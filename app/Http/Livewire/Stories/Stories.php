<?php

namespace App\Http\Livewire\Stories;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Carbon;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\LflbApp;
use App\Models\LflbCategory;
use App\Models\LflbSubCategory;
use App\Models\LflbStory;
use Illuminate\Support\Facades\Log;

class Stories extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows, WithFileUploads;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'title' => '',
        'parent_category' => '',
        'sub_category' => '',
        'featured' => '',
    ];
    public LflbStory $editing;
    public $editingSubCategories = [];
    public LflbCategory $editingCategory;
    public LflbApp $editingApp;
    public $collection;
    public $upload;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshStories' => '$refresh'];

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.description' => 'sometimes',
            'editing.image' => 'sometimes|nullable',
            'editing.app_id' => 'required',
            // 'editingApp.name' => 'required|min:3',
            'editingSubCategories' => 'required',
            // 'editingSubCategory.sub_category_id' => 'required',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankStory();
        $this->editingSubCategories = $this->makeBlankSubCategory();
        $this->editingApp = $this->makeBlankApp();
        // $this->collection = LflbSubCategory::all();
    }
    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'stories.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted ' . $deleteCount . ' stories');
        $this->selected = [];
        $this->editing = $this->makeBlankStory();
        $this->editingSubCategories = $this->makeBlankSubCategory();
        $this->editingApp = $this->makeBlankApp();
    }

    public function makeBlankStory()
    {
        $blank_story = LflbStory::make(['app_id' => 1, 'description' => 'NEW STORY DESCRIPTION', 'featured' => 'FALSE', 'app_name' => 'History Center of Lake Forest-Lake Bluff', 'imageUrl' => 'nothing']);
        // dd($blank_story);
        return $blank_story;
    }
    public function makeBlankApp()
    {
        return LflbApp::make(['name' => 'History Center of Lake Forest-Lake Bluff']);
    }
    public function makeBlankSubCategory()
    {
        // return LflbSubCategory::make(['id' => 12]);
        return [];
    }
    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankStory();
            // $this->editingSubCategories[] = ['id' => '12'];

            $this->editingApp = $this->makeBlankApp();
        }

        $this->showEditModal = true;
        // dd($this->editingSubCategories);
    }

    public function edit(LflbStory $lflb_story)
    {
        $this->useCachedRows();
        if ($this->editing->isNot($lflb_story)) {
            $this->editing = $lflb_story;
            $this->editingSubCategories = [];
            foreach ($this->editing->lflbSubCategories as $sub_category) {
                $this->editingSubCategories[] = $sub_category->id;
            }
            $this->editingApp = $lflb_story->lflbApp;
        }
        $this->showEditModal = true;
        // dd($this->editingSubCategories);
    }

    public function save()
    {
        $this->validate();

        if ($this->editing->save()) {
            // if ($this->editing->fill($this->editing->only($this->editing->fillable))->save()) {
            $this->upload && $this->editing->update([
                'image' => $this->upload->store('/', 'public'),
            ]);

            // $parent_app = $this->editing->lflbApp;
            // $parent_app->update(['name' => $this->editingApp->name]);
            foreach ($this->editingSubCategories as $subCategory) {
                $this->editing->lflbSubCategories()->sync($subCategory, false);
                # code...
            }

            $this->showEditModal = false;
            unset($this->editingSubCategories);

            $this->notify('You\'ve updated a story');
        } else {
            // dd($this->editing);
        }
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = LflbStory::query()

            // ->has('lflbSubCategories')
            // $query = LflbStory::query()
            ->when($this->filters['search'], fn ($query, $search) => $query->where('lflb_stories.title', 'like', '%' . $search . '%'))
            ->when($this->filters['sub_category'], fn ($query, $sub_category) => $query->where('lflb_sub_categories.id', '=', $sub_category))
            ->when($this->filters['parent_category'], fn ($query, $parent_category) => $query->where('lflb_categories.id', '=', $parent_category))
            ->join(
                'lflb_story_lflb_sub_category',
                'lflb_story_lflb_sub_category.lflb_story_id',
                '=',
                'lflb_stories.id'
            )
            ->join(
                'lflb_sub_categories',
                'lflb_sub_categories.id',
                '=',
                'lflb_story_lflb_sub_category.lflb_sub_category_id'
            )
            ->join(
                'lflb_categories',
                'lflb_categories.id',
                '=',
                'lflb_sub_categories.category_id'
            )
            ->select('lflb_stories.*', 'lflb_sub_categories.title as sub_category_title', \DB::raw('group_concat(DISTINCT lflb_sub_categories.title ORDER BY lflb_sub_categories.title) as sub_category_titles'), \DB::raw('group_concat(DISTINCT lflb_categories.title ORDER BY lflb_categories.title) as category_titles'))
            ->groupBy('lflb_stories.title')
            ->has('lflbSubCategories')
            ->where('app_id', 1)
            ->whereNot('lflb_categories.id', 2);


        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {
        return view('livewire.stories.stories', [
            'stories' => $this->rows,
        ]);
    }
}

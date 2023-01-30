<?php

namespace App\Http\Livewire\Stories;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Carbon;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\LflbCategory;
use App\Models\LflbSubCategory;
use App\Models\LflbStory;

class Stories extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows, WithFileUploads;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'title' => '',
        'image' => '',
        'app_id' => '',
        'parent_category' => '',
        'sub_category' => '',
        // 'featured' => '',
    ];
    public LflbStory $editing;
    public $collection;
    public $upload;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshStories' => '$refresh'];

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.description' => 'required|min:3',
            'editing.image' => 'sometimes|nullable',
            // 'editing.category_id' => 'sometimes|nullable',
            'editing.app_id' => 'required',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankCategory();
        $this->collection = LflbSubCategory::all();
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
    }

    public function makeBlankCategory()
    {
        return LflbStory::make(['app_id' => '1', 'description' => 'NEW STORY DESCRIPTION', 'featured' => 'FALSE']);
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankCategory();

        $this->showEditModal = true;
    }

    public function edit(LflbStory $lflb_story)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($lflb_story)) $this->editing = $lflb_story;
        // $this->editing->category_id = $lflb_story->lflbCategory->id;

        $this->showEditModal = true;
        // dd($lflb_story);
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->upload && $this->editing->update([
            'image' => $this->upload->store('/', 'public'),
        ]);

        $this->showEditModal = false;

        $this->notify('You\'ve updated a story');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = LflbStory::query()
            ->when($this->filters['title'], fn ($query, $title) => $query->where('title', 'like', '%' . $title . '%'))
            ->when($this->filters['search'], fn ($query, $search) => $query->where('title', 'like', '%' . $search . '%'))
            ->join('lflb_apps', 'lflb_stories.app_id', '=', 'lflb_apps.id')
            ->select(
                'lflb_stories.*',
                'lflb_apps.name as app_name',
            )
            ->where('app_id', 1)
            ->distinct();

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        // dd($this->rowsQuery);
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

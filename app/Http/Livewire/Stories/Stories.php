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
        'image' => '',
        'app_id' => '',
        'app_name' => '',
        'parent_category' => '',
        'sub_category' => '',
        'featured' => '',
    ];
    public LflbStory $editing;
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
            // 'editing.category_id' => 'sometimes|nullable',
            'editingApp.name' => 'sometimes',
            // 'editing.featured' => 'sometimes',
            'editing.app_id' => 'required',
            'editing.imageUrl' => 'required',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankCategory();
        // dd($this->editing);
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
    }

    public function makeBlankCategory()
    {
        // EditPost::where('original_post_id', 4)->update(array('post_approval_rating'=>$some_value))->editor()->associate($user)->save();
        return LflbStory::make(['app_id' => '16', 'description' => 'NEW STORY DESCRIPTION', 'featured' => 'FALSE', 'app_name' => 'THE YO APP', 'imageUrl' => 'nothing']);
        // return LflbApp::make(['app_name' => 'THE YO APP']);
    }
    public function makeBlankApp()
    {
        // EditPost::where('original_post_id', 4)->update(array('post_approval_rating'=>$some_value))->editor()->associate($user)->save();
        return LflbApp::make(['name' => 'THE TESTING APP']);
        // return LflbApp::make(['app_name' => 'THE YO APP']);
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
        // dd($this->editing);
    }

    public function edit(LflbStory $lflb_story)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($lflb_story)) $this->editing = $lflb_story;
        // $this->editing->category_id = $lflb_story->lflbCategory->id;
        // $this->editingApp = $lflb_story->lflbApp;
        // dd($lflb_story->lflbApp);
        $this->showEditModal = true;
        // dd($lflb_story);
    }

    public function save()
    {
        $this->validate();
        // dd($this->editing);
        // Log::info($this->editing);
        // Log::info(
        //     $this->editing
        //         ->join(
        //             'lflb_apps',
        //             'lflb_stories.app_id',
        //             '=',
        //             'lflb_apps.id'
        //         )->toSql()
        // );

        // LflbStory::where('original_post_id', 4)
        // ->update(array('post_approval_rating'=>$some_value))
        // ->editor()
        // ->associate($user)
        // ->save();
        // dd($this->editing);
        // dd($this->editing);
        if ($this->editing->save()) {
            // if ($this->editing->fill($this->editing->only($this->editing->fillable))->save()) {
            $this->upload && $this->editing->update([
                'image' => $this->upload->store('/', 'public'),
            ]);
            $story_id = $this->editing->id;
            // $this->editingApp = $this->editing::find($story_id)->lflbApp;
            $parent_app = $this->editing->lflbApp;
            // dd($this->editingApp);
            $parent_app->update(['name' => $this->editingApp->name]);
            // dd($this->editingApp);
            Log::info($story_id);
            // dd(
            //     LflbStory::find($story_id)
            //         ->join(
            //             'lflb_apps',
            //             'lflb_stories.app_id',
            //             '=',
            //             'lflb_apps.id'
            //         )
            // );
            // dd(
            // LflbStory::find($story_id)
            //     ->lflbApp()->update(['name' => $this->editingApp->app_name]);
            // );

            $this->showEditModal = false;

            $this->notify('You\'ve updated a story');
        } else {
            dd($this->editing);
        }
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
            // ->join(
            //     'lflb_sub_categories',
            //     \DB::raw('FIND_IN_SET(`lflb_stories`.`id`, `lflb_sub_categories`.`stories`)'),
            //     '>',
            //     \DB::raw('0')
            // )
            // ->join(
            //     'lflb_categories',
            //     'lflb_sub_categories.category_id',
            //     '=',
            //     'lflb_categories.id'
            // )
            ->join(
                'lflb_apps',
                'lflb_stories.app_id',
                '=',
                'lflb_apps.id'
            )
            ->select(
                'lflb_stories.*',
                // 'lflb_sub_categories.id as sub_category_id',
                // 'lflb_sub_categories.title as sub_category_title',
                // 'lflb_categories.title as category_title',
                // 'lflb_categories.id as category_id',
                // 'lflb_categories.featured as category_featured',
                'lflb_apps.id as app_id',
                'lflb_apps.name as app_name',
            )
            ->where('app_id', 16);
        // ->where('lflb_categories.id', '!=', '2');
        // ->distinct();

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

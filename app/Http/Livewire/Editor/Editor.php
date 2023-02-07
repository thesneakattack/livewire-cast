<?php

namespace App\Http\Livewire\Editor;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Carbon;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\LflbApp;
use App\Models\LflbAsset;
use App\Models\LflbCategory;
use App\Models\LflbSubCategory;
use App\Models\LflbStory;
use Illuminate\Support\Facades\Log;

class Editor extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows, WithFileUploads;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [];
    public $sub_category;
    public LflbStory $story;
    public LflbAsset $editing;
    public LflbAsset $asset;
    public $storyAssets;
    public $allAssets = [];
    public $collection;
    public $upload;

    public function mount()
    {
        $this->editing = $this->makeBlankAsset();
        $this->storyAssets = $this->story->lflbAssets;
    }

    public function makeBlankAsset()
    {
        return LflbAsset::make(['type' => 'TEXT', 'cleanText' => 'TESTING', 'caption' => 'DEFAULT CAPTION']);
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankAsset();
        }

        $this->showEditModal = true;
    }

    public function edit(LflbAsset $lflb_asset)
    {
        $this->useCachedRows();
        if ($this->editing->isNot($lflb_asset)) {
            $this->editing = $lflb_asset;
        }
        $this->showEditModal = true;
    }

    public function rules()
    {
        return [
            'editing.type' => 'sometimes|nullable',
            'editing.caption' => 'required|min:3',
            'storyAssets.*.type' => 'sometimes|nullable',
            // 'editing.image' => 'sometimes|nullable',
            // 'editing.category_id' => 'sometimes|nullable',
            // 'editingApp.name' => 'required|min:3',
            // 'editing.featured' => 'sometimes',
            // 'editing.app_id' => 'required',
            // 'editing.imageUrl' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();
        if ($this->editing->save()) {
            // if ($this->editing->fill($this->editing->only($this->editing->fillable))->save()) {
            $this->upload && $this->editing->update([
                'image' => $this->upload->store('/', 'public'),
            ]);
            $this->editing->lflbStories()->attach($this->story->id);
            // $parent_app = $this->editing->lflbApp;
            // $parent_app->update(['name' => $this->editingApp->name]);

            $this->showEditModal = false;

            $this->notify('You\'ve updated a story');
        } else {
            // dd($this->editing);
        }
        $this->storyAssets->each(function ($item, $key) {
            $item->save();
            $item->sync([$this->story->id]);
        });
        // if ($this->storyAssets->each->save()) {
        //     dd($this->storyAssets->each);
        //     $this->notify('You\'ve updated a story');
        //     foreach ($this->editingSubCategories as $subCategory) {
        //         $this->editing->lflbSubCategories()->sync($subCategory, false);
        //         # code...
        //     }
        // }
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted ' . $deleteCount . ' items');
        $this->selected = [];
        $this->editing = $this->makeBlankAsset();
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function getRowsQueryProperty()
    {
        // $query = $this->asset::with([
        //     'lflbStories' => function ($query) {
        //         $query->where('lflb_stories.id', $this->story->id)->get();
        //     }
        // ]);
        $query = LflbAsset::query()
            ->join(
                'lflb_asset_lflb_story',
                'lflb_asset_lflb_story.asset_id',
                '=',
                'lflb_assets.id'
            )
            ->join(
                'lflb_stories',
                'lflb_stories.id',
                '=',
                'lflb_asset_lflb_story.story_id'
            )
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
            ->select(
                'lflb_assets.*',
                'lflb_asset_lflb_story.id as story_part_id',
                'lflb_asset_lflb_story.position as pivot_position',
                'lflb_asset_lflb_story.story_id as pivot_story_id',
                'lflb_asset_lflb_story.asset_id as pivot_asset_id',
                'lflb_stories.id as story_id',
                'lflb_stories.title as story_title',
                'lflb_sub_categories.id as sub_category_id',
                'lflb_sub_categories.title as sub_category_title',
                'lflb_categories.id as category_id',
                'lflb_categories.title as category_title',
            )
            ->where('lflb_asset_lflb_story.story_id', $this->story->id)
            ->orderBy('lflb_asset_lflb_story.position')
            ->groupBy('lflb_assets.id');
        // ->groupBy('')
        // ->where('lflb_sub_categories.id', '=', $this->sub_category);
        // ->distinct('lflb_assets.id', 'lflb_categories.id');

        return $this->applySorting($query);
    }
    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
            // return $this->rowsQuery->paginate(10);
        });
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'stories.csv');
    }

    public function render()
    {
        // dd($this->story->id);
        // dd($this->rows);
        // $this->story = LflbStory::find($this->id);
        // dd($this->story->toArray());
        return view('livewire.editor.editor', [
            'story' => $this->story
        ]);
    }
}

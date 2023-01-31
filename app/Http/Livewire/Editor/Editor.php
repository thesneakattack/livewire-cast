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
    public LflbStory $story;
    public LflbStory $editing;
    public LflbAsset $asset;
    public $collection;
    public $upload;

    public function mount()
    {
        $this->editing = $this->makeBlankAsset();
        $this->asset = new LflbAsset;
    }

    public function makeBlankAsset()
    {
        return LflbStory::make(['title' => 'DEFAULT TITLE']);
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankAsset();
            // $this->editingApp = $this->makeBlankApp();
        }

        $this->showEditModal = true;
    }

    public function edit(LflbStory $lflb_story)
    {
        $this->useCachedRows();
        if ($this->editing->isNot($lflb_story)) {
            $this->editing = $lflb_story;
            // $this->editingApp = $lflb_story->lflbApp;
        }
        $this->showEditModal = true;
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
        $query = $this->asset::with([
            'lflbStories' => function ($query) {
                $query->where('lflb_stories.id', $this->story->id)->get();
            }
        ]);
        // ->when($this->filters['title'], fn ($query, $title) => $query->where('title', 'like', '%' . $title . '%'))
        // ->when($this->filters['search'], fn ($query, $search) => $query->where('title', 'like', '%' . $search . '%'));
        // ->distinct();

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->rowsQuery->paginate(5);
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
        return view('livewire.editor.editor', [
            'assets' => $this->rows,
        ]);
    }
}

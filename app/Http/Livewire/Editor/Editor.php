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
    public LflbStory $story;
    public LflbStory $editing;
    public LflbApp $editingApp;
    public $collection;
    public $upload;

    public function render()
    {
        // $this->story = LflbStory::find($this->id);
        return view('livewire.editor.editor');
    }
}

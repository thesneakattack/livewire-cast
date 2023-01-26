<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LflbCategory;
use Illuminate\Support\Carbon;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class Categories extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'featured' => '',
    ];
    public LflbCategory $editing;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshCategories' => '$refresh'];

    public function rules() { return [
        'editing.title' => 'required|min:3',
        'editing.featured' => 'required|in:'.collect(LflbCategory::STATUSES)->keys()->implode(','),
    ]; }

    public function mount() { $this->editing = $this->makeBlankCategory(); }
    public function updatedFilters() { $this->resetPage(); }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'categories.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted '.$deleteCount.' categories');
    }

    public function makeBlankCategory()
    {
        return LflbCategory::make(['date' => now(), 'featured' => 'TRUE']);
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = ! $this->showFilters;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankCategory();

        $this->showEditModal = true;
    }

    public function edit(LflbCategory $lflb_category)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($lflb_category)) $this->editing = $lflb_category;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function resetFilters() { $this->reset('filters'); }

    public function getRowsQueryProperty()
    {
        $query = LflbCategory::query()
            ->when($this->filters['featured'], fn($query, $featured) => $query->where('featured', $featured))
            ->when($this->filters['search'], fn($query, $search) => $query->where('title', 'like', '%'.$search.'%'));

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
        return view('livewire.categories', [
            'categories' => $this->rows,
        ]);
    }
}

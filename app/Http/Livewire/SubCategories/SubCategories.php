<?php

namespace App\Http\Livewire\SubCategories;

use Livewire\Component;
use App\Models\LflbSubCategory;
use Illuminate\Support\Carbon;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class SubCategories extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'title' => '',
        'subTitle' => '',
        // 'sub_categories' => '',
        'featured' => '',
    ];
    public LflbSubCategory $editing;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshSubCategories' => '$refresh'];

    public function rules() { return [
        'editing.title' => 'required|min:3',
        'editing.subTitle' => 'required|min:3',
    ]; }

    public function mount() { $this->editing = $this->makeBlankCategory(); }
    public function updatedFilters() { $this->resetPage(); }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'sub-categories.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted '.$deleteCount.' sub-categories');
    }

    public function makeBlankCategory()
    {
        return LflbSubCategory::make(['date' => now(), 'featured' => 'FALSE']);
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

    public function edit(LflbSubCategory $lflb_category)
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

        $this->notify('You\'ve added a sub-category');
    }

    public function resetFilters() { $this->reset('filters'); }

    public function getRowsQueryProperty()
    {
        $query = LflbSubCategory::query()
            ->when($this->filters['title'], fn($query, $title) => $query->where('title', 'like', '%'.$title.'%'))
            ->when($this->filters['subTitle'], fn($query, $subTitle) => $query->where('subTitle', 'like', '%'.$subTitle.'%'))
            // ->when($this->filters['sub_categories'], fn($query, $sub_categories) => $query->where('sub_categories', 'like', '%'.$sub_categories.'%'))
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
        return view('livewire.sub-categories.view', [
            'sub-categories' => $this->rows,
        ]);
    }
}

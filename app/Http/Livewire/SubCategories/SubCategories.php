<?php

namespace App\Http\Livewire\SubCategories;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LflbSubCategory;
use Illuminate\Support\Carbon;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\LflbCategory;

class SubCategories extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows, WithFileUploads;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'title' => '',
        'subTitle' => '',
        'category_id' => '',
        'parent_category' => '',
        'featured' => '',
    ];
    public LflbSubCategory $editing;
    public $collection;
    public $upload;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshSubCategories' => '$refresh'];

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.subTitle' => 'required|min:3',
            'editing.mainImage' => 'sometimes|nullable',
            'editing.category_id' => 'required|int',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankSubCategory();
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
        }, 'sub-categories.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->notify('You\'ve deleted ' . $deleteCount . ' sub-categories');
        $this->selected = [];
        $this->editing = $this->makeBlankSubCategory();
    }

    public function makeBlankSubCategory()
    {
        return LflbSubCategory::make(['date' => now(), 'featured' => 'FALSE']);
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = !$this->showFilters;
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankSubCategory();

        $this->showEditModal = true;
    }

    public function edit(LflbSubCategory $lflb_sub_category)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($lflb_sub_category)) $this->editing = $lflb_sub_category;
        // $this->editing->category_id = $lflb_sub_category->lflbCategory->id;

        $this->showEditModal = true;
        // dd($lflb_sub_category);
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->upload && $this->editing->update([
            'mainImage' => $this->upload->store('/', 'public'),
        ]);

        $this->showEditModal = false;

        $this->notify('You\'ve updated a sub-category');
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function getRowsQueryProperty()
    {
        $query = LflbSubCategory::query()
            ->when($this->filters['title'], fn ($query, $title) => $query->where('title', 'like', '%' . $title . '%'))
            ->when($this->filters['subTitle'], fn ($query, $subTitle) => $query->where('subTitle', 'like', '%' . $subTitle . '%'))
            // ->when($this->filters['parent_category'], fn ($query, $parent_category) => $query->where('`lflb_categories`.`title`', 'like', '%' . $parent_category . '%'))
            ->when(
                $this->filters['category_id'],
                function ($query, $category_id) {
                    // return dd(LflbCategory::query());
                    return $query->where('category_id', 'like', '%' . $category_id . '%');
                }
            )
            // ->when($this->filters['parent_category'], fn ($query, $parent_category) => $query->where('category.title', 'like', '%' . $parent_category . '%'))
            ->when($this->filters['featured'], fn ($query, $featured) => $query->where('featured', $featured))
            ->when($this->filters['search'], fn ($query, $search) => $query->where('title', 'like', '%' . $search . '%'))
            // ->with('lflbCategory')->get();
            ->join('lflb_categories', 'lflb_sub_categories.category_id', '=', 'lflb_categories.id')
            ->select(
                'lflb_sub_categories.*',
                'lflb_categories.title as category_title',
                'lflb_categories.mainImage as category_mainImage',
            )
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
        return view('livewire.sub-categories.sub-categories', [
            'sub_categories' => $this->rows,
        ]);
    }
}

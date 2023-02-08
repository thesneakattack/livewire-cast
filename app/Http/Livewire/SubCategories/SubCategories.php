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

    public function validationAttributes()
    {
        return [
            'category_id' => 'parent category'
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
        return LflbSubCategory::make(['date' => now(), 'featured' => 'FALSE', 'category_id' => '']);
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
            ->when(
                $this->filters['parent_category'],
                function ($query, $parent_category) {
                    // return dd(LflbCategory::query());
                    return $query->where('lflb_categories.id', '=', $parent_category);
                }
            )
            // ->when($this->filters['featured'], fn ($query, $featured) => $query->where('featured', $featured))
            ->when($this->filters['search'], fn ($query, $search) => $query->where('lflb_sub_categories.title', 'like', '%' . $search . '%'))
            // ->with('lflbCategory')->get();
            ->join('lflb_categories', 'lflb_sub_categories.category_id', '=', 'lflb_categories.id')
            ->join('lflb_story_lflb_sub_category', 'lflb_sub_categories.id', '=', 'lflb_story_lflb_sub_category.lflb_sub_category_id')
            ->select(
                'lflb_sub_categories.*',
                'lflb_categories.title as category_title',
                'lflb_categories.mainImage as category_mainImage',
                \DB::raw('COUNT(lflb_story_lflb_sub_category.id) as story_count')
            )->groupBy('lflb_sub_categories.id');
        // ->selectRaw('issues.*, COUNT(lflb_story_lflb_sub_category.id) as story_count')
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
        return view('livewire.sub-categories.sub-categories', [
            'sub_categories' => $this->rows,
        ]);
    }
}

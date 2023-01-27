<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LflbCategory;
use Illuminate\Support\Carbon;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class Categories extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows, WithFileUploads;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'title' => '',
        'description' => '',
        'introText' => '',
        'bodyText' => '',
        'mainImage' => '',
        'sub_categories' => '',
        'featured' => '',
    ];
    public LflbCategory $editing;
    public $upload;

    protected $queryString = ['sorts'];

    protected $listeners = ['refreshCategories' => '$refresh'];

    public function rules() { return [
        'editing.title' => 'required|min:3',
        'editing.description' => 'required|min:3',
        'editing.introText' => 'sometimes|nullable',
        'editing.bodyText' => 'sometimes|nullable',
        // 'editing.mainImage' => 'nullable|image|max:1024',
        'editing.mainImage' => 'sometimes|nullable',
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
        //set default values
        return LflbCategory::make(['featured' => 'FALSE']);
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
        // $this->editing->mainImage = $this->editing->avatarUrl();

        $this->showEditModal = true;

        // dd($this->editing->introText);
    }

    public function save()
    {
        $this->validate();

        // dd($this->upload);

        $this->editing->save();

        $this->upload && $this->editing->update([
            'mainImage' => $this->upload->store('/', 'public'),
        ]);

        $this->showEditModal = false;

        $this->notify('You\'ve updated a category');
    }

    public function resetFilters() { $this->reset('filters'); }

    public function getRowsQueryProperty()
    {
        $query = LflbCategory::query()
            ->when($this->filters['title'], fn($query, $title) => $query->where('title', 'like', '%'.$title.'%'))
            ->when($this->filters['description'], fn($query, $description) => $query->where('description', 'like', '%'.$description.'%'))
            ->when($this->filters['introText'], fn($query, $introText) => $query->where('introText', 'like', '%'.$introText.'%'))
            ->when($this->filters['bodyText'], fn($query, $bodyText) => $query->where('bodyText', 'like', '%'.$bodyText.'%'))
            ->when($this->filters['mainImage'], fn($query, $mainImage) => $query->where('mainImage', 'like', '%'.$mainImage.'%'))
            ->when($this->filters['sub_categories'], fn($query, $sub_categories) => $query->where('sub_categories', 'like', '%'.$sub_categories.'%'))
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
        return view('livewire.categories.view', [
            'categories' => $this->rows,
        ]);
    }
}

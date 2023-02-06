<div>
    <h1 class="text-2xl font-semibold text-gray-900">Stories</h1>

    <div class="py-4 space-y-4">
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div class="flex w-2/4 space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Search Stories..." />

                <x-button.link wire:click="toggleShowFilters">@if ($showFilters) Hide @endif Advanced Search...
                </x-button.link>
            </div>

            <div class="flex items-center space-x-2">
                <x-input.group borderless paddingless for="perPage" label="Per Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-dropdown label="Bulk Actions">
                    <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                        <x-icon.download class="text-cool-gray-400" /> <span>Export</span>
                    </x-dropdown.item>

                    <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')"
                        class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400" /> <span>Delete</span>
                    </x-dropdown.item>
                </x-dropdown>

                {{--
                <livewire:categories.import-categories /> --}}

                <x-button.primary wire:click="create">
                    <x-icon.plus /> New
                </x-button.primary>
            </div>
        </div>

        <!-- Advanced Search -->
        <div>
            @if ($showFilters)
            <div class="relative flex p-4 rounded shadow-inner bg-cool-gray-200">
                <div class="w-1/2 pr-2 space-y-4">
                    <x-input.group inline for="filter-featured" label="Featured">
                        <x-input.select wire:model="filters.featured" id="filter-featured">
                            <option value="" disabled>Select Featured...</option>

                            @foreach (App\Models\LflbCategory::STATUSES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group inline for="filter-title" label="Title">
                        <x-input.text wire:model.lazy="filters.title" id="filter-title" placeholder="Title" />
                    </x-input.group>

                    <x-input.group inline for="filter-description" label="Description">
                        <x-input.text wire:model.lazy="filters.description" id="filter-description"
                            placeholder="Description" />
                    </x-input.group>
                </div>

                <div class="w-1/2 pl-2 space-y-4">
                    <x-button.link wire:click="resetFilters" class="absolute bottom-0 right-0 p-4">Reset Filters
                    </x-button.link>
                </div>
            </div>
            @endif
        </div>
        {{-- {{dd($stories)}} --}}
        <!-- Stories Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="w-8 pr-0">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('lflb_stories.title')"
                        :direction="$sorts['lflb_stories.title'] ?? null">Title</x-table.heading>
                    <x-table.heading>Main Image</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('sub_category_titles')"
                        :direction="$sorts['sub_category_titles'] ?? null">Sub-Categories</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('category_titles')"
                        :direction="$sorts['category_titles'] ?? null">Parent Categories</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('created_at')"
                        :direction="$sorts['created_at'] ?? null">Date Created</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="6">
                            @unless ($selectAll)
                            <div>
                                <span>You have selected <strong>{{ $stories->count() }}</strong> stories, do
                                    you want to select all <strong>{{ $stories->total() }}</strong>?</span>
                                <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All
                                </x-button.link>
                            </div>
                            @else
                            <span>You are currently selecting all <strong>{{ $stories->total() }}</strong>
                                stories.</span>
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @endif
                    {{-- {{dd($stories)}} --}}
                    @forelse ($stories as $story)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $story->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $story->id }}" />
                        </x-table.cell>

                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400" />

                                <p class="truncate text-cool-gray-600">
                                    {{ $story->title }}
                                </p>
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="font-medium text-cool-gray-900">{{ $story->image }} </span>
                        </x-table.cell>

                        <x-table.cell class="max-w-[150px]">
                            <ol>
                                <li>
                                    <span class="font-medium text-cool-gray-900">
                                        {{-- @foreach ($story->lflbSubCategories->sortBy('title') as $sub_category)
                                        @php
                                        @endphp
                                        @unless ($sub_category->lflbCategory->id === 2)
                                        {{$sub_category->title}}<br>
                                        @endunless
                                        @endforeach --}}

                                        @foreach ( $story->lflbCategories()->sortBy('title') as $category =>
                                        $sub_categories)
                                        @unless ($category === 'Timeline')
                                        {{-- <strong>{{$category}}</strong> --}}
                                        <ol>
                                            @foreach ($sub_categories as $sub_category)
                                            <li>{{$sub_category->title}}</li>
                                            @endforeach
                                        </ol>
                                        @endunless
                                        @endforeach
                                    </span>
                                </li>
                            </ol>
                        </x-table.cell>
                        <x-table.cell class="max-w-[150px]">
                            <ul>
                                <li>
                                    <span class="font-medium text-cool-gray-900">
                                        @foreach ( $story->lflbCategories()->sortBy('title') as $category =>
                                        $sub_categories)
                                        @unless ($category === 'Timeline')
                                        <strong>{{$category}}</strong>
                                        <ol>
                                            @foreach ($sub_categories as $sub_category)
                                            <li>{{$sub_category->title}}</li>
                                            @endforeach
                                        </ol>
                                        @endunless
                                        @endforeach
                                    </span>
                                </li>
                            </ul>
                        </x-table.cell>
                        <x-table.cell>
                            {{ $story->date_for_humans }}
                        </x-table.cell>

                        <x-table.cell>
                            {{-- <x-button.link
                                onclick="location.href='{{ route('editor', ['story' => $story->id, 'sub_category' => $story->lflbSubCategories->first()->id]) }}'">
                                Edit</x-button.link> --}}
                            <x-button.link wire:click="edit({{ $story->id }})">Edit</x-button.link>
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="6">
                            <div class="flex items-center justify-center space-x-2">
                                <x-icon.inbox class="w-8 h-8 text-cool-gray-400" />
                                <span class="py-8 text-xl font-medium text-cool-gray-400">No stories
                                    found...</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div>
                {{ $stories->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Stories Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Story</x-slot>

            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Are you sure? This action is irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit" wire:click="resetFilters">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>

    <!-- Save Story Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit Story</x-slot>

            <x-slot name="content">
                <x-input.group for="title" label="Title" :error="$errors->first('editing.title')">
                    <x-input.text wire:model="editing.title" id="title" placeholder="Title" />
                </x-input.group>

                <x-input.group for="description" label="Description" :error="$errors->first('editing.description')">
                    <x-input.text wire:model="editing.description" id="description" placeholder="Description" />
                </x-input.group>

                <x-input.group label="Main Image" for="image" :error="$errors->first('editing.image')">
                    <x-input.file-upload wire:model="upload" id="image">
                        <span class="w-12 h-12 overflow-hidden bg-gray-100 rounded-full">
                            @if ($upload)
                            <img src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
                            @else
                            {{-- <img src="{{ asset('/storage/'.$editing->image) }}" alt="Profile Photo"> --}}
                            <img src="{{ $editing->mainImageUrl() }}" alt="Profile Photo">
                            @endif
                        </span>
                    </x-input.file-upload>
                </x-input.group>

                <x-input.group for="Sub_Categories" label="Sub-Category"
                    :error="$errors->first('editingSubCategories')">
                    <x-input.select wire:model="editingSubCategories" id="Sub_Categories" multiple>
                        <option value="" disabled>Select Sub-Category</option>
                        @foreach (App\Models\LflbSubCategory::all() as $sub_category)
                        @unless ($sub_category->LflbCategory->id === 2)

                        <option value="{{ $sub_category->id }}">{{ $sub_category->title }}</option>
                        @endunless
                        @endforeach
                    </x-input.select>
                </x-input.group>
                <input type="hidden" wire:model="editing.app_id" id="app_id">
                <x-input.group for="app_name" label="App Name" :error="$errors->first('editingApp.name')">
                    <x-input.text wire:model="editingApp.name" id="name" placeholder="App Name" />
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>

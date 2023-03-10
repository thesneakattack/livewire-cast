<div>
    <h1 class="text-2xl font-semibold text-gray-900">Categories</h1>

    <div class="py-4 space-y-4">
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div class="flex w-2/4 space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Search Categories..." />

                <x-button.link wire:click="toggleShowFilters">
                    @if ($showFilters) Hide @endif
                    Advanced Search...
                </x-button.link>
            </div>

            <div class="flex items-center space-x-2">
                <x-input.group for="perPage" borderless paddingless label="Per Page">
                    <x-input.select id="perPage" wire:model="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-dropdown label="Bulk Actions">
                    <x-dropdown.item class="flex items-center space-x-2" type="button"
                        wire:click="$toggle('showDeleteModal')">
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
                        <x-input.group for="filter-featured" inline label="Featured">
                            <x-input.select id="filter-featured" wire:model="filters.featured">
                                <option value="" disabled>Select Featured...</option>

                                @foreach (App\Models\LflbCategory::STATUSES as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </x-input.select>
                        </x-input.group>

                        {{-- <x-input.group inline for="filter-title" label="Title">
                        <x-input.text wire:model.lazy="filters.title" id="filter-title" placeholder="Title" />
                    </x-input.group>

                    <x-input.group inline for="filter-description" label="Description">
                        <x-input.text wire:model.lazy="filters.description" id="filter-description"
                            placeholder="Description" />
                    </x-input.group>
                </div> --}}

                        <div class="w-1/2 pl-2 space-y-4">
                            <x-button.link class="absolute bottom-0 right-0 p-4" wire:click="resetFilters">Reset Filters
                            </x-button.link>
                        </div>
                    </div>
            @endif
        </div>

        <!-- Categories Table -->
        <div class="flex-col space-y-4">
            <div>
                {{ $categories->links() }}
            </div>
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="w-8 pr-0">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading />
                    <x-table.heading sortable multi-column wire:click="sortBy('title')" :direction="$sorts['title'] ?? null">Title
                    </x-table.heading>
                    {{-- <x-table.heading>Description</x-table.heading> --}}
                    {{-- <x-table.heading>Introduction</x-table.heading>
                    <x-table.heading>Body</x-table.heading> --}}
                    <x-table.heading>Main Image</x-table.heading>
                    <x-table.heading>Sub-Categories</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('featured')" :direction="$sorts['featured'] ?? null">Featured
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('created_at')" :direction="$sorts['created_at'] ?? null">Date
                        Created</x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                        <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                            <x-table.cell colspan="6">
                                @unless($selectAll)
                                    <div>
                                        <span>You have selected <strong>{{ $categories->count() }}</strong> categories, do
                                            you
                                            want to select all <strong>{{ $categories->total() }}</strong>?</span>
                                        <x-button.link class="ml-1 text-blue-600" wire:click="selectAll">Select All
                                        </x-button.link>
                                    </div>
                                @else
                                    <span>You are currently selecting all <strong>{{ $categories->total() }}</strong>
                                        categories.</span>
                        @endif
                        </x-table.cell>
                        </x-table.row>
                        @endif

                        @forelse ($categories as $category)
                            <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $category->id }}">
                                <x-table.cell class="pr-0">
                                    <x-input.checkbox value="{{ $category->id }}" wire:model="selected" />
                                </x-table.cell>
                                <x-table.cell>
                                    <x-button.secondary wire:click="edit({{ $category->id }})">Details</x-button.link>
                                        <a href="{{ env('SIGN_PREVIEW_URL') . 'topics/' . $category->id }}" target="_blank">
                                            <x-button.secondary>
                                                Preview
                                            </x-button.secondary>
                                        </a>
                                </x-table.cell>
                                <x-table.cell>
                                    <span class="inline-flex space-x-2 text-sm leading-5" href="#">
                                        <x-icon.cash class="text-cool-gray-400" />

                                        <p class="truncate text-cool-gray-600">
                                            {{ $category->title }}
                                        </p>
                                    </span>
                                </x-table.cell>

                                {{-- <x-table.cell>
                            <span class="font-medium text-cool-gray-900">{{ $category->description }} </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="font-medium text-cool-gray-900">{{ $category->introText }} </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="font-medium text-cool-gray-900">{{ $category->bodyText }} </span>
                        </x-table.cell> --}}

                                <x-table.cell>
                                    <div class="flex flex-wrap content-center justify-center">
                                        <div class="w-96 sm:w-96">
                                            @if (file_exists(storage_path('app/public/' . $category->mainImage)))
                                                <img src="{{ $category->mainImageUrl() }}" alt="...">
                                            @else
                                                <img class="object-contain h-auto max-w-full align-middle border-none rounded shadow "
                                                    src="https://lflbsign.webfoundry.dev/assets/{{ $category->mainImage }}"
                                                    alt="..." />
                                            @endif
                                        </div>
                                    </div>
                                </x-table.cell>

                                <x-table.cell class="max-w-[150px]">
                                    <ol>
                                        @foreach ($category->lflbSubCategories->sortBy('position')->sortBy('title') as $sub_category)
                                            <li>
                                                <span class="font-medium text-cool-gray-900">{{ $sub_category->title }}
                                                </span>
                                            </li>
                                        @endforeach

                                    </ol>
                                </x-table.cell>

                                <x-table.cell>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $category->status_color }}-100 text-{{ $category->status_color }}-800 capitalize">
                                        {{ $category->featured }}
                                    </span>
                                </x-table.cell>

                                <x-table.cell>
                                    {{ $category->date_for_humans }}
                                </x-table.cell>

                            </x-table.row>
                        @empty
                            <x-table.row>
                                <x-table.cell colspan="6">
                                    <div class="flex items-center justify-center space-x-2">
                                        <x-icon.inbox class="w-8 h-8 text-cool-gray-400" />
                                        <span class="py-8 text-xl font-medium text-cool-gray-400">No categories
                                            found...</span>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>


            </div>
        </div>

        <!-- Delete Categories Modal -->
        <form wire:submit.prevent="deleteSelected">
            <x-modal.confirmation wire:model.defer="showDeleteModal">
                <x-slot name="title">Delete Category</x-slot>

                <x-slot name="content">
                    <div class="py-8 text-cool-gray-700">Are you sure? This action is irreversible.</div>
                </x-slot>

                <x-slot name="footer">
                    <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

                    <x-button.primary type="submit" wire:click="resetFilters">Delete</x-button.primary>
                </x-slot>
            </x-modal.confirmation>
        </form>

        <!-- Save Category Modal -->
        <form wire:submit.prevent="save">
            <x-modal.dialog wire:model.defer="showEditModal">
                <x-slot name="title">Edit Category</x-slot>

                <x-slot name="content">
                    <x-input.group for="title" label="Title" :error="$errors->first('editing.title')">
                        <x-input.text id="title" wire:model="editing.title" placeholder="Title" />
                    </x-input.group>

                    <x-input.group for="description" label="Description" :error="$errors->first('editing.description')">
                        <x-input.text id="description" wire:model="editing.description" />
                    </x-input.group>

                    <x-input.group for="introText" label="Introduction" :error="$errors->first('editing.introText')">
                        <x-input.rich-text id="introText" wire:model.defer="editing.introText" />
                    </x-input.group>

                    <x-input.group for="bodyText" label="Body" :error="$errors->first('editing.bodyText')">
                        <x-input.rich-text id="bodyText" wire:model.defer="editing.bodyText" />
                    </x-input.group>

                    <x-input.group for="mainImage" label="Main Image" :error="$errors->first('editing.mainImage')">
                        <x-input.file-upload id="mainImage" wire:model="upload">
                            <span class="overflow-hidden w-96 max-h-72">
                                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700" x-show="isUploading">
                                    <div class="bg-indigo-600 text-xs font-medium text-indigo-100 text-center p-0.5 leading-none rounded-full"
                                        x-bind:style="`width:${progress}%`" x-text="`${progress}%`"></div>
                                </div>
                                @if ($upload)
                                    <img src="{{ $upload->temporaryUrl() }}" alt="...">
                                @else
                                    {{-- <img src="{{ asset('/storage/'.$editing->image) }}" alt="..."> --}}
                                    <div class="flex flex-wrap content-center justify-center">
                                        <div class="w-96 sm:w-96">
                                            @if (file_exists(storage_path('app/public/' . $editing->mainImage)))
                                                <img src="{{ $editing->mainImageUrl() }}" alt="...">
                                            @else
                                                <img class="object-contain h-auto max-w-full align-middle border-none rounded shadow "
                                                    src="https://lflbsign.webfoundry.dev/assets/{{ $editing->mainImage }}"
                                                    alt="..." />
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </span>
                        </x-input.file-upload>
                    </x-input.group>
                    <x-input.group for="featured" label="Featured" :error="$errors->first('editing.featured')">
                        <x-input.select id="featured" wire:model="editing.featured">
                            @foreach (App\Models\LflbCategory::STATUSES as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>
                    @if (count($editing->lflbSubCategories) > 0)
                        <x-input.group for="sub_categories" label="Sub-Categories" :error="$errors->first('editing.sub_categories')">
                            <ol>
                                @foreach ($editing->lflbSubCategories->sortBy('position')->sortBy('title') as $sub_category)
                                    <li class="font-medium text-cool-gray-900">{{ $sub_category->title }} </li>
                                @endforeach
                            </ol>
                        </x-input.group>
                    @endif
                </x-slot>

                <x-slot name="footer">
                    <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                    <x-button.primary type="submit">Save</x-button.primary>
                </x-slot>
            </x-modal.dialog>
        </form>
    </div>

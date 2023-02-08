@php
// $assets = $story->lflbAssets->sortBy('pivot.position');
// dd($assets);
@endphp
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-semibold text-gray-900">Story Editor</h1>

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
        {{-- {{dd($assets)}} --}}
        <!-- Stories Table -->
        <div class="flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="w-8 pr-0">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('pivot_story_id')"
                        :direction="$sorts['pivot_story_id'] ?? null">Story ID</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="6">
                            @unless ($selectAll)
                            <div>
                                <span>You have selected <strong>{{ $assets->count() }}</strong> stories, do
                                    you want to select all <strong>{{ $assets->total() }}</strong>?</span>
                                <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select All
                                </x-button.link>
                            </div>
                            @else
                            <span>You are currently selecting all <strong>{{ $assets->total() }}</strong>
                                stories.</span>
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @endif

                    @forelse ($assets as $asset)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $asset->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $asset->id }}" />
                        </x-table.cell>
                        <x-table.cell class="max-w-2xl py-3">
                            <div class="">
                                <span href="#" class="">
                                    @switch($asset->type)
                                    @case('TEXT')
                                    {!!$asset->cleanText!!}
                                    {{-- {!!strip_tags($asset['cleanText'], ["<p>", "<span>", "<ul>", "<li>", "<em>",
                                                        "<strong>", "<b>", "<i>", "<br>"])!!} --}}

                                                                    @break
                                                                    @case('IMAGE')
                                                                    <img class="object-scale-down"
                                                                        src="{{ $asset->fileUrl() }}" alt="Photo">
                                                                    <img class="object-scale-down"
                                                                        src="https://lflbsign.webfoundry.dev/assets/{{ $asset->link }}"
                                                                        alt="Photo">
                                                                    @break
                                                                    @case('VIDEO')
                                                                    <p class="truncate line-clamp-3 text-cool-gray-600">
                                                                        {{ $asset->link }}
                                                                    </p>
                                                                    @break
                                                                    @default

                                                                    @endswitch
                                        </span>
                            </div>
                        </x-table.cell>

                        <x-table.cell>
                            <x-button.link wire:click="edit({{ $asset->id }})">Edit</x-button.link>
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
                {{ $assets->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Stories Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Item</x-slot>

            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Are you sure? This action is irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit" wire:click="resetFilters">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>

    <!-- Save Item Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">Edit Content</x-slot>
            <x-slot name="content">
                <p>{{$story->title}}</p>
                @foreach ($story->lflbSubCategories as $subCategory)
                <p>{{$subCategory->lflbCategory->title.'-'.$subCategory->title}}</p>
                @endforeach
                <x-input.group for="type" label="Type" :error="$errors->first('editing.type')">
                    {{--
                    <x-input.text wire:model="editing.type" id="type" placeholder="Type" /> --}}
                    <x-input.select wire:model="editing.type" id="type">
                        <option value="" disabled>Select Content Type</option>
                        <option value="TEXT">TEXT</option>
                        <option value="IMAGE">IMAGE</option>
                        <option value="VIDEO">VIDEO</option>
                    </x-input.select>

                </x-input.group>
                <x-input.group for="position" label="Position" :error="$errors->first('editing.position')">
                    <input type="text" wire:model="editing.position" id="position" />
                </x-input.group>

                @switch($editing->type)
                @case('TEXT')
                <x-input.group for="cleanText" label="Text" :error="$errors->first('editing.cleanText')">
                    <x-input.rich-text wire:model="editing.cleanText" id="cleanText" />
                </x-input.group>
                @break
                @case('IMAGE')
                <x-input.group label="Main Image" for="image" :error="$errors->first('editing.link')">
                    <x-input.file-upload wire:model="upload" id="image">
                        <span class="overflow-hidden w-96 max-h-72">
                            @if ($upload)
                            <img src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
                            @else
                            {{-- <img src="{{ asset('/storage/'.$editing->image) }}" alt="Profile Photo"> --}}
                            <div class="flex flex-wrap content-center justify-center">
                                <div class="w-96 sm:w-96">
                                    @if (file_exists(storage_path('app/public/'.$editing->link)))
                                    <img src="{{ $editing->fileUrl() }}" alt="Profile Photo">
                                    @else
                                    <img src="https://lflbsign.webfoundry.dev/assets/{{ $editing->link }}" alt="..."
                                        class="object-contain h-auto max-w-full align-middle border-none rounded shadow " />
                                    @endif
                                </div>
                            </div>
                            @endif
                        </span>
                    </x-input.file-upload>
                </x-input.group>
                <x-input.group for="caption" label="Caption" :error="$errors->first('editing.caption')">
                    <x-input.text wire:model="editing.caption" id="caption" placeholder="Caption" />
                </x-input.group>
                @break
                @default

                @endswitch


                {{-- @foreach ( as )

                @endforeach --}}

                {{-- <x-input.group label="Main Image" for="image" :error="$errors->first('editing.image')">
                    <x-input.file-upload wire:model="upload" id="image">
                        <span class="w-12 h-12 overflow-hidden bg-gray-100 rounded-full">
                            @if ($upload)
                            <img src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
                            @else
                            <img src="{{ $editing->mainImageUrl() }}" alt="Profile Photo">
                            @endif
                        </span>
                    </x-input.file-upload>
                </x-input.group> --}}
                {{-- <input type="text" wire:model="editingApp.name" id="name"
                    :error="$errors->first('editingApp.name')" /> --}}
                {{-- <x-input.group for="app_name" label="App Name" :error="$errors->first('editingApp.name')">
                    <x-input.text wire:model="editingApp.name" id="name" placeholder="App Name" />
                </x-input.group> --}}
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>

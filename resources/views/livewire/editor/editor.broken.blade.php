@php

// dd($assets);
@endphp
<div>
    <h1 class="text-2xl font-semibold text-gray-900">Story Editor</h1>
    <form wire:submit.prevent="save">
        <div class="mb-6 form-group">
            @foreach ($story->lflbAssets->sortBy('pivot.position') as $index => $part)
            <div wire:key="part-field-{{ $part->id }}">
                @switch($part->type)
                @case("TEXT")
                <x-input.group for="cleanText" label="Text"
                    :error="$errors->first('storyAssets.{{ $index }}.cleanText')">
                    <x-input.rich-text wire:model="storyAssets.{{ $index }}.cleanText"
                        id="storyAssets.{{ $index }}.cleanText" />
                    <x-button.link wire:click.prevent="deleteItem({{$part->id}});" class="btn btn-danger btn-sm">Delete
                    </x-button.link>
                    <x-button.link wire:click="edit({{ $part->id }})">Edit</x-button.link>

                </x-input.group>
                @break
                @case("IMAGE")
                <x-input.group for="image" label="Image" :error="$errors->first('storyAssets.{{ $index }}.link')">
                    <x-input.file-upload wire:model="storyAssets.{{ $index }}.link" id="image" />
                    <button wire:click.prevent="deleteItem({{$part->id}})" class="btn btn-danger btn-sm">Delete</button>
                </x-input.group>
                @break
                @case("VIDEO")
                <x-input.group for="video" label="Video" :error="$errors->first('storyAssets.{{ $index }}.link')">
                    <x-input.file-upload wire:model="storyAssets.{{ $index }}.link" id="video" />
                    <button wire:click.prevent="deleteItem({{$part->id}})" class="btn btn-danger btn-sm">Delete</button>
                </x-input.group>
                @break
                @default

                @endswitch

            </div>
            @endforeach

            <div class="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </div>
        </div>
    </form>
    <div class="py-4 space-y-4">
        <!-- Top Bar -->
        <div class="flex justify-between">
            {{-- <div class="flex w-2/4 space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Search Stories..." />

                <x-button.link wire:click="toggleShowFilters">@if ($showFilters) Hide @endif Advanced Search...
                </x-button.link>
            </div> --}}

            <div class="flex items-center space-x-2">

                {{-- <x-dropdown label="Bulk Actions">
                    <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                        <x-icon.download class="text-cool-gray-400" /> <span>Export</span>
                    </x-dropdown.item>

                    <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')"
                        class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400" /> <span>Delete</span>
                    </x-dropdown.item>
                </x-dropdown> --}}

                {{--
                <livewire:categories.import-categories /> --}}

                <x-button.primary wire:click="create">
                    <x-icon.plus /> New
                </x-button.primary>
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
            <x-slot name="title">Edit Item</x-slot>
            <x-slot name="content">
                <p>{{$story->title}}</p>
                @foreach ($story->lflbSubCategories as $subCategory)
                <p>{{$subCategory->lflbCategory->title.'-'.$subCategory->title}}</p>
                @endforeach
                <x-input.group for="type" label="Type" :error="$errors->first('editing.type')">
                    <x-input.text wire:model="editing.type" id="type" placeholder="Type" />
                </x-input.group>

                <x-input.group for="content" label="" :error="$errors->first('editing.cleanText')">
                    <x-input.rich-text wire:model="editing.cleanText" id="content" placeholder="Add text here..." />
                </x-input.group>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>

@php
$storyparts = $story->lflbAssets->sortBy('pivot.position');

// dd($assets);
@endphp
<div>
    <h1 class="text-2xl font-semibold text-gray-900">Story Editor</h1>

    <div class="py-4 space-y-4">
        <!-- Top Bar -->

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
                    <x-table.heading sortable multi-column wire:click="sortBy('pivot_story_part_id')"
                        :direction="$sorts['pivot_story_part_id'] ?? null">StoryPart ID</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('lflb_assets.id')"
                        :direction="$sorts['id'] ?? null">Asset ID</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('lflb_categories.title')"
                        :direction="$sorts['lflb_categories.title'] ?? null">Sub-Category</x-table.heading>
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

                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400" />

                                <p class="truncate text-cool-gray-600">
                                    {{ $asset->id}}
                                </p>
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400" />

                                <p class="truncate text-cool-gray-600">
                                    {{ $asset->story_part_id}}
                                </p>
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400" />

                                <p class="truncate text-cool-gray-600">
                                    {{ $asset->story_id}}
                                </p>
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400" />

                                <p class="truncate text-cool-gray-600">
                                    {{ $asset->sub_category_title}}
                                </p>
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="font-medium text-cool-gray-900">{{ $asset->image }} </span>
                        </x-table.cell>

                        <x-table.cell class="max-w-[150px]">
                            <ol>
                                <li>
                                    <span class="font-medium text-cool-gray-900">{{
                                        $asset->caption;
                                        }} </span>
                                </li>
                            </ol>
                        </x-table.cell>

                        <x-table.cell>
                            {{ $asset->date_for_humans }}
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
            <x-slot name="title">Edit Item</x-slot>
            <x-slot name="content">
                <p>{{$story->title}}</p>
                @foreach ($story->lflbSubCategories as $subCategory)
                <p>{{$subCategory->lflbCategory->title.'-'.$subCategory->title}}</p>
                @endforeach
                @foreach ( $storyAssets->sortBy('pivot.position') as $storyAsset)
                <x-input.group for="type" label="Type" :error="$errors->first('editing.type')">
                    <x-input.text wire:model="editing.type" id="type" placeholder="Type" />
                </x-input.group>

                <x-input.group for="caption" label="Caption" :error="$errors->first('editing.caption')">
                    <x-input.text wire:model="editing.caption" id="caption" placeholder="Caption" />
                </x-input.group>
                @endforeach
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
</div>

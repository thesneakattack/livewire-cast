{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

<div class="flex items-center" x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true, placeholderImage = false"
    x-on:livewire-upload-finish="isUploading = false, placeholderImage = true"
    x-on:livewire-upload-error="isUploading = false, placeholderImage = true"
    x-on:livewire-upload-progress="progress = $event.detail.progress">
    {{ $slot }}

    <div x-data="{ focused: false }">
        <span class="ml-5 rounded-md shadow-sm">
            <input @focus="focused = true" @blur="focused = false" class="sr-only" type="file" {{ $attributes }}>
            <label for="{{ $attributes['id'] }}"
                :class="{ 'outline-none border-blue-300 shadow-outline-blue': focused }"
                class="px-3 py-2 text-sm font-medium leading-4 text-gray-700 transition duration-150 ease-in-out border border-gray-300 rounded-md cursor-pointer hover:text-gray-500 active:bg-gray-50 active:text-gray-800">
                Select File
            </label>
        </span>

    </div>
</div>

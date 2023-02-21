@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modal-content">
        <div class="px-6 py-4">
            <div class="text-lg modal-header">
                {{ $title }}
            </div>

            <div class="mt-4 modal-body max-h-[450px] overflow-y-auto">
                {{ $content }}
            </div>
        </div>

        <div class="px-6 py-4 text-right bg-gray-100 modal-footer">
            {{ $footer }}
        </div>
    </div>
</x-modal>

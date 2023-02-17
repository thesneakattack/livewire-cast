@props([
    'options' => [],
    'selectedItems' => [],
])
<div wire:ignore>
    <select x-data="{
        tomSelectInstance: null,
        value: @entangle($attributes->wire('model')),
        options: {{ collect($options) }},
        items: @entangle($attributes->wire('model')),

        renderTemplate(data, escape) {
            return `<div class='flex items-center'>
                            <span class='mr-3 w-8 h-8 rounded-full bg-gray-100'><img src='https://avatars.dicebear.com/api/initials/${escape(data.title)}.svg' class='w-8 h-8 rounded-full'/></span>
                            <div><span class='block font-medium text-gray-700'>${escape(data.title)}</span>
                            <span class='block text-gray-500'>${escape(data.lflb_category.title)}</span></div>
                        </div>`;
        },
        itemTemplate(data, escape) {
            return `<div>
                            <span class='block font-medium text-gray-700'>${escape(data.title)}</span>
                        </div>`;
        },

        isFocused() { return document.activeElement !== $refs.input },

    }" x-init="tomSelectInstance = new TomSelect($refs.input, {
        valueField: 'id',
        labelField: 'title',
        searchField: 'title',
        options: options,
        items: items,
        @if(!empty($items) && !$attributes->has('multiple'))
        placeholder: undefined,
        @endif
        render: {
            option: renderTemplate,
            item: itemTemplate
        }
    });$watch('items', items => isFocused() && tomSelectInstance.setValue(items));" x-on:change="console.log($event.target.value)" x-ref="input" x-cloak {{ $attributes }}
        placeholder="Pick some links..."></select>
</div>
@push('scripts')
    <script>
        // console.log(data);
    </script>
@endpush

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>

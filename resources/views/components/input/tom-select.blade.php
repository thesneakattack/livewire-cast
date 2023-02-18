@props([
    'options' => [],
    'selectedItems' => [],
    'tomSelectId' => Str::random(5),

])
<div wire:ignore x-data="{
    tomSelectInstance: null,
    value: @entangle($attributes->wire('model')),
    options: {{ collect($options) }},
    items: @entangle($attributes->wire('model')),

    renderTemplate(data, escape) {
        return `<div class='flex items-center'>
                                <span class='w-8 h-8 mr-3 bg-gray-100 rounded-full'><img src='https://avatars.dicebear.com/api/initials/${escape(data.title)}.svg' class='w-8 h-8 rounded-full'/></span>
                                <div><span class='block font-medium text-gray-700'>${escape(data.title)}</span>
                                <span class='block text-gray-500'>${escape(data.lflb_category.title)}</span></div>
                            </div>`;
    },
    itemTemplate(data, escape) {
        return `<div>
                                <span class='block font-medium text-gray-700'>${escape(data.title)}</span>
                            </div>`;
    },

    isFocused() { return document.activeElement !== $refs.tomSelect },

}" x-init="tomSelectInstance = new TomSelect($refs.tomSelect, {
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
});
$watch('items', items => isFocused() && tomSelectInstance.setValue(items));" x-on:change="console.log($event.target.value)">
    <select id="{{ $tomSelectId }}" x-ref="tomSelect" x-cloak {{ $attributes }} placeholder="Pick some links..."></select>
</div>
@push('scripts')
    <script>
        // console.log(data);
    </script>
@endpush

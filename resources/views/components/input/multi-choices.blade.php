@props([
    'options' => [],
])

@once
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" />
    @endpush
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    @endpush
@endonce


<div wire:ignore x-data="{
    value: @entangle('selections'),
    options: {{ json_encode($options) }},
    debounce: null,
}" x-init="this.$nextTick(() => {
    const choices = new Choices(this.$refs.select, {
        removeItems: true,
        removeItemButton: true,
        duplicateItemsAllowed: false,
    })

    const refreshChoices = () => {
        const selection = this.value

        choices.clearStore()

        choices.setChoices(this.options.map(({ value, label }) => ({
            value,
            label,
            selected: selection.includes(value),
        })))
    }

    this.$refs.select.addEventListener('change', () => {
        this.value = choices.getValue(true)
    })

    this.$refs.select.addEventListener('search', async (e) => {
        if (e.detail.value) {
            clearTimeout(this.debounce)
            this.debounce = setTimeout(() => {
                $wire.call('search', e.detail.value)
            }, 300)
        }
    })

    $wire.on('select-options-updated', (options) => {
        this.options = options
    })

    this.$watch('value', () => refreshChoices())
    this.$watch('options', () => refreshChoices())

    refreshChoices()
})">

    <select x-ref="select"></select>

</div>

{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}
@props(['trixId' => Str::random(5)])
<div class="rounded-md shadow-sm" x-data="{
    value: @entangle($attributes->wire('model')),
    isFocused() { return document.activeElement !== this.$refs.trix },
    setValue() { this.$refs.trix.editor.loadHTML(this.value) },
}" x-init="setValue();
$watch('value', () => isFocused() && setValue())"
    x-on:trix-change="value = $event.target.value" {{ $attributes->whereDoesntStartWith('wire:model') }} wire:ignore>
    <input id="{{ $trixId }}" type="hidden">
    <trix-editor
        class="block w-full prose transition duration-150 ease-in-out max-w-none form-textarea sm:text-sm sm:leading-5"
        x-ref="trix" input="{{ $trixId }}">
    </trix-editor>
</div>

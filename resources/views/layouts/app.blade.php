<x-layouts.base>
    <div class="flex h-screen overflow-hidden bg-cool-gray-100" x-data="{ sidebarOpen: false }"
        @keydown.window.escape="sidebarOpen = false">

        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            {{-- <main class="relative z-0 flex-1 pt-2 pb-6 overflow-y-auto focus:outline-none md:py-6" tabindex="0"
                x-data="" x-init="$el.focus()"> --}}
                <main class="relative z-0 flex-1 pt-2 pb-6 overflow-y-auto focus:outline-none md:py-6" tabindex="0"
                    x-data="" x-init="">
                    <div class="max-w-full px-4 mx-auto sm:px-6 md:px-8">
                        {{ $slot }}
                    </div>
                </main>
        </div>

        <x-notification />
    </div>
</x-layouts.base>

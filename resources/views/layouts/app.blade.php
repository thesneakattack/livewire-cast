<x-layouts.base>
    <div class="h-screen flex overflow-hidden bg-cool-gray-100" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <main class="flex-1 relative z-0 overflow-y-auto pt-2 pb-6 focus:outline-none md:py-6" tabindex="0" x-data="" x-init="$el.focus()">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <x-notification />
    </div>
</x-layouts.base>

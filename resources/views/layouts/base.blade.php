<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Paaji+2&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://rsms.me/inter/inter.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css'])
    <!-- Alpine -->
    <!-- <blade ___scripts_0___/> -->

    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>


    <!-- Tailwind UI -->

    {{--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css"> --}}
    <!-- Styles -->
    @livewireStyles
    @stack('styles')
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css" rel="stylesheet">
    <link type="text/css" href="https://unpkg.com/trix@1.2.3/dist/trix.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">

</head>

<body class="font-sans antialiased bg-gray-200">
    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-full px-4 py-6 mx-auto sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    {{ $slot }}

    @livewireScripts
    @vite(['resources/js/app.js'])
    <script src="https://unpkg.com/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <script src="https://unpkg.com/trix@1.2.3/dist/trix.js"></script>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
</body>

</html>

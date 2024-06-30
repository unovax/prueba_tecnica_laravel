<!DOCTYPE html>
<html class="w-full h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="flex w-full h-full overflow-hidden">
        @livewire('sidebar-component')
        <main class="flex-1 overflow-hidden">
            <div class="shadow bg-topbar h-[50px] flex items-center justify-between px-2">
                <h1 class="text-secondary">{{ $title }}</h1>
            </div>
            {{ $slot }}
        </main>
        @livewire('toast-component')
        @stack('modals')

        @livewireScripts
    </body>
</html>

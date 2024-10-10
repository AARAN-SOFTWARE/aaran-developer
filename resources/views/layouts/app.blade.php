<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
<x.jet-banner/>

<div x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen=false"
     class="min-h-screen bg-white print:bg-white">
    <div class="flex-1">

        <x-menu.top-menu>{{$header}}</x-menu.top-menu>
        <x-menu.side-menu/>

        <!-- Page Content -->
        <main {{$attributes}} class=" @if (\Route::current()->getName() == 'dashboard') bg-[#F8F8FF] @else bg-white @endif  print:bg-white sm:p-5 p-2 ">
            {{ $slot }}
        </main>

    </div>
</div>
<x-alerts.notification/>

@stack('modals')

@livewireScripts

<script>
    function copyToClipboard(id) {
        navigator.clipboard.writeText(id);
    }
</script>

@stack('custom-scripts')

@if (\Route::current()->getName() == 'dashboard')
    <x-web.dashboard.copyright />
@endif
</body>
</html>

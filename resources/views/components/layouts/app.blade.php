<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kantin Cisat' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/livewire@2.x.x/dist/livewire.js" defer></script>
    @livewireScripts
    <x-livewire-alert::scripts />
</head>
<body class="bg-slate-200 dark:bg-slate-700">
    @livewire('partials.navbar')

    <main>
        {{ $slot }}
    </main>

    @livewire('partials.footer')


        
</body>
</html>

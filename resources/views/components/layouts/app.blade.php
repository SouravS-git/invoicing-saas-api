<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex flex-col min-h-screen">

        <nav class="flex-none">
            <x-navigation />
        </nav>

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="flex-none">
            <x-footer/>
        </footer>

    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Daily~Track') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='grad' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%2316a34a;stop-opacity:1' /%3E%3Cstop offset='100%25' style='stop-color:%23eab308;stop-opacity:1' /%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='100' height='100' rx='20' fill='url(%23grad)'/%3E%3Ctext x='50' y='70' font-family='Arial,sans-serif' font-size='60' font-weight='bold' fill='white' text-anchor='middle'%3ED%3C/text%3E%3C/svg%3E">
        <link rel="apple-touch-icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cdefs%3E%3ClinearGradient id='grad' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%2316a34a;stop-opacity:1' /%3E%3Cstop offset='100%25' style='stop-color:%23eab308;stop-opacity:1' /%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='100' height='100' rx='20' fill='url(%23grad)'/%3E%3Ctext x='50' y='70' font-family='Arial,sans-serif' font-size='60' font-weight='bold' fill='white' text-anchor='middle'%3ED%3C/text%3E%3C/svg%3E">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-nss-green-50 via-white to-nss-yellow-50">
            <div class="mb-6">
                <a href="/">
                    <x-application-logo class="w-auto h-16" />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white/80 backdrop-blur-sm shadow-2xl overflow-hidden rounded-3xl border border-nss-green-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Daily~Track - NSS Activity Tracking System for efficient task management">

        <title>{{ config('app.name', 'Daily~Track') }}</title>

        <!-- Performance: DNS Prefetch & Preconnect -->
        <link rel="dns-prefetch" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts with preload hints -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-gray-50 via-white to-nss-green-50 relative overflow-x-hidden">
        <!-- Decorative Bubbles -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <!-- Yellow Bubble -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-nss-yellow-300/20 to-nss-yellow-500/10 rounded-full blur-3xl animate-pulse"></div>

            <!-- Green Bubble -->
            <div class="absolute top-1/3 -left-32 w-80 h-80 bg-gradient-to-br from-nss-green-300/20 to-nss-green-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

            <!-- Red/Orange Bubble -->
            <div class="absolute bottom-20 right-1/4 w-64 h-64 bg-gradient-to-br from-red-300/15 to-orange-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

            <!-- Small Green Bubble -->
            <div class="absolute top-2/3 right-1/3 w-48 h-48 bg-gradient-to-br from-nss-green-200/20 to-nss-green-400/10 rounded-full blur-2xl animate-pulse" style="animation-delay: 0.5s;"></div>

            <!-- Small Yellow Bubble -->
            <div class="absolute bottom-1/4 left-1/4 w-56 h-56 bg-gradient-to-br from-nss-yellow-200/20 to-nss-yellow-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1.5s;"></div>
        </div>

        <div class="min-h-screen relative z-10">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-sm shadow-sm border-b border-nss-green-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

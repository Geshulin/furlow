<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Furlow') }}</title>

        <!-- Fonts -->

        <!-- Scripts -->
        @include('layouts.partials.head-assets')

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @include('layouts.partials.head-assets')
    </head>
    <body class="font-sans text-furlow-body antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-furlow-bg px-4">
            <a href="/" class="mb-6 flex items-center gap-2">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo Furlow" class="h-9 w-9">
                <span class="font-display text-3xl font-bold text-furlow-ink">Furlow</span>
            </a>
            <div class="w-full max-w-md rounded-2xl border border-furlow-ink/15 bg-white px-6 py-8">

                <a href="/" class="mb-4 inline-block text-sm font-semibold text-furlow-ink">← Kembali ke beranda</a>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>

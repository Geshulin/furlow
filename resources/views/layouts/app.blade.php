<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Furlow') }}</title>
    @include('layouts.partials.head-assets')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-furlow-bg font-sans text-furlow-body antialiased">
    <div class="min-h-screen md:flex">
        {{-- Sidebar: hanya desktop --}}
        <aside class="hidden border-r border-furlow-ink/15 bg-white p-5 md:sticky md:top-0 md:block md:h-screen md:w-60 md:shrink-0">
            @include('layouts.navigation')
        </aside>

        {{-- Konten --}}
        <main class="w-full max-w-5xl flex-1 px-5 pb-28 pt-8 md:px-10 md:pb-10">
            @isset($header)
                <div class="mb-6">{{ $header }}</div>
            @endisset
            {{ $slot }}
        </main>
    </div>

    {{-- Tab bar bawah: hanya mobile --}}
    @php
        $isAdminTab = Auth::user()->role === 'admin';
        $tabs = $isAdminTab
            ? [['Beranda', 'dashboard'], ['Booking', 'booking.admin.index'], ['Layanan', 'layanan.index']]
            : [['Beranda', 'dashboard'], ['Hewan', 'hewan.index'], ['Booking', 'booking.index']];
    @endphp
    <nav class="fixed inset-x-0 bottom-0 z-30 flex justify-around border-t border-furlow-ink/15 bg-white py-3 md:hidden">
        @foreach ($tabs as [$label, $route])
            <a href="{{ route($route) }}"
               class="text-xs font-medium {{ request()->routeIs($route) ? 'font-bold text-furlow-ink' : '' }}">
                {{ $label }}
            </a>
        @endforeach
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-xs font-medium">Keluar</button>
        </form>
    </nav>
</body>
</html>
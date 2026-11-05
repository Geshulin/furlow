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
        <main class="w-full max-w-7xl flex-1 px-5 pb-28 pt-8 md:px-10 md:pb-24">
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
            ? [['Beranda', 'dashboard', 'home'], ['Booking', 'booking.admin.index', 'booking'], ['Layanan', 'layanan.index', 'layanan'], ['Profil', 'profile.edit', 'profil']]
            : [['Beranda', 'dashboard', 'home'], ['Hewan', 'hewan.index', 'hewan'], ['Booking', 'booking.index', 'booking'], ['Profil', 'profile.edit', 'profil']];
    @endphp
    <nav class="fixed inset-x-0 bottom-0 z-30 flex justify-around border-t border-furlow-ink/15 bg-white py-3 md:hidden">
        @foreach ($tabs as [$label, $route, $icon])
            <a href="{{ route($route) }}"
               class="flex flex-col items-center gap-1 text-xs font-medium {{ request()->routeIs($route) ? 'font-bold text-furlow-ink' : '' }}">
                <x-icon :name="$icon" />
                {{ $label }}
            </a>
        @endforeach

        <x-konfirmasi :action="route('logout')" judul="Keluar dari Furlow?"
                      pesan="Kamu perlu login lagi untuk masuk." tombol="Ya, keluar" :bahaya="false">
            <x-slot name="trigger">
                <button type="button" class="flex flex-col items-center gap-1 text-xs font-medium">
                    <x-icon name="keluar" />
                    Keluar
                </button>
            </x-slot>
        </x-konfirmasi>
    </nav>

    {{-- WhatsApp CS --}}
    @unless (auth()->user()?->role === 'admin')
    <a href="https://wa.me/{{ config('furlow.wa') }}?text={{ urlencode('Halo Furlow, saya mau tanya soal layanan.') }}"
       target="_blank" rel="noopener"
       class="btn-hover fixed bottom-24 right-5 z-40 rounded-full bg-[#25D366] px-5 py-3 text-sm font-semibold text-white shadow-lg md:bottom-6">
        Chat WhatsApp
    </a>
    @endunless

    {{-- Loader tapak: muncul saat form dikirim atau pindah halaman --}}
    <div x-data="{ loading: false }"
         @submit.window="if (!$event.defaultPrevented) loading = true"
         @beforeunload.window="setTimeout(() => loading = true, 200)"
         @pageshow.window="loading = false"
         x-show="loading" x-cloak
         class="fixed inset-0 z-[60] flex items-center justify-center bg-furlow-bg/80">
        <x-paw-loader />
    </div>
</body>
</html>
@php
    $isAdmin = Auth::user()->role === 'admin';
    $menu = $isAdmin
        ? [['Beranda', 'dashboard', 'home'], ['Booking', 'booking.admin.index', 'booking'], ['Layanan', 'layanan.index', 'layanan']]
        : [['Beranda', 'dashboard', 'home'], ['Hewan', 'hewan.index', 'hewan'], ['Booking', 'booking.index', 'booking']];
@endphp

<div class="flex h-full flex-col">
    <a href="{{ route('dashboard') }}" class="mb-2 flex items-center gap-2">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo Furlow" class="h-7 w-7">
        <span class="font-display text-xl font-bold text-furlow-ink">Furlow</span>
    </a>
    <span class="mb-6 w-fit rounded-full bg-furlow-blob px-3 py-1 text-xs font-semibold text-furlow-accent-ink">
        {{ $isAdmin ? 'Admin' : 'Pemilik' }}
    </span>

    <nav class="space-y-1">
        @foreach ($menu as [$label, $route, $icon])
            <a href="{{ route($route) }}"
               class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition
                      {{ menu_aktif($route) ? 'bg-furlow-blob text-furlow-accent-ink font-semibold' : 'hover:bg-furlow-bg' }}">
                <x-icon :name="$icon" />
                {{ $label }}
            </a>
        @endforeach
    </nav>

    <div class="mt-auto space-y-1 pt-6">
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition
                  {{ request()->routeIs('profile.*') ? 'bg-furlow-blob text-furlow-accent-ink font-semibold' : 'hover:bg-furlow-bg' }}">
            <x-icon name="profil" />
            Profil
        </a>

        <x-konfirmasi class="block" :action="route('logout')" judul="Keluar dari Furlow?"
                      pesan="Kamu perlu login lagi untuk masuk." tombol="Ya, keluar" :bahaya="false">
            <x-slot name="trigger">
                <button type="button"
                        class="flex w-full items-center gap-3 rounded-xl px-4 py-2.5 text-left text-sm font-medium transition hover:bg-furlow-bg">
                    <x-icon name="keluar" />
                    Keluar
                </button>
            </x-slot>
        </x-konfirmasi>
    </div>
</div>
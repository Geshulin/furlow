<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display text-2xl font-semibold text-furlow-ink">Halo, {{ Auth::user()->name }}</h1>
    </x-slot>

    <h2 class="mb-3 font-display text-xl font-semibold text-furlow-ink">Booking aktif</h2>
    <div class="mb-8 grid gap-4 md:grid-cols-2">
        @forelse ($bookingAktif as $b)
            <div class="rounded-2xl border border-furlow-ink/15 bg-white p-5">
                <div class="flex items-center justify-between">
                    <p class="font-display text-lg font-semibold text-furlow-ink">{{ $b->hewan->nama }}</p>
                    <x-status-badge :status="$b->status" />
                </div>
                <p class="mt-1 text-sm">{{ $b->layanan->nama_layanan }} · <x-rentang-tanggal :booking="$b" /></p>
            </div>
        @empty
            <p>Tidak ada booking aktif.</p>
        @endforelse
    </div>

    <h2 class="mb-3 font-display text-xl font-semibold text-furlow-ink">Hewan saya</h2>
    <div class="grid gap-4 md:grid-cols-2">
        @forelse ($hewanSaya as $h)
            <x-hewan-card :hewan="$h" :aksi="false" />
        @empty
            <p>Belum ada hewan.</p>
        @endforelse
    </div>
</x-app-layout>
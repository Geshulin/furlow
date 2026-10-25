<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display text-2xl font-semibold text-furlow-ink">Booking hari ini</h1>
    </x-slot>

    <div class="mb-6 grid grid-cols-2 gap-4">
        <div class="rounded-2xl bg-furlow-ink p-5 text-white">
            <p class="text-sm opacity-70">Menunggu konfirmasi</p>
            <p class="font-display text-3xl font-semibold">{{ $menunggu }}</p>
        </div>
        <div class="rounded-2xl bg-white p-5 border border-furlow-ink/15">
            <p class="text-sm">Sedang diproses</p>
            <p class="font-display text-3xl font-semibold text-furlow-ink">{{ $diproses }}</p>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        @forelse ($hariIni as $b)
            <a href="{{ route('booking.admin.index') }}" class="rounded-2xl border border-furlow-ink/15 bg-white p-5">
                <div class="flex items-center justify-between">
                    <p class="font-display text-lg font-semibold text-furlow-ink">{{ $b->hewan->nama }}</p>
                    <x-status-badge :status="$b->status" />
                </div>
                <p class="mt-1 text-sm">{{ $b->layanan->nama_layanan }}</p>
            </a>
        @empty
            <p>Tidak ada booking untuk hari ini.</p>
        @endforelse
    </div>
</x-app-layout>

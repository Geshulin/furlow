<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="font-display text-2xl font-semibold text-furlow-ink">{{ $hewan->nama }}</h1>
            <a href="{{ route('hewan.edit', $hewan) }}"
               class="rounded-full border border-furlow-ink/20 px-5 py-2.5 text-sm font-semibold text-furlow-ink">Edit data hewan</a>
        </div>
    </x-slot>

    <p class="text-sm">{{ $hewan->jenis }}@if ($hewan->ras) · {{ $hewan->ras }}@endif</p>
    @if ($hewan->catatan_kesehatan)
        <p class="mt-2 text-sm"><span class="font-semibold text-furlow-ink">Catatan kesehatan:</span> {{ $hewan->catatan_kesehatan }}</p>
    @endif

    <h2 class="mb-3 mt-8 font-display text-xl font-semibold text-furlow-ink">Riwayat layanan (5 terbaru)</h2>

    {{-- Alpine.js: klik foto untuk memperbesar --}}
    <div x-data="{ foto: null }" class="space-y-4">
        @forelse ($riwayat as $r)
            <div class="rounded-2xl border border-furlow-ink/15 bg-white p-5">
                <div class="flex items-center justify-between">
                    <p class="font-semibold text-furlow-ink">
                        {{ $r->layanan->nama_layanan }}
                        @if ($r->layanan->trashed()) <span class="text-xs font-normal">(layanan tidak aktif)</span> @endif
                    </p>
                    <x-status-badge :status="$r->status" />
                </div>
                <p class="mt-1 text-sm">{{ $r->tanggal_masuk->translatedFormat('d F Y') }}</p>

                @if ($r->foto_before || $r->foto_after)
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        @foreach (['foto_before' => 'Sebelum', 'foto_after' => 'Sesudah'] as $kolom => $label)
                            @if ($r->$kolom)
                                <button type="button" @click="foto = '{{ asset('storage/' . $r->$kolom) }}'" class="text-left">
                                    <img src="{{ asset('storage/' . $r->$kolom) }}" alt="Foto {{ strtolower($label) }}"
                                         class="h-40 w-full rounded-xl object-cover">
                                    <span class="mt-1 block text-xs font-semibold">{{ $label }}</span>
                                </button>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <p>Belum ada riwayat layanan.</p>
        @endforelse

        {{-- Tampilan foto besar --}}
        <div x-show="foto" x-cloak @click="foto = null" @keydown.escape.window="foto = null"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4">
            <img :src="foto" alt="Foto diperbesar" class="max-h-[85vh] rounded-2xl">
        </div>
    </div>

    <a href="{{ route('booking.index') }}" class="mt-6 inline-block text-sm font-semibold text-furlow-ink underline">Lihat semua booking →</a>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="font-display text-2xl font-semibold text-furlow-ink">Booking saya</h1>
            <a href="{{ route('booking.create') }}"
               class="rounded-full bg-furlow-accent px-5 py-2.5 text-sm font-semibold text-furlow-accent-ink">+ Ajukan booking</a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 rounded-xl bg-green-100 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="mb-4 rounded-xl bg-red-100 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>
    @endif

    <div class="grid gap-4 md:grid-cols-2">
        @forelse ($bookingSaya as $b)
            <div class="rounded-2xl border border-furlow-ink/15 bg-white p-5">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="font-display text-lg font-semibold text-furlow-ink">
                            {{ $b->hewan->nama }}
                            @if ($b->hewan->trashed()) <span class="text-xs font-normal">(sudah dihapus)</span> @endif
                        </p>
                        <p class="text-sm">
                            {{ $b->layanan->nama_layanan }}
                            @if ($b->layanan->trashed()) <span class="text-xs">(layanan tidak aktif)</span> @endif
                        </p>
                    </div>
                    <x-status-badge :status="$b->status" />
                </div>

                <p class="mt-3 text-sm">
                    {{ $b->tanggal_masuk->translatedFormat('d F Y') }}
                    @if ($b->tanggal_keluar) – {{ $b->tanggal_keluar->translatedFormat('d F Y') }} @endif
                </p>

                @if ($b->status === 'ditolak' && $b->alasan_penolakan)
                    <p class="mt-3 rounded-xl bg-red-50 px-3 py-2 text-sm text-red-800">Alasan: {{ $b->alasan_penolakan }}</p>
                @endif
                @if ($b->status === 'diproses' && $b->estimasi_selesai)
                    <p class="mt-3 text-sm">Estimasi selesai: {{ $b->estimasi_selesai->translatedFormat('d F Y, H:i') }}</p>
                @endif

                @if ($b->status === 'menunggu')
                    <form method="POST" action="{{ route('booking.batal', $b) }}" class="mt-4"
                          onsubmit="return confirm('Batalkan booking ini?')">
                        @csrf
                        @method('PATCH')
                        <x-secondary-button type="submit">Batalkan</x-secondary-button>
                    </form>
                @endif
            </div>
        @empty
            <p>Belum ada booking.</p>
        @endforelse
    </div>
</x-app-layout>
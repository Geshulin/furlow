<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h1 class="font-display text-2xl text-furlow-ink">{{ $hewan->nama }}</h1>
            <div class="flex gap-2">
                <a href="{{ route('hewan.edit', $hewan) }}"
                   class="rounded-md bg-furlow-ink px-4 py-2 text-sm text-white">Edit</a>
                <a href="{{ route('hewan.index') }}"
                   class="rounded-md border px-4 py-2 text-sm">Kembali</a>
            </div>
        </div>
    </x-slot>

    {{-- Data hewan --}}
    <div class="mb-6 flex flex-col gap-5 rounded-2xl bg-white p-6 sm:flex-row">
        @if ($hewan->foto)
            <img src="{{ asset('storage/' . $hewan->foto) }}" alt="Foto {{ $hewan->nama }}"
                 class="h-40 w-40 rounded-2xl object-cover">
        @endif
        <dl class="space-y-2 text-sm">
            <div><dt class="font-medium">Jenis</dt><dd>{{ $hewan->jenis }}</dd></div>
            <div><dt class="font-medium">Ras</dt><dd>{{ $hewan->ras ?? '-' }}</dd></div>
            <div><dt class="font-medium">Catatan kesehatan / alergi</dt>
                <dd>{{ $hewan->catatan_kesehatan ?? '-' }}</dd></div>
        </dl>
    </div>

    {{-- Riwayat layanan --}}
    <h2 class="mb-3 font-display text-xl text-furlow-ink">Riwayat Layanan</h2>
    <div class="space-y-3">
        @forelse ($bookings as $b)
            <div class="rounded-2xl bg-white p-5">
                <div class="flex items-center justify-between">
                    <p class="font-medium">
                        {{ $b->layanan->nama_layanan }}
                        @if ($b->layanan->trashed())
                            <span class="text-xs text-gray-500">(layanan dihapus)</span>
                        @endif
                    </p>
                    <x-status-badge :status="$b->status" />
                </div>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $b->tanggal_masuk }} s/d {{ $b->tanggal_keluar ?? '-' }}
                </p>

                @if ($b->status === 'ditolak' && $b->alasan_penolakan)
                    <p class="mt-2 text-sm text-red-700">Alasan: {{ $b->alasan_penolakan }}</p>
                @endif

                @if ($b->foto_before || $b->foto_after)
                    <div class="mt-3 grid grid-cols-2 gap-3">
                        @if ($b->foto_before)
                            <div>
                                <p class="mb-1 text-xs">Sebelum</p>
                                <img src="{{ asset('storage/' . $b->foto_before) }}" alt="Foto sebelum"
                                     class="aspect-square w-full rounded-xl object-cover">
                            </div>
                        @endif
                        @if ($b->foto_after)
                            <div>
                                <p class="mb-1 text-xs">Sesudah</p>
                                <img src="{{ asset('storage/' . $b->foto_after) }}" alt="Foto sesudah"
                                     class="aspect-square w-full rounded-xl object-cover">
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <p class="rounded-2xl bg-white p-5 text-sm">Belum ada riwayat layanan untuk hewan ini.</p>
        @endforelse
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="font-display text-2xl text-furlow-ink">Kelola Layanan</h1>
            <a href="{{ route('layanan.create') }}"
               class="rounded-md bg-furlow-ink px-4 py-2 text-sm text-white">+ Tambah</a>
        </div>
    </x-slot>

    <div class="overflow-x-auto rounded-2xl bg-white">
        <table class="w-full text-left text-sm">
            <thead class="border-b text-furlow-ink">
                <tr>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Harga</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($layanan as $l)
                    <tr class="border-b last:border-0">
                        <td class="p-4">
                            {{ $l->nama_layanan }}
                            @if ($l->butuh_tanggal_keluar)
                                <span class="ml-2 rounded-full bg-furlow-blob px-2 py-0.5 text-xs font-semibold text-furlow-accent-ink">Penitipan</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap p-4">{{ rupiah($l->harga) }}</td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('layanan.edit', $l) }}"
                                   class="rounded-md border border-furlow-ink px-3 py-1.5 text-xs text-furlow-ink">Edit</a>

                                <x-konfirmasi :action="route('layanan.destroy', $l)" method="DELETE"
                                              judul="Hapus layanan?"
                                              pesan="Layanan hilang dari pilihan booking, tapi riwayat booking lama tetap tersimpan."
                                              tombol="Ya, hapus">
                                    <x-slot name="trigger">
                                        <button type="button"
                                                class="rounded-md border border-red-700 px-3 py-1.5 text-xs text-red-700">Hapus</button>
                                    </x-slot>
                                </x-konfirmasi>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-4 text-center">Belum ada layanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
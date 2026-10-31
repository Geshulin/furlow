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
                        <td class="p-4">{{ $l->nama_layanan }}
                            @if ($l->butuh_tanggal_keluar)
                                <span class="ml-2 rounded-full bg-furlow-blob px-2 py-0.5 text-xs font-semibold text-furlow-accent-ink">Penitipan</span>
                            @endif
                        </td>
                        <td class="p-4">{{ rupiah($l->harga) }}</td>
                        <td class="flex gap-3 p-4">
                            <a href="{{ route('layanan.edit', $l) }}" class="underline">Edit</a>
                            <form method="POST" action="{{ route('layanan.destroy', $l) }}"
                                  onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-700 underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-4 text-center">Belum ada layanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
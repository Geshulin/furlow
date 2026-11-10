<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display text-2xl text-furlow-ink">Semua Booking</h1>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 rounded-xl bg-green-100 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="mb-4 rounded-xl bg-red-100 px-4 py-3 text-sm text-red-800">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="overflow-x-auto rounded-2xl bg-white">
        <table class="w-full text-left text-sm">
            <thead class="border-b text-furlow-ink">
                <tr>
                    <th class="p-4">Pemilik</th>
                    <th class="p-4">Hewan</th>
                    <th class="p-4">Layanan</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Estimasi</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semuaBooking as $b)
                    <tr class="border-b align-top last:border-0">
                        <td class="p-4">
                        {{ $b->hewan->user->name }}
                        @if ($b->hewan->user->alamat)
                            <p class="mt-1 max-w-[14rem] break-words text-xs text-gray-500">{{ $b->hewan->user->alamat }}</p>
                        @endif
                    </td>
                        <td class="p-4">
                            {{ $b->hewan->nama }}
                            @if ($b->hewan->trashed()) <span class="text-xs text-gray-500">(dihapus)</span> @endif
                        </td>
                        <td class="p-4">
                            {{ $b->layanan->nama_layanan }}
                            @if ($b->layanan->trashed()) <span class="text-xs text-gray-500">(dihapus)</span> @endif
                        </td>
                        <td class="min-w-44 p-4"><x-rentang-tanggal :booking="$b" /></td>
                        <td class="whitespace-nowrap p-4">{{ rupiah($b->estimasiTotal()) }}</td>
                        <td class="p-4">
                            <x-status-badge :status="$b->status" />
                            @if ($b->status === 'ditolak' && $b->alasan_penolakan)
                                <p class="mt-1 max-w-xs break-words text-xs text-red-700 [overflow-wrap:anywhere]">{{ $b->alasan_penolakan }}</p>
                            @endif
                        </td>

                        <td class="p-4">
                            @if ($b->status === 'menunggu')
                                <div x-data="{ tolak: false }" class="space-y-2">
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('booking.updateStatus', $b) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="diterima">
                                            <button type="submit"
                                                    class="rounded-md bg-furlow-ink px-3 py-1.5 text-xs text-white">Terima</button>
                                        </form>
                                        <button type="button" @click="tolak = !tolak"
                                                class="rounded-md border border-red-700 px-3 py-1.5 text-xs text-red-700">Tolak</button>
                                    </div>

                                    <form x-show="tolak" x-cloak method="POST"
                                          action="{{ route('booking.updateStatus', $b) }}" class="space-y-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <textarea name="alasan_penolakan" rows="2" required maxlength="200"
                                                  placeholder="Alasan penolakan (misal: kandang penuh), maks. 200 karakter"
                                                  class="block w-full min-w-56 rounded-md border-gray-300 text-xs shadow-sm"></textarea>
                                        <button type="submit"
                                                class="rounded-md bg-red-700 px-3 py-1.5 text-xs text-white">Kirim penolakan</button>
                                    </form>
                                </div>

                            @elseif ($b->status === 'diterima')
                                @if ($b->tanggal_masuk->lte(today()))
                                    <form method="POST" action="{{ route('booking.updateStatus', $b) }}" class="space-y-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="diproses">
                                        <label class="block text-xs">Estimasi selesai (opsional)</label>
                                        <input type="datetime-local" name="estimasi_selesai"
                                               min="{{ $b->tanggal_masuk->format('Y-m-d\TH:i') }}"
                                               class="block rounded-md border-gray-300 text-xs shadow-sm">
                                        <button type="submit"
                                                class="rounded-md bg-furlow-ink px-3 py-1.5 text-xs text-white">Proses</button>
                                    </form>
                                @else
                                    <p class="text-xs">Bisa diproses mulai {{ tanggal($b->tanggal_masuk) }}.</p>
                                @endif

                            @elseif ($b->status === 'diproses')
                                <div x-data="{ foto: false }" class="min-w-56 space-y-3">
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="foto = !foto"
                                                class="rounded-md border border-furlow-ink px-3 py-1.5 text-xs text-furlow-ink"
                                                x-text="foto ? 'Tutup' : 'Foto before/after'"></button>

                                        <x-konfirmasi :action="route('booking.updateStatus', $b)" method="PATCH"
                                                judul="Tandai selesai?"
                                                pesan="Setelah ini status terkunci dan foto tidak bisa diubah."
                                                tombol="Ya, selesai" :bahaya="false">
                                        <x-slot name="trigger">
                                            <button type="button" class="rounded-md bg-furlow-ink px-3 py-1.5 text-xs text-white">Selesai</button>
                                        </x-slot>
                                        <input type="hidden" name="status" value="selesai">
                                    </x-konfirmasi>
                                    </div>

                                    <form x-show="foto" x-cloak method="POST"
                                          action="{{ route('booking.uploadFoto', $b) }}" enctype="multipart/form-data"
                                          class="space-y-3 rounded-xl bg-furlow-bg p-4">
                                        @csrf
                                        <div>
                                            <label class="text-sm font-semibold text-furlow-ink">Foto sebelum</label>
                                            @if ($b->foto_before)
                                                <img src="{{ asset('storage/' . $b->foto_before) }}" alt="Foto sebelum"
                                                     class="mt-1 h-16 w-16 rounded-lg object-cover">
                                            @endif
                                            <input type="file" name="foto_before" accept="image/*" class="mt-1 block w-full text-sm">
                                        </div>
                                        <div>
                                            <label class="text-sm font-semibold text-furlow-ink">Foto sesudah</label>
                                            @if ($b->foto_after)
                                                <img src="{{ asset('storage/' . $b->foto_after) }}" alt="Foto sesudah"
                                                     class="mt-1 h-16 w-16 rounded-lg object-cover">
                                            @endif
                                            <input type="file" name="foto_after" accept="image/*" class="mt-1 block w-full text-sm">
                                        </div>
                                        <x-primary-button>Simpan foto</x-primary-button>
                                    </form>
                                </div>

                            @else
                                <span class="text-xs text-gray-500">Final</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-4 text-center">Belum ada booking.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
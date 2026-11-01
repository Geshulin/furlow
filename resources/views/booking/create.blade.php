<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display text-2xl font-semibold text-furlow-ink">Ajukan booking</h1>
    </x-slot>

    @if ($hewan->isEmpty())
        <div class="rounded-2xl border border-furlow-ink/15 bg-white p-6">
            <p>Kamu belum punya hewan. Tambahkan hewan dulu sebelum booking.</p>
            <a href="{{ route('hewan.create') }}"
               class="mt-4 inline-block rounded-full bg-furlow-accent px-5 py-2.5 text-sm font-semibold text-furlow-accent-ink">+ Tambah hewan</a>
        </div>
    @else
        <form method="POST" action="{{ route('booking.store') }}"
              x-data="{
                  penitipan: @js($layanan->pluck('butuh_tanggal_keluar', 'id')),
                  pilih: '{{ old('layanan_id') }}'
              }"
              class="max-w-lg space-y-5 rounded-2xl border border-furlow-ink/15 bg-white p-6">
            @csrf

            <div>
                <x-input-label for="hewan_id" value="Hewan" />
                <select id="hewan_id" name="hewan_id"
                        class="mt-1 w-full rounded-xl border-furlow-ink/20 focus:border-furlow-teal focus:ring-furlow-teal">
                    <option value="">— Pilih hewan —</option>
                    @foreach ($hewan as $h)
                        <option value="{{ $h->id }}" @selected(old('hewan_id') == $h->id)>{{ $h->nama }} ({{ $h->jenis }})</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('hewan_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="layanan_id" value="Layanan" />
                <select id="layanan_id" name="layanan_id" x-model="pilih"
                        class="mt-1 w-full rounded-xl border-furlow-ink/20 focus:border-furlow-teal focus:ring-furlow-teal">
                    <option value="">— Pilih layanan —</option>
                    @foreach ($layanan as $l)
                        <option value="{{ $l->id }}">{{ $l->nama_layanan }} — mulai {{ rupiah($l->harga) }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('layanan_id')" class="mt-2" />
                <p class="mt-1 text-xs">Harga akhir dikonfirmasi petshop sesuai ukuran dan kondisi bulu hewan.</p>
            </div>

            <div>
                <x-input-label for="tanggal_masuk" value="Tanggal masuk" />
                <x-text-input id="tanggal_masuk" name="tanggal_masuk" type="date"
                              min="{{ today()->toDateString() }}" :value="old('tanggal_masuk')" class="mt-1" />
                <x-input-error :messages="$errors->get('tanggal_masuk')" class="mt-2" />
            </div>

            <div>
                <label for="tanggal_keluar" class="block text-sm font-medium text-gray-700">
                    Tanggal keluar
                    <span x-show="penitipan[pilih]" x-cloak class="text-red-600">(wajib untuk penitipan)</span>
                    <span x-show="!penitipan[pilih]" class="text-xs font-normal">(opsional)</span>
                </label>
                <x-text-input id="tanggal_keluar" name="tanggal_keluar" type="date"
                              min="{{ today()->toDateString() }}" :value="old('tanggal_keluar')" class="mt-1" />
                <x-input-error :messages="$errors->get('tanggal_keluar')" class="mt-2" />
            </div>

            <div class="flex items-center gap-3">
                <x-primary-button>Kirim booking</x-primary-button>
                <a href="{{ route('booking.index') }}" class="text-sm underline">Batal</a>
            </div>
        </form>
    @endif
</x-app-layout>
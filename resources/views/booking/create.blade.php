<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display text-2xl text-furlow-ink">Ajukan Booking</h1>
    </x-slot>

    <form method="POST" action="{{ route('booking.store') }}"
          class="max-w-xl space-y-5 rounded-2xl bg-white p-6">
        @csrf

        <div>
            <x-input-label for="hewan_id" value="Hewan" />
            <select id="hewan_id" name="hewan_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Pilih hewan --</option>
                @foreach ($hewan as $h)
                    <option value="{{ $h->id }}" @selected(old('hewan_id') == $h->id)>
                        {{ $h->nama }} ({{ $h->jenis }})
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('hewan_id')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="layanan_id" value="Layanan" />
            <select id="layanan_id" name="layanan_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Pilih layanan --</option>
                @foreach ($layanan as $l)
                    <option value="{{ $l->id }}" @selected(old('layanan_id') == $l->id)>
                        {{ $l->nama_layanan }} - {{ rupiah($l->harga) }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('layanan_id')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="tanggal_masuk" value="Tanggal masuk" />
            <x-text-input id="tanggal_masuk" type="date" name="tanggal_masuk"
                          class="mt-1 block w-full" :value="old('tanggal_masuk')" required />
            <x-input-error :messages="$errors->get('tanggal_masuk')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="tanggal_keluar" value="Tanggal keluar (wajib untuk penitipan)" />
            <x-text-input id="tanggal_keluar" type="date" name="tanggal_keluar"
                          class="mt-1 block w-full" :value="old('tanggal_keluar')" />
            <x-input-error :messages="$errors->get('tanggal_keluar')" class="mt-1" />
        </div>

        <div class="flex items-center gap-3">
            <x-primary-button>Ajukan</x-primary-button>
            <a href="{{ route('booking.index') }}" class="text-sm underline">Batal</a>
        </div>
    </form>
</x-app-layout>
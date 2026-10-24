<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display text-2xl text-furlow-ink">Tambah Layanan</h1>
    </x-slot>

    <form method="POST" action="{{ route('layanan.store') }}"
          class="max-w-xl space-y-5 rounded-2xl bg-white p-6">
        @csrf

        <div>
            <x-input-label for="nama_layanan" value="Nama layanan" />
            <x-text-input id="nama_layanan" name="nama_layanan" class="mt-1 block w-full"
                          :value="old('nama_layanan')" required />
            <x-input-error :messages="$errors->get('nama_layanan')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="harga" value="Harga (per hari / per layanan)" />
            <x-text-input id="harga" type="number" name="harga" class="mt-1 block w-full"
                          :value="old('harga')" required />
            <x-input-error :messages="$errors->get('harga')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="deskripsi" value="Deskripsi" />
            <textarea id="deskripsi" name="deskripsi" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('deskripsi') }}</textarea>
            <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
        </div>

        <div class="flex items-center gap-3">
            <x-primary-button>Simpan</x-primary-button>
            <a href="{{ route('layanan.index') }}" class="text-sm underline">Batal</a>
        </div>
    </form>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display text-2xl text-furlow-ink">Tambah Hewan</h1>
    </x-slot>

    <form method="POST" action="{{ route('hewan.store') }}" enctype="multipart/form-data"
          class="max-w-xl space-y-5 rounded-2xl bg-white p-6">
        @csrf

        <div>
            <x-input-label for="nama" value="Nama hewan" />
            <x-text-input id="nama" name="nama" class="mt-1 block w-full" :value="old('nama')" required />
            <x-input-error :messages="$errors->get('nama')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="jenis" value="Jenis (kucing, anjing, dll)" />
            <x-text-input id="jenis" name="jenis" class="mt-1 block w-full" :value="old('jenis')" required />
            <x-input-error :messages="$errors->get('jenis')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="ras" value="Ras (opsional)" />
            <x-text-input id="ras" name="ras" class="mt-1 block w-full" :value="old('ras')" />
            <x-input-error :messages="$errors->get('ras')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="catatan_kesehatan" value="Catatan kesehatan / alergi (opsional)" />
            <textarea id="catatan_kesehatan" name="catatan_kesehatan" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('catatan_kesehatan') }}</textarea>
            <x-input-error :messages="$errors->get('catatan_kesehatan')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="foto" value="Foto (opsional, maks 2 MB)" />
            <input id="foto" type="file" name="foto" accept="image/*" class="mt-1 block w-full text-sm">
            <x-input-error :messages="$errors->get('foto')" class="mt-1" />
        </div>

        <div class="flex items-center gap-3">
            <x-primary-button>Simpan</x-primary-button>
            <a href="{{ route('hewan.index') }}" class="text-sm underline">Batal</a>
        </div>
    </form>
</x-app-layout>
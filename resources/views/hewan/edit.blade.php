<x-app-layout>
    <x-slot name="header">
        <h1 class="font-display text-2xl text-furlow-ink">Edit Hewan</h1>
    </x-slot>

    <form method="POST" action="{{ route('hewan.update', $hewan) }}" enctype="multipart/form-data"
          class="max-w-xl space-y-5 rounded-2xl bg-white p-6">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="nama" value="Nama hewan" />
            <x-text-input id="nama" name="nama" class="mt-1 block w-full"
                          :value="old('nama', $hewan->nama)" required />
            <x-input-error :messages="$errors->get('nama')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="jenis" value="Jenis (kucing, anjing, dll)" />
            <x-text-input id="jenis" name="jenis" class="mt-1 block w-full"
                          :value="old('jenis', $hewan->jenis)" required />
            <x-input-error :messages="$errors->get('jenis')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="ras" value="Ras (opsional)" />
            <x-text-input id="ras" name="ras" class="mt-1 block w-full"
                          :value="old('ras', $hewan->ras)" />
            <x-input-error :messages="$errors->get('ras')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="catatan_kesehatan" value="Catatan kesehatan / alergi (opsional)" />
            <textarea id="catatan_kesehatan" name="catatan_kesehatan" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('catatan_kesehatan', $hewan->catatan_kesehatan) }}</textarea>
            <x-input-error :messages="$errors->get('catatan_kesehatan')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="foto" value="Foto (opsional, maks 2 MB)" />
            @if ($hewan->foto)
                <img src="{{ asset('storage/' . $hewan->foto) }}" alt="Foto {{ $hewan->nama }}"
                     class="mt-2 h-24 w-24 rounded-xl object-cover">
                <p class="mt-1 text-xs text-gray-500">Pilih file baru hanya kalau mau mengganti foto.</p>
            @endif
            <input id="foto" type="file" name="foto" accept="image/*" class="mt-2 block w-full text-sm">
            <x-input-error :messages="$errors->get('foto')" class="mt-1" />
        </div>

        <div class="flex items-center gap-3">
            <x-primary-button>Simpan Perubahan</x-primary-button>
            <a href="{{ route('hewan.index') }}" class="text-sm underline">Batal</a>
        </div>
    </form>
</x-app-layout>
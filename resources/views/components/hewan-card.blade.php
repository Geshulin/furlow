@props(['hewan', 'aksi' => true])

<div class="rounded-2xl border border-furlow-ink/15 bg-white p-4">
    <a href="{{ route('hewan.show', $hewan) }}" class="flex items-center gap-4">
        @if ($hewan->foto)
            <img src="{{ asset('storage/' . $hewan->foto) }}" alt="Foto {{ $hewan->nama }}"
                 class="h-14 w-14 rounded-xl object-cover">
        @else
            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-furlow-blob text-xl">🐾</div>
        @endif
        <div>
            <p class="font-display text-lg font-semibold text-furlow-ink">{{ $hewan->nama }}</p>
            <p class="text-sm">{{ $hewan->jenis }}@if ($hewan->ras) · {{ $hewan->ras }}@endif</p>
        </div>
    </a>

    @if ($aksi)
        <div class="mt-4 flex flex-wrap gap-2">
            <a href="{{ route('hewan.show', $hewan) }}"
               class="rounded-full border border-furlow-ink/20 px-4 py-1.5 text-xs font-semibold text-furlow-ink">Detail</a>
            <a href="{{ route('hewan.edit', $hewan) }}"
               class="rounded-full border border-furlow-ink/20 px-4 py-1.5 text-xs font-semibold text-furlow-ink">Edit</a>
            <form method="POST" action="{{ route('hewan.destroy', $hewan) }}"
                  onsubmit="return confirm(@js('Hapus ' . $hewan->nama . '?'))">
                @csrf
                @method('DELETE')
                <button class="rounded-full border border-red-200 px-4 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-50">Hapus</button>
            </form>
        </div>
    @endif
</div>

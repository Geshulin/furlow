@props(['hewan'])

<a href="{{ route('hewan.show', $hewan) }}"
   class="flex items-center gap-4 rounded-2xl border border-furlow-ink/15 bg-white p-4 transition hover:-translate-y-0.5 hover:border-furlow-teal">
    @if ($hewan->foto)
        <img src="{{ asset('storage/' . $hewan->foto) }}" alt="Foto {{ $hewan->nama }}" class="h-14 w-14 rounded-xl object-cover">
    @else
        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-furlow-blob text-xl">🐾</div>
    @endif
    <div>
        <p class="font-display text-lg font-semibold text-furlow-ink">{{ $hewan->nama }}</p>
        <p class="text-sm">{{ $hewan->jenis }}@if ($hewan->ras) · {{ $hewan->ras }}@endif</p>
    </div>
</a>
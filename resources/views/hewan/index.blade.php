<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h1 class="font-display text-2xl font-semibold text-furlow-ink">Hewan saya</h1>
            <a href="{{ route('hewan.create') }}"
               class="rounded-full bg-furlow-accent px-5 py-2.5 text-sm font-semibold text-furlow-accent-ink">+ Tambah hewan</a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 rounded-xl bg-green-100 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
    @endif

    <div class="grid gap-4 md:grid-cols-2">
        @forelse ($hewan as $h)
            <x-hewan-card :hewan="$h" />
        @empty
            <p>Belum ada hewan. Tambahkan hewan pertamamu.</p>
        @endforelse
    </div>
</x-app-layout>
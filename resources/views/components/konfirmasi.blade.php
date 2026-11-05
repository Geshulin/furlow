@props(['action', 'method' => 'POST', 'judul' => 'Yakin?', 'pesan' => '', 'tombol' => 'Ya, lanjut', 'bahaya' => true])

<div x-data="{ buka: false }" class="{{ $attributes->get('class', 'inline-block') }}">
    <div @click="buka = true">{{ $trigger }}</div>

    <template x-teleport="body">
        <div x-show="buka" x-cloak @click.self="buka = false" @keydown.escape.window="buka = false"
             class="fixed inset-0 z-[70] flex items-center justify-center bg-black/50 p-4">
            <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-xl">
                <h3 class="font-display text-lg font-semibold text-furlow-ink">{{ $judul }}</h3>
                <p class="mt-2 text-sm">{{ $pesan }}</p>
                <div class="mt-5 flex justify-end gap-2">
                    <button type="button" @click="buka = false"
                            class="rounded-md border border-furlow-ink/30 px-4 py-2 text-sm text-furlow-ink">Batal</button>
                    <form method="POST" action="{{ $action }}">
                        @csrf
                        @if (strtoupper($method) !== 'POST') @method($method) @endif
                        {{ $slot }}
                        <button type="submit"
                                class="rounded-md px-4 py-2 text-sm text-white {{ $bahaya ? 'bg-red-700' : 'bg-furlow-ink' }}">{{ $tombol }}</button>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Furlow — Penitipan & Grooming Hewan</title>
    @include('layouts.partials.head-assets')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-furlow-bg font-sans text-furlow-body antialiased">
    <header class="mx-auto flex max-w-6xl items-center justify-between px-5 py-6">
        <a href="/" class="flex items-center gap-2">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo Furlow" class="h-8 w-8">
            <span class="font-display text-2xl font-bold text-furlow-ink">Furlow</span>
        </a>
        <nav class="flex items-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-hover rounded-full bg-furlow-accent px-5 py-2.5 text-sm font-semibold text-furlow-accent-ink">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-hover rounded-full border border-furlow-ink/20 px-5 py-2.5 text-sm font-semibold text-furlow-ink">Masuk</a>
                <a href="{{ route('register') }}" class="btn-hover rounded-full bg-furlow-accent px-5 py-2.5 text-sm font-semibold text-furlow-accent-ink">Daftar</a>
            @endauth
        </nav>
    </header>

    <main>
        <div class="relative overflow-hidden">
            <div class="blob"></div>
            <div class="blob-2"></div>

            <section class="relative z-10 mx-auto grid max-w-6xl items-center gap-12 px-5 pb-24 pt-14 md:grid-cols-[1.1fr_0.9fr] md:pb-36 md:pt-24">
                <div>
                    <h1 class="reveal font-display text-4xl font-semibold leading-tight text-furlow-ink md:text-6xl">
                        Titip dan rawat hewanmu, <em class="text-furlow-teal">seperti di rumah sendiri.</em>
                    </h1>
                    <p class="reveal mt-5 max-w-lg text-lg" style="--d:.15s">Penitipan harian, grooming, dan pantauan kesehatan dalam satu tempat. Kamu yang mengantar, kami yang merawat.</p>
                    <div class="reveal mt-8 flex flex-wrap gap-3" style="--d:.3s">
                        <a href="#layanan" class="btn-hover rounded-full bg-furlow-accent px-6 py-3 font-semibold text-furlow-accent-ink">Lihat layanan</a>
                    </div>

                    <div class="paw-trail mt-10 flex flex-wrap items-center gap-2.5">
                        @for ($i = 0; $i < 5; $i++)
                            <svg viewBox="0 0 24 24" fill="#6E9B8F"><circle cx="12" cy="16" r="4.2"/><circle cx="5" cy="9" r="1.8"/><circle cx="19" cy="9" r="1.8"/><circle cx="8.4" cy="5.6" r="1.6"/><circle cx="15.6" cy="5.6" r="1.6"/></svg>
                        @endfor
                    </div>
                </div>

                <div class="reveal relative mt-32 md:mt-0" style="--d:.2s">
                    {{-- Golden retriever x kucing hitam, duduk di tepi kartu --}}
                    <svg class="absolute bottom-full right-4 block overflow-visible" viewBox="0 0 230 113" width="270" height="132" aria-hidden="true">
                        {{-- ===== KUCING ===== --}}
                        <path class="cat-tail" d="M194 98 C214 98 220 70 206 62"
                              fill="none" stroke="#1F3A2E" stroke-width="9" stroke-linecap="round"/>
                        <ellipse cx="168" cy="86" rx="27" ry="24" fill="#1F3A2E"/>
                        <ellipse cx="158" cy="108" rx="8" ry="4" fill="#2D5443"/>
                        <ellipse cx="180" cy="108" rx="8" ry="4" fill="#2D5443"/>

                        <g class="cat-head">
                            <path class="cat-ear" d="M154 36 L152 12 L170 28 Z" fill="#1F3A2E"/>
                            <path d="M190 36 L192 12 L174 28 Z" fill="#1F3A2E"/>
                            <path d="M156 31 L155 20 L164 27 Z" fill="#FBDFC0"/>
                            <circle cx="172" cy="50" r="20" fill="#1F3A2E"/>
                            <path d="M161 50 A4 4 0 0 0 169 50 Z" fill="#FBDFC0"/>
                            <path d="M175 50 A4 4 0 0 0 183 50 Z" fill="#FBDFC0"/>
                            <path d="M160 50 H170 M174 50 H184" stroke="#FBDFC0" stroke-width="1.4" stroke-linecap="round"/>
                            <circle cx="168" cy="52" r="1.5" fill="#1F3A2E"/>
                            <circle cx="182" cy="52" r="1.5" fill="#1F3A2E"/>
                            <path d="M169 57 L175 57 L172 61 Z" fill="#E8A33D"/>
                            <path d="M166 65 H178" stroke="#FBDFC0" stroke-width="1.2" stroke-linecap="round"/>
                            <path d="M156 56 L145 54 M156 59 L145 61 M188 56 L199 54 M188 59 L199 61"
                                  stroke="#FBDFC0" stroke-width="1" stroke-linecap="round"/>
                        </g>
                        <path d="M148 34 q-3 5 0 8 q3 -3 0 -8z" fill="#9CCFE0"/>

                        {{-- ===== ANJING ===== --}}
                        <g transform="translate(16 0)">
                            <path class="dog-tail" d="M34 100 C14 98 8 80 20 70"
                                  fill="none" stroke="#E3A94A" stroke-width="9" stroke-linecap="round"/>
                            <ellipse cx="44" cy="94" rx="15" ry="15" fill="#D9983A"/>
                            <ellipse cx="72" cy="86" rx="30" ry="25" fill="#E3A94A"/>
                            <ellipse cx="84" cy="94" rx="16" ry="15" fill="#F3CE8A"/>
                            <ellipse cx="46" cy="108" rx="10" ry="4.5" fill="#D9983A"/>
                            <ellipse cx="76" cy="108" rx="9" ry="4.5" fill="#F3CE8A"/>
                            <ellipse cx="95" cy="108" rx="9" ry="4.5" fill="#F3CE8A"/>

                            <g class="dog-head">
                                <ellipse cx="77" cy="54" rx="8" ry="16" transform="rotate(18 77 54)" fill="#C98A2B"/>
                                <ellipse cx="119" cy="54" rx="8" ry="16" transform="rotate(-18 119 54)" fill="#C98A2B"/>
                                <circle cx="98" cy="48" r="22" fill="#EDB95C"/>
                                <ellipse cx="98" cy="57" rx="12" ry="9" fill="#F6D9A0"/>
                                <circle cx="84" cy="52" r="3.5" fill="#F4A58A" opacity=".6"/>
                                <circle cx="112" cy="52" r="3.5" fill="#F4A58A" opacity=".6"/>
                                <path d="M87 42 Q91 37 95 42 M101 42 Q105 37 109 42"
                                      fill="none" stroke="#2B1B12" stroke-width="2.2" stroke-linecap="round"/>
                                <ellipse cx="98" cy="52" rx="4.5" ry="3.2" fill="#2B1B12"/>
                                <ellipse cx="98" cy="66" rx="3.5" ry="5" fill="#F08A9A"/>
                                <path d="M93 61 Q98 66 103 61" fill="none" stroke="#2B1B12" stroke-width="1.6" stroke-linecap="round"/>
                            </g>

                            <g transform="translate(96 16)"><path class="heart" d="M0 1 C-2.5 -2 -6 1.5 0 6 C6 1.5 2.5 -2 0 1Z" fill="#E8798A"/></g>
                            <g transform="translate(112 12)"><path class="heart" style="animation-delay:1s" d="M0 1 C-2.5 -2 -6 1.5 0 6 C6 1.5 2.5 -2 0 1Z" fill="#E8798A"/></g>
                            <g transform="translate(80 20)"><path class="heart" style="animation-delay:2s" d="M0 1 C-2.5 -2 -6 1.5 0 6 C6 1.5 2.5 -2 0 1Z" fill="#E8798A"/></g>
                        </g>
                    </svg>

                    <div class="flex min-h-64 items-center justify-center rounded-3xl border border-furlow-ink/15 bg-white p-6">
                        <img src="{{ asset('images/logo.svg') }}" alt="" class="h-24 w-24 opacity-90">
                    </div>
                </div>
            </section>
        </div>

        <section id="layanan" class="mx-auto max-w-6xl px-5 py-16">
            <h2 class="reveal-scroll font-display text-3xl font-semibold text-furlow-ink">Layanan kami</h2>
            <div class="mt-8 divide-y divide-furlow-ink/15 border-y border-furlow-ink/15">
                @forelse ($layanan as $l)
                    <div class="reveal-scroll flex flex-col gap-2 py-6 md:flex-row md:items-center md:justify-between"
                         style="transition-delay: {{ $loop->index * 0.08 }}s">
                        <div>
                            <h3 class="font-display text-xl font-semibold text-furlow-ink">{{ $l->nama_layanan }}</h3>
                            <p class="mt-1 text-sm">{{ $l->deskripsi }}</p>
                        </div>
                        <p class="font-display text-lg font-semibold text-furlow-ink">
                            <span class="text-sm font-normal">Mulai dari</span> {{ rupiah($l->harga) }}
                        </p>
                    </div>
                @empty
                    <p class="py-6">Layanan akan segera tersedia.</p>
                @endforelse
            </div>
        </section>

        <section class="mx-auto max-w-6xl px-5 pb-20">
            <div class="reveal-scroll flex flex-wrap items-center justify-between gap-7 rounded-[26px] bg-furlow-ink px-6 py-12 md:px-16">
                <div>
                    <h2 class="max-w-[22ch] font-display text-3xl font-semibold text-white">Booking pertama hewanmu hari ini.</h2>
                    <p class="mt-2 max-w-md text-sm text-white/70">Daftarkan hewanmu sekali. Catatan alergi dan riwayat layanannya tersimpan untuk kunjungan berikutnya.</p>
                </div>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-hover rounded-full bg-furlow-accent px-6 py-3 font-semibold text-furlow-accent-ink">Ke dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn-hover rounded-full bg-furlow-accent px-6 py-3 font-semibold text-furlow-accent-ink">Daftar sekarang</a>
                @endauth
            </div>
        </section>
    </main>

    <footer class="border-t border-furlow-ink/15 py-8 text-center text-sm">© 2026 Furlow. Proyek UKOM.</footer>

    <a href="https://wa.me/{{ config('furlow.wa') }}?text={{ urlencode('Halo min Furlow, aku mau nanya soal layanan nichh') }}"
       target="_blank" rel="noopener"
       class="btn-hover fixed bottom-6 right-5 z-40 rounded-full bg-[#25D366] px-5 py-3 text-sm font-semibold text-white shadow-lg">
        Chat WhatsApp
    </a>
</body>
</html>
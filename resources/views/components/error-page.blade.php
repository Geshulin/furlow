@props(['kode', 'judul', 'pesan'])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $kode }} — Furlow</title>
    @include('layouts.partials.head-assets')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-furlow-bg font-sans text-furlow-body antialiased">
    <div class="flex min-h-screen flex-col items-center justify-center px-5 text-center">
        <p class="font-display text-7xl font-bold text-furlow-accent">{{ $kode }}</p>
        <h1 class="mt-4 font-display text-2xl font-semibold text-furlow-ink">{{ $judul }}</h1>
        <p class="mt-2 max-w-md">{{ $pesan }}</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ url('/') }}"
               class="btn-hover rounded-full bg-furlow-accent px-6 py-3 text-sm font-semibold text-furlow-accent-ink">Kembali ke beranda</a>
            @auth
                <a href="{{ route('dashboard') }}"
                   class="rounded-full border border-furlow-ink/20 px-6 py-3 text-sm font-semibold text-furlow-ink">Ke dashboard</a>
            @endauth
        </div>
    </div>
</body>
</html>
@props(['name'])
<svg {{ $attributes->merge(['class' => 'h-5 w-5 shrink-0']) }} viewBox="0 0 24 24" fill="none"
     stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('home')    <path d="M4 11l8-6 8 6v8a1 1 0 01-1 1H5a1 1 0 01-1-1v-8z"/> @break
        @case('layanan') <rect x="4" y="4" width="16" height="16" rx="3"/> @break
        @case('booking') <rect x="4" y="5" width="16" height="15" rx="2"/><path d="M8 3v4M16 3v4M4 10h16"/> @break
        @case('keluar')  <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/> @break
        @case('profil')  <circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/> @break
        @case('hewan')   <g fill="currentColor" stroke="none"><circle cx="12" cy="16" r="4.2"/><circle cx="5" cy="9" r="1.8"/><circle cx="19" cy="9" r="1.8"/><circle cx="8.4" cy="5.6" r="1.6"/><circle cx="15.6" cy="5.6" r="1.6"/></g> @break
    @endswitch
</svg>
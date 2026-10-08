<h1>Booking Saya</h1>
@if(session('success')) <p>{{ session('success') }}</p> @endif
<a href="{{ route('booking.create') }}">+ Ajukan Booking</a>
<ul>
@foreach($bookingSaya as $b)
    <li>
        {{ $b->hewan->nama }} — {{ $b->layanan->nama_layanan }}
        — masuk: {{ $b->tanggal_masuk }}
        — status: {{ $b->status }}
    </li>
@endforeach
</ul>
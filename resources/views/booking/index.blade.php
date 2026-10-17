<h1>Booking Saya</h1>
@if(session('success')) <p>{{ session('success') }}</p> @endif
<a href="{{ route('booking.create') }}">+ Ajukan Booking</a>
<ul>
@foreach($bookingSaya as $b)
    <li>
        {{ $b->hewan->nama }} — {{ $b->layanan->nama_layanan }}
        — masuk: {{ $b->tanggal_masuk }}
        — status: {{ $b->status }}
        @if($b->status === 'menunggu')
    <form action="{{ route('booking.batal', $b) }}" method="POST" style="display:inline">
        @csrf @method('PATCH')
        <button type="submit">Batalkan</button>
    </form>
@endif
    </li>
@endforeach
</ul>
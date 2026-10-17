<h1>Semua Booking</h1>
@if(session('success')) <p>{{ session('success') }}</p> @endif
@if($errors->any()) <p>{{ $errors->first() }}</p> @endif
<ul>
@foreach($semuaBooking as $b)
    <li>
        {{ $b->hewan->nama }} — {{ $b->layanan->nama_layanan }}
        — masuk: {{ $b->tanggal_masuk }}
        @if($b->tanggal_keluar) — keluar: {{ $b->tanggal_keluar }} @endif

        @if(in_array($b->status, ['ditolak', 'selesai', 'dibatalkan']))
            — status: {{ $b->status }}
        @else
            <form action="{{ route('booking.updateStatus', $b) }}" method="POST" style="display:inline">
                @csrf @method('PATCH')
                <select name="status">
                    @foreach(['menunggu', 'diterima', 'ditolak', 'diproses', 'selesai'] as $s)
                        <option value="{{ $s }}" @selected($b->status === $s)>{{ $s }}</option>
                    @endforeach
                </select>
                <button type="submit">Simpan</button>
            </form>
        @endif
    </li>
@endforeach
</ul>
<h1>Ajukan Booking</h1>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{ route('booking.store') }}" method="POST">
    @csrf
    <label>Hewan</label>
    <select name="hewan_id">
        @foreach($hewanSaya as $h)
            <option value="{{ $h->id }}">{{ $h->nama }}</option>
        @endforeach
    </select>

    <label>Layanan</label>
    <select name="layanan_id">
        @foreach($layanan as $l)
            <option value="{{ $l->id }}">{{ $l->nama_layanan }} — Rp {{ number_format($l->harga, 0, ',', '.') }}</option>
        @endforeach
    </select>

    <label>Tanggal Masuk</label>
    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}">
    <label>Tanggal Keluar (untuk penitipan)</label>
    <input type="date" name="tanggal_keluar" value="{{ old('tanggal_keluar') }}">

    <button type="submit">Ajukan</button>
</form>
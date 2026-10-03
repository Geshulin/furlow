<h1>Tambah Layanan</h1>
<form action="{{ route('layanan.store') }}" method="POST">
    @csrf
    <label>Nama Layanan</label>
    <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}">
    <label>Harga</label>
    <input type="number" name="harga" value="{{ old('harga') }}">
    <label>Deskripsi</label>
    <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
    <button type="submit">Simpan</button>
</form>
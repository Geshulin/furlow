<h1>Edit Layanan</h1>
<form action="{{ route('layanan.update', $layanan) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nama Layanan</label>
    <input type="text" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}">
    <label>Harga</label>
    <input type="number" name="harga" value="{{ old('harga', (int) $layanan->harga) }}">
    <label>Deskripsi</label>
    <textarea name="deskripsi">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
    <button type="submit">Simpan</button>
</form>
<h1>Tambah Hewan</h1>
<form action="{{ route('hewan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Nama</label>
    <input type="text" name="nama" value="{{ old('nama') }}">
    <label>Jenis</label>
    <input type="text" name="jenis" value="{{ old('jenis') }}">
    <label>Ras</label>
    <input type="text" name="ras" value="{{ old('ras') }}">
    <label>Catatan Kesehatan</label>
    <textarea name="catatan_kesehatan">{{ old('catatan_kesehatan') }}</textarea>
    <label>Foto</label>
    <input type="file" name="foto">
    <button type="submit">Simpan</button>
</form>
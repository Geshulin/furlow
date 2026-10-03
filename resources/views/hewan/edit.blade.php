<h1>Edit Hewan</h1>
<form action="{{ route('hewan.update', $hewan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Nama</label>
    <input type="text" name="nama" value="{{ old('nama', $hewan->nama) }}">
    <label>Jenis</label>
    <input type="text" name="jenis" value="{{ old('jenis', $hewan->jenis) }}">
    <label>Catatan Kesehatan</label>
    <textarea name="catatan_kesehatan">{{ old('catatan_kesehatan', $hewan->catatan_kesehatan) }}</textarea>
    <label>Foto</label>
    @if($hewan->foto)
        <img src="{{ asset('storage/'.$hewan->foto) }}" width="80">
    @endif
    <input type="file" name="foto">
    <button type="submit">Simpan</button>
</form>
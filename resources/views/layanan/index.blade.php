<h1>Kelola Layanan</h1>
@if(session('success')) <p>{{ session('success') }}</p> @endif
<a href="{{ route('layanan.create') }}" >+ Tambah Layanan</a>
<ul>
    @foreach($layanan as $l)
    <li>
        {{ $l->nama_layanan }} - Rp {{ number_format($l->harga, 0, ',', '.') }}
        <a href="{{ route('layanan.edit', $l) }}">Edit</a>
        <form action="{{ route('layanan.destroy', $l) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </li>
    @endforeach
</ul>
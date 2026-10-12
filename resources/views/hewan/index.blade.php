<h1>Hewan Saya</h1>
@if(session('success')) <p>{{ session('success') }}</p> @endif
<a href="{{ route('hewan.create') }}">+ Tambah Hewan</a>
<ul>
@foreach($hewan as $h)
    <li>
        @if($h->foto)
            <img src="{{ asset('storage/'.$h->foto) }}" width="80">
        @endif
        {{ $h->nama }} ({{ $h->jenis }}{{ $h->ras ? ', '.$h->ras : '' }})
        <a href="{{ route('hewan.edit', $h) }}">Edit</a>
        <form action="{{ route('hewan.destroy', $h) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </li>
@endforeach
</ul>
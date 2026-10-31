@props(['booking'])

<span {{ $attributes }}>
    {{ tanggal($booking->tanggal_masuk) }}
    @if ($booking->tanggal_keluar && ! $booking->tanggal_keluar->isSameDay($booking->tanggal_masuk))
        – {{ tanggal($booking->tanggal_keluar) }}
    @endif
</span>
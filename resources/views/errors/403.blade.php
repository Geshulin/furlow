<x-error-page kode="403" judul="Kamu tidak punya akses ke halaman ini"
    :pesan="$exception->getMessage() ?: 'Halaman ini hanya bisa dibuka oleh akun yang berhak.'" />
<!DOCTYPE html>
<html>
<head>
    <title>Detail Novel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <a href="{{ route('novels.search') }}" class="btn btn-secondary mb-3">
        ← Kembali
    </a>

    <div class="card shadow p-4">

        <h2>
            {{ $book['title'] ?? 'Tanpa Judul' }}
        </h2>

        {{-- ❤️ BUTTON BOOKMARK --}}
        @auth
            <form method="POST" action="{{ route('bookmark.store') }}">
                @csrf

                <input type="hidden" name="book_id" value="{{ $book['key'] ?? '' }}">
                <input type="hidden" name="title" value="{{ $book['title'] ?? '' }}">
                <input type="hidden" name="author" value="{{ $book['authors'][0]['name'] ?? 'Unknown' }}">
                <input type="hidden" name="thumbnail" value="">

                <button class="btn btn-danger btn-sm mt-2 mb-3">
                    ❤️ Simpan Favorit
                </button>
            </form>
        @endauth

        <p>
            <strong>Deskripsi:</strong><br>

            @php
                $desc = $book['description'] ?? 'Tidak ada deskripsi';

                if (is_array($desc)) {
                    $desc = $desc['value'] ?? json_encode($desc);
                }

                // bersihkan markdown link
                $desc = preg_replace('/\[(.*?)\]\((.*?)\)/', '$1', $desc);
            @endphp

            {{ $desc }}
        </p>

        <p>
            <strong>ID Buku:</strong><br>
            {{ $book['key'] ?? '-' }}
        </p>

    </div>

</div>

</body>
</html>
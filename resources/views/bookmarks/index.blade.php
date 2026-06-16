<!DOCTYPE html>
<html>
<head>
    <title>Bookmark Favorit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2>❤️ Buku Favorit Saya</h2>

    <a href="/search" class="btn btn-secondary mb-3">← Kembali</a>

    @foreach($bookmarks as $b)

        <div class="card mb-3 p-3">

            <h4>{{ $b->title }}</h4>
            <p>{{ $b->author }}</p>

            <form method="POST" action="{{ route('bookmark.destroy', $b->id) }}">
                @csrf
                @method('DELETE')

                <button class="btn btn-sm btn-danger">
                    Hapus
                </button>
            </form>

        </div>

    @endforeach

</div>

</body>
</html>
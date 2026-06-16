<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovelKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            📚 NovelKu
        </a>
    </div>
</nav>

<div class="container mt-4">

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h2 class="mb-3">
                Cari Novel Favoritmu
            </h2>

            <form method="GET" action="{{ route('novels.search') }}">

                <div class="input-group">

                    <input
                        type="text"
                        class="form-control"
                        name="q"
                        placeholder="Contoh: Harry Potter"
                        value="{{ request('q') }}"
                    >

                    <button
                        class="btn btn-primary"
                        type="submit"
                    >
                        Cari
                    </button>

                </div>

            </form>

        </div>
    </div>

    @if(isset($books['docs']) && count($books['docs']) > 0)

        <div class="row">

            @foreach($books['docs'] as $book)

                <div class="col-md-4 mb-4">

                    <div class="card h-100 shadow-sm">

                        @if(isset($book['cover_i']))
                            <img
                                src="https://covers.openlibrary.org/b/id/{{ $book['cover_i'] }}-L.jpg"
                                class="card-img-top"
                                style="height:350px; object-fit:cover;"
                            >
                        @else
                            <div
                                class="d-flex align-items-center justify-content-center bg-secondary text-white"
                                style="height:350px;"
                            >
                                No Cover
                            </div>
                        @endif

                        <div class="card-body">

                            <h5 class="card-title">
                                {{ $book['title'] ?? 'Tanpa Judul' }}
                            </h5>

                            <p class="card-text">
                                <strong>Penulis:</strong>
                                {{ implode(', ', $book['author_name'] ?? ['Unknown']) }}
                            </p>

                            <p class="card-text">
                                <strong>Tahun:</strong>
                                {{ $book['first_publish_year'] ?? '-' }}
                            </p>

                            {{-- BUTTON DETAIL --}}
							<a href="{{ route('novels.detail', ['id' => urlencode($book['key'])]) }}"
							  class="btn btn-dark btn-sm mt-2">
								Lihat Detail
							</a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @elseif(request('q'))

        <div class="alert alert-warning">
            Novel tidak ditemukan.
        </div>

    @endif

</div>

</body>
</html>
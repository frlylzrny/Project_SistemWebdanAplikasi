<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovelKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .book-card{
            transition: all .3s ease;
            border:none;
        }

        .book-card:hover{
            transform: translateY(-8px);
            box-shadow:0 10px 25px rgba(0,0,0,.15);
        }

        .cover-img{
            height:350px;
            object-fit:cover;
        }

        .book-title{
            min-height:60px;
        }

        @media (max-width:768px){
            .cover-img{
                height:300px;
            }

            .navbar-brand{
                font-size:1.5rem !important;
            }
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">

        <a class="navbar-brand fw-bold fs-3" href="{{ route('novels.search') }}">
            📚 NovelKu
        </a>

        <div class="d-flex align-items-center gap-3">

            <span class="text-white d-none d-md-inline">
                Temukan Novel Favoritmu
            </span>

            @auth
                <a href="/dashboard" class="btn btn-light btn-sm">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-light btn-sm">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">
                    Register
                </a>
            @endauth

        </div>

    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow border-0 mb-4">
        <div class="card-body p-4">

            <h2 class="fw-bold mb-3">
                Cari Novel Favoritmu
            </h2>

            <form method="GET" action="{{ route('novels.search') }}">

                <div class="input-group input-group-lg">

                    <input
                        type="text"
                        class="form-control"
                        name="q"
                        placeholder="Contoh: Harry Potter"
                        value="{{ request('q') }}"
                    >

                    <button
                        class="btn btn-primary px-4"
                        type="submit"
                    >
                        Cari
                    </button>

                </div>

            </form>

        </div>
    </div>

    {{-- PESAN AWAL --}}
    @if(!request('q'))

        <div class="alert alert-info shadow-sm">
            Cari novel berdasarkan judul atau nama penulis untuk mulai menjelajah koleksi buku.
        </div>

    @endif

    @if(isset($books['docs']) && count($books['docs']) > 0)

        <div class="mb-4">
            <h5>
                Ditemukan
                <span class="badge bg-success">
                    {{ count($books['docs']) }}
                </span>
                novel
            </h5>
        </div>

        <div class="row g-4">

            @foreach($books['docs'] as $book)

                <div class="col-md-4">

                    <div class="card h-100 shadow-sm book-card">

                        @if(isset($book['cover_i']))
                            <img
                                src="https://covers.openlibrary.org/b/id/{{ $book['cover_i'] }}-L.jpg"
                                class="card-img-top cover-img"
                            >
                        @else
                            <div
                                class="d-flex align-items-center justify-content-center bg-secondary text-white cover-img"
                            >
                                No Cover
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title fw-bold book-title">
                                {{ $book['title'] ?? 'Tanpa Judul' }}
                            </h5>

                            <p class="card-text mb-2">
                                <strong>Penulis:</strong><br>
                                {{ implode(', ', $book['author_name'] ?? ['Unknown']) }}
                            </p>

                            <p class="card-text">
                                <strong>Tahun:</strong>
                                {{ $book['first_publish_year'] ?? '-' }}
                            </p>

                            <div class="mt-auto">

                                <a
                                    href="{{ route('novels.detail', ['id' => urlencode($book['key'])]) }}"
                                    class="btn btn-dark w-100"
                                >
                                    📖 Lihat Detail
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @elseif(request('q'))

        <div class="alert alert-warning shadow-sm">
            Novel tidak ditemukan.
        </div>

    @endif

</div>

</body>
</html>
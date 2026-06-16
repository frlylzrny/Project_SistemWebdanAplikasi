<!DOCTYPE html>
<html>
<head>
    <title>Detail Novel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .book-cover{
            height: 550px;
            object-fit: cover;
        }

        .genre-badge{
            font-size: 14px;
            padding: 8px 12px;
            margin-bottom: 5px;
        }

        .book-card{
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .desc-box{
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-4">

        <a href="{{ route('novels.search') }}"
           class="btn btn-secondary">
            ← Kembali
        </a>

        @auth
            <a href="{{ route('bookmark.index') }}"
               class="btn btn-warning">
                ❤️ Bookmark Saya
            </a>
        @endauth

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg book-card">

        <div class="row g-0">

            {{-- COVER --}}
            <div class="col-md-4">

                @if(isset($book['covers'][0]))

                    <img
                        src="https://covers.openlibrary.org/b/id/{{ $book['covers'][0] }}-L.jpg"
                        class="img-fluid w-100 book-cover"
                    >

                @else

                    <div
                        class="bg-secondary text-white d-flex justify-content-center align-items-center"
                        style="height:550px;"
                    >
                        No Cover
                    </div>

                @endif

            </div>

            {{-- DETAIL --}}
            <div class="col-md-8">

                <div class="card-body p-4">

                    <h1 class="fw-bold mb-3">
                        {{ $book['title'] ?? 'Tanpa Judul' }}
                    </h1>

                    {{-- BOOKMARK --}}
                    @auth
                        <form method="POST" action="{{ route('bookmark.store') }}">
                            @csrf

                            <input type="hidden" name="book_id" value="{{ $book['key'] ?? '' }}">
                            <input type="hidden" name="title" value="{{ $book['title'] ?? '' }}">
                            <input type="hidden" name="author" value="Unknown">
                            <input type="hidden" name="thumbnail" value="">

                            <button class="btn btn-danger mb-4">
                                ❤️ Simpan ke Favorit
                            </button>
                        </form>
                    @endauth

                    {{-- DESKRIPSI --}}
                    <h4 class="fw-bold">
                        Deskripsi
                    </h4>

                    @php
                        $desc = $book['description'] ?? 'Tidak ada deskripsi';

                        if (is_array($desc)) {
                            $desc = $desc['value'] ?? json_encode($desc);
                        }

                        $desc = preg_replace('/\[(.*?)\]\((.*?)\)/', '$1', $desc);
                    @endphp

                    <div class="desc-box mb-4">
                        {{ $desc }}
                    </div>

                    {{-- KATEGORI --}}
                    @if(isset($book['subjects']))
                        <h4 class="fw-bold">
                            Genre / Kategori
                        </h4>

                        <div class="mb-4">

                            @foreach(array_slice($book['subjects'], 0, 12) as $subject)

                                <span class="badge bg-primary genre-badge">
                                    {{ $subject }}
                                </span>

                            @endforeach

                        </div>
                    @endif

                    {{-- INFORMASI --}}
                    <h4 class="fw-bold">
                        Informasi Buku
                    </h4>

                    <div class="card border-0 bg-light p-3">

                        <p class="mb-2">
                            <strong>ID Buku:</strong>
                            {{ $book['key'] ?? '-' }}
                        </p>

                        <p class="mb-0">
                            <strong>Sumber Data:</strong>
                            OpenLibrary API
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
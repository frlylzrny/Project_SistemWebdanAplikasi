<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pencarian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                🔍 Riwayat Pencarian
            </h2>

            <p class="text-muted">
                Total Riwayat: {{ count($histories) }}
            </p>
        </div>

        <a href="{{ route('novels.search') }}"
           class="btn btn-secondary">
            ← Kembali
        </a>

    </div>

    @if(count($histories) > 0)

        <div class="card shadow">

            <div class="list-group list-group-flush">

                @foreach($histories as $history)

                    <div class="list-group-item">

                        <h5 class="mb-1">
                            {{ $history->keyword }}
                        </h5>

                        <small class="text-muted">
                            {{ $history->created_at }}
                        </small>

                    </div>

                @endforeach

            </div>

        </div>

    @else

        <div class="alert alert-info">

            Belum ada riwayat pencarian.

        </div>

    @endif

</div>

</body>
</html>
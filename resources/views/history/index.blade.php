<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pencarian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .history-card{
            transition:.3s;
            border:none;
        }

        .history-card:hover{
            transform:translateY(-3px);
            box-shadow:0 10px 20px rgba(0,0,0,.12);
        }
    </style>
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                🔍 Riwayat Pencarian
            </h2>

            <p class="text-muted">
                Total Riwayat:
                {{ count($histories) }}
            </p>
        </div>

        <a href="{{ route('novels.search') }}"
           class="btn btn-secondary">
            ← Kembali
        </a>

    </div>

    @if(count($histories) > 0)

        <div class="row">

            @foreach($histories as $history)

                <div class="col-md-6 mb-3">

                    <div class="card history-card shadow-sm">

                        <div class="card-body">

                            <h5 class="fw-bold">
                                {{ $history->keyword }}
                            </h5>

                            <small class="text-muted">
                                Dicari pada:
                                {{ $history->created_at }}
                            </small>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="alert alert-info">

            Belum ada riwayat pencarian.

        </div>

    @endif

</div>

</body>
</html>
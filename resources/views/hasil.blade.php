<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hasil Ujian - {{ $hasil->sesi }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            background: white;
            max-width: 500px;
            width: 100%;
            padding: 3rem 2.5rem;
            text-align: center;
            margin: 1rem auto;
        }
        h2 {
            font-weight: 700;
            color: #3b49df;
            margin-bottom: 1.5rem;
        }
        p {
            font-size: 1.15rem;
            color: #444;
            margin-bottom: 1.25rem;
        }
        .keterangan {
            font-style: italic;
            color: #666;
            margin-bottom: 2rem;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .btn-view {
            background: #0d6efd;
            border: none;
            padding: 0.75rem 1.8rem;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-view:hover {
            background: #0843c3;
            color: #fff;
        }
        .btn-download {
            background: #198754;
            border: none;
            padding: 0.75rem 1.8rem;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-download:hover {
            background: #126a37;
            color: #fff;
        }
        .btn-secondary {
            padding: 0.65rem 1.6rem;
            font-size: 1.05rem;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            background-color: #6c757d;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #5c636a;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Hasil Ujian</h2>
    <h4 class="mb-4"><span class="text-primary">{{ $hasil->sesi }}</span></h4>

    <p><strong>Tanggal Ujian:</strong> {{ \Carbon\Carbon::parse($hasil->tanggal_ujian)->translatedFormat('j F Y') }}</p>

    @if($hasil->keterangan)
        <p class="keterangan">"{{ $hasil->keterangan }}"</p>
    @endif

    <div class="btn-group" role="group" aria-label="File actions">
        {{-- Tombol Lihat --}}
        <a href="{{ asset('storage/' . $hasil->file_path) }}" target="_blank" class="btn btn-view">
            <i class="bi bi-eye"></i> Lihat File
        </a>

        {{-- Tombol Download --}}
        <a href="{{ route('hasil.download', $hasil->id) }}" class="btn btn-download">
            <i class="bi bi-download"></i> Download File
        </a>
    </div>

    {{-- Tombol Kembali --}}
    <div class="d-flex justify-content-center">
        <a href="{{ url('/') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

</body>
</html>
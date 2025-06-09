<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hasil Ujian - {{ $hasil->sesi }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
  />
  <style>
    body {
      background-image: url('{{ asset('assets/img/graha.png') }}');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      padding: 2rem;
      position: relative;
      z-index: 0;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      background: white;
      max-width: 500px;
      width: 100%;
      padding: 3rem 2.5rem;
      text-align: center;
      margin: 1rem auto;
      position: relative;
      z-index: 1;
    }
    h2 {
      font-weight: 700;
      color: #444444;
      margin-bottom: 1.5rem;
    }
    h4 {
      color: #666666;
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
      flex-direction: column;
      gap: 1rem;
      align-items: center;
      margin-bottom: 2rem;
      width: 100%;
      max-width: 320px;
      margin-left: auto;
      margin-right: auto;
    }
    .btn-group a {
      width: 100%;
      max-width: 320px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.5rem;
      font-size: 1.2rem;
      padding: 0.85rem 2rem;
      border-radius: 8px;
      text-decoration: none;
      color: white;
      transition: background-color 0.3s ease;
      cursor: pointer;
      box-sizing: border-box;
      font-weight: 600;
    }
    .btn-view {
      background: #0d6efd;
      border: none;
    }
    .btn-view:hover {
      background: #0843c3;
      color: #fff;
    }
    .btn-download {
      background: #198754;
      border: none;
    }
    .btn-download:hover {
      background: #126a37;
      color: #fff;
    }
    .btn-secondary {
      background-color: #6c757d;
      border: none;
      font-size: 1.15rem;
      font-weight: 600;
      padding: 0.85rem 2rem;
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
    <h4>
      <span>{{ $hasil->sesi }}</span>
    </h4>

    <p><strong>Tanggal Ujian:</strong> {{ \Carbon\Carbon::parse($hasil->tanggal_ujian)->translatedFormat('j F Y') }}</p>

    @if($hasil->keterangan)
    <p class="keterangan">"{{ $hasil->keterangan }}"</p>
    @endif

    <div class="btn-group" role="group" aria-label="Aksi file">
      <!-- Tombol Lihat -->
      <a href="{{ asset('storage/' . $hasil->file_path) }}" target="_blank" class="btn-view">
        <i class="bi bi-eye"></i> Lihat File
      </a>

      <!-- Tombol Download -->
      <a href="{{ route('hasil.download', $hasil->id) }}" class="btn-download">
        <i class="bi bi-download"></i> Download File
      </a>

      <!-- Tombol Kembali -->
      <a href="{{ url('/beranda') }}" class="btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </div>
  </div>
</body>
</html>

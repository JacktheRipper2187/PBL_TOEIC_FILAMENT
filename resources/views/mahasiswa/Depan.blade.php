@php
    $site_name = get_setting_value('_site_name');
    $section = get_section_value();
    $location = get_setting_value('_location');
    $site_description = get_setting_value('_site_description');
    $instagram = get_setting_value('_instagram');
    $email = get_setting_value('_email');
    $whatsapp = get_setting_value('_whatsapp');
    $pendaftaran = get_pendaftaran_value();
    // Ambil data dari model yang sesuai dengan kategori
    $jadwalPendaftaran = get_JadwalPendaftaran_value();
    $ujian = get_JadwalUjian_value();
    $pengambilan = get_JadwalSertifikat_value();
    $mahasiswa = Auth::user()->mahasiswa;
    $ujianList = get_JadwalUjian_value();

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ $site_name }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- CDN Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            padding-top: 56px;
        }

        .masthead {
            padding-top: 100px;
        }

        /* Style untuk lingkaran hijau fixed */
        .date-box {
            background-color: #1abc9c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            height: 150px;
            margin-right: 40px;
            flex-shrink: 0;
        }

        #current-date {
            font-size: 1.2rem;
            font-weight: 600;
            text-align: center;
            padding: 10px;
            color: white;
        }

        /* Style untuk tabel */
        .btn-outline-light.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .table {
            background-color: white;
            color: #212529;
        }

        .thead-dark th {
            background-color: #343a40;
            color: white;
        }

        .badge {
            font-size: 0.95rem;
            padding: 0.5em 0.8em;
            border-radius: 8px;
        }

        .card-title {
            font-size: 1.1rem;
        }

        .card {
            border-width: 2px;
            border-radius: 12px;
        }

        .dropdown-menu {
            min-width: 160px;
            margin-top: 0.5rem;
            border-radius: 10px;
        }

        /* NAVBAR CUSTOM STYLES */
        /* Ensure navbar brand stays on the left */
        .navbar-brand {
            margin-right: auto;
            /* Pushes everything else to the right */
        }

        /* Navbar container to allow full width */
        .navbar-container {
            width: 100%;
            padding: 0 15px;
            /* Match Bootstrap's container padding */
        }

        /* Navbar menu alignment */
        .navbar-nav {
            margin-left: auto;
            /* Pushes menu items to the right */
        }

        /* Nav item spacing */
        .nav-item {
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

        /* Profile dropdown alignment */
        .profile-dropdown {
            margin-left: 1rem;
        }

        .fade {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .fade.show {
            opacity: 1;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container-fluid navbar-container"> <!-- Changed to container-fluid for full width -->
            <!-- Logo and Site Name - Left aligned -->
            <a class="navbar-brand d-flex align-items-center" href="#page-top">
                <img src="assets/img/Logo Polinema.png" alt="Logo" class="mr-2" style="width: 65px;">
                {{ $site_name }}
            </a>

            <!-- Mobile Toggle Button -->
            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navbar Menu - Right aligned -->
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto"> <!-- Changed to ml-auto for right alignment -->
                    <!-- Main Menu Items -->
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#beranda">{{ __('messages.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#syarat">{{ __('messages.terms') }}</a></li>
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#pendaftaran">{{ __('messages.registration') }}</a></li>
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#jadwal">{{ __('messages.schedule') }}</a></li>
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#hasil">{{ __('messages.result') }}</a></li>

                    <!-- Language Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle py-3 px-0 px-lg-3 rounded" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('messages.select_language') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item"
                                    href="{{ route('change.language', 'id') }}">{{ __('messages.indonesian') }}</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('change.language', 'en') }}">{{ __('messages.english') }}</a></li>
                        </ul>
                    </li>

                    <!-- Profile Dropdown - Right aligned -->
                    <li class="nav-item dropdown profile-dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $mahasiswa && $mahasiswa->foto ? asset('storage/' . $mahasiswa->foto) : asset('storage/img/profile.png') }}"
                                alt="Foto Profil" width="40" height="40" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center text-primary"
                                    href="{{ route('mahasiswa.profile') }}">
                                    <i class="bi bi-person me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item m-0 p-0">
                                    @csrf
                                    <button class="dropdown-item d-flex align-items-center text-danger" type="submit">
                                        <i class="bi bi-box-arrow-left me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead -->
    <header class="masthead text-white text-center" id="beranda"
        style="background: url('assets/img/graha.png'); background-size: cover; background-position: center; height: 100vh;">
        <div class="container d-flex align-items-center flex-column justify-content-center"
            style="min-height: 100vh;">
            <div class="d-flex align-items-center mb-5"
                style="width: 80%; justify-content: flex-start; padding: 30px;">
                <!-- Tanggal dengan background hijau fixed -->
                <div class="date-box">
                    <h3 id="current-date" class="mb-0"></h3>
                </div>

                <div>
                    <div style="text-align: left; width: 100%;">
                        <h2 class="masthead-subheading mb-2.5" style="font-size: 1rem; font-weight: 600;">
                            {{ $section['Beranda']->title }}
                        </h2>
                        <h1 class="masthead-title mb-4"
                            style="font-size: 3rem; font-weight: 800; letter-spacing: 3px;">
                            {{ $section['Beranda']->thumbnail }}
                        </h1>
                        <div class="masthead-description lead"
                            style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem;">
                            {!! $section['Beranda']->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
        const locale = "{{ session('locale', 'id') }}";

        function updateCurrentDate() {
            const now = new Date();
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                timeZone: 'Asia/Jakarta'
            };
            document.getElementById('current-date').textContent =
                now.toLocaleDateString(locale, options).replace('pukul', '').trim() + ' WIB';
        }
        updateCurrentDate();
        setInterval(updateCurrentDate, 60000);
    </script>

    <!-- Syarat dan Ketentuan Section-->
    <section class="page-section" id="syarat">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-4">{{ $section['SyaratKetentuan']->thumbnail }}
            </h2>
            <div class="divider-custom divider-dark mb-5">
                <div class="divider-custom-line"></div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="syarat-box">
                        {!! $section['SyaratKetentuan']->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pendaftaran Section-->
    <section class="page-section portfolio" id="pendaftaran">
        <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-4">
                {{ __('messages.pendaftar') }}
            </h2>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="row justify-content-center">
                @php
                    $pendaftaranAktif = is_pendaftaran_active();
                @endphp
                @php
                    $pendaftaranAktif = is_pendaftaran_active();
                @endphp

                @foreach ($pendaftaran as $item)
                    @php
                        $isGratis = Str::contains(Str::lower($item->title), ['gratis', 'free']);

                        if ($isGratis) {
                            $now = now();
                            $schedule = \App\Models\JadwalPendaftaran::getActiveScheduleForStaticTitle();
                            $jadwalAktif = $schedule && $schedule->isActive();

                            $debugInfo = [
                                'title' => $item->title,
                                'current_time' => $now->format('Y-m-d H:i:s'),
                                'active_schedule' => $schedule
                                    ? [
                                        'id' => $schedule->id,
                                        'nama' => $schedule->nama_jadwal,
                                        'status' => $schedule->isActive(),
                                        'mode' => is_null($schedule->status_manual) ? 'otomatis' : 'manual',
                                        'periode' =>
                                            $schedule->tgl_buka->format('d M Y') .
                                            ' - ' .
                                            $schedule->tgl_tutup->format('d M Y'),
                                        'is_current' => $now->between($schedule->tgl_buka, $schedule->tgl_tutup),
                                        'updated_at' => $schedule->updated_at->format('Y-m-d H:i:s'),
                                    ]
                                    : null,
                                'all_schedules' => \App\Models\JadwalPendaftaran::where('skema', 'gratis')
                                    ->get()
                                    ->map(function ($item) use ($now) {
                                        return [
                                            'id' => $item->id,
                                            'nama' => $item->nama_jadwal,
                                            'status' => $item->isActive(),
                                            'mode' => is_null($item->status_manual) ? 'otomatis' : 'manual',
                                            'periode' =>
                                                $item->tgl_buka->format('d M Y') .
                                                ' - ' .
                                                $item->tgl_tutup->format('d M Y'),
                                            'is_current' => $now->between($item->tgl_buka, $item->tgl_tutup),
                                            'updated_at' => $item->updated_at->format('Y-m-d H:i:s'),
                                        ];
                                    }),
                            ];
                        } else {
                            $jadwalAktif = true;
                            $debugInfo = null;
                        }
                    @endphp
                    <div class="col-md-6 col-lg-4 mb-5">
                        {{-- @if ($isGratis && $debugInfo)
                            <!-- Debug info - hapus setelah fix -->
                            <div class="bg-yellow-100 p-2 mb-2 text-xs">
                                <pre>{{ json_encode($debugInfo, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        @endif --}}

                        <a href="{{ $jadwalAktif ? ($item->link ?: route('formpendaftaran')) : 'javascript:void(0)' }}"
                            onclick="{{ $jadwalAktif ? '' : 'showClosedAlert(event)' }}"
                            class="portfolio-item mx-auto d-block position-relative {{ $jadwalAktif ? '' : 'opacity-50 cursor-not-allowed' }}"
                            target="{{ $item->link ? '_blank' : '_self' }}">

                            @if ($isGratis && !$jadwalAktif)
                                <span
                                    class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 small rounded-end z-10">
                                    {{ __('Ditutup') }}
                                </span>
                            @endif

                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>

                            <img class="img-fluid" src="{{ asset('uploads/' . $item->thumbnail) }}"
                                alt="..." />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- Jadwal Section - Modified to match guest view but with buttons -->
    <section class="page-section bg-primary text-white mb-0" id="jadwal">
        <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-white mb-4">
                Jadwal
            </h2>

            <!-- Tombol Navigasi -->
            <div class="text-center mb-4">
                <button type="button" class="btn btn-outline-light mx-2 active" data-target="jadwal_pendaftaran">
                    {{ __('messages.registration') }}
                </button>
                <button type="button" class="btn btn-outline-light mx-2" data-target="ujian">
                    {{ __('messages.exam') }}
                </button>
                <button type="button" class="btn btn-outline-light mx-2" data-target="pengambilan">
                    {{ __('messages.certificate') }}
                </button>
            </div>

            <!-- Jadwal Pendaftaran TOEIC Section -->
            <div id="jadwal_pendaftaran" class="category-table fade show">
                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover bg-white">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">Skema</th>
                                    <th class="text-center">Periode Pendaftaran</th>
                                    <th class="text-center">Kuota</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jadwalPendaftaran as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $item->skema == 'gratis' ? 'TOEIC Gratis' : 'TOEIC Berbayar' }}
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->tgl_buka)->translatedFormat('d F Y') }} -
                                            {{ \Carbon\Carbon::parse($item->tgl_tutup)->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge rounded-pill {{ $item->kuota > 0 ? 'bg-success' : 'bg-danger' }} ">
                                                {{ $item->kuota }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            {{ $item->keterangan }}
                                            @if ($item->jadwalPelaksanaans->count() > 0)
                                                <button class="btn btn-sm btn-outline-info mt-1"
                                                    onclick="showScheduleModal({{ $item->id }}, '{{ $item->skema == 'gratis' ? 'TOEIC Gratis' : 'TOEIC Berbayar' }}')">
                                                    <i class="fas fa-calendar-alt me-1"></i> Lihat Jadwal
                                                </button>
                                            @else
                                                <span class="text-muted">Akan diinfokan lebih lanjut</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada jadwal pendaftaran tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Detail Jadwal -->
            <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="scheduleModalLabel">Detail Jadwal Pelaksanaan</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center">Hari/Tanggal</th>
                                            <th class="text-center">Sesi</th>
                                            <th class="text-center">Jam</th>
                                            <th class="text-center">Lokasi/Platform</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalScheduleBody">
                                        <!-- Data akan diisi oleh JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Ujian -->
            <div id="ujian" class="category-table fade" style="display: none;">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Jadwal Ujian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ujian as $item)
                                <tr>
                                    <td class="text-center">
                                        @if ($item->jadwal_ujian)
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#imageModal{{ $loop->index }}">
                                                Lihat Jadwal Ujian
                                            </button>
                                        @else
                                            Tidak ada jadwal
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center">Tidak ada jadwal ujian yang diupload</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal untuk Pop-up Gambar -->
            @foreach ($ujian as $item)
                @if ($item->jadwal_ujian)
                    <div class="modal fade" id="imageModal{{ $loop->index }}" tabindex="-1" role="dialog"
                        aria-labelledby="imageModalLabel{{ $loop->index }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title" id="imageModalLabel{{ $loop->index }}">Jadwal Ujian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $item->jadwal_ujian) }}"
                                        alt="Thumbnail Jadwal Ujian" class="img-fluid rounded"
                                        style="max-height: 80vh;">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Pastikan Bootstrap JS ter-load -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


            <!-- Data Pengambilan Sertifikat -->
            <div id="pengambilan" class="category-table fade" style="display: none;">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Tempat</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengambilan as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('j F Y') }}</td>
                                    <td>{{ $item->waktu }}</td>
                                    <td>{{ $item->tempat }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada jadwal pengambilan sertifikat
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Tambahan form di bawah tabel -->
                <div class="mt-4">

                    <div class="info-item mb-2">
                        <span class="info-label">Pengambilan Sertifikat</span>
                        <span class="info-value">{{ $mahasiswa->pengambilan_sertifikat ?? '-' }}</span>
                    </div>
                    <!--<form action="{{ route('mahasiswa.update-pengambilan', $mahasiswa->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <label for="image" class="form-label">Upload Gambar Sertifikat</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>


                        <button type="submit" class="btn btn-success w-100 mt-2">
                            <i class="bi bi-check-circle me-1"></i> Tandai Sebagai Sudah Diambil
                        </button>
                    </form>
                </div>
            </div>-->

                </div>
    </section>

    <!-- CSS Transisi -->
    <style>
        .fade {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .fade.show {
            opacity: 1;
        }

        /* Style untuk tabel di modal */
        #scheduleModal .table {
            margin-bottom: 0;
        }

        #scheduleModal .table th {
            background-color: #2c3e50;
            color: white;
        }

        #scheduleModal .table td {
            vertical-align: middle;
        }

        .modal-backdrop.fade {
            transition-duration: 0.2s;
            opacity: 0;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
            opacity: 1;
        }

        /* Efek hover pada baris tabel */
        #modalScheduleBody tr:hover {
            background-color: rgba(26, 188, 156, 0.1);
        }

        .modal-backdrop {
            transition: opacity 0.2s ease-out !important;
            z-index: 1040 !important;
        }

        .modal-backdrop.show {
            background-color: rgba(0, 0, 0, 0.3);
            transition-duration: 0.0s;
        }

        /* Menjaga latar belakang halaman tetap terlihat */
        body.modal-open {
            background-color: #f8f9fa;
        }
    </style>

    <!-- JavaScript Transisi -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll(".btn[data-target]");
            const tables = document.querySelectorAll(".category-table");

            // Tampilkan jadwal pendaftaran secara default
            document.getElementById('jadwal_pendaftaran').style.display = 'block';
            document.getElementById('jadwal_pendaftaran').classList.add('show');

            buttons.forEach(button => {
                button.addEventListener("click", function() {
                    // Toggle button active state
                    buttons.forEach(btn => btn.classList.remove("active"));
                    this.classList.add("active");

                    const targetId = this.getAttribute("data-target");

                    // Hide all tables with fade-out
                    tables.forEach(table => {
                        table.classList.remove("show");
                        setTimeout(() => {
                            table.style.display = "none";
                        }, 300);
                    });

                    // Show selected table with fade-in
                    const targetTable = document.getElementById(targetId);
                    if (targetTable) {
                        setTimeout(() => {
                            targetTable.style.display = "block";
                            setTimeout(() => {
                                targetTable.classList.add("show");
                            }, 10);
                        }, 300);
                    }
                });
            });
        });

        function showScheduleModal(id, skema) {
            // Implementasi fungsi ini sesuai kebutuhan Anda
            console.log("Show schedule for ID:", id, "Skema:", skema);
            // Anda perlu mengisi implementasi untuk menampilkan modal dengan jadwal yang sesuai
        }
    </script>
    <!-- Hasil Section -->
    <section class="page-section" id="hasil">
        <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-4">
                {{ __('messages.result') }}
            </h2>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>

            <!-- Form Cari Hasil Ujian -->
            <div class="row justify-content-center mb-5">
                <div class="col-md-8">
                    <form action="{{ route('hasil.cari') }}" method="GET" class="d-flex">
                        <select name="tanggal" id="tanggal" class="form-select me-2" required>Add commentMore
                            actions
                            <option value="" disabled selected>Pilih tanggal ujian...</option>
                            @foreach ($tanggalList as $tanggal)
                                <option value="{{ $tanggal }}">
                                    {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>

                        <select name="sesi" id="sesi" class="form-select me-2" required>
                            <option value="">Pilih sesi...</option>
                        </select>

                        <button type="submit" class="btn btn-success">Cari</button>
                    </form>
                    <script>
                        document.getElementById('tanggal').addEventListener('change', function() {
                            let tanggal = this.value;
                            let sesiSelect = document.getElementById('sesi');
                            sesiSelect.innerHTML = '<option>Memuat sesi...</option>';

                            fetch(`/get-sesi/${tanggal}`)
                                .then(response => response.json())
                                .then(data => {
                                    sesiSelect.innerHTML = '<option value="">Pilih sesi...</option>';
                                    data.forEach(sesi => {
                                        sesiSelect.innerHTML += `<option value="${sesi}">${sesi}</option>`;
                                    });
                                });
                        });
                    </script>
                    </form>
                </div>
            </div>

            <!-- Tabel Hasil TOEIC -->
            <div class="table-responsive">
                @if ($hasilToeic->isNotEmpty())
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Listening</th>
                                <th>Reading</th>
                                <th>Total</th>
                                <th>Tanggal Tes</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasilToeic as $hasil)
                                <tr>
                                    <td>{{ $hasil->name }}</td>
                                    <td>{{ $hasil->nim }}</td>
                                    <td>{{ $hasil->l }}</td>
                                    <td>{{ $hasil->r }}</td>
                                    <td>{{ $hasil->tot }}</td>
                                    <td>{{ date('d-m-Y', strtotime($hasil->test_date)) }}</td>
                                    <td>{{ $hasil->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info text-center">
                        Data hasil TOEIC tidak ditemukan. Silakan cari dengan tanggal dan sesi ujian.
                    </div>
                @endif
            </div>
            <!-- Judul Section -->
            <h2 class="mt-5 mb-4 text-center fw-bold">
                <i class="bi bi-file-earmark-text"></i> PENGAJUAN SK TOEIC
            </h2>

            <div class="container">
                <!-- Tampilkan form hanya jika belum ada pengajuan atau status ditolak -->
                @if (!$konfirmasiSkTerakhir || $konfirmasiSkTerakhir->status === 'ditolak')
                    <div class="card shadow-sm mb-4" id="infoAwal">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">
                                <i class="bi bi-info-circle-fill text-primary"></i> Informasi Pengajuan SK TOEIC
                            </h5>
                            <div class="alert alert-info mt-3">
                                <p class="mb-0">
                                    Mahasiswa yang telah mengikuti ujian TOEIC sebanyak 2 kali dengan score di bawah
                                    500, diperkenankan mengajukan SK TOEIC sebagai pengganti syarat pengambilan ijazah.
                                </p>
                            </div>

                            <div class="alert alert-warning small">
                                <strong><i class="bi bi-exclamation-triangle"></i> Persyaratan:</strong>
                                <ul class="mt-2 mb-0">
                                    <li>Memiliki 2 sertifikat TOEIC resmi</li>
                                    <li>Score kedua sertifikat di bawah 500</li>
                                    <li>Masa berlaku sertifikat masih valid</li>
                                </ul>
                            </div>

                            <button id="btnAjukan" class="btn btn-primary w-100 mt-3">
                                <i class="bi bi-send"></i> Ajukan SK TOEIC
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Form Section -->
                <div id="formSection"
                    style="display: {{ $konfirmasiSkTerakhir && $konfirmasiSkTerakhir->status !== 'ditolak' ? 'block' : 'none' }};">
                    <div class="row">
                        {{-- Form Upload --}}
                        <div class="col-md-6">
                            @if (session('success'))
                                <div class="alert alert-success text-center animate__animated animate__fadeInDown">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @php
                                $status = $konfirmasiSkTerakhir->status ?? null;
                                $isAktif = !$status || $status === 'ditolak';

                                $statusBadge = match ($status) {
                                    'disetujui' => '<span class="badge bg-success">Disetujui</span>',
                                    'pending' => '<span class="badge bg-warning text-dark">Menunggu</span>',
                                    'ditolak' => '<span class="badge bg-danger">Ditolak</span>',
                                    default => '<span class="badge bg-secondary">Belum Ada</span>',
                                };
                            @endphp

                            <form method="POST" action="{{ route('konfirmasi-sk.store') }}"
                                enctype="multipart/form-data" class="card p-4 shadow-sm border-primary"
                                id="uploadForm">
                                @csrf

                                <div class="mb-3">
                                    <label for="sertifikat_1" class="form-label">Sertifikat 1 (PDF, maks. 2MB)</label>
                                    <input type="file"
                                        class="form-control @error('sertifikat_1') is-invalid @enderror"
                                        id="sertifikat_1" name="sertifikat_1" accept="application/pdf"
                                        {{ $isAktif ? '' : 'disabled' }}>

                                    <!-- Client-side error -->
                                    <div id="errorSertifikat1" class="invalid-feedback"></div>

                                    <!-- Server-side error -->
                                    @error('sertifikat_1')
                                        <div class="alert alert-danger mt-2 small p-2">
                                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sertifikat_2" class="form-label">Sertifikat 2 (PDF, maks. 2MB)</label>
                                    <input type="file"
                                        class="form-control @error('sertifikat_2') is-invalid @enderror"
                                        id="sertifikat_2" name="sertifikat_2" accept="application/pdf"
                                        {{ $isAktif ? '' : 'disabled' }}>

                                    <!-- Client-side error -->
                                    <div id="errorSertifikat2" class="invalid-feedback"></div>

                                    <!-- Server-side error -->
                                    @error('sertifikat_2')
                                        <div class="alert alert-danger mt-2 small p-2">
                                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-secondary w-100" id="submitBtn" disabled>
                                    Kirim
                                </button>

                                <div id="fileValidation" class="text-muted small mt-2" style="display:none;">
                                    Harap unggah kedua sertifikat untuk melanjutkan
                                </div>

                                @unless ($isAktif)
                                    <p class="text-muted mt-2 small text-center">
                                        Tidak bisa upload ulang karena status: {!! $statusBadge !!}
                                    </p>
                                @endunless
                            </form>
                        </div>

                        {{-- Status Info --}}
                        <div class="col-md-6">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <!-- Di dalam card Status Pengajuan Terakhir -->
                                    @if ($konfirmasiSkTerakhir)
                                        @php
                                            $borderClass = match ($status) {
                                                'disetujui' => 'border-start border-5 border-success',
                                                'ditolak' => 'border-start border-5 border-danger',
                                                'pending' => 'border-start border-5 border-warning',
                                                default => 'border-start border-5 border-secondary',
                                            };
                                        @endphp

                                        <div class="{{ $borderClass }} p-3 rounded-end">
                                            <h5 class="card-title fw-semibold mb-3">
                                                <i class="bi bi-info-circle"></i>
                                                Status Pengajuan Terakhir
                                            </h5>

                                            <div
                                                class="alert alert-{{ match ($status) {
                                                    'disetujui' => 'success',
                                                    'ditolak' => 'danger',
                                                    'pending' => 'warning',
                                                    default => 'secondary',
                                                } }}">
                                                Status: {!! $statusBadge !!}
                                                @if ($konfirmasiSkTerakhir->created_at)
                                                    <br>
                                                    <small class="text-muted">
                                                        Diajukan pada:
                                                        {{ $konfirmasiSkTerakhir->created_at->format('d M Y H:i') }}
                                                    </small>
                                                @endif
                                            </div>

                                            <!-- CATATAN PENOLAKAN -->
                                            @if ($status === 'ditolak' && $konfirmasiSkTerakhir->catatan)
                                                <div class="alert alert-danger">
                                                    <h6 class="fw-semibold"><i class="bi bi-exclamation-triangle"></i>
                                                        Alasan Penolakan:</h6>
                                                    <div class="mt-2 p-3 bg-white rounded border border-danger">
                                                        {!! nl2br(e($konfirmasiSkTerakhir->catatan)) !!}
                                                    </div>
                                                    <small class="text-muted d-block mt-2">
                                                        Ditolak pada:
                                                        {{ $konfirmasiSkTerakhir->updated_at->format('d M Y H:i') }}
                                                    </small>
                                                </div>
                                            @endif
                                            <!-- END OF CATATAN PENOLAKAN -->

                                            <div class="mb-3">
                                                <h6><i class="bi bi-file-earmark-pdf"></i> Dokumen Terlampir:</h6>
                                                <ul class="list-group list-group-flush">
                                                    @if ($konfirmasiSkTerakhir->sertifikat_1)
                                                        <li class="list-group-item">
                                                            <a href="{{ asset('storage/' . $konfirmasiSkTerakhir->sertifikat_1) }}"
                                                                target="_blank" class="text-decoration-none">
                                                                <i class="bi bi-filetype-pdf text-danger"></i>
                                                                Sertifikat 1
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if ($konfirmasiSkTerakhir->sertifikat_2)
                                                        <li class="list-group-item">
                                                            <a href="{{ asset('storage/' . $konfirmasiSkTerakhir->sertifikat_2) }}"
                                                                target="_blank" class="text-decoration-none">
                                                                <i class="bi bi-filetype-pdf text-danger"></i>
                                                                Sertifikat 2
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>

                                            @if ($konfirmasiSkTerakhir->file_sk && $status === 'disetujui')
                                                <div class="d-grid">
                                                    <a href="{{ route('mahasiswa.downloadSk', $konfirmasiSkTerakhir->id) }}"
                                                        class="btn btn-success">
                                                        <i class="bi bi-download"></i> Unduh SK Disetujui
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                </div>
                            @else
                                <div class="border-start border-5 border-primary p-3 rounded-end">
                                    <h5 class="card-title fw-semibold mb-3">
                                        <i class="bi bi-exclamation-circle text-primary"></i>
                                        Syarat dan Ketentuan Pengajuan SK TOEIC
                                    </h5>

                                    <div class="alert alert-info">
                                        <strong>Sebelum mengajukan, pastikan:</strong>
                                        <ol class="mt-2 mb-0">
                                            <li>Sertifikat TOEIC masih berlaku</li>
                                            <li>File yang diupload format PDF</li>
                                            <li>Maksimal ukuran file 2MB per sertifikat</li>
                                            <li>Hanya bisa mengajukan sekali dalam satu periode</li>
                                        </ol>
                                    </div>

                                    <div class="alert alert-warning small">
                                        <i class="bi bi-clock-history"></i> <strong>Proses verifikasi:</strong>
                                        <ul class="mt-2 mb-0">
                                            <li>Verifikasi membutuhkan waktu 3-5 hari kerja</li>
                                            <li>Anda akan mendapatkan notifikasi ketika status berubah</li>
                                            <li>Jika ditolak, Anda bisa mengajukan ulang</li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        // Script untuk dropdown tanggal dan sesi
        document.getElementById('tanggal').addEventListener('change', function() {
            let tanggal = this.value;
            let sesiSelect = document.getElementById('sesi');
            sesiSelect.innerHTML = '<option>Memuat sesi...</option>';

            fetch(`/get-sesi/${tanggal}`)
                .then(response => response.json())
                .then(data => {
                    sesiSelect.innerHTML = '<option value="">Pilih sesi...</option>';
                    data.forEach(sesi => {
                        sesiSelect.innerHTML += `<option value="${sesi}">${sesi}</option>`;
                    });
                });
        });

        // Script untuk toggle kategori jadwal
        function showCategory(id) {
            document.querySelectorAll('.category-table').forEach(div => div.style.display = 'none');
            const selected = document.getElementById(id);
            if (selected) selected.style.display = 'block';
        }

        document.querySelectorAll('button[data-target]').forEach(button => {
            button.addEventListener('click', () => {
                const target = button.getAttribute('data-target');
                showCategory(target);
                document.querySelectorAll('button[data-target]').forEach(btn => btn.classList.remove(
                    'active'));
                button.classList.add('active');
            });
        });

        // Script untuk smooth scroll dan active nav
        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section[id]');

            function handleNavClick(event) {
                event.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - 70,
                        behavior: 'smooth'
                    });
                    history.replaceState(null, null, '#' + targetId);
                    updateActiveNav(targetId);
                }
            }

            function updateActiveNav(targetId) {
                navLinks.forEach(nav => {
                    const navHref = nav.getAttribute('href').substring(1);
                    nav.classList.toggle('active', navHref === targetId);
                });
            }

            function handleScroll() {
                let currentSection = '';
                const scrollPosition = window.scrollY + 100;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionBottom = sectionTop + section.clientHeight;

                    if (scrollPosition >= sectionTop - 100 && scrollPosition < sectionBottom - 100) {
                        currentSection = section.id;
                    }
                });

                if (currentSection) {
                    updateActiveNav(currentSection);
                }
            }

            function throttle(func, limit = 100) {
                let lastFunc;
                let lastRan;
                return function() {
                    const context = this;
                    const args = arguments;
                    if (!lastRan) {
                        func.apply(context, args);
                        lastRan = Date.now();
                    } else {
                        clearTimeout(lastFunc);
                        lastFunc = setTimeout(function() {
                            if ((Date.now() - lastRan) >= limit) {
                                func.apply(context, args);
                                lastRan = Date.now();
                            }
                        }, limit - (Date.now() - lastRan));
                    }
                }

                navLinks.forEach(link => {
                    link.addEventListener('click', handleNavClick);
                });

                window.addEventListener('scroll', throttle(handleScroll));

                // Inisialisasi halaman pertama kali
                if (window.location.hash) {
                    const hash = window.location.hash.substring(1);
                    const targetSection = document.getElementById(hash);
                    if (targetSection) {
                        setTimeout(() => {
                            window.scrollTo({
                                top: targetSection.offsetTop - 70,
                                behavior: 'auto'
                            });
                            updateActiveNav(hash);
                        }, 100);
                    }
                } else {
                    updateActiveNav('beranda');
                }
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll(".btn[data-target]");
            const tables = document.querySelectorAll(".category-table");

            buttons.forEach(button => {
                button.addEventListener("click", function() {
                    // Toggle button active state
                    buttons.forEach(btn => btn.classList.remove("active"));
                    this.classList.add("active");

                    const targetId = this.getAttribute("data-target");

                    // Hide all tables with fade-out
                    tables.forEach(table => {
                        table.classList.remove("show");
                        setTimeout(() => {
                            table.style.display = "none";
                        }, 300);
                    });

                    // Show selected table with fade-in
                    const targetTable = document.getElementById(targetId);
                    if (targetTable) {
                        setTimeout(() => {
                            targetTable.style.display = "block";
                            setTimeout(() => {
                                targetTable.classList.add("show");
                            }, 10);
                        }, 300);
                    }
                });
            });
        });
    </script>

    <!-- Footer-->
    <footer class="footer text-center" id="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">{{ __('messages.location') }}</h4>
                    <p class="lead mb-0">{{ $location }}</p>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">{{ __('messages.about') }}</h4>
                    <div class="d-flex justify-content-center">
                        @if ($instagram)
                            <a class="btn btn-outline-light btn-social mx-1" href="{{ $instagram }}"
                                target="_blank">
                                <i class="fab fa-fw fa-instagram"></i>
                            </a>
                        @endif
                        @if ($email)
                            <a class="btn btn-outline-light btn-social mx-1" href="mailto:{{ $email }}"
                                target="_blank">
                                <i class="fas fa-fw fa-envelope"></i>
                            </a>
                        @endif
                        @if ($whatsapp)
                            <a class="btn btn-outline-light btn-social mx-1" href="{{ $whatsapp }}"
                                target="_blank">
                                <i class="fab fa-fw fa-whatsapp"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">{{ __('messages.issue') }}</h4>
                    <p class="lead mb-0">{{ $site_description }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; {{ $site_name }} 2025</small></div>
    </div>

    <!-- pendaftaran Modals-->
    @php $i = 1; @endphp
    @foreach ($pendaftaran as $item)
        <div class="portfolio-modal modal fade" id="portfolioModal{{ $i }}" tabindex="-1"
            aria-labelledby="portfolioModal{{ $i }}Label" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">
                                        {{ $item->title }}
                                    </h2>
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <img class="img-fluid rounded mb-5"
                                        src="{{ asset('uploads/' . $item->thumbnail) }}" alt="..." />
                                    {!! $item->content !!}
                                    <div class="mt-4">
                                        @if ($item->link)
                                            <a href="{{ $item->link }}" class="btn btn-primary btn-lg"
                                                target="_blank">
                                                {{ __('messages.regis') }}
                                            </a>
                                        @else
                                            <a href="{{ route('formpendaftaran') }}" class="btn btn-primary btn-lg">
                                                Daftar Sekarang
                                            </a>
                                        @endif
                                        <button class="btn btn-outline-secondary btn-lg ms-2" data-bs-dismiss="modal">
                                            <i class="fas fa-xmark fa-fw"></i>
                                            {{ __('messages.close') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php $i++; @endphp
    @endforeach

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- SB Forms JS-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script>
        function showClosedAlert(event) {
            event.preventDefault(); // Biar gak jalan ke href-nya
            Swal.fire({
                icon: 'info',
                title: 'Pendaftaran Ditutup',
                text: 'Maaf, pendaftaran gratis sudah ditutup untuk saat ini.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Mengerti'
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('uploadForm');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Cek apakah form aktif (bisa di-submit)
                const submitButton = form.querySelector('button[type="submit"]');
                if (submitButton.disabled) {
                    return;
                }

                Swal.fire({
                    title: 'Yakin ingin mengunggah?',
                    text: "Pastikan file sertifikat sudah benar.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, unggah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form secara manual
                        form.submit();
                    }
                });
            });
        });
    </script>
    <!-- JavaScript -->
    <script>
        // Fungsi untuk menampilkan modal jadwal
        function showScheduleModal(jadwalId, skema) {
            // Set judul modal
            document.getElementById('scheduleModalLabel').textContent = `Jadwal Pelaksanaan ${skema}`;

            // Kosongkan body modal
            const modalBody = document.getElementById('modalScheduleBody');
            modalBody.innerHTML = '';

            // Cari data jadwal yang sesuai
            const jadwal = {!! $jadwalPendaftaran->toJson() !!}.find(item => item.id === jadwalId);

            if (jadwal && jadwal.jadwal_pelaksanaans && jadwal.jadwal_pelaksanaans.length > 0) {
                // Urutkan jadwal berdasarkan tanggal dan sesi
                const sortedJadwal = jadwal.jadwal_pelaksanaans.sort((a, b) => {
                    return new Date(a.tanggal) - new Date(b.tanggal) || a.sesi.localeCompare(b.sesi);
                });

                // Isi data ke dalam modal
                sortedJadwal.forEach(pelaksanaan => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${formatTanggal(pelaksanaan.tanggal)}</td>
                    <td class="text-center">${pelaksanaan.sesi}</td>
                    <td class="text-center">${formatJam(pelaksanaan.jam_mulai)} - ${formatJam(pelaksanaan.jam_selesai)}</td>
                    <td class="text-center">${pelaksanaan.lokasi_platform}</td>
                `;
                    modalBody.appendChild(row);
                });
            } else {
                modalBody.innerHTML =
                    '<tr><td colspan="4" class="text-center text-muted">Tidak ada jadwal pelaksanaan tersedia</td></tr>';
            }

            // Tampilkan modal
            const modal = new bootstrap.Modal(document.getElementById('scheduleModal'));
            modal.show();
        }

        // Fungsi helper untuk format tanggal
        function formatTanggal(tanggal) {
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return new Date(tanggal).toLocaleDateString('id-ID', options);
        }

        // Fungsi helper untuk format jam
        function formatJam(jam) {
            return jam.substring(0, 5); // Ambil hanya HH:MM
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Toggle antara info awal dan form
            const btnAjukan = document.getElementById('btnAjukan');
            const infoAwal = document.getElementById('infoAwal');
            const formSection = document.getElementById('formSection');

            if (btnAjukan) {
                btnAjukan.addEventListener('click', function() {
                    infoAwal.style.display = 'none';
                    formSection.style.display = 'block';
                });
            }

            // 2. Validasi file upload
            const fileInput1 = document.getElementById('sertifikat_1');
            const fileInput2 = document.getElementById('sertifikat_2');
            const submitBtn = document.getElementById('submitBtn');
            const validationMsg = document.getElementById('fileValidation');

            // Fungsi validasi ukuran file (tambahan baru)
            function validateFileSize(fileInput) {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const maxSize = 2 * 1024 * 1024; // 2MB dalam bytes
                    if (file.size > maxSize) {
                        alert(`File ${file.name} melebihi 2MB!`);
                        fileInput.value = ''; // Reset input
                        return false;
                    }
                }
                return true;
            }

            // Fungsi utama pengecekan
            function checkFiles() {
                // Validasi ukuran file terlebih dahulu
                const valid1 = validateFileSize(fileInput1);
                const valid2 = validateFileSize(fileInput2);

                if (!valid1 || !valid2) {
                    submitBtn.disabled = true;
                    submitBtn.classList.remove('btn-primary');
                    submitBtn.classList.add('btn-secondary');
                    return;
                }

                // Lanjutkan pengecekan normal
                const bothFilesSelected = fileInput1.files.length > 0 && fileInput2.files.length > 0;

                if (bothFilesSelected) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('btn-secondary');
                    submitBtn.classList.add('btn-primary');
                    validationMsg.style.display = 'none';
                } else {
                    submitBtn.disabled = true;
                    submitBtn.classList.remove('btn-primary');
                    submitBtn.classList.add('btn-secondary');
                }

                if (fileInput1.files.length > 0 || fileInput2.files.length > 0) {
                    validationMsg.style.display = 'block';
                } else {
                    validationMsg.style.display = 'none';
                }
            }

            // Event listeners
            fileInput1.addEventListener('change', checkFiles);
            fileInput2.addEventListener('change', checkFiles);
        });
    </script>
</body>

</html>

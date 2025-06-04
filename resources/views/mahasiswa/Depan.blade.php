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
        <div class="container d-flex align-items-center flex-column justify-content-center" style="min-height: 100vh;">
            <div class="d-flex align-items-center mb-5" style="width: 80%; justify-content: flex-start; padding: 30px;">
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
                        $isGratis = Str::contains(Str::lower($item->title), 'gratis');
                    @endphp

                    <div class="col-md-6 col-lg-4 mb-5">
                        <a href="{{ !$isGratis || $pendaftaranAktif ? ($item->link ?: route('formpendaftaran')) : 'javascript:void(0)' }}"
                            onclick="{{ !$isGratis || $pendaftaranAktif ? '' : 'showClosedAlert(event)' }}"
                            class="portfolio-item mx-auto d-block position-relative {{ !$isGratis || $pendaftaranAktif ? '' : 'opacity-50 cursor-not-allowed' }}"
                            target="{{ $item->link ? '_blank' : '_self' }}">

                            @if ($isGratis && !$pendaftaranAktif)
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
    </section>

    <!-- Jadwal Section -->
    <section class="page-section bg-primary text-white mb-0" id="jadwal">
        <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-white mb-4">
                {{ __('messages.schedule') }}
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

            <!-- Konten Kategori -->
            <div class="category-content">
                <!-- Data Pendaftaran -->
                <div id="jadwal_pendaftaran" class="category-table fade show" style="display: block;">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Skema</th>
                                    <th>Periode Pendaftaran</th>
                                    <th>Kuota</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jadwalPendaftaran as $item)
                                    <tr>
                                        <td>{{ ucfirst($item->skema) }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tgl_buka)->translatedFormat('j F Y') }} -
                                            {{ \Carbon\Carbon::parse($item->tgl_tutup)->translatedFormat('j F Y') }}
                                            <br>
                                            <small class="text-muted">{{ $item->periode_pendaftaran }}</small>
                                        </td>
                                        <td>
                                            <span class="badge {{ $item->kuota > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $item->kuota > 0 ? number_format($item->kuota, 0, ',', '.') . ' Kuota' : 'Penuh' }}
                                            </span>
                                        </td>
                                        <td>{{ $item->keterangan }}</td>
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

                <!-- Data Ujian -->
                <div id="ujian" class="category-table fade" style="display: none;">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Hari, Tanggal</th>
                                    <th>Jam</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ujian as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, j F Y') }}
                                        </td>
                                        <td>{{ $item->jam }}</td>
                                        <td>{{ $item->kampus_cabang }}</td>
                                        <td>{{ $item->jurusan }} - {{ $item->program_studi }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada jadwal ujian saat ini</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

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
                                        <td>{{ $item->lokasi }}</td>
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
                </div>
            </div>
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
    </style>

    <!-- JavaScript Transisi -->
    <script>
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

    <!-- Data Pengambilan Sertifikat -->
    <div id="pengambilan" class="category-table" style="display:none;">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Hari, Tanggal</th>
                        <th>Jam</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengambilan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->hari_tanggal)->translatedFormat('l, j F Y') }}</td>
                            <td>{{ $item->waktu }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->keterangan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada jadwal pengambilan sertifikat saat ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
    </section>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

</body>

</html>

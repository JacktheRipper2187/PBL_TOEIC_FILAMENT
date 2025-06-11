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
    // $ujian = get_JadwalUjian_value();
    $pengambilan = get_JadwalSertifikat_value();
    $jadwalPendaftaran = get_JadwalPendaftaran_value();
    // Contoh cara memanggil yang benar
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
    <style>
        body {
            padding-top: 56px;
            /* Sesuaikan tinggi navbar (biasanya 56px-70px) */
        }

        /* Jika ingin header punya jarak lebih */
        .masthead {
            padding-top: 100px;
            /* Jarak tambahan setelah navbar */
        }

        /* CSS untuk date-box yang fixed */
        .date-box {
            background-color: #1abc9c;
            /* Warna hijau */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            /* Ukuran fixed */
            height: 150px;
            /* Ukuran fixed */
            margin-right: 40px;
            flex-shrink: 0;
            /* Agar tidak menyusut */
        }

        /* Style untuk tabel */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            min-width: 800px;
        }

        .table th {
            background-color: #2c3e50;
            color: white;
            font-weight: 600;
            padding: 12px;
        }

        .table td {
            padding: 10px;
            vertical-align: middle;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        /* Style untuk detail jadwal */
        #schedule-detail {
            border: 2px solid #3498db;
            background-color: #f8f9fa;
        }

        #schedule-title {
            color: #2c3e50;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Badge kuota */
        .badge {
            font-size: 0.85rem;
            padding: 5px 10px;
            min-width: 60px;
        }

        /* CSS untuk teks tanggal di dalam box */
        #current-date {
            font-size: 1.2rem;
            /* Ukuran font yang sesuai */
            font-weight: 600;
            text-align: center;
            padding: 10px;
            /* Padding untuk teks */
            color: white;
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

            <!-- Navbar Menu -->
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
                            href="#jadwal pendaftaran">{{ __('messages.schedule') }}</a></li>

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

                    <!-- Login Button - Positioned at far right -->
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}" class="btn btn-primary px-3 py-2 rounded-pill">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead -->
    <header class="masthead text-white text-center" id="beranda"
        style="background: url('assets/img/graha.png'); background-size: cover; background-position: center; height: 100vh;">
        <div class="container d-flex align-items-center flex-column justify-content-center" style="min-height: 100vh;">
            <!-- Tanggal & Waktu dengan Tulisan di Sebelah Kanan -->
            <div class="d-flex align-items-center mb-5" style="width: 80%; justify-content: flex-start; padding: 30px;">
                <!-- Tanggal (Background Bulat Utuh) -->
                <div class="date-box">
                    <h3 id="current-date" class="mb-0"></h3>
                </div>
                <!-- Teks Sebelah Kanan -->
                <div>
                    <div style="text-align: left; width: 100%;">
                        <h2 class="masthead-subheading mb-2.5" style="font-size: 1rem; font-weight: 600;">
                            {{ $section['Beranda']->title }}</h2>
                        <h1 class="masthead-title mb-4" style="font-size: 3rem; font-weight: 800; letter-spacing: 3px;">
                            {{ $section['Beranda']->thumbnail }}
                        </h1>
                        <!-- Deskripsi -->
                        <div class="masthead-description lead"
                            style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem;">
                            {!! $section['Beranda']->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Script untuk Tanggal & Waktu -->
    <script>
        const locale = "{{ session('locale', 'id') }}"; // Default ke 'id' (Indonesia)
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

            // Format tanggal sesuai locale
            document.getElementById('current-date').textContent =
                now.toLocaleDateString(locale, options).replace('pukul', '').trim() + ' WIB';
        }

        // Update setiap menit (60000ms)
        updateCurrentDate();
        setInterval(updateCurrentDate, 60000);
    </script>

    <!-- Syarat dan Ketentuan Section-->
    <section class="page-section" id="syarat">
        <div class="container">
            <!-- Section Heading -->
            <h2 class="text-center text-uppercase text-secondary mb-4">{{ $section['SyaratKetentuan']->thumbnail }}
            </h2>

            <!-- Divider -->
            <div class="divider-custom divider-dark mb-5">
                <div class="divider-custom-line"></div>
            </div>

            <!-- Content -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Menggunakan Div yang Diatur dengan CSS untuk Kotak -->
                    <div class="syarat-box">
                        <!-- Menggunakan ul/ol untuk daftar syarat -->
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
                {{ __('messages.pendaftar') }}</h2>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="row justify-content-center">
                @foreach ($pendaftaran as $index => $item)
                    <div class="col-md-6 col-lg-4 mb-5">
                        <a href="{{ $index == 0 ? 'https://www.itc-indonesia.com' : route('login') }}"
                            class="portfolio-item mx-auto d-block" target="{{ $index == 0 ? '_blank' : '_self' }}">
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
    
<!-- Jadwal Pendaftaran TOEIC Section -->
<section class="page-section bg-primary text-white mb-0" id="jadwal pendaftaran">
    <div class="container">
        <!-- Section Heading -->
        <h2 class="page-section-heading text-center text-uppercase text-white mb-4">
            Jadwal Pendaftaran TOEIC
        </h2>

        <!-- Divider -->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <!-- Jadwal Table -->
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
                                <span class="badge rounded-pill {{ $item->kuota > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->kuota }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{ $item->keterangan }}
                                @if($item->jadwalPelaksanaans->count() > 0)
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
                            <td colspan="4" class="text-center">Tidak ada jadwal pendaftaran tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal untuk Detail Jadwal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="scheduleModalLabel">Detail Jadwal Pelaksanaan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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

<style>
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
    
    /* Animasi modal */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out, opacity 0.3s ease;
        transform: translateY(-20px);
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
</style>

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
            modalBody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">Tidak ada jadwal pelaksanaan tersedia</td></tr>';
        }
        
        // Tampilkan modal
        const modal = new bootstrap.Modal(document.getElementById('scheduleModal'));
        modal.show();
    }
    
    // Fungsi helper untuk format tanggal
    function formatTanggal(tanggal) {
        const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
        return new Date(tanggal).toLocaleDateString('id-ID', options);
    }
    
    // Fungsi helper untuk format jam
    function formatJam(jam) {
        return jam.substring(0, 5); // Ambil hanya HH:MM
    }
</script>
    <!-- Footer-->
    <footer class="footer text-center" id="profile">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">{{ __('messages.location') }}</h4>
                    <p class="lead mb-0">
                        {{ $location }}
                    </p>
                </div>
                <!-- Footer Social Icons-->
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

                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">{{ __('messages.issue') }}</h4>
                    <p class="lead mb-0">
                        {{ $site_description }}
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; {{ $site_name }} 2025</small></div>
    </div>

    <!-- pendaftaran Modals-->
    @php
        $i = 1;
    @endphp
    @foreach ($pendaftaran as $index => $item)
        <!-- pendaftaran Modal {{ $i }}-->
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
                                        {{ $item->title }}</h2>
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <img class="img-fluid rounded mb-5"
                                        src="{{ asset('uploads/' . $item->thumbnail) }}" alt="..." />
                                    {!! $item->content !!}

                                    <div class="mt-4">
                                        <a href="{{ $index == 0 ? 'https://itc-indonesia.com/toeic/' : route('login') }}"
                                            class="btn btn-primary btn-lg"
                                            target="{{ $index == 0 ? '_blank' : '_self' }}">
                                            {{ __('messages.regis') }}
                                        </a>
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
        @php
            $i++;
        @endphp
    @endforeach
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section[id]');

            // Fungsi untuk menangani klik pada nav-link
            function handleNavClick(event) {
                event.preventDefault();

                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - 70, // Sesuaikan dengan tinggi navbar
                        behavior: 'smooth'
                    });

                    history.replaceState(null, null, '#' + targetId);
                    updateActiveNav(targetId);
                }
            }

            // Fungsi untuk mengupdate nav-link aktif
            function updateActiveNav(targetId) {
                navLinks.forEach(nav => {
                    const navHref = nav.getAttribute('href').substring(1);
                    nav.classList.toggle('active', navHref === targetId);
                });
            }

            // Fungsi untuk menangani scroll
            function handleScroll() {
                let currentSection = '';
                const scrollPosition = window.scrollY + 100; // Offset yang lebih kecil

                // Cek khusus untuk beranda (harus di atas semua section lain)
                const berandaSection = document.getElementById('beranda');
                if (berandaSection && scrollPosition < berandaSection.offsetTop + berandaSection.clientHeight -
                    200) {
                    currentSection = 'beranda';
                } else {
                    // Cek section lainnya
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop;
                        const sectionBottom = sectionTop + section.clientHeight;

                        if (scrollPosition >= sectionTop - 100 && scrollPosition < sectionBottom - 100) {
                            currentSection = section.id;
                        }
                    });
                }

                if (currentSection) {
                    updateActiveNav(currentSection);
                }
            }

            // Throttle function untuk optimasi performance
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
                };
            }

            // Tambahkan event listener
            navLinks.forEach(link => {
                link.addEventListener('click', handleNavClick);
            });

            window.addEventListener('scroll', throttle(handleScroll));

            // Inisialisasi halaman pertama kali
            function initializePage() {
                // Jika ada hash di URL
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
                    // Default ke beranda
                    updateActiveNav('beranda');
                    window.scrollTo(0, 0);
                }
            }

            initializePage();
        });
    </script>
    <script>
        // Fungsi untuk menampilkan jadwal pelaksanaan
        function showSchedule(jadwalId) {
            fetch(`/api/jadwal-pelaksanaan/${jadwalId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengambil data');
                    return response.json();
                })
                .then(data => {
                    if (!data.success || data.data.length === 0) {
                        throw new Error('Tidak ada jadwal tersedia');
                    }

                    const tbody = document.getElementById('schedule-body');
                    tbody.innerHTML = '';

                    data.data.forEach(item => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${new Date(item.tanggal).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })}</td>
                    <td class="text-center">${item.sesi}</td>
                    <td class="text-center">${item.jam_mulai} - ${item.jam_selesai}</td>
                    <td class="text-center">${item.lokasi_platform}</td>
                `;
                        tbody.appendChild(row);
                    });

                    document.getElementById('schedule-detail').style.display = 'block';
                })
                .catch(error => {
                    alert(error.message);
                    console.error('Error:', error);
                });
        }

        function hideSchedule() {
            document.getElementById('schedule-detail').style.display = 'none';
        }
    </script>
</body>

</html>

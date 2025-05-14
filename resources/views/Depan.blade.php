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
</head>
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
</style>

<body id="page-top">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <!-- Menambahkan logo di sebelah kiri nama situs -->
            <a class="navbar-brand d-flex align-items-center" href="#page-top">
                <img src="assets/img/Logo Polinema.png" alt="Logo" class="mr-2" style="width: 65px;">
                {{ $site_name }} <!-- Nama situs -->
            </a>

            <!-- Tombol navbar untuk perangkat kecil -->
            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>

            <!-- Menu navbar utama -->
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#beranda">Beranda</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#syarat">Syarat & Ketentuan</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#pendaftaran">Pendaftaran</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#jadwal">Jadwal</a></li>
                    <!-- Menambahkan dropdown untuk pilihan bahasa -->
                    <li class="nav-item dropdown mx-0 mx-lg-1">
                        <a class="nav-link dropdown-toggle py-3 px-0 px-lg-3 rounded" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Bahasa
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Indonesia</a></li>
                            <li><a class="dropdown-item" href="#">Inggris</a></li>
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
            <!-- Tanggal & Waktu dengan Tulisan di Sebelah Kanan -->
            <div class="d-flex align-items-center mb-5" style="width: 80%; justify-content: flex-start; padding: 30px;">
                <!-- Tanggal (Background Bulat Utuh) -->
                <div class="date-box bg-primary rounded-circle d-flex align-items-center justify-content-center mr-4"
                    style="width: 600px; height: 150px;margin-right: 40px;">
                    <h3 id="current-date" class="mb-0" style="font-size: 2rem; font-weight: 600;"></h3>
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

            // Format: "11 Mei 2025 14.36 WIB"
            document.getElementById('current-date').textContent =
                now.toLocaleDateString('id-ID', options).replace('pukul', '').trim() + ' WIB';
        }

        // Update setiap menit (60000ms)
        updateCurrentDate();
        setInterval(updateCurrentDate, 60000);
    </script>

    <!-- Syarat dan Ketentuan Section-->
    <section class="page-section" id="syarat">
        <div class="container">
            <!-- Section Heading -->
            <h2 class="text-center text-uppercase text-secondary mb-4">{{ $section['SyaratKetentuan']->thumbnail }}</h2>

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
            <!-- Pendaftaran Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-4">PENDAFTARAN</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Pendaftaran Grid Items-->
            <div class="row justify-content-center">
                @php
                    $i=1;
                @endphp
                @foreach ($pendaftaran as $item)
            {{-- <!-- Pendaftaran Item {{ $i }}--> --}}
                <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal{{$i}}">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="{{ Storage::url($item->thumbnail) }}" alt="..." />
                    </div>
                </div>
                {{-- <!-- last Pendaftaran {{$i}}--> --}}
               @php
                   $i++;
               @endphp
                @endforeach 
            </div>
        </div>
    </section>

<!-- Jadwal Section -->
<section class="page-section bg-primary text-white mb-0" id="jadwal">
    <div class="container">
        <!-- Heading Section -->
        <h2 class="page-section-heading text-center text-uppercase text-white mb-4">Jadwal </h2>
        
        <!-- Tombol Kategori -->
       <!-- Tombol Kategori -->
<div class="text-center mb-4">
    <button class="btn btn-outline-light mx-2 active" onclick="showCategory('pendaftaran')">Pendaftaran</button>
    <button class="btn btn-outline-light mx-2" onclick="showCategory('ujian')">Ujian</button>
    <button class="btn btn-outline-light mx-2" onclick="showCategory('pengambilan')">Pengambilan Sertifikat</button>
</div>
        <!-- Konten Kategori -->
        <div class="category-content">
       <!-- Data Pendaftaran -->
<div id="pendaftaran" class="category-table">
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th width="25%">Program Tes</th>
                    <th width="30%">Periode Pendaftaran</th>
                    <th width="20%">Waktu Pendaftaran</th>
                    <th width="15%">Kuota</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwalPendaftaran as $item)
                    @php
                        $now = now();
                        $startDate = \Carbon\Carbon::parse($item->tanggal_mulai);
                        $endDate = \Carbon\Carbon::parse($item->tanggal_akhir);
                        $isOpen = $now->between($startDate, $endDate);
                        $isComing = $now < $startDate;
                        $isClosed = $now > $endDate;
                    @endphp
                    
                    <tr>
                        <td>
                            <strong>{{ $item->judul }}</strong>
                            @if($item->content)
                                <br><small class="text-muted">{{ $item->content }}</small>
                            @endif
                        </td>
                        <td>
                            {{ $startDate->translatedFormat('j F Y') }}<br>
                            <small>s.d. {{ $endDate->translatedFormat('j F Y') }}</small>
                        </td>
                        <td>
                            @if($item->jam_mulai && $item->jam_selesai)
                                {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }} WIB
                            @else
                                <span class="text-muted">24 Jam Online</span>
                            @endif
                        </td>
                        <td>
                            @if($item->kuota > 0)
                                {{ number_format($item->kuota, 0, ',', '.') }} kursi
                            @else
                                <span class="text-danger">Penuh</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($isComing)
                                <span class="badge bg-info">Akan Dibuka</span>
                            @elseif($isClosed)
                                <span class="badge bg-secondary">Ditutup</span>
                            @else
                                <span class="badge bg-success">Buka</span>
                                @if($now->diffInDays($endDate) < 3)
                                    <br><small class="text-warning mt-1 d-block">Segera tutup!</small>
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fas fa-calendar-times me-2"></i>
                            Tidak ada jadwal pendaftaran tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

            <!-- Data Ujian -->
            <div id="ujian" class="category-table" style="display:none;">
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
                                    <td>{{ \Carbon\Carbon::parse($item->hari_tanggal)->translatedFormat('l, j F Y') }}</td>
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
                                    <td colspan="4" class="text-center">Tidak ada jadwal pengambilan sertifikat saat ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript untuk toggle kategori -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('[data-target]');
    
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Hide all tables
            document.querySelectorAll('.category-table').forEach(table => {
                table.style.display = 'none';
            });
            
            // Show selected table
            const target = this.getAttribute('data-target');
            document.getElementById(target).style.display = 'block';
        });
    });
});
</script>

<style>
    .btn-outline-light.active {
        background-color: rgba(255,255,255,0.2);
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
        font-size: 0.9em;
        padding: 0.35em 0.65em;
    }
</style>

    </section>

    <!-- Footer-->
    <footer class="footer text-center" id="profile">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Lokasi</h4>
                    <p class="lead mb-0">
                        {{ $location }}
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Tentang Situs</h4>
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
                    <h4 class="text-uppercase mb-4">Jika Ada Kendala</h4>
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
    $i=1;
@endphp
@foreach ($pendaftaran as $item)
<!-- pendaftaran Modal {{$i}}-->
<div class="portfolio-modal modal fade" id="portfolioModal{{$i}}" tabindex="-1" aria-labelledby="portfolioModal{{$i}}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- pendaftaran Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">{{$item->title}}</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- pendaftaran Modal - Image-->
                            <img class="img-fluid rounded mb-5" src="{{Storage::url($item->thumbnail)}}" alt="..." />
                            {!! $item->content !!}
                            
                            <!-- Tombol Daftar Sekarang -->
                            <div class="mt-4">
                                @if($item->link)
                                    <a href="{{ $item->link }}" class="btn btn-primary btn-lg" target="_blank">
                                        Daftar Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('pendaftaran') }}" class="btn btn-primary btn-lg">
                                        Daftar Sekarang
                                    </a>
                                @endif
                                
                                <button class="btn btn-outline-secondary btn-lg ms-2" data-bs-dismiss="modal">
                                    <i class="fas fa-xmark fa-fw"></i>
                                    Tutup
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
</body>


</html>

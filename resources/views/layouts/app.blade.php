<!-- resources/views/layouts/app.blade.php -->
@php
    $site_name = get_setting_value('_site_name');
    $section = get_section_value();
    $location = get_setting_value('_location');
    $site_description = get_setting_value('_site_description');
    $instagram = get_setting_value('_instagram');
    $email = get_setting_value('_email');
    $whatsapp = get_setting_value('_whatsapp');
    $mahasiswa = Auth::user()->mahasiswa ?? null;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ $site_name }}</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Core CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    @stack('styles')

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

        /* NAVBAR CUSTOM STYLES */
        .navbar-brand {
            margin-right: auto;
        }

        .navbar-container {
            width: 100%;
            padding: 0 15px;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .nav-item {
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

        .profile-dropdown {
            margin-left: 1rem;
        }

        /* Additional styles for form */
        .card-body label,
        .card-body input,
        .card-body select,
        .card-body textarea,
        .card-body .form-control,
        .card-body .form-select,
        .card-body .text-danger,
        .card-body .text-muted {
            color: #212529 !important;
        }

        .card-body ::placeholder {
            color: #6c757d !important;
            opacity: 1;
        }

        /* Override warna teks alert agar tidak putih */
        section#pendaftaran .card-body .alert,
        section#pendaftaran .card-body .alert * {
            color: #212529 !important;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container-fluid navbar-container">
            <a class="navbar-brand d-flex align-items-center" href="#page-top">
                <img src="{{ asset('assets/img/Logo Polinema.png') }}" alt="Logo" class="mr-2"
                    style="width: 65px;">
                {{ $site_name }}
            </a>

            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="{{ url('/beranda') }}#beranda">{{ __('messages.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="{{ url('/beranda') }}#syarat">{{ __('messages.terms') }}</a></li>
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="{{ url('/pendaftaran') }}">{{ __('messages.registration') }}</a></li>
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="{{ url('/beranda') }}#jadwal">{{ __('messages.schedule') }}</a></li>
                    <li class="nav-item"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="{{ url('/beranda') }}#hasil">{{ __('messages.result') }}</a></li>

                    <!-- Language Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle py-3 px-0 px-lg-3 rounded" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('messages.select_language') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item"
                                    href="{{ route('change.language', 'id') }}">{{ __('messages.indonesian') }}</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('change.language', 'en') }}">{{ __('messages.english') }}</a></li>
                        </ul>
                    </li>

                    @auth
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
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

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
        <div class="container"><small>Copyright &copy; {{ $site_name }} {{ date('Y') }}</small></div>
    </div>

    <!-- Core Scripts -->
    <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Then Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Scripts -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!-- Section Specific Scripts -->
    @stack('scripts')

    <!-- Script untuk Tanggal & Waktu -->
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
            const dateElement = document.getElementById('current-date');
            if (dateElement) {
                dateElement.textContent =
                    now.toLocaleDateString(locale, options).replace('pukul', '').trim() + ' WIB';
            }
        }
        updateCurrentDate();
        setInterval(updateCurrentDate, 60000);
    </script>

    <!-- Navbar Scroll Highlight -->
    <script>
        $(window).scroll(function() {
            var scrollPosition = $(this).scrollTop();

            $('section').each(function() {
                var currentSection = $(this);
                var sectionTop = currentSection.offset().top - 100;
                var sectionBottom = sectionTop + currentSection.outerHeight();

                if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                    var targetId = '#' + currentSection.attr('id');
                    $('.nav-link').removeClass('active');
                    $('.nav-link[href="' + targetId + '"]').addClass('active');
                }
            });
        });
    </script>


</body>

</html>

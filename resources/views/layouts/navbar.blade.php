<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3" id="mainNav"
    style="background-color: #2c3e50; border-radius: 10px;">
    <div class="container">
        <!-- Logo dan Nama Situs -->
        <a class="navbar-brand d-flex align-items-center" href="#page-top">
            <img src="assets/img/Logo Polinema.png" alt="Logo" class="mr-2" style="width: 65px;">
            {{ $site_name }}
        </a>

        <!-- Tombol Toggle untuk Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"
            style="border-radius: 5px;">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Menu Navigasi -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3" href="{{ url('/') }}#beranda">{{ __('messages.home') }}</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3" href="{{ url('/') }}#syarat">{{ __('messages.terms') }}</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3" href="#pendaftaran">{{ __('messages.registration') }}</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3" href="{{ url('/') }}#jadwal">{{ __('messages.schedule') }}</a>
                </li>
                <!-- Dropdown Bahasa -->
                <li class="nav-item dropdown mx-0 mx-lg-1">
                    <a class="nav-link dropdown-toggle py-3 px-0 px-lg-3" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('messages.select_language') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-radius: 8px;">
                        <li><a class="dropdown-item"
                                href="{{ route('change.language', 'id') }}">{{ __('messages.indonesian') }}</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('change.language', 'en') }}">{{ __('messages.english') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- CSS untuk Navbar -->
<style>
    /* Warna dasar navbar */
    .navbar {
        background-color: #007bff !important;
        transition: all 0.3s ease;
        border-radius: 0 !important;
        clip-path: none !important;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        padding: 10px 0;
    }



    /* Warna teks putih */
    .navbar-dark .navbar-nav .nav-link {
        color: white !important;
    }

    /* Efek hover - cukup ubah opacity */
    .navbar-dark .navbar-nav .nav-link:hover {
        opacity: 0.8;
    }

    /* Tombol toggle mobile */
    .navbar-toggler {
        color: white;
        border-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        /* Membuat sudut tumpul */
    }

    /* Dropdown menu */
    .dropdown-menu {
        background-color: #2c3e50;
        border: none;
        border-radius: 12px;
        /* Membuat sudut lebih tumpul */
    }

    .dropdown-item {
        color: white !important;
    }

    .dropdown-item:hover {
        background-color: #34495e !important;
    }

    .container {
        border-radius: 0 !important;
        overflow: visible;
    }


    .nav-link.active {
        border-radius: 8px !important;
        /* Tidak terlalu kotak, tidak terlalu bulat */
    }

    .navbar-brand {
        font-size: 1.75rem;
        transition: font-size 0.3s ease;
    }

    .navbar-shrink .navbar-brand {
        font-size: 1.25rem;
        /* Ukuran lebih kecil saat scroll */
    }

    body {
        margin: 0;
        padding: 0;
    }
</style>

<!-- JavaScript untuk Highlight Menu Aktif -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', function () {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;

                if (pageYOffset >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('mainNav');

        function adjustNavbar() {
            if (window.scrollY > 100) {
                navbar.classList.add('navbar-shrink');
            } else {
                navbar.classList.remove('navbar-shrink');
            }
        }

        adjustNavbar(); // cek saat pertama load
        window.addEventListener('scroll', adjustNavbar);
    });
</script>
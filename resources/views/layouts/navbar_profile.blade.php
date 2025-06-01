@php
    $mahasiswa = Auth::user()->mahasiswa;
@endphp

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
        <!-- Menambahkan logo di sebelah kiri nama situs -->
        <a class="navbar-brand d-flex align-items-center" href="#page-top">
            <img src="{{ asset('assets/img/Logo Polinema.png') }}" alt="Logo" class="mr-2" style="width: 65px;">
            {{ $site_name }} <!-- Nama situs -->
        </a>

        <!-- Tombol navbar untuk perangkat kecil -->
        <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
            type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
            aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Menu -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <!-- Main Menu Items -->
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                        href="{{ url('/beranda') }}#beranda">{{ __('messages.home') }}</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                        href="{{ url('/beranda') }}#syarat">{{ __('messages.terms') }}</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                        href="#pendaftaran">{{ __('messages.registration') }}</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                        href="{{ url('/beranda') }}#jadwal">{{ __('messages.schedule') }}</a></li>

                <!-- Language Dropdown -->
                <li class="nav-item dropdown mx-0 mx-lg-1">
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
                <li class="nav-item dropdown ms-auto">
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

<!-- JavaScript untuk Highlight Menu Aktif -->
<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const sections = document.querySelectorAll('section');
    //     const navLinks = document.querySelectorAll('.nav-link');

    //     window.addEventListener('scroll', function () {
    //         let current = '';

    //         sections.forEach(section => {
    //             const sectionTop = section.offsetTop;
    //             const sectionHeight = section.clientHeight;

    //             if (pageYOffset >= (sectionTop - 100)) {
    //                 current = section.getAttribute('id');
    //             }
    //         });


    //         navLinks.forEach(link => {
    //             link.classList.remove('active');
    //             if (link.getAttribute('href') === `#${current}`) {
    //                 link.classList.add('active');
    //             }
    //         });
    //     });
    // });
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

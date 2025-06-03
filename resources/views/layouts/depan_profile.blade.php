<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
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
                            {{ $section['Beranda']->title }}</h2>
                        <h1 class="masthead-title mb-4" style="font-size: 3rem; font-weight: 800; letter-spacing: 3px;">
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

    <!-- Syarat dan Ketentuan Section-->
    <section class="page-section" id="syarat">
        <!-- ... konten section syarat ... -->
    </section>
@endsection

@section('scripts')
    <script>
        // Script khusus untuk halaman ini
    </script>
@endsection
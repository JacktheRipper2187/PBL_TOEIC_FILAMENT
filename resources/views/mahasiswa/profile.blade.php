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
@extends('layouts.depan_profile')

@section('title', $site_name)

@section('content')
    <section class="page-section bg-primary mb-0" id="pendaftaran">
        <div class="container">
            <br>
            <h2 class="page-section-heading text-center text-uppercase text-white mb-4">Profil Mahasiswa</h2>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>

            <!-- Card Informasi Mahasiswa -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow p-4 mb-5 bg-white rounded">
                        <h4 class="mb-3">Informasi Mahasiswa</h4>
                        <p><strong>Nama:</strong> {{ $mahasiswa->nama_lengkap ?? '-' }}</p>
                        <p><strong>NIM:</strong> {{ $mahasiswa->nim ?? '-' }}</p>
                        <p><strong>Email:</strong> {{ $mahasiswa->email ?? '-' }}</p>
                        <p><strong>No. Telp:</strong> {{ $mahasiswa->no_telp ?? '-' }}</p>
                        <p><strong>Kampus:</strong> {{ $mahasiswa->kampus ?? '-' }}</p>
                        <p><strong>Jurusan:</strong> {{ $mahasiswa->jurusan ?? '-' }}</p>
                        <p><strong>Prodi:</strong> {{ $mahasiswa->prodi ?? '-' }}</p>
                        <p><strong>Username:</strong> {{ $user->username }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Ubah Foto Profil (Letakkan di urutan pertama) -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow p-4 mb-5 bg-white rounded">
                        <h4 class="mb-3">Ubah Foto Profil</h4>
                        @if (session('foto_success'))
                            <div class="alert alert-success">{{ session('foto_success') }}</div>
                        @endif
                        <div class="mb-3 text-center">
                            <img src="{{ $mahasiswa && $mahasiswa->foto ? asset('storage/' . $mahasiswa->foto) : asset('storage/img/profile.png') }}"
                                alt="Foto Profil" class="rounded-circle" width="150" height="150">
                        </div>
                        <form action="{{ route('mahasiswa.update-foto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="foto" class="form-label">Pilih Foto</label>
                                <input type="file" name="foto" class="form-control" required>
                                @error('foto')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-upload me-1"></i>
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Card Ubah Password -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow p-4 bg-white rounded">
                        <h4 class="mb-3">Ubah Password</h4>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('password_success') }}</div>
                        @endif

                        <form action="{{ route('mahasiswa.update-password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Lama</label>
                                <input type="password" name="current_password" class="form-control" required>
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i>
                                Simpan Password Baru
                            </button>
                            <a href="{{ url('/beranda') }}" class="btn btn-secondary ms-2">
                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

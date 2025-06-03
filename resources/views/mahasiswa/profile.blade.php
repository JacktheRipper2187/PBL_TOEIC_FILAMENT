@php
    $site_name = get_setting_value('_site_name');
    $section = get_section_value();
    $location = get_setting_value('_location');
    $site_description = get_setting_value('_site_description');
    $instagram = get_setting_value('_instagram');
    $email = get_setting_value('_email');
    $whatsapp = get_setting_value('_whatsapp');
    $pendaftaran = get_pendaftaran_value();
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

            <div class="row">
                <!-- Kolom Kiri - Informasi yang bisa diubah -->
                <div class="col-md-6 order-md-1">
                    <!-- Card Ubah Foto Profil -->
                    <div class="card shadow p-4 mb-4 bg-white rounded">
                        <h4 class="mb-3"><i class="bi bi-person-circle me-2"></i>Ubah Foto Profil</h4>
                        @if (session('foto_success'))
                            <div class="alert alert-success">{{ session('foto_success') }}</div>
                        @endif
                        <div class="text-center mb-3">
                            <img src="{{ $mahasiswa && $mahasiswa->foto ? asset('storage/' . $mahasiswa->foto) : asset('storage/img/profile.png') }}"
                                alt="Foto Profil" class="rounded-circle shadow-sm" width="150" height="150">
                        </div>
                        <form action="{{ route('mahasiswa.update-foto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="foto" class="form-label">Upload Foto Baru</label>
                                <input type="file" name="foto" class="form-control" required>
                                @error('foto')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-upload me-1"></i> Update Foto
                            </button>
                        </form>
                    </div>

                    <!-- Card Ubah Password -->
                    <div class="card shadow p-4 bg-white rounded">
                        <h4 class="mb-3"><i class="bi bi-shield-lock me-2"></i>Keamanan Akun</h4>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('password_success') }}</div>
                        @endif

                        <form action="{{ route('mahasiswa.update-password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Saat Ini</label>
                                <input type="password" name="current_password" class="form-control" placeholder="Masukkan password lama" required>
                                @error('current_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password baru" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                <i class="bi bi-check-circle me-1"></i> Perbarui Password
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Kolom Kanan - Informasi mahasiswa (read-only) -->
                <div class="col-md-6 order-md-2">
                    <div class="card shadow p-4 h-100 bg-white rounded">
                        <h4 class="mb-3"><i class="bi bi-person-lines-fill me-2"></i>Informasi Mahasiswa</h4>
                        <div class="profile-info">
                            <div class="info-item">
                                <span class="info-label">Nama Lengkap</span>
                                <span class="info-value">{{ $mahasiswa->nama_lengkap ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">NIM</span>
                                <span class="info-value">{{ $mahasiswa->nim ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ $mahasiswa->email ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">No. Telepon</span>
                                <span class="info-value">{{ $mahasiswa->no_telp ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Kampus</span>
                                <span class="info-value">{{ $mahasiswa->kampus ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Jurusan</span>
                                <span class="info-value">{{ $mahasiswa->jurusan ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Program Studi</span>
                                <span class="info-value">{{ $mahasiswa->prodi ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Username</span>
                                <span class="info-value">{{ $user->username }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-3 border-top text-center">
                            <a href="{{ url('/beranda') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    /* Profile Info Styling */
    .profile-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .info-item {
        display: flex;
        align-items: flex-start;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #eee;
    }
    .info-label {
        font-weight: 600;
        color: #555;
        min-width: 140px;
        padding-right: 10px;
    }
    .info-label::after {
        content: ":";
        margin-left: auto;
    }
    .info-value {
        flex: 1;
        color: #333;
        word-break: break-word;
    }
    
    /* Card Styling */
    .card {
        border: none;
        border-radius: 10px;
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .card h4 {
        color: #2c3e50;
        font-weight: 600;
    }
    
    /* Responsive Adjustment */
    @media (max-width: 768px) {
        .order-md-1, .order-md-2 {
            order: 0;
        }
        .info-label {
            min-width: 120px;
        }
    }
</style>
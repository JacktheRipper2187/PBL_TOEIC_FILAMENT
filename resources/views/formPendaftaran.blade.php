{{-- filepath: resources/views/formPendaftaran.blade.php --}}
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
@extends('layouts.depan')

@section('title', '{{ $site_name }}')

@section('content')
    <section class="page-section bg-primary mb-0" id="pendaftaran">
        <div class="container">
            <br>
            <h2 class="page-section-heading text-center text-uppercase text-white mb-4">
                {{ __('messages.participant_registration') }}</h2>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Modal Success -->
                    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="successModalLabel">{{ __('messages.success') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><i
                                            class="bi bi-check-circle-fill text-success me-2"></i>{{ __('messages.congratulate') }}
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                        id="successCloseBtn">{{ __('messages.understand') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Error -->
                    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="errorModalLabel">{{ __('messages.failed') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="errorModalBody"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">{{ __('messages.understand') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body p-4 text-dark">

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert" style="padding-bottom: 0.5rem;">
                                    <strong>{{ __('messages.complete') }}</strong>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="pendaftaranForm" method="POST" action="{{ route('pendaftaran.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3 row">
                                    <label for="nama_lengkap"
                                        class="col-md-3 col-form-label">{{ __('messages.fullname') }}</label>
                                    <div class="col-md-9">
                                        <input type="text" id="nama_lengkap" name="nama_lengkap"
                                            value="{{ old('nama_lengkap') }}" class="form-control"
                                            placeholder="{{ __('messages.enter_fullname') }}" required>
                                        @error('nama_lengkap')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nim_nik" class="col-md-3 col-form-label">NIM</label>
                                    <div class="col-md-9">
                                        <input type="text" id="nim_nik" name="nim_nik" value="{{ old('nim_nik') }}"
                                            class="form-control" placeholder="{{ __('messages.nim') }}" required
                                            pattern="\d{8,15}">
                                        @error('nim_nik')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div id="nimValidation" class="mt-2"></div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="email" class="col-md-3 col-form-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            class="form-control" placeholder="{{ __('messages.email') }}" required>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="alamat_asal"
                                        class="col-md-3 col-form-label">{{ __('messages.home_address') }}</label>
                                    <div class="col-md-9">
                                        <textarea id="alamat_asal" name="alamat_asal" class="form-control" required>{{ old('alamat_asal') }}</textarea>
                                        @error('alamat_asal')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="alamat_sekarang"
                                        class="col-md-3 col-form-label">{{ __('messages.current_address') }}</label>
                                    <div class="col-md-9">
                                        <textarea id="alamat_sekarang" name="alamat_sekarang" class="form-control" required>{{ old('alamat_sekarang') }}</textarea>
                                        @error('alamat_sekarang')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Dropdown Kampus -->
                                <div class="mb-3 row">
                                    <label for="kampus"
                                        class="col-md-3 col-form-label">{{ __('messages.kampus') }}</label>
                                    <div class="col-md-9">
                                        <select id="kampus" name="kampus" class="form-select" required>
                                            <option value="" selected disabled>{{ __('messages.pilih_kampus') }}
                                            </option>
                                            <option value="utama" {{ old('kampus') == 'utama' ? 'selected' : '' }}>Kampus
                                                Utama</option>
                                            <option value="kediri" {{ old('kampus') == 'kediri' ? 'selected' : '' }}>PSDKU
                                                Kediri</option>
                                            <option value="pamekasan"
                                                {{ old('kampus') == 'pamekasan' ? 'selected' : '' }}>PSDKU Pamekasan
                                            </option>
                                            <option value="lumajang" {{ old('kampus') == 'lumajang' ? 'selected' : '' }}>
                                                PSDKU Lumajang</option>
                                        </select>
                                        @error('kampus')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Dropdown Jurusan -->
                                <div class="mb-3 row">
                                    <label for="jurusan"
                                        class="col-md-3 col-form-label">{{ __('messages.jurusan') }}</label>
                                    <div class="col-md-9">
                                        <select id="jurusan" name="jurusan" class="form-select" required>
                                            <option value="" selected disabled>{{ __('messages.pilih_jurusan') }}
                                            </option>
                                        </select>
                                        @error('jurusan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Dropdown Program Studi -->
                                <div class="mb-3 row">
                                    <label for="program_studi"
                                        class="col-md-3 col-form-label">{{ __('messages.program_studi') }}</label>
                                    <div class="col-md-9">
                                        <select id="program_studi" name="program_studi" class="form-select" required>
                                            <option value="" selected disabled>
                                                {{ __('messages.pilih_program_studi') }}</option>
                                        </select>
                                        @error('program_studi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- menampilkan contoh gambar --}}
                                <div class="mt-2">
                                    <p class="text-muted mb-2">{{ __('messages.contoh_foto_formal') }}</p>
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/img/contoh_foto_formal.jpg') }}"Add commentMore
                                            actions alt="Contoh Foto Formal" class="img-fluid img-thumbnail"
                                            style="max-width: 400px; min-width: 200px; width: 90%; height: auto; cursor: pointer;"
                                            onclick="window.open(this.src, '_blank')">
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="foto_formal"
                                            class="col-md-3 col-form-label">{{ __('messages.foto_formal') }}</label>
                                        <div class="col-md-9">
                                            <input type="file" id="foto_formal" name="foto_formal"
                                                class="form-control" accept="image/jpeg,image/png" required
                                                onchange="previewFile(this, 'fotoFormalPreview')">
                                            <small class="text-muted">{{ __('messages.format_jpg_png_max') }}</small>
                                            <div id="fotoFormalPreview" class="mt-2"></div>
                                            @error('foto_formal')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="upload_ktp" class="col-md-3 col-form-label">Upload KTP</label>
                                        <div class="col-md-9">
                                            <input type="file" id="upload_ktp" name="upload_ktp" class="form-control"
                                                accept=".pdf,.jpg,.jpeg,.png" required
                                                onchange="previewFile(this, 'ktpPreview')">
                                            <small class="text-muted">{{ __('messages.format_pdf_jpg_png_max') }}</small>
                                            <div id="ktpPreview" class="mt-2"></div>
                                            @error('upload_ktp')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="upload_ktm" class="col-md-3 col-form-label">Upload KTM</label>
                                        <div class="col-md-9">
                                            <input type="file" id="upload_ktm" name="upload_ktm" class="form-control"
                                                accept=".pdf,.jpg,.jpeg,.png" required
                                                onchange="previewFile(this, 'ktmPreview')">
                                            <small class="text-muted">{{ __('messages.format_pdf_jpg_png_max') }}</small>
                                            <div id="ktmPreview" class="mt-2"></div>
                                            @error('upload_ktm')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-9 offset-md-3">
                                            <button type="submit" class="btn btn-success" id="submitBtn">
                                                {{-- Icon daftar (Bootstrap Icons check-circle) --}}
                                                <i class="bi bi-check-circle me-1"></i>
                                                {{ __('messages.daftar_sekarang') }}
                                            </button>
                                            <a href="{{ url('/beranda') }}" class="btn btn-secondary ms-2">
                                                {{-- Icon panah kiri (Bootstrap Icons arrow-left) --}}
                                                <i class="bi bi-arrow-left me-1"></i>
                                                {{ __('messages.back') }}
                                            </a>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const dataJurusan = {
            "utama": [{
                    value: "TE",
                    label: "Teknik Elektro"
                },
                {
                    value: "TM",
                    label: "Teknik Mesin"
                },
                {
                    value: "TS",
                    label: "Teknik Sipil"
                },
                {
                    value: "AK",
                    label: "Akuntansi"
                },
                {
                    value: "AN",
                    label: "Administrasi Niaga"
                },
                {
                    value: "TK",
                    label: "Teknik Kimia"
                },
                {
                    value: "TI",
                    label: "Teknologi Informasi"
                }
            ],
            "kediri": [{
                    value: "TI",
                    label: "Teknologi Informasi"
                },
                {
                    value: "TM",
                    label: "Teknik Mesin"
                },
                {
                    value: "AK",
                    label: "Akuntansi"
                },
                {
                    value: "TE",
                    label: "Teknik Elektro"
                }
            ],
            "lumajang": [{
                    value: "TI",
                    label: "Teknologi Informasi"
                },
                {
                    value: "TS",
                    label: "Teknik Sipil"
                },
                {
                    value: "AK",
                    label: "Akuntansi"
                }
            ],
            "pamekasan": [{
                    value: "TM",
                    label: "Teknik Mesin"
                },
                {
                    value: "AK",
                    label: "Akuntansi"
                },
                {
                    value: "AN",
                    label: "Teknologi Informasi"
                }
            ]
        };

        const dataProgramStudi = {
            "TE": ["D-IV Teknik Elektronika", "D-IV Sistem Kelistrikan",
                "D-IV Jaringan Telekomunikasi Digital",
                "D-III Teknik Elektronika",
                "D-III Teknik Listrik",
                "D-III Teknik Telekomunikasi"
            ],
            "TM": ["D-IV Teknik Otomotif Elektronik", "D-IV Teknik Mesin Produksi dan Perawatan",
                "D-III Teknik Mesin", "D-III Teknologi Pemeliharaan Pesawat Udara"
            ],
            "TS": ["D-IV Manajemen Rekayasa Konstruksi", "D-IV Teknologi Rekayasa Konstruksi Jalan dan Jembatan",
                "D-III Teknik Sipil", "D-III Teknik Konstruksi Jalan dan Jembatan", "D-III Teknologi Pertambangan"
            ],
            "AK": ["D-IV Akuntansi Manajemen", "D-IV Keuangan", "D-III Akuntansi"],
            "AN": ["D-IV Manajemen Pemasaran", "D-IV Bahasa Inggris untuk Komunikasi Bisnis dan Profesional",
                "D-IV Pengelolaan Arsip dan Rekaman Informasi", "D-IV Usaha Perjalanan Wisata",
                "D-IV Bahasa Inggris untuk Industri Pariwisata", "D-III Administrasi Bisnis"
            ],
            "TK": ["D-IV Teknologi Kimia Industri", "D-III Teknik Kimia"],
            "TI": ["D-IV Teknik Informatika", "D-IV Sistem Informasi Bisnis", "D-II Pengembangan Piranti Lunak Situs"]
        };

        // Fungsi untuk preview file upload
        function previewFile(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (!file) return;

            preview.innerHTML = '';

            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <div class="border p-2 rounded" style="max-width: 300px;">
                            <img src="${e.target.result}" class="img-fluid" alt="Preview">
                            <div class="text-muted small mt-1">${file.name}</div>
                        </div>
                    `;
                }
                reader.readAsDataURL(file);
            } else if (file.name.match(/\.(pdf)$/i)) {
                preview.innerHTML = `
                    <div class="alert alert-info p-2 d-flex align-items-center">
                        <i class="bi bi-file-earmark-pdf fs-4 me-2"></i>
                        <div>
                            <strong>File PDF:</strong><br>
                            <small>${file.name}</small>
                        </div>
                    </div>
                `;
            } else {
                preview.innerHTML = `
                    <div class="alert alert-warning p-2">
                        Format file tidak didukung: ${file.name}
                    </div>
                `;
            }
        }

        // Fungsi untuk update dropdown jurusan
        function updateJurusan() {
            const kampus = $('#kampus').val();
            $('#jurusan').empty().append('<option value="" selected disabled>Pilih Jurusan</option>');
            $('#program_studi').empty().append('<option value="" selected disabled>Pilih Program Studi</option>');

            if (kampus && dataJurusan[kampus]) {
                dataJurusan[kampus].forEach(jurusan => {
                    $('#jurusan').append(`<option value="${jurusan.value}">${jurusan.label}</option>`);
                });
            }
        }

        // Fungsi untuk update dropdown program studi
        function updateProgramStudi() {
            const jurusan = $('#jurusan').val();
            $('#program_studi').empty().append('<option value="" selected disabled>Pilih Program Studi</option>');

            if (jurusan && dataProgramStudi[jurusan]) {
                dataProgramStudi[jurusan].forEach(prodi => {
                    $('#program_studi').append(`<option value="${prodi}">${prodi}</option>`);
                });
            }
        }

        $(document).ready(function() {
            // Inisialisasi event listener
            $('#kampus').on('change', updateJurusan);
            $('#jurusan').on('change', updateProgramStudi);

            // Inisialisasi nilai old jika ada
            if ("{{ old('kampus') }}") {
                $('#kampus').val("{{ old('kampus') }}").trigger('change');
                setTimeout(() => {
                    if ("{{ old('jurusan') }}") {
                        $('#jurusan').val("{{ old('jurusan') }}").trigger('change');
                        setTimeout(() => {
                            if ("{{ old('program_studi') }}") {
                                $('#program_studi').val("{{ old('program_studi') }}");
                            }
                        }, 100);
                    }
                }, 100);
            }

            // Validasi file upload
            $('input[type="file"]').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const fileSize = file.size / 1024 / 1024; // in MB
                    if (fileSize > 2) {
                        alert('Ukuran file maksimal 2MB');
                        $(this).val('');
                    }
                }
            });

            // Form submission handler
            $('#pendaftaranForm').on('submit', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);
                const submitBtn = $('#submitBtn');

                submitBtn.prop('disabled', true);
                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...'
                );

                // Clear errors
                $('.text-danger').html('');
                $('#nimValidation').html('');

                // Submit form
                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            var successModal = new bootstrap.Modal(document.getElementById(
                                'successModal'));
                            successModal.show();
                            form.reset();
                            $('#jurusan').html(
                                '<option value="" selected disabled>Pilih Jurusan</option>');
                            $('#program_studi').html(
                                '<option value="" selected disabled>Pilih Program Studi</option>'
                            );

                            // Reload page after 2 seconds to show new data
                            setTimeout(() => {
                                var modalEl = document.getElementById('successModal');
                                var modalInstance = bootstrap.Modal.getInstance(
                                    modalEl);
                                if (modalInstance) {
                                    modalInstance.hide();
                                }
                            }, 8000);
                        } else {
                            if (response.errors) {
                                for (const key in response.errors) {
                                    let errorHtml = response.errors[key].join('<br>');
                                    $(`[name="${key}"]`).next('.text-danger').html(errorHtml);
                                }
                            }
                            if (response.message) {
                                $('#errorModalBody').html(
                                    `<p><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> ${response.message}</p>`
                                );
                                var errorModal = new bootstrap.Modal(document.getElementById(
                                    'errorModal'));
                                errorModal.show();
                            }
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan pada server';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $('#errorModalBody').html(
                            `<p><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> ${errorMessage}</p>`
                        );
                        var errorModal = new bootstrap.Modal(document.getElementById(
                            'errorModal'));
                        errorModal.show();
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false);
                        submitBtn.html(
                            '<i class="bi bi-check-circle me-1"></i> Daftar Sekarang');
                    }
                });
            });
        });

        // Redirect ke landing page setelah modal sukses ditutup
        $('#successModal').on('hidden.bs.modal', function() {
            window.location.href = '/beranda'; // Ganti '/' dengan route landing page kamu jika perlu
        });

        $('#successCloseBtn').on('click', function() {
            window.location.href = '/beranda'; // Ganti '/' dengan route landing page kamu jika perlu
        });

        $(document).ready(function() {
            // Fungsi untuk highlight nav link aktif
            function highlightNav() {
                const scrollPos = $(document).scrollTop();

                $('section').each(function() {
                    const sectionTop = $(this).offset().top - 100;
                    const sectionBottom = sectionTop + $(this).outerHeight();

                    if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                        const sectionId = $(this).attr('id');
                        $('.nav-link').removeClass('active');
                        $(`.nav-link[href*="${sectionId}"]`).addClass('active');
                    }
                });
            }

            // Jalankan saat load dan scroll
            $(window).on('load scroll', highlightNav);

            // Untuk form pendaftaran khusus
            if (window.location.pathname.includes('/pendaftaran')) {
                $('.nav-link[href*="pendaftaran"]').addClass('active');
            }
        });
    </script>
@endpush

@push('styles')
    <style>
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
@endpush

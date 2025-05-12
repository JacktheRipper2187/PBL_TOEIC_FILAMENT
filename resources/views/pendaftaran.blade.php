<!-- Styles -->
<link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/style.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Pendaftaran Berhasil!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><i class="bi bi-check-circle-fill text-success me-2"></i> Pendaftaran Anda berhasil!</p>
                <p>Silakan tunggu informasi jadwal TOEIC melalui email yang Anda daftarkan.</p>
                <p>Proses verifikasi membutuhkan waktu 1-3 hari kerja.</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="modalCloseBtn" class="btn btn-success" data-bs-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body p-4">
        <h3 class="card-title fw-bold text-success mb-3">Pendaftaran Peserta</h3>
        <form id="pendaftaranForm" method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 row">
                <label for="nama_lengkap" class="col-md-3 col-form-label">Nama Lengkap</label>
                <div class="col-md-9">
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control" placeholder="Masukkan nama Anda">
                    @error('nama_lengkap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nim_nik" class="col-md-3 col-form-label">NIM/NIK</label>
                <div class="col-md-9">
                    <input type="text" id="nim_nik" name="nim_nik" value="{{ old('nim_nik') }}" class="form-control" placeholder="Masukkan NIM/NIK Anda">
                    @error('nim_nik')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-md-3 col-form-label">Email</label>
                <div class="col-md-9">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Masukkan email Anda">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="alamat_asal" class="col-md-3 col-form-label">Alamat Asal</label>
                <div class="col-md-9">
                    <input type="text" id="alamat_asal" name="alamat_asal" value="{{ old('alamat_asal') }}" class="form-control" placeholder="Masukkan Alamat Asal Anda">
                    @error('alamat_asal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="alamat_sekarang" class="col-md-3 col-form-label">Alamat Sekarang</label>
                <div class="col-md-9">
                    <input type="text" id="alamat_sekarang" name="alamat_sekarang" value="{{ old('alamat_sekarang') }}" class="form-control" placeholder="Masukkan Alamat Sekarang Anda">
                    @error('alamat_sekarang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Dropdown Kampus -->
            <div class="mb-3 row">
                <label for="kampus" class="col-md-3 col-form-label">Kampus</label>
                <div class="col-md-9">
                    <select id="kampus" name="kampus" class="form-select" onchange="updateJurusan()">
                        <option selected disabled>Pilih Kampus</option>
                        <option value="utama" {{ old('kampus') == 'utama' ? 'selected' : '' }}>Kampus Utama</option>
                        <option value="kediri" {{ old('kampus') == 'kediri' ? 'selected' : '' }}>PSDKU Kediri</option>
                        <option value="pamekasan" {{ old('kampus') == 'pamekasan' ? 'selected' : '' }}>PSDKU Pamekasan</option>
                        <option value="lumajang" {{ old('kampus') == 'lumajang' ? 'selected' : '' }}>PSDKU Lumajang</option>
                    </select>
                    @error('kampus')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Dropdown Jurusan -->
            <div class="mb-3 row">
                <label for="jurusan" class="col-md-3 col-form-label">Jurusan</label>
                <div class="col-md-9">
                    <select id="jurusan" name="jurusan" class="form-select" onchange="updateProgramStudi()">
                        <option selected disabled>Pilih Jurusan</option>
                    </select>
                    @error('jurusan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Dropdown Program Studi -->
            <div class="mb-3 row">
                <label for="program_studi" class="col-md-3 col-form-label">Program Studi</label>
                <div class="col-md-9">
                    <select id="program_studi" name="program_studi" class="form-select">
                        <option selected disabled>Pilih Program Studi</option>
                    </select>
                    @error('program_studi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="foto_formal" class="col-md-3 col-form-label">Foto Formal</label>
                <div class="col-md-9">
                    <input type="file" id="foto_formal" name="foto_formal" class="form-control">
                    @error('foto_formal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="upload_ktp" class="col-md-3 col-form-label">Upload KTP</label>
                <div class="col-md-9">
                    <input type="file" id="upload_ktp" name="upload_ktp" class="form-control">
                    @error('upload_ktp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="upload_ktm" class="col-md-3 col-form-label">Upload KTM</label>
                <div class="col-md-9">
                    <input type="file" id="upload_ktm" name="upload_ktm" class="form-control">
                    @error('upload_ktm')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success" id="submitBtn">Daftar Sekarang</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fungsi dropdown
    const dataJurusan = {
        "utama": [
            { value: "TE", label: "Teknik Elektro" },
            { value: "TM", label: "Teknik Mesin" },
            { value: "TS", label: "Teknik Sipil" },
            { value: "AK", label: "Akuntansi" },
            { value: "AN", label: "Administrasi Niaga" },
            { value: "TK", label: "Teknik Kimia" },
            { value: "TI", label: "Teknologi Informasi" }
        ],
        "kediri": [
            { value: "TI", label: "Teknologi Informasi" },
            { value: "TM", label: "Teknik Mesin" },
            { value: "AK", label: "Akuntansi" },
            { value: "TE", label: "Teknik Elektro" }
        ],
        "lumajang": [
            { value: "TI", label: "Teknologi Informasi" },
            { value: "TS", label: "Teknik Sipil" },
            { value: "AK", label: "Akuntansi" }
        ],
        "pamekasan": [
            { value: "TM", label: "Teknik Mesin" },
            { value: "AK", label: "Akuntansi" },
            { value: "AN", label: "Teknologi Informasi" }
        ]
    };

    const dataProgramStudi = {
        "TE": ["D-IV Teknik Elektronika","D-IV Sistem Kelistrikan",
                    "D-IV Jaringan Telekomunikasi Digital",
                    "D-III Teknik Elektronika",
                    "D-III Teknik Listrik",
                    "D-III Teknik Telekomunikasi"],
        "TM": ["D-IV Teknik Otomotif Elektronik", "D-IV Teknik Mesin Produksi dan Perawatan",
                    "D-III Teknik Mesin", "D-III Teknologi Pemeliharaan Pesawat Udara"],
        "TS": ["D-IV Manajemen Rekayasa Konstruksi", "D-IV Teknologi Rekayasa Konstruksi Jalan dan Jembatan",
                    "D-III Teknik Sipil", "D-III Teknik Konstruksi Jalan dan Jembatan", "D-III Teknologi Pertambangan"],
        "AK": ["D-IV Akuntansi Manajemen", "D-IV Keuangan", "D-III Akuntansi"],
        "AN": ["D-IV Manajemen Pemasaran", "D-IV Bahasa Inggris untuk Komunikasi Bisnis dan Profesional", 
                    "D-IV Pengelolaan Arsip dan Rekaman Informasi", "D-IV Usaha Perjalanan Wisata", "D-IV Bahasa Inggris untuk Industri Pariwisata", "D-III Administrasi Bisnis"],
        "TK": ["D-IV Teknologi Kimia Industri", "D-III Teknik Kimia"],
        "TI": ["D-IV Teknik Informatika", "D-IV Sistem Informasi Bisnis", "D-II Pengembangan Piranti Lunak Situs"]
    };

    function updateJurusan() {
        const kampus = document.getElementById("kampus").value;
        const jurusanSelect = document.getElementById("jurusan");
        const programStudiSelect = document.getElementById("program_studi");

        // Reset dropdown
        jurusanSelect.innerHTML = '<option selected disabled>Pilih Jurusan</option>';
        programStudiSelect.innerHTML = '<option selected disabled>Pilih Program Studi</option>';

        if (dataJurusan[kampus]) {
            dataJurusan[kampus].forEach(jurusan => {
                const option = document.createElement("option");
                option.value = jurusan.value;
                option.textContent = jurusan.label;
                jurusanSelect.appendChild(option);
            });
        }
    }

    function updateProgramStudi() {
        const jurusan = document.getElementById("jurusan").value;
        const programStudiSelect = document.getElementById("program_studi");

        // Reset
        programStudiSelect.innerHTML = '<option selected disabled>Pilih Program Studi</option>';

        if (dataProgramStudi[jurusan]) {
            dataProgramStudi[jurusan].forEach(prodi => {
                const option = document.createElement("option");
                option.value = prodi;
                option.textContent = prodi;
                programStudiSelect.appendChild(option);
            });
        }
    }

    // AJAX Form Submission
    $(document).ready(function() {
        // Inisialisasi event untuk dropdown
        $('#kampus').on('change', updateJurusan);
        $('#jurusan').on('change', updateProgramStudi);
        
        $('#pendaftaranForm').on('submit', function(e) {
            e.preventDefault();
            
            var form = this;
            var formData = new FormData(form);
            var submitBtn = $('#submitBtn');
            
            // Tampilkan loading state
            submitBtn.prop('disabled', true);
            submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...');
            
            // Clear previous errors
            $('.text-danger').html('');
            
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Tampilkan modal sukses
                        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();
                        
                        // Reset form
                        form.reset();
                        
                        // Reset dropdown
                        $('#jurusan').html('<option selected disabled>Pilih Jurusan</option>');
                        $('#program_studi').html('<option selected disabled>Pilih Program Studi</option>');
                        
                        // Redirect setelah modal ditutup
                        $('#successModal').on('hidden.bs.modal', function() {
                            window.location.href = '/'; // Ganti dengan URL landing page Anda
                        });
                    } else {
                        alert(response.message || 'Terjadi kesalahan');
                    }
                },
                error: function(xhr) {
                    var response = xhr.responseJSON;
                    if (xhr.status == 422 && response.errors) {
                        // Tampilkan error validasi
                        $.each(response.errors, function(key, value) {
                            $('[name="' + key + '"]').next('.text-danger').html(value[0]);
                        });
                    } else {
                        alert(response?.message || 'Terjadi kesalahan saat mengirim data');
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Daftar Sekarang');
                }
            });
        });
    });
</script>

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('themes/ezone/assets/css/style.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Modal Success -->
<!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Pendaftaran Berhasil!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><i class="bi bi-check-circle-fill text-success me-2"></i> Selamat! Anda berhasil terdaftar untuk mengikuti tes TOEIC gratis. Silakan tunggu informasi lebih lanjut melalui WhatsApp dari pihak TOEIC terkait jadwal dan prosedur tes. Pastikan juga untuk mengecek jadwal tes secara berkala melalui website resmi kami. Terima kasih</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">Pendaftaran Gagal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="errorModalBody">
                {{-- <p><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> Mohon maaf, Anda tidak dapat mendaftar untuk tes TOEIC gratis kali ini. Data Anda tidak terdaftar sebagai mahasiswa yang berhak mengikuti tes gratis atau Anda sudah pernah mengikuti tes gratis sebelumnya. Jika Anda ingin mengikuti tes TOEIC, Anda dapat mendaftar secara umum melalui website resmi. Terima kasih atas perhatian Anda.</p> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body p-4">
        <h3 class="card-title fw-bold text-success mb-3">Pendaftaran Peserta</h3>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="pendaftaranForm" method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 row">
                <label for="nama_lengkap" class="col-md-3 col-form-label">Nama Lengkap</label>
                <div class="col-md-9">
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control" placeholder="Masukkan nama lengkap Anda" required>

                    @error('nama_lengkap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nim_nik" class="col-md-3 col-form-label">NIM <small class="text-muted"></small></label>
                <div class="col-md-9">
                    <input type="text" id="nim_nik" name="nim_nik" value="{{ old('nim_nik') }}" class="form-control" placeholder="Masukkan NIM Anda" required pattern="\d{8,15}">
                    @error('nim_nik')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div id="nimValidation" class="mt-2"></div>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-md-3 col-form-label">Email</label>
                <div class="col-md-9">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Masukkan email aktif" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

           <div class="mb-3 row">
                <label for="alamat_asal" class="col-md-3 col-form-label">Alamat Asal</label>
                <div class="col-md-9">
                    <textarea id="alamat_asal" name="alamat_asal" class="form-control" required>{{ old('alamat_asal') }}</textarea>
                    @error('alamat_asal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="alamat_sekarang" class="col-md-3 col-form-label">Alamat Sekarang</label>
                <div class="col-md-9">
                    <textarea id="alamat_sekarang" name="alamat_sekarang" class="form-control" required>{{ old('alamat_sekarang') }}</textarea>
                    @error('alamat_sekarang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>



            <!-- Dropdown Kampus -->
            <div class="mb-3 row">
                <label for="kampus" class="col-md-3 col-form-label">Kampus</label>
                <div class="col-md-9">
                    <select id="kampus" name="kampus" class="form-select" required>
                        <option value="" selected disabled>Pilih Kampus</option>
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
                    <select id="jurusan" name="jurusan" class="form-select" required>
                        <option value="" selected disabled>Pilih Jurusan</option>
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
                    <select id="program_studi" name="program_studi" class="form-select" required>
                        <option value="" selected disabled>Pilih Program Studi</option>
                    </select>
                    @error('program_studi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

          
        
            <div class="mb-3 row">
                <label for="foto_formal" class="col-md-3 col-form-label">Foto Formal</label>
                <div class="col-md-9">
                    <input type="file" id="foto_formal" name="foto_formal" class="form-control" accept="image/jpeg,image/png" required>
                    <small class="text-muted">Format: JPG/PNG, maksimal 2MB</small>
                    @error('foto_formal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
              <div class="mb-3 row">
                <label for="upload_ktp" class="col-md-3 col-form-label">Upload KTP</label>
                <div class="col-md-9">
                    <input type="file" id="upload_ktp" name="upload_ktp" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                    <small class="text-muted">Format: PDF/JPG/PNG, maksimal 2MB</small>
                    @error('upload_ktp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="upload_ktm" class="col-md-3 col-form-label">Upload KTM</label>
                <div class="col-md-9">
                    <input type="file" id="upload_ktm" name="upload_ktm" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                    <small class="text-muted">Format: PDF/JPG/PNG, maksimal 2MB</small>
                    @error('upload_ktm')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success" id="submitBtn">Daftar Sekarang</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Kembali</a>
        </form>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Data untuk dropdown
const dataJurusan = {
    "utama": [
        {value: "TE", label: "Teknik Elektro"},
        {value: "TM", label: "Teknik Mesin"},
        {value: "TS", label: "Teknik Sipil"},
        {value: "AK", label: "Akuntansi"},
        {value: "AN", label: "Administrasi Niaga"},
        {value: "TK", label: "Teknik Kimia"},
        {value: "TI", label: "Teknologi Informasi"}
    ],
    "kediri": [
        {value: "TE", label: "Teknik Elektro"}, 
        {value: "TM", label: "Teknik Mesin"},
        {value: "TI", label: "Teknologi Informasi"},
        {value: "AK", label: "Akuntansi"}
    ],
    "pamekasan": [
        {value: "TM", label: "Teknik Mesin"},
        {value: "AK", label: "Akuntansi"},
        {value: "AN", label: "Administrasi Niaga"}
    ],
    "lumajang": [
        {value: "TI", label: "Teknologi Informasi"},
        {value: "TS", label: "Teknik Sipil"},
        {value: "AK", label: "Akuntansi"}
    ]
};

const dataProgramStudi = {
    "TE": ["D-IV Teknik Elektronika", "D-IV Sistem Kelistrikan", "D-IV Jaringan Telekomunikasi Digital"],
    "TM": ["D-IV Teknik Otomotif Elektronik", "D-IV Teknik Mesin Produksi dan Perawatan"],
    "TS": ["D-IV Teknik Konstruksi Gedung", "D-IV Teknik Perencanaan Jalan dan Jembatan"],
    "AK": ["D-IV Akuntansi Keuangan", "D-IV Akuntansi Manajerial"],
    "AN": ["D-IV Administrasi Bisnis", "D-IV Administrasi Perkantoran"],
    "TK": ["D-IV Teknik Kimia Industri", "D-IV Teknik Pengolahan Minyak dan Gas"],
    "TI": ["D-IV Teknologi Informasi", "D-IV Sistem Informasi"]
};

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
        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...');

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
                if(response.success) {
                    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                    form.reset();
                    $('#jurusan').html('<option value="" selected disabled>Pilih Jurusan</option>');
                    $('#program_studi').html('<option value="" selected disabled>Pilih Program Studi</option>');
                    
                    // Reload page after 2 seconds to show new data
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    if(response.errors) {
                        for (const key in response.errors) {
                            let errorHtml = response.errors[key].join('<br>');
                            $(`[name="${key}"]`).next('.text-danger').html(errorHtml);
                        }
                    }
                    if(response.message) {
                        $('#errorModalBody').html(`<p><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> ${response.message}</p>`);
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    }
                }
            },
            error: function(xhr) {
                let errorMessage = 'Terjadi kesalahan pada server';
                if(xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                $('#errorModalBody').html(`<p><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i> ${errorMessage}</p>`);
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            },
            complete: function() {
                submitBtn.prop('disabled', false);
                submitBtn.html('Daftar Sekarang');
            }
        });
    });
});
</script>
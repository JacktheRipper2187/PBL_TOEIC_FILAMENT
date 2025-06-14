<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            /* Agar padding dan border dihitung dalam lebar elemen */
        }

        body {
            background: url('assets/img/graha.png') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(74, 73, 73, 0.1);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #007bff, #007bff);
            color: white;
            padding: 25px 30px;
        }

        .form-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .form-header p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .form-body {
            padding: 30px;
        }

        .form-section {
            margin-bottom: 15px;
            /* Reduced margin */
        }

        .section-title {
            display: flex;
            align-items: center;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #007bff;
        }

        .section-title svg {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            font-size: 14px;
        }

        label span.required {
            color: #e53e3e;
        }

        input,
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            line-height: 1.3;
            transition: border-color 0.3s;
        }


        input:focus,
        select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(118, 120, 128, 0.2);
        }

        .error-message {
            color: #e53e3e;
            font-size: 13px;
            margin-top: 5px;
        }

        .form-footer {
            margin-top: 20px;
            display: flex;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
        }

        .btn-kembali {
            background-color: #6c757d;
            color: white;
        }

        .btn-kembali:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .btn-register {
            background: linear-gradient(135deg, #007bff, #007bff);
            color: white;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(79, 107, 235, 0.3);
        }

        .btn svg {
            width: 18px;
            height: 18px;
        }

        .btn-kembali svg {
            margin-right: 6px;
        }

        .btn-register svg {
            margin-left: 6px;
        }

        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            max-width: 90%;
        }

        .modal-footer {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px auto;
            }

            .form-header {
                padding: 20px;
            }

            .form-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <h1>Register Mahasiswa</h1>
                <p>Silakan lengkapi formulir pendaftaran berikut</p>
            </div>

            <div class="form-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Data User Section -->
                    <div class="form-section">
                        <div class="section-title">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Data Akun
                        </div>

                        <div class="form-group">
                            <label for="username">Username <span class="required">*</span></label>
                            <input id="username" type="text" class="@error('username') error-field @enderror"
                                name="username" value="{{ old('username') }}" required autocomplete="username"
                                autofocus>
                            @error('username')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password <span class="required">*</span></label>
                            <input id="password" type="password" class="@error('password') error-field @enderror"
                                name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password <span
                                    class="required">*</span></label>
                            <input id="password_confirmation" type="password"
                                class="@error('password_confirmation') error-field @enderror"
                                name="password_confirmation" required autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Data Mahasiswa Section -->
                    <div class="form-section">
                        <div class="section-title">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                            </svg>
                            Data Mahasiswa
                        </div>

                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
                            <input id="nama_lengkap" type="text" class="@error('nama_lengkap') error-field @enderror"
                                name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                            @error('nama_lengkap')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nim">NIM<span class="required">*</span></label>
                            <input id="nim" type="text" class="@error('nim') error-field @enderror"
                                name="nim" value="{{ old('nim') }}" required>
                            @error('nim')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_telp">No.Telepon <span class="required">*</span></label>
                            <input id="no_telp" type="text" class="@error('no_telp') error-field @enderror"
                                name="no_telp" value="{{ old('no_telp') }}" required>
                            @error('no_telp')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input id="email" type="text" class="@error('email') error-field @enderror"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kampus">Kampus <span class="required">*</span></label>
                            <select id="kampus" name="kampus" class="@error('kampus') error-field @enderror"
                                required>
                                <option value="">Pilih Kampus</option>
                                <option value="utama" {{ old('kampus') == 'utama' ? 'selected' : '' }}>Kampus Utama
                                </option>
                                <option value="kediri" {{ old('kampus') == 'kediri' ? 'selected' : '' }}>Kampus Kediri
                                </option>
                                <option value="lumajang" {{ old('kampus') == 'lumajang' ? 'selected' : '' }}>Kampus
                                    Lumajang</option>
                                <option value="pamekasan" {{ old('kampus') == 'pamekasan' ? 'selected' : '' }}>Kampus
                                    Pamekasan</option>
                            </select>
                            @error('kampus')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Jurusan <span class="required">*</span></label>
                            <select id="jurusan" name="jurusan" class="@error('jurusan') error-field @enderror"
                                required>
                                <option value="">Pilih Jurusan</option>
                                @if (old('kampus'))
                                    @php
                                        $jurusanOptions = [
                                            'utama' => [
                                                'TE' => 'Teknik Elektro',
                                                'TM' => 'Teknik Mesin',
                                                'TS' => 'Teknik Sipil',
                                                'AK' => 'Akuntansi',
                                                'AN' => 'Administrasi Niaga',
                                                'TK' => 'Teknik Kimia',
                                                'TI' => 'Teknologi Informasi',
                                            ],
                                            'kediri' => [
                                                'TI' => 'Teknologi Informasi',
                                                'TM' => 'Teknik Mesin',
                                                'AK' => 'Akuntansi',
                                                'TE' => 'Teknik Elektro',
                                            ],
                                            'lumajang' => [
                                                'TI' => 'Teknologi Informasi',
                                                'TS' => 'Teknik Sipil',
                                                'AK' => 'Akuntansi',
                                            ],
                                            'pamekasan' => [
                                                'TM' => 'Teknik Mesin',
                                                'AK' => 'Akuntansi',
                                                'AN' => 'Administrasi Niaga',
                                            ],
                                        ];
                                    @endphp
                                    @foreach ($jurusanOptions[old('kampus')] ?? [] as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('jurusan') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('jurusan')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prodi">Program Studi <span class="required">*</span></label>
                            <select id="prodi" name="prodi" class="@error('prodi') error-field @enderror"
                                required>
                                <option value="">Pilih Program Studi</option>
                                @if (old('jurusan'))
                                    @php
                                        $prodiOptions = [
                                            'TE' => [
                                                'D-IV Teknik Elektronika',
                                                'D-IV Sistem Kelistrikan',
                                                'D-IV Jaringan Telekomunikasi Digital',
                                                'D-III Teknik Elektronika',
                                                'D-III Teknik Listrik',
                                                'D-III Teknik Telekomunikasi',
                                            ],
                                            'TM' => [
                                                'D-IV Teknik Otomotif Elektronik',
                                                'D-IV Teknik Mesin Produksi dan Perawatan',
                                                'D-III Teknik Mesin',
                                                'D-III Teknologi Pemeliharaan Pesawat Udara',
                                            ],
                                            'TS' => [
                                                'D-IV Manajemen Rekayasa Konstruksi',
                                                'D-IV Teknologi Rekayasa Konstruksi Jalan dan Jembatan',
                                                'D-III Teknik Sipil',
                                                'D-III Teknik Konstruksi Jalan dan Jembatan',
                                                'D-III Teknologi Pertambangan',
                                            ],
                                            'AK' => ['D-IV Akuntansi Manajemen', 'D-IV Keuangan', 'D-III Akuntansi'],
                                            'AN' => [
                                                'D-IV Manajemen Pemasaran',
                                                'D-IV Bahasa Inggris untuk Komunikasi Bisnis dan Profesional',
                                                'D-IV Pengelolaan Arsip dan Rekaman Informasi',
                                                'D-IV Usaha Perjalanan Wisata',
                                                'D-IV Bahasa Inggris untuk Industri Pariwisata',
                                                'D-III Administrasi Bisnis',
                                            ],
                                            'TK' => ['D-IV Teknologi Kimia Industri', 'D-III Teknik Kimia'],
                                            'TI' => [
                                                'D-IV Teknik Informatika',
                                                'D-IV Sistem Informasi Bisnis',
                                                'D-II Pengembangan Piranti Lunak Situs',
                                            ],
                                        ];
                                    @endphp
                                    @foreach ($prodiOptions[old('jurusan')] ?? [] as $prodi)
                                        <option value="{{ $prodi }}"
                                            {{ old('prodi') == $prodi ? 'selected' : '' }}>
                                            {{ $prodi }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('prodi')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Footer with Buttons -->
                    <div class="form-footer">
                        <button type="button" class="btn btn-kembali" id="btnKembali">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H15a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Kembali
                        </button>

                        <button type="submit" class="btn btn-register">
                            Register
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="confirmationModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <h3>Konfirmasi</h3>
            <p>Apakah Anda yakin ingin kembali? Semua data yang telah diisi akan hilang.</p>
            <div class="modal-footer">
                <button type="button" id="confirmLeave" class="btn btn-register">Ya, Tinggalkan</button>
                <button type="button" id="cancelLeave" class="btn btn-kembali">Batal</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Kampus, Jurusan, Prodi dropdown logic
            const kampusSelect = document.getElementById('kampus');
            const jurusanSelect = document.getElementById('jurusan');
            const prodiSelect = document.getElementById('prodi');

            // Data untuk select options
            const jurusanData = {
                "utama": {
                    "TE": "Teknik Elektro",
                    "TM": "Teknik Mesin",
                    "TS": "Teknik Sipil",
                    "AK": "Akuntansi",
                    "AN": "Administrasi Niaga",
                    "TK": "Teknik Kimia",
                    "TI": "Teknologi Informasi"
                },
                "kediri": {
                    "TI": "Teknologi Informasi",
                    "TM": "Teknik Mesin",
                    "AK": "Akuntansi",
                    "TE": "Teknik Elektro"
                },
                "lumajang": {
                    "TI": "Teknologi Informasi",
                    "TS": "Teknik Sipil",
                    "AK": "Akuntansi"
                },
                "pamekasan": {
                    "TM": "Teknik Mesin",
                    "AK": "Akuntansi",
                    "AN": "Administrasi Niaga"
                }
            };

            const prodiData = {
                "TE": ["D-IV Teknik Elektronika", "D-IV Sistem Kelistrikan",
                    "D-IV Jaringan Telekomunikasi Digital", "D-III Teknik Elektronika",
                    "D-III Teknik Listrik", "D-III Teknik Telekomunikasi"
                ],
                "TM": ["D-IV Teknik Otomotif Elektronik", "D-IV Teknik Mesin Produksi dan Perawatan",
                    "D-III Teknik Mesin", "D-III Teknologi Pemeliharaan Pesawat Udara"
                ],
                "TS": ["D-IV Manajemen Rekayasa Konstruksi",
                    "D-IV Teknologi Rekayasa Konstruksi Jalan dan Jembatan", "D-III Teknik Sipil",
                    "D-III Teknik Konstruksi Jalan dan Jembatan", "D-III Teknologi Pertambangan"
                ],
                "AK": ["D-IV Akuntansi Manajemen", "D-IV Keuangan", "D-III Akuntansi"],
                "AN": ["D-IV Manajemen Pemasaran",
                    "D-IV Bahasa Inggris untuk Komunikasi Bisnis dan Profesional",
                    "D-IV Pengelolaan Arsip dan Rekaman Informasi", "D-IV Usaha Perjalanan Wisata",
                    "D-IV Bahasa Inggris untuk Industri Pariwisata", "D-III Administrasi Bisnis"
                ],
                "TK": ["D-IV Teknologi Kimia Industri", "D-III Teknik Kimia"],
                "TI": ["D-IV Teknik Informatika", "D-IV Sistem Informasi Bisnis",
                    "D-II Pengembangan Piranti Lunak Situs"
                ]
            };

            // Event listener untuk kampus
            kampusSelect.addEventListener('change', function() {
                const kampus = this.value;

                // Reset jurusan dan prodi
                jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';
                prodiSelect.innerHTML = '<option value="">Pilih Program Studi</option>';

                if (kampus) {
                    // Isi jurusan berdasarkan kampus
                    const jurusans = jurusanData[kampus] || {};
                    for (const [value, label] of Object.entries(jurusans)) {
                        const option = document.createElement('option');
                        option.value = value;
                        option.textContent = label;
                        jurusanSelect.appendChild(option);
                    }

                    jurusanSelect.disabled = false;
                } else {
                    jurusanSelect.disabled = true;
                    prodiSelect.disabled = true;
                }
            });

            // Event listener untuk jurusan
            jurusanSelect.addEventListener('change', function() {
                const jurusan = this.value;

                // Reset prodi
                prodiSelect.innerHTML = '<option value="">Pilih Program Studi</option>';

                if (jurusan) {
                    // Isi prodi berdasarkan jurusan
                    const prodis = prodiData[jurusan] || [];
                    prodis.forEach(prodi => {
                        const option = document.createElement('option');
                        option.value = prodi;
                        option.textContent = prodi;
                        prodiSelect.appendChild(option);
                    });

                    prodiSelect.disabled = false;
                } else {
                    prodiSelect.disabled = true;
                }
            });

            // Inisialisasi jika ada data old (setelah validasi gagal)
            @if (old('kampus'))
                kampusSelect.dispatchEvent(new Event('change'));
                @if (old('jurusan'))
                    jurusanSelect.value = "{{ old('jurusan') }}";
                    jurusanSelect.dispatchEvent(new Event('change'));
                    @if (old('prodi'))
                        prodiSelect.value = "{{ old('prodi') }}";
                    @endif
                @endif
            @endif

            // Modal functionality
            const modal = document.getElementById('confirmationModal');
            const btnKembali = document.getElementById('btnKembali');
            const confirmLeave = document.getElementById('confirmLeave');
            const cancelLeave = document.getElementById('cancelLeave');

            btnKembali.addEventListener('click', function() {
                modal.style.display = 'flex';
            });

            confirmLeave.addEventListener('click', function() {
                window.location.href = '/login';
            });

            cancelLeave.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        });
    </script>
</body>

</html>
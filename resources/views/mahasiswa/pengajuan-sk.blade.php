<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan TOEIC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }
        table.header {
            width: 100%;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        table.header td {
            vertical-align: middle;
        }
        .logo {
            width: 90px;
        }
        .header-text h3,
        .header-text h4,
        .header-text p {
            margin: 4px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<table class="header">
    <tr>
        <!-- Kolom kiri (Logo) -->
        <td style="width: 100px;">
            <img 
              src="{{ public_path('assets/img/Logo Polinema.png') }}" 
              class="logo" 
              alt="Logo Polinema">
        </td>

        <!-- Kolom tengah (Teks, akan tampak di tengah halaman) -->
        <td class="header-text" style="text-align: center;">
            <h3>KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</h3>
            <h4>UNIT PENUNJANG AKADEMIK BAHASA POLITEKNIK NEGERI MALANG</h4>
            <p>Jl. Soekarno Hatta No.9 Malang 65141<br>
               Telp (0341) 404424 – 404425 Fax (0341) 404420</p>
        </td>

        <!-- Kolom kanan kosong (agar teks benar-benar center) -->
        <td style="width: 100px;"></td>
    </tr>
</table>


    <h3 style="text-align: center;">SURAT KETERANGAN SUDAH MENGIKUTI TOEIC</h3>
    <p style="text-align: center;">Nomor: /PL2. UPA BHS/2024</p>

    <p>Yang bertanda tangan di bawah ini:</p>
    <ol>
        <li>Atiqah Nurul Asri, S.Pd., M.Pd.<br>
            NIP. 197606252005012001<br>
            Penata Tingkat 1/ III D Kepala UPA Bahasa
        </li>
    </ol>

    <p>Dengan ini menyatakan bahwa:</p>
    <p>Nama: <strong>{{ $nama ?? '-' }}</strong></p>
    <p>NIM: <strong>{{ $nim ?? '-' }}</strong></p>
    <p>Program Studi/Jurusan: <strong>{{ $prodi ?? '-' }} / {{ $jurusan ?? '-' }}</strong></p>

    <p>telah mengikuti ujian TOEIC dan mendapat sertifikat yang diterbitkan oleh ETS sebanyak dua kali dengan nilai di bawah ketentuan yang berlaku. Sertifikat terlampir.</p>
    <p>Surat ini dibuat sebagai pengganti syarat pengambilan ijazah.</p>

    <br><br>
    <p style="text-align: right;">Kepala UPA Bahasa,</p>
    <br><br><br>
    <p style="text-align: right;">
        Atiqah Nurul Asri, S.Pd., M.Pd.<br>
        NIP. 197606252005012001
    </p>
</body>
</html>

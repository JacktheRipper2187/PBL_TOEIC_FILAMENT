<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi SK TOEIC</title>
</head>
<body>
    <div style="text-align: center; margin-top: 50px;">
        @if($sk)
            <h2>SK TOEIC Valid</h2>
            <p>Nomor: SK/{{ str_pad($sk->id, 3, '0', STR_PAD_LEFT) }}/PL2.UPA-BHS/{{ $sk->created_at->format('Y') }}</p>
            <p>Atas nama: {{ $sk->mahasiswa->nama_lengkap }}</p>
            <p>NIM: {{ $sk->mahasiswa->nim }}</p>
            <p>Tanggal diterbitkan: {{ $sk->created_at->format('d F Y') }}</p>
        @else
            <h2 style="color: red;">SK Tidak Ditemukan</h2>
        @endif
    </div>
</body>
</html>
<?php

namespace App\Exports;

use App\Models\Pendaftar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftarsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pendaftar::select('nama_lengkap', 'nim_nik', 'email', 'kampus', 'jurusan', 'program_studi')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIM/NIK',
            'Email',
            'Kampus',
            'Jurusan',
            'Prodi',
        ];
    }
}
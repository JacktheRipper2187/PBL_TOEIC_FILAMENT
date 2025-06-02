<?php

namespace App\Imports;

use App\Models\HasilToeic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HasilToeicImport implements ToModel, WithHeadingRow
{
   public function model(array $row)
{
    // Validasi wajib yang tidak boleh kosong, misal 'l', 'r', 'tot'
    if (empty($row['l']) || empty($row['r']) || empty($row['tot'])) {
        // skip baris ini supaya tidak error di DB
        return null;
    }

    return new HasilToeic([
        'name' => $row['name'] ?? null,
        'nim' => $row['nim'] ?? null,
        'l' => (int) $row['l'],
        'r' => (int) $row['r'],
        'tot' => (int) $row['tot'],
        'group' => $row['group'] ?? null,
        'position' => $row['position'] ?? null,
        'category' => $row['category'] ?? null,
        'test_date' => $this->parseDate($row['test_date']),
    ]);
}

    private function parseDate($value)
    {
        try {
            if (is_numeric($value)) {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            }
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // atau throw jika perlu
        }
    }
}

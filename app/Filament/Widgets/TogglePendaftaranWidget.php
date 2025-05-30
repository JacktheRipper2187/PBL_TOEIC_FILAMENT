<?php

namespace App\Filament\Widgets;

use App\Models\JadwalPendaftaran;
use Filament\Widgets\Widget;

class TogglePendaftaranWidget extends Widget
{
    protected static string $view = 'filament.widgets.toggle-pendaftaran';

    public function setManualStatus($status)
    {
        $jadwal = JadwalPendaftaran::latest()->first();
        if ($jadwal) {
            $jadwal->status_manual = $status; // bisa true atau false
            $jadwal->save();
        }
    }

    public function setToAutomatic()
    {
        $jadwal = JadwalPendaftaran::latest()->first();
        if ($jadwal) {
            $jadwal->status_manual = null; // reset ke otomatis
            $jadwal->save();
        }
    }

    protected function getViewData(): array
    {
        $jadwal = JadwalPendaftaran::latest()->first();
        return [
            'status' => $jadwal?->is_pendaftaran_dibuka,
            'override' => $jadwal?->status_manual,
        ];
    }
}

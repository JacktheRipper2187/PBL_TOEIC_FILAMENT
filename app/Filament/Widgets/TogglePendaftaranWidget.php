<?php

namespace App\Filament\Widgets;

use App\Models\JadwalPendaftaran;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class TogglePendaftaranWidget extends Widget
{
    protected static string $view = 'filament.widgets.toggle-pendaftaran';

    public $selectedJadwalId;
    public $jadwals;

    // Computed property for status
    // Di widget admin
    public function getStatusProperty()
    {
        $schedule = JadwalPendaftaran::find($this->selectedJadwalId);

        if (!$schedule) return false;

        return $schedule->isActive();
    }

    // Computed property for override status
    public function getOverrideProperty()
    {
        if (!$this->selectedJadwalId) return null;

        $jadwal = JadwalPendaftaran::find($this->selectedJadwalId);
        return $jadwal ? $jadwal->status_manual : null;
    }

    public function mount()
    {
        $this->jadwals = JadwalPendaftaran::all();
        $this->selectedJadwalId = $this->jadwals->first()->id ?? null;
    }

    public function setManualStatus($status)
    {
        DB::transaction(function () use ($status) {
            $jadwal = JadwalPendaftaran::find($this->selectedJadwalId);

            // Update status dan pastikan timestamp berubah
            $jadwal->update([
                'status_manual' => (int)$status,
                'updated_at' => now()
            ]);

            // Clear cache
            Cache::forget('active_gratis_schedules');
            $this->dispatch('statusUpdated');
        });
    }

    public function setToAutomatic()
    {
        DB::transaction(function () {
            JadwalPendaftaran::where('id', $this->selectedJadwalId)
                ->update(['status_manual' => null]);

            $this->clearCache();
        });
    }

    protected function clearCache()
    {
        Cache::forget('active_gratis_schedules');
        $this->dispatch('refreshStatus');
    }

    // Helper method to get current jadwal
    public function getCurrentJadwal()
    {
        return JadwalPendaftaran::find($this->selectedJadwalId);
    }
}

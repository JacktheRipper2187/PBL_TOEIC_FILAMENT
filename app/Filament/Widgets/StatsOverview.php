<?php

namespace App\Filament\Widgets;

use App\Models\JadwalPendaftaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Mahasiswa;
use App\Models\Pendaftar;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $totalKuota = JadwalPendaftaran::sum('kuota');
        $totalTerdaftar = Pendaftar::count();
        $kuotaTersedia = $totalKuota - $totalTerdaftar;

        return [
            Card::make('Mahasiswa Terdaftar', $totalTerdaftar)
                ->icon('heroicon-o-user-group')
                ->description('Data real-time')
                ->color('success'),

            Card::make('Kuota Pendaftaran Tersedia', $kuotaTersedia)
                ->icon('heroicon-o-user-minus')
                ->description('Tersisa dari total kuota')
                ->color($kuotaTersedia > 0 ? 'info' : 'danger'),

            Card::make('Total Kuota Pendaftaran', $totalKuota)
                ->icon('heroicon-o-archive-box')
                ->description('Kuota awal keseluruhan')
                ->color('warning'),
        ];
    }
}

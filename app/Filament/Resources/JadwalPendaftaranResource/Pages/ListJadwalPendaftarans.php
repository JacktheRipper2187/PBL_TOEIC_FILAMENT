<?php

namespace App\Filament\Resources\JadwalPendaftaranResource\Pages;

use App\Filament\Resources\JadwalPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPendaftarans extends ListRecords
{
    protected static string $resource = JadwalPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
         return [
            Actions\CreateAction::make()
              ->icon('heroicon-m-plus')
        ];
    }
}

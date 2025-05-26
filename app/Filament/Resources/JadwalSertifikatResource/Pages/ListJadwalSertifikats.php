<?php

namespace App\Filament\Resources\JadwalSertifikatResource\Pages;

use App\Filament\Resources\JadwalSertifikatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalSertifikats extends ListRecords
{
    protected static string $resource = JadwalSertifikatResource::class;

    protected function getHeaderActions(): array
    {
         return [
            Actions\CreateAction::make()
              ->icon('heroicon-m-plus')
        ];
    }
}

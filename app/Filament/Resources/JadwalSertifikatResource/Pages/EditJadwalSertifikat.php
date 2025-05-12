<?php

namespace App\Filament\Resources\JadwalSertifikatResource\Pages;

use App\Filament\Resources\JadwalSertifikatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalSertifikat extends EditRecord
{
    protected static string $resource = JadwalSertifikatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

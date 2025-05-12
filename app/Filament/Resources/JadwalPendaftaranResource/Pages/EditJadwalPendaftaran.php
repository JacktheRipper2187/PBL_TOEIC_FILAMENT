<?php

namespace App\Filament\Resources\JadwalPendaftaranResource\Pages;

use App\Filament\Resources\JadwalPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalPendaftaran extends EditRecord
{
    protected static string $resource = JadwalPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

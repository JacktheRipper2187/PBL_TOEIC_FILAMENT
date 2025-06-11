<?php

namespace App\Filament\Resources\JadwalPelaksanaanResource\Pages;

use App\Filament\Resources\JadwalPelaksanaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalPelaksanaan extends EditRecord
{
    protected static string $resource = JadwalPelaksanaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

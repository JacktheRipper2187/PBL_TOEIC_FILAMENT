<?php

namespace App\Filament\Resources\KonfirmasiSkResource\Pages;

use App\Filament\Resources\KonfirmasiSkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKonfirmasiSk extends EditRecord
{
    protected static string $resource = KonfirmasiSkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

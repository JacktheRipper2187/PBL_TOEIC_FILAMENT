<?php

namespace App\Filament\Resources\MahasiswaTerdaftarResource\Pages;

use App\Filament\Resources\MahasiswaTerdaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMahasiswaTerdaftar extends EditRecord
{
    protected static string $resource = MahasiswaTerdaftarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

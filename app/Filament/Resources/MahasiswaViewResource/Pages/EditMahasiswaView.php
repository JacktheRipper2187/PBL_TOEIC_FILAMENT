<?php

namespace App\Filament\Resources\MahasiswaViewResource\Pages;

use App\Filament\Resources\MahasiswaViewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMahasiswaView extends EditRecord
{
    protected static string $resource = MahasiswaViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\FormPendaftaranResource\Pages;

use App\Filament\Resources\FormPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormPendaftaran extends EditRecord
{
    protected static string $resource = FormPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

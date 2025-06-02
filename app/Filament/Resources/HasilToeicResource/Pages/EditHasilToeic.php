<?php

namespace App\Filament\Resources\HasilToeicResource\Pages;

use App\Filament\Resources\HasilToeicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHasilToeic extends EditRecord
{
    protected static string $resource = HasilToeicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

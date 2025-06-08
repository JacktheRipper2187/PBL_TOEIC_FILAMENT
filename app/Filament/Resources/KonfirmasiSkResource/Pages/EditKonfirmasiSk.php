<?php

namespace App\Filament\Resources\KonfirmasiSkResource\Pages;

use App\Filament\Resources\KonfirmasiSkResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class EditKonfirmasiSk extends EditRecord
{
    protected static string $resource = KonfirmasiSkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generateSk')
                ->label('Generate SK')
                ->icon('heroicon-o-document-check')
                ->color('success')
                ->requiresConfirmation()
                ->action(function () {
                    $record = $this->record;

                    // Panggil controller kamu untuk generate SK
                    app(\App\Http\Controllers\KonfirmasiSkMahasiswaController::class)->generateSk($record->id);

                    $this->fillForm();
                    Notification::make()
                        ->title('Berhasil')
                        ->body('Surat Keterangan berhasil digenerate.')
                        ->success()
                        ->send();
                }),
        ];
    }
}

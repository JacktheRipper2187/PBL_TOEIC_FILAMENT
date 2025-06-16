<?php

namespace App\Filament\Resources\KonfirmasiSkResource\Pages;

use App\Filament\Resources\KonfirmasiSkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditKonfirmasiSk extends EditRecord
{
    protected static string $resource = KonfirmasiSkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Status diperbarui')
            ->body('Status pengajuan SK TOEIC berhasil diperbarui.');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
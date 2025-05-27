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
             Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),
        ];
    }

        protected function getSaveFormAction(): Actions\Action
    {
        return parent::getSaveFormAction()
            ->icon('heroicon-o-check'); // Icon centang untuk tombol simpan
    }

    protected function getCancelFormAction(): Actions\Action
    {
        return parent::getCancelFormAction()
            ->icon('heroicon-o-x-mark') // Icon silang untuk tombol cancel
            ->color('gray'); // Warna netral, otomatis adaptif tema
    }
}

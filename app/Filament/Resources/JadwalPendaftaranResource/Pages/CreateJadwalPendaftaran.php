<?php

namespace App\Filament\Resources\JadwalPendaftaranResource\Pages;

use App\Filament\Resources\JadwalPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJadwalPendaftaran extends CreateRecord
{
    protected static string $resource = JadwalPendaftaranResource::class;

        // Tombol "Create"
    protected function getCreateFormAction(): Actions\Action
    {
        return parent::getCreateFormAction()
            ->icon('heroicon-s-document-plus'); // Icon centang
    }

    // Tombol "Create Another"
    protected function getCreateAnotherFormAction(): Actions\Action
    {
        return parent::getCreateAnotherFormAction()
            ->icon('heroicon-s-document-duplicate'); // solid
            
    }

    protected function getCancelFormAction(): Actions\Action
    {
        return parent::getCancelFormAction()
            ->icon('heroicon-o-x-mark')
            ->color('gray');
    }
}

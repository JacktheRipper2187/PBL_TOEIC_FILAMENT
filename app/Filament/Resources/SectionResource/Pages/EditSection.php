<?php

namespace App\Filament\Resources\SectionResource\Pages;

use App\Filament\Resources\SectionResource;
use App\Models\section;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditSection extends EditRecord
{
    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->icon('heroicon-o-trash')
            ->after(
            function (section $record) {
                if ($record->thumbnail) {
                    // Hapus file thumbnail dari storage
                    Storage::disk('public')->delete($record->thumbnail);
                } 
            } 
            ),
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

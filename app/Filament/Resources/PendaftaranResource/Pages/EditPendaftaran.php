<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use App\Models\pendaftaran;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPendaftaran extends EditRecord
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
           Actions\DeleteAction::make()->after(
            function (pendaftaran $record) {
                if ($record->thumbnail) {
                    // Hapus file thumbnail dari storage
                    Storage::disk('public')->delete($record->thumbnail);
                } 
            }
            ),
        ];
    }
}

<?php

namespace App\Filament\Resources\MahasiswaViewResource\Pages;

use App\Filament\Resources\MahasiswaViewResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMahasiswaViews extends ListRecords
{
    // Reference to the MahasiswaViewResource
    protected static string $resource = MahasiswaViewResource::class;

    // No actions (edit, create, delete) for this view-only resource
    protected function getActions(): array
    {
        return [];
    }
}

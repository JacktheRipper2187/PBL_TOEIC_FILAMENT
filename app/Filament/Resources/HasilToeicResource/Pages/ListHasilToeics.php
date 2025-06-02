<?php

namespace App\Filament\Resources\HasilToeicResource\Pages;

use App\Filament\Resources\HasilToeicResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HasilToeicImport;
use Exception;

class ListHasilToeics extends ListRecords
{
    protected static string $resource = HasilToeicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Import Excel')
                ->form([
                    FileUpload::make('file')
                        ->label('File Excel')
                        ->required()
                        ->disk('local') // <- Tambahan penting
                        ->directory('imports') // <- Temp folder penyimpanan
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                        ]),
                ])
                ->action(function (array $data) {
                    try {
                        $filePath = storage_path('app/' . $data['file']);
                        Excel::import(new HasilToeicImport, $filePath);

                        Notification::make()
                            ->title('Import berhasil!')
                            ->body('Data hasil TOEIC berhasil diimpor.')
                            ->success()
                            ->send();
                    } catch (Exception $e) {
                        Notification::make()
                            ->title('Gagal mengimpor!')
                            ->body('Terjadi kesalahan: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}

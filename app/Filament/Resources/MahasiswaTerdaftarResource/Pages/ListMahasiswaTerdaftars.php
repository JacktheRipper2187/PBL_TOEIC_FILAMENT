<?php

namespace App\Filament\Resources\MahasiswaTerdaftarResource\Pages;

use App\Filament\Resources\MahasiswaTerdaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
use Filament\Forms;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaTerdaftarImport;
use Illuminate\Support\HtmlString;

class ListMahasiswaTerdaftars extends ListRecords
{
    protected static string $resource = MahasiswaTerdaftarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
              ->icon('heroicon-m-plus'),
            Actions\Action::make('import')
                ->label('Import Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success') // hijau
                ->modalHeading('Import Mahasiswa Terdaftar')
                ->modalDescription(new HtmlString('
    <div class="mb-4">
        <a href="' . route('template.mahasiswa-terdaftar') . '" class="inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset filament-button dark:focus:ring-offset-0 h-9 px-4 text-sm shadow focus:ring-white border-transparent bg-success-600 hover:bg-success-500 focus:bg-success-700 focus:ring-offset-success-700 filament-page-button-action text-success-50 dark:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48" fill="none">
                <rect width="48" height="48" rx="8" fill="#217346"/>
                <text x="12" y="34" font-size="24" fill="white" font-family="Arial" font-weight="bold">X</text>
            </svg>
            Download Template Excel
        </a>
    </div>
    <div class="text-sm text-gray-500">
        Pastikan file sesuai format template sebelum di-upload.
    </div>
'))
                ->form([
                    Forms\Components\FileUpload::make('file')
                        ->disk('public')
                        ->directory('imports') // opsional: simpan ke subfolder
                        ->required()
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                        ])
                        ->storeFiles()
                ])
                ->action(function (array $data) {
                    $filePath = $data['file']; // string path seperti "file-uploads/abc.xlsx"

                    if (!$filePath) {
                        Notification::make()
                            ->title('File belum dipilih!')
                            ->danger()
                            ->send();
                        return;
                    }

                    $fileName = basename($filePath); // Ambil nama file dari path

                    if (str_contains($fileName, 'template_mahasiswa_terdaftar')) {
                        Notification::make()
                            ->title('Jangan upload file template kosong. Silakan isi data mahasiswa terlebih dahulu.')
                            ->danger()
                            ->send();
                        return;
                    }

                    $sourcePath = storage_path('app/public/' . $filePath); // asumsi disimpan di disk 'public'

                    if (!file_exists($sourcePath)) {
                        Notification::make()
                            ->title('File tidak ditemukan di server.')
                            ->danger()
                            ->send();
                        return;
                    }

                    try {
                        Excel::import(new MahasiswaTerdaftarImport, $sourcePath);

                        Notification::make()
                            ->title('Import berhasil!')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Terjadi error saat import: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}

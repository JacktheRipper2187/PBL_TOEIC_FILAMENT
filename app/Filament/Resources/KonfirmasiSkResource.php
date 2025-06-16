<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KonfirmasiSkResource\Pages;
use App\Models\KonfirmasiSk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use App\Http\Controllers\KonfirmasiSkMahasiswaController;
use Illuminate\Support\Facades\Log;

class KonfirmasiSkResource extends Resource
{
    protected static ?string $model = KonfirmasiSk::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationGroup = 'Manajemen SK TOEIC';
    protected static ?string $modelLabel = 'Validasi SK TOEIC';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.nama_lengkap')
                    ->label('Nama Mahasiswa')
                    ->searchable()
                    ->sortable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('mahasiswa.nim')
                    ->label('NIM')
                    ->searchable()
                    ->default('-'),

                // Certificate preview columns
                Tables\Columns\TextColumn::make('sertifikat_1')
                    ->label('Sertifikat 1')
                    ->formatStateUsing(fn() => '📄 Lihat')
                    ->action(
                        Tables\Actions\Action::make('previewSertifikat1')
                            ->modalHeading('Preview Sertifikat 1')
                            ->modalContent(
                                fn($record) => $record?->sertifikat_1
                                    ? view('components.preview-pdf', ['fileUrl' => Storage::url($record->sertifikat_1)])
                                    : '<p class="p-4">File tidak tersedia</p>'
                            )
                    ),

                Tables\Columns\TextColumn::make('sertifikat_2')
                    ->label('Sertifikat 2')
                    ->formatStateUsing(fn() => '📄 Lihat')
                    ->action(
                        Tables\Actions\Action::make('previewSertifikat2')
                            ->modalHeading('Preview Sertifikat 2')
                            ->modalContent(
                                fn($record) => $record?->sertifikat_2
                                    ? view('components.preview-pdf', ['fileUrl' => Storage::url($record->sertifikat_2)])
                                    : '<p class="p-4">File tidak tersedia</p>'
                            )
                    ),

                // SK Preview column
                Tables\Columns\TextColumn::make('file_sk')
                    ->label('SK TOEIC')
                    ->formatStateUsing(function ($state, $record) {
                        $shouldShow = $record?->status === 'disetujui' && $state;
                        return $shouldShow ? '📄 Lihat SK' : '';
                    })
                    ->action(
                        Tables\Actions\Action::make('previewSK')
                            ->modalHeading('Preview SK TOEIC')
                            ->modalContent(function ($record) {
                                if (!$record?->file_sk || $record?->status !== 'disetujui') {
                                    return view('components.empty-state', [
                                        'message' => 'SK tidak tersedia'
                                    ]);
                                }
                                return view('components.preview-pdf', [
                                    'fileUrl' => Storage::url($record->file_sk)
                                ]);
                            })
                            ->hidden(fn($record) => !$record?->file_sk || $record?->status !== 'disetujui')
                    )
                    ->extraAttributes(function ($record) {
                        $isClickable = $record?->status === 'disetujui' && $record?->file_sk;
                        return [
                            'style' => $isClickable ? 'cursor: pointer' : 'cursor: default',
                            'class' => $isClickable ? '' : 'opacity-50'
                        ];
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'pending' => 'warning',
                        'disetujui' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('catatan')
                    ->label('Alasan Penolakan')
                    ->placeholder('-')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record?->status !== 'ditolak') {
                            return '-';
                        }

                        // Pastikan selalu return string yang aman
                        return $state ?
                            nl2br(e($state)) :
                            '<span class="text-gray-400">Tidak ada catatan</span>';
                    })
                    ->html()
                    ->extraAttributes(function ($record) {
                        return $record?->status === 'ditolak'
                            ? ['class' => 'bg-red-50 p-2 rounded']
                            : ['class' => 'opacity-50 text-xs'];
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Upload')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                    ])
            ])
            ->actions([
                // Approve Action (auto-generate SK)
                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record?->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Persetujuan')
                    ->modalDescription('SK akan otomatis digenerate dan dikirim ke mahasiswa')
                    ->action(function ($record) {
                        $skController = new KonfirmasiSkMahasiswaController();
                        $skController->generateSk($record->id);

                        Notification::make()
                            ->title('SK Disetujui')
                            ->body('SK TOEIC telah otomatis digenerate dan dikirim')
                            ->success()
                            ->send();
                    }),

                // Reject Action
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn($record) => $record?->status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('catatan')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->placeholder('Masukkan alasan penolakan...')
                            ->helperText('Alasan ini akan dilihat oleh mahasiswa')
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => 'ditolak',
                            'catatan' => nl2br(e($data['catatan'])),
                            'updated_at' => now()
                        ]);

                        Notification::make()
                            ->title('Pengajuan Ditolak')
                            ->body('Pengajuan SK TOEIC telah ditolak')
                            ->danger()
                            ->send();
                    })
                    ->after(function () {
                        return redirect(request()->header('Referer'));
                    }),

                // Download SK Action
                Tables\Actions\Action::make('download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->visible(fn($record) => $record?->status === 'disetujui' && $record?->file_sk)
                    ->action(function ($record) {
                        try {
                            if (!$record?->file_sk) {
                                Notification::make()
                                    ->title('File Tidak Ditemukan')
                                    ->body('File SK tidak ditemukan di penyimpanan')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            $filePath = $record->file_sk;

                            if (!Storage::disk('public')->exists($filePath)) {
                                Notification::make()
                                    ->title('File Tidak Ditemukan')
                                    ->body('File SK tidak ditemukan di penyimpanan')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            // Get the file content
                            $fileContent = Storage::disk('public')->get($filePath);

                            // Generate proper download response
                            $headers = [
                                'Content-Type' => 'application/pdf',
                                'Content-Disposition' => 'attachment; filename="SK_TOEIC_' . $record->mahasiswa?->nim . '.pdf"',
                            ];

                            return response()->streamDownload(
                                function () use ($fileContent) {
                                    echo $fileContent;
                                },
                                'SK_TOEIC_' . $record->mahasiswa?->nim . '.pdf',
                                $headers
                            );
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Error')
                                ->body('Gagal mengunduh file: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),

                // Delete Action
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->visible(fn($record) => $record?->status !== 'disetujui'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKonfirmasiSks::route('/'),
        ];
    }
}

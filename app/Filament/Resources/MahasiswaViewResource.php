<?php
namespace App\Filament\Resources;

use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class MahasiswaViewResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Hasil Ujian';
    protected static ?string $navigationLabel = 'Sertifikat Mahasiswa';

    // Form untuk edit jika diperlukan
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lengkap')->required()->maxLength(100),
                Forms\Components\TextInput::make('nim')->required()->maxLength(20),
                Forms\Components\TextInput::make('email')->required()->email()->maxLength(100),
                Forms\Components\TextInput::make('no_telp')->required()->maxLength(15),
                Forms\Components\Select::make('kampus')
                    ->required()
                    ->options([
                        'utama' => 'Kampus Utama',
                        'kediri' => 'Kampus Kediri',
                        'lumajang' => 'Kampus Lumajang',
                        'pamekasan' => 'Kampus Pamekasan',
                    ]),
                Forms\Components\TextInput::make('jurusan')->required(),
                Forms\Components\TextInput::make('prodi')->required(),
                Forms\Components\TextInput::make('pengambilan_sertifikat')->required(),
                Forms\Components\FileUpload::make('foto_sertifikat')
                    ->label('Foto Pengambilan Sertifikat')
                    ->image()
                    ->directory('sertifikat')
                    ->nullable()
                    ->disk('public'),
            ]);
    }

    // Tabel hanya untuk melihat data
   public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('nama_lengkap')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('nim')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('no_telp'),
            Tables\Columns\TextColumn::make('kampus')->sortable(),
            Tables\Columns\TextColumn::make('jurusan'),
            Tables\Columns\TextColumn::make('prodi'),
            // Kolom pengambilan sertifikat
            Tables\Columns\TextColumn::make('pengambilan_sertifikat')
                ->getStateUsing(fn($record) => $record->pengambilan_sertifikat) // Get state value
                ->formatStateUsing(function ($state, $record) {
                    if ($state === 'sudah') {
                        return '<span class="text-green-500">Sudah &#x2714;</span>'; // ✔ (Hijau)
                    } elseif ($state === 'pending') {
                        return '<span class="text-yellow-500">Pending &#x23F3;</span>'; // ⏳ (Pending icon)
                    } else {
                        return '<span class="text-red-500">Belum &#x2716;</span>'; // ✘ (Merah)
                    }
                })
                ->html()
                ->sortable(),
            // Kolom aksi untuk update pengambilan sertifikat
            Tables\Columns\TextColumn::make('image_path')
                    ->label('Bukti Sertifikat')
                    ->formatStateUsing(fn () => '🖼️ Lihat')
                    ->action(
                        Tables\Actions\Action::make('Lihat Sertifikat')
                            ->modalHeading('Preview Pengambilan Sertifikat')
                            ->modalContent(fn ($record) => view('components.preview-image', [
                            'imageUrl' => Storage::url($record->image_path),
                            ]))
                            ->modalSubmitAction(false)
                            ->modalCancelAction(false)
                    ),
        ])
        ->defaultSort('nama_lengkap')
        ->actions([
            // Aksi untuk mengubah status menjadi 'sudah'
            Tables\Actions\Action::make('konfirmasi_pengambilan')
                ->label('Konfirmasi Pengambilan')
                ->icon('heroicon-o-check-circle')
                ->color('primary')
                // Menggunakan URL untuk mengarahkan ke halaman pembaruan status
                ->url(fn($record) => '/update-pengambilan-sertifikat/' . $record->id) // Arahkan ke URL pembaruan
                ->visible(fn($record) => $record->pengambilan_sertifikat === 'pending'),
        ])

        ->bulkActions([]); // Menonaktifkan aksi Bulk Delete
}


    // Adding JavaScript to handle the status change


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\MahasiswaViewResource\Pages\ListMahasiswaViews::route('/'),
        ];
    }

    // Mengizinkan hanya admin untuk melihat data
    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user instanceof \App\Models\User && $user->hasRole('admin');
    }

    // Menonaktifkan create, edit, delete
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}

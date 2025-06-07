<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KonfirmasiSkResource\Pages;
use App\Models\KonfirmasiSk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KonfirmasiSkResource extends Resource
{
    protected static ?string $model = KonfirmasiSk::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Manajemen SK TOEIC';
    protected static ?string $modelLabel = 'Konfirmasi SK TOEIC';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'disetujui' => 'Disetujui',
                    'ditolak' => 'Ditolak',
                ])
                ->required(),

            Forms\Components\FileUpload::make('file_sk')
                ->label('File SK (PDF)')
                ->directory('konfirmasi_sk')
                ->disk('public')
                ->acceptedFileTypes(['application/pdf'])
                ->visible(fn ($get) => $get('status') === 'disetujui')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('mahasiswa.nama_lengkap')
                ->label('Nama Mahasiswa')
                ->searchable(),

            Tables\Columns\TextColumn::make('sertifikat_1')
                ->label('Sertifikat 1')
                ->formatStateUsing(fn ($state) => $state ? 'Lihat File' : '-')
                ->url(fn ($record) => $record->sertifikat_1 ? asset('storage/' . $record->sertifikat_1) : null)
                ->openUrlInNewTab(),

            Tables\Columns\TextColumn::make('sertifikat_2')
                ->label('Sertifikat 2')
                ->formatStateUsing(fn ($state) => $state ? 'Lihat File' : '-')
                ->url(fn ($record) => $record->sertifikat_2 ? asset('storage/' . $record->sertifikat_2) : null)
                ->openUrlInNewTab(),

            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'pending' => 'warning',
                    'disetujui' => 'success',
                    'ditolak' => 'danger',
                }),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal Upload')
                ->dateTime('d M Y H:i'),
        ])
        ->actions([
            Tables\Actions\EditAction::make()->label('Validasi'),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKonfirmasiSks::route('/'),
            'edit' => Pages\EditKonfirmasiSk::route('/{record}/edit'),
        ];
    }
}

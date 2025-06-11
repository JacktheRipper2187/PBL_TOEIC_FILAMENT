<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalPendaftaranResource\Pages;
use App\Models\JadwalPendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;


class JadwalPendaftaranResource extends Resource
{
    protected static ?string $model = JadwalPendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Manajemen Jadwal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_jadwal')
                    ->required()
                    ->label('Nama Jadwal')
                    ->placeholder('Contoh: TOEIC Gratis Periode 1 2024'),
                Forms\Components\Select::make('skema')
                    ->label('Skema')
                    ->options([
                        'gratis' => 'Gratis',
                        'berbayar' => 'Berbayar',
                    ])
                    ->required(),

                Forms\Components\DatePicker::make('tgl_buka')
                    ->label('Tanggal Buka')
                    ->required(),

                Forms\Components\DatePicker::make('tgl_tutup')
                    ->label('Tanggal Tutup')
                    ->required(),

                Forms\Components\TextInput::make('kuota')
                    ->required()
                    ->numeric(),

                Forms\Components\Textarea::make('keterangan')
                    ->maxLength(500)
                    ->label('Keterangan')
                    ->rows(3),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('skema')->label('Skema'),
                Tables\Columns\TextColumn::make('tgl_buka')->date('d F Y')->label('Tanggal Buka'),
                Tables\Columns\TextColumn::make('tgl_tutup')->date('d F Y')->label('Tanggal Tutup'),
                Tables\Columns\TextColumn::make('kuota')->label('Kuota'),
                Tables\Columns\TextColumn::make('keterangan')->label('Keterangan')->limit(30),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->icon('heroicon-o-trash'),
                Action::make('lihat_pendaftar')
                    ->label('Lihat Pendaftar')
                    ->icon('heroicon-o-user-group')
                    ->url(fn($record) => route('filament.admin.resources.pendaftars.index', ['jadwal_id' => $record->id]))
                    ->openUrlInNewTab(),
                Action::make('lihat_jadwal')  // PASTIKAN INI MASUK DALAM ARRAY ACTIONS
                    ->label('Lihat Jadwal')
                    ->icon('heroicon-o-clock')
                    ->url(fn($record) => JadwalPelaksanaanResource::getUrl('index', ['jadwal_pendaftaran_id' => $record->id]))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalPendaftarans::route('/'),
            'create' => Pages\CreateJadwalPendaftaran::route('/create'),
            'edit' => Pages\EditJadwalPendaftaran::route('/{record}/edit'),
        ];
    }

    // Role-based akses
    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user instanceof \App\Models\User && $user->hasRole('admin');
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit($record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete($record): bool
    {
        return static::canViewAny();
    }
}

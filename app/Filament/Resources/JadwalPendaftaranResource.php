<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalPendaftaranResource\Pages;
use App\Models\JadwalPendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JadwalPendaftaranResource extends Resource
{
    protected static ?string $model = JadwalPendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Manajemen Jadwal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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

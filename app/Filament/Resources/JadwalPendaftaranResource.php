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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tgl_buka')
                    ->required(),
                Forms\Components\DatePicker::make('tgl_tutup')
                    ->required(),
                Forms\Components\TextInput::make('kuota')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lokasi')->label('Lokasi'),
                Tables\Columns\TextColumn::make('tgl_buka')->date('d F Y')->label('Tanggal Buka'),
                Tables\Columns\TextColumn::make('tgl_tutup')->date('d F Y')->label('Tanggal Tutup'),
                Tables\Columns\TextColumn::make('kuota')->label('Kuota'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
}

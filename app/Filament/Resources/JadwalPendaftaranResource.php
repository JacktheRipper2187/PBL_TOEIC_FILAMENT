<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalPendaftaranResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\JadwalPendaftaran;

class JadwalPendaftaranResource extends Resource
{
    protected static ?string $model = JadwalPendaftaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    // Wajib ada: Form configuration
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->required(),
                Forms\Components\TextInput::make('kuota')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_akhir')
                    ->required(),
            ]);
    }

    // Table configuration (sudah ada di kode Anda)
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Pendaftaran'),
                Tables\Columns\TextColumn::make('content')
                    ->label('Content Pendaftaran'),
                Tables\Columns\TextColumn::make('kuota')
                    ->label('Kuota'),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai Pendaftaran')
                    ->date('d F Y'),
                Tables\Columns\TextColumn::make('tanggal_akhir')
                    ->label('Tanggal Tenggat Pendaftaran')
                    ->date('d F Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Wajib ada: Pages/routes configuration
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalPendaftarans::route('/'),
            'create' => Pages\CreateJadwalPendaftaran::route('/create'),
            'edit' => Pages\EditJadwalPendaftaran::route('/{record}/edit'),
        ];
    }
}
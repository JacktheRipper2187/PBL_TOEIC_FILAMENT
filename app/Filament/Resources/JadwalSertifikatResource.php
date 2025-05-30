<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalSertifikatResource\Pages;
use App\Filament\Resources\JadwalSertifikatResource\RelationManagers;
use App\Models\JadwalSertifikat;
use Filament\Forms;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;

class JadwalSertifikatResource extends Resource
{
    protected static ?string $model = JadwalSertifikat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
protected static ?string $navigationGroup = 'Manajemen Jadwal';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TimePicker::make('waktu')
                    ->required(),
                TextInput::make('lokasi')
                    ->required(),
                DatePicker::make('hari_tanggal')
                    ->required(),
                Textarea::make('keterangan')
                    ->required(),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('hari_tanggal')
                ->label('Hari & Tanggal')
                ->date('l, d M Y') 
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('waktu')
                ->label('Waktu')
                ->time()
                ->sortable(),

            Tables\Columns\TextColumn::make('lokasi')
                ->label('Lokasi')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('keterangan')
                ->label('Keterangan')
                ->limit(30) 
                ->toggleable(), 
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalSertifikats::route('/'),
            'create' => Pages\CreateJadwalSertifikat::route('/create'),
            'edit' => Pages\EditJadwalSertifikat::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
{
    $user = auth()->user();

    return $user instanceof \App\Models\User && $user->hasRole('admin');
}

public static function canCreate(): bool
{
    return static::canViewAny(); // Admin otomatis bisa create
}

public static function canEdit($record): bool
{
    return static::canViewAny(); // Admin otomatis bisa edit
}

public static function canDelete($record): bool
{
    return static::canViewAny(); // Admin otomatis bisa delete
}
}



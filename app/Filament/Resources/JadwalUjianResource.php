<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalUjianResource\Pages;
use App\Filament\Resources\JadwalUjianResource\RelationManagers;
use App\Models\JadwalUjian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JadwalUjianResource extends Resource
{
    protected static ?string $model = JadwalUjian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Jadwal';
    public static function form(Form $form): Form
     {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('jadwal_ujian')
                    ->required()
                    ->image() // Gunakan image() di FileUpload untuk memastikan hanya gambar yang bisa di-upload
                    ->disk('public_folder'), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jadwal_ujian')
                    ->searchable(),
            ])
            ->filters([
                //Define filters if needed
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
            'index' => Pages\ListJadwalUjians::route('/'),
            'create' => Pages\CreateJadwalUjian::route('/create'),
            'edit' => Pages\EditJadwalUjian::route('/{record}/edit'),
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

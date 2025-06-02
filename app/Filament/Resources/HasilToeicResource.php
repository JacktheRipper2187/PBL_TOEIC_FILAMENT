<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HasilToeicResource\Pages;
use App\Models\HasilToeic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class HasilToeicResource extends Resource
{
    protected static ?string $model = HasilToeic::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Manajemen Hasil Ujian';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nim')->required(),
            TextInput::make('name')->required(),
            TextInput::make('l')->label('Listening')->numeric(),
            TextInput::make('r')->label('Reading')->numeric(),
            TextInput::make('tot')->label('Total')->numeric(),
            TextInput::make('group')->nullable(),
            TextInput::make('position')->nullable(),
            TextInput::make('category')->nullable(),
            DatePicker::make('test_date')->label('Test Date')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nim')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('l')->label('L'),
                Tables\Columns\TextColumn::make('r')->label('R'),
                Tables\Columns\TextColumn::make('tot')->label('Total'),
                Tables\Columns\TextColumn::make('group'),
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('test_date')->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHasilToeics::route('/'),
            'create' => Pages\CreateHasilToeic::route('/create'),
            'edit' => Pages\EditHasilToeic::route('/{record}/edit'),
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

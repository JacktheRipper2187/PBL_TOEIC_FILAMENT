<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Filament\Resources\SectionResource\RelationManagers;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;



class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
protected static ?string $navigationGroup = 'Manajemen Tampilan';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('thumbnail')
                        ->required(), 
                    Forms\Components\RichEditor::make('content')
                        ->required(),
                    Forms\Components\Select::make('post_as')
                        ->options([
                            'Beranda' => 'Beranda',
                            'SyaratKetentuan' => 'SyaratKetentuan',
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()-> searchable(),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('post_as')->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(), 
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
                ])  
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
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
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
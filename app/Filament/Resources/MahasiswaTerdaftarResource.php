<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaTerdaftarResource\Pages;
use App\Filament\Resources\MahasiswaTerdaftarResource\RelationManagers;
use App\Models\MahasiswaTerdaftar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaTerdaftarResource extends Resource
{
    protected static ?string $model = MahasiswaTerdaftar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lengkap')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nim')
                    ->label('NIM')
                    ->required()
                    ->maxLength(50)
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('no_hp')
                    ->label('No. HP')
                    ->tel()
                    ->required()
                    ->maxLength(20),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('alamat_asal')
                    ->label('Alamat Asal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kampus')
                    ->label('Kampus')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jurusan')
                    ->label('Jurusan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('program_studi')
                    ->label('Program Studi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('nim')->label('NIM')->searchable(),
                Tables\Columns\TextColumn::make('no_hp')->label('No. HP'),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('alamat_asal')->label('Alamat Asal'),
                Tables\Columns\TextColumn::make('kampus')->label('Kampus'),
                Tables\Columns\TextColumn::make('jurusan')->label('Jurusan'),
                Tables\Columns\TextColumn::make('program_studi')->label('Program Studi'),
            ])
            ->filters([
                // Optional filter logic
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
            'index' => Pages\ListMahasiswaTerdaftars::route('/'),
            'create' => Pages\CreateMahasiswaTerdaftar::route('/create'),
            'edit' => Pages\EditMahasiswaTerdaftar::route('/{record}/edit'),
        ];
    }
}

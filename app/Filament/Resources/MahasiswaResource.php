<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen User';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lengkap')->required()->maxLength(100),
                Forms\Components\TextInput::make('nim')->required()->unique(ignoreRecord: true)->maxLength(20),
                Forms\Components\TextInput::make('email')->required()->email()->maxLength(100),
                Forms\Components\TextInput::make('no_telp')->required()->maxLength(15),
                Forms\Components\Select::make('kampus')
                    ->required()
                    ->options([
                        'utama' => 'Kampus Utama',
                        'kediri' => 'Kampus Kediri',
                        'lumajang' => 'Kampus Lumajang',
                        'pamekasan' => 'Kampus Pamekasan',
                    ]),
                Forms\Components\TextInput::make('jurusan')->required(),
                Forms\Components\TextInput::make('prodi')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nim')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('no_telp'),
                Tables\Columns\TextColumn::make('kampus')->sortable(),
                Tables\Columns\TextColumn::make('jurusan'),
                Tables\Columns\TextColumn::make('prodi'),
            ])
            ->defaultSort('nama_lengkap')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
    //     // Role-based akses
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

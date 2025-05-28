<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;


class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Manajemen User';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('username')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('password')
                ->password()
                ->required(fn ($context) => $context === 'create') // hanya saat create
                ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                ->hiddenOn('edit'),

            Forms\Components\Select::make('roles')
                ->relationship('roles', 'name')
                ->multiple()
                ->preload()
                ->searchable()
                ->required()
                ->visible(fn () => ($user = auth()->user()) instanceof \App\Models\User && $user->hasRole('admin'))
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->badge()
                    ->color('primary')
                    ->label('Role')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->searchable(),
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
    $user = auth()->user();
    return $user instanceof \App\Models\User
        && $user->hasRole('admin')
        && $user->can('create users');
}

public static function canEdit($record): bool
{
    $user = auth()->user();
    return $user instanceof \App\Models\User
        && $user->hasRole('admin')
        && $user->can('edit users');
}

public static function canDelete($record): bool
{
    $user = auth()->user();
    return $user instanceof \App\Models\User
        && $user->hasRole('admin')
        && $user->can('delete users');
}

}
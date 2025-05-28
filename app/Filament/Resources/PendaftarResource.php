<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftarResource\Pages;
use App\Filament\Resources\PendaftarResource\RelationManagers;
use App\Models\Pendaftar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class PendaftarResource extends Resource
{
    protected static ?string $model = Pendaftar::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
protected static ?string $navigationGroup = 'Manajemen Data Pendaftaran';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nim_nik')
                    ->label('NIM/NIK')
                    ->required()
                    ->maxLength(50)
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                Forms\Components\TextInput::make('alamat_asal')
                    ->label('Alamat Asal')
                    ->required(),

                Forms\Components\TextInput::make('alamat_sekarang')
                    ->label('Alamat Sekarang')
                    ->required(),

                Forms\Components\TextInput::make('kampus')
                    ->label('Kampus')
                    ->required(),

                Forms\Components\TextInput::make('jurusan')
                    ->label('Jurusan')
                    ->required(),

                Forms\Components\TextInput::make('program_studi')
                    ->label('Program Studi')
                    ->required(),

                Forms\Components\FileUpload::make('foto_formal')
                    ->label('Foto Formal')
                    ->image()
                    ->directory('pendaftar/foto_formal')
                    ->nullable()
                    ->disk('public'),

                Forms\Components\FileUpload::make('upload_ktp')
                    ->label('Upload KTP')
                    ->directory('pendaftar/ktp')
                    ->nullable()
                    ->disk('public'),

                Forms\Components\FileUpload::make('upload_ktm')
                    ->label('Upload KTM')
                    ->directory('pendaftar/ktm')
                    ->nullable()
                    ->disk('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('nim_nik')->label('NIM/NIK')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('kampus')->label('Kampus'),
                Tables\Columns\TextColumn::make('jurusan')->label('Jurusan'),
                Tables\Columns\TextColumn::make('program_studi')->label('Prodi'),

                Tables\Columns\TextColumn::make('foto_formal')
                    ->label('Foto Formal')
                    ->formatStateUsing(fn () => '🖼️ Lihat')
                    ->action(
                        Tables\Actions\Action::make('Lihat Foto')
                            ->modalHeading('Preview Foto Formal')
                            ->modalContent(fn ($record) => view('components.preview-image', [
                            'imageUrl' => Storage::url($record->foto_formal),
                            ]))
                            ->modalSubmitAction(false)
                            ->modalCancelAction(false)
                    ),

                Tables\Columns\TextColumn::make('upload_ktp')
                    ->label('KTP')
                    ->formatStateUsing(fn () => '🖼️ Lihat')
                    ->action(
                        Tables\Actions\Action::make('Lihat KTP')
                            ->modalHeading('Preview KTP')
                            ->modalContent(fn ($record) => view('components.preview-image', [
                            'imageUrl' => Storage::url($record->upload_ktp),
        ]))

                            ->modalSubmitAction(false)
                            ->modalCancelAction(false)
                    ),

                Tables\Columns\TextColumn::make('upload_ktm')
                    ->label('KTM')
                    ->formatStateUsing(fn () => '🖼️ Lihat')
                    ->action(
                        Tables\Actions\Action::make('Lihat KTM')
                            ->modalHeading('Preview KTM')
                            ->modalContent(fn ($record) => view('components.preview-image', ['imageUrl' => Storage::url($record->upload_ktm),
                            ]))
                            ->modalSubmitAction(false)
                            ->modalCancelAction(false)    
                    ),
            ])
            ->filters([
                // tambahkan filter jika perlu
            ])
            ->headerActions([
                Tables\Actions\Action::make('Export Excel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('success')
                    ->url(route('admin.pendaftar.export-excel'))
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('Export PDF')
                    ->label('Export PDF')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('danger')
                    ->url(route('admin.pendaftar.export-pdf'))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListPendaftars::route('/'),
            // 'create' => Pages\CreatePendaftar::route('/create'),
            'edit' => Pages\EditPendaftar::route('/{record}/edit'),
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


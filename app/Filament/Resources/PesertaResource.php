<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesertaResource\Pages;
use App\Models\Peserta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;



class PesertaResource extends Resource
{
    protected static ?string $model = Peserta::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_lengkap')
                ->required()
                ->label('Nama Lengkap'),

            Forms\Components\TextInput::make('nim_nik')
                ->required()
                ->unique(ignoreRecord: true)
                ->label('NIM/NIK'),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required(),

            Forms\Components\TextInput::make('alamat_asal')
                ->required()
                ->label('Alamat Asal'),

            Forms\Components\TextInput::make('alamat_sekarang')
                ->required()
                ->label('Alamat Sekarang'),

            Forms\Components\TextInput::make('kampus')
                ->required(),

            Forms\Components\TextInput::make('jurusan')
                ->required(),

            Forms\Components\TextInput::make('program_studi')
                ->required(),

            Forms\Components\FileUpload::make('foto_formal')
                ->image()
                ->disk('public')
                
                ->directory('foto_formal')   // Ini akan otomatis simpan file di folder 'foto_formal'
                ->label('Foto Formal'),

            Forms\Components\FileUpload::make('upload_ktp')
                ->image()
                ->disk('public')
                ->directory('upload_ktp')
                ->label('Upload KTP'),

            Forms\Components\FileUpload::make('upload_ktm')
                ->image()
                ->disk('public')
                ->directory('upload_ktm')
                ->label('Upload KTM'),
        ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('nama_lengkap')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('nim_nik')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('kampus'),
            Tables\Columns\TextColumn::make('jurusan'),
            Tables\Columns\TextColumn::make('program_studi'),
            
            Tables\Columns\ImageColumn::make('foto_formal')
                ->label('Foto Formal')
                ->disk('public'),

            Tables\Columns\ImageColumn::make('upload_ktp')
                ->label('Upload KTP')
                ->disk('public'),

            Tables\Columns\ImageColumn::make('upload_ktm')
                ->label('Upload KTM')
                ->disk('public'),

            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Tanggal Daftar'),
        ])
        ->filters([])
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
            'index' => Pages\ListPesertas::route('/'),
            'create' => Pages\CreatePeserta::route('/create'),
            'edit' => Pages\EditPeserta::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalPelaksanaanResource\Pages;
use App\Models\JadwalPelaksanaan;
use App\Models\JadwalPendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JadwalPelaksanaanResource extends Resource
{
    protected static ?string $model = JadwalPelaksanaan::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Manajemen Jadwal';

    public static function form(Form $form): Form
    {
      return $form
            ->schema([
               Forms\Components\Select::make('jadwal_pendaftaran_id')
            ->relationship('jadwalPendaftaran', 'nama_jadwal') // Tampilkan nama_jadwal bukan skema
            ->searchable()
            ->preload()
            ->required()
            ->label('Pilih Jenis Tes'),

                Forms\Components\DatePicker::make('tanggal')
                    ->required()
                    ->label('Tanggal Pelaksanaan'),

                Forms\Components\Select::make('sesi')
                    ->options([
                        'Sesi 1' => 'Sesi 1',
                        'Sesi 2' => 'Sesi 2',
                    ])
                    ->required()
                    ->label('Sesi'),

                Forms\Components\TimePicker::make('jam_mulai')
                    ->required()
                    ->label('Jam Mulai'),

                Forms\Components\TimePicker::make('jam_selesai')
                    ->required()
                    ->label('Jam Selesai'),

                Forms\Components\TextInput::make('lokasi_platform')
                    ->required()
                    ->label('Lokasi/Platform'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jadwalPendaftaran.skema')
                ->label('Jenis Tes')
                ->searchable()
                ->sortable(),
                    
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d F Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('sesi'),
                    
                Tables\Columns\TextColumn::make('jam_mulai'),
                    
                Tables\Columns\TextColumn::make('jam_selesai'),
                    
                Tables\Columns\TextColumn::make('lokasi_platform')
                    ->label('Lokasi'),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->with('jadwalPendaftaran'))
            ->filters([
                Tables\Filters\SelectFilter::make('jadwal_pendaftaran_id')
                    ->relationship('jadwalPendaftaran', 'skema')
                    ->label('Filter by Jenis Tes'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tanggal', 'asc');
    }

public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalPelaksanaans::route('/'),
            'create' => Pages\CreateJadwalPelaksanaan::route('/create'),
            'edit' => Pages\EditJadwalPelaksanaan::route('/{record}/edit'),
        ];
    }
    
    // Role-based akses
    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user instanceof \App\Models\User && $user->hasRole('admin');
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit($record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete($record): bool
    {
        return static::canViewAny();
    }
}


<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormPendaftaranResource\Pages;
use App\Models\FormPendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Get;
use Filament\Forms\Set;

class FormPendaftaranResource extends Resource
{
    protected static ?string $model = FormPendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. FIELD DATA PRIBADI
                Forms\Components\Section::make('Data Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('nim')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\TextInput::make('no_hp')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                            
                        Forms\Components\Textarea::make('alamat_asal')
                            ->required()
                            ->columnSpanFull(),
                            
                        Forms\Components\Textarea::make('alamat_sekarang')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
                
                // 2. FIELD DATA AKADEMIK (DROPDOWN)
                Forms\Components\Section::make('Data Akademik')
                    ->schema([
                        // Dropdown Kampus
                        Forms\Components\Select::make('kampus')
                            ->label('Kampus')
                            ->options([
                                'Kampus Utama (Malang)' => 'Kampus Utama (Malang)',
                                'Kampus PSDKU Kediri' => 'Kampus PSDKU Kediri',
                                'Kampus PSDKU Pamekasan' => 'Kampus PSDKU Pamekasan',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('jurusan', null)),
                            
                        // Dropdown Jurusan (Tergantung Kampus)
                        Forms\Components\Select::make('jurusan')
                            ->options(function (Get $get) {
                                $kampus = $get('kampus');
                                
                                if (!$kampus) return [];
                                
                                $jurusanOptions = [
                                    'Kampus Utama (Malang)' => [
                                        'Teknik Elektro',
                                        'Teknik Mesin',
                                        'Teknologi Informasi',
                                        'Teknik Kimia',
                                        'Teknik Sipil',
                                        'Akuntansi',
                                        'Administrasi Niaga'
                                    ],
                                    'Kampus PSDKU Kediri' => [
                                        'Teknik Informatika',
                                        'Teknik Mesin',
                                        'Teknik Elektronika',
                                        'Teknik Mesin Produksi dan Perawatan',
                                        'Keuangan'
                                    ],
                                    'Kampus PSDKU Pamekasan' => [
                                        'Teknik Informatika',
                                        'Teknik Mesin',
                                        'Teknik Mesin Produksi dan Perawatan',
                                        'Teknik Elektronika',
                                        'Keuangan'
                                    ]
                                ];
                                
                                return array_combine(
                                    $jurusanOptions[$kampus],
                                    $jurusanOptions[$kampus]
                                );
                            })
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('prodi', null)),
                            
                        // Dropdown Prodi (Tergantung Jurusan)
                        Forms\Components\Select::make('prodi')
                            ->options(function (Get $get) {
                                $jurusan = $get('jurusan');
                                if (!$jurusan) return [];
                                
                                $prodiOptions = [
                                    'Teknik Elektro' => [
                                        'D-III Teknik Listrik',
                                        'D-III Teknik Elektronika',
                                        'D-III Teknik Telekomunikasi',
                                        'D-IV Sistem Kelistrikan',
                                        'D-IV Teknik Elektronika',
                                        'D-IV Teknik Jaringan Telekomunikasi Digital'
                                    ],
                                    'Teknik Mesin' => [
                                        'D-III Teknik Mesin',
                                        'D-III Teknologi Pemeliharaan Pesawat Udara',
                                        'D-IV Teknik Mesin Produksi dan Perawatan',
                                        'D-IV Teknik Otomotif Elektronik'
                                    ],
                                    // Tambahkan mapping untuk jurusan lainnya...
                                ];
                                
                                return array_combine(
                                    $prodiOptions[$jurusan] ?? [],
                                    $prodiOptions[$jurusan] ?? []
                                );
                            })
                            ->required(),
                    ])->columns(3),
                
                // 3. UPLOAD BERKAS
                Forms\Components\Section::make('Berkas Persyaratan')
                    ->schema([
                        Forms\Components\FileUpload::make('pas_foto_path')
                            ->label('Pas Foto')
                            ->image()
                            ->directory('pas-foto')
                            ->required(),
                            
                        Forms\Components\FileUpload::make('ktp_path')
                            ->label('KTP')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->directory('ktp')
                            ->required(),
                            
                        Forms\Components\FileUpload::make('ktm_path')
                            ->label('KTM')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->directory('ktm')
                            ->required(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('nim')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('kampus'),
                
                Tables\Columns\TextColumn::make('jurusan'),
                
                Tables\Columns\TextColumn::make('prodi'),
                
                Tables\Columns\IconColumn::make('is_verified')
                    ->label('Verified')
                    ->boolean(),
            ])
            ->filters([
                // Tambahkan filter jika perlu
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
            'index' => Pages\ListFormPendaftarans::route('/'),
            'create' => Pages\CreateFormPendaftaran::route('/create'),
            'edit' => Pages\EditFormPendaftaran::route('/{record}/edit'),
        ];
    }
}


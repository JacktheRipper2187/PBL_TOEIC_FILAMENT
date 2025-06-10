<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset permission cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Role
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $mahasiswaRole = Role::firstOrCreate([
            'name' => 'mahasiswa',
            'guard_name' => 'web',
        ]);

        // 2. Buat User Admin
        $admin = User::firstOrCreate(
            ['username' => 'adminuser'],
            [
                'email' => 'admin@example.com',
                'password' => Hash::make('admin1'),
            ]
        );

        // Assign Role Admin
        if (!$admin->hasRole($adminRole)) {
            $admin->assignRole($adminRole);
            echo "Assigned admin role to: " . $admin->username . PHP_EOL;
        }

        // 3. Buat User Mahasiswa 1
        $mahasiswaUser1 = User::firstOrCreate(
            ['username' => 'mahasiswa1'],
            [
                'email' => 'mahasiswa1@example.com',
                'password' => Hash::make('mahasiswa1'),
            ]
        );

        Mahasiswa::firstOrCreate(
            [
                'user_id' => $mahasiswaUser1->id,
                'nama_lengkap' => 'John Doe',
                'nim' => '123456789',
                'no_telp' => '081234567890',
                'kampus' => 'Universitas Contoh',
                'jurusan' => 'Teknik Informatika',
                'prodi' => 'S1',
                'email' => 'john.doe@example.com',
                'pengambilan_sertifikat' => 'belum',
            ]
        );

        if (!$mahasiswaUser1->hasRole($mahasiswaRole)) {
            $mahasiswaUser1->assignRole($mahasiswaRole);
            echo "Assigned mahasiswa role to: " . $mahasiswaUser1->username . PHP_EOL;
        }

        // 4. Buat User Mahasiswa 2
        $mahasiswaUser2 = User::firstOrCreate(
            ['username' => 'mahasiswa2'],
            [
                'email' => 'mahasiswa2@example.com',
                'password' => Hash::make('mahasiswa2'),
            ]
        );

        Mahasiswa::firstOrCreate(
            [
                'user_id' => $mahasiswaUser2->id,
                'nama_lengkap' => 'Jane Smith',
                'nim' => '987654321',
                'no_telp' => '081298765432',
                'kampus' => 'Politeknik Negeri Malang',
                'jurusan' => 'Sistem Informasi Bisnis',
                'prodi' => 'D4',
                'email' => 'jane.smith@example.com',
                'pengambilan_sertifikat' => 'belum',
            ]
        );

        if (!$mahasiswaUser2->hasRole($mahasiswaRole)) {
            $mahasiswaUser2->assignRole($mahasiswaRole);
            echo "Assigned mahasiswa role to: " . $mahasiswaUser2->username . PHP_EOL;
        }

        // 5. Verifikasi langsung
        dump(User::with('roles')->find($admin->id)->getRoleNames());
        dump(User::with('roles')->find($mahasiswaUser1->id)->getRoleNames());
        dump(User::with('roles')->find($mahasiswaUser2->id)->getRoleNames());

        // 6. Panggil Seeder Lain
        $this->call([
            SectionsTableSeeder::class,
            PendaftaranTableSeeder::class,
            SettingsTableSeeder::class,
            MahasiswaTerdaftarSeeder::class,
            HasilsTableSeeder::class,
            JadwalPendaftaranTableSeeder::class,
        ]);
    }
}
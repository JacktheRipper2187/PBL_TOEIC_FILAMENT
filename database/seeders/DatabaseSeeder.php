<?php

namespace Database\Seeders;

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
        // Wajib: Reset cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Role (jika belum ada)
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web' // <- Pastikan guard_name sesuai
        ]);

        $mahasiswaRole = Role::firstOrCreate([
            'name' => 'mahasiswa',
            'guard_name' => 'web',
        ]);

        // 2. Buat User Admin
        $admin = User::firstOrCreate(
            ['username' => 'adminuser'],
            [
                'password' => Hash::make('NazwaAdmin1'),
            ]
        );

        // 3. Assign Role Admin ke User Admin
        if (!$admin->hasRole($adminRole)) {
            $admin->assignRole($adminRole);
            echo "Assigned admin role to: ".$admin->username.PHP_EOL;
        }

        // 4. Buat User Mahasiswa
        $mahasiswa = User::firstOrCreate(
            ['username' => 'mahasiswa1'],
            [
                'password' => Hash::make('passwordMahasiswa'),
            ]
        );

        // 5. Assign Role Mahasiswa ke User Mahasiswa
        if (!$mahasiswa->hasRole($mahasiswaRole)) {
            $mahasiswa->assignRole($mahasiswaRole);
            echo "Assigned mahasiswa role to: ".$mahasiswa->username.PHP_EOL;
        }

        // 6. Verifikasi langsung
        $freshAdmin = User::with('roles')->find($admin->id);
        dump($freshAdmin->getRoleNames()); // Harus menampilkan ['admin']

        $freshMahasiswa = User::with('roles')->find($mahasiswa->id);
        dump($freshMahasiswa->getRoleNames()); // Harus menampilkan ['mahasiswa']

        // 7. Panggil Seeder lainnya
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

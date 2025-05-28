<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset permission cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat permission
        $permissions = [
            'view dashboard',
            'manage users',
            'manage mahasiswa',
            'view reports',
            'create users',
            'edit users',
            'delete users',
            'assign roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Buat role
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $mahasiswaRole = Role::firstOrCreate(['name' => 'mahasiswa', 'guard_name' => 'web']);

        // Assign permission ke role admin
        $adminRole->syncPermissions($permissions);

        // Assign permission terbatas ke mahasiswa (misal cuma lihat dashboard)
        $mahasiswaRole->syncPermissions(['view dashboard']);

        // Buat user admin jika belum ada
        $admin = User::firstOrCreate(
            ['username' => 'adminuser'],
            ['password' => Hash::make('NazwaAdmin1')]
        );

        // Assign role admin ke user
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
    }
}

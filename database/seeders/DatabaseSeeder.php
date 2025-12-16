<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;           // ← Tambahkan ini
use Spatie\Permission\Models\Permission;   // ← Opsional, kalau butuh permission
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat role
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'kasir']);

        // User admin
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@pos.com',
            'password' => bcrypt('admin123'),
        ]);
        $admin->assignRole('admin');

        // User kasir
        $kasir = User::create([
            'name'     => 'Kasir',
            'email'    => 'kasir@pos.com',
            'password' => bcrypt('kasir123'),
        ]);
        $kasir->assignRole('kasir');

    }
}
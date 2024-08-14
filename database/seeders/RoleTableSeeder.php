<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Role
        $adminRole = Role::create([
            'id' => 28,
            'name' => 'admin'
        ]);
        $adminRole->givePermissionTo(Permission::all());

        // Editor Role
        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo([
            'kalender-permission',
            'artikel-permission',
            'wishlist-list', 'wishlist-tambah', 'wishlist-delete',
            'dashboard-permission'
        ]);

        // User Role
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'kalender-permission',
            'artikel-permission',
            'wishlist-list', 'wishlist-tambah', 'wishlist-delete'
        ]);
    }
}
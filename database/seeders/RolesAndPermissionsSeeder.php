<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            'edit-bookings',
            'delete-bookings',
            'add-bookings',
            'allow-all',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign existing permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);

        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo(['edit-bookings', 'add-bookings','delete-bookings']);

        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo(['edit-bookings', 'add-bookings']);
    }
}

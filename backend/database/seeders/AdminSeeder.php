<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create users or get existing ones
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'profile' => 'user.avif'
            ]
        );

        $writer = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => bcrypt('password')
            ]
        );

        // Create roles or get existing ones
        $admin_role = Role::firstOrCreate(['name' => 'admin']);
        $writer_role = Role::firstOrCreate(['name' => 'user']);

        // Create permissions
        $permissions = [
            'Post access', 'Post edit', 'Post create', 'Post delete',
            'Role access', 'Role edit', 'Role create', 'Role delete',
            'User access', 'User edit', 'User create', 'User delete',
            'Permission access', 'Permission edit', 'Permission create', 'Permission delete',
            'Mail access', 'Mail edit'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign roles to users
        $admin->assignRole($admin_role);
        $writer->assignRole($writer_role);

        // Assign all permissions to admin role
        $admin_role->givePermissionTo(Permission::all());
    }
}

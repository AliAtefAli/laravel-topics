<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Permissions\AllPermissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * 1. create user(admin)
         * 2. create role.
         * 3. create the permissions
         * 4. give the permissions to the role
        */

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make(123456789),
            'address' => 'Mansoura',
            'role' => 'admin',
        ]);

        $role = Role::create([
            'name' => 'admin'
        ]);

        foreach (AllPermissions::Permissions as $permission) {
            foreach ($permission as $p) {
                Permission::create([
                    'name' => $p
                ]);
            }
        }

        $role->givePermissionTo(AllPermissions::Permissions);
    }
}

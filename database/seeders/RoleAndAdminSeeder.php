<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $mempelaiRole = Role::create(['name' => 'mempelai']);

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@suratulem.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $admin->assignRole($adminRole);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('id_ID');

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // // create permissions
        Permission::create(['name' => 'manage-website']);
        Permission::create(['name' => 'manage-content']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'creator']);
        $role1->givePermissionTo('manage-content');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('manage-website');
        $role2->givePermissionTo('manage-content');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = User::create([
            'username'  => 'usertest',
            'name'      => 'usertest',
            'email'     => 'usertest@gmail.com',
            'description' => $faker->paragraph('2'),
            'password'  => Hash::make('password')
        ]);
        $user->assignRole($role1);

        $user = User::create([
            'username'  => 'adminlorem',
            'name'      => 'ADMIN',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('password')
        ]);
        $user->assignRole($role2);

        $user = User::create([
            'username'  => 'superadmin',
            'name'      => 'SUPER ADMIN',
            'email'     => 'super@gmail.com',
            'password'  => Hash::make('password')
        ]);
        $user->assignRole($role3);

    }
}

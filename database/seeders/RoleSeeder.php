<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DATA PERMISSION LIST REFERENSI DARI PermissionSeeder
        $permission_lists = Permission::all();

        try {
            
            $role1 = Role::create(['name' => 'creator']);
            $role1->givePermissionTo('creator');

            $role2 = Role::create(['name' => 'admin']);
            $role2->givePermissionTo('admin');
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

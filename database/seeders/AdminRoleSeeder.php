<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleTeam = Role::firstOrCreate(['name' => 'team admin']);

        $roleTeam->givePermissionTo(Permission::firstOrCreate(['name' => 'update team']));
        $roleTeam->givePermissionTo(Permission::firstOrCreate(['name' => 'view team members']));
        $roleTeam->givePermissionTo(Permission::firstOrCreate(['name' => 'remove team members']));
        $roleTeam->givePermissionTo(Permission::firstOrCreate(['name' => 'invite to team']));
    }
}

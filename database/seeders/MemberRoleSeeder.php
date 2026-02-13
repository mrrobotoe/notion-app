<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MemberRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleTeamMember = Role::firstOrCreate(['name' => 'team member']);

        $roleTeamMember->givePermissionTo(Permission::firstOrCreate(['name' => 'view team members']));
    }
}

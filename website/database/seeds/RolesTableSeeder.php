<?php

use App\Applications\User\Model\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => 1,
            'name' => Role::ADMIN,
            'display_name' => 'System Administrator',
            'description' => 'General administrator role with read/write access to almost everything',
        ]);
        Role::create([
            'id' => 2,
            'name' => Role::COLLABORATOR,
            'display_name' => 'System Collaborator',
            'description' => 'General administration role with read access to almost everything but no write access',
        ]);
        Role::create([
            'id' => 3,
            'name' => Role::PUBLIC,
            'display_name' => 'Public User',
            'description' => 'Public User that has access to the public user features',
        ]);
    }
}

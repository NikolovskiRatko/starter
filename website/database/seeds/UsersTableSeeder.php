<?php

use Illuminate\Database\Seeder;
use App\Applications\User\Model\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $Admin */
        $Admin = User::create([
            'id' => 1,
            'username' => 'administrator',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'is_disabled' => 0,
            'password' => bcrypt('password'),
        ]);
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        /** @var User $Colaborator */
        $Colaborator = User::create([
            'id' => 2,
            'username' => 'collaborator',
            'first_name' => 'Collaborator',
            'last_name' => 'User',
            'email' => 'collaborator@example.com',
            'is_disabled' => 0,
            'password' => bcrypt('password'),
        ]);
        DB::table('role_user')->insert([
            'user_id' => 2,
            'role_id' => 2,
        ]);

        /** @var User $Public */
        $Public = User::create([
            'id' => 3,
            'username' => 'public',
            'first_name' => 'Dimitar',
            'last_name' => 'Pashovski',
            'company' => 'Company',
            'company_vat' => 'A789-BCD',
            'email' => 'public@example.com',
            'is_disabled' => 0,
            'password' => bcrypt('password'),
        ]);
        DB::table('role_user')->insert([
            'user_id' => 3,
            'role_id' => 3,
        ]);

        $Public = User::create([
            'id' => 4,
            'username' => 'tartufka',
            'first_name' => 'Elena',
            'last_name' => 'Stankovska',
            'company' => 'Company',
            'company_vat' => 'A789-BCD',
            'email' => 'public@gmail.com',
            'is_disabled' => 0,
            'password' => bcrypt('password'),
        ]);
        DB::table('role_user')->insert([
            'user_id' => 4,
            'role_id' => 3,
        ]);

        $Public = User::create([
            'id' => 5,
            'username' => 'pederbal',
            'first_name' => 'Tomche',
            'last_name' => 'Mucuko',
            'company' => 'Company',
            'company_vat' => 'A789-BCD',
            'email' => 'public@yahoo.com',
            'is_disabled' => 0,
            'password' => bcrypt('password'),
        ]);
        DB::table('role_user')->insert([
            'user_id' => 5,
            'role_id' => 3,
        ]);

        DB::table('details')->insert([
            'user_id' => 3,
            'type' => 'SHIPPING',
            'name' => 'Public User',
            'city' => 'New York',
            'address' => '12th Ave',
            'company' => 'Company',
            'company_vat' => 'A789-BCD',
            'country_id' => 581,
            'phone' => '+44 113 496 0999',
            'default' => true
        ]);

        DB::table('details')->insert([
            'user_id' => 3,
            'type' => 'BILLING',
            'name' => 'Public User',
            'city' => 'New York',
            'address' => '12th Ave',
            'company' => 'Company',
            'company_vat' => 'A789-BCD',
            'country_id' => 581,
            'phone' => '+44 113 496 0999',
            'default' => true
        ]);

        DB::table('details')->insert([
            'user_id' => 4,
            'type' => 'SHIPPING',
            'name' => 'Public User',
            'city' => 'New York',
            'address' => '12th Ave',
            'company' => 'Company',
            'company_vat' => 'A789-BCD',
            'country_id' => 581,
            'phone' => '+44 113 496 0999',
            'default' => true
        ]);

        DB::table('details')->insert([
            'user_id' => 4,
            'type' => 'BILLING',
            'name' => 'Public User',
            'city' => 'New York',
            'address' => '12th Ave',
            'company' => 'Company',
            'company_vat' => 'A789-BCD',
            'country_id' => 581,
            'phone' => '+44 113 496 0999',
            'default' => true
        ]);

        DB::table('details')->insert([
            'user_id' => 5,
            'type' => 'SHIPPING',
            'name' => 'Public User',
            'city' => 'New York',
            'address' => '12th Ave',
            'company' => 'Company',
            'company_vat' => 'A789-BCD',
            'country_id' => 581,
            'phone' => '+44 113 496 0999',
            'default' => true
        ]);

        DB::table('details')->insert([
            'user_id' => 5,
            'type' => 'BILLING',
            'name' => 'Public User',
            'city' => 'New York',
            'address' => '12th Ave',
            'company' => 'Company',
            'company_vat' => 'A789-BCD',
            'country_id' => 581,
            'phone' => '+44 113 496 0999',
            'default' => true
        ]);

        try {
            $Admin->addMedia(public_path() . '/images/avatar.jpg')->preservingOriginal()->toMediaCollection('user_avatars');
            $Colaborator->addMedia(public_path() . '/images/bag-size-1.jpg')->preservingOriginal()->toMediaCollection('user_avatars');
            $Public->addMedia(public_path() . '/images/custom-bag-size.jpg')->preservingOriginal()->toMediaCollection('user_avatars');
        } catch (Exception $e) {
            echo ($e);
        }
    }
}

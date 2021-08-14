<?php

use App\Applications\Booking\Model\ChildService;
use Illuminate\Database\Seeder;

class ChildServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChildService::create([
            'id' => 1,
            'name' => 'Depilacija na noze',
            'duration' => 30,
            'order' => 1,
            'price' => 300,
            'parent_service_id' => 1,
            'active' => 1
        ]);

        ChildService::create([
            'id' => 2,
            'name' => 'Depilacija na race',
            'duration' => 15,
            'order' => 2,
            'price' => 200,
            'parent_service_id' => 1,
            'active' => 1
        ]);

        ChildService::create([
            'id' => 3,
            'name' => 'Depilacija na intima',
            'duration' => 30,
            'order' => 3,
            'price' => 250,
            'parent_service_id' => 1,
            'active' => 1
        ]);

        ChildService::create([
            'id' => 4,
            'name' => 'Depilacija na lice',
            'duration' => 15,
            'order' => 4,
            'price' => 200,
            'parent_service_id' => 1,
            'active' => 1
        ]);

        ChildService::create([
            'id' => 5,
            'name' => 'Depilacija na vegi i nadusnici',
            'duration' => 15,
            'order' => 5,
            'price' => 100,
            'parent_service_id' => 1,
            'active' => 1
        ]);
    }
}

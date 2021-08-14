<?php

use App\Applications\Booking\Model\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'id' => 1,
            'name' => 'Depilacija',
            'duration' => 0,
            'order' => 1,
            'price' => 0,
            'active' => 1
        ]);

        Service::create([
            'id' => 2,
            'name' => 'Gel lak',
            'duration' => 45,
            'order' => 2,
            'price' => 250,
            'active' => 1
        ]);

        Service::create([
            'id' => 3,
            'name' => 'Pedikir',
            'duration' => 30,
            'order' => 3,
            'price' => 300,
            'active' => 1
        ]);

        Service::create([
            'id' => 4,
            'name' => 'Tretman za lice',
            'duration' => 25,
            'order' => 4,
            'price' => 0,
            'active' => 1
        ]);

        Service::create([
            'id' => 5,
            'name' => 'Parafin na race/noze',
            'duration' => 60,
            'order' => 5,
            'price' => 250,
            'active' => 1
        ]);
    }
}

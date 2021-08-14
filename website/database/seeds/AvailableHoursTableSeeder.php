<?php

use App\Applications\Booking\Model\AvailableHours;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AvailableHoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AvailableHours::create([
            'id' => 1,
            'time' => Carbon::today()->addHour(9)->addMinute(00),
        ]);

        AvailableHours::create([
            'id' => 2,
            'time' => Carbon::today()->addHour(9)->addMinute(30),
        ]);

        AvailableHours::create([
            'id' => 3,
            'time' => Carbon::today()->addHour(10)->addMinute(00),
        ]);

        AvailableHours::create([
            'id' => 4,
            'time' => Carbon::today()->addHour(10)->addMinute(30),
        ]);

        AvailableHours::create([
            'id' => 5,
            'time' => Carbon::today()->addHour(11)->addMinute(00),
        ]);

        AvailableHours::create([
            'id' => 6,
            'time' => Carbon::today()->addHour(11)->addMinute(30),
        ]);

        AvailableHours::create([
            'id' => 7,
            'time' => Carbon::today()->addHour(12)->addMinute(00),
        ]);

        AvailableHours::create([
            'id' => 8,
            'time' => Carbon::today()->addHour(12)->addMinute(30),
        ]);

        AvailableHours::create([
            'id' => 9,
            'time' => Carbon::today()->addHour(16)->addMinute(00),
        ]);

        AvailableHours::create([
            'id' => 10,
            'time' => Carbon::today()->addHour(16)->addMinute(30),
        ]);

        AvailableHours::create([
            'id' => 11,
            'time' => Carbon::today()->addHour(17)->addMinute(00),
        ]);

        AvailableHours::create([
            'id' => 12,
            'time' => Carbon::today()->addHour(17)->addMinute(30),
        ]);

        AvailableHours::create([
            'id' => 13,
            'time' => Carbon::today()->addHour(18)->addMinute(00),
        ]);

        AvailableHours::create([
            'id' => 14,
            'time' => Carbon::today()->addHour(18)->addMinute(30),
        ]);

        AvailableHours::create([
            'id' => 15,
            'time' => Carbon::today()->addHour(19)->addMinute(00),
        ]);
    }
}

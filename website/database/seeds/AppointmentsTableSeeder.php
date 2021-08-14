<?php

use App\Applications\Booking\Model\Appointment;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AppointmentsTableSeeder extends Seeder
{
    //TODO: CREATE CREATED/EDITED BY USER/ADMIN TO AVOID THE ISSUE WITH DIFFERENT AVAILABLE HOURS
    //TODO: USER CAN ONLY EDIT APPOINTMENT THAT IS CREATED/EDITED BY HIM/HER
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appointment = Appointment::create([
            'id' => 1,
            'user_id' => 3,
            'duration' => 60,
            'start' => Carbon::today()->addHour(11)->addMinute(00),
            'end' => Carbon::today()->addHour(12)->addMinute(00),
            'date' => Carbon::today(),
            'status' => 1,
        ]);
        $appointment->service()->sync([1,3]);
        $appointment->child_service()->sync([1,2]);


        $appointment = Appointment::create([
            'id' => 2,
            'user_id' => 3,
            'duration' => 30,
            'start' => Carbon::today()->addHour(10)->addMinute(00),
            'end' => Carbon::today()->addHour(11)->addMinute(30),
            'date' => Carbon::today(),
            'status' => 1,
        ]);
        $appointment->service()->sync([2]);

    }
}

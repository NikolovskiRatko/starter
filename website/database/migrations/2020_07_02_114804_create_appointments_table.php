<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('duration');
            $table->time('start');
            $table->time('end');
            $table->date('date');
            $table->integer('status')->default(1);
        });

        Schema::create('appointment_service', function (Blueprint $table) {
            $table->integer('appointment_id')->unsigned();
            $table->integer('service_id')->unsigned();
        });

        Schema::create('appointment_child_service', function (Blueprint $table) {
            $table->integer('appointment_id')->unsigned();
            $table->integer('child_service_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('appointment_service');
        Schema::dropIfExists('appointment_child_service');
    }
}

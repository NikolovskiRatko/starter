<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailsTable extends Migration {

	public function up()
	{
		Schema::create('details', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name', 80)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('alt_address', 200)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('company')->nullable();
            $table->string('company_vat')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('type');
            $table->integer('user_id')->unsigned();
            $table->boolean('default')->default(false);
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('details');
	}
}

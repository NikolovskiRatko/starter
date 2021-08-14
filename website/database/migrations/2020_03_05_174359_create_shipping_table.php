<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingTable extends Migration {

	public function up()
	{
		Schema::create('shipping', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('base_price');
			$table->integer('price_kg')->unsigned();
			$table->integer('min_price')->unsigned();
			$table->integer('max_palete_weight')->unsigned();
		});

	}

	public function down()
	{
		Schema::drop('shipping');
	}
}

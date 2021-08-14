<?php

use Illuminate\Database\Migrations\Migration;

class SetupCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return  void
	 */
	public function up()
	{
		// Creates the users table
		Schema::create(\Config::get('countries.table_name'), function($table)
		{
		    $table->integer('id')->unsigned()->index();
		    $table->string('capital')->nullable();
		    $table->string('citizenship')->nullable();
		    $table->string('country_code')->default('');
		    $table->string('currency')->nullable();
		    $table->string('currency_code')->nullable();
		    $table->string('currency_sub_unit')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->integer('currency_decimals')->nullable();
		    $table->string('full_name')->nullable();
		    $table->string('iso_3166_2')->default('');
		    $table->string('iso_3166_3')->default('');
		    $table->string('name')->default('');
		    $table->string('region_code')->default('');
		    $table->string('sub_region_code')->default('');
		    $table->boolean('eea')->default(0);
		    $table->string('calling_code')->nullable();
		    $table->string('flag')->nullable();

		    $table->primary('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return  void
	 */
	public function down()
	{
		Schema::drop(\Config::get('countries.table_name'));
	}

}

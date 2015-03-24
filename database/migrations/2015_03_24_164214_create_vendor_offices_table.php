<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorOfficesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendor_offices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('vendor_id')->unsigned();
			$table->string('street');
			$table->string('city');
			$table->string('country');
			$table->double('latitude');
			$table->double('longitude');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vendor_offices');
	}

}

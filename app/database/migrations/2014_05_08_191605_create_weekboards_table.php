<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWeekboardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weekboards', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('lim_id')->unsigned();
			$table->timestamps();

			$table->foreign('lim_id')
			      ->references('id')->on('lims')
			      ->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('weekboards');
	}

}

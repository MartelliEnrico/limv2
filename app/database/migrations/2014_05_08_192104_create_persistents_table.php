<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersistentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persistents', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('lim_id')->unsigned();
			$table->integer('class_id')->unsigned();
			$table->timestamps();

			$table->foreign('lim_id')
			      ->references('id')->on('lims')
			      ->onDelete('cascade');

			$table->foreign('class_id')
			      ->references('id')->on('classes')
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
		Schema::drop('persistents');
	}

}

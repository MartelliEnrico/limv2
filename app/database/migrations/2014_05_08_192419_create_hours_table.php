<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hours', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('day')->unsigned();
			$table->integer('hour')->unsigned();
			$table->integer('teacher_id')->unsigned()->nullable();
			$table->integer('class_id')->unsigned();
			$table->morphs('reservable');
			$table->timestamps();

			$table->foreign('teacher_id')
			      ->references('id')->on('users')
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
		Schema::drop('hours');
	}

}

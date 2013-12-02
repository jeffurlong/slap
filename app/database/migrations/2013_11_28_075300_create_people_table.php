<?php

use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id')->unsigned();
			$table->integer('master_id')->unsigned()->nullable()->index();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('phone');
			$table->string('street')->nullable();
			$table->string('city')->nullable();
			$table->string('state', 2)->nullable();
			$table->string('zip', 10)->nullable();
			$table->enum('gender', array('M', 'F'))->nullable();
			$table->date('dob')->nullable();
			$table->string('emergency_name')->nullable();
			$table->string('emergency_phone')->nullable();
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
		Schema::drop('people');
	}

}

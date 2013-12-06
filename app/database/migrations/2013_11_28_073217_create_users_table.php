<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
			// $table->integer('person_id')->unsigned()->unique();
			$table->string('email');
			$table->string('password');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip', 10)->nullable();
			$table->timestamps();
			$table->softDeletes();
        });


        Schema::create('password_reminders', function($table)
        {
            $table->engine = 'InnoDB';

            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('password_reminders');
        Schema::drop('users');
	}

}

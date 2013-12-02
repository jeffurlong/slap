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
			$table->integer('person_id')->unsigned()->unique();
			$table->string('email');
			$table->string('password');
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

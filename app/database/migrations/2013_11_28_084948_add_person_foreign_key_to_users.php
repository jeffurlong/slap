<?php

use Illuminate\Database\Migrations\Migration;

class AddPersonForeignKeyToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
            $table->foreign('person_id')
                ->references('id')->on('people');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table) {
            $table->dropForeign('users_person_id_foreign');
        });

	}

}

<?php

use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('participants', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id')->unsigned();
			$table->integer('parent_id')->unsigned();
			$table->string('first_name');
			$table->string('last_name');
			$table->enum('gender', array('M', 'F'));
			$table->date('dob');
			$table->string('emergency_name')->nullable();
			$table->string('emergency_phone')->nullable();
			$table->timestamps();
			$table->softDeletes();
			
			$table->foreign('parent_id')->references('id')->on('users'); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('participants', function($table) {
            $table->dropForeign('participants_parent_id_foreign');
        });
        
		Schema::drop('participants');
	}

}

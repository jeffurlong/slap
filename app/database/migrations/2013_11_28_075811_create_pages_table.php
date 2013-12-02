<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id')->unsigned();
			$table->string('title');
			$table->text('content')->nullable();
			$table->string('slug');
			$table->string('meta_title');
			$table->string('meta_description');
			$table->boolean('visible')->default(true);

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
		Schema::drop('pages');
	}

}

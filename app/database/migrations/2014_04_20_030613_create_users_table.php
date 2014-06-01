<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			/* main */
			$table->bigIncrements('id');
			$table->string('email',64)->unique();
			$table->string('username',32)->unique();  // Changeable
			$table->string('password',60);
			$table->timestamps();

			/* profile */
			$table->string('icon',42)->nullable();  // Filename
			$table->tinyInteger('ugender')->default(3);
			$table->tinyInteger('uintend')->default(3);
			$table->smallInteger('ucity')->nullable();
			$table->string('udepict',333)->nullable();
			$table->tinyInteger('udefview')->default(1);

			/* posts & hoards */
			$table->mediumInteger('urepost')->default(0);
			$table->integer('upost')->default(0);
			$table->smallInteger('uhoard')->default(0);
			$table->integer('ubehoard')->default(0);

			/* follow */
			$table->smallinteger('ufollowppl')->default(0);
			$table->integer('ufollowers')->default(0);
			$table->smallinteger('ufollowcates')->default(0);

			/* Record */
			$table->tinyInteger('uvalid')->default(0);  // 0 indicates it is a valid user; 1: he/she has canceled
			$table->tinyInteger('ubanned')->default(0); // 0: not banned; 1: banned

			/* Laravel */
			$table->string('remember_token',100)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

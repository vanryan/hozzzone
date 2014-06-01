<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesrsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imagesrs', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('srname',32)->unique();
			$table->string('srdepict',233)->unique();

			$table->bigInteger('auid');
			$table->string('auname',32);
			$table->string('auicon',42)->nullable()->default('default_avatar');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imagesrs');
	}

}

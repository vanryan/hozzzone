<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageindsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'imageinds', function( Blueprint $table ) {
				$table->bigIncrements( 'id' );
				$table->string( 'filename', 64 )->unique();
				$table->string( 'imgtitle', 60 )->nullable();

				$table->bigInteger( 'upuid' );
				$table->string( 'upuname', 32 );
				$table->string( 'upuicon', 42 )->nullable()->default( 'default_avatar' );

				$table->timestamps();

				$table->tinyInteger( 'srseq' )->default( 0 );
				$table->integer( 'srid' )->default( 0 );
				$table->tinyInteger( 'srcover' )->default( 0 );

				$table->integer( 'hits' )->default( 0 );
			} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'imageinds' );
	}

}

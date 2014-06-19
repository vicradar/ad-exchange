<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('adItems', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('identifier')->unique();
			$table->string('title');
			$table->string('mimeType');
			$table->string('storeUrl');
			$table->string('appUrl');
			$table->string('rootFileIdentifier');
			$table->timestamps();
		});

		Schema::create('platforms', function(Blueprint $table) 
		{
			$table->increments('id');
			$table->string('identifier')->unique();
			$table->string('title');
			$table->timestamps();
		});

		Schema::create('adItemPlatformMaps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('adItemIdentifier');
			$table->string('platformIdentifier');
			$table->unique(['adItemIdentifier', 'platformIdentifier']);
		});

		Schema::create('adItemFiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('identifier')->unique();
			$table->string('adItemIdentifier');
			$table->string('fileHash');
			$table->string('storagePath');
			$table->string('usePath');
			$table->timestamps();
			
			$table->index('adItemIdentifier');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('adItems');
		Schema::drop('platforms');
		Schema::drop('adItemPlatformMaps');
		Schema::drop('adItemFiles');
	}

}

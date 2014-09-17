<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::create('other_cat', function(Blueprint $table)
		{
			$table->increments('id');
			//$table->tinyInteger('status')->default(1);
			//$table->string('image','255');
			$table->string('name','255');
			//$table->string('image','255');
			//$table->string('platforms','255');
			//$table->integer('s');
			//$table->integer('e');
			//$table->string('run','255');
			//$table->integer('show_id');
			//$table->tinyInteger('deleted')->default(0);
			//$table->integer('user_id')->unsigned();
			//$table->integer('comment_parent')->unsigned();
			//$table->string('content');
			//$table->timestamps();

			//$table->foreign('media_id')->references('id')->on('media');
			//$table->foreign('profile_id')->references('id')->on('users');
		});

	}

}

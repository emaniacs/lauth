<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users', function ($t) {
			$t->increments('id');
			$t->string('fullname', 64);
			$t->string('username', 32)->unique();
			$t->string('email', 64)->unique();
			$t->string('password', 64);
			$t->string('role')->default(1);
			$t->string('status')->default(1);
			$t->timestamps();
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
		Schema::drop('users');
	}

}

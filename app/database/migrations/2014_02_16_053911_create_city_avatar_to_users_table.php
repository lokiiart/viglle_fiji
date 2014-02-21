<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityAvatarToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::table('users',function($table){
            $table->string('city')->default("深圳");
            $table->integer('telephone')->default("00000000000");
            $table->string('intro')->default("没有填写个人简介");
            $table->string('avatar')->default("http://placehold.it/230x230");
			});
		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}

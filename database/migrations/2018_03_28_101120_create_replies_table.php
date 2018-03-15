<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration 
{
	public function up()
	{
		Schema::create('replies', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned()->default(0)->index();
            $table->integer('user_id')->unsigned()->default(0)->index();
            $table->integer('reply_user_id')->unsigned()->default(0)->index();
            $table->text('body');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('replies');
	}
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('munes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('name_en')->nullable();;
            $table->integer('parent_id')->defalut('0');
            $table->string('icon')->default('&#xe68e;');
            $table->string('href')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('munes');
    }
}

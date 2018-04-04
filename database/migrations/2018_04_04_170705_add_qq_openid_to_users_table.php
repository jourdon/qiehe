<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQqOpenidToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('platform')->after('password')->nullable();
            $table->string('openid')->unique()->nullable()->after('platform');
            $table->string('password')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('sex')->default(1);
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('platform');
            $table->dropColumn('openid');
            $table->dropColumn('sex');
            $table->dropColumn('province');
            $table->dropColumn('city');
            $table->dropColumn('status');
            $table->string('password')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
        });
    }
}

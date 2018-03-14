<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarAndIntroductionToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('sex')->default(1);
            $table->string('avatar')->nullable();
            $table->string('introduction')->nullable();
            $table->tinyInteger('is_admin')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamp('last_login_in')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('ip')->nullable();
            $table->string('address')->nullable();
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
            $table->dropColumn('sex');
            $table->dropColumn('avatar');
            $table->dropColumn('introduction');
            $table->dropColumn('is_admin');
            $table->dropColumn('status');
            $table->dropColumn('last_login_in');
            $table->dropColumn('user_agent');
            $table->dropColumn('ip');
            $table->dropColumn('address');
        });
    }
}

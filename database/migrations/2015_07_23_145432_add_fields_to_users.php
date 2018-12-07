<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('birthday');
            $table->text('bio');
            $table->string('gender');
            $table->string('mobile_no');
            $table->string('country');
            $table->string('timezone');
            $table->string('reset_password_code');
            $table->dateTime('reset_requested_on');
            $table->tinyInteger('activated');
            $table->string('activation_code');
            $table->dateTime('activated_at');
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
            $table->dropColumn('birthday');
            $table->dropColumn('bio');
            $table->dropColumn('gender');
            $table->dropColumn('mobile_no');
            $table->dropColumn('country');
            $table->dropColumn('timezone');
            $table->dropColumn('reset_password_code');
            $table->dropColumn('reset_requested_on');
            $table->dropColumn('activated');
            $table->dropColumn('activation_code');
            $table->dropColumn('activated_at');
        });
    }
}

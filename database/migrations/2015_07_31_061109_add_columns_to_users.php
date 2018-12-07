<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('website_url');
            $table->string('twitter_url');
            $table->string('google_plus_url');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->tinyInteger('show_author_box')->default(1);
            $table->tinyInteger('show_author_socials')->default(1);
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
            $table->dropColumn('website_url');
            $table->dropColumn('twitter_url');
            $table->dropColumn('google_plus_url');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('show_author_box');
            $table->dropColumn('show_author_socials');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDontShowAuthorAsPublisher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sources', function (Blueprint $table) {
            $table->tinyInteger('dont_show_author_publisher');
            $table->tinyInteger('show_post_source');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->tinyInteger('dont_show_author_publisher');
            $table->tinyInteger('show_post_source');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sources', function (Blueprint $table) {
            $table->dropColumn('dont_show_author_publisher');
            $table->dropColumn('show_post_source');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('dont_show_author_publisher');
            $table->dropColumn('show_post_source');
        });
    }
}

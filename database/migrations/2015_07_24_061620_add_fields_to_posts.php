<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->tinyInteger('show_in_mega_menu');
            $table->string('render_type');
            $table->string('video_embed_code');
            $table->tinyInteger('image_parallax');
            $table->tinyInteger('video_parallax');
            $table->tinyInteger('rating_box');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('show_in_mega_menu');
            $table->dropColumn('render_type');
            $table->dropColumn('video_embed_code');
            $table->dropColumn('image_parallax');
            $table->dropColumn('video_parallax');
            $table->dropColumn('rating_box');
        });
    }
}

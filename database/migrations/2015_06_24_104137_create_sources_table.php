<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->integer('priority');
            $table->integer('category_id');
            $table->string('channel_title');
            $table->string('channel_link');
            $table->string('channel_description');
            $table->string('channel_language');
            $table->string('channel_pubDate');
            $table->string('channel_lastBuildDate');
            $table->string('channel_generator');
            $table->tinyInteger('auto_update');
            $table->integer('items_count');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->integer('category_id');
            $table->string('type');
            $table->integer('source_id');
            $table->text('description');
            $table->string('featured_image');
            $table->integer('views');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('sources');
        Schema::dropIfExists('posts');
    }
}

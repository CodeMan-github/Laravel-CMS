<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->string('email');
            $table->string('name');
            $table->integer('user_id');
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('rating');
            $table->tinyInteger('approved');
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
        Schema::dropIfExists("post_ratings");
    }
}

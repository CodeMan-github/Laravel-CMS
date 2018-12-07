<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Settings;

class AddTwitterHandleSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settings = new Settings();
        $settings->category = Settings::CATEGORY_SOCIAL;
        $settings->column_key = 'twitter_handle';
        $settings->value_string = '';
        $settings->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::where('category', Settings::CATEGORY_SOCIAL)->where('column_key', 'twitter_handle')->delete();
    }
}

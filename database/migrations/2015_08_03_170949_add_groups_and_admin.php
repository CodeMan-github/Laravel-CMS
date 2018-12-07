<?php

use Illuminate\Database\Migrations\Migration;

class AddGroupsAndAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(\App\Groups::where('name',\App\Users::TYPE_ADMIN)->count() <= 0) {

            $group = new \App\Groups();
            $group->name = \App\Users::TYPE_ADMIN;
            $group->save();

            $admin = new \App\Users();
            $admin->name = "Admin";
            $admin->slug = \Illuminate\Support\Str::slug("Admin");
            $admin->email = "admin@mail.com";
            $admin->password = Hash::make("admin");
            $admin->avatar = URL::to('/uploads/author-thumb.jpg');
            $admin->birthday = "15-01-1990";
            $admin->bio = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quam ex, dignissim at sem nec, rutrum volutpat sapien. Curabitur sed mauris metus. Sed in erat ullamcorper, congue dolor quis, tristique quam. Fusce a pharetra nulla. Duis imperdiet varius odio id mattis";
            $admin->gender = "Male";
            $admin->mobile_no = "+1922933234";
            $admin->country = "1";
            $admin->activated = 1;
            $admin->fb_url = "http://www.facebook.com/shellprog";
            $admin->fb_page_url = "http://www.facebook.com/kodeinfo";
            $admin->website_url = "http://www.kodeinfo.com";
            $admin->google_plus_url = "http://plus.google.com";
            $admin->save();

            $users_group = new \App\UsersGroups();
            $users_group->group_id = $group->id;
            $users_group->user_id = $admin->id;
            $users_group->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Groups;
use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use App\Posts;
use App\Users;
use App\UsersGroups;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Support\Str;
use Input;
use Session;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('has_permission:users.add', ['only' => ['create', 'store']]);
        $this->middleware('has_permission:users.edit', ['only' => ['edit', 'update']]);
        $this->middleware('has_permission:users.view', ['only' => ['all']]);
        $this->middleware('has_permission:users.delete', ['only' => ['delete']]);
    }

    public function create()
    {
        $countries = DB::table('countries')->get();
        $groups = DB::table('groups')->get();

        return view('admin.users.create', ['countries' => $countries, 'groups' => $groups]);
    }

    public function store()
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        $v = \Validator::make([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
            'type' => Input::get('type'),
        ], [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'type' => 'required',
        ]);

        if ($v->fails()) {
            Session::flash('error_msg', Utils::messages($v));
            return redirect()->back()->withInput(Input::except('avatar'));
        }

        $user = new Users();
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->avatar = Input::hasFile('avatar') ? Utils::imageUpload(Input::file('avatar')) : '';
        $user->birthday = Input::get('dob');
        $user->bio = Input::get('bio');
        $user->gender = Input::get('gender');
        $user->mobile_no = Input::get('mobile_no');
        $user->fb_url = Input::get('fb_url');
        $user->fb_page_url = Input::get('fb_page_url');
        $user->website_url = Input::get('website_url');
        $user->twitter_url = Input::get('twitter_url');
        $user->google_plus_url = Input::get('google_plus_url');
        $user->country = Input::get('country');
        $user->activated = Input::has('activate');

        if (Input::has('activate')) {
            $user->activated_at = Carbon::now();
        }

        $user->save();

        $type = Input::get('type', 1);

        $users_group = new UsersGroups();
        $users_group->group_id = $type;
        $users_group->user_id = $user->id;
        $users_group->save();

        Session::flash('success_msg', trans('messages.user_created_success'));
        return redirect()->to('/admin/users/all');

    }

    public function edit($id)
    {

        if (!is_null($id) && sizeof(Users::where('id', $id)->get()) > 0) {

            $user = Users::where('id', $id)->first();
            $countries = DB::table('countries')->get();
            $groups = DB::table('groups')->get();

            $user->group = UsersGroups::where('user_id', $user->id)->first();

            return view('admin.users.edit', ['user' => $user, 'countries' => $countries, 'groups' => $groups]);

        } else {
            Session::flash('error_msg', trans('messages.user_not_found'));
            return redirect()->to('/admin/users/all');
        }

    }

    public function update()
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (Input::has('id') && sizeof(Users::where('id', Input::get('id'))->get()) > 0) {

            if (sizeof(Users::where('email', Input::get('email'))->where('id', '!=', Input::get('id'))->get()) > 0) {
                Session::flash('error_msg', 'Email already exists');
                return redirect()->back()->withInput(Input::all());
            }

            if (sizeof(Users::where('name', Input::get('name'))->where('id', '!=', Input::get('id'))->get()) > 0) {
                Session::flash('error_msg', 'Name already exists');
                return redirect()->back()->withInput(Input::all());
            }

            $data = [
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'type' => Input::get('type'),
            ];

            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'type' => 'required',
            ];

            if (strlen(Input::get('password')) > 0) {
                $data['password'] = Input::get('password');
                $data['password_confirmation'] = Input::get('password_confirmation');

                $rules['password'] = 'required|confirmed';
                $rules['password_confirmation'] = 'required';
            }

            $v = \Validator::make($data, $rules);

            if ($v->fails()) {
                Session::flash('error_msg', Utils::messages($v));
                return redirect()->back()->withInput(Input::except('avatar'));
            }

            $user = Users::where('id', Input::get('id'))->first();

            $user->name = Input::get('name');
            $user->slug = Str::slug(Input::get('name'));
            $user->email = Input::get('email');

            if (strlen(Input::get('password')) > 0) {
                $user->password = Hash::make(Input::get('password'));
            }

            $user->avatar = Input::hasFile('avatar') ? Utils::imageUpload(Input::file('avatar')) : Input::get('old_avatar');
            $user->birthday = Input::get('dob');
            $user->bio = Input::get('bio');
            $user->gender = Input::get('gender');
            $user->mobile_no = Input::get('mobile_no');
            $user->fb_url = Input::get('fb_url');
            $user->fb_page_url = Input::get('fb_page_url');
            $user->website_url = Input::get('website_url');
            $user->twitter_url = Input::get('twitter_url');
            $user->google_plus_url = Input::get('google_plus_url');
            $user->country = Input::get('country');
            $user->activated = Input::has('activate');

            if (Input::has('activate')) {
                $user->activated_at = Carbon::now();
            }

            $user->save();

            $group = UsersGroups::where('user_id', $user->id)->first();

            $type = Input::get('type', 1);

            if ($group->id != $type) {

                UsersGroups::where('id', $group->id)->delete();

                $users_group = new UsersGroups();
                $users_group->group_id = $type;
                $users_group->user_id = $user->id;
                $users_group->save();
            }

            Session::flash('success_msg', trans('messages.user_updated_success'));
            return redirect()->to('/admin/users/all');
        } else {
            Session::flash('error_msg', trans('messages.user_not_found'));
            return redirect()->to('/admin/users/all');
        }

    }

    public function all()
    {

        $users = Users::all();

        foreach ($users as $user) {
            if($user->slug=='customer')
            {
                $user->type = "customer";
            }
            else {
                $user_group = UsersGroups::where('user_id', $user->id)->first();
                $user->type = Groups::where('id', $user_group->group_id)->first();
            }
        }

        return view('admin.users.all', ['users' => $users]);
    }

    public function delete($id)
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!is_null($id) && sizeof(Users::where('id', $id)->get()) > 0) {

            Users::where('id', $id)->delete();
            UsersGroups::where('user_id', $id)->delete();
            Posts::where('author_id', $id)->delete();

            Session::flash('success_msg', trans('messages.user_deleted_success'));
            return redirect()->to('/admin/users/all');

        } else {
            Session::flash('error_msg', trans('messages.user_not_found'));
            return redirect()->to('/admin/users/all');
        }
    }

}
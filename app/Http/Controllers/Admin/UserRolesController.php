<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use App\Groups;
use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use App\Permissions;
use App\Posts;
use App\Users;
use App\UsersGroups;
use Input;
use Session;

class UserRolesController extends Controller
{

    function __construct()
    {
        $this->middleware('has_permission:roles.add', ['only' => ['create', 'store']]);
        $this->middleware('has_permission:roles.edit', ['only' => ['edit', 'update']]);
        $this->middleware('has_permission:roles.view', ['only' => ['all']]);
        $this->middleware('has_permission:roles.delete', ['only' => ['delete']]);
    }

    public function create()
    {
        $permissions_groups = \Config::get('permissions');

        return view('admin.roles.create', ['permissions_groups' => $permissions_groups]);
    }

    public function store()
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!Input::has('role')) {
            Session::flash('error_msg', trans('messages.role_required'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!Input::has('permissions')) {
            Session::flash('error_msg', trans('messages.permissions_required'));
            return redirect()->back()->withInput(Input::all());
        }

        if (sizeof(Groups::where('name', Input::get('role'))->get()) > 0) {
            Session::flash('error_msg', trans('messages.role_already_exists'));
            return redirect()->back()->withInput(Input::all());
        }


        $group = new Groups();
        $group->name = Input::get('role');
        $group->permissions = implode(',', Input::get('permissions'));
        $group->save();

        Session::flash('success_msg', trans('messages.user_role_created_success'));
        return redirect()->to('/admin/roles/all');

    }

    public function edit($id)
    {

        if (!is_null($id) && sizeof(Groups::where('id', $id)->get()) > 0) {

            $group = Groups::where('id', $id)->first();
            $parsed_permissions = Utils::parsePermissions($group->permissions, true);

            return view('admin.roles.edit', ['parsed_permissions' => $parsed_permissions, 'role' => $group, 'permissions_groups' => \Config::get('permissions')]);

        } else {
            Session::flash('error_msg', trans('messages.user_role_not_found'));
            return redirect()->to('/admin/roles/all');
        }

    }

    public function update()
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (Input::has('id') && sizeof(Groups::where('id', Input::get('id'))->get()) > 0) {

            if (!Input::has('role')) {
                Session::flash('error_msg', trans('messages.role_required'));
                return redirect()->back()->withInput(Input::all());
            }

            if (!Input::has('permissions')) {
                Session::flash('error_msg', trans('messages.permissions_required'));
                return redirect()->back()->withInput(Input::all());
            }

            if (sizeof(Groups::where('name', Input::get('role'))->where('id', '!=', Input::get('id'))->get()) > 0) {
                Session::flash('error_msg', trans('messages.role_already_exists'));
                return redirect()->back()->withInput(Input::all());
            }

            $group = Groups::where('id', Input::get('id'))->first();
            $group->name = Input::get('role');
            $group->permissions = implode(',', Input::get('permissions'));
            $group->save();

            Session::flash('success_msg', trans('messages.user_role_updated_success'));
            return redirect()->to('/admin/roles/all');

        } else {
            Session::flash('error_msg', trans('messages.user_role_not_found'));
            return redirect()->to('/admin/roles/all');
        }

    }

    public function all()
    {

        $roles = Groups::all();

        foreach ($roles as $role) {
            $role->permissions = Utils::parsePermissions($role->permissions);
        }

        return view('admin.roles.all', ['roles' => $roles]);
    }

    public function delete($id)
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!is_null($id) && sizeof(Groups::where('id', $id)->get()) > 0) {

            //Get all users in this group
            //For each user delete sources and posts
            //and then delete user

            $group = Groups::where('id', $id)->first();

            if (!empty($group) && $group->name != Users::TYPE_ADMIN) {

                $users = UsersGroups::where('group_id', $id)->lists('user_id');

                //Delete all posts by users
                foreach ($users as $user) {
                    Posts::where('author_id', $user)->delete();
                    Users::where('id', $user)->delete();
                }

                UsersGroups::where('group_id', $id)->delete();
                Groups::where('id', $id)->delete();
            }

            Session::flash('success_msg', trans('messages.role_deleted_success'));
            return redirect()->to('/admin/roles/all');

        } else {
            Session::flash('error_msg', trans('messages.role_not_found'));
            return redirect()->to('/admin/roles/all');
        }
    }

}
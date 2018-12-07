<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use App\Pages;
use App\Users;
use Illuminate\Support\Str;
use Input;
use Session;

class PagesController extends Controller
{

    function __construct()
    {
        $this->middleware('has_permission:pages.add', ['only' => ['create', 'store']]);
        $this->middleware('has_permission:pages.edit', ['only' => ['edit', 'update']]);
        $this->middleware('has_permission:pages.view', ['only' => ['all']]);
        $this->middleware('has_permission:pages.delete', ['only' => ['delete']]);
    }

    public function create()
    {
        $admins = Utils::getUsersInGroup(Users::TYPE_ADMIN);

        return view('admin.pages.create', ['categories' => Categories::all(), 'admins' => $admins]);
    }

    public function store()
    {

        if(!Utils::hasWriteAccess()){
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!Input::has('title')) {
            Session::flash('error_msg', trans('messages.page_title_required'));
            return redirect()->back()->withInput(Input::all());
        }

        $page = new Pages();
        $page->title = Input::get('title');
        $page->description = Input::get('description');
        $page->slug = Str::slug(Input::get('title'));
        $page->show_in_menu = Input::has('show_in_menu') ? 1 : 0;
        $page->show_in_sidebar = Input::has('show_in_sidebar') ? 1 : 0;
        $page->show_in_footer = Input::has('show_in_footer') ? 1 : 0;
        $page->seo_keywords = Input::get('seo_keywords', Input::get('name'));
        $page->seo_description = Input::get('seo_description', Input::get('name'));
        $page->status = Input::get('status');
        $page->author_id = Input::get('author');
        $page->save();

        Session::flash('success_msg', trans('messages.page_created_success'));
        return redirect()->to('/admin/pages/all');

    }

    public function edit($id)
    {

        $admins = Utils::getUsersInGroup(Users::TYPE_ADMIN);

        if (!is_null($id) && sizeof(Pages::where('id', $id)->get()) > 0) {

            $page = Pages::where('id', $id)->first();
            return view('admin.pages.edit', ['page' => $page,'admins' => $admins]);

        } else {
            Session::flash('error_msg', trans('messages.page_not_found'));
            return redirect()->to('/admin/pages/all');
        }

    }

    public function update()
    {

        if(!Utils::hasWriteAccess()){
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (Input::has('id') && sizeof(Pages::where('id', Input::get('id'))->get()) > 0) {

            if (sizeof(Pages::where('title', Input::get('title'))->where('id', '!=', Input::get('id'))->get()) > 0) {
                Session::flash('error_msg', trans('messages.page_title_already_exists'));
                return redirect()->back()->withInput(Input::all());
            }

            $page = Pages::where('id', Input::get('id'))->first();

            $page->title = Input::get('title');
            $page->slug = Str::slug(Input::get('title'));
            $page->description = Input::get('description');
            $page->show_in_menu = Input::has('show_in_menu') ? 1 : 0;
            $page->show_in_sidebar = Input::has('show_in_sidebar') ? 1 : 0;
            $page->show_in_footer = Input::has('show_in_footer') ? 1 : 0;
            $page->seo_keywords = Input::get('seo_keywords', Input::get('name'));
            $page->seo_description = Input::get('seo_description', Input::get('name'));
            $page->status = Input::get('status');
            $page->author_id = Input::get('author');
            $page->save();

            Session::flash('success_msg', trans('messages.page_updated_success'));
            return redirect()->to('/admin/pages/all');

        } else {
            Session::flash('error_msg', trans('messages.page_not_found'));
            return redirect()->to('/admin/pages/all');
        }

    }

    public function all()
    {

        $pages = Pages::all();

        return view('admin.pages.all', ['pages' => $pages]);
    }

    public function delete($id)
    {
        if(!Utils::hasWriteAccess()){
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!is_null($id) && sizeof(Pages::where('id', $id)->get()) > 0) {

            Pages::where('id', $id)->delete();

            Session::flash('success_msg', trans('messages.page_deleted_success'));
            return redirect()->to('/admin/pages/all');

        } else {
            Session::flash('error_msg', trans('messages.page_not_found'));
            return redirect()->to('/admin/pages/all');
        }
    }

}
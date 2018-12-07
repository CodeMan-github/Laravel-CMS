<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use App\Posts;
use App\Sources;
use App\SubCategories;
use Illuminate\Support\Str;
use Input;
use Session;

class CategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('has_permission:categories.add', ['only' => ['create', 'store']]);
        $this->middleware('has_permission:categories.edit', ['only' => ['edit', 'update']]);
        $this->middleware('has_permission:categories.view', ['only' => ['all']]);
        $this->middleware('has_permission:categories.delete', ['only' => ['delete']]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store()
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!Input::has('title')) {
            Session::flash('error_msg', trans('messages.category_title_required'));
            return redirect()->back()->withInput(Input::all());
        }

        $category = new Categories();
        $category->title = Input::get('title');
        $category->slug = Str::slug(Input::get('title'));
        $category->scroll_type = Input::get('scroll_type', Categories::SCROLL_TYPE_PAGINATION);
        $category->show_in_menu = Input::has('show_in_menu') ? 1 : 0;
        $category->show_in_sidebar = Input::has('show_in_sidebar') ? 1 : 0;
        $category->show_in_footer = Input::has('show_in_footer') ? 1 : 0;
        $category->seo_keywords = Input::get('seo_keywords', Input::get('title'));
        $category->seo_description = Input::get('seo_description', Input::get('title'));
        $category->show_as_mega_menu = Input::has('show_as_mega_menu') ? 1 : 0;
        $category->show_on_home = Input::has('show_on_home') ? 1 : 0;
        $category->save();

        Session::flash('success_msg', trans('messages.category_created_success'));
        return redirect()->to('/admin/categories/all');

    }

    public function edit($id)
    {

        if (!is_null($id) && sizeof(Categories::where('id', $id)->get()) > 0) {

            $category = Categories::where('id', $id)->first();
            return view('admin.categories.edit', ['category' => $category]);

        } else {
            Session::flash('error_msg', trans('messages.category_created_success'));
            return redirect()->to('/admin/categories/all');
        }

    }

    public function update()
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (Input::has('id') && sizeof(Categories::where('id', Input::get('id'))->get()) > 0) {

            if (sizeof(Categories::where('title', Input::get('title'))->where('id', '!=', Input::get('id'))->get()) > 0) {
                Session::flash('error_msg', trans('messages.category_title_exists'));
                return redirect()->back()->withInput(Input::all());
            }

            $category = Categories::where('id', Input::get('id'))->first();

            $category->title = Input::get('title');
            $category->slug = Str::slug(Input::get('title'));
            $category->scroll_type = Input::get('scroll_type', Categories::SCROLL_TYPE_PAGINATION);
            $category->show_in_menu = Input::has('show_in_menu') ? 1 : 0;
            $category->show_in_sidebar = Input::has('show_in_sidebar') ? 1 : 0;
            $category->show_in_footer = Input::has('show_in_footer') ? 1 : 0;
            $category->seo_keywords = Input::get('seo_keywords', Input::get('title'));
            $category->seo_description = Input::get('seo_description', Input::get('title'));
            $category->show_as_mega_menu = Input::has('show_as_mega_menu') ? 1 : 0;
            $category->show_on_home = Input::has('show_on_home') ? 1 : 0;
            $category->save();

            Session::flash('success_msg', trans('messages.category_update_success'));
            return redirect()->to('/admin/categories/all');

        } else {
            Session::flash('error_msg', trans('messages.category_not_found'));
            return redirect()->to('/admin/categories/all');
        }

    }

    public function all()
    {

        $categories = Categories::all();

        return view('admin.categories.all', ['categories' => $categories]);
    }

    public function delete($id)
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!is_null($id) && sizeof(Categories::where('id', $id)->get()) > 0) {

            Categories::where('id', $id)->delete();

            $sub_lists = SubCategories::where('parent_id', $id)->lists('id');

            if (sizeof($sub_lists) > 0) {
                Sources::whereIn('category_id', $sub_lists)->delete();
                Posts::whereIn('category_id', $sub_lists)->delete();
                SubCategories::where('parent_id', $id)->delete();
            }

            Session::flash('success_msg', trans('messages.category_deleted_success'));
            return redirect()->to('/admin/categories/all');

        } else {
            Session::flash('error_msg', trans('messages.category_not_found'));
            return redirect()->to('/admin/categories/all');
        }
    }

}
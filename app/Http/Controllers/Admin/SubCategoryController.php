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

class SubCategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('has_permission:sub_categories.add', ['only' => ['create', 'store']]);
        $this->middleware('has_permission:sub_categories.edit', ['only' => ['edit', 'update']]);
        $this->middleware('has_permission:sub_categories.view', ['only' => ['all']]);
        $this->middleware('has_permission:sub_categories.delete', ['only' => ['delete']]);
    }

    public function create()
    {

        $parent_categories = Categories::all();

        return view('admin.sub_categories.create', ['parent_categories' => $parent_categories]);
    }

    public function store()
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!Input::has('title')) {
            Session::flash('error_msg', trans('messages.sub_category_title_required'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!Input::has('parent_category')) {
            Session::flash('error_msg', trans('messages.category_is_required'));
            return redirect()->back()->withInput(Input::all());
        }


        $category = new SubCategories();
        $category->priority = Input::get('priority', 1);
        $category->parent_id = Input::get('parent_category');
        $category->title = Input::get('title');
        $category->slug = Str::slug(Input::get('title'));
        $category->scroll_type = Input::get('scroll_type', SubCategories::SCROLL_TYPE_PAGINATION);
        $category->show_in_menu = Input::has('show_in_menu') ? 1 : 0;
        $category->show_in_sidebar = Input::has('show_in_sidebar') ? 1 : 0;
        $category->show_in_footer = Input::has('show_in_footer') ? 1 : 0;
        $category->seo_keywords = Input::get('seo_keywords', Input::get('title'));
        $category->seo_description = Input::get('seo_description', Input::get('title'));
        $category->save();

        Session::flash('success_msg', trans('messages.sub_category_created_success'));
        return redirect()->to('/admin/sub_categories/all');

    }

    public function edit($id)
    {

        if (!is_null($id) && sizeof(SubCategories::where('id', $id)->get()) > 0) {

            $parent_categories = Categories::all();
            $category = SubCategories::where('id', $id)->first();
            return view('admin.sub_categories.edit', ['category' => $category, 'parent_categories' => $parent_categories]);

        } else {
            Session::flash('error_msg', trans('messages.sub_category_not_found'));
            return redirect()->to('/admin/sub_categories/all');
        }

    }

    public function update()
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (Input::has('id') && sizeof(SubCategories::where('id', Input::get('id'))->get()) > 0) {

            if (sizeof(SubCategories::where('title', Input::get('title'))->where('id', '!=', Input::get('id'))->get()) > 0) {
                Session::flash('error_msg', trans('messages.sub_category_title_already_exists'));
                return redirect()->back()->withInput(Input::all());
            }

            $category = SubCategories::where('id', Input::get('id'))->first();

            $category->title = Input::get('title');
            $category->priority = Input::get('priority', 1);
            $category->parent_id = Input::get('parent_category');
            $category->slug = Str::slug(Input::get('title'));
            $category->scroll_type = Input::get('scroll_type', SubCategories::SCROLL_TYPE_PAGINATION);
            $category->show_in_menu = Input::has('show_in_menu') ? 1 : 0;
            $category->show_in_sidebar = Input::has('show_in_sidebar') ? 1 : 0;
            $category->show_in_footer = Input::has('show_in_footer') ? 1 : 0;
            $category->seo_keywords = Input::get('seo_keywords', Input::get('title'));
            $category->seo_description = Input::get('seo_description', Input::get('title'));
            $category->save();

            Session::flash('success_msg', trans('messages.sub_category_updated_success'));
            return redirect()->to('/admin/sub_categories/all');

        } else {
            Session::flash('error_msg', trans('messages.sub_category_not_found'));
            return redirect()->to('/admin/sub_categories/all');
        }

    }

    public function all()
    {

        $categories = SubCategories::all();

        foreach ($categories as $category) {
            $category->no_sources = Sources::where('category_id', $category->id)->count();
            $category->no_posts = Posts::where('category_id', $category->id)->count();
            $category->parent_category = Categories::where('id', $category->parent_id)->first();
        }

        return view('admin.sub_categories.all', ['categories' => $categories]);
    }

    public function delete($id)
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!is_null($id) && sizeof(SubCategories::where('id', $id)->get()) > 0) {

            SubCategories::where('id', $id)->delete();

            Sources::where('category_id', $id)->delete();
            Posts::where('category_id', $id)->delete();

            Session::flash('success_msg', trans('messages.sub_category_deleted_success'));
            return redirect()->to('/admin/sub_categories/all');

        } else {
            Session::flash('error_msg', trans('messages.sub_category_not_found'));
            return redirect()->to('/admin/sub_categories/all');
        }
    }

}
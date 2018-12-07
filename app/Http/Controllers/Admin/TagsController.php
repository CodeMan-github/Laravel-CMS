<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use App\PostTags;
use App\Tags;
use Input;
use Session;

class TagsController extends Controller
{
    function __construct()
    {
        $this->middleware('has_permission:tags.view', ['only' => ['all']]);
        $this->middleware('has_permission:tags.delete', ['only' => ['delete']]);
    }

    public function all()
    {

        $tags = \DB::table('tags')->orderBy('id', 'asc')->paginate(10);

        foreach ($tags as $t) {
            $t->post_count = PostTags::where('tag_id', $t->id)->count();
        }

        return view('admin.tags.all', ['tags' => $tags]);
    }

    public function delete($id)
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!is_null($id) && sizeof(Tags::where('id', $id)->get()) > 0) {

            PostTags::where('tag_id', $id)->delete();
            Tags::where('id', $id)->delete();

            Session::flash('success_msg', trans('messages.tag_deleted_success'));
            return redirect()->to('/admin/tags/all');

        } else {
            Session::flash('error_msg', trans('messages.tag_not_found'));
            return redirect()->to('/admin/tags/all');
        }
    }

}
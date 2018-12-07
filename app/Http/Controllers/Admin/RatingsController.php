<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use App\PostRatings;
use App\Posts;
use Input;
use Session;

class RatingsController extends Controller
{

    function __construct()
    {
        $this->middleware('has_permission:ratings.view', ['only' => ['all']]);
        $this->middleware('has_permission:ratings.delete', ['only' => ['delete']]);
    }

    public function all()
    {

        $ratings = PostRatings::all();

        foreach ($ratings as $r) {
            $r->post = Posts::where('id', $r->post_id)->first();
        }

        return view('admin.ratings.all', ['ratings' => $ratings]);
    }

    public function delete($id)
    {
        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!is_null($id) && sizeof(PostRatings::where('id', $id)->get()) > 0) {

            PostRatings::where('id', $id)->delete();

            Session::flash('success_msg', trans('messages.rating_delete_success'));
            return redirect()->to('/admin/ratings/all');

        } else {
            Session::flash('error_msg', trans('messages.rating_not_found'));
            return redirect()->to('/admin/ratings/all');
        }
    }

}
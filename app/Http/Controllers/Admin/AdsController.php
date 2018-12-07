<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use Input;
use Session;

class AdsController extends Controller
{

    function __construct()
    {
        $this->middleware('has_permission:ad_sections.add', ['only' => ['create', 'store']]);
        $this->middleware('has_permission:ad_sections.edit', ['only' => ['edit', 'update']]);
        $this->middleware('has_permission:ad_sections.view', ['only' => ['all']]);
        $this->middleware('has_permission:ad_sections.delete', ['only' => ['delete']]);
    }

    public function create()
    {

        return view('admin.ads.create');
    }

    public function store()
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (!Input::has('code') | !Input::has('position')) {
            Session::flash('error_msg', trans('messages.code_position_required'));
            return redirect()->back()->withInput(Input::all());
        }

        $ads = new Ads();
        $ads->code = Input::get('code');
        $ads->position = Input::get('position');
        $ads->save();

        Session::flash('success_msg', trans('messages.ads_created_success'));
        return redirect()->to('/admin/ads/all');

    }

    public function edit($id = 0)
    {

        $ad = Ads::where('id', $id)->first();

        if (!empty($ad)) {

            return view('admin.ads.edit', ['ad' => $ad]);

        } else {

            Session::flash('error_msg', trans('messages.ad_not_found'));
            return redirect()->to('/admin/ads/all');

        }

    }

    public function update()
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        if (Input::has('id') && sizeof(Ads::where('id', Input::get('id'))->get()) > 0) {


            $ad = Ads::where('id', Input::get('id'))->first();

            $ad->code = Input::get('code');
            $ad->position = Input::get('position');
            $ad->save();

            Session::flash('success_msg', trans('messages.ad_updated_success'));
            return redirect()->to('/admin/ads/all');

        } else {
            Session::flash('error_msg', trans('messages.ad_not_found'));
            return redirect()->to('/admin/ads/all');
        }

    }

    public function all()
    {

        $ads = Ads::all();

        return view('admin.ads.all', ['ads' => $ads]);
    }

    public function delete($id = 0)
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        $ad = Ads::where('id', $id)->first();

        if (!empty($ad)) {

            Ads::where('id', $id)->delete();

            Session::flash('success_msg', trans('messages.ad_deleted_success'));
            return redirect()->to('/admin/ads/all');

        } else {
            Session::flash('error_msg', trans('messages.ad_not_found'));
            return redirect()->to('/admin/ads/all');
        }
    }

}
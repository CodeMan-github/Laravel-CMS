<?php

namespace App\Http\Controllers\Admin;

use App\Ads;
use App\CronJobs;
use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use Illuminate\Support\Facades\Hash;
use Input;
use Session;

class CronController extends Controller
{

    function __construct()
    {
        $this->middleware('has_permission:crons.run', ['only' => ['run']]);
        $this->middleware('has_permission:crons.view', ['only' => ['view']]);
        $this->middleware('has_permission:crons.all', ['only' => ['all']]);
        $this->middleware('has_permission:crons.delete', ['only' => ['delete']]);
    }

    public function run(){

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        \Artisan::call('update-sources');

        Session::flash('success_msg',trans('messages.cron_run_success'));
        return redirect()->back();
    }

    public function view($id = 0)
    {
        $cron = CronJobs::where('id', $id)->first();

        if (!empty($cron)) {

            return view('admin.crons.view', ['cron' => $cron]);

        } else {

            Session::flash('error_msg', trans('messages.cron_not_found'));
            return redirect()->to('/admin/crons/all');

        }

    }

    public function all()
    {

        $crons = CronJobs::orderby('created_at','desc')->get();

        return view('admin.crons.all', ['crons' => $crons]);
    }

    public function delete($id = 0)
    {

        if (!Utils::hasWriteAccess()) {
            Session::flash('error_msg', trans('messages.preview_mode_error'));
            return redirect()->back()->withInput(Input::all());
        }

        $cron = CronJobs::where('id', $id)->first();

        if (!empty($cron)) {

            CronJobs::where('id', $id)->delete();

            Session::flash('success_msg', trans('messages.cron_deleted_success'));
            return redirect()->to('/admin/crons/all');

        } else {
            Session::flash('error_msg', trans('messages.cron_not_found'));
            return redirect()->to('/admin/crons/all');
        }
    }

}
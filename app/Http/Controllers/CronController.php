<?php

namespace App\Http\Controllers;

use App\Ads;
use App\CronJobs;
use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use Illuminate\Support\Facades\Hash;
use Input;
use Session;

class CronController extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function run(){        
		
        \Artisan::call('update-sources');
        die(trans('messages.cron_run_success'));
        //return redirect()->back();
    }
}
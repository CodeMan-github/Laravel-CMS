<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Input;
use Session;
use App\Ads;

class StatisticsController extends Controller
{

    function __construct()
    {
        $this->middleware('has_permission:statistics.view', ['only' => ['all']]);
    }

    public function all()
    {
        return view('admin.statistics.all');
    }

}
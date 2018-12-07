<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Utils;
use App\Posts;
use App\Sources;
use App\Users;
use File;
use Input;
use Session;
use SplFileInfo;
use URL;

class DashboardController extends Controller
{

    public function updateApplication()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('migrate',['--force'=>'yes']);

        Session::flash('success_msg', 'Application successfully updated');

        return redirect()->back();
    }

    public function giveMeWriteAccess()
    {
        Session::put('GIVE-ME-WRITE-ACCESS', true);
        return 'Done dana done now u have write access';
    }

    public function removeWriteAccess()
    {
        Session::forget('GIVE-ME-WRITE-ACCESS');
        return 'Nice to meet you , see you later ba bye';
    }

    public function index()
    {
        $posts_count = Posts::count();
        $sources_count = Sources::count();
        $users_count = Users::count();

        return view('admin.index', ['posts_count' => $posts_count, 'sources_count' => $sources_count, 'users_count' => $users_count]);
    }

    public function handleRedactorUploads()
    {
        $filename = Utils::imageUpload(Input::file('file'), 'images');
        return response()->json($data = array(
            'filelink' => $filename
        ), 200);
    }

    public function redactorImages()
    {

        $arr = [];
        $allFiles = File::allFiles(public_path() . '/uploads/images/');

        foreach ($allFiles as $file) {
            $file = new SplFileInfo($file);
            $arr[] = ["thumb" => URL::to('/') . '/uploads/images/' . $file->getFilename(), "image" => URL::to('/') . '/uploads/images/' . $file->getFilename(), "title" => $file->getFilename()];
        }

        return $arr;
    }

}
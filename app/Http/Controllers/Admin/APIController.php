<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SubCategories;
use App\Tags;

class APIController extends Controller
{

    public function getSubCategories($category_id = 0)
    {

        if ($category_id == null || $category_id == 0) {
            return SubCategories::all();
        }

        return SubCategories::where('parent_id', $category_id)->get();
    }

    public function getTags(){
        return Tags::lists('title');
    }

}
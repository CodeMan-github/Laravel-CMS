<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{

    const SCROLL_TYPE_PAGINATION = "pagination";
    const SCROLL_TYPE_SCROLL = "infinite_scroll";

    protected $table = 'sub_categories';

}

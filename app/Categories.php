<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    const SCROLL_TYPE_PAGINATION = "pagination";
    const SCROLL_TYPE_SCROLL = "infinite_scroll";

    protected $table = 'categories';

}

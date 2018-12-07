<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{

    const TYPE_INDEX_HEADER = "index_header";
    const TYPE_INDEX_FOOTER = "index_footer";
    const TYPE_SIDEBAR = "sidebar";
    const TYPE_ABOVE_POST = "above_post";
    const TYPE_BELOW_POST = "below_post";
    const TYPE_BETWEEN_CATEGORY_INDEX = "between_category_index";
    const TYPE_BETWEEN_SUBCATEGORY_INDEX = "between_sub_category_index";
    const TYPE_BETWEEN_AUTHOR_INDEX = "between_author_index";
    const TYPE_BETWEEN_TAG_INDEX = "between_tag_index";
    const TYPE_BETWEEN_SEARCH_INDEX = "between_search_index";
    const TYPE_ABOVE_PAGE = "above_page";
    const TYPE_BELOW_PAGE = "below_page";

    protected $table = 'ads';

}

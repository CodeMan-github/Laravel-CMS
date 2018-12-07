<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    const CATEGORY_CUSTOM_CSS = "custom_css";
    const CATEGORY_CUSTOM_JS = "custom_js";
    const CATEGORY_SOCIAL = "social";
    const CATEGORY_COMMENTS = "comments";
    const CATEGORY_SEO = "seo";
    const CATEGORY_GENERAL = "general";
    const CATEGORY_OLD_NEWS = "old_news";

    const TYPE_STRING = 'string';
    const TYPE_TEXT = 'text';
    const TYPE_CHECK = 'check';

    protected $table = 'settings';

}

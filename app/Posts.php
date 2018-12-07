<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    const TYPE_SOURCE = "source";
    const TYPE_MANUAL = "manual";

    const RENDER_TYPE_TEXT = "text";
    const RENDER_TYPE_IMAGE = "image";
    const RENDER_TYPE_GALLERY = "gallery";
    const RENDER_TYPE_VIDEO = "video";

    const COMMENT_FACEBOOK = "facebook";
    const COMMENT_DISQUS = "disqus";

    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;

    protected $table = 'posts';

}

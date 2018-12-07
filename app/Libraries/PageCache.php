<?php namespace App\Libraries;

use URL;
use Cache;
use Closure;

class SMDLCache
{
    public static function cache($key, $expires = 1, Closure $closure)
    {
        $key = $key . URL::full();

        if ( Cache::has( $key ) )
        {
            $content = Cache::get( $key );
        }
        else
        {
            ob_start();
            $closure();
            $content = ob_get_contents();
            ob_end_clean();
            Cache::put( $key, $content, $expires );
        }

        echo $content;
    }
}
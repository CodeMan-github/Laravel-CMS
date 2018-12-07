<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use \App;
use \Config;

class BeforeRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $general = \App\Libraries\Utils::getSettings(\App\Settings::CATEGORY_GENERAL);

        App::setLocale($general->locale);

        try {
            setlocale(LC_TIME, $general->locale);
            Carbon::setLocale($general->locale);
        }catch(\Exception $e){
            dd($e);
        }

        Config::set('app.timezone', $general->timezone);
        Config::set('app.locale', $general->locale);

        date_default_timezone_set($general->timezone);

        return $next($request);
    }
}

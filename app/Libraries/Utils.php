<?php

namespace App\Libraries;

use App;
use App\Groups;
use App\Settings;
use App\Users;
use App\UsersGroups;
use Crypt;
use DB;
use Log;
use StdClass;
use URL;
use Session;

class Utils
{

    static function getSettingsValue($category, $key, $type)
    {
        $setting = Settings::where('category', $category)->where('column_key', $key)->first();

        if (!empty($setting)) {
            if ($type == Settings::TYPE_STRING) {
                return $setting->value_string;
            }

            if ($type == Settings::TYPE_TEXT) {
                return $setting->value_txt;
            }

            if ($type == Settings::TYPE_CHECK) {
                return $setting->value_check;
            }
        }

        return "http://localhost";
    }

    static function parsePermissions($permissions, $only_keys = false)
    {
        $actuals = [];
        $main_permissions = \Config::get('permissions');

        if (strlen($permissions) > 0) {

            $arr = explode(',', $permissions);

            foreach ($arr as $a) {

                foreach ($main_permissions as $m) {
                    foreach ($m['permissions'] as $permission) {
                        if ($permission['key'] == $a) {
                            if ($only_keys) {
                                $actuals[] = $permission['key'];
                            } else {
                                $actuals[] = $permission;
                            }
                        }
                    }
                }

            }

            return $actuals;

        } else {
            return [];
        }
    }

    static function hasWriteAccess()
    {
        return Session::has('GIVE-ME-WRITE-ACCESS') ? true : env('WRITE_ACCESS');
    }

    static function getUsersInGroup($group = Users::TYPE_AUTHOR)
    {

        if (is_integer($group)) {
            $user_ids = UsersGroups::where("group_id", $group)->lists('user_id');
        } else {
            $find_group = Groups::where("name", $group)->first();
            $user_ids = UsersGroups::where("group_id", $find_group->id)->lists('user_id');
        }

        return sizeof($user_ids) > 0 ? Users::whereIn('id', $user_ids)->get() : [];
    }

    static function isAdmin($user_id)
    {
        return self::inGroup(Users::TYPE_ADMIN, $user_id);
    }

    static function isCustomer($user_id)
    {
        return self::inGroup(Users::TYPE_CUSTOMER, $user_id);
    }

    static function isPublisher($user_id)
    {
        return self::inGroup(Users::TYPE_PUBLISHER, $user_id);
    }

    static function isAuthor($user_id)
    {
        return self::inGroup(Users::TYPE_AUTHOR, $user_id);
    }

    static function inGroup($group_name_or_id, $user_id)
    {
        if (is_integer($group_name_or_id)) {
            $groups = UsersGroups::where("user_id", $user_id)->where("group_id", $group_name_or_id)->get();
        } else {
            $group = Groups::where("name", $group_name_or_id)->first();
            $groups = UsersGroups::where("user_id", $user_id)->where("group_id", $group->id)->get();
        }

        if (sizeof($groups) > 0) {
            return true;
        }

        return false;
    }

    static function getImageWithSizeGreaterThan($html, $size = 200)
    {
        ini_set('allow_url_fopen', 1);
        $html_parser = new \Yangqi\Htmldom\Htmldom();
        $html_parser->str_get_html($html);

        $featured_img = "";

        $imgs = $html_parser->find('img');

        foreach ($imgs as $img) {

            try {
                list($width, $height) = getimagesize($img->src);

                if ($width >= $size) {
                    $featured_img = $img->src;
                    break;
                }
            } catch (\Exception $e) {
                continue;
            }

        }

        return $featured_img;
    }

    static function getImageFromString($html, $index = 0)
    {
        $html_parser = new \Yangqi\Htmldom\Htmldom();
        $html_parser->str_get_html($html);
        return isset($html_parser->find('img')[$index]) ? $html_parser->find('img')[$index]->src : '';
    }

    public static function doubleTruncate($val, $f = "0")
    {
        if (($p = strpos($val, '.')) !== false) {
            $val = floatval(substr($val, 0, $p + 1 + $f));
        }
        return $val;
    }

    public static function generateResetCode()
    {

        $code = Crypt::encrypt(str_random(12));

        if (DB::table('users')->where("reset_password_code", $code)->count() > 0) {
            self::generateResetCode();
        }

        return $code;
    }

    public static function imageUpload($file, $folder = null)
    {

        $timestamp = uniqid();
        $ext = $file->guessClientExtension();
        $name = $timestamp . "_file." . $ext;

        if (is_null($folder)) {

            // move uploaded file from temp to uploads directory
            if ($file->move(public_path() . '/uploads/', $name)) {
                return URL::to('/uploads/' . $name);
            }

        } else {


            if (!\File::exists(public_path() . '/uploads/' . $folder)) {
                \File::makeDirectory(public_path() . '/uploads/' . $folder);
            }

            // move uploaded file from temp to uploads directory
            if ($file->move(public_path() . '/uploads/' . $folder . '/', $name)) {
                return URL::to('/uploads/' . $folder . '/' . $name);
            }
        }

        return false;

    }

    static function findOrString($cat, $col_key)
    {
        return DB::table('settings')->where('category', $cat)->where('column_key', $col_key)->count() > 0 ? Settings::where('category', $cat)->where('column_key', $col_key)->first()->value_string : '';
    }

    static function findOrTxt($cat, $col_key)
    {
        return DB::table('settings')->where('category', $cat)->where('column_key', $col_key)->count() > 0 ? Settings::where('category', $cat)->where('column_key', $col_key)->first()->value_txt : '';
    }

    static function findOrCheck($cat, $col_key)
    {
        return DB::table('settings')->where('category', $cat)->where('column_key', $col_key)->count() > 0 ? Settings::where('category', $cat)->where('column_key', $col_key)->first()->value_check : 0;
    }

    static function setOrCreateSettings($category, $key, $value, $type)
    {
        if (sizeof(Settings::where('category', $category)->where('column_key', $key)->get()) > 0) {

            $setting = Settings::where('category', $category)->where('column_key', $key)->first();

            if ($type == Settings::TYPE_TEXT)
                $setting->value_txt = $value;

            if ($type == Settings::TYPE_STRING)
                $setting->value_string = $value;

            if ($type == Settings::TYPE_CHECK)
                $setting->value_check = $value;

            $setting->save();

        } else {

            $settings = new Settings();
            $settings->category = $category;
            $settings->column_key = $key;

            if ($type == Settings::TYPE_TEXT)
                $settings->value_txt = $value;

            if ($type == Settings::TYPE_STRING)
                $settings->value_string = $value;

            if ($type == Settings::TYPE_CHECK)
                $settings->value_check = $value;

            $settings->save();
        }
    }

    static function getSettings($key)
    {

        if ($key == Settings::CATEGORY_CUSTOM_CSS) {
            //Custom CSS Tab
            $settings_custom_css = new StdClass();
            $settings_custom_css->custom_css = self::findOrTxt(Settings::CATEGORY_CUSTOM_CSS, Settings::CATEGORY_CUSTOM_CSS);
            return $settings_custom_css;
        }

        if ($key == Settings::CATEGORY_CUSTOM_JS) {
            //Custom JS Tab
            $settings_custom_js = new StdClass();
            $settings_custom_js->custom_js = self::findOrTxt(Settings::CATEGORY_CUSTOM_JS, Settings::CATEGORY_CUSTOM_JS);
            return $settings_custom_js;
        }

        if ($key == Settings::CATEGORY_SOCIAL) {
            //Social Tab
            $settings_social = new StdClass();
            $settings_social->fb_page_url = self::findOrString(Settings::CATEGORY_SOCIAL, 'fb_page_url');
            $settings_social->twitter_handle = self::findOrString(Settings::CATEGORY_SOCIAL, 'twitter_handle');
            $settings_social->twitter_url = self::findOrString(Settings::CATEGORY_SOCIAL, 'twitter_url');
            $settings_social->google_plus_page_url = self::findOrString(Settings::CATEGORY_SOCIAL, 'google_plus_page_url');
            $settings_social->skype_username = self::findOrString(Settings::CATEGORY_SOCIAL, 'skype_username');
            $settings_social->youtube_channel_url = self::findOrString(Settings::CATEGORY_SOCIAL, 'youtube_channel_url');
            $settings_social->vimeo_channel_url = self::findOrString(Settings::CATEGORY_SOCIAL, 'vimeo_channel_url');
            $settings_social->addthis_js = self::findOrTxt(Settings::CATEGORY_SOCIAL, 'addthis_js');
            $settings_social->sharethis_js = self::findOrTxt(Settings::CATEGORY_SOCIAL, 'sharethis_js');
            $settings_social->sharethis_span_tags = self::findOrTxt(Settings::CATEGORY_SOCIAL, 'sharethis_span_tags');
            $settings_social->facebook_box_js = self::findOrTxt(Settings::CATEGORY_SOCIAL, 'facebook_box_js');
            $settings_social->twitter_box_js = self::findOrTxt(Settings::CATEGORY_SOCIAL, 'twitter_box_js');
            $settings_social->show_sharing = self::findOrCheck(Settings::CATEGORY_SOCIAL, 'show_sharing');
            $settings_social->show_big_sharing = self::findOrCheck(Settings::CATEGORY_SOCIAL, 'show_big_sharing');
            return $settings_social;
        }

        if ($key == Settings::CATEGORY_COMMENTS) {
            //Comments Tab
            $settings_comments = new StdClass();
            $settings_comments->comment_system = self::findOrString(Settings::CATEGORY_COMMENTS, 'comment_system');
            $settings_comments->fb_js = self::findOrTxt(Settings::CATEGORY_COMMENTS, 'fb_js');
            $settings_comments->fb_num_posts = self::findOrString(Settings::CATEGORY_COMMENTS, 'fb_num_posts');
            $settings_comments->fb_comment_count = self::findOrCheck(Settings::CATEGORY_COMMENTS, 'fb_comment_count');
            $settings_comments->disqus_js = self::findOrTxt(Settings::CATEGORY_COMMENTS, 'disqus_js');
            $settings_comments->disqus_comment_count = self::findOrCheck(Settings::CATEGORY_COMMENTS, 'disqus_comment_count');
            $settings_comments->show_comment_box = self::findOrCheck(Settings::CATEGORY_COMMENTS, 'show_comment_box');

            return $settings_comments;
        }

        if ($key == Settings::CATEGORY_SEO) {
            //SEO Tab
            $settings_seo = new StdClass();
            $settings_seo->seo_keywords = self::findOrTxt(Settings::CATEGORY_SEO, 'seo_keywords');
            $settings_seo->seo_description = self::findOrTxt(Settings::CATEGORY_SEO, 'seo_description');
            $settings_seo->google_verify = self::findOrString(Settings::CATEGORY_SEO, 'google_verify');
            $settings_seo->bing_verify = self::findOrString(Settings::CATEGORY_SEO, 'bing_verify');

            return $settings_seo;
        }

        if ($key == Settings::CATEGORY_OLD_NEWS) {
            //Old News Tab
            $settings_old_news = new StdClass();
            $settings_old_news->days = self::findOrString(Settings::CATEGORY_OLD_NEWS, 'days');
            $settings_old_news->auto_update = self::findOrCheck(Settings::CATEGORY_OLD_NEWS, 'auto_delete_old_news');

            return $settings_old_news;
        }

        if ($key == Settings::CATEGORY_GENERAL) {
            //General Tab
            $settings_general = new StdClass();
            $settings_general->site_url = self::findOrString(Settings::CATEGORY_GENERAL, 'site_url');
            $settings_general->site_title = self::findOrString(Settings::CATEGORY_GENERAL, 'site_title');
            $settings_general->analytics_code = self::findOrTxt(Settings::CATEGORY_GENERAL, 'analytics_code');
            $settings_general->mailchimp_form = self::findOrTxt(Settings::CATEGORY_GENERAL, 'mailchimp_form');
            $settings_general->logo_76 = self::findOrString(Settings::CATEGORY_GENERAL, 'logo_76');
            $settings_general->logo_120 = self::findOrString(Settings::CATEGORY_GENERAL, 'logo_120');
            $settings_general->logo_152 = self::findOrString(Settings::CATEGORY_GENERAL, 'logo_152');
            $settings_general->favicon = self::findOrString(Settings::CATEGORY_GENERAL, 'favicon');
            $settings_general->site_post_as_titles = self::findOrCheck(Settings::CATEGORY_GENERAL, 'site_post_as_titles');
            $settings_general->generate_sitemap = self::findOrCheck(Settings::CATEGORY_GENERAL, 'generate_sitemap');
            $settings_general->generate_rss_feeds = self::findOrCheck(Settings::CATEGORY_GENERAL, 'generate_rss_feeds');
            $settings_general->include_sources = self::findOrCheck(Settings::CATEGORY_GENERAL, 'include_sources');

            $locale = self::findOrString(Settings::CATEGORY_GENERAL, 'locale');
            $timezone = self::findOrString(Settings::CATEGORY_GENERAL, 'timezone');

            $settings_general->locale = strlen($locale) <= 0 ? 'en' : $locale;
            $settings_general->timezone = strlen($timezone) <= 0 ? 'America/New_York' : $timezone;

            return $settings_general;
        }

        return [];
    }

    static function logs($str, $arg, $lvl = 'info')
    {
        Log::$lvl($str . ' :: ' . print_r($arg, true));
    }

    static function log($arg, $lvl = 'info')
    {
        Log::$lvl(print_r($arg, true));
    }


    static function prettyDate($date, $time = true)
    {
        $format = $time ? "F jS, Y" : "F jS, Y";
        return date($format, strtotime($date));
    }

    static function generateRandom($length = 9, $strength = 4)
    {

        $vowels = 'aeiouy';
        $consonants = 'bcdfghjklmnpqrstvwxz';
        if ($strength & 1) {
            $consonants .= 'BCDFGHJKLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEIOUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

    static function messages($v)
    {
        return implode('', $v->messages()->all('<li style="margin-left:10px;">:message</li>'));
    }


}
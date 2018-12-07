<?php

namespace App\Libraries;

use App;
use Carbon\Carbon;
use App\Posts;

class Parser
{

    public $reader;
    public $optimized_feeds;

    public static function xml($url)
    {
        $reader = new \Sabre\Xml\Reader();


        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,$url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'RSS');
        $str = curl_exec($curl_handle);
        curl_close($curl_handle);

        $str = str_ireplace(array('ndash;', 'nbsp;'), array('-', ' '), $str);

        $str = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $str);

        $reader->xml($str);

        $feeds = $reader->parse();

        $optimized_feeds = [];

        if ($feeds['name'] == "{}rss") {

            $loopers = $feeds['value'];

            foreach ($loopers as $l) {

                if ($l['name'] == "{}channel") {

                    foreach ($l['value'] as $loop) {

                        if ($loop['name'] == "{}title") {
                            $optimized_feeds['channel']['title'] = $loop['value'];
                        }

                        if ($loop['name'] == "{}link") {
                            $optimized_feeds['channel']['link'] = $loop['value'];
                        }

                        if ($loop['name'] == "{}description") {
                            $optimized_feeds['channel']['description'] = $loop['value'];
                        }

                        if ($loop['name'] == "{http://purl.org/rss/1.0/modules/syndication/}updatePeriod") {
                            $optimized_feeds['channel']['updatePeriod'] = $loop['value'];
                        }

                        if ($loop['name'] == "{http://purl.org/rss/1.0/modules/syndication/}updateFrequency") {
                            $optimized_feeds['channel']['updateFrequency'] = $loop['value'];
                        }

                        if ($loop['name'] == "{}language") {
                            $optimized_feeds['channel']['language'] = $loop['value'];
                        }

                        if ($loop['name'] == "{}pubDate") {
                            $optimized_feeds['channel']['pubDate'] = $loop['value'];
                        }

                        if ($loop['name'] == "{}lastBuildDate") {
                            $optimized_feeds['channel']['lastBuildDate'] = $loop['value'];
                        }

                        if ($loop['name'] == "{}generator") {
                            $optimized_feeds['channel']['generator'] = $loop['value'];
                        }

                        if ($loop['name'] == "{}item") {

                            $values = $loop['value'];

                            $renderType = App\Posts::RENDER_TYPE_IMAGE;

                            $categories = [];
                            $title = "";
                            $link = "";
                            $description = "";
                            $pubDate = "";
                            $featuredImage = "";
                            $featuredImageL = "";
                            $videoEmbedCode = "";



                            foreach ($values as $value) {



                                if ($value['name'] == '{}title') {
                                    $title = $value['value'];
                                }

                                if ($value['name'] == "{}category") {
                                    $categories[] = $value['value'];
                                }



                                if ($value['name'] == '{}enclosure') {


                                    if (!empty($value['attributes']['url']) && !empty($value['attributes']['type']) && in_array($value['attributes']['type'], array('image/jpeg', "image/png", "image"))) {
                                        $featuredImage = $value['attributes']['url'];

                                        if (!empty($value['attributes']['size']) && $value['attributes']['size'] == 'l' && !in_array('forum', $value['attributes'])) {
                                            $featuredImageL = $value['attributes']['url'];

                                        }

                                        $renderType = App\Posts::RENDER_TYPE_IMAGE;
                                    }

                                    if (!empty($featuredImageL)) $featuredImage = $featuredImageL;

                                }

                                if ($value['name'] == '{http://search.yahoo.com/mrss/}content') {

                                    if (!empty($value['attributes']['url']) && !empty($value['attributes']['type']) && in_array($value['attributes']['type'], array('image/jpeg', "image/png", "image"))) {
                                        $featuredImage = $value['attributes']['url'];
                                        $renderType = App\Posts::RENDER_TYPE_IMAGE;
                                    }

                                    if (!empty($featuredImageL)) $featuredImage = $featuredImageL;

                                }

                                if ($value['name'] == '{}link') {

                                    if (isset($value['value']) && strlen($value['value']) > 0) {

                                        $url = $value['value'];

                                        //Load any url:
                                        $info = \Embed::make($url)->parseUrl();

                                        if ($info) {

                                            $link = $url;
                                            $renderType = App\Posts::RENDER_TYPE_VIDEO;
                                            $videoEmbedCode = $info->getHtml();

                                        } else {
                                            $renderType = App\Posts::RENDER_TYPE_TEXT;
                                            $link = $url;
                                        }

                                    }
                                }

                                if ($value['name'] == '{}pubDate') {
                                    try {
                                        $pubDate = Carbon::parse($value['value']);
                                    } catch (\Exception $e) {
                                        $pubDate = Carbon::now();
                                    }
                                }

                                if ($value['name'] == '{}description') {
                                    $description = $value['value'];
                                }

                                if ($value['name'] == '{http://purl.org/rss/1.0/modules/content/}encoded') {
                                    $description = $value['value'];
                                }

                                if ($value['name'] == '{http://search.yahoo.com/mrss/}thumbnail') {
                                    if (!empty($value['attributes']['url']) && strlen($value['attributes']['url']) > 0) {
                                        $featuredImage = $value['attributes']['url'];
                                        $renderType = App\Posts::RENDER_TYPE_IMAGE;
                                    }
                                }



                            }

                            $optimized_feeds['channel']['item'][] = ['categories' => $categories, 'render_type' => $renderType, 'featured_image' => $featuredImage, 'video_embed_code' => $videoEmbedCode, 'title' => $title, 'link' => $link, 'description' => $description, 'pubDate' => $pubDate];
                        }
                    }
                }
            }
        }

        if ($feeds['name'] == "{http://www.w3.org/2005/Atom}feed") {
            $loopers = $feeds['value'];

            foreach ($loopers as $loop) {

                if ($loop['name'] == "{http://www.w3.org/2005/Atom}title") {
                    $optimized_feeds['channel']['title'] = $loop['value'];
                }

                if ($loop['name'] == "{http://www.w3.org/2005/Atom}link") {
                    $optimized_feeds['channel']['link'] = isset($loop['attributes']) ? $loop['attributes']['href'] : '';
                }

                if ($loop['name'] == "{http://www.w3.org/2005/Atom}description") {
                    $optimized_feeds['channel']['description'] = $loop['value'];
                }

                if ($loop['name'] == "{http://purl.org/rss/1.0/modules/syndication/}updatePeriod") {
                    $optimized_feeds['channel']['updatePeriod'] = '';
                }

                if ($loop['name'] == "{http://purl.org/rss/1.0/modules/syndication/}updateFrequency") {
                    $optimized_feeds['channel']['updateFrequency'] = '';
                }

                if ($loop['name'] == "{}language") {
                    $optimized_feeds['channel']['language'] = '';
                }

                if ($loop['name'] == "{http://www.w3.org/2005/Atom}published") {
                    $optimized_feeds['channel']['pubDate'] = $loop['value'];
                }

                if ($loop['name'] == "{}lastBuildDate") {
                    $optimized_feeds['channel']['lastBuildDate'] = '';
                }

                if ($loop['name'] == "{}generator") {
                    $optimized_feeds['channel']['generator'] = '';
                }

                if ($loop['name'] == "{http://www.w3.org/2005/Atom}entry") {

                    $values = $loop['value'];

                    $categories = [];
                    $title = "";
                    $link = "";
                    $description = "";
                    $pubDate = "";
                    $featuredImage = "";
                    $videoEmbedCode = "";
                    $renderType = App\Posts::RENDER_TYPE_IMAGE;

                    foreach ($values as $value) {

                        if ($value['name'] == '{http://www.w3.org/2005/Atom}title') {
                            $title = $value['value'];
                        }

                        if ($value['name'] == "{http://www.w3.org/2005/Atom}category") {
                            if (isset($value['attributes']['term']) && strlen($value['attributes']['term']) > 0) {
                                $categories[] = $value['attributes']['term'];
                            }
                        }

                        if ($value['name'] == '{http://www.w3.org/2005/Atom}link') {

                            if (isset($value['attributes']['href']) && strlen($value['attributes']['href']) > 0) {

                                $url = $value['attributes']['href'];

                                $info = \Embed::make($url)->parseUrl();

                                if ($info) {
                                    $link = $url;
                                    $renderType = App\Posts::RENDER_TYPE_VIDEO;
                                    $videoEmbedCode = $info->getHtml();
                                } else {
                                    $renderType = App\Posts::RENDER_TYPE_TEXT;
                                    $link = $url;
                                }

                            }

                        }

                        if ($value['name'] == '{http://www.w3.org/2005/Atom}published') {
                            try {
                                $pubDate = Carbon::parse($value['value']);
                            } catch (\Exception $e) {
                                $pubDate = Carbon::now();
                            }
                        }

                        if ($value['name'] == '{http://www.w3.org/2005/Atom}content') {

                            if (strlen($description) <= 0) {
                                $description = $value['value'];
                            }

                        }

                        if ($value['name'] == '{http://search.yahoo.com/mrss/}group') {

                            $more_values = $value['value'];

                            foreach ($more_values as $v) {

                                if ($v['name'] == '{http://search.yahoo.com/mrss/}title') {
                                    $title = $v['value'];
                                }

                                if ($v['name'] == '{http://search.yahoo.com/mrss/}thumbnail') {

                                    if (!empty($v['attributes']['url'])) {
                                        $featuredImage = $v['attributes']['url'];
                                    }

                                }

//                                if ($v['name'] == '{http://search.yahoo.com/mrss/}description') {
//                                    $description = $v['value'];
//                                }
                            }

                        }

                    }


                    $optimized_feeds['channel']['item'][] = ['categories' => $categories, 'render_type' => $renderType, 'featured_image' => $featuredImage, 'video_embed_code' => $videoEmbedCode, 'title' => $title, 'link' => $link, 'description' => $description, 'pubDate' => $pubDate];
                }
            }
        }

        return $optimized_feeds;
    }

    public static function fetchFull($url, $description)
    {

        if (is_null($url)) return $description;

        if (strlen($url) <= 0) return $description;

        $request = \URL::to('/') . '/fulltext/makefulltextfeed.php?format=json&url=' . $url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        if (!$result) return $description;

        $json = json_decode($result);

        if (!$json) return $description;

        $item = $json->rss->channel->item;

        return $item->description;
    }

    public static function setImgAndRenderType($description, $video_embed_code, $featured_image)
    {

        $render_type = Posts::RENDER_TYPE_VIDEO;

        //If no featured image but we have description then pull image from description
        if (strlen($featured_image) <= 0 && !is_null($description) && strlen($description) > 0)
            $find_img = Utils::getImageWithSizeGreaterThan($description);
        else
            $find_img = $featured_image;

        //No Video Embed set it to IMAGE POST
        if (strlen($video_embed_code) <= 0) {
            $render_type = Posts::RENDER_TYPE_IMAGE;
        }

        //No Image then set it to IMAGE POST
        if (strlen($find_img) <= 0 && strlen($video_embed_code) <= 0) {
            $render_type = Posts::RENDER_TYPE_TEXT;
        }

        return [$render_type, $find_img];
    }

    public static function url_get_contents($Url)
    {
        if (!function_exists('curl_init')) {
            die('CURL is not installed!');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $protocol = str_contains($Url, 'https') === true ? 'https://' : 'http://';

        if ($protocol == "https://") {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public static function spin($title, $description)
    {
        $spin_text = new SpinText();

        if (strlen($description) > 0)
            return $spin_text->do_spin($title, $description);
        else
            return ['title' => $title, 'description' => $description];
    }

}
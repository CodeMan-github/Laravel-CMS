<?php

namespace App\Libraries;


class SpinText
{

    function update_post($article)
    {

        $spinned = $article;

        //synonyms
        if (stristr($spinned, '911911')) {
            $spinned = str_replace('911911', '**9999**', $spinned);
        }


        $spinned_arr = explode('**9999**', $spinned);


        $spinned_ttl = $spinned_arr[0];
        $spinned_cnt = $spinned_arr[1];


        //spintaxed wrirretten instance
        //require_once('class.spintax.php');

        $spintax = new Spintax;
        $spintaxed = $spintax->spin($spinned);


        //$spintaxed2 = $spintax->editor_form;

        $spintaxed_arr = explode('**9999**', $spintaxed);

        $spintaxed_ttl = $spintaxed_arr[0];
        $spintaxed_cnt = $spintaxed_arr[1];

        return ['title' => $spintaxed_ttl, 'description' => $spintaxed_cnt];

    }

    public function do_spin($title, $post)
    {

        $opt = [];//get_option('wp_auto_spin',array());


        $article = stripslashes($title) . '**9999**' . stripslashes($post);

        //match links
        $htmlurls = array();

        if (!in_array('OPT_AUTO_SPIN_LINKS', $opt)) {
            preg_match_all("/<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*?)<\/a>/s", $article, $matches, PREG_PATTERN_ORDER);
            $htmlurls = $matches[0];
        }

        //execlude urls pasted OPT_AUTO_SPIN_URL_EX
        $urls_txt = array();
        if (in_array('OPT_AUTO_SPIN_URL_EX', $opt)) {
            //ececluding the capped words
            preg_match_all('/https?:\/\/[^<\s]+/', $article, $matches_urls_txt);
            $urls_txt = $matches_urls_txt[0];
        }


        //html tags
        preg_match_all("/<[^<>]+>/is", $article, $matches, PREG_PATTERN_ORDER);
        $htmlfounds = $matches[0];


        //no spin items
        preg_match_all('{\[nospin\].*?\[/nospin\]}s', $article, $matches_ns);
        $nospin = $matches_ns[0];


        //extract all fucken shortcodes
        $pattern = "\[.*?\]";
        preg_match_all("/" . $pattern . "/s", $article, $matches2, PREG_PATTERN_ORDER);
        $shortcodes = $matches2[0];

        //javascript
        preg_match_all("/<script.*?<\/script>/is", $article, $matches3, PREG_PATTERN_ORDER);
        $js = $matches3[0];


        //numbers \d*
        preg_match_all('/\d{2,}/s', $article, $matches_nums);
        $nospin_nums = $matches_nums[0];
        sort($nospin_nums);
        $nospin_nums = array_reverse($nospin_nums);


        //extract all reserved words
        $wp_auto_spinner_execlude = '';//get_option('wp_auto_spinner_execlude','');
        $execlude = explode("\n", trim($wp_auto_spinner_execlude));

        //execlude title words
        $autospin = [];//get_option('wp_auto_spin',array());
        if (in_array('OPT_AUTO_SPIN_TITLE_EX', $autospin)) {
            $extitle = explode(' ', $this->title);
            $execlude = array_merge($execlude, $extitle);
        }

        //execlude capital letters
        $capped = array();
        if (in_array('OPT_AUTO_SPIN_CAP_EX', $opt)) {
            //ececluding the capped words
            preg_match_all('{\b[A-Z][a-z]+\b}', $article, $matches_cap);
            $capped = $matches_cap[0];
            sort($capped);
            $capped = array_reverse($capped);


        }


        //execlude curly quotes
        $curly_quote = array();
        if (in_array('OPT_AUTO_SPIN_CURLY_EX', $opt)) {

            //double smart qoute
            preg_match_all('{“.*?”}', $article, $matches_curly_txt);
            $curly_quote = $matches_curly_txt[0];

            //single smart quote
            preg_match_all('{‘.*?’}', $article, $matches_curly_txt_s);
            $single_curly_quote = $matches_curly_txt_s[0];

            //&quot;
            preg_match_all('{&quot;.*?&quot;}', $article, $matches_curly_txt_s_and);
            $single_curly_quote_and = $matches_curly_txt_s_and[0];

            //&#8220; &#8221;
            preg_match_all('{&#8220;.*?&#8221}', $article, $matches_curly_txt_s_and_num);
            $single_curly_quote_and_num = $matches_curly_txt_s_and_num[0];

            //regular duouble quotes
            $curly_quote_regular = array();
            if (in_array('OPT_AUTO_SPIN_CURLY_EX_R', $opt)) {
                preg_match_all('{".*?"}', $article, $matches_curly_txt_regular);
                $curly_quote_regular = $matches_curly_txt_regular[0];
            }

            $curly_quote = array_merge($curly_quote, $single_curly_quote, $single_curly_quote_and, $single_curly_quote_and_num, $curly_quote_regular);


        }


        $exword_founds = array(); // ini

        foreach ($execlude as $exword) {

            if (preg_match('/\b' . preg_quote(trim($exword), '/') . '\b/u', $article)) {
                $exword_founds[] = trim($exword);
            }
        }


        // merge shortcodes to html which should be replaced
        $htmlfounds = array_merge($nospin, $js, $htmlurls, $curly_quote, $htmlfounds, $urls_txt, $shortcodes, $nospin_nums, $capped);

        $htmlfounds = array_filter(array_unique($htmlfounds));

        $i = 1;
        foreach ($htmlfounds as $htmlfound) {
            $article = str_replace($htmlfound, '(' . str_repeat('*', $i) . ')', $article);

            $i++;
        }


        //echo $article;
        //replacing execluded words
        foreach ($exword_founds as $exword) {
            if (trim($exword) != '') {
                $article = preg_replace('/\b' . preg_quote(trim($exword), '/') . '\b/u', '(' . str_repeat('*', $i) . ')', $article);
                $i++;
            }
        }


        //open the treasures db

        $wp_auto_spinner_lang = 'en';//get_option('wp_auto_spinner_lang','en');

        //original synonyms
        $file = file(dirname(__FILE__) . '/treasures_' . $wp_auto_spinner_lang . '.dat');

        //deleted synonyms update
        $deleted = array_unique([]);
        foreach ($deleted as $deleted_id) {
            unset($file[$deleted_id]);
        }

        //updated synonyms update
        $modified = [];//get_option('wp_auto_spinner_modified_' . $wp_auto_spinner_lang, array());

        foreach ($modified as $key => $val) {
            if (isset($file[$key])) {
                $file[$key] = $val;
            }
        }

        //custom synonyms on top of synonyms
        $custom = [];//get_option('wp_auto_spinner_custom_' . $wp_auto_spinner_lang, array());
        $file = array_merge($custom, $file);
        //echo $article;

        //checking all words for existance
        foreach ($file as $line) {

            //echo 'line:'.$line;

            //each synonym word
            $synonyms = explode('|', $line);
            $synonyms = array_map('trim', $synonyms);


            if (in_array('OPT_AUTO_SPIN_ACTIVE_SHUFFLE', $autospin)) {
                $synonyms2 = $synonyms;
            } else {
                $synonyms2 = array($synonyms[0]);
            }


            foreach ($synonyms2 as $word) {
                //echo ' word:'. $word;

                $word = str_replace('/', '\/', $word);
                if (trim($word) != '' & !in_array(strtolower($word), $execlude)) {

                    //echo $word.' ';

                    //echo '..'.$word;
                    if (preg_match('/\b' . $word . '\b/u', $article)) {

                        //replace the word with it's hash str_replace(array("\n", "\r"), '',$line)and add it to the array for restoring to prevent duplicate

                        //restructure line to make the original word as the first word
                        $restruct = array($word);
                        $restruct = array_merge($restruct, $synonyms);
                        $restruct = array_unique($restruct);
                        //$restruct=array_reverse($restruct);
                        $restruct = implode('|', $restruct);


                        $founds[md5($word)] = str_replace(array("\n", "\r"), '', $restruct);

                        $md = md5($word);
                        $article = preg_replace('/\b' . $word . '\b/u', $md, $article);

                        //fix hivens like one-way
                        $article = str_replace('-' . $md, '-' . $word, $article);
                        $article = str_replace($md . '-', $word . '-', $article);


                    }


                    //replacing upper case words
                    $uword = $this->auto_spinner_mb_ucfirst($word);

                    //echo ' uword:'.$uword;

                    if (preg_match('/\b' . $uword . '\b/u', $article)) {

                        $restruct = array($word);
                        $restruct = array_merge($restruct, $synonyms);
                        $restruct = array_unique($restruct);
                        //$restruct=array_reverse($restruct);
                        $restruct = implode('|', $restruct);


                        $founds[md5($uword)] = $this->auto_spinner_upper_case(str_replace(array("\n", "\r"), '', $restruct));

                        $article = preg_replace('/\b' . $uword . '\b/u', md5($uword), $article);

                    }


                }
            }


        }//foreach line of the synonyms file


        //restore html tags
        $i = 1;
        foreach ($htmlfounds as $htmlfound) {
            $article = str_replace('(' . str_repeat('*', $i) . ')', $htmlfound, $article);
            $i++;
        }


        //replacing execluded words
        foreach ($exword_founds as $exword) {
            if (trim($exword) != '') {
                $article = str_replace('(' . str_repeat('*', $i) . ')', $exword, $article);
                $i++;
            }

        }


        //replace hashes with synonyms
        if (isset($founds) && count($founds) != 0) {
            foreach ($founds as $key => $val) {
                $article = str_replace($key, '{' . $val . '}', $article);
            }
        }


        //deleting spin and nospin shortcodes
        $article = str_replace(array('[nospin]', '[/nospin]'), '', $article);

        $this->article = $article;


        //now article contains the synonyms on the form {test|test2}
        return $this->update_post($article);


    }

    function auto_spinner_mb_ucfirst($string)
    {


        if (function_exists('mb_strtoupper')) {
            $encoding = "utf8";
            $firstChar = mb_substr($string, 0, 1, $encoding);
            $then = mb_substr($string, 1, mb_strlen($string), $encoding);
            return mb_strtoupper($firstChar, $encoding) . $then;
        } else {
            return ucfirst($string);
        }
    }

    function  auto_spinner_upper_case($line)
    {

        $w_arr = explode('|', $line);

        for ($i = 0; $i < count($w_arr); $i++) {
            $w_arr[$i] = $this->auto_spinner_mb_ucfirst($w_arr[$i]);
        }

        $line = implode('|', $w_arr);

        return $line;


    }

}

class Spintax
{

    public $editor_form;

    function spin($string, $view = false)
    {

        $opt = [];//get_option('wp_auto_spin',array());


        $z = -1;
        $input = $this->bracketArray($string);


        for ($i = 0; $i < count($input); $i++) {
            for ($x = 0; $x < count($input[$i]); $x++) {
                if (!$input[$i][$x] == "" || "/n") {
                    $z++;
                    if (strstr($input[$i][$x], "*|*")) {
                        $out = explode("*|*", $input[$i][$x]);


                        $output[$z] = $out[rand(1, count($out) - 2)];

                        //invert synonyms
                        $synonyms = str_replace('*|*', '|', $input[$i][$x]);

                        //if content spinningactive

                        if (!in_array('OPT_AUTO_SPIN_DEACTIVE_CNT', $opt)) {

                            $randSyn = $out[rand(1, count($out) - 1)];

                        } else {

                            $randSyn = $out[0];

                        }

                        $output2[$z] = '<span  synonyms="' . $synonyms . '" class="synonym">' . $randSyn . '</span>';
                    } else {
                        $output[$z] = $input[$i][$x];
                        $output2[$z] = $input[$i][$x];
                    }
                }
            }
        }
        $res = '';
        $res2 = '';
        for ($i = 0; $i < count($output); $i++) {
            $res .= $output[$i];
            $res2 .= $output2[$i];
        }


        //$this->editor_form = $res2;

        return $res;

    }


    function bracketArray($str, $view = false)
    {

        preg_match_all('/{(.*?)}/s', $str, $matches);
        $sets = $matches [0];
        foreach ($sets as $set) {
            $str = str_replace($set, str_replace('|', '*|*', $set), $str);
        }


        @$string = explode("{", $str);

        for ($i = 0; $i < count($string); $i++) {
            @$_string[$i] = explode("}", $string[$i]);
        }
        if ($view) {
            $this->printArray($_string);
        }
        return $_string;
    }

    function cleanArray($array)
    {
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] != "") {
                $cleanArray[$i] = $array[$i];
            }
        }
        return $cleanArray;
    }

    function printArray($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}
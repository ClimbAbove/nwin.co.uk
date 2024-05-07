<?php

namespace App\Classes;

use App\Repositories\Interfaces\OpeningHoursRepositoryInterface;

class Helpers
{
    public static $scripts;
    public static $register = [];

    /**
     * showTelephone
     *
     * helper function that retrives the opening hours, and if we are within those hours ... isOpen(), then
     * return an array of telephone data.
     *
     * @return array|false
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function showTelephone()
    {
        $opening_hours_repository = app()->make(OpeningHoursRepositoryInterface::class);
        if($opening_hours_repository->isOpen()) {

            return [
                'number'               => str_replace(' ', '', config('content.telephone')),
                'number_formatted'     => config('content.telephone'),
                'international_number' => config('content.international_telephone'),
            ];
        }

        return false;
    }

    /**
     * substrNearestSpace
     *
     * returns the substr of a string to the nearest space/word.
     *
     * @param $string
     * @param $length
     *
     * @return string
     */
    public static function substrNearestSpace($string, $length)
    {

        $x      = explode(" ", $string);
        $y      = count($x);
        $substr = '';

        for ($i = 0; $i < $y; $i++) {

            $this_x = $x[$i] . ' ';

            if (strlen($substr . $this_x) > $length) {
                $i = $y;
            }
            else {
                $substr = $substr . $this_x;
            }
        }

        return $substr;
    }

    /**
     * minifyHTML
     *
     * will minify a given HTML string. It removed spaces etc.
     *
     * NOTE: can introduce bugs, so may need tweaks throughout time.
     *
     * @param $html
     *
     * @return array|string|string[]
     */
    public static function minifyHTML($html)
    {
        $search = array(
            '/\>[^\S ]+/s', //strip whitespaces after tags, except space
            '/[^\S ]+\</s', //strip whitespaces before tags, except space
            '/(\s)+/s',     // shorten multiple whitespace sequences
        );

        $replace = array(
            '>',
            '<',
            '\\1',
        );

        // Remove JS Comments
        if(preg_match_all('/<script([^\>]*)>([^\<]*)<\/script>/is', $html, $m)) {
            foreach($m[2] as $content) {
                if($content) {
                    // Single line (try not to mess with URLS)
                    $temp_content = preg_replace('![^\:|\'|\"]//([^\n]*)\n!ism', '', $content);
                    $html         = str_replace($content, $temp_content, $html);


                    // Multi line
                    $temp_content = preg_replace('!/\*(.*)\*\/!ism', '', $html);
                    $html         = str_replace($html, $temp_content, $html);
                }
            }
        }

        // Keep any real newlines in textarea.
        if(preg_match_all('/<textarea([^\>]*)>([^\<]*)<\/textarea>/is', $html, $m)) {
            foreach($m[2] as $content) {
                $temp_content = str_replace(PHP_EOL, '__PHP_EOL', $content);
                $html = str_replace($content, $temp_content, $html);
            }
        }

        // Keep any real newlines in pre.
        if(preg_match_all('/<pre([^\>]*)>([^\<]*)<\/pre>/is', $html, $m)) {
            foreach($m[2] as $content) {
                $temp_content = str_replace(PHP_EOL, '__PHP_EOL', $content);
                $html = str_replace($content, $temp_content, $html);
            }
        }

        $html = preg_replace($search, $replace, $html);

        return str_replace('__PHP_EOL', PHP_EOL, '<!DOCTYPE html>' . $html);
    }

}

<?php

namespace App\Helpers;

class StringHelper {

    /**
     * Generate a "random" alpha-numeric string.
     *
     * @param  int  $length
     * @return string
     */
    public static function randString($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    /**
     * Trim, clean the string.
     *
     * @param  string  $str
     * @return string
     */
    public static function cleanAndTrimString($str)
    {
        return trim(preg_replace('/\s\s+/', '', $str));
    }


    /**
     * Generate a URL friendly "slug" from a given string
     *
     * @param  string  $str
     * @return string
     */
    public static function uniqueSlugString($str)
    {
        return time() . '-' . str_slug($str, "-");
    }
}

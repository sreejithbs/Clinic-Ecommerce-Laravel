<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Route;

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

    /**
     * Set css class if the specific URI is current URI
     *
     * @param array $path
     * @return string
     */
    public static function setActive(array $routes, string $className = "active")
    {
        foreach ($routes as $route) {
            if( str_is($route, Route::currentRouteName()) ){
                return $className;
                break;
            }
        }
        return '';
    }
}
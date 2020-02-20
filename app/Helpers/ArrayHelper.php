<?php

namespace App\Helpers;

class ArrayHelper {

    /**
     * Trim, implode and clean the array.
     *
     * @param  array  $arr
     * @return string
     */
    public static function cleanAndImplodeToString($arr)
    {
        return implode(" ", array_map("trim", array_filter($arr)));
    }
}
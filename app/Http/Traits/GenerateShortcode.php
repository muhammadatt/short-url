<?php

namespace App\Http\Traits;

trait GenerateShortcode {
    
    /*
    |--------------------------------------------------------------------------
    | Generating a Shortcode
    |-------------------------------------------------------------------------- 
    |
    | There are a bunch of potential ways to handle generating a short code for
    | each url. The main considerations for our program are:
    |    
    | + Each shortcode must be unique (or have an extremely low probability of collisions)
    | + The generated shortcode should be as short as possible 
    | + The shortcode must contain only "url safe" and unreserved characters (no '&' '+' '\', etc.);
    |   - i.e. basically only numerals 0-9 and upper/lowercase letters (a-z A-Z)    
    | + However, the shortcode does NOT need to be "cryptographically secure" or impossible to guess
    | 
    | One approach that fits this requirements is to take the auto-increment id for 
    | each new databse entry and convert it into either base36 (numerals and lowercase letters) 
    | or base 62 (numerals, upper lowercase letters). See additional comments below.
    |  
    */

    /**
     * Converts integer to base36 (uses numerals and lowercase letters only)
     * PROS: Uses built-in PHP function (so it's reliable)
     * CONS: Only works up to base36, so wont generate urls quite as short as base62
     */
    public static function convert_int_to_base36($int)
    {

        return base_convert($int, 10, 36);
    }

    /**
     * Converts integer to base62 (numerals, uppercase and lowercase letters)
     * Borrowed, with slight modification from https://stackoverflow.com/questions/4964197/converting-a-number-base-10-to-base-62-a-za-z0-9
     * PROS: Adding uppercase letters to the character set generates the shortest urls possible
     * CONS: May require more testing around edge cases for larger numbers?
     * Tested basic working functionality over an arbitray range of integers here: http://codepad.org/ZVCK3ltF
     */

    public static function convert_int_to_base62($int)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($chars); //62

        //get remainder of $int/62
        $r = $int % $base;

        //generate first character of shortcode
        $shortcode = $chars[$r];

        //round down to nearest int
        $q = floor($int / $base);

        //generate remaining characters of shortcode
        while ($q) {
            $r = $q % 62;
            $q = floor($q / $base);
            $shortcode = $chars[$r] . $shortcode;
        }
        return $shortcode;
    }
}
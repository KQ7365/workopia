<?php

//since its in framework folder give it namespace

namespace Framework;

class Validation {
    //validate a string
    public static function string($value, $min = 1, $max = INF) {
        if(is_string($value)) {
            $value = trim($value);
            $length = strlen($value);
            return $length >= $min && $length <= $max;
        }
        return false;
    }

    //this will return false if not active email but will return actual email if true
    public static function email($value) {
        $value = trim($value);
            //now you can do different filters. Start typing it again and you'll see how many options
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    //This checks if password strings will match and only return if true
    public static function match($value1, $value2) {
        $value1 = trim($value1);
        $value2 = trim($value2);
        return $value1 === $value2;
     
    }
}
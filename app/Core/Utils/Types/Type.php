<?php

namespace App\Core\Utils\Types;


class Type
{
    public static function realType($value)
    {
        if (is_numeric($value)) {
            if (strripos($value, ".") !== false) $value = (float) $value;
            else $value = (int) $value;
        }

        return $value;
    }
}
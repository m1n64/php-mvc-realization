<?php

namespace App\Core\Database\Mapper\Query;


class Cleanup
{
    const SYMBOLS = [
        '\'',
        "\""
    ];

    /**
     * @param string $string
     * @return string
     */
    public static function cleanQuotes(string $string) : string
    {
        foreach (self::SYMBOLS as $symbol) {
            $string =  str_replace($symbol, '', $string);
        }
        return $string;
    }
}
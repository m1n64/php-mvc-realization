<?php

namespace App\Core\Router;

class ParametersParser
{
    /**
     * @param string $url
     * @return array
     */
    public static function parse(string $url) : array
    {
        preg_match_all(Route::REGEX_URL_PATTERN, $url, $matches);
        return $matches[1];
    }

}
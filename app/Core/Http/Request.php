<?php
namespace App\Core\Http;


use App\Core\Utils\Types\Type;

class Request
{
    /**
     * @return array
     */
    public function getParams() : array
    {
        $params = array_merge($_GET, $_POST);

        foreach ($params as $key => $param) {
            $params[$key] = Type::realType($param);
        }

        return $params;
    }

    /**
     * @param string $key
     * @return mixed|string
     */
    public function getParam(string $key)
    {
        $params = array_merge($_GET, $_POST);
        return Type::realType($params[$key]) ?? null;
    }

    /**
     * @return array
     */
    public function getFiles() : array
    {
        return $_FILES;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getFile(string $key)
    {
        return $_FILES[$key] ?? null;
    }

    /**
     * @return array
     */
    public function getCookies() : array
    {
        return $_COOKIE;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getCookie(string $key)
    {
        return $_COOKIE[$key] ?? null;
    }
}
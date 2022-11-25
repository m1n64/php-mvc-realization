<?php
namespace App\Core;


use App\Core\Http\Response;
use App\Core\Router\ParametersParser;
use App\Core\Router\Route;

class Router
{
    /**
     * @var Route[]
     */
    protected static array $paths = [];

    /**
     * @return void
     */
    public static function start() : void
    {
        $routes = self::cleanRoute();
        $container = require "config/di.php";

        if (isset(self::$paths[$routes])) {
            $currentPath = self::$paths[$routes];

            if ($_SERVER['REQUEST_METHOD'] == $currentPath->getMethod()) {
                //$controller = new $currentPath["controller"]();
                $controller = $container->get($currentPath->getController());

                $actionName = $currentPath->getAction();
                //$parameters = $currentPath->getRouteParams();
                $controller->$actionName();
            }
            else {
                self::pageNotFound();
            }
        }
        else {
            self::pageNotFound();
        }
    }

    /**
     * @param string $path
     * @param array $controller
     */
    public static function get(string $path, array $controller) : void
    {
        self::addPath($path, $controller, "GET");
    }

    /**
     * @param string $path
     * @param array $controller
     */
    public static function post(string $path, array $controller) : void
    {
        self::addPath($path, $controller, "POST");
    }

    /**
     * @param string $path
     * @param array $controller
     */
    public static function delete(string $path, array $controller) : void
    {
        self::addPath($path, $controller, "DELETE");
    }

    /**
     * @param string $path
     * @param array $controller
     */
    public static function put(string $path, array $controller) : void
    {
        self::addPath($path, $controller, "PUT");
    }

    /**
     * @param string $path
     * @param array $controller
     * @param string $method
     */
    private static function addPath(string $path, array $controller, string $method) : void
    {
        if (!isset(self::$paths[$path])) {
            /*self::$paths[$path] = [
                "controller" => $controller[0],
                "action" => $controller[1] ?? "index",
                "method" => $method
            ];*/
            self::$paths[$path] = new Router\Route($path, $controller[0], $controller[1] ?? "index", $method);
        }
    }

    /**
     * @return string
     */
    private static function cleanRoute() : string
    {
        return explode("?", $_SERVER['REQUEST_URI'])[0];
    }

    /**
     * @return void
     */
    private static function pageNotFound() : void
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        (new Response())->redirect("404");
    }
}
<?php

namespace App\Core\Controller;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Middleware\Interfaces\MiddlewareInterface;
use App\Core\Model\AbstractModel;
use App\Core\Model\Interfaces\ModelInterface;
use App\Core\View\HtmlView;
use App\Core\View\Interfaces\ViewInterface;

abstract class AbstractController
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var ModelInterface
     */
    protected ModelInterface $model;

    /**
     * @var ViewInterface
     */
    protected ViewInterface $view;

    public function __construct()
    {
        $this->view = new HtmlView();
        $this->request = new Request();
        $this->response = new Response();
    }

    abstract public function index() : void;

    /**
     * @param string $middlewarePath
     */
    protected function middleware(string $middlewarePath) : void
    {
        $container = require __DIR__ . "/../config/di.php";

        $middleware = $container->get($middlewarePath);
        if ($middleware instanceof MiddlewareInterface) {
            $middleware->execute();
        }
    }
}

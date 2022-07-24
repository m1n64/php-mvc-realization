<?php

namespace App\Core\Middleware;


use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Middleware\Interfaces\MiddlewareInterface;

abstract class AbstractMiddleware implements MiddlewareInterface
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Response
     */
    protected Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    abstract public function execute(): void;

    /**
     * @param string $to
     */
    protected function redirect(string $to) : void
    {
        $this->response->redirect($to);
    }
}
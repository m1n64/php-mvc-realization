<?php

namespace App\Core\Router;

class Route
{
    public const REGEX_URL_PATTERN = '/:(\w+?)?:/';

    /**
     * @var string
     */
    protected string $url;

    /**
     * @var string
     */
    protected string $controller;

    /**
     * @var string
     */
    protected string $action;

    /**
     * @var string
     */
    protected string $method;

    /**
     * @param string $url
     * @param string $controller
     * @param string $action
     * @param string $method
     */
    public function __construct(
        string $url,
        string $controller,
        string $action,
        string $method
    )
    {
        $this->url = $url;
        $this->controller = $controller;
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * @return null
     */
    /*public function getRouteParams()
    {
        return (new ParametersParser($this->url))->parse();
    }*/

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

}
<?php
namespace App\Core\Http;


class Response
{
    /**
     * @var string
     */
    protected string $host;

    public function __construct()
    {
        $this->host = "http://{$_SERVER['HTTP_HOST']}/";
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $to
     */
    public function redirect(string $to) : void
    {
        header("Location: {$this->host}$to");
    }

}
<?php

namespace Core;

class Request
{
    /**
     * @var array
     */
    protected $params;
    /**
     * @var string
     */
    protected $server;

    public function __construct($getParams = array(), $postParams = array(), $serverParams = array())
    {
        $params = array();
        $this->params =array_merge($postParams, $getParams);
        $this->server = $serverParams;
    }

    public static function createFromGlobals(): object
    {
        return new Request($_GET, $_POST, $_SERVER);
    }

    public function getUri(): string
    {
        return trim($this->server['QUERY_STRING'], '/');
    }
}

<?php

namespace Core;

use Core\View;
use Core\Interfaces\responseinterface;

class response implements ResponseInterface
{
    protected $statusCode;
    protected $headers;
    protected $body=[];

    public function setStatusCode(string $code) :object
    {
        $this->statusCode = $code;
        return $this;
    }

    public function setHeader(array $header):object
    {
        $this->headers=$header;
        return $this;
    }

    public function setBody(array $body): object
    {
        $this->body = $body;
        return $this;
    }

    public function getStatusCode():string
    {
        return $this->statusCode;
    }
    public function getHeaders():array
    {
        return $this->headers;
    }
    public function getBody():array
    {
        return $this->body;
    }
    public static function create(string $statusCode = null, array $headers = null, string $body = null): response
    {
        return new Response($statusCode, $headers, $body);
    }
    public function send(): void
    {
        foreach ($this->headers as $header => $value) {
            header(strtoupper($header).': '.$value);
        }

        if ($this->headers['Content-Type']==="text/html" && $this->statusCode === "200") {
            View::renderTemplate($this->body['view']);
        }
    }
}

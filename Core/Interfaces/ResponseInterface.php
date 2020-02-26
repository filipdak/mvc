<?php

namespace Core\Interfaces;

interface ResponseInterface
{
    public function setStatusCode(string $code);

    public function setHeader(array $header);

    public function setBody(array $body);

    public static function create(string $statusCode = null, array $headers = null, string $body = null);
    
    public function send();
}

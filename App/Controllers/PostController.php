<?php

namespace App\Controllers;

use Core\Response;

class PostController
{
    public function index()
    {
        return Response::create()
            ->setStatusCode(200)
            ->setHeader(['Content-Type' => 'text/html'])
            ->setBody(['view'=>'index']);
    }
}

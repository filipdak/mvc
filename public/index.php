<?php

declare(strict_types=1);

use Core\Router;
use Core\FrontController;

require dirname(__DIR__).'\vendor\autoload.php';
set_exception_handler('Core\Error::exceptionHandler');

$router = new Router();
$router->addRoute('posts', ['controller'=>'PostController', 'action'=>'index']);
$router->addRoute('post', ['controller'=>'PostController', 'action'=>'show']);

$frontController = new FrontController($router);

$frontController->run();

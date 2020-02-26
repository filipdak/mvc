<?php

namespace Core;

use Core\Exceptions\PageNotFoundException;
use Core\Exceptions\AccessForbiddenException;
use Exception;

class Router
{
    protected $routes=[];
    protected $params=[];


    public function getRoutes() :iterable
    {
        return $this->routes;
    }

    public function getParams() :array
    {
        return $this->params;
    }
    public function addRoute(string $route, array $params) :void
    {
        $this->routes[$route]=$params;
    }

    public function dispatch(request $request) :object
    {
   
        if ($this->match($request)) {
            $controller = $this->getnamespace().ucfirst($this->params['controller']);
            $controller_object = new $controller;
            $action = $this->params['action'];
            if (class_exists($controller) && is_callable([$controller_object, $action])) {
                return $controller_object->$action();
            }
            throw new Exception("Controller $controller or method $action not exists");
        }

        throw new PageNotFoundException('Route not found');
    }

    public function getnamespace() :string
    {
        return "App\Controllers\\";
    }

    public function match(object $request): bool
    {
        foreach ($this->routes as $route => $value) {
            if ($request->getUri() === $route) {
                $this->params = $value;

                return true;
            }
        }

        return false;
    }
}

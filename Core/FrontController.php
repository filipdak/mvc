<?php

namespace Core;

use Core\Router;
use Core\Request;
use Core\View;
use Core\Exceptions\PageNotFoundException;

class FrontController
{
    protected $router;

    public function __construct(router $router)
    {
        $this->router = $router;
    }

    public function run(): void
    {
        try {
            $request = Request::createFromGlobals();
            $response = $this->router->dispatch($request);
            $response->send();
        } catch (AccessForbiddenException $e) {
            $this->handleError($e, 403);
        } catch (PageNotFoundException $e) {
            $this->handleError($e, 404);
        } catch (\Exception $e) {
            $this->handleError($e, 500);
        }
    }

    public function handleError($exception, $statusCode)
    {
        echo $exception->getmessage();
        http_response_code($statusCode);
    }
}

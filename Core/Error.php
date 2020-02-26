<?php

namespace Core;

class Error
{
    public function exceptionHandler(object $exception): void
    {
        echo 'Upps. Something went wrong. '.$exception->getMessage();
    }
}

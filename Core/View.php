<?php

namespace Core;

use \eftec\bladeone\BladeOne;

abstract class View
{
    public static function renderTemplate($template, $params=[])
    {
        static $blade = null;
        if ($blade === null) {
            $views = dirname(__DIR__).'/App/Views';
            $cache = dirname(__DIR__).'/App/Cache';
            $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        }
        echo $blade->run($template, $params);
    }
}

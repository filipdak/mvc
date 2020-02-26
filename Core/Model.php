<?php

namespace Core;

use Symfony\Component\Yaml\Yaml;
use PDO;

abstract class Model
{
    public function getConfig()
    {
        return Yaml::parseFile("../Config/db.yaml");
    }

    public static function getDB() :PDO
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host='.self::getConfig()['db']['host'].';dbname='.self::getConfig()['db']['name'].';charset=utf8';
            $db = new PDO($dsn, self::getConfig()['db']['user'], self::getConfig()['db']['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}

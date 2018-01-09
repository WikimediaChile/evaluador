<?php

namespace model;

class database
{
    private static $con;

    public static function instance(array $db = []) : \DB\SQL
    {
        $db = $db ?: \F3::get('database');
        if (is_null(self::$con)) {
            $string = 'mysql:host=%s;dbname=%s';

            $dsn = sprintf($string, $db['server'], $db['database']);
            $option = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
            self::$con = new \DB\SQL($dsn, $db['user'], $db['password'], $option);
        }
        return self::$con;
    }
}

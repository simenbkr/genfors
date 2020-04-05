<?php


namespace genfors;


class DB extends \PDO
{
    private static $__instance = null;

    public static function getDB()
    {
        if (self::$__instance == null) {
            self::$__instance = new self();
        }
        return self::$__instance;
    }

    public function __construct()
    {
        $domain = 'mysql:host=' . DB_DOMAIN . ';dbname=' . DB_NAME . ';';
        parent::__construct($domain, DB_USER, DB_PW,
            array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\''));
        parent::setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

}
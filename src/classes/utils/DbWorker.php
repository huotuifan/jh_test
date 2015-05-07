<?php

namespace utils;

class DbWorker
{
    private static $instance = null;
    private $connection = null;

    public static function getConnection()
    {
        if (self::$instance == null) {
            self::$instance = new DbWorker();
        }
        return self::$instance->connection;
    }

    function __construct()
    {
        require_once dirname(__FILE__) . '/dbsimple/Generic.php';
        $this->connection = \utils\DbSimple_Generic::connect(__CONFIG_NM_DB_CONNECT__);
        $this->connection->setErrorHandler(array($this, 'databaseErrorHandler'));
        $this->connection->setIdentPrefix('nm_');
        $this->connection->query("SET NAMES 'utf8'");
    }

    public function mysqlErrorHandler($message, $info)
    {
        // TODO: send mail with error message
        if (!error_reporting()) return;
        Utils::print_pre($message);
        Utils::print_pre($info);
        Utils::print_pre($this);
        Utils::sendError(Utils::getMessage('s001'));
        exit();
    }
    function databaseErrorHandler($message, $info)
    {
        if (!error_reporting()) return;
        error_log("SQL Error : $message", 3, "/var/tmp/my-errors.log");
        exit();
    }

}

<?php namespace Module\Core;

abstract class Database {
    protected $connect;

    public function __construct() {
        session_start();
        try{
            $dbConfig = require_once ROOT_DIR . 'config/database.php';
            $this->connect = new \PDO('mysql:dbname='. $dbConfig['DB_NAME'].';host='. $dbConfig['DB_HOST'], $dbConfig['DB_USER'], $dbConfig['DB_PASS']);
        }
        catch(\PDOException $ex) {
            return 'Connection failed:' . $ex->getMessage();
        }
    }

}
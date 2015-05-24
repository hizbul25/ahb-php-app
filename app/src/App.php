<?php namespace Module;

use Klein\Klein;

class App {
    protected static $request;

    public function __construct() {
        session_start();
        if(self::$request == null) {
            self::$request = new Klein();
        }

        return self::$request;
    }

    public static function requestHandler() {
        return self::$request;
    }
}
<?php namespace Module\Core;

interface Authenticate{
    public function getLogin(array $arrCredentials);
    public function getLogout();
}
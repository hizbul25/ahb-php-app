<?php
error_reporting(1);
ini_set('display_error', 1);
define('ROOT_DIR', __DIR__ . '/app/');
define('ASSETS_DIR', __DIR__ . '/assets/');

/**
 * Load all library files
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Load helper functions
 */
require ROOT_DIR . 'functions.php';

/**
 * Separate all request to another file [http-request]
 *
 * @See http-request for all the request of this application
 */
$app = new Module\App();

require ROOT_DIR . 'http-request.php';

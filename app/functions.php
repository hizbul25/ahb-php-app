<?php

/**
 * Dump a variable - helper method
 *
 * @param $data
 */
function dd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die;
}

/**
 * Load a layout
 *
 * @param string $layout
 * @return string
 */
function layout($layout = 'default.php')
{
    ob_start();
    include ROOT_DIR . 'views/layouts/' .$layout;
    $html = ob_get_clean();
    return $html;
}

/**
 * Load a view
 *
 * @param string $_pageName
 * @param string $ext
 * @param array $data
 * @return string
 */
function renderPage($_pageName, array $data = array(), $ext = '.php', $layout = 'default.php')
{
    extract($data);
    ob_start();
    include ROOT_DIR . 'views/' .$_pageName . $ext;
    $html = ob_get_clean();
    return str_replace('{{=yields=}}', $html, layout($layout));
}

/**
 * Load chunks
 *
 * @param $_pageName
 * @param array $data
 * @param string $ext
 */
function partial($_pageName, array $data = array(), $ext = '.php')
{
    extract($data);
    ob_start();
    include ROOT_DIR . 'views/partial' .$_pageName . $ext;
    $html = ob_get_clean();
    echo $html;
}

/**
 * Load a single file
 *
 * @param $file
 * @param bool $return
 * @return string
 */
function asset($file, $return = false)
{
    $url = '//' . $_SERVER['HTTP_HOST'] . '/'. $file;
    if ($return === false) {
        echo $url;
    }

    return $url;
}

/**
 * Load all files from this directory
 *
 * @param $dirs
 * @param $string
 * @return string
 */
function assets($dirs, $string)
{
    $html = '';
    $originalDirs = ASSETS_DIR . $dirs;
    if ( file_exists($originalDirs) ) {
        $files = scandir($originalDirs);
        unset($files[0]); //remove .
        unset($files[1]); //remove ..
        foreach ($files as $file) {
            $file = 'assets/' . $dirs . '/' . $file;
            if ( is_dir($file) ) continue;
            $html .= str_ireplace('{link}', asset($file, true), $string);
        }
    }
    return $html;
}

/**
 * Load all java scripts
 *
 * @param $dirs
 * @return string
 */
function javaScripts($dirs)
{
    echo assets($dirs, '<script src="{link}"></script>');
}
/**
 * Load all css files
 *
 * @param $dirs
 * @return string
 */
function stylesheets($dirs)
{
    echo assets($dirs, '<link rel="stylesheet" href="{link}">');
}

/**
 * Generate a url
 *
 * @param $url
 */
function generate_url($url)
{
    echo '//' . $_SERVER['HTTP_HOST'] . '/'. $url;
}

/**
 * Redirect to a uri
 *
 * @param string $uri
 */
function redirect($uri = '/')
{
    header('Location: ' . $uri); exit;
}

/**
 * Flash a message to user or set a message for future use
 *
 * @param null $message
 * @return null
 */
function setFlash($message = null)
{
    $flash = $message;
    if ($message === null && isset($_SESSION['flash.message'])) {
        $flash = $_SESSION['flash.message'];
        unset($_SESSION['flash.message']);
    } else {
        $_SESSION['flash.message'] = $message;
    }

    return $flash;
}

function getFlash() {
    return $_SESSION['flash.message'];
}

/**
 * get login user name
 * @return string
 *
 */

function currentUser() {
    if(!empty($_SESSION['login_user_name'])) {
        return $_SESSION['login_user_name'];
    }
}


/**
 * show flash message
 * @params string $message
 * @params string $type
 *
 * @return string
 */

function getMessage($message, $type = 'success') {
    echo '<div class="alert alert-'.$type.'" role="alert">' . $message . '</div>';

}
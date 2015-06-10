<?php
use Module\Core\User;

$request_handler = \Module\App::requestHandler();

$request_handler->respond( array('GET','POST'), '/', function( $request ) {
    return layout();
});

$request_handler->respond(['GET', 'POST'], '/backbone/test', function($request) {
    switch ($request->method()) {
        case 'GET':
            return renderPage('backbone/index');
            break;
        case 'POST':
            exit();
            break;
    }
});

$request_handler->respond(['GET', 'POST'], '/backbone/data', function($request) {
    dd($request);
    switch ($request->method()) {
        case 'GET':
            return renderPage('backbone/data', ['id' => $request->id]);
            break;
        case 'POST':
            exit();
            break;
    }
});

$request_handler->respond( array('GET','POST'), '/register', function( $request )
{
    switch($request->method())
    {
        case 'GET':
            return renderPage('user/register');
            break;
        case 'POST':
            $objUser = new User();
            $blnCreate = $objUser->create(array(
                'name'      => $request->name,
                'email'     => $request->email,
                'mobile'    => $request->mobile,
                'password'  => $request->password
                ));
            if($blnCreate) {
                redirect('/');
            }
            break;

    }
});

$request_handler->respond( array('GET','POST'), '/login', function( $request )
{
    switch($request->method())
    {
        case 'GET':
            return renderPage('user/login');
            break;
        case 'POST':
            $objUser = new User();
            $blnLogin = $objUser->getLogin(array(
                'email'     => $request->email,
                'password'  => $request->password
            ));
            if($blnLogin) {
                redirect('/');
            }
            break;

    }
});

$request_handler->respond(['GET', 'POST'], '/logout', function($request) {
    $objUser = new User();
    $objUser->getLogout();
});
$request_handler->dispatch();
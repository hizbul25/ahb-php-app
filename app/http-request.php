<?php
use Module\Core\User;

$request_handler = \Module\App::requestHandler();

$request_handler->respond( array('GET','POST'), '/', function( $request ) {
    return layout();
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
    return "form another page";
});
$request_handler->dispatch();
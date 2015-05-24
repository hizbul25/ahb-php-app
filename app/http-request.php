<?php

$request_handler = \Module\App::requestHandler();

$request_handler->respond( array('GET','POST'), '/', function( $request ) {
});

$request_handler->dispatch();
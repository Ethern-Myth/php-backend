<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

spl_autoload_register(function ($class) {
    include_once(DOC_ROOT_PATH . '/backend/handler/' . $class . '.php');
});

set_exception_handler("ErrorHandler::handleException");

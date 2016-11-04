<?php

require_once 'APIController.php';
require_once 'config/Definitions.php';

header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');




if (isset($_SERVER['PATH_INFO'])) {
    $request_method = $_SERVER['REQUEST_METHOD'];   // HTTP request method
    $path = explode('/', trim($_SERVER['PATH_INFO']));   // URI
    array_shift($path);
    $body = json_decode(file_get_contents('php://input'), true);    // JSON

    $response = null;

    $controller = new APIController($request_method, trim($_SERVER['PATH_INFO']), $body);
    $response = $controller->getResponse();
    /*
    if (json_last_error() == JSON_ERROR_NONE) {
        $controller = new APIController($request_method, trim($_SERVER['PATH_INFO']), $body);
        $response = $controller->getResponse();
    } else {
        $response = new Response("InvalidError-.-.");  // TODO: return invalid JSON error
    }
*/
    //header(':', true, $response->getStatusCode());
    echo $response->getResponse();
}
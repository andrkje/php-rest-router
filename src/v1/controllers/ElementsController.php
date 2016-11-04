<?php

require_once __DIR__ . '/../../v1/EndPointControllerInterface.php';
require_once __DIR__ . '/../../v1/Auth.php';


class ElementsController implements EndPointControllerInterface
{
    private $message, $error;

    /**
     * Constructor
     */
    public function __construct($request_method, $path, $body, $auth, array $path_arguments = [])
    {
        if (Auth::isAuthenticatedForPath($auth)){
            $this->message = "element controller";
        } else {
            $this->message = 'Auth error';
         }
    }

    /**
     * Returns response
     * @return Response
     */
    public function getResponse()
    {
        return new Response($this->message);
    }
}
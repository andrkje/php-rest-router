<?php

require_once __DIR__ . '/../../v1/EndPointControllerInterface.php';
require_once __DIR__ . '/../../v1/Auth.php';

class ListController implements EndPointControllerInterface
{
    private $message;

    /**
     * Constructor
     */
    public function __construct($request_method, $path, $body, $auth, array $path_arguments = [])
    {
        if (Auth::isAuthenticatedForPath($auth))  {
            $id = '';
            if ($path_arguments)
                $id .= ', with id: ' . $path_arguments[0];
            $this->message = 'ListController called with request method ' . $request_method . $id . '.';
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
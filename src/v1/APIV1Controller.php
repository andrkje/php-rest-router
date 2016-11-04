<?php

require_once __DIR__ . '/response/Response.php';

class APIV1Controller implements ControllerInterface
{
    /**
     * APIV1Controller constructor.
     */
    public function __construct($request_method, $path, $body)
    {
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return new Response('v1');
    }
}
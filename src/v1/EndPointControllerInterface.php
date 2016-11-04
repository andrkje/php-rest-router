<?php

interface EndPointControllerInterface
{
    /**
     * Constructor
     */
    public function __construct($request_method, $path, $body, $auth, array $path_arguments);

    /**
     * Returns response
     * @return Response
     */
    public function getResponse();


}
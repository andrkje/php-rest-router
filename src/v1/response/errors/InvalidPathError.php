<?php

require_once __DIR__ . '/../HTTPStatusCodes.php';
require_once __DIR__ . '/../ErrorResponse.php';

class InvalidPathError extends ErrorResponse
{
    /**
     * InvalidPathError constructor.
     * @param $path
     */
    public function __construct($path, $request_method)
    {
        $title = 'Invalid path error';
        $message = "The request method $request_method is not valid to the path: " . $path;
        parent::__construct($title, $message, HTTPStatusCodes::NOT_FOUND);
    }


}
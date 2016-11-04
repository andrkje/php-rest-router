<?php

require_once __DIR__ . '/../HTTPStatusCodes.php';
require_once __DIR__ . '/../ErrorResponse.php';

class AuthenticationError extends ErrorResponse
{
    /**
     * InvalidPathError constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $title = 'Authentication error';
        $message = "You're not authenticated to enter the path: " . $path;
        parent::__construct($title, $message, HTTPStatusCodes::BAD_REQUEST);    // DODO add auth code
    }


}
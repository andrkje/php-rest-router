<?php

require_once 'Response.php';
require_once 'HTTPStatusCodes.php';

class ErrorResponse extends Response
{
    /**
     * ErrorResponse constructor.
     * @param $title
     * @param int $message
     * @param int|string $status_code
     */
    public function __construct($title, $message, $status_code = HTTPStatusCodes::INTERNAL_ERROR)
    {
        $response = array(
            'Title' => $title,
            'Message' => $message
        );
        parent::__construct($response, $status_code);
    }
}
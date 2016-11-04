<?php

require_once 'HTTPStatusCodes.php';
require_once 'ContentTypes.php';

class Response
{
    protected $response, $status_code, $content_type;

    /**
     * Response constructor.
     * @param $response
     * @param int $status_code
     * @param string $content_type
     */
    public function __construct($response, $status_code = HTTPStatusCodes::OK, $content_type = ContentTypes::JSON)
    {
        $this->response = $response;
        $this->status_code = $status_code;
        $this->$content_type = $content_type;
    }

    /**
     * Returns JSON response
     * @return string
     */
    public function getResponse() {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    /**
     * Returns status code
     * @return int
     */
    public function getStatusCode() {
        return $this->status_code;
    }

    /**
     * Returns content type
     * @return mixed
     */
    public function getContentType() {
        return $this->content_type;
    }
}
<?php

require_once 'ControllerInterface.php';
require_once __DIR__ . '/v1/V1Paths.php';
require_once __DIR__ . '/v1/response/errors/InvalidPathError.php';

class APIController implements ControllerInterface
{
    private $controller, $error;

    /**
     * APIController constructor.
     * @param $request_method
     * @param $path
     * @param $body
     */
    public function __construct($request_method, $path, $body)
    {
        $path_array = explode('/', $path);  // TODO: clean up. Also duplicate
        array_shift($path_array);

        if (count($path_array) > 0) {
            $api_version = $path_array[0];
            switch ($api_version) {
                case 'v1':
                    $this->controller = new V1Paths($request_method, $path, $body);
                    break;
                default:
                    $this->error = new InvalidPathError($path, $request_method);
            }
        } else {
            $this->error = new InvalidPathError($path, $request_method);
        }

       
    }

    

    /**
     * Returns response.
     * @return Response
     */
    public function getResponse()
    {
        if ($this->error)
            return $this->error;
        return $this->controller->getResponse();
    }
}
<?php

require_once __DIR__ . '/../ControllerInterface.php';
require_once __DIR__ . '/response/errors/InvalidPathError.php';
require_once __DIR__ . '/response/Response.php';

require_once __DIR__ . '/config/V1PathConfig.php';
require_once __DIR__ . '/models/api/APIPaths.php';
require_once __DIR__ . '/models/api/Path.php';
require_once __DIR__ . '/response/errors/AuthenticationError.php';

foreach (glob("v1/controllers/*.php") as $filename) {
    require_once $filename;
}

class V1Paths implements ControllerInterface
{
    private $controller, $error;

    public function __construct($request_method, $path, $body)
    {
        try {
            $paths = V1PathConfig::getPaths();
            $path_strings = $paths->getPaths();

            $path_string = Path::getPathFormat($path);

            foreach ($path_strings as $p) {
                if ($p->getPathStringFormat() == $path_string) {

                    if (!in_array($request_method, $p->getRequestMethods())) {
                        $this->error = new InvalidPathError($path, $request_method);
                    }

                    $controller_name = $p->getController();
                    $this->controller = new $controller_name(
                        $request_method, $path, $body, $p->getAuthentication(), Path::getPathArgumentsFromPath($path)
                    );

                }
            }

            if (!($this->controller || $this->error))
                $this->error = new InvalidPathError($path, $request_method);

        } catch (InvalidArgumentException $e) {
            if (DEBUG)
                echo get_class($e) . ": " . $e->getMessage();
        }


    }

    /**
     * Returns response
     * @return Response
     */
    public function getResponse()
    {
        if ($this->error)
            return $this->error;
        return $this->controller->getResponse();
    }
}
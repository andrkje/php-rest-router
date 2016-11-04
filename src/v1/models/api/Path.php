<?php

require_once __DIR__ . '/../../config/APIConfig.php';

/**
 * Class Path
 *
 * Storage of path and controller.
 */
class Path
{
    private $path, $controller, $request_methods, $authentication;

    public function __construct($path, $controller, array $request_methods = ['GET'], $authentication = 0)
    {
        if (!is_string($path))
            throw new InvalidArgumentException('Path must be a string');
        $this->path = $path;    // TODO: validation?

        if (!is_string($controller))
            throw new InvalidArgumentException('Controller must be a string');
        $this->controller = $controller;

        if (!$this->isValidRequestMethodArray($request_methods))
            throw new InvalidArgumentException('$request_methods contains illegal request method. Allowed request methods:' .
                APIConfig::getStringRepresentationRequestMethods());
        $this->request_methods = $request_methods;


        if (!is_int($authentication) || !$this->isValidAuthentication($authentication))
            throw new InvalidArgumentException('$authentication must be int, 0 or 1.');
        $this->authentication = $authentication;
    }

    /**
     * Checks that all request methods given are valid
     * @param $request_methods
     * @return bool
     */
    private function isValidRequestMethodArray($request_methods)
    {
        foreach ($request_methods as $request_method) {
            if (!in_array($request_method, REQUEST_METHODS))
                return false;
        }
        return true;
    }

    /**
     * Checks that auth is 0 or 1
     * @param $authentication
     * @return bool
     */
    private function isValidAuthentication($authentication)
    {
        foreach (AUTH_LEVELS as $auth_level) {
            if ($authentication === $auth_level) {
                return true;
            }
        }
        return false;
        return $authentication === 1 || $authentication === 0;
    }


    /**
     * Removes '/' on the end of the path
     * @param $path
     * @return string
     */
    private static function trimPath($path)
    {
        if (substr($path, -1) == '/')
            return substr($path, 0, strlen($path) - 1);
        return $path;
    }

    /**
     * Returns array representation of path
     * @param $path
     * @return array
     */
    public static function getPathArray($path)
    {
        $path = Path::trimPath($path);
        $path_array = explode('/', $path);
        array_shift($path_array);
        return $path_array;  // TODO: should this be accessible form everywhere?
    }

    /**
     * Returns path on XXXXXX format    // TODO: change XXXXXXX to something more descriptive
     * @param $path
     * @return string
     */
    public static function getPathFormat($path)
    {

        $path_array = Path::getPathArray($path);
        array_shift($path_array);   // Removes 'v1'
        $string_path = '';
        foreach ($path_array as $path_element) {        // Handle decimal numbers (2.54 is valid...)
            $string_path .= '/';
            if (Path::isIntegerString($path_element)) {
                $string_path .= '{n}';
            } else {
                $string_path .= $path_element;
            }
        }

        return $string_path;
    }

    /**
     * Returns array of arguments in the path string
     * @param $path
     * @return array
     */
    public static function getPathArgumentsFromPath($path) {
        $path_array = explode('/', $path);  // TODO: clean up.
        array_shift($path_array);
        $numeric_parameters = [];

        foreach ($path_array as $path_element) {
            if (Path::isIntegerString($path_element)) {
                array_push($numeric_parameters, $path_element);
            }
        }

        return $numeric_parameters;
    }

    /**
     * Returns if string contains only integer values
     * @param $s
     * @return bool
     */
    private static function isIntegerString($s)
    {      // TODO: Global?
        if (strlen($s == 0))
            return false;
        $numbers = '1234567890';
        foreach (str_split($s) as $char) {
            if (strpos($numbers, $char) === false)
                return false;
        }
        return true;
    }



    //////////////////////// PUBLIC /////////////////////////


    /**
     * Returns path string format
     * @return string
     */
    public function getPathStringFormat()
    {
        return $this->getPathFormat($this->path);
    }

    /**
     * Path getter
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Controller getter
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * RequestMethods getter
     * @return array
     */
    public function getRequestMethods()
    {
        return $this->request_methods;
    }

    /**
     * Authentication getter
     * @return mixed
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

}
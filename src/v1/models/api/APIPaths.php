<?php

/**
 * Class APIPaths
 *
 * Collection of all system paths
 */
class APIPaths
{
    private $paths;

    /**
     * APIPaths constructor
     * @param array $paths
     */
    public function __construct(array $paths = [])
    {
        $this->paths = $paths;
    }

    /**
     * Paths getter
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * Add path to path list
     * @param Path $path
     */
    public function addPath(Path $path)
    {
        array_push($this->paths, $path);
    }

}
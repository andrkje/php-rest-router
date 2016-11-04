<?php

require_once __DIR__ . '/../models/api/APIPaths.php';

class V1PathConfig
{
    /**
     * @return APIPaths
     */
    public static function getPaths()
    {
        // Contains all paths in the API
        $paths = new APIPaths();
        // *******************************************************************
        //                              Add paths
        //
        //  To add paths:
        // *******************************************************************
        $p = new Path('aaa', 'controller');

        $paths->addPath(new Path('/v1/lists/', 'ListController', ['GET'], 1));
        $paths->addPath(new Path('/v1/lists/{n}/', 'ListController', ['GET','POST', 'PUT', 'DELETE']));
        $paths->addPath(new Path('/v1/lists/{n}/elements', 'ElementsController', ['GET','POST', 'PUT', 'DELETE'], 1));

        return $paths;
    }

}
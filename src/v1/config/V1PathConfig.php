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
        //  $paths->addPath(new Path('/pathname/', 'Controller', [Allowed HTTP request types'], auth_required));
        // *******************************************************************
        $api_version = '/v1';

        // Lists
        $paths->addPath(new Path($api_version . '/lists/', 'ListController', ['GET'], AUTH_LEVELS['NONE']));
        $paths->addPath(new Path($api_version . '/lists/{n}/', 'ListController', ['GET','POST', 'PUT', 'DELETE']));
        $paths->addPath(new Path($api_version . '/lists/{n}/elements', 'ElementsController', ['GET','POST', 'PUT', 'DELETE'], AUTH_LEVELS['NONE']));

        // Admin
        $paths->addPath(new Path($api_version . '/admin', 'AdminController', ['GET'], AUTH_LEVELS['ADMIN']));


        
        return $paths;
    }

}
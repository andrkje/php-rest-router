# php-rest-router

## Add new path
Paths are defined in /src/v1/config/V1PathConfig
$paths->addPath(new Path('/pathname/', 'ControllerName', [Allowed HTTP request types'], auth_level_required));

A controller with the same name must go in /src/v1/controllers

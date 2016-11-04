<?php

class Auth
{
    public static function isAuthenticatedForPath($auth) {
        return $auth === USER_AUTH_LEVEL;
    }
}
<?php

class APIConfig
{
    // Constants




    // Function

    /**
     * Returns string of allowed request methods
     * @return string
     */
    public static function getStringRepresentationRequestMethods()
    {
        $output = '';
        foreach (REQUEST_METHODS as $request_method) {
            $output .= ' ' . $request_method;
        }
        return $output;
    }

}
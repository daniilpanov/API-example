<?php

function getAuthorizationHeader()
{
    $headers = null;

    if (isset($_SERVER['Authorization']))
    {
        list($headers['type'], $headers['token']) = explode(" ", trim($_SERVER["Authorization"]));
    }
    elseif (isset($_SERVER['HTTP_AUTHORIZATION']))
    {
        list($headers['type'], $headers['token']) = explode(" ", trim($_SERVER["HTTP_AUTHORIZATION"]));
    }
    elseif (function_exists('apache_request_headers'))
    {
        $requestHeaders = apache_request_headers();

        $requestHeaders = array_combine(
                array_map(
                    'ucwords',
                    array_keys($requestHeaders)
                ),
                array_values($requestHeaders)
        );

        if (isset($requestHeaders['Authorization']))
        {
            $parsed_auth = explode(" ", trim($requestHeaders['Authorization']));
            $headers['type'] = $auth_type = $parsed_auth[0];

            switch ($auth_type)
            {
                case "Basic":
                    if (isset($_SERVER['PHP_AUTH_USER']))
                    {
                        $headers['user'] = $_SERVER['PHP_AUTH_USER'];

                        if (isset($_SERVER['PHP_AUTH_PW']))
                            $headers['pass'] = $_SERVER['PHP_AUTH_PW'];
                    }
                    break;

                case "Bearer":
                    $headers['token'] = $parsed_auth[2];
                    break;
            }
        }
    }

    return $headers;
}
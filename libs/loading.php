<?php
//
define ('ERR_404', "err404");
define ('ERR_422', "err422");
//
define ('LOAD_REQUIRE', "r");
define ('LOAD_REQUIRE_ONCE', "ro");
define ('LOAD_INCLUDE', "i");
define ('LOAD_INCLUDE_ONCE', "io");

//
//
function path_convert($path, $handler_separator = "/", $needle_separator = DIRECTORY_SEPARATOR)
{
    return str_replace($handler_separator, $needle_separator, $path);
}
//
function path($path, $handler_separator = "/")
{
    return PHP_BASE . path_convert($handler_separator . $path, $handler_separator);
}
//
function load($filename, $loading, $exception_msg = null)
{
    if (!is_file($filename = path($filename)))
    {
        if ($exception_msg)
            load_err_register($exception_msg);

        return ERR_404;
    }

    switch ($loading)
    {
        case LOAD_REQUIRE:
            return require ($filename);

        case LOAD_REQUIRE_ONCE:
            return require_once $filename;

        case LOAD_INCLUDE:
            return include ($filename);

        case LOAD_INCLUDE_ONCE:
            return include_once $filename;

        default:
            load_err_register("The type of loading '$loading' does not allowed!", 422);
            return ERR_422;
    }
}

function load_php($php_script, $loading, $exception_msg = null)
{
    return load($php_script . ".php", $loading, $exception_msg);
}

function require_class($namespace)
{
    load_php(
        path_convert($namespace, "\\"),
        LOAD_REQUIRE_ONCE,
        "A class '$namespace' not found!");
}

function include_lib($libname)
{
    return load_php("libs/$libname", LOAD_INCLUDE_ONCE, "A lib '$libname' not found!");
}

function require_config($conf)
{
    return load_php("config/$conf", LOAD_REQUIRE, "Configuration file '$conf' not found!");
}
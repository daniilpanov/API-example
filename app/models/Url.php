<?php


namespace app\models;


use app\base\Model;

class Url extends Model
{
    public $host, $scheme,
        $user, $pass,
        $path_str, $path,
        $query_str, $query, $method;

    public function __construct($url)
    {
        $data = parse_url($url);

        $this->host = $data['host'];
        $this->scheme = $data['scheme'];

        $this->user = isset($data['user']) ? $data['user'] : null;
        $this->path = isset($data['pass']) ? $data['pass'] : null;

        $this->path_str = isset($data['path']) ? $data['path'] : null;
        $this->path = explode("/", $this->path_str);
        //
        array_shift($this->path);

        $this->query_str = isset($data['query']) ? $data['query'] : null;
        $this->query = explode("&", $this->query_str);
        //
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /** @var $instance self|null */
    private static $instance;

    public static function getUrl()
    {
        return (isset($_SERVER['HTTPS']) ? "https" : "http")
            . "://" . $_SERVER['HTTP_HOST']
            . $_SERVER['REQUEST_URI'];
    }

    public static function url($url)
    {
        return new self($url);
    }

    public static function init()
    {
        return self::$instance = self::url(self::getUrl());
    }

    public static function path($item = null)
    {
        if ($item === null || $item === false)
            return urldecode(self::$instance->path_str);

        if (!isset(self::$instance->path[$item]))
            return null;

        return urldecode(self::$instance->path[$item]);
    }

    public static function request($number = null)
    {
        if (!$number)
            return self::$instance->query_str;

        if (!isset(self::$instance->query[$number]))
            return null;

        return self::$instance->query[$number];
    }

    public static function host()
    {
        return self::$instance->host;
    }

    public static function scheme()
    {
        return self::$instance->scheme;
    }

    public static function user()
    {
        return self::$instance->user;
    }

    public static function pass()
    {
        return self::$instance->pass;
    }

    public static function method()
    {
        return self::$instance->method;
    }
}
<?php


namespace app\models;


use app\base\Model;

class Request extends Model
{
    public $controller, $url, $user;

    public function __construct($controller, $url, $user = "*")
    {
        $this->controller = $controller;
        $this->url = str_replace("/", "\/", $url);
        $this->user = $user;
    }

    public function check($url = null, $user = null)
    {
        if ($this->user != "*")
        {
            if ($this->user === "+" && $user === null)
                return false;
            elseif ($this->user === "-" && $user === null)
                return false;
            elseif ($user !== $this->user)
                return false;
        }

        if (!$url)
            return ($this->url === null) ? $this->controller : false;

        if (preg_match('/^' . $this->url . "$/", $url, $params))
            return [$this->controller, $params];

        return false;
    }
}
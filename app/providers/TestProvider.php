<?php


namespace app\providers;


use app\base\Provider;

class TestProvider extends Provider
{
    public function methodProvide($name, &$arguments)
    {
        if ($name == "trig")
        {

        }
    }

    public function varGetProvide($name)
    {

    }

    public function varSetProvide($name, &$value)
    {

    }
}
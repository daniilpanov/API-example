<?php


namespace app\base;


use app\factories\EventsFactory;
use app\factories\Factories;

abstract class Event extends BaseObj
{
    protected $controller, $method;

    public function __construct($controller, $method = null)
    {
        $this->controller = $controller;
        $this->method = $method;
    }

    protected function call($params = [])
    {
        $controller = Factories::controllers()->controller($this->controller);

        return ($this->method)
            ? $controller->{$this->method}(...$params)
            : $controller(...$params);
    }

    abstract public function trig($params = null);

    public static function addDefaultProvider($provider_class)
    {
        if (static::class === self::class)
            return;

        $providers = &EventsFactory::$default_providers;

        if (!isset($providers[static::class]))
            $providers[static::class] = [];

        $providers[static::class][] = $provider_class;
    }
}
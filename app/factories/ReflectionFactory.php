<?php


namespace app\factories;


use app\base\SingletonFactory;

class ReflectionFactory extends SingletonFactory
{
    public function getRef($class): \ReflectionClass
    {
        return $this->instance("\ReflectionClass", $class, [$class]);
    }

    public function createWithoutConstruct($class)
    {
        return $this->getRef($class)->newInstanceWithoutConstructor();
    }
}
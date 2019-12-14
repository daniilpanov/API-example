<?php


namespace app\factories;


use app\base\BaseObj;
use app\base\ScalableObj;
use app\base\SingletonFactory;

class Factories extends SingletonFactory
{
    /** @var $inst self|null */
    private static $inst;

    /**
     * @param $namespace string
     * @param $key string|int
     * @param $providers bool
     * @return object|BaseObj|ScalableObj
     */
    public static function get($namespace, $key, $providers = false)
    {
        $namespace = "\\app\\factories\\{$namespace}Factory";

        if (!isset(self::$inst))
            self::$inst = new self;

        return ($providers)
            ? self::$inst->providedInstance($namespace, $key)
            : self::$inst->instance($namespace, $key);
    }

    /**
     * @param $providers bool
     * @return ControllersFactory
     */
    public static function controllers($providers = false)
    {
        return self::get("Controllers", "controllers", $providers);
    }

    /**
     * @param $providers bool
     * @return ModelsFactory
     */
    public static function models($providers = false)
    {
        return self::get("Models", "models", $providers);
    }

    /**
     * @param $providers bool
     * @return ReflectionFactory
     */
    public static function reflection($providers = false)
    {
        return self::get("Reflection", "ref", $providers);
    }
}
<?php


namespace app\factories;


use app\base\BaseObj;
use app\base\ScalableObj;
use app\base\SingletonFactory;

class ControllersFactory extends SingletonFactory
{
    public static $default_provider;

    public function controllerProvided($controller)
    {
        $namespace = "\\app\\controllers\\$controller";

        /** @var $inst ScalableObj|BaseObj */
        $inst = parent::providedInstance($namespace, $controller);

        if (self::$default_provider)
        {
            if (is_string(self::$default_provider))
            {
                if ($inst->hasProvider(self::$default_provider) === false)
                    $inst->addProvider(new self::$default_provider());
            }
            elseif (is_array(self::$default_provider))
            {
                foreach (self::$default_provider as $item)
                {
                    if ($inst->hasProvider($item) === false)
                        $inst->addProvider(new $item());
                }
            }
        }

        return $inst;
    }

    public function controller($controller)
    {
        return parent::instance("\\app\\controllers\\$controller", $controller);
    }

    public function addDefaultProvider($clazz)
    {
        self::$default_provider[] = $clazz;
    }
}
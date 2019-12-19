<?php


namespace app\factories;


use app\base\Event;
use app\base\ScalableObj;

class EventsFactory extends MultiFactory
{
    public static $default_providers;

    public function createEvent($event_name, $params = [], $register = true)
    {
        $event = "app\\events\\$event_name";
        /** @var $instance Event|ScalableObj */
        $instance = $this->create($event, $params, $event_name, $register);

        if (self::$providing && self::$default_providers)
        {
            if (isset(self::$default_providers[$event]))
            {
                foreach (self::$default_providers[$event] as $provider_class)
                {
                    $provider = new $provider_class();
                    $instance->addProvider($provider);
                }
            }
        }

        return $instance;
    }

    public function createTrigger($trigger_for, $params = null)
    {
        $instances = $this->search($trigger_for);

        if (!$instances)
            return false;

        foreach ($instances as $instance)
        {
            if ($res = $instance->trig($params))
                return $res;
        }

        return false;
    }
}
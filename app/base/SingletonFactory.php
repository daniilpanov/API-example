<?php


namespace app\base;


class SingletonFactory extends BaseObj
{
    protected $instances = [];

    protected function instance($namespace, $key, $params = [])
    {
        if (!isset($this->instances['obj'][$key]))
        {
            $inst = $this->instances['obj'][$key] = new $namespace(...$params);
            if (method_exists($inst, "boot"))
                $inst->boot();
        }

        return $this->instances['obj'][$key];
    }

    protected function providedInstance($namespace, $key, $params = [])
    {
        if (!isset($this->instances['providing'][$key]))
        {
            $inst = $this->instances['providing'][$key] = new ScalableObj(new $namespace(...$params));
            if (method_exists($inst, "boot"))
                $inst->boot();
        }

        return $this->instances['providing'][$key];
    }
}
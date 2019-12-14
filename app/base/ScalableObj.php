<?php


namespace app\base;


class ScalableObj
{
    /** @var $obj BaseObj */
    private $obj;
    /** @var $providers Provider[] */
    private $providers = [];

    public function __construct(BaseObj $obj)
    {
        $this->obj = $obj;
    }

    public function __call($name, $arguments)
    {
        foreach ($this->providers as $provider)
        {
            if ($provider->methods == "*" || in_array($name, $provider->methods))
                $provider->methodProvide($name, $arguments);
        }

        return $this->obj->$name(...$arguments);
    }

    public function __get($name)
    {
        foreach ($this->providers as $provider)
        {
            if ($provider->vars == "*" || in_array($name, $provider->vars))
                $provider->varGetProvide($name);
        }

        return $this->obj->$name;
    }

    public function __set($name, $value)
    {
        foreach ($this->providers as $provider)
        {
            if ($provider->vars == "*" || in_array($name, $provider->vars))
                $provider->varSetProvide($name, $value);
        }

        $this->obj->$name = $value;
    }

    public function __invoke(...$arguments)
    {
        return $this->__call("__invoke", $arguments);
    }

    public function addProvider(Provider $provider)
    {
        $id = count($this->providers);
        $this->providers[$id] = $provider;
        $provider->on(get_class($this->obj), $id);

        return $id;
    }

    public function removeProvider($id)
    {
        if (!isset($this->providers[$id]))
            return false;

        unset($this->providers[$id]);
        return true;
    }

    public function hasProvider($provider_class)
    {
        foreach ($this->providers as $id => $provider)
        {
            if (get_class($provider) == $provider_class)
                return $id;
        }

        return false;
    }

    /**
     * @return BaseObj
     */
    public function getObj()
    {
        return $this->obj;
    }
}
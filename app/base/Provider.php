<?php


namespace app\base;


abstract class Provider
{
    /** @var $vars string[]|string */
    public $vars = "*";
    /** @var $methods string[]|string */
    public $methods = "*";
    /** @var $id int */
    private $id;
    /** @var $class string */
    private $class;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProvidingClass()
    {
        return $this->class;
    }

    //
    public function on($class, int $id)
    {
        $this->class = $class;
        $this->id = $id;
    }

    //
    abstract public function methodProvide($name, &$arguments);

    abstract public function varGetProvide($name);

    abstract public function varSetProvide($name, &$value);
}
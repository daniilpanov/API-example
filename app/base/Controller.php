<?php


namespace app\base;


use app\factories\Factories;

abstract class Controller extends BaseObj
{
    /**
     * @return self
     */
    public static function get()
    {
        $clazz = static::class;
        $clazz = explode("\\", $clazz);
        $clazz = end($clazz);

        return Factories::controllers()->controller($clazz);
    }
}
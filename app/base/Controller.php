<?php


namespace app\base;


use app\factories\Factories;

abstract class Controller extends BaseObj
{
    /**
     * @return static
     */
    public static function get()
    {
        $clazz = static::class;
        $clazz = explode("\\", $clazz);
        $clazz = end($clazz);

        return Factories::controllers()->controller($clazz);
    }

    public function call($request, $data)
    {
        $request = strtolower($request) . "Request";
        if (!method_exists($this, $request))
            return false;

        return $this->$request(...$data);
    }
}
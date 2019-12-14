<?php


namespace app\base;


abstract class Model extends BaseObj
{
    const RETURN = -1;

    private $group = null;

    /**
     * @param $group string|int|null
     * @return string|int|null|void
     */
    public function group($group = self::RETURN)
    {
        if ($group === self::RETURN)
            return $this->group;

        $this->group = $group;
    }

    public function setData($data_arr)
    {
        if (!$data_arr)
            return;

        if (is_assoc($data_arr))
        {
            foreach ($data_arr as $col => $value)
            {
                $this->$col = $value;
            }
        }
        else
        {
            $cols = array_keys(get_object_vars($this));

            for ($i = 0; $i < count($data_arr); $i++)
            {
                $col = $cols[$i];
                $this->$col = $data_arr[$i];
            }
        }
    }
}
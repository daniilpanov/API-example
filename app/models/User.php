<?php


namespace app\models;


use app\base\Model;

class User extends Model
{
    const CREATE = "c", SIGNIN = "si",
        DELETE = "d", PATCH = "p";

    public
        //
        $login,
        $password,
        //
        $mission,
        $status,
        //
        $info = null;

    public function __construct($login, $password, $mission)
    {
        //
        $this->login = $login;
        $this->password = $password;
        //
        $this->mission = $mission;
    }

    public function init()
    {
        switch ($this->mission)
        {
            case self::CREATE:

                break;

            case self::SIGNIN:

                break;

            case self::DELETE:

                break;

            case self::PATCH:

                break;

            default:
                
                break;
        }
    }
}
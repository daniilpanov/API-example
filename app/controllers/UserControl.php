<?php


namespace app\controllers;


use app\base\Controller;
use app\factories\Factories;
use app\models\Response;
use app\models\User;

class UserControl extends Controller
{
    public $auth = false;

    public function authBasic($login, $pass)
    {
        /** @var $user User */
        $user = Factories::models()->createIfNotExists("User");

        if ($user->signin($login, $pass))
        {
            $_SESSION['user'] = $user;
            (new Response(200, ['id' => $user->id, 'token' => $user->token]))->init();
            return true;
        }
        else
        {
            (new Response(
                401,
                [
                    'login' => $user->login,
                    'password' => $user->password,
                    'msg' => "Incorrect login or password"
                ])
            )->init();

            return false;
        }
    }

    public function authBearer($token)
    {
        $user = $_SESSION['user'];

        return ($this->auth = ($user->token !== null && $token === $user->token));
    }
}
<?php


namespace app\models;


use app\base\Model;
use app\controllers\DbController;

class User extends Model
{
    public
        //
        $id = null,
        //
        $login = null,
        $password = null,
        //
        $token = null;

    public function signup()
    {

    }

    public function delete()
    {

    }

    public function patch($password)
    {

    }

    public function signin($login, $password)
    {
        //
        $this->login = $login;
        $this->password = password($password);

        $user = DbController::get()
            ->query(
                "SELECT * FROM users WHERE login=:l AND password=:p",
                ['l' => $this->login, 'p' => $this->password]
            );

        if (!$user)
            return false;

        $user = $user->fetch();

        if (!$user)
            return false;

        $this->id = $user['id'];
        // TODO: Token generation
        $this->token = "";

        return true;
    }

    public function signout()
    {
        if (!isset($_SESSION['user']))
        {
            (new Response(401))->init();
            return;
        }

        (new Response(200, $_SESSION['user']))->init();
        unset($_SESSION['user']);
    }
}
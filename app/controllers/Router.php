<?php


namespace app\controllers;


use app\base\Controller;
use app\models\Response;
use app\models\Url;
use app\factories\Factories;

class Router extends Controller
{
    public function route()
    {
        $user = isset($_SESSION['user']) ? $_SESSION['user']->login : null;

        if ($auth = getAuthorizationHeader())
        {
            if ($auth['type'] == "Basic")
                var_dump(UserControl::get()->authBasic($auth['login'], $auth['pass']));
            elseif ($auth['type'] == "Bearer")
                var_dump(UserControl::get()->authBearer($auth['token']));
        }
        else
        {
            $registered_requests = Factories::models()->searchModel("Request");

            foreach ($registered_requests as $registered_request)
            {
                if ($c = $registered_request->check(Url::getFullPath(), $user))
                {
                    list($controller, $data) = $c;
                    $controller = $controller::get();

                    if ($controller->call($_SERVER['REQUEST_METHOD'], $data) === false)
                        (new Response(400, ['message' => "Error"]))->init();
                }
            }
        }
    }
}
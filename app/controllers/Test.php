<?php


namespace app\controllers;


use app\base\Controller;
use app\models\Response;

class Test extends Controller
{
    public function getRequest()
    {
        (new Response(200, "GET"))->init();
    }

    public function postRequest()
    {
        (new Response(200, "POST"))->init();
    }
}
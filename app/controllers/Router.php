<?php


namespace app\controllers;


use app\base\Controller;
use app\models\Url;

class Router extends Controller
{
    /** @var $url Url|null */
    private $url;

    public function boot()
    {
        $this->url = Url::init();
    }

    public function test()
    {
        echo Url::path();
    }
}
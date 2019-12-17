<?php


namespace app\controllers;


use app\base\Controller;
use app\models\Routing;
use app\models\Url;

class Router extends Controller
{
    /** @var $url Url|null */
    private $url;
    /** @var $routes Routing[]|null */
    private $routes;


}
<?php

use app\models\Url;


Url::init();

function request($controller, $url)
{
    $url = "http://localhost/api-example" . $url;

    \app\factories\Factories::models()
        ->createModel(
            "Request",
            ["\\app\\controllers\\$controller", $url]
        );
}

request("Test", "/");
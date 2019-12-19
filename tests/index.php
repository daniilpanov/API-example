<?php
//
require_once "../index.php";

/*\app\factories\Factories::events()
    ->createEvent("Request", ["DbController", "http:\/\/localhost\/api-example\/tests\/", "ok"]);

\app\factories\Factories::events()->createTrigger("Request", \app\models\Request::getFullPath());*/

(new \app\models\Response(200, ["message" => "HELLO!"]))->header("json", "Content-Type")->init();
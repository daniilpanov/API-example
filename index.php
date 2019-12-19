<?php
//
include_once "libs/logging.php";
//
include_once "libs/loading.php";
//
$config = require ("config/base.php");
//
define('PHP_BASE', $config['doc_root']);
//
include_lib("helpers");
//
include_lib("auth");
//
require_config("autoload");
//
require_config("phpconfig");
//
$connection = \app\factories\Factories::models()
    ->createModel(
        "Connection",
        ["localhost", "test", "php", "12345"]
    );
$connection->connect();

\app\controllers\DbController::get()
    ->init($connection);
//
require_config("routing");

\app\controllers\Router::get()->route();
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
require_config("autoload");
//
require_config("phpconfig");
//
require_config("routing");

require_config("fgdgb");
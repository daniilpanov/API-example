<?php
// It is a tmp router
// The next router will be released by class Router
use app\models\Url;

//
Url::init();
//
$url = Url::getFullPath();

//
switch ($url)
{

}
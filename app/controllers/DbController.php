<?php


namespace app\controllers;


use app\base\Controller;

class DbController extends Controller
{
    /**
     * @param $sql
     * @param array $params
     * @return \PDOStatement|bool|null
     */
    public function query($sql, $params = [])
    {

    }
}
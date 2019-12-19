<?php


namespace app\controllers;


use app\base\Controller;
use app\models\Connection;

class DbController extends Controller
{
    private $connection;

    public function init(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param $sql
     * @param array $params
     * @return \PDOStatement|bool|null
     */
    public function query($sql, $params = [])
    {
        return $this->connection->query($sql, $params);
    }

    /**
     * @param $sql
     * @param array $params
     * @return array|mixed|bool|null
     */
    public function queryAndFetch($sql, $params = [])
    {
        $res = $this->query($sql, $params);

        if ($res)
            $res = $res->fetchAll();

        return $res;
    }
}
<?php


namespace app\models;


use app\base\Model;

class Connection extends Model
{
    public $host, $db_name;
    public $user, $password;
    public $charset, $options = [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];
    //
    public $connection_handler;

    public function __construct($host, $db_name, $user, $password = null, $charset = "utf8")
    {
        $data = func_get_args();
        if (!isset($data[3]))
            $data[3] = null;
        if (!isset($data[4]))
            $data[4] = "utf8";

        $this->setData($data);
    }

    public function connect()
    {
        try
        {
            $this->connection_handler = new \PDO(
                "mysql:host=" . $this->host
                . ";dbname=" . $this->db_name
                . ";charset=" . $this->charset,
                $this->user,
                $this->password,
                $this->options
            );

            $this->query("SET NAMES :ch", ['ch' => $this->charset]);
        }
        catch (\PDOException $exception)
        {
            (new Response(500, ['exception_msg' => $exception->getMessage()]))->init();
        }
    }

    public function query($sql, $params = [])
    {
        if ($params)
        {
            $sth = $this->connection_handler->prepare($sql);
            $sth->execute($params);
            return $sth;
        }
        else
            return $this->connection_handler->query($sql);
    }
}
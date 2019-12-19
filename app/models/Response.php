<?php


namespace app\models;


use app\base\Model;

class Response extends Model
{
    const STATUSES_TABLE = [
        200 => "OK",
        201 => "Created",
        301 => "Moved Permanently",
        302 => "Moved Temporarily",
        400 => "Bad Request",
        401 => "Unauthorized",
        403 => "Forbidden",
        404 => "Not Found",
        422 => "Unprocessable Entity",
        500 => "Internal Server Error",
        502 => "Bad Gateway",
    ];

    public $headers, $data;

    public function __construct($status, $data = null)
    {
        //
        $this->data = $data;
        //
        $this->headers[$_SERVER['SERVER_PROTOCOL']]
            = $status
            . (isset(self::STATUSES_TABLE[$status])
                ? self::STATUSES_TABLE[$status]
                : ""
            );
    }

    public function header($header, $key = null)
    {
        if ($key === null)
            $key = count($this->headers);
        $this->headers[$key] = $header;
        return $this;
    }

    public function init()
    {
        foreach ($this->headers as $key => $header)
        {
            header(
                (is_string($key)
                    ? ($key . ": ")
                    : ""
                ) . $header
            );
        }

        if ($this->data)
            echo json_encode($this->data);
    }
}
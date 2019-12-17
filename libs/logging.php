<?php
//
function logger($msg, $type, $status = 404)
{
    $log_file = path("files/dumps_n_logs/loading.log");

    if (!is_file($log_file))
    {
        if (!$file = fopen($log_file, "w"))
        {
            if (!is_dir(path("files/")))
            {
                mkdir("files");
                mkdir("files/dumps_n_logs");
            }

            $file = fopen($log_file, "w");
        }

        fwrite($file, "");
        flush();
        fclose($file);

        $content = "";
    }
    else
    {
        $content = file_get_contents($log_file);
    }

    $date = date("d.m.Y");
    $time = date("H:i:s");

    file_put_contents($log_file, "$type $status -- $msg (at $date, $time)\r\n$content");
}

//
function load_err_register($exception, $status = 404)
{
    logger("Loading failed: " . $exception, "error", $status);
}

function user_change_action_register(\app\models\User $user)
{

}
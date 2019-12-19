<?php
//
//
function is_assoc($array)
{
    foreach ($array as $key => $element)
    {
        if (is_numeric($key))
            return false;
    }

    return true;
}

//
function password($password)
{
    return md5(
        md5("nnnadieij43509==-akwjJOSJA")
        . md5($password)
        . md5("kkHHHsioqi12jHhjk/;l=-JSPIJoijdks")
    );
}
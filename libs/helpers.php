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
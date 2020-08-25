<?php

namespace App\API;

class ApiError
{
    public static function errorMessage($msg, $code)
    {
        return [
            'msg' => $msg,
            'code' => $code
        ];
    }
}

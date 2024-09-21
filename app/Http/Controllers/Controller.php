<?php

namespace App\Http\Controllers;


use App\Jobs\SendSms;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generatePassword()
    {
        $password = "";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $chars_length = strlen($chars);
        for ($i = 0; $i < 8; $i++) {
            $password .= $chars[rand(0, $chars_length - 1)];
        }
        return $password;
    }
}

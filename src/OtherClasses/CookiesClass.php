<?php

namespace Blog\OtherClasses;

class CookiesClass
{
    public function getRegCookie()
    {
        $regCookie = $_COOKIE['reg'] ?? 'false';

        return $regCookie;
    }

    public function getUsernameCookie(): string
    {
        if ($_COOKIE['user'] == 'true')
            $usernameCookie = 'true';
        else
            $usernameCookie = 'false';

        return $usernameCookie;
    }


}
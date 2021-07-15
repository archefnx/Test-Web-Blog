<?php

namespace Blog\OtherClasses;

class CookiesClass
{
    private bool $usernameCookie;
    private bool $regCookie;

    /**
     * @return bool|mixed
     */
    public function getRegCookie(): bool
    {
        $_COOKIE['user'] == '' ? $this->usernameCookie = false : $this->usernameCookie = true;

        return $this->regCookie;
    }

    /**
     * @return bool
     */
    public function getUsernameCookie(): bool
    {
        $this->regCookie = $_COOKIE['reg'];

        return $this->usernameCookie;
    }


}
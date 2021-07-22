<?php

namespace Blog\OtherClasses;

class CookiesClass
{
    private bool $usernameCookie;
    private bool $regCookie;

    public function getRegCookie()
    {
        $this->regCookie = $_COOKIE['reg'] ?? 'false';

        return $this->regCookie;
    }

    /**
     * @return bool
     */
    public function getUsernameCookie(): bool
    {
        $_COOKIE['user'] == '' ? $this->usernameCookie = false : $this->usernameCookie = true;

        return $this->usernameCookie;
    }


}
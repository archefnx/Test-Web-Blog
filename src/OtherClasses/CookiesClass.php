<?php

namespace Blog\OtherClasses;

class CookiesClass
{
    private bool $usernameCookie;
    private bool $regCookie;

<<<<<<< HEAD
    public function getRegCookie()
    {
        $this->regCookie = $_COOKIE['reg'] ?? 'false';
=======
    /**
     * @return bool|mixed
     */
    public function getRegCookie(): bool
    {
        $_COOKIE['user'] == '' ? $this->usernameCookie = false : $this->usernameCookie = true;
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57

        return $this->regCookie;
    }

    /**
     * @return bool
     */
    public function getUsernameCookie(): bool
    {
<<<<<<< HEAD
        $_COOKIE['user'] == '' ? $this->usernameCookie = false : $this->usernameCookie = true;
=======
        $this->regCookie = $_COOKIE['reg'];
>>>>>>> f7cbf4fd4aeb636651e7ffe8e226cd2cac045d57

        return $this->usernameCookie;
    }


}
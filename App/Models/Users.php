<?php


namespace App\Models;


class Users
{
    public function setCookiePass()
    {
        $password = $this->createPassword();
        setcookie("user_pass", $password, time() + 3600 * 24 * 365 * 10);
        return $password;
    }

    //метод генерирующий пароль и возвращающий его
    protected function createPassword()
    {
        // Символы, которые будут использоваться в пароле.
        $chars='qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP';
        // Количество символов в пароле.
        $max=32;
        // Определяем количество символов в $chars
        $size=StrLen($chars)-1;
        // Определяем пустую переменную, в которую и будем записывать символы.
        $password=null;
        // Создаём пароль.
        while($max--)
            $password.=$chars[rand(0,$size)];

        return $password;
    }
}
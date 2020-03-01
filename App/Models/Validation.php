<?php


namespace App\Models;


class Validation
{
    public static $errors = [];

    // метод который нам возвращает одну запись по email для валидации
    public static function validate($student)
    {
        foreach ($student as $name => $value) {
            if ('last_name' == $name) {
                if ( iconv_strlen($value) > 200 ) {
                    static::$errors[$name] = 'Фамилия должна быть не более 200 символов, вы ввели '.iconv_strlen($value);
                    //дать ошибку если фамилия более 200 символов
                }
            }
            if ('groupe' == $name) {
                if (iconv_strlen($value) > 5 || iconv_strlen($value) < 2 ) {
                    static::$errors[$name] = 'Группа должна быть от 2 до 5 символов, вы указали '.iconv_strlen($value);
                    //дать ошибку группа указана не верно
                }
            }
            if ('exam' == $name) {
                if ( $value > 300 ) {
                    static::$errors[$name] = 'К-во баллов по ЕГЭ должно быть не более 300, вы указали '.$value;
                    //дать ошибку что к-во баллов указано не верно
                }
            }
            if ('email' == $name) {
                if ( !filter_var($value, FILTER_VALIDATE_EMAIL) ) {
                    static::$errors[$name] = 'Email введен не корректно. Корректный email вида "pupkin@mail.ru" ';
                    //дать ошибку что email кривой
                }
                if (Students::getRegisterUser($value)) {
                    static::$errors[$name] = '"pupkin@mail.ru" уже используется, зарегистрируйтесь под другим адресом';
                }
            }

        }

        if (!empty( static::$errors )) {
            return static::$errors;
        }
    }

}
<?php


namespace App\Models;

use App\Db;
use App\Model;

class Students extends Model
{
    // cтатичное свойство с названием таблицы
    public static $table = 'students';

    //свойства кроме id, т.к. это свойство есть в абстрактном классе
    public $first_name;
    public $last_name;
    public $gender;
    public $groupe;
    public $email;
    public $exam;
    public $birthday;
    public $resident;
    public $user_pass;

    // метод который нам возвращает одну запись по email для валидации
    public static function getRegisterUser($email)
    {
        //создаем объект класса базы данных
        $db = new Db();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE email=:email',
            static::class,/*у каждого класса есть специальная константа class которая содержит его имя: 1)Students::class 2) self::class - этот класс в котором код написан 3)static::class - класс, который вызывает(позднее статическое связывание) )*/
            [':email' => $email]
        );
        if (!empty($data)) {
            //если данные не пустые то возвращаем 0 объект массива $data (чтобы избавиться от массива с 1 объектом возвращаем просто 1 объект)
            return $data[0];
        }
        //иначе возвращаем null если пришли какие-то не те данные
        return null;
    }



}
<?php


namespace App\Controllers;


use App\Controller;
use App\Models\Students;

class Personal extends Controller
{
    //контроллер выполняет одно действие (выводит данные о студенте на странице регистрации для обновления данных)
    public function action()
    {
        if (!empty($_COOKIE['user_pass'])) {
            $user_pass = $_COOKIE['user_pass'];
        }
        $this->view->student = Students::findByCookiePass($user_pass);

        //подготавливаем ответ сохраняя в переменную $contents (используя буфферизацию)
        $contents = $this->view->render(__DIR__ . '/../Templates/registration.php');
        //подготавливаем ответ сохраняя в переменную $contents (для удобного вывода в нужном нам месте кода)
        echo $contents;
    }
}
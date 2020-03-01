<?php

namespace App\Controllers;

use App\Controller;

class Registration extends Controller
{

    //контроллер выполняет одно действие (выводим весь список студентов)
    public function action()
    {
        //подготавливаем ответ сохраняя в переменную $contents (используя буфферизацию)
        $contents = $this->view->render(__DIR__ . '/../Templates/registration.php');
        //подготавливаем ответ сохраняя в переменную $contents (для удобного вывода в нужном нам месте кода)
        echo $contents;
    }
}
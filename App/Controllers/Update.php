<?php


namespace App\Controllers;


use App\Controller;
use App\Models\Students;

class Update extends Controller
{
    //контроллер выполняет одно действие (обновляем запись зарегистрированного пользователя)
    public function action()
    {
        if (!empty($_POST)) {
            $student = new Students();
            foreach ($_POST as $name => $value) {
                $student->$name = $value;
            }

            $student->update($_COOKIE['user_pass']);
            header('Location: /');
            exit;
        }
    }
}
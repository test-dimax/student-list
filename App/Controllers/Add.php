<?php


namespace App\Controllers;

use App\Models\Students;
use App\Models\Users;
use App\Models\Validation;
use App\View;

class Add
{
    //контроллер выполняет одно действие (добавляет запись в список студентов)
    public function action()
    {
        if (!empty($_POST)) {

            $student = new Students();
            foreach ($_POST as $name => $value) {
                $student->$name = trim($value);
            }

            //проходим валидацию
            $errors = Validation::validate($student);

            if (!empty($errors)) {
                //если были найдены ошибки то создаем объект представления и выводим ошибки и вводимые значения пользователем
                $this->view = new View();
                $this->view->student = $student;
                $this->view->errors = $errors;
                //подготавливаем ответ сохраняя в переменную $contents (используя буфферизацию)
                $contents = $this->view->render(__DIR__ . '/../Templates/registration.php');
                //подготавливаем ответ сохраняя в переменную $contents (для удобного вывода в нужном нам месте кода)
                echo $contents;
            } else {
                $user_pass = new Users();
                $password = $user_pass->setCookiePass();
                $student->user_pass = $password;
                $student->insert();
                header('Location: /thanks.php');
                exit;
            }
        }
    }
}
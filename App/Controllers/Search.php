<?php


namespace App\Controllers;


use App\Controller;
use App\Models\Students;

class Search extends Controller
{
    //контроллер выполняет одно действие (ищет в базе заданый текст)
    public function action()
    {
        if (!empty($_POST)) {
            $text = trim(htmlspecialchars($_POST['text']));
            $student = new Students;

            $this->view->students = $student->getSearch($text);
            //подготавливаем ответ сохраняя в переменную $contents (используя буфферизацию)
            $contents = $this->view->render(__DIR__ . '/../Templates/index.php');
            //подготавливаем ответ сохраняя в переменную $contents (для удобного вывода в нужном нам месте кода)
            echo $contents;
        } else {
            header('Location: /');
            exit;
        }
    }
}
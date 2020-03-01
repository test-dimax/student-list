<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Students;

class Index extends Controller
{
    //контроллер выполняет одно действие (выводим весь список студентов)
    public function action()
    {

        if ( !empty($_GET['page']) ) {
            $this->view->page = htmlspecialchars($_GET['page']);
        } else {
            $this->view->page = 1;
        }
        if ( !empty($_GET['sorter']) ) {
            $this->view->sorter = htmlspecialchars($_GET['sorter']);
        } else {
            $this->view->sorter = 'exam';
        }

        // вызываем статичный метод getPageCount чтобы получить к-во страниц в пагинации
        $this->view->pager = Students::getPageCount();

        // вызываем статичный метод findAllByParams (не создавая объект) и получаем массив объектов
        $this->view->students = Students::findAllByParams($this->view->sorter, $this->view->page);

        // вызываем статичный метод findAll (не создавая объект) и получаем массив объектов
//        $this->view->students = Students::findAll();
        //подготавливаем ответ сохраняя в переменную $contents (используя буфферизацию)
        $contents = $this->view->render(__DIR__ . '/../Templates/index.php');
        //подготавливаем ответ сохраняя в переменную $contents (для удобного вывода в нужном нам месте кода)
        echo $contents;
    }
}
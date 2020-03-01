<?php


namespace App;
use App\View;


abstract class Controller
{

    protected $view;

    public function __construct()
    {
        //создаем объект представления
        //создавая объект View в конструкторе абстрактном классе
        // контроллера мы создаем зависимость от класса View
        //что значит что у всех контроллеров есть класс View
        $this->view = new View();
    }

    //у всех контроллеров должен быть публичный метод action();
    abstract public function action();
}
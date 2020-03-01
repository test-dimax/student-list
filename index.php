<?php

    //автозагрузка
    require __DIR__ . '/autoload.php';

    //определяем какой контроллер запускать
    $ctrl = new \App\Controllers\Index();
    //вызываем метод контроллера
    $ctrl->action();
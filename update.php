<?php

//автозагрузка
require __DIR__ . '/autoload.php';

//определяем какой контроллер запускать
$ctrl = new \App\Controllers\Update();
//вызываем метод контроллера
$ctrl->action();
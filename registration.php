<?php

//автозагрузка
require __DIR__ . '/autoload.php';

//если пользователь авторизован, то даем возможность редактировать запись
if (!empty($_COOKIE['user_pass'])) {
    $ctrl = new \App\Controllers\Personal();
    $ctrl->action();
} else {
    $ctrl = new \App\Controllers\Registration();
    //вызываем метод контроллера
    $ctrl->action();
}







<?php

    function __autoload($class)
    {
        //текущая папка/возьми имя класса, замени обратные слэши на прямые/добавь .php
        require __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    }

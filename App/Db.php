<?php

namespace App;

class Db
{
    // data base handler
    protected $dbh;

     public function __construct()
     {
         // устанавливаем соединение с базой данных
         $dsn = 'mysql:host=localhost;dbname=student';
         $this->dbh = new \PDO($dsn, 'root', '');
     }

    // метод принимающий запрос и возвращает его результат
    public function query(string $sql, string $class, array $data = [])
    {
        // statement handler подготавливаем запрос к исполнению
        $sth = $this->dbh->prepare($sql);
        // исполняем подготовленый запрос
        $sth->execute($data);
        // получаем данные из db c помощью константы FETCH_CLASS мы получаем результат в виде объекта класса $class
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    // метод выполняющий запрос и не возвращающий данные
    public function execute(string $sql, array $data = [])
    {
        // statement handler подготавливаем запрос к исполнению
        $sth = $this->dbh->prepare($sql);
        // исполняем подготовленый запрос
        return $sth->execute($data);
    }

    // метод выполняющий запрос и считающий к-во записей в таблице
    public function queryRowCount(string $sql, array $data = [])
    {
        // statement handler подготавливаем запрос к исполнению
        $sth = $this->dbh->prepare($sql);
        // исполняем подготовленый запрос
        $sth->execute($data);
        // возвращаем результат
        return $sth->fetchAll();
    }

    // метод возвращающий последний вставленный id
    public function lastInsertId()
    {
        // lastInsertId метод класса PDO возвращающий последний вставленный id
        return $this->dbh->lastInsertId();
    }
}
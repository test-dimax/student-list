<?php


namespace App;

//создаем абстрактный класс (его объекты невозможно создать, он предназначается для наследования)
abstract class Model
{
    // cтатичное свойство с названием таблицы
    public static $table = null;

    public $id;

    //метод который делает запись в базу данных
    public function insert()
    {
        //получаем все поля которые нам надо внести в базу данных (список свойств объекта)
        $props = get_object_vars($this);
        //создаем пустой массив в который будем добавлять поля которые нам нужны
        $fields = [];
        //создаем пустой массив в который будем добавлять вставки/подстановки для заносимых в базу данных значений
        $binds = [];
        //создаем пустой массив в который будем добавлять данные которые будем подставлять в запрос
        $data = [];
        foreach ($props as $name => $value) {
            //поле id пропускаем, т.к. его не надо вносить в базу данных
            if ('id' == $name) {
                continue;
            }
            $fields[] = $name;
            $binds[] = ':' . $name;
            $data[':' . $name] = $value;
        }
        $sql = 'INSERT INTO ' . static::$table . '
        (' . implode(',', $fields) . ')  
        VALUES (' . implode(',', $binds) . ')';
//        var_dump($sql);

        //создаем объект класса базы данных
        $db = new Db();
        //выполняем запрос подставляя данные
        $db->execute($sql, $data);
        //вызываем метод который даст нам последний вставленный id, т.к. в базу мы не вставляли его он AI
        $this->id = $db->lastInsertId();
    }


    //метод который редактирует/обновляет запись в базу данных
    public function update($user_pass)
    {
        //получаем все поля которые нам надо внести в базу данных (список свойств объекта)
        $props = get_object_vars($this);
        //создаем пустой массив в который будем добавлять вставки/подстановки для заносимых в базу данных значений
        $binds = [];
        //создаем массив в который будем добавлять данные которые будем подставлять в запрос
        $data = [':user_pass' => $user_pass];

        foreach ($props as $name => $value) {

            //поле id пропускаем, т.к. его не надо вносить в базу данных
            if ('id' == $name || 'user_pass' == $name) {
                continue;
            }
            $binds[] = $name . '=:' . $name;
            $data[':' . $name] = $value;
        }

        $sql = 'UPDATE ' . static::$table . '
        SET ' . implode(',', $binds) . '  
        WHERE user_pass=:user_pass';

        //создаем объект класса базы данных
        $db = new Db();
        //выполняем запрос подставляя данные
        $db->execute($sql, $data);
    }

    // метод который нам возвращает одну запись по id
    public static function findById($id)
    {
        //создаем объект класса базы данных
        $db = new Db();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE id=:id',
            static::class,/*у каждого класса есть специальная константа class которая содержит его имя: 1)Students::class 2) self::class - этот класс в котором код написан 3)static::class - класс, который вызывает(позднее статическое связывание) )*/
            [':id' => $id]
        );
        if (!empty($data)) {
            //если данные не пустые то возвращаем 0 объект массива $data (чтобы избавиться от массива с 1 объектом возвращаем просто 1 объект)
            return $data[0];
        }
        //иначе возвращаем null если пришли какие-то не те данные
        return null;
    }

    // метод который нам возвращает одну запись по паролю из кук
    public static function findByCookiePass($user_pass)
    {
        //создаем объект класса базы данных
        $db = new Db();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE user_pass=:user_pass',
            static::class,/*у каждого класса есть специальная константа class которая содержит его имя: 1)Students::class 2) self::class - этот класс в котором код написан 3)static::class - класс, который вызывает(позднее статическое связывание) )*/
            [':user_pass' => $user_pass]
        );
        if (!empty($data)) {
            //если данные не пустые то возвращаем 0 объект массива $data (чтобы избавиться от массива с 1 объектом возвращаем просто 1 объект)
            return $data[0];
        }
        //иначе возвращаем null если пришли какие-то не те данные
        return null;
    }

    // статичный метод который будет возвращать все записи из нужной нам таблицы
    public static function findAll() {
        //создаем объект класса базы данных
        $db = new Db();
        $data = $db->query(
            'SELECT * FROM ' . static::$table,
            static::class/*у каждого класса есть специальная константа class которая содержит его имя: 1)Students::class 2) self::class - этот класс в котором код написан 3)static::class - класс, который вызывает(позднее статическое связывание) )*/
        );
        return $data;
    }

    // статичный метод который будет возвращать записи из нужной нам таблицы c дополнительными параметрами limit order
    public static function findAllByParams(string $sorter, int $page) {
        $limit = 20;
        $offset = ($page - 1) * 20;
        //создаем объект класса базы данных
        $db = new Db();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' ORDER BY ' . $sorter . ' ASC LIMIT ' . $limit . ' OFFSET ' . $offset,
            static::class/*у каждого класса есть специальная константа class которая содержит его имя: 1)Students::class 2) self::class - этот класс в котором код написан 3)static::class - класс, который вызывает(позднее статическое связывание) )*/
        );

        return $data;
    }

    // статичный метод который будет искать по заданному тексту в таблице записи (поиск)
    public function getSearch($text) {
        //создаем объект класса базы данных
        $db = new Db();
        $props = get_object_vars($this);
        $like = [];
        $first = true;
        foreach ($props as $prop => $value) {
            if ($first) {
                $like[] = $prop . ' LIKE \'%' . $text . '%\'';
                $first = false;
            } else {
                $like[] = ' OR ' . $prop . ' LIKE \'%' . $text . '%\' ';
            }
        }
//        var_dump('SELECT * FROM ' . static::$table . ' WHERE ' . implode("", $like));
        $data = $db->query(
            'SELECT * FROM ' . static::$table . ' WHERE '  . implode("", $like),
            static::class/*у каждого класса есть специальная константа class которая содержит его имя: 1)Students::class 2) self::class - этот класс в котором код написан 3)static::class - класс, который вызывает(позднее статическое связывание) )*/
        );
        return $data;
    }

    public static function getPageCount() {
        $db = new Db();
        $data = $db->queryRowCount(
            'SELECT COUNT(*) FROM ' . static::$table
        );
        return ceil($data[0][0] / 20);
    }
}
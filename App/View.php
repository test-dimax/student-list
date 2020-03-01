<?php


namespace App;


class View
{
    //массив для хранения данных
    protected $data = [];

    //применяем __set __get __isset только тогда когда нам надо создавать свойства
    //магический метод вызывается когда идет обращение к несуществующему/недоступного свойству
    public function  __set($name, $value)
    {
        //
        $this->data[$name] = $value;
    }
    //магический метод который вызывается когда пытаемся прочитать значение несуществующего/недоступного свойства
    public function __get($name)
    {
        //
        return $this->data[$name];
    }
    //магический метод который возвращает true или false если с нашей точки зрения есть свойство
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function display($template)
    {
        //$this->data['students'] - так будут доступны данные в шаблоне
        foreach ($this->data as $index => $value) {
            //создаем переменную с именем значения переменной $index (переменная переменной)
            //$$index = $['students'] = $news
            $$index = $value;
        }
        include $template;
    }

    //метод создаст ответ без его отправки
    public function render($template)
    {
        //стартуем буфферизацию вывода (останавливает весь вывод клиенту и организует буфер)
        ob_start();
        $this->display($template);
        //получаем что накопилось в буфере на текущий момент
        $contents = ob_get_contents();
        //очищаем буфер
        ob_end_clean();
        //возвращаем данные
        return $contents;
    }

}
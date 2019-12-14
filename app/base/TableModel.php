<?php


namespace app\base;


abstract class TableModel extends Model
{
    // Обязательные колонки
    public $cols;

    // Метод, возвращающий SQL-шаблон ( "<col>" )
    abstract public function getSQL();
}
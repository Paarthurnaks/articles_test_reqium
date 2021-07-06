<?php

/**
 * Интерфейс для создания ORM сущностей
 */

namespace App\Interfaces;

interface DataManagerInterface
{
    public static function getTableName() ;
    public static function add($arFields) ;
    public static function update($arFields) ;
    public static function delete($id) ;
    public static function getList($order, $select, $filter, $limit) ;
    public static function getById($id) ;
}

<?php

/**
 * Какое-то подобие ORM для таблицы Links
 */

namespace App\Classes;

require_once("DataManagerInterface.php");

use App\Interfaces\DataManagerInterface;

class ArticlesTable implements DataManagerInterface
{
    /**
     * Возвращает имя таблицы
     * @return string
     */
    public static function getTableName ()
    {
        return 't_articles';
    }

    /**
     * Возвращает поля таблицы
     * @return string[]
     */
    public static function getMap()
    {
        return array(
            'ID', 'TITLE', 'DESCRIPTION', 'CATEGORY_ID', 'DATE_CREATE', 'DATE_UPDATE', 'AUTHOR_ID', 'KEYWORDS', 'IMAGE'
        );
    }

    /**
     * Добавляет запись в таблицу
     * @param $arFields
     *
     * Принимает массив вида
     * array( 'fields' => array( 'someField' => 'someValue' ) )
     */
    public static function add($arFields)
    {
        $map = static::getMap();
        $sql = "INSERT INTO " . static::getTableName() . ' (';
        $valuesForSql = '';

        $now = date('Y-m-d h:i:s');

        $arFields['fields']['DATE_CREATE'] = $now;
        $arFields['fields']['DATE_UPDATE'] = $now;

        foreach ($map as $key => $value) {
            if ($value != 'ID') {
                if (!isset($arFields['fields'][$value])){
                    echo "Отсутствует поле \"".$value."\"" ;
                    die;
                }
                else {
                    if ($value == end($map)) {
                        $sql .= $value . ') ';
                        $valuesForSql .= '"' . $arFields['fields'][$value] . '") ';
                    }
                    else {
                        $sql .= $value . ',';
                        $valuesForSql .= '"' . $arFields['fields'][$value] . '",';
                    }
                }
            }
        }

        $sql .= ' VALUES ('.$valuesForSql;

        $result = \App\Classes\DB::getConnection()->query($sql);

        return $result;
    }

    /**
     * Обновляет запись в таблице
     * @param $arFields
     * @return bool|\mysqli_result|string
     *
     *  Принимает массив вида
     * array( 'id' => '1', 'fields' => array( 'someField' => 'someValue' ) )
     */
    public static function update($arFields)
    {
        $map = static::getMap();
        $sql = 'UPDATE ' . static::getTableName() . ' SET ';

        if (!isset($arFields['id'])){
            return "Отсутствует поле id";
        }

        if (isset($arFields['fields']['DATE_CREATE']))
            unset($arFields['fields']['DATE_CREATE']);

        $arFields['fields']['DATE_UPDATE'] = date('Y-m-d h:i:s');

        foreach ($arFields['fields'] as $key => $value) {
            if (in_array($key, $map))
            {
                $sql .= $key . ' = "' . $value . '",';
            }
        }

        $sql = mb_substr($sql,0,-1);

        $sql .= ' WHERE ID = ' . $arFields['id'];

        $db_result = \App\Classes\DB::getConnection()->query($sql);

        return $db_result;
    }

    /**
     * Удаляет запись из таблицы
     * @param $id
     * @return array
     */
    public static function delete($id)
    {
        $sql = 'DELETE FROM ' . static::getTableName() . ' WHERE ID = "' .$id .'"';

        $db_result = \App\Classes\DB::getConnection()->query($sql);
        $result = \App\Classes\DB::getConnection()->fetch($db_result);

        return $result;
    }

    /**
     * Возвращает список записей с таблицы (простой вариант без условие > < != и так далее)
     * @param array $order
     * @param array $select
     * @param array $filter
     * @param null $limit
     * @return array
     */
    public static function getList($order = array(), $select = array(), $filter = array(), $limit = null)
    {
        $isOrder = 0;

        if (!function_exists('\array_key_first')) {
            function array_key_first(array $arr) {
                foreach($arr as $key => $unused) {
                    return $key;
                }
                return NULL;
            }
        }

        foreach (static::getMap() as $key => $value)
        {
            if (array_key_first($order) == $value)
            {
                if ($order[$value] == 'ASC' || $order[$value] == 'DESC')
                    $isOrder = 1;
            }
        }

        if ($isOrder == 0)
        {
            $order = array(
                'ID' => 'DESC'
            );
        }

        if (count($select) == 0)
        {
            $select = array(
                '*'
            );
        }

        if (count($filter) == 0)
            $isFilter = 0;
        else
            $isFilter = 1;

        $sql = 'SELECT ';

        foreach ($select as $key => $value)
        {
            if ($key + 1 == count($select))
                $sql .= $value;
            else
                $sql .= $value . ', ';
        }

        $sql .= ' FROM ' . static::getTableName() . ' ';

        if ($isFilter == 1)
        {
            $sql .= ' WHERE ';

            $i = 0;

            foreach ($filter as $key => $value)
            {
                $i++;

                if (\in_array($key, static::getMap()))
                {
                    if ($i == count($filter))
                        $sql .= $key . ' = "' . $value . '" ';
                    else
                        $sql .= $key . ' = "' . $value . '" and ';
                }
            }
        }

        $sql .=  ' ORDER BY ' . array_key_first($order) . ' '. $order[array_key_first($order)] . ' ';

        if ($limit != null)
        {
            $sql .= ' LIMIT ' . $limit;
        }

        $db_result = \App\Classes\DB::getConnection()->query($sql);
        $result = \App\Classes\DB::getConnection()->fetch($db_result);

        return $result;
    }

    /**
     * Возвращает запись по ID
     * @param $id
     * @return array
     */
    public static function getById($id)
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE ID = "' .$id .'"';

        $db_result = \App\Classes\DB::getConnection()->query($sql);
        $result = \App\Classes\DB::getConnection()->fetch($db_result);

        return $result;
    }
}

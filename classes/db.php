<?php

namespace App\Classes;

/**
 * Класс для работы с базой данных
 *
 * Class DB
 * @package App\Classes
 */
class DB
{
    private $mysqli;
    private static $db = null;

    public function __construct()
    {
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/settings.php');

        $this->mysqli = new \mysqli($DBHost, $DBLogin, $DBPassword, $DBName);
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    /**
     * Возвращает экземпляр подключения к базе данных
     * @return DB|null
     */
    public static function getConnection() {
        if (self::$db == null) self::$db = new DB();
        return self::$db;
    }

    /**
     * MySqli запрос к БД
     *
     * @param $sql
     * @param int $result_mode
     * @return bool|\mysqli_result
     */
    public function query ($sql)
    {
        $result = $this->mysqli->query($sql);

        return $result;
    }

    /**
     * @param $DBresult
     * @return array
     */
    public function fetch ($DBresult)
    {
        $arFetchResult = array();

        while ($row = \mysqli_fetch_array($DBresult))
        {
            $arFetchResult [] = $row;
        }

        return $arFetchResult;
    }
}
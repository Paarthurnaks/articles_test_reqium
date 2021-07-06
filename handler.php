<?php

namespace App;

// подключение к бд и простой орм сущности
require_once "classes/db.php";
require_once "classes/ArticlesTable.php";

use App\Classes\DB;
use App\Classes\ArticlesTable;

// если есть категория
if (!isset($_REQUEST['category'])) {
    echo 'Не указана категория';
    die;
}

$arOrder = array( 'ID' => 'DESC');
$arSelect = array( 'TITLE', 'DESCRIPTION', 'IMAGE');
$arFilter = array( 'CATEGORY_ID' => $_REQUEST['category']);
$limit = 5;

// получение объекта орм сщуности
$articlesTable = new ArticlesTable;
// получение необходимых данных
$result = $articlesTable->getList($arOrder, $arSelect, $arFilter, $limit);

if (count($result) == 0) {
    echo 'end';die;
}

$response = array();

foreach ($result as $key => $value) {
    $response[$key] = array();

    foreach ($value as $field => $item) {
        if (!is_int($field)) {
            $response[$key][mb_strtolower($field)] = $item;
        }
    }
}

echo json_encode($response);

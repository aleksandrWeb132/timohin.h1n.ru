<?php
require_once "./config/config.php";
require_once "./lib/Orm.php";
require_once "./lib/CProducts.php";

use lib\CProducts;

$accessBd = getAccessBd();

$host = $accessBd["host"];
$username = $accessBd["username"];
$password = $accessBd["password"];
$database = $accessBd["database"];

$connect = new mysqli($host, $username, $password, $database);

if($connect->connect_error) {
    die(json_encode([
        "code" => 40401,
        "message" => "Ошибка, не удалось подключиться к БД!"
    ]));
}

$products = new CProducts($connect);

$productList = $products->getList(5);

$connect->close();

die(json_encode([
    "code" => 1,
    "products" => $productList
]));
<?php

require_once "./config/config.php";
require_once "./lib/Orm.php";
require_once "./lib/CProducts.php";

use lib\CProducts;

if(!isset($_POST["productId"]) || !isset($_POST["productQuantity"])) {
    die(json_encode([
        "code" => 404092,
        "message" => "Ошибка, не переданы параметры!"
    ]));
}

if(!is_numeric($_POST["productId"]) || !is_numeric($_POST["productQuantity"])) {
    die(json_encode([
        "code" => 404082,
        "message" => "Ошибка, переданные параметры должны быть числом!"
    ]));
}

$productId = htmlspecialchars($_POST["productId"], ENT_QUOTES, 'UTF-8');
$productQuantity = htmlspecialchars($_POST["productQuantity"], ENT_QUOTES, 'UTF-8');

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

$updateQuantity = $products->updateQuantity($productId, $productQuantity);

$connect->close();

die(json_encode($updateQuantity));
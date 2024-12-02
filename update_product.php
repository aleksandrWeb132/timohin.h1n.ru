<?php

require_once "./config/config.php";
require_once "./lib/Orm.php";
require_once "./lib/CProducts.php";

use lib\CProducts;

// Убедитесь, что заголовок указывает, что вы ожидаете JSON
header("Content-Type: application/json");

// Получаем данные из тела запроса
$data = json_decode(file_get_contents("php://input"), true);

if(!isset($data["productId"]) || !isset($data["productQuantity"])) {
    die(json_encode([
        "code" => 404092,
        "message" => "Ошибка, не переданы параметры!"
    ]));
}

if(!is_numeric($data["productId"]) || !is_numeric($data["productQuantity"])) {
    die(json_encode([
        "code" => 404082,
        "message" => "Ошибка, переданные параметры должны быть числом!"
    ]));
}

$productId = htmlspecialchars($data["productId"], ENT_QUOTES, 'UTF-8');
$productQuantity = htmlspecialchars($data["productQuantity"], ENT_QUOTES, 'UTF-8');

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
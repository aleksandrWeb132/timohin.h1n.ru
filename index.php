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
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="table">
            <div class="scroll-container">
                <div class="table__header">
                    <div class="header__column id">Id</div>
                    <div class="header__column name">Имя</div>
                    <div class="header__column price">Цена</div>
                    <div class="header__column article">Описание</div>
                    <div class="header__column quantity">Количество</div>
                    <div class="header__column create">Дата создания</div>
                </div>
                <div class="table__body">
                    <div class="body__list">
                        <?php foreach($productList as $value): ?>
                            <div id="<?=$value["PRODUCT_ID"]?>" class="body__item">
                                <div class="body__column id"><?=$value["PRODUCT_ID"]?></div>
                                <div class="body__column name"><?=$value["PRODUCT_NAME"]?></div>
                                <div class="body__column price"><?=$value["PRODUCT_PRICE"]?></div>
                                <div class="body__column article"><?=$value["PRODUCT_ARTICLE"]?></div>
                                <div class="body__column quantity">
                                    <button class="quantity__button" type="button" onclick="addQuantity(<?=$value["PRODUCT_ID"]?>)">+</button>
                                    <span class="quantity__number"><?=$value["PRODUCT_QUANTITY"]?></span>
                                    <button class="quantity__button" type="button" onclick="removeQuantity(<?=$value["PRODUCT_ID"]?>)">-</button>
                                </div>
                                <div class="body__column create"><?=$value["DATE_CREATE"]?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/main.js"></script>
</body>
</html>
<?php

namespace lib;

class CProducts extends Orm {
    function __construct($connect) {
        parent::__construct($connect, "Products");
    }

    public function updateQuantity($idProduct, $value) {
        $idList = $this->findId("PRODUCT_ID", $idProduct);

        if(count($idList) === 0) {
            return [
                "code" => 3442,
                "message" => "Ошибка, не удалось изменить количество продуктов!"
            ];
        }

        $this->update($idList[0]["ID"], [
            "PRODUCT_QUANTITY" => $value
        ]);

        return [
            "code" => 1,
            "message" => "Количество продуктов изменилось!"
        ];
    }

    public function hideLine($idProduct) {
        $idList = $this->findId("PRODUCT_ID", $idProduct);

        $this->update($idList[0]["ID"], [
            "PRODUCT_ACTIVE" => 0
        ]);

        return [
            "code" => 1,
            "message" => "Количество продуктов изменилось!"
        ];
    }
}
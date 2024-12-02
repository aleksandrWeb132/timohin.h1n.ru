<?php

namespace lib;

class Orm {
    private $connect;
    private $table;

    function __construct($connect, $table) {
        $this->connect = $connect;
        $this->table = $table;
    }

    /** Получить список всех  **/
    public function getList($limit = null) {
        $sql = "SELECT * FROM ".$this->table." WHERE PRODUCT_ACTIVE = 1 ORDER BY DATE_CREATE DESC";

        if($limit !== null && gettype($limit) !== "string") {
            $sql .= " LIMIT ".$limit;
        }

        $result = $this->connect->query($sql);

        return $this->getArray($result);
    }


    /** Получить список ID по полю **/
    public function findId($field, $value) {
        $sql = "SELECT ID FROM ".$this->table." WHERE ".$field." = ".$value;

        $result = $this->connect->query($sql);

        return $this->getArray($result);
    }

    /** Обновить все параметры **/
    public function update($id, $params) {
        $sql = "UPDATE ".$this->table." SET";

        $lastKey = array_key_last($params);

        foreach ($params as $key => $value) {
            if(gettype($value) === "string") {
                $value = "'".$value."'";
            }

            if($key !== $lastKey) {
                $sql .= " ".$key." = ".$value.",";
            }

            $sql .= " ".$key." = ".$value;
        }

        $sql .= " WHERE ID = ".$id;

        $this->connect->query($sql);
    }

    private function getArray($result) {
        $data = [];

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }
}
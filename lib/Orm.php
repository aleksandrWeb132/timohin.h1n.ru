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
        $sql = "SELECT * FROM ".$this->table;

        if($limit !== null && gettype($limit) !== "string") {
            $sql .= " LIMIT ".$limit;
        }

        $result = $this->connect->query($sql);

        return $this->getArray($result);
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
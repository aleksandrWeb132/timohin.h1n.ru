<?php

namespace lib;

class Orm {
    private $connect;
    private $table;

    function __construct($connect, $table) {
        $this->connect = $connect;
        $this->table = $table;
    }
}
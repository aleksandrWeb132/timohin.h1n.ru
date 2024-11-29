<?php

namespace lib;

class CProducts extends Orm {
    function __construct($connect) {
        parent::__construct($connect, "Products");
    }

}
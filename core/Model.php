<?php
class Model {
    protected $conn;

    public function __construct() {
        $this->conn = require __DIR__ . '/../config/db.php';
    }
}

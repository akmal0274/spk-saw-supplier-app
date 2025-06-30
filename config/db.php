<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'spk_saw_supplier_app';

$conn = mysqli_connect($host, $user, $password, $db) or die ('Gagal Koneksi Database');

return $conn;
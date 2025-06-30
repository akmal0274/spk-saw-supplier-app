<?php
// Mulai session jika pakai session untuk alert/login
session_start();

// Panggil core
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';

// Jalankan router
$app = new App();


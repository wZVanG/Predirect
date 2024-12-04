<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$variables_entorno_verifificar = ['GA_SERVER', 'GA_TRACKING_ID', 'DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'INSTALL_PASSWORD'];
foreach ($variables_entorno_verifificar as $variable) {
    if(!getenv($variable)) die("Falta la variable de entorno $variable");
    else define($variable, getenv($variable));
}

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
        DB_USER,
        DB_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
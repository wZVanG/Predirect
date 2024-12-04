<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$variables_entorno_verifificar = ['GA_SERVER', 'GA_TRACKING_ID', 'DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'INSTALL_PASSWORD'];
foreach ($variables_entorno_verifificar as $variable) {
    //Podemos obtener la variable de entorno con getenv o $_ENV

    $valor = isset($_ENV[$variable]) ? $_ENV[$variable] : getenv($variable);

    if(!$valor) die("Falta la variable de entorno $variable");
    else define($variable, $valor);
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
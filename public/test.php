<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

var_dump(getenv('GA_SERVER')); 
echo "<br>";
var_dump($_ENV['GA_SERVER']);
echo "<br>";
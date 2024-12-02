<?php

require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/Controllers/RedirectController.php';

//require_once __DIR__ . '/../src/Scripts/insert_data.php'; exit;

$slug = isset($_GET['pagina']) ? $_GET['pagina'] : '';

$controller = new \App\Controllers\RedirectController();
$controller->redirect($slug);
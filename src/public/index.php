<?php

require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/Controllers/RedirectController.php';

$slug = isset($_GET['pagina']) ? $_GET['pagina'] : '';

$controller = new \App\Controllers\RedirectController();
$controller->redirect($slug);
<?php

define("APP_DIR", __DIR__);

require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/Controllers/RedirectController.php';

if(isset($_GET['install'])){
    require_once __DIR__ . '/../src/Scripts/install.php'; 
    exit;
}

$slug = isset($_GET['pagina']) ? $_GET['pagina'] : '';
$options = [
    'canal' => isset($_GET['canal']) ? $_GET['canal'] : null,
    'ref' => isset($_GET['ref']) ? $_GET['ref'] : null
];

$controller = new \App\Controllers\RedirectController();
$controller->redirect($slug, $options);
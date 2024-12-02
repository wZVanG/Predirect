<?php
exit;

require_once __DIR__ . '/../config.php';

$paginas = [
    'luzia' => 'https://wa.me/message/4LQUC6A2B5BXB1',
    'curso-gpt' => 'https://www.udemy.com/course/chat-gpt-101-usos-y-como-impulsar-tu-negocio/',
    'chang' => 'https://drive.google.com/drive/u/2/folders/12bW-TVFZzDupcR6BMzs5bBxstaFQSZZN',
];

foreach ($paginas as $slug => $url) {
    $sql = 'INSERT INTO paginas (slug, url) VALUES (:slug, :url)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':url', $url);
    $stmt->execute();
}

echo "Páginas insertadas correctamente.";

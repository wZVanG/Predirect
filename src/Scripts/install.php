<?php

defined('APP_DIR') or die('No se ha definido APP_DIR');

session_start();

// Solo usuarios con permiso de instalación
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (md5($_POST['password']) === INSTALL_PASSWORD) {
            $_SESSION['authenticated'] = true; 
        } else {
            echo "Contraseña incorrecta. Por favor, inténtelo de nuevo.";
            exit;
        }
    } else {
        showLoginForm();
        exit;
    }
}

$paginas = [
    'luzia' => 'https://wa.me/message/4LQUC6A2B5BXB1',
    'curso-gpt' => 'https://www.udemy.com/course/chat-gpt-101-usos-y-como-impulsar-tu-negocio/',
    'chang' => 'https://drive.google.com/drive/u/2/folders/12bW-TVFZzDupcR6BMzs5bBxstaFQSZZN',
];

//Verificar y crear tabla paginas

try{
    $sql = 'CREATE TABLE IF NOT EXISTS paginas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        slug VARCHAR(255) NOT NULL,
        url TEXT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    foreach ($paginas as $slug => $url) {
        $sqlCheck = 'SELECT COUNT(*) FROM paginas WHERE slug = :slug';
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':slug', $slug);
        $stmtCheck->execute();
        $exists = $stmtCheck->fetchColumn();
    
        if ($exists == 0) {
            $sql = 'INSERT INTO paginas (slug, url) VALUES (:slug, :url)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':slug', $slug);
            $stmt->bindParam(':url', $url);
            $stmt->execute();
        }else{
            echo "Página $slug ya existe<br />";
        }
    }

    echo "Se ha ejecutado correctamente la instalación";

}catch(Exception $e){
    echo "Error: " . $e->getMessage();
}


function showLoginForm() {
    echo '<form method="POST">
            Contraseña: <input type="password" name="password" required>
            <input type="submit" value="Instalar">
          </form>';
}
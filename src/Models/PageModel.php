<?php

namespace App\Models;

use PDO;

class PageModel
{
    // Obtener la URL correspondiente al slug desde la base de datos
    public static function getUrlBySlug($slug)
    {
        global $pdo;

        $sql = 'SELECT url FROM paginas WHERE slug = :slug LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row ? $row['url'] : null;
    }
}

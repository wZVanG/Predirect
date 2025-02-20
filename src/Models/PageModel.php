<?php

namespace App\Models;

use PDO;

class PageModel
{
    // Obtener la URL correspondiente al slug desde la base de datos
    public static function getUrlBySlug($slug)
    {
        global $pdo;

        $slug = trim((string) $slug);

        if(empty($slug)) return null;

        $sql = 'SELECT url FROM paginas WHERE slug = :slug LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row ? $row['url'] : null;
    }

    private static function generateRandomSlug($length = 6) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $slug = '';
        for ($i = 0; $i < $length; $i++) {
            $slug .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $slug;
    }

    public static function slugExists($slug) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM paginas WHERE slug = :slug');
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public static function createShortUrl($url, $customSlug = null) {
        global $pdo;

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception("URL no válida");
        }

        $slug = $customSlug;
        if (!$slug) {
            do {
                $slug = self::generateRandomSlug();
            } while (self::slugExists($slug));
        } else if (self::slugExists($slug)) {
            throw new \Exception("El slug ya existe");
        }

        $stmt = $pdo->prepare('INSERT INTO paginas (slug, url) VALUES (:slug, :url)');
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->execute();

        return $slug;
    }
}

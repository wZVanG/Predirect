<?php

namespace App\Controllers;

use App\Models\PageModel;

class ApiController
{
    private function validateApiKey($apiKey) {
        return $apiKey === API_KEY;
    }

    public function createShortUrl() {
        header('Content-Type: application/json');

        try {
            // Validar método HTTP
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception("Método no permitido", 405);
            }

            // Validar API Key
            $headers = getallheaders();
            $apiKey = isset($headers['X-Api-Key']) ? $headers['X-Api-Key'] : null;
            
            if (!$apiKey || !$this->validateApiKey($apiKey)) {
                throw new \Exception("API Key no válida", 401);
            }

            // Obtener datos del body
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['url'])) {
                throw new \Exception("URL es requerida", 400);
            }

            $customSlug = isset($data['slug']) ? $data['slug'] : null;
            
            $slug = PageModel::createShortUrl($data['url'], $customSlug);

            http_response_code(201);
            echo json_encode([
                'success' => true,
                'data' => [
                    'slug' => $slug,
                    'short_url' => 'https://' . $_SERVER['HTTP_HOST'] . '/' . $slug,
                    'original_url' => $data['url']
                ]
            ]);

        } catch (\Exception $e) {
            $code = $e->getCode() ?: 500;
            http_response_code($code);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
} 
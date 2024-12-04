<?php

namespace App\Utils;

class GoogleAnalytics
{
    public static function trackEvent($category, $action, $label)
    {
        $trackingId = GA_TRACKING_ID;
        $clientId = self::generateClientId();
        $server = 'www.google-analytics.com';

        $data = [
            'v' => 1, // Versión del protocolo
            'tid' => $trackingId, // ID de seguimiento
            'cid' => $clientId, // Identificador único del cliente
            't' => 'event', // Tipo de hit
            'ec' => $category, // Categoría del evento
            'ea' => $action, // Acción del evento
            'el' => $label // Etiqueta del evento
        ];

        // URL de la API de Google Analytics
        $url = 'https://' . $server . '/collect';

        try{

            // Iniciar cURL para enviar los datos
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Tiempo de espera máximo de 5 segundos

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            curl_close($ch);

            return $httpCode == 200;
        } catch (\Exception $e) {
            return false;
        }

    }

    private static function generateClientId() {
        return md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
    }
}

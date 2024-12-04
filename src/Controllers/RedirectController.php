<?php

namespace App\Controllers;

use App\Utils\GoogleAnalytics;
use App\Models\PageModel;

class RedirectController
{
    public function redirect($slug, $options = [])
    {
        $url = PageModel::getUrlBySlug($slug);

        if ($url) {
            
            GoogleAnalytics::trackEvent('Redirección', 'Acceso', $slug, $options);
            
            if(filter_var($url, FILTER_VALIDATE_URL)){
                header("Location: " . $url);
            }else{
                die("URL no válida: $url");
            }

        } else {
            header("Location: https://wai.pe");
        }

        exit;
    }
}

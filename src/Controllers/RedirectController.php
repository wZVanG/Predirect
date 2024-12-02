<?php

namespace App\Controllers;

use App\Utils\GoogleAnalytics;
use App\Models\PageModel;

class RedirectController
{
    public function redirect($slug)
    {
        $url = PageModel::getUrlBySlug($slug);

        if ($url) {
            GoogleAnalytics::trackEvent('Redirección', 'Acceso', $slug);
            header("Location: " . $url);
        } else {
            header("Location: https://wai.pe");
        }

        exit;
    }
}

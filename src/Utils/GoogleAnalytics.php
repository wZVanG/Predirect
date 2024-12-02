<?php

namespace App\Utils;

class GoogleAnalytics
{
    public static function trackEvent($category, $action, $label)
    {
        $trackingId = GA_TRACKING_ID;
        $server = GA_SERVER;

        // Llamada a Google Analytics
        $url = "https://www.google-analytics.com/collect?v=1&t=event&tid=$trackingId&cid=555&ec=$category&ea=$action&el=$label";
        file_get_contents($url);
    }
}

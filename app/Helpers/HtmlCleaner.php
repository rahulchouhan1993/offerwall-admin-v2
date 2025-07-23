<?php

namespace App\Helpers;

use HTMLPurifier;
use HTMLPurifier_Config;

class HtmlCleaner
{
    public static function clean($dirtyHtml)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,a[href],ul,ol,li,strong,em,b,i,u,br'); // adjust as needed
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($dirtyHtml);
    }
}
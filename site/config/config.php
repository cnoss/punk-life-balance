<?php

/**
 * The config file is optional. It accepts a return array with config options
 * Note: Never include more than one return statement, all options go within this single return array
 * In this example, we set debugging to true, so that errors are displayed onscreen.
 * This setting must be set to false in production.
 * All config options: https://getkirby.com/docs/reference/system/options
 */
return [
    'debug'                       => false,
    'languages'                   => false, // Or remove the languages section entirely
    'default.language'            => 'de',
    'schnti.cachebuster.active'   => false,
    'languages.detect'            => false,
    'locale'                      => 'de_DE.utf8',
    'panel'                       => [
        'install' => false,
    ],
    'tobimori.seo.sitemap.active' => true, // Enable the Tob

    'tobimori.seo.canonicalBase'  => 'https://punklifebalance.de',
    'tobimori.seo.robots.active'  => false,
];

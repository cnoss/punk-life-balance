<?php

# Use @include_once in case plugin is not installed through zip
# see https://getkirby.com/docs/guide/plugins/plugin-setup-composer#support-for-plugin-installation-without-composer
@include_once __DIR__ . '/vendor/autoload.php';

use Kirby\Http\Response;
use Zephir\Cookieconsent\Configuration;

Kirby::plugin('zephir/cookieconsent', [
    'snippets' => [
        'cookieconsentJs' => __DIR__ . '/snippets/cookieconsent_js.php',
        'cookieconsentCss' => __DIR__ . '/snippets/cookieconsent_css.php'
    ],
    'routes' => function ($kirby) {
        return [
            [
                'pattern' => 'cookieconsent.js',
                'language' => '*',
                'action' => function () {
                    return new Response(
                        Configuration::getInitJs(),
                        'application/javascript',
                        200,
                        [
                            'Cache-Control' => 'public, max-age=3600, must-revalidate'
                        ]
                    );
                }
            ]
        ];
    },
    'options' => [
        'cdn' => false,

        // CookieConsent options
        // Root options
        'revision' => 1,
        'root' => 'document.body',
        'autoClearCookies' => true, // Only works when the categories has an autoClear array
        'autoShow' => false,
        'hideFromBots' => true,
        'disablePageInteraction' => false,
        'lazyHtmlGeneration' => true,

        // Cookie options
        'cookie' => [
            'name' => 'cc-2024',
            'expiresAfterDays' => 365,
            'domain' => 'window.location.hostname,',
            'path' => '/',
            'useLocalStorage' => true,
            'sameSite' => 'Lax'
        ],

        // Block options
        'guiOptions' => [
            'consentModal' => [
                'layout' => 'box',
                'position' => 'top',
                'flipButtons' => false,
                'equalWeightButtons' => true
            ],
            'preferencesModal' => [
                'layout' => 'box',
                'position' => 'middle center',
                'flipButtons' => false,
                'equalWeightButtons' => true
            ]
        ],
        'categories' => [
            'necessary' => [
                'enabled' => true,
                'readOnly' => false
            ],
            'measurement' => [
                'enabled' => false,
                'readOnly' => false
            ],
            'functionality' => [
                'enabled' => true,
                'readOnly' => false
            ],
            'experience' => [
                'enabled' => false,
                'readOnly' => false
            ],
            'marketing' => [
                'enabled' => false,
                'readOnly' => false
            ]
        ],

        // Language options
        'translations' => [
            'de' => require_once(__DIR__ . '/translations/de.php'),
            'en' => require_once(__DIR__ . '/translations/en.php'),
            'fr' => require_once(__DIR__ . '/translations/fr.php')
        ]
    ]
]);
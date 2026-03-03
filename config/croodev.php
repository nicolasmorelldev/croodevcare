<?php

return [
    'admin_path' => env('ADMIN_PATH', 'admin'),
    'site' => [
        'product_name' => env('APP_NAME', 'Croodev Care'),
        'product_tagline' => env('SITE_TAGLINE', 'Ayuda clara para causas que importan'),
        'concept_label' => env('SITE_CONCEPT_LABEL', 'Concept by Croodev'),
        'currency' => env('SITE_CURRENCY', 'ARS'),
        'support_email' => env('SITE_SUPPORT_EMAIL', 'hola@croodevcare.test'),
        'support_phone' => env('SITE_SUPPORT_PHONE', '+54 11 5555 0192'),
        'whatsapp' => env('SITE_SUPPORT_WHATSAPP', '+54 9 11 5555 0192'),
    ],
];

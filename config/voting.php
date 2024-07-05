<?php

return [
    'url' => env('FINDRETROS_URL', 'https://findretros.com'),
    'username' => env('FINDRETROS_NAME'),
    'enabled' => env('FINDRETROS_ENABLED', false),
    'verify_url' => env('FINDRETROS_VERIFY_URL', 'validate.php?user=%s&ip=%s'),
    'redirect_url' => env('FINDRETROS_REDIRECT_URL', '%s/servers/%s/vote?%s'),
    'cache_key' => env('FINDRETROS_CACHE_KEY', 'findretros-voted-%s'),
    'minimal' => env('FINDRETROS_MINIMAL', 1),
    'return' => env('FINDRETROS_RETURN', 1),
];

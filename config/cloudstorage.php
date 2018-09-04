<?php

return [
    'base_url'                  => env('FILE_STORAGE_URL', ''),
    'endpoint'                  => '/api/' . env('FILE_STORAGE_API_VERSION', '1.1') . '/public-asset',
    'serializer_cache_dir'      => storage_path('framework/cache/serializer'),
    'serializer_definition_dir' => base_path('vendor/belka-car/php-lib-filestorage/serializer_definition'),
];

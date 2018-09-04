<?php

return [
    'definition' => [
        'path'            => resource_path('serializer_definition'),
        'serialize_nulls' => false,
    ],
    'cache_dir'  => [
        'path' => storage_path('framework/cache/serializer'),
    ],
];

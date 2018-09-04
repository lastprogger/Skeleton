<?php

return [
    'source_host'    => env('GRAYLOG_SOURCE', gethostname()),
    'host'           => env('GRAYLOG_HOST'),
    'port'           => env('GRAYLOG_PORT'),
    'enable_graylog' => env('GRAYLOG_ENABLED', false),
    'enable_mask'    => env('GRAYLOG_MASK', true),
    'log_level'      => env('APP_LOG_LEVEL', 'error'),
];

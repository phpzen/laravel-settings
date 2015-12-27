<?php
return [
    'cache_file' => env('SETTINGS_CACHE_FILE', storage_path('settings.json')),
    'table_name' => env('SETTINGS_TABLE_NAME', 'settings')
];
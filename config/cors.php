<?php
// config/cors.php

return [
    'allowed_origins' => ['*'],
    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With'],
    'expose_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];

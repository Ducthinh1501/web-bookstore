<?php
require_once __DIR__ . '/../config/database.php'; // Giữ kết nối database cũ

// Thêm các cấu hình mới cho API nếu cần
$apiConfig = [
    'api_version' => '1.0',
    'api_url' => $_ENV['API_URL'] ?? 'http://localhost/api',
    'jwt_secret' => $_ENV['JWT_SECRET'] ?? 'your_secret_key',
    'jwt_expire' => $_ENV['JWT_EXPIRE'] ?? 3600
];

return array_merge($config, $apiConfig); // Kết hợp config cũ và mới

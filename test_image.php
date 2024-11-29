<?php
include 'config/database.php';

$query = "SELECT image FROM books WHERE id = 1"; // Thay id = 1 bằng một id thực tế
$result = mysqli_query($conn, $query);
$book = mysqli_fetch_assoc($result);

if ($book && $book['image']) {
    header("Content-Type: image/jpeg");
    echo $book['image'];
} else {
    echo "Không tìm thấy hình ảnh";
} 
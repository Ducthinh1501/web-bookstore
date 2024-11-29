<?php
include 'config/database.php';

if(!isset($conn)) {
    die("Không thể kết nối database");
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$search = mysqli_real_escape_string($conn, $search);

$query = "SELECT * FROM books WHERE title LIKE '%$search%'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Hiển thị kết quả
while ($row = mysqli_fetch_assoc($result)) {
    // Hiển thị thông tin sách
    echo "<div class='book-item'>";
    // ... rest of your display code ...
    echo "</div>";
}
?> 
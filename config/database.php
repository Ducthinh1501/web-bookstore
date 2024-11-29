<?php
$conn = mysqli_connect("localhost", "root", "", "bookstore");

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
} 
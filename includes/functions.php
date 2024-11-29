<?php
// Hàm kiểm tra đăng nhập
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Hàm kiểm tra admin
function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

// Hàm format giá tiền
function formatPrice($price) {
    return number_format($price, 0, ',', '.') . ' VNĐ';
}

// Hàm lấy thông tin user
function getUserInfo($user_id) {
    global $conn;
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

// Hàm lấy giỏ hàng
function getCartItems() {
    if (!isset($_SESSION['cart'])) {
        return array();
    }
    
    global $conn;
    $cart = array();
    foreach ($_SESSION['cart'] as $book_id => $quantity) {
        $query = "SELECT * FROM books WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $book_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $book = mysqli_fetch_assoc($result);
        if ($book) {
            $book['quantity'] = $quantity;
            $cart[] = $book;
        }
    }
    return $cart;
}

// Hàm tính tổng giỏ hàng
function getCartTotal() {
    $items = getCartItems();
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

function getBookImage($book) {
    return !empty($book['image_url']) ? $book['image_url'] : 'assets/images/default-book.jpg';
}
?> 
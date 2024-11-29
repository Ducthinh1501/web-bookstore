<?php
session_start();
include 'includes/config.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Xử lý đặt hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tính tổng tiền
    $total = 0;
    foreach ($_SESSION['cart'] as $book_id => $quantity) {
        $query = "SELECT price FROM books WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $book_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $book = mysqli_fetch_assoc($result);
        $total += $book['price'] * $quantity;
    }

    // Tạo đơn hàng
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO orders (user_id, total_amount) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "id", $user_id, $total);
    mysqli_stmt_execute($stmt);
    $order_id = mysqli_insert_id($conn);

    // Thêm chi tiết đơn hàng
    foreach ($_SESSION['cart'] as $book_id => $quantity) {
        $query = "SELECT price FROM books WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $book_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $book = mysqli_fetch_assoc($result);

        $query = "INSERT INTO order_items (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "iiid", $order_id, $book_id, $quantity, $book['price']);
        mysqli_stmt_execute($stmt);
    }

    // Xóa giỏ hàng
    unset($_SESSION['cart']);
    
    header('Location: order_success.php?id=' . $order_id);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thanh toán</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h1>Thanh toán</h1>
        
        <form method="POST" class="checkout-form">
            <h3>Thông tin giao hàng</h3>
            <input type="text" name="address" placeholder="Địa chỉ giao hàng" required>
            <input type="text" name="phone" placeholder="Số điện thoại" required>
            
            <h3>Đơn hàng của bạn</h3>
            <table>
                <tr>
                    <th>Sách</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $book_id => $quantity):
                    $query = "SELECT * FROM books WHERE id = ?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "i", $book_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $book = mysqli_fetch_assoc($result);
                    $total += $book['price'] * $quantity;
                ?>
                    <tr>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo number_format($book['price'] * $quantity); ?> VNĐ</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Tổng cộng:</strong></td>
                    <td><strong><?php echo number_format($total); ?> VNĐ</strong></td>
                </tr>
            </table>
            
            <button type="submit">Đặt hàng</button>
        </form>
    </div>
</body>
</html> 
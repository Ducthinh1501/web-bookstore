<?php
session_start();
include '../includes/config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: ../index.php');
    exit();
}

// Cập nhật trạng thái đơn hàng
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    
    $query = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $status, $order_id);
    mysqli_stmt_execute($stmt);
}

// Lấy danh sách đơn hàng
$query = "SELECT orders.*, users.username, users.full_name 
          FROM orders 
          JOIN users ON orders.user_id = users.id 
          ORDER BY orders.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="container">
        <h1>Quản lý đơn hàng</h1>

        <table class="order-table">
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Thao tác</th>
            </tr>
            <?php while ($order = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['full_name']; ?> (<?php echo $order['username']; ?>)</td>
                    <td><?php echo number_format($order['total_amount']); ?> VNĐ</td>
                    <td>
                        <form method="POST" class="status-form">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <select name="status" onchange="this.form.submit()">
                                <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>
                                    Chờ xử lý
                                </option>
                                <option value="processing" <?php echo $order['status'] == 'processing' ? 'selected' : ''; ?>>
                                    Đang xử lý
                                </option>
                                <option value="shipped" <?php echo $order['status'] == 'shipped' ? 'selected' : ''; ?>>
                                    Đã giao
                                </option>
                                <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>
                                    Đã hủy
                                </option>
                            </select>
                            <input type="hidden" name="update_status" value="1">
                        </form>
                    </td>
                    <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                    <td>
                        <a href="view_order.php?id=<?php echo $order['id']; ?>" class="btn">Chi tiết</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html> 
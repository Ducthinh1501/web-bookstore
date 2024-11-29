<?php
session_start();
include '../includes/config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: ../index.php');
    exit();
}

// Thống kê theo tháng
$query = "SELECT 
            YEAR(created_at) as year,
            MONTH(created_at) as month,
            COUNT(*) as total_orders,
            SUM(total_amount) as revenue
          FROM orders
          WHERE status = 'shipped'
          GROUP BY YEAR(created_at), MONTH(created_at)
          ORDER BY year DESC, month DESC
          LIMIT 12";
$monthly_stats = mysqli_query($conn, $query);

// Thống kê sách bán chạy
$query = "SELECT 
            books.title,
            SUM(order_items.quantity) as total_sold,
            SUM(order_items.quantity * order_items.price) as revenue
          FROM order_items
          JOIN books ON order_items.book_id = books.id
          JOIN orders ON order_items.order_id = orders.id
          WHERE orders.status = 'shipped'
          GROUP BY books.id
          ORDER BY total_sold DESC
          LIMIT 10";
$bestsellers = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thống kê doanh thu</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="container">
        <h1>Thống kê doanh thu</h1>

        <!-- Thống kê theo tháng -->
        <div class="stats-section">
            <h2>Doanh thu theo tháng</h2>
            <table class="stats-table">
                <tr>
                    <th>Tháng/Năm</th>
                    <th>Số đơn hàng</th>
                    <th>Doanh thu</th>
                </tr>
                <?php while ($stat = mysqli_fetch_assoc($monthly_stats)): ?>
                    <tr>
                        <td><?php echo $stat['month']; ?>/<?php echo $stat['year']; ?></td>
                        <td><?php echo $stat['total_orders']; ?></td>
                        <td><?php echo number_format($stat['revenue']); ?> VNĐ</td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <!-- Sách bán chạy -->
        <div class="stats-section">
            <h2>Top 10 sách bán chạy</h2>
            <table class="stats-table">
                <tr>
                    <th>Tên sách</th>
                    <th>Số lượng đã bán</th>
                    <th>Doanh thu</th>
                </tr>
                <?php while ($book = mysqli_fetch_assoc($bestsellers)): ?>
                    <tr>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $book['total_sold']; ?></td>
                        <td><?php echo number_format($book['revenue']); ?> VNĐ</td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html> 
<?php
session_start();
include '../includes/config.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: ../index.php');
    exit();
}

// Xử lý thêm sách
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];

    // Xử lý upload ảnh
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/' . $image);
    }

    $query = "INSERT INTO books (title, author, description, price, image, category, stock) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssdssi", $title, $author, $description, $price, $image, $category, $stock);
    mysqli_stmt_execute($stmt);
}

// Xử lý xóa sách
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM books WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

// Lấy danh sách sách
$query = "SELECT * FROM books ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý sách</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="container">
        <h1>Quản lý sách</h1>

        <!-- Form thêm sách -->
        <form method="POST" enctype="multipart/form-data" class="add-book-form">
            <h2>Thêm sách mới</h2>
            <input type="text" name="title" placeholder="Tên sách" required>
            <input type="text" name="author" placeholder="Tác giả" required>
            <textarea name="description" placeholder="Mô tả"></textarea>
            <input type="number" name="price" placeholder="Giá" required>
            <input type="file" name="image">
            <input type="text" name="category" placeholder="Danh mục">
            <input type="number" name="stock" placeholder="Số lượng" required>
            <button type="submit" name="add">Thêm sách</button>
        </form>

        <!-- Danh sách sách -->
        <table class="book-table">
            <tr>
                <th>ID</th>
                <th>Tên sách</th>
                <th>Tác giả</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
            </tr>
            <?php while ($book = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $book['id']; ?></td>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo number_format($book['price']); ?> VNĐ</td>
                    <td><?php echo $book['category']; ?></td>
                    <td><?php echo $book['stock']; ?></td>
                    <td>
                        <a href="edit_book.php?id=<?php echo $book['id']; ?>" class="btn">Sửa</a>
                        <a href="?delete=<?php echo $book['id']; ?>" 
                           onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html> 
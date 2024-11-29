<?php 
include 'config/database.php';
include 'includes/header.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT * FROM books";
if (!empty($search)) {
    $query .= " WHERE title LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);
?>

<main>
    <!-- Banner Section -->
    <section class="products-banner">
        <div class="container">
            <h1>Thư Viện Sách</h1>
            <p>Khám phá kho tàng tri thức đa dạng của chúng tôi</p>
        </div>
    </section>

    <!-- Filter & Search Section -->
    <section class="filter-section">
        <div class="container">
            <div class="search-box">
                <form action="products.php" method="GET" class="search-form">
                    <div class="search-input">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" 
                               placeholder="Tìm kiếm sách..." 
                               value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <button type="submit" class="search-button">Tìm Kiếm</button>
                </form>
            </div>

            <div class="filter-options">
                <select name="category" class="filter-select">
                    <option value="">Tất cả thể loại</option>
                    <option value="novel">Tiểu thuyết</option>
                    <option value="education">Giáo dục</option>
                    <option value="children">Thiếu nhi</option>
                </select>

                <select name="sort" class="filter-select">
                    <option value="newest">Mới nhất</option>
                    <option value="price-asc">Giá tăng dần</option>
                    <option value="price-desc">Giá giảm dần</option>
                </select>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="products-section">
        <div class="container">
            <div class="products-grid">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($book = mysqli_fetch_assoc($result)): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <?php
                                $image_path = "assets/images/" . $book['image'];
                                if (file_exists($image_path)): ?>
                                    <img src="<?php echo $image_path; ?>" 
                                         alt="<?php echo htmlspecialchars($book['title']); ?>">
                                <?php else: ?>
                                    <img src="assets/images/default-book.jpg" alt="No image available">
                                <?php endif; ?>
                                <div class="product-overlay">
                                    <form method="POST" action="cart.php">
                                        <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                        <button type="submit" name="add_to_cart" class="add-to-cart-btn">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                                <?php if (!empty($book['author'])): ?>
                                    <div class="author"><?php echo htmlspecialchars($book['author']); ?></div>
                                <?php endif; ?>
                                <div class="product-price">
                                    <span class="price"><?php echo number_format($book['price']); ?>đ</span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h2>Không tìm thấy sản phẩm</h2>
                        <p>Vui lòng thử lại với từ khóa khác</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?> 
<?php
session_start();
include 'config/database.php';

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_POST['add_to_cart'])) {
    $book_id = $_POST['book_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
    if (isset($_SESSION['cart'][$book_id])) {
        $_SESSION['cart'][$book_id] += $quantity;
    } else {
        $_SESSION['cart'][$book_id] = $quantity;
    }
    header('Location: cart.php');
    exit();
}

// Xử lý cập nhật số lượng
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $book_id => $quantity) {
        if ($quantity > 0) {
            $_SESSION['cart'][$book_id] = $quantity;
        } else {
            unset($_SESSION['cart'][$book_id]);
        }
    }
    header('Location: cart.php');
    exit();
}

// Xử lý xóa sản phẩm
if (isset($_GET['remove'])) {
    $book_id = $_GET['remove'];
    unset($_SESSION['cart'][$book_id]);
    header('Location: cart.php');
    exit();
}

include 'includes/header.php';
?>

<style>
/* Container styles */
.cart-page {
    padding: 40px 0;
    background-color: #f8f9fa;
    min-height: calc(100vh - 200px);
    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Page title */
.cart-page h1 {
    font-size: 2.5rem;
    color: #27A4F2;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.cart-page h1:after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: #27A4F2;
    margin: 15px auto;
    border-radius: 2px;
}

/* Cart Table Styles */
.cart-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(39, 164, 242, 0.1);
    margin-bottom: 30px;
}

.cart-table th {
    background: #27A4F2;
    color: white;
    padding: 18px 20px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 1rem;
    letter-spacing: 1px;
}

.cart-table td {
    padding: 20px;
    border-bottom: 1px solid #9FD7F9;
    vertical-align: middle;
}

/* Product Info Column */
.product-info {
    display: flex;
    align-items: center;
    gap: 25px;
}

.product-info img {
    width: 100px;
    height: 140px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(39, 164, 242, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-info img:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(39, 164, 242, 0.2);
}

.product-info div {
    flex: 1;
}

.product-info h3 {
    margin: 0 0 8px;
    font-size: 1.2rem;
    color: #27A4F2;
    font-weight: 600;
    line-height: 1.4;
}

.product-info .author {
    color: #666;
    font-size: 1rem;
    font-style: italic;
}

/* Quantity Input */
.quantity input {
    width: 80px;
    padding: 10px;
    border: 2px solid #9FD7F9;
    border-radius: 6px;
    text-align: center;
    font-size: 1rem;
    font-weight: 500;
    transition: border-color 0.2s;
}

.quantity input:focus {
    border-color: #27A4F2;
    outline: none;
    box-shadow: 0 0 0 3px rgba(39, 164, 242, 0.1);
}

/* Price and Total */
.price, .subtotal {
    font-weight: 600;
    color: #27A4F2;
    font-size: 1.1rem;
}

/* Remove Button */
.remove-btn {
    color: #27A4F2;
    font-size: 1.3rem;
    transition: all 0.2s;
    display: inline-block;
    padding: 8px;
    border-radius: 50%;
}

.remove-btn:hover {
    color: white;
    background: #27A4F2;
    transform: rotate(90deg);
}

/* Cart Actions */
.cart-actions {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
    margin-top: 40px;
}

.btn {
    padding: 15px 30px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s;
}

.update-btn {
    background: #3EAEF4;
    color: white;
}

.update-btn:hover {
    background: #27A4F2;
    transform: translateY(-2px);
}

.checkout-btn {
    background: #27A4F2;
    color: white;
}

.checkout-btn:hover {
    background: #3EAEF4;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(39, 164, 242, 0.2);
}

/* Empty Cart */
.empty-cart {
    text-align: center;
    padding: 50px 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(39, 164, 242, 0.1);
}

.empty-cart i {
    font-size: 4rem;
    color: #27A4F2;
    margin-bottom: 20px;
}

.empty-cart p {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 25px;
}

.empty-cart .btn {
    display: inline-block;
    text-decoration: none;
    background: #28a745;
    color: white;
}

.empty-cart .btn:hover {
    background: #218838;
}

/* Cart Total Row */
.cart-table tfoot td {
    background: #f8f9fa;
    font-size: 1.3rem;
    font-weight: bold;
    color: #27A4F2;
    padding: 20px;
}

.text-right {
    text-align: right;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-page {
        padding: 20px 0;
    }
    
    .product-info img {
        width: 80px;
        height: 112px;
    }
    
    .product-info h3 {
        font-size: 1.1rem;
    }
    
    .cart-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        padding: 12px;
    }
}
</style>

<main class="cart-page">
    <div class="container">
        <h1>Giỏ Hàng</h1>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <p>Giỏ hàng trống</p>
                <a href="products.php" class="btn">Tiếp tục mua sắm</a>
            </div>
        <?php else: ?>
            <form method="POST" action="cart.php">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $book_id => $quantity):
                            $query = "SELECT * FROM books WHERE id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $book_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $book = $result->fetch_assoc();
                            
                            if ($book):
                                $subtotal = $book['price'] * $quantity;
                                $total += $subtotal;
                        ?>
                            <tr>
                                <td class="product-info">
                                    <img src="assets/images/<?php echo $book['image']; ?>" 
                                         alt="<?php echo htmlspecialchars($book['title']); ?>">
                                    <div>
                                        <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                                        <p class="author"><?php echo htmlspecialchars($book['author']); ?></p>
                                    </div>
                                </td>
                                <td class="price" data-label="Giá:"><?php echo number_format($book['price']); ?>đ</td>
                                <td class="quantity" data-label="Số lượng:">
                                    <input type="number" name="quantity[<?php echo $book_id; ?>]" 
                                           value="<?php echo $quantity; ?>" min="1">
                                </td>
                                <td class="subtotal" data-label="Tổng:"><?php echo number_format($subtotal); ?>đ</td>
                                <td class="remove">
                                    <a href="cart.php?remove=<?php echo $book_id; ?>" 
                                       class="remove-btn">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Tổng cộng:</strong></td>
                            <td colspan="2"><strong><?php echo number_format($total); ?>đ</strong></td>
                        </tr>
                    </tfoot>
                </table>
                
                <div class="cart-actions">
                    <button type="submit" name="update_cart" class="btn update-btn">
                        Cập nhật giỏ hàng
                    </button>
                    <a href="checkout.php" class="btn checkout-btn">
                        Thanh toán
                    </a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</main>


<?php
// Không có khoảng trắng hoặc xuống dòng trước <?php
// Your header code here
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Header Styles Only */
        .main-header {
            background: white;
            box-shadow: 0 2px 10px rgba(39, 164, 242, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-top {
            background: #27A4F2;
            color: white;
            padding: 8px 0;
            font-size: 0.9rem;
        }

        .header-top-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }

        .contact-info {
            display: flex;
            gap: 20px;
        }

        .contact-info a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .header-main {
            padding: 15px 0;
            background: white;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #27A4F2;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            font-size: 2rem;
        }

        .search-bar {
            flex: 1;
            max-width: 500px;
            margin: 0 30px;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 20px;
            border: 2px solid #9FD7F9;
            border-radius: 25px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #3EAEF4;
            box-shadow: 0 0 0 3px rgba(39, 164, 242, 0.1);
        }

        .search-bar button {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: #27A4F2;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .search-bar button:hover {
            background: #3EAEF4;
        }

        .header-actions {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .header-actions a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }

        .header-actions a:hover {
            color: #27A4F2;
        }

        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #27A4F2;
            color: white;
            font-size: 0.8rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav {
            background: #f8f9fa;
            border-top: 1px solid #eee;
            padding: 10px 0;
        }

        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-menu a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            padding: 5px 0;
            position: relative;
        }

        .nav-menu a:hover {
            color: #27A4F2;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #27A4F2;
        }

        @media (max-width: 768px) {
            .header-top {
                display: none;
            }

            .header-content {
                flex-wrap: wrap;
            }

            .search-bar {
                order: 3;
                margin: 15px 0;
                max-width: 100%;
            }

            .nav-menu {
                flex-wrap: wrap;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="header-top">
            <div class="header-top-content">
                <div class="contact-info">
                    <a href="tel:1234567890"><i class="fas fa-phone"></i>0765406359</a>
                    <a href="mailto:info@bookstore.com"><i class="fas fa-envelope"></i> ducthinh150103@gmail.com</a>
                </div>
            </div>
        </div>

        <div class="header-main">
            <div class="header-content">
                <a href="index.php" class="logo">
                    <i class="fas fa-book"></i>
                    BookStore
                </a>

               

                <div class="header-actions">
                    <a href="account.php"><i class="fas fa-user"></i> Tài khoản</a>
                    <a href="cart.php" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                    </a>
                </div>
            </div>
        </div>

        <nav class="nav">
            <div class="nav-content">
                <ul class="nav-menu">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="products.php">Sản phẩm</a></li>
                    <li><a href="about.php">Giới thiệu</a></li>
                    <li><a href="contact.php">Liên hệ</a></li>
                </ul>
            </div>
        </nav>
    </header>
</body>
</html> 
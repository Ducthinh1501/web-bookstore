<style>
.main-footer {
    background: #27A4F2;
    color: white;
    padding: 40px 0 0;
    margin-top: auto;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    padding: 0 20px;
}

.footer-section h3 {
    font-size: 1.2rem;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.footer-section h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 2px;
    background: #9FD7F9;
}

.footer-section p,
.footer-section a {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    margin-bottom: 10px;
    display: block;
}

.footer-section a:hover {
    color: #9FD7F9;
    transform: translateX(5px);
    transition: all 0.3s ease;
}

.social-links {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.social-links a {
    width: 35px;
    height: 35px;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s;
}

.social-links a:hover {
    background: #3EAEF4;
}

.footer-bottom {
    background: #3EAEF4;
    padding: 20px 0;
    margin-top: 40px;
    text-align: center;
}

.footer-bottom p {
    margin: 0;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .footer-section h3::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .social-links {
        justify-content: center;
    }

    .footer-section {
        border-left: none;
        border-bottom: 3px solid #9FD7F9;
        padding-left: 0;
        padding-bottom: 20px;
    }
}

.footer-section {
    border-left: 3px solid #9FD7F9;
    padding-left: 20px;
}

.main-footer {
    background: linear-gradient(135deg, #27A4F2, #3EAEF4);
}
</style>

<footer class="main-footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>Về chúng tôi</h3>
            <p>BookStore - Nơi mang đến cho bạn những cuốn sách hay nhất với giá tốt nhất.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <div class="footer-section">
            <h3>Liên hệ</h3>
            <p><i class="fas fa-phone"></i>0765406359</p>
            <p><i class="fas fa-envelope"></i> ducthinh150103@gmail.com</p>
            <p><i class="fas fa-map-marker-alt"></i> TRÀ VINH</p>
        </div>

        <div class="footer-section">
            <h3>Danh mục</h3>
            <a href="#">Sách mới</a>
            <a href="#">Sách bán chạy</a>
            <a href="#">Sách giáo khoa</a>
            <a href="#">Văn học</a>
        </div>

        <div class="footer-section">
            <h3>Hỗ trợ</h3>
            <a href="#">Chính sách đổi trả</a>
            <a href="#">Chính sách bảo hành</a>
            <a href="#">Chính sách vận chuyển</a>
            <a href="#">Chính sách thanh toán</a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Book Store. All rights reserved.</p>
    </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html> 
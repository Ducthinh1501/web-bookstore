// Lazy loading cho hình ảnh
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
});

// Xử lý giỏ hàng với AJAX
function addToCart(bookId) {
    fetch('cart.php?action=add&id=' + bookId, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartCount(data.cartCount);
            showNotification('Đã thêm sách vào giỏ hàng!');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Cập nhật số lượng trong giỏ hàng
function updateCartCount(count) {
    const cartCounter = document.querySelector('.cart-counter');
    if (cartCounter) {
        cartCounter.textContent = count;
    }
}

// Hiển thị thông báo
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.add('show');
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 2000);
    }, 100);
}

// Xử lý tìm kiếm realtime
const searchInput = document.querySelector('.search-input');
if (searchInput) {
    let timeout = null;
    searchInput.addEventListener('input', function(e) {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            const searchTerm = e.target.value;
            if (searchTerm.length >= 2) {
                fetch(`search.php?term=${searchTerm}&ajax=1`)
                    .then(response => response.json())
                    .then(data => {
                        updateSearchResults(data);
                    });
            }
        }, 500);
    });
}

// Cập nhật kết quả tìm kiếm
function updateSearchResults(results) {
    const resultsContainer = document.querySelector('.search-results');
    if (resultsContainer) {
        resultsContainer.innerHTML = '';
        results.forEach(book => {
            const bookElement = document.createElement('div');
            bookElement.className = 'search-result-item';
            bookElement.innerHTML = `
                <img src="assets/images/${book.image}" alt="${book.title}">
                <div class="book-info">
                    <h3>${book.title}</h3>
                    <p>${book.author}</p>
                    <p class="price">${formatPrice(book.price)} VNĐ</p>
                </div>
            `;
            resultsContainer.appendChild(bookElement);
        });
    }
}

// Format giá tiền
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}

// Xử lý menu mobile
const menuToggle = document.querySelector('.menu-toggle');
const navMenu = document.querySelector('.nav-menu');

if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });
}

// Validate form
function validateForm(formElement) {
    const inputs = formElement.querySelectorAll('input[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            showInputError(input, 'Vui lòng điền thông tin này');
        } else {
            removeInputError(input);
        }
    });

    return isValid;
}

function showInputError(input, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    input.classList.add('error');
    input.parentNode.appendChild(errorDiv);
}

function removeInputError(input) {
    input.classList.remove('error');
    const errorDiv = input.parentNode.querySelector('.error-message');
    if (errorDiv) {
        errorDiv.remove();
    }
} 
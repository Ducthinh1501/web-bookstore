-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 12:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` longblob DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `price`, `image`, `category`, `stock`, `created_at`, `category_id`) VALUES
(1, 'Đắc Nhân Tâm', 'Dale Carnegie', 'Đắc nhân tâm của Dale Carnegie là quyển sách của mọi thời đại và một hiện tượng đáng kinh ngạc trong ngành xuất bản Hoa Kỳ.', 89000.00, 0x6461636e68616e74616d2e6a7067, 'Self-help', 50, '2024-11-29 05:47:23', NULL),
(2, 'Nhà Giả Kim', 'Paulo Coelho', 'Tiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông.', 69000.00, 0x6e68616769616b696d2e6a7067, 'Tiểu thuyết', 45, '2024-11-29 05:47:23', NULL),
(3, 'Cây Cam Ngọt Của Tôi', 'José Mauro de Vasconcelos', 'Cây Cam Ngọt Của Tôi là một tác phẩm tự truyện của nhà văn Brazil José Mauro de Vasconcelos.', 108000.00, 0x63617963616d6e676f74637561746f692e6a7067, 'Tiểu thuyết', 30, '2024-11-29 05:47:23', NULL),
(4, 'Bí Mật Tư Duy Triệu Phú', 'Rosie Nguyễn', 'Tuổi trẻ đáng giá bao nhiêu? là một cuốn sách của tác giả Rosie Nguyễn.', 75000.00, 0x62696d6174747564757974726965757068752e6a7067, 'Self-help', 40, '2024-11-29 05:47:23', NULL),
(5, 'Bước Chậm Giữa Thế Gian Vội Vả', 'Yuval Noah Harari', 'Sapiens là một cuốn sách về lịch sử loài người từ thời kỳ đồ đá cho đến hiện đại.', 299000.00, 0x62756f636368616d676975617468656769616e766f6976612e6a7067, 'Lịch sử', 25, '2024-11-29 05:47:23', NULL),
(6, 'Nghĩ giàu làm giàu', 'David J. Lieberman', 'Đọc Vị Bất Kỳ Ai là cuốn sách gối đầu giường cho những ai muốn tìm hiểu về tâm lý học.', 89000.00, 0x6e676869676961756c616d676961752e6a7067, 'Tâm lý', 35, '2024-11-29 05:47:23', NULL),
(7, 'Người Giàu Có Nhất Thành Babylon', 'George S. Clason', 'Cuốn sách này sẽ cung cấp cho bạn những bí quyết quản lý tài chính cá nhân.', 85000.00, 0x6e67756f6967696175636f6e6861747468616e68626162796c6f6e2e6a7067, 'Kinh tế', 40, '2024-11-29 05:47:23', NULL),
(8, 'Nhà Giả Kim', 'Nguyễn Nhật Ánh', 'Một tác phẩm đặc sắc của nhà văn Nguyễn Nhật Ánh về tuổi thơ.', 125000.00, 0x6e68616769616b696d2e6a7067, 'Văn học', 50, '2024-11-29 05:47:23', NULL),
(9, 'Những đòn trong thuyết phục', 'Alex Rovira', 'Cuốn sách này sẽ giúp bạn hiểu rõ hơn về may mắn và cách tạo ra may mắn.', 79000.00, 0x6e68756e67646f6e74616d6c7974726f6e67746875796574706875632e6a7067, 'Self-help', 30, '2024-11-29 05:47:23', NULL),
(10, 'Tư duy nhanh và chậm', 'Thomas L. Friedman', 'Một cuốn sách về toàn cầu hóa và những tác động của nó.', 259000.00, 0x74756475796e68616e6876616368616d2e6a7067, 'Kinh tế', 20, '2024-11-29 05:47:23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

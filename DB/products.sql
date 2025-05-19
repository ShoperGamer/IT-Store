-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 01:50 PM
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
-- Database: `onedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `NAME`, `description`, `price`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'Samsung Galaxy S24 Ultra', 'สุดยอดสมาร์ทโฟนเรือธง กล้องเทพ จอ Dynamic AMOLED 2X สว่างคมชัด ชิปเซ็ต Snapdragon 8 Gen 3 for Galaxy แรงเหลือล้น พร้อม S Pen อัจฉริยะ', 46900.00, 'https://images.samsung.com/is/image/samsung/assets/th/smartphones/galaxy-s24-ultra/buy/01_S24Ultra-Group-KV_MO_0527_final.jpg?imbypass=true', '2025-05-19 09:01:50', '2025-05-19 10:02:09'),
(2, 'Samsung Galaxy S24+', 'เรือธงอีกรุ่น จอ Dynamic AMOLED 2X ขนาดใหญ่ขึ้น ชิปเซ็ต Exynos 2400 หรือ Snapdragon 8 Gen 3 for Galaxy (ตามภูมิภาค) กล้องคุณภาพสูง แบตเตอรี่อึดทน', 35900.00, 'https://static1.anpoimages.com/wordpress/wp-content/uploads/wm/2024/01/samsung-galaxy-s24-plus-home-screen-2.jpg', '2025-05-19 09:01:50', '2025-05-19 10:03:36'),
(3, 'Samsung Galaxy S24', 'เรือธงขนาดกะทัดรัด จอ Dynamic AMOLED 2X ชิปเซ็ต Exynos 2400 หรือ Snapdragon 8 Gen 3 for Galaxy (ตามภูมิภาค) กล้องถ่ายรูปสวยงาม ประสิทธิภาพเยี่ยม', 30900.00, 'https://i.insider.com/65d627d6a3bd891424f8e7dd?width=700', '2025-05-19 09:01:50', '2025-05-19 10:04:37'),
(4, 'Samsung Galaxy S23 FE', 'รุ่น Fan Edition ที่นำฟีเจอร์เด่นจาก S23 มาในราคาที่เข้าถึงง่ายขึ้น กล้องคุณภาพดี จอ Dynamic AMOLED 2X ชิปเซ็ต Exynos 2200 หรือ Snapdragon 8 Gen 1 (ตามภูมิภาค)', 19990.00, 'https://m-cdn.phonearena.com/images/review/5949-wide-two_940/Samsung-Galaxy-S23-FE-review-trusty-camera-system-outstanding-display-great-value.webp?1729177702', '2025-05-19 09:01:50', '2025-05-19 10:06:32'),
(5, 'Samsung Galaxy A55 5G', 'สมาร์ทโฟนระดับกลาง จอ Super AMOLED สวยงาม กล้องหลัก 50MP พร้อม OIS แบตเตอรี่ใช้งานได้ยาวนาน ดีไซน์พรีเมียม', 14499.00, 'https://static.toiimg.com/thumb/msid-110058195,width-1280,height-720,resizemode-4/110058195.jpg', '2025-05-19 09:29:23', '2025-05-19 10:07:33'),
(6, 'Samsung Galaxy A35 5G', 'สมาร์ทโฟนระดับกลางอีกรุ่น จอ Super AMOLED กล้องดีไซน์ใหม่ แบตเตอรี่อึดทน รองรับ 5G', 11999.00, 'https://media.techtribune.net/d-2/2024/03/BK6A1103-Edit.jpg', '2025-05-19 09:29:23', '2025-05-19 10:10:04'),
(7, 'Samsung Galaxy A25 5G', 'สมาร์ทโฟนราคาคุ้มค่า รองรับ 5G จอ Super AMOLED กล้องคมชัด แบตเตอรี่ใช้งานได้นาน', 8999.00, 'https://cdn.gadgetbytenepal.com/wp-content/uploads/2024/01/Samsung-Galaxy-A25-5G-Review.jpg', '2025-05-19 09:29:23', '2025-05-19 10:11:37'),
(8, 'Samsung Galaxy M55 5G', 'เน้นแบตเตอรี่อึดเป็นพิเศษ จอ Super AMOLED กล้องความละเอียดสูง รองรับ 5G', 15990.00, 'https://techstory.in/wp-content/uploads/2024/04/TDD.jpg', '2025-05-19 09:29:23', '2025-05-19 10:12:49'),
(9, 'Samsung Galaxy M35 5G', 'รุ่นใหม่ในตระกูล M เน้นแบตเตอรี่และฟังก์ชันการใช้งานที่ครบครัน รองรับ 5G\r\n', 13000.00, 'https://static.toiimg.com/thumb/msid-115736509,width-400,resizemode-4/115736509.jpg', '2025-05-19 09:29:40', '2025-05-19 10:14:29'),
(10, 'Samsung Galaxy M15 5G', 'สมาร์ทโฟนราคาประหยัด รองรับ 5G แบตเตอรี่ขนาดใหญ่ ใช้งานได้ยาวนาน', 6999.00, 'https://images.samsung.com/is/image/samsung/p6pim/in/feature/165618180/in-feature-galaxy-m-543582094?$FB_TYPE_A_MO_JPG$', '2025-05-19 09:29:40', '2025-05-19 10:15:18'),
(11, 'Samsung Galaxy Z Fold5', 'สมาร์ทโฟนจอพับได้ระดับพรีเมียม จอ Dynamic AMOLED 2X ทั้งด้านในและด้านนอก Multi-tasking สุดยอด ประสิทธิภาพสูง', 59900.00, 'https://s.isanook.com/hi/0/ud/315/1579367/fold5.jpg', '2025-05-19 09:29:40', '2025-05-19 10:16:28'),
(12, 'Samsung Galaxy Z Flip5', 'สมาร์ทโฟนจอพับได้ขนาดกะทัดรัด พกพาสะดวก จอ Flex Window ใหญ่ขึ้น กล้องคุณภาพดี ดีไซน์สวยงาม', 38900.00, 'https://images.samsung.com/is/image/samsung/assets/th/smartphones/galaxy-z-flip5/images/galaxy-z-flip5-highlights-sustainability-mo.jpg?imbypass=true', '2025-05-19 09:29:40', '2025-05-19 10:17:19'),
(13, 'Samsung Galaxy Tab S9 Ultra 5G', 'แท็บเล็ตเรือธง จอ Dynamic AMOLED 2X ขนาดใหญ่สะใจ ชิปเซ็ต Snapdragon 8 Gen 2 for Galaxy พร้อม S Pen ในกล่อง\r\n', 42900.00, 'https://gizmologi.id/wp-content/uploads/2023/08/Samsung-Galaxy-Tab-S9-5G-201-1-860x484.jpg', '2025-05-19 09:30:04', '2025-05-19 11:08:51'),
(14, 'Samsung Galaxy Tab S9+', 'แท็บเล็ตระดับพรีเมียม จอ Dynamic AMOLED 2X ขนาดกำลังดี ชิปเซ็ต Snapdragon 8 Gen 2 for Galaxy พร้อม S Pen ในกล่อง', 35900.00, 'https://www.notebookcheck.net/fileadmin/_processed_/5/7/csm_IMG_20231004_085440_5873c8748b.jpg', '2025-05-19 09:30:04', '2025-05-19 10:19:43'),
(15, 'Samsung Galaxy Tab S9 FE+', 'แท็บเล็ต Fan Edition จอ LCD ขนาดใหญ่ แบตเตอรี่อึดทน รองรับ S Pen (จำหน่ายแยก)\r\n', 19990.00, 'https://tynmagazine.com/wp-content/uploads/sites/3/2023/11/samsung-galaxy-tab-S9-FE-930x523.jpg', '2025-05-19 09:30:04', '2025-05-19 10:20:23'),
(16, 'Samsung Galaxy S23 Ultra', 'เรือธงรุ่นก่อนหน้า ยังคงทรงพลังด้วยชิปเซ็ต Snapdragon 8 Gen 2 for Galaxy กล้องซูมสุดยอด จอ Dynamic AMOLED 2X และ S Pen', 43900.00, 'https://images.samsung.com/is/image/samsung/p6pim/ae/feature/others/ae-feature-galaxy-s23-s918-535228082?$FB_TYPE_A_MO_JPG$', '2025-05-19 09:30:04', '2025-05-19 10:20:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

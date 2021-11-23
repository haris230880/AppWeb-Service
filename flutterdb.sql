-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2021 at 02:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flutterdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(25) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`) VALUES
(1, 'condo', 'condo.png'),
(2, 'apartment', 'apartment.png'),
(3, 'mansion', 'mansion.png'),
(4, 'dormitory', 'dormitory.png');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` date NOT NULL,
  `comment_time` time NOT NULL,
  `comment_score` int(5) NOT NULL,
  `member_id` int(255) NOT NULL,
  `rentalroom_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_content`, `comment_date`, `comment_time`, `comment_score`, `member_id`, `rentalroom_id`) VALUES
(1, 'สะอาด สบาย สวยงาม', '2021-11-10', '07:38:37', 5, 1, 1),
(2, 'สะดวก ห้องสวย', '2021-11-10', '05:11:18', 4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `game_id` varchar(15) NOT NULL,
  `game_name` varchar(255) NOT NULL,
  `game_price` int(5) NOT NULL,
  `game_detail` text NOT NULL,
  `game_img` varchar(255) NOT NULL,
  `game_stock` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `game_id`, `game_name`, `game_price`, `game_detail`, `game_img`, `game_stock`) VALUES
(28, 'GA4', 'NFS Rivals', 1500, 'Need for Speed Rivals is a 2013 racing video game set in an open world environment. Developed by Ghost Games and Criterion Games, this is the twentieth installment in the long-running Need for Speed series. The game was released for Microsoft Windows, PlayStation 3 and Xbox 360 on 19 November 2013. It has also been released for PlayStation 4 and Xbox One as launch titles in the same month.', '', 0),
(27, 'GA3', 'GTA V', 2000, 'Grand Theft Auto V is an open world, action-adventure video game developed by Rockstar North and published by Rockstar Games. It was released on 17 September 2013 for the PlayStation 3 and Xbox 360. It is the fifteenth title in the Grand Theft Auto series, and the first main entry since Grand Theft Auto IV in 2008. Set within the fictional state of San Andreas, based on Southern California, Grand Theft Auto V\'s single-player story follows three criminals and their efforts to execute a number of heists while under pressure from government agencies. The game\'s use of open world design allows the player to freely roam the state\'s countryside and the city of Los Santos, based on Los Angeles.', 'Gta5.jpg', 30),
(25, 'GA1', 'SkyRim', 1000, 'The Elder Scrolls V: Skyrim is an action role-playing video game developed by Bethesda Game Studios and published by Bethesda Softworks.', 'Skyrim.jpg', 10),
(26, 'GA2', 'Skyrim', 1500, 'Assassin\'s Creed IV: Black Flag is a 2013 historical action-adventure open world video game developed by Ubisoft Montreal and published by Ubisoft. It was released worldwide for the PlayStation 3 and Xbox 360 on October 29, 2013; for the Wii U on October 29, 2013 in North America, on November 21, 2013 in Australia, on November 22, 2013 in Europe, and on November 28, 2013 in Japan; for the PlayStation 4 on November 15, 2013 in North America, on November 22, 2013 in Europe, and on November 29, 2013 in Australia; for Microsoft Windows on November 19, 2013 in North America, on November 21, 2013 in Australia, and on November 22, 2013 in Europe; and for the Xbox One on November 22, 2013.', 'Ass4.jpg', 20),
(79, '34', 'sda', 23, 'sad', '', 23),
(80, '3', 'hsad', 1212323, 'sadasdadasdada', '', 55),
(81, '5', 'asd', 2323, 'asd', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `name`, `surname`) VALUES
('u1', 'p1', 'Nalinee', 'Inthamano'),
('u2', 'p2', 'Mintra', 'Deejai');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(255) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_lastname` varchar(255) NOT NULL,
  `member_email` varchar(255) NOT NULL,
  `member_password` varchar(255) NOT NULL,
  `member_level` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_name`, `member_lastname`, `member_email`, `member_password`, `member_level`) VALUES
(1, 'Haris', 'mama', 'Harismama23@gmail.com', '1212', 'ปกติ'),
(2, 'hafis', 'kalu', 'hafis@gamil.com', '010', 'ปกติ');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `pic_id` int(255) NOT NULL,
  `picture` text NOT NULL,
  `rentalroom_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`pic_id`, `picture`, `rentalroom_id`) VALUES
(1, '6137499fb6045_52703.jpeg', 1),
(2, '5f638fb6a4c5e_admin_31362.jpeg', 2),
(3, 'LRM_EXPORT_43506210147196_20181104_220308337.jpeg', 3),
(4, 'IMG_0761.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `rentalroom`
--

CREATE TABLE `rentalroom` (
  `rentalroom_id` int(255) NOT NULL,
  `rentalroom_name` varchar(255) NOT NULL,
  `rentalroom_price` int(10) NOT NULL,
  `rentalroom_name_location` varchar(255) NOT NULL,
  `rentalroom_latitude` text NOT NULL,
  `rentalroom_longitude` text NOT NULL,
  `rentalroom_phone` varchar(25) NOT NULL,
  `rentalroom_limitedroom_sex` varchar(25) NOT NULL,
  `rentalroom_approve` int(1) NOT NULL,
  `rentalroom_facilities` text NOT NULL,
  `category_id` int(25) NOT NULL,
  `member_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rentalroom`
--

INSERT INTO `rentalroom` (`rentalroom_id`, `rentalroom_name`, `rentalroom_price`, `rentalroom_name_location`, `rentalroom_latitude`, `rentalroom_longitude`, `rentalroom_phone`, `rentalroom_limitedroom_sex`, `rentalroom_approve`, `rentalroom_facilities`, `category_id`, `member_id`) VALUES
(1, ' คอนโดรีเจ้นท์โฮมสุขุมวิท 8', 8500, 'ซอย สุขุมวิท 81 แขวง สวนหลวง แขวงสวนหลวง กรุงเทพมหานคร 10250', '13.70662929204076', '100.60811915149073', '020630102', 'รวม', 10, ' แอร์ Sharp 12,000 btu inverter 2 เครื่อง\r\nเตียงพร้อมที่นอนยางพาราอย่างดี\r\nตู้เสื้อผ้าใหญ่\r\nโต๊ะทานข้าว+เก้าอี้\r\nTv + ชั้นวางทีวี และชั้นเก็บของ\r\nโซฟา\r\nตู้เย็น 2 ประตู ระบบประหยัดไฟ\r\nพิเศษ!!! พัดลมติดผนังแบบรีโมท 2 จุด\r\nเครื่องทำน้ำอุ่น+ฝักบัว Rain Shower\r\nโต๊ะเครื่องแป้ง\r\nเคาน์เตอร์ครัวปูน พร้อมซิงค์ล้างจานและตู้เก็บของ\r\nไมโครเวฟ\r\nเครื่องซักผ้า', 1, 1),
(2, ' ดิ เอ็กซ์เซล กรูฟ ลาซาล 52', 7000, 'บางนา สรรพวุธ ลาซาล แบริ่ง สันติคาม ม.รามคำแหง 2 เมกะบางนา เอแบคบางนา', '13.656753937793304', '100.63451884417942', '0220299999', 'รวม', 20, 'โซฟาขนาด 2 ที่นั่ง พร้อมโต๊ะกินข้าวและเก้าอี้ 2 ตัว ชั้นวางทีวี ทีวี และตู้เก็บของที่บิวท์มาให้สุดเพดาน เตียงและที่นอนขนาด 5 ฟุตมีลิ้นชักใต้เตียง ตู้เสื้อผ้าที่ขนาดใหญ่แบบ 3 บาน และโต๊ะเครื่องแป้ง ห้องครัวคราวนี้แบบครัวปิด เป็นประตูกระจกใสบานเลื่อน ได้เคาน์เตอร์ครัวไมโครเวฟ ตู้เย็น เครื่องซักผ้า ห้องน้ำมีเครื่องทำน้ำอุ่น', 2, 2),
(3, 'สราญใจแมนชั่น สุขุมวิท6', 12000, '17/250 สุขุมวิท6 คลองเตย คลองเตย กรุงเทพฯ 10110\r\nตำบล / แขวง คลองเตย\r\nเขต / อำเภอ เขตคลองเตย\r\nจังหวัด กรุงเทพมหานคร', '13.739202220991235', '100.55436458368268', '0222501803', 'รวม', 3, 'ที่จอดรถ\r\nเครื่องปรับอากาศ\r\nระเบียง\r\nไฟฟ้า\r\nน้ำ\r\nตกแต่งครบ', 3, 1),
(4, ' แบงค์คอก ฮอไรซอน', 6500, '14 ถนน นราธิวาสราชนครินทร์ แขวง ทุ่งวัดดอน เขต สาทร กรุงเทพมหานคร 10120', '13.713946750060126', '100.5334096471089', '0222869377', 'รวม', 32, 'ที่จอดรถ\r\nอินเตอร์เน็ต\r\nเคเบิ้ลวิดีโอ\r\nเครื่องปรับอากาศ\r\nตกแต่งครบ', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scorerentalroom`
--

CREATE TABLE `scorerentalroom` (
  `score_id` int(255) NOT NULL,
  `score` int(5) NOT NULL,
  `member_id` int(255) NOT NULL,
  `rentalroom_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD UNIQUE KEY `member_id` (`member_id`,`rentalroom_id`),
  ADD KEY `rentalroom_id` (`rentalroom_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`pic_id`),
  ADD UNIQUE KEY `rentalroom_id` (`rentalroom_id`);

--
-- Indexes for table `rentalroom`
--
ALTER TABLE `rentalroom`
  ADD PRIMARY KEY (`rentalroom_id`),
  ADD UNIQUE KEY `category_id` (`category_id`,`member_id`),
  ADD KEY `rentalroom_ibfk_2` (`member_id`);

--
-- Indexes for table `scorerentalroom`
--
ALTER TABLE `scorerentalroom`
  ADD PRIMARY KEY (`score_id`),
  ADD UNIQUE KEY `member_id` (`member_id`,`rentalroom_id`),
  ADD KEY `rentalroom_id` (`rentalroom_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `pic_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

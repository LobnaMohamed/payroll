-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2020 at 09:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `ID` int(11) NOT NULL,
  `contractType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `creditdedinstallments`
--

CREATE TABLE `creditdedinstallments` (
  `creditDed_id` bigint(20) NOT NULL,
  `installmentDate` date NOT NULL,
  `monthlyValue` decimal(10,2) NOT NULL,
  `remainingValue` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `creditdeductions`
--

CREATE TABLE `creditdeductions` (
  `ID` bigint(20) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `deductionType_id` int(11) NOT NULL,
  `deductionDate` date NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `months` int(11) DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deductiontypes`
--

CREATE TABLE `deductiontypes` (
  `deductionTypeID` int(11) NOT NULL,
  `deductionType` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `empcurrentprofile`
-- (See below for the actual view)
--
CREATE TABLE `empcurrentprofile` (
`ID` int(11)
,`empName` varchar(250)
,`currentCode` int(11)
,`gender` varchar(10)
,`hireDate` date
,`currentShift` varchar(10)
,`contractType` varchar(50)
,`empLevel` varchar(50)
,`maritalStatus` varchar(50)
,`syndicate` varchar(50)
,`job` varchar(200)
,`currentSalary` decimal(10,3)
,`DOB` date
);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `currentCode` int(11) DEFAULT NULL,
  `empName` varchar(250) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `education` varchar(250) DEFAULT NULL,
  `hireDate` date DEFAULT NULL,
  `currentSalary` decimal(10,3) NOT NULL,
  `syndicate_id` int(11) DEFAULT NULL,
  `currentJob` int(11) DEFAULT NULL,
  `currentLevel` int(11) DEFAULT NULL,
  `currentContract` int(11) DEFAULT NULL,
  `currentMS` int(11) DEFAULT NULL,
  `currentRepresentation` double DEFAULT 0 COMMENT 'تمثيل',
  `currentWorkAllowanceNature` double DEFAULT 0 COMMENT 'طبيعة',
  `currentShift` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `currentCode`, `empName`, `gender`, `DOB`, `education`, `hireDate`, `currentSalary`, `syndicate_id`, `currentJob`, `currentLevel`, `currentContract`, `currentMS`, `currentRepresentation`, `currentWorkAllowanceNature`, `currentShift`) VALUES
(1, 33, 'محمود حامد احمد شبارة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(2, 34, 'موسى احمد إبراهيم عبد العال', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(3, 36, 'خالد محمد رافت حرب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(4, 37, 'على محمود السيد سالم ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(5, 40, 'احمد مصطفى اللبان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(6, 41, 'محمد عبد السيد الزقم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(7, 42, 'راندا محمد حسن شهاب', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(8, 43, 'صافيناز جمعة محمود مبروك', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(9, 44, 'عمرو إبراهيم إبراهيم بن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(10, 47, 'رانيا محمود عبد الرحمن المالكى', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(11, 48, 'احمد فتحى احمد عبد الرازق', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(12, 49, 'ياسر احمد محمد اكمل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(13, 51, 'كرم يوسف حسين محمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(14, 55, 'حسام حسن احمد خليل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(15, 60, 'حسام الدين ذكى عبده محمود بركات', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(16, 62, 'اشرف محمد عبده محمد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(17, 64, 'محمد السيد محمد عبد الغفارالصردي', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(18, 65, 'عصام محمد محمد الخوالقة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(19, 69, 'محمد محمود علي ابو العلا', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(20, 70, 'إبراهيم عبد الفتاح عبد الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(21, 71, 'عمرو احمد لطفي شحاتة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(22, 74, 'السيد محمد فرج عدوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(23, 78, 'يوسف عبد الله محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(24, 79, 'محمد احمد محمد منسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(25, 81, 'ريهام محمد بهجت عتيبة', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(26, 82, 'عمرو محمد ممدوح امارة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(27, 83, 'عمرو علي علي سعيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(28, 84, 'السيد مصطفى الغنيمي', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(29, 85, 'مصطفى عبد السلام عبد العليم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(30, 86, 'محمد صالح بسيوني الشافعي', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(31, 88, 'إبراهيم على عبد الحميد الشرقاوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(32, 89, 'محمد احمد جابر البراوي', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(33, 91, 'عماد عبد الرحيم حسين ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(34, 94, 'احمد راشد محمد عبد اللطيف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(35, 100, 'مدحت احمد هويدى احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(36, 101, 'رفعت جلبي اسماعيل ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(37, 102, 'خالد محمد عادل حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(38, 103, 'عمرو محمد نور الدين  الكباريتى ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(39, 104, 'ياسر زغلول محمد  على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(40, 105, 'جمال الدين فاضل مصطفى إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(41, 106, 'إياد وجدى محمود منسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(42, 107, 'هانى احمد كمال شاكر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(43, 108, 'محمد سعيد محمد مرسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(44, 110, 'عادل احمد عبد الراضى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(45, 111, 'مهدى محمد السيد شحاته', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(46, 112, 'محمد حسين محمود بلال', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(47, 113, 'منى لطفى كامل عزيز', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(48, 114, 'حازم اسماعيل على عرفات', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(49, 122, 'حمدى السيد عبد القادر صالح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(50, 123, 'على عمر عبد الحافظ عمر ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(51, 126, 'إبراهيم عبد الحميد محمد متولى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(52, 127, 'الشربينى ياسين امين عبد الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(53, 128, 'محمد جبرجابرمحمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(54, 130, 'طارق فاروق احمد متولى ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(55, 131, 'عطية محمد عيسى احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(56, 132, 'مرسى مصطفى محمد ابو عيسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(57, 133, 'جمال محمد نصار محمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(58, 134, 'جمال عبد الحميد احمد سالم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(59, 135, 'احمد عبد المنعم حسين البنان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(60, 136, 'ابو بكر احمد كيلانى محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(61, 138, 'عوض السيد طه  فرج', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(62, 139, 'مصطفى سلامة سالم  ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(63, 140, 'محمد عبد السلام محمد منصور', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(64, 141, 'على شعبان حسن السبخى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(65, 142, 'عمرو عبد المنعم نصر الطيبانى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(66, 143, 'محمد محمود احمد على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(67, 144, 'زكريا على زكريا على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(68, 145, 'جويدة على جويدة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(69, 146, 'عمر فرج محمد الصاوى ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(70, 147, 'ايهاب احمد عبد الحليم مبروك', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(71, 148, 'خالد عبد الفتاح محمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(72, 150, 'حسام الدين محمد توفيق سليمه ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(73, 151, 'ياسر عبدالله محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(74, 152, 'محمد كامل مبروك عبده', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(75, 153, 'محمد على على كتات', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(76, 154, 'خالد احمد جاب الله عبد المولى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(77, 155, 'ماجد محمد عبد الحميد البرلسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(78, 156, 'وسام محمود الخولى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(79, 159, 'مصطفى عبد الوهاب صالح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(80, 160, 'خالد على زكريا حسن ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(81, 161, 'محمد حسن حفنى السيد البهنساوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(82, 162, 'محمود عوض  عبد الجواد مفتاح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(83, 163, 'عبد الحميد محمد عبد الحميد فرج', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(84, 164, 'السيد محمد مصطفى عمر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(85, 165, 'وحيد حسين احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(86, 166, 'سعيد محمد كمال على حمادة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(87, 167, 'محمد عبد الفتاح سيد احمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(88, 169, 'طارق محمد عرفه', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(89, 171, 'ايهاب محمود محمد عثمان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(90, 173, 'يحيى سالم على سالم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(91, 174, 'حازم محمد سويلم عيسى غازى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(92, 177, 'السيد عبد الحميد محمد المصرى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(93, 179, 'ايهاب عبد الوارث محمد الكردى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(94, 180, 'امل عبد الفتاح احمد ربيع', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(95, 181, 'محمد احمد فوزى عبد السلام', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(96, 184, 'محمد عبد السلام محمود عبد السلام', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(97, 185, 'محمد جابر محمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(98, 186, 'محمد عايد حمد الله إسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(99, 187, 'معروف احمد إسماعيل دربالة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(100, 188, 'عبده عيد محمد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(101, 189, 'إسماعيل بسيونى على محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(102, 192, 'مدحت احمد عبد الدايم عليان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(103, 194, 'حمدى محمد احمد حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(104, 195, 'اشرف رافت عبد الوهاب محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(105, 196, 'محمد محمود سيف فرجانى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(106, 197, 'على منصور محمد سنهورى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(107, 198, 'محمود محمد محمود السيد فودة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(108, 199, 'صلاح محمد محمد محمد خليل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(109, 200, 'حمدى محمد محمد راشد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(110, 201, 'عصام محمد إبراهيم عطا  حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(111, 202, 'ناصر حسن احمد عبد المجيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(112, 204, 'محمد السيد عبد الحميد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(113, 205, 'اشرف السيد مصطفى احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(114, 206, 'سامح حسين محمود بسيونى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(115, 207, 'السيد عبد الرؤف محمد عبد الباسط', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(116, 208, 'محمد حسن إبراهيم ابو المجد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(117, 209, 'جابر محمد سعيد نور الدين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(118, 210, 'محمد عبد الغفار موسى فرج', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(119, 211, 'عوض خميس عوض احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(120, 212, 'جمال احمد يوسف الدراجينى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(121, 213, 'محمد توفيق محمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(122, 214, 'صبرى محفوظ على سلامة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(123, 215, 'احمد فاروق احمد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(124, 216, 'جابر إبراهيم عبد الجليل محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(125, 217, 'ممدوح محمد محمود موسى الفوزى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(126, 218, 'عادل عبد الهادى بخيت احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(127, 221, 'عاطف محمد محمد مصطفى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(128, 222, 'حسام محمد السيد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(129, 223, 'مجدى احمد فؤاد سيد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(130, 225, 'احمد محمد احمد النجار', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(131, 226, 'حسن محمد عمر حسنين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(132, 227, 'عبد الحميد السيد متولى محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(133, 229, 'عماد رشدى عطية محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(134, 230, 'هانى عبد المنعم عبد الحليم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(135, 231, 'يسرى عبد العظيم حسين محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(136, 232, 'السيد يس السيد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(137, 233, 'محمد احمد قطب على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(138, 234, 'السيد هارون السيد سرور', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(139, 235, 'محمد حسين محمد محمود خميس', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(140, 236, 'اشرف السيد محمد خليفة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(141, 237, 'بركة محمد محمد بركة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(142, 238, 'محمد عبد البارى محمد عبد البارى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(143, 241, 'اشرف عبد الحليم محمد جاد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(144, 243, 'عبد الغفار فوزى عبد الغفار محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(145, 244, 'حسام الدين محمد توفيق محمد حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(146, 245, 'عادل نصر إبراهيم بدوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(147, 246, 'حامد عرفات حامد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(148, 247, 'وليد احمد محمود عبد القادر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(149, 248, 'وائل نبيل مصطفى على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(150, 249, 'احمد فتحى عطية محمد التهامى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(151, 250, 'علاء الدين إبراهيم محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(152, 251, 'لمياء حسن محمود احمد', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(153, 252, 'إبراهيم إبراهيم امين إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(154, 254, 'بلال محمد صادق عبد الوهاب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(155, 255, 'حسام فاروق بكر ياقوت', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(156, 261, 'احمد حسين كامل بركات', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(157, 264, 'محمد إبراهيم محمد شاهين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(158, 265, 'علاء محمد سليمان احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(159, 267, 'عماد يحيى عبد اللطيف شرف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(160, 268, 'هدى عادل سعيد الششتاوى', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(161, 269, 'محمد جمعة عبد الرازق بيومى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(162, 270, 'فايق ثابت بخيت حبشى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(163, 271, 'اشرف السيد حسين خليفة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(164, 274, 'محمد محمود السيد موسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(165, 275, 'طارق على محمد  الفولى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(166, 276, 'شريف محمد عبد الحليم  على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(167, 277, 'محمد مسعد عبد الغنى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(168, 278, 'جمال امين عبد الحمبد صالح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(169, 281, 'عبد الحكيم محمود عبد الحكيم داود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(170, 282, 'محمود عبد العزيزالسيد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(171, 283, 'مسعد حسن حسن صفار', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(172, 284, 'احمد محمد بهى الدين محمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(173, 285, 'فتحى عبد الله بيومى الخولى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(174, 287, 'سعيد سلامة محمد عبد العليم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(175, 289, 'عبد المنعم جلبى إسماعيل جلبى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(176, 290, 'احمد محمد محمد على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(177, 292, 'محمد فؤاد محمد على خضر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(178, 293, 'محمد صلاح الدين محمد إبراهيم هيبة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(179, 294, 'محمد عبد المنعم محمد عبد المعطى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(180, 295, 'محمود محمد حسن على المليجى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(181, 297, 'السيد حسن احمد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(182, 298, 'ماهر عبد الله محمد اسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(183, 299, 'ابراهيم محمد السيد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(184, 300, 'شعبان محمد محمد طه', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(185, 302, 'هانى احمد رجب احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(186, 303, 'امير محمد على إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(187, 304, 'محمد محمود حسين عابد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(188, 306, 'ناصر محمد صقر قابل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(189, 307, 'محمد  حسين  حسنين محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(190, 308, 'محمد السيد محمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(191, 309, 'ياسر عطية عزب السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(192, 310, 'حاتم حسن سعيد  عبد الصمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(193, 312, 'صابر حسن السيد الشريف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(194, 313, 'على احمد قدرى حسن محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(195, 314, 'محمد حسن محمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(196, 315, 'حسام حفنى إبراهيم حسان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(197, 316, 'اسامه سعيد محمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(198, 317, 'زكريا احمد آدم ابوزيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(199, 318, 'احمد محمد عبد المحسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(200, 319, 'عصام فرج خليل إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(201, 321, 'هشام محمد نجيب احمد نجيب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(202, 323, 'عماد عبد المنعم محمد الشرقاوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(203, 324, 'محمد فتحى محمد سليمان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(204, 326, 'سليمان السيد سليمان مرسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(205, 327, 'طارق محمد حسن على المليجى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(206, 328, 'كريم محمد احمد ابو العلا', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(207, 329, 'مصطفى محمد خميس محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(208, 330, 'احمد محمد رمضان محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(209, 331, 'محمد محمد محمد حسن غزى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(210, 332, 'محمد رفعت محمد الشاذلى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(211, 333, 'فكرى محمد حسن حسنين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(212, 334, 'جاسر محمود على حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(213, 335, 'معتز ياسر محمد رفعت علوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(214, 336, 'علاء محمد عبد الله مخيون', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(215, 337, 'محمد السيد محمد السيد وهبه', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(216, 338, 'محمد عبد الرزاق إبراهيم احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(217, 339, 'تامر محمد صلاح الدين وحيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(218, 340, 'كامل محمد حسن السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(219, 342, 'محمد عطيه ابو ضيف احمد مسعود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(220, 343, 'مصطفى محمد مصطفى محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(221, 345, 'السيد إبراهيم الشافع حسان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(222, 346, 'وائل فؤاد سعد الدين طاهر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(223, 347, 'احمد فوزى عبد الحميد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(224, 348, 'محمد عبد الستار جوده محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(225, 349, 'عمرو احمد محمد عبد الكريم بلتاجى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(226, 350, 'اشرف احمد سيد حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(227, 351, 'ابراهيم صلاح الدين محمد هيبه', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(228, 352, 'محمد سالم الهادى صالح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(229, 353, 'إبراهيم مصطفى حموده عبد الفتاح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(230, 354, 'محمد امير على صادق', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(231, 355, 'شاهيناز طلعت محمد الخراشى', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(232, 356, 'باهى محمد عبد العظيم عبد الحميد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(233, 358, 'امنية سمير حسن نور الدين', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(234, 359, 'مصطفى العزب محمود  محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(235, 360, 'كريم على امين على سليمان ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(236, 361, 'وائل  محمد رجب السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(237, 362, 'محمد محمود محمد عبد الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(238, 363, 'عمر حسين فتح الله عيسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(239, 364, 'سامح عبد العزيز محمد ابو الخير', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(240, 365, 'وليد محمد عبدالله احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(241, 367, 'غادة يحيى نصر الدين يحيى هيبه', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(242, 369, 'محمد مصطفى مصطفى النزهى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(243, 370, 'عصام محمد محمد السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(244, 371, 'محمد كمال رمضان كشك', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(245, 372, 'محمد محمود درويش ابو بكر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(246, 373, 'رفعت إبراهيم حسن إبراهيم ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(247, 374, 'احمد عبد القادر حسين محمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(248, 375, 'عبد الرازق عبد القادر عبد القادر صالح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(249, 376, 'حسام الدين سعد الدين اسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(250, 377, 'مصطفى ممدوح عيسى عبد الرحيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(251, 378, 'هشام عباس محمد السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(252, 379, 'محمد إبراهيم محمد محمد بيومى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(253, 380, 'وليد شعبان محمد ابو زيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(254, 381, 'حسين عبد العليم عبد العظيم على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(255, 382, 'الحسين كمال عبد الله  عباس', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(256, 383, 'زكريا إبراهيم صابر على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(257, 384, 'كمال عبد الفتاح عبد الوهاب مصطفى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(258, 385, 'محمد حسن جعفر احمد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(259, 386, 'محمد زكى على سليمان النجار', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(260, 388, 'رمضان يحيى محمد عبد العاطى ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(261, 389, 'محمد سمير مصطفى مختار', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(262, 390, 'احمد فوزى السيد سعد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(263, 391, 'احمد محمود احمد اسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(264, 392, 'محمد محمد فتح الله الشريف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(265, 393, 'محمد شحاته سالم سالم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(266, 394, 'ايمن يونس عبد الفتاح عبد الجواد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(267, 395, 'محمد صبحى محمد حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(268, 396, 'ياسر محمد سعيد نور الدين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(269, 397, 'هانى محمد رشاد عبد العزيز', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(270, 398, 'محمد احمد عبد السلام نور الدين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(271, 399, 'محمد محمد حامد مهنا', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(272, 400, 'احمد فوزى ابوضيف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(273, 401, 'وليد يوسف اسماعيل عبد النبى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(274, 402, 'عادل محمد بدوى محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(275, 403, 'عماد السيد محمود مصطفى الفقى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(276, 404, 'عمرو محمد محمد المزين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(277, 405, 'تامر محمد السيد عبد اللطيف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(278, 406, 'احمد محمد اسماعيل على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(279, 407, 'ايهاب احمد عبد الحليم الزلاط', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(280, 408, 'حسن محمود حسن خليل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(281, 409, 'بركات حسن السيد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(282, 410, 'محمد إبراهيم عبد الموجود ابو النصر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(283, 411, 'محمد السيد محمد حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(284, 412, 'حاتم محمود محمد محمد محجوب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(285, 413, 'قنديل متولى قنديل متولى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(286, 414, 'ايمن عبد المجيد عيد خليل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(287, 416, 'شريف رضوان ضيف الله عبد العاطى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(288, 417, 'اسامه حمدى السيد محمد حسنين ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(289, 419, 'محمد محمد محمد إبراهيم البادى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(290, 420, 'محمد محمد محمد محمد دياب ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(291, 421, 'محمد عبد الله عبد الحميد بدران', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(292, 422, 'وليد طلعت احمد محمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(293, 423, 'تامر احمد تامر احمد منصور', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(294, 424, 'منصور مرسى الدسوقى محمد حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(295, 425, 'احمد كامل محمد محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(296, 427, 'حبيب محمد حبيب محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(297, 428, 'احمد فوزى عبد الرحمن احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(298, 429, 'محمود احمد محمود عرابى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(299, 430, 'محمد عطيه محمد خميس ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(300, 431, 'عيد عبد القادر محمد عبد الرازق', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(301, 432, 'محمد عبد المنعم على الدسوقى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(302, 433, 'رامى السيد على محمود هلال', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(303, 434, 'هيثم احمد مختار إبراهيم على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(304, 435, 'طه كامل طه عقل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(305, 436, 'طلعت لبيب حماد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(306, 437, 'شريف احمد محمد مصطفى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(307, 438, 'عبد المجيد عبد الفتاح عبد المجيد محمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(308, 439, 'محمد ياقوت إبراهيم سيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(309, 440, 'احمد عبد المنعم السيد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(310, 441, 'محمد علاء الدين حمزه عبد العاطى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(311, 442, 'قطب خليفه السيد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(312, 443, 'محمد وجيه على على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(313, 444, 'عبد السميع رمضان عبد المجيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(314, 445, 'احمد حسن خميس حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(315, 446, 'محمد إبراهيم يونس رضوان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(316, 447, 'هشام عباس عرابى عباس', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(317, 448, 'وائل محمد فهمى حامد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(318, 449, 'اسامه عبد المنعم محمد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(319, 450, 'محمد محمد محمود بخاتى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(320, 451, 'محمد فتحى محمد ابو راحج', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(321, 452, 'صبرى محمد خضر مهدى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(322, 453, 'السيد على عبد العاطى ابو سلامه', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(323, 454, 'إبراهيم محمد رضوان محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(324, 455, 'محمود سليمان عبد السلام احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(325, 456, 'محمد عبد المنعم عباس إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(326, 457, 'سعيد عجمى عبد السلام محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(327, 458, 'محمد درويش محمد درويش', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(328, 459, 'مدحت صابر السيد جابر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(329, 460, 'ايمن احمد عبد الحميد عبد العزيز', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(330, 461, 'محمد زين العابدين السيد الطيب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(331, 462, 'طارق إبراهيم محمد القليط', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(332, 463, 'ايهاب محمود محمد الطويل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(333, 464, 'محمد فهمى على عبد الباقى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(334, 465, 'احمد سعيد محمد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(335, 466, 'اشرف احمد رجب احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(336, 467, 'عماد الدين سمير توفيق ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(337, 468, 'انس محمود احمد عليمى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(338, 469, 'خالد السمان احمد رحاب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(339, 470, 'محمد جابر احمد طه', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(340, 471, 'محمد عبد القادر حسن يوسف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(341, 472, 'راضى عبد الحافظ على الجمل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(342, 473, 'محمد حسين رزق إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(343, 474, 'هانى إبراهيم عبد المجيد يوسف ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(344, 475, 'مدحت احمد مصطفى احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(345, 476, 'محمد عبد النبى عسران على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(346, 477, 'احمد حسن إبراهيم قاسم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(347, 478, 'احمد عبد الله سيد محمد عيسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(348, 479, 'محمد البدرى محمد بسطاوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(349, 480, 'حسن احمد عبد الله نصر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(350, 481, 'محمد جابر محمد رفاعى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(351, 482, 'رامى محمود جمعه عبد المجيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(352, 483, 'محمد صبره محمد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(353, 484, 'احمد محمد احمد الحداد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(354, 486, 'على عبد الله مختار', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(355, 487, 'عصام عبد الرؤوف على سليمان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(356, 488, 'اسامه ابو اليزيد الشاميه', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(357, 489, 'اسماعيل السيد اسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(358, 490, 'محمود احمد رجب احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(359, 491, 'هانى محمد عبد الحميد الصياد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(360, 492, 'محمد حسن رسلان عبد العزيز', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(361, 493, 'محمد كمال عبد الرحيم السقعان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(362, 494, 'حامد محمد زياده نويشى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(363, 495, 'اشرف اسماعيل احمد الشاذلى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(364, 497, 'إسلام محمد صالح صادق', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(365, 498, 'محمد رياض عبد الغنى نعيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(366, 499, 'محمد محمود محمد السيد عبد الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(367, 500, 'محمد احمد عبد المجيد السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(368, 501, 'طارق بيومى محمود عصر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(369, 502, 'محمد جابر حسن محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(370, 503, 'ايمن محمد محمد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(371, 504, 'احمد حمدى عبد الجليل حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(372, 505, 'إبراهيم عبد الخالق احمد هجام', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(373, 506, 'حسام الدين مصطفى حسن إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(374, 507, 'حامد احمد محمد احمد عيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(375, 508, 'عماد درويش السيد درويش', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(376, 509, 'عبد العزيز محمود عبد العزيز احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(377, 510, 'عاطف محمد احمد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(378, 511, 'سعيد سعيد إبراهيم سالم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(379, 512, 'السيد شفيق السيد شحاتة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(380, 513, 'سعد الدين حسن سعد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(381, 514, 'محمد سعيد سليمان عثمان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(382, 515, 'خالد حنفى محمود حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(383, 516, 'ممدوح محمد عبد الحميد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(384, 517, 'خير الله عبد الرحمن خير الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(385, 518, 'محمد عبد الفتاح محمد عبد الفتاح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(386, 519, 'محمد عبد الحميد محمد عبد الرحيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(387, 520, 'محمد عبد الحليم عبده', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(388, 522, 'إبراهيم على على عيسى النجار', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(389, 523, 'محمد ربيع عبد التواب طه الصرفى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(390, 524, 'محمد عبد النبى احمد الشريف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(391, 525, 'محمد فهمى السيد سليمان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(392, 527, 'إبراهيم عيد السيد قريش', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(393, 528, 'احمد عبد السلام عبد العزيز المنطاوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(394, 529, 'محمد سعيد احمد شلبى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(395, 530, 'محمد شلبى عبد اللطيف محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(396, 531, 'ايمن محمد محمد نعمان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(397, 532, 'مصطفى عوض عبد الوهاب وهدان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(398, 533, 'جمال محمد محمود على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(399, 535, 'حميدو على جويده عبد الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(400, 536, 'مصطفى عبد العال احمد على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(401, 537, 'احمد فهمى احمد محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(402, 539, 'محمد كمال الدين احمد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(403, 540, 'حسن انور عبد الحميد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(404, 542, 'عبد الجليل فتحى عبد الجليل محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(405, 543, 'حلمى عبد اللطيف عبد الحليم الصفتى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(406, 544, 'محمود محمد محمود بسيونى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(407, 545, 'محمد عبد الجواد ابو العلا القنواتى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(408, 546, 'محمد احمد محمد بخيت', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(409, 547, 'نادر احمد جاب الله محمد الطباخ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(410, 549, 'احمد عبد السلام عوض فرج', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL);
INSERT INTO `employee` (`ID`, `currentCode`, `empName`, `gender`, `DOB`, `education`, `hireDate`, `currentSalary`, `syndicate_id`, `currentJob`, `currentLevel`, `currentContract`, `currentMS`, `currentRepresentation`, `currentWorkAllowanceNature`, `currentShift`) VALUES
(411, 550, 'عبد الله محمد عبد النبى خلاف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(412, 551, 'وليد الحسينى زكى محمد الديب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(413, 553, 'طارق عطيه عبد الرحمن محمد ابو طه', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(414, 554, 'محمد احمد محمد على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(415, 555, 'علاء الدين محمد محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(416, 556, 'محمد مصطفى طه مهيا', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(417, 557, 'السيد إبراهيم السيد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(418, 559, 'عبد النعيم إبراهيم عبد النعيم  صالح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(419, 561, 'احمد كريم مصطفى حسين الديب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(420, 562, 'هشام بدر حسن محمد مرسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(421, 563, 'اسلام عادل حسن سلطان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(422, 564, 'إبراهيم الصغير بسيونى إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(423, 565, 'وحيد سعيد عبد المنعم محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(424, 566, 'إسلام إبراهيم حماده محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(425, 567, 'محمود عباس صديق محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(426, 568, 'محمد سباق حجازى السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(427, 569, 'محمد احمد عبد الله الشناوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(428, 570, 'وجيه على حسن عثمان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(429, 571, 'ياسر فتحى محمد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(430, 572, 'محمود شكرى جاد الكريم محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(431, 573, 'محمود عنتر محمود السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(432, 574, 'احمد محمد صلاح احمد ندا', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(433, 575, 'اشرف عبد الراضى سليمان منصور', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(434, 576, 'محمد السيد إبراهيم محمد هريدى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(435, 577, 'احمد محمود ناجى على مصطفى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(436, 578, 'محمد يوسف محمد الغريب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(437, 579, 'احمد إسماعيل محمود إسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(438, 580, 'سامح جابر احمد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(439, 581, 'على احمد محمود ناصر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(440, 582, 'على سمير السيد ياقوت', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(441, 584, 'رمضان عبد الحميد مصطفى اسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(442, 585, 'السيد احمد عبد الرحمن عبد الكريم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(443, 586, 'حسن محمد حسن حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(444, 587, 'ايمن محمد محمود السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(445, 588, 'خالد محمد عبد الحميد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(446, 589, 'محمد كامل محمد كامل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(447, 590, 'عماد محمد محمود احمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(448, 591, 'احمد عبد الفضيل عبد النعيم عبد الجليل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(449, 592, 'سامح إسماعيل محمد إسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(450, 593, 'منى عباس إبراهيم السيد', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(451, 594, 'محمد بركات محمد جابر الانصارى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(452, 595, 'لطفى عباس احمد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(453, 596, 'احمد احمد على محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(454, 597, 'محمد عزيز محمود سيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(455, 598, 'محمد احمد السيد عمر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(456, 599, 'احمد فتحى عبد الغنى الشافعى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(457, 600, 'احمد صابر عبد العزيز موسى إسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(458, 601, 'احمد محمد محمود على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(459, 602, 'ابوزيد رزق ابوزيد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(460, 603, 'مصطفى فوزى عيد عبد القادر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(461, 605, 'اشرف إبراهيم سالم الحلفاوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(462, 606, 'محمد فريد السيد دومة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(463, 607, 'السيد شحاته راشد بيومى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(464, 608, 'مصطفى سعيد السيد سليم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(465, 609, 'محمد السيد محمد السيد بكرى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(466, 610, 'رضا عليوه محمد سليمان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(467, 611, 'اشرف رشاد على محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(468, 613, 'جمعه عسران ابو الحمد عسران', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(469, 614, 'محمد عبد اللطيف محمد الفقى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(470, 615, 'نبيل محمد السيد حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(471, 616, 'مصطفى شكرى محمد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(472, 617, 'محمد سعيد صبحى هاشم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(473, 618, 'ايهاب فاروق عبد العزيز محمود ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(474, 619, 'احمد حسن احمد خمخم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(475, 620, 'غادة محمد ياقوت صبره', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(476, 621, 'حمدى محمد محمد فرج الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(477, 622, 'سعيد محمد جمال الشبراوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(478, 623, 'احمد سيف الإسلام احمد عبد القادر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(479, 624, 'ايهاب جابر احمد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(480, 626, 'مروان احمد عوض السيد سيف الدين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(481, 627, 'علاء مسعد على على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(482, 628, 'هشام عبدالظاهر عبدالراضى محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(483, 629, 'ايمن عبدالفتاح عبدالحميد النويهى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(484, 630, 'عطيه فتحى عبد الفتاح عبد العزيز', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(485, 631, 'محمد محرم إبراهيم مجاهد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(486, 632, 'محمد صبحى جودت الجعرانى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(487, 633, 'وليد جابر محمود حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(488, 634, 'ابراهيم حامد احمد ماضى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(489, 635, 'نور الدين خميس محمد  محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(490, 636, 'شفيق عبد الفتاح عبد الفتاح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(491, 637, 'هشام اسماعيل صديق اسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(492, 638, 'محمد محمود ابو المجد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(493, 639, 'خالد السيد محمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(494, 640, 'احمد إبراهيم عبد العزيز عبد المعطى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(495, 641, 'التركى محمد محمد عطية', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(496, 644, 'حازم احمد حسن عبد الرحمن راشد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(497, 645, 'اسامة كمال عبد العزيز احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(498, 646, 'ياسر على محمد خليف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(499, 647, 'السيد احمد على محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(500, 648, 'عماد عزت عبد الجواد منصور', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(501, 649, 'محمد عبد المنعم سالم بدر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(502, 650, 'حسن عبد السلام السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(503, 651, 'السيد فتح الله محمد دربالة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(504, 652, 'محمد مهدى سعيد رمضان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(505, 653, 'راضى على عبد القادر محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(506, 654, 'هانى محسن محمد الراوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(507, 655, 'محمد عبد الرحمن محمد الشرقاوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(508, 656, 'محمد فتحى محمد عبد اللطيف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(509, 657, 'غازى محمد على مبروك', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(510, 658, 'عماد عبد الغنى عبد المولى موسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(511, 659, 'احمد إسماعيل احمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(512, 660, 'رامى مصطفى محمود احمد الخياط', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(513, 661, 'ياسر محمد عبد المنعم رزق', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(514, 662, 'اسامة السيد موسى ابو زيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(515, 663, 'محمود محمود عبد الحى حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(516, 664, 'امير عاشور محمود سالم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(517, 665, 'محمد إبراهيم عبد الهادى احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(518, 666, 'وائل عادل محمد إسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(519, 667, 'نجوى مصطفى محمد الطوخى', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(520, 668, 'مصطفى السيد عبد اللطيف قنديل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(521, 669, 'احمد حامد إبراهيم حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(522, 670, 'عماد حمدى عبد العليم الحنفى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(523, 671, 'محمود وحيد محمود الصيرفى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(524, 672, 'ايهاب عباس محمد على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(525, 673, 'علاء جابر محمد احمد مسعود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(526, 675, 'محمد محمود محمد يوسف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(527, 676, 'ياسر حسن احمد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(528, 677, 'احمد محمد عقل على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(529, 678, 'إسلام صالح بهلول احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(530, 679, 'شادى محمد احمد حلمى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(531, 680, 'إسلام سيف الإسلام عبد الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(532, 681, 'احمد محمد حسان عبد المجيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(533, 682, 'محمد فوزى إبراهيم مليجى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(534, 683, 'علاء محمد مصطفى ابو الدهب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(535, 684, 'إسلام السيد رجب محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(536, 685, 'محمد عبد الرحمن عبد العزيز إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(537, 686, 'هيثم احمد محمد محمد حزين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(538, 687, 'بدوى على محمد السيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(539, 689, 'احمد عبد اللطيف احمد عبد اللطيف', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(540, 690, 'محمد محمد على محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(541, 691, 'عمرو سعيد محمد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(542, 692, 'احمد شعبان إبراهيم احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(543, 694, 'عصام الدين احمد محمد بدر الدين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(544, 695, 'احمد محمد عبد القادر غباشى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(545, 696, 'عمرو السيد محمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(546, 697, 'حسن عبد السلام توفيق مرسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(547, 698, 'محمد محمد عبد الهادى الروبى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(548, 701, 'خالد محمود احمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(549, 702, 'سامح حبشى جاد حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(550, 703, 'محمد صابر عبد الرحمن على المهدى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(551, 704, 'صابر سيد ابو ضيف محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(552, 705, 'صالح عطية صالح عبد الرازق', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(553, 706, 'حمادة شعبان مختار مرسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(554, 707, 'ايهاب عبد الفتاح محمود الخياط', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(555, 708, 'طارق محمد مهدى مجاهد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(556, 709, 'وائل مصطفى عبد السلام', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(557, 710, 'ياسر محمد رمضان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(558, 712, 'احمد محمد متولى إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(559, 714, 'ايمن اسماعيل عبد الحميد محمد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(560, 715, 'حسين سعيد حسين الشاذلى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(561, 716, 'عمرو عبد الحميد محمد عبد الحميد ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(562, 717, 'محمود محمد إسماعيل على الصياد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(563, 718, 'احمد محمد عبده خليل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(564, 721, 'خالد محمود سليم ريحان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(565, 722, 'فتحى عبد العاطى جاب الله العياط', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(566, 723, 'محمد عبد الناصر محمود حسب الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(567, 724, 'ابراهيم كامل محمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(568, 725, 'خالد محمد عطية  إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(569, 726, 'محمد رضا محمد سلامة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(570, 727, 'نبيل محمد محمد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(571, 728, 'سعد احمد محمد احمد درويش', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(572, 729, 'محمد محمد سعد القالع', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(573, 730, 'ياسر محمد السيد منصور', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(574, 731, 'احمد فتحى ضاحى اسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(575, 734, 'محمد عبد العليم عبد العظيم على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(576, 735, 'محمد احمد عبد اللطيف قاسم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(577, 736, 'اكرم احمد عبد الغنى التمين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(578, 737, 'احمد عادل عبد المنعم ابراهيم الملاح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(579, 738, 'ريم متولى حسين احمد مصطفى', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(580, 739, 'على رشاد على محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(581, 740, 'ايمان كمال محمد قنديل', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(582, 741, 'احمد فارس عبد الفتاح الشال', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(583, 742, 'ماجى محمد عبد الغنى عفيفى', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(584, 743, 'ايمن يوسف عازر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(585, 744, 'محمود ابراهيم عبد المطلب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(586, 746, 'محمد إبراهيم محمد عبد الحميد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(587, 747, 'عبد المقصود محمود على حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(588, 748, 'كمال حمدى عبد الواحد عباس', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(589, 749, 'سامح عبد الرحمن محمد عبد الرحمن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(590, 750, 'على حسين عبد العزيز حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(591, 751, 'محمد همام عيسى ثابت', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(592, 752, 'محمد موسى خليفة النحال', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(593, 753, 'محمد عبد الله عبد العظيم عبد اللاه', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(594, 754, 'عاطف صبرى محروس', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(595, 755, 'فتحى رمضان محمد بخيت', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(596, 757, 'محمد إبراهيم محمد ابو شعيشع', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(597, 758, 'خالد احمد امين هدية', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(598, 759, 'محمد عبد العال عبد الراضى محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(599, 760, 'فرج عبد الباعث فرج الاخرس', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(600, 761, 'محمد السيد عطيه ابو قمر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(601, 762, 'محمد محمد عوض البربرى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(602, 763, 'محمد سعد السيد الفرنوانى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(603, 764, 'محمود جابر محمود البرقامى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(604, 765, 'اسلام يوسف محمد محمود', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(605, 766, 'غريب مصطفى غريب جمعة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(606, 767, 'حسن محمد محمد حسن عبد الرحمن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(607, 768, 'عمر محمد رزق الزير', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(608, 769, 'موسى السيد ادريس نوح', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(609, 770, 'محمد سعيد عبد الرؤف حسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(610, 771, 'محمد عبد الحى سالم الزعلوك', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(611, 772, 'احمد السيد احمد محمد إسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(612, 773, 'احمد زكى محمد سعد فوزى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(613, 774, 'اسامة إبراهيم الدسوقى محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(614, 775, 'عمرو احمد محمد إبراهيم عطيان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(615, 776, 'محمد مبروك إبراهيم خطاب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(616, 777, 'على خميس عوض على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(617, 778, 'على طه محمد علام', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(618, 779, 'وائل محمد حسين عكاز', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(619, 780, 'ايمن عبد الرحمن عبد الحفيظ', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(620, 781, 'رمضان محمد حامد محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(621, 782, 'محمد كامل صابر جاب الله', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(622, 783, 'صفوت مصطفى عبد الرازق درويش', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(623, 784, 'محمد بدوى فتح الله بدوى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(624, 785, 'محمد الزناتى يوسف على', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(625, 786, 'جابر محمود ابو بكر ابوالحسن', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(626, 787, 'جميل على عبد العزيز زيد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(627, 788, 'محمد مصطفى محمد رشاد ابو الخير', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(628, 789, 'إبراهيم زهران محمود ابو زهرة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(629, 790, 'رجب انور شحاتة السمديسى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(630, 791, 'علاء محمد محمد حسين', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(631, 792, 'محمد محروس عثمان محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(632, 793, 'محمد عبد العزيز احمد إبراهيم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(633, 794, 'محمد زكى عبده بركات', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(634, 795, 'وائل على مصطفى كامل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(635, 796, 'هبة حسن مدحت محمد حسن', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(636, 798, 'احمد محمد سيد محمود عمر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(637, 799, 'هيثم حسن احمد رزق', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(638, 800, 'احمد صالح يوسف رجب', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(639, 801, 'عمرو محمد محمد احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(640, 802, 'نصر إبراهيم عبد العال إسماعيل', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(641, 803, 'محمد محمود مختار ابو سمرة', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(642, 804, 'السيد مصطفى السيد الحلوانى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(643, 805, 'عمرو سالم حسن سالم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(644, 806, 'احمد محمد محمد عبد الحليم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(645, 807, 'احمد فتحى حسن محمد العوفى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(646, 808, 'حسام الدين عبد الحميد معروف محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(647, 809, 'محمد عبد الرؤف عبد الحليم البنا', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(648, 810, 'على السيد محمد على حسن السقا', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(649, 811, 'محمد خميس عبد الغنى عمر', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(650, 812, 'على عبد السلام محمد ابو زيان', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(651, 813, 'جاد محمد جاد الكريم', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(652, 814, 'اسلام محمود محمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(653, 816, 'ممدوح خميس عوض احمد', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(654, 817, 'ياسر عبد العزيز عطية', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(655, 819, 'محمد محمود عباس العتى', 'ذكر', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL),
(656, 820, 'غادة محمد نجيب جمال حماد', 'انثى', '0000-00-00', NULL, NULL, '0.000', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `empnatureallowance_changes`
--

CREATE TABLE `empnatureallowance_changes` (
  `emp_id` int(11) NOT NULL,
  `workNatureDate` date NOT NULL,
  `workAllowanceNature` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emprepresentationallowance_changes`
--

CREATE TABLE `emprepresentationallowance_changes` (
  `emp_id` int(11) NOT NULL,
  `representationDate` date NOT NULL,
  `representationAllowance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emptimesheet`
--

CREATE TABLE `emptimesheet` (
  `TS_id` bigint(20) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `presence_days` double NOT NULL DEFAULT 30,
  `sickLeave_days` double NOT NULL DEFAULT 0 COMMENT 'مرضى',
  `deduction_days` double NOT NULL DEFAULT 0 COMMENT 'بالخصم',
  `absence_days` double NOT NULL DEFAULT 0 COMMENT 'الانقطاع',
  `annual_days` double NOT NULL DEFAULT 0 COMMENT 'سنوى',
  `casual_days` double NOT NULL DEFAULT 0 COMMENT 'عارضة',
  `manufacturing_days` double NOT NULL DEFAULT 0 COMMENT 'تصنيع',
  `overnight_days` double NOT NULL DEFAULT 0 COMMENT 'ايام نوباتجية',
  `shift_days` double NOT NULL DEFAULT 0 COMMENT 'ايام الوردية',
  `notes` varchar(250) DEFAULT NULL,
  `evaluationPercent` double DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_basicsalary`
--

CREATE TABLE `emp_basicsalary` (
  `emp_id` int(11) NOT NULL,
  `basicSalary` decimal(10,3) NOT NULL,
  `salaryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_contract`
--

CREATE TABLE `emp_contract` (
  `emp_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `contract_date` date NOT NULL,
  `empCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_job`
--

CREATE TABLE `emp_job` (
  `emp_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_date` date NOT NULL,
  `job_description` varchar(300) DEFAULT NULL,
  `shift` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_level`
--

CREATE TABLE `emp_level` (
  `emp_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `level_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_maritalstatus`
--

CREATE TABLE `emp_maritalstatus` (
  `emp_id` int(11) NOT NULL,
  `marital_status_id` int(11) NOT NULL,
  `marital_status_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_overnight`
--

CREATE TABLE `emp_overnight` (
  `TS_id` bigint(20) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `overnight_days` double DEFAULT NULL,
  `overnight_deserveddays` double DEFAULT NULL,
  `notes` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_shift`
--

CREATE TABLE `emp_shift` (
  `TS_id` bigint(20) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `shift_days` double DEFAULT NULL,
  `cashperday` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `notes` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emp_sickleaves`
--

CREATE TABLE `emp_sickleaves` (
  `TS_id` bigint(20) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `sick_leavesDays` double DEFAULT NULL,
  `continious` tinyint(1) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `real_sickLeaves` double DEFAULT NULL,
  `totalAmountDeducted` double DEFAULT NULL,
  `notes` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `ID` int(11) NOT NULL,
  `job` varchar(200) NOT NULL,
  `level_id` int(11) NOT NULL,
  `experience_amount` double DEFAULT NULL COMMENT 'قيمة الخبرة',
  `specialization_amount` double NOT NULL COMMENT 'قيمة التخصص',
  `representation_amount` double NOT NULL COMMENT 'تمثيل'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `ID` int(11) NOT NULL,
  `empLevel` varchar(50) NOT NULL,
  `incentivePercent` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `ID` bigint(20) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `bankName` varchar(50) NOT NULL,
  `loanDate` date NOT NULL,
  `no_of_installments` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maritalstatus`
--

CREATE TABLE `maritalstatus` (
  `ID` int(11) NOT NULL,
  `maritalStatus` varchar(50) NOT NULL,
  `social_insurance` double NOT NULL,
  `med_insurance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `TS_id` bigint(20) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `salaryDescription` varchar(250) DEFAULT NULL,
  `attendancePay` decimal(10,2) DEFAULT 0.00 COMMENT 'أجر الحضور',
  `natureOfworkAllowance` decimal(10,2) DEFAULT 0.00 COMMENT 'بدل طبيعة',
  `socialAid` decimal(10,2) DEFAULT 0.00 COMMENT 'م.اجتماعية',
  `representation` decimal(10,2) DEFAULT 0.00 COMMENT 'تمثيل',
  `occupationalAllowance` decimal(10,2) DEFAULT 0.00 COMMENT 'بدل مهنى',
  `experience` decimal(10,2) DEFAULT 0.00 COMMENT 'خبرة',
  `specialBonus` decimal(10,2) DEFAULT 0.00 COMMENT 'علاوات خاصة',
  `overnightShift` decimal(10,2) DEFAULT 0.00 COMMENT 'نوباتجية',
  `laborDayGrant` decimal(10,2) DEFAULT 0.00 COMMENT 'منحة عيد العمال',
  `tiffinAllowance` decimal(10,2) DEFAULT 0.00 COMMENT 'وجبات نقدية',
  `incentive` decimal(10,2) DEFAULT 0.00 COMMENT 'حافز',
  `shift` decimal(10,2) DEFAULT 0.00 COMMENT 'وردية',
  `specializationAllowance` decimal(10,2) DEFAULT 0.00 COMMENT 'بدل تخصص',
  `manufacturingAllowance` decimal(10,2) DEFAULT 0.00 COMMENT 'بدل تصنيع',
  `otherDues` decimal(10,2) DEFAULT 0.00 COMMENT 'استحقاق',
  `additionalIncentive` decimal(10,2) DEFAULT 0.00,
  `pastPeriod` decimal(10,2) DEFAULT 0.00 COMMENT 'مدة سابقة',
  `perimiumCard` decimal(10,2) DEFAULT 0.00 COMMENT 'كارت بريميوم',
  `familyHealthInsurance` decimal(10,2) DEFAULT 0.00 COMMENT 'علاج أسر',
  `otherDeduction` decimal(10,2) DEFAULT 0.00 COMMENT 'إستقطاع أخر',
  `petroleumSyndicate` decimal(10,2) DEFAULT 10.00 COMMENT 'ن.بترول',
  `sanctions` decimal(10,2) DEFAULT 0.00 COMMENT 'جزاءات',
  `mobil` decimal(10,2) DEFAULT 0.00 COMMENT 'موبايل',
  `loan` decimal(10,2) DEFAULT 0.00 COMMENT 'قرض',
  `empServiceFund` decimal(10,2) DEFAULT 20.00 COMMENT 'صندوق خدمات عاملين',
  `socialInsurances` decimal(10,2) DEFAULT 0.00 COMMENT 'تأمينات',
  `etisalatNet` decimal(10,2) DEFAULT 0.00 COMMENT 'اتصالات',
  `totalBenefits` decimal(10,2) DEFAULT NULL,
  `totalDeductions` decimal(10,2) DEFAULT NULL,
  `netSalary` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sanctions`
--

CREATE TABLE `sanctions` (
  `TS_id` bigint(20) NOT NULL,
  `employee_ID` int(11) NOT NULL,
  `sanctionDays` double NOT NULL DEFAULT 0,
  `sanctionAmount` decimal(10,2) NOT NULL,
  `sanctionNotes` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `syndicates`
--

CREATE TABLE `syndicates` (
  `ID` int(11) NOT NULL,
  `syndicate` varchar(50) NOT NULL,
  `amount` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timesheets`
--

CREATE TABLE `timesheets` (
  `ID` bigint(20) NOT NULL,
  `sheetDate` date DEFAULT NULL,
  `description` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_data`
--

CREATE TABLE `t_data` (
  `ID` double DEFAULT NULL,
  `emp_code` double DEFAULT NULL,
  `emp_name` varchar(255) DEFAULT NULL,
  `contract_type` double DEFAULT NULL,
  `id_job` double DEFAULT NULL,
  `desc_job` varchar(255) DEFAULT NULL,
  `level_id` double DEFAULT NULL,
  `management` varchar(255) DEFAULT NULL,
  `g_management_id` double DEFAULT NULL,
  `day_night` double DEFAULT NULL,
  `active` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `empcurrentprofile`
--
DROP TABLE IF EXISTS `empcurrentprofile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `empcurrentprofile`  AS  select `e`.`ID` AS `ID`,`e`.`empName` AS `empName`,`e`.`currentCode` AS `currentCode`,`e`.`gender` AS `gender`,`e`.`hireDate` AS `hireDate`,`e`.`currentShift` AS `currentShift`,`c`.`contractType` AS `contractType`,`l`.`empLevel` AS `empLevel`,`ms`.`maritalStatus` AS `maritalStatus`,`s`.`syndicate` AS `syndicate`,`j`.`job` AS `job`,`e`.`currentSalary` AS `currentSalary`,`e`.`DOB` AS `DOB` from (((((`employee` `e` join `syndicates` `s`) join `contract` `c`) join `level` `l`) join `maritalstatus` `ms`) join `job` `j`) where `e`.`syndicate_id` = `s`.`ID` and `e`.`currentJob` = `j`.`ID` and `e`.`currentLevel` = `l`.`ID` and `e`.`currentContract` = `c`.`ID` and `e`.`currentMS` = `ms`.`ID` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `creditdedinstallments`
--
ALTER TABLE `creditdedinstallments`
  ADD KEY `FK_creditDedInstallments_ID` (`creditDed_id`);

--
-- Indexes for table `creditdeductions`
--
ALTER TABLE `creditdeductions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_creditDeductions_employee` (`emp_id`),
  ADD KEY `FK_creditDeductions_deductionTypes` (`deductionType_id`);

--
-- Indexes for table `deductiontypes`
--
ALTER TABLE `deductiontypes`
  ADD PRIMARY KEY (`deductionTypeID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `currentCode` (`currentCode`);

--
-- Indexes for table `empnatureallowance_changes`
--
ALTER TABLE `empnatureallowance_changes`
  ADD PRIMARY KEY (`emp_id`,`workNatureDate`);

--
-- Indexes for table `emprepresentationallowance_changes`
--
ALTER TABLE `emprepresentationallowance_changes`
  ADD PRIMARY KEY (`emp_id`,`representationDate`);

--
-- Indexes for table `emptimesheet`
--
ALTER TABLE `emptimesheet`
  ADD PRIMARY KEY (`TS_id`,`emp_id`),
  ADD KEY `FK_emp_empTimesheet` (`emp_id`);

--
-- Indexes for table `emp_basicsalary`
--
ALTER TABLE `emp_basicsalary`
  ADD PRIMARY KEY (`emp_id`,`basicSalary`);

--
-- Indexes for table `emp_contract`
--
ALTER TABLE `emp_contract`
  ADD PRIMARY KEY (`emp_id`,`contract_id`),
  ADD KEY `FK_emp_contract_contractid` (`contract_id`);

--
-- Indexes for table `emp_job`
--
ALTER TABLE `emp_job`
  ADD PRIMARY KEY (`emp_id`,`job_id`,`job_date`),
  ADD KEY `FK_emp_job_job_id` (`job_id`);

--
-- Indexes for table `emp_level`
--
ALTER TABLE `emp_level`
  ADD PRIMARY KEY (`emp_id`,`level_id`),
  ADD KEY `FK_emp_level_level_id` (`level_id`);

--
-- Indexes for table `emp_maritalstatus`
--
ALTER TABLE `emp_maritalstatus`
  ADD PRIMARY KEY (`emp_id`,`marital_status_id`),
  ADD KEY `FK_emp_maritalstatus_ms_id` (`marital_status_id`);

--
-- Indexes for table `emp_overnight`
--
ALTER TABLE `emp_overnight`
  ADD PRIMARY KEY (`TS_id`,`emp_id`),
  ADD KEY `FK_emp_overnight_employeeid` (`emp_id`);

--
-- Indexes for table `emp_shift`
--
ALTER TABLE `emp_shift`
  ADD PRIMARY KEY (`TS_id`,`emp_id`),
  ADD KEY `FK_emp_shift_employee_id` (`emp_id`);

--
-- Indexes for table `emp_sickleaves`
--
ALTER TABLE `emp_sickleaves`
  ADD PRIMARY KEY (`TS_id`,`emp_id`),
  ADD KEY `FK_emp_sickLeaves_employee` (`emp_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_job_level` (`level_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_emp_loan` (`emp_id`);

--
-- Indexes for table `maritalstatus`
--
ALTER TABLE `maritalstatus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`TS_id`,`emp_id`),
  ADD KEY `FK_emp_salary` (`emp_id`);

--
-- Indexes for table `sanctions`
--
ALTER TABLE `sanctions`
  ADD PRIMARY KEY (`TS_id`,`employee_ID`),
  ADD KEY `FK_emp_sanctions` (`employee_ID`);

--
-- Indexes for table `syndicates`
--
ALTER TABLE `syndicates`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `timesheets`
--
ALTER TABLE `timesheets`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deductiontypes`
--
ALTER TABLE `deductiontypes`
  MODIFY `deductionTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=657;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maritalstatus`
--
ALTER TABLE `maritalstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `syndicates`
--
ALTER TABLE `syndicates`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timesheets`
--
ALTER TABLE `timesheets`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `creditdedinstallments`
--
ALTER TABLE `creditdedinstallments`
  ADD CONSTRAINT `FK_creditDedInstallments_ID` FOREIGN KEY (`creditDed_id`) REFERENCES `creditdeductions` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `creditdeductions`
--
ALTER TABLE `creditdeductions`
  ADD CONSTRAINT `FK_creditDeductions_deductionTypes` FOREIGN KEY (`deductionType_id`) REFERENCES `deductiontypes` (`deductionTypeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_creditDeductions_employee` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `empnatureallowance_changes`
--
ALTER TABLE `empnatureallowance_changes`
  ADD CONSTRAINT `employee_id_natureAllowance` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`);

--
-- Constraints for table `emprepresentationallowance_changes`
--
ALTER TABLE `emprepresentationallowance_changes`
  ADD CONSTRAINT `employee_id_representation` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`);

--
-- Constraints for table `emptimesheet`
--
ALTER TABLE `emptimesheet`
  ADD CONSTRAINT `FK_Timesheet_empTimesheet` FOREIGN KEY (`TS_id`) REFERENCES `timesheets` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_emp_empTimesheet` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `emp_basicsalary`
--
ALTER TABLE `emp_basicsalary`
  ADD CONSTRAINT `FK_basicsalary_empId` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp_contract`
--
ALTER TABLE `emp_contract`
  ADD CONSTRAINT `FK_emp_contract_contractid` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_emp_contract_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `emp_job`
--
ALTER TABLE `emp_job`
  ADD CONSTRAINT `FK_emp_job_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_emp_job_job_id` FOREIGN KEY (`job_id`) REFERENCES `job` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `emp_level`
--
ALTER TABLE `emp_level`
  ADD CONSTRAINT `FK_emp_level_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_emp_level_level_id` FOREIGN KEY (`level_id`) REFERENCES `level` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `emp_maritalstatus`
--
ALTER TABLE `emp_maritalstatus`
  ADD CONSTRAINT `FK_emp_maritalstatus_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_emp_maritalstatus_ms_id` FOREIGN KEY (`marital_status_id`) REFERENCES `maritalstatus` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `emp_overnight`
--
ALTER TABLE `emp_overnight`
  ADD CONSTRAINT `FK_emp_overnight_emp_timesheet` FOREIGN KEY (`TS_id`) REFERENCES `timesheets` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_overnight_employeeid` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp_shift`
--
ALTER TABLE `emp_shift`
  ADD CONSTRAINT `FK_emp_shift_employee_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_shift_timesheets` FOREIGN KEY (`TS_id`) REFERENCES `timesheets` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `emp_sickleaves`
--
ALTER TABLE `emp_sickleaves`
  ADD CONSTRAINT `FK_emp_sickLeaves_employee` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_emp_sickLeaves_timesheets` FOREIGN KEY (`TS_id`) REFERENCES `timesheets` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `FK_job_level` FOREIGN KEY (`level_id`) REFERENCES `level` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `FK_emp_loan` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `FK_Timesheet_salary` FOREIGN KEY (`TS_id`) REFERENCES `timesheets` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_emp_salary` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sanctions`
--
ALTER TABLE `sanctions`
  ADD CONSTRAINT `FK_emp_sanctions` FOREIGN KEY (`employee_ID`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_timesheet_sanctions` FOREIGN KEY (`TS_id`) REFERENCES `timesheets` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

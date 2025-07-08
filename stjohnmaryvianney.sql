-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 02:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stjohnmaryvianney`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `activity_log_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `action` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_log_id`, `username`, `action`, `date`, `id`, `user_id`) VALUES
(1, 'joyce', 'Added new baptism record: Maricar V N Vergara', '2024-11-02 20:00:17', NULL, NULL),
(2, 'joyce', 'Updated baptism record: Maricar V N Vergara', '2024-11-02 20:10:56', NULL, NULL),
(3, 'joyce', 'Added new baptism record: Maricar Vi N Vergara', '2024-11-02 20:13:38', NULL, NULL),
(4, 'joyce', 'Updated baptism record: Maricar V N Vergara', '2024-11-02 20:14:13', NULL, NULL),
(5, 'joyce', 'Updated baptism record: Maricar Vi N Vergara', '2024-11-02 20:15:58', NULL, NULL),
(6, 'joyce', 'Updated baptism record: Maricar V N Vergara', '2024-11-02 20:16:08', NULL, NULL),
(7, 'joyce', 'Updated baptism record: Maricar V N Vergara', '2024-11-02 20:16:25', NULL, NULL),
(8, 'joyce', 'Updated baptism record: Maricar V N Vergara', '2024-11-02 20:16:50', NULL, NULL),
(9, 'joyce', 'Updated baptism record: Maricar Vi N Vergara', '2024-11-02 20:17:05', NULL, NULL),
(10, 'joyce', 'Updated baptism record: Maricar Vi N Vergara', '2024-11-02 20:17:19', NULL, NULL),
(11, 'joyce', 'Updated baptism record: Maricar Vi N Vergara', '2024-11-02 20:17:34', NULL, NULL),
(12, 'joyce', 'Updated baptism record: Maricar Vi N Vergara', '2024-11-02 20:17:46', NULL, NULL),
(13, 'joyce', 'Updated baptism record: Maricar Vi N Vergara', '2024-11-02 20:18:06', NULL, NULL),
(14, 'joyce', 'Updated baptism record: Maricar Vi N Vergara', '2024-11-02 20:19:00', NULL, NULL),
(15, 'joyce', 'Edited admin record: joyce', '2024-11-03 15:40:57', NULL, NULL),
(16, 'joyce', 'Edited admin record: joyce', '2024-11-03 15:41:09', NULL, NULL),
(17, 'joyce', 'Edited admin record: ashley', '2024-11-03 15:41:19', NULL, NULL),
(18, 'joyce', 'Edited admin record: ashley', '2024-11-03 15:41:30', NULL, NULL),
(19, 'joyce', 'Added new admin: mikah', '2024-11-03 15:53:13', NULL, NULL),
(20, 'joyce', 'Added new admin: mikahh', '2024-11-03 15:54:13', NULL, NULL),
(21, 'joyce', 'Edited admin record: mikah', '2024-11-03 16:01:29', NULL, NULL),
(22, 'joyce', 'Edited admin record: joyce', '2024-11-03 16:02:06', NULL, NULL),
(24, 'mikahh', 'Added new confirmation record: Ashley Ve Marquez Gonzales', '2024-11-03 17:38:21', NULL, NULL),
(25, 'mikahh', 'Added new confirmation record: Ashley Vi Marquez Gonzales', '2024-11-03 17:41:10', NULL, NULL),
(26, 'mikahh', 'Added new baptism record: Maricar Vivien N Vergara', '2024-11-03 17:42:32', NULL, NULL),
(28, 'mikahh', 'Deleted prayer request with ID: 1', '2024-11-03 18:01:31', NULL, NULL),
(29, 'mikahh', 'Deleted prayer request with ID: 6. Details: thank you po', '2024-11-03 18:15:52', NULL, NULL),
(30, 'mikahh', 'Deleted prayer request: thank you po', '2024-11-03 18:16:42', NULL, NULL),
(39, 'mikahh', 'Archived baptism record: Maricar Vi N Vergara', '2024-11-03 18:26:21', NULL, NULL),
(40, 'mikahh', 'Archived baptism record: Maricar Vivien N Vergara', '2024-11-03 18:26:42', NULL, NULL),
(41, 'mikahh', 'Archived baptism record: Maricar V N Vergara', '2024-11-03 18:26:55', NULL, NULL),
(42, 'mikahh', 'Restored baptism record: Maricar V N Vergara', '2024-11-03 18:28:48', NULL, NULL),
(44, 'mikahh', 'Restored baptism record: Maricar Vivien N Vergara', '2024-11-03 18:31:56', NULL, NULL),
(45, 'mikahh', 'Restored baptism record: Maricar Vi N Vergara', '2024-11-03 18:31:59', NULL, NULL),
(46, 'mikahh', 'Deleted baptism record: Maricar Vi N Vergara', '2024-11-03 18:32:11', NULL, NULL),
(47, 'mikahh', 'Added new confirmation record: Ashley Vina Marquez Gonzales', '2024-11-03 18:33:15', NULL, NULL),
(48, 'mikahh', 'Updated confirmation record: Ashley Vil Marquez Gonzales', '2024-11-03 18:33:43', NULL, NULL),
(50, 'mikahh', 'Archived confirmation record: Ashley Vina Marquez Gonzales', '2024-11-03 18:37:52', NULL, NULL),
(51, 'mikahh', 'Restored confirmation record: Ashley Ve Marquez Gonzales', '2024-11-03 18:38:04', NULL, NULL),
(52, 'mikahh', 'Deleted confirmation record: Ashley Ve Marquez Gonzales', '2024-11-03 18:41:45', NULL, NULL),
(53, 'mikahh', 'Updated marriage record: Emery Keanu S Keanu Torres & Aierrys Angel P Garcia', '2024-11-03 18:42:25', NULL, NULL),
(57, 'mikahh', 'Restored marriage record: Emery Keanu S Keanu Torres & Aierrys Angel P Garcia', '2024-11-03 18:57:16', NULL, NULL),
(58, 'mikahh', 'Archived marriage record: Emery Keanu S Keanu Torres & Aierrys Angel P Garcia', '2024-11-03 18:57:38', NULL, NULL),
(59, 'joyce', 'Restored marriage record: Emery Keanu S Keanu Torres & Aierrys Angel P Garcia', '2024-11-03 20:28:29', NULL, NULL),
(61, 'joyce', 'Updated marriage record: Emery Keanu s Keanu Torres & Aierrys Angel M Garcia', '2024-11-03 20:29:56', NULL, NULL),
(62, 'joyce', 'Updated marriage record: Emery Keanu s Keanu Torres & Aierrys Angel M Garcia', '2024-11-03 20:40:34', NULL, NULL),
(63, 'joyce', 'Updated marriage record: Emery Keanu s Keanu Torres & Aierrys Angel M Garcia', '2024-11-03 20:40:53', NULL, NULL),
(64, 'joyce', 'Updated marriage record: Emery Keanu s Keanu Torres & Aierrys Angel M Garcia', '2024-11-03 20:43:17', NULL, NULL),
(65, 'joyce', 'Updated marriage record: Emery Keanu S Keanu Torres & Aierrys Angel M Garcia', '2024-11-03 20:52:57', NULL, NULL),
(66, 'joyce', 'Updated marriage record: Emery Keanu S Keanu Torres & Aierrys Angel M Garcia', '2024-11-03 21:05:56', NULL, NULL),
(67, 'joyce', 'Updated marriage record: Emery Keanu w Keanu Torres & Aierrys Angel M Garcia', '2024-11-03 21:06:06', NULL, NULL),
(68, 'joyce', 'Updated marriage record: Emery Keanu s Keanu Torres & Aierrys Angel M Garcia', '2024-11-03 21:06:16', NULL, NULL),
(69, 'joyce', 'Updated marriage record: Emery Keanu S Keanu Torres & Aierrys Angel M Garcia', '2024-11-03 21:06:28', NULL, NULL),
(70, 'joyce', 'Updated marriage record: Emery Keanu S Torres & Aierrys Angel M Garcia', '2024-11-03 21:06:39', NULL, NULL),
(71, 'joyce', 'Updated marriage record: Emery Keanu S Torres & Aierrys Angel P Garcia', '2024-11-03 21:06:48', NULL, NULL),
(72, 'joyce', 'Updated marriage record: Emery Keanu v Torres & Aierrys Angel M Garcia', '2024-11-03 21:09:27', NULL, NULL),
(73, 'joyce', 'Updated marriage record: Emery Keanu S Torres & Aierrys Angel M Garcia', '2024-11-03 21:09:35', NULL, NULL),
(74, 'joyce', 'Updated marriage record: Emery Keanu v Torres & Aierrys Angel M Garcia', '2024-11-03 21:12:28', NULL, NULL),
(75, 'joyce', 'Updated marriage record: Emery Keanu S Torres & Aierrys Angel M Garcia', '2024-11-03 21:12:37', NULL, NULL),
(76, 'joyce', 'Updated marriage record: Emery Keanu eefw Torres & Aierrys Angel M Garcia', '2024-11-03 21:14:14', NULL, NULL),
(77, 'joyce', 'Updated marriage record: Emery Keanu De Alba Torres & Aierrys Angel M Garcia', '2024-11-03 21:14:35', NULL, NULL),
(78, 'joyce', 'Updated marriage record: Emery Keanu s Torres & Aierrys Angel M Garcia', '2024-11-03 21:16:25', NULL, NULL),
(80, 'joyce', 'Approved certificate request for: Maricar Vi Vergara', '2024-11-04 22:14:58', NULL, NULL),
(81, 'joyce', 'Declined certificate request for: Maricar Vi Vergara', '2024-11-05 18:00:57', NULL, NULL),
(82, 'joyce', 'Updated confirmation record: Ashley Vil Marquez Gonzales', '2024-11-05 18:47:43', NULL, NULL),
(83, 'joyce', 'Approved certificate request for: Aierrys Angel Garcia', '2024-11-05 18:53:32', NULL, NULL),
(84, 'joyce', 'Added new confirmation record: Ashley Vivien Marquez Gonzales', '2024-11-05 18:55:28', NULL, NULL),
(85, 'joyce', 'Approved certificate request for: Ashley Vivien Gonzales', '2024-11-05 19:26:31', NULL, NULL),
(86, 'joyce', 'Approved certificate request for: Ashley Vivien Gonzales', '2024-11-05 22:41:24', NULL, NULL),
(87, 'joyce', 'Approved certificate request for: Maricar Vivien Vergara', '2024-11-06 08:36:37', NULL, NULL),
(88, 'joyce', 'Approved certificate request for: Ashley Vivien Gonzales', '2024-11-06 08:39:24', NULL, NULL),
(89, 'joyce', 'Approved certificate request for: Ashley Vivien Gonzales', '2024-11-06 09:00:56', NULL, NULL),
(90, 'joyce', 'Archived baptism record: Maricar Vivien N Vergara', '2024-11-06 09:39:08', NULL, NULL),
(91, 'joyce', 'Restored confirmation record: Ashley Vina Marquez Gonzales', '2024-11-06 10:11:51', NULL, NULL),
(92, 'joyce', 'Archived confirmation record: Ashley Vil Marquez Gonzales', '2024-11-06 10:12:10', NULL, NULL),
(93, 'joyce', 'Added new admin: mikay', '2024-11-06 10:15:34', NULL, NULL),
(94, 'joyce', 'Restored baptism record: Maricar Vivien N Vergara', '2024-11-06 14:19:09', NULL, NULL),
(95, 'joyce', 'Updated baptism record: Maricar Vivien N Vergara', '2024-11-06 14:19:43', NULL, NULL),
(96, 'ashley', 'Added new confirmation record: Melanie B Lopez', '2024-11-06 17:55:37', NULL, NULL),
(97, 'ashley', 'Restored confirmation record: Ashley Vil Marquez Gonzales', '2024-11-06 17:56:35', NULL, NULL),
(98, 'joyce', 'Added new baptism record: Maricar Vilma N Vergara', '2024-11-07 17:49:57', NULL, NULL),
(99, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 17:50:13', NULL, NULL),
(100, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 17:54:03', NULL, NULL),
(101, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 17:59:40', NULL, NULL),
(102, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 18:00:02', NULL, NULL),
(103, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 18:00:14', NULL, NULL),
(104, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 18:03:22', NULL, NULL),
(105, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 18:03:41', NULL, NULL),
(106, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 18:07:09', NULL, NULL),
(107, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 18:10:12', NULL, NULL),
(108, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-07 18:12:47', NULL, NULL),
(109, 'joyce', 'Updated confirmation record: Melanie B Lopez', '2024-11-07 18:14:00', NULL, NULL),
(110, 'joyce', 'Updated marriage record: Emery Keanu s Torres & Aierrys Angel M Garcia', '2024-11-07 18:14:31', NULL, NULL),
(111, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-08 09:16:33', NULL, NULL),
(112, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-08 09:19:36', NULL, NULL),
(113, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-08 09:20:02', NULL, NULL),
(114, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-08 09:22:16', NULL, NULL),
(115, 'joyce', 'Updated baptism record: Maricar Vilma N Vergara', '2024-11-08 09:25:35', NULL, NULL),
(116, 'joyce', 'Archived baptism record: Maricar Vilma N Vergara', '2024-11-08 15:04:44', NULL, NULL),
(117, 'joyce', 'Added new baptism record: Nicole N De leon', '2024-11-08 17:22:00', NULL, NULL),
(118, 'joyce', 'Archived confirmation record: Melanie B Lopez', '2024-11-08 17:48:46', NULL, NULL),
(119, 'joyce', 'Archived marriage record: Emery Keanu S Torres & Aierrys Angel P Garcia', '2024-11-08 17:51:50', NULL, NULL),
(120, 'joyce', 'Deleted prayer request: Sana po', '2024-11-08 18:27:35', NULL, NULL),
(121, 'joyce', 'Deleted prayer request: thank you po', '2024-11-08 18:30:34', NULL, NULL),
(122, 'joyce', 'Deleted prayer request: thank you po', '2024-11-08 18:31:09', NULL, NULL),
(123, 'joyce', 'Declined certificate request for: Ashley Vivien Gonzales', '2024-11-08 18:43:45', NULL, NULL),
(124, 'joyce', 'Declined certificate request for: Ashley Vivien Gonzales', '2024-11-08 18:43:58', NULL, NULL),
(125, 'joyce', 'Declined certificate request for: Ashley Vivien Gonzales', '2024-11-08 18:44:07', NULL, NULL),
(126, 'joyce', 'Approved certificate request for: Ashley Vivien Gonzales', '2024-11-08 18:44:19', NULL, NULL),
(127, 'joyce', 'Approved certificate request for: Ashley Vivien Gonzales', '2024-11-08 18:46:17', NULL, NULL),
(128, 'joyce', 'Approved certificate request for: Ashley Vivien Gonzales', '2024-11-08 18:46:25', NULL, NULL),
(129, 'joyce', 'Approved certificate request for: Ashley Vivien Gonzales', '2024-11-08 18:46:38', NULL, NULL),
(130, 'joyce', 'Restored baptism record: Maricar Vilma N Vergara', '2024-11-09 11:34:39', NULL, NULL),
(131, 'joyce', 'Archived baptism record: Nicole N De leon', '2024-11-09 11:34:51', NULL, NULL),
(132, 'joyce', 'Deleted prayer request: thank you po', '2024-11-09 11:35:16', NULL, NULL),
(133, 'joyce', 'Approved certificate request for: Maricar Vivien Vergara', '2024-11-09 11:56:16', NULL, NULL),
(134, 'joyce', 'Deleted confirmation record:   ', '2024-11-09 13:02:44', NULL, NULL),
(135, 'joyce', 'Deleted baptism record:   ', '2024-11-09 13:03:07', NULL, NULL),
(136, 'joyce', 'Deleted baptism record:   ', '2024-11-09 13:03:21', NULL, NULL),
(143, 'joyce', 'Deleted certificate request:   ', '2024-11-09 13:40:46', NULL, NULL),
(144, 'joyce', 'Deleted certificate request:   ', '2024-11-09 13:40:47', NULL, NULL),
(145, 'joyce', 'Deleted certificate request:   ', '2024-11-09 13:40:49', NULL, NULL),
(146, 'joyce', 'Deleted certificate request:   ', '2024-11-09 13:40:51', NULL, NULL),
(147, 'joyce', 'Declined certificate request for: Aierrys Angel Garcia', '2024-11-09 13:43:11', NULL, NULL),
(149, 'joyce', 'Declined certificate request for: Maricar Vi Vergara', '2024-11-09 13:44:16', NULL, NULL),
(151, 'joyce', 'Declined certificate request for: Aierrys Angel Garcia', '2024-11-09 13:45:22', NULL, NULL),
(153, 'joyce', 'Declined certificate request for: Maricar Vi Vergara', '2024-11-09 13:46:13', NULL, NULL),
(156, 'joyce', 'Archived baptism record: Maricar Vilma N Vergara', '2024-11-13 11:37:26', NULL, NULL),
(157, 'joyce', 'Added new baptism record: Aierrys Pelayo Garcia', '2024-11-13 18:55:47', NULL, NULL),
(158, 'joyce', 'Updated baptism record: Aierrys Pelayo Garcia', '2024-11-13 18:56:25', NULL, NULL),
(159, 'joyce', 'Archived baptism record: Aierrys Pelayo Garcia', '2024-11-13 18:56:57', NULL, NULL),
(160, 'joyce', 'Restored baptism record: Aierrys Pelayo Garcia', '2024-11-13 18:58:22', NULL, NULL),
(161, 'joyce', 'Added new admin: Aierrystotle30', '2024-11-13 19:03:07', NULL, NULL),
(162, 'joyce', 'Approved certificate request for: Nicole De leon', '2024-11-13 19:19:58', NULL, NULL),
(163, 'joyce', 'Archived baptism record: Aierrys Pelayo Garcia', '2024-11-14 17:41:50', NULL, NULL),
(164, 'joyce', 'Approved prayer request ID: 13', '2024-11-14 17:48:40', NULL, NULL),
(165, 'joyce', 'Approved prayer request:', '2024-11-14 17:54:36', NULL, NULL),
(166, 'joyce', 'Approved prayer request type: 1', '2024-11-14 17:58:48', NULL, NULL),
(167, 'joyce', 'Approved prayer request type: 1', '2024-11-14 17:59:20', NULL, NULL),
(168, 'joyce', 'Approved prayer request type: 1', '2024-11-14 18:04:46', NULL, NULL),
(169, 'joyce', 'Approved prayer request type: 1', '2024-11-14 18:07:33', NULL, NULL),
(170, 'joyce', 'Approved prayer request:', '2024-11-14 18:08:20', NULL, NULL),
(171, 'joyce', 'Approved prayer request:', '2024-11-14 18:08:44', NULL, NULL),
(172, 'joyce', 'Approved prayer request:', '2024-11-14 18:08:49', NULL, NULL),
(173, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-11-14 18:10:15', NULL, NULL),
(174, 'joyce', 'Added new confirmation record: Aierrys Angel Pelayo Garcia', '2024-11-15 09:11:14', NULL, NULL),
(175, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-11-15 14:32:19', NULL, NULL),
(176, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-11-15 14:52:30', NULL, NULL),
(177, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-11-15 14:59:57', NULL, NULL),
(178, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-11-15 15:00:22', NULL, NULL),
(179, 'joyce', 'Deleted prayer request: please Lord sana gumana na', '2024-11-18 11:33:02', NULL, NULL),
(180, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-11-18 11:54:59', NULL, NULL),
(181, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-11-18 11:55:14', NULL, NULL),
(182, 'joyce', 'Deleted prayer request: thank you po', '2024-11-18 12:02:34', NULL, NULL),
(183, 'joyce', 'Deleted prayer request: ', '2024-11-18 12:03:10', NULL, NULL),
(184, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-11-18 12:06:33', NULL, NULL),
(185, 'joyce', 'Updated confirmation record: Aierrys Angels Pelayo Garcia', '2024-11-21 10:29:31', NULL, NULL),
(186, 'joyce', 'Archived confirmation record: Aierrys Angels Pelayo Garcia', '2024-11-21 10:29:58', NULL, NULL),
(187, 'joyce', 'Added new marriage record: Edgen Dy Magdangal Gavino & Jasmin magda Milla', '2024-11-21 10:34:31', NULL, NULL),
(188, 'joyce', 'Restored confirmation record: Aierrys Angels Pelayo Garcia', '2024-11-21 10:35:22', NULL, NULL),
(189, 'joyce', 'Approved prayer request of type: Special Intention', '2024-11-21 10:52:04', NULL, NULL),
(190, 'joyce', 'Updated marriage record: Edgen Dy Magdangal Gavino & Jasmin magda Milla', '2024-11-21 10:54:41', NULL, NULL),
(191, 'joyce', 'Updated marriage record: Edgen Dy Magdangal Gavino & Jasmin magda Milla', '2024-11-21 10:55:11', NULL, NULL),
(192, 'joyce', 'Approved prayer request of type: Special Intention', '2024-11-21 10:56:36', NULL, NULL),
(193, 'joyce', 'Approved prayer request of type: Special Intention', '2024-11-21 10:57:00', NULL, NULL),
(194, 'joyce', 'Edited admin record: ashley', '2024-11-21 12:04:28', NULL, NULL),
(195, 'joyce', 'Edited admin record: dhane', '2024-11-21 12:05:21', NULL, NULL),
(196, 'joyce', 'Archived confirmation record: Aierrys Angels Pelayo Garcia', '2024-11-21 13:21:25', NULL, NULL),
(197, 'joyce', 'Approved prayer request of type: Special Intention', '2024-11-21 13:24:47', NULL, NULL),
(198, 'joyce', 'Approved certificate request for: Maricar Vivien Vergara', '2024-11-21 13:27:15', NULL, NULL),
(201, 'joyce', 'Updated marriage record: Emery Keanu s Torres & Aierrys Angel M Garcia', '2024-11-24 20:38:54', NULL, NULL),
(208, 'joyce', 'Deleted prayer request: sana po', '2024-11-28 19:10:07', NULL, NULL),
(209, 'joyce', 'Deleted prayer request: thank you po', '2024-11-28 19:12:35', NULL, NULL),
(210, 'joyce', 'Deleted prayer request: thank you po', '2024-11-28 19:14:14', NULL, NULL),
(212, 'joyce', 'Deleted prayer request: hwoef', '2024-11-28 19:20:53', NULL, NULL),
(213, 'mikay', 'Updated baptism record: Maricar Vivien N Vergara', '2024-11-29 15:24:19', NULL, NULL),
(214, 'joyce', 'Edited admin record: mikahlim', '2024-11-29 16:04:20', NULL, NULL),
(215, 'joyce', 'Added new admin: colet', '2024-11-29 16:05:57', NULL, NULL),
(216, 'joyce', 'Edited admin record: joyce', '2024-11-29 16:32:09', NULL, NULL),
(217, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-11-29 16:41:57', NULL, NULL),
(218, 'joyce', 'Approved certificate request for: Maricar Vivien Vergara', '2024-11-29 16:45:12', NULL, NULL),
(219, 'joyce', 'Declined certificate request for: Aierrys Angels Garcia', '2024-11-29 16:50:01', NULL, NULL),
(220, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-11-29 16:51:52', NULL, NULL),
(221, 'joyce', 'Declined certificate request for: Maricar Vi Vergara', '2024-11-29 16:56:33', NULL, NULL),
(222, 'joyce', 'Declined certificate request for: Maricar Vi Vergara', '2024-11-29 16:57:22', NULL, NULL),
(223, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-11-29 17:01:31', NULL, NULL),
(224, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-11-29 17:03:05', NULL, NULL),
(225, 'joyce', 'Declined certificate request for: Aierrys Angels Garcia', '2024-11-29 17:04:26', NULL, NULL),
(226, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-11-29 17:06:54', NULL, NULL),
(227, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-11-29 17:08:11', NULL, NULL),
(228, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-11-29 17:11:00', NULL, NULL),
(229, 'joyce', 'Deleted prayer request: sana', '2024-11-29 20:19:06', NULL, NULL),
(230, 'joyce', 'Deleted prayer request: Sana po', '2024-11-29 20:21:30', NULL, NULL),
(231, 'joyce', 'Deleted prayer request: thank you po ', '2024-11-29 20:22:01', NULL, NULL),
(232, 'joyce', 'Archived baptism record: Maricar Vivien N Vergara', '2024-11-29 20:49:18', NULL, NULL),
(233, 'joyce', 'Restored baptism record: Maricar Vivien N Vergara', '2024-11-29 20:49:27', NULL, NULL),
(234, 'joyce', 'Archived baptism record: Maricar Vivien N Vergara', '2024-11-29 21:01:09', NULL, NULL),
(235, 'joyce', 'Restored baptism record: Maricar Vivien N Vergara', '2024-11-29 21:01:55', NULL, NULL),
(236, 'joyce', 'Added new admin: mariahjerrunica', '2024-12-01 15:31:33', NULL, NULL),
(237, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-12-08 15:16:42', NULL, NULL),
(238, 'joyce', 'Updated baptism record: Maricar Vivien N Vergara', '2024-12-08 15:17:40', NULL, NULL),
(239, 'joyce', 'Updated confirmation record: Ashley Vivien Marquez Gonzales', '2024-12-08 16:37:27', NULL, NULL),
(240, 'joyce', 'Archived confirmation record: Ashley Vina Marquez Gonzales', '2024-12-08 16:37:40', NULL, NULL),
(241, 'joyce', 'Archived confirmation record: Ashley Vil Marquez Gonzales', '2024-12-08 16:37:44', NULL, NULL),
(242, 'joyce', 'Updated confirmation record: Ashley Vivien Marquez Gonzales', '2024-12-08 16:38:06', NULL, NULL),
(243, 'joyce', 'Archived confirmation record: Ashley Vivien Marquez Gonzales', '2024-12-08 16:38:43', NULL, NULL),
(244, 'joyce', 'Restored confirmation record: Aierrys Angels Pelayo Garcia', '2024-12-08 16:38:51', NULL, NULL),
(245, 'joyce', 'Restored confirmation record: Ashley Vina Marquez Gonzales', '2024-12-08 16:38:57', NULL, NULL),
(246, 'joyce', 'Restored confirmation record: Ashley Vivien Marquez Gonzales', '2024-12-08 16:39:03', NULL, NULL),
(247, 'joyce', 'Archived confirmation record: Ashley Vina Marquez Gonzales', '2024-12-08 16:39:15', NULL, NULL),
(248, 'joyce', 'Updated confirmation record: Aierrys Angels Pelayo Garcia', '2024-12-08 16:39:36', NULL, NULL),
(249, 'joyce', 'Updated confirmation record: Aierrys Angels Pelayo Garcia', '2024-12-08 16:40:50', NULL, NULL),
(250, 'joyce', 'Added new baptism record: Monique Cortez Bernardo', '2024-12-08 17:25:27', NULL, NULL),
(251, 'joyce', 'Updated baptism record: Monique Cortez Bernardo', '2024-12-08 17:26:14', NULL, NULL),
(252, 'joyce', 'Archived baptism record: Monique Cortez Bernardo', '2024-12-08 17:26:30', NULL, NULL),
(253, 'joyce', 'Added new confirmation record: Bianca N Graciano', '2024-12-08 17:28:19', NULL, NULL),
(254, 'joyce', 'Updated confirmation record: Bianca N Graciano', '2024-12-08 17:28:46', NULL, NULL),
(255, 'joyce', 'Archived confirmation record: Bianca N Graciano', '2024-12-08 17:28:56', NULL, NULL),
(256, 'joyce', 'Added new marriage record: Brandon Walter M Lorenzo & Nicole N De Leon', '2024-12-08 17:32:05', NULL, NULL),
(257, 'joyce', 'Updated marriage record: Brandon Walter M Lorenzo & Nicole N De Leon', '2024-12-08 17:32:32', NULL, NULL),
(258, 'joyce', 'Archived marriage record: Brandon Walter M Lorenzo & Nicole N De Leon', '2024-12-08 17:32:50', NULL, NULL),
(259, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-12-08 17:33:11', NULL, NULL),
(260, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-12-08 17:35:48', NULL, NULL),
(261, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-12-08 17:41:22', NULL, NULL),
(262, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-12-08 17:43:09', NULL, NULL),
(263, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-12-08 17:48:10', NULL, NULL),
(264, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-12-08 17:49:13', NULL, NULL),
(265, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-12-08 17:50:47', NULL, NULL),
(266, 'joyce', 'Added new admin: ashley', '2024-12-08 17:52:03', NULL, NULL),
(267, 'joyce', 'Edited admin record: ashleym', '2024-12-08 17:52:13', NULL, NULL),
(268, 'ashleym', 'Archived baptism record: Maricar Vivien N Vergara', '2024-12-08 17:52:47', NULL, NULL),
(269, 'joyce', 'Restored baptism record: Maricar Vivien N Vergara', '2024-12-09 14:24:52', NULL, NULL),
(270, 'joyce', 'Approved certificate request for: Aierrys Angels Garcia', '2024-12-09 14:25:23', NULL, NULL),
(274, 'joyce', 'Edited admin record: mariahjerrunica', '2024-12-09 14:37:09', NULL, NULL),
(275, 'joyce', 'Edited admin record: joyce', '2024-12-09 14:37:28', NULL, NULL),
(276, 'joyce', 'Edited admin record: mariahjerrunica', '2024-12-09 14:37:39', NULL, NULL),
(277, 'joyce', 'Approved certificate request for: Aierrys Angels Garcia', '2024-12-09 14:46:14', NULL, NULL),
(278, 'joyce', 'Deleted certificate request: Edgen Dy Magdangal Gavino', '2024-12-09 14:46:35', NULL, NULL),
(279, 'joyce', 'Deleted certificate request from: Vivien Marina Caberio Dizon', '2024-12-09 14:50:07', NULL, NULL),
(280, 'joyce', 'Added new baptism record: Moniquee Cortez Bernardo', '2024-12-09 23:40:59', NULL, NULL),
(281, 'joyce', 'Added new baptism record: Moniqueee Cortez Bernardo', '2024-12-09 23:44:19', NULL, NULL),
(282, 'joyce', 'Updated baptism record: Moniqueee Cortez Bernardo', '2024-12-09 23:45:12', NULL, NULL),
(283, 'joyce', 'Updated baptism record: Moniquee Cortez Bernardo', '2024-12-09 23:45:29', NULL, NULL),
(284, 'joyce', 'Restored marriage record: Brandon Walter M Lorenzo & Nicole N De Leon', '2024-12-09 23:46:32', NULL, NULL),
(285, 'joyce', 'Added new admin: lovely', '2024-12-09 23:49:41', NULL, NULL),
(286, 'joyce', 'Edited admin record: lovely', '2024-12-09 23:51:20', NULL, NULL),
(287, 'lovely', 'Deleted certificate request from: Vivien Marina Caberio Dizon', '2024-12-09 23:52:07', NULL, NULL),
(288, 'joyce', 'Added new baptism record: Monique Carla Cortez Bernardo', '2024-12-10 14:11:56', NULL, NULL),
(289, 'joyce', 'Updated baptism record: Monique Carla Cortez Bernardo', '2024-12-10 14:12:47', NULL, NULL),
(290, 'joyce', 'Archived baptism record: Monique Carla Cortez Bernardo', '2024-12-10 14:12:59', NULL, NULL),
(291, 'joyce', 'Added new confirmation record: Carla B Abellana', '2024-12-10 14:15:02', NULL, NULL),
(292, 'joyce', 'Updated confirmation record: Carla B Abellana', '2024-12-10 14:15:30', NULL, NULL),
(293, 'joyce', 'Archived confirmation record: Carla B Abellana', '2024-12-10 14:15:43', NULL, NULL),
(294, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-12-10 14:18:19', NULL, NULL),
(295, 'joyce', 'Updated baptism record: Moniqueee Cortez Bernardo', '2024-12-10 16:42:09', NULL, NULL),
(296, 'joyce', 'Approved prayer request of type: Thanksgiving', '2024-12-10 16:49:20', NULL, NULL),
(297, 'joyce', 'Declined certificate request for: Maricar Vivien Vergara', '2024-12-10 16:51:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `admin_first_name` varchar(50) NOT NULL,
  `admin_last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','archived') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `admin_first_name`, `admin_last_name`, `email`, `password`, `role`, `created_at`, `status`) VALUES
(1, 'joyce', 'iFSEbSNNoVwcJ0Afg6JYJRPAT7rPKe/Mj1vfz2n/bPQ=', 'mX4Bat6aM4kjOvA0sgYdrO8WAM4DxhXd5uzB7fxgLnY=', 'ML+JLXSwmiT8Dw/1ob0JpfRHnaVZd6f9KXTYXCHRE3k=', '$2y$10$SCc1CDdoiCl9mEJenZd2e.XE4eXuCtLEhVv44C4ew1Vi8/zUbne/q', 'super_admin', '2024-11-29 08:07:50', 'active'),
(2, 'mariahjerrunica', 'aEeVwDe4uvXPz8aP1ZehRxFcjD/ShznwSLPzMxP2SG8=', 'a4vZtFJ5MsDHc0PoBELtjEMcw2snSF2Dp2UOHkX4Cys=', 'i+J03tHkXEApJ7E+j9vJFQ7NCIuSiJXzmQcHLqiPUZju6t8PNgqggfkTFIGOUN1f', '$2y$10$fdDfpGxhm98J//igy9Xr7eoFS4Gw55IXGuzuqaF8FjeRkMP5kTdZm', 'admin', '2024-12-01 07:31:33', 'active'),
(3, 'ashleym', '801N6LL3y4IhQsIZLVH8s6w8JFpLv7CthXJuJRL7Iig=', 'jKd6uRIUZrhBfxiihoXOsBLj2LFVxcXd70ksvNmGMUc=', 'W3JuSF7BCckgdjaUXl/sHJOKMHU8QoU/3wK0eiNmlbHriAOCkXx4k1XmvADaFXUx', '$2y$10$gRlJZYeYlU4Gad4slpHy1.l8EBR/llV5HS513pXPy1bn5pLLcjZpO', 'admin', '2024-12-08 09:52:03', 'active'),
(4, 'lovely', 'fmOIn3SO9IydXWCBleDDYv9tGm4rOEe9MGYkWcMZbio=', 'MK7GZqknsl206LKPN+s7sNGJUtJMRtAr05bfzOQtwg4=', 'Ag5UzBpzFn7Diinq01IFkgZqMXFNz3xHPYxLlN4gy9k=', '$2y$10$qTQkIU7ADBMTV1o/xMWWpu/8WLs9hkwOGku7MlyNQPswwBAHVibhO', 'admin', '2024-12-09 15:49:41', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `baptism`
--

CREATE TABLE `baptism` (
  `baptism_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `baptism_date` date DEFAULT NULL,
  `priest_id` int(11) DEFAULT NULL,
  `book_no` int(11) NOT NULL,
  `page_no` int(11) NOT NULL,
  `line_no` int(11) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `encoder` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baptism`
--

INSERT INTO `baptism` (`baptism_id`, `person_id`, `baptism_date`, `priest_id`, `book_no`, `page_no`, `line_no`, `purpose`, `encoder`, `created_at`, `status`, `admin_id`) VALUES
(1, 1, '2024-11-22', 1, 0, 0, 0, '', 'joyce', '2024-11-03 10:29:09', 'deleted', NULL),
(2, 2, '2024-11-15', 2, 0, 0, 0, '', 'joyce', '2024-11-03 10:32:11', 'deleted', NULL),
(3, 5, '2024-11-19', 5, 21, 0, 0, 'Reference', 'joyce', '2024-12-09 06:24:52', 'active', NULL),
(4, 13, '2024-11-20', 13, 0, 0, 0, '', 'joyce', '2024-11-13 03:37:26', 'archived', NULL),
(5, 14, '2028-12-12', 14, 0, 0, 0, '', 'joyce', '2024-11-09 03:34:51', 'archived', NULL),
(6, 15, '2001-07-30', 15, 1, 23, 1, 'School', 'joyce', '2024-11-14 09:41:50', 'archived', NULL),
(7, 19, '2024-12-17', 19, 21, 2, 7, 'School', 'joyce', '2024-12-08 09:26:30', 'archived', NULL),
(8, 23, '2024-12-25', 23, 0, 0, 0, '', 'joyce', '2024-12-09 15:40:59', 'active', NULL),
(9, 24, '2025-01-01', 24, 12, 43, 54, '', 'joyce', '2024-12-10 08:42:09', 'active', NULL),
(10, 25, '2024-12-26', 25, 112, 241, 34, 'School', 'joyce', '2024-12-10 06:12:59', 'archived', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certificate_requests`
--

CREATE TABLE `certificate_requests` (
  `request_id` int(11) NOT NULL,
  `requester_first_name` varchar(100) NOT NULL,
  `requester_middle_name` varchar(100) DEFAULT NULL,
  `requester_last_name` varchar(100) NOT NULL,
  `requester_email` varchar(100) NOT NULL,
  `requester_contact` varchar(100) NOT NULL,
  `relation_to_person` varchar(100) NOT NULL,
  `supporting_document` varchar(255) NOT NULL,
  `certificate_type` varchar(100) NOT NULL,
  `request_purpose` varchar(20) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL,
  `person_id` int(11) NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `approved_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate_requests`
--

INSERT INTO `certificate_requests` (`request_id`, `requester_first_name`, `requester_middle_name`, `requester_last_name`, `requester_email`, `requester_contact`, `relation_to_person`, `supporting_document`, `certificate_type`, `request_purpose`, `request_date`, `status`, `person_id`, `approved_by`, `approved_date`, `user_id`) VALUES
(61, 'kPuuJ5aCI6D9WJ7zOxzONNdUIuPI2japthgS8DkVPJc=', 'GvK5GPbh8rh/3fEywD+OZz7iXqtX1mJdl6z4GAnepoA=', 'XK2uElqKoPeTJeBMnWN6dsQtm7RdhSClz75vuA/ggZg=', 'lJH96PSnaJncp25KHJe5rlcjArdV2sh06tBz2OW9Fnt9UWzNSUysXQ19YCMMiVbg', '7PvPSBO2dF9tDxrMDMcpdMm8EJEYpPGT9+ZWcy4TwDI=', '7WDSi7ugwqwEsm9DTSOA5OYaa96U53vrxXV7ulBncVU=', 'photo_6163577442321677856_y.jpg', 'Y8CyJQp5V5IXxe5GZhK7DynQb0Syy4Kk081M1lDUW58=', 'school', '2024-11-16 12:36:35', 'approved', 5, 'joyce', '2024-11-29 16:45:08', 19),
(63, 'g1b9F2IJyctAdiY/cqcRX10s3D/GXoMkBaMEYrrbgb0=', 'BPTd11Z/oIwrDoJNySGP0ta12Bu+64Hf/3ZmS0zOHqU=', 'UQQi30Bh9WfGURhVjNNOuGAK2ObrMQN64evUN9+q9Rs=', 'O1JLcpPSMRIDCOTlYUPvF80dz7y+hkMgm3yyXbWNqKaivN0AvmnpauDg4hRaKiml', 'DHAzYPsxYhaLhNOpaCEcjwr/fBzBAqmSTzD5arazo3s=', '7LAjOXrm9IFRHYPtTezuemzK0XgC2vZ4V+bwLv62xsg=', 'photo_6163577442321677856_y.jpg', 'bxl3iDicBQCaoieiWTitbiaC8VBE1IrJSwccPhdXi5Q=', 'school', '2024-11-16 12:42:10', 'declined', 5, 'joyce', '2024-11-29 17:10:54', 19),
(67, '5U/Lm11H5trqXCkq8IoghfXEmsnGafygPcvvD9wmKXQ=', '64LmFGDPBnlCDPtGOOb3kfzb20JFf6Qxnz5Z7JXFdUo=', 'TkvVh5BQo/Sqw3YNCQ2DE8pS8NTngmuDIHD+/zQxiW0=', '63aVyXPfMGLQMQTuMm35lizvjgeSYV8f5bSJhLFF2oShj8XHZsGYUAuAsc3nbL+f', 'jb/rhdRrK6Exk2vtOkMcmGHN9LpZjjWfTaiYAAl8lHE=', 'kFV5oPdijhPDbhrkH5+w2f/oH7aKi+rsDDR1tMdfFuA=', 'photo_6163577442321677855_y.jpg', '+gMToI+8JliIXTJ4SHk6oHFosx4TiIiF1RixC7IYSac=', 'school', '2024-11-16 12:58:10', 'pending', 16, '', NULL, 21),
(68, 'mgr4k7WYDZn1GSE7PHGG0HCygReF73TD7RgS/ZmCLC4=', 'oU3zXALnZqd+A1Er94KqATTJEnpvhhlJNbVRuZ3y7Cg=', 'ikKZafIQUZrKv4Uy7h3vh7Cna42MyNehUZv7vr66s4g=', 'yyVM7Gs43ZFLd0PAZwmub0SOm9PgPy2D1HtHhj9AR5AR1ej9bQuKry5EQIBIGK2h', 'G5l4LV9cjLB1vWaWGbEcrBgmSlIAEy+gmQkrCRjAx5g=', '/lzijJYK/fxIVQuhL6x8nQ37cbltyZZzuX0YxTGNSVQ=', 'photo_6163577442321677855_y.jpg', 'iqEfm/Mk6l2fOpx3VlVWR0heLWPq/J3YE6ik5wMYcxQ=', 'school', '2024-11-16 12:58:44', 'pending', 16, '', NULL, 21),
(74, 'XTxCQQMa6jGugfU9dp23VQIbH10SpXYMCgrlz1xktfI=', 'BLox2D65gUbbfFkon3VlXvAfdcH3KkDXsVZ4uB4nSNs=', 'Y/FXx1kOuDtLZPxekSCnTMBWPx/0gRcvfFCq7HpdhOA=', '/OHzs1kQoO8xRcHR8WaL9L9iymj6GoCi8VmoqCC9/8LdvrHOxR+jUXCd0xvOc+5w', '6uS8QrYrbI0mYLW/h+16D4uhjgmfuU26UGCU2tDFoAk=', '8FEqFuk/+Dosh4OVYjqJedZxyEcOuVHx+6ucnQhJHhk=', 'photo_6242533299297828762_y.jpg', '3u9Dh0FG8dWaBnGPBH1OvPDu03XT3LR1nC3HfKOyge4=', 'School', '2024-12-08 09:20:11', 'approved', 5, 'joyce', '2024-12-08 17:50:44', 1),
(75, 'L2B7YMZHdogIm91B3+Ox+MadzKilW043yQBP1SbJ4l8=', 'mGH7sbD7vG8G+FCSmrZhGXUC3oA3a3Teeex235dMOpQ=', 'OWoyRVzi0LkL1SpGVzjB1+BaQA6+9Oh0nvi04brPGKw=', 'MExH3COLaLc/Ee32f7YVJCo4WuiBaW4NiQyr/W6skhp8q9EDKBjnOc/kYpzLKkWN', '8aPQ9fLpjkYUQf+Oo11orlOuQCIG7u0Gbl2qTT5phTc=', '/94E/Xct/4WguUi+c0b84hw4rO5iZHkXsx1QwymOGZ4=', 'bride (2).jpg', '5UOR33dB4w65on5I64eHalZRJvrfoLncnBanps6w6cU=', 'school', '2024-12-09 15:54:43', 'pending', 5, '', NULL, 1),
(76, '3ievg1m6W1zntfbuGr/sGkDgbQuCKTMHoEzhIeSgh+k=', '8QZq7DqKWKOLgWIokC/PV5W8q6BJRQc7cOxmO9urGes=', 'FALUxYbBQsHDAskzyJNf2F8hN6cOIS7aDumyRRG2Uww=', 'sxHj/7IpACzVou1gPT6SLJFO66DLOfZdDufsxkqNtU/dAgzTfY5mWGCaRBJ76ARL', 'whEDB7PoWdByemFU2nVu/7tQKZ9eHWsNt3jPBbKOrmw=', 'VS9KdexW7tkxTcf7z7BJ28rYqscjxv3Vwg1FdqwGdKs=', 'groom (3).jpg', 'vyHzIRCSZAGhsuDMJ3LUOwaSHrUMyW7c39mUuJ9dGSQ=', 'school', '2024-12-10 06:06:07', 'pending', 5, '', NULL, 2),
(77, 'SL5fxh0vbj17lA0ujlbVyYbb+Sgq7r5DyHkxe7vzwbA=', '8rE+p5HpO9SbWtNp8fCQV+XIhp6hKlpAf39x3sfqsVg=', 'UT9bo7wGyZLj2y53IG5pgny5+OnvGZCm+NsaX0GMhCw=', 'pv17QABJznQBGHSRM7Mt/LZGOaTjy/fO7EARVTy0cKY5D3X/Ff96zwEGlBnRZMbg', 'FBTGzQTPEqwMk5uDagsxrBy1JpfOUmobe9cMKqKsPKQ=', 'D14r9dhOLbeSKAndr7HZt8I9W/3cVtGAYbDfy4nPeC8=', 'clouds.jpg', '0lKyx9UP/fjLzozhP+S5T4mOA7e9vfyvOMZs1w2hzUc=', 'School', '2024-12-10 08:34:39', 'declined', 5, 'joyce', '2024-12-10 16:51:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `confirmation`
--

CREATE TABLE `confirmation` (
  `confirmation_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `confirmation_date` date DEFAULT NULL,
  `place_of_baptism` varchar(50) NOT NULL,
  `priest_id` int(11) DEFAULT NULL,
  `book_no` int(11) NOT NULL,
  `page_no` int(11) NOT NULL,
  `line_no` int(11) NOT NULL,
  `purpose` varchar(20) NOT NULL,
  `encoder` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `sponsor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirmation`
--

INSERT INTO `confirmation` (`confirmation_id`, `person_id`, `confirmation_date`, `place_of_baptism`, `priest_id`, `book_no`, `page_no`, `line_no`, `purpose`, `encoder`, `created_at`, `status`, `sponsor_id`) VALUES
(1, 3, '2024-11-07', 'o1I3Hn1oFT+P75YOdApnRSjXDV05DrETRcclg6YR5u0=', 3, 0, 0, 0, '', 'mikahh', '2024-11-03 10:41:45', 'deleted', NULL),
(2, 4, '2024-11-19', '3ZJCQ6DR7ScHmhQWXkpDgrwrlPyeLVAha/jdJ9vZJxE=', 4, 0, 0, 0, '', 'joyce', '2024-12-08 08:37:44', 'archived', NULL),
(3, 8, '2024-11-05', '24Zb+6XEIOElQYYzOuMhIgFNcRdndx2q75uodNJHx04=', 8, 0, 0, 0, '', 'mikahh', '2024-12-08 08:39:15', 'archived', NULL),
(4, 11, '2024-11-23', '96S0jSZkedfRg9ufEtGv3DeyiHIcQH5FptA/53QzlOU=', 11, 0, 0, 0, '', 'joyce', '2024-12-08 08:39:03', 'active', NULL),
(5, 12, '2024-11-22', 'MCf1gpbI1o6oS2W9etasxS8KDnV4hrqvOhcZp+g9WWw=', 12, 0, 0, 0, '', 'joyce', '2024-11-08 09:48:46', 'archived', NULL),
(6, 16, '2024-11-20', '9JFkFzQHpiMVoo+ZDUSntq9mQvU3qhnUrTRepVCMUYk=', 16, 0, 0, 0, '', 'joyce', '2024-12-08 08:40:50', 'active', NULL),
(7, 20, '2023-06-14', '381ThbLO8hE9Y49ectVH1TDgTnFQgp+hNksXl1INE5Y=', 20, 23, 10, 29, 'Reference', 'joyce', '2024-12-08 09:28:56', 'archived', NULL),
(8, 26, '2024-12-12', 'GH3WwhNyyIiSVeveUfRtpGwy2llh3TSCxIb+1vI5CF8=', 26, 24, 98, 34, 'Reference', 'joyce', '2024-12-10 06:15:43', 'archived', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marriage`
--

CREATE TABLE `marriage` (
  `marriage_id` int(11) NOT NULL,
  `groom_id` int(11) DEFAULT NULL,
  `bride_id` int(11) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `marriage_date` date DEFAULT NULL,
  `priest_id` int(11) DEFAULT NULL,
  `encoder` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `groom_photo` varchar(255) NOT NULL,
  `bride_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marriage`
--

INSERT INTO `marriage` (`marriage_id`, `groom_id`, `bride_id`, `registration_date`, `marriage_date`, `priest_id`, `encoder`, `created_at`, `status`, `person_id`, `groom_photo`, `bride_photo`) VALUES
(1, 6, 7, '2024-11-15', '2024-11-20', 7, 'joyce', '2024-11-03 09:54:59', 'archived', 6, 'sunny.png', 'sun (2).png'),
(2, 9, 10, '2024-11-08', '2024-11-14', 10, 'joyce', '2024-11-03 12:29:38', 'active', 9, 'sun (1).png', 'partly-cloudy.png'),
(3, 17, 18, '2024-11-22', '2024-11-22', 18, 'joyce', '2024-11-21 02:34:31', 'active', 17, '67431e768a480-photo_6163577442321677857_y.jpg', '673ea0f113631-Screenshot 2023-10-24 221427.png'),
(4, 21, 22, '2024-12-10', '2024-11-28', 22, 'joyce', '2024-12-08 09:32:05', 'active', 21, 'groom (3).jpg', 'bride (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `parent_first_name` varchar(255) NOT NULL,
  `parent_middle_name` varchar(255) NOT NULL,
  `parent_last_name` varchar(255) NOT NULL,
  `parent_address` varchar(255) NOT NULL,
  `relation` varchar(10) NOT NULL,
  `marriage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `person_id`, `parent_first_name`, `parent_middle_name`, `parent_last_name`, `parent_address`, `relation`, `marriage`) VALUES
(1, 1, '1dqFJvyOGpF7fputPWhAFoEJiLzcq5tlLg15JoHwCmc=', 'frDp55nZLUOZXFDTVA/5wFAVG7yn170hUN1mpmrdsLA=', 'iVIl0u02vPe69eDjD5AKTyW+6V6qiZNDkiQ12eQvaC8=', 'KScZsL/q1sUsG8jkWYYGl0jbooggdcBSDF5MkRCiqXY=', 'father', 'EsptqUXdf3QIPU5R1cux+dl6JL+IDeWOudTnRw7opIw='),
(2, 1, 'i2GzZMsIICHG8eMPEGz4kCOHYCvSIFD/X7CLnoCPmSQ=', 'LExwZalY9ZPkOaZoy0a/o18fD6JjdnHRaur/3A0QtdY=', 'U4q8iENkejZZhWxj9cjB6VxvL9frlGLBXUxwXUV25mw=', '0xwDzifjxZh6Np7fQRftEdoJzAMh+xY1SEX7WMXZkAE=', 'mother', 'EsptqUXdf3QIPU5R1cux+dl6JL+IDeWOudTnRw7opIw='),
(3, 2, 'Mr5quJSnTQD3vUy7NJJ0y5EbB12+9BClmoXGg2rB+8k=', 'Go7iDlIH204JKu1hly9YUwN5IJkK1oY8z0vuB6E5oN4=', 'ILQAGjfr88ouYhTfNwC8uMNDAceBmp36dSPe4v7MjlA=', 'h76HZ6mybLu9FXasMdX7DuKSKl9Y54VwalmleVe+l00=', 'father', 'u/GniLP319fEYIQqiNXPzi6YprzB++0hoooaZuihQlY='),
(4, 2, 'g6WrzGIzsfqhO9NX62PlBDly9PaseFO/jurNSuR9eUY=', 'qQ1EjQRrYkiOPtEFHXDuHZVPw6kDNtvrPmbL2I6dmFQ=', 'T0U/jZJsHNN1LhMO7r137lpy+ooKvS2aYcOKLZ5C0Gw=', '2KrFmI1MEKNieaNM1QtRALykPikvXKAH15M07vgJoQA=', 'mother', 'u/GniLP319fEYIQqiNXPzi6YprzB++0hoooaZuihQlY='),
(5, 3, 'ioIXwj00okPimjW71wm/oAsjZiaUZIoppY7ajJy9jHA=', 'yB7bF8QbumzUs4kkDMHck8DoSEfLwTpil+2TtJzeDj8=', '/xEe5Pvb658bpKG+B9YggtSH0PAG3cpQbfaA/wLlVkc=', '', 'father', ''),
(6, 3, 'TEVtMIg31SJo88stL04Yejd2PkdwWCYnxSd6mrOovd4=', 'zt9uoL3SMBf1wj0irczR7q3EDu7FYAax9agjeZQD6w0=', 'lI/rgolFshAufd3HZQX+m0rIG/eSm462VRuc+WeC6uU=', '', 'mother', ''),
(7, 4, 'Ew/nLnHsR8GFKl5JLZvquOAm8ClKB8G4X4tuUpqHe4A=', 'sU2ooKRjg8zxGuixskw1p6Ro4OJwDLFchaloqJDjmtA=', 'Pg4voziJVjj+n34LHIgwq+v8tqbqXpwCJOChqY6+Bsk=', '', 'father', ''),
(8, 4, 'E1IYinZ+S6tVHayBuQIyfDuMiLqTeKnZ37xUv+q8ReQ=', 'TrVC2iKDfA7vfZt9YYpyA71okhqT5gaj9tx0i+Nu7vY=', 'AEn0BY+AzZ9V19fYstl13t1x8tDytSOzqcafaBMFFpc=', '', 'mother', ''),
(9, 5, 'bvPeL8fZUFbueqKXbIDcer6Fc88usyXR5ZuCLuIrgH8=', 'IVDAn/hIMtRaLZu3OtUKb3afk+hbP8zPEKIo2E/lPEQ=', 'bJP3sRVvLww4xnTVJXZKa7PvLydMaYExq2rmTPjdlG4=', '1RqcawQOPfSAqx8ducDCWvqJWgzN0etHTkKE66IzXdk=', 'father', 'LHOCZhLJWQN/HZYF5jgdtxB3yAdfXb9y7ByscpdYN08='),
(10, 5, 'bpYecdEKHvTaYrRmxbWUY38WD3WJX8PhB+GBrNVgcrg=', 'xPS8EfhvoG3p1kzhdAhVvoMhYu6F+lyRtLotIpKADBA=', 'qKDuTQsh6UfFrCknEH/D5vA9/1dUfEHlsaXLGKpxYpw=', 'm8Hau5B/bFWM+BssME9/kWPcsPO20wsIfuR8kyE74EY=', 'mother', 'LHOCZhLJWQN/HZYF5jgdtxB3yAdfXb9y7ByscpdYN08='),
(11, 6, 'MbTztADjcGeeejAbksA5Ow09AJcR4EeITFLvB7nnVag=', 'kyWsbWVmJBxLdb8wj2d5kI76xx+y0xp214syKm90Z5g=', 'BjD9waLmAeAWv0u7XqLSHZNnPFL++AH02mXQ9HH50LE=', '', 'father', ''),
(12, 6, 'ohLCrg+eUt7lVctHCzY7n4MJc3aB9oWZFjpc+aHdYig=', 'KM1T5jgMebfKPcehuYMLs7wGwUJGiJEG9vBgAtKcGT0=', 'gNYt0/lcw+8rzFOFwjLs0vTXAqyOcQeJl8MCGCl/a1s=', '', 'mother', ''),
(13, 7, '64LddP80W0Eg1IDi2UplMX+8nMRef3mbW1ZbQ057tg4=', 'mMfff2GZatxNT0e0kv8afU1/da/CaEAZTObGvD6/TBg=', 'fiX5XWXh/2ni83wGaBU1sJcghonpb9L+9daI2RAfv0c=', '', 'father', ''),
(14, 7, 'zs4NLC2ok2PDGqFTUjX/Dhv4yTWHHAz28l4pPNbM1M8=', 'UDI/nqnK38u2EBa64QL0+IqHtQonyWjAFUrKQYviBHA=', 'FK7wx4RDZtgZsYV+ka+wZxm7lbqriSETc3GVrmbuG2Y=', '', 'mother', ''),
(15, 8, 'SomAydDAR+6n03UXLU2LjGysTVp2rZ/KybHBmxb/eCc=', 'ORZZ+GISwfv/6Gr6uFrJPTnRwRb/OE0CToawKKt9VCE=', 'nHVi7d8tMfzJssTZ6yws5vmJkqB+Jy78M/B33Y2htnQ=', '', 'father', ''),
(16, 8, 'fs4jEZCekDQgROBVc4hk5/VSh2C5fgc8mTAQzhp5SKc=', '4Ar2fDNFMVS2RNRDo1NADpvV6TIXhpSjD9SVIIdGveE=', 'HY1g2UQiceHdohUHTsy/dgGMqzQNfmS8v+BNwVKVP8c=', '', 'mother', ''),
(17, 9, '+kiOp7XhpEZaMgLOKj99/eAE9HNYSBmyjtLEQyo08WA=', 'irS0K1nfiutyEiM2IQBGLypjM0n2xiRUC6cBAqlBbW0=', 'FTQMZDj9Lc+lrs8EafLqB/B70re4vHY1sMiPj2/+zhk=', '', 'father', ''),
(18, 9, 'GHD51JKTZH0uoqq1K4nZYzL7npE6xH+vQcpnLc/36PU=', 'mrFeJfcL+Sq636ZR0u+1MoCouI33ZYwTdGGKIzZKpu0=', 'EZ/mLZ4Vn9w/baNgCfU1VovYm5xZYvJPOrfBldzHRoA=', '', 'mother', ''),
(19, 10, 'KAgZPIsTH5FaAT62cKbB7cQMBLX/RLf0lJkfr0sLmQY=', '4YJFL1rbfyiUElS8PEKhsOyu7/7sInlWQEKXQ3tPG90=', 'nOW3qNk0Ey0iYcdUiuInG/w437fbSfD0/c7HEa7yR8c=', '', 'father', ''),
(20, 10, 'DKSyHbccsytAJ2mMqIgFJduz5oZmmZ+eSu7s/2t+org=', '1QOZYCyH+o0STey31ENe0QThzFd9CBvaQEiOQewX3Sk=', 'F2IEd81yMyoKaqxxR6OsImq44dGLL5NUEvc4fz76/PM=', '', 'mother', ''),
(21, 11, 'hwox/v07wl5PV9IpzsWg7jCwF1q18xZyrUlusFM4QzM=', '0ya29hSYuuCaa2CA2/TFwLSM/QuEqBqAXticgQQuFEo=', '3+74+HouyAuTJbeQvC5lqt/440zl35SKEbluXIUgXhc=', '', 'father', ''),
(22, 11, 'qTktV2eU6QwuBT44OGCqgFuVMjGslRBubnUZzM1LKYA=', 'OIX9dGTtU8oqFcVqEUHbGz3KipbacEVwrVuhFECCZ0g=', '0UjNnrxy3GpSo7cpmxVVv9stihuFx7fymNjhDSDat4M=', '', 'mother', ''),
(23, 12, 'FTITRUcI1mFVl7CCsRnryCiP+te3UwQCf8eWujcEeq8=', 'sIG0B1eI10El91HEdB9zOf8SvRa+8vuzrHAYKDPyWwQ=', '8KUYBXgViWwV8TCJK2u62BxXY4m7y61TzO0GYZDGMjg=', '', 'father', ''),
(24, 12, 'qHeT6D12n8id2H2NKWrr4OrHRo+EjsHioMjL09jtE6o=', '6Y3D/9eytHOckliBWpOQitU27wLC2rFx9THOYVK7eII=', 'V23L4wawnMxw9nCAvMezYaBaKMA6fIznAKtDzuAruYI=', '', 'mother', ''),
(25, 13, 'X4XIY0tw0WsaCZIWOEZln0750svuk9AvA0RJKx7v+7k=', 'Wd6XWvxDqYbcsC3pmprGxsyT0wukmjVJUr1ksS1cMNk=', '4EKhISOIXn8ghkRphfntubGywuJ6+pA0bCPC3hhqDnY=', 'ARKwtccoQhJ44Ca/qkRJdbSkk5kkS8G3Np6RKlptx2E=', 'father', 'te9IS1chb2jSHP0Qc31SwgdPCLeLFrpRxUoO+dTnZmE='),
(26, 13, 'Fvwd8Zh1pw1Gn+DHobFRFhXY9+wqh67lYE1TygTgrNg=', 'eJKrG3/j90dbeDi/QdmRImCz8yODZn34bHbZildNPAw=', 'BQL+7W98boUpuyU2PUOl5dr6Dv5bf2bawpXzB96kUyk=', 'ZwQduT8GN5qv/EMiIsJikLyUZKvFxw7Rgy7+qosFIVI=', 'mother', 'te9IS1chb2jSHP0Qc31SwgdPCLeLFrpRxUoO+dTnZmE='),
(27, 14, 'KjGQhW3Ie8tlNev5RwmJOrmTjKsXwr30IY1FpyAfO1M=', 'nHe4ohua+DMJO8/8vOcGDw8h871NRytZpyetrbRJYMQ=', 'w+fq10i1TuGnttCmUXF2V/hzjsIRTm/mOTTB7eevHrg=', '+T+8qogr9ddGeiWaDvGZMNk79Nj5D+MBi9T61v7WPFk=', 'father', 'T737G2xMIT8u0gSM+/uG4+Jzqeobi0aq0rug8K8aw3M='),
(28, 14, 'aI2AuHU26kBNNtC2t0YAw0QU+pGIaYms4WnAxwKIU58=', '7QvWykOW5VM0V4jGD9whi0UyYqrAnfgsiz8zh4LPLIg=', '6YIdavm3gyaLhlFFSvEQ/w8sbj2S+v7dNz86YtNXPq4=', 'g2+Wl3UCPZ8Lm8tRk4jKyT87Qlzu47gfXiM2O/pTrFc=', 'mother', 'T737G2xMIT8u0gSM+/uG4+Jzqeobi0aq0rug8K8aw3M='),
(29, 15, 'Wdh6dQmAfCSwrqIQbo/CFfKnbuiJTddoCarY6IqeUx0=', 'S4nVf/4KR2nWaccv7EvfteDjMFYAt8jBnQnWuA+4kVo=', 'PxIKN02OK2V/DcCARmXn54Q4O22jt+qqBJa62SIQoKI=', 'ZhaTUlox6buTWd4V5EBvHqDCZe71pcEiOO/xQOqWKXQ=', 'father', 'IqCKHYsxM3KkaLUFDRmj1zbSsg9p62osiLdJji8OKTI='),
(30, 15, 'rMB918XnFqn4gbFhGQOouHKEGVgUQkPO50nekrQR9q4=', 'OZDjZpvYRBkvxFYIbkwQDq7ZwXc6WuvNrfQa8tkW3o0=', 'la8aGszh1dfsxcJRPXAR4Bn5dzlTlJkbYtXxL5C42cU=', '17qtXXvioXstCEzWQohu9FiEodyGlNz5OvxLDAv5KIU=', 'mother', 'IqCKHYsxM3KkaLUFDRmj1zbSsg9p62osiLdJji8OKTI='),
(31, 16, 'r7H8ETwsqRaGl9QxLZyc5wR6F+PWe2yH3OgibKxTKqs=', 'C/NX0/yMfxZ9HmgWB93SK/qxWG+67Z6ctL8RJYVWqu0=', 'IdHpBx9+FpROXl2aXj4VTKisiM+ddH+eGhvnOYh8thE=', '', 'father', ''),
(32, 16, 'fwAYEdJp2cJCLvz4ApXKRn0WCr1pVLOADHl0Ib3WFfQ=', 'f5pMPPBlzMD5w4q35EW/co2wiAoPJZOk43YgAt5xrQA=', 'YbCHovmFBWO13bT/xzhhM0TBzJ6WC9hn6VrDo4+M51M=', '', 'mother', ''),
(33, 17, 'H/SP4FSTuv5xAoHbg1gTB31Ey5GPZX3BmZMMcY4IUIg=', 'rwVeBEXyLC7FzuN321xaBcHHQA7R2WRN1vKDK12keTo=', 'IrolDVGsHIdEH4NW+jYZDa7stf1PC+wAwBj+oEQmyuQ=', '', 'father', ''),
(34, 17, 'fuJmCCqa5T/U8bbjjbBRfLk8ZllPd5btDC1vc9bXARc=', 'Ae2AcWMTyP1d9upMGJ3pnmsYF37edrEom81EigijtvY=', 'ozuo/LydhTadnKYf2ssxQgAxWdV3y+PEAW9AdhZWH7g=', '', 'mother', ''),
(35, 18, 'D9RRpA+AD4PljOiwp4sAlShbBz0Ine8jL2A6ko6w8lY=', '/6u7R0G95oF2/Z61CEEb/NOudrqp62AxnYZQ6PhPBm4=', 'hBkcgEytvAqZ7Ae5B0kQPp056cigY4zD2tnmQ/Wc0Ps=', '', 'father', ''),
(36, 18, 'RT7PbuVCrXPfpS4QNDlnYbaCLfMC7Z29jNOTHSfFNJw=', 'LeoeZGZWvNl8luFDt1tqqDFD+sJd98ofQrWW78gauDQ=', 'n0Vp/y4kEJzWpAjtqEqAolrpmJMcCWZGn9ayDiVhqRI=', '', 'mother', ''),
(37, 19, '/5mYJ0Htwsq3a5poFN4lmdviNxtjjFSys12VJZumkKU=', 'LX+Cv1zRjy56Kcy13TyHHNDsiAqxGh9qN51CJMdoyPs=', 'DcTV+VMAHA5wJDVxe9NxEpDp0tRN114mutm/Jn+B6/0=', 'U4fFCL3xi4e7PDAZjRy1v3JG3dFDKxChiebrRwQXyJM=', 'father', 'ob7gu27nl7NpVOwZgDv+WapdrvdH8tNZxnkslkxVPPw='),
(38, 19, 'aa18XJKXDSJWX2hbMoZJnxRMlL7lG1cdLc4/TysFpfg=', 'DQAKF1ZzhZaMnA+gkT0CoeAbH7DaQVg5ytpJwwr0BRU=', 'vHTKf22bgXtP7/Ae8tYrxKBILHAOplny2zEICop5gzU=', 'cEE88dDW3maVLawNu02fPDhOhv7nMO+W//5qVU3QOXs=', 'mother', 'ob7gu27nl7NpVOwZgDv+WapdrvdH8tNZxnkslkxVPPw='),
(39, 20, 'XbIP1VUNuw34F1g+vc9Up9LKAw3N9GULMG2rZ5Aiy6k=', '1+cVdeTmFMLKmN4fev7jO8iZQAwRxEavcWVlrCuTlAY=', '4J2OzZchrrTrgcVFPBAuGq+519Lby4wQz1j4233NeiA=', '', 'father', ''),
(40, 20, '9tWfw6h6m7Ft4UOuqUh9Bezd6v85CwWPr+G5BoqQ+H0=', 'YpFygulvyeAlNmDII7bTFjbCOllFtlqZelt0/TJiEvM=', 'AjYMYwYWSUC7tERmGdbiQdMfMjJ56QMOXpKAJ1UMUjI=', '', 'mother', ''),
(41, 21, '2PEs+8U1H0EljMVU/rp0wEAvtJ9vv3Q06kcYXr7UaaA=', 'oyS/BJHJhXjLlHZtUENutbsn7lw4c3RWfCOJvkZwYYU=', '63302tiGLvpG4wb4s34BUiai0BBRjcjWJyGNAUL+JJw=', '', 'father', ''),
(42, 21, 'y4qO4ePhfw/NdFPzCc1bG9qyvGMf2YYXCSAHAEsbO6c=', 'xJl1kRxXAb3nKXXoqJA+G18dMh7U+Pe+o9VSgBbfNSY=', 'tkntHzdtppnIC+muIih0Lw/IKq7509cv2yX0k1h/Ipo=', '', 'mother', ''),
(43, 22, 'WoHwm/k4YESfrlCKfdAbZVnQqHt/hC2oulEy3wngb5k=', '0xe0J9KetwWsFqLMrm7ODwPGHT2Cy1cFmTHkzyXx0zQ=', 'sYAxHCYXbNtaffF+be5psxmjHNYPsCEKM4rZGAviT9k=', '', 'father', ''),
(44, 22, '6/icJd9Z7+VEO/GiPpZwWHGTyXMvG69cwSJHgZ6e2WM=', 'NFVhwljBz4vOkusZYUGAaQaKYTjYy34hSXYsBxYxeMs=', 'PQQu8KNJKdb4hqFUMcbfy126sX7ghru+yj0JpUVBi24=', '', 'mother', ''),
(45, 23, 'tK/5fYghBE3BBas/5Sbvygk/aA+F3XlTYKHtTxOMRzc=', '5I9m5zS8RHToR+27rkltnE4Tg1yH9QehnuVgNdcQKGc=', 'KbAp2pTM2rFQ5Zzexxy0PoYf0Pb6qCCOEDi2sHSO4kA=', 'qKHZIhcZAoJIVP29+9obsVBvjIRfGQxaOm2uVLh6fKM=', 'father', 'NRBSoP2oD2wMvMJC1z+/F9mfJeqX3fUEuXfhPoEDZV8='),
(46, 23, 'XE91IdOO69Hcnk4bswuQsROp/9A73gGYeiZmA+BjAVE=', '5QsB8lDFVIi+qHoOuaYm6G4PY75Sbv0lhVNEcllPah4=', 'pv1qnI3DNriw8TANtKnsrhPv42fgFrri8P0AYhPucHA=', '72x6Ilu9IjJD0iI9/9RSrxTn0zO9qGnAo4aIy8CQ69g=', 'mother', 'NRBSoP2oD2wMvMJC1z+/F9mfJeqX3fUEuXfhPoEDZV8='),
(47, 24, 'E7NLePHMdvk6LPHO2EjPdG89KlS+W0A3703y+5TDr0A=', 'hutxjW35JA7RGUCVm5cFU7C+4EEthgj7jR0/+Rjl4rc=', '+NEBtHUVQdCxjVTSI7groGcZ8CPbLDRiD4hhOBCK+bU=', 'BdBnogGjZkp4bfblIpDvaJgbqnrfx4F+ZdB6GrX4s2A=', 'father', '7/WBDY1zrop92iO8JhgAKJDUob3mVRuZ0xEIXBeSq6o='),
(48, 24, 'XPy12iIB3/ET1YQgjPl/3vcc/L3JIprsgt0iiVDrKjY=', '9xdyvkyf96SbYz3KFwsFqMzXAybOv5S62zqghBktSjk=', 'zW2SgNT1Htdy6zGhCxqvaKv4TQifwyMoyFEmNcXAf2E=', 'A0E+LX2MKcVlof6poh5G6UwQSg9mj99jKrlVuwVZtwE=', 'mother', '7/WBDY1zrop92iO8JhgAKJDUob3mVRuZ0xEIXBeSq6o='),
(49, 25, 'sKDLTK5fZ3u3/qyyM/xiiHBFGiccKnLreogSzNclIz8=', 'K+LQ1B0fr/qmrl319rViOid6DGdqfbun/l3oLa3cQ24=', '5PIvVAkinJkXJgzXcamPsfJlwHMJrsA4/kRnptftaDM=', 'NvCak7FBt3+RZAQnz2ZSozrXnGMdLUGWopg+z7pfuZg=', 'father', 'AnmZbJj7dSZM1alrLtoqa2P792woL6Y1kMVlRIOJLKE='),
(50, 25, 'PTmEnUpTJF9KVb9RzJ/1Y8meq72h130btYJyW6LPiiw=', 'N5AKmV/pKFCewQhpr002jhCOICIIYHkeOydBejB7Aas=', 'BioVzt1Q0NE7sn36cZQvb6DpKX7JLdIEHeHrPoNfZvc=', 'RvX8QZsLdZrXM7lq+I+ROZxharVsjqq2hj9IBlRz4Dw=', 'mother', 'AnmZbJj7dSZM1alrLtoqa2P792woL6Y1kMVlRIOJLKE='),
(51, 26, 'VYJihETBmB3KNYpSs0duoXi+0EIW8oELHh7OPy2K0HI=', 'rZZseSHGwnnclx0mMgHJ8bYNL8YoDCynY1oPQU42mYo=', 'lGM7I3ZyBRpDWInjTlpOSZEQCVS1uSW28SD6IL1dctQ=', '', 'father', ''),
(52, 26, 'HH3qSU6tl5PFRhdwQaQru0IgUqGuNb+qUP2CQX+ej1c=', 'ylZsIfXb0a51Oi2Jhu3WVufbLGsp+/hJNxsoVLNfOLg=', '1xBUZCg/EYcDknwIEcwpKA4hEn5QXM+4LVOiZJXFvg0=', '', 'mother', '');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` enum('bride','groom') DEFAULT NULL,
  `sacrament` enum('baptism','confirmation','marriage') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `first_name`, `middle_name`, `last_name`, `gender`, `dob`, `age`, `place_of_birth`, `address`, `role`, `sacrament`) VALUES
(1, 'nEAol1JbVIxMxeoltw3w53bL9NCXh2NbE7Piao6oJWE=', 'Q5WEUQ9W7JTnyZ/McF78FEjEpicl5SWDHW0J4Q0oXKA=', '6rK7C1ycD36i8MAL554p15ymAzN1zpSjrjyRZf4JJAI=', 'Babae', '2024-11-26', 1, 'Qt6+DB3xDL04XD9MTnMjOX00gyXZgCfhYN8tIGVbtII=', 'WsK5JB1/YXTiXUlaldqTNtXm+yWRjak4fHWscDaWe70=', NULL, 'baptism'),
(2, 'YrgHYJWiZSYxiOr9QedkgmWFXQDz9P9nZ7PznUVHFV0=', '5QCK1VGj7hhiBADc43lJnmoQIPhHYSqZJQ62xEbF2lU=', 'uJVBKjbwbQYikZ1qcBSm28PFjbxnlSPDVLRX/edcLBk=', 'Babae', '2024-11-12', 1, 'INhBzsar6cd1L68KiTF7buMQCGLk0v4V5bNYtFk93rs=', 'eVq6TZD5ye+bc4vxDTUmwocfwQrX65nyKkWcI8qksS8=', NULL, 'baptism'),
(3, 'DF0N0/uy3fAn7PKDU0Wt+pJII3XvVB+hznffF4sAMRg=', '1CLjIrK3Psr6An2e/GX45eTt4w86h4k+7/mtb6sNcUs=', 'j5ywgyUqMoetzmZOpJFjB1AjbitNj0xk5tADZWykbmY=', '', '0000-00-00', 12, '', '', NULL, 'confirmation'),
(4, 'LSXLbZpWafskpJ9tsFjl4zEojz1NTimTgHsCc0TPmuE=', 'C47luznp5OMRc9Bv2aCJ5hTRkxPYZzzEZXADHq+rM9I=', 'HBWEWD79mEDC/9pkz+/3Z9Eoi+gXBtSKsIrAV6aTVeg=', '', '0000-00-00', 13, '', '', NULL, 'confirmation'),
(5, 'R47c0SFAo4HtnyN14ythbPtkq1WlG39Cz0N8dLu/IbA=', '7rixwy7p4BwlyhW5wDUFmf6k9109+Z408C85o34YbOU=', 'ff9ART1erhoNbV/+2JwpoknjlHIy3g5ZaCZAPzQa/Ck=', 'Babae', '2024-11-22', 1, 'lxe3GdiB2JPV8kfFFmnTc4Yvuae9dqU6250EYfv+Evg=', 'vSb7pMA+HJJQJDpZ80Lof1erNNk0W1fm5vaB9Dn+n5U=', NULL, 'baptism'),
(6, 'iRgw+346XQznAQbDxHMwAam8VkpF778XoZ+nsWsjfRw=', 'd5iUfmaCgAdP0jV8D5W8pnctQN4FuVBPyhfofGujRio=', 'NZoGhuqeZ2tvLXjMmEImK0J6dQkztzF/YSbwjC57zsw=', '', '0000-00-00', 25, '', 'P+R//iKo2jWauW61pQMYpGGjWAsThEvpVjdAREXuzVk=', NULL, 'marriage'),
(7, 'Z/GFfpLFpqhv4e5XlVfpsvcAroie0oo75FvH8xp8RFk=', '1AqT1Z9GL4sfnvnI0a4I1A74Qf4+EsceekNGx7a+WyM=', '/gLfBHqckUUzgjktgCyDiRONczOkOURFZIdV9cJSftw=', '', '0000-00-00', 24, '', 'QMvLfNhOhs9BXlx2D8XTF+PojxVwKg+qgTpRa7sjkp6IW1MLMLJxeG4vFDO6CdxS', NULL, 'marriage'),
(8, 'qdMQWFejCjbE0kaGZc86S7wNzid6lD64MI0oNB6dS08=', 'EIA3iQeYKqu4PesnSMOsCWD7cWiflueEhdfXwdYVDYQ=', 'ruNNBNLXVenUuUC40DvT8yj45XlnFdGFjxNeuvyWjoQ=', '', '0000-00-00', 12, '', '', NULL, 'confirmation'),
(9, 'SRq3AOxVIvYkht1L8F4y5as+K9fB3hZJLYs04tz0MDw=', 'btcqF1uEA47xPGVC7h1ZtVf/6TYN63ue4TwXG9FQq+E=', 'IGI/NeJ2TGS6OnnQjXBeDhZjlK6hcApqxE9CkHf9bYI=', '', '0000-00-00', 29, '', 'pU9NYx3+8WmbthgBa8Vr+dbIrfIx8lq+P2a/LhCZXFY=', NULL, 'marriage'),
(10, 'uD+0ggjLYDEOo5q9WsgXr4C6jUXwRY0Xbivz8duoolQ=', 'oTGDFsZEWT3XLDfAtMr0poeg95DpHUvOf7irAoCH5uk=', 'YfMOYt6neNa43sXf4ci0OejwS4yy1dOUW2+jqLXp/Q4=', '', '0000-00-00', 26, '', 'sQNtrg/q5trvTbNvZDvEMN9q6YxERLqCFqgSCdc3bxE=', NULL, 'marriage'),
(11, '9aHmDs4BZDauza+Bm8VnRjYCyD/dQgtEyZrNP+PBmXE=', 'ZtNRpEo2ABI2Jw+gEFpfAS1nzEy7E2b7O5ux/jHRZNA=', 'KBueJG9mTUk+nDWxwwNUyPqw9dw5KTyPP//W8FSyy4k=', '', '0000-00-00', 12, '', '', NULL, 'confirmation'),
(12, 'xa8/dPkzrgVlH3FEU9lgCMrkoKxlsZMP8E3J1eB+Xfc=', 'hipcjRJkeJ5zXiR+KFj2BusN2kLoTkw5ScPj7288iCo=', '9LzUmOZ1iJr9vYuPQP5iZ/ni66a3A4L+oJe17knyiXw=', '', '0000-00-00', 12, '', '', NULL, 'confirmation'),
(13, 'KFEhKn+PQBDVTxeyEnmaVdEwSot7dhOt5vDY6b8faqg=', 'dYzLynPccRYi0NvzhM+1Xeh0OixdbxsfTlaAa1D6zCA=', 'QxHGcmTXMf9AwsTrsY5/1zb+hqfWIc2sSGLbsZjFHZw=', 'Lalaki', '2024-11-22', 1, 'm5Qp+YRTOSGmVXVxJ496XNh/NfxWWUPLKJ/cRX8PRC4=', 'VhImnzjGowLEbX5JguwQlT1PhA1JLqthq6NxuIXnPbg=', NULL, 'baptism'),
(14, 'F2r9SIGsCavTXnSotauKLmqcsUlhsuOEYz3PG/2nj/k=', '/9DaMnaNSpxbQEIhQ7oVRkNgrdvDxmpc4ZjYCrYDuNo=', 'e3Kh4XQO2N7qOQ+d8kJ+yioALI3fFTsJq90BKs7FwIo=', 'Babae', '2019-12-09', 4, '1YBsh/O9rh7eski2/ncPipVuXi6l8Zt4qR0Vku8nn8I=', 'ORINNH/iv3b5fl3euJZ8/3cUSmqUOHpC66BeQLcRUAk=', NULL, 'baptism'),
(15, 'y4rewdfVXz/fcnct5Y0uAAj3vq3nfnO/LE/CWZFA9VA=', 'vBIn/qqoxlC9EoI97zxGEwcTJ/pi6N6tLD4OFjpoEpE=', 'YdYoXEDpjABGFmEXqt5q/nwM87WTkWJxn8qs2mem/DM=', 'Babae', '2001-07-30', 23, 'N3Rj7ff3fWJtGQQnTRWNy/qIJ5fsX/rjiUTS0Tv6FaE=', '3ODmmXv+5c/kdPq93ncns2HC/2V20pBP2dkww/vBmzU4Rj3NF0lMkkcrJuakbB1m', NULL, 'baptism'),
(16, 'U78y8egZ08bBHwPQY48xXgFGcxc4qIPSC6ULldep3jU=', 'e/r9x8zu8Q+IuCgVCpVeNrS0X+bTgpUHvrbC8NVYOd8=', 'hN20mLSJ2HjNMPaVMEvcm7U0pyVaxwVz/6JyaJZFnsI=', '', '0000-00-00', 12, '', '', NULL, 'confirmation'),
(17, 'OHDoyckF6lAQXaHPh++9f43JQrpfWuk2zVLXeu+rqFU=', 'dcM4ATCYCCiegvLSDGfrpRwU+x8Ms+1Jq5R/90PA3mE=', 'oW+57kfRp0r09Gszz8LSeXnRMwhodsSn/4nlGLQJ53g=', '', '0000-00-00', 22, '', 'Ue/IxFwsP4qJUhXFeZ9PCViDP+T2RcRULNwyrQMIXJ4=', NULL, 'marriage'),
(18, 'nOF2sCPpg5dToVisu7+M6ft1F2h5a6cOSJoDorNMSec=', 'WPSrbtG7gheWeyxL+RV3VYFVh1+OyfG6S185laONeFs=', 'TXa/uvt/uXdhQukA/TZnd6G2IOGdB5cs6YdtzE8JlIU=', '', '0000-00-00', 22, '', 'myWnQEb2ko57x65uuBlJyEsKC578I6QKQqizI/Y/DuE=', NULL, 'marriage'),
(19, 'zALYefLYTrjJH0xQAUXmOoU72ryhe36vbj2ew/7HfK8=', 'Bibeu71v/UXhZKYclk1lFnwDWD1x8v+iLFUuolW/7Dk=', 'sjUEWWNc6zSZ0ngs/bQz4jQzo1JWI8QA+byfgM+3a+U=', 'Babae', '2023-02-03', 1, 'W4V5jvxd6U9GunLebx1xhb1QdQU2+fwCl1wS54Pk2gM=', '6YWRzFapMyUTr2ofX0JylBQnHVy/JXUeOIZIMCk2m0Y=', NULL, 'baptism'),
(20, 'po2JSZrRPBXYU+2FZGrF/RZovV+GsxRvmW/Dy7hhI1g=', 'aAQtqT4IJ7teSlsxPxKmcRLrYDyUo82ZPZuEWif/B04=', 'IEk5FXvP9HiftaOCcPpUf3+dyFe4Pw57AV1aBaYAVUo=', '', '0000-00-00', 12, '', '', NULL, 'confirmation'),
(21, 'X7lEacntaq83Ip4oMR6JGqnGJhg4Ut4eCShMbJ1aYQQ=', '7HIO2SDFRZtJazJo0DAOXOGARwz7vEu7LIA3DPIQicU=', 'Evey5qpo5FlBlTcT0GLXWHx5TdpsHYQb4XRGGPqQtOs=', '', '0000-00-00', 32, '', '2rC+lkiGcXF/wbzlY97jYcF7u+UFqpZi4RJI1r/zSk0=', NULL, 'marriage'),
(22, 'iJTTGU85w8+0gVmkmWZIhj0iOxTc6Zk1RcpffHCD5yQ=', 'QtxTU6cuQrvVgcvnLPKYdYMhz2dzfVZLW9vzirxs5aQ=', 'RSjsQjdSuHkTvV1u1PsRdIVL/F6y3DGMu+m6Wv8Qm6w=', '', '0000-00-00', 29, '', 'icnLXqbIZg9TfNe5/E4N8JBGf/Kiv8+j7C7CFYHbM8K8z3zLzJLy3SRVNSrRzOnv', NULL, 'marriage'),
(23, 'RwZSRfbBKqv6SaaHt8xh1hqUZludLkRETtkQQjULNrA=', 'Qls1Ngpt/Ggf/tNxXF96Z8va4mRslokA2W9uS57R9uY=', 'iFkTmA5gfSbpu3ycPmlN9r72Vm3ygLUEa1Do9QwLV78=', 'Babae', '2025-01-02', 1, 'RqUM5dxz3vhQFHUC1osMo/mKJKs+rz6vkSo6lRgmpDQ=', 'tOkebbtI9v2WZhDSqYsqyXod3e3J1u8KWFGMxkYbprA=', NULL, 'baptism'),
(24, 'uKzjSn3jkLLhuR4X1titufRgCBbK8cUMU3Sp64X/nx0=', 'Z2R7BMVWSeXruY6bn+Qa3IxaCUkHvkvtDCNYOtS8Lh8=', 'f87K+AVPm6q1Ajc7w0gXfDkwOfrLWF4k9VqGt/AbI/Q=', 'Babae', '2019-08-07', 1, 'av6o6v1iHyVAJCtTBCQmZz4YjNhIKjfXdwQP/Q3RGBE=', 'XJwJ9CIfBm+5qdN/aQ76e8xSI13Sj/A0x5EPkhyImmg=', NULL, 'baptism'),
(25, 'HmOtn2uypZpR1KhkGfjBgLDWkDu9W0jxXOFTwxW3iAo=', '9Die6UKZdG9zrA7qsQQBpDzrVv16YmxtPavP3ytuOko=', 'JNdOe5WSu6SGMBlq3JVdC8Z3KYrUgmNZ1/83b2+1pBY=', 'Babae', '2025-01-01', 1, 'uilH7zv/YNCvK4AD6UvYxElB2CrGQ44ZEyZMndJ7d0A=', 'EjFoZ+gBAc7YhRfVEzmoRM3Qai51cJMbcPuXdbWRWcw=', NULL, 'baptism'),
(26, 'jS/zfo/r1FNafHlpJCdETytNGGZgcYAjuI8xjYOnXHM=', 'OwCStZkVOQcPfiDRBG6ZR1QI4coG8IaKNImDNFjHzzE=', 'A75UgcfjBI7pMkckj3f5PKWwrVbnd4OLMyFcnNPp388=', '', '0000-00-00', 11, '', '', NULL, 'confirmation');

-- --------------------------------------------------------

--
-- Table structure for table `prayer_req`
--

CREATE TABLE `prayer_req` (
  `prayer_id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `prayer_rq` varchar(300) NOT NULL,
  `prayerType` varchar(20) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT NULL,
  `kind` enum('public','private') NOT NULL,
  `approved_by` varchar(50) NOT NULL,
  `approved_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prayer_req`
--

INSERT INTO `prayer_req` (`prayer_id`, `Name`, `prayer_rq`, `prayerType`, `time`, `status`, `kind`, `approved_by`, `approved_date`) VALUES
(18, 'Aierrys Angel Garcia', 'please Lord, sana po maging okay lahat', 'Thanksgiving', '2024-11-14 18:08:12', 'approved', 'public', 'joyce', '2024-11-14 18:10:15'),
(20, 'mariah', 'I wish', 'Thanksgiving', '2024-11-15 14:29:14', 'approved', 'private', 'joyce', '2024-11-15 14:32:19'),
(23, 'belle', 'maraming salamat po', 'Thanksgiving', '2024-11-15 14:40:50', 'approved', 'private', 'joyce', '2024-11-18 12:06:33'),
(24, 'skye', 'thanks po', 'Thanksgiving', '2024-11-15 14:42:14', 'approved', 'public', 'joyce', '2024-11-18 11:55:14'),
(33, 'Jasmin Milla', 'gumaling na si vane', 'Special Intention', '2024-11-21 10:43:42', 'approved', 'private', 'joyce', '2024-11-21 10:52:04'),
(34, 'Jasmin Milla', 'gumaling na si vane', 'Special Intention', '2024-11-21 10:56:11', 'approved', 'private', 'joyce', '2024-11-21 10:56:36'),
(35, 'Jasmin Milla', 'gumaling na si vane', 'Special Intention', '2024-11-21 10:56:51', 'approved', 'public', 'joyce', '2024-11-21 10:57:00'),
(40, 'minda', 'thank you po', 'Thanksgiving', '2024-12-08 15:07:55', 'approved', 'public', 'joyce', '2024-12-08 15:16:42'),
(41, 'martha', 'thank you po', 'Thanksgiving', '2024-12-08 17:08:49', 'approved', 'public', 'joyce', '2024-12-08 17:33:11'),
(42, 'mandy', 'thank you po ', 'Thanksgiving', '2024-12-10 13:56:23', 'approved', 'public', 'joyce', '2024-12-10 14:18:19'),
(43, 'mylene', 'Thank you', 'Thanksgiving', '2024-12-10 16:48:43', 'approved', 'public', 'joyce', '2024-12-10 16:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `priest`
--

CREATE TABLE `priest` (
  `priest_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `priest_title` varchar(50) DEFAULT NULL,
  `priest_fname` varchar(50) DEFAULT NULL,
  `priest_mname` varchar(50) DEFAULT NULL,
  `priest_lname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `priest`
--

INSERT INTO `priest` (`priest_id`, `person_id`, `priest_title`, `priest_fname`, `priest_mname`, `priest_lname`) VALUES
(1, 1, 'zOZgXtvg/lZdh1GVv5SpsWZgQqe2/WGsXklha+XAM7U=', 'KnmTByFKKDK752Sf0IdATM0gtom/6dF/NeKTA8H/TgI=', 'v0o5k3KPWME90Dld/7ZrBkGpt4AGvzt1QTHwu10+d/M=', 'uNh4CABoEvO645E1w1huOYoz50pA0apDr26odUhEECk='),
(2, 2, 'TCp8q57HHXs+V0dI1/ZLhamDEDWAp5CozVxIMAcnzzU=', 'ylWQun/DKNvOpQiHdZAFYrG+vxsewCdTR+Y9gl7W3dI=', '5HtsmFORQOBn+QAvDIIa6IrE9EvlvFOhPftQJ1dhEXQ=', 'Fj4l4qmlpMVyHe+ScdQWzVPdduCFdXf+sQoZmBUq6OU='),
(3, 3, 'AiAuxhPoZ81P0LXt8nHbYGeZqIEmaoFZ6tggKrJbF6E=', 'NmGm/vQH6mcQjuRQRKGRL505JY4RpsZoNpGUQnyg//c=', '81XX9E/S5LkeTHN0EtcLlE59cLjLs/dwSvaEF3iTZfs=', '6TwEV3LwDDzwYg4FmGKwi/EycfS5sdctaxGoKvjG2y8='),
(4, 4, 'BZWT1CBEXT4KCkDTNYQX+pcRWbKquKkJCA7Ie6ERkSs=', 'I70Po0YiZDIIGiV6dLuJva3hmXlI+5eof/nWLT6Ec4M=', 'G1B7T2ms5rre9rjwxY9oJODD1012wsb+JNgQJazrSCY=', 'deTNEj62xozmpVMxtmYqVzRw+8GO4p55adeH1dgVYII='),
(5, 5, 'hpvT0FKNOM10cx9ZsJgaZje2ugR0tdSNMrQnpr5hiBI=', '3g3NqIeDYPwD//hYR0yTW7kGzrfMyXAyE1qJHnGLd2c=', 'icjVVItVp5zxtlywuGyyHvRBC3H3IFmcCv46q5CcMx8=', 'eYOwAtZKjSO+xyASHqeF1aaNO4r7UCs1ID5QJF26p30='),
(6, 6, '6c/g2lcIYBvl4aaY1WxLmP87quwLoTd0+MjL4pkyL54=', 'nmVdgK5OxYkuvSI1GutnyQ3uGYyhW27J5klrSPdu9XI=', 'ioDwhg00nKGKj4vlFNgbnwBc5sAHR4onfO62D9MvMjU=', 'm/2IMxARKqRwHVHlruNf34+tE/18PtrogyYo+L4i940='),
(7, 7, 'M3P+nnxYRQE94EN/wZyWS90NDmz0aqCFcIaEw4e03UM=', 'dSqyJ7t5k/NnpSsOqAovVWs9teY2vQmeEAv4T/b56Dw=', 'kEHOPaKEn/b05YI9bwHtQhRSB5cKVJhksIFYUEd1K+o=', 'mKs/CFQro9ZZSYwamZ1rE0oPub4+IxgHOC+gX+ZsdaI='),
(8, 8, 'nKDLZXamOescgvEdGiAJkRx0Ot9WgShNpE6a9pCxuMs=', 'EkGvsne+UkPq0N0wbyzEaZW8vIHxRwuRhI9Ozcd0yAc=', 'KdIsnigzLFtDumRjl9kFvBfKMs+3xb51hKSe+rp0fLQ=', 'Z1mxio5gF5QmByY+hp5ANO+0jzQ9n3sf8uRxVSCecBk='),
(9, 9, 'uedPDBftcJLRNT0Nt5NsDE+mcstO5YCR1mZ0JRC4l0I=', 'dVz0/+FMnxFM12qrzAm/VljQjr0HttKYqyC5nSYPZAA=', '0tyhlXVuRXQZtrfF/a69C8D8paQFkz8zbT/YwINrB5E=', 'DbuibxPIhos5GZ1MxU+Wlfrq0zP50FAId6GLg8S/SVg='),
(10, 10, 'lq2Rx+IgAjBLkSmpVsVPv5svijsBJvgE9GJr3h++780=', 'gD9Q4pA6a7RZuNP8BbJTnn7GhJOFYOClA2OjXLiao+I=', '2E2LEhh9IIe24HZ2VI57Ja5RkbnGsPdGnZXsbhj7ldc=', '5n1c/5AEBBenh/27lqXCtUIXJTtdeeMShoJAPUHtKhc='),
(11, 11, 'qShjPGznuR0jVfTDLh44lZQIZws999A58Z3yuEt/k7w=', '95Y9onTMYON83SDZg6aX6t7DIsBARScauIOH5NGEaGg=', 'i/OLuAbjcOMThXlyynZgah2fKMsFtc11vjahXA1YaoM=', 'b4IAqvTvCqoBJCHIyOLypl831oF/7qN1ahSRAKTQLoM='),
(12, 12, 'GHLS+d/0KlC+n/VYeHTYVKWBVn+bvphagmdgOK1sxSU=', 'CPJgyAbXMjL5vnoqzqQojarnpmvu062DDYlmvZ1wwfs=', 'VewagZQFoxYJoRRfUCLMJh1efa5Mr4AFOUuomgw7dNw=', 'ml0SUUxwNxVGGlNGW9HXmzEhk0gF37jiuOH7F98ABJs='),
(13, 13, 'NS+JDeGwhd6rH6V4Uaygqpztx1jzbT5p4wFTWzrP75A=', 'SylbgwoVy7GMk9j5NZGLdGcgw0Adcg4C4vM/JWUxab0=', 'FsYnC5IKTcuZ+gsAiu+X0zUaP0+6IsWKW9fAk35ONLc=', 'WzZWo24DsJIyIQJ1HUnmYu6oGuGwz74WU5JuQOZqxYI='),
(14, 14, 'bdecUpi3Q3klsoIPh9Sumf4OjQcqDKuunVCYhL5KFBM=', 'qR2sXZBCK8TtYg4/T7x12y7bkl/FxMhZvsRxXnkTYkI=', '6ewdpuRKzW8l8fC+0fxHJy3a7ptAn8Hyjk6be4pF22s=', '7nrE1FJxe4YuTot/PkRwYzgDO7teBVZpmC6pIILFfA8='),
(15, 15, 'kaVYwT1PR3hQvmeRserG1nu8nnzlCE9nu29C2m0rhms=', 'ChxKR2xjQlJxQb119H2e/wA+AbaTn4vUiUHYvZS14Lo=', 'rEjiZy6TkhKUVFs32ydemQ6GxNo5sinrxkeaI0G9WTM=', 'CwEw5GeJP3O3QKOnxlPbvr27wxgID+0ZaIE4bzJvE98='),
(16, 16, '+CR3yHocI0pvXZVq6BFZ0OTUI7uJK1Rgv6qeYlinjfQ=', 'Z0CEYeE9jxurpdiPDkAN2vhUAxXR0W0yyeBRA8iUS3o=', 'qadpnx3ovh26fhb3pUFGHl4Omjp73Vj4J4xKlb+XCa8=', 'NblvwneJwboAiQ6yI3qlDhIcMt6YlDxxwZQ7YaiQpgw='),
(17, 17, '9jJT/0mEYmPC+ViK9NPMePtyssr3oApMc4suJkoZv58=', 'qf/aGpb5YcMq0hjMNk6JWRMkhPLoG7plTeU/KHyujBQ=', 'DhR6X/wf8C5r+ouPfLU4KISivgyLzGGdaeu/Bg0ZUfs=', 'DcK//Eo/pKpDIl0VDZBhYgLL2zSbLmrtCqKnlITpGpA='),
(18, 18, 'rQVvJ+mHxburRFlfWw2eAoWAKYZitL//V2d6MpZmgp0=', 'ksrnOsbaEgQhF2SkrfN+A7Ef9tC5RoCfrPid63/BRQ0=', 'nkKt0p4lNLUWr++nTzGN7zEFlAKBn7OLl6d/HQGFkRU=', 'qRFGpySOsvYb/izw0SjuMspVN6+MiYFw8DJURxhDRdE='),
(19, 19, '6s1NjVsA5yLHyUBSO+LeyGo88k0qTi5rkji1n8iAvmQ=', '02Sk0sOnuNFCiBgUDZsmo2SDh4qC3f0BB3xGC+cY+1o=', 'yV5xFwrpXshl3defQnrIW6McdKHCZLuA+082t9wjMZY=', 'KazgQRYIsFx3nYNj3PoFKxHYcAic3QGIujvNDQ/yK5Q='),
(20, 20, 'F5jXWunhNq6aB7Mz7EvS9Xa5/BpnHtZItfnc1pVbfN8=', '8YSUt6ppvnAQXcc36473giTBmJItf6Qvi/NzjWrZoZ8=', 'K3JCncOAxWC3T5OpCwHjLmyUai9Te+p6aUj8vVp//ms=', '2rtGIj2abLpMIKxEkjK17PDuEphTJibhIn/MM4qmWDc='),
(21, 21, 'Wc9QvZ7foNrzUXVXbb5wxSnOBd+X1xWPyYXoygFTkV8=', 'Bss7/GaryuZoB3jAFmCFLHSv7T2wfYs8k8tp/Ek5TeQ=', 'r6kTmdJeRMA22SfDtxhtAVfNS8Gz9kTovq4VBis2JSU=', 'JtItI2N/Dz2XiXn6k/Tb+1kOccpLAVw9abx4ge7ju/Q='),
(22, 22, 'vnw0yAssCDgHVZE5GEnKXSybymtadRSxG4Ch6I5iNEw=', 'QFryRc7SsO19iWqXDh/q7OiGRd3WzUjtcpmzErlHuhU=', 'tCrmi/I0LVWvraLnFL2H8CFFxuyNtJNQaPnI70dlp+Q=', 'lYWr2GM0TTc3yuBI5tvh12iRp8pXPTg/810bZHPsR6o='),
(23, 23, 'jmVJt71XP4ClGLus3CSrz3MZGUAHLPKTLHEF0tRA66w=', 'HT3wD9CHBL0IqH/QS1vqYOH28gnDAd0dDUNa2E+IaEY=', 'krVQbDnxfxUd6nbH1tnDejYKYA9xjdQUO5Z3XNyE7pw=', 'GBXkcU/SFOqkfaFOo/pp8yeLQHtUNdkXQqYQ0D4TVuA='),
(24, 24, 'XM1tN4TPGNoyCVDD3v+l9Nycpd6P8RL8jMcgeLlsEcA=', '1QblF5Jym/HyhM2RGsiJbz9Hw1/7inWWLnvSE0x7gwc=', 'GZoHqpM/sZ/Xo1q88hEKHeOQYRHhrh0OxJ/rz39Fb2I=', 'oU0FyVAggpz7DyfSFlVLyFKw4P8C2GnA62XbMQg0sDE='),
(25, 25, 'mBe0iseL4HhiGB7GkEEoB3zwP4CqAdCUzffoIo854t8=', 'K9vpIwmezsDv6qXF4q/BRlfPbJ8VLBgGH0MLPal/Ajg=', 'bdmuC3MxN5T1/9qQFi+W3HxNouRdHU1Zd+Z2ajopRDM=', 'Xt+/ZNJ80JXkexyqXpKqn5op+RwGyzmjK8tn0g0Z3AM='),
(26, 26, 'h3hS/NTdCFF7OyCtryAqf1JmwQV/7TnUACGIMBM6hIQ=', 'f1M2xQz2ttmSmyRqSpe3H7EcvylWLGcCoElV6fg0k+w=', 'tLXqIr2PxKx47msfx2VHZ8kNnJF0DQr2LVs9zL70MBE=', '5YF6h01dx13rqJdVcYysCdJ6+ncqS8bKK/LzAg0h/so=');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `sponsor_id` int(11) NOT NULL,
  `sponsor_first_name` varchar(100) NOT NULL,
  `sponsor_middle_name` varchar(100) DEFAULT NULL,
  `sponsor_last_name` varchar(100) NOT NULL,
  `sponsor_address` varchar(100) DEFAULT NULL,
  `relation` varchar(50) NOT NULL,
  `person_id` int(11) NOT NULL,
  `sacrament` enum('baptism','confirmation','marriage') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`sponsor_id`, `sponsor_first_name`, `sponsor_middle_name`, `sponsor_last_name`, `sponsor_address`, `relation`, `person_id`, `sacrament`) VALUES
(8, 'yXBsd38WKFagoih5H0dMYBMsSeR7QKrxH4Q5pwnBGoE=', 'mq8IVMWxlPC6In0HLYcQZVbIDWmr67d3szQHZP7lex8=', 'oodZVa2eZ672Pyd9hZZsuIqyINUUbeK4E48WlRlP4/s=', 'yAhmhd3Bu3JM7x2HrB/lpfea8U/L6eNLe/G8Eajd9V8=', 'BoDdMzYDdp/mZM9NrTRHJfYjm724A9JNi6hLRtTMvyE=', 1, 'baptism'),
(14, 'BrzJWd3rxz6hxj4ncwI2Zo/26EODjBCjeU40UPGaPig=', 'f7+IY0MQdUG/oDeMl8X+7osvoQ9nEordHtLrT4dBflM=', 'e3NcDaPNDk/pGE5ujtabz/NCfz63W6xhbUv6biMRN1I=', 'dFN0lptnpuX3A6yJKqjmGq1afpOgw2mzF0/pgEuPdZU=', 'SwOcS9kzFbOzf0JOYXgwJJfwpnIpM1FoBpgpyP4A5Vc=', 2, 'baptism'),
(15, 'JFpk3+hjSA5iHIT0RlOAIjj/EVctJKx8y/g/x/WugN4=', '0+ts20GOWG6PaVLs2GYPqvzTaqLn/uE9tGB4EVhEZqQ=', 'x4fmwzFlKGzjitTmNtLESzfFE86Umi7314+XwIoM8+Y=', NULL, 'taTGWPSzgNqH8ToGxKHHm3yr1RiXXqJt6UMM1/ljRbg=', 3, 'confirmation'),
(19, '15GB6IgpBU7bbGN0MpHjMyj3hCYAuT266ycyi+hsEq4=', 'KP3kgOQSh4SrIcXSfcLpnABsydt4pOJTcTWHzs2i6zE=', 'hUMr/dSJlrzGZQJSJEBHI6KHYehlQCDX1E4nnOgo+TU=', NULL, 'VBm+cfvKtHySXy+pyWKs9qvNp34kukoNpO7wTAkX2ss=', 8, 'confirmation'),
(33, '2DS4YIv+SXraHnrVj4Q9Fg0RDe2noLOWFyokNxHhDp0=', 'q56LKe6OBntr0IG/f7xVk+4s8TzhygUw4rdDqgjBpow=', 'Fxi8Liv2vhj7tH8aJ9m8FY4QpaPn4RVWw8mjozTKlWY=', NULL, '3LiuPLwpqqlfLnWGGLirJtQRLTB8ENpL/0JOPjSWUBw=', 7, 'marriage'),
(41, 'CLGy9fJc4QocREgZWd8ctrXbpld+2ChxR0fkFY6bnHw=', '+KrotUNpvpfXtKfj956OQzaPLKyA5w3KB5lvPfyyCH4=', 'NPdEURzsqYHjSWGI3llyzV2Bf5ou/FxP35be1lb2qxs=', NULL, '1WCtsyBlBPDhBvSjdG5Nkcje7p9N0QdLkQqAWVCJ0tQ=', 4, 'confirmation'),
(78, 'pT4z0fIO2MJyq59NnYsvAKxOm5Mh1unZ4yj+GM/lJhQ=', 'ZtaxusV9eS3rzKhYlL42IPsFpqlfEA+Np9tHLGM+Wj4=', 'uM1O71PquFHPa2IMzXl4FgF+bbyXhYatTqOktrC/L58=', NULL, 'XxsLGV2zfMzk9VJee6uwboHRLGi1EMmJ1jqEpVwAKg0=', 12, 'confirmation'),
(79, 'Rzl7IerLdKjsGlEht4mkzATSKRTVHej9WpPrkWRG2z0=', '1UAKsixyXyhNqPppc6Dmq8VEPMy7SsYV7OJ+Cp5+bWU=', 'PWBMod21y2d0Q+2b10lR7/agMaFBTx68GBf9Q1+Ut4s=', NULL, 'GySpZ4t5zE8ycySpT/sJNQLya7+AumP44bZvPEZyzlo=', 12, 'confirmation'),
(94, 'hlfgmaJNu29SMIzESKS2UNa1I2NHoZM8ad85yTjOs7U=', 'eulcXqysZStiINfLB+XQB9J1JG+WTzVZIYRjO6wPqXM=', 'htbuYrVi7bKJAtDO2i/cROD4PkL2JNJW+Nt3sVm56Iw=', 'HnPkjxKnV5jVtR6SVL0bMxiz3+LDv2GT1NmjUuRcEso=', 'xHY+bZVvmRGuh8LmxKWssLwtQUCDawZzISnEUW6yc8I=', 13, 'baptism'),
(95, '/V+DNsLpNMKRgAtP+KboYWtuD0oXxQREuZ8tpgMVMXQ=', 'tld9qCLz9DUW9sHa0GrgvZ4Z6uzPN2Ms4hDVXZhqYzg=', 'WLbSxjswQxehJa8X4nKZQ35rcuFCgHxQ6vcyje08GEI=', 'bmZfzc2E3dYCofFeZu0k1ZxqGo9n9jaunEhLteSAerkUHFYd/+hBTGymKK6Yf+62', 'RFY9TmRGVbmF1zKgIH9z5vBDEOVWF7Ud5LdAVFZwXx8=', 13, 'baptism'),
(96, 'c15/oioII97ci+yPFhx/eHRto/ebqn8goIlYSz1Ok6w=', 'opq64dUnlvNa1VbtZFwH65DOFwX1yD5LXP1zLniYouY=', '5X0+V8bnuDRfYexEWO6uR94rYqdqls7DyNp6PD4lMvc=', 'hmHC2144cFdOvHw7h0iAboBTxM5JZjo3rMTYxeMQ680=', 'd/bUdO+bJWPOZmlYnVm7NP5Tku1a5r8PMyO+O/FBULY=', 13, 'baptism'),
(97, 's3kSMb36MLz2GtdnCYQvhS8YNcq/CP0q/9xvIUYecDI=', 'GuvL/hE3cKe/28Skifk6lRpBNu9mEr3NWL4bm/XIexM=', 'T/7gBY/v9xSR5PghnU5gRNmbD8Wqsdy33gMw986D+RI=', 'Y9HK96P3I6a79axQrkClqFCtNMZG1Ug64cWg0JwixWM=', 'ma/hGgflKHI2OxpKYHDboXFzil2+R9Ol5QzT31cmKkg=', 13, 'baptism'),
(98, 'p8febzR93RPReWJVnSx8MkB7d1KCAusxI2fo0XJixFg=', 'TgAzb0bEau/jFKa1k2m3Nn8k5Nn7AR1n9QhJjYyiCsQ=', 'fP//QthrJZqWtQo57jckD2ZkOw0uKrX1dwIRkceN8jU=', 'wZyGzWtAWa1wkzIr5jZL26fisAWqUSNZykVSl4uybFs=', 'LA1DJumVyDSevDfMbyjiGD+XDvg4jfOShatge9XC1X8=', 13, 'baptism'),
(99, '+LK0RWvZqp4itD0Ogxxg4VyzCzpC8r8Ff32J0zXaKnI=', 'W6XVvwh5MvQLx8XcqZqslGiZeklfC8T9PSxDo4xWrxQ=', '7nDkLqLAxgot3xN9Kyx2PXozhnS4Hi4drOu/dtP1Ppc=', 'uLhujUMHcWKR/vq6vZ1B8CiJefVLi35ZTxA1aAgcME8=', 'drNZvRRawSNjrVlSaj7wJRcvpcwdRF50g4IhRIzZd3s=', 14, 'baptism'),
(101, '+S3yUZi/aOZFTRC5RGteZcBOiOfRtvj1Wbs9SbPGctU=', 'c2eugY3EscgInEsjTxbE9EqjAji7jVhlhgd+iFYke3U=', 'Lg2rKDKdw118BkUiqBXPXh3R5xjIZGHBCqPQsly0HFo=', 'fc9565GGffZ7N7uZXeZwERQsQDpn4PKmjn2T+7UNmYg=', 'O5QiPwTZXMRi70HTPs+4CdaFJ83SLV9ObAAN3yTrBmg=', 15, 'baptism'),
(108, 'ex+HIWQF+ms/WJxKIWX/D1OokTt5JUqqR/jKAnmGbkw=', 'XZdaveT0Oby8o+DGFhElPNjZV0IaLs1w9kYVi2PkkMk=', 'MrnB8fKtbGfoiXbDLOceynR2aeqWu4oGGwEintfRPCw=', NULL, 'xELU/m8EETALBuy1iBDqWCWhQJ1sRl8pwmjhgl/quns=', 10, 'marriage'),
(109, 'G6CxrAVEjKcp2CmT1bPljhUcxIv7VDxhiWyFc2vbV6Y=', 'ax4723qwLCVCkxurYaYjOz4hutc/wykr4YA1qgeA+ww=', 'eWp2sv80jxvFRPmppVhuHjwAb186iP/30sLaJTVIg5A=', NULL, 'tC6agtpM6ZIiuhVzls+PlPEe0vfLh5ZUpj7u0FGAhHI=', 10, 'marriage'),
(110, 'LwrZDGi52cZfQtQaO63Iw6ZEptDX2nzUP06PLfqWn6w=', 'xM5YJLVI2kiOIUC67DBc/imCJTOsR8RfoHs/Nle3dcc=', 'RhHQu2YxlWVKcSPYKbZR/R3x4rxURhO6IzQheziPEfc=', NULL, 'TzR2UWm53B4h7fJj/5fPOwFvE1sloUjY6X9qVyXE1TY=', 18, 'marriage'),
(112, 'cm7J3bOybIW0Uy9fO04Umw9Pd6b1BUAM0Hsu7OWqigQ=', 'ZId/iN5ApUjKiIaOXusP1eL0zmu2cxWH/3jwZgipQCk=', 'XqT7hlVNcP/qthsRYhY1wJfdWs3GR3LeH+QvNvKZZs0=', 'NxsN/Kx6leFRjXaSdtI2gyhNwccUuyr85I5cERIiY6g=', 'iyYhfbEVvtjGGItZXhFP582ZiEXlTpKPAifqEEXyKRw=', 5, 'baptism'),
(114, 'hxa5YE5eWoBAoEgMJGyc6mOHV0oLjrL4gLxvDEu0uT4=', '93clCw7CE5T1Wxd8JeiJTVXZnef9hbdCE3/OZ2mmT20=', 'b6n8clLrOH/iaZzswlu4UqIuhczcSCNWXKMi37TS1sY=', NULL, 'V5+UjtseNfIYv5sD5wFU1WzSriWyZCbQCDxXfMKzLMM=', 11, 'confirmation'),
(116, '5XYhO6nB9ajt9wzqJLn8DLzEr0CAB3g+dACCPe9EXLA=', '4vnujt0rvBCNEw/Bd0Y5Y1BbvhZiG2yKwWZP+f+Qr1U=', 'iEXIIOZicmJmdptAkK8sVNvm5v0zz15mTmAgJ8bimkE=', NULL, 'xJC5QCa6iBgWw93HZShZH4cXXZbllHvZYnDeNvZUBgs=', 16, 'confirmation'),
(118, 'fN0i8zFxpcobPy6OGirOI0avIL5sqoehKLOiaKWjY+k=', 'kf9rjhZ9kzK+C5Mk0AWAZaNJhyYsh+vEmPl9rMtUlSM=', '4IOymT+4L7Z6ckxPUbhgTiB/O90qIxHSwJpkT29D5/E=', '/O9Ueb3pKHtKM9mo8ISBPedbJimVVe2wBOTnCYdUjXQ=', 'zFlE1iwoTTT61zO0PS//0MJnAZBP0C6L20cUDxl1Ua8=', 19, 'baptism'),
(120, 'iWC3/a5oT/MMFaAwDo1kiEyZuQGZdIkJqZvok9dpr78=', 'ZEp4vEYfyRPcRyXjgbBJD2UsUTIAHJUvRQdC/byEzTQ=', 'RC4k9PJ5HXcA3pGA6GDkJnly70mCtGl/EjIAWBAXsz4=', NULL, 'eCOhl2s6dd/Qk8rNp1HFtQ5p1MVoMQS6x/hsPmcoo4U=', 20, 'confirmation'),
(122, '4gPHeHbUhT0Q0WnUrHEzzRfAO0+5vpudsxSObRfCzKM=', 'YNcTydUxqM+lUQQijYT/D8P/3JK3XMKk9Mt6ej8YRLE=', 'gj6UYRq9LZg2k3VLm+9mKXn12bpnW4En5DXc8y6WIAo=', NULL, 'MBLhPgZXS8EOYpxYBMlX0Gtpyh6pTMZoMWZWOgBOIX4=', 22, 'marriage'),
(126, 'EjlFDCmZsQiNus/dqZcxdUoELADNfdXropHIRZoTyUU=', 'rXLO8TzksNxjg21TSSVKqaGs83kDopvFv2guN6OrYOQ=', 'IxqpLsKGhctYC87KlUEP8jIw7/4iWQLHM+xPZ+H/W4Q=', 'FoiPPbUixjZqRiL02iJCnOtWAGvdbiPl4I58kQ0cByI=', 'BHD6n9+sirJfCrE9NSvO7kkr7nG9kEulLhB5Gr7jTIM=', 23, 'baptism'),
(128, 'JaanfCi9pOkvcDhqzpqPz9ojrt49IjDG3tbCd/g4odk=', 'bXYCJzccqGsdyC8swn1OUDgHwQSo8inkeqlp7bkgkdE=', 'FBsmkoQBSvVahnfypm++sILssGuOYzX9nsQq+8vXl7k=', '6WwH3I5HbE4lKXzJvfwqx2Xg8zhXa/hKjt+0EPFmB4k=', 'i579UoT0ew1EZGPV4waD35VyuDZOMHI0RVQHfeaO8BM=', 25, 'baptism'),
(130, 'nMndAUuS+VQr6k2kq4lD84i0qJC4pgjwcD4WsmoaRPY=', 'mzl8Jt+dify072KIIwsy1IYCEj2knQvMTj55J+kv39k=', 'NbdSiuNZqhPnINOlxbT1Q7gIHKr+tvaxcIw5r2CRPMI=', NULL, 'm7epvMFxSdkQpRGkOmykYS8Hb+3ZhCg21EDPF8pp/H8=', 26, 'confirmation'),
(131, 'WwoEkaGWkSAFZ+RN6ABChfIgN/pzcmOSptwo9iSBqUc=', '+Z2b5VFS9HrGwXJ0gecnI63sYGUVUHobWV1d4oXxSk0=', 'tkszcYNEZpusbVYWR0uCVhibVAXAo4pyTtMGpwGr7uU=', 'PpHNDB/zg8l7X/NxHaOPhA9I6c9U2UcbK9mRtutcT5k=', 'RNdgSUdEwmOIbkxqm/RY002aezXjmLxf/Oayz0uuKiM=', 24, 'baptism');

-- --------------------------------------------------------

--
-- Table structure for table `user_acc`
--

CREATE TABLE `user_acc` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_acc`
--

INSERT INTO `user_acc` (`user_id`, `username`, `password`, `email`, `first_name`, `middle_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 'mariah', '$2y$10$Xa3t0JyT5DFb44v82v5TdOxDkTQp.HZoJhudBy3f5GVCc4RIZ6Sca', 'tuEb+GfuRbtOK76kgCs2lL/aTL5UsHdeiAzn28GHJ5qasNISzobB/G+41MTSTh/s', 'm+HeKftf23H7Oa+l5iautItbrNfCORQU52Oh1w07Sjc=', 'IfFZ3L37B4zytmWGxGlJ5OjKZcGPrr4756czxRBOhhQ=', 'B64wuIl0iJmX2FcrJJPAujmmlUyWHnapcWw0+P4Qd9w=', '2024-12-08 09:10:08', '2024-12-10 08:31:21'),
(2, 'donna', '$2y$10$oSTKTUthbeE7C69KEht0z.7FeEystR3Iu2dkzNK3YVsdVqtbL9MOS', 'I7wVDynEsXKZbaf7sz49O5rZkUd0ukliuiCLhp9dlUOVNgGAAe0h756/wDAZ32LK', 'SRduF0tPh+b4H2JSWXV7fowHm58nWeUp4M5C93uduak=', 'yc9BDhFkPLb7rrqv6qeAIwUwhIQ9Tv4A3CRHRH3fAk0=', 'bls/fXslxWKkaKhYkcMG5h6q2hTuoizQ6OuENti7tyI=', '2024-12-10 06:00:15', '2024-12-10 06:08:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`activity_log_id`),
  ADD KEY `fk_id` (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `baptism`
--
ALTER TABLE `baptism`
  ADD PRIMARY KEY (`baptism_id`),
  ADD KEY `priest_id` (`priest_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `fk_admin_id` (`admin_id`);

--
-- Indexes for table `certificate_requests`
--
ALTER TABLE `certificate_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `confirmation`
--
ALTER TABLE `confirmation`
  ADD PRIMARY KEY (`confirmation_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `priest_id` (`priest_id`),
  ADD KEY `fk_sponsor` (`sponsor_id`);

--
-- Indexes for table `marriage`
--
ALTER TABLE `marriage`
  ADD PRIMARY KEY (`marriage_id`),
  ADD KEY `fk_priest_id` (`priest_id`),
  ADD KEY `fk_person` (`person_id`),
  ADD KEY `fk_groom_id` (`groom_id`),
  ADD KEY `fk_bride_id` (`bride_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `prayer_req`
--
ALTER TABLE `prayer_req`
  ADD PRIMARY KEY (`prayer_id`);

--
-- Indexes for table `priest`
--
ALTER TABLE `priest`
  ADD PRIMARY KEY (`priest_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`sponsor_id`),
  ADD UNIQUE KEY `sponsor_first_name` (`sponsor_first_name`,`sponsor_middle_name`,`sponsor_last_name`,`person_id`),
  ADD UNIQUE KEY `unique_sponsor` (`sponsor_first_name`,`sponsor_middle_name`,`sponsor_last_name`,`relation`,`person_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `user_acc`
--
ALTER TABLE `user_acc`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `activity_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `baptism`
--
ALTER TABLE `baptism`
  MODIFY `baptism_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `certificate_requests`
--
ALTER TABLE `certificate_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `confirmation`
--
ALTER TABLE `confirmation`
  MODIFY `confirmation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `marriage`
--
ALTER TABLE `marriage`
  MODIFY `marriage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `prayer_req`
--
ALTER TABLE `prayer_req`
  MODIFY `prayer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `priest`
--
ALTER TABLE `priest`
  MODIFY `priest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `user_acc`
--
ALTER TABLE `user_acc`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `admins` (`admin_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_acc` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `baptism`
--
ALTER TABLE `baptism`
  ADD CONSTRAINT `baptism_ibfk_1` FOREIGN KEY (`priest_id`) REFERENCES `priest` (`priest_id`),
  ADD CONSTRAINT `baptism_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`),
  ADD CONSTRAINT `fk_baptism_admin` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `certificate_requests`
--
ALTER TABLE `certificate_requests`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_acc` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `confirmation`
--
ALTER TABLE `confirmation`
  ADD CONSTRAINT `confirmation_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `confirmation_ibfk_3` FOREIGN KEY (`priest_id`) REFERENCES `priest` (`priest_id`),
  ADD CONSTRAINT `fk_sponsor` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsor` (`sponsor_id`);

--
-- Constraints for table `marriage`
--
ALTER TABLE `marriage`
  ADD CONSTRAINT `fk_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_priest_id` FOREIGN KEY (`priest_id`) REFERENCES `priest` (`priest_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `priest`
--
ALTER TABLE `priest`
  ADD CONSTRAINT `priest_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `sponsor_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

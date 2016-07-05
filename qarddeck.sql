-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2016 at 07:49 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qarddeck`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deck`
--

CREATE TABLE `deck` (
  `deck_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=draft.1=published,2=deleted,3=temp,4=inactive',
  `deck_privacy` int(11) DEFAULT NULL,
  `url` text COLLATE utf8_unicode_ci,
  `bg_image` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `deck`
--

INSERT INTO `deck` (`deck_id`, `user_id`, `status`, `deck_privacy`, `url`, `bg_image`, `title`, `description`, `created_at`, `updated_at`) VALUES
(5, NULL, 0, NULL, NULL, '../img/temp/\\14670994215772291d40ea03.96056979.jpg', 'erf', 'wrfwe', '2016-06-28 07:38:15', '2016-06-28 07:38:15'),
(6, 31, 0, NULL, NULL, '../img/temp/\\1467175296577351808cc426.12044389.jpg', 'New Deck', 'This is a new deck', '2016-06-29 04:41:38', '2016-06-29 04:41:38'),
(7, 31, 0, NULL, NULL, '../img/temp/\\146717885257735f64c08731.33493878.jpg', 'Deck1', 'All about QD', '2016-06-29 05:40:54', '2016-06-29 05:40:54'),
(8, 31, 0, NULL, NULL, '../img/temp/\\146718111057736836788a00.40893332.jpg', 'Denu', 'About myself', '2016-06-29 06:18:32', '2016-06-29 06:18:32'),
(9, 31, 0, NULL, NULL, '../img/temp/\\14671811505773685e7b4b99.71056894.jpg', 'Cool Qards', 'sfd', '2016-06-29 06:19:11', '2016-06-29 06:19:11'),
(10, 42, 0, NULL, NULL, '../img/temp/\\146718347257737170026473.13257943.jpg', 'My Deck', 'Sample Deck', '2016-06-29 06:57:53', '2016-06-29 06:57:53'),
(11, 31, 0, NULL, NULL, '../img/temp/\\146718365257737224a97762.27501622.jpg', 'Branded', 'Simply a Deck', '2016-06-29 07:00:54', '2016-06-29 07:00:54'),
(12, 31, 0, NULL, NULL, '../img/temp/\\14672027165773bc9cb298e4.09110683.jpg', 'Sample', 'Sample Deck', '2016-06-29 12:18:38', '2016-06-29 12:18:38'),
(13, 31, 0, NULL, NULL, '../img/temp/\\14672027735773bcd5c66ff2.62776775.png', 'Simple', 'simple qards', '2016-06-29 12:19:35', '2016-06-29 12:19:35'),
(14, 31, 0, NULL, NULL, '../img/temp/\\14672028215773bd0579f477.69928281.jpg', 'Test', 'test', '2016-06-29 12:20:22', '2016-06-29 12:20:22'),
(15, 31, 0, NULL, NULL, '../img/temp/\\14672028495773bd213cd1a2.07443868.jpg', 'Hehe', 'sdfsf', '2016-06-29 12:20:50', '2016-06-29 12:20:50'),
(16, 31, 0, NULL, NULL, '../img/temp/\\14672030075773bdbfe25d64.09053694.jpg', 'One more!', '', '2016-06-29 12:23:29', '2016-06-29 12:23:29'),
(17, 31, 0, NULL, NULL, '../img/temp/\\14672650145774aff6e04f65.04686428.jpg', 'sd', 'sdf', '2016-06-30 05:36:57', '2016-06-30 05:36:57'),
(18, 31, 0, NULL, NULL, '../uploads/\\1467615541577a0935830338.04465575.jpg', 'venice', NULL, '2016-07-04 06:59:01', '2016-07-04 06:59:01'),
(19, 31, 0, NULL, NULL, '../uploads/\\1467616001577a0b014706c2.11492482.png', 'zsxa', NULL, '2016-07-04 07:06:41', '2016-07-04 07:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `deck_comment`
--

CREATE TABLE `deck_comment` (
  `deck_comment_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `deck_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 =inactive,1=active,2=deleted,3=flagged',
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deck_permissions`
--

CREATE TABLE `deck_permissions` (
  `dp_id` int(11) NOT NULL,
  `deck_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `permission_status` tinyint(4) NOT NULL COMMENT '0=inactive,1=active,2=deleted',
  `permission_type` tinyint(4) NOT NULL COMMENT '0=view,1=edit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deck_tags`
--

CREATE TABLE `deck_tags` (
  `dt_id` int(11) NOT NULL,
  `deck_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `deck_tags`
--

INSERT INTO `deck_tags` (`dt_id`, `deck_id`, `tag_id`) VALUES
(7, 5, 1),
(8, 5, 2),
(9, 6, 1),
(10, 6, 2),
(11, 7, 2),
(12, 8, 1),
(13, 9, 2),
(14, 10, 1),
(15, 11, 3),
(16, 11, 4),
(17, 11, 5),
(18, 11, 7),
(19, 12, 2),
(20, 12, 4),
(21, 12, 5),
(22, 13, 3),
(23, 14, 6),
(24, 15, 3),
(25, 16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE `follower` (
  `f_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1459750532),
('m130524_201442_init', 1459750772),
('m140506_102106_rbac_init', 1459751149);

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `org_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE `privacy` (
  `privacy_id` int(11) NOT NULL,
  `privacy_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `privacy`
--

INSERT INTO `privacy` (`privacy_id`, `privacy_type`, `description`) VALUES
(1, 'public', 'Visible to everyone in the system');

-- --------------------------------------------------------

--
-- Table structure for table `qard`
--

CREATE TABLE `qard` (
  `qard_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `qard_theme` int(11) DEFAULT NULL,
  `qard_privacy` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=draft.1=published,2=deleted,3=temp,4=inactive, 5=template',
  `title` text COLLATE utf8_unicode_ci,
  `url` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `bg_image` text COLLATE utf8_unicode_ci,
  `last_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qard_image_url` varchar(2550) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `qard`
--

INSERT INTO `qard` (`qard_id`, `user_id`, `qard_theme`, `qard_privacy`, `status`, `title`, `url`, `description`, `bg_image`, `last_updated_at`, `qard_image_url`) VALUES
(53, NULL, 124, 1, 0, NULL, NULL, NULL, NULL, '2016-06-09 08:56:22', NULL),
(54, 31, 138, 1, 1, 'xcfvdfsv', NULL, NULL, NULL, '2016-06-09 08:56:22', NULL),
(55, NULL, 129, 1, 0, NULL, NULL, NULL, NULL, '2016-06-09 08:56:22', NULL),
(58, NULL, 143, 1, 0, 'Test', NULL, NULL, NULL, '2016-06-09 08:56:22', NULL),
(59, NULL, 147, 1, 0, 'nbvxcv ', NULL, NULL, NULL, '2016-06-09 08:56:22', NULL),
(60, NULL, 149, 1, 0, NULL, NULL, NULL, NULL, '2016-06-09 08:56:22', NULL),
(61, NULL, 150, 1, 0, NULL, NULL, NULL, NULL, '2016-06-10 08:16:55', NULL),
(62, NULL, 151, 1, 0, NULL, NULL, NULL, NULL, '2016-06-10 08:17:02', NULL),
(64, NULL, 155, 1, 0, NULL, NULL, NULL, NULL, '2016-06-13 08:22:02', NULL),
(65, NULL, 156, 1, 0, NULL, NULL, NULL, NULL, '2016-06-13 09:24:27', NULL),
(66, 31, 157, 1, 0, 'dsfs', NULL, NULL, NULL, '2016-06-14 04:26:24', NULL),
(67, 31, 159, 1, 0, 'god', NULL, NULL, NULL, '2016-06-14 04:28:34', NULL),
(69, 31, 166, 1, 0, 'Green', NULL, NULL, NULL, '2016-06-14 04:35:14', NULL),
(70, 31, 167, 1, 0, NULL, NULL, NULL, NULL, '2016-06-14 05:08:41', NULL),
(71, 31, 168, 1, 0, NULL, NULL, NULL, NULL, '2016-06-14 05:12:27', NULL),
(73, NULL, 175, 1, 0, 'Qard', NULL, NULL, NULL, '2016-06-14 12:23:24', NULL),
(74, NULL, 176, 1, 0, NULL, NULL, NULL, NULL, '2016-06-14 12:49:02', NULL),
(75, NULL, 177, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 06:05:02', NULL),
(76, NULL, 184, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 06:05:26', NULL),
(77, NULL, 188, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 06:08:55', NULL),
(78, NULL, 189, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 07:17:45', NULL),
(79, NULL, 198, 1, 0, 'ferf', NULL, NULL, NULL, '2016-06-15 07:21:57', NULL),
(80, NULL, 200, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 07:23:33', NULL),
(81, NULL, 204, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 07:25:46', NULL),
(82, NULL, 205, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 07:27:24', NULL),
(83, 31, 209, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 07:29:14', NULL),
(84, 31, 211, 1, 0, 'dfgv', NULL, NULL, NULL, '2016-06-15 07:51:41', NULL),
(85, 31, 212, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 07:54:42', NULL),
(86, 31, 213, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 07:54:43', NULL),
(87, 31, 214, 1, 0, NULL, NULL, NULL, NULL, '2016-06-15 07:54:44', NULL),
(88, 31, 243, 1, 1, NULL, NULL, NULL, NULL, '2016-06-15 09:56:01', NULL),
(89, 31, 244, 1, 0, NULL, NULL, NULL, NULL, '2016-06-16 05:01:00', NULL),
(90, 31, 246, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:25:17', NULL),
(91, 31, 247, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:26:03', NULL),
(92, 31, 248, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:27:07', NULL),
(93, 31, 249, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:28:04', NULL),
(94, 31, 251, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:28:26', NULL),
(95, 31, 253, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:33:34', NULL),
(96, 31, 254, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:35:25', NULL),
(97, 31, 255, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:35:50', NULL),
(98, 31, 256, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:42:11', NULL),
(99, 31, 257, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:43:25', NULL),
(100, 31, 258, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 06:44:56', NULL),
(101, 31, 271, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 07:03:49', NULL),
(102, 31, 275, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 07:12:57', NULL),
(103, 31, 278, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 07:31:07', NULL),
(104, 31, 281, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 07:49:05', NULL),
(105, 31, 282, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 08:46:04', NULL),
(106, 31, 284, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 08:48:12', NULL),
(107, 31, 286, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 08:49:50', NULL),
(108, 31, 290, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 08:53:31', NULL),
(109, 31, 291, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 08:58:30', NULL),
(110, 31, 292, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 08:59:41', NULL),
(111, 31, 293, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 09:01:45', NULL),
(112, 31, 294, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 09:03:07', NULL),
(113, 31, 298, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 09:05:18', NULL),
(114, 31, 301, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 09:10:07', NULL),
(115, 31, 302, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 09:23:39', NULL),
(116, 31, 304, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 09:26:42', NULL),
(117, 31, 305, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 09:27:20', NULL),
(118, 31, 306, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 09:27:45', NULL),
(119, 31, 307, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:03:13', NULL),
(120, 31, 308, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:07:24', NULL),
(121, 31, 309, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:08:17', NULL),
(122, 31, 310, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:09:19', NULL),
(123, 31, 311, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:13:16', NULL),
(124, 31, 312, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:19:11', NULL),
(125, 31, 313, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:20:16', NULL),
(126, 31, 314, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:21:38', NULL),
(127, 31, 315, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:21:44', NULL),
(129, 31, 317, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 11:51:52', NULL),
(130, 31, 318, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 12:17:24', NULL),
(131, 31, 320, 1, 1, 'Sunset', NULL, NULL, NULL, '2016-06-17 12:17:40', NULL),
(132, 31, 321, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 13:07:04', NULL),
(133, 31, 322, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 13:09:48', NULL),
(134, 31, 323, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 13:10:28', NULL),
(135, 31, 324, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 13:29:34', NULL),
(136, 31, 325, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 13:40:42', NULL),
(137, 31, 326, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 13:51:08', NULL),
(138, 31, 327, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 14:00:02', NULL),
(139, 31, 329, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 14:05:31', NULL),
(140, 31, 330, 1, 0, NULL, NULL, NULL, NULL, '2016-06-17 14:09:18', NULL),
(141, 31, 331, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 04:35:07', NULL),
(142, 31, 332, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 04:40:37', NULL),
(143, 31, 333, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 04:45:59', NULL),
(144, 31, 334, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 04:53:35', NULL),
(145, 31, 346, 1, 1, 'Sample', NULL, NULL, NULL, '2016-06-20 06:11:00', NULL),
(146, 31, 348, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 07:03:00', NULL),
(147, 31, 351, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 08:44:03', NULL),
(148, 31, 354, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 08:46:43', NULL),
(149, 31, 356, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 08:47:32', NULL),
(150, 31, 358, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 08:48:15', NULL),
(151, 31, 360, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 08:50:36', NULL),
(152, 31, 362, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 08:51:55', NULL),
(153, 31, 363, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 09:14:02', NULL),
(154, 31, 368, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 09:14:07', NULL),
(155, 31, 369, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 09:18:41', NULL),
(156, 31, 370, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 09:20:18', NULL),
(157, 31, 376, 1, 1, 'Sample', NULL, NULL, NULL, '2016-06-20 11:21:31', NULL),
(158, 31, 377, 1, 0, NULL, NULL, NULL, NULL, '2016-06-20 11:54:55', NULL),
(159, 31, 378, 1, 1, 'tgrg', NULL, NULL, NULL, '2016-06-20 12:53:52', NULL),
(160, 31, 379, 1, 1, 'dfgdf', NULL, NULL, NULL, '2016-06-20 12:59:03', NULL),
(161, 31, 380, 1, 0, NULL, NULL, NULL, NULL, '2016-06-21 08:11:57', NULL),
(162, 31, 381, 1, 0, NULL, NULL, NULL, NULL, '2016-06-21 10:17:13', NULL),
(163, 31, 382, 1, 0, NULL, NULL, NULL, NULL, '2016-06-21 10:22:14', NULL),
(164, 31, 383, 1, 0, NULL, NULL, NULL, NULL, '2016-06-21 10:23:49', NULL),
(165, 31, 384, 1, 0, NULL, NULL, NULL, NULL, '2016-06-21 10:28:53', NULL),
(166, 31, 385, 1, 0, NULL, NULL, NULL, NULL, '2016-06-21 10:29:18', NULL),
(167, 31, 388, 1, 0, NULL, NULL, NULL, NULL, '2016-06-21 10:32:38', NULL),
(168, 31, 390, 1, 1, 'sadasd', NULL, NULL, NULL, '2016-06-21 10:38:27', NULL),
(169, 31, 7, 1, 1, 'sdfsf', NULL, NULL, NULL, '2016-06-21 11:09:37', NULL),
(170, 31, 393, 1, 0, NULL, NULL, NULL, NULL, '2016-06-21 11:13:12', NULL),
(171, 31, 394, 1, 0, NULL, NULL, NULL, NULL, '2016-06-21 11:17:26', NULL),
(173, 31, 7, 1, 0, NULL, NULL, NULL, NULL, '2016-06-22 05:34:38', NULL),
(174, 31, 7, 1, 0, NULL, NULL, NULL, NULL, '2016-06-22 07:19:15', NULL),
(175, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-22 08:47:03', NULL),
(176, 31, 1, 1, 1, 'Penguins', NULL, NULL, NULL, '2016-06-22 08:49:54', NULL),
(177, 31, 371, 1, 0, NULL, NULL, NULL, NULL, '2016-06-22 09:07:47', NULL),
(178, 31, 371, 1, 1, 'sdfsdf', NULL, NULL, NULL, '2016-06-22 09:11:23', NULL),
(179, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-06-22 09:29:30', NULL),
(180, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-06-22 13:41:19', NULL),
(181, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-06-22 13:41:55', NULL),
(182, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-23 04:17:53', NULL),
(183, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-23 04:26:32', NULL),
(184, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-23 04:38:25', NULL),
(185, 31, 1, 1, 1, 'New Qard', NULL, NULL, NULL, '2016-06-23 05:09:58', NULL),
(186, 31, 4, 1, 1, 'save', NULL, NULL, NULL, '2016-06-23 06:27:22', NULL),
(187, 31, 7, 1, 0, NULL, NULL, NULL, NULL, '2016-06-23 07:28:56', NULL),
(188, 31, 7, 1, 0, NULL, NULL, NULL, NULL, '2016-06-23 07:29:38', NULL),
(189, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-23 07:39:23', NULL),
(190, 31, 7, 1, 0, NULL, NULL, NULL, NULL, '2016-06-23 07:47:46', NULL),
(191, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-23 08:26:57', NULL),
(192, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-23 10:01:59', NULL),
(193, 31, 2, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 04:52:19', NULL),
(194, 31, 3, 1, 1, 'Bianca', NULL, NULL, NULL, '2016-06-24 05:01:47', NULL),
(195, 31, 2, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 05:22:58', NULL),
(196, 31, 2, 1, 1, NULL, NULL, NULL, NULL, '2016-06-24 05:23:21', NULL),
(197, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 05:47:37', NULL),
(198, 31, 2, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 05:50:51', NULL),
(199, 31, 2, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 05:54:21', NULL),
(200, 31, 2, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 05:55:16', NULL),
(201, 31, 2, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 05:56:16', NULL),
(202, 31, 2, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 05:58:33', NULL),
(203, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 05:58:46', NULL),
(204, 31, 2, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 06:06:37', NULL),
(205, 31, 2, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 06:10:31', NULL),
(206, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 07:15:30', NULL),
(207, 31, 371, 1, 1, 'rferf', NULL, NULL, NULL, '2016-06-24 07:17:45', NULL),
(208, 31, 6, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 10:01:39', NULL),
(209, 31, 5, 1, 0, NULL, NULL, NULL, NULL, '2016-06-24 11:20:06', NULL),
(210, 31, 371, 1, 1, 'Qards', NULL, NULL, NULL, '2016-06-24 13:02:40', NULL),
(211, 31, 3, 1, 1, NULL, NULL, NULL, NULL, '2016-06-28 04:33:45', NULL),
(212, 31, 1, 1, 1, NULL, NULL, NULL, NULL, '2016-06-28 08:26:33', NULL),
(213, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-29 12:37:06', NULL),
(214, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-30 04:24:52', NULL),
(215, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-30 04:28:58', NULL),
(216, 31, 1, 1, 1, NULL, NULL, NULL, NULL, '2016-06-30 04:29:38', NULL),
(217, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-06-30 04:30:19', NULL),
(218, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-06-30 04:33:22', NULL),
(219, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-06-30 04:34:06', NULL),
(220, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-06-30 04:35:05', NULL),
(221, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-30 06:50:01', NULL),
(222, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-30 12:14:12', NULL),
(223, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-06-30 12:51:29', NULL),
(224, NULL, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-01 04:37:03', NULL),
(225, NULL, 1, 1, 0, 'sdas', NULL, NULL, NULL, '2016-07-01 06:34:21', NULL),
(226, NULL, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-01 06:35:42', NULL),
(227, NULL, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-01 07:10:04', NULL),
(228, 31, 3, 1, 1, 'New3', NULL, NULL, NULL, '2016-07-04 06:13:14', 'E:\\xampp\\htdocs\\qarddeck/web/uploads/qards/228.png'),
(229, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-04 09:33:00', NULL),
(230, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:37:28', NULL),
(231, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:37:55', NULL),
(232, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:41:54', NULL),
(233, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:42:18', NULL),
(234, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:50:48', NULL),
(235, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:52:45', NULL),
(236, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:54:01', NULL),
(237, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:57:37', NULL),
(238, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:58:19', NULL),
(239, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 04:59:33', NULL),
(240, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:00:07', NULL),
(241, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:01:09', NULL),
(242, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:09:45', NULL),
(243, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:10:29', NULL),
(244, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:31:40', NULL),
(245, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:32:40', NULL),
(246, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:34:58', NULL),
(247, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:36:08', NULL),
(248, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:37:06', NULL),
(249, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 05:37:21', NULL),
(250, 31, 1, 1, 1, 'Image Only', NULL, NULL, NULL, '2016-07-05 05:39:33', 'E:\\xampp\\htdocs\\qarddeck/web/uploads/qards/250.png'),
(251, 31, 3, 1, 1, 'Image only1', NULL, NULL, NULL, '2016-07-05 05:42:28', 'E:\\xampp\\htdocs\\qarddeck/web/uploads/qards/251.png'),
(252, 31, 6, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 06:23:43', NULL),
(253, 31, 6, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 06:24:49', NULL),
(254, 31, 6, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 07:19:59', NULL),
(255, 31, 6, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 07:23:18', NULL),
(256, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 09:44:03', NULL),
(257, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 09:51:19', NULL),
(258, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:02:40', NULL),
(259, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:02:50', NULL),
(260, 31, 3, 1, 1, NULL, NULL, NULL, NULL, '2016-07-05 10:03:16', 'E:\\xampp\\htdocs\\qarddeck/web/uploads/qards/260.png'),
(261, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:04:40', NULL),
(262, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:08:20', NULL),
(263, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:11:55', NULL),
(264, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:13:16', NULL),
(265, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:13:48', NULL),
(266, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:25:45', NULL),
(267, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:27:21', NULL),
(268, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:29:22', NULL),
(269, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:31:55', NULL),
(270, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:32:32', NULL),
(271, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:32:47', NULL),
(272, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:33:26', NULL),
(273, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:33:59', NULL),
(274, 31, 3, 1, 1, 'sfsf', NULL, NULL, NULL, '2016-07-05 10:34:40', 'E:\\xampp\\htdocs\\qarddeck/web/uploads/qards/274.png'),
(275, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:36:02', NULL),
(276, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:36:12', NULL),
(277, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:36:26', NULL),
(278, 31, 1, 1, 1, 'dfgvdf', NULL, NULL, NULL, '2016-07-05 10:39:11', 'E:\\xampp\\htdocs\\qarddeck/web/uploads/qards/278.png'),
(279, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:45:04', NULL),
(280, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:46:15', NULL),
(281, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:49:18', NULL),
(282, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:49:31', NULL),
(283, 31, 1, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 10:50:18', NULL),
(284, 31, 1, 1, 1, NULL, NULL, NULL, NULL, '2016-07-05 10:50:34', 'E:\\xampp\\htdocs\\qarddeck/web/uploads/qards/284.png'),
(285, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 11:23:12', NULL),
(286, 31, 3, 1, 0, NULL, NULL, NULL, NULL, '2016-07-05 11:23:34', NULL),
(287, 31, 3, 1, 1, 'gfdfgd', NULL, NULL, NULL, '2016-07-05 11:24:42', 'E:\\xampp\\htdocs\\qarddeck/web/uploads/qards/287.png');

-- --------------------------------------------------------

--
-- Table structure for table `qard_block`
--

CREATE TABLE `qard_block` (
  `block_id` int(11) NOT NULL,
  `qard_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=temp,1=active,2=delete,3=template',
  `is_title` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `text` text COLLATE utf8_unicode_ci,
  `extra_text` text COLLATE utf8_unicode_ci,
  `link_url` text COLLATE utf8_unicode_ci,
  `link_image` text COLLATE utf8_unicode_ci,
  `link_document` text COLLATE utf8_unicode_ci,
  `link_title` text COLLATE utf8_unicode_ci,
  `link_description` text COLLATE utf8_unicode_ci,
  `block_priority` int(11) DEFAULT NULL,
  `block_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `placeholder_text` text COLLATE utf8_unicode_ci,
  `help_text` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `qard_block`
--

INSERT INTO `qard_block` (`block_id`, `qard_id`, `theme_id`, `status`, `is_title`, `text`, `extra_text`, `link_url`, `link_image`, `link_document`, `link_title`, `link_description`, `block_priority`, `block_name`, `placeholder_text`, `help_text`) VALUES
(1, 1, 19, 0, 0, 'dfg fgb', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 21, 0, 0, 'fgbfbf', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 23, 0, 0, 'sdcvsdfdf', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 24, 0, 0, 'sdfsd', '0', NULL, 'rand_3100time_1464874991qid_4.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, 25, 0, 0, NULL, NULL, NULL, 'rand_125time_1464874967qid_4.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 5, 26, 0, 0, '\n		    ', '0', NULL, 'rand_3577time_1464946754qid_5.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 6, 27, 0, 0, '<span class="review-qard"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_url"><span class="url-content"><h4>php - Multidimensional array for data table - Stack Overflow</h4><span class="url-text"><p>How to Select key values by index</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 6, 28, 0, 0, '<span class="review-qard"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_url"><span class="url-content"><h4>What is wrong with my question, and how can I improve it? - Meta Stack Overflow</h4><span class="url-text"><p>I am building a site with Pinax, and its standard Django URL for the admin interface is giving a 404 error. I looked at the URLs.py, expecting to see commented-out lines for the admin interface, and saw what looked to me like urlpatterns including the admin interface among the initial barrage of URLs.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 7, 29, 0, 0, '<span class="review-qard"><span class="img-preview col-sm-3 col-md-3"><img src="http://meta.stackoverflow.com//content/Sites/stackoverflowmeta/img/apple-touch-icon@2.png?v=6de7587d1583&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_url"><span class="url-content"><h4>What is wrong with my question, and how can I improve it? - Meta Stack Overflow</h4><span class="url-text"><p>I am building a site with Pinax, and its standard Django URL for the admin interface is giving a 404 error. I looked at the URLs.py, expecting to see commented-out lines for the admin interface, and saw what looked to me like urlpatterns including the admin interface among the initial barrage of URLs.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 7, 30, 0, 0, '<span class="review-qard"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_url"><span class="url-content"><h4>yii2 change controller action in gridview - Stack Overflow</h4><span class="url-text"><p>I have ItemController and in actionView I put gridview of my Itempicture, and I want when I click on icon view, update and delete then go to ItempictureController.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 7, 31, 0, 0, '<span class="review-qard"><span class="img-preview col-sm-3 col-md-3"><img src="undefined" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_url"><span class="url-content"><h4 style="display: none;">	British Council IELTS Online Application</h4><span class="url-text"><p>Register online for an IELTS exam with the British Council. IELTS is the world''s leading assessment of English communicative ability â testing your English listening, reading, writing and speaking.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 8, 32, 0, 0, '<span class="review-qard"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_url"><span class="url-content"><h4>yii2 change controller action in gridview - Stack Overflow</h4><span class="url-text"><p>I have ItemController and in actionView I put gridview of my Itempicture, and I want when I click on icon view, update and delete then go to ItempictureController.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 8, 33, 0, 0, '<span class="review-qard"><span class="img-preview col-sm-3 col-md-3"><img src="http://meta.stackoverflow.com//content/Sites/stackoverflowmeta/img/apple-touch-icon@2.png?v=6de7587d1583&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_url"><span class="url-content"><h4>What is wrong with my question, and how can I improve it? - Meta Stack Overflow</h4><span class="url-text"><p>I am building a site with Pinax, and its standard Django URL for the admin interface is giving a 404 error. I looked at the URLs.py, expecting to see commented-out lines for the admin interface, and saw what looked to me like urlpatterns including the admin interface among the initial barrage of URLs.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 9, 34, 0, 0, '<span class="review-qard"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_url"><span class="url-content"><h4>yii2 change controller action in gridview - Stack Overflow</h4><span class="url-text"><p>I have ItemController and in actionView I put gridview of my Itempicture, and I want when I click on icon view, update and delete then go to ItempictureController.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 10, 35, 0, 0, '<span class="review-qard"><span class="col-sm-12 col-md-12" id="title_desc_url"><span class="url-content"><h4>Lima Mumbai : Finally a good Latin American Restaurant in India! – Indian Food Freak</h4><span class="url-text"><p>Having lived more than 12 years across the length of Latin America, I know this cuisine quite well and my earlier trysts with restaurants in India trying to pose off as Latin American have resulted in disasters.&nbsp;</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 12, 37, 0, 0, '\n		    ', '0', NULL, 'rand_6342time_1464963713qid_12.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 13, 38, 0, 0, '\n		    ', '0', NULL, 'rand_6664time_1464963980qid_13.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 14, 39, 0, 0, '\n		    ', '0', NULL, 'rand_2598time_1464964308qid_14.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 15, 40, 0, 0, '\n		    ', '0', NULL, 'rand_5726time_1464964746qid_15.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 16, 41, 0, 0, '\n		    ', '0', NULL, 'rand_6330time_1464964950qid_16.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 17, 42, 0, 0, '\n		    ', '0', NULL, 'rand_3546time_1464965142qid_17.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 18, 43, 0, 0, '\n		    ', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 19, 44, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>php - Generating random numbers without repeats</h4><span class="url-text"><p>I''m building a website that will randomly display a yelp listing each time the page is refreshed. The yelp search api returns 20 listings in an array. Right now, I am using PHP''s function rand(0,19) </p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 20, 45, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>php - Generating random numbers without repeats - Stack Overflow</h4><span class="url-text"><p>I''m building a website that will randomly display a yelp listing each time the page is refreshed. The yelp search api returns 20 listings in an array. Right now, I am using PHP''s function rand(0,19) to generate a random listing every time the page is refreshed ( $businesses[rand(0,19)] ).</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 21, 46, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>php - Generating random numbers without repeats - Stack Overflow</h4><span class="url-text"><p>I''m building a website that will randomly display a yelp listing each time the page is refreshed. The yelp search api returns 20 listings in an array. Right now, I am using PHP''s function rand(0,19) to generate a random listing every time the page is refreshed ( $businesses[rand(0,19)] ).</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 22, 47, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>php - MD5 random generate code duplicate - Stack Overflow</h4><span class="url-text"><p>I''m using md5 with random code, current datetime and customer_id to generate a hash code but after I run 200,000 records I found there is many duplicated records. How can i avoid the duplicate? </p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 22, 48, 0, 0, 'dfs sdfcrc', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 23, 49, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>jquery - CSS Toggle Switch enable all - Stack Overflow</h4><span class="url-text"><p>I want to add on function when I click on enable all to turn all toggle switch on. I''m using css3 switchers and now i turn on or off switch using .</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 24, 50, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>php - Generating random numbers without repeats - Stack Overflow</h4><span class="url-text"><p>I''m building a website that will randomly display a yelp listing each time the page is refreshed. The yelp search api returns 20 listings in an array. Right now, I am using PHP''s function rand(0,19) to generate a random listing every time the page is refreshed ( $businesses[rand(0,19)] ).</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 25, 51, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>php - Generating random numbers without repeats - Stack Overflow</h4><span class="url-text"><p>I''m building a website that will randomly display a yelp listing each time the page is refreshed. The yelp search api returns 20 listings in an array. Right now, I am using PHP''s function rand(0,19) to generate a random listing every time the page is refreshed ( $businesses[rand(0,19)] ).</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 26, 52, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>php - MD5 random generate code duplicate - Stack Overflow</h4><span class="url-text"><p>I''m using md5 with random code, current datetime and customer_id to generate a hash code but after I run 200,000 records I found there is many duplicated records. How can i avoid the duplicate? </p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 27, 53, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>javascript - Set new id with jQuery - Stack Overflow</h4><span class="url-text"><p>"this" is a text field, "new_id" is an integer.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 28, 54, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>jquery - Twitter bootstrap tabs and javascript events - Stack Overflow</h4><span class="url-text"><p>I am using twitter bootstrap for a project - in particular its tab functions (http://twitter.github.com/bootstrap/javascript.html#tabs)</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 29, 55, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>jquery - Whether a variable is undefined - Stack Overflow</h4><span class="url-text"><p>Possible Duplicate:Best way to check for âundefinedâ in JavaScript?  </p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 30, 56, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4><font color="#e5e838">Javascript - Set new id with jQuery - Stack Overflow</font></h4><span class="url-text"><p><font color="#170505">The content which belongs to this aricle will come here! Pretty intenrsting,huh!?</font></p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 31, 57, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_1"><span class="url-content"><h4>php - MD5 random generate code duplicate - Stack Overflow</h4><span class="url-text"><p>I''m using md5 with random code, current datetime and customer_id to generate a hash code but after I run 200,000 records I found there is many duplicated records. How can i avoid the duplicate? </p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 32, 58, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>User Dency G B - Stack Overflow</h4><span class="url-text"><p>Dency G B</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 33, 59, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>javascript - Set new id with jQuery - Stack Overflow</h4><span class="url-text"><p>"this" is a text field, "new_id" is an integer.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 34, 60, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>javascript - Set new id with jQuery - Stack Overflow</h4><span class="url-text"><p>"this" is a text field, "new_id" is an integer.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 35, 61, 0, 0, '\n		    ', '0', NULL, 'rand_6092time_1465217530qid_35.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 35, 62, 0, 0, '<span class="url-qard-block" id="url_parentblk_2"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_2"><span class="url-content"><h4><font color="#ed112d">MD5 random generate code duplicate</font></h4><span class="url-text"><p>I''m using md5 with random code, current datetime and customer_id to generate a hash code but after I run 200,000 records I found there is many duplicated records. How can i avoid the duplicate? \n<br>\nHere goes the answer!!!</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 35, 63, 0, 0, '<span class="review-qard" id="url_parentblk_3"><span class="img-preview col-sm-3 col-md-3"><img src="//api.jquery.com/jquery-wp-content/themes/jquery/content/books/learning-jquery-4th-ed.jpg" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_3"><span class="url-content"><h4>jQuery.parseHTML() | jQuery API Documentation</h4><span class="url-text"><p>jQuery: The Write Less, Do More, JavaScript Library</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 36, 64, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_1"><span class="url-content"><h4>Tastes of Thailand at Sofitel Mumbai BKC – Indian Food Freak</h4><span class="url-text"><p>Apart from being a favorite holiday destination for us Indians, Thailand is a foodie’s paradise too. And thanks to Sofitel Mumbai and So Bangkok who, in collaboration with the Tourism Authority of Thailand, have brought in the Thai Food festival right here in amchi Mumbai. </p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 36, 65, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="http://www.indianfoodfreak.com/wp-content/uploads/sites/3/2016/05/title-400x214.jpg" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>Fashionable Foodie: Is there any correlation between Food and Fashion?</h4><span class="url-text"><p>People don’t normally talk about ‘fashion’ and ‘food’ in the same breath. Many a times, I have been asked how I can be a fashion designer and yet be so active in food groups</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 37, 66, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_1"><span class="url-content"><h4>jquery - Gravity Forms Engineering - Stack Overflow</h4><span class="url-text"><p>Am tearing my hair out on a Gravity Form question. Anyone here know the GF hook system?  Here is the deal.  I have a 3 part form.  The 1st part contains several radio button style questions.  What I want to do is this:</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 37, 67, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_2"><span class="url-content"><h4>javascript - DataTable width is going beyond a panel - Stack Overflow</h4><span class="url-text"><p>Good day everybody.Im new on ASP.Net MVC 4, Im using DataTable plugin for my table and Im encountering the following problems. 1. DataTable Width is going beyond the width of the panel that contained it. 2. It didn''t generate a child row that will supposedly show the columns that will not fit in the panel''s width.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 38, 68, 0, 0, '<div class="bgoverlay-block" style="background-color:rgb(255, 0, 0);opacity:0.6;"><div data-height="6" style="height:225px;" data-block_id="48" data-theme_id="68" class="text-block current_blk working_div" unselectable="off" contenteditable="true">gjkhkg jkbjkhgf jkhjkhfg jhdf<br><br>dfgvb<br><br>dfgdfg<br><br>dfgfdg<br><br>fdgdfg<br><br>fdgdfgd<br></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 39, 69, 0, 0, '\n		    <div class="bgoverlay-block" style="height: 150px;">\n			<div class="text-block current_blk working_div" data-height="4" style="height: 150px;" unselectable="off" contenteditable="true"></div>                                    \n		    </div>                                \n		', '0', NULL, 'rand_233time_1465277858qid_39.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 39, 70, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk working_div" data-height="1" unselectable="off" contenteditable="true">grtge fgbfg fgbfg fgbgf</div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 39, 71, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off">sdfsd dfg fddf&nbsp;</div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 40, 72, 0, 0, '\n		    <div class="bgoverlay-block" style="height: 225px;">\n			<div class="text-block current_blk working_div" data-height="6" style="height: 225px;" unselectable="off" contenteditable="true"><span class="review-qard" id="url_parentblk_2"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_2"><span class="url-content"><h4><font color="#39cfe3">jquery - Gravity Forms Engineering - Stack Overflow</font></h4><span class="url-text"><p><font color="#37d3c0">Am tearing my hair out on a Gravity Form question. Anyone here know the GF hook system?  Here is the deal.  I have a 3 part form.  The 1st part contains several radio button style questions.  What I want to do is this:sdfgdf dcvsdf dfvs</font></p></span></span></span></span></div>                                    \n		    </div>                                \n		', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 40, 73, 0, 0, '<div class="bgoverlay-block" style="height: 187.5px;"><div class="text-block current_blk" data-height="5" contenteditable="true" unselectable="off" style="height: 187.5px;">sdfsfdsdfsd df<br><br><br><br><br><br><br><br><br></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 41, 74, 0, 0, '\n                                <div class="bgoverlay-block" style="height: 150px;">\n                                    <div class="text-block current_blk working_div" data-height="4" unselectable="off" contenteditable="true" style="height: 150px;"><span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>javascript - DataTable width is going beyond a panel - Stack Overflow</h4><span class="url-text"><p>Good day everybody.</p></span></span></span></span></div>                                    \n                                </div>                                \n                            ', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 41, 75, 0, 0, '<div class="bgoverlay-block" style="height: 150px;"><div class="text-block current_blk" data-height="4" contenteditable="true" unselectable="off" style="height: 150px;">ghxukvhiosd jkbfv<br><br>vsdfv<br><br>fvdfvdfv<br><br>&nbsp;fgbdfgb<br></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 41, 76, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off">dfgvdf fgbfg&nbsp;<br>dfgvbdgvb<br></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 41, 77, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off"></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 42, 78, 0, 0, '\n		    <div class="bgoverlay-block" style="height: 225px;">\n			<div class="text-block current_blk working_div" data-height="6" style="height: 225px;" unselectable="off" contenteditable="true"><span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>jquery - Gravity Forms Engineering - Stack Overflow</h4><span class="url-text"><p>Am tearing my hair out on a Gravity Form question. Anyone here know the GF hook system?  Here is the deal.  I have a 3 part form.  The 1st part contains several radio button style questions.  What I want to do is this:</p></span></span></span></span></div>                                    \n		    </div>                                \n		', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 43, 79, 0, 0, '\n		    <div class="bgoverlay-block" style="height: 225px;">\n			<div class="text-block current_blk working_div" data-height="6" style="height: 225px;" unselectable="off" contenteditable="true"><span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>jquery - Gravity Forms Engineering - Stack Overflow</h4><span class="url-text"><p>Am tearing my hair out on a Gravity Form question. Anyone here know the GF hook system?  Here is the deal.  I have a 3 part form.  The 1st part contains several radio button style questions.  What I want to do is this:</p></span></span></span></span></div>                                    \n		    </div>                                \n		', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 44, 80, 0, 0, '\n                                <div class="bgoverlay-block" style="height: 225px;">\n                                    <div class="text-block current_blk working_div" data-height="6" unselectable="off" contenteditable="true" style="height: 225px;"><span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>jquery - Gravity Forms Engineering - Stack Overflow</h4><span class="url-text"><p>Am tearing my hair out on a Gravity Form question. Anyone here know the GF hook system?  Here is the deal.  I have a 3 part form.  The 1st part contains several radio button style questions.  What I want to do is this:</p></span></span></span></span></div>                                    \n                                </div>                                \n                            ', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 44, 81, 0, 0, '<div class="bgoverlay-block" style="height: 262.5px;"><div class="text-block current_blk working_div" data-height="7" style="height: 262.5px;" unselectable="off" contenteditable="true"><span class="review-qard" id="url_parentblk_3"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_3"><span class="url-content"><h4>javascript - drag and drop display divs for form wizard - Stack Overflow</h4><span class="url-text"><p>I''m new to jquery I wanted when onclick submit button whatever inside the droppable to display out what is been dropped inside, for now is whatever is drop inside will display out the ids but it is together.. I wanted them to display differently so I can put inside my form wizard step 1, 2 or 3.. Any ideas how to do that? please guide me along..</p></span></span></span></span></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 44, 82, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off">THE END</div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 44, 83, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off"></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 45, 84, 0, 0, '\n                                <div class="bgoverlay-block">\n                                    <div class="text-block current_blk working_div" data-height="1" unselectable="off" contenteditable="true">rfe erfger derfgv</div>                                    \n                                </div>                                \n                            ', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 45, 85, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off">wefwef</div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 45, 86, 0, 0, '<div class="bgoverlay-block" style="height: 150px;"><div class="text-block current_blk" data-height="4" contenteditable="true" unselectable="off" style="height: 150px;">wedwe<br><br><br><br>sdfgvv<br><br>sdfcecf<br></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 45, 87, 0, 0, '<div class="bgoverlay-block" style="height: 75px;"><div class="text-block current_blk" data-height="2" contenteditable="true" unselectable="off" style="height: 75px;">csfcsercf<br><br>dcvscdf<br></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 45, 88, 0, 0, '<div class="bgoverlay-block" style="height: 75px;"><div class="text-block current_blk" data-height="2" contenteditable="true" unselectable="off" style="height: 75px;">sdcfsd<br><br>sdfcsdc<br></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 45, 89, 0, 0, '<div class="bgoverlay-block" style="height: 75px;"><div class="text-block current_blk" data-height="2" contenteditable="true" unselectable="off" style="height: 75px;">sdssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 45, 90, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off"></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 45, 91, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off"></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 45, 92, 0, 0, '<div class="bgoverlay-block"><div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off"></div></div>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 46, 93, 0, 0, 'fdvge rgtrtg', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 46, 94, 0, 0, NULL, NULL, NULL, 'rand_1200time_1465291426qid_46.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 47, 95, 0, 0, '\n                                        \n                                    ', '0', NULL, 'rand_8610time_1465291481qid_47.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 47, 96, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_2"><span class="url-content"><h4>jquery - Gravity Forms Engineering - Stack Overflow</h4><span class="url-text"><p>Am tearing my hair out on a Gravity Form question. Anyone here know the GF hook system?  Here is the deal.  I have a 3 part form.  The 1st part contains several radio button style questions.  What I want to do is this:</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 48, 97, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>jquery - Gravity Forms Engineering - Stack Overflow</h4><span class="url-text"><p>Am tearing my hair out on a Gravity Form question. Anyone here know the GF hook system?  Here is the deal.  I have a 3 part form.  The 1st part contains several radio button style questions.  What I want to do is this:</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 48, 98, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="http://meta.stackoverflow.com//content/Sites/stackoverflowmeta/img/apple-touch-icon@2.png?v=6de7587d1583&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>Why is MCVE so utterly beautiful? If yes, can we put it more places, or make it more bright and garish and attention seeky? - Meta Stack Overflow</h4><span class="url-text"><p>I recently came across a comment including:</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 48, 99, 0, 0, NULL, NULL, NULL, 'rand_3479time_1465292225qid_48.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 49, 100, 0, 0, '\n                                        \n                                    ', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 49, 101, 0, 0, 'rfer', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 49, 103, 0, 0, 'srferf', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 49, 104, 0, 0, 'vdfdf', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 49, 105, 0, 0, 'sdfsdfsdf', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 49, 106, 0, 0, 'sdfsdfsd', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 49, 107, 0, 0, 'sdfsf', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 49, 108, 0, 0, 'dfsfsf', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 49, 109, 0, 0, 'sdfsf', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 50, 115, 0, 0, '<div style="text-align: center;"><b style="line-height: 1.42857; background-color: buttonface;"><font color="#1f0909" size="5">The &nbsp;sample Qard</font></b></div>', '0', NULL, 'rand_2315time_1465363951qid_50.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 50, 116, 0, 0, '<span class="url-qard-block" id="url_parentblk_2"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_2"><span class="url-content"><h4>Muhammad Ali - Wikipedia, the free encyclopedia</h4><span class="url-text"><p>Muhammad Ali /ɑːˈliː/;[9] (born Cassius Marcellus Clay Jr.; January 17, 1942 – June 3, 2016) was an American Olympic and professional boxer, widely regarded as one of the most significant and celebrated sports figures of the 20th century. From early in his career, Ali was known as an inspiring, controversial and polarizing figure both inside and outside the ring.Clay was born in Louisville, Kentucky, and began training when he was 12 years old. At 22, he won the world heavyweight championship from Sonny Liston in an upset in 1964</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 51, 117, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>Search data by taking input from datepicker in yii2 - Stack Overflow</h4><span class="url-text"><p>In this case the sql query in the search model is - </p></span></span></span></span>', '0', NULL, 'rand_6935time_1465364850qid_51.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 51, 118, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="http://www.voguefaqs.com/wp-content/uploads/sites/12/2016/05/chilling-out-200x200.jpg" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>The place you can look ugly and enjoy it – Home! – VogueFAQs</h4><span class="url-text"><p>When things around you start feeling more familiar than strange,</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 51, 119, 0, 0, '<span class="url-qard-block" id="url_parentblk_3"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_3"><span class="url-content"><h4>Gurgaon’s Online Food Delivery Option: A Compiled List </h4><span class="url-text"><p>Login with Facebook to see the best online foods available in Gurgaon! The best at the best rates! Hurry up guys.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 51, 120, 0, 0, '<span class="review-qard" id="url_parentblk_4"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_4"><span class="url-content"><h4>Search data by taking input from datepicker in yii2 - Stack Overflow</h4><span class="url-text"><p>In this case the sql query in the search model is - </p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 52, 121, 0, 0, '\n                                        \n                                    ', '0', NULL, 'rand_9562time_1465386985qid_52.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 53, 122, 0, 0, '\n                                        \n                                    ', '0', NULL, 'rand_7876time_1465387936qid_53.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 53, 123, 0, 0, NULL, NULL, NULL, 'rand_4414time_1465389369qid_53.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 53, 124, 0, 0, '<span class="review-qard" id="url_parentblk_3"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_3"><span class="url-content"><h4>triggering the printscreen keyboard function and sending the converted image to server in jQuery - Stack Overflow</h4><span class="url-text"><p>How can i trigger the PrtScn i.e, PrintScreen keyboard event through some jQuery function and then save that captured image to server ?</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 54, 125, 0, 0, '<div style="text-align: center;"><b style="line-height: 1.42857;"><font color="#ffffff" size="5"><br></font></b></div><div style="text-align: center;"><b style="line-height: 1.42857;"><font color="#ffffff" size="5"><br></font></b></div><div style="text-align: center;"><b style="line-height: 1.42857;"><font color="#ffffff" size="5">THE SMAPLE QARD</font></b><br></div><div style="text-align: center;"><b style="line-height: 1.42857;"><font color="#ffffff" size="5"><br></font></b></div><div style="text-align: center;"><b style="line-height: 1.42857;"><font color="#ffffff" size="5"><br></font></b></div>', '0', NULL, 'rand_8795time_1465389496qid_54.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 54, 126, 0, 0, NULL, NULL, NULL, 'rand_6569time_1465389513qid_54.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 54, 127, 0, 0, 'null', '0', NULL, 'rand_10time_1465389576qid_54.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 55, 128, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_1"><span class="url-content"><h4>triggering the printscreen keyboard function and sending the converted image to server in jQuery - Stack Overflow</h4><span class="url-text"><p>How can i trigger the PrtScn i.e, PrintScreen keyboard event through some jQuery function and then save that captured image to server ?</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 55, 129, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.grabz.it/images/logo-top.png" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>Try GrabzIt''s Free PHP Screenshot API</h4><span class="url-text"><p>Use GrabzIt''s free PHP API to easily take image and PDF screenshots of the web. Or convert HTML tables to CSV or YouTube videos to animated GIFs.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 56, 131, 0, 0, 'sdjhs jgjksd gkjsfd<br><br>sdsd<br><br>sdfsdf<br><br>dsfsdfsd<br>sd<br>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 56, 132, 0, 0, 'sdfgsjd jk<br><br>sdsdf<br>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 56, 137, 0, 0, '<span class="review-qard" id="url_parentblk_4"><span class="img-preview col-sm-3 col-md-3"><img src="http://meta.stackoverflow.com//content/Sites/stackoverflowmeta/img/apple-touch-icon@2.png?v=6de7587d1583&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_4"><span class="url-content"><h4>When and by whom was [ibm-watson] replaced by [ibm-watson-cognitive]? - Meta Stack Overflow</h4><span class="url-text"><p>I am a developer evangelist for IBM Watson Developer Cloud. There does not appear to be any information here on meta about when or why the tag ibm-watson was retagged to ibm-watson-cognitive.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 54, 138, 0, 0, 'THw<br><br>dsfgdfv<br><br>dfgdfgdg<br><br>dfgdfgdfgdf<br>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 57, 139, 0, 0, '\n                                        \n                                    ', '0', NULL, 'rand_8925time_1465391849qid_57.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 57, 140, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="http://meta.stackoverflow.com//content/Sites/stackoverflowmeta/img/apple-touch-icon@2.png?v=6de7587d1583&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>Why was my answer deleted? I think it should be undeleted - Meta Stack Overflow</h4><span class="url-text"><p>I have asked this question (about .NET). After a while, a user has requested additional info by comment. I took a look at that, read some MSDN and decided that replacing my method call with the one being part of that comment is the ultimate solutionTM of the problem made me asking my question.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 58, 141, 0, 0, '\n                                        \n                                    ', '0', NULL, 'rand_6829time_1465392068qid_58.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 58, 142, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="https://dencygb.files.wordpress.com/2014/09/money-means-different-to-different-people.jpg" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>The kinda people I Think,I know!  | My Thoughts</h4><span class="url-text"><p>I remember now, I have got a very strange habit of studying people.Many of my friends know that and I sit hours to explain their own character to themselves.So I thought of writing about the variety of characters I met/know in my life. I know this is little bit risky,yet trying expecting some people to…</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 58, 143, 0, 0, '<span class="review-qard" id="url_parentblk_3"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_3"><span class="url-content"><h4>php - Store a second value as a variable based on a dropdown menu selection - Stack Overflow</h4><span class="url-text"><p>I have two tables: event_title lists the Event_title_ID, title, and date of upcoming events, and event_reg stores data from a submitted form.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 59, 144, 0, 0, '<div style="text-align: center;"><b style="line-height: 1.42857;"><font size="5" color="#fffafa"><br></font></b></div><div style="text-align: center;"><b style="line-height: 1.42857;"><font size="5" color="#fffafa">WELCOME TO KARNATAKA</font></b><br></div>', '0', NULL, 'rand_45time_1465392361qid_59.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 59, 145, 0, 0, '<span class="url-qard-block" id="url_parentblk_2"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_2"><span class="url-content"><h4><font color="#fff7f7">Welcome to Nandi Hills</font></h4><span class="url-text"><p><font color="#f0eded">NANDI HILLS.There are many stories about the orgin of the name Nandi Hills. During the Chola period, Nandi Hills was called Ananda Giri meaning The Hill of Happiness.</font></p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 59, 146, 0, 0, '<span class="review-qard" id="url_parentblk_3"><span class="img-preview col-sm-3 col-md-3"><img src="//upload.wikimedia.org/wikipedia/en/thumb/9/99/Question_book-new.svg/50px-Question_book-new.svg.png" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_3"><span class="url-content"><h4><font color="#f5f5f5">Jog Falls - Wikipedia, the free encyclopedia</font></h4><span class="url-text"><p><font color="#fcfcfc">Jog Falls, Gerosoppa Falls or Joga Falls is the second-highest plunge waterfall in India located in Sagara taluk in the state of Karnataka.</font></p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 59, 147, 0, 0, 'BADAMI<br><span style="color: rgb(0, 0, 128); font-family: Verdana; font-size: small; line-height: normal; text-align: justify;">Nandi Hills provides modern, well-furnished accommodation for tourists. Nehru House, formerly Cubbon House, build by Lord Cubbon has 18 rooms and available for tourist. Gandhi House, where the Mahatma himself stayed, is under the management of DPAR (Protocol) Government of Karnataka and is reserved for the stay of important dignitaries.</span><br>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 60, 148, 0, 0, 'kjhsdfkhdsdsjk<br>dfssjkfhsdkfhss<br>dfhsfjxcvj;j<br>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `qard_block` (`block_id`, `qard_id`, `theme_id`, `status`, `is_title`, `text`, `extra_text`, `link_url`, `link_image`, `link_document`, `link_title`, `link_description`, `block_priority`, `block_name`, `placeholder_text`, `help_text`) VALUES
(123, 60, 149, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="//upload.wikimedia.org/wikipedia/en/thumb/6/6d/Mohammed_Rafi.jpg/238px-Mohammed_Rafi.jpg" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>Mohammed Rafi - Wikipedia, the free encyclopedia</h4><span class="url-text"><p>Mohammed Rafi (24 &nbsp; 1924 – 31 July 1980) was an Indian playback singer and one of the most popular singers of the Hindi film industry. Rafi was notable for his versatility, his songs ranged from classical numbers to patriotic songs, sad lamentations to highly romantic numbers, qawwalis to ghazals and bhajans. He was known for his ability to mould his voice to the persona of the actor lip-synching the song on screen in the movie.[1] Between 1950 and 1970, Rafi was the most sought after singer in the Hindi film industry.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 63, 152, 0, 0, 'SERGj', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 63, 153, 0, 0, 'FIRST BLOCK', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 63, 154, 0, 0, 'sdf dfvsd', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 64, 155, 0, 0, 'null', '0', NULL, 'rand_4375time_1465806157qid_64.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 65, 156, 0, 0, NULL, NULL, NULL, 'rand_5288time_1465809867qid_65.JPG', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 66, 157, 0, 0, 'sdfsd<br><br>dsfdf<br><br><br>sdff<br><br><br>sdff<br><br>sdfdf<br><br><br>fsdf<br><br><br>sdff<br><br>sdfsdf<br><br>sdfsf<br><br>sdfd<br><br><br>dsf<br>dsf<br><br>dsfdsf<br><br>dsfd<br>', '0', NULL, 'rand_9108time_1465878384qid_66.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(130, 67, 158, 0, 0, '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>', '0', NULL, 'rand_5167time_1465878631qid_67.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(131, 67, 159, 0, 0, '<div align="center"><font size="5"><b>GOD OF SMALL THINGS</b></font><br></div>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(133, 69, 163, 0, 0, NULL, NULL, NULL, 'rand_3983time_1465878914qid_69.JPG', NULL, NULL, NULL, 4, NULL, NULL, NULL),
(134, 69, 164, 0, 0, '<br><br><br><br><br><br><br><br>', '0', NULL, 'rand_5810time_1465878932qid_69.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(135, 69, 165, 0, 0, '<br><br><br><br><br><br><br>', '0', NULL, 'rand_5989time_1465878956qid_69.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(136, 69, 166, 0, 0, NULL, NULL, NULL, 'rand_7072time_1465879010qid_69.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL),
(137, 70, 167, 0, 0, NULL, NULL, NULL, 'rand_7040time_1465880921qid_70.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(138, 71, 168, 0, 0, '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><div align="center"><font size="7"><b>QARD DECK</b></font><br></div><font size="2"><b><br><br><br><br><br><br><br><br><br></b></font><br><br><br><br><br><br>', '0', NULL, 'rand_4910time_1465881148qid_71.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(139, 72, 169, 0, 0, '<font size="7">&nbsp; &nbsp; &nbsp;QARD DECK&nbsp;</font>', '0', NULL, 'rand_285time_1465884086qid_72.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(141, 73, 174, 0, 0, '<div><br></div><div><br></div><div></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><b style="line-height: 1.42857; background-color: transparent;"><font size="7">QARD DECK</font></b><br></div><div><b style="line-height: 1.42857; background-color: transparent;"><font size="7"><br></font></b></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_2886time_1465907004qid_73.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(142, 73, 175, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_3067time_1465907113qid_73.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(143, 74, 176, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_2943time_1465908542qid_74.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(144, 76, 178, 0, 0, NULL, NULL, NULL, 'rand_2916time_1465970726qid_76.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(145, 76, 179, 0, 0, NULL, NULL, NULL, 'rand_9641time_1465970740qid_76.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(146, 76, 181, 0, 0, NULL, NULL, NULL, 'rand_652time_1465970759qid_76.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL),
(147, 76, 182, 0, 0, NULL, NULL, NULL, 'rand_9450time_1465970778qid_76.JPG', NULL, NULL, NULL, 4, NULL, NULL, NULL),
(148, 77, 185, 0, 0, NULL, NULL, NULL, 'rand_4712time_1465970935qid_77.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(149, 77, 186, 0, 0, NULL, NULL, NULL, 'rand_7120time_1465970948qid_77.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(150, 77, 187, 0, 0, NULL, NULL, NULL, 'rand_3134time_1465970963qid_77.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL),
(151, 77, 188, 0, 0, 'jty<div>ryrty</div><div><br></div><div>rtyrty</div><div>rtyry</div><div><br></div><div>rtytryry</div><div>rytyryr</div>', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(152, 79, 190, 0, 0, NULL, NULL, NULL, 'rand_9782time_1465975317qid_79.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(153, 79, 191, 0, 0, NULL, NULL, NULL, 'rand_5206time_1465975328qid_79.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(154, 79, 192, 0, 0, NULL, NULL, NULL, 'rand_628time_1465975340qid_79.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL),
(155, 79, 193, 0, 0, NULL, NULL, NULL, 'rand_1543time_1465975350qid_79.JPG', NULL, NULL, NULL, 4, NULL, NULL, NULL),
(156, 80, 199, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_2421time_1465975413qid_80.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(157, 80, 200, 0, 0, 'Thanks', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(158, 81, 201, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_9860time_1465975546qid_81.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(159, 81, 204, 0, 0, 'sfsf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(160, 83, 206, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_8026time_1465975754qid_83.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(161, 83, 207, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_4239time_1465975793qid_83.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(162, 83, 208, 0, 0, NULL, NULL, NULL, 'rand_6375time_1465975817qid_83.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL),
(163, 83, 209, 0, 0, 'jgjksdgf<div>sdfsdf</div><div>sdffds</div><div>dfsfdf</div>', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(164, 84, 210, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_9128time_1465977101qid_84.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(165, 84, 211, 0, 0, 'sdfsdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(166, 88, 215, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_1"><span class="url-content"><h4>Can''t connect to local MySQL server through socket ''/var/mysql/mysql.sock'' (38) - Stack Overflow</h4><span class="url-text"><p>I am having a big problem trying to connect to mysql.&nbsp;</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(167, 88, 216, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_2"><span class="url-content"><h4>Yii2 - Include JS Script Only For Specific View - Stack Overflow</h4><span class="url-text"><p>I want to include my js script specific.js for a specific view having action id specific-action-id. I don''t want the specific.js</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(168, 88, 217, 0, 0, '<span class="review-qard" id="url_parentblk_3"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_3"><span class="url-content"><h4>javascript - How can I make a page redirect using jQuery? - Stack Overflow</h4><span class="url-text"><p>How can I redirect the user from one page to another using jQuery?</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(169, 88, 218, 0, 0, '<span class="review-qard" id="url_parentblk_4"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_4"><span class="url-content"><h4>javascript - Ajax + Controller Action in Yii2 - Stack Overflow</h4><span class="url-text"><p>I''m new to programming, and I''m trying to call a function when the user imputs data and clicks submit button. I''m using Yii2 and I''m not familiar with Ajax. I tried developing a function, but my controller action isn''t called.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(170, 88, 219, 0, 0, '<div style="text-align: center;"><b style="line-height: 1.42857; background-color: buttonface;"><font size="7">Yii + Javascript</font></b></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(171, 88, 223, 0, 0, 'Thanks to SO', '0', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL),
(172, 89, 244, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(173, 90, 245, 0, 0, 'dwed', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(174, 90, 246, 0, 0, 'sdsjdsd', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(175, 91, 247, 0, 0, 'sdwsdsdsd', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(176, 92, 248, 0, 0, 'sadasd sfs', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(177, 93, 249, 0, 0, 'asxa<div>sds</div><div><br></div><div>sdfsdf</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(178, 94, 250, 0, 0, 'sdsf', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(179, 94, 251, 0, 0, 'sdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(180, 95, 252, 0, 0, 'dsa', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(181, 95, 253, 0, 0, 'asds', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(182, 96, 254, 0, 0, 'sdfsf', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(183, 97, 255, 0, 0, 'sdhcjhs sfdjsdg<div><br></div><div>sdfsdf</div><div><br></div><div>fd</div><div>fd</div><div>ghfhgj</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(184, 98, 256, 0, 0, 'asdfsd<div>sdfsdf</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(185, 99, 257, 0, 0, 'sfsdf<div>dfgf</div><div>dfg</div><div>f</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(186, 100, 258, 0, 0, 'xsxsa<div>dfs</div><div>dfg</div><div>dfgfg</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(187, 101, 259, 0, 0, 'sdfsdf fdf', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(188, 101, 260, 0, 0, 'sdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(189, 101, 261, 0, 0, 'sdfs dsff', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(190, 101, 262, 0, 0, 'sdfsdfsf', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(191, 101, 263, 0, 0, 'sdfsfs', '0', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(192, 101, 264, 0, 0, 'sdfsdfs', '0', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL),
(193, 101, 265, 0, 0, 'sdfsf', '0', NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL),
(194, 101, 266, 0, 0, 'sdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL),
(195, 101, 267, 0, 0, 'sdfsff', '0', NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, NULL),
(196, 101, 268, 0, 0, 'sdfsdfs', '0', NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL),
(197, 101, 269, 0, 0, 'sdfsf', '0', NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL),
(198, 101, 270, 0, 0, 'sdfsfsffsf', '0', NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL),
(199, 101, 271, 0, 0, 'sdfsfs', '0', NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, NULL),
(200, 102, 272, 0, 0, 'asdasd sdas', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(201, 102, 273, 0, 0, 'sadsdfs', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(202, 102, 274, 0, 0, 'sdfsdf dfvd', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(203, 102, 275, 0, 0, 'gfshsdf<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div>fsgdfg</div><div>dfgdf</div><div>dfgdfg</div><div>dfgdfg</div><div>dfgdfg</div><div>gf</div>', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(204, 103, 276, 0, 0, 'sdf dfgfd df', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(205, 103, 277, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_2"><span class="url-content"><h4>javascript - contenteditable change events - Stack Overflow</h4><span class="url-text"><p>I want to run a function when a user edits the content of a div with contenteditable attribute. What''s the equivalent of an on change event.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(206, 103, 278, 0, 0, 'dfgdfgdfg', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(207, 104, 279, 0, 0, 'sdcs<br>sdsd<br>sd<br>sd<br>sdc<br>sdcsd<br>dssd<br>sdsdds<br>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(208, 104, 280, 0, 0, 'sdsdsd<br>sd<br>sd<br>sd<br>sd<br>sd<br>sd<br><br>sd<br>sd<br>sd<br>dsds<br>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(209, 104, 281, 0, 0, 'sdsdf<br>sdf<br>sd<br>sd<br>sd<br>sdsdf<br>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(210, 105, 282, 0, 0, 'sfvd', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(211, 106, 283, 0, 0, 'dfgvdfg', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(212, 106, 284, 0, 0, 'sdfd dvd', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(213, 107, 285, 0, 0, '1', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(214, 107, 286, 0, 0, '2', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(215, 108, 287, 0, 0, '1', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(216, 108, 288, 0, 0, '2', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(217, 108, 289, 0, 0, '3', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(218, 108, 290, 0, 0, '4', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(219, 109, 291, 0, 0, NULL, NULL, NULL, 'rand_1608time_1466153910qid_109.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(220, 110, 292, 0, 0, NULL, NULL, NULL, 'rand_1381time_1466153981qid_110.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(221, 111, 293, 0, 0, NULL, NULL, NULL, 'rand_9932time_1466154106qid_111.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(222, 112, 294, 0, 0, 'fvd<div>df</div><div>df</div><div>df</div>', '0', NULL, 'rand_9817time_1466154187qid_112.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(223, 113, 295, 0, 0, '10', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(224, 113, 296, 0, 0, '20', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(225, 113, 297, 0, 0, '30', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(226, 113, 298, 0, 0, '40', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(227, 114, 299, 0, 0, '100', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(228, 114, 300, 0, 0, '200', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(229, 114, 301, 0, 0, '300', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(230, 115, 302, 0, 0, NULL, NULL, NULL, 'rand_2197time_1466155419qid_115.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(231, 116, 303, 0, 0, 'dhgsdjs<div><br></div><div>sdsd</div><div>ds</div><div>fsd</div><div>sd</div><div>sd</div><div>sd</div><div><br></div><div>sdf</div><div>sd</div><div>sd</div><div>dsds</div><div>sdsdf</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(232, 116, 304, 0, 0, 'sdfsdfs<div><br></div><div>sd</div><div>sd</div><div>sd</div><div>sd</div><div><br></div>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(233, 117, 305, 0, 0, NULL, NULL, NULL, 'rand_8042time_1466155640qid_117.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(234, 118, 306, 0, 0, NULL, NULL, NULL, 'rand_9951time_1466155665qid_118.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(235, 121, 309, 0, 0, NULL, NULL, NULL, 'rand_6471time_1466161697qid_121.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(236, 122, 310, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_220time_1466161759qid_122.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(237, 123, 311, 0, 0, NULL, NULL, NULL, 'rand_2751time_1466161997qid_123.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(238, 124, 312, 0, 0, NULL, NULL, NULL, 'rand_1560time_1466162351qid_124.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(239, 125, 313, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><div style="line-height: 18.5714px;"><br></div></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_4160time_1466162416qid_125.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(240, 127, 315, 0, 0, 'asdsda', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(242, 129, 317, 0, 0, '<div style="text-align: center;"><br></div>', '0', NULL, 'rand_9395time_1466164312qid_129.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(243, 131, 319, 0, 0, '<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_2917time_1466165860qid_131.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(244, 131, 320, 0, 0, '<div style="text-align: center;"><b style="line-height: 1.42857; background-color: buttonface;"><font size="3">THE SUNSET</font></b></div>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(245, 132, 321, 0, 0, 'gjgfjkdf<div><br></div><div>dfg</div><div>dfg</div><div>dg</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(246, 133, 322, 0, 0, 'gjhgjsf<div>df</div><div>dfg</div><div>dffd</div><div>dfgdf</div><div>dfdf</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(247, 134, 323, 0, 0, '<div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;">fsfdfgdfg</div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"><br></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"><br></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"><br></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(248, 135, 324, 0, 0, 'sdfsdf<div>sd</div><div>sf</div><div>sf</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(249, 136, 325, 0, 0, 'fd', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(250, 137, 326, 0, 0, 'sdas', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(251, 138, 327, 0, 0, 'dfg gbf fgb<div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div>gbgffg</div><div>fg</div><div>fgb</div><div>fg</div><div>fg</div><div>fg</div><div>fg</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(252, 139, 328, 0, 0, 'jhgjs', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(253, 140, 330, 0, 0, 'sdfsdf<div><br></div><div>df</div><div>sdf</div><div><br></div><div>sdf</div><div><br></div><div>sfd</div><div>sd</div><div>f</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(254, 141, 331, 0, 0, 'fgdfhg dfhgdf<div><br></div><div>dfg</div><div>dfg</div><div>dfg</div><div>df</div><div>df</div><div>dfgdfgdffgg</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(255, 142, 332, 0, 0, 'frfd<div>dfg</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(256, 143, 333, 0, 0, 'rfgedrger', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(257, 144, 334, 0, 0, 'gfjgjdf<div>dfg</div><div>df</div><div>gd</div><div>fg</div><div>dfgdf</div><div>jhdf</div><div>dfgdf</div><div>gdfg</div><div>fd</div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(258, 144, 335, 0, 0, 'jhgdjgsd<div>sdfsdfsdfsdfsd</div><div><br></div><div>sdfsd</div><div>dsdf</div><div>s</div><div>ss</div><div>dfss</div><div><br></div><div>ssdf</div>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(259, 145, 336, 0, 0, '<div style="text-align: center;"><b style="color: rgb(245, 252, 178); font-size: large; line-height: 1.42857;"><br></b></div><div style="text-align: center;"><b style="color: rgb(245, 252, 178); font-size: large; line-height: 1.42857;"><br></b></div><div style="text-align: center;"><b style="color: rgb(245, 252, 178); line-height: 1.42857;"><font size="7">QARD DECK</font></b></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(260, 145, 337, 0, 0, '<div style="text-align: center;"><b style="font-size: -webkit-xxx-large; color: rgb(204, 85, 85); line-height: 1.42857;"><br></b></div><div style="text-align: center;"><b style="font-size: -webkit-xxx-large; color: rgb(204, 85, 85); line-height: 1.42857;">QARD DECK</b><br></div>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(261, 145, 338, 0, 0, '<div style="text-align: center;"><span style="color: rgb(71, 120, 227); font-size: -webkit-xxx-large; line-height: 1.42857;"><b><br></b></span></div><div style="text-align: center;"><span style="color: rgb(71, 120, 227); font-size: -webkit-xxx-large; line-height: 1.42857;"><b>QARDDECK</b></span></div><div style="text-align: center;"><span style="color: rgb(71, 120, 227); font-size: -webkit-xxx-large; line-height: 1.42857;"><b><br></b></span></div>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(262, 145, 346, 0, 0, '<div><br></div><div style="text-align: right;"><span style="line-height: 1.42857;"><i>Courtesy : Abacies</i></span></div>', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(263, 146, 347, 0, 0, '<span style="color: rgb(115, 177, 162);">asdfs dfdgd </span><span style="color: rgb(204, 85, 85);">sdfd dfd fgbfb vsdf cvd dfvkd dfvlddfkvdl kvd kdfg</span><span style="color: rgb(115, 177, 162);">&nbsp;djfgvjkdf dfvkddfgvk ddkfjhdkdvvdvh ddfkd dvbfjkdvhfkd dfgvdfk&nbsp;</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(264, 146, 348, 0, 0, '&nbsp;jgfs djksdsd <span style="color: rgb(204, 85, 85);">gsdfghsfd</span>', '0', NULL, 'rand_2908time_1466407337qid_146.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(265, 147, 349, 0, 0, 'sdfwerf', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(266, 147, 350, 0, 0, 'fsd', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(267, 147, 351, 0, 0, 'svdf', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(268, 148, 352, 0, 0, 'ewrfwr', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(269, 148, 353, 0, 0, 'rfwerff', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(270, 148, 354, 0, 0, 'ff<div><br></div><div><br></div><div><br></div>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(271, 149, 355, 0, 0, 'sdfsf dfgvdrfgv', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(272, 149, 356, 0, 0, 'sdfsfdsdf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(273, 150, 357, 0, 0, 'sfsdfsd', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(274, 150, 358, 0, 0, 'sdfdf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(275, 151, 359, 0, 0, 'sadasd', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(276, 151, 360, 0, 0, 'asdasd', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(277, 152, 361, 0, 0, 'sdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(278, 152, 362, 0, 0, 'sdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(279, 154, 364, 0, 0, 'yu', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(280, 154, 368, 0, 0, 'kj', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(281, 155, 369, 0, 0, 'dfsf dfvdf<div><br></div><div><br></div><div><br></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(282, 156, 370, 0, 0, 'dfgdf', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(283, 157, 372, 0, 0, '<span style="color: rgb(255, 255, 255); font-size: x-large;">Qard Deck is a place to share your ideas, thoughts, research points or anything that you love to share.</span>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(284, 157, 373, 0, 0, '<div><br></div><div><br></div><div style="text-align: center;"><br></div><div><br></div>', '0', NULL, 'rand_962time_1466422297qid_157.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(285, 157, 374, 0, 0, '<span style="font-size: large;">Qard Deck is a place to share your ideas, thoughts, research points or anything that you love to share</span>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(286, 157, 375, 0, 0, '<span style="color: rgb(255, 255, 255); font-size: large;">Qard deck is a place to share your ideas, thoughts , research points or anything that you would love to share. We are here to help you in achieving the same with out much hassle.</span>', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(287, 157, 376, 0, 0, '<div>Qard deck is a place to share your ideas, thoughts , research points or anything that you would love to share. We are here to help you in achieving the same with out much hassle.</div><div><span style="line-height: 18.5714px;"><br></span></div><div><span style="line-height: 18.5714px;">Qard deck is a place to share your ideas, thoughts , research points or anything that you would love to share. We are here to help you in achieving the same with out much hassle.</span><br></div>', '0', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(288, 158, 377, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>javascript - How to break/exit from a each() function in JQuery? - Stack Overflow</h4><span class="url-text"><p>This question already has an answer here</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(289, 159, 378, 0, 0, '<div style="text-align: center;"><span style="color: rgb(0, 0, 0); font-size: -webkit-xxx-large; font-weight: bold; line-height: 1.42857;">Q</span></div><div style="text-align: center;"><span style="color: rgb(0, 0, 0); font-size: -webkit-xxx-large; font-weight: bold;">A</span></div><div style="text-align: center;"><span style="color: rgb(0, 0, 0); font-size: -webkit-xxx-large; font-weight: bold;">R</span></div><div style="text-align: center;"><span style="color: rgb(0, 0, 0); font-size: -webkit-xxx-large; font-weight: bold;">D</span></div><div style="text-align: center;"><span style="color: rgb(0, 0, 0); font-size: -webkit-xxx-large; font-weight: bold;">D</span></div><div style="text-align: center;"><span style="color: rgb(0, 0, 0); font-size: -webkit-xxx-large; font-weight: bold;">E</span></div><div style="text-align: center;"><span style="color: rgb(0, 0, 0); font-size: -webkit-xxx-large; font-weight: bold;">C</span></div><div style="text-align: center;"><span style="color: rgb(0, 0, 0); font-size: -webkit-xxx-large; font-weight: bold;">K</span></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(290, 160, 379, 0, 0, '<span style="color: rgb(192, 192, 192);">Qfjjjjjjjjjjjjjjjjjjjjjjjjd jdfgjgdfj dfjhk kdfjhkfd df dfjkhdfk dfdfkdfk dfjkhk</span><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);">d</span></div><div><span style="color: rgb(192, 192, 192);">f</span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);"><br></span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);"><br></span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);">d</span></div><div><span style="color: rgb(192, 192, 192);">f</span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);"><br></span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);">d</span></div><div><span style="color: rgb(192, 192, 192);">f</span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);">f</span></div><div><span style="color: rgb(192, 192, 192);">f</span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);"><br></span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);"><br></span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);"><br></span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);">dgjhsddf</span></div><div><span style="color: rgb(192, 192, 192);">df</span></div><div><span style="color: rgb(192, 192, 192);">df</span></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(291, 161, 380, 0, 0, '<br>', '0', NULL, 'rand_217time_1466496717qid_161.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(292, 162, 381, 0, 0, '<span style="color: rgb(0, 64, 0);">asds</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(293, 163, 382, 0, 0, '<div style="text-align: center;"><span style="color: rgb(0, 64, 0); font-size: -webkit-xxx-large; font-weight: bold; line-height: 1.42857;"><br></span></div><div style="text-align: center;"><span style="color: rgb(0, 64, 0); font-size: -webkit-xxx-large; font-weight: bold; line-height: 1.42857;">QARDDECK</span></div><div style="text-align: center;"><span style="color: rgb(0, 64, 0); font-size: -webkit-xxx-large; font-weight: bold; line-height: 1.42857;"><br></span></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(294, 164, 383, 0, 0, 'asdasd', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(295, 165, 384, 0, 0, 'sdwedw', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(296, 166, 385, 0, 0, '<span style="color: rgb(0, 64, 0);">wedwed</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(297, 167, 386, 0, 0, 'asadasdas', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(298, 167, 388, 0, 0, 'sdfsf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(299, 168, 389, 0, 0, '<div style="text-align: center;"><span style="color: rgb(64, 128, 128); font-size: xx-large; font-weight: bold; line-height: 1.42857;"><br></span></div><div style="text-align: center;"><span style="font-size: xx-large; font-weight: bold; line-height: 1.42857; color: rgb(0, 64, 0);">adass</span></div><div style="text-align: center;"><span style="color: rgb(64, 128, 128); font-size: xx-large; font-weight: bold; line-height: 1.42857;"><br></span></div>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(300, 168, 390, 0, 0, '<div style="text-align: center;"><span style="color: rgb(0, 64, 0); font-size: -webkit-xxx-large; line-height: 1.42857;">Q</span></div><div style="text-align: center;"><span style="color: rgb(0, 64, 0); font-size: -webkit-xxx-large;">A</span></div><div style="text-align: center;"><span style="color: rgb(0, 64, 0); font-size: -webkit-xxx-large;">R</span></div><div style="text-align: center;"><span style="color: rgb(0, 64, 0); font-size: -webkit-xxx-large;">D</span></div><div style="text-align: center;"><span style="color: rgb(0, 64, 0); font-size: -webkit-xxx-large;"><br></span></div><div style="text-align: center;"><span style="color: rgb(0, 64, 0); font-size: -webkit-xxx-large;">DECK</span></div>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(301, 169, 391, 0, 0, '<div style="text-align: center;"><span style="color: rgb(192, 192, 192); font-size: -webkit-xxx-large; line-height: 1.42857;">Q</span></div><div style="text-align: center;"><span style="color: rgb(192, 192, 192); font-size: -webkit-xxx-large; line-height: 1.42857;">A</span></div><div style="text-align: center;"><span style="color: rgb(192, 192, 192); font-size: -webkit-xxx-large; line-height: 1.42857;">R</span></div><div style="text-align: center;"><span style="color: rgb(192, 192, 192); font-size: -webkit-xxx-large; line-height: 1.42857;">D</span></div><div style="text-align: center;"><span style="color: rgb(192, 192, 192); font-size: -webkit-xxx-large; line-height: 1.42857;">DECK</span></div>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(302, 169, 392, 0, 0, '<div><span style="color: rgb(0, 64, 128); font-size: -webkit-xxx-large;"><br></span></div><span style="color: rgb(0, 64, 128); font-size: -webkit-xxx-large;"><div><span style="color: rgb(0, 64, 128); font-size: -webkit-xxx-large;"><br></span></div><div style="text-align: center;"><span style="font-size: -webkit-xxx-large; line-height: 1.42857;">QARDDECK</span></div></span>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(303, 170, 393, 0, 0, 'retert', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(304, 171, 394, 0, 0, 'qweqwew', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(305, 173, 397, 0, 0, '<span style="color: rgb(0, 0, 0);">xczzx sdvdfv</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(306, 174, 398, 0, 0, NULL, NULL, NULL, 'rand_6107time_1466579955qid_174.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(307, 174, 399, 0, 0, NULL, NULL, NULL, 'rand_7574time_1466579974qid_174.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(308, 175, 400, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_1"><span class="url-content"><h4>javascript - How can I make a page redirect using jQuery? - Stack Overflow</h4><span class="url-text"><p>How can I redirect the user from one page to another using jQuery?</p></span></span></span></span>', '0', NULL, 'rand_2438time_1466585286qid_175.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(309, 176, 401, 0, 0, NULL, NULL, NULL, 'rand_4691time_1466585394qid_176.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(310, 176, 402, 0, 0, '<span class="url-qard-block" id="url_parentblk_2"><span class="col-sm-12 col-md-12" id="title_desc_urlblk_2"><span class="url-content"><h4><span style="color: rgb(192, 192, 192);">Penguin - Wikipedia, the free encyclopedia</span></h4><span class="url-text"><p><span style="color: rgb(192, 192, 192);"><b style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">Penguins</b><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">&nbsp;(</span><a href="https://en.wikipedia.org/wiki/Order_(biology)" title="Order (biology)" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">order</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">&nbsp;</span><b style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">Sphenisciformes</b><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">,&nbsp;</span><a href="https://en.wikipedia.org/wiki/Family_(biology)" title="Family (biology)" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">family</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">&nbsp;</span><b style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">Spheniscidae</b><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">) are a group of&nbsp;</span><a href="https://en.wikipedia.org/wiki/Aquatic_bird" class="mw-redirect" title="Aquatic bird" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">aquatic</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">,&nbsp;</span><a href="https://en.wikipedia.org/wiki/Flightless_bird" title="Flightless bird" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">flightless</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">&nbsp;</span><a href="https://en.wikipedia.org/wiki/Bird" title="Bird" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">birds</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">&nbsp;living almost exclusively in the&nbsp;</span><a href="https://en.wikipedia.org/wiki/Southern_Hemisphere" title="Southern Hemisphere" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">Southern Hemisphere</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">, especially in&nbsp;</span><a href="https://en.wikipedia.org/wiki/Antarctica" title="Antarctica" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">Antarctica</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">. Highly adapted for life in the water, penguins have&nbsp;</span><a href="https://en.wikipedia.org/wiki/Countershading" title="Countershading" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">countershaded</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">&nbsp;dark and white&nbsp;</span><a href="https://en.wikipedia.org/wiki/Plumage" title="Plumage" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">plumage</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">, and their wings have evolved into&nbsp;</span><a href="https://en.wikipedia.org/wiki/Flipper_(anatomy)" title="Flipper (anatomy)" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">flippers</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">. Most penguins feed on&nbsp;</span><a href="https://en.wikipedia.org/wiki/Krill" title="Krill" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">krill</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">,&nbsp;</span><a href="https://en.wikipedia.org/wiki/Fish" title="Fish" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">fish</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">,&nbsp;</span><a href="https://en.wikipedia.org/wiki/Squid" title="Squid" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">squid</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">&nbsp;and other forms of&nbsp;</span><a href="https://en.wikipedia.org/wiki/Sealife" class="mw-redirect" title="Sealife" style="font-family: sans-serif; font-size: 14px; line-height: 22.4px; background: none rgb(255, 255, 255);">sealife</a><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">&nbsp;caught while swimming underwater. They spend about half of their lives on land and half in the oceans.</span></span><br></p><p><span style="color: rgb(192, 192, 192); font-family: sans-serif; font-size: 14px; line-height: 22.4px;">Intersting facts: Explore Qarddeck!!</span></p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(311, 177, 403, 0, 0, '<span class="review-qard" id="url_parentblk_1"><span class="img-preview col-sm-3 col-md-3"><img src="http://cdn.sstatic.net/Sites/stackoverflow/img/apple-touch-icon@2.png?v=73d79a89bded&amp;a" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_1"><span class="url-content"><h4>Jquery Event : Detect changes to the html/text of a div - Stack Overflow</h4><span class="url-text"><p>I have a div which has its content changing all the time , be it ajax requests, jquery functions, blur etc etc.</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(312, 177, 404, 0, 0, '<span class="review-qard" id="url_parentblk_2"><span class="img-preview col-sm-3 col-md-3"><img src="https://projects.invisionapp.com//share/common/img/backgrounds/error-bg@1x.jpg?v=1" alt=""></span><span class="col-sm-9 col-md-9" id="title_desc_urlblk_2"><span class="url-content"><h4>dfgvdfgdf</h4><span class="url-text"><p>dfgdfgdfgfgd fgvdgv gvbdv\nsfsdsd</p></span></span></span></span>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(314, 178, 406, 0, 0, '&nbsp; &nbsp;<span style="color: rgb(255, 255, 255);"> I have a div which has its content changing all the time , be it &nbsp;</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(315, 178, 407, 0, 0, NULL, NULL, NULL, 'rand_2821time_1466586850qid_178.JPG', NULL, NULL, NULL, 4, NULL, NULL, NULL),
(316, 178, 408, 0, 0, '<div><br></div><div>dfdfgdfgdfgdf</div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div>', '0', NULL, 'rand_5452time_1466587008qid_178.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(317, 178, 409, 0, 0, '<span style="color: rgb(255, 255, 255);">I have a div which has its content changing all the time , be it ajax requests, jquery functions, blur etc etc.I have a div which has its content changing all the time , be it ajax requests, jquery functions, blur etc etc.I have a div which has its content changing all the time , be it ajax requests, jquery functions, blur etc etc.I have a div which has its content changing all the time , be it ajax requests, jquery functions, blur etc etc.I have a div which has its content changing all the time , be it ajax requests, jquery functions, blur etc etc.I have a div which has its content changing all the time , be it ajax requests, jquery functions, blur etc etc.</span>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(318, 178, 415, 0, 0, '<span style="color: rgb(255, 255, 255);">cvbd</span><div><span style="color: rgb(255, 255, 255);">sf</span></div><div><span style="color: rgb(255, 255, 255);">sf</span></div><div><span style="color: rgb(255, 255, 255);">sdf</span></div><div><span style="color: rgb(255, 255, 255);">sdf</span></div><div><span style="color: rgb(255, 255, 255);"><br></span></div><div><span style="color: rgb(255, 255, 255);">df</span></div><div><span style="color: rgb(255, 255, 255);">f</span></div>', '0', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(319, 179, 416, 0, 0, NULL, NULL, NULL, 'rand_5300time_1466587770qid_179.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(320, 180, 417, 0, 0, '<span>Add Your Description Here!g<br><img style="width:7%;height:31%;margin-left:350px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(321, 181, 418, 0, 0, '<span>Add Your Description Here!<br><img style="width:7%;height:31%;margin-left:350px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(322, 182, 419, 0, 0, 'Add Your Description Here!<br><span style="height: 24px;width: 25px;">UNIVERSITY OF BERKELY PROJECT.doc<img onclick="showFiles(&quot;UNIVERSITY" of="" berkely="" project.doc")="" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(323, 183, 420, 0, 0, 'Organize anything, together. Trello is a collaboration tool that organizes your projects into boards. In one glance, know what''s being worked on, who''s working on what, and where something is in a process.<p></p><div id="previewLink" onclick="displayLink(this);" data-url="https://trello.com/b/wdPWoJEj/version-1-0"><input type="hidden" value="https://trello.com/b/wdPWoJEj/version-1-0" id="hiddenUrl"><img src="/qarddeck/web/images/link-trans.png" alt=""></div><p></p>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(324, 184, 421, 0, 0, 'Sir Leonard "Len" Hutton (23 June 1916&nbsp;– 6 September 1990) was an English cricketer who played as an opening batsman for Yorkshire from 1934 to 1955 and for England in 79 Test matches between 1937 and 1955. Wisden Cricketers'' Almanack described him as one of the greatest batsmen in the history of cricket. He set a record in 1938 for the highest individual innings in a Test match in only his sixth Test appearance, scoring 364 runs against Australia, a milestone that stood for nearly 20 years (and remains an England Test record). In 1952, he became the first professional cricketer of the 20th Century to captain England in Tests; under his captaincy England won the Ashes the following year for the first time in 19 years. Following the Second World War, he was the mainstay of England''s batting, and the team depended greatly on his success.<p></p><div id="previewLink" onclick="displayLink(this);" data-url="https://en.wikipedia.org/wiki/Len_Hutton"><input type="hidden" value="https://en.wikipedia.org/wiki/Len_Hutton" id="hiddenUrl"><img src="/qarddeck/web/images/link-trans.png" alt=""></div><p></p>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(325, 185, 422, 0, 0, '<span style="font-weight: bold; font-size: medium; color: rgb(0, 64, 128);">Few minutes back, I CV''d a question having both c and arrays tags.</span><p></p><div id="previewLink" onclick="displayLink(this);" data-url="http://meta.stackoverflow.com/questions/326611/which-dupe-tag-shall-appear-in-mj%C3%B6lnir-close-vote-when-i-have-multiple-mj%C3%B6lnirs?cb=1"><input type="hidden" value="http://meta.stackoverflow.com/questions/326611/which-dupe-tag-shall-appear-in-mj%C3%B6lnir-close-vote-when-i-have-multiple-mj%C3%B6lnirs?cb=1" id="hiddenUrl">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="/qarddeck/web/images/link-trans.png" alt=""></div><p></p>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL);
INSERT INTO `qard_block` (`block_id`, `qard_id`, `theme_id`, `status`, `is_title`, `text`, `extra_text`, `link_url`, `link_image`, `link_document`, `link_title`, `link_description`, `block_priority`, `block_name`, `placeholder_text`, `help_text`) VALUES
(326, 185, 423, 0, 0, '<div><span style="color: rgb(192, 192, 192);"><br></span></div><span style="color: rgb(192, 192, 192);"><div style="text-align: center;"><span style="color: rgb(192, 192, 192); font-size: large;">Sir Leonard</span></div>Sir Leonard "Len" Hutton (23 June 1916&nbsp;– 6 September 1990) was an English cricketer who played as an opening batsman for Yorkshire from 1934 to 1955 and for England in 79 Test matches between 1937 and 1955.</span><p></p><div id="previewLink" onclick="displayLink(this);" data-url="https://en.wikipedia.org/wiki/Len_Hutton"><input type="hidden" value="https://en.wikipedia.org/wiki/Len_Hutton" id="hiddenUrl">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img src="/qarddeck/web/images/link-trans.png" alt=""></div><p></p>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(327, 185, 424, 0, 0, NULL, NULL, NULL, 'rand_8297time_1466658741qid_185.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL),
(328, 185, 425, 0, 0, '<span style="color: rgb(0, 64, 128);"><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">He set a record in 1938 for the highest individual innings in a Test match in only his sixth Test appearance, scoring 364 runs&nbsp;</span><span style="font-family: sans-serif; font-size: 14px; line-height: 22.4px;">against Australia, a milestone that stood for nearly 20 years (and remains an England Test record). In 1952, he became the first professional cricketer of the 20th Century to captain England in Tests;&nbsp;</span></span>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(329, 186, 426, 0, 0, '<div id="qardContent">Yorkshire County Cricket Club - Wikipedia, the free encyclopedia...<p></p><div id="previewLink" onclick="displayLink(this);" data-url="https://en.wikipedia.org/wiki/Yorkshire_County_Cricket_Club"><input type="hidden" value="https://en.wikipedia.org/wiki/Yorkshire_County_Cricket_Club" id="hiddenUrl"><i class="fa fa-link"></i></div><p></p></div>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(330, 186, 427, 0, 0, '<div id="qardContent">Which dupe tag shall appear in Mjölnir close vote when I have multiple Mjölnirs? - Meta Stack Overflow...<p></p><div id="previewLink" onclick="displayLink(this);" data-url="http://meta.stackoverflow.com/questions/326611/which-dupe-tag-shall-appear-in-mj%C3%B6lnir-close-vote-when-i-have-multiple-mj%C3%B6lnirs?cb=1"><input type="hidden" value="http://meta.stackoverflow.com/questions/326611/which-dupe-tag-shall-appear-in-mj%C3%B6lnir-close-vote-when-i-have-multiple-mj%C3%B6lnirs?cb=1" id="hiddenUrl"><i class="fa fa-link"></i></div><p></p></div>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(331, 186, 428, 0, 0, '<div id="qardContent">Unable to understand question because of poor English - Meta Stack Overflow...<p></p><div id="previewLink" onclick="displayLink(this);" data-url="http://meta.stackoverflow.com/questions/326675/unable-to-understand-question-because-of-poor-english?cb=1"><input type="hidden" value="http://meta.stackoverflow.com/questions/326675/unable-to-understand-question-because-of-poor-english?cb=1" id="hiddenUrl"><i class="fa fa-link"></i></div><p></p></div>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(332, 186, 429, 0, 0, '<div id="qardContent">What''s the mods'' policy on incorrect edit reviews? - Meta Stack Overflow...<p></p><div id="previewLink" onclick="displayLink(this);" data-url="http://meta.stackoverflow.com/questions/326666/whats-the-mods-policy-on-incorrect-edit-reviews?cb=1"><input type="hidden" value="http://meta.stackoverflow.com/questions/326666/whats-the-mods-policy-on-incorrect-edit-reviews?cb=1" id="hiddenUrl"><i class="fa fa-link"></i></div><p></p></div>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(333, 186, 430, 0, 0, '<div id="qardContent">Inlining external code - copyright? - Meta Stack Overflow...</div><div id="qardContent"><br><p></p><div id="previewLink" onclick="displayLink(this);" data-url="http://meta.stackoverflow.com/questions/326673/inlining-external-code-copyright?cb=1"><input type="hidden" value="http://meta.stackoverflow.com/questions/326673/inlining-external-code-copyright?cb=1" id="hiddenUrl"><i class="fa fa-link"></i></div><p></p></div>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(334, 187, 431, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;UNIVERSITY" of="" berkely="" project.doc")="" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(336, 188, 433, 0, 0, 'Add Your Description Here!<br><span style="height: 24px;width: 25px;">UNIVERSITY OF BERKELY PROJECT.doc<img onclick="showFilePrev(&quot;UNIVERSITY" of="" berkely="" project.doc")="" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(337, 188, 434, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;daisy_ticket.pdf&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(338, 188, 435, 0, 0, NULL, NULL, NULL, 'rand_9863time_1466667144qid_188.JPG', NULL, NULL, NULL, 4, NULL, NULL, NULL),
(339, 189, 436, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;daisy_ticket.pdf&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(340, 189, 437, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;UNIVERSITY" of="" berkely="" project.doc")="" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(341, 189, 438, 0, 0, 'Add Your Description Here!<br><span style="height: 24px;width: 25px;">UNIVERSITY OF BERKELY PROJECT.doc<img onclick="showFilePrev(&quot;UNIVERSITY" of="" berkely="" project.doc")="" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(342, 189, 439, 0, 0, '<div id="qardContent">How can I view/open a word document in my browser using with PHP or HTML - Stack Overflow...<p></p><div id="previewLink" onclick="displayLink(this);" data-url="http://stackoverflow.com/questions/4346117/how-can-i-view-open-a-word-document-in-my-browser-using-with-php-or-html"><input type="hidden" value="http://stackoverflow.com/questions/4346117/how-can-i-view-open-a-word-document-in-my-browser-using-with-php-or-html" id="hiddenUrl"><img src="/qarddeck/web/images/link-trans.png" alt=""></div><p></p></div>', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(343, 190, 440, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;Requirement_explained.docx&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(344, 191, 441, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;UNIVERSITY_OF_BERKELY_PROJECT.doc&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(345, 192, 442, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;Requirement_explained.docx&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(346, 192, 443, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;daisy_ticket.pdf&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(347, 205, 444, 0, 0, '<span style="color: rgb(192, 192, 192);">fgdgd</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(348, 204, 445, 0, 0, 'dfgdfgdf dfgdfg', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(349, 194, 446, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;bitcoin.pdf&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(350, 195, 447, 0, 0, '<span style="color: rgb(192, 192, 192);">fgdgd &nbsp;fgbfg fgn f</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(351, 195, 448, 0, 0, 'fgbhfgbf fgbfgb', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(352, 196, 449, 0, 0, '<span style="color: rgb(192, 192, 192);">fgdgd fgb fg</span>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(353, 196, 450, 0, 0, 'cvbfgvbfg fgbfg', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(354, 196, 451, 0, 0, 'cvbfg', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(355, 197, 452, 0, 0, '<span style="color: rgb(0, 64, 128);">vbnvnbvn</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(356, 197, 453, 0, 0, 'xcvdfvdf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(357, 198, 454, 0, 0, '<span style="color: rgb(192, 192, 192);">fgdgd gfgfg</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(358, 199, 455, 0, 0, '<span style="color: rgb(192, 192, 192);">fgdgd fgfff</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(359, 200, 456, 0, 0, '<span style="color: rgb(192, 192, 192);">fgdgd dfdfgv</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(360, 200, 457, 0, 0, 'dfgdfgdf fghbfgbh', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(361, 201, 458, 0, 0, '<span style="color: rgb(192, 192, 192);">fgdgd</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(362, 201, 459, 0, 0, 'fdgdgdg', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(363, 202, 460, 0, 0, '<span style="color: rgb(192, 192, 192);">fgdgd</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(364, 203, 461, 0, 0, '<span style="color: rgb(0, 64, 128);">dfgdfgdfg</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(365, 203, 462, 0, 0, 'dfgdgdgf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(366, 204, 463, 0, 0, 'dfgfgvd fgbfgbfgb', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(367, 204, 464, 0, 0, 'sdfrfdgdfgdf', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(368, 204, 465, 0, 0, NULL, NULL, NULL, 'rand_3188time_1466748422qid_204.JPG', NULL, NULL, NULL, 5, NULL, NULL, NULL),
(369, 204, 466, 0, 0, 'dfgdfgdfgdf', '0', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL),
(370, 204, 467, 0, 0, 'sdsdfverf', '0', NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL),
(371, 194, 468, 0, 0, '<span style="color: rgb(13, 183, 187);">dfdgdgd fgbfg fgbfg</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(372, 194, 469, 0, 0, '<span style="color: rgb(13, 183, 187);">fghfhfghgh</span>', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(373, 194, 470, 0, 0, '<span style="color: rgb(0, 64, 0);">ghfghjhf</span><div><span style="color: rgb(0, 64, 0);"><br></span></div><div><span style="color: rgb(0, 64, 0);"><br></span></div><div><span style="color: rgb(0, 64, 0);">gbhvjh</span></div><div><span style="color: rgb(0, 64, 0);">vnvmjv</span></div><div><span style="color: rgb(0, 64, 0);">\\fgdgd</span></div><div><span style="color: rgb(0, 64, 0);">fdgdfgdfg</span></div>', '0', NULL, 'rand_1945time_1466749207qid_194.JPG', NULL, NULL, NULL, 5, NULL, NULL, NULL),
(374, 194, 471, 0, 0, '<span><span style="color: rgb(192, 192, 192);">Add Your Description Here!ghdysguj</span><br><img onclick="showFilePrev(&quot;bitcoin.pdf&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span><div><span><br></span></div>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(375, 194, 472, 0, 0, '<div id="qardContent">Our designs!!!<br><p></p><div id="previewLink" contenteditable="false" onclick="displayLink(this);" data-url="https://projects.invisionapp.com/share/V47KCP7PS#/screens/165834240"><input type="hidden" value="https://projects.invisionapp.com/share/V47KCP7PS#/screens/165834240" id="hiddenUrl"><img src="/qarddeck/web/images/link-trans.png" alt=""></div><p></p></div>', '0', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL),
(378, 206, 475, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;UNIVERSITY_OF_BERKELY_PROJECT.doc&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(379, 206, 476, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;bitcoin.pdf&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(380, 206, 477, 0, 0, 'gfhfghgfh<br>fg<br><br>fg<br><br>fg<br>fg<br>fg<br>fgh<br>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(381, 206, 478, 0, 0, NULL, NULL, NULL, 'rand_9949time_1466752580qid_206.JPG', NULL, NULL, NULL, 4, NULL, NULL, NULL),
(382, 206, 479, 0, 0, 'fghfgh<br>gh<br><br>gf<br>h<br>ghh<br>', '0', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(383, 207, 480, 0, 0, '<span><span style="color: rgb(192, 192, 192);">Add Your Description Here!</span><br><img onclick="showFilePrev(&quot;UNIVERSITY_OF_BERKELY_PROJECT.doc&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(384, 207, 481, 0, 0, '<span style="color: rgb(192, 192, 192);">fvdfdg</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(385, 207, 482, 0, 0, NULL, NULL, NULL, 'rand_8994time_1466752709qid_207.JPG', NULL, NULL, NULL, 4, NULL, NULL, NULL),
(386, 207, 483, 0, 0, '<span style="color: rgb(13, 183, 187);">fsdf<br>df<br><br>df<br>gdf<br><br>dfg<br>df<br>g<br>dfg<br>df<br>g<br>dfg<br>df<br>fd<br>dfg<br>dfg<br>dfgdfg</span><br>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(387, 208, 484, 0, 0, '<span style="color: rgb(192, 192, 192);">fgdfgdfgdfg</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(388, 209, 485, 0, 0, '<span style="color: rgb(0, 0, 0);">fger</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(389, 194, 486, 0, 0, '<div id="qardContent"><div class="embed_title"><span style="color: rgb(0, 64, 128); font-size: small; font-weight: bold;">Rolodex of Hate from Bianca Del Rio on Vimeo</span></div><div class="embed_content"><p><br></p></div><div class="embed_content"><input type="hidden" id="embedHide" value="https://player.vimeo.com/video/144927592?title=0&amp;byline=0&amp;portrait=0&amp;badge=0"><p>https://vimeo.com/144927592</p><div onclick="embedCode(this)" contenteditable="false"><i class="fa fa-youtube-play fa-2x"></i></div></div></div>', '0', NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL),
(390, 210, 487, 0, 0, '<div id="qardContent"><div class="embed_title"><span style="color: rgb(13, 183, 187);">Mohenjo Daro | Official Trailer | Hrithik Roshan &amp; Pooja Hegde | In Cinemas Aug 12 - YouTube</span></div><div class="embed_content"><input type="hidden" id="embedHide" value="https://www.youtube.com/embed/UPZ5FKEB02I"><p style="color: rgb(13, 183, 187);">https://youtu.be/UPZ5FKEB02I</p><div onclick="embedCode(this)" contenteditable="false"><i class="fa fa-youtube-play fa-2x"></i></div></div></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(391, 210, 488, 0, 0, '<div id="qardContent"><span style="color: rgb(255, 255, 255);">Our design for Qarddeck!!</span><p></p><div id="previewLink" contenteditable="false" onclick="displayLink(this);" data-url="https://projects.invisionapp.com/share/V47KCP7PS#/screens/165834240"><input type="hidden" value="https://projects.invisionapp.com/share/V47KCP7PS#/screens/165834240" id="hiddenUrl"><img src="/qarddeck/web/images/link-trans.png" alt=""></div><p></p></div>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(392, 210, 489, 0, 0, '<div id="qardContent"><div class="embed_title"><span style="color: rgb(13, 183, 187); font-family: Roboto;">Rolodex of Hate from Bianca Del Rio on Vimeo</span></div><div class="embed_content"><input type="hidden" id="embedHide" value="https://player.vimeo.com/video/144927592?title=0&amp;byline=0&amp;portrait=0&amp;badge=0"><p style="color: rgb(13, 183, 187); font-family: Roboto;">https://vimeo.com/144927592?title=0&amp;byline=0&amp;portrait=0&amp;badge=0</p><div onclick="embedCode(this)" contenteditable="false"><i class="fa fa-youtube-play fa-2x"></i></div></div></div>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(393, 210, 490, 0, 0, '<span><span style="color: rgb(13, 183, 187);">Add Your Description Here!</span><br><img onclick="showFilePrev(&quot;bitcoin.pdf&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(394, 210, 491, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;bitcoin.pdf&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, 'rand_9425time_1466773596qid_210.JPG', NULL, NULL, NULL, 4, NULL, NULL, NULL),
(395, 210, 492, 0, 0, '<div style="text-align: center;"><span style="color: rgb(255, 255, 255); font-size: x-large; font-weight: bold; line-height: 1.42857;">dfgdgg</span></div><div style="text-align: center;"><span style="color: rgb(255, 255, 255); font-size: x-large; font-weight: bold; line-height: 1.42857;"><br></span></div><div style="text-align: center;"><span style="color: rgb(255, 255, 255); font-size: x-large; font-weight: bold; line-height: 1.42857;">This is &nbsp;a qarddeck JOB!!</span></div><div style="text-align: center;"><span style="color: rgb(255, 255, 255); font-size: x-large; font-weight: bold; line-height: 1.42857;"><br></span></div>', '0', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL),
(396, 211, 493, 0, 0, 'fdfgdf', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(397, 212, 494, 0, 0, '<span style="color: rgb(0, 64, 128);">serwer</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(398, 213, 495, 0, 0, '<span style="color: rgb(0, 64, 128);">erterer dgvdfgvdrf dfgdrfre</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(399, 214, 496, 0, 0, '<span style="color: rgb(0, 64, 128);">asdcsd</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(400, 215, 497, 0, 0, '<span style="color: rgb(0, 64, 128);">dsdds</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(401, 216, 498, 0, 0, '<span style="color: rgb(0, 64, 128);">sdcsdc</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(402, 217, 499, 0, 0, '<span style="color: rgb(0, 64, 0);">cvfcv</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(403, 218, 500, 0, 0, '<span style="color: rgb(0, 64, 0);">dsfsfd</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(404, 219, 501, 0, 0, '<span style="color: rgb(0, 64, 0);">dcvd</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(405, 220, 502, 0, 0, '<span style="color: rgb(0, 64, 0);">xcsdc</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(406, 221, 503, 0, 0, '<span>Add Your Description Here!<br><img onclick="showFilePrev(&quot;UNIVERSITY_OF_BERKELY_PROJECT.doc&quot;)" style="height: 24px;width: 25px;" src="/qarddeck/web/images/docfile.png"></span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(407, 222, 504, 0, 0, '<span style="color: rgb(0, 64, 128);">sdfsf</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(408, 223, 505, 0, 0, '<span style="color: rgb(0, 64, 128);">sdcfsdf</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(409, 224, 506, 0, 0, 'dsfsdf', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(410, 225, 507, 0, 0, '<span style="color: rgb(0, 64, 128);">wsdfsdf</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(411, 225, 508, 0, 0, 'sdfsdfsf<div>s</div><div>dsdsdss</div><div>ssd</div><div>s</div><div><br></div><div><br></div><div><br></div><div>ss</div><div>fsd</div><div><br></div><div>sf</div><div>fsd</div><div>sd</div><div>s</div><div><br></div><div>s</div><div>sd</div><div>sd</div><div><br></div><div>s</div><div>s</div><div><br></div><div><br></div><div>sd</div><div>s</div><div><br></div><div>s</div><div>s</div><div>ssdfsdfs</div><div>sfsfs</div>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(412, 226, 509, 0, 0, '<span style="color: rgb(0, 64, 0);">asds</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(413, 226, 510, 0, 0, 'dsdfs<div>s</div><div>d</div><div>s</div><div>df</div><div>s</div><div><br></div><div>s</div><div>s</div><div>sd</div>', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(414, 226, 511, 0, 0, 'sdfsdfsf<div>sf</div><div>sf</div><div>f</div>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(415, 227, 512, 0, 0, '<span style="color: rgb(0, 64, 0);">zdczxc</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(416, 228, 513, 0, 0, '<span style="color: rgb(0, 64, 0);">sdasss</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(417, 228, 514, 0, 0, 'sdfsdfsf', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(418, 228, 515, 0, 0, 'sdfsfsf', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(419, 228, 516, 0, 0, 'sdfsdfsf', '0', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL),
(420, 228, 517, 0, 0, 'ssdfsfsfsf', '0', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(421, 228, 518, 0, 0, 'sdfsdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL),
(422, 228, 519, 0, 0, 'sdfsdfsf', '0', NULL, NULL, NULL, NULL, NULL, 7, NULL, NULL, NULL),
(423, 228, 520, 0, 0, 'sdsfsdf', '0', NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL),
(424, 228, 521, 0, 0, 'sdfsfsfsff', '0', NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, NULL),
(425, 228, 522, 0, 0, 'sdffdsdff', '0', NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL),
(426, 228, 523, 0, 0, 'sdfdfdsdf', '0', NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL),
(427, 228, 524, 0, 0, 'sdfsdfsdfsf', '0', NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL),
(428, 228, 525, 0, 0, 'sdfdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 13, NULL, NULL, NULL),
(429, 228, 526, 0, 0, 'sdsdfsdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL),
(430, 228, 529, 0, 0, 'sdffdfsdfsdsdfsfd', '0', NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, NULL),
(431, 228, 536, 0, 0, 'dfsdfsfsdfsdf', '0', NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, NULL),
(432, 229, 537, 0, 0, '<span style="color: rgb(0, 64, 128);">sdfsfsf</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(433, 230, 538, 0, 0, 'Add your content here', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(434, 231, 539, 0, 0, 'Add your content here', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(435, 232, 540, 0, 0, NULL, NULL, NULL, 'rand_7370time_1467693714qid_232.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(436, 233, 541, 0, 0, NULL, NULL, NULL, 'rand_4765time_1467693738qid_233.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(437, 233, 542, 0, 0, NULL, NULL, NULL, 'rand_9347time_1467693816qid_233.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(438, 234, 543, 0, 0, '<span style="color: rgb(0, 64, 128);">dfgdfgdfgdfgdfgdfgdf</span><div><span style="color: rgb(0, 64, 128);"><br></span></div><div><span style="color: rgb(0, 64, 128);">dfg</span></div><div><span style="color: rgb(0, 64, 128);">d</span></div><div><span style="color: rgb(0, 64, 128);">fg</span></div>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(439, 235, 544, 0, 0, '<span style="color: rgb(0, 64, 128);">sdcsdfcsdfs</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(440, 235, 545, 0, 0, 'sdfsdfsd', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(441, 235, 546, 0, 0, 'sdfsdfs', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(442, 236, 547, 0, 0, NULL, NULL, NULL, 'rand_4221time_1467694441qid_236.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(443, 237, 548, 0, 0, NULL, NULL, NULL, 'rand_4627time_1467694657qid_237.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(444, 238, 549, 0, 0, NULL, NULL, NULL, 'rand_1393time_1467694699qid_238.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(445, 239, 550, 0, 0, NULL, NULL, NULL, 'rand_457time_1467694773qid_239.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(446, 240, 551, 0, 0, NULL, NULL, NULL, 'rand_8542time_1467694807qid_240.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(447, 241, 552, 0, 0, NULL, NULL, NULL, 'rand_7889time_1467694869qid_241.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(448, 242, 553, 0, 0, '<span style="color: rgb(0, 64, 128);">sdfsdf</span>', '0', NULL, 'rand_1270time_1467695385qid_242.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(449, 243, 554, 0, 0, '<span style="color: rgb(0, 64, 128);">jk,jjl</span>', '0', NULL, 'rand_6180time_1467695429qid_243.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(450, 244, 555, 0, 0, '<span style="color: rgb(0, 64, 128);">fgffhfhfghfgh</span>', '0', NULL, 'rand_3157time_1467696700qid_244.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(451, 245, 556, 0, 0, NULL, NULL, NULL, 'rand_2342time_1467696760qid_245.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(452, 246, 557, 0, 0, NULL, NULL, NULL, 'rand_7871time_1467696898qid_246.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(453, 248, 558, 0, 0, '<span style="color: rgb(192, 192, 192);">tytytyututyutyutyutyuytu</span>', '0', NULL, 'rand_2257time_1467697036qid_248.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(454, 249, 559, 0, 0, 'yhtyhyhtyhth', '0', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL),
(455, 249, 560, 0, 0, 'gfhfhfg<div>fg</div><div>h</div><div>fgh</div><div>f</div><div>gh</div><div>h</div><div>gf</div><div><br></div><div>gh</div><div>fg</div><div>h</div><div>g</div><div>hfg</div><div>hgh</div><div>fg</div><div>hfghgf</div><div>h</div><div>h</div><div>f</div><div>h</div><div>fghfgh</div>', '0', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(456, 249, 561, 0, 0, '<div><br></div><div>ghg</div><div>gh</div><div>gh</div><div>g</div><div>h</div>', '0', NULL, 'rand_1418time_1467697080qid_249.JPG', NULL, NULL, NULL, 4, NULL, NULL, NULL),
(457, 250, 562, 0, 0, NULL, NULL, NULL, 'rand_2398time_1467697198qid_250.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(458, 251, 563, 0, 0, NULL, NULL, NULL, 'rand_6739time_1467697375qid_251.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(459, 253, 565, 0, 0, '<span style="color: rgb(0, 0, 0);">ftgghfghfg</span>', '0', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(460, 254, 566, 0, 0, NULL, NULL, NULL, 'rand_8970time_1467703207qid_254.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(461, 256, 568, 0, 0, 'sdfsdfsddfgg', '0', NULL, 'rand_5412time_1467711852qid_256.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(462, 257, 569, 0, 0, NULL, NULL, NULL, 'rand_9031time_1467712279qid_257.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(463, 259, 571, 0, 0, NULL, NULL, NULL, 'rand_9081time_1467712970qid_259.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(464, 260, 572, 0, 0, NULL, NULL, NULL, 'rand_2605time_1467713018qid_260.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(465, 261, 573, 0, 0, NULL, NULL, NULL, 'rand_3475time_1467713080qid_261.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(466, 262, 574, 0, 0, NULL, NULL, NULL, 'rand_3067time_1467713300qid_262.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(467, 263, 575, 0, 0, NULL, NULL, NULL, 'rand_2616time_1467713515qid_263.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(468, 264, 576, 0, 0, NULL, NULL, NULL, 'rand_4930time_1467713596qid_264.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(469, 265, 577, 0, 0, NULL, NULL, NULL, 'rand_8526time_1467713628qid_265.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(470, 266, 578, 0, 0, NULL, NULL, NULL, 'rand_248time_1467714345qid_266.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(471, 267, 579, 0, 0, NULL, NULL, NULL, 'rand_2447time_1467714441qid_267.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(472, 268, 580, 0, 0, NULL, NULL, NULL, 'rand_6764time_1467714562qid_268.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(473, 269, 581, 0, 0, NULL, NULL, NULL, 'rand_8572time_1467714715qid_269.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(474, 270, 582, 0, 0, NULL, NULL, NULL, 'rand_6833time_1467714752qid_270.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(475, 271, 583, 0, 0, NULL, NULL, NULL, 'rand_1917time_1467714767qid_271.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(476, 274, 584, 0, 0, NULL, NULL, NULL, 'rand_7017time_1467714903qid_274.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(477, 274, 585, 0, 0, 'srfgvgvdgvdfgdgdgdg', '0', NULL, 'rand_4458time_1467714903qid_274.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(478, 274, 586, 0, 0, '<div id="qardContent">CSS3 background-size property...dgd<p></p><div id="previewLink" contenteditable="false" onclick="displayLink(this);" data-url="http://www.w3schools.com/cssref/css3_pr_background-size.asp"><input type="hidden" value="http://www.w3schools.com/cssref/css3_pr_background-size.asp" id="hiddenUrl"><img src="/qarddeck/web/images/link-trans.png" alt=""></div><p></p></div>', '0', NULL, 'rand_7190time_1467714903qid_274.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL),
(479, 278, 588, 0, 0, NULL, NULL, NULL, 'rand_9753time_1467715168qid_276.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(480, 278, 589, 0, 0, NULL, NULL, NULL, 'rand_7012time_1467715168qid_277.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(481, 278, 590, 0, 0, 'xcdfxdxv', '0', NULL, 'rand_2552time_1467715169qid_278.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL),
(482, 279, 591, 0, 0, NULL, NULL, NULL, 'rand_3225time_1467715506qid_279.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(483, 280, 592, 0, 0, NULL, NULL, NULL, 'rand_8383time_1467715578qid_280.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(484, 281, 593, 0, 0, NULL, NULL, NULL, 'rand_6883time_1467715759qid_281.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(485, 282, 594, 0, 0, NULL, NULL, NULL, 'rand_825time_1467715771qid_282.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(486, 284, 595, 0, 0, NULL, NULL, NULL, 'rand_4135time_1467715849qid_284.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(487, 284, 596, 0, 0, 'sdfsfdsdf', '0', NULL, 'rand_7063time_1467715850qid_284.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(488, 284, 597, 0, 0, 'dsfdfdsfsdfsdf', '0', NULL, 'rand_3510time_1467715850qid_284.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL),
(489, 287, 598, 0, 0, NULL, NULL, NULL, 'rand_1205time_1467717937qid_287.JPG', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(490, 287, 599, 0, 0, NULL, NULL, NULL, 'rand_1600time_1467717937qid_287.JPG', NULL, NULL, NULL, 2, NULL, NULL, NULL),
(491, 287, 600, 0, 0, NULL, NULL, NULL, 'rand_3829time_1467717938qid_287.JPG', NULL, NULL, NULL, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qard_comments`
--

CREATE TABLE `qard_comments` (
  `qard_comment_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `qard_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 =inactive,1=active,2=deleted,3=flagged',
  `priority` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `qard_comments`
--

INSERT INTO `qard_comments` (`qard_comment_id`, `parent_id`, `qard_id`, `user_id`, `text`, `status`, `priority`, `created_at`) VALUES
(1, 0, 210, 31, 'sdsf', 0, 0, '2016-06-29 09:27:07'),
(2, 0, 210, 31, 'dfvdf', 0, 0, '2016-06-29 09:35:21'),
(3, 0, 210, 31, 'sdfsfsd', 0, 0, '2016-06-29 09:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `qard_deck`
--

CREATE TABLE `qard_deck` (
  `qd_id` int(11) NOT NULL,
  `qard_id` int(11) NOT NULL,
  `deck_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `qard_deck`
--

INSERT INTO `qard_deck` (`qd_id`, `qard_id`, `deck_id`) VALUES
(1, 223, 6),
(2, 194, 5),
(3, 216, 5),
(4, 228, 19),
(5, 227, 14),
(6, 231, 19),
(7, 250, 19);

-- --------------------------------------------------------

--
-- Table structure for table `qard_permissions`
--

CREATE TABLE `qard_permissions` (
  `qp_id` int(11) NOT NULL,
  `qard_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `permission_status` tinyint(4) NOT NULL COMMENT '0=inactice,1=active,2=deleted',
  `permission_type` tinyint(4) NOT NULL COMMENT '0=view,1=edit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qard_tags`
--

CREATE TABLE `qard_tags` (
  `qt_id` int(11) NOT NULL,
  `qard_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `qard_tags`
--

INSERT INTO `qard_tags` (`qt_id`, `qard_id`, `tag_id`) VALUES
(35, 194, 1),
(78, 207, 1),
(79, 207, 2),
(80, 212, 1),
(81, 212, 2),
(99, 210, 2),
(101, 225, 6),
(149, 228, 6),
(151, 250, 1),
(152, 251, 6),
(155, 274, 6),
(158, 278, 6),
(161, 287, 6);

-- --------------------------------------------------------

--
-- Table structure for table `qard_user_activity`
--

CREATE TABLE `qard_user_activity` (
  `activity_id` int(11) NOT NULL,
  `activity_type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `qard_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `qard_user_activity`
--

INSERT INTO `qard_user_activity` (`activity_id`, `activity_type`, `qard_id`, `user_id`, `created_at`) VALUES
(2, 'comment', 145, 31, '2016-06-20 09:10:01'),
(4, 'share', 145, 31, '2016-06-20 09:10:09'),
(5, 'share', 145, 31, '2016-06-20 09:10:10'),
(9, 'like', 207, 31, '2016-06-28 09:45:59'),
(10, 'like', 211, 31, '2016-06-28 09:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`, `description`) VALUES
(1, 'Fashion&Beauty', 'Things related to fasghion and beauty'),
(2, 'Automobile', NULL),
(3, 'Food', ''),
(4, 'Technology', ''),
(5, 'Cars', ''),
(6, 'Psychology', ''),
(7, 'random', '');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=inactive.1=active,2=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `tu_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `theme_id` int(11) NOT NULL,
  `theme_type` int(11) NOT NULL COMMENT '0=block,1=qard',
  `theme_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `theme_properties` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`theme_id`, `theme_type`, `theme_name`, `theme_properties`) VALUES
(1, 1, 'QardDeck', 'a:19:{s:13:"theme_color_1";s:7:"#004000";s:13:"theme_color_2";s:7:"#808040";s:13:"theme_color_3";s:7:"#400040";s:13:"theme_color_4";s:7:"#008080";s:13:"theme_color_5";s:7:"#8080c0";s:7:"is_bold";s:2:"on";s:10:"is_italics";s:0:"";s:12:"is_underline";s:0:"";s:10:"text_align";s:6:"center";s:10:"text_color";s:7:"#0080c0";s:10:"font_style";s:0:"";s:16:"light_text_color";s:7:"#c0c0c0";s:15:"dark_text_color";s:7:"#004080";s:16:"light_link_color";s:7:"#c0c0c0";s:15:"dark_link_color";s:7:"#004080";s:15:"overlay_opacity";s:0:"";s:13:"overlay_color";s:7:"#d4d4d4";s:22:"block_background_color";s:7:"#e9e9e9";s:23:"element_highlight_color";s:7:"#ff0080";}'),
(2, 0, 'Custom1', 'a:19:{s:13:"theme_color_1";s:7:"#ff8000";s:13:"theme_color_2";s:7:"#8000ff";s:13:"theme_color_3";s:7:"#80ff00";s:13:"theme_color_4";s:7:"#c0c0c0";s:13:"theme_color_5";s:7:"#0000ff";s:7:"is_bold";s:2:"on";s:10:"is_italics";s:2:"on";s:12:"is_underline";s:2:"on";s:10:"text_align";s:0:"";s:10:"text_color";s:7:"#8000ff";s:10:"font_style";s:5:"Ariel";s:16:"light_text_color";s:7:"#0000ff";s:15:"dark_text_color";s:7:"#c0c0c0";s:16:"light_link_color";s:7:"#000000";s:15:"dark_link_color";s:7:"#000000";s:15:"overlay_opacity";s:2:"40";s:13:"overlay_color";s:7:"#ff0f80";s:22:"block_background_color";s:7:"#ff0000";s:23:"element_highlight_color";s:7:"#ff0080";}'),
(3, 1, 'Elegant Theme', 'a:19:{s:13:"theme_color_1";s:7:"#ff0080";s:13:"theme_color_2";s:7:"#ff8000";s:13:"theme_color_3";s:7:"#ff80c0";s:13:"theme_color_4";s:7:"#c0c0c0";s:13:"theme_color_5";s:7:"#8080c0";s:7:"is_bold";s:2:"on";s:10:"is_italics";s:2:"on";s:12:"is_underline";s:0:"";s:10:"text_align";s:7:"justify";s:10:"text_color";s:7:"#00ff80";s:10:"font_style";s:5:"Ariel";s:16:"light_text_color";s:7:"#408080";s:15:"dark_text_color";s:7:"#004000";s:16:"light_link_color";s:7:"#c0c0c0";s:15:"dark_link_color";s:7:"#000000";s:15:"overlay_opacity";s:2:"40";s:13:"overlay_color";s:7:"#ffecf5";s:22:"block_background_color";s:7:"#ffb3b3";s:23:"element_highlight_color";s:7:"#ff0080";}'),
(4, 1, 'no 4', 'a:19:{s:13:"theme_color_1";s:7:"#800080";s:13:"theme_color_2";s:7:"#ffffff";s:13:"theme_color_3";s:7:"#800080";s:13:"theme_color_4";s:7:"#000000";s:13:"theme_color_5";s:7:"#800080";s:7:"is_bold";s:0:"";s:10:"is_italics";s:2:"on";s:12:"is_underline";s:2:"on";s:10:"text_align";s:6:"center";s:10:"text_color";s:7:"#000000";s:10:"font_style";s:0:"";s:16:"light_text_color";s:7:"#000000";s:15:"dark_text_color";s:7:"#000000";s:16:"light_link_color";s:7:"#000000";s:15:"dark_link_color";s:7:"#000000";s:15:"overlay_opacity";s:0:"";s:13:"overlay_color";s:7:"#000000";s:22:"block_background_color";s:7:"#000000";s:23:"element_highlight_color";s:7:"#800080";}'),
(5, 1, 'no 5', 'a:19:{s:13:"theme_color_1";s:7:"#ff80c0";s:13:"theme_color_2";s:7:"#ffffff";s:13:"theme_color_3";s:7:"#ff80c0";s:13:"theme_color_4";s:7:"#ffffff";s:13:"theme_color_5";s:7:"#ff80c0";s:7:"is_bold";s:0:"";s:10:"is_italics";s:2:"on";s:12:"is_underline";s:2:"on";s:10:"text_align";s:6:"center";s:10:"text_color";s:7:"#000000";s:10:"font_style";s:0:"";s:16:"light_text_color";s:7:"#000000";s:15:"dark_text_color";s:7:"#000000";s:16:"light_link_color";s:7:"#000000";s:15:"dark_link_color";s:7:"#000000";s:15:"overlay_opacity";s:0:"";s:13:"overlay_color";s:7:"#000000";s:22:"block_background_color";s:7:"#000000";s:23:"element_highlight_color";s:7:"#800080";}'),
(6, 1, 'No 6', 'a:19:{s:13:"theme_color_1";s:7:"#c0c0c0";s:13:"theme_color_2";s:7:"#ff8000";s:13:"theme_color_3";s:7:"#c0c0c0";s:13:"theme_color_4";s:7:"#ff8000";s:13:"theme_color_5";s:7:"#c0c0c0";s:7:"is_bold";s:2:"on";s:10:"is_italics";s:0:"";s:12:"is_underline";s:2:"on";s:10:"text_align";s:0:"";s:10:"text_color";s:7:"#000000";s:10:"font_style";s:4:"dgdg";s:16:"light_text_color";s:7:"#c0c0c0";s:15:"dark_text_color";s:7:"#000000";s:16:"light_link_color";s:7:"#000000";s:15:"dark_link_color";s:7:"#000000";s:15:"overlay_opacity";s:2:"45";s:13:"overlay_color";s:7:"#000000";s:22:"block_background_color";s:7:"#000000";s:23:"element_highlight_color";s:7:"#000000";}'),
(7, 1, 'Elegant Design1', 'a:19:{s:13:"theme_color_1";s:7:"#fffff0";s:13:"theme_color_2";s:7:"#000000";s:13:"theme_color_3";s:7:"#004080";s:13:"theme_color_4";s:7:"#000000";s:13:"theme_color_5";s:7:"#00ffff";s:7:"is_bold";s:2:"on";s:10:"is_italics";s:0:"";s:12:"is_underline";s:2:"on";s:10:"text_align";s:0:"";s:10:"text_color";s:7:"#000000";s:10:"font_style";s:6:"Roboto";s:16:"light_text_color";s:7:"#000000";s:15:"dark_text_color";s:7:"#000000";s:16:"light_link_color";s:7:"#000000";s:15:"dark_link_color";s:7:"#000000";s:15:"overlay_opacity";s:0:"";s:13:"overlay_color";s:7:"#00ffff";s:22:"block_background_color";s:7:"#000000";s:23:"element_highlight_color";s:7:"#000000";}'),
(8, 1, 'Test Again', 'a:19:{s:13:"theme_color_1";s:7:"#ffffff";s:13:"theme_color_2";s:7:"#400040";s:13:"theme_color_3";s:7:"#c0c0c0";s:13:"theme_color_4";s:7:"#808080";s:13:"theme_color_5";s:7:"#808000";s:7:"is_bold";s:0:"";s:10:"is_italics";s:2:"on";s:12:"is_underline";s:0:"";s:10:"text_align";s:0:"";s:10:"text_color";s:7:"#000000";s:10:"font_style";s:6:"Roboto";s:16:"light_text_color";s:7:"#000000";s:15:"dark_text_color";s:7:"#000000";s:16:"light_link_color";s:7:"#000000";s:15:"dark_link_color";s:7:"#000000";s:15:"overlay_opacity";s:2:"40";s:13:"overlay_color";s:7:"#000fff";s:22:"block_background_color";s:7:"#000000";s:23:"element_highlight_color";s:7:"#000000";}'),
(19, 0, NULL, 'a:4:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:6:"height";s:4:"37.5";}'),
(20, 0, NULL, 'a:4:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:6:"height";s:4:"37.5";}'),
(21, 0, NULL, 'a:4:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:6:"height";s:4:"37.5";}'),
(22, 0, NULL, 'a:4:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:6:"height";s:4:"37.5";}'),
(23, 0, NULL, 'a:4:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:6:"height";s:4:"37.5";}'),
(24, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(25, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(26, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(27, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(28, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(29, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(30, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(31, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(32, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(33, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(34, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(35, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(36, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(37, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(38, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(39, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(40, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(41, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(42, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(43, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(44, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(45, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(46, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(47, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(48, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(49, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(50, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(51, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(52, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(53, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(54, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(55, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(56, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(174, 208, 177)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(57, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(58, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(59, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(60, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(61, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(62, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(195, 223, 246)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(63, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(160, 175, 187)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(64, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(65, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(66, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(67, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(237, 228, 228)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(68, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(69, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(70, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(71, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(72, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(73, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(74, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(75, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(76, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(77, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(78, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(79, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(80, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(81, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(82, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(83, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(84, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(85, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(86, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(87, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(88, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(89, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(90, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(91, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(92, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:14:"rgb(255, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(93, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(94, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(95, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(96, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(97, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(98, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(99, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(100, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(101, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(102, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(103, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(104, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(105, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(106, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(107, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(108, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(109, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(110, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(111, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(112, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(113, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(114, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(115, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(116, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(117, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.8";s:11:"div_bgcolor";s:18:"rgb(102, 102, 102)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(118, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(119, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(120, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(121, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(122, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(123, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(124, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(125, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.8";s:11:"div_bgcolor";s:16:"rgb(230, 20, 20)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(126, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(127, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(128, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(129, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(130, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(131, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(132, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(133, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(134, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(135, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(136, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(137, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(138, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(139, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"0";s:11:"div_bgcolor";s:18:"rgb(245, 239, 239)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(140, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(141, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"0";s:11:"div_bgcolor";s:18:"rgb(247, 239, 239)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(142, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(143, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(144, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.5";s:11:"div_bgcolor";s:15:"rgb(46, 43, 43)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(145, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:13:"rgb(15, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(146, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:13:"rgb(15, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(147, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(148, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(149, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"337.5";}'),
(150, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(151, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(152, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(153, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(154, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(155, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(156, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(157, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"600";}'),
(158, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"562.5";}'),
(159, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(161, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(162, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(163, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(164, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(165, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(166, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(167, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(168, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"600";}'),
(169, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(171, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"412.5";}'),
(172, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"412.5";}'),
(173, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"412.5";}'),
(174, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"412.5";}'),
(175, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"0";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(176, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"412.5";}'),
(177, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(178, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(179, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(180, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(181, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(182, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(183, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(184, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(185, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(186, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(187, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(188, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(189, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(190, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(191, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(192, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(193, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(194, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(195, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(196, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(197, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(198, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(199, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"562.5";}'),
(200, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(201, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"562.5";}'),
(202, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(203, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(204, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(205, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(206, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(207, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(208, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(209, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(210, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"562.5";}'),
(211, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(212, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(213, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(214, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(215, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(216, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(217, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(218, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(219, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(220, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(221, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(222, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(223, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(224, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(225, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(226, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(227, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(228, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(229, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(230, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(231, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(232, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(233, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(234, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(235, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(236, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(237, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(238, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(239, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(240, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(241, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(242, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(243, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(244, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"600";}'),
(245, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(246, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(247, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(248, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(249, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(250, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(251, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(252, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(253, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(254, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(255, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(256, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(257, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(258, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(259, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(260, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(261, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(262, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(263, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(264, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(265, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(266, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(267, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(268, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(269, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(270, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(271, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(272, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(273, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(274, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}');
INSERT INTO `theme` (`theme_id`, `theme_type`, `theme_name`, `theme_properties`) VALUES
(275, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"375";}'),
(276, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(277, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(278, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(279, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(280, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(281, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(282, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(283, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(284, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(285, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(286, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(287, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(288, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(289, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(290, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(291, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(292, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(293, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(294, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(295, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(296, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(297, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(298, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(299, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(300, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(301, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(302, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(303, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(304, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(305, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(306, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(307, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(308, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(309, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(310, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(311, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(312, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(313, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"525";}'),
(314, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(315, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(317, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(318, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(319, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"562.5";}'),
(320, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(321, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(322, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(323, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(324, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(325, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(326, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(327, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(328, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(329, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"375";}'),
(330, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(331, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(332, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(333, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(334, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(335, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:18:"rgb(221, 221, 221)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"375";}'),
(336, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(337, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(338, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(339, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(340, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(341, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(342, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(343, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(344, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(345, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(346, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(347, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(348, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(349, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(350, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(351, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(352, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(353, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(354, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(355, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(356, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(357, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(358, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(359, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(360, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(361, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(362, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(363, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(364, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(365, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(366, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(367, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(368, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(369, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(370, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(371, 1, 'QardDeck', 'a:19:{s:13:"theme_color_1";s:7:"#ffffff";s:13:"theme_color_2";s:7:"#465360";s:13:"theme_color_3";s:7:"#d8d8d8";s:13:"theme_color_4";s:7:"#f0f0f0";s:13:"theme_color_5";s:7:"#0db7bb";s:7:"is_bold";s:0:"";s:10:"is_italics";s:0:"";s:12:"is_underline";s:0:"";s:10:"text_align";s:0:"";s:10:"text_color";s:7:"#000000";s:10:"font_style";s:6:"Roboto";s:16:"light_text_color";s:7:"#ffffff";s:15:"dark_text_color";s:7:"#0db7bb";s:16:"light_link_color";s:7:"#ffffff";s:15:"dark_link_color";s:7:"#0db7bb";s:15:"overlay_opacity";s:0:"";s:13:"overlay_color";s:7:"#c0c0c0";s:22:"block_background_color";s:7:"#f0f0f0";s:23:"element_highlight_color";s:7:"#0db7bb";}'),
(372, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:17:"rgb(13, 183, 187)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(373, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.2";s:11:"div_bgcolor";s:18:"rgb(102, 102, 102)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(374, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(216, 216, 216)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(375, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:15:"rgb(70, 83, 96)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(376, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(377, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(192, 192, 192)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(378, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:0:"";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"600";}'),
(379, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:0:"";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"600";}'),
(380, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(381, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.5";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(382, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.5";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(383, 0, NULL, 'a:5:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(384, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(385, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(386, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(387, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.5";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:18:"rgb(102, 102, 102)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(388, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.5";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:18:"rgb(102, 102, 102)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(389, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.5";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:16:"rgb(255, 255, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(390, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"450";}'),
(391, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:16:"div_overlaycolor";s:16:"rgb(255, 255, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"375";}'),
(392, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(393, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:16:"div_overlaycolor";s:16:"rgb(255, 255, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(394, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:16:"div_overlaycolor";s:16:"rgb(255, 255, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(395, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(396, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(397, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(398, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(399, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(400, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(401, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(402, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"337.5";}'),
(403, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(404, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"NaN";}'),
(406, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:17:"rgb(13, 183, 187)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(407, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(408, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(409, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:15:"rgb(70, 83, 96)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(410, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(411, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(412, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(413, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(414, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(415, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:17:"rgb(13, 183, 187)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(416, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(417, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(418, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(419, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"450";}'),
(420, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(421, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"300";}'),
(422, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.7";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:16:"div_overlaycolor";s:18:"rgb(255, 255, 255)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(423, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:14:"rgb(64, 0, 64)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(424, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(425, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:3:"0.6";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:16:"div_overlaycolor";s:18:"rgb(240, 246, 255)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(426, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(427, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(428, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(429, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(430, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(431, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(433, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(434, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(435, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(436, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(437, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(438, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(439, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(440, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(441, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(442, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(443, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(444, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(445, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(446, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(255, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_3";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:3:"gap";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(447, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(448, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(449, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(450, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(451, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(452, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(453, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(454, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(455, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(456, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(457, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(458, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(459, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(460, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(461, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(462, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(463, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(464, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(465, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(466, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(467, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(468, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_1";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:3:"gap";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(469, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:3:"gap";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(470, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:3:"gap";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(471, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:3:"gap";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(472, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_5";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:3:"gap";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(475, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:11:"transparent";s:16:"div_overlaycolor";s:11:"transparent";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(476, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:11:"transparent";s:16:"div_overlaycolor";s:11:"transparent";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(477, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:11:"transparent";s:16:"div_overlaycolor";s:11:"transparent";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(478, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:11:"transparent";s:16:"div_overlaycolor";s:11:"transparent";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(479, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:11:"transparent";s:16:"div_overlaycolor";s:11:"transparent";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(480, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:17:"rgb(13, 183, 187)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_5";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(481, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:15:"rgb(70, 83, 96)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(482, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(240, 240, 240)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(483, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:15:"rgb(70, 83, 96)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"337.5";}'),
(484, 0, NULL, 'a:6:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(485, 0, NULL, 'a:8:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(255, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_1";s:17:"data_fontcolor_id";s:16:"light_text_color";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(486, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:3:"gap";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(487, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(255, 255, 255)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_1";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:6:"shadow";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(488, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(216, 216, 216)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_3";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:6:"shadow";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(489, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:15:"rgb(70, 83, 96)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:6:"shadow";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(490, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:15:"rgb(70, 83, 96)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:6:"shadow";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(491, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(216, 216, 216)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_3";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:6:"shadow";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(492, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:17:"rgb(13, 183, 187)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_5";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:6:"shadow";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(493, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(255, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_3";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(494, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_4";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(495, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_5";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(496, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(497, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(498, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(499, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(500, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(501, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(502, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(503, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(504, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(505, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(506, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_5";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:3:"gap";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(507, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:17:"rgb(128, 128, 64)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(508, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_5";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"562.5";}');
INSERT INTO `theme` (`theme_id`, `theme_type`, `theme_name`, `theme_properties`) VALUES
(509, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(255, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_3";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(510, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(192, 192, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_4";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(511, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:2:"75";}'),
(512, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(513, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(514, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(515, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(255, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(516, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(192, 192, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(517, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(518, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_1";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(519, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(520, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(255, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_3";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(521, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(192, 192, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_4";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(522, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_5";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(523, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_1";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(524, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 128, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(525, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(255, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_3";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(526, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(192, 192, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_4";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(527, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(528, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(529, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_5";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(530, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(531, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(532, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(533, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(534, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(535, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(536, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(255, 0, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_1";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(537, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(538, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(539, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(540, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(541, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(542, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(543, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:17:"rgb(128, 128, 64)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(544, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(545, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:17:"rgb(128, 128, 64)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_2";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(546, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgb(0, 128, 128)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_4";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(547, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(548, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(549, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(550, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(551, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(552, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(553, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(554, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(555, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(556, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(557, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(558, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(559, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:18:"rgb(128, 128, 192)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:13:"theme_color_5";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(560, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"412.5";}'),
(561, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(562, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"600";}'),
(563, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"600";}'),
(564, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(565, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(566, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(567, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(568, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(569, 0, NULL, 'a:9:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(570, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:24:"right -242px bottom 23px";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(571, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:19:"left 0px top -194px";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(572, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:19:"left 0px top -184px";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(573, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:21:"left -63px top -157px";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(574, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:19:"left -503px top 0px";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(575, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:23:"left -873px top -1307px";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(576, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:23:"left -1554px top -927px";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(577, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:20:"left -23px top -96px";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(578, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:19:"left 0px top -300px";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(579, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:22:"left -294px top -490px";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(580, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:24:"left -1783px top -1771px";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(581, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:20:"left -70px top -89px";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(582, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:19:"left 0px top -211px";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(583, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:19:"left 0px top -221px";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(584, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(585, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(586, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"262.5";}'),
(587, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(588, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(589, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"225";}'),
(590, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(591, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(592, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(593, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(594, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:22:"left -251px top -273px";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(595, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"150";}'),
(596, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:3:"300";}'),
(597, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:4:"37.5";}'),
(598, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}'),
(599, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"187.5";}'),
(600, 0, NULL, 'a:10:{s:13:"image_opacity";s:1:"1";s:11:"div_opacity";s:1:"1";s:11:"div_bgcolor";s:16:"rgba(0, 0, 0, 0)";s:16:"div_overlaycolor";s:16:"rgba(0, 0, 0, 0)";s:15:"data_bgcolor_id";s:1:"0";s:17:"data_fontcolor_id";s:1:"0";s:15:"data_style_qard";s:4:"line";s:20:"div_bgimage_position";s:5:"0% 0%";s:11:"div_bgimage";s:0:"";s:6:"height";s:5:"112.5";}');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `login_type` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `role`, `login_type`) VALUES
(1, 'admin', 'lnzDZZfiBqKFAcc4K5GXUE7SjdrdlTbn', '$2y$13$svzEXzYCy72bv0Zgyjsh5eyRG2APxhfBGIJ7p.zIlu4FfW4XHeunW', NULL, 'den.cy@abacies.com', 10, 1461761180, 1461761180, 'user', ''),
(3, 'admin1', '99rbIQQAN67g5cJFJRANJbts-E9c2lVZ', '$2y$13$C5Jv0lrPmp1SIcyRBoI37ugzZ4ygg.jpf10Tz4iNN0w9PMMKboqzu', NULL, 'dency@abacies.com', 10, 1461913248, 1461913248, 'user', ''),
(10, 'adm1', 'kLy3bsYasKbAl2wrWnW9LNmG3-o5C2gk', '$2y$13$sdJ1x2wwGfWkliGMrIKbxujkSa11zF4ks2kSo6l8fyedWO7bX6dX.', NULL, 'vbvb@dg.com', 10, 1461914143, 1461914143, 'user', ''),
(15, 'admin12', 'y8d_0toSjBQsDg5KRiYihxt9J2rfxcQB', '$2y$13$EIAoZNUEMniuINmErlu3puL0kllbtfnI.3if/Wc97sC9Ifc7BgH7e', NULL, 'dency@abacies.com', 10, 1461923902, 1461923902, 'user', ''),
(16, 'dency', 'jwnR2vA6j1Hd6600HcdXX9_QdNUD398O', '$2y$13$oHZg767Ad/bsIrc08YJHPuG.j3QVnbdmIFONfmJomBZnQPT7OJdQK', NULL, 'dency@abacies.com', 10, 1461924789, 1461924789, 'user', ''),
(17, 'daisy', 'oo5GRXB-SibhbK6B7-x1JUxDsoGRDEQa', '$2y$13$PYexc19j4XixC6Au/aM9YubmXL48ckpOCczb9RMvDShUeSBD1CibS', NULL, 'dency@abacies.com', 10, 1461924981, 1461924981, 'user', ''),
(18, 'daisy1', 'uXqqZ8JZcgqo5WJgP56wnoJRz00AbXfl', '$2y$13$hlVi94bpnT8j2qtcN/4kLOd/QYHM..Ifk4959Xkt4jtuRi9KWRfVS', NULL, 'dency@abacies.com', 10, 1461925036, 1461925036, 'user', ''),
(19, 'dencygb', 'OI-0ozmLu0S8O6jMBsRaJYicd5obe4I5', '$2y$13$nlvPXj5FjaRLSjQtReSoj./Fh06rxo90HyC3fZ.DXzpDJKw59cyIe', NULL, 'dency@abacies.com', 10, 1461925101, 1461925101, 'user', ''),
(20, 'vijay', 'Xh9Gx3QiTvC0pxYqLJRrsyOLkSQs5-YB', '$2y$13$wi73BwBirN/3kukdOGQVweLs9HJfY6LL2L3DhfbM8uTTctm/HY/.6', NULL, 'vijay@abacies.com', 10, 1461925233, 1461925233, 'user', ''),
(21, 'benu', 'r9mXWeiLBQUDt5HJCJJO8JYYYIdw15UE', '$2y$13$QF28qhSaQBS0O/O44TyXSuTZTi6ZvnvpudLi8gBcJaWzCcWf2XqPy', NULL, 'dency@abacies.com', 10, 1461925545, 1461925545, 'user', ''),
(22, 'dencybaby', 'vk2thUyXyEtKzOQocTQ22E7zI5X9PiT9', '$2y$13$YJ6Z2bbhzKCaoUf4D1bNtu1AZDB3jDyYLL2FMhgZGNno5cBjcw5ey', NULL, 'dency@abacies.com', 10, 1461926604, 1461926604, 'user', ''),
(23, 'vijaysharma', 'EgAEDPrT8FDD3CeMTbHNgO1JDSg85Svw', '$2y$13$DT8Kh6qvb9uSxnsYL/aJVOl41IyxxPfZGD1Ui0D8ptj87SyO2dFC.', NULL, 'vijay@abacies.com', 10, 1461929463, 1461929463, 'user', ''),
(24, 'denunew', '5e5y62xH3lDAQ9XoMq4k_fXjKVlfsacX', '$2y$13$H9CK/MfLilFVnFKeLCZi3..6KXTulUWJTdNv1pQs6d2MGaY0.Ar0e', NULL, 'de.ncy@abacies.com', 10, 1463991251, 1463991258, 'user', ''),
(25, 'denurony', 'xiS8yEhAsRWB9B1YP94PwWszXvtF3389', '$2y$13$e3bIod79z2d4SO/pzv2x.eaXbOYZXhRnp5qh9KQuFyYr4KH4LRFia', NULL, 'd.enu@abacies.com', 10, 1463996025, 1463996030, 'user', ''),
(26, 'benu1', 'WUj1dD96NAL-wiw8AmbhAuSambGQ6Dth', '$2y$13$jsRSzy2KqcSMNltjNtAG0O9SXPMjYsgBoGPZ6Luf/sirTdTl.EKCu', NULL, 'bencygsd@ghdfs.com', 10, 1463999336, 1463999341, 'user', ''),
(27, 'daisy12', 'bHy9xBoZHMCRBc1YTfj7tuK3DxNIMHVr', '$2y$13$rthhzxRwiK47j7Zu63JsT.cz9E/XvqtMg/ukcdZ9SombxdEkLvEHy', NULL, 'sdfcsd@fg.com', 10, 1463999404, 1463999408, 'user', ''),
(28, 'zxcvbnm', 'JFZfcj7TaMnaBQKWx402-tb4GiSI7fcc', '$2y$13$e3bIod79z2d4SO/pzv2x.eaXbOYZXhRnp5qh9KQuFyYr4KH4LRFia', NULL, 'sdf@dggd.com', 10, 1463999566, 1463999570, 'user', ''),
(29, 'g', 'I1DF7P67_JqjaK6M1J1FUTkkKcPLZanj', '$2y$13$eZmqWbmfjqwmaXWtG2o8h.kL7hSrLMpfbhYwfuVKm2X0Px0k00qC6', NULL, 'werf@dfsg.com', 10, 1463999894, 1463999898, 'user', ''),
(30, 'gh', 'B_UDuqSFgDUvIZmsv31rFJFMMKsKPtjI', '$2y$13$IKScCHGhLgcybydw0VJkCuQ978eOBmlTkgzHRuCISQsb29mBWrTLO', NULL, 'dsdf@jkhasd.com', 10, 1464000385, 1464000385, 'user', ''),
(31, 'lemmi', 'yLDBdaRsTEydXcgbvKAgRBsY3UyrjUy7', '$2y$13$BAt5ssxBV.1RiemQstLc6ODwpWUav6T6CI839Ws3/.L9w7tNDdVze', NULL, 'lamiasathar@gmail.com', 10, 1464000753, 1464167462, 'admin', ''),
(32, 'anu', 'WuBZM_VmDefDUd7I7mK5cOzAuOYYWiMT', '$2y$13$R1MwFtneOIcWpEz9HPYMa.hp3.QwkW1/LkSL47MvKJccJBJM6ptti', NULL, 'anurosann@ghs.com', 10, 1464003005, 1464003005, 'user', ''),
(33, 'vijay12', '1LdJLdHHtIKHmKjhF0NiF2iNSBukFht9', '$2y$13$Y7mb/j/7HX5RE98NzS8I.Og3uO68ZRYjtU.7CFqH3yaDnkTWH40gK', NULL, 'vijay@a.bacies.com', 10, 1464003411, 1464003415, 'user', ''),
(34, 'denurm', 'Vv0QVw_XJCG7wxS2W4jdXVPSAT5x1gwx', '$2y$13$sRDQ9MITqmbSrwVmEoRVUOBPUd7jMigV./XRK.96qC7vYKMiNfgyK', NULL, 'denu@ghfd.com', 10, 1464065651, 1464065655, 'user', ''),
(35, 'prabhu', 'AMCLh6xxITOJWcIJutmJVMx2pVyccaQb', '$2y$13$m3BWa2vi06TgdLX40hjDEu92pVMyExOTcUGi52wR3QuM8/hPwyZXG', NULL, 'dency@abacies.com', 10, 1464078172, 1464096183, 'user', ''),
(36, 'surya', '3q56yX3CQxTe4pOCTuzG9BY3BWoipKiv', '$2y$13$oXMsHNWHqdBGArSgOO8GC.DQD7QB24pjuO17kQ2dM/MfsOAzyhGcC', NULL, 'dency@abacies.com', 10, 1464160078, 1464160097, 'user', 'email'),
(39, 'fb_564848063677338', 'TU80yNbNr0LKG8k7Q6UldM1n2vZIULwF', '$2y$13$hi4D2K15IAUGjpxrK4pime12ZPpMGZbv7yFBrav5yMYlvy6xznD8a', NULL, 'dencydxp@gmail.com', 10, 1464166403, 1464166403, 'user', 'facebook'),
(42, 'tw_3433980017', 'V6gEd1kUubHhn2Jf_4zxdgdRgI7x5AD7', '$2y$13$zPTiqsvtfV/6Q3QK3qk.u.Ykun2pNGaJ3vNoKRqqA/sBR3Fp5kkbO', NULL, '', 10, 1464329549, 1464329549, 'user', 'twitter');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = To be verified,  1 = active, 2 = temp, 3 = del',
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_url` text COLLATE utf8_unicode_ci,
  `profile_photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8_unicode_ci,
  `display_url` text COLLATE utf8_unicode_ci,
  `display_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_bg_image` text COLLATE utf8_unicode_ci,
  `bg_properties` longtext COLLATE utf8_unicode_ci,
  `profile_privacy` int(11) NOT NULL DEFAULT '1',
  `fb_status` smallint(6) NOT NULL,
  `tw_status` smallint(6) NOT NULL,
  `isEmailEnabled` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`profile_id`, `user_id`, `profile_status`, `firstname`, `lastname`, `profile_url`, `profile_photo`, `temp_image`, `short_description`, `display_url`, `display_email`, `profile_bg_image`, `bg_properties`, `profile_privacy`, `fb_status`, `tw_status`, `isEmailEnabled`) VALUES
(1, 1, 0, 'sdfsf', 'sdfsd', NULL, NULL, NULL, 'sdfsdf', NULL, 'den.cy@abacies.com', NULL, NULL, 1, 0, 0, 0),
(2, 3, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(4, 10, 0, 'hgng', 'vbnvbn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(5, 15, 0, 'Balamurugan', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(6, 16, 0, 'Dency', 'G B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(7, 17, 0, 'Daisy', 'G B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(8, 18, 0, 'Daisy', 'G B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(9, 19, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(10, 20, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(11, 21, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(12, 22, 0, 'Dency', 'Baby', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(13, 23, 0, 'Vijay', 'Sharma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(14, 24, 0, 'Dency', 'G B', '', NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(15, 25, 0, 'Denu', 'Rony', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(16, 26, 0, 'Bency', 'Liju', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(17, 27, 0, 'sdfe', 'fgdg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(18, 28, 0, 'f', 'dfg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(19, 29, 0, 'try', 'rty', '', NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(20, 30, 0, 'frwef', 'werwe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(21, 31, 0, 'Lamia', 'Sathar', '', '/qarddeck/web/uploads/Spring green leaves eye wallpapers 1280x720.jpg', 'uploads/Spring green leaves eye wallpapers 1280x720.jpg', '', NULL, 'dencydxp@gmail.com', 'http://abs.twimg.com/images/themes/theme1/bg.png', NULL, 1, 1, 1, 0),
(22, 32, 0, 'Anu', 'Siby', '', NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(23, 33, 0, 'Vijay', 'Sharma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(24, 34, 0, 'Denu', 'Manjaly', NULL, NULL, NULL, NULL, NULL, NULL, 'http://abs.twimg.com/images/themes/theme1/bg.png', NULL, 1, 0, 1, 0),
(25, 35, 0, 'sf', 'dfgg', '', NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 0, 0, 1),
(26, 36, 0, 'Surya', 'Sahoo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(29, 39, 0, 'Dency', 'G B', NULL, NULL, NULL, NULL, NULL, 'dencydxp@gmail.com', NULL, NULL, 1, 0, 0, 0),
(32, 42, 0, 'Dency', 'G B', '', '/qarddeck/web/uploads/Philippe-Dumas-60-years-old-French-model-new.jpg', 'uploads/Philippe-Dumas-60-years-old-French-model-new.jpg', '', NULL, 'd4denz@gmail.com', NULL, NULL, 1, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `deck`
--
ALTER TABLE `deck`
  ADD PRIMARY KEY (`deck_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `privacy` (`deck_privacy`);

--
-- Indexes for table `deck_comment`
--
ALTER TABLE `deck_comment`
  ADD PRIMARY KEY (`deck_comment_id`),
  ADD KEY `deck_id` (`deck_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `deck_permissions`
--
ALTER TABLE `deck_permissions`
  ADD PRIMARY KEY (`dp_id`),
  ADD KEY `deck_id` (`deck_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `deck_tags`
--
ALTER TABLE `deck_tags`
  ADD PRIMARY KEY (`dt_id`),
  ADD KEY `deck_id` (`deck_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `follower_id` (`follower_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `privacy`
--
ALTER TABLE `privacy`
  ADD PRIMARY KEY (`privacy_id`);

--
-- Indexes for table `qard`
--
ALTER TABLE `qard`
  ADD PRIMARY KEY (`qard_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `qard_theme` (`qard_theme`),
  ADD KEY `qard_privacy` (`qard_privacy`);

--
-- Indexes for table `qard_block`
--
ALTER TABLE `qard_block`
  ADD PRIMARY KEY (`block_id`),
  ADD KEY `qard_id` (`qard_id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Indexes for table `qard_comments`
--
ALTER TABLE `qard_comments`
  ADD PRIMARY KEY (`qard_comment_id`),
  ADD KEY `qard_id` (`qard_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `qard_deck`
--
ALTER TABLE `qard_deck`
  ADD PRIMARY KEY (`qd_id`),
  ADD KEY `qard_id` (`qard_id`),
  ADD KEY `deck_id` (`deck_id`);

--
-- Indexes for table `qard_permissions`
--
ALTER TABLE `qard_permissions`
  ADD KEY `qard_id` (`qard_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `qard_tags`
--
ALTER TABLE `qard_tags`
  ADD PRIMARY KEY (`qt_id`);

--
-- Indexes for table `qard_user_activity`
--
ALTER TABLE `qard_user_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`tu_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `profile_privacy` (`profile_privacy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deck`
--
ALTER TABLE `deck`
  MODIFY `deck_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `deck_comment`
--
ALTER TABLE `deck_comment`
  MODIFY `deck_comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deck_permissions`
--
ALTER TABLE `deck_permissions`
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deck_tags`
--
ALTER TABLE `deck_tags`
  MODIFY `dt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `follower`
--
ALTER TABLE `follower`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `privacy`
--
ALTER TABLE `privacy`
  MODIFY `privacy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `qard`
--
ALTER TABLE `qard`
  MODIFY `qard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;
--
-- AUTO_INCREMENT for table `qard_block`
--
ALTER TABLE `qard_block`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=492;
--
-- AUTO_INCREMENT for table `qard_comments`
--
ALTER TABLE `qard_comments`
  MODIFY `qard_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `qard_deck`
--
ALTER TABLE `qard_deck`
  MODIFY `qd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `qard_tags`
--
ALTER TABLE `qard_tags`
  MODIFY `qt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `qard_user_activity`
--
ALTER TABLE `qard_user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `tu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `theme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=601;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deck`
--
ALTER TABLE `deck`
  ADD CONSTRAINT `deck_ibfk_1` FOREIGN KEY (`deck_privacy`) REFERENCES `privacy` (`privacy_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deck_comment`
--
ALTER TABLE `deck_comment`
  ADD CONSTRAINT `deck_comment_ibfk_1` FOREIGN KEY (`deck_id`) REFERENCES `deck` (`deck_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deck_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deck_permissions`
--
ALTER TABLE `deck_permissions`
  ADD CONSTRAINT `deck_permissions_ibfk_1` FOREIGN KEY (`deck_id`) REFERENCES `deck` (`deck_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deck_permissions_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deck_permissions_ibfk_3` FOREIGN KEY (`org_id`) REFERENCES `organisation` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deck_tags`
--
ALTER TABLE `deck_tags`
  ADD CONSTRAINT `deck_tags_ibfk_1` FOREIGN KEY (`deck_id`) REFERENCES `deck` (`deck_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deck_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `follower_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `follower_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qard`
--
ALTER TABLE `qard`
  ADD CONSTRAINT `qard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qard_ibfk_2` FOREIGN KEY (`qard_privacy`) REFERENCES `privacy` (`privacy_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qard_ibfk_3` FOREIGN KEY (`qard_theme`) REFERENCES `theme` (`theme_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qard_comments`
--
ALTER TABLE `qard_comments`
  ADD CONSTRAINT `qard_comments_ibfk_1` FOREIGN KEY (`qard_id`) REFERENCES `qard` (`qard_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qard_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qard_deck`
--
ALTER TABLE `qard_deck`
  ADD CONSTRAINT `qard_deck_ibfk_1` FOREIGN KEY (`qard_id`) REFERENCES `qard` (`qard_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qard_deck_ibfk_2` FOREIGN KEY (`deck_id`) REFERENCES `deck` (`deck_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qard_permissions`
--
ALTER TABLE `qard_permissions`
  ADD CONSTRAINT `qard_permissions_ibfk_1` FOREIGN KEY (`qard_id`) REFERENCES `qard` (`qard_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qard_permissions_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qard_permissions_ibfk_3` FOREIGN KEY (`org_id`) REFERENCES `organisation` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organisation` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_user`
--
ALTER TABLE `team_user`
  ADD CONSTRAINT `team_user_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_profile_ibfk_2` FOREIGN KEY (`profile_privacy`) REFERENCES `privacy` (`privacy_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

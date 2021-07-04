-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Време на генериране:  4 юли 2021 в 09:36
-- Версия на сървъра: 10.3.30-MariaDB-log
-- Версия на PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `museecu8_museumbooking`
--

-- --------------------------------------------------------

--
-- Структура на таблица `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `city`
--

INSERT INTO `city` (`id`, `country_id`, `name`, `image`) VALUES
(1, 1, 'Razgrad', ''),
(2, 1, 'Plovdiv', ''),
(3, 1, 'Veliko Turnovo', ''),
(4, 1, 'Sofiq', ''),
(5, 1, 'Turgovishte', ''),
(6, 1, 'Shumen', ''),
(7, 1, 'Ruse', ''),
(8, 1, 'Varna ', '');

-- --------------------------------------------------------

--
-- Структура на таблица `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `country`
--

INSERT INTO `country` (`id`, `name`, `image`) VALUES
(1, 'Bulgaria', '');

-- --------------------------------------------------------

--
-- Структура на таблица `day`
--

CREATE TABLE `day` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `day`
--

INSERT INTO `day` (`id`, `name`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Структура на таблица `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `museum_id` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `image`
--

INSERT INTO `image` (`id`, `museum_id`, `path`) VALUES
(2, 1, 'abritus1.jpg'),
(3, 1, 'abritus2.jpg\r\n'),
(4, 1, 'abritusMuseum.jpg'),
(5, 1, 'abritus3.jpg'),
(6, 3, 'tsarevets1.jpg'),
(7, 3, 'tsarevets2.jpg'),
(8, 3, 'tsarevets3.jpg'),
(9, 3, 'Military_Museum_Sofia_1.jpg'),
(10, 4, 'Military_Museum_Sofia_1.jpg'),
(11, 4, 'Military_Museum_Sofia_2.jpg'),
(12, 4, 'Military_Museum_Sofia_3.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20201114104724', '2020-11-14 10:47:47'),
('20201116071840', '2020-11-16 07:19:14'),
('20201123191558', '2020-11-23 19:18:52'),
('20201127201251', '2020-11-27 20:13:20'),
('20201129073731', '2020-11-29 07:38:12'),
('20201129162938', '2020-11-29 16:30:08'),
('20201129164907', '2020-11-29 16:49:28'),
('20201129204527', '2020-11-29 20:45:46'),
('20201201201745', '2020-12-01 20:18:10'),
('20201201202327', '2020-12-01 20:23:45'),
('20201201203854', '2020-12-01 20:39:01'),
('20201201203942', '2020-12-01 20:40:01'),
('20201204050214', '2020-12-04 05:02:42'),
('20201204052026', '2020-12-04 05:20:49'),
('20201205080733', '2020-12-05 08:07:59'),
('20201219135617', '2020-12-19 13:57:59'),
('20201226171856', '2020-12-26 17:19:17');

-- --------------------------------------------------------

--
-- Структура на таблица `museum`
--

CREATE TABLE `museum` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `museum_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_information` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `museum`
--

INSERT INTO `museum` (`id`, `user_id`, `city_id`, `museum_name`, `additional_information`, `image`, `max_capacity`, `rating`) VALUES
(1, 1, 1, 'Abritus', 'The ancient city of Abritus is extremely well preserved and some parts of the excavations have been renovated. The museum offers an interactive way to learn more about this ancient settlement', '7d1745d3ccd689c6df354be863c1e9d6603fc256997aa.tmp', 25, 4.5),
(2, 6, 4, 'Regional Historical Museum ', 'In 1928, at the suggestion of Mayor Vladimir Vazov, a decision was made to establish a city museum. Initially, it combined the tasks of a city museum, library and archive. Along with the National, Military History and Church Archeology, it is one of the o', 'regionalHistoricalMuseum.jpg', 23, 4),
(3, 8, 3, 'Tsarevets', ' Tsarevets is a medieval stronghold located on a hill with the same name in Veliko Tarnovo in northern Bulgaria. Tsarevets is 206 meters (676 ft) above sea level. It served as the Second Bulgarian Empire\'s primary fortress and strongest bulwark between 11', 'tsarevets.jpg', 25, 4),
(4, 12, 4, 'National Museum of Military History', ' The National Museum of Military History in Sofia is a military, research and cultural-educational institute, administratively subordinated to the Ministry of Defense. The museum has the status of a national institution of Bulgaria.', 'nationalMilitaryMuseum.jpg', 40, 3.5),
(5, 13, 8, ' Archaeological Museum of Varna', ' The Regional History Museum is the historical and archeological museum of the city of Varna. It was founded in 1887 by the brothers Karel and Herman Shkorpil. The museum preserves the oldest gold in the world discovered in 1972 near Varna: the Varna Eneo', 'archelogyMuseumVarna.jpg', 40, 3),
(6, 14, 4, 'National Archaeological Institute with Museum', '', 'NationalArchaeologicalInstitutewithMuseum.jpg', 100, 2.5),
(7, 15, 2, 'Regional Ethnographic Museum', '', 'RegionalEthnographicMuseum.jpg', 20, 2.5),
(8, 16, 7, ' National Museum of Transport', '', 'NationalMuseumofTransport.jpg', 25, 2),
(9, 17, 7, ' Ecomuseum', '', 'ecomuseumRuse.jpg', 25, 2),
(10, 18, 7, 'Regional Historical Museum', '', 'museum-no-photo.jpg', 25, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `museum_review`
--

CREATE TABLE `museum_review` (
  `id` int(11) NOT NULL,
  `tour_operator_id` int(11) DEFAULT NULL,
  `museum_id` int(11) DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `museum_review`
--

INSERT INTO `museum_review` (`id`, `tour_operator_id`, `museum_id`, `text`, `date`, `rating`) VALUES
(2, 1, 1, 'This museum have a very nice personal and service. The architectur is good restored', '2020-12-01', 4.5),
(3, 1, 1, 'I\'ve been to better museums. The service is good, but it can be better. On the other hand, there is something to see in the museum', '2021-02-26', 2.5),
(4, 1, 1, '\r\nI\'ve been to better museums. The service is good, but it can be better. There are too many stones', '2021-02-26', 3),
(5, 1, 4, 'I\'ve been to better museums. The service is good, but WC are awful\n', '2021-03-04', 2),
(6, 1, 4, 'I\'ve been to better museums. The service is good', '2021-03-04', 2),
(11, 1, 1, 'This site sucks. But I love the animations. ????', '2021-04-20', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `museum_worker`
--

CREATE TABLE `museum_worker` (
  `id` int(11) NOT NULL,
  `museum_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'ROLE_TOUROPERATOR'),
(2, 'ROLE_MUSEUM'),
(3, 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Структура на таблица `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `day_id` int(11) DEFAULT NULL,
  `museum_id` int(11) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `schedule`
--

INSERT INTO `schedule` (`id`, `day_id`, `museum_id`, `start_time`, `end_time`, `price`) VALUES
(1, 2, 1, '20:30:00', '00:00:00', 0),
(17, 1, 1, '21:00:00', '23:00:00', 25),
(19, 2, 1, '17:00:00', '18:00:00', 0),
(20, NULL, 1, '21:30:41', '21:30:41', 0),
(21, NULL, 1, '21:30:42', '21:30:42', 0),
(22, NULL, 1, '21:00:00', '22:00:00', 0),
(23, NULL, 1, '09:00:00', '10:00:00', 0),
(24, 2, 1, '06:56:51', '06:56:51', 0),
(25, 2, 1, '21:00:00', '23:00:00', 0),
(28, 5, 1, '09:00:00', '10:00:00', 0),
(29, 5, 1, '14:00:00', '15:00:00', 0),
(30, 2, 1, '09:00:00', '10:00:00', 0),
(31, NULL, 1, '19:29:58', '19:29:58', 0),
(32, 2, 1, '10:00:00', '11:00:00', 25),
(33, 3, 1, '10:00:00', '11:00:00', 25),
(34, 4, 1, '10:00:00', '11:00:00', 20),
(35, 6, 1, '10:00:00', '11:00:00', 10),
(38, 6, 1, '16:00:00', '17:00:00', 10),
(39, NULL, 1, '11:00:00', '00:00:00', 25),
(40, NULL, 1, '00:00:00', '13:00:00', 25),
(41, 7, 1, '09:00:00', '10:00:00', 25),
(43, 7, 1, '11:00:00', '13:00:00', 20),
(44, 7, 1, '14:00:00', '15:00:00', 25),
(45, 7, 1, '15:00:00', '16:00:00', 25),
(46, 7, 1, '16:00:00', '17:00:00', 25),
(47, 7, 1, '17:00:00', '18:00:00', 30),
(48, 6, 1, '09:00:00', '10:00:00', 20),
(49, 6, 1, '13:00:00', '14:00:00', 25),
(50, 6, 1, '14:00:00', '15:00:00', 25),
(51, 6, 1, '15:00:00', '16:00:00', 30),
(53, 5, 1, '11:00:00', '13:00:00', 20),
(54, 5, 1, '13:00:00', '14:00:00', 25),
(55, 5, 1, '15:00:00', '16:00:00', 30),
(56, 5, 1, '16:00:00', '17:00:00', 30),
(57, 3, 1, '13:00:00', '14:00:00', 25),
(58, 3, 1, '15:00:00', '16:00:00', 25),
(59, 3, 1, '17:00:00', '18:00:00', 25),
(60, 3, 1, '09:00:00', '10:00:00', 25),
(61, 4, 1, '09:00:00', '10:00:00', 30),
(63, 4, 1, '13:00:00', '14:00:00', 30),
(64, 4, 1, '15:00:00', '16:00:00', 30),
(65, 4, 1, '17:00:00', '18:00:00', 30),
(66, 1, 1, '09:00:00', '10:00:00', 30),
(67, 1, 1, '11:00:00', '13:00:00', 30),
(68, 1, 1, '13:00:00', '14:00:00', 30),
(69, 1, 1, '15:00:00', '16:00:00', 30),
(70, 1, 1, '16:00:00', '17:00:00', 30),
(71, 1, 3, '09:00:00', '10:00:00', 10),
(72, 1, 3, '10:00:00', '11:00:00', 15),
(73, 1, 3, '13:00:00', '14:00:00', 20),
(74, 1, 3, '15:00:00', '16:00:00', 20),
(75, 1, 3, '17:00:00', '18:00:00', 20),
(76, 2, 3, '08:00:00', '09:00:00', 20),
(77, 2, 3, '09:00:00', '10:00:00', 25),
(78, 2, 3, '13:00:00', '14:00:00', 15),
(79, 2, 3, '14:00:00', '15:00:00', 15),
(80, 2, 3, '16:00:00', '17:00:00', 15),
(81, 2, 3, '17:00:00', '18:00:00', 15),
(82, 3, 3, '08:00:00', '09:00:00', 20),
(83, 3, 3, '09:00:00', '10:00:00', 20),
(84, 3, 3, '13:00:00', '14:00:00', 25),
(85, 3, 3, '14:00:00', '15:00:00', 25),
(86, 3, 3, '16:00:00', '17:00:00', 25),
(87, 3, 3, '17:00:00', '18:00:00', 25),
(88, 4, 3, '08:00:00', '09:00:00', 15),
(89, 4, 3, '09:00:00', '10:00:00', 15),
(90, 4, 3, '13:00:00', '14:00:00', 15),
(91, 4, 3, '15:00:00', '16:00:00', 15),
(92, 4, 3, '16:00:00', '17:00:00', 15),
(93, 4, 3, '17:00:00', '18:00:00', 15),
(94, 5, 3, '08:00:00', '09:00:00', 20),
(95, 5, 3, '09:00:00', '10:00:00', 20),
(96, 5, 3, '10:00:00', '11:00:00', 20),
(97, 5, 3, '13:00:00', '14:00:00', 25),
(98, 5, 3, '14:00:00', '15:00:00', 25),
(99, 5, 3, '15:00:00', '16:00:00', 25),
(101, 6, 3, '09:00:00', '10:00:00', 25),
(102, 6, 3, '10:00:00', '11:00:00', 25),
(103, 6, 3, '13:00:00', '14:00:00', 25),
(104, 6, 3, '14:00:00', '15:00:00', 25),
(105, 6, 3, '15:00:00', '16:00:00', 25),
(106, 6, 3, '16:00:00', '17:00:00', 25),
(107, 7, 3, '09:00:00', '10:00:00', 25),
(108, 7, 3, '13:00:00', '14:00:00', 25),
(109, 7, 3, '16:00:00', '17:00:00', 25),
(110, 1, 4, '09:00:00', '10:00:00', 25),
(111, 1, 4, '10:00:00', '11:00:00', 25),
(112, 1, 4, '13:00:00', '14:00:00', 25),
(113, 1, 4, '14:00:00', '15:00:00', 25),
(114, 1, 4, '16:00:00', '17:00:00', 25),
(115, 2, 4, '08:00:00', '09:00:00', 30),
(116, 2, 4, '09:00:00', '10:00:00', 30),
(117, 2, 4, '10:00:00', '11:00:00', 30),
(118, 2, 4, '13:00:00', '14:00:00', 30),
(119, 2, 4, '14:00:00', '15:00:00', 30),
(120, 2, 4, '15:00:00', '16:00:00', 30),
(121, 3, 4, '08:00:00', '09:00:00', 25),
(122, 3, 4, '09:00:00', '10:00:00', 25),
(123, 3, 4, '10:00:00', '11:00:00', 25),
(124, 3, 4, '13:00:00', '14:00:00', 25),
(125, 3, 4, '15:00:00', '16:00:00', 25),
(126, 3, 4, '17:00:00', '18:00:00', 25),
(127, 4, 4, '08:00:00', '09:00:00', 25),
(128, 4, 4, '09:00:00', '10:00:00', 25),
(129, 4, 4, '10:00:00', '11:00:00', 25),
(130, 4, 4, '13:00:00', '14:00:00', 25),
(131, 4, 4, '15:00:00', '16:00:00', 25),
(132, 4, 4, '17:00:00', '18:00:00', 25),
(133, 5, 4, '08:00:00', '09:00:00', 30),
(134, 5, 4, '09:00:00', '10:00:00', 30),
(135, 5, 4, '10:00:00', '11:00:00', 30),
(136, 5, 4, '13:00:00', '14:00:00', 30),
(137, 5, 4, '15:00:00', '16:00:00', 30),
(138, 5, 4, '17:00:00', '18:00:00', 30),
(139, 1, 7, '09:00:00', '10:00:00', 25),
(140, 1, 7, '10:00:00', '11:00:00', 25),
(141, 1, 7, '13:00:00', '14:00:00', 25),
(142, 1, 7, '14:00:00', '15:00:00', 30),
(143, 1, 7, '16:00:00', '17:00:00', 30),
(144, 2, 7, '09:00:00', '10:00:00', 20),
(145, 2, 7, '10:00:00', '11:00:00', 30),
(146, 2, 7, '13:00:00', '14:00:00', 25),
(147, 2, 7, '14:00:00', '15:00:00', 30),
(148, 2, 7, '15:00:00', '16:00:00', 30),
(149, 3, 7, '10:00:00', '11:00:00', 30),
(150, 3, 7, '14:00:00', '15:00:00', 25),
(151, 3, 7, '16:00:00', '17:00:00', 30);

-- --------------------------------------------------------

--
-- Структура на таблица `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `tour_operator_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `time` time NOT NULL,
  `number` int(11) NOT NULL,
  `has_come` tinyint(1) NOT NULL,
  `bought_date` date NOT NULL,
  `reserved_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `ticket`
--

INSERT INTO `ticket` (`id`, `tour_operator_id`, `schedule_id`, `time`, `number`, `has_come`, `bought_date`, `reserved_date`) VALUES
(8, 1, 17, '20:15:11', 2, 0, '2021-01-15', '2021-02-28'),
(10, 1, 53, '09:23:11', 5, 1, '2021-02-24', '2021-02-25'),
(13, 6, 54, '13:20:10', 2, 1, '2021-02-26', '2021-02-26'),
(14, 8, 54, '13:20:10', 2, 1, '2021-02-26', '2021-02-26'),
(15, 8, 54, '13:20:11', 2, 1, '2021-02-26', '2021-02-26'),
(26, 10, 44, '10:44:31', 1, 1, '2021-02-28', '2021-02-28'),
(27, 6, 44, '10:44:32', 1, 0, '2021-02-28', '2021-02-28'),
(28, 6, 44, '10:44:33', 1, 1, '2021-02-28', '2021-02-28'),
(29, 1, 44, '10:44:34', 1, 1, '2021-02-28', '2021-02-28'),
(34, 8, 54, '09:00:44', 2, 0, '2021-03-03', '2021-03-05'),
(35, 6, 131, '21:49:15', 1, 0, '2021-03-03', '2021-03-04'),
(36, 11, 131, '21:49:15', 1, 0, '2021-03-03', '2021-03-04'),
(37, 14, 137, '21:49:33', 1, 0, '2021-03-03', '2021-03-05'),
(38, 1, 137, '21:49:33', 1, 0, '2021-03-03', '2021-03-05'),
(39, 1, 92, '21:50:26', 1, 0, '2021-03-03', '2021-03-04'),
(40, 6, 92, '21:50:26', 1, 0, '2021-03-03', '2021-03-04'),
(41, 14, 92, '21:50:26', 1, 0, '2021-03-03', '2021-03-04'),
(42, 13, 92, '21:50:26', 1, 0, '2021-03-03', '2021-03-04'),
(43, 1, 92, '21:50:27', 1, 0, '2021-03-03', '2021-03-04'),
(44, 14, 90, '21:50:34', 1, 0, '2021-03-03', '2021-03-18'),
(45, 1, 90, '21:50:34', 1, 0, '2021-03-03', '2021-03-18'),
(46, 6, 55, '21:51:27', 2, 0, '2021-03-03', '2021-03-05'),
(47, 13, 55, '21:51:27', 2, 0, '2021-03-03', '2021-03-05'),
(48, 1, 110, '06:14:30', 2, 0, '2021-03-04', '2021-03-08'),
(51, 12, 135, '10:35:13', 2, 0, '2021-03-04', '2021-03-05'),
(52, 1, 34, '21:33:11', 1, 1, '2021-03-04', '2021-03-20'),
(53, 1, 38, '21:33:11', 1, 0, '2021-03-04', '2021-03-20'),
(54, 9, 53, '22:23:09', 1, 0, '2021-03-04', '2021-03-05'),
(55, 12, 53, '22:23:10', 1, 0, '2021-03-04', '2021-03-05'),
(56, 3, 29, '22:29:03', 1, 0, '2021-03-04', '2021-03-05'),
(57, 2, 29, '22:29:04', 1, 0, '2021-03-04', '2021-03-05'),
(58, 3, 45, '22:29:26', 2, 0, '2021-03-04', '2021-03-07'),
(59, 3, 45, '22:29:27', 2, 0, '2021-03-04', '2021-03-07'),
(61, 11, 53, '07:43:16', 2, 0, '2021-03-05', '2021-03-05'),
(65, 1, 103, '10:30:28', 2, 0, '2021-05-08', '2021-05-08'),
(66, 12, 116, '10:32:50', 3, 0, '2021-05-08', '2021-05-11'),
(68, 2, 51, '10:42:40', 1, 0, '2021-05-08', '2021-05-08'),
(70, 10, 38, '10:44:21', 2, 0, '2021-05-08', '2021-05-08'),
(72, 5, 67, '10:49:50', 2, 0, '2021-05-08', '2021-05-10'),
(73, 13, 67, '10:49:51', 2, 0, '2021-05-08', '2021-05-10'),
(74, 9, 69, '10:49:58', 2, 0, '2021-05-08', '2021-05-10'),
(75, 14, 69, '10:50:00', 2, 0, '2021-05-08', '2021-05-10'),
(76, 11, 64, '10:50:12', 3, 0, '2021-05-08', '2021-05-13'),
(77, 10, 64, '10:50:14', 3, 0, '2021-05-08', '2021-05-13'),
(78, 6, 54, '10:50:22', 2, 0, '2021-05-08', '2021-05-14'),
(79, 7, 54, '10:50:23', 2, 0, '2021-05-08', '2021-05-14'),
(80, 8, 38, '10:50:36', 3, 0, '2021-05-08', '2021-05-08'),
(81, 7, 38, '10:50:38', 3, 0, '2021-05-08', '2021-05-08'),
(82, 1, 117, '10:58:20', 2, 0, '2021-05-08', '2021-05-11'),
(84, 1, 73, '10:58:54', 2, 0, '2021-05-08', '2021-05-17');

-- --------------------------------------------------------

--
-- Структура на таблица `tour_operator`
--

CREATE TABLE `tour_operator` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_rating` double NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `tour_operator`
--

INSERT INTO `tour_operator` (`id`, `user_id`, `city_id`, `name`, `f_name`, `phone_number`, `visit_rating`, `image`) VALUES
(1, 2, 1, 'Ivanela', 'Boyanova', '0894568590', 0.7, '9cb5b37d6440bf6309b0633d133d82fd603f6d755a6c4.tmp'),
(2, 11, 4, 'Petyr', 'Stoqnov', '0894393801', 4.5, 'user1.jpg'),
(3, 19, 4, 'Ivan', 'Todorov', '0895655475', 3, 'user2.jpg'),
(4, 20, 4, 'Petyr', 'Ivanov', '0895655476', 2, 'user3.jpg'),
(5, 21, 4, 'Stoqn', 'Dimitrov', '0895655477', 4.5, 'user4.jpg'),
(6, 22, 4, 'Georgi', 'Ivanov', '0895655478', 3.7, 'user5.jpg'),
(7, 23, 7, 'Kosta', 'Micev', '0895655479', 4.7, 'user6.jpg'),
(8, 24, 5, 'Milen', 'Petvo', '0895655480', 5, 'user7.jpg'),
(9, 25, 5, 'Mert', 'Ibrahim', '0895655481', 3.2, 'user8.jpg'),
(10, 26, 5, 'Bilyana', 'Dimitrova', '0895655482', 2, 'user9.jpg'),
(11, 27, 6, 'Bob', 'Stoilov', '0895655483', 2.7, 'user11.jpg'),
(12, 28, 6, 'Bobi', 'Kostov', '0895655484', 2.5, 'user12.jpg'),
(13, 29, 8, 'Tanq', 'Peneva', '0895655485', 3.5, 'user13.jpg'),
(14, 30, 3, 'Tifani', 'Todorova', '0895655485', 2, 'user-no-photo.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'museum@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(2, 'tourOperator@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(6, 'az@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(7, 'az@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(8, 'tsarevets@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(11, '21we12e', '$2y$12$IJBVmhGL6ZSX1wpH4RooruCU9xzJqPgQQTGAtp155qsFxvIB5HZB6$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(12, 'nmofmilhis@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(13, 'armuofvar@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(14, 'natarchinswithmus@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(15, 'regionalEthMusPlov@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(16, 'natTransRuse@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(17, 'ecoMus@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(18, 'regHistoRus@museum.booking', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(19, 'ivanTodorov@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(20, 'petyrIvanov@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(21, 'stoyanIvanov@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(22, 'georgiIvanov@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(23, 'kostaa@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(24, 'milenskiq@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(25, 'mertskiq@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(26, 'bil2@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(27, 'bob123@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(28, 'bobiKo@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(29, 'tanqPen@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(30, 'tifaniTodorova@gmail.com', '$2y$12$7NQjSDLHL8agUti.j/FfMui0bOfai2cYEQHSdL6UrKjdPv7IjY1Ym'),
(31, 'az23634@gmail.com', '$2y$12$u2J8rfyaYvH7zU83LzShKu0Q/8J5daQ9M8VuvLBw9Y3NHOG6y7bQ6'),
(32, 'admin@museum.booking', '$2y$12$q2cuadmQdI8sUkLAkjaMWuRlQM30YLNbkSrO0R9XllPoJNimx2qvW');

-- --------------------------------------------------------

--
-- Структура на таблица `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(1, 2),
(2, 1),
(6, 2),
(7, 2),
(8, 2),
(11, 1),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 2),
(32, 3);

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2D5B0234F92F3E70` (`country_id`);

--
-- Индекси за таблица `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045F4B52E5B5` (`museum_id`);

--
-- Индекси за таблица `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индекси за таблица `museum`
--
ALTER TABLE `museum`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_62474477A76ED395` (`user_id`),
  ADD KEY `IDX_624744778BAC62AF` (`city_id`);

--
-- Индекси за таблица `museum_review`
--
ALTER TABLE `museum_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_468A7B4B4B52E5B5` (`museum_id`),
  ADD KEY `IDX_468A7B4B3813CA60` (`tour_operator_id`);

--
-- Индекси за таблица `museum_worker`
--
ALTER TABLE `museum_worker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A07B45EF4B52E5B5` (`museum_id`),
  ADD KEY `IDX_A07B45EF8BAC62AF` (`city_id`);

--
-- Индекси за таблица `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5A3811FB9C24126` (`day_id`),
  ADD KEY `IDX_5A3811FB4B52E5B5` (`museum_id`);

--
-- Индекси за таблица `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_97A0ADA33813CA60` (`tour_operator_id`),
  ADD KEY `IDX_97A0ADA3A40BC2D5` (`schedule_id`);

--
-- Индекси за таблица `tour_operator`
--
ALTER TABLE `tour_operator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4D59FEB2A76ED395` (`user_id`),
  ADD KEY `IDX_4D59FEB28BAC62AF` (`city_id`);

--
-- Индекси за таблица `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `IDX_54FCD59FA76ED395` (`user_id`),
  ADD KEY `IDX_54FCD59FD60322AC` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `museum`
--
ALTER TABLE `museum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `museum_review`
--
ALTER TABLE `museum_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `museum_worker`
--
ALTER TABLE `museum_worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tour_operator`
--
ALTER TABLE `tour_operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `FK_2D5B0234F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Ограничения за таблица `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F4B52E5B5` FOREIGN KEY (`museum_id`) REFERENCES `museum` (`id`);

--
-- Ограничения за таблица `museum`
--
ALTER TABLE `museum`
  ADD CONSTRAINT `FK_624744778BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `FK_62474477A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения за таблица `museum_review`
--
ALTER TABLE `museum_review`
  ADD CONSTRAINT `FK_468A7B4B3813CA60` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`),
  ADD CONSTRAINT `FK_468A7B4B4B52E5B5` FOREIGN KEY (`museum_id`) REFERENCES `museum` (`id`);

--
-- Ограничения за таблица `museum_worker`
--
ALTER TABLE `museum_worker`
  ADD CONSTRAINT `FK_A07B45EF4B52E5B5` FOREIGN KEY (`museum_id`) REFERENCES `museum` (`id`),
  ADD CONSTRAINT `FK_A07B45EF8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

--
-- Ограничения за таблица `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `FK_5A3811FB4B52E5B5` FOREIGN KEY (`museum_id`) REFERENCES `museum` (`id`),
  ADD CONSTRAINT `FK_5A3811FB9C24126` FOREIGN KEY (`day_id`) REFERENCES `day` (`id`);

--
-- Ограничения за таблица `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_97A0ADA33813CA60` FOREIGN KEY (`tour_operator_id`) REFERENCES `tour_operator` (`id`),
  ADD CONSTRAINT `FK_97A0ADA3A40BC2D5` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`);

--
-- Ограничения за таблица `tour_operator`
--
ALTER TABLE `tour_operator`
  ADD CONSTRAINT `FK_4D59FEB28BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `FK_4D59FEB2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения за таблица `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `FK_54FCD59FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_54FCD59FD60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

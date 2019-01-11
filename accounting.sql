-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 10, 2019 at 06:30 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `acts`
--

DROP TABLE IF EXISTS `acts`;
CREATE TABLE IF NOT EXISTS `acts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `slug` varchar(40) NOT NULL,
  `purpose` varchar(40) NOT NULL DEFAULT 'other',
  `balance` int(11) DEFAULT '0',
  `nodel` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=200031 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acts`
--

INSERT INTO `acts` (`id`, `typeid`, `type`, `name`, `slug`, `purpose`, `balance`, `nodel`) VALUES
(200019, 2, 'Revenue', 'Sales Account', 'sales-account', 'income', 0, 1),
(200018, 10, 'Cost of Goods Sold', 'Purchase Account', 'purchase-account', 'inventory', 0, 1),
(200017, 5, 'Current Assets', 'Cash in Bank', 'cash-in-bank', 'cash', 0, 0),
(200016, 5, 'Current Assets', 'Cash in Hands', 'cash-in-hands', 'cash', 0, 1),
(200015, 1, 'Capital', 'Capital A/c of Ali Pervaiz', 'capital-a-c-of-ali-pervaiz', 'capital', 0, 0),
(200014, 1, 'Capital', 'Capital A/c of Hamza Pervaiz', 'capital-a-c-of-hamza-pervaiz', 'capital', 0, 0),
(200020, 7, 'Drawing Capital', 'Drawing A/c of Hamza Pervaiz', 'drawing-a-c-of-hamza-pervaiz', 'capital', 0, 0),
(200021, 5, 'Current Assets', 'Customers', 'customers', 'assets', 0, 1),
(200022, 3, 'Liability', 'Vendors', 'vendors', 'liabilities', 0, 0),
(200023, 4, 'Expenses', 'Food Expenses', 'food-expenses', 'expenses', 0, 0),
(200024, 3, 'Liability', 'Loan from Hassan ', 'loan-from-hassan-', 'liabilities', 0, 0),
(200025, 5, 'Current Assets', 'UBL Bank', 'ubl-bank', 'cash', 0, 0),
(200028, 10, 'Cost of Goods Sold', 'Purchase Return', 'purchase-return', 'inventory', 0, 0),
(200029, 2, 'Revenue', 'Sales Return', 'sales-return', 'income', 0, 0),
(200030, 6, 'Fixed Assets', 'Furniture Account', 'furniture-account', 'assets', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `act_t`
--

DROP TABLE IF EXISTS `act_t`;
CREATE TABLE IF NOT EXISTS `act_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(20) DEFAULT NULL,
  `name` text NOT NULL,
  `balance` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `act_t`
--

INSERT INTO `act_t` (`id`, `slug`, `name`, `balance`) VALUES
(1, 'capital', 'Capital', 'credit'),
(2, 'revenue', 'Revenue', 'credit'),
(3, 'liability', 'Liability', 'credit'),
(4, 'expenses', 'Expenses', 'debit'),
(5, 'current assets', 'Current Assets', 'debit'),
(6, 'fixed assets', 'Fixed Assets', 'debit'),
(7, 'drawing capital', 'Drawing Capital', 'debit'),
(10, 'cogs', 'Cost of Goods Sold', '');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `ctval` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(22) NOT NULL,
  PRIMARY KEY (`ctval`)
) ENGINE=InnoDB AUTO_INCREMENT=461 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`ctval`, `city`) VALUES
(1, 'Abdul Hakeem'),
(2, 'Abottabad'),
(3, 'Adda jahan khan'),
(4, 'Adda shaiwala'),
(5, 'Ahmed Pur East'),
(6, 'Ahmedpur Lamma'),
(7, 'Akhora khattak'),
(8, 'Ali chak'),
(9, 'Alipur Chatta'),
(10, 'Allahabad'),
(11, 'Amangarh'),
(12, 'Arifwala'),
(13, 'Attock'),
(14, 'Babarloi'),
(15, 'Babri banda'),
(16, 'Badin'),
(17, 'Bahawal Nagar'),
(18, 'Balakot'),
(19, 'Bannu'),
(20, 'Baroute'),
(21, 'Basirpur'),
(22, 'Basti Shorekot'),
(23, 'Bat khela'),
(24, 'Batang'),
(25, 'Bhai pheru'),
(26, 'Bhakkar'),
(27, 'Bhalwal'),
(28, 'Bhan saeedabad'),
(29, 'Bhawalpur'),
(30, 'Bhera'),
(31, 'Bhikky'),
(32, 'Bhimber'),
(33, 'Bhirya road'),
(34, 'Bhuawana'),
(35, 'Buchay key'),
(36, 'Burewala'),
(37, 'Chacklala'),
(38, 'Chaininda'),
(39, 'Chak 4 b c'),
(40, 'Chak 46'),
(41, 'Chak jamal'),
(42, 'Chak jhumra'),
(43, 'Chak Shahzad'),
(44, 'Chaksawari'),
(45, 'Chakwal'),
(46, 'Charsadda'),
(47, 'Chashma'),
(48, 'Chawinda'),
(49, 'Chichawatni'),
(50, 'Chiniot'),
(51, 'Chishtian'),
(52, 'Chitral'),
(53, 'Chohar jamali'),
(54, 'Choppar hatta'),
(55, 'Chowha saidan shah'),
(56, 'Chowk azam'),
(57, 'Chowk mailta'),
(58, 'Chowk munda'),
(59, 'Chunian'),
(60, 'D.G.Khan'),
(61, 'Dadakhel'),
(62, 'Dadu'),
(63, 'Dadyal Ak'),
(64, 'Daharki'),
(65, 'Dandot'),
(66, 'Dargai'),
(67, 'Darya khan'),
(68, 'Daska'),
(69, 'Daud khel'),
(70, 'Daulatpur'),
(71, 'Deh pathaan'),
(72, 'Depal pur'),
(73, 'Dera Allah Yar'),
(74, 'Dera ismail khan'),
(75, 'Dera murad jamali'),
(76, 'Dera nawab sahib'),
(77, 'Dhatmal'),
(78, 'Dhoun kal'),
(79, 'Digri'),
(80, 'Dijkot'),
(81, 'Dina'),
(82, 'Dinga'),
(83, 'Dir'),
(84, 'Doaaba'),
(85, 'Doltala'),
(86, 'Domeli'),
(87, 'Donga Bonga'),
(88, 'Dudial'),
(89, 'Dunia Pur'),
(90, 'Eminabad'),
(91, 'Esa Khel'),
(92, 'Faisalabad'),
(93, 'Faqirwali'),
(94, 'Farooqabad'),
(95, 'Fateh Jang'),
(96, 'Fateh pur'),
(97, 'Feroz walla'),
(98, 'Feroz watan'),
(99, 'Ferozwatowan'),
(100, 'Fiza got'),
(101, 'Fort Abbass'),
(102, 'Gadoon amazai'),
(103, 'Gaggo mandi'),
(104, 'Gakhar mandi'),
(105, 'Gambat'),
(106, 'Gambet'),
(107, 'Garh maharaja'),
(108, 'Garh more'),
(109, 'Garhi yaseen'),
(110, 'Gari habibullah'),
(111, 'Gari mori'),
(112, 'Gharo'),
(113, 'Ghazi'),
(114, 'Ghotki'),
(115, 'Gilgit'),
(116, 'Gohar ghoushti'),
(117, 'Gojar khan'),
(118, 'Gojra'),
(119, 'Goth Machi'),
(120, 'Goular khel'),
(121, 'Guddu'),
(122, 'Gujar Khan'),
(123, 'Gujranwala'),
(124, 'Gujrat'),
(125, 'Gwadar'),
(126, 'Hafizabad'),
(127, 'Hala'),
(128, 'Hangu'),
(129, 'Harappa'),
(130, 'Hari pur'),
(131, 'Hariwala'),
(132, 'Haroonabad'),
(133, 'Hasilpur'),
(134, 'hamza abdal'),
(135, 'Hattar'),
(136, 'Hattian'),
(137, 'Hattian lawrencepur'),
(138, 'Havali Lakhan'),
(139, 'Hawilian'),
(140, 'Hayatabad'),
(141, 'Hazro'),
(142, 'Head marala'),
(143, 'Hub'),
(144, 'Hub-Balochistan'),
(145, 'Hujra Shah Mukeem'),
(146, 'Hunza'),
(147, 'Hyderabad'),
(148, 'Iskandarabad'),
(149, 'Jacobabad'),
(150, 'Jahaniya'),
(151, 'Jaja abasian'),
(152, 'Jalalpur Jattan'),
(153, 'Jalalpur Pirwala'),
(154, 'Jampur'),
(155, 'Jamrud road'),
(156, 'Jamshoro'),
(157, 'Jan pur'),
(158, 'Jand'),
(159, 'Jandanwala'),
(160, 'Jaranwala'),
(161, 'Jatlaan'),
(162, 'Jatoi'),
(163, 'Jauharabad'),
(164, 'Jehangira'),
(165, 'Jehlum'),
(166, 'Jhal Magsi'),
(167, 'Jhand'),
(168, 'Jhang'),
(169, 'Jhatta bhutta'),
(170, 'Jhudo'),
(171, 'Jin Pur'),
(172, 'K.N. Shah'),
(173, 'Kabirwala'),
(174, 'Kacha khooh'),
(175, 'Kahuta'),
(176, 'Kakul'),
(177, 'Kakur town'),
(178, 'Kala bagh'),
(179, 'Kala shah kaku'),
(180, 'Kalaswala'),
(181, 'Kallar Kahar'),
(182, 'Kallar Saddiyian'),
(183, 'Kallur kot'),
(184, 'Kamalia'),
(185, 'Kamalia musa'),
(186, 'Kamber ali khan'),
(187, 'Kameer'),
(188, 'Kamoke'),
(189, 'Kamra'),
(190, 'Kandh kot'),
(191, 'Kandiaro'),
(192, 'Karak'),
(193, 'Karoor pacca'),
(194, 'Karore lalisan'),
(195, 'Kashmir'),
(196, 'Kashmore'),
(197, 'Kasur'),
(198, 'Kazi ahmed'),
(199, 'Khair Pur Mirs'),
(200, 'Khairpur'),
(201, 'Khan Bela'),
(202, 'Khan qah sharif'),
(203, 'Khandabad'),
(204, 'Khanewal'),
(205, 'Khangarh'),
(206, 'Khanqah dogran'),
(207, 'Khanqah sharif'),
(208, 'Kharian'),
(209, 'Khebar'),
(210, 'Khewra'),
(211, 'Khoski'),
(212, 'Khudian Khas'),
(213, 'Khurian wala'),
(214, 'Khurrianwala'),
(215, 'Khushab'),
(216, 'Khushal kot'),
(217, 'Khuzdar'),
(218, 'Klaske'),
(219, 'Kohat'),
(220, 'Kot addu'),
(221, 'Kot bunglow'),
(222, 'Kot ghulam mohd'),
(223, 'Kot mithan'),
(224, 'Kot Momin'),
(225, 'Kot radha kishan'),
(226, 'Kotla'),
(227, 'Kotla arab ali khan'),
(228, 'Kotla jam'),
(229, 'Kotla Pathan'),
(230, 'Kotly Ak'),
(231, 'Kotly Loharana'),
(232, 'Kotri'),
(233, 'Kumbh'),
(234, 'Kundina'),
(235, 'Kunjah'),
(236, 'Kunri'),
(237, 'Laki marwat'),
(238, 'Lala musa'),
(239, 'Lala rukh'),
(240, 'Laliah'),
(241, 'Lalshanra'),
(242, 'Larkana'),
(243, 'Lasbella'),
(244, 'Lawrence pur'),
(245, 'Layya'),
(246, 'Liaqat Pur'),
(247, 'Lodhran'),
(248, 'Lower Dir'),
(249, 'Ludhan'),
(250, 'Madina'),
(251, 'Makli'),
(252, 'Malakand Agency'),
(253, 'Malikwal'),
(254, 'Mamu kunjan'),
(255, 'Mandi bahauddin'),
(256, 'Mandra'),
(257, 'Manga mandi'),
(258, 'Mangal sada'),
(259, 'Mangi'),
(260, 'Mangla'),
(261, 'Mangowal'),
(262, 'Manoabad'),
(263, 'Mansahra'),
(264, 'Mardan'),
(265, 'Mari indus'),
(266, 'Mastoi'),
(267, 'Matli'),
(268, 'Mehar'),
(269, 'Mehmood kot'),
(270, 'Mehrabpur'),
(271, 'Melsi'),
(272, 'Mian Channu'),
(273, 'Mian Wali'),
(274, 'Minchanaabad'),
(275, 'Mingora'),
(276, 'Mir ali'),
(277, 'Miran shah'),
(278, 'Mirpur A.K.'),
(279, 'Mirpur khas'),
(280, 'Mirpur mathelo'),
(281, 'Mithi'),
(282, 'Mitiari'),
(283, 'Mohen jo daro'),
(284, 'More kunda'),
(285, 'Morgah'),
(286, 'Moro'),
(287, 'Mubarik pur'),
(288, 'Multan'),
(289, 'Muridkay'),
(290, 'Murree'),
(291, 'Musafir khana'),
(292, 'Mustung'),
(293, 'Muzaffar Gargh'),
(294, 'Muzaffarabad'),
(295, 'Nankana sahib'),
(296, 'Narang mandi'),
(297, 'Narowal'),
(298, 'Naseerabad'),
(299, 'Naukot'),
(300, 'Naukundi'),
(301, 'Nawabshah'),
(302, 'New saeedabad'),
(303, 'Nilore'),
(304, 'Noor kot'),
(305, 'Nooriabad'),
(306, 'Noorpur nooranga'),
(307, 'Noshero Feroze'),
(308, 'Noudero'),
(309, 'Nowshera'),
(310, 'Nowshera cantt'),
(311, 'Nowshera Virka'),
(312, 'Okara'),
(313, 'Other'),
(314, 'Padidan'),
(315, 'Pak china fertilizer'),
(316, 'Pak pattan sharif'),
(317, 'Panjan kisan'),
(318, 'Panjgoor'),
(319, 'Panno Aqil'),
(320, 'Panu Aqil'),
(321, 'Pasni'),
(322, 'Pasroor'),
(323, 'Pattoki'),
(324, 'Phagwar'),
(325, 'Phalia'),
(326, 'Phool nagar'),
(327, 'Piaro goth'),
(328, 'Pind Dadan Khan'),
(329, 'Pindi Bhattiya'),
(330, 'Pindi bhohri'),
(331, 'Pindi gheb'),
(332, 'Piplan'),
(333, 'Pir mahal'),
(334, 'Pishin'),
(335, 'Qalandarabad'),
(336, 'Qamber Ali Khan'),
(337, 'Qasba gujrat'),
(338, 'Qazi ahmed'),
(339, 'Qila Deedar Singh'),
(340, 'Quaid Abad'),
(341, 'Quetta'),
(342, 'Rabwah'),
(343, 'Rahim Yar Khan'),
(344, 'Rahwali'),
(345, 'Raiwind'),
(346, 'Rajana'),
(347, 'Rajanpur'),
(348, 'Rangoo'),
(349, 'Ranipur'),
(350, 'Rato Dero'),
(351, 'Rawala kot'),
(352, 'Rawat'),
(353, 'Renala khurd'),
(354, 'Risalpur'),
(355, 'Rohri'),
(356, 'Sadiqabad'),
(357, 'Sagri'),
(358, 'Sahiwal'),
(359, 'Saidu sharif'),
(360, 'Sajawal'),
(361, 'Sakhi Sarwar'),
(362, 'Samanabad'),
(363, 'Sambrial'),
(364, 'Samma satta'),
(365, 'Sanghar'),
(366, 'Sanghi'),
(367, 'Sangla Hills'),
(368, 'Sangote'),
(369, 'Sanjarpur'),
(370, 'Sanjwal'),
(371, 'Sara e naurang'),
(372, 'Sara-E-Alamgir'),
(373, 'Sargodha'),
(374, 'Satiayana'),
(375, 'Sawabi'),
(376, 'Sehar baqlas'),
(377, 'Sehwan Sharif'),
(378, 'Sekhat'),
(379, 'Serai alamgir'),
(380, 'Shadiwal'),
(381, 'Shah kot'),
(382, 'Shahdad kot'),
(383, 'Shahdara'),
(384, 'Shahpur chakar'),
(385, 'Shahpur Saddar'),
(386, 'Sheikhupura'),
(387, 'Shakargarh'),
(388, 'Shamsabad'),
(389, 'Shankiari'),
(390, 'Shedani sharif'),
(391, 'Shehdadpur'),
(392, 'Shemier'),
(394, 'Shikar pur'),
(395, 'Shorekot Cantt'),
(396, 'Shorkot'),
(397, 'Shuja Abad'),
(398, 'Sialkot'),
(399, 'Sibi'),
(400, 'Sihala'),
(401, 'Sikandarabad'),
(402, 'Sillanwali'),
(403, 'Sita road'),
(404, 'Skardu'),
(405, 'Skrand'),
(406, 'Sohawa'),
(407, 'Sohawa district daska'),
(408, 'Sukkur'),
(409, 'Sumandari'),
(410, 'Swat'),
(411, 'Swatmingora'),
(412, 'Takhtbai'),
(413, 'Talagang'),
(414, 'Talamba'),
(415, 'Talhur'),
(416, 'Tandiliyawala'),
(417, 'Tando adam'),
(418, 'Tando Allah Yar'),
(419, 'Tando jam'),
(420, 'Tando Muhammad Khan'),
(421, 'Tank'),
(422, 'Tarbela'),
(423, 'Tarmatan'),
(424, 'Tatlay Wali'),
(425, 'Taunsa sharif'),
(426, 'Taxila'),
(427, 'Tharo shah'),
(428, 'Thatta'),
(429, 'Theing jattan more'),
(430, 'Thull'),
(431, 'Tibba sultanpur'),
(432, 'Toba Tek Singh'),
(433, 'Topi'),
(434, 'Toru'),
(435, 'Tranda Muhammad Pannah'),
(436, 'Turbat'),
(437, 'Ubaro'),
(438, 'Ubauro'),
(439, 'Ugoke'),
(440, 'Ukba'),
(441, 'Umer Kot'),
(442, 'Upper deval'),
(443, 'Usta Muhammad'),
(444, 'Vehari'),
(445, 'Village Sunder'),
(446, 'Wah cantt'),
(447, 'Wahi hassain'),
(448, 'Wahn Bachran'),
(449, 'Wan radha ram'),
(450, 'Warah'),
(451, 'Warburton'),
(452, 'Wazirabad'),
(453, 'Yazman mandi'),
(454, 'Zafarwal'),
(455, 'Zahir Peer'),
(456, 'Lahore'),
(457, 'Karachi'),
(458, 'Islamabad'),
(459, 'Rawalpindi'),
(460, 'Peshawar');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_name` text NOT NULL,
  `comp_owner` text NOT NULL,
  `comp_phone` text NOT NULL,
  `comp_email` text NOT NULL,
  `comp_address` text NOT NULL,
  `comp_logo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `comp_name`, `comp_owner`, `comp_phone`, `comp_email`, `comp_address`, `comp_logo`) VALUES
(1, 'HP Accounting Software', 'Hamza Pervaiz', '03494965879', 'hamzapervaiz5@gmail.com', 'Lahore', '');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=200 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Anguilla'),
(7, 'Antigua & Barbuda'),
(8, 'Argentina'),
(9, 'Armenia'),
(10, 'Australia'),
(11, 'Austria'),
(12, 'Azerbaijan'),
(13, 'Bahamas'),
(14, 'Bahrain'),
(15, 'Bangladesh'),
(16, 'Barbados'),
(17, 'Belarus'),
(18, 'Belgium'),
(19, 'Belize'),
(20, 'Benin'),
(21, 'Bermuda'),
(22, 'Bhutan'),
(23, 'Bolivia'),
(24, 'Bosnia & Herzegovina'),
(25, 'Botswana'),
(26, 'Brazil'),
(27, 'Brunei Darussalam'),
(28, 'Bulgaria'),
(29, 'Burkina Faso'),
(30, 'Burundi'),
(31, 'Cambodia'),
(32, 'Cameroon'),
(33, 'Canada'),
(34, 'Cape Verde'),
(35, 'Cayman Islands'),
(36, 'Central African Republic'),
(37, 'Chad'),
(38, 'Chile'),
(39, 'China'),
(40, 'China - Hong Kong / Macau'),
(41, 'Colombia'),
(42, 'Comoros'),
(43, 'Congo'),
(44, 'Congo, Democratic Republic of (DRC)'),
(45, 'Costa Rica'),
(46, 'Croatia'),
(47, 'Cuba'),
(48, 'Cyprus'),
(49, 'Czech Republic'),
(50, 'Denmark'),
(51, 'Djibouti'),
(52, 'Dominica'),
(53, 'Dominican Republic'),
(54, 'Ecuador'),
(55, 'Egypt'),
(56, 'El Salvador'),
(57, 'Equatorial Guinea'),
(58, 'Eritrea'),
(59, 'Estonia'),
(60, 'Ethiopia'),
(61, 'Fiji'),
(62, 'Finland'),
(63, 'France'),
(64, 'French Guiana'),
(65, 'Gabon'),
(66, 'Gambia'),
(67, 'Georgia'),
(68, 'Germany'),
(69, 'Ghana'),
(70, 'Great Britain'),
(71, 'Greece'),
(72, 'Grenada'),
(73, 'Guadeloupe'),
(74, 'Guatemala'),
(75, 'Guinea'),
(76, 'Guinea-Bissau'),
(77, 'Guyana'),
(78, 'Haiti'),
(79, 'Honduras'),
(80, 'Hungary'),
(81, 'Iceland'),
(82, 'India'),
(83, 'Indonesia'),
(84, 'Iran'),
(85, 'Iraq'),
(86, 'Israel and the Occupied Territories'),
(87, 'Italy'),
(88, 'Ivory Coast (Cote d\'Ivoire)'),
(89, 'Jamaica'),
(90, 'Japan'),
(91, 'Jordan'),
(92, 'Kazakhstan'),
(93, 'Kenya'),
(94, 'Korea, Democratic Republic of (North Korea)'),
(95, 'Korea, Republic of (South Korea)'),
(96, 'Kosovo'),
(97, 'Kuwait'),
(98, 'Kyrgyz Republic (Kyrgyzstan)'),
(99, 'Laos'),
(100, 'Latvia'),
(101, 'Lebanon'),
(102, 'Lesotho'),
(103, 'Liberia'),
(104, 'Libya'),
(105, 'Liechtenstein'),
(106, 'Lithuania'),
(107, 'Luxembourg'),
(108, 'Macedonia, Republic of'),
(109, 'Madagascar'),
(110, 'Malawi'),
(111, 'Malaysia'),
(112, 'Maldives'),
(113, 'Mali'),
(114, 'Malta'),
(115, 'Martinique'),
(116, 'Mauritania'),
(117, 'Mauritius'),
(118, 'Mayotte'),
(119, 'Mexico'),
(120, 'Moldova, Republic of'),
(121, 'Monaco'),
(122, 'Mongolia'),
(123, 'Montenegro'),
(124, 'Montserrat'),
(125, 'Morocco'),
(126, 'Mozambique'),
(127, 'Myanmar/Burma'),
(128, 'Namibia'),
(129, 'Nepal'),
(130, 'New Zealand'),
(131, 'Nicaragua'),
(132, 'Niger'),
(133, 'Nigeria'),
(134, 'Norway'),
(135, 'Oman'),
(136, 'Pacific Islands'),
(137, 'Pakistan'),
(138, 'Panama'),
(139, 'Papua New Guinea'),
(140, 'Paraguay'),
(141, 'Peru'),
(142, 'Philippines'),
(143, 'Poland'),
(144, 'Portugal'),
(145, 'Puerto Rico'),
(146, 'Qatar'),
(147, 'Reunion'),
(148, 'Romania'),
(149, 'Russian Federation'),
(150, 'Rwanda'),
(151, 'Saint Kitts and Nevis'),
(152, 'Saint Lucia'),
(153, 'Saint Vincent and the Grenadines'),
(154, 'Samoa'),
(155, 'Sao Tome and Principe'),
(156, 'Saudi Arabia'),
(157, 'Senegal'),
(158, 'Serbia'),
(159, 'Seychelles'),
(160, 'Sierra Leone'),
(161, 'Singapore'),
(162, 'Slovak Republic (Slovakia)'),
(163, 'Slovenia'),
(164, 'Solomon Islands'),
(165, 'Somalia'),
(166, 'South Africa'),
(167, 'South Sudan'),
(168, 'Spain'),
(169, 'Sri Lanka'),
(170, 'Sudan'),
(171, 'Suriname'),
(172, 'Swaziland'),
(173, 'Sweden'),
(174, 'Switzerland'),
(175, 'Syria'),
(176, 'Tajikistan'),
(177, 'Tanzania'),
(178, 'Thailand'),
(179, 'Netherlands'),
(180, 'Timor Leste'),
(181, 'Togo'),
(182, 'Trinidad & Tobago'),
(183, 'Tunisia'),
(184, 'Turkey'),
(185, 'Turkmenistan'),
(186, 'Turks & Caicos Islands'),
(187, 'Uganda'),
(188, 'Ukraine'),
(189, 'United Arab Emirates'),
(190, 'United States of America (USA)'),
(191, 'Uruguay'),
(192, 'Uzbekistan'),
(193, 'Venezuela'),
(194, 'Vietnam'),
(195, 'Virgin Islands (UK)'),
(196, 'Virgin Islands (US)'),
(197, 'Yemen'),
(198, 'Zambia'),
(199, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(40) NOT NULL DEFAULT 'Customers',
  `name` text NOT NULL,
  `mobile` text,
  `company` text,
  `phone` text,
  `email` text,
  `address` text,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `balance` int(11) DEFAULT '0',
  `dated` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=600006 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `typeid`, `type`, `name`, `mobile`, `company`, `phone`, `email`, `address`, `city`, `country`, `balance`, `dated`) VALUES
(600001, 200021, 'Customers', 'Test Customer 1', '123456789', 'ABC Company', '456789123', 'email@abccompany.com', 'Test Address Customer 1', 'Lahore', 'Pakistan', 0, '2018-12-17'),
(600002, 200021, 'Customers', 'Test Customer 2', '123456789', 'XYZ Company', '456789123', 'email@xyzcompany.com', 'Test Address Customer 2', 'Multan', 'Pakistan', 0, '2018-12-17'),
(600003, 200021, 'Customers', 'Test Customer 3', '123456789', 'JKL Company', '456789123', 'email@jklcompany.com', 'Test Address Customer 3', 'Karachi', 'Pakistan', 0, '2018-12-17'),
(600004, 200021, 'Customers', 'Test Customer 4', '123456789', 'MNO Company', '456789123', 'email@mnocompany.com', 'Test Address Customer 4', 'Lahore', 'Pakistan', 0, '2018-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(40) NOT NULL,
  `name` text NOT NULL,
  `desp` text NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '0',
  `pause` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `brand`, `name`, `desp`, `price`, `quantity`, `weight`, `stock`, `pause`) VALUES
(2, '4', 'Product 33', 'Product 33', 0, 0, 780, 0, 0),
(3, '4', 'Product 2', 'Description 2', 0, 0, 250, 0, 0),
(1, '1', 'N/A', 'N/A', 0, 0, 0, 0, 1),
(4, '9', 'Product 46', 'Product 45', 0, 0, 200, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemsb`
--

DROP TABLE IF EXISTS `itemsb`;
CREATE TABLE IF NOT EXISTS `itemsb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemsb`
--

INSERT INTO `itemsb` (`id`, `name`) VALUES
(1, 'None'),
(2, 'Brand 2'),
(4, 'Brand 32'),
(9, 'Brand 46'),
(8, 'Brand 1');

-- --------------------------------------------------------

--
-- Table structure for table `itemslog`
--

DROP TABLE IF EXISTS `itemslog`;
CREATE TABLE IF NOT EXISTS `itemslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `type` varchar(11) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `subtotal` float NOT NULL DEFAULT '0',
  `datec` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

DROP TABLE IF EXISTS `journal`;
CREATE TABLE IF NOT EXISTS `journal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desp` text NOT NULL,
  `dract` int(11) NOT NULL DEFAULT '0',
  `cract` int(11) NOT NULL DEFAULT '0',
  `dr` int(11) NOT NULL DEFAULT '0',
  `cr` int(11) NOT NULL DEFAULT '0',
  `datec` date NOT NULL,
  `dateup` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=205649 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

DROP TABLE IF EXISTS `ledger`;
CREATE TABLE IF NOT EXISTS `ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jid` int(11) NOT NULL,
  `typeid` int(11) NOT NULL DEFAULT '0',
  `actid` int(11) NOT NULL,
  `desp` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `dr` varchar(11) DEFAULT '0',
  `cr` varchar(11) DEFAULT '0',
  `balance` int(11) NOT NULL DEFAULT '0',
  `datec` date NOT NULL,
  `dateup` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=760600 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capital` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `capital`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'hamza56', 'admin990', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(40) NOT NULL DEFAULT 'Vendors',
  `name` text NOT NULL,
  `mobile` text,
  `company` text,
  `phone` text,
  `email` text,
  `address` text,
  `city` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `balance` int(11) DEFAULT '0',
  `dated` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=400006 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `typeid`, `type`, `name`, `mobile`, `company`, `phone`, `email`, `address`, `city`, `country`, `balance`, `dated`) VALUES
(400001, 200022, 'Vendors', 'Test Vendor 1', '123456789', 'ABC Company', '456789123', 'email@abccompany.com', 'Test Address Vendor 1', 'Lahore', 'Pakistan', 0, '2018-12-17'),
(400002, 200022, 'Vendors', 'Test Vendor 2', '123456789', 'XYZ Company', '456789123', 'email@xyzcompany.com', 'Test Address Vendor 2', 'Multan', 'Pakistan', 0, '2018-12-17'),
(400003, 200022, 'Vendors', 'Test Vendor 3', '123456789', 'JKL Company', '456789123', 'email@jklcompany.com', 'Test Address Vendor 3', 'Karachi', 'Pakistan', 0, '2018-12-17'),
(400004, 200022, 'Vendors', 'Test Vendor 4', '123456789', 'MNO Company', '456789123', 'email@mnocompany.com', 'Test Address Vendor 4', 'Lahore', 'Pakistan', 0, '2018-12-17'),
(400005, 200022, 'Vendors', 'HAMZA PERVAIZ', '3204157040', 'Voanpny', '3204157040', 'hamzapervaiz5@gmail.com', 'House # 604, C Block,, Al-Rehman Garden Phase 2,', 'Lahore', 'Pakistan', 0, '2019-01-05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2021 at 08:20 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organ_donation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_email` varchar(128) NOT NULL,
  `admin_contact` varchar(15) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_contact`, `admin_password`) VALUES
(1, 'Umesh Chaudhari', 'admin@gmail.com', '86694604', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(150) NOT NULL,
  `doctor_email` varchar(128) NOT NULL,
  `doctor_contactno` varchar(15) NOT NULL,
  `doctor_password` varchar(50) NOT NULL,
  `doctor_qualification` varchar(100) NOT NULL,
  `organization_name` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_name`, `doctor_email`, `doctor_contactno`, `doctor_password`, `doctor_qualification`, `organization_name`, `address`) VALUES
(1, 'doctor', 'doctor@gmail.com', '123456789', 'doctor', 'BE', 'OYO', 'Pune'),
(5, 'Jeanie Laise', 'jlaise4@hhs.gov', '544-633-4184', 'Xp5vNj1', 'BG', 'Realfire', '17468 Weeping Birch Crossing'),
(6, 'Anderson Reville', 'areville5@nhs.uk', '771-333-9981', 'UtylE8T', 'CN', 'Photolist', '5 Pawling Alley'),
(7, 'Gladi Molloy', 'gmolloy6@edublogs.org', '313-364-2536', '6Bqc8D', 'CN', 'Skippad', '354 Schurz Court'),
(8, 'Maynord Fernan', 'mfernan7@timesonline.co.uk', '559-479-5356', 'hHfE6U', 'PH', 'Edgetag', '9506 5th Way'),
(9, 'Allis Dufton', 'adufton8@spotify.com', '927-363-7631', 'sl2XbV', 'RU', 'Twitterbeat', '05382 Tony Terrace'),
(10, 'Camel Beney', 'cbeney9@springer.com', '427-167-5957', 'gl2TlHXh', 'BR', 'Kare', '14 Pearson Crossing'),
(11, 'Mitch Hinstock', 'mhinstocka@ucsd.edu', '129-402-6891', 'pyvB7Fs', 'PH', 'Vinder', '1 Meadow Valley Lane'),
(12, 'Padraig Perillo', 'pperillob@barnesandnoble.com', '134-545-0212', 'LtuhFTI6UKL2', 'EE', 'Livepath', '996 Dixon Crossing'),
(13, 'Theodoric Hempel', 'thempelc@thetimes.co.uk', '878-990-1167', 'HZD1X2qEIoof', 'CN', 'Eayo', '3158 Donald Crossing'),
(14, 'Rick Laugharne', 'rlaugharned@facebook.com', '257-767-5315', 'sUayGSXwCst', 'CN', 'Twiyo', '62 Heath Crossing'),
(15, 'Conroy Camplen', 'ccamplene@wikispaces.com', '558-992-6552', 'bCkEUdjelqKd', 'KZ', 'Eabox', '375 Lerdahl Court'),
(16, 'Mill Karchowski', 'mkarchowskif@geocities.jp', '203-612-0779', '5oa8GGKnAMRV', 'ID', 'Riffwire', '703 Miller Circle'),
(17, 'Loren Fonzo', 'lfonzog@walmart.com', '398-483-4282', 'lUYKggVFcR', 'JP', 'Shufflebeat', '5 Mcbride Junction'),
(18, 'Derward Roundtree', 'droundtreeh@tuttocitta.it', '430-753-6680', '88uxbH0A', 'GR', 'Buzzshare', '450 Montana Way'),
(19, 'Alane McTeague', 'amcteaguei@harvard.edu', '703-453-7164', 'vzEm3p5', 'US', 'Zoonoodle', '5 Schmedeman Point'),
(20, 'Ajay Coules', 'acoulesj@alexa.com', '530-541-8983', '47qwEfNt', 'US', 'Zoomdog', '3678 Hanover Street'),
(21, 'Cart Perring', 'cperringk@webmd.com', '381-807-7632', '5oX5pX', 'CO', 'Blogpad', '46 Duke Court'),
(22, 'Claudell Jendricke', 'cjendrickel@scientificamerican.com', '634-978-8040', 'Sw4rLPX8FUN', 'CN', 'Realblab', '231 Crownhardt Court'),
(23, 'Eleanora Ferruzzi', 'eferruzzim@irs.gov', '137-610-7894', '8cNgDNTYA', 'GT', 'Meevee', '25 Bultman Way'),
(24, 'Kip Hembling', 'khemblingn@icq.com', '744-684-2233', 'TEJwRcX', 'ID', 'Edgewire', '897 Fairview Terrace'),
(25, 'Norene Pomfret', 'npomfreto@hugedomains.com', '180-969-7920', 'VOd3W7ABEy5t', 'CN', 'Rooxo', '33 Meadow Valley Park'),
(26, 'Kanya Littlefield', 'klittlefieldp@wix.com', '531-150-1671', 'GaZgDF', 'ID', 'Youspan', '0 Laurel Point'),
(27, 'Nessie Wanless', 'nwanlessq@berkeley.edu', '751-680-0442', 'x9r5vo8', 'BR', 'Flashdog', '4 Warner Center'),
(28, 'Liuka Kaemena', 'lkaemenar@printfriendly.com', '698-760-3602', 'rjg2hRfWMoB', 'RS', 'Linklinks', '3 Esker Way'),
(29, 'Suzi Swift', 'sswifts@opensource.org', '791-460-8063', 't2jbTeaLkMI', 'CN', 'Flipopia', '4232 Mandrake Hill'),
(30, 'Timmy Fiddeman', 'tfiddemant@scientificamerican.com', '746-284-5594', 'xW2vYf56r', 'CN', 'Feednation', '0 Maple Point'),
(31, 'Jennifer Ovesen', 'jovesenu@bloglines.com', '154-231-8062', 'Z5xHp6P', 'CN', 'Vinte', '7923 Graceland Court'),
(32, 'My Lewnden', 'mlewndenv@amazon.co.uk', '409-792-3617', 'xgLqaKlQCM3', 'AR', 'Flashdog', '01799 Sunfield Trail'),
(33, 'Merci Watkins', 'mwatkinsw@reference.com', '911-554-3603', 'JoYznOjqJKb7', 'RU', 'InnoZ', '20205 Lakewood Gardens Hill'),
(34, 'Cliff Suttaby', 'csuttabyx@wordpress.com', '946-393-2487', 'IP88fy94', 'LV', 'Photobug', '86 Erie Lane'),
(35, 'Ginelle Eskrigge', 'geskriggey@hao123.com', '540-783-9462', '0kSNTe', 'PK', 'Nlounge', '1666 Valley Edge Plaza'),
(36, 'Fanni Shemming', 'fshemmingz@jugem.jp', '865-124-7582', 'exhQhcl8uBEm', 'FR', 'Feedfish', '2 Barnett Road'),
(37, 'Maura Garrard', 'mgarrard10@state.gov', '392-692-6835', 'QxhgK9ZNQJ', 'CN', 'Bluejam', '028 Namekagon Plaza'),
(38, 'Anabal Rafter', 'arafter11@live.com', '274-800-4990', 'KVHyijV9ub', 'CZ', 'Wikido', '6 Gina Parkway'),
(39, 'Orren Manhare', 'omanhare12@arizona.edu', '704-662-9246', 'zpY4L6qDoq', 'FR', 'Yata', '6018 Michigan Parkway'),
(40, 'Garwood Mackerel', 'gmackerel13@tripod.com', '833-308-6119', 'DPBiHRFRU', 'ID', 'Brainsphere', '776 Washington Plaza'),
(41, 'Valaria Guy', 'vguy14@archive.org', '979-894-0258', 'Hr5hEB2WV8m', 'RU', 'Livefish', '11098 Victoria Way'),
(42, 'Murdoch Boult', 'mboult15@redcross.org', '223-279-6059', 'velQyUy', 'MA', 'Photospace', '8022 5th Pass'),
(43, 'Lindsay Wardhaugh', 'lwardhaugh16@ustream.tv', '105-674-8371', 'qnVxpdsw', 'CL', 'Wordtune', '45931 Westerfield Center'),
(44, 'Marijo Anscombe', 'manscombe17@icio.us', '945-690-1921', 'fSXqlU', 'KR', 'Kwimbee', '097 Artisan Place'),
(45, 'Tabatha Edess', 'tedess18@statcounter.com', '133-521-5704', '8JONNNh', 'CN', 'Flashdog', '8552 Porter Terrace'),
(46, 'Wren Clardge', 'wclardge19@cornell.edu', '806-565-6085', 'TdhhsCjf', 'ID', 'Flashspan', '29940 Park Meadow Avenue'),
(47, 'Rhett Roisen', 'rroisen1a@flavors.me', '990-134-0586', '0w0R0xv', 'MY', 'Pixonyx', '4288 Chive Drive'),
(48, 'Analiese Launder', 'alaunder1b@fastcompany.com', '244-518-8088', 'Tz5QgrQhYp', 'ID', 'Abatz', '8 Waxwing Pass'),
(49, 'Cordi Puddicombe', 'cpuddicombe1c@blogtalkradio.com', '904-654-6791', 'xfykCCx', 'UZ', 'Meembee', '80286 Hayes Hill'),
(50, 'Imojean Postans', 'ipostans1d@simplemachines.org', '391-311-5805', 'QNW4FRNR', 'RU', 'Talane', '859 Sachtjen Plaza'),
(51, 'Lizbeth Benettini', 'lbenettini1e@prnewswire.com', '775-184-5245', 'pUWWxdRsjn', 'ID', 'Oodoo', '315 3rd Park'),
(52, 'Rhodie Chapelhow', 'rchapelhow1f@cbsnews.com', '879-864-5005', 'CqUZ3jnaGH8k', 'CA', 'Camido', '2978 Clove Road'),
(53, 'Louis Tipler', 'ltipler1g@artisteer.com', '490-810-1592', 'pIkWehnlta', 'HN', 'Tagtune', '73701 Mandrake Avenue'),
(54, 'Hanan Esbrook', 'hesbrook1h@meetup.com', '813-440-1595', 'fY19uydVo', 'US', 'Brightdog', '53 Elgar Point'),
(55, 'Loralyn Dibden', 'ldibden1i@yandex.ru', '562-343-5021', 'mjYe3J', 'PH', 'Skipstorm', '59560 Eastlawn Court'),
(56, 'Sabine Rawcliff', 'srawcliff1j@engadget.com', '154-629-1204', 'yvzVBbg', 'CN', 'Gigazoom', '6 Kedzie Pass'),
(57, 'Rickie Ingman', 'ringman1k@nymag.com', '983-210-6425', 'oyx7CAjd', 'PH', 'Jabbercube', '8138 Scoville Alley'),
(58, 'Rosalinde Bidewell', 'rbidewell1l@ning.com', '381-551-0190', 'CNYdWQU1r', 'UA', 'Skippad', '638 Canary Crossing'),
(59, 'Krisha Vallentin', 'kvallentin1m@bbc.co.uk', '120-502-1463', '3xKtqEp', 'AR', 'Wikizz', '3 Mosinee Street'),
(60, 'Rheba Booij', 'rbooij1n@biglobe.ne.jp', '255-564-2046', 'kN3cCHKkO', 'BR', 'Thoughtmix', '32 Red Cloud Center'),
(61, 'Robbyn Greenlees', 'rgreenlees1o@flavors.me', '975-924-3945', '3RKQH0UIGy', 'GN', 'Blognation', '99 Manufacturers Parkway'),
(62, 'Marje Ladd', 'mladd1p@alexa.com', '650-638-0848', '2y5ZP8YAIM', 'VN', 'Agimba', '8922 Meadow Valley Place'),
(63, 'Haley McGeaney', 'hmcgeaney1q@opensource.org', '156-204-7730', 'JBZgWdb0DCZE', 'PE', 'Skinder', '24 Tennessee Center'),
(64, 'Callida Jacobovitch', 'cjacobovitch1r@gov.uk', '550-168-3720', 'lvKMQHAc10KO', 'CN', 'Feednation', '0 North Pass'),
(65, 'Niles Dopson', 'ndopson1s@biblegateway.com', '565-483-1762', 'vYK7gBT', 'ID', 'Jabberstorm', '25 Jenna Trail'),
(66, 'Egbert Kellegher', 'ekellegher1t@hugedomains.com', '809-461-7509', 'hcTigaNi', 'CN', 'Feedbug', '0 Maple Trail'),
(67, 'Korney Natt', 'knatt1u@foxnews.com', '514-605-8859', 'w0ufzgJ', 'GT', 'Mymm', '51 Tony Parkway'),
(68, 'Nettle Steer', 'nsteer1v@yale.edu', '798-544-7268', 'VyGn1RibQwkI', 'BR', 'Buzzshare', '28 Sheridan Way'),
(69, 'Tab Hyndson', 'thyndson1w@google.es', '664-230-0301', '3e1BY47', 'CO', 'Dabtype', '5 Prentice Park'),
(70, 'Bliss Kubec', 'bkubec1x@elegantthemes.com', '335-805-7777', 'w6Cn4G', 'CM', 'Mynte', '4 Debra Terrace'),
(71, 'Deedee Bardell', 'dbardell1y@cloudflare.com', '810-346-8291', 'fhJlYSH', 'CA', 'Tagfeed', '4854 Charing Cross Junction'),
(72, 'Cindra Westmoreland', 'cwestmoreland1z@fotki.com', '219-274-9471', 'V7jakY', 'PK', 'Oyondu', '48650 Reindahl Street'),
(73, 'Luke Rosenbarg', 'lrosenbarg20@hubpages.com', '495-356-2414', 'hAszKH', 'TH', 'Tagfeed', '1 Hazelcrest Trail'),
(74, 'Marrissa Hubane', 'mhubane21@economist.com', '932-445-5450', 'BxPCUG0r6', 'UG', 'Vinder', '37 Meadow Ridge Terrace'),
(75, 'Odele Halloway', 'ohalloway22@adobe.com', '173-118-9358', 'c161fU', 'NO', 'Thoughtmix', '6 Waubesa Way'),
(76, 'Keriann Hucker', 'khucker23@imgur.com', '478-888-5786', 'IYCBkFii', 'ID', 'Livetube', '532 Onsgard Place'),
(77, 'Pooh Houchen', 'phouchen24@imageshack.us', '784-912-2969', 'hhuwDo', 'RU', 'Buzzshare', '90 Florence Terrace'),
(78, 'Hanson Schultheiss', 'hschultheiss25@alexa.com', '536-939-6560', '68qIlcj', 'PH', 'Twitterbridge', '7 Kennedy Drive'),
(79, 'Harlie Kleint', 'hkleint26@amazon.de', '258-635-8544', 'XgmqaGFFIvc4', 'ID', 'Browsetype', '8816 Westridge Pass'),
(80, 'Agnes Thorneley', 'athorneley27@oaic.gov.au', '177-795-0334', 'V4JPi25NVlnF', 'CN', 'Layo', '45 Sage Pass'),
(81, 'Mavis Cottingham', 'mcottingham28@cbc.ca', '729-913-5556', '6ItRInu', 'VN', 'Thoughtstorm', '842 Sunfield Trail'),
(82, 'Hi Bassingden', 'hbassingden29@buzzfeed.com', '802-581-3513', 'JlSMhFj', 'ID', 'Trupe', '98721 Steensland Circle'),
(83, 'Donall Mattioli', 'dmattioli2a@businessweek.com', '414-589-0604', 'VOeDowDcq', 'US', 'Layo', '3614 Pawling Place'),
(84, 'Rivi Records', 'rrecords2b@moonfruit.com', '125-789-7592', 'Obv1Y7qha', 'FR', 'Ntags', '6 Scofield Road'),
(85, 'Kristo Kinnach', 'kkinnach2c@boston.com', '656-648-8929', 'Vp8lJ4lS', 'ID', 'Twitterworks', '7733 Hanson Hill'),
(86, 'Victor Vasyatkin', 'vvasyatkin2d@indiegogo.com', '973-887-2881', '8qTlVeb4geZ', 'CN', 'Demimbu', '9230 Buhler Terrace'),
(87, 'Jennie Orrock', 'jorrock2e@live.com', '358-635-7304', 'IdIIwjgoJz', 'AR', 'Blognation', '87853 Fieldstone Terrace'),
(88, 'Lamont Wyness', 'lwyness2f@blogspot.com', '841-237-1682', 'QpmZKQs6ll0l', 'IR', 'Fadeo', '0 Forest Dale Court'),
(89, 'Paolina Glassup', 'pglassup2g@cdc.gov', '326-191-6004', 'stKGHlx', 'PL', 'Flipopia', '9963 Welch Pass'),
(90, 'Gay Levington', 'glevington2h@twitter.com', '210-727-8263', 'lScrNH', 'CN', 'Browseblab', '5828 Sutherland Street'),
(91, 'Griz Punyer', 'gpunyer2i@photobucket.com', '902-171-2437', '4fbR2PM', 'ZA', 'Yoveo', '22631 Northfield Trail'),
(92, 'Honoria Snodin', 'hsnodin2j@paypal.com', '615-925-5940', 'cAWxrs', 'MX', 'Centimia', '33146 Stang Point'),
(93, 'Gilbertina Ricciardelli', 'gricciardelli2k@cpanel.net', '976-988-7407', 'cDaKo1', 'CN', 'Centizu', '457 Mallard Pass'),
(94, 'Anitra Doreward', 'adoreward2l@flickr.com', '924-242-6175', 'ns60I6', 'CN', 'Twinte', '28539 Elgar Court'),
(95, 'Maximilian Lindborg', 'mlindborg2m@dagondesign.com', '308-463-7359', 'nc3cemQSTtP', 'CN', 'Skinte', '810 American Junction'),
(96, 'Ezequiel Plascott', 'eplascott2n@soundcloud.com', '188-955-5998', 'q7vlBKsNlv', 'CN', 'Blogpad', '943 Blackbird Hill'),
(97, 'Gabey Pigny', 'gpigny2o@elpais.com', '875-761-3141', 'AIJe5fbQV42', 'SI', 'Quaxo', '83 Loftsgordon Circle'),
(98, 'Raynell Towsie', 'rtowsie2p@yellowbook.com', '272-367-1437', 'kGA8XQk', 'NG', 'Livefish', '66708 Marquette Junction'),
(99, 'Malvin McVittie', 'mmcvittie2q@weebly.com', '437-375-8869', 'pBRWBPasVl', 'WS', 'Kwilith', '12398 American Ash Place'),
(100, 'Shana Kitcat', 'skitcat2r@delicious.com', '173-422-3430', 'qRgg2pWvFX', 'CN', 'Meedoo', '771 Annamark Park'),
(102, 'Umesh', 'umesh@gmail.com', '2233556699', '123', 'BE', 'ANI AK', 'pune');

-- --------------------------------------------------------

--
-- Table structure for table `donar`
--

CREATE TABLE `donar` (
  `donar_id` int(11) NOT NULL,
  `donar_name` varchar(150) NOT NULL,
  `donar_email` varchar(128) NOT NULL,
  `donar_contactno` varchar(15) NOT NULL,
  `donar_dob` date NOT NULL,
  `donar_address` text NOT NULL,
  `organ_id` int(50) NOT NULL,
  `process_status` varchar(15) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donar`
--

INSERT INTO `donar` (`donar_id`, `donar_name`, `donar_email`, `donar_contactno`, `donar_dob`, `donar_address`, `organ_id`, `process_status`) VALUES
(1, 'Denny Osmondu', 'dosmond0@multiply.com', '187-923-9526', '0000-00-00', '89721 Lake View Courtju', 1, 'REJECTED'),
(2, 'Nedi Diprose', 'ndiprose1@harvard.edu', '729-751-2398', '0000-00-00', '5475 Mendota Pass', 2, 'PENDING'),
(3, 'Marietta Lockyer', 'mlockyer2@google.cn', '464-234-4087', '0000-00-00', '9 Sunnyside Pass', 3, 'SUCCESS'),
(4, 'Meggie McShee', 'mmcshee3@springer.com', '907-701-8269', '0000-00-00', '5587 Spohn Park', 4, 'PENDING'),
(5, 'Miller Harden', 'mharden4@forbes.com', '886-825-5583', '0000-00-00', '2 Jana Plaza', 5, 'SUCCESS'),
(6, 'Ailene Tiptaft', 'atiptaft5@zimbio.com', '186-244-9532', '0000-00-00', '10965 Delladonna Alley', 1, 'PENDING'),
(7, 'Vitoria Gorler', 'vgorler6@ca.gov', '362-921-9178', '0000-00-00', '16 Maryland Drive', 2, 'SCHEDULE'),
(8, 'Kincaid Sommersett', 'ksommersett7@yellowbook.com', '623-857-2957', '0000-00-00', '14 Cardinal Plaza', 3, 'PENDING'),
(9, 'Gertrude Scoffham', 'gscoffham8@linkedin.com', '467-877-4008', '0000-00-00', '221 David Hill', 4, 'PENDING'),
(10, 'Etta McClary', 'emcclary9@amazon.de', '577-620-0682', '0000-00-00', '16139 Rowland Court', 5, 'PENDING'),
(11, 'Karly Gullan', 'kgullana@hud.gov', '921-803-9716', '0000-00-00', '83 Autumn Leaf Hill', 1, 'SCHEDULE'),
(12, 'Hamnet Dumingos', 'hdumingosb@aol.com', '305-339-7055', '0000-00-00', '97573 Porter Parkway', 2, 'PENDING'),
(13, 'Shanan Rickesies', 'srickesiesc@mtv.com', '933-150-2970', '0000-00-00', '2 Northport Drive', 3, 'SUCCESS'),
(14, 'Ferd Dincey', 'fdinceyd@apple.com', '578-461-8823', '0000-00-00', '46 Northview Park', 4, 'PENDING'),
(15, 'Faye Dallaway', 'fdallawaye@cafepress.com', '557-520-0131', '0000-00-00', '24 Merrick Alley', 5, 'PENDING'),
(16, 'Ailbert Ping', 'apingf@noaa.gov', '341-580-5517', '0000-00-00', '4 Gateway Point', 1, 'SUCCESS'),
(17, 'Reinald Levicount', 'rlevicountg@engadget.com', '705-304-8292', '0000-00-00', '5922 Ilene Park', 2, 'PENDING'),
(18, 'Trixi Siviour', 'tsiviourh@ed.gov', '608-171-4248', '0000-00-00', '398 1st Avenue', 3, 'SCHEDULE'),
(19, 'Vernen Hanscom', 'vhanscomi@scientificamerican.com', '191-535-0181', '0000-00-00', '3112 Sutherland Crossing', 4, 'SCHEDULE'),
(20, 'Georgie Hernik', 'ghernikj@icq.com', '383-176-7198', '0000-00-00', '7369 Brown Alley', 1, 'PENDING'),
(21, 'Sibylle Daintrey', 'sdaintreyk@unicef.org', '971-842-2681', '0000-00-00', '44498 Maryland Way', 2, 'SUCCESS'),
(22, 'Kelsey Douglass', 'kdouglassl@npr.org', '922-436-2557', '0000-00-00', '1079 Mayfield Pass', 3, 'PENDING'),
(23, 'Lorettalorna Jaye', 'ljayem@ft.com', '638-529-9611', '0000-00-00', '45326 Truax Place', 4, 'PENDING'),
(24, 'Estelle Gusticke', 'egusticken@a8.net', '571-769-0284', '0000-00-00', '24 Anderson Park', 5, 'PENDING'),
(25, 'Tony Leyborne', 'tleyborneo@psu.edu', '288-590-6824', '0000-00-00', '2728 Mallard Road', 1, 'SUCCESS'),
(26, 'Richie Novik', 'rnovikp@wordpress.org', '667-670-3422', '0000-00-00', '16944 Pawling Place', 2, 'PENDING'),
(27, 'Mirella Pinkard', 'mpinkardq@desdev.cn', '704-709-8820', '0000-00-00', '835 Heath Drive', 3, 'PENDING'),
(28, 'Jennifer Willis', 'jwillisr@reference.com', '994-868-4857', '0000-00-00', '274 Shopko Hill', 4, 'SCHEDULE'),
(29, 'Ashlee Stride', 'astrides@blogger.com', '315-345-6550', '0000-00-00', '75714 Schmedeman Place', 5, 'PENDING'),
(30, 'Myra Thorwarth', 'mthorwartht@usgs.gov', '250-366-5979', '0000-00-00', '91786 Arkansas Court', 1, 'PENDING'),
(31, 'Lovell Ohlsen', 'lohlsenu@intel.com', '191-323-4280', '0000-00-00', '0700 Acker Plaza', 2, 'SCHEDULE'),
(32, 'Trista Clegg', 'tcleggv@go.com', '367-558-8138', '0000-00-00', '4 Little Fleur Plaza', 3, 'PENDING'),
(33, 'Carmon Venables', 'cvenablesw@printfriendly.com', '249-491-9639', '0000-00-00', '96 Mayfield Point', 4, 'SUCCESS'),
(34, 'Cybil Dradey', 'cdradeyx@newyorker.com', '917-552-5456', '0000-00-00', '797 Paget Road', 5, 'PENDING'),
(35, 'Fidelity Scales', 'fscalesy@cloudflare.com', '818-426-9949', '0000-00-00', '27 Granby Point', 1, 'PENDING'),
(36, 'Berke Dimblebee', 'bdimblebeez@free.fr', '455-842-7162', '0000-00-00', '62 Talmadge Place', 2, 'SUCCESS'),
(37, 'Ernaline Balchin', 'ebalchin10@live.com', '811-529-8510', '0000-00-00', '238 Rieder Hill', 3, 'PENDING'),
(38, 'Renee Bastick', 'rbastick11@spotify.com', '704-320-3251', '0000-00-00', '10502 Texas Terrace', 4, 'SUCCESS'),
(39, 'Simonette Coale', 'scoale12@timesonline.co.uk', '731-830-3365', '0000-00-00', '57410 Melody Road', 5, 'PENDING'),
(40, 'Gustavo Cogdon', 'gcogdon13@symantec.com', '578-912-7905', '0000-00-00', '76 David Place', 1, 'PENDING'),
(41, 'Yurik Goutcher', 'ygoutcher14@home.pl', '572-479-1437', '0000-00-00', '008 Lyons Terrace', 2, 'PENDING'),
(42, 'Yulma Eilhertsen', 'yeilhertsen15@netvibes.com', '241-470-6911', '0000-00-00', '8459 Riverside Avenue', 3, 'SUCCESS'),
(43, 'Thedrick Ritchie', 'tritchie16@intel.com', '691-800-6520', '0000-00-00', '18802 Barby Lane', 4, 'PENDING'),
(44, 'Odelle Woodeson', 'owoodeson17@friendfeed.com', '467-204-9388', '0000-00-00', '03 Bowman Parkway', 5, 'PENDING'),
(45, 'Ferris Capeloff', 'fcapeloff18@typepad.com', '606-846-8003', '0000-00-00', '56 Dwight Street', 1, 'PENDING'),
(46, 'Silva Chatan', 'schatan19@microsoft.com', '638-113-0926', '0000-00-00', '796 Northridge Way', 2, 'PENDING'),
(47, 'Matthieu Nestor', 'mnestor1a@seattletimes.com', '421-324-1920', '0000-00-00', '1802 Trailsway Road', 3, 'SCHEDULE'),
(48, 'Mischa Moiser', 'mmoiser1b@deliciousdays.com', '857-423-6168', '0000-00-00', '65 American Ash Circle', 4, 'PENDING'),
(49, 'Amabelle Tousey', 'atousey1c@blogs.com', '688-727-8926', '0000-00-00', '1537 Maple Wood Lane', 5, 'SCHEDULE'),
(50, 'Kellie Mumbeson', 'kmumbeson1d@myspace.com', '353-468-4166', '0000-00-00', '80 Ilene Parkway', 1, 'PENDING'),
(51, 'Jannelle Churchard', 'jchurchard1e@hubpages.com', '702-718-9840', '0000-00-00', '7 High Crossing Center', 2, 'PENDING'),
(52, 'Cammy Pexton', 'cpexton1f@a8.net', '261-559-1459', '0000-00-00', '209 Fieldstone Drive', 3, 'SCHEDULE'),
(53, 'Marten Fullom', 'mfullom1g@booking.com', '974-945-6121', '0000-00-00', '583 Kedzie Crossing', 4, 'PENDING'),
(54, 'Carrol Bremen', 'cbremen1h@networkadvertising.org', '317-417-2388', '0000-00-00', '6754 Crowley Hill', 5, 'PENDING'),
(55, 'Gavin Philot', 'gphilot1i@goo.gl', '794-228-9816', '0000-00-00', '069 Tennessee Point', 1, 'PENDING'),
(56, 'Marion Deniseau', 'mdeniseau1j@zdnet.com', '990-246-3960', '0000-00-00', '32 Armistice Avenue', 2, 'PENDING'),
(57, 'Gris Robinet', 'grobinet1k@state.tx.us', '618-577-9001', '0000-00-00', '719 Caliangt Junction', 3, 'PENDING'),
(58, 'Yolane Baudino', 'ybaudino1l@yelp.com', '360-190-5680', '0000-00-00', '4541 Ridgeview Trail', 4, 'SUCCESS'),
(59, 'Wainwright Meegin', 'wmeegin1m@a8.net', '943-334-7580', '0000-00-00', '7 Ryan Terrace', 5, 'PENDING'),
(60, 'Carlye Wallsworth', 'cwallsworth1n@skyrock.com', '591-836-9517', '0000-00-00', '40 Shasta Point', 1, 'PENDING'),
(61, 'Ambur Mariotte', 'amariotte1o@nba.com', '125-245-6325', '0000-00-00', '19 Victoria Place', 2, 'PENDING'),
(62, 'Charlene Mawne', 'cmawne1p@bbb.org', '106-894-0265', '0000-00-00', '26 Vidon Court', 3, 'PENDING'),
(63, 'Kristel Zack', 'kzack1q@uiuc.edu', '498-557-9371', '0000-00-00', '1 Center Way', 4, 'PENDING'),
(64, 'Worden Shade', 'wshade1r@seattletimes.com', '980-429-6676', '0000-00-00', '699 Canary Parkway', 5, 'PENDING'),
(65, 'Nixie Blasoni', 'nblasoni1s@harvard.edu', '319-616-3440', '0000-00-00', '320 Lerdahl Parkway', 1, 'PENDING'),
(66, 'Jacob Jiracek', 'jjiracek1t@netscape.com', '251-528-5504', '0000-00-00', '11 Village Crossing', 2, 'PENDING'),
(67, 'Rupert Prendergrast', 'rprendergrast1u@virginia.edu', '185-160-1366', '0000-00-00', '91 Lake View Parkway', 3, 'PENDING'),
(68, 'Libbie Lammerding', 'llammerding1v@about.me', '598-512-3081', '0000-00-00', '8970 Armistice Road', 4, 'PENDING'),
(69, 'Maribel Banishevitz', 'mbanishevitz1w@jugem.jp', '855-830-2035', '0000-00-00', '3093 Waxwing Lane', 5, 'PENDING'),
(70, 'Carmelita Urion', 'curion1x@blogs.com', '907-954-2470', '0000-00-00', '71 Elmside Point', 1, 'PENDING'),
(71, 'Nita Stansall', 'nstansall1y@51.la', '831-945-2629', '0000-00-00', '6740 Center Place', 2, 'PENDING'),
(72, 'Juli Cunningham', 'jcunningham1z@cnbc.com', '395-215-7472', '0000-00-00', '4 Bayside Court', 3, 'PENDING'),
(73, 'Fara Dowthwaite', 'fdowthwaite20@fc2.com', '503-118-0475', '0000-00-00', '91856 Bobwhite Hill', 4, 'SCHEDULE'),
(74, 'Yehudit Millin', 'ymillin21@cmu.edu', '199-661-9982', '0000-00-00', '8706 Main Street', 5, 'PENDING'),
(75, 'Myles Waywell', 'mwaywell22@geocities.jp', '613-542-2822', '0000-00-00', '75 Saint Paul Junction', 1, 'PENDING'),
(76, 'Rana Milthorpe', 'rmilthorpe23@yolasite.com', '400-315-2012', '0000-00-00', '17 Cherokee Terrace', 2, 'PENDING'),
(77, 'Vasilis Nodin', 'vnodin24@ycombinator.com', '739-398-1751', '0000-00-00', '2441 Bartelt Lane', 3, 'PENDING'),
(78, 'Catrina Mulleary', 'cmulleary25@skype.com', '872-966-2100', '0000-00-00', '6432 Mayfield Alley', 4, 'PENDING'),
(79, 'Winslow Vasenkov', 'wvasenkov26@aol.com', '149-292-4563', '0000-00-00', '71566 7th Road', 5, 'PENDING'),
(80, 'Helyn Ruddlesden', 'hruddlesden27@51.la', '644-246-5097', '0000-00-00', '35 Calypso Lane', 1, 'PENDING'),
(81, 'Maddy Knowles', 'mknowles28@house.gov', '623-339-0965', '0000-00-00', '4345 Claremont Pass', 2, 'PENDING'),
(82, 'Blinnie Celand', 'bceland29@senate.gov', '948-515-2602', '0000-00-00', '15 International Street', 3, 'PENDING'),
(83, 'Cheslie Dugald', 'cdugald2a@ocn.ne.jp', '121-612-2457', '0000-00-00', '63 Bluejay Avenue', 4, 'PENDING'),
(84, 'Natalee Barnet', 'nbarnet2b@tinyurl.com', '388-749-5927', '0000-00-00', '9 Oxford Lane', 5, 'SCHEDULE'),
(85, 'Carlina Braemer', 'cbraemer2c@shutterfly.com', '843-552-7910', '0000-00-00', '242 Independence Circle', 1, 'PENDING'),
(86, 'Delores Iorio', 'diorio2d@istockphoto.com', '791-691-3554', '0000-00-00', '504 Carioca Road', 2, 'PENDING'),
(87, 'Kermit Lesper', 'klesper2e@skype.com', '290-681-6539', '0000-00-00', '875 Dapin Street', 3, 'PENDING'),
(88, 'North Lathy', 'nlathy2f@rediff.com', '176-574-7228', '0000-00-00', '41575 Hermina Place', 4, 'PENDING'),
(89, 'Mort Pert', 'mpert2g@wikia.com', '106-370-7610', '0000-00-00', '198 Loeprich Alley', 5, 'SCHEDULE'),
(90, 'Tudor Keays', 'tkeays2h@webnode.com', '531-883-8511', '0000-00-00', '9 Waywood Avenue', 1, 'PENDING'),
(91, 'Edwin Gresswell', 'egresswell2i@unicef.org', '339-571-2686', '0000-00-00', '768 Weeping Birch Terrace', 2, 'PENDING'),
(92, 'Imogene Finlaison', 'ifinlaison2j@house.gov', '817-591-0728', '0000-00-00', '3850 Kipling Circle', 3, 'PENDING'),
(93, 'Jeremie Redman', 'jredman2k@answers.com', '542-995-6094', '0000-00-00', '2184 Swallow Parkway', 4, 'PENDING'),
(94, 'Zerk Dellatorre', 'zdellatorre2l@dailymail.co.uk', '782-488-8327', '0000-00-00', '0727 Knutson Pass', 5, 'PENDING'),
(95, 'Effie Ormond', 'eormond2m@redcross.org', '161-674-0722', '0000-00-00', '892 Bartillon Point', 1, 'PENDING'),
(96, 'Erhart Klossmann', 'eklossmann2n@theguardian.com', '347-432-1627', '0000-00-00', '6057 Merry Crossing', 2, 'PENDING'),
(97, 'Culley Tregent', 'ctregent2o@usnews.com', '415-122-8403', '0000-00-00', '31 Old Gate Court', 3, 'SUCCESS'),
(98, 'Chrissie Foreman', 'cforeman2p@ycombinator.com', '359-282-0750', '0000-00-00', '3 Jenifer Court', 4, 'PENDING'),
(116, 'donar', 'admin@gmail.com', '789456', '2021-11-26', 'kj', 3, 'PENDING'),
(117, 'donar', 'admin@gmail.com', '7894561230', '2021-11-20', 'kjh', 2, 'PENDING'),
(118, 'donar', 'admin@gmail.com', '7894561230', '2021-11-20', 'kjh', 2, 'PENDING'),
(119, 'donar', 'admin@gmail.com', '7894561230', '2021-11-20', 'kjh', 2, 'PENDING'),
(120, 'donar', 'admin@gmail.com', '789456', '2021-11-05', 'jhg', 1, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `donar_appointment`
--

CREATE TABLE `donar_appointment` (
  `da_id` int(11) NOT NULL,
  `donar_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `da_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donar_appointment`
--

INSERT INTO `donar_appointment` (`da_id`, `donar_id`, `doctor_id`, `da_date`) VALUES
(1, 1, 1, '2021-11-04'),
(2, 3, 1, '2021-11-17'),
(3, 5, 1, '2021-11-28'),
(4, 13, 1, '2021-11-12'),
(5, 7, 1, '2021-11-03'),
(6, 25, 1, '2021-11-11'),
(7, 18, 1, '2021-11-11'),
(8, 38, 1, '2021-11-24'),
(9, 49, 1, '2021-11-10'),
(10, 33, 1, '2021-11-10'),
(11, 42, 1, '2021-11-04'),
(12, 58, 1, '2021-11-10'),
(13, 84, 1, '2021-11-03'),
(14, 97, 1, '2021-11-23'),
(15, 89, 1, '2021-11-10'),
(16, 21, 1, '2021-11-03'),
(17, 73, 1, '2021-11-19'),
(18, 16, 1, '2021-11-17'),
(19, 19, 1, '2021-11-11'),
(20, 28, 1, '2021-11-03'),
(21, 52, 1, '2021-11-05'),
(22, 47, 1, '2021-11-03'),
(23, 36, 1, '2021-11-19'),
(24, 11, 1, '2021-11-11'),
(25, 31, 1, '2021-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `organ`
--

CREATE TABLE `organ` (
  `organ_id` int(11) NOT NULL,
  `organ_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organ`
--

INSERT INTO `organ` (`organ_id`, `organ_name`) VALUES
(1, 'Brain'),
(2, 'Lungs'),
(3, 'Liver'),
(4, 'Kidneys'),
(5, 'Heart');

-- --------------------------------------------------------

--
-- Table structure for table `organ_transaction`
--

CREATE TABLE `organ_transaction` (
  `ot_id` int(11) NOT NULL,
  `donar_id` int(11) NOT NULL,
  `recipient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organ_transaction`
--

INSERT INTO `organ_transaction` (`ot_id`, `donar_id`, `recipient_id`) VALUES
(1, 13, 126),
(2, 33, 127),
(3, 97, 128),
(4, 38, 129),
(6, 58, 130),
(7, 21, 0),
(11, 16, 0),
(12, 36, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `recipient_id` int(11) NOT NULL,
  `recipient_name` varchar(150) NOT NULL,
  `recipient_email` varchar(128) NOT NULL,
  `recipient_contactno` varchar(15) NOT NULL,
  `recipient_dob` date NOT NULL,
  `recipient_address` text NOT NULL,
  `organ_id` int(50) NOT NULL,
  `process_status` varchar(15) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipient`
--

INSERT INTO `recipient` (`recipient_id`, `recipient_name`, `recipient_email`, `recipient_contactno`, `recipient_dob`, `recipient_address`, `organ_id`, `process_status`) VALUES
(0, '', '', '', '0000-00-00', '', 1, ''),
(125, 'umesh', 'umesh@gmail.com', '4561230', '2021-11-18', 'MKU', 1, 'SUCCESS'),
(126, 'Amol', 'amol@gmail.com', '789456123', '2021-11-17', 'Pune', 3, 'PENDING'),
(127, 'Rahul', 'rahul@gmail.com', '7894563210', '2021-11-10', 'iuyt', 4, 'SUCCESS'),
(128, 'Ankur', 'ak@gmail.com', '789456', '2021-11-15', 'Maki', 3, 'REJECTED'),
(129, 'Anmol', 'anmol@gmail.com', '78899456130', '2021-11-25', 'Mku', 4, 'REJECTED'),
(130, 'ak Mk', 'ak@gmail.com', '4561230', '2021-11-17', 'MNU', 4, 'PENDING'),
(131, 'MNK', 'mnk@gmail.com', '122589634', '2021-11-18', 'MKL', 2, 'SUCCESS');

-- --------------------------------------------------------

--
-- Table structure for table `recipient_appointment`
--

CREATE TABLE `recipient_appointment` (
  `ra_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `ra_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipient_appointment`
--

INSERT INTO `recipient_appointment` (`ra_id`, `recipient_id`, `doctor_id`, `ra_date`) VALUES
(13, 125, 1, '2021-11-11'),
(14, 127, 1, '2021-11-03'),
(15, 128, 1, '2021-11-25'),
(16, 131, 1, '2021-11-27'),
(17, 129, 1, '2021-11-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `donar`
--
ALTER TABLE `donar`
  ADD PRIMARY KEY (`donar_id`),
  ADD KEY `donar_organ` (`organ_id`);

--
-- Indexes for table `donar_appointment`
--
ALTER TABLE `donar_appointment`
  ADD PRIMARY KEY (`da_id`),
  ADD KEY `donar_app` (`donar_id`),
  ADD KEY `doctor_donar` (`doctor_id`);

--
-- Indexes for table `organ`
--
ALTER TABLE `organ`
  ADD PRIMARY KEY (`organ_id`);

--
-- Indexes for table `organ_transaction`
--
ALTER TABLE `organ_transaction`
  ADD PRIMARY KEY (`ot_id`),
  ADD KEY `donar_transaction` (`donar_id`),
  ADD KEY `recipient_transaction` (`recipient_id`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`recipient_id`),
  ADD KEY `recipient_organ` (`organ_id`);

--
-- Indexes for table `recipient_appointment`
--
ALTER TABLE `recipient_appointment`
  ADD PRIMARY KEY (`ra_id`),
  ADD KEY `recipient_app` (`recipient_id`),
  ADD KEY `recipient_doctor` (`doctor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `donar`
--
ALTER TABLE `donar`
  MODIFY `donar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `donar_appointment`
--
ALTER TABLE `donar_appointment`
  MODIFY `da_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `organ`
--
ALTER TABLE `organ`
  MODIFY `organ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `organ_transaction`
--
ALTER TABLE `organ_transaction`
  MODIFY `ot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `recipient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `recipient_appointment`
--
ALTER TABLE `recipient_appointment`
  MODIFY `ra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donar`
--
ALTER TABLE `donar`
  ADD CONSTRAINT `donar_organ` FOREIGN KEY (`organ_id`) REFERENCES `organ` (`organ_id`);

--
-- Constraints for table `donar_appointment`
--
ALTER TABLE `donar_appointment`
  ADD CONSTRAINT `doctor_donar` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donar_app` FOREIGN KEY (`donar_id`) REFERENCES `donar` (`donar_id`);

--
-- Constraints for table `organ_transaction`
--
ALTER TABLE `organ_transaction`
  ADD CONSTRAINT `donar_transaction` FOREIGN KEY (`donar_id`) REFERENCES `donar` (`donar_id`),
  ADD CONSTRAINT `recipient_transaction` FOREIGN KEY (`recipient_id`) REFERENCES `recipient` (`recipient_id`);

--
-- Constraints for table `recipient`
--
ALTER TABLE `recipient`
  ADD CONSTRAINT `recipient_organ` FOREIGN KEY (`organ_id`) REFERENCES `organ` (`organ_id`);

--
-- Constraints for table `recipient_appointment`
--
ALTER TABLE `recipient_appointment`
  ADD CONSTRAINT `recipient_app` FOREIGN KEY (`recipient_id`) REFERENCES `recipient` (`recipient_id`),
  ADD CONSTRAINT `recipient_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

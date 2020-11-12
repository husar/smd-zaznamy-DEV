-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1:3308
-- Čas generovania: Št 12.Nov 2020, 09:24
-- Verzia serveru: 5.7.31
-- Verzia PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `user_manager`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `osobne_cislo` varchar(30) COLLATE utf8_bin NOT NULL,
  `meno` varchar(36) COLLATE utf8_bin NOT NULL,
  `priezvisko` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ldap` int(11) NOT NULL,
  `aktivny` int(11) NOT NULL,
  `heslo` varchar(300) COLLATE utf8_bin NOT NULL,
  `menoBD` varchar(200) COLLATE utf8_bin NOT NULL,
  `priezviskoBD` varchar(200) COLLATE utf8_bin NOT NULL,
  `hash_odkaz` varchar(300) COLLATE utf8_bin NOT NULL,
  `datum_pridania` date DEFAULT NULL,
  `cislo_karty` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `anonym` int(11) NOT NULL DEFAULT '1',
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`osobne_cislo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Sťahujem dáta pre tabuľku `employees`
--

INSERT INTO `employees` (`osobne_cislo`, `meno`, `priezvisko`, `email`, `ldap`, `aktivny`, `heslo`, `menoBD`, `priezviskoBD`, `hash_odkaz`, `datum_pridania`, `cislo_karty`, `anonym`, `admin`) VALUES
('692', 'Jozef', 'Štucka', 'stuckajano6@gmail.com', 2, 1, 'srus', 'jozef', 'stucka', '4416a47ea87dbb22522b0951dc46fb1b', '2020-08-08', '', 2, 1),
('526', 'Karol', 'Krambabula', 'asda@sadasd', 2, 1, 'ahoj', 'karol', 'krambabula', '79c2b46ce2594ecbcb5b73e928345492', '2020-04-21', '', 2, 0),
('00002', 'Janik', 'Janik', 'ASI@asd.com', 2, 1, 'jBR21qTs', 'janik', 'janik', '2b8225757ef071d098fe162aab7437b3', '2020-09-22', '123456789', 1, 0),
('0005', 'Karol', 'as', 'stuckajano6@gmail.com', 2, 1, 'asdf', 'karol', 'as', '3cf66e2c3858945c9cf800b4ad1ad612', '2019-09-19', '005123', 2, 0),
('5855', 'Ján', 'Uhrc', 'uhrc@mkem.sk', 2, 2, 'asdf', 'jan', 'uhrc', 'c8eb76b932f87122ff75d20d3451647b', '2020-09-21', '', 2, 0),
('08006', 'Ivan', 'Kanikuly', 'mkem@mkem.sk', 2, 1, 'sqY8fvNT', 'ivan', 'kanikuly', '61deacd21d24be5a195e8fe81e4410cd', '2020-09-22', '00526908', 1, 0),
('666', 'Magian', 'Kotleta', 'ujo@jozo.sk', 2, 1, 'kukuk', 'magian', 'kotleta', 'f750129526502acbb38dc24c441431bb', '2020-11-05', '12345', 2, 0),
('525', 'Jozef', 'Krambabula', 'asda@sadasd', 2, 1, 'ahoj', 'jozef', 'krambabula', '79c2b46ce2594ecbcb5b73e928345492', '2020-04-21', '', 2, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id_skupiny` int(11) NOT NULL AUTO_INCREMENT,
  `meno` varchar(50) COLLATE utf8_bin NOT NULL,
  `popis` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `menoBD` varchar(200) COLLATE utf8_bin NOT NULL,
  `datum_pridania` date DEFAULT NULL,
  PRIMARY KEY (`id_skupiny`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Sťahujem dáta pre tabuľku `groups`
--

INSERT INTO `groups` (`id_skupiny`, `meno`, `popis`, `menoBD`, `datum_pridania`) VALUES
(5, 'Karol', 'new                                                                                       ', 'karol', NULL),
(6, 'Najnovsia', 'ultra mega najnovsia                                                    ', 'najnovsia', '2020-09-21'),
(7, 'IT', 'my 4 + pes                                                    ', 'it', '2020-09-22'),
(8, 'Virtuálna nástenka', 'Umožňuje pridávanie príspevkov a oznamov, ktoré sa následne budú premietať dole na telke.', 'virtualna-nastenka', '2020-11-03');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `seo_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `module_filename` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `menu`
--

INSERT INTO `menu` (`id`, `name`, `seo_name`, `module_filename`) VALUES
(21, 'Pridať používateľa', 'pridat-pouzivatela', 'mod_pridat-pouzivatela.php'),
(22, 'Vytvoriť skupinu', 'vytvorit-skupinu', 'mod_vytvorit-skupinu.php'),
(23, 'Spravovať používateľov', 'spravovat-pouzivatelov', 'mod_spravovat-pouzivatelov.php'),
(24, 'Spravovať skupiny', 'spravovat-skupiny', 'mod_spravovat-skupiny.php'),
(25, 'Editovať skupinu', 'upravit-skupinu', 'mod_upravit-skupinu.php'),
(26, 'Upraviť používateľa', 'upravit-pouzivatela', 'mod_upravit-pouzivatela.php');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `admin` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `pwd`, `admin`, `active`) VALUES
(1, 'prejsa', 'Jozef Prejsa', 'pwd', 1, 1),
(2, '357', 'Martin Marťák', 'PWD', 1, 1),
(3, '430', 'Bibiana Vargova', 'Biba430', 0, 1),
(4, '091', 'Danka Kohutova', 'smt', 0, 1),
(5, '661', 'Jakub Oravec', 'smt', 0, 1),
(6, '555', 'Ondrej Andrascik', 'smt', 0, 1),
(7, '495', 'Akif Arifi', 'smt', 0, 1),
(8, '671', 'Milan Réti', 'smt', 1, 1),
(9, '000', 'Operátor vlna', 'smt', 0, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE IF NOT EXISTS `user_groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `osobne_cislo` varchar(11) COLLATE utf8_bin NOT NULL,
  `id_skupiny` int(11) NOT NULL,
  `datum_pridania` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- Sťahujem dáta pre tabuľku `user_groups`
--

INSERT INTO `user_groups` (`ID`, `osobne_cislo`, `id_skupiny`, `datum_pridania`) VALUES
(129, '526', 8, '2020-11-05'),
(123, '692', 5, '2020-09-23'),
(109, '526', 5, '2020-05-20'),
(121, '08006', 6, '2020-09-22'),
(128, '692', 8, '2020-11-05'),
(127, '666', 8, '2020-11-05'),
(118, '692', 7, '2020-09-22'),
(124, '00002', 6, '2020-10-22'),
(125, '526', 6, '2020-10-22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

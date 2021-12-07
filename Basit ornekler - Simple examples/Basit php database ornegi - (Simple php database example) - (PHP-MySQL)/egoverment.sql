-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 May 2020, 01:43:54
-- Sunucu sürümü: 5.7.17
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `egoverment`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `citizeninfos`
--

CREATE TABLE `citizeninfos` (
  `TC` bigint(11) NOT NULL,
  `userName` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `phoneNo` bigint(10) NOT NULL,
  `mail` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(30) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `citizeninfos`
--

INSERT INTO `citizeninfos` (`TC`, `userName`, `adress`, `phoneNo`, `mail`, `birthdate`, `password`) VALUES
(10000000031, 'John Travolta', '22 RE, California, US', 5332556557, 'jhntrvlt@gmail.com', '1966-05-22', 'jhn '),
(10000000030, 'Jim Carrey', 'Jim Carrey', 5332565142, 'jimcarrey@gmail.com', '1977-11-12', 'jimcarrey '),
(10000000028, 'Jhon Snow', '2130 NJ-70 W, Cherry Hill, NJ 08002, US', 5659943213, 'jhonsnow@hotmail.com', '1988-07-02', 'Xf8AMFSKEZ'),
(10000000027, 'Tom Hardy', '925 Paterson Plank Rd, Secaucus, NJ 07094, US', 5232452525, 'tomhardy@gmail.com', '1981-05-21', '4q3dsLrnFs');

--
-- Tetikleyiciler `citizeninfos`
--
DELIMITER $$
CREATE TRIGGER `before_delete` BEFORE DELETE ON `citizeninfos` FOR EACH ROW BEGIN
    INSERT INTO inactive_users(TC,userName,adress,phoneNo,mail,birthdate,password)
    VALUES(OLD.TC,OLD.userName,OLD.adress,OLD.phoneNo,OLD.mail,OLD.birthdate,OLD.password);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `complaints`
--

CREATE TABLE `complaints` (
  `TC` bigint(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `complaintText` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `complaints`
--

INSERT INTO `complaints` (`TC`, `title`, `complaintText`) VALUES
(10000000030, 'Trash', 'There is a guy putting trash in my door.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `father_son`
--

CREATE TABLE `father_son` (
  `fathersTC` bigint(11) NOT NULL,
  `kidsTC` bigint(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `father_son`
--

INSERT INTO `father_son` (`fathersTC`, `kidsTC`) VALUES
(10000000027, 10000000030);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `inactive_users`
--

CREATE TABLE `inactive_users` (
  `TC` bigint(11) NOT NULL,
  `userName` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `phoneNo` bigint(10) NOT NULL,
  `mail` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(30) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `socialsupport`
--

CREATE TABLE `socialsupport` (
  `appID` int(11) NOT NULL,
  `TC` bigint(11) NOT NULL,
  `houseMembers` smallint(5) NOT NULL,
  `totalEarnings` int(10) NOT NULL,
  `explanation` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `socialsupport`
--

INSERT INTO `socialsupport` (`appID`, `TC`, `houseMembers`, `totalEarnings`, `explanation`) VALUES
(2, 10000000030, 4, 5000, 'We really need that money.');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `citizeninfos`
--
ALTER TABLE `citizeninfos`
  ADD PRIMARY KEY (`TC`);

--
-- Tablo için indeksler `father_son`
--
ALTER TABLE `father_son`
  ADD UNIQUE KEY `kidsTC` (`kidsTC`);

--
-- Tablo için indeksler `inactive_users`
--
ALTER TABLE `inactive_users`
  ADD PRIMARY KEY (`TC`);

--
-- Tablo için indeksler `socialsupport`
--
ALTER TABLE `socialsupport`
  ADD PRIMARY KEY (`appID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `citizeninfos`
--
ALTER TABLE `citizeninfos`
  MODIFY `TC` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- Tablo için AUTO_INCREMENT değeri `socialsupport`
--
ALTER TABLE `socialsupport`
  MODIFY `appID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

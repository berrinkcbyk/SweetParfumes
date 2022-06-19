-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 10 Haz 2022, 17:24:32
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sweetparfum`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `adi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `adi`) VALUES
(1, 'Erkek Parfümü'),
(2, 'Kadın Parfümü'),
(3, 'Unisex Parfüm'),
(4, 'Gece Parfümleri'),
(6, 'Gündüz Parfümleri');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `parfumler`
--

CREATE TABLE `parfumler` (
  `id` int(11) NOT NULL,
  `kategorisi` int(11) NOT NULL,
  `uye` int(11) NOT NULL,
  `adi` varchar(100) NOT NULL,
  `fiyati` int(11) NOT NULL,
  `aciklama` text NOT NULL,
  `fotograf` varchar(500) NOT NULL,
  `notalari` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `parfumler`
--

INSERT INTO `parfumler` (`id`, `kategorisi`, `uye`, `adi`, `fiyati`, `aciklama`, `fotograf`, `notalari`) VALUES
(2, 2, 1, 'Bvlgari jasmin Noir', 2500, 'Jasmin Noir Eau de Parfum Spray 82270 BVLGARI', 'assets/img/parfumes/3572parfum.png', '<p>deneme</p>'),
(4, 4, 1, 'Lacoste Parfum', 2500, 'deneme', 'assets/img/parfumes/3718lacoste.png', '<p>adsadsad</p>'),
(5, 1, 2, 'Dolce Galbana', 450, 'Dolce Galbana Parfüm', 'assets/img/parfumes/8246dolce.png', '<p>lorem ipsum dolar sit amme</p>'),
(6, 1, 3, 'Alberto Sego Africanuma Erkek Parfüm', 750, 'Alberto Sego africanuma erkekler için amber fougere kokusudur. 2022 yılında piyasaya sürüldü. Bu kokunun arkasındaki Alberto Emre Çelik\'dir. Üst notalarda portakal, mandalina ve bergamot; orta nota sardunya; temel alt notalarda tonka Fasulyesi, vanilya, özel reçineler, sandal ağacı, misk ve sedir bulunur.', 'assets/img/parfumes/4098PmaYQGakakk651i.jpg', '<p><br>Üst Nota:</p><p>Orman meyveleri, Soft, Okyanus, Beyaz Orkide</p><p>Orta Nota:</p><p>Sardunya</p><p>Alt Nota:</p><p>Vanilya, Sedir, Sandal ağacı, Reçineler</p>');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(255) NOT NULL,
  `sifre` varchar(50) NOT NULL,
  `isim` varchar(255) NOT NULL,
  `aciklama` varchar(255) NOT NULL,
  `parfumler` int(11) NOT NULL,
  `yetki` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `kullaniciadi`, `sifre`, `isim`, `aciklama`, `parfumler`, `yetki`) VALUES
(1, 'admin', '123', 'Berrin', 'Lorem ipsum dolar sit amme.', 0, 0),
(2, 'tugba', '123', 'Tuğba Akman', '', 0, 1),
(3, 'buse', '123', 'Buse', '', 0, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `parfumler`
--
ALTER TABLE `parfumler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `parfumler`
--
ALTER TABLE `parfumler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

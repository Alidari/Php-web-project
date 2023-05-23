-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 May 2023, 21:29:46
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `rog`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `sifre` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `ad`, `soyad`, `email`, `sifre`) VALUES
(7, 'Ali', 'Darı', 'alidari1905@gmail.com', '51b5febd38113b73c915ab831b2b8ecf190c33895182276a8317c4764c8044ba');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_puan`
--

CREATE TABLE `kullanici_puan` (
  `kullanici_id` bigint(20) UNSIGNED NOT NULL,
  `oyun_id` bigint(20) UNSIGNED NOT NULL,
  `puan` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici_puan`
--

INSERT INTO `kullanici_puan` (`kullanici_id`, `oyun_id`, `puan`) VALUES
(7, 8, 4),
(7, 10, 4),
(7, 11, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oyunlar`
--

CREATE TABLE `oyunlar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isim` varchar(64) NOT NULL,
  `resim` varchar(128) NOT NULL DEFAULT './imgs/',
  `yapimci` varchar(64) DEFAULT 'Belirtilmemiş',
  `kul_skor` float NOT NULL,
  `meta_skor` float NOT NULL,
  `tür` varchar(64) DEFAULT 'Belirtilmemiş',
  `Aciklama` text NOT NULL,
  `resim2` varchar(64) NOT NULL DEFAULT './imgs/' COMMENT 'yüksek cozunurluklu resim'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `oyunlar`
--

INSERT INTO `oyunlar` (`id`, `isim`, `resim`, `yapimci`, `kul_skor`, `meta_skor`, `tür`, `Aciklama`, `resim2`) VALUES
(1, 'Dead Space Remake', './imgs/deadspace.jpg', 'EA Games', 8.7, 89, 'Aksiyon, Gerilim', 'Yeni nesil konsollar ve PC için özel olarak geliştirildi ve Frostbite oyun motoru tarafından desteklenen çarpıcı görseller, ses ve kontroller aracılığıyla korku ve sürükleyicilik seviyesini seri için benzeri görülmemiş yüksekliklere çıkarıyor. Hayranlar, ıssız maden yıldız gemisi USG Ishimura\'da yaşayan bir kabusta hayatta kalmak için savaşırken, katledilen mürettebata ve gemiye olanların korkunç gizemini açığa çıkarırken gelişmiş bir hikaye, karakterler, oyun mekaniği ve daha fazlasını deneyimleyecek.', './imgs/'),
(2, 'Hogwarts Legacy', './imgs/hogwarts.jpg', 'Avalanche Studios - Warner Bros. Interactive Entertainment', 8, 83, 'Role Playing Game', 'Hogwarts Legacy, ilk olarak Harry Potter kitaplarında tanıtılan dünyada geçen sürükleyici, açık dünya bir aksiyon RPG\'sidir. Artık aksiyonun kontrolünü elinize alabilir ve büyücülük dünyasında kendi maceranızın merkezinde olabilirsiniz. Fantastik canavarları keşfedip keşfederken, karakterinizi özelleştirip iksirler yaparken, büyü yapmada ustalaşın, yeteneklerinizi yükseltin ve olmak istediğiniz sihirbaz olurken tanıdık ve yeni konumlarda bir yolculuğa çıkın.', './imgs/'),
(3, 'Resident Evil 4 Remake', './imgs/residentevil.jpg', 'Capcom', 8, 93, 'Aksiyon,Korku', '2005\'in efsanevi hayatta kalma korku oyunu Resident Evil 4, bu sıfırdan yeniden yapımda tamamen güncellendi. Resident Evil 2\'deki olaylardan altı yıl sonra, Raccoon City\'den sağ kurtulan Leon Kennedy, ABD başkanının kızının ortadan kaybolmasını araştırmak üzere tenha bir Avrupa köyüne gönderilir. Orada keşfettiği şey daha önce karşılaştığı hiçbir şeye benzemiyor. Modernize edilmiş grafikler ve kontrollerden orijinal oyunun sert hayranlarını bile şaşırtabilecek yeniden tasarlanmış bir hikayeye kadar klasik oyunun her yönü mevcut nesil için güncellendi.\r\n', './imgs/'),
(4, 'WWE 2K23', './imgs/wwe.jpg', 'Visual Concepts - 2K Sports', 7.1, 82, 'Dövüş', 'Genişletilmiş özellikler, muhteşem grafikler ve en üst düzey WWE deneyimi. Roman Reigns, \"American Nightmare\" Cody Rhodes, Ronda Rousey, Brock Lesnar, \"Stone Cold\" Steve Austin ve daha fazlasını içeren geniş bir WWE Superstars ve Legends kadrosuyla ringe çıkın!\r\n', './imgs/'),
(5, 'SpongeBob SquarePants: The Cosmic Shake', './imgs/sunger.jpg', 'Purple Lamp Studios - THQ Nordic', 7, 71, 'Aile oyunu, Platform', 'Dilekleri yerine getiren Deniz Kızının Gözyaşları Sünger Bob ve Patrick\'in ellerinde... Neyin ters gitmesi mümkün olabilir? Elbette, evreni bir arada tutan yapı çok bozulabilir, şövalyeler, kovboylar, korsanlar ve tarih öncesi salyangozlarla dolu Wishworlds\'e portallar açabilir. Ancak bu, herkesin en sevdiği süngerin doğru kozmik kostümle üstesinden gelemeyeceği bir şey değil! Herkes Cosmic Shake\'i yapsın!\r\n', './imgs/'),
(6, 'The Last Of Us Part I PC\r\nResim: ', './imgs/tlou.jpg', 'Naughty Dog - Sony Interactive Entertainment', 2.2, 57, 'Aksiyon, Korku', 'Enfekte olmuş ve sertleşmiş hayatta kalanların kol gezdiği harap olmuş bir medeniyette, yorgun bir kahraman olan Joel, 14 yaşındaki Ellie\'yi askeri karantina bölgesinden kaçırmak için tutulur. Ancak, küçük bir iş olarak başlayan şey, kısa sürede acımasız bir ülke çapında yolculuğa dönüşür. The Last of Us tek oyunculu hikayenin tamamını ve Ellie ile en iyi arkadaşı Riley\'nin hayatlarını sonsuza dek değiştiren olayları araştıran ünlü bir ön bölüm olan Left Behind\'ı içerir.', './imgs/'),
(7, 'Minecraft Legends', './imgs/minecraft.jpg', 'Black Bird Interactive - Microsoft Game Studios', 5.7, 65, 'Aksiyon, Strateji', 'Yeni bir aksiyon strateji oyunu olan Minecraft Legends\'ın gizemlerini keşfedin. Overworld\'ü yıkıcı piglinlerden korumak için müttefiklerinize kahramanca savaşlarda liderlik edin.\r\n', './imgs/'),
(8, 'Star Wars Jedi: Survivor', './imgs/starwars.jpg', 'Respawn Entertainment - EA Games', 5.9, 85, 'Aksiyon,Role Playing Game', 'Star Wars Jedi: Survivor, Star Wars Jedi: Fallen Order\'daki olayların beş yıl sonrasını konu alıyor. Cal, galakside kalan son Jedi\'lardan biri olmanın ağırlığını hissetmeye devam ederken, İmparatorluğun sürekli arayışında bir adım önde olmalıdır. Respawn Entertainment\'ın kıdemli ekibi tarafından geliştirilen Jedi: Survivor, ikonik Star Wars hikayelerini, dünyalarını ve karakterlerini ve ilk olarak Jedi: Fallen Order\'da deneyimlenen heyecan verici dövüşleri genişletecek.', './imgs/'),
(9, 'Redfall', './imgs/redfall.jpg', 'Arkane Studios', 2.1, 54, 'Aksiyon,First Person Shooter', 'Ada kasabası Redfall, Massachusetts, güneşi ve vatandaşların dış dünyayla bağlantısını kesen bir vampir lejyonu tarafından kuşatma altındadır. Açık dünyayı keşfedin ve vampirlerin görünüşünün ardındaki gizemi çözerken kendinizi derin bir hikaye kampanyasına kaptırın. Kasabanın kanını kurutmakla tehdit eden yaratıklara karşı bir avuç hayatta kalanla ittifak kur.\r\n\r\nRedfall, Prey ve Dishonored\'ın arkasındaki ödüllü ekip Arkane Austin\'den açık dünya, kooperatif bir FPS\'dir. Arkane\'nin özenle hazırlanmış dünyalar ve sürükleyici sims mirasını sürdüren Redfall, stüdyonun imzalı oynanışını bu hikaye odaklı aksiyon nişancı oyununa getiriyor.', './imgs/redfall2.jpg'),
(10, 'Horizon Forbidden West: Burning Shores', './imgs/horizonWest.jpg', 'Guerilla Games', 4.2, 82, 'Aksiyon,Macera', 'Aloy\'un hikayesi devam ederken Yasak Batı\'nın ötesine seyahat edin. Yeni makinelerle ve ilgi çekici yeni bir hikayeyle karşılaşın. Tenakth Clan Lands\'in güneyinde, binlerce yıllık volkanik patlamalar ve şiddetli sismik faaliyetler, Los Angeles\'ın harabelerini hain bir takımadaya dönüştürdü. Horizon Forbidden West\'in bir sonraki bölümünü, Aloy bu tehlikeli, evcilleştirilmemiş vahşi doğanın arasına gizlenmiş, gezegene yönelik uğursuz yeni bir tehdidin peşine düşerken deneyimleyin. Burning Shores DLC, Horizon Forbidden West için çarpıcı ama tehlikeli yeni bir alanda yeni karakterler ve deneyimler dahil olmak üzere ek içerik içerir. Burning Shores\'a girmek için Horizon Forbidden West\'in PS5 versiyonundaki ana görevi (Singularity\'ye kadar ve dahil) tamamlamanız gerekiyor. Ana görevin ardından oyuncu, DLC\'yi başlatan Aloy\'s Focus üzerinden bir çağrı alacak.\r\n', './imgs/horizon.webp'),
(11, 'The Legend of Zelda: Tears of the Kingdom', './imgs/zelda.jpg', 'Nintendo', 8.7, 96, 'Macera', 'Nintendo Switch™ için The Legend of Zelda™: Tears of the Kingdom\'da Hyrule diyarında ve göklerinde destansı bir macera sizi bekliyor. Macera, hayal gücünüzle dolu bir dünyada yaratmanız için size ait. The Legend of Zelda: Breath of the Wild\'ın bu devam oyununda, Hyrule\'un uçsuz bucaksız arazilerinde ve yukarıdaki uçsuz bucaksız gökyüzünde yüzen gizemli adalarda kendi yolunuza karar vereceksiniz. Krallığı tehdit eden kötü niyetli güçlere karşı savaşmak için Link\'in yeni yeteneklerinin gücünü kullanabilir misin?', './imgs/zelda.webp');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `yorum` varchar(500) NOT NULL,
  `oyun_id` bigint(20) UNSIGNED NOT NULL,
  `kullanici_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `yorum`, `oyun_id`, `kullanici_id`) VALUES
(10, 'Güzel oyun', 1, 7),
(13, 'Deneme yorum', 2, 7),
(14, 'Beğendim', 2, 7),
(15, 'Star wars sevenler için güzel', 8, 7);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ad` (`ad`);

--
-- Tablo için indeksler `kullanici_puan`
--
ALTER TABLE `kullanici_puan`
  ADD PRIMARY KEY (`kullanici_id`,`oyun_id`),
  ADD KEY `oyun_id` (`oyun_id`);

--
-- Tablo için indeksler `oyunlar`
--
ALTER TABLE `oyunlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isim` (`isim`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kullanici_id` (`kullanici_id`),
  ADD KEY `oyun_id` (`oyun_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `oyunlar`
--
ALTER TABLE `oyunlar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `kullanici_puan`
--
ALTER TABLE `kullanici_puan`
  ADD CONSTRAINT `kullanici_puan_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`),
  ADD CONSTRAINT `kullanici_puan_ibfk_2` FOREIGN KEY (`oyun_id`) REFERENCES `oyunlar` (`id`);

--
-- Tablo kısıtlamaları `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`),
  ADD CONSTRAINT `yorumlar_ibfk_2` FOREIGN KEY (`oyun_id`) REFERENCES `oyunlar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

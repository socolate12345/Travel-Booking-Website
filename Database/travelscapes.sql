-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: travelscapes
-- ------------------------------------------------------
-- Server version	9.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_login` (
  `srno` int NOT NULL AUTO_INCREMENT,
  `Admin_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Admin_Password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_login`
--

LOCK TABLES `admin_login` WRITE;
/*!40000 ALTER TABLE `admin_login` DISABLE KEYS */;
INSERT INTO `admin_login` VALUES (1,'Admin','Admin'),(2,'Tejas','Tejas'),(3,'atharva','atharva'),(4,'yash','Yash');
/*!40000 ALTER TABLE `admin_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `cityid` int NOT NULL AUTO_INCREMENT,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `season` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `days` int NOT NULL,
  `cost` int NOT NULL,
  PRIMARY KEY (`cityid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (10,'Tay Bac','North West','Spring',5,7199000),(11,'Ho Chi Minh','South East','Summer',6,3900000),(12,'Nha Trang','Central ','Summer',3,3650000),(13,'Hue','Central ','Fall',3,6000000),(14,'Phu Yen','Central ','Fall',5,5260000),(15,'Da Lat','Central ','Winter',2,2150000),(16,'Phu Quoc','Mekong Delta','Summer',2,2790000),(17,'Hoi An','Central ','Fall',3,3090000),(18,'Ha Giang','North West','Fall',6,7990000);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorites` (
  `favorite_id` int NOT NULL AUTO_INCREMENT,
  `usersid` int NOT NULL,
  `cityid` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`favorite_id`),
  KEY `usersid` (`usersid`),
  KEY `cityid` (`cityid`),
  CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`usersid`) REFERENCES `login` (`usersid`) ON DELETE CASCADE,
  CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`cityid`) REFERENCES `cities` (`cityid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (20,1,10,'2025-05-13 16:38:50');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_bookings`
--

DROP TABLE IF EXISTS `hotel_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotel_bookings` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cityid` int NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `hotelid` int NOT NULL,
  `hotel_name` varchar(100) NOT NULL,
  `tourists` int NOT NULL DEFAULT '1',
  `tour_date` date NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cost_per_day` int NOT NULL,
  `total_amount` int NOT NULL,
  `booking_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `userid` (`userid`),
  KEY `cityid` (`cityid`),
  KEY `hotelid` (`hotelid`),
  CONSTRAINT `hotel_bookings_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `login` (`usersid`),
  CONSTRAINT `hotel_bookings_ibfk_2` FOREIGN KEY (`cityid`) REFERENCES `cities` (`cityid`),
  CONSTRAINT `hotel_bookings_ibfk_3` FOREIGN KEY (`hotelid`) REFERENCES `hotels` (`hotelid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_bookings`
--

LOCK TABLES `hotel_bookings` WRITE;
/*!40000 ALTER TABLE `hotel_bookings` DISABLE KEYS */;
INSERT INTO `hotel_bookings` VALUES (5,2,'test2','test2@test.com',10,'Tay Bac',4,'Thinh Vuong Hotel',2,'2025-04-25','07842851223',2100000,4200000,'2025-05-13 17:41:22');
/*!40000 ALTER TABLE `hotel_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotels` (
  `hotelid` int NOT NULL AUTO_INCREMENT,
  `hotel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cityid` int DEFAULT NULL,
  `cost` bigint DEFAULT NULL,
  `amenities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ratings` int DEFAULT NULL,
  PRIMARY KEY (`hotelid`),
  KEY `hotels_ibfk_1` (`cityid`),
  CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`cityid`) REFERENCES `cities` (`cityid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES (1,'An Loc Hotel',10,2079000,'Wifi, Parking',4),(2,'Thanh Nam Hotel',10,1200000,'Wifi, Parking, Bar',3),(3,'Frontier Hostel & Tours',10,1290000,'Wifi, Parking, Breakfast, Bar',4),(4,'Thinh Vuong Hotel',10,2100000,'Wifi, Parking, Airport, Breakfast',3),(5,'Hoang Lien Hotel',10,2250000,'Wifi, Parking, Pool',4),(6,'Muong Thanh Hotel',10,3231900,'Wifi, Parking, Breakfast, Pool',4),(7,'Anh Hong Hotel',10,1485000,'Parking, Bar, Breakfast',5),(8,'Hoa Sua Hotel',10,1530000,'Parking',4),(9,'Hoang Ha River Town',10,1155000,'Wifi, Parking',4),(10,'Gem Market Guest House',10,900000,'Wifi, Parking, Breakfast, Pool, Airport',4),(11,'Ming Ngoc Hotel',11,1607800,'Wifi, Parking',2),(12,'Nori Homestay',11,1250504,'Wifi',4),(13,'Vintage Park View Hotel',11,1044000,'Wifi, Parking, Breakfast, Airport, Spa',4),(14,'Quy Hung Hotel',11,1320000,'Wifi, Airport',4),(15,'Niecy Apartment',11,1572278,'Wifi, Parking',4),(16,'Anpha Apartment Hotel',11,2970000,'Wifi, Parking, Breakfast, Airport, Spa, Bar',3),(17,'S79 Boutique Hotel',11,1228125,'Wifi, Parking',4),(18,'Chez Mimosa',11,2316600,'Wifi, Breakfast',3),(19,'The Luxury MAYS Hotel',11,1134000,'Wifi, Parking, Airport, Spa',5),(20,'The Alpina Hstaad',11,1053000,'Wifi, Airport',5),(21,'LYN Panorama Nha Trang Condotel',12,1679999,'Wifi, Airport',5),(22,'Panorama Beachfront',12,1200000,'Wifi, Airport',4),(23,'Hermes',12,639998,'Wifi, Airport, Parking',4),(24,'MySea Panorama',12,880000,'Wifi, Airport, Parking, Breakfast',4),(25,'OCEANFRONT SUITES',12,1125000,'Wifi, Airport, Parking',5),(26,'Senia Hotel',12,875000,'Wifi, Airport, Pool',5),(27,'AQua Hotel',12,450000,'Wifi, Airport',5),(28,'Yen Indochine',12,554400,'Wifi, Airport, Pool, Parking',5),(29,'Lucky Sun Hotel',12,958850,'Airport, PoolRelationships, Bar, Breakfast',5),(30,'Sun Kiss Hotel',12,885600,'Wifi, Airport, Pool, Bar, Breakfast',5),(31,'VinaSpa Hotel',13,719397,'Wifi, Parking, Breakfast, Spa, Airport',2),(32,'BIG Hotel',13,585906,'Wifi, Airport, Parking',5),(33,'Cosy Homestay',13,306000,'Wifi, Airport, Parking',3),(34,'Gardenia Hue Hotel',13,624000,'Wifi, Airport, Parking, Breakfast',5),(35,'Dory Homestay',13,324000,'Wifi, Parking',5),(36,'Moonlight Boutique Hotel',13,520200,'Wifi, Parking, Airport, Pool',5),(37,'Charm House Hue',13,495000,'Wifi, Airport, Parking, Breakfast',5),(38,'The Scarlett Boutique Hotel',13,906873,'Wifi, Airport, Parking, Breakfast',5),(39,'Son Ca',13,1655000,'Wifi, Airport, Parking',5),(40,'Sunny B Hotel',13,1350000,'Wifi, Airport, Parking',5),(41,'Novus Sol Hotel Phu Quoc',16,1550000,'Wifi, Parking',5),(42,'The Pier Phu Quoc Resort',16,2380000,'Wifi, Pool, Parking',4),(43,'Sole Casa Phu Quoc',16,1825000,'Wifi, Tivi',4),(44,'Luna Sol Villas',16,2277000,'Wifi, Tivi, Parking, Bar',5),(45,'Casepia',16,1683000,'Wifi, Tivi, Bar',4),(46,'Azure Premium Apartments',16,956000,'Tivi, Bar',4),(47,'Mira Home',16,1008000,'Tivi, Bar',3),(48,'Rova Hotel',16,374000,'Wifi, Bar',3),(49,'Oscar Seaview Apartment',16,1600000,'Wifi, Pool, Tivi, Bar',4),(50,'Maris Beach Hotel Phu Quoc',16,720000,'Wifi, Parking, Pool, Breakfast',4),(51,'Thanh Premier Dalat',15,1400000,'Wifi, Parking, Airport',4),(52,'BIDV Central Dalat Hotel',15,1639000,'Wifi, Parking, Breakfast, Airport',5),(53,'Greenview City Hotel',15,1954000,'Wifi, Tivi, Parking, Airport',5),(54,'Nature Hotel City Center',15,1161000,'Wifi, Tivi, Parking, Airport',4),(55,'Dalat Wind Hotel',15,678000,'Wifi, Tivi, Bar, Parking',3),(56,'Phuong Vy Luxuty Hotel',15,1395000,'Wifi, Tivi, Parking',4),(57,'Dalat Hills Apartment',15,650000,'Wifi, Tivi, Parking, Airport',3),(58,'Nature Green Hotel',15,1842000,'Wifi, Tivi, Parking, Breakfast',4),(59,'Carnival Hotel',15,1200000,'Wifi, Tivi, Parking, Breakfast, Bar',5),(60,'Thanh Thanh Hotel',15,1100000,'Wifi, Tivi, Parking, Airport',4),(61,'Handstay Nghinh Phong',14,1300000,'Wifi, Tivi, Parking, Bar',4),(62,'Apec Mandala Phu Yen',14,1135000,'Wifi, Tivi, Parking, Bar',4),(63,'Palm Beach Hotel Phu Yen',14,1590000,'Wifi, Tivi, Parking, Bar, Breakfast, Pool',5),(64,'PAMY Homestay Phu Yen',14,1245389,'Wifi, Tivi, Parking, Bar',4),(65,'Coconut Hotel Phú Yên',14,1734201,'Wifi, Parking, Bar, Breakfast, Pool',5),(66,'Paradise Hotel & Homestay',14,788563,'Wifi, Parking',3),(67,'Sala Tuy Hoa Beach Hotel',14,1029447,'Wifi, Pool, Bar, Parking',5),(68,'Dreamville Beach Homestay',14,1593820,'Wifi, Tivi, Parking, Breakfast, Pool',5),(69,'Daisy House',14,686117,'Wifi, Parking',4),(70,'Ivory Phu Yen Hotel',14,957000,'Pool, Parking, Breakfast',5),(71,'Du De Homestay',17,720000,'Wifi, Parking, Breakfast, Airport',4),(72,'Renaissance Hoi An Resort & Spa',17,2100000,'Wifi, Parking, Breakfast, Airport, Bar',5),(73,'Moire Hoi An',17,3973000,'Wifi, Parking, Breakfast, Airport, Bar, Pool',5),(74,'Elites Riverside Hotel & Spa Hoi An',17,2167000,'Wifi, Breakfast, Airport, Bar, Pool',4),(75,'December Hoi An Villa',17,4000000,'Wifi, Breakfast, Airport, Bar, Pool, Parking',5),(76,'Ocean Breeze Villa',17,1300000,'Wifi, Breakfast, Airport, Pool, Parking',4),(77,'Serene Nature Hotel & Spa',17,3150000,'Wifi, Breakfast, Airport, Bar, Pool, Parking',5),(78,'Babylon Hoi An Central Villa',17,1550000,'Wifi, Breakfast, Airport, Pool, Parking',4),(79,'Truc Loc Villa',17,1085000,'Wifi, Breakfast, Pool, Parking',4),(80,'An Bang Vu Nhi Homestay',17,2095251,'Wifi, Breakfast, Airport, Parking',4),(81,'Nhà Lá Homestay',18,1250000,'Wifi, Breakfast, Parking',4),(82,'Four Points by Sheraton Ha Giang',18,1425000,'Breakfast, Pool, Parking',4),(83,'H\'mong Village Resort Ha Giang',18,1057540,'Wifi, Breakfast, Pool, Parking',5),(84,'Lotus Premium Lodge - Group Tours',18,1170000,'Wifi, Breakfast, Pool, Parking, Airport, Bar',5),(85,'Yen Bien Luxury Hotel',18,2450000,'Breakfast, Pool, Parking, Airport, Bar',5),(86,'Silk River Hotel Ha Giang',18,1035000,'Wifi, Breakfast, Pool, Parking, Bar',4),(87,'Garden Hotel II',18,1093950,'Wifi, Breakfast, Parking, Airport, Bar',4),(88,'Sun Hà Giang Hotel',18,600000,'Wifi, Breakfast, Parking',4),(89,'Sky Bay Lodge',18,970000,'Wifi, Breakfast, Pool, Parking, Bar',5),(90,'Ha Giang Xanh Retreat',18,935000,'Wifi, Breakfast, Pool, Parking, Airport, Bar',5);
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `usersid` int NOT NULL AUTO_INCREMENT,
  `usersEmail` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usersuid` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userspwd` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`usersid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'test@test.com','test','$2y$10$flekLyq.6a/gn12Xsdm0v.SZZCrx3/.Pm3M3Ucvel8MwCzReorRsq'),(2,'test2@test.com','test2','$2y$10$uqx8Jk9IDXZ8q1x4JFPR5OYiaCKYTquxsXH6A0OM7hTXkpEKXzjJG'),(3,'test3@test.com','test3','$2y$10$OGLEA.ETOj1DB0fRhjjuduKb4OJ75.WB5wgs5UVUBPjTMbcoUVVgy'),(5,'test4@test.com','test4','$2y$10$ikw.LpmUCDlMTuK2qdUyNuueZOn2Zrqkg4WLEuUaqDFLYh4YjrIlC'),(7,'test@123.com','socola12345','$2y$12$Ma8zP5fyLq7KKXOaYoHkc.a6PtOTR22UKyUpYer0X6Z33VmvCjG2e');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_bookings`
--

DROP TABLE IF EXISTS `tour_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_bookings` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cityid` int NOT NULL,
  `city_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tourid` int NOT NULL,
  `tour_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tourists` int NOT NULL DEFAULT '1',
  `tour_date` date NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `price_per_person` int NOT NULL,
  `total_amount` int NOT NULL,
  `booking_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`booking_id`),
  KEY `userid` (`userid`),
  KEY `cityid` (`cityid`),
  KEY `tourid` (`tourid`),
  CONSTRAINT `tour_bookings_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `login` (`usersid`),
  CONSTRAINT `tour_bookings_ibfk_2` FOREIGN KEY (`cityid`) REFERENCES `cities` (`cityid`),
  CONSTRAINT `tour_bookings_ibfk_3` FOREIGN KEY (`tourid`) REFERENCES `tours` (`tourid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_bookings`
--

LOCK TABLES `tour_bookings` WRITE;
/*!40000 ALTER TABLE `tour_bookings` DISABLE KEYS */;
INSERT INTO `tour_bookings` VALUES (1,1,'Long ','long@gmail.com',18,'Ha Giang',19,'HA GIANG - DONG VAN - MA PI LENG - MEO VAC TOUR',2,'2025-07-25','0784285524',4500000,9000000,'2025-05-12 03:20:48'),(2,1,'Truong','long@gmail.com',18,'Ha Giang',19,'HA GIANG - DONG VAN - MA PI LENG - MEO VAC TOUR',1,'2025-07-25','07842851223',4500000,4500000,'2025-05-12 03:25:03'),(3,1,'TRUONG','pxuantruong1412@gmail.com',10,'Tay Bac',5,'NORTHWEST IN RICE HARVEST SEASON - NGHIA LO - MU CANG CHAI - SAPA - FANSIPAN - LAI CHAU - DIEN BIEN',1,'2025-12-24','0784285524',12179000,12179000,'2025-05-13 17:25:45');
/*!40000 ALTER TABLE `tour_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tours`
--

DROP TABLE IF EXISTS `tours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tours` (
  `tourid` int NOT NULL AUTO_INCREMENT,
  `cityid` int NOT NULL,
  `tour_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `duration_days` int NOT NULL,
  `price_per_person` int NOT NULL,
  `season` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tourid`),
  KEY `cityid` (`cityid`),
  CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`cityid`) REFERENCES `cities` (`cityid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tours`
--

LOCK TABLES `tours` WRITE;
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;
INSERT INTO `tours` VALUES (1,11,'City Tour - 4-Hour Double-Decker Bus Saigon - Cholon & Culinary Experience','Unique perspective from a double-decker bus\r\nCultural insights in Cholon\r\nExquisite culinary stops with local delicacies',1,599000,'Spring','2025-05-11 16:09:23'),(4,10,'HUNG TEMPLE - NGHIA LO - TU LE - MU CANG CHAI - SAPA - FANSIPAN - DIEN BIEN - MOC CHAU TOUR','Visit the historic Hung Temple, a symbol of Vietnam\'s ancient culture and heritage.\r\nExplore the picturesque rice terraces of Mu Cang Chai and Tu Le Valley.\r\nConquer Fansipan Mountain, the roof of Indochina, with a breathtaking cable car ride.\r\nExperience the local culture in Nghia Lo, Sapa, and Moc Chau, meeting ethnic minorities like Thai, H\'mong, and Dao.',4,13590000,'Spring','2025-05-11 16:17:06'),(5,10,'NORTHWEST IN RICE HARVEST SEASON - NGHIA LO - MU CANG CHAI - SAPA - FANSIPAN - LAI CHAU - DIEN BIEN','Explore the stunning landscapes of Sa Pa, with terraced fields and the highest mountain in Vietnam – Fansipan.\r\nDiscover the unique culture of ethnic minorities in the northern provinces like H\'mong, Tay, and Dao.\r\nExperience the serene beauty of Pu Luong Nature Reserve, Moc Chau Plateau, and Mai Chau Valley.',6,12179000,'Summer','2025-05-11 16:20:18'),(6,12,'NHA TRANG - 3 DAYS - THÁP BÀ PONAGAR, NHŨ TIÊN BEACH & MORE','Discover Nha Trang’s rich cultural heritage and stunning landscapes.\r\nExperience luxurious stays at a 4-star hotel with premium amenities.\r\nVisit the iconic Tháp Bà Ponagar, relax at Nhũ Tiên Beach, and enjoy thrilling rides at VinWonders.',3,2390000,'Summer','2025-05-11 16:22:35'),(7,12,'NHA TRANG - 3 DAYS - POTTERY & SEASHELL WORKSHOP, ANCIENT NHA TRANG & MORE','Immerse in the artistic heritage of Bàu Trúc Pottery Village.\r\nDiscover ancient Nha Trang and its historic sites.\r\nRelax at Nhũ Tiên Beach and enjoy thrilling attractions at VinWonders.\r\nCreate unique crafts at the Pottery & Seashell Workshop Experience.',3,2690000,'Spring','2025-05-11 16:27:54'),(8,13,'DA NANG - PHONG NHA CAVE - LA VANG - HUE - BA NA HILLS - HOI AN','Explore the natural beauty of Phong Nha Cave and the sacred La Vang Pilgrimage Center.\r\nDiscover the historical essence of Hue and the ancient charm of Hoi An.\r\nExperience the stunning Ba Na Hills and the iconic Golden Bridge over a 5-day immersive journey.',5,6990000,'Fall','2025-05-11 16:33:04'),(9,13,'HANOI - SAPA - FANSIPAN - HA LONG - NINH BINH - DA NANG - SON TRA - BA NA HILLS - GOLDEN BRIDGE - HOI AN - LA VANG - HUE - PHONG NHA','Comprehensive journey through Vietnam’s cultural and natural highlights.\r\nConquer Fansipan, the highest peak in Indochina.\r\nMarvel at Ha Long Bay, the Golden Bridge, and Hoi An’s ancient charm.',10,23590000,'Summer','2025-05-11 16:36:34'),(10,14,'PHU YEN: QUY NHON - KY CO - EO GIO - GANH DA DIA','Explore the stunning beaches of Ky Co and Eo Gio.\r\nMarvel at the unique rock formations of Ganh Da Dia.\r\nDiscover the local culture and cuisine of Quy Nhon.',3,3990000,'Summer','2025-05-11 16:42:07'),(11,14,'PHU YEN - QUY NHON - EO GIO TOUR','Discover the unspoiled beauty of Phu Yen with its stunning coastline, rocky landscapes, and peaceful countryside.\r\nEnjoy the vibrant seaside city of Quy Nhon, known for its clean beaches, friendly locals, and rich Cham culture.\r\nExplore Eo Gio and Ky Co – two of the most picturesque coastal spots in Vietnam with turquoise water and dramatic cliffs.',4,7390000,'Summer','2025-05-11 16:44:04'),(12,15,'DA LAT - VALLEY OF LOVE - LANGBIANG - NIGHT MARKET TOUR','Experience the romantic charm of Da Lat with its cool climate, pine forests, and blooming flowers.\r\nVisit iconic landmarks like the Valley of Love and Langbiang Mountain for breathtaking views and outdoor fun.\r\nEnjoy the lively atmosphere of Da Lat Night Market with delicious street food and local specialties.',3,2800000,'Fall','2025-05-11 16:46:53'),(13,15,'DA LAT - DATANLA WATERFALL - COFFEE FARM - CLAY TUNNEL TOUR','Discover the natural beauty of Da Lat through waterfalls, pine forests, and colorful flower gardens.\r\nVisit Datanla Waterfall for thrilling activities like alpine coaster rides.\r\nExperience Da Lat’s unique culture with stops at a local coffee farm and the artistic Clay Tunnel',2,2040000,'Fall','2025-05-11 16:47:52'),(14,16,'  PHU QUOC - BAI SAO - TRANH STREAM - NIGHT MARKET TOUR','Relax on the white sandy beaches of Bai Sao, one of the most beautiful in Phu Quoc.\r\nExplore the natural charm of Tranh Stream with its clear water, rocks, and lush surroundings.\r\nEnjoy the vibrant atmosphere of Phu Quoc Night Market with local seafood and souvenirs.',3,5250000,'Summer','2025-05-11 16:51:20'),(15,16,' PHU QUOC - VINWONDERS - SAFARI - HON THOM CABLE CAR TOUR','Experience the best of Phu Quoc’s modern attractions and natural beauty in one trip.\r\nHave fun at VinWonders – one of Vietnam’s largest theme parks with thrilling rides and shows.\r\nExplore Vinpearl Safari, home to hundreds of wild animals in a semi-wild environment.\r\nTake in stunning views from the world’s longest sea-crossing Hon Thom Cable Car.',4,8800000,'Summer','2025-05-11 16:52:17'),(16,17,'HOI AN ANCIENT TOWN - LANTERN STREET - THU BON RIVER TOUR','Immerse yourself in the timeless charm of Hoi An Ancient Town, a UNESCO World Heritage site.\r\nStroll through Lantern Street glowing with colorful lights and traditional architecture.\r\nEnjoy a peaceful boat ride on Thu Bon River, perfect for sunset views and cultural photos.',2,2400000,'Spring','2025-05-11 16:53:08'),(17,17,'HOI AN - MY SON SANCTUARY - TRA QUE VILLAGE - COCONUT FOREST TOUR','Explore the ancient My Son Sanctuary, a UNESCO World Heritage site rich in Champa culture.\r\nExperience authentic local life at Tra Que Vegetable Village with farming activities.\r\nEnjoy a fun basket boat ride through the peaceful Bay Mau Coconut Forest.',3,3820000,'Fall','2025-05-11 16:55:19'),(18,18,'HA GIANG - DONG VAN - MA PI LENG - MEO VAC TOUR','Conquer the legendary Ha Giang Loop, one of Vietnam’s most scenic mountain routes.\r\nAdmire breathtaking landscapes at Ma Pi Leng Pass, often called the “king of all mountain passes.”\r\nExplore the unique culture of ethnic minorities in Dong Van and Meo Vac.',3,3750000,'Winter','2025-05-11 16:56:40'),(19,18,'HA GIANG - DONG VAN - MA PI LENG - MEO VAC TOUR','Conquer the legendary Ha Giang Loop, one of Vietnam’s most scenic mountain routes.\r\nAdmire breathtaking landscapes at Ma Pi Leng Pass, often called the “king of all mountain passes.”\r\nExplore the unique culture of ethnic minorities in Dong Van and Meo Vac.',4,4500000,'Winter','2025-05-11 17:00:23'),(20,11,'Saigon City Tour - Duc Ba Church, Nguyen Hue Street, Landmark81, Bui Vien, Dinh Doc Lap','Discover Saigon\'s iconic landmarks over three days of exploration.\r\nExperience the majestic architecture of Duc Ba Church and the vibrant Nguyen Hue Street.\r\nEnjoy panoramic city views from Landmark 81 and the bustling nightlife of Bui Vien Walking Street.\r\nExplore the historical significance of Dinh Doc Lap.',3,2800000,'Spring','2025-05-11 17:09:04');
/*!40000 ALTER TABLE `tours` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-14  0:55:54

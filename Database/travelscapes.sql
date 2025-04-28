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
  `Admin_Name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Admin_Password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
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
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `season` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
INSERT INTO `cities` VALUES (10,'Tây Bắc','North West','Spring',5,7199000),(11,'Hồ Chí Minh','South East','Summer',6,3900000),(12,'Nha Trang','Central ','Summer',3,3650000),(13,'Hue','Central ','Fall',3,6000000),(14,'Phu Yen','Central ','Fall',5,5260000),(15,'Da Lat','Central ','Winter',2,2150000),(16,'Phu Quoc','Mekong Delta','Summer',2,2790000),(17,'Hoi An','Central ','Fall',3,3090000),(18,'Ha Giang','North West','Fall',6,7990000);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (8,1,10,'2025-04-22 10:50:30'),(9,1,11,'2025-04-22 10:50:36'),(10,1,12,'2025-04-22 11:39:27');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES (1,'Sunrise Palace',10,1450000.00,'WiFi,Pool,Gym',5),(2,'Moonlight Inn',11,950000.00,'WiFi,Parking',3),(3,'Ocean Breeze Hotel',12,1850000.00,'WiFi,Pool,Spa,Gym',5),(4,'Green Leaf Resort',13,1250000.00,'WiFi,Pool',4),(5,'Skyline Tower',14,2200000.00,'WiFi,Pool,Gym,Spa,Bar',5),(6,'Mountain View Lodge',15,780000.00,'WiFi,Parking',4),(7,'City Central Hotel',16,1380000.00,'WiFi,Gym,Bar',4),(8,'Blue Lagoon',17,1650000.00,'WiFi,Pool,Spa',5),(9,'Comfort Stay',18,650000.00,'WiFi,Parking',3),(10,'Royal Heritage',10,1950000.00,'WiFi,Pool,Gym,Spa',5),(11,'Harmony Suites',11,890000.00,'WiFi,Gym',4),(12,'Luxury Line Hotel',12,2500000.00,'WiFi,Pool,Gym,Spa,Bar,Parking',5),(13,'Golden Nights',13,1550000.00,'WiFi,Bar,Pool',4),(14,'Maple Residency',14,980000.00,'WiFi,Parking,Gym',4),(15,'Urban Nest',15,1030000.00,'WiFi,Gym',4),(16,'Coral Bay',16,1750000.00,'WiFi,Pool,Spa',5),(17,'Elite Comfort',17,1220000.00,'WiFi,Parking,Gym',4),(18,'Cityscape Inn',18,1190000.00,'WiFi,Gym,Parking',4),(19,'Sunset Boulevard',10,1450000.00,'WiFi,Pool',4),(20,'Amber Woods',11,870000.00,'WiFi,Parking,Gym',4),(21,'The Riverfront',12,1690000.00,'WiFi,Pool,Spa,Gym',5),(22,'Nightfall Hotel',13,780000.00,'WiFi,Parking',3),(23,'Crystal Crown',14,2100000.00,'WiFi,Pool,Spa,Gym',5),(24,'Grand Bay Inn',15,1090000.00,'WiFi,Gym,Bar',4),(25,'Emerald Hills',16,1850000.00,'WiFi,Pool,Spa,Parking',5),(26,'Pearl View',17,1590000.00,'WiFi,Pool,Gym',4),(27,'The Downtown Hub',18,950000.00,'WiFi,Gym',4),(28,'Shoreline Suites',10,1280000.00,'WiFi,Pool,Gym',4),(29,'Olive Garden Hotel',11,1150000.00,'WiFi,Parking,Gym',4),(30,'Diamond Edge',12,1980000.00,'WiFi,Pool,Spa,Gym,Bar',5);
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
  `usersEmail` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `usersuid` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `userspwd` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-22 21:12:38

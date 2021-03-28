-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: ulekare
-- ------------------------------------------------------
-- Server version	5.5.5-10.2.14-MariaDB-10.2.14+maria~jessie

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form`
--

LOCK TABLES `form` WRITE;
/*!40000 ALTER TABLE `form` DISABLE KEYS */;
/*!40000 ALTER TABLE `form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_item_type`
--

DROP TABLE IF EXISTS `form_item_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `form_item`
--

DROP TABLE IF EXISTS `form_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `form_item_type_id` int(11) NOT NULL,
  `placeholder` text DEFAULT NULL,
  `tooltip` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_item_form_id_fk` (`form_id`),
  KEY `form_item_form_item_type_id_fk` (`form_item_type_id`),
  CONSTRAINT `form_item_form_id_fk` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`),
  CONSTRAINT `form_item_form_item_type_id_fk` FOREIGN KEY (`form_item_type_id`) REFERENCES `form_item_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_item`
--

LOCK TABLES `form_item` WRITE;
/*!40000 ALTER TABLE `form_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `form_item_type`
--

LOCK TABLES `form_item_type` WRITE;
/*!40000 ALTER TABLE `form_item_type` DISABLE KEYS */;
INSERT INTO `form_item_type` VALUES (1,'text'),(2,'textarea'),(3,'checkbox'),(4,'multiple_checkbox'),(5,'radio'),(6,'select'),(7,'mutliple_select');
/*!40000 ALTER TABLE `form_item_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_result`
--

DROP TABLE IF EXISTS `form_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_item_id` int(11) DEFAULT NULL,
  `result` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_result_form_item_id_fk` (`form_item_id`),
  CONSTRAINT `form_result_form_item_id_fk` FOREIGN KEY (`form_item_id`) REFERENCES `form_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_result`
--

LOCK TABLES `form_result` WRITE;
/*!40000 ALTER TABLE `form_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_result` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-28 16:52:01

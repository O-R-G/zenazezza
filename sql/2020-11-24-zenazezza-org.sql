-- MySQL dump 10.13  Distrib 5.7.29, for osx10.14 (x86_64)
--
-- Host: localhost    Database: zenazezza_local
-- ------------------------------------------------------
-- Server version	5.7.29

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
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `object` int(10) unsigned DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `rank` int(10) unsigned DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'jpg',
  `caption` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objects`
--

DROP TABLE IF EXISTS `objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `rank` int(10) unsigned DEFAULT NULL,
  `name1` tinytext,
  `name2` tinytext,
  `address1` text,
  `address2` text,
  `city` tinytext,
  `state` tinytext,
  `zip` tinytext,
  `country` tinytext,
  `phone` tinytext,
  `fax` tinytext,
  `url` tinytext,
  `email` tinytext,
  `begin` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `head` tinytext,
  `deck` mediumblob,
  `body` mediumblob,
  `notes` mediumblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objects`
--

LOCK TABLES `objects` WRITE;
/*!40000 ALTER TABLE `objects` DISABLE KEYS */;
INSERT INTO `objects` VALUES (1,1,'2020-11-23 22:15:51','2020-11-23 23:00:31',NULL,'About',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'about',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								',_binary '<div>Zena Zezza is a project directed by Sandra Percival.</div><div><br></div><div><br></div><div>Zena Zezza is a contemporary art project that supports and presents the work of artists—their ideas, influences and the questions they raise. Each Artist Project Season produces an exhibition and an integrated series of discursive and performative events to stimulate new ways of thinking about art and contemporary culture. Zena encourages critical thinking through collaborating with academic and cultural institutions and presents unusual opportunities for conviviality and public conversation.</div><div><br></div><div>Zena Zezza is a 501c3 nonprofit organization in Portland, Oregon.</div>\r\n																								',_binary '\r\n																								'),(2,1,'2020-11-23 22:15:59','2020-11-23 23:37:32',NULL,'Current',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'current',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								',_binary '<div>Zena Zezza is currently taking this time to research and plan our next Artist Project Season.</div><div><br></div><div><br></div><div>During this hiatus, please take time to watch and listen to posted event recordings from Artist Project Seasons with Josiah McElheny and Anthony McCall.</div><div><br></div><div>Special events which profile performance, music and writing include McElheny\'s \"Light Club Party\" and \"Soup and Tart\" held during McCall\'s season.</div><div><br></div><div>We\'re currently working to edit past events from recent seasons.</div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div><br></div><div>For announcement of news and upcoming events please SUBSCRIBE to Zena\'s e-list.</div>',_binary '\r\n																								'),(3,1,'2020-11-23 22:16:07','2020-11-23 22:16:07',NULL,'Past',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'past',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'2020-11-23 22:16:16','2020-11-23 22:16:16',NULL,'Support',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'support',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,'2020-11-23 22:16:25','2020-11-23 22:16:25',NULL,'Subscribe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'subscribe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,1,'2020-11-23 23:37:54','2020-11-23 23:37:54',NULL,'Book for Purchase',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'book-for-purchase',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wires`
--

DROP TABLE IF EXISTS `wires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `fromid` int(10) unsigned DEFAULT NULL,
  `toid` int(10) unsigned DEFAULT NULL,
  `weight` float NOT NULL DEFAULT '1',
  `notes` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wires`
--

LOCK TABLES `wires` WRITE;
/*!40000 ALTER TABLE `wires` DISABLE KEYS */;
INSERT INTO `wires` VALUES (1,1,'2020-11-23 22:15:51','2020-11-23 22:15:51',0,1,1,NULL),(2,1,'2020-11-23 22:15:59','2020-11-23 22:15:59',0,2,1,NULL),(3,1,'2020-11-23 22:16:07','2020-11-23 22:16:07',0,3,1,NULL),(4,1,'2020-11-23 22:16:16','2020-11-23 22:16:16',0,4,1,NULL),(5,1,'2020-11-23 22:16:25','2020-11-23 22:16:25',0,5,1,NULL),(6,1,'2020-11-23 23:37:54','2020-11-23 23:37:54',2,6,1,NULL);
/*!40000 ALTER TABLE `wires` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-24 12:42:11

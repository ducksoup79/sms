-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sms
-- ------------------------------------------------------
-- Server version	5.5.55-0ubuntu0.14.04.1

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
-- Table structure for table `corrective_action_plan`
--

DROP TABLE IF EXISTS `corrective_action_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `corrective_action_plan` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `occurence_num` int(10) DEFAULT NULL,
  `notification_date` date DEFAULT NULL,
  `notification_received` date DEFAULT NULL,
  `notification_details` text,
  `suggested_corrective_action` text,
  `action_to_be_taken` text,
  `target_date` date DEFAULT NULL,
  `action_taken` text,
  `date_completed` date DEFAULT NULL,
  `responsible_person` varchar(30) DEFAULT NULL,
  `date_closed` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corrective_action_plan`
--

LOCK TABLES `corrective_action_plan` WRITE;
/*!40000 ALTER TABLE `corrective_action_plan` DISABLE KEYS */;
INSERT INTO `corrective_action_plan` VALUES (1,1,'2009-08-24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `corrective_action_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `description`
--

DROP TABLE IF EXISTS `description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `description` (
  `desc_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`desc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `description`
--

LOCK TABLES `description` WRITE;
/*!40000 ALTER TABLE `description` DISABLE KEYS */;
INSERT INTO `description` VALUES (23,''),(24,'GO AROUND'),(25,'CARGO DOOR OPEN'),(26,'ANIMALS ON THE RUNWAY'),(27,'SLIPPERY RUNWAY'),(28,'FLATT TYRE');
/*!40000 ALTER TABLE `description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hazard_reports`
--

DROP TABLE IF EXISTS `hazard_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hazard_reports` (
  `hazreport_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hazard_num` varchar(15) DEFAULT NULL,
  `haz_date` date DEFAULT NULL,
  `aircraft_reg` varchar(6) DEFAULT NULL,
  `aircraft_type` varchar(5) DEFAULT NULL,
  `departure` varchar(10) DEFAULT NULL,
  `arrival` varchar(10) DEFAULT NULL,
  `hazard_detail` text,
  `name` varchar(20) DEFAULT NULL,
  `tel_number` int(10) DEFAULT NULL,
  `e_mail` varchar(30) DEFAULT NULL,
  `lic_number` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `target_date` date DEFAULT NULL,
  `date_closed` date DEFAULT NULL,
  `person_responsible` varchar(20) DEFAULT NULL,
  `feedback` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`hazreport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hazard_reports`
--

LOCK TABLES `hazard_reports` WRITE;
/*!40000 ALTER TABLE `hazard_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `hazard_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hazards`
--

DROP TABLE IF EXISTS `hazards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hazards` (
  `haz_id` int(11) NOT NULL AUTO_INCREMENT,
  `haz_num` int(10) DEFAULT NULL,
  `haz_date` date DEFAULT NULL,
  `aircraft_reg` varchar(5) DEFAULT NULL,
  `aircraft_type` varchar(10) DEFAULT NULL,
  `departure` varchar(20) DEFAULT NULL,
  `destination` varchar(20) DEFAULT NULL,
  `description` text,
  `reporter_name` varchar(20) DEFAULT NULL,
  `lic_number` varchar(10) DEFAULT NULL,
  `e_mail` varchar(30) DEFAULT NULL,
  `contact_number` varchar(10) DEFAULT NULL,
  `target_date` date DEFAULT NULL,
  `closed_date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`haz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hazards`
--

LOCK TABLES `hazards` WRITE;
/*!40000 ALTER TABLE `hazards` DISABLE KEYS */;
INSERT INTO `hazards` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,'loose runway markers',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `hazards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incident_reports`
--

DROP TABLE IF EXISTS `incident_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incident_reports` (
  `inc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inc_num` varchar(15) DEFAULT NULL,
  `inc_date` date DEFAULT NULL,
  `inc_time` time DEFAULT NULL,
  `duty_time` time DEFAULT NULL,
  `flight_time` time DEFAULT NULL,
  `location` varchar(10) DEFAULT NULL,
  `aircraft_reg` varchar(6) DEFAULT NULL,
  `aircraft_type` varchar(5) DEFAULT NULL,
  `departure` varchar(10) DEFAULT NULL,
  `destination` varchar(10) DEFAULT NULL,
  `type_flight` varchar(30) DEFAULT NULL,
  `phase` varchar(20) DEFAULT NULL,
  `airspeed` varchar(6) DEFAULT NULL,
  `altitude` int(10) DEFAULT NULL,
  `heading` int(3) DEFAULT NULL,
  `flight_rules` varchar(3) DEFAULT NULL,
  `flight_conditions` varchar(3) DEFAULT NULL,
  `turbulance` varchar(10) DEFAULT NULL,
  `winds_gusts` varchar(10) DEFAULT NULL,
  `rain` varchar(10) DEFAULT NULL,
  `other_info` varchar(100) DEFAULT NULL,
  `pic` varchar(30) DEFAULT NULL,
  `training_captain` varchar(30) DEFAULT NULL,
  `description_mulf_item` varchar(100) DEFAULT NULL,
  `details_mulf_item` varchar(100) DEFAULT NULL,
  `event_description` text,
  `name` varchar(30) DEFAULT NULL,
  `lic_number` varchar(10) DEFAULT NULL,
  `contact_number` int(20) DEFAULT NULL,
  `e_mail` varchar(30) DEFAULT NULL,
  `report_date` datetime DEFAULT NULL,
  `target_Date` date DEFAULT NULL,
  `closed_date` datetime DEFAULT NULL,
  `closed_responsible` int(1) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `feedback` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`inc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incident_reports`
--

LOCK TABLES `incident_reports` WRITE;
/*!40000 ALTER TABLE `incident_reports` DISABLE KEYS */;
INSERT INTO `incident_reports` VALUES (1,'i439','2018-01-01','10:55:00','05:00:00','02:10:00','FBMN','A2-SAA','GA8','FBSV','FBMN','Non-scheduled','Approach','80 kts',3400,260,'VFR','VMC','Light','200/06','None','','Gellie Burger','not','','','Upon arrival we were cleared to proceed to the active runway 26.We were the handed over to Tower on 118.7 and were instructed to continue to final approach runway 26.We were number 2 in sequence at this stage.We then advised tower that we don\'t have number one visual and that caused some concern because we should have each other visual at this stage.I then frantically started looking for the number one traffic and requested his position.He then stated that he is on final approach for runway 08(non-active runway). I then saw him as he was approaching for runway 08 and immediately requested to turn to the right. Maun Tower approved my request and I re-positioned myself for runway 26.Tower cleared the Caravan to land since he cant do a go-around due to the fact that he will be flying straight for me.\r\n\r\nThe aircraft that was involved was a Wilderness Air Caravan(C208B) and the suspected call sign was A2-LZD.The pilot involved in the incident was Trent Landsman.','Gellie','CA2107217',76344184,'safaripilot7@gmail.com','2018-01-02 00:00:00','0000-00-00','0000-00-00 00:00:00',0,'open','pending');
/*!40000 ALTER TABLE `incident_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incidents`
--

DROP TABLE IF EXISTS `incidents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incidents` (
  `inc_id` int(11) NOT NULL AUTO_INCREMENT,
  `inc_num` int(10) DEFAULT NULL,
  `inc_date` date DEFAULT NULL,
  `inc_time` datetime DEFAULT NULL,
  `inc_location` varchar(20) DEFAULT NULL,
  `aircraft_reg` varchar(5) DEFAULT NULL,
  `aircraft_type` varchar(10) DEFAULT NULL,
  `departure` varchar(20) DEFAULT NULL,
  `destination` varchar(20) DEFAULT NULL,
  `type_of_flight` varchar(15) DEFAULT NULL,
  `phase_of_flight` varchar(20) DEFAULT NULL,
  `flight_rules` varchar(3) DEFAULT NULL,
  `flight_conditions` varchar(3) DEFAULT NULL,
  `pic` varchar(20) DEFAULT NULL,
  `t_captain` varchar(20) DEFAULT NULL,
  `description` text,
  `reporter_name` varchar(20) DEFAULT NULL,
  `lic_number` varchar(10) DEFAULT NULL,
  `e_mail` varchar(30) DEFAULT NULL,
  `contact_number` varchar(10) DEFAULT NULL,
  `target_date` date DEFAULT NULL,
  `closed_date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `closed_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`inc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incidents`
--

LOCK TABLES `incidents` WRITE;
/*!40000 ALTER TABLE `incidents` DISABLE KEYS */;
INSERT INTO `incidents` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `incidents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) DEFAULT NULL,
  `user_surname` varchar(20) NOT NULL,
  `pass` varchar(40) DEFAULT NULL,
  `user_role` varchar(10) DEFAULT NULL,
  `e_mail` varchar(30) NOT NULL,
  `cell` varchar(15) NOT NULL,
  `lic_num` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user` (`user_name`(6))
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (3,'admin','admin','e2db6c26e2dd1d3141d84728a19ec17e','admin','safaripilot1@gmail.com','71326459','CA265306'),(4,'Johannes','Groenewald','ee11cbb19052e40b07aac0ca060c23ee','user','safaripilot1@gmail.com','71326459','CA265306'),(5,'Moshe','Batshidi','1bc205f2272863efdb9f1c1cc3f59237','user','safaripilot2@gmail.com','77581993','CA295715'),(6,'Wynand','van Niekerk','9c75233eae8fbedcc7eb43a34ab77b31','user','safaripilot4@gmail.com','75059851','CA299216'),(7,'JD','Potgieter','3f5944d01e61c33c688abe708b5ab806','user','safaripilot5@gmail.com','71558473','CV215'),(8,'Bakang','Botlhole','22251c6f1b9c1f32abf181e29e676a87','user','safaripilot6@gmail.com','76663337','CA2102717'),(9,'Gellie','Burger','4b583fa1bfd9a2367c15291a3bc1c8e1','user','safaripilot7@gmail.com','76344184','CA2107217'),(10,'Gerald','Garth','a9815e9c1d91136095f0062e9ffe8c9a','user','safaripilot8@gmail.com','74835742','CA2103617'),(11,'Neelo','Garwe','d21ef1fa7f119bf30040ceed7fa38fa1','user','safaripilot10@gmail.com','73614042','CA2102116'),(12,'Phenyo','Kgaimena','fd69c35a5501c35523779c89683ec5e4','user','safaripilot11@gmail.com','75310423','CA296816'),(13,'Derrick','Kabelo','8cd3b4a4ccf86abb76fe0b09421fb80a','user','safaripilot12@gmail.com','71522228','CA298316'),(14,'Lloyd','Bartlett','65a423f3c447917d0ca4a15abdf309e5','user','safaripilot13@gmail.com','72513028','CA252005');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risk_assesment`
--

DROP TABLE IF EXISTS `risk_assesment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risk_assesment` (
  `assm_id` int(11) NOT NULL AUTO_INCREMENT,
  `occurence_num` varchar(15) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `category` varchar(15) DEFAULT NULL,
  `hazards` int(11) DEFAULT NULL,
  `hazard1` varchar(125) DEFAULT NULL,
  `risk1` int(3) DEFAULT NULL,
  `hazard2` varchar(125) DEFAULT NULL,
  `risk2` int(3) DEFAULT NULL,
  `hazard3` varchar(125) DEFAULT NULL,
  `risk3` int(3) DEFAULT NULL,
  `hazard4` varchar(125) DEFAULT NULL,
  `risk4` int(3) DEFAULT NULL,
  `total_risk` int(3) DEFAULT NULL,
  `root_cause` text,
  `defence` text,
  `defence_req` text,
  `action_taken` text,
  `risk_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`assm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risk_assesment`
--

LOCK TABLES `risk_assesment` WRITE;
/*!40000 ALTER TABLE `risk_assesment` DISABLE KEYS */;
INSERT INTO `risk_assesment` VALUES (1,'i439','','',0,'',0,'',0,'',0,'',0,0,'','','','',''),(2,'i439','','',0,'',0,'',0,'',0,'',0,0,'','','','',''),(3,'i439','','',0,'',0,'',0,'',0,'',0,0,'','','','','');
/*!40000 ALTER TABLE `risk_assesment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-02  6:19:29

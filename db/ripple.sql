-- MySQL dump 10.16  Distrib 10.1.25-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: fluenterp
-- ------------------------------------------------------
-- Server version	10.1.25-MariaDB

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `recnum` int(11) DEFAULT NULL,
  `id` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `tsymbol` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `employees` varchar(100) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `ownership` varchar(100) DEFAULT NULL,
  `annual_revenue` int(11) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `stccode` varchar(100) DEFAULT NULL,
  `addr1` varchar(255) DEFAULT NULL,
  `addr2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `baddr1` varchar(255) DEFAULT NULL,
  `baddr2` varchar(255) DEFAULT NULL,
  `bcity` varchar(100) DEFAULT NULL,
  `bstate` varchar(100) DEFAULT NULL,
  `bzipcode` varchar(100) DEFAULT NULL,
  `bcountry` varchar(100) DEFAULT NULL,
  `saddr1` varchar(255) DEFAULT NULL,
  `saddr2` varchar(255) DEFAULT NULL,
  `scity` varchar(100) DEFAULT NULL,
  `sstate` varchar(100) DEFAULT NULL,
  `szipcode` varchar(100) DEFAULT NULL,
  `scountry` varchar(100) DEFAULT NULL,
  `l1address` int(11) DEFAULT NULL,
  `l2address` int(11) DEFAULT NULL,
  `company2parent_company` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accp_rating`
--

DROP TABLE IF EXISTS `accp_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accp_rating` (
  `recnum` int(11) DEFAULT NULL,
  `crn` varchar(50) DEFAULT NULL,
  `relase_note` varchar(255) DEFAULT NULL,
  `qa_date` date DEFAULT NULL,
  `qty_disp` int(11) DEFAULT NULL,
  `inspected_by` varchar(255) DEFAULT NULL,
  `qty_accp` int(11) DEFAULT NULL,
  `wonum` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accp_rating`
--

LOCK TABLES `accp_rating` WRITE;
/*!40000 ALTER TABLE `accp_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `accp_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activeusers_log`
--

DROP TABLE IF EXISTS `activeusers_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activeusers_log` (
  `userid` varchar(8) DEFAULT NULL,
  `session` varchar(50) DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `activity` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activeusers_log`
--

LOCK TABLES `activeusers_log` WRITE;
/*!40000 ALTER TABLE `activeusers_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `activeusers_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `recnum` int(11) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `zipcode` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adv_lic`
--

DROP TABLE IF EXISTS `adv_lic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adv_lic` (
  `adv_license` varchar(50) DEFAULT NULL,
  `lic_date` date DEFAULT NULL,
  `recnum` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adv_lic`
--

LOCK TABLES `adv_lic` WRITE;
/*!40000 ALTER TABLE `adv_lic` DISABLE KEYS */;
/*!40000 ALTER TABLE `adv_lic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advlic_li`
--

DROP TABLE IF EXISTS `advlic_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advlic_li` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `item_num` varchar(50) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `crn` varchar(50) DEFAULT NULL,
  `link2adv` int(11) DEFAULT NULL,
  `qty2make` int(11) DEFAULT NULL,
  `qty_imp` int(11) DEFAULT NULL,
  `imp_bal` int(11) DEFAULT NULL,
  `exp_bal` int(11) DEFAULT NULL,
  `tariff` int(11) DEFAULT NULL,
  `rm_spec` varchar(255) DEFAULT NULL,
  `rm_size` varchar(50) DEFAULT NULL,
  `wastage` float DEFAULT NULL,
  `assessmnt_value` decimal(5,2) DEFAULT NULL,
  `cif_value` decimal(5,2) DEFAULT NULL,
  `rate` decimal(5,2) DEFAULT NULL,
  `be_no` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advlic_li`
--

LOCK TABLES `advlic_li` WRITE;
/*!40000 ALTER TABLE `advlic_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `advlic_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `allot_crn`
--

DROP TABLE IF EXISTS `allot_crn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allot_crn` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` varchar(20) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `partname` varchar(30) DEFAULT NULL,
  `attachments` varchar(50) DEFAULT NULL,
  `drg_issue` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allot_crn`
--

LOCK TABLES `allot_crn` WRITE;
/*!40000 ALTER TABLE `allot_crn` DISABLE KEYS */;
/*!40000 ALTER TABLE `allot_crn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amendment`
--

DROP TABLE IF EXISTS `amendment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amendment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amendment` text,
  `cr_date` date DEFAULT NULL,
  `link2so` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amendment`
--

LOCK TABLES `amendment` WRITE;
/*!40000 ALTER TABLE `amendment` DISABLE KEYS */;
/*!40000 ALTER TABLE `amendment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_license`
--

DROP TABLE IF EXISTS `app_license`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_license` (
  `recnum` int(11) DEFAULT NULL,
  `app_name` varchar(100) DEFAULT NULL,
  `maxlicense_num` int(11) DEFAULT NULL,
  `license_reg` varchar(100) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_license`
--

LOCK TABLES `app_license` WRITE;
/*!40000 ALTER TABLE `app_license` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_license` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appendixc`
--

DROP TABLE IF EXISTS `appendixc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appendixc` (
  `recnum` int(11) DEFAULT NULL,
  `exportinvnum` varchar(255) DEFAULT NULL,
  `totnumpkgs` varchar(45) DEFAULT NULL,
  `link2customer` int(10) unsigned DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `siteid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appendixc`
--

LOCK TABLES `appendixc` WRITE;
/*!40000 ALTER TABLE `appendixc` DISABLE KEYS */;
INSERT INTO `appendixc` VALUES (1,'233','2',130,'2016-11-02',NULL,NULL);
/*!40000 ALTER TABLE `appendixc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arform`
--

DROP TABLE IF EXISTS `arform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arform` (
  `recnum` int(10) unsigned DEFAULT NULL,
  `link2invoice` int(10) unsigned DEFAULT NULL,
  `ar3anum` varchar(45) DEFAULT NULL,
  `ar3adate` date DEFAULT NULL,
  `exchangerate` float DEFAULT NULL,
  `valueinwords` varchar(255) DEFAULT NULL,
  `dutyinwords` varchar(255) DEFAULT NULL,
  `totalrupees` float DEFAULT NULL,
  `totalusd` float unsigned DEFAULT NULL,
  `totqty` int(10) unsigned DEFAULT NULL,
  `numpkgs` varchar(100) DEFAULT NULL,
  `grosswt` float DEFAULT NULL,
  `total_payableamt` float DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `link2ship` int(11) DEFAULT NULL,
  `vatsubtotal` float DEFAULT NULL,
  `siteid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arform`
--

LOCK TABLES `arform` WRITE;
/*!40000 ALTER TABLE `arform` DISABLE KEYS */;
INSERT INTO `arform` VALUES (5,1,'AR3A-163/16-17','2016-11-09',100,'Ten Thousand','Two Thousand Two Hundred and Eigthy-Five',10000,100,1,'',0,2285,'2016-11-02',NULL,130,100,NULL);
/*!40000 ALTER TABLE `arform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arform_line_items`
--

DROP TABLE IF EXISTS `arform_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arform_line_items` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link2arform` int(10) unsigned DEFAULT NULL,
  `statcode` varchar(255) DEFAULT NULL,
  `marknum` varchar(255) DEFAULT NULL,
  `qty` int(10) unsigned DEFAULT NULL,
  `warehousedate` date DEFAULT NULL,
  `valueusd` float DEFAULT NULL,
  `rate` varchar(25) DEFAULT NULL,
  `payableusd` float DEFAULT NULL,
  `remarks` text,
  `line_num` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arform_line_items`
--

LOCK TABLES `arform_line_items` WRITE;
/*!40000 ALTER TABLE `arform_line_items` DISABLE KEYS */;
INSERT INTO `arform_line_items` VALUES (6,5,' 3434 dfdf ','  ',1,'0000-00-00',100,'  ',500,'  ',1),(7,5,'  ','  ',0,'0000-00-00',0,'  ',1312.5,'  ',2),(8,5,'  ','  ',0,'0000-00-00',0,'  ',0,'  ',3),(9,5,'  ','  ',0,'0000-00-00',0,'  ',472.5,'  ',4);
/*!40000 ALTER TABLE `arform_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assy_part_status`
--

DROP TABLE IF EXISTS `assy_part_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assy_part_status` (
  `fromsl` varchar(15) DEFAULT NULL,
  `tosl` varchar(15) DEFAULT NULL,
  `samplingsl` varchar(255) DEFAULT NULL,
  `rework` varchar(255) DEFAULT NULL,
  `acc` varchar(255) DEFAULT NULL,
  `rej` varchar(255) DEFAULT NULL,
  `ret` varchar(255) DEFAULT NULL,
  `stage` varchar(255) DEFAULT NULL,
  `inspnum` varchar(255) DEFAULT NULL,
  `signoff` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `link2assywo` int(11) DEFAULT NULL,
  `line_num` int(11) DEFAULT NULL,
  `recno` int(11) NOT NULL AUTO_INCREMENT,
  `st_date` date DEFAULT NULL,
  PRIMARY KEY (`recno`),
  KEY `wo_wps` (`link2assywo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assy_part_status`
--

LOCK TABLES `assy_part_status` WRITE;
/*!40000 ALTER TABLE `assy_part_status` DISABLE KEYS */;
INSERT INTO `assy_part_status` VALUES ('1','1','1','','1','','','fi','test','','',2563,1,1,'2017-11-23'),('1','1','1','','1','','','fi','test','','',2564,1,2,'2017-11-24'),('1','1','1','','1','','','fi','test','','',2565,1,3,'2017-11-30'),('1','1','1','','1','','','fi','tut','tyuty','tyuytu',2599,1,4,'2017-12-05');
/*!40000 ALTER TABLE `assy_part_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assy_processdetails`
--

DROP TABLE IF EXISTS `assy_processdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assy_processdetails` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `line_num` varchar(45) DEFAULT NULL,
  `process` varchar(70) DEFAULT NULL,
  `st_date_time` datetime DEFAULT NULL,
  `end_date_time` datetime DEFAULT NULL,
  `other_details` varchar(255) DEFAULT NULL,
  `link2assywo` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assy_processdetails`
--

LOCK TABLES `assy_processdetails` WRITE;
/*!40000 ALTER TABLE `assy_processdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `assy_processdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assy_review`
--

DROP TABLE IF EXISTS `assy_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assy_review` (
  `recnum` int(11) NOT NULL,
  `cust_ponum` varchar(100) NOT NULL,
  `customer` int(11) NOT NULL,
  `po_date` date NOT NULL,
  `quote_ref` varchar(100) NOT NULL,
  `poline` varchar(50) NOT NULL,
  `amendment_num` varchar(50) NOT NULL,
  `amendment_date` date NOT NULL,
  `review_ref` varchar(50) NOT NULL,
  `review_date` date NOT NULL,
  `ord_type` varchar(150) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `order_for` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `source_raw_material` varchar(150) NOT NULL,
  `agreement` varchar(200) NOT NULL,
  `project` varchar(200) NOT NULL,
  `technical_requirement` varchar(255) NOT NULL,
  `quality_requirement` varchar(255) NOT NULL,
  `controlled` varchar(255) NOT NULL,
  `doc_req` varchar(255) NOT NULL,
  `spec_req` varchar(255) NOT NULL,
  `cust_agr` varchar(255) NOT NULL,
  `app_cust` varchar(255) NOT NULL,
  `item_req` varchar(255) NOT NULL,
  `item_app` varchar(255) NOT NULL,
  `sup_item` varchar(200) NOT NULL,
  `delivery` varchar(150) NOT NULL,
  `risk` varchar(200) NOT NULL,
  `resources` varchar(200) NOT NULL,
  `env` varchar(200) NOT NULL,
  `others` varchar(200) NOT NULL,
  `act_out` varchar(255) DEFAULT NULL,
  `outsourcing_activities` varchar(255) DEFAULT NULL,
  `formatnum` varchar(150) NOT NULL,
  `formatrev` varchar(150) NOT NULL,
  `status` char(30) DEFAULT NULL,
  `special_instruction` longtext,
  `engineering_approved` char(5) DEFAULT NULL,
  `engg_app_by` varchar(45) DEFAULT NULL,
  `qa_approved` char(5) DEFAULT NULL,
  `qa_app_by` varchar(45) DEFAULT NULL,
  `val_status` char(10) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assy_review`
--

LOCK TABLES `assy_review` WRITE;
/*!40000 ALTER TABLE `assy_review` DISABLE KEYS */;
INSERT INTO `assy_review` VALUES (33,'AS-001',127,'2017-11-24','test','1','','0000-00-00','test','2017-11-24','','','','','','','','','','','','','','','','','','','','','','','','','F3004','Rev:01','Open','test','','','','',NULL,'FSI'),(34,'AS-002',134,'2017-11-25','','2','','0000-00-00','test','0000-00-00','','','','','','','','','','','','','','','','','','','','','','','','','F3004','Rev:01','Open','test','','','','',NULL,'FSI'),(35,'AS-003',127,'2017-11-22','','','','0000-00-00','','0000-00-00','','','','','','','','','','','','','','','','','','','','','','','','','F3004','Rev:01','Open','test','','','','',NULL,'FSI'),(36,'KARASSY-001',172,'2017-12-05','','','','0000-00-00','','0000-00-00','','','','','','','','','','','','','','','','','','','','','','','','','F3004','Rev:01','Open','fjhfghfg','','','','',NULL,'FSI');
/*!40000 ALTER TABLE `assy_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assy_review_li`
--

DROP TABLE IF EXISTS `assy_review_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assy_review_li` (
  `recnum` int(11) NOT NULL,
  `line_num` varchar(25) DEFAULT NULL,
  `assy_partnum` varchar(200) DEFAULT NULL,
  `assy_desc` varchar(255) DEFAULT NULL,
  `bomref` varchar(100) DEFAULT NULL,
  `bomiss` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `link2assyreview` int(11) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `crn` varchar(100) DEFAULT NULL,
  `pcrn` varchar(45) DEFAULT NULL,
  `ponum` varchar(100) DEFAULT NULL,
  `pi_attachments` varchar(255) DEFAULT NULL,
  `drg_iss` varchar(255) DEFAULT NULL,
  `cos_iss` varchar(255) DEFAULT NULL,
  `part_num` varchar(200) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `model_iss` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assy_review_li`
--

LOCK TABLES `assy_review_li` WRITE;
/*!40000 ALTER TABLE `assy_review_li` DISABLE KEYS */;
INSERT INTO `assy_review_li` VALUES (1060,'1','132','','BBOM/prn9','00',10,100,33,1000,'prn9','prn9','AS-001','','','','','',''),(1061,'1-1','132','','BBOM/prn9','00',10,0,33,0,'prn10','prn9','AS-001','','','','3243','dsf',''),(1062,'1-2','132','','BBOM/prn9','00',10,0,33,0,'prn1','prn9','AS-001','A','A','A','121','sss',''),(1063,'1-3','132','','BBOM/prn9','00',10,0,33,0,'prn3','prn9','AS-001','c','c','c','3434','dsds',''),(1064,'1-4','132','','BBOM/prn9','00',10,0,33,0,'1234','prn9','AS-001','','','','1234','test',''),(1065,'1-5','132','','BBOM/prn9','00',10,0,33,0,'BBOM/prn6','prn9','AS-001','','','','BBOM/prn6','testdf',''),(1066,'1-6','132','','BBOM/prn9','00',10,0,33,0,'test','prn9','AS-001','','','','','test',''),(1067,'1-7','132','','BBOM/prn9','00',20,0,33,0,'testdf','prn9','AS-001','','','','','testdf',''),(1068,'1','132','','BBOM/prn9','01',10,0,34,0,'prn9','prn9','AS-002','','','','','',''),(1069,'1-1','132','','BBOM/prn9','01',10,0,34,0,'prn10','prn9','AS-002','','','','3243','dsf',''),(1070,'1-2','132','','BBOM/prn9','01',10,0,34,0,'prn1','prn9','AS-002','A','A','A','121','sss',''),(1071,'1-3','132','','BBOM/prn9','01',10,0,34,0,'prn3','prn9','AS-002','c','c','c','3434','dsds',''),(1072,'1-4','132','','BBOM/prn9','01',10,0,34,0,'1234','prn9','AS-002','','','','1234','test',''),(1073,'1-5','132','','BBOM/prn9','01',10,0,34,0,'BBOM/prn6','prn9','AS-002','','','','BBOM/prn6','testdf',''),(1074,'1-6','132','','BBOM/prn9','01',10,0,34,0,'test','prn9','AS-002','','','','','test',''),(1075,'1-7','132','','BBOM/prn9','01',20,0,34,0,'testdf','prn9','AS-002','','','','','testdf',''),(1076,'1','3243','','BBOM/prn10','00',10,0,35,0,'prn10','prn10','AS-003','','','','','',''),(1077,'1-1','3243','','BBOM/prn10','00',10,0,35,0,'prn9','prn10','AS-003','','','','132','asd',''),(1078,'1-2','3243','','BBOM/prn10','00',10,0,35,0,'prn1','prn10','AS-003','A','A','A','121','sss',''),(1079,'1-3','3243','','BBOM/prn10','00',10,0,35,0,'BBOM/prn6','prn10','AS-003','','','','BBOM/prn6','testdf',''),(1080,'1-4','3243','','BBOM/prn10','00',10,0,35,0,'test','prn10','AS-003','','','','','test',''),(1081,'1','flu-boi-001','new bom','BBOM/flu-assy-001','00',100,0,36,0,'flu-assy-001','flu-assy-001','KARASSY-001','','','','','',''),(1082,'1-1','flu-boi-001','new bom','BBOM/flu-assy-001','00',100,0,36,0,'flu-001','flu-assy-001','KARASSY-001','A','A','A','flu 00 100','fluent part',''),(1083,'1-2','flu-boi-001','new bom','BBOM/flu-assy-001','00',100,0,36,0,'rmk 00 12','flu-assy-001','KARASSY-001','A','','','rmk 00 12','ghdsgh',''),(1084,'1-3','flu-boi-001','new bom','BBOM/flu-assy-001','00',100,0,36,0,'dghsdd','flu-assy-001','KARASSY-001','','','','ghg','dghsdd','');
/*!40000 ALTER TABLE `assy_review_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assy_wo`
--

DROP TABLE IF EXISTS `assy_wo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assy_wo` (
  `recnum` int(11) NOT NULL DEFAULT '0',
  `assy_wonum` varchar(50) DEFAULT NULL,
  `assydate` date DEFAULT NULL,
  `woqty` int(11) DEFAULT NULL,
  `crn` varchar(50) DEFAULT NULL,
  `link2cust` int(11) DEFAULT NULL,
  `ponum` varchar(100) DEFAULT NULL,
  `poqty` int(11) DEFAULT NULL,
  `assypartnum` varchar(100) DEFAULT NULL,
  `assypartiss` varchar(100) DEFAULT NULL,
  `assyqty` int(11) DEFAULT NULL,
  `bomnum` varchar(50) DEFAULT NULL,
  `bomiss` varchar(50) DEFAULT NULL,
  `apsnum` varchar(50) DEFAULT NULL,
  `apsiss` varchar(50) DEFAULT NULL,
  `cosno` varchar(50) DEFAULT NULL,
  `drgno` varchar(50) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `drgiss` varchar(50) DEFAULT NULL,
  `formatnum` varchar(255) DEFAULT NULL,
  `formatrev` varchar(255) DEFAULT NULL,
  `comp_qty` int(11) DEFAULT '0',
  `sch_due_date` date DEFAULT NULL,
  `revised_ship_date` date DEFAULT NULL,
  `actual_ship_date` date DEFAULT NULL,
  `assy_partname` varchar(255) DEFAULT NULL,
  `attachments` varchar(255) DEFAULT NULL,
  `cos` varchar(255) DEFAULT NULL,
  `format_num` varchar(255) DEFAULT NULL,
  `format_rev` varchar(255) DEFAULT NULL,
  `mpsnumber` varchar(45) DEFAULT NULL,
  `mps_rev` varchar(45) DEFAULT NULL,
  `fai` varchar(45) DEFAULT NULL,
  `link2mps` int(10) unsigned DEFAULT NULL,
  `status` char(20) DEFAULT NULL,
  `cust_po_line_num` char(10) DEFAULT NULL,
  `type_remarks` text,
  `assy_type` varchar(45) DEFAULT NULL,
  `dispatch_qty` int(11) DEFAULT '0',
  `kit_qty` int(11) NOT NULL DEFAULT '0',
  `rework_grn` varchar(45) DEFAULT NULL,
  `rej_qty` int(11) DEFAULT '0',
  `ret_qty` int(11) DEFAULT '0',
  `cust_rej_qty` int(11) DEFAULT '0',
  `siteid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assy_wo`
--

LOCK TABLES `assy_wo` WRITE;
/*!40000 ALTER TABLE `assy_wo` DISABLE KEYS */;
INSERT INTO `assy_wo` VALUES (2618,'A02618','2017-12-22',0,'prn9',127,'AS-001',10,'132','C',1,'BBOM/prn9','01','','','C','','','C',NULL,NULL,0,'2017-12-22','0000-00-00','0000-00-00',NULL,NULL,NULL,'F7035','Rev 1 dt 30 August, 2012 Process Details','','20','FAIR',2313,'Open','1','Type is FAIR because of the first WO for the CRN','Assembly',0,0,'',0,0,0,'FSI'),(2619,'A02619','2017-12-22',0,'prn9',127,'AS-001',9,'132','C',1,'BBOM/prn9','01','','','C','','','C',NULL,NULL,0,'2017-12-22','0000-00-00','0000-00-00',NULL,NULL,NULL,'F7035','Rev 1 dt 30 August, 2012 Process Details','','20','FAIR',2313,'Open','1','Type is FAIR as of the status entered by QA','Assembly',0,0,'',0,0,0,'FSI');
/*!40000 ALTER TABLE `assy_wo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assypo`
--

DROP TABLE IF EXISTS `assypo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assypo` (
  `recnum` int(11) DEFAULT NULL,
  `assyPonum` varchar(100) DEFAULT NULL,
  `podate` date DEFAULT NULL,
  `link2vend` int(11) DEFAULT NULL,
  `link2host` int(11) DEFAULT NULL,
  `amnd_no` varchar(100) DEFAULT NULL,
  `amnd_date` date DEFAULT NULL,
  `amnd_notes` longtext,
  `approval` varchar(10) DEFAULT NULL,
  `approval_date` date DEFAULT NULL,
  `terms` text,
  `remarks` text,
  `poamount` float DEFAULT NULL,
  `shipping` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `labour` float DEFAULT NULL,
  `total_due` decimal(15,2) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `formatnum` varchar(50) DEFAULT NULL,
  `formatrev` varchar(50) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `po_desc` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `type` char(20) DEFAULT NULL,
  `approval_by` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assypo`
--

LOCK TABLES `assypo` WRITE;
/*!40000 ALTER TABLE `assypo` DISABLE KEYS */;
INSERT INTO `assypo` VALUES (215,'spo3','2016-05-11',2,1,'','2016-05-24','dsg \r\n \r\n \r\n \r\n \r\n','yes','2016-05-11','dg','sgd',1200,0,0,0,1200.00,'2016-05-11','2016-05-11','F7003-1','Rev 0','$','sawf','Open','Assembly','Sales'),(215,'spo3','2016-05-11',2,1,'','2016-05-24','dsg \r\n \r\n \r\n \r\n \r\n','yes','2016-05-11','dg','sgd',1200,0,0,0,1200.00,'2016-05-11','2016-05-11','F7003-1','Rev 0','$','sawf','Open','Assembly','Sales'),(216,'spo4','2016-05-04',2,1,'','2016-05-24','dsg \r\n \r\n \r\n \r\n','yes','2016-05-11','dg','sgd',1200,0,0,0,1200.00,'2016-05-11','2016-05-11','F7003-1','Rev 0','$','sawf','Open','Assembly','Sales'),(217,'spo1','2016-05-10',2,1,'','0000-00-00','sf \r\n','yes','2016-05-12','sff','ff',1200,0,0,0,1200.00,'2016-05-12','2016-05-12','F7003-1','Rev 0','$','dfsff','Open','Assembly','Sales'),(218,'spo6','2016-05-09',2,1,'','0000-00-00','saf \r\n \r\n','yes','2016-05-12','af','affgf',2300,0,0,0,2300.00,'2016-05-12','2016-05-13','F7003-1','Rev 0','$','sf','Open','Regular','Sales'),(219,'po1','2016-05-16',2,1,'','2016-05-18','fg \r\n \r\n \r\n','yes','2016-05-16','sfg','sg',1200,0,0,0,1200.00,'2016-05-16','2016-05-17','F7003-1','Rev 0','$','df','Open','Regular','Sales'),(220,'spo','2016-05-09',2,1,'','2016-05-16','saff \r\n \r\n \r\n \r\n \r\n','yes','2016-05-17','asf','safd',2200,0,0,0,2200.00,'2016-05-17','2016-05-17','F7003-1','Rev 0','$','saf','Open','Regular','Sales'),(221,'spo2','2016-05-09',2,1,'','2016-05-17',' \r\n','yes','2016-05-18','dsf','sfa',1000,0,0,0,1000.00,'2016-05-18','2016-05-18','F7003-1','Rev 0','$','dsg','Open','Regular','Sales'),(222,'1','2016-05-25',2,1,'','2016-05-31','sf \r\n','yes','2016-05-25','dv','sdg',2000,0,0,0,2000.00,'2016-05-25','2016-05-25','F7003-1','Rev 0','$','saf','Open','Regular','Sales'),(223,'qw2','2016-06-29',2,1,'','0000-00-00','',NULL,NULL,'dfg','et',100,0,0,0,100.00,'2016-06-29',NULL,'F7003-1','Rev 0','$','ret','Pending','Regular','');
/*!40000 ALTER TABLE `assypo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assypo_line_items`
--

DROP TABLE IF EXISTS `assypo_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assypo_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `lineNum` varchar(50) DEFAULT NULL,
  `crnNum` varchar(100) DEFAULT NULL,
  `priPartNum` varchar(255) DEFAULT NULL,
  `secPartNum` varchar(255) DEFAULT NULL,
  `partName` varchar(255) DEFAULT NULL,
  `partIss` varchar(100) DEFAULT NULL,
  `drg` varchar(100) DEFAULT NULL,
  `link2assyPo` int(11) DEFAULT NULL,
  `mtlSpec` varchar(255) DEFAULT NULL,
  `mtlType` varchar(255) DEFAULT NULL,
  `rmCondition` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `extPrice` decimal(15,2) DEFAULT NULL,
  `cos` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assypo_line_items`
--

LOCK TABLES `assypo_line_items` WRITE;
/*!40000 ALTER TABLE `assypo_line_items` DISABLE KEYS */;
INSERT INTO `assypo_line_items` VALUES (2053,'18','prn5','32','432','saf','a','a',215,'affs','sfff','',12,100,1200.00,'ewe'),(2054,'1','prn5','32','432','saf','a','a',216,'affs','sfff','',12,100,1200.00,'ewe'),(2055,'1','prn6','24','133','saf','d','d',217,'gdsg','dg','',12,100,1200.00,'es'),(2056,'1','prn6','24','133','saf','d','d',218,'gdsg','dg','',23,100,2300.00,'es'),(2057,'1','prn2','121','322','dxgdgdgd','a','a',219,'csc','sc','',12,100,1200.00,'a'),(2058,'1','prn3','xvzx','zxbv','xbxz','B','B',220,'RMS3','RMT3','',22,100,2200.00,'B'),(2059,'1','prn2','121','322','dxgdgdgd','B','B',221,'csc','sc','',10,100,1000.00,'B'),(2060,'1','prn2','121','322','dxgdgdgd','a','a',222,'csc','sc','',20,100,2000.00,'a'),(2061,'1','prn2','','','','','',223,'','','',1,100,100.00,'');
/*!40000 ALTER TABLE `assypo_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assywo_flow`
--

DROP TABLE IF EXISTS `assywo_flow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assywo_flow` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `doctype` varchar(255) DEFAULT NULL,
  `sch_due` date DEFAULT NULL,
  `revised` date DEFAULT NULL,
  `completed` date DEFAULT NULL,
  `timetaken` varchar(30) DEFAULT NULL,
  `link2doc` int(11) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL,
  `link2wfconfig` int(11) DEFAULT NULL,
  `link2owner` int(11) DEFAULT NULL,
  `link2contact` int(11) DEFAULT NULL,
  `link2approvedbyowner` int(11) DEFAULT '0',
  `link2approvedbycontact` int(11) DEFAULT NULL,
  `hold_date` date DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `condition` varchar(100) DEFAULT NULL,
  `dependency` varchar(30) DEFAULT NULL,
  `stagename` varchar(100) DEFAULT NULL,
  `stagenum` int(11) DEFAULT NULL,
  `dept` varchar(40) DEFAULT NULL,
  `stagedependency` varchar(30) DEFAULT NULL,
  `secondary_responsibility` varchar(100) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `when_process` varchar(255) DEFAULT NULL,
  `email_list` varchar(255) DEFAULT NULL,
  `primary_responsibility` varchar(255) DEFAULT NULL,
  `app_flag` int(11) DEFAULT '0',
  KEY `ind_dates_link2wo` (`link2wo`),
  KEY `ind_date_stagenum` (`stagenum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assywo_flow`
--

LOCK TABLES `assywo_flow` WRITE;
/*!40000 ALTER TABLE `assywo_flow` DISABLE KEYS */;
INSERT INTO `assywo_flow` VALUES (4824,'','WO','2017-12-21',NULL,'2017-12-22',NULL,2618,2618,100,0,NULL,2,NULL,NULL,NULL,'NA','','Int Wo Released',10,'Marketing','','Badari',' test',' tste','','Badari',1),(4825,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,101,0,NULL,2,NULL,NULL,NULL,'NA','10','Risk Analysis',20,'Marketing','10','accounts',' tese',' etret','','accounts',1),(4826,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,102,0,NULL,2,NULL,NULL,NULL,'NA','20','BOM',30,'PPC','20','Badari',' test',' test','','Badari',1),(4827,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,103,0,NULL,2,NULL,NULL,NULL,'NA','30','Purchase indents',40,'PPC','30','Badari',' test',' test','','Badari',1),(4828,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,104,0,NULL,2,NULL,NULL,NULL,'NA','40','Store Approval',50,'Stores','40','ppc1',' test',' test','','ppc1',1),(4829,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,105,0,NULL,2,NULL,NULL,NULL,'NA','50','RMPO for tools Consummables',60,'PPC','50','qas',' test',' test','','stores',1),(4830,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,106,0,NULL,2,NULL,NULL,NULL,'NA','60','Stores Recepts GRN',70,'Stores','60','Badari',' testr',' test','','Badari',1),(4831,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,107,0,NULL,2,NULL,NULL,NULL,'NA','70','QA Inspection',80,'QA','70','Badari',' test',' test','','stores',1),(4832,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,108,0,NULL,2,NULL,NULL,NULL,'NA','80','BOI',90,'PPC','80','Badari',' test',' test','','Badari',1),(4833,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,109,0,NULL,2,NULL,NULL,NULL,'NA','90','BOI  recd GRN',100,'PPC','90','Badari',' test',' test','','Badari',1),(4834,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,110,0,NULL,2,NULL,NULL,NULL,'NA','100','QA Inspection',110,'PPC','100','Badari',' test',' test','','Badari',1),(4835,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,111,0,NULL,2,NULL,NULL,NULL,'NA','110','Stores create KIT & DOC',120,'Stores','110','Badari',' test',' test','','Badari',1),(4836,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,112,0,NULL,2,NULL,NULL,NULL,'NA','120','Invoice by Account',130,'Account','120','accounts',' test',' test','','accounts',1),(4837,'','WO','2017-12-31',NULL,'2017-12-22',NULL,2618,2618,113,0,NULL,2,NULL,NULL,NULL,'NA','','packing',140,'Packing','','qas',' test',' test','','qas',1),(4838,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,100,0,NULL,0,NULL,NULL,NULL,'NA','','Int Wo Released',10,'Marketing','','Badari',' test',' tste','','Badari',0),(4839,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,101,0,NULL,0,NULL,NULL,NULL,'NA','10','Risk Analysis',20,'Marketing','10','accounts',' tese',' etret','','accounts',0),(4840,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,102,0,NULL,0,NULL,NULL,NULL,'NA','20','BOM',30,'PPC','20','Badari',' test',' test','','Badari',0),(4841,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,103,0,NULL,0,NULL,NULL,NULL,'NA','30','Purchase indents',40,'PPC','30','Badari',' test',' test','','Badari',0),(4842,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,104,0,NULL,0,NULL,NULL,NULL,'NA','40','Store Approval',50,'Stores','40','ppc1',' test',' test','','ppc1',0),(4843,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,105,0,NULL,0,NULL,NULL,NULL,'NA','50','RMPO for tools Consummables',60,'PPC','50','qas',' test',' test','','stores',0),(4844,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,106,0,NULL,0,NULL,NULL,NULL,'NA','60','Stores Recepts GRN',70,'Stores','60','Badari',' testr',' test','','Badari',0),(4845,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,107,0,NULL,0,NULL,NULL,NULL,'NA','70','QA Inspection',80,'QA','70','Badari',' test',' test','','stores',0),(4846,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,108,0,NULL,0,NULL,NULL,NULL,'NA','80','BOI',90,'PPC','80','Badari',' test',' test','','Badari',0),(4847,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,109,0,NULL,0,NULL,NULL,NULL,'NA','90','BOI  recd GRN',100,'PPC','90','Badari',' test',' test','','Badari',0),(4848,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,110,0,NULL,0,NULL,NULL,NULL,'NA','100','QA Inspection',110,'PPC','100','Badari',' test',' test','','Badari',0),(4849,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,111,0,NULL,0,NULL,NULL,NULL,'NA','110','Stores create KIT & DOC',120,'Stores','110','Badari',' test',' test','','Badari',0),(4850,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,112,0,NULL,0,NULL,NULL,NULL,'NA','120','Invoice by Account',130,'Account','120','accounts',' test',' test','','accounts',0),(4851,'','WO','2017-12-31',NULL,NULL,NULL,2619,2619,113,0,NULL,0,NULL,NULL,NULL,'NA','','packing',140,'Packing','','qas',' test',' test','','qas',0);
/*!40000 ALTER TABLE `assywo_flow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assywo_li`
--

DROP TABLE IF EXISTS `assywo_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assywo_li` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `linenum` varchar(20) DEFAULT NULL,
  `itemno` varchar(50) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `issue` varchar(50) DEFAULT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `uom` varchar(50) DEFAULT NULL,
  `qty_wo` int(11) DEFAULT NULL,
  `grn` varchar(50) DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `link2assywo` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `crn_num4li` varchar(50) DEFAULT NULL,
  `qty_rew` int(10) unsigned DEFAULT NULL,
  `qty_rej` int(10) unsigned DEFAULT NULL,
  `bom_type` varchar(45) DEFAULT NULL,
  `qty_ret` int(10) unsigned DEFAULT NULL,
  `qty_acc` int(10) unsigned DEFAULT NULL,
  `pcrn_num` varchar(45) DEFAULT NULL,
  `crn_type` varchar(45) DEFAULT NULL,
  `pcustponum` varchar(100) DEFAULT NULL,
  `custend_rew_qty` int(11) DEFAULT '0',
  `custend_rej_qty` int(11) DEFAULT '0',
  `custend_rew_flag` int(11) DEFAULT '0',
  `rmponum` varchar(50) DEFAULT NULL,
  `rmpo_linenum` varchar(50) DEFAULT NULL,
  `rmpo_cost` decimal(15,2) DEFAULT NULL,
  `qaapproved` varchar(20) DEFAULT NULL,
  `qaapproved_date` date DEFAULT NULL,
  `qaapproved_by` varchar(20) DEFAULT NULL,
  `ncrnum` varchar(20) DEFAULT NULL,
  `cofc_num` char(50) DEFAULT NULL,
  `supplier_wo` char(50) DEFAULT NULL,
  PRIMARY KEY (`recnum`),
  KEY `ali_grn` (`grn`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assywo_li`
--

LOCK TABLES `assywo_li` WRITE;
/*!40000 ALTER TABLE `assywo_li` DISABLE KEYS */;
INSERT INTO `assywo_li` VALUES (1,'A02618-1-1','','121','A','sss ',1,'',1,'31472','0000-00-00',2618,'Cofc # :5 Supp WO# 0 DN# 0','prn1',NULL,NULL,'Non Assembly',0,0,'','Untreated','AS-001',0,0,0,'','',0.00,NULL,NULL,NULL,NULL,NULL,NULL),(2,'A02618-1-2','','BBOM/prn6','','testdf ',1,'',1,'G00010','2017-12-31',2618,'','',NULL,NULL,'Bought Out',0,0,'','','AS-001',0,0,0,'','',0.00,NULL,NULL,NULL,NULL,NULL,NULL),(3,'A02618-1-3','','BBOM/prn6','','testdf ',2,'',2,'G00011','2017-12-31',2618,'','',NULL,NULL,'Consummables',0,0,'','','AS-001',0,0,0,'','',0.00,NULL,NULL,NULL,NULL,NULL,NULL),(4,'A02618-1-4','','2343','dd','24354 ',1,'',1,'31473','0000-00-00',2618,'Cofc # :2 Supp WO# 0 DN# 0','prn8',NULL,NULL,'Non Assembly',0,0,'','Treated','AS-001',0,0,0,'','',0.00,NULL,NULL,NULL,NULL,NULL,NULL),(5,'A02619-1-1','','121','A','sss ',1,'',1,'31472','0000-00-00',2619,'Cofc # :4 Supp WO# 1 DN# 0','prn1',NULL,NULL,'Non Assembly',0,0,'','Untreated','AS-001',0,0,0,'','',0.00,NULL,NULL,NULL,NULL,NULL,NULL),(6,'A02619-1-2','','BBOM/prn6','','testdf ',1,'',1,'G00010','2017-12-31',2619,'','',NULL,NULL,'Bought Out',0,0,'','','AS-001',0,0,0,'','',0.00,NULL,NULL,NULL,NULL,NULL,NULL),(7,'A02619-1-3','','BBOM/prn6','','testdf ',2,'',2,'G00011','2017-12-31',2619,'','',NULL,NULL,'Consummables',0,0,'','','AS-001',0,0,0,'','',0.00,NULL,NULL,NULL,NULL,NULL,NULL),(8,'A02619-1-4','','2343','dd','24354 ',1,'',1,'31473','0000-00-00',2619,'Cofc # :1 Supp WO# 1 DN# 0','prn8',NULL,NULL,'Non Assembly',0,0,'','Treated','AS-001',0,0,0,'','',0.00,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `assywo_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assywo_notes`
--

DROP TABLE IF EXISTS `assywo_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assywo_notes` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` date DEFAULT NULL,
  `link2wo` int(10) unsigned DEFAULT NULL,
  `link2user` varchar(45) DEFAULT NULL,
  `wonotes` text,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assywo_notes`
--

LOCK TABLES `assywo_notes` WRITE;
/*!40000 ALTER TABLE `assywo_notes` DISABLE KEYS */;
INSERT INTO `assywo_notes` VALUES (1,'2017-12-08',2564,'2','Notes Added');
/*!40000 ALTER TABLE `assywo_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `empid` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `checkInOut` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lon` varchar(50) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `type` char(50) DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  `siteid` varchar(20) DEFAULT NULL,
  `start_hour` int(11) DEFAULT NULL,
  `start_min` int(11) DEFAULT NULL,
  `end_hour` int(11) DEFAULT NULL,
  `end_min` int(11) DEFAULT NULL,
  `insert_type` varchar(50) DEFAULT NULL,
  `link2upload` int(11) DEFAULT NULL,
  `subsidaryid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,'E246','',1,'2017-09-07 08:02:15','12.91699359','77.58520968','','',97,'FSI',0,0,0,0,NULL,NULL,NULL),(2,'E246','',0,'2017-09-07 08:02:23','12.91699359','77.58520968','','',97,'FSI',0,0,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance_monthly`
--

DROP TABLE IF EXISTS `attendance_monthly`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_monthly` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `empid` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `days_come` int(11) DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `type` char(50) DEFAULT NULL,
  `siteid` varchar(20) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `hours_worked` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_monthly`
--

LOCK TABLES `attendance_monthly` WRITE;
/*!40000 ALTER TABLE `attendance_monthly` DISABLE KEYS */;
INSERT INTO `attendance_monthly` VALUES (1,'E246',NULL,'2017-09-07 08:02:15',1,NULL,NULL,NULL,'FSI','09','2017',NULL);
/*!40000 ALTER TABLE `attendance_monthly` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance_upload`
--

DROP TABLE IF EXISTS `attendance_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_upload` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `upload_name` varchar(50) DEFAULT NULL,
  `upload_size` varchar(50) DEFAULT NULL,
  `upload_by` varchar(50) DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  KEY `recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_upload`
--

LOCK TABLES `attendance_upload` WRITE;
/*!40000 ALTER TABLE `attendance_upload` DISABLE KEYS */;
INSERT INTO `attendance_upload` VALUES (1,'timesheet_attendance.csv','191','sa','2017-10-13',1),(2,'Import_2017-10-31 10:50:27','','sa','2017-10-31',1);
/*!40000 ALTER TABLE `attendance_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom`
--

DROP TABLE IF EXISTS `bom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bom` (
  `recnum` int(11) NOT NULL,
  `bomnum` varchar(100) DEFAULT NULL,
  `bom_issue` varchar(100) DEFAULT NULL,
  `crn` varchar(100) DEFAULT NULL,
  `assy_partnum` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `issue` varchar(100) DEFAULT NULL,
  `cos_no` varchar(100) DEFAULT NULL,
  `cos_iss` varchar(100) DEFAULT NULL,
  `drg_no` varchar(100) DEFAULT NULL,
  `bom_revnum` varchar(45) DEFAULT NULL,
  `eng_app` char(4) DEFAULT NULL,
  `eng_app_by` varchar(45) DEFAULT NULL,
  `eng_app_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `partiss` varchar(100) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom`
--

LOCK TABLES `bom` WRITE;
/*!40000 ALTER TABLE `bom` DISABLE KEYS */;
INSERT INTO `bom` VALUES (291,'BBOM/prn9','','prn9','132','','','','','','00','yes','bmandyam','2016-11-09','2016-11-09','Active','2016-11-09','','FSI'),(292,'BBOM/prn10','','prn10','3243','','','','','','00','yes','bmandyam','2016-11-11','2016-11-11','Active','2016-11-11','','FSI'),(300,'BBOM/prn9','','prn9','132','','','','','','44','yes','bmandyam','2016-11-11','2016-11-11','Active','2016-11-11','','FSI'),(301,'BBOM/prn9','','prn9','132','','C','C','','','01','yes','bmandyam','2017-11-23','2017-11-24','Active','2017-11-23','C','FSI'),(302,'BBOM/flu-assy-001','','flu-assy-001','flu-boi-001','new bom','A','A','','','00','yes','bmandyam','2017-12-05','2017-12-05','Active','2017-12-05','A','FSI');
/*!40000 ALTER TABLE `bom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_bought_items`
--

DROP TABLE IF EXISTS `bom_bought_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bom_bought_items` (
  `recnum` int(11) NOT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `item_no` varchar(50) DEFAULT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `drg_no` varchar(100) DEFAULT NULL,
  `issue` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `partiss` varchar(100) DEFAULT NULL,
  `qpa` varchar(50) DEFAULT NULL,
  `link2bom` int(11) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_bought_items`
--

LOCK TABLES `bom_bought_items` WRITE;
/*!40000 ALTER TABLE `bom_bought_items` DISABLE KEYS */;
INSERT INTO `bom_bought_items` VALUES (404,'1','','test','','','supp','BBOM/prn2','','1',289,NULL),(405,'1','','testdf','','','supp','BBOM/prn6','','1',290,NULL),(406,'1','','test','','','Aero','1234','','1',291,NULL),(407,'1','','testdf','','','supp','BBOM/prn6','','1',292,NULL),(408,'1','','testdf','','','supp','BBOM/prn6','','1',301,NULL),(409,'1','','ghdsgh','A','A','supp','rmk 00 12','A','1',302,NULL);
/*!40000 ALTER TABLE `bom_bought_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_consume`
--

DROP TABLE IF EXISTS `bom_consume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bom_consume` (
  `recnum` int(11) NOT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `item_no` varchar(50) DEFAULT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `spec` varchar(100) DEFAULT NULL,
  `issue` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `qpa` varchar(50) DEFAULT NULL,
  `link2bom` int(11) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_consume`
--

LOCK TABLES `bom_consume` WRITE;
/*!40000 ALTER TABLE `bom_consume` DISABLE KEYS */;
INSERT INTO `bom_consume` VALUES (286,'1','','test','','','Aero','',284,NULL,'1234'),(287,'1','','testdf','','','supp','1',285,NULL,'BBOM/prn6'),(288,'1','','testdf','','','supp','1',288,NULL,'BBOM/prn6'),(289,'1','','test','','','Aero','1',289,NULL,'1234'),(290,'1','','test','','','Aero','1',290,NULL,'1234'),(291,'1','','test','','','supp','1',291,NULL,'BBOM/prn2'),(292,'1','','test','','','Aero','1',292,NULL,'1234'),(293,'1','','testdf','','','supp','2',301,NULL,'BBOM/prn6'),(294,'1','','dghsdd','ghg','A','supp','1',302,NULL,'rmk 00 13');
/*!40000 ALTER TABLE `bom_consume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_mfg_items`
--

DROP TABLE IF EXISTS `bom_mfg_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bom_mfg_items` (
  `recnum` int(11) NOT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `item_no` varchar(50) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `crn` varchar(100) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `partiss` varchar(100) DEFAULT NULL,
  `drgiss` varchar(100) DEFAULT NULL,
  `attach` varchar(100) DEFAULT NULL,
  `qpa` varchar(50) DEFAULT NULL,
  `link2bom` int(11) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `mpsnum` varchar(100) DEFAULT NULL,
  `mpsrev` varchar(100) DEFAULT NULL,
  `crn_type` varchar(45) DEFAULT NULL,
  `cos` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_mfg_items`
--

LOCK TABLES `bom_mfg_items` WRITE;
/*!40000 ALTER TABLE `bom_mfg_items` DISABLE KEYS */;
INSERT INTO `bom_mfg_items` VALUES (421,'1','','3434','prn3','dsds','c','c','','1',291,NULL,NULL,'233','00','Untreated','c'),(422,'1','','121','prn1','sss','A','A','','1',292,NULL,NULL,'123','1213','Untreated','A'),(423,'1','','3434','prn3','dsds','','','','',294,NULL,NULL,'233','00','Untreated',''),(424,'1','','435','prn4','rdgfd','','','','',297,NULL,NULL,'','454','Untreated',''),(425,'1','','3434','prn3','dsds','','','','',298,NULL,NULL,'233','00','Untreated',''),(426,'1','','3434','prn3','dsds','','','','',299,NULL,NULL,'233','00','Untreated',''),(427,'1','','3434','prn3','dsds','c','c','','1',300,NULL,NULL,'233','00','Untreated','c'),(428,'1','','121','prn1','sss','A','A','','1',301,NULL,NULL,'123','121','Untreated','A'),(429,'1','','flu 00 100','flu-001','fluent part','A','A','','1',302,NULL,NULL,'flu-mps-001','001','Untreated','A');
/*!40000 ALTER TABLE `bom_mfg_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_notes`
--

DROP TABLE IF EXISTS `bom_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bom_notes` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `notes` longtext,
  `notes2user` varchar(50) DEFAULT NULL,
  `notes2bom` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_notes`
--

LOCK TABLES `bom_notes` WRITE;
/*!40000 ALTER TABLE `bom_notes` DISABLE KEYS */;
INSERT INTO `bom_notes` VALUES (1,'2016-05-11 15:25:00','sfsaf','bmandyam',271),(2,'2016-05-11 15:25:30','sfds','bmandyam',272),(3,'2016-05-11 18:46:25','sdf','bmandyam',272),(4,'2016-05-11 18:52:34','shg','bmandyam',272),(5,'2016-05-12 10:40:44','sfsdf','bmandyam',273),(6,'2016-05-12 12:06:00','fd','bmandyam',273),(7,'2016-05-27 18:21:11','','bmandyam',271),(8,'2016-05-27 18:21:50','','bmandyam',271),(9,'2016-05-27 18:22:49','','bmandyam',271),(10,'2016-05-27 18:24:45','','bmandyam',271),(11,'2016-05-27 18:25:10','','bmandyam',271),(12,'2016-05-27 18:25:18','','bmandyam',271),(13,'2016-05-27 18:31:44','','bmandyam',271),(14,'2016-05-27 18:41:00','','bmandyam',271),(15,'2016-05-27 18:41:33','','bmandyam',271),(16,'2016-05-27 18:46:16','','bmandyam',271),(17,'2016-05-27 18:49:55','','bmandyam',271),(18,'2016-07-07 12:29:46','testing','bmandyam',274),(19,'2016-10-06 12:11:39','test','bmandyam',275),(20,'2016-10-06 12:25:07','testing','bmandyam',275),(21,'2016-10-06 12:48:35','test','bmandyam',275),(22,'2016-10-06 13:05:16','test','bmandyam',275),(23,'2016-10-06 13:07:48','test','bmandyam',275),(24,'2016-10-06 13:07:55','test','bmandyam',275),(25,'2016-10-06 13:09:27','test','bmandyam',275),(26,'2016-10-06 13:09:47','test','bmandyam',275),(27,'2016-10-06 13:16:41','test','bmandyam',275),(28,'2016-10-06 13:31:24','test','qas',275),(29,'2016-10-06 13:32:25','test','qas',275),(30,'2016-10-06 13:33:37','fdfg','qas',275),(31,'2016-10-06 13:37:02','test','qas',275),(32,'2016-10-06 13:38:03','test','qas',275),(33,'2016-10-06 14:32:42','test','bmandyam',276),(34,'2016-10-06 14:38:32','text','bmandyam',276),(35,'2016-10-06 14:40:01','test','bmandyam',276),(36,'2016-10-06 14:52:05','dsf','bmandyam',277),(37,'2016-10-06 15:04:50','test','bmandyam',277),(38,'2016-10-11 14:26:45','test','bmandyam',277),(41,'2016-10-12 12:19:27','test','bmandyam',283),(42,'2016-10-12 12:19:45','test','bmandyam',283),(43,'2016-10-12 12:21:12','test','bmandyam',283),(44,'2016-10-12 12:21:49','test','bmandyam',283),(45,'2016-10-12 12:26:43','test','bmandyam',283),(46,'2016-10-12 12:28:53','test','bmandyam',283),(65,'2016-10-12 12:53:01','test','bmandyam',283),(66,'2016-10-12 12:53:15','test','bmandyam',283),(67,'2016-10-12 12:53:31','rer','bmandyam',283),(68,'2016-10-12 12:53:47','rrr','bmandyam',283),(69,'2016-10-12 12:54:10','df','bmandyam',283),(70,'2016-10-12 16:43:40','test','bmandyam',284),(71,'2016-10-12 16:54:15','test','bmandyam',284),(72,'2016-10-13 15:17:43','test','bmandyam',284),(73,'2016-10-13 15:19:43','ty','bmandyam',284),(74,'2016-10-13 15:21:09','ty','bmandyam',284),(75,'2016-10-13 15:25:43','ggg','bmandyam',284),(76,'2016-10-13 15:26:06','gfh','bmandyam',284),(77,'2016-10-13 15:26:53','h','bmandyam',284),(78,'2016-10-13 15:27:21','hj','bmandyam',284),(79,'2016-10-13 15:28:03','ddd','bmandyam',284),(80,'2016-10-13 15:32:24','fff','bmandyam',284),(81,'2016-10-13 15:32:52','gf','bmandyam',284),(82,'2016-10-13 16:08:51','dff','bmandyam',284),(83,'2016-10-13 16:09:17','test','bmandyam',284),(84,'2016-10-13 16:34:37','test','bmandyam',284),(85,'2016-10-20 16:55:35','test','bmandyam',288),(86,'2016-10-20 17:10:36','test','bmandyam',288),(87,'2016-10-20 17:10:55','trest','bmandyam',288),(88,'2016-11-09 18:14:55','test','bmandyam',291),(89,'2016-11-09 18:15:17','test','bmandyam',291),(90,'2016-11-11 14:49:01','test','bmandyam',292),(91,'2016-11-11 18:15:42','','bmandyam',300),(92,'2016-11-11 18:15:58','','bmandyam',300),(93,'2016-11-11 18:16:12','','bmandyam',300),(94,'2016-11-11 18:18:36','','bmandyam',300),(95,'2017-11-23 17:48:13','test','bmandyam',301),(96,'2017-11-23 17:51:34','test','bmandyam',301),(97,'2017-11-23 18:24:32','test','bmandyam',301),(102,'2017-11-24 10:20:16','test','bmandyam',301),(103,'2017-12-05 12:44:58','fgjsfgj','bmandyam',302),(104,'2017-12-05 12:45:41','line added','bmandyam',302),(105,'2017-12-05 12:47:16','boi and cosummables added','bmandyam',302);
/*!40000 ALTER TABLE `bom_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_op_desc`
--

DROP TABLE IF EXISTS `bom_op_desc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bom_op_desc` (
  `recnum` int(11) NOT NULL,
  `opn_num` varchar(50) DEFAULT NULL,
  `stn` varchar(150) DEFAULT NULL,
  `oper_desc` varchar(255) DEFAULT NULL,
  `signoff` varchar(100) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `link2bom` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_op_desc`
--

LOCK TABLES `bom_op_desc` WRITE;
/*!40000 ALTER TABLE `bom_op_desc` DISABLE KEYS */;
/*!40000 ALTER TABLE `bom_op_desc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_subassy_items`
--

DROP TABLE IF EXISTS `bom_subassy_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bom_subassy_items` (
  `recnum` int(11) NOT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `item_no` varchar(50) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `crn` varchar(100) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `partiss` varchar(100) DEFAULT NULL,
  `drgiss` varchar(100) DEFAULT NULL,
  `attach` varchar(100) DEFAULT NULL,
  `qpa` varchar(50) DEFAULT NULL,
  `link2bom` int(11) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `mpsnum` varchar(100) DEFAULT NULL,
  `mpsrev` varchar(100) DEFAULT NULL,
  `crn_type` varchar(45) DEFAULT NULL,
  `cos` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_subassy_items`
--

LOCK TABLES `bom_subassy_items` WRITE;
/*!40000 ALTER TABLE `bom_subassy_items` DISABLE KEYS */;
INSERT INTO `bom_subassy_items` VALUES (68,'1','','324','prn5','sddsd','s','b','','123',277,NULL,NULL,'','133','Assembly',''),(69,'1','','324','prn5','sddsd','s','b','','12',285,NULL,NULL,'222','133','Assembly','a'),(70,'1','','324','prn5','sddsd','','','','1',288,NULL,NULL,'222','133','Assembly','a'),(71,'1','','121','prn1','sss','A','A','','1',290,NULL,NULL,'123','121','Assembly','A'),(72,'1','','132','prn9','asd','','','','1',292,NULL,NULL,'','20','Assembly',''),(73,'1','','3243','prn10','dsf','','','','',294,NULL,NULL,'','1','Assembly',''),(74,'1','','132','prn9','asd','','','','',296,NULL,NULL,'','20','Assembly',''),(75,'1','','3243','prn10','dsf','','','','',297,NULL,NULL,'','1','Assembly',''),(76,'1','','132','prn9','asd','','','','',298,NULL,NULL,'','20','Assembly',''),(77,'1','','132','prn9','asd','','','','',299,NULL,NULL,'','20','Assembly',''),(78,'1','','3243','prn10','dsf','','','','1',300,NULL,NULL,'','1','Assembly','');
/*!40000 ALTER TABLE `bom_subassy_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_treated_items`
--

DROP TABLE IF EXISTS `bom_treated_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bom_treated_items` (
  `recnum` int(11) NOT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `item_no` varchar(50) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `crn` varchar(100) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `partiss` varchar(100) DEFAULT NULL,
  `drgiss` varchar(100) DEFAULT NULL,
  `attach` varchar(100) DEFAULT NULL,
  `qpa` varchar(50) DEFAULT NULL,
  `link2bom` int(11) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `mpsnum` varchar(100) DEFAULT NULL,
  `mpsrev` varchar(100) DEFAULT NULL,
  `crn_type` varchar(45) DEFAULT NULL,
  `cos` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_treated_items`
--

LOCK TABLES `bom_treated_items` WRITE;
/*!40000 ALTER TABLE `bom_treated_items` DISABLE KEYS */;
INSERT INTO `bom_treated_items` VALUES (13,'1','','3434','prn2','ssss','b','b','','1',291,NULL,NULL,'12343','','Treated','b'),(14,'1','','54543','prn6','sssss','g','g','','1',292,NULL,NULL,'324','66','Treated','g'),(15,'1','','54543','prn6','sssss','','','','',294,NULL,NULL,'324','66','Treated',''),(16,'1','','34344','prn7','fddd','g','g','','',297,NULL,NULL,'3434','','Treated','g'),(17,'1','','34344','prn7','fddd','g','g','','',298,NULL,NULL,'3434','','Treated','g'),(18,'1','','2343','prn8','24354','','','','',299,NULL,NULL,'2342','234','Treated',''),(19,'1','','54543','prn6','sssss','g','g','','1',300,NULL,NULL,'324','66','Treated','g'),(20,'2','','2343','prn8','24354','dd','dd','','1',301,NULL,NULL,'2342','123','Treated','dd');
/*!40000 ALTER TABLE `bom_treated_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookmark`
--

DROP TABLE IF EXISTS `bookmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmark` (
  `recnum` int(11) DEFAULT NULL,
  `bookmarknum` varchar(100) DEFAULT NULL,
  `notes` longtext,
  `link2wo` int(11) DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmark`
--

LOCK TABLES `bookmark` WRITE;
/*!40000 ALTER TABLE `bookmark` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookmark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `box`
--

DROP TABLE IF EXISTS `box`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `box` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `box` varchar(100) DEFAULT NULL,
  `psn` varchar(100) DEFAULT NULL,
  `ponum` varchar(100) DEFAULT NULL,
  `qty` varchar(10) DEFAULT NULL,
  `batchnum` varchar(50) DEFAULT NULL,
  `wonum` varchar(100) DEFAULT NULL,
  `partnum` varchar(200) DEFAULT NULL,
  `cofc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`recnum`),
  KEY `ind_box_wonum` (`wonum`),
  KEY `ind_box_cofc` (`cofc`)
) ENGINE=MyISAM AUTO_INCREMENT=3564 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `box`
--

LOCK TABLES `box` WRITE;
/*!40000 ALTER TABLE `box` DISABLE KEYS */;
/*!40000 ALTER TABLE `box` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capacity_plan`
--

DROP TABLE IF EXISTS `capacity_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capacity_plan` (
  `recnum` int(11) DEFAULT NULL,
  `machineid` varchar(20) DEFAULT NULL,
  `av_cap` varchar(20) DEFAULT NULL,
  `used_cap` varchar(20) DEFAULT NULL,
  `unused_cap` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capacity_plan`
--

LOCK TABLES `capacity_plan` WRITE;
/*!40000 ALTER TABLE `capacity_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `capacity_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chemical_composition_li`
--

DROP TABLE IF EXISTS `chemical_composition_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chemical_composition_li` (
  `recno` int(11) DEFAULT NULL,
  `constituents` varchar(10) DEFAULT NULL,
  `standard_min` float DEFAULT NULL,
  `standard_max` float DEFAULT NULL,
  `supplier_min` float DEFAULT NULL,
  `supplier_max` float DEFAULT NULL,
  `report_lab` varchar(100) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `link2testreport` varchar(20) DEFAULT NULL,
  `lineno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chemical_composition_li`
--

LOCK TABLES `chemical_composition_li` WRITE;
/*!40000 ALTER TABLE `chemical_composition_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `chemical_composition_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cofc`
--

DROP TABLE IF EXISTS `cofc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cofc` (
  `recno` int(11) DEFAULT NULL,
  `dimensional` varchar(10) DEFAULT NULL,
  `ndt` varchar(10) DEFAULT NULL,
  `visual` varchar(10) DEFAULT NULL,
  `grain` varchar(10) DEFAULT NULL,
  `mech` varchar(10) DEFAULT NULL,
  `conductivity` varchar(10) DEFAULT NULL,
  `chemical` varchar(10) DEFAULT NULL,
  `hardness` varchar(10) DEFAULT NULL,
  `quantity` varchar(10) DEFAULT NULL,
  `temper` varchar(10) DEFAULT NULL,
  `cusserial` varchar(10) DEFAULT NULL,
  `cimserial` varchar(10) DEFAULT NULL,
  `notrequired` varchar(10) DEFAULT NULL,
  `frmserial` varchar(20) DEFAULT NULL,
  `toserial` varchar(20) DEFAULT NULL,
  `noncon` varchar(10) DEFAULT NULL,
  `ncref` varchar(10) DEFAULT NULL,
  `ncdate` date DEFAULT NULL,
  `comm` varchar(10) DEFAULT NULL,
  `dcomm` varchar(100) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `approval` varchar(255) DEFAULT NULL,
  `link2grn` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cofc`
--

LOCK TABLES `cofc` WRITE;
/*!40000 ALTER TABLE `cofc` DISABLE KEYS */;
INSERT INTO `cofc` VALUES (1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15286),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15287),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15288),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15289),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15290),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15291),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15292),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15293),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15294),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15295),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15296),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15297),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15298),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15299),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15300),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15301),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15302),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15303),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15304),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15305),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15306),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15307),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15308),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15309),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15310),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15311),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15312),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15313),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15314),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15315),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15316),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15317),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15318),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15319),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15320),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15321),(1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15322);
/*!40000 ALTER TABLE `cofc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `recnum` int(11) DEFAULT NULL,
  `id` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `tsymbol` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `employees` varchar(100) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `ownership` varchar(100) DEFAULT NULL,
  `annual_revenue` int(11) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `stccode` varchar(100) DEFAULT NULL,
  `addr1` varchar(255) DEFAULT NULL,
  `addr2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `baddr1` varchar(255) DEFAULT NULL,
  `baddr2` varchar(255) DEFAULT NULL,
  `bcity` varchar(100) DEFAULT NULL,
  `bstate` varchar(100) DEFAULT NULL,
  `bzipcode` varchar(100) DEFAULT NULL,
  `bcountry` varchar(100) DEFAULT NULL,
  `saddr1` varchar(255) DEFAULT NULL,
  `saddr2` varchar(255) DEFAULT NULL,
  `scity` varchar(100) DEFAULT NULL,
  `sstate` varchar(100) DEFAULT NULL,
  `szipcode` varchar(100) DEFAULT NULL,
  `scountry` varchar(100) DEFAULT NULL,
  `l1address` int(11) DEFAULT NULL,
  `l2address` int(11) DEFAULT NULL,
  `company2parent_company` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `guid` varchar(20) DEFAULT NULL,
  `alt_recnum` int(11) DEFAULT NULL,
  `remarks` text,
  `terms` varchar(255) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `how_created` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lon` varchar(50) DEFAULT NULL,
  KEY `ind_recnum` (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'FSI','FLUENT','HOST','','','','','','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active',NULL,NULL,NULL,1,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(2,'A1','SUPP1','CUST','','','','','supp1@ft.com','','','',0,'Aerospace','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2014-01-23',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(126,'A126','CUST1','CUST','','','','','cust1@ft.com','','','',0,'Aerospace','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2014-01-23',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(127,'A127','A2','CUST','325432','ewfr','','','dsfafaf@saasf.com','','','',0,'','','#472, 2nd Floor ,Keer Plaza,','above Axis bank,Basaveshwaranagar','Bangalore','Karnataka','560079','India','#472, 2nd Floor ,Keer Plaza,','above Axis bank,Basaveshwaranagar','Bangalore','Karnataka','560079','India','#472, 2nd Floor ,Keer Plaza,','above Axis bank,Basaveshwaranagar','Bangalore','Karnataka','560079','India',NULL,NULL,NULL,'Active','2016-05-11',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,'',''),(128,'A128','sss','CUST','4324235','','','','sdg@gamil.com','','','',0,'','','ds','sfd','dfd','sf','s','ss','fs','sf','fsd','sf','sf','sf','','','','','','',NULL,NULL,NULL,'Active','2016-05-24',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(129,'A129','Aero','VEND','8090677890','','','','Aero@gmail.com','','','',0,'','','saf','asf','afds','dsaf','asf','af','af','afs','afsf','fas','af','saf','af','af','af','af','af','af',NULL,NULL,NULL,'Active','2016-05-25',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,'',''),(130,'A130','aaaa','CUST','32434','','','','dsfafaf@saasf.com','','','',0,'','','VIJANAGAR','','BANGALORE','','523333','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2016-06-29',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(131,'A131','cust','CUST','213244','','','','ad1234@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2016-07-05',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(132,'A132','supp','VEND','','','','','dsfafaf@saasf.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2016-07-05',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(133,'A133','supp','CUST','','','','','sdg@gamil.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2016-07-05',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(134,'A134','Aero Components','CUST','','','','','aaa@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2016-09-30',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,'',''),(135,'A135','XYZ','CUST','9845152785','','','','info@fluentsoft.com','','','',0,'Aerospace','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2016-11-09',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(136,'A136','aaa','','232434','','','','ashu@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(137,'A137','aaa','','232434','','','','ashu@fluentsoft.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(138,'A138','aaa','','232434','','','','ashu@fluentsoft.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(139,'A139','aaa','','324235','','','','ashu@fluentsoft.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(140,'A140','aaaa','','234','','','','ashu@fluentsoft.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(141,'A141','aaa','','3435','','','','ashu@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(142,'A142','ade','','3435','','','','ashu@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(143,'A143','dsfdsfsd','CUST','','','','','ssf','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(144,'A144','assss','CUST','','','','','ashu@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,'FSI',NULL,NULL,NULL,NULL),(145,'A145','fdfg','','54656','','','','ashu@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Inactive','2017-03-10',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(146,'A146','FSI','','23456677','','','','mnoja@gamail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Inactive','2017-03-13',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(147,'A147','FGI','','2435435','','','','ankitha@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Inactive','2017-03-13',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(148,'A148','FSI','','565276970','','','','mani@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Inactive','2017-03-13',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(166,'A166','asd','','34325','','','','ashu.pinky24@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Inactive','2017-04-28',NULL,NULL,NULL,NULL,NULL,NULL,'','Online Registration','ds',NULL,NULL),(167,'A167','asd','','34325','','','','ashu.pinky24@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Inactive','2017-04-28',NULL,NULL,NULL,NULL,NULL,NULL,'','Online Registration','sds',NULL,NULL),(168,'A168','FSi','','45435','','','','ashu.pinky24@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Inactive','2017-04-28',NULL,NULL,NULL,NULL,NULL,NULL,'','Online Registration','wew',NULL,NULL),(169,'A169','fgf','CUST','454','','','','ashwinic@fluentsoft.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-04-28',NULL,NULL,NULL,NULL,NULL,NULL,'FSI','','',NULL,NULL),(170,'A170','ffffff','CUST','45465','','','','ashwinic@fluentsoft.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-04-28',NULL,NULL,NULL,NULL,NULL,NULL,'FSI','','',NULL,NULL),(171,'A171','asd','HOST','46346',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','2017-07-05',NULL,NULL,NULL,NULL,NULL,NULL,'FSI','Online Registration','asd',NULL,NULL),(171,'A171','asd','HOST','46346',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','2017-07-05',NULL,NULL,NULL,NULL,NULL,NULL,'FSI','Online Registration','asd',NULL,NULL),(172,'A172','karthick','CUST','','','','','karthick@gmail.com','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2017-12-05',NULL,NULL,NULL,NULL,NULL,NULL,'FSI','','',NULL,NULL);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competitor`
--

DROP TABLE IF EXISTS `competitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competitor` (
  `recnum` int(11) DEFAULT NULL,
  `companyname` varchar(100) DEFAULT NULL,
  `revenue` float DEFAULT NULL,
  `industrysegment` varchar(100) DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `guid` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competitor`
--

LOCK TABLES `competitor` WRITE;
/*!40000 ALTER TABLE `competitor` DISABLE KEYS */;
INSERT INTO `competitor` VALUES (1,'xxx',0,'xx','xx','test','xxx','45454','s@gmail.com','sdf','sdfdsdsf','dsf','sdfsd','df','4545','FSI');
/*!40000 ALTER TABLE `competitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumption`
--

DROP TABLE IF EXISTS `consumption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumption` (
  `recnum` int(10) unsigned DEFAULT NULL,
  `invoice_num` varchar(45) DEFAULT NULL,
  `grnnum` varchar(45) DEFAULT NULL,
  `grn_date` date DEFAULT NULL,
  `ponum` varchar(45) DEFAULT NULL,
  `description` text,
  `qty_recd` float DEFAULT NULL,
  `qty_cons` float DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `crn` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `closingbal` decimal(10,2) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `cofc_num` varchar(45) DEFAULT NULL,
  `bond_num` varchar(45) DEFAULT NULL,
  `be_num` varchar(45) DEFAULT NULL,
  `grnwonum` varchar(45) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `rmtype` varchar(100) DEFAULT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `bonddate` date DEFAULT NULL,
  `bedate` date DEFAULT NULL,
  `assessval` decimal(14,2) DEFAULT NULL,
  `cifval` decimal(14,2) DEFAULT NULL,
  `dutyamt` decimal(14,2) DEFAULT NULL,
  `invamt` decimal(14,2) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `currency` char(5) DEFAULT NULL,
  `qty_rej` float DEFAULT NULL,
  `wonum` char(100) DEFAULT NULL,
  `qty_rew` int(11) DEFAULT NULL,
  `parentgrnnum` varchar(45) DEFAULT NULL,
  `expinvnum` varchar(50) DEFAULT NULL,
  `inv_assessval` decimal(10,2) DEFAULT NULL,
  `inv_dutyamt` decimal(10,2) DEFAULT NULL,
  `be_rmtype` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumption`
--

LOCK TABLES `consumption` WRITE;
/*!40000 ALTER TABLE `consumption` DISABLE KEYS */;
INSERT INTO `consumption` VALUES (48341,'123','G1','2016-08-23',NULL,'RMS 1  (50X50X50) Regular',5000,1,'2016-08-23','2016-11-05','prn1',NULL,4999.00,'2016-08-22','C27332','','',NULL,'Aero','RMT 1','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,500,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48342,'123','g2','2016-11-09',NULL,'RMS2  (10 x 10 x 10) Regular',1000,1,'2017-12-21','2017-12-21','prn2',NULL,27.00,'2016-11-09','C27319','','',NULL,'Aero','RMT2','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,100,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48343,'234','G3','2016-09-29',NULL,'RMS 3  (232 x 4 x 4) Boughtout',556800,1,'2016-11-04','2016-11-04','prn3',NULL,19.00,'2016-09-30','C27326','','',NULL,'supp','RMT 3','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,5568,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48344,'1','2','2016-05-29',NULL,'RMS3  (40 x 12 x 12) Regular',18,1,'2016-05-30','2016-05-30','prn2',NULL,17.00,'2016-05-23','C27279','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48345,'232','G4','2016-06-29',NULL,'RMS4  (60X50X50) Regular',732,1,'2016-06-29','2016-06-30','prn4',NULL,731.00,'2016-06-30','C27320','','',NULL,'SUPP1','RMT4','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,6,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48346,'232','G5','2016-10-04',NULL,'RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27276','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48347,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,2,'2016-10-06','2016-10-06','prn5',NULL,10.00,'2016-10-05','C27277','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48348,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,3,'2016-10-06','2016-10-06','prn5',NULL,9.00,'2016-10-05','C27278','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48349,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27280','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48350,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27281','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48351,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27282','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48352,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27283','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48353,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27284','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48354,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27285','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48355,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27286','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48356,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,2,'2016-05-30','2016-05-30','prn2',NULL,16.00,'2016-05-23','C27287','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48357,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,1,'2016-05-30','2016-05-30','prn2',NULL,17.00,'2016-05-23','C27284','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48358,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,2,'2016-05-30','2016-05-30','prn2',NULL,16.00,'2016-05-23','C27288','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48359,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,1,'2016-05-30','2016-05-30','prn2',NULL,17.00,'2016-05-23','C27290','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48360,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,1,'2016-05-30','2016-05-30','prn2',NULL,17.00,'2016-05-23','C27291','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48361,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,1,'2016-05-30','2016-05-30','prn2',NULL,17.00,'2016-05-23','C27292','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48362,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,1,'2016-05-30','2016-05-30','prn2',NULL,17.00,'2016-05-23','C27296','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48363,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,1,'2016-05-30','2016-05-30','prn2',NULL,17.00,'2016-05-23','C27297','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48364,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,2,'2016-05-30','2016-05-30','prn2',NULL,34.00,'2016-05-23','C27298','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48365,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,2,'2016-05-30','2016-05-30','prn2',NULL,16.00,'2016-05-23','C27299','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48366,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27298','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48367,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,11,'2016-10-06','2016-10-06','prn5',NULL,13.00,'2016-10-05','C27288','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48368,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,6,'2016-10-06','2016-10-06','prn5',NULL,6.00,'2016-10-05','C27297','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48369,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,3,'2016-10-06','2016-10-06','prn5',NULL,9.00,'2016-10-05','C27291','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48370,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,5,'2016-05-30','2016-05-30','prn2',NULL,31.00,'2016-05-23','C27301','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48371,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,16,'2016-10-06','2016-10-06','prn5',NULL,-4.00,'2016-10-05','C27301','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48372,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,3,'2016-05-30','2016-05-30','prn2',NULL,33.00,'2016-05-23','C27302','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48373,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,3,'2016-05-30','2016-05-30','prn2',NULL,33.00,'2016-05-23','C27303','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48374,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27303','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48375,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,3,'2016-05-30','2016-05-30','prn2',NULL,33.00,'2016-05-23','C27304','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48376,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,1,'2016-05-30','2016-05-30','prn2',NULL,17.00,'2016-05-23','C27305','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48377,'1','2','2016-05-29','214','RMS3  (40 x 12 x 12) Regular',18,2,'2016-05-30','2016-05-30','prn2',NULL,16.00,'2016-05-23','C27306','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48378,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27306','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48379,'545','G6','2016-09-30',NULL,'RMS 6  (400 x 40 x 50) Consummables',4000,1,'2017-02-27','2017-02-27','prn6',NULL,3999.00,'2016-09-30','C27327','','',NULL,'Aero','RMT 6','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,40,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48380,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27311','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48381,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,2,'2016-10-06','2016-10-06','prn5',NULL,22.00,'2016-10-05','C27312','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48382,'232','G5','2016-10-04','4','RMS 5  (400X40X40) Regular',1945.6,1,'2016-10-06','2016-10-06','prn5',NULL,11.00,'2016-10-05','C27313','','',NULL,'Aero','RMT 5','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.8,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48383,'243','G10','2016-05-30',NULL,'RMS3  (55 x 35 x 33) Regular',2,NULL,'2016-05-30','2016-05-30','PRN3',NULL,NULL,'2016-05-23',NULL,NULL,NULL,NULL,'SUPP1','RMT3','',NULL,NULL,NULL,NULL,NULL,NULL,1.21,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(48384,'235','G11','2016-05-31',NULL,'RMS11  (22X32X42) Regular',5.54,NULL,'2016-05-30',NULL,'prn5',NULL,NULL,'2016-05-31',NULL,NULL,NULL,NULL,'SUPP1','RMT11','',NULL,NULL,NULL,NULL,NULL,NULL,0.264,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(48385,'3321','G13','2016-05-30',NULL,'RMS13  (22X22X22) Regular',25.41,NULL,'2016-05-31',NULL,'prn2',NULL,NULL,'2016-05-31',NULL,NULL,NULL,NULL,'SUPP1','RMT13','',NULL,NULL,NULL,NULL,NULL,NULL,1.21,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(48386,'1','2','2016-05-29','214','RMS3  (40X12X12) ;Regular',18,5,'2016-06-23','2016-06-23','prn2',NULL,13.00,'2016-05-23','C27314','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48387,'1','2','2016-05-29','214','RMS3  (40X12X12) ;Regular',18,2,'2016-06-23','2016-06-23','prn2',NULL,34.00,'2016-05-23','C27318','','',NULL,'SUPP1','RMT3','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.84,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48388,'232','G4','2016-06-29','4','RMS4  (60X50X50) ;Regular',732,1,'2016-06-30','2016-07-01','prn4',NULL,731.00,'2016-06-30','C27321','','',NULL,'SUPP1','RMT4','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,6,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48389,'123','G2','2016-11-09','2','RMS2  (10 x 10 x 10) Regular',1000,1,'2017-12-21','2017-12-21','prn2',NULL,27.00,'2016-11-09','C27324','','',NULL,'Aero','RMT2','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,100,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48390,'232','G4','2016-06-29','4','RMS4  (60X50X50) ;Regular',732,1,'2016-07-01',NULL,'prn1',NULL,731.00,'2016-06-30','C27325','','',NULL,'SUPP1','RMT4','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,6,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48391,'3434','g7','2016-10-05',NULL,'  (200X20X20) Regular',120000,NULL,'2016-10-12','2016-10-12','prn7',NULL,NULL,'2016-10-12',NULL,NULL,NULL,NULL,'Aero','','NOS',NULL,NULL,NULL,NULL,NULL,NULL,400,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL),(48392,'123','g2','2016-11-09','2','RMS2  (10 x 10 x 10) Regular',1000,1,'2017-12-21','2017-12-21','prn2',NULL,239.00,'2016-11-09','C27329','','',NULL,'Aero','RMT2','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,100,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48393,'234','g3','2016-09-29','3','RMS 3  (232 x 4 x 4) Boughtout',556800,1,'2016-11-04','2016-11-04','prn3',NULL,556799.00,'2016-09-30','C27330','','',NULL,'supp','RMT 3','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,5568,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48394,'65756','g8','2016-10-18',NULL,'RMS 8  (5X5X5) Regular',250,1,'2016-10-18','2016-10-18','prn8',NULL,249.00,'2016-10-18','C27331','','',NULL,'Aero','RMT 8','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,25,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48395,'123','G1','2016-08-23','1','RMS 1  (50X50X50) ;Regular',5000,1,'2016-11-05',NULL,'prn1',NULL,4999.00,'2016-08-22','C27333','','',NULL,'Aero','RMT 1','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,500,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48396,'545','g6','2016-09-30','234','RMS 6  (400 x 40 x 50) Consummables',4000,1,'2017-02-27','2017-02-27','prn6',NULL,3999.00,'2016-09-30','C27334','','',NULL,'Aero','RMT 6','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,40,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48397,'3434','g1235','2016-11-09',NULL,'  (1 x 1 x 1) Boughtout',24,1,'2017-02-27','2017-02-27','',NULL,23.00,'2016-11-09','C27335','','',NULL,'Aero','','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0.01,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48398,'234','g3','2016-09-29','3','',556800,1,'2016-11-09',NULL,'prn9',NULL,556799.00,'2016-09-30','C27335','','',NULL,'supp','RMT 3','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48399,'545','g6','2016-09-30','234','RMS 6  (400 x 40 x 50) Consummables',4000,1,'2017-02-27','2017-02-27','prn6',NULL,3999.00,'2016-09-30','C27335','','',NULL,'Aero','RMT 6','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,40,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48400,'123','g2','2016-11-09','2','RMS2  (10 x 10 x 10) Regular',1000,1,'2017-12-21','2017-12-21','prn2',NULL,999.00,'2016-11-09','C27335','','',NULL,'Aero','RMT2','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,100,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48401,'234','g3','2016-09-29','3','RMS 3  (232X4X4) ;Boughtout',10,1,'2017-02-15',NULL,'prn3',NULL,9.00,'2016-09-30','C27336','','',NULL,'supp','RMT 3','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,5568,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48402,'123','G1','2016-08-23','1','RMS 1  (50X50X50) ;Regular',5000,1,'2017-03-09',NULL,'prn1',NULL,4999.00,'2016-08-22','C27337','','',NULL,'Aero','RMT 1','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,500,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48403,'234','g3','2016-09-29','3','RMS 3  (232X4X4) ;Boughtout',10,1,'2017-03-16',NULL,'prn3',NULL,9.00,'2016-09-30','C27338','','',NULL,'supp','RMT 3','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,5568,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48404,'dgsdfg','RMK-GRN-001','2017-08-10',NULL,'bvnxfgchd  (10 x 10 x 10) Regular',100,1,'2017-08-08','2017-08-10','prn1',NULL,99.00,'2017-08-16','C27339','','',NULL,'Aero','dgsfg','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,10,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48405,'123','g2','2016-11-09','2','RMS2  (10 x 10 x 10) Regular',1000,1,'2017-12-21','2017-12-21','prn2',NULL,999.00,'2016-11-09','C27340','','',NULL,'Aero','RMT2','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,100,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48406,'123','g2','2016-11-09','2','RMS2  (10 x 10 x 10) Regular',1000,1,'2017-12-21','2017-12-21','prn2',NULL,999.00,'2016-11-09','C27341','','',NULL,'Aero','RMT2','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,100,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48407,'4545','G0004','2017-09-12',NULL,'test  (200 x 10) Regular',4,1,'2017-11-24','2017-11-24','prn4',NULL,1.00,'2017-09-12','C27344','','',NULL,'Aero','test','Meters','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,2,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48408,'123','g2','2016-11-09','2','RMS2  (10 x 10 x 10) Regular',1000,1,'2017-12-21','2017-12-21','prn2',NULL,999.00,'2016-11-09','C27345','','',NULL,'Aero','RMT2','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,100,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48409,'65756','g8','2016-10-18','5551','RMS 8  (5X5X5) ;Regular',250,10,'2017-11-23',NULL,'prn8',NULL,240.00,'2016-10-18','C27347','','',NULL,'Aero','RMT 8','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,25,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48410,'65756','g8','2016-10-18','5551','RMS 8  (5X5X5) ;Regular',250,10,'2017-11-23',NULL,'prn8',NULL,240.00,'2016-10-18','C27348','','',NULL,'Aero','RMT 8','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,25,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48411,'dgsdfg','RMK-GRN-001','2017-08-10','PO-001','bvnxfgchd  (10X10X10) ;Regular',100,1,'2017-11-23',NULL,'prn1',NULL,99.00,'2017-08-16','C27349','','',NULL,'Aero','dgsfg','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,10,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48412,'test','G00010','2017-11-22',NULL,'test  (1 x 1) Boughtout',100,1,'2017-12-01','2017-12-01','prn1',NULL,99.00,'2017-11-22','C27353','','',NULL,'Aero','test','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,1,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48413,'454534','G00011','2017-11-23',NULL,'test  (331X11) Consummables',100,1,'2017-11-23','2017-11-24','prn4',NULL,99.00,'2017-11-23','C27353','','',NULL,'Aero','test','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,13,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48414,'3434','g1235','2016-11-09','5','',24,1,'2017-11-23',NULL,'prn9',NULL,23.00,'2016-11-09','C27350','','',NULL,'Aero','','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48415,'545','g6','2016-09-30','234','',4000,1,'2017-11-23',NULL,'prn9',NULL,3999.00,'2016-09-30','C27350','','',NULL,'Aero','RMT 6','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48416,'dgsdfg','RMK-GRN-001','2017-08-10','PO-001','bvnxfgchd  (10X10X10) ;Regular',100,5,'2017-11-24',NULL,'prn1',NULL,95.00,'2017-08-16','C27351','','',NULL,'Aero','dgsfg','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,10,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48417,'65756','g8','2016-10-18','5551','RMS 8  (5X5X5) ;Regular',250,5,'2017-11-24',NULL,'prn8',NULL,245.00,'2016-10-18','C27352','','',NULL,'Aero','RMT 8','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,25,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48418,'dgsdfg','RMK-GRN-001','2017-08-10','PO-001','',100,1,'2017-11-24',NULL,'prn9',NULL,99.00,'2017-08-16','C27353','','',NULL,'Aero','dgsfg','','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48419,'65756','g8','2016-10-18','5551','',250,1,'2017-11-24',NULL,'prn9',NULL,249.00,'2016-10-18','C27353','','',NULL,'Aero','RMT 8','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,0,'',0,NULL,NULL,NULL,'',NULL,NULL,NULL),(48420,'inn001','kar00001','2017-12-04',NULL,'raw spec  (20X20X10) Regular',2000,1,'2017-12-05','2017-12-05','flu-001',NULL,1999.00,'2017-12-04','C27354','','',NULL,'supp','raw type','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,20,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48421,'45646','kar00002','2017-12-06',NULL,'raw spec  (10 x 10 x 10) Boughtout',100,1,'2017-12-05','2017-12-05','flu-001',NULL,99.00,'2017-12-06','C27354','','',NULL,'supp','raw type','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,10,'',0,NULL,NULL,'','',NULL,NULL,NULL),(48422,'456435','kar00003','2017-12-06',NULL,'raw spec  (STD x STD x STD) Consummables',100,1,'2017-12-05','2017-12-05','flu-001',NULL,99.00,'2017-12-05','C27354','','',NULL,'supp','raw type','NOS','0000-00-00','0000-00-00',0.00,0.00,0.00,0.00,10,'',0,NULL,NULL,'','',NULL,NULL,NULL);
/*!40000 ALTER TABLE `consumption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `recnum` int(11) DEFAULT NULL,
  `contactid` varchar(20) DEFAULT NULL,
  `salutation` varchar(10) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` varchar(30) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `contact2company` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `contact2site` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (26,'C26','Mr.','b','m','RU','','','bm@ft.com','','','','','','',126,'Active','2016-03-10',NULL,'FSI',1),(27,'C27','Mr.','ravi','r','RU','','','ravi@gamil.com','','','','','','',126,'Active','2017-02-17',NULL,'FSI',1),(28,'C28','Mr.','asha','a','SU','','','asha@fluentsoft.com','','','','','','',127,'Active','2017-02-20',NULL,'FSI',1),(30,'C30','Mr.','aero','a','SU','','','aero@gamil.com','','','','','','',129,'Active','2017-02-20',NULL,'FSI',1);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `id` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `approved` varchar(20) DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  KEY `recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
INSERT INTO `contract` VALUES (1,'karthick rmk','CR1','Open','2018-01-17','2018-06-30','sa','2017-10-23','sa','2017-10-24','yes','sa','2017-10-24');
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_enquiry`
--

DROP TABLE IF EXISTS `contract_enquiry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract_enquiry` (
  `recnum` int(11) DEFAULT NULL,
  `refno` varchar(30) DEFAULT NULL,
  `enqdate` date DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `enqmode` varchar(255) DEFAULT NULL,
  `enqrefnum` varchar(50) DEFAULT NULL,
  `enqisfor` varchar(255) DEFAULT NULL,
  `diffspecify` varchar(255) DEFAULT NULL,
  `numofparts` varchar(255) DEFAULT NULL,
  `attachment1` varchar(255) DEFAULT NULL,
  `attachment2` varchar(255) DEFAULT NULL,
  `rawmaterial` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `resources` varchar(255) DEFAULT NULL,
  `qualityreq` varchar(255) DEFAULT NULL,
  `saliant` varchar(255) DEFAULT NULL,
  `aditional_resources` varchar(255) DEFAULT NULL,
  `investment` varchar(255) DEFAULT NULL,
  `subcontract` varchar(255) DEFAULT NULL,
  `special_process` varchar(255) DEFAULT NULL,
  `delivery_req` varchar(255) DEFAULT NULL,
  `person` varchar(50) DEFAULT NULL,
  `enq_answeredby` varchar(50) DEFAULT NULL,
  `quotation` varchar(100) DEFAULT NULL,
  `data_for_quote` varchar(255) DEFAULT NULL,
  `data_store` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `quotation_det_store` varchar(255) DEFAULT NULL,
  `risk_factors` varchar(255) DEFAULT NULL,
  `requirements` varchar(255) DEFAULT NULL,
  `quote_sentby` varchar(255) DEFAULT NULL,
  `explain_risk_factors` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `quote_path` varchar(255) DEFAULT NULL,
  `enquiry_path` varchar(255) DEFAULT NULL,
  `data_for_enquiry` varchar(255) DEFAULT NULL,
  `formrev` varchar(50) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract_enquiry`
--

LOCK TABLES `contract_enquiry` WRITE;
/*!40000 ALTER TABLE `contract_enquiry` DISABLE KEYS */;
INSERT INTO `contract_enquiry` VALUES (3,'3','2016-08-17','asdad','dsd','','1','','','','','','','','','','','','','','','','','asas','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3002 Rev No.:1','FSI');
/*!40000 ALTER TABLE `contract_enquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_review`
--

DROP TABLE IF EXISTS `contract_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract_review` (
  `recnum` int(11) DEFAULT NULL,
  `refno` varchar(30) DEFAULT NULL,
  `ordernum` varchar(30) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `ordertype` varchar(255) DEFAULT NULL,
  `orderfor` varchar(255) DEFAULT NULL,
  `quoterefnum` varchar(50) DEFAULT NULL,
  `numofparts` varchar(255) DEFAULT NULL,
  `attachment1` varchar(255) DEFAULT NULL,
  `attachment2` varchar(255) DEFAULT NULL,
  `rawmaterial` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `resources` varchar(255) DEFAULT NULL,
  `qualityreq` varchar(255) DEFAULT NULL,
  `saliant` varchar(255) DEFAULT NULL,
  `aditional_resources` varchar(255) DEFAULT NULL,
  `investment` varchar(255) DEFAULT NULL,
  `subcontract` varchar(255) DEFAULT NULL,
  `special_process` varchar(255) DEFAULT NULL,
  `delivery_req` varchar(255) DEFAULT NULL,
  `person` varchar(50) DEFAULT NULL,
  `enq_answeredby` varchar(50) DEFAULT NULL,
  `quotation` varchar(100) DEFAULT NULL,
  `data_for_quote` varchar(255) DEFAULT NULL,
  `data_store` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `quotation_det_store` varchar(255) DEFAULT NULL,
  `risk_factors` varchar(255) DEFAULT NULL,
  `requirements` varchar(255) DEFAULT NULL,
  `quote_sentby` varchar(255) DEFAULT NULL,
  `explain_risk_factors` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `quote_path` varchar(255) DEFAULT NULL,
  `enquiry_path` varchar(255) DEFAULT NULL,
  `data_for_enquiry` varchar(255) DEFAULT NULL,
  `formrev` varchar(50) DEFAULT NULL,
  `amendment_num` varchar(255) DEFAULT NULL,
  `amendment_date` date DEFAULT NULL,
  `special_instrns` longtext,
  `status` varchar(10) DEFAULT NULL,
  `val_status` varchar(50) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `qa_approved` varchar(45) DEFAULT NULL,
  `engineering_approved` varchar(45) DEFAULT NULL,
  `qa_app_by` varchar(100) DEFAULT NULL,
  `engg_app_by` varchar(100) DEFAULT NULL,
  `prodn_approved` varchar(45) DEFAULT NULL,
  `prodn_app_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract_review`
--

LOCK TABLES `contract_review` WRITE;
/*!40000 ALTER TABLE `contract_review` DISABLE KEYS */;
INSERT INTO `contract_review` VALUES (3198,'3198','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','John','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2014-01-21','','','','','','',''),(3199,'3199','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','svfsdvx','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-05-31','','','','','','',''),(3200,'3200','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','sdgds','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-05-24','','','','','','',''),(3201,'3201','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','dsgd','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-05-29','','','','','','',''),(3202,'3202','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','dsadf','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-05-31','','','','','','',''),(3203,'3203','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','sdgsd','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-05-24','','','','','','',''),(3204,'3204','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','sffsf','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-05-15','','','','','','',''),(3205,'3205','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3206,'3206','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','asggdsgds','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-05-11','','','','','','',''),(3207,'3207','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','ASDSD','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-06-23','','','','','','',''),(3208,'3208','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','qwre','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-06-27','','','','','','',''),(3209,'3209','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','sss','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-08-23','','','','','','',''),(3210,'3210','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3211,'3211','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3212,'3212','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3213,'3213','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2016-09-29','','','','','','',''),(3214,'3214','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','0000-00-00','','','','','','',''),(3215,'3215','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','0000-00-00','','','','','','',''),(3216,'3216','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','0000-00-00','','','','','','',''),(3217,'3217','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3218,'3218','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3219,'3219','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3220,'3220','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3219,'3219','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3221,'3221','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3222,'3222','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3223,'3223','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3224,'3224','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3225,'3225','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','Open','NO','0000-00-00','','','','','','',''),(3226,'3226','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','0000-00-00','','','','','','','');
/*!40000 ALTER TABLE `contract_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crn_fg`
--

DROP TABLE IF EXISTS `crn_fg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crn_fg` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `crn` varchar(20) DEFAULT NULL,
  `fg_qty` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_date` date NOT NULL,
  `modified_date` date NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `approved_by` varchar(100) NOT NULL,
  `approved_date` date NOT NULL,
  `approved` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crn_fg`
--

LOCK TABLES `crn_fg` WRITE;
/*!40000 ALTER TABLE `crn_fg` DISABLE KEYS */;
INSERT INTO `crn_fg` VALUES (1,'prn2',1,'Open','2017-05-08','2017-05-08','Sales','Sales','','0000-00-00',NULL),(2,'prn4',1,'Open','2017-05-08','2017-05-08','Sales','Sales','','0000-00-00',NULL),(3,'prn6',1,'Open','2017-05-08','2017-05-08','Sales','Sales','','0000-00-00',NULL),(4,'prn3',1,'Open','2016-05-09','2016-05-09','','','','0000-00-00',NULL),(5,'prn5',1,'Open','2017-05-08','2017-05-08','Sales','Sales','','0000-00-00',NULL);
/*!40000 ALTER TABLE `crn_fg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crn_mc`
--

DROP TABLE IF EXISTS `crn_mc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crn_mc` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mc_id` varchar(45) DEFAULT NULL,
  `mc_name` varchar(45) DEFAULT NULL,
  `mc_series` varchar(45) DEFAULT NULL,
  `crn` varchar(65) DEFAULT NULL,
  `runtime_hrs` float DEFAULT '0',
  `operation` varchar(85) DEFAULT NULL,
  `create_date` date DEFAULT '0000-00-00',
  `modified_date` date DEFAULT '0000-00-00',
  `created_by` varchar(65) DEFAULT NULL,
  `modified_by` varchar(65) DEFAULT NULL,
  `month` varchar(65) DEFAULT NULL,
  `year` varchar(65) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `blank` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crn_mc`
--

LOCK TABLES `crn_mc` WRITE;
/*!40000 ALTER TABLE `crn_mc` DISABLE KEYS */;
INSERT INTO `crn_mc` VALUES (7,'BMV 1','BMV 1','BMV 1','prn1',10,'','2016-11-15','2016-11-23','CAD','Sales','11','2016','FSI',1),(13,'VMC 2','VMC 2','VMC 2','prn2',10,'','2016-11-23','2016-11-23','Sales','Sales','11','2016','FSI',1),(4,'DX 4','DX 4','3','prn3',10,'','2016-11-15','0000-00-00','CAD',NULL,'11','2015','FSI',1),(5,'HMC 5','HMC 5','4','prn4',10,'','2016-11-15','0000-00-00','CAD',NULL,'11','2015','FSI',1),(11,'BMV 1','BMV 1','BMV 1','prn2',10,'','2016-11-15','2016-11-23','Sales','Sales','11','2016','FSI',1),(12,'BMV 1','BMV 1','BMV 1','prn5',10,'','2016-11-16','2017-06-20','Sales','Sales','10','2016','FSI',1),(14,'BMV 1','BMV 1','BMV 1','prn6',10,'','2016-11-23','0000-00-00','Sales',NULL,'11','2016','FSI',1),(15,'VMC 2','VMC 2','VMC 2','prn3',10,'','2016-11-23','2017-05-03','Sales','Sales','05','2017','FSI',1),(16,'BMV 1','BMV 1','BMV 1','prn4',10,'','2016-11-25','0000-00-00','Sales',NULL,'10','2016','FSI',1),(17,'DMG 3','DMG 3','BMV 1','prn3',10,'','2016-11-25','0000-00-00','Sales',NULL,'10','2016','FSI',1),(25,'DMG 3','DMG 3','1','prn2',1,'','2017-05-03','0000-00-00','Sales',NULL,'07','2017','FSI',1),(24,'VMC 2','VMC 2','1212','prn1',1,'','2017-05-03','0000-00-00','Sales',NULL,'06','2017','FSI',1),(23,'BMV 1','BMV 1','BMV 1','prn3',1,'','2017-05-03','0000-00-00','Sales',NULL,'05','2017','FSI',1),(26,'BMV 1','BMV 1','BMV','prn1',2,'1','2017-08-04','0000-00-00','Sales',NULL,'08','2017','FSI',1),(27,'BMV 1','BMV 1','BMV','prn2',3,'1','2017-08-04','0000-00-00','Sales',NULL,'08','2017','FSI',1),(28,'BMV 1','BMV 1','BMV','prn3',4,'1','2017-08-04','0000-00-00','Sales',NULL,'08','2017','FSI',1),(29,'VMC 2','VMC 2','VMC','prn4',2,'1','2017-08-04','0000-00-00','Sales',NULL,'08','2017','FSI',1),(30,'VMC 2','VMC 2','VMC','prn5',3,'1','2017-08-04','0000-00-00','Sales',NULL,'08','2017','FSI',1),(31,'DMG 3','DMG 3','DMG','prn6',2,'1','2017-08-04','0000-00-00','Sales',NULL,'08','2017','FSI',1);
/*!40000 ALTER TABLE `crn_mc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cust_data_lineitems`
--

DROP TABLE IF EXISTS `cust_data_lineitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cust_data_lineitems` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` int(11) DEFAULT NULL,
  `px` int(11) DEFAULT NULL,
  `py` int(11) DEFAULT NULL,
  `pz` int(11) DEFAULT NULL,
  `mx` int(11) DEFAULT NULL,
  `my` int(11) DEFAULT NULL,
  `mz` int(11) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `link2custdata` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cust_data_lineitems`
--

LOCK TABLES `cust_data_lineitems` WRITE;
/*!40000 ALTER TABLE `cust_data_lineitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `cust_data_lineitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cust_data_validation`
--

DROP TABLE IF EXISTS `cust_data_validation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cust_data_validation` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(30) DEFAULT NULL,
  `cust_ref_num` varchar(30) DEFAULT NULL,
  `partname` varchar(40) DEFAULT NULL,
  `cust_rev_num` varchar(30) DEFAULT NULL,
  `sup_mod_format` varchar(30) DEFAULT NULL,
  `translated_to` varchar(30) DEFAULT NULL,
  `approved_by` varchar(30) DEFAULT NULL,
  `prepared_by` varchar(30) DEFAULT NULL,
  `Issue` varchar(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cust_data_validation`
--

LOCK TABLES `cust_data_validation` WRITE;
/*!40000 ALTER TABLE `cust_data_validation` DISABLE KEYS */;
/*!40000 ALTER TABLE `cust_data_validation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cust_feedback`
--

DROP TABLE IF EXISTS `cust_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cust_feedback` (
  `recnum` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `formrev` varchar(100) DEFAULT NULL,
  `fdate` date DEFAULT NULL,
  `todate` date DEFAULT NULL,
  `ldate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cust_feedback`
--

LOCK TABLES `cust_feedback` WRITE;
/*!40000 ALTER TABLE `cust_feedback` DISABLE KEYS */;
INSERT INTO `cust_feedback` VALUES (1,'bmandyam','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00','2017-12-19','2017-12-31',NULL),(2,'bmandyam','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00','2017-12-31','2018-01-12',NULL),(5,'bmandyam','bmandyam','2017-12-20','FSI','MKT/F/01 Iss No:01.Rev:00','2017-12-05','2017-12-30','2017-11-01'),(6,'bmandyam','bmandyam','2017-12-21','FSI','MKT/F/01 Iss No:01.Rev:00','2017-12-21','2018-01-31','2017-12-21');
/*!40000 ALTER TABLE `cust_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cust_invoice`
--

DROP TABLE IF EXISTS `cust_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cust_invoice` (
  `recnum` int(11) DEFAULT NULL,
  `exporter` int(11) DEFAULT NULL,
  `consignee` int(11) DEFAULT NULL,
  `invnum` char(50) DEFAULT NULL,
  `invdate` date DEFAULT NULL,
  `invdesc` varchar(255) DEFAULT NULL,
  `inv2customer` int(11) DEFAULT NULL,
  `custpo_num` char(50) DEFAULT NULL,
  `precarriageby` char(50) DEFAULT NULL,
  `precarrierreceipt` char(50) DEFAULT NULL,
  `countryoforigin` char(50) DEFAULT NULL,
  `countryoffinaldest` char(50) DEFAULT NULL,
  `vessel` char(50) DEFAULT NULL,
  `portofloading` char(50) DEFAULT NULL,
  `terms` varchar(50) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `portofdischarge` char(50) DEFAULT NULL,
  `finaldest` char(50) DEFAULT NULL,
  `subtotal` decimal(12,2) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `totaldue` decimal(12,2) DEFAULT NULL,
  `packages` varchar(50) DEFAULT NULL,
  `remarks` text,
  `currency` char(5) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `fob_or_candf` char(10) DEFAULT NULL,
  `awbnum` varchar(45) DEFAULT NULL,
  `awbdate` date DEFAULT NULL,
  `fircnum` varchar(45) DEFAULT NULL,
  `fircdate` date DEFAULT NULL,
  `shipdate` date DEFAULT NULL,
  `shipping` varchar(45) DEFAULT NULL,
  `salestax` varchar(45) DEFAULT NULL,
  `inv2invli` int(10) unsigned DEFAULT NULL,
  `custporecnum` int(10) unsigned DEFAULT NULL,
  `formrev` varchar(255) DEFAULT NULL,
  `inv2shipping` int(10) unsigned DEFAULT NULL,
  `dcnum` varchar(45) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `advance_info` varchar(255) DEFAULT NULL,
  `advance_amount` decimal(8,2) DEFAULT NULL,
  `excise` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `excsubtotal` decimal(10,2) NOT NULL,
  `vatsubtotal` decimal(10,2) NOT NULL,
  `service_tax` decimal(10,2) DEFAULT NULL,
  `stsubtotal` decimal(10,2) DEFAULT NULL,
  KEY `ind_custinv_inv2customer` (`inv2customer`),
  KEY `cust_inv_ind_recnum` (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cust_invoice`
--

LOCK TABLES `cust_invoice` WRITE;
/*!40000 ALTER TABLE `cust_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `cust_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cust_invoice_line_items`
--

DROP TABLE IF EXISTS `cust_invoice_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cust_invoice_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` int(11) DEFAULT NULL,
  `custpo_num` char(50) DEFAULT NULL,
  `cofc_num` char(50) DEFAULT NULL,
  `crnnum` char(50) DEFAULT NULL,
  `rawmtl` varchar(255) DEFAULT NULL,
  `cimpartnum` varchar(255) DEFAULT NULL,
  `noofpackages` int(11) DEFAULT NULL,
  `packaging` varchar(255) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `tariff_schedule` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `line_amount` decimal(10,2) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `link2invoice` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `po_qty` int(10) unsigned DEFAULT NULL,
  `polinenum` int(10) unsigned DEFAULT NULL,
  `schpo` varchar(255) DEFAULT NULL,
  KEY `ind_custinv_link2invoice` (`link2invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cust_invoice_line_items`
--

LOCK TABLES `cust_invoice_line_items` WRITE;
/*!40000 ALTER TABLE `cust_invoice_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cust_invoice_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custfeedback_li`
--

DROP TABLE IF EXISTS `custfeedback_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custfeedback_li` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `parameters` varchar(100) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `remarks` text,
  `link2feedback` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custfeedback_li`
--

LOCK TABLES `custfeedback_li` WRITE;
/*!40000 ALTER TABLE `custfeedback_li` DISABLE KEYS */;
INSERT INTO `custfeedback_li` VALUES (1,'ON TIME DELIVERY',10,'texteh dbucivdvd dguffgsfshsc shssufcs vfucxc sfuisfs hffus svf fufhfhsfuig sfgsgfsgfsg ftexteh dbucivdvd dguffgsfshsc shssufcs vfucxc sfuisfs hffus svf fufhfhsfuig sfgsgfsgfsg ftexteh dbucivdvd dguffgsfshsc shssufcs vfucxc sfuisfs hffus svf fufhfhsfuig sfgsgfsgfsg f',1),(2,'PRODUCT QUALITY',20,'ehsgd',1),(3,'REJECTION/REWORK',30,'wrjscjs',1),(4,'PACKING AND DISPATCH',40,'',1),(5,'COMMUNICATION WITH CUSTOMER',50,'',1),(6,'ON TIME DELIVERY',10,'test',2),(7,'PRODUCT QUALITY',20,'ehsgd',2),(8,'REJECTION/REWORK',30,'wrjscjs',2),(9,'PACKING AND DISPATCH',40,'test',2),(10,'COMMUNICATION WITH CUSTOMER',50,'test',2),(11,'ON TIME DELIVERY',10,'test',5),(12,'PRODUCT QUALITY',9,'test',5),(13,'ON TIME DELIVERY',4,'test',6),(14,'PRODUCT QUALITY',7,'test',6),(15,'REJECTION/REWORK',8,'test',6),(16,'PACKING AND DISPATCH',9,'test',6),(17,'COMMUNICATION WITH CUSTOMER',10,'test',6),(18,'RESPONSE TO CUSTOMER REQUIREMENTS',5,'test',6),(19,'ATTENDING CUSTOMER COMPLAINT',6,'test',6),(20,'SERVICE QUALITY',7,'test',6),(21,'LENDING A HELPING HAND DURING CRISIS TIME',5,'test',6),(22,'OVERALL IMPRESSION WITH SN ENGINEERING',8,'test',6);
/*!40000 ALTER TABLE `custfeedback_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parameters` varchar(100) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `remarks` text,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `formrev` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Ashwini','test',10,'geqh gatdbchs dbcs cdc fcu tests shgcs sys sdscsih s syrsad cjh sbn sgcsgf gcusg dhagd ','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(2,'rajesh','test',9,'hdsnb','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(3,'bmandyam','',10,'test ysdsf','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(4,'bmandyam','',8,'dsfd','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(5,'bmandyam','',7,'dfsdsf','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(6,'bmandyam','',0,'','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(7,'bmandyam','',0,'','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(8,'bmandyam','',0,'','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(9,'bmandyam','',0,'','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(10,'bmandyam','',0,'','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(11,'bmandyam','',0,'','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00'),(12,'bmandyam','',0,'','bmandyam','2017-12-19','FSI','MKT/F/01 Iss No:01.Rev:00');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_notes`
--

DROP TABLE IF EXISTS `customer_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_notes` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `cust_notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2task` int(11) DEFAULT NULL,
  `notes2project` int(11) DEFAULT NULL,
  KEY `ind_recnum` (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_notes`
--

LOCK TABLES `customer_notes` WRITE;
/*!40000 ALTER TABLE `customer_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datasheet`
--

DROP TABLE IF EXISTS `datasheet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datasheet` (
  `recnum` int(11) DEFAULT NULL,
  `opn_ref_no` varchar(40) DEFAULT NULL,
  `drg_issue` varchar(20) DEFAULT NULL,
  `work_center` varchar(100) DEFAULT NULL,
  `opnnum` int(11) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `attachments` varchar(100) DEFAULT NULL,
  `revnum` varchar(30) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `parttype` varchar(40) DEFAULT NULL,
  `revdate` date DEFAULT NULL,
  `prepared_by` varchar(100) DEFAULT NULL,
  `approved_by` varchar(100) DEFAULT NULL,
  `issuenum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datasheet`
--

LOCK TABLES `datasheet` WRITE;
/*!40000 ALTER TABLE `datasheet` DISABLE KEYS */;
/*!40000 ALTER TABLE `datasheet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datasheet_line_items`
--

DROP TABLE IF EXISTS `datasheet_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datasheet_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `linenum` int(11) DEFAULT NULL,
  `tool_details` varchar(100) DEFAULT NULL,
  `tool_length` float DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `feed` float DEFAULT NULL,
  `opn_desc` varchar(100) DEFAULT NULL,
  `cnc_pgm_name` varchar(50) DEFAULT NULL,
  `link2ds` int(11) DEFAULT NULL,
  `est_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datasheet_line_items`
--

LOCK TABLES `datasheet_line_items` WRITE;
/*!40000 ALTER TABLE `datasheet_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `datasheet_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dates`
--

DROP TABLE IF EXISTS `dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dates` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `doctype` varchar(255) DEFAULT NULL,
  `sch_due` date DEFAULT NULL,
  `revised` date DEFAULT NULL,
  `completed` date DEFAULT NULL,
  `timetaken` varchar(30) DEFAULT NULL,
  `link2doc` int(11) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL,
  `link2wfconfig` int(11) DEFAULT NULL,
  `link2owner` int(11) DEFAULT NULL,
  `link2contact` int(11) DEFAULT NULL,
  `link2approvedbyowner` int(11) DEFAULT '0',
  `link2approvedbycontact` int(11) DEFAULT NULL,
  `hold_date` date DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `condition` varchar(100) DEFAULT NULL,
  `dependency` varchar(30) DEFAULT NULL,
  `stagename` varchar(100) DEFAULT NULL,
  `stagenum` int(11) DEFAULT NULL,
  `dept` varchar(40) DEFAULT NULL,
  `stagedependency` varchar(30) DEFAULT NULL,
  `secondary_responsibility` varchar(100) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `when_process` varchar(255) DEFAULT NULL,
  `email_list` varchar(255) DEFAULT NULL,
  `primary_responsibility` varchar(255) DEFAULT NULL,
  KEY `ind_dates_link2wo` (`link2wo`),
  KEY `ind_date_stagenum` (`stagenum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dates`
--

LOCK TABLES `dates` WRITE;
/*!40000 ALTER TABLE `dates` DISABLE KEYS */;
INSERT INTO `dates` VALUES (285447,'','WO','0000-00-00','0000-00-00',NULL,NULL,31418,31418,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285448,'','WO','0000-00-00','0000-00-00',NULL,NULL,31418,31418,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285449,'','WO','0000-00-00','0000-00-00',NULL,NULL,31419,31419,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285450,'','WO','0000-00-00','0000-00-00',NULL,NULL,31419,31419,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285451,'','WO','0000-00-00','0000-00-00',NULL,NULL,31420,31420,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285452,'','WO','0000-00-00','0000-00-00',NULL,NULL,31420,31420,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285453,'','WO','0000-00-00',NULL,NULL,NULL,31421,31421,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285454,'','WO','0000-00-00',NULL,NULL,NULL,31421,31421,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285455,'','WO','0000-00-00',NULL,NULL,NULL,31422,31422,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285456,'','WO','0000-00-00',NULL,NULL,NULL,31422,31422,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285457,'','WO','0000-00-00','0000-00-00',NULL,NULL,31423,31423,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285458,'','WO','0000-00-00','0000-00-00',NULL,NULL,31423,31423,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285459,'','WO','0000-00-00',NULL,NULL,NULL,31424,31424,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285460,'','WO','0000-00-00',NULL,NULL,NULL,31424,31424,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285461,'','WO','0000-00-00',NULL,NULL,NULL,31425,31425,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285462,'','WO','0000-00-00',NULL,NULL,NULL,31425,31425,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285463,'','WO','0000-00-00',NULL,NULL,NULL,31426,31426,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285464,'','WO','0000-00-00',NULL,NULL,NULL,31426,31426,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285465,'','WO','0000-00-00',NULL,NULL,NULL,31427,31427,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285466,'','WO','0000-00-00',NULL,NULL,NULL,31427,31427,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285467,'','WO','0000-00-00','0000-00-00',NULL,NULL,31428,31428,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285468,'','WO','0000-00-00','0000-00-00',NULL,NULL,31428,31428,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285469,'','WO','0000-00-00',NULL,NULL,NULL,31429,31429,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285470,'','WO','0000-00-00',NULL,NULL,NULL,31429,31429,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285471,'','WO','0000-00-00','0000-00-00',NULL,NULL,31430,31430,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285472,'','WO','0000-00-00','0000-00-00',NULL,NULL,31430,31430,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285473,'','WO','0000-00-00','0000-00-00',NULL,NULL,31431,31431,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285474,'','WO','0000-00-00','0000-00-00',NULL,NULL,31431,31431,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285475,'','WO','0000-00-00','0000-00-00',NULL,NULL,31432,31432,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285476,'','WO','0000-00-00','0000-00-00',NULL,NULL,31432,31432,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285477,'','WO','0000-00-00','0000-00-00',NULL,NULL,31433,31433,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285478,'','WO','0000-00-00','0000-00-00',NULL,NULL,31433,31433,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285479,'','WO','0000-00-00','0000-00-00',NULL,NULL,31434,31434,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285480,'','WO','0000-00-00','0000-00-00',NULL,NULL,31434,31434,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285481,'','WO','0000-00-00','0000-00-00',NULL,NULL,31435,31435,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285482,'','WO','0000-00-00','0000-00-00',NULL,NULL,31435,31435,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285483,'','WO','0000-00-00','0000-00-00',NULL,NULL,31436,31436,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285484,'','WO','0000-00-00','0000-00-00',NULL,NULL,31436,31436,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285485,'','WO','0000-00-00','0000-00-00',NULL,NULL,31437,31437,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285486,'','WO','0000-00-00','0000-00-00',NULL,NULL,31437,31437,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285487,'','WO','0000-00-00','0000-00-00',NULL,NULL,31438,31438,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285488,'','WO','0000-00-00','0000-00-00',NULL,NULL,31438,31438,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285489,'','WO','0000-00-00','0000-00-00',NULL,NULL,31439,31439,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285490,'','WO','0000-00-00','0000-00-00',NULL,NULL,31439,31439,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285491,'','WO','0000-00-00','2016-06-27',NULL,NULL,31440,31440,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285492,'','WO','0000-00-00','2016-06-27',NULL,NULL,31440,31440,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285493,'','WO','0000-00-00',NULL,NULL,NULL,31441,31441,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285494,'','WO','0000-00-00',NULL,NULL,NULL,31441,31441,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285495,'','WO','0000-00-00',NULL,NULL,NULL,31442,31442,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285496,'','WO','0000-00-00',NULL,NULL,NULL,31442,31442,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285497,'','WO','0000-00-00',NULL,NULL,NULL,31443,31443,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285498,'','WO','0000-00-00',NULL,NULL,NULL,31443,31443,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285499,'','WO','0000-00-00',NULL,NULL,NULL,31444,31444,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285500,'','WO','0000-00-00',NULL,NULL,NULL,31444,31444,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285501,'','WO','0000-00-00',NULL,NULL,NULL,31445,31445,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285502,'','WO','0000-00-00',NULL,NULL,NULL,31445,31445,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285503,'','WO','0000-00-00','0000-00-00',NULL,NULL,31446,31446,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285504,'','WO','0000-00-00','0000-00-00',NULL,NULL,31446,31446,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285505,'','WO','0000-00-00','0000-00-00',NULL,NULL,31447,31447,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285506,'','WO','0000-00-00','0000-00-00',NULL,NULL,31447,31447,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285507,'','WO','0000-00-00',NULL,NULL,NULL,31448,31448,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285508,'','WO','0000-00-00',NULL,NULL,NULL,31448,31448,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285509,'','WO','0000-00-00',NULL,NULL,NULL,31449,31449,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285510,'','WO','0000-00-00',NULL,NULL,NULL,31449,31449,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285511,'','WO','0000-00-00','0000-00-00',NULL,NULL,31450,31450,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285512,'','WO','0000-00-00','0000-00-00',NULL,NULL,31450,31450,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285513,'','WO','0000-00-00','0000-00-00',NULL,NULL,31451,31451,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285514,'','WO','0000-00-00','0000-00-00',NULL,NULL,31451,31451,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285515,'','WO','0000-00-00','0000-00-00',NULL,NULL,31452,31452,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285516,'','WO','0000-00-00','0000-00-00',NULL,NULL,31452,31452,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285517,'','WO','0000-00-00','0000-00-00',NULL,NULL,31453,31453,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285518,'','WO','0000-00-00','0000-00-00',NULL,NULL,31453,31453,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285519,'','WO','0000-00-00',NULL,NULL,NULL,31454,31454,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285520,'','WO','0000-00-00',NULL,NULL,NULL,31454,31454,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285521,'','WO','0000-00-00',NULL,NULL,NULL,31455,31455,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285522,'','WO','0000-00-00',NULL,NULL,NULL,31455,31455,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285523,'','WO','0000-00-00',NULL,NULL,NULL,31456,31456,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285524,'','WO','0000-00-00',NULL,NULL,NULL,31456,31456,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285525,'','WO','0000-00-00','0000-00-00',NULL,NULL,31457,31457,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285526,'','WO','0000-00-00','0000-00-00',NULL,NULL,31457,31457,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285527,'','WO','0000-00-00','0000-00-00',NULL,NULL,31458,31458,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285528,'','WO','0000-00-00','0000-00-00',NULL,NULL,31458,31458,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285529,'','WO','0000-00-00',NULL,NULL,NULL,31459,31459,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285530,'','WO','0000-00-00',NULL,NULL,NULL,31459,31459,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285531,'','WO','0000-00-00','0000-00-00',NULL,NULL,31460,31460,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285532,'','WO','0000-00-00','0000-00-00',NULL,NULL,31460,31460,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285533,'','WO','0000-00-00','0000-00-00','2016-10-05',NULL,31461,31461,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285534,'','WO','0000-00-00','0000-00-00','2016-10-05',NULL,31461,31461,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285535,'','WO','0000-00-00','0000-00-00',NULL,NULL,31462,31462,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285536,'','WO','0000-00-00','0000-00-00',NULL,NULL,31462,31462,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285537,'','WO','0000-00-00','0000-00-00','2016-10-05',NULL,31463,31463,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285538,'','WO','0000-00-00','0000-00-00','2016-10-05',NULL,31463,31463,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285539,'','WO','0000-00-00','0000-00-00',NULL,NULL,31464,31464,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285540,'','WO','0000-00-00','0000-00-00',NULL,NULL,31464,31464,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285541,'','WO','0000-00-00','0000-00-00',NULL,NULL,31465,31465,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285542,'','WO','0000-00-00','0000-00-00',NULL,NULL,31465,31465,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285543,'','WO','0000-00-00',NULL,NULL,NULL,31466,31466,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285544,'','WO','0000-00-00',NULL,NULL,NULL,31466,31466,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285545,'','WO','0000-00-00','0000-00-00',NULL,NULL,31467,31467,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285546,'','WO','0000-00-00','0000-00-00',NULL,NULL,31467,31467,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285547,'','WO','0000-00-00','0000-00-00',NULL,NULL,31468,31468,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285548,'','WO','0000-00-00','0000-00-00',NULL,NULL,31468,31468,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285549,'','WO','0000-00-00','0000-00-00','2016-10-18',NULL,31469,31469,19,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285550,'','WO','0000-00-00','0000-00-00','2016-10-18',NULL,31469,31469,24,NULL,NULL,1,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285551,'','WO','0000-00-00',NULL,'2016-10-28',NULL,31470,31470,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',220,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285552,'','WO','0000-00-00',NULL,'2016-10-28',NULL,31470,31470,24,NULL,NULL,1,NULL,NULL,NULL,'NA','','Issue Qty',220,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285553,'','WO','0000-00-00',NULL,NULL,NULL,31471,31471,19,NULL,NULL,1,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285554,'','WO','0000-00-00',NULL,NULL,NULL,31471,31471,24,NULL,NULL,1,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285555,'','WO','0000-00-00','0000-00-00','2016-11-04',NULL,31472,31472,19,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285556,'','WO','0000-00-00','0000-00-00','2016-11-04',NULL,31472,31472,24,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285557,'','WO','0000-00-00',NULL,NULL,NULL,31473,31473,19,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285558,'','WO','0000-00-00',NULL,NULL,NULL,31473,31473,24,NULL,NULL,0,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285559,'','WO','0000-00-00',NULL,NULL,NULL,31474,31474,19,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285560,'','WO','0000-00-00',NULL,NULL,NULL,31474,31474,24,NULL,NULL,0,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285561,'','WO','0000-00-00',NULL,NULL,NULL,31475,31475,19,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285562,'','WO','0000-00-00',NULL,NULL,NULL,31475,31475,24,NULL,NULL,0,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285563,'','WO','0000-00-00','0000-00-00','2016-11-05',NULL,31476,31476,19,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285564,'','WO','0000-00-00','0000-00-00','2016-11-05',NULL,31476,31476,24,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285565,'','WO','0000-00-00','0000-00-00','2016-11-07',NULL,31477,31477,19,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285566,'','WO','0000-00-00','0000-00-00','2016-11-07',NULL,31477,31477,24,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285567,'','WO','0000-00-00','0000-00-00','2016-11-09',NULL,31478,31478,19,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285568,'','WO','0000-00-00','0000-00-00','2016-11-09',NULL,31478,31478,24,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285569,'','WO','0000-00-00','0000-00-00','2016-11-09',NULL,31479,31479,19,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285570,'','WO','0000-00-00','0000-00-00','2016-11-09',NULL,31479,31479,24,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285571,'','WO','0000-00-00','0000-00-00','2017-02-20',NULL,31480,31480,19,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285572,'','WO','0000-00-00','0000-00-00','2017-02-20',NULL,31480,31480,24,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285573,'','WO','0000-00-00',NULL,NULL,NULL,31481,31481,19,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285574,'','WO','0000-00-00',NULL,NULL,NULL,31481,31481,24,NULL,NULL,0,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285575,'','WO','0000-00-00',NULL,NULL,NULL,31482,31482,19,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285576,'','WO','0000-00-00',NULL,NULL,NULL,31482,31482,24,NULL,NULL,0,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285577,'','WO','0000-00-00','0000-00-00',NULL,NULL,31483,31483,19,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285578,'','WO','0000-00-00','0000-00-00',NULL,NULL,31483,31483,24,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285579,'','WO','0000-00-00',NULL,NULL,NULL,31484,31484,19,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285580,'','WO','0000-00-00',NULL,NULL,NULL,31484,31484,24,NULL,NULL,0,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285581,'','WO','0000-00-00',NULL,NULL,NULL,31485,31485,19,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285582,'','WO','0000-00-00',NULL,NULL,NULL,31485,31485,24,NULL,NULL,0,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285583,'','WO','0000-00-00',NULL,NULL,NULL,31486,31486,19,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',10,'PPC','','sec response','process',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285584,'','WO','0000-00-00',NULL,NULL,NULL,31486,31486,24,NULL,NULL,0,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10','sec response','process',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285585,'','WO','0000-00-00','0000-00-00',NULL,NULL,31487,31487,19,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285586,'','WO','0000-00-00','0000-00-00',NULL,NULL,31487,31487,24,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285587,'','WO','0000-00-00','0000-00-00',NULL,NULL,31488,31488,19,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285588,'','WO','0000-00-00','0000-00-00',NULL,NULL,31488,31488,24,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285589,'','WO','0000-00-00','0000-00-00',NULL,NULL,31489,31489,19,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285590,'','WO','0000-00-00','0000-00-00',NULL,NULL,31489,31489,24,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','10','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285591,'','WO','0000-00-00','0000-00-00','2017-03-09',NULL,31490,31490,19,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create WO',10,'PPC','',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285592,'','WO','0000-00-00','0000-00-00','2017-03-09',NULL,31490,31490,24,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Issue Qty',50,'Stores','10',NULL,NULL,' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285593,'','WO','0000-00-00',NULL,'2017-08-08',NULL,31494,31494,16,NULL,NULL,2,NULL,NULL,NULL,'NA','','Create WO',0,'','','secfghdg','fgffghd',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285594,'','WO','0000-00-00','0000-00-00',NULL,NULL,31495,31495,16,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','Create WO',0,'','','secfghdg','fgffghd',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285595,'','WO','0000-00-00',NULL,NULL,NULL,31496,31496,16,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',0,'','','secfghdg','fgffghd',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285596,'','WO','0000-00-00',NULL,NULL,NULL,31497,31497,17,2,NULL,0,NULL,NULL,NULL,'NA','','trest',0,'ppc','','er','ere',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285597,'','WO','2017-08-10',NULL,NULL,NULL,31498,31498,16,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create WO',16,'PPC','','secfghdg','fgffghd',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285598,'','WO','2017-08-11',NULL,NULL,NULL,31499,31499,17,2,NULL,0,NULL,NULL,NULL,'NA','','trest',17,'ppc','','er','ere',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285599,'','WO','2017-08-12','0000-00-00',NULL,NULL,31500,31500,17,225,NULL,0,NULL,'0000-00-00','0000-00-00','','','trest',17,'ppc','','er','ere',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285600,'','WO','2017-08-12','0000-00-00','2017-08-10',NULL,31501,31501,16,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create WO',16,'PPC','','secfghdg','fgffghd',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285601,'','WO','2017-08-10','0000-00-00','2017-08-10',NULL,31502,31502,19,2,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',19,'QA','','y','y',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285602,'','WO','2017-08-10',NULL,'2017-08-10',NULL,31503,31503,20,2,NULL,2,NULL,NULL,NULL,'NA','','test',20,'PPC','','test','test',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285603,'','WO','2017-08-10','0000-00-00',NULL,NULL,31504,31504,19,2,NULL,0,NULL,'0000-00-00','0000-00-00','','','test',19,'QA','','y','y',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285604,'','WO','2017-08-10',NULL,NULL,NULL,31505,31505,18,2,NULL,0,NULL,NULL,NULL,'NA','','test',18,'Sales','','yy','yyy',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285605,'','WO','2017-08-10',NULL,NULL,NULL,31505,31505,22,2,NULL,0,NULL,NULL,NULL,'NA','','ere',22,'PPC1','','y','y',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ',NULL,NULL),(285606,'','WO','2017-08-14',NULL,NULL,NULL,31506,31506,18,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',18,'Sales','','yy','yyy',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285607,'','WO','2017-08-14',NULL,NULL,NULL,31506,31506,22,2,NULL,0,NULL,NULL,NULL,'NA','y','ere',22,'PPC1','y','y','y',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285608,'','WO','2017-08-14',NULL,NULL,NULL,31506,31506,24,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',24,'Management','','test','srfejh jewhw jbfs bjcbxbcc',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285609,'','WO','2017-08-14',NULL,NULL,NULL,31507,31507,18,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',18,'Sales','','yy','yyy',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285610,'','WO','2017-08-14',NULL,NULL,NULL,31507,31507,22,2,NULL,0,NULL,NULL,NULL,'NA','y','ere',22,'PPC1','y','y','y',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285611,'','WO','2017-08-14',NULL,NULL,NULL,31507,31507,24,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',24,'Management','','test','srfejh jewhw jbfs bjcbxbcc',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285612,'','WO','2017-08-14',NULL,NULL,NULL,31508,31508,25,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',25,'Management','','test',' test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285613,'','WO','2017-08-14',NULL,NULL,NULL,31508,31508,26,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',26,'Engineering','','test',' test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285614,'','WO','2017-08-15',NULL,'2017-08-14',NULL,31509,31509,25,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',25,'Management','','test',' test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285615,'','WO','2017-08-15',NULL,'2017-08-14',NULL,31509,31509,26,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',26,'Engineering','','test','test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285616,'','WO','2017-08-15',NULL,'2017-08-14',NULL,31509,31509,32,NULL,NULL,2,NULL,NULL,NULL,'NA','','',32,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285617,'','WO','2017-08-15',NULL,'2017-08-14',NULL,31509,31509,33,NULL,NULL,2,NULL,NULL,NULL,'NA','','',33,'Management','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285618,'','WO','2017-08-16','0000-00-00',NULL,NULL,31510,31510,29,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','test',29,'QA','','test','test te shu dnnhio bcbuichv nbji bbjid bio\r\nsjk o bbih cndkfeiu  uh   jiiiihihioj\r\nkscfs dhcdh cecjh dndiuwe hjsidsoid hsj',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285619,'','WO','2017-08-16','0000-00-00',NULL,NULL,31510,31510,30,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','29','test',30,'Packing','','test','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285620,'','WO','2017-08-16','0000-00-00','2017-08-16',NULL,31511,31511,25,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',123,'Management','','test',' test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285621,'','WO','2017-08-16','0000-00-00','2017-08-16',NULL,31511,31511,26,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',124,'Engineering','','test','test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285622,'','WO','2017-08-16','0000-00-00','2017-08-16',NULL,31511,31511,32,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','',244,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285623,'','WO','2017-08-16',NULL,NULL,NULL,31511,31511,33,NULL,NULL,0,NULL,NULL,NULL,'NA','','',344,'Management','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285624,'','WO','2017-08-31','0000-00-00',NULL,NULL,31512,31512,35,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','',23,'PPC','','Mr.Rahul Chhonkar','Hardcopy and Softcopy in ERP\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285625,'','WO','2017-08-31','0000-00-00',NULL,NULL,31512,31512,39,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','test',35,'Stores','','Mr. Nitin Sagar','Production Executive must ensure that all the raw material as per BOM is available in store. If available then he will handover the documents to line Supervisor but If he didn&#65533;t found material in stock then he must immediately raise the issue to th',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. NitinSagar@gmail.com',NULL),(285626,'','WO','2017-08-31','0000-00-00',NULL,NULL,31512,31512,37,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','100','',120,'PPC','100','Mr. Kamal Kant','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. KamalKant@gmail.com',NULL),(285627,'','WO','2017-08-31','0000-00-00',NULL,NULL,31512,31512,25,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','test',123,'Management','','test',' test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285628,'','WO','2017-08-31','0000-00-00',NULL,NULL,31512,31512,26,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','test',124,'Engineering','','test','test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285629,'','WO','2017-08-31','0000-00-00',NULL,NULL,31512,31512,34,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','1','',234,'Stores','1','Mr.Rahul Chhonkar','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285630,'','WO','2017-08-31','0000-00-00',NULL,NULL,31512,31512,32,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','',244,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285631,'','WO','2017-08-31',NULL,NULL,NULL,31512,31512,33,NULL,NULL,0,NULL,NULL,NULL,'NA','','',344,'Management','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285632,'','WO','2017-08-31',NULL,NULL,NULL,31512,31512,36,NULL,NULL,0,NULL,NULL,NULL,'NA','1','test',345,'Production','1','Kamal Kant','immediately after receiving the complete project file\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','KamalKant@gmail.com',NULL),(285633,'','WO','2017-08-31',NULL,NULL,NULL,31512,31512,38,NULL,NULL,0,NULL,NULL,NULL,'NA','','',366,'Management','','Mr. Nitin Sagar','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. NitinSagar@gmail.com',NULL),(285634,'','WO','0000-00-00',NULL,NULL,NULL,31513,31513,31,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create Wo',100,'Management','',' test',' test',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285635,'','WO','2017-08-17',NULL,'2017-08-28',NULL,31514,31514,35,NULL,NULL,2,NULL,NULL,NULL,'NA','','',23,'PPC','','Mr.Rahul Chhonkar','Hardcopy and Softcopy in ERP\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285636,'','WO','2017-08-17',NULL,NULL,NULL,31514,31514,39,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',35,'Stores','','Mr. Nitin Sagar','Production Executive must ensure that all the raw material as per BOM is available in store. If available then he will handover the documents to line Supervisor but If he didn&#65533;t found material in stock then he must immediately raise the issue to th',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. NitinSagar@gmail.com',NULL),(285637,'','WO','2017-08-17',NULL,NULL,NULL,31514,31514,37,NULL,NULL,0,NULL,NULL,NULL,'NA','100','',120,'PPC','100','Mr. Kamal Kant','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. KamalKant@gmail.com',NULL),(285638,'','WO','2017-08-17',NULL,NULL,NULL,31514,31514,25,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',123,'Management','','test',' test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285639,'','WO','2017-08-17',NULL,NULL,NULL,31514,31514,26,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',124,'Engineering','','test','test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285640,'','WO','2017-08-17',NULL,NULL,NULL,31514,31514,34,NULL,NULL,0,NULL,NULL,NULL,'NA','1','',234,'Stores','1','Mr.Rahul Chhonkar',' ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285641,'','WO','2017-08-17',NULL,NULL,NULL,31514,31514,32,NULL,NULL,0,NULL,NULL,NULL,'NA','','',244,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285642,'','WO','2017-08-17',NULL,NULL,NULL,31514,31514,33,NULL,NULL,0,NULL,NULL,NULL,'NA','','',344,'Management','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285643,'','WO','2017-08-17',NULL,NULL,NULL,31514,31514,36,NULL,NULL,0,NULL,NULL,NULL,'NA','1','test',345,'Production','1','Kamal Kant','immediately after receiving the complete project file\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','KamalKant@gmail.com',NULL),(285644,'','WO','2017-08-17',NULL,NULL,NULL,31514,31514,38,NULL,NULL,0,NULL,NULL,NULL,'NA','','',366,'Management','','Mr. Nitin Sagar','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. NitinSagar@gmail.com',NULL),(285645,'','WO','2017-08-28',NULL,NULL,NULL,31515,31515,31,NULL,NULL,0,NULL,NULL,NULL,'NA','','Create Wo',100,'Management','',' test',' test',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285646,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,35,NULL,NULL,0,NULL,NULL,NULL,'NA','','',23,'PPC','','Mr.Rahul Chhonkar','Hardcopy and Softcopy in ERP\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285647,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,39,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',35,'Stores','','Mr. Nitin Sagar','Production Executive must ensure that all the raw material as per BOM is available in store. If available then he will handover the documents to line Supervisor but If he didn&#65533;t found material in stock then he must immediately raise the issue to th',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. NitinSagar@gmail.com',NULL),(285648,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,37,NULL,NULL,0,NULL,NULL,NULL,'NA','100','',120,'PPC','100','Mr. Kamal Kant','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. KamalKant@gmail.com',NULL),(285649,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,25,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',123,'Management','','test',' test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285650,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,26,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',124,'Engineering','','test','test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285651,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,34,NULL,NULL,0,NULL,NULL,NULL,'NA','1','',234,'Stores','1','Mr.Rahul Chhonkar',' ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285652,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,32,NULL,NULL,0,NULL,NULL,NULL,'NA','','',244,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285653,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,33,NULL,NULL,0,NULL,NULL,NULL,'NA','','',344,'Management','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285654,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,36,NULL,NULL,0,NULL,NULL,NULL,'NA','1','test',345,'Production','1','Kamal Kant','immediately after receiving the complete project file\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','KamalKant@gmail.com',NULL),(285655,'','WO','2017-08-28',NULL,NULL,NULL,31516,31516,38,NULL,NULL,0,NULL,NULL,NULL,'NA','','',366,'Management','','Mr. Nitin Sagar','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. NitinSagar@gmail.com',NULL),(285656,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,35,NULL,NULL,0,NULL,NULL,NULL,'NA','','',23,'PPC','','Mr.Rahul Chhonkar','Hardcopy and Softcopy in ERP\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285657,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,39,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',35,'Stores','','Mr. Nitin Sagar','Production Executive must ensure that all the raw material as per BOM is available in store. If available then he will handover the documents to line Supervisor but If he didn&#65533;t found material in stock then he must immediately raise the issue to th',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. NitinSagar@gmail.com',NULL),(285658,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,37,NULL,NULL,0,NULL,NULL,NULL,'NA','100','',120,'PPC','100','Mr. Kamal Kant','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. KamalKant@gmail.com',NULL),(285659,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,25,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',123,'Management','','test',' test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285660,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,26,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',124,'Engineering','','test','test ytyds hsdsbuds sdbsysd sdbssg sui cxcncxjcxjc vcjxcx cs wewisw jhewte hwi jwdshis djgsd sdnsjsdgs j gsdhs dsj sjhdshds',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285661,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,34,NULL,NULL,0,NULL,NULL,NULL,'NA','1','',234,'Stores','1','Mr.Rahul Chhonkar',' ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285662,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,32,NULL,NULL,0,NULL,NULL,NULL,'NA','','',244,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285663,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,33,NULL,NULL,0,NULL,NULL,NULL,'NA','','',344,'Management','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','ashwini@fluentsoft.com',NULL),(285664,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,36,NULL,NULL,0,NULL,NULL,NULL,'NA','1','test',345,'Production','1','Kamal Kant','immediately after receiving the complete project file\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','KamalKant@gmail.com',NULL),(285665,'','WO','2017-08-28',NULL,NULL,NULL,31517,31517,38,NULL,NULL,0,NULL,NULL,NULL,'NA','','',366,'Management','','Mr. Nitin Sagar','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','Mr. NitinSagar@gmail.com',NULL),(285666,'','WO','2017-08-28',NULL,'2017-08-28',NULL,31518,31518,40,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',10,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285667,'','WO','2017-08-29',NULL,'2017-08-28',NULL,31518,31518,41,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',20,'Stores','','Kamal Kant','immediately after receiving the complete project file\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285668,'','WO','2017-08-30',NULL,'2017-08-28',NULL,31518,31518,42,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',30,'Engineering','','Mr.Rahul Chhonkar','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285669,'','WO','2017-08-30',NULL,'2017-08-28',NULL,31518,31518,43,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',40,'PPC','','Mr. Kamal Kant','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285670,'','WO','2017-08-30',NULL,'2017-08-28',NULL,31518,31518,44,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',50,'Production','','Mr. Vivek Saxena','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285671,'','WO','2017-08-31',NULL,'2017-08-28',NULL,31518,31518,45,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',60,'QA','','Mr. Nitin Sagar','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285672,'','WO','2017-08-28',NULL,'2017-08-28',NULL,31518,31518,46,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',70,'Assembly','','Mr. Jahir/Mr. Robin','through format no&#65533;&#65533;\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285673,'','WO','2017-08-29',NULL,'2017-08-28',NULL,31518,31518,47,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',80,'Packing','','Mr. Shivendu','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285674,'','WO','2017-08-31',NULL,'2017-08-28',NULL,31518,31518,48,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',90,'Purchasing','','Mr. Narottam/Mr. Sanjeev','All product after QC clearance must be packed according to minimum packing standards/as per packing instructions in order.\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285675,'','WO','2017-08-31',NULL,'2017-08-28',NULL,31518,31518,49,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',100,'Management','','Mr. G.R Sharma','Inform whether the payment has received as per the approved payment terms decided at the order finalization. After getting OK from Accounts, production dept. must ensure full kitting of dispatch of that partiicular Job Card along with the synchronization ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285676,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,40,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',10,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285677,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,41,NULL,NULL,0,NULL,NULL,NULL,'NA','10','test',20,'Stores','','Kamal Kant','immediately after receiving the complete project file\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285678,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,42,NULL,NULL,0,NULL,NULL,NULL,'NA','20','test',30,'Engineering','','Mr.Rahul Chhonkar','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285679,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,43,NULL,NULL,0,NULL,NULL,NULL,'NA','30','test',40,'PPC','','Mr. Kamal Kant','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285680,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,44,NULL,NULL,0,NULL,NULL,NULL,'NA','40','test',50,'Production','','Mr. Vivek Saxena','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285681,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,45,NULL,NULL,0,NULL,NULL,NULL,'NA','50','test',60,'QA','','Mr. Nitin Sagar','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285682,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,46,NULL,NULL,0,NULL,NULL,NULL,'NA','60','test',70,'Assembly','','Mr. Jahir/Mr. Robin','through format no&#65533;&#65533;\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285683,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,47,NULL,NULL,0,NULL,NULL,NULL,'NA','70','test',80,'Packing','','Mr. Shivendu','',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285684,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,48,NULL,NULL,0,NULL,NULL,NULL,'NA','80','test',90,'Purchasing','','Mr. Narottam/Mr. Sanjeev','All product after QC clearance must be packed according to minimum packing standards/as per packing instructions in order.\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285685,'','WO','2017-08-28',NULL,NULL,NULL,31519,31519,49,NULL,NULL,0,NULL,NULL,NULL,'NA','90','test',100,'Management','','Mr. G.R Sharma','Inform whether the payment has received as per the approved payment terms decided at the order finalization. After getting OK from Accounts, production dept. must ensure full kitting of dispatch of that partiicular Job Card along with the synchronization ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285686,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31520,31520,50,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Pattern','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285687,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31520,31520,51,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Print','','Kamal Kant','immediately after receiving the complete project file',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285688,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31520,31520,52,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',30,'Assy Kit','','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285689,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31520,31520,54,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Scanout','','Mr. Vipin Kaushik','He must check all the relevant papers (viz. payment terms, PI, Bills, Form C etc.) and ensure that the total payment should be received from the Client.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285690,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31520,31520,55,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'Tailored','','Site Supervisor','As per Format No. Kalco/Proj/F02 each and every thing should be finally handover to client along with his/her signature and handover the User Manual to the Client.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285691,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31520,31520,56,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'QA','','Mr. Amit Sharma','As per Format No. Kalco/Proj/F01 If he found unfit to deliver it to the Client then he must ensure that the rectification should be done within minimum time frame.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285692,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31521,31521,50,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Pattern','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285693,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31521,31521,51,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Print','','Kamal Kant','immediately after receiving the complete project file',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285694,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31521,31521,52,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',30,'Assy Kit','','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285695,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31521,31521,54,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Scanout','','Mr. Vipin Kaushik','He must check all the relevant papers (viz. payment terms, PI, Bills, Form C etc.) and ensure that the total payment should be received from the Client.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285696,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31521,31521,55,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'Tailored','','Site Supervisor','As per Format No. Kalco/Proj/F02 each and every thing should be finally handover to client along with his/her signature and handover the User Manual to the Client.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285697,'','WO','2017-08-28','0000-00-00','2017-11-23',NULL,31521,31521,56,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'QA','','Mr. Amit Sharma','As per Format No. Kalco/Proj/F01 If he found unfit to deliver it to the Client then he must ensure that the rectification should be done within minimum time frame.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285698,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,40,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',10,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285699,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,41,NULL,NULL,0,NULL,NULL,NULL,'NA','10','test',20,'Stores','','Kamal Kant',' immediately after receiving the complete project file\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285700,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,42,NULL,NULL,0,NULL,NULL,NULL,'NA','20','test',30,'Engineering','','Mr.Rahul Chhonkar','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285701,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,43,NULL,NULL,0,NULL,NULL,NULL,'NA','30','test',40,'PPC','','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI) from Accounts department. If he found any discrepancy from the order then he must take the corrected order',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285702,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,44,NULL,NULL,0,NULL,NULL,NULL,'NA','40','test',50,'Production','','Mr. Vivek Saxena','After receiving MMS in ERP technical executive will make Bill of Material and all production document from K-Soft (viz. stickers, cutting list, assembling list, special instruction if any etc.)\r\n* Any kind of mistake will not be acceptable & may lead to',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285703,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,45,NULL,NULL,0,NULL,NULL,NULL,'NA','50','test',60,'QA','','Mr. Nitin Sagar','After receiving the complete production document from technical department, production executive will verify that he has received all the documents as per norms* .\r\n* BOM, Cutting list,elevation and shop drawing, MMS etc.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285704,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,46,NULL,NULL,0,NULL,NULL,NULL,'NA','60','test',70,'Assembly','','Mr. Jahir/Mr. Robin','through format no&#65533;&#65533;\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285705,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,47,NULL,NULL,0,NULL,NULL,NULL,'NA','70','test',80,'Packing','','Mr. Shivendu','He must follow Format No&#65533;..,fill it completely* and hand over it to Data Entry Operator for feeding it in ERP. If found any Quality defect then he should inform it to the Line Supervisor, Production Executive, Production head and MDO.\r\n* Any kind o',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285706,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,48,NULL,NULL,0,NULL,NULL,NULL,'NA','80','test',90,'Purchasing','','Mr. Narottam/Mr. Sanjeev','All product after QC clearance must be packed according to minimum packing standards/as per packing instructions in order.\r\n',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','',NULL),(285707,'','WO','2017-08-29',NULL,NULL,NULL,31522,31522,49,NULL,NULL,0,NULL,NULL,NULL,'NA','90','test',100,'Management','','Mr. G.R Sharma','Inform whether the payment has received as per the approved payment terms decided at the order finalization. After getting OK from Accounts, production dept. must ensure full kitting of dispatch of that partiicular Job Card along with the synchronization ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285708,'','WO','2017-08-29','0000-00-00','2017-09-12',NULL,31523,31523,50,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Pattern','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285709,'','WO','2017-08-29','0000-00-00','2017-09-12',NULL,31523,31523,51,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Print','','Kamal Kant',' immediately after receiving the complete project file',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285710,'','WO','2017-08-29','0000-00-00','2017-09-12',NULL,31523,31523,52,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',30,'Assy Kit','','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285711,'','WO','2017-08-29','0000-00-00','2017-09-12',NULL,31523,31523,54,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Scanout','','Mr. Vipin Kaushik','He must check all the relevant papers (viz. payment terms, PI, Bills, Form C etc.) and ensure that the total payment should be received from the Client.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285712,'','WO','2017-08-29','0000-00-00','2017-09-12',NULL,31523,31523,55,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'Tailored','','Site Supervisor','As per Format No. Kalco/Proj/F02 each and every thing should be finally handover to client along with his/her signature and handover the User Manual to the Client.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285713,'','WO','2017-08-29','0000-00-00','2017-09-12',NULL,31523,31523,56,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'QA','','Mr. Amit Sharma','As per Format No. Kalco/Proj/F01 If he found unfit to deliver it to the Client then he must ensure that the rectification should be done within minimum time frame.',' As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',NULL),(285714,'','WO','2017-09-07','0000-00-00','2017-09-12',NULL,31524,31524,50,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Pattern','','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.','fluentsoft.com',''),(285715,'','WO','2017-09-07','0000-00-00','2017-09-12',NULL,31524,31524,51,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Print','10','Kamal Kant',' immediately after receiving the complete project file','As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site','fluentsoft.com',''),(285716,'','WO','2017-09-07','0000-00-00','2017-09-12',NULL,31524,31524,52,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',30,'Assy Kit','20','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI)* from Accounts department. If he found any discrepancy from the order then he must take the corrected order','After receiving the MMS form and photos of site within 4 hours.','fluentsoft.com',''),(285717,'','WO','2017-09-07','0000-00-00','2017-09-12',NULL,31524,31524,54,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Scanout','30','Mr. Vipin Kaushik','He must check all the relevant papers (viz. payment terms, PI, Bills, Form C etc.) and ensure that the total payment should be received from the Client.','Immediately with CHR.','fluentsoft.com',''),(285718,'','WO','2017-09-07','0000-00-00','2017-09-12',NULL,31524,31524,55,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'Tailored','50','Site Supervisor','As per Format No. Kalco/Proj/F02 each and every thing should be finally handover to client along with his/her signature and handover the User Manual to the Client.','At the time of Handover but within as minimum as possible time after PHR.','fluentsoft.com',''),(285719,'','WO','2017-09-07','0000-00-00','2017-09-12',NULL,31524,31524,56,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'QA','60','Mr. Amit Sharma','As per Format No. Kalco/Proj/F01 If he found unfit to deliver it to the Client then he must ensure that the rectification should be done within minimum time frame.','After/during the fixing of product.','fluentsoft.com',''),(285720,'','WO','0000-00-00',NULL,NULL,NULL,31525,31525,57,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',10,'Pattern','','Pattern Owner','As per our terms & conditions in Quotation along with the Advance cheque','After receiving it from Client within a day and send for approval to Technical dept.','pattern@fluentsoft.com','Badari'),(285721,'','WO','0000-00-00',NULL,NULL,NULL,31525,31525,58,NULL,NULL,0,NULL,NULL,NULL,'NA','10','test',20,'Print','10','Print Owner','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.','print@fluentsoft.com','Badari'),(285722,'','WO','0000-00-00',NULL,NULL,NULL,31525,31525,59,NULL,NULL,0,NULL,NULL,NULL,'NA','20','test',30,'Assy Kit','20','AssyKit Owner','immediately after receiving the 1st copy of order within a day.','immediately after receiving the 1st copy of order within a day.','assy_kit@fluentsoft.com','Badari'),(285723,'','WO','0000-00-00',NULL,NULL,NULL,31525,31525,60,NULL,NULL,0,NULL,NULL,NULL,'NA','30','test',40,'Scanout','30','Scanout Owner','immediately after receiving the 1st copy of order within a day.','immediately after receiving the 1st copy of order within a day.','pattern@fluentsoft.com','stores'),(285724,'','WO','0000-00-00',NULL,NULL,NULL,31525,31525,61,NULL,NULL,0,NULL,NULL,NULL,'NA','40','test',50,'Tailored','40','Tailored Owner','immediately after receiving the 1st copy of order within a day.','immediately after receiving the 1st copy of order within a day.','print@fluentsoft.com','sa'),(285725,'','WO','0000-00-00',NULL,NULL,NULL,31525,31525,62,NULL,NULL,0,NULL,NULL,NULL,'NA','50','test',60,'QA','50','QA Owner','immediately after receiving the 1st copy of order within a day.','immediately after receiving the 1st copy of order within a day.','pattern@fluentsoft.com','Badari'),(285726,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31526,31526,57,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Pattern','','Pattern Owner','As per our terms & conditions in Quotation along with the Advance cheque','After receiving it from Client within a day and send for approval to Technical dept.','pattern@fluentsoft.com','Badari'),(285727,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31526,31526,58,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Print','10','Print Owner','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.','print@fluentsoft.com','Badari'),(285728,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31526,31526,59,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',30,'Assy Kit','20','AssyKit Owner','immediately after receiving the 1st copy of order within a day.','immediately after receiving the 1st copy of order within a day.','assy_kit@fluentsoft.com','Badari'),(285729,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31526,31526,60,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',40,'Scanout','30','Scanout Owner','immediately after receiving the 1st copy of order within a day.','immediately after receiving the 1st copy of order within a day.','pattern@fluentsoft.com','stores'),(285730,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31526,31526,61,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Tailored','40','Tailored Owner','immediately after receiving the 1st copy of order within a day.','immediately after receiving the 1st copy of order within a day.','print@fluentsoft.com','sa'),(285731,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31526,31526,62,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'QA','50','QA Owner','immediately after receiving the 1st copy of order within a day.','immediately after receiving the 1st copy of order within a day.','pattern@fluentsoft.com','Badari'),(285732,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31527,31527,50,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Pattern','','Pattern Owner','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.','fluentsoft.com',''),(285733,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31527,31527,51,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Print','10','Print Owner',' immediately after receiving the complete project file','As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site','fluentsoft.com',''),(285734,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31527,31527,52,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',30,'Assy Kit','20','Assy Kit Owner','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI)* from Accounts department. If he found any discrepancy from the order then he must take the corrected order','After receiving the MMS form and photos of site within 4 hours.','fluentsoft.com',''),(285735,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31527,31527,54,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Scanout','30','Scanout Owner','He must check all the relevant papers (viz. payment terms, PI, Bills, Form C etc.) and ensure that the total payment should be received from the Client.','Immediately with CHR.','fluentsoft.com',''),(285736,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31527,31527,55,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'Tailored','50','Tailored Owner','As per Format No. Kalco/Proj/F02 each and every thing should be finally handover to client along with his/her signature and handover the User Manual to the Client.','At the time of Handover but within as minimum as possible time after PHR.','fluentsoft.com',''),(285737,'','WO','2017-09-12','0000-00-00','2017-09-12',NULL,31527,31527,56,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'QA','60','QA Owner','As per Format No. Kalco/Proj/F01 If he found unfit to deliver it to the Client then he must ensure that the rectification should be done within minimum time frame.','After/during the fixing of product.','fluentsoft.com',''),(285738,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31528,31528,31,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create Wo',100,'Management','','test',' test',' test',NULL,NULL),(285739,'','WO','0000-00-00',NULL,'2017-11-03',NULL,31529,31529,40,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',10,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n','After receiving it from Client within a day and send for approval to Technical dept.\r\n','fluentsoft.com',''),(285740,'','WO','0000-00-00',NULL,NULL,NULL,31529,31529,41,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',20,'Stores','10','Kamal Kant',' immediately after receiving the complete project file\r\n','As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',''),(285741,'','WO','0000-00-00',NULL,NULL,NULL,31529,31529,42,NULL,NULL,0,NULL,NULL,NULL,'NA','20','test',30,'Engineering','20','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.\r\n','fluentsoft.com',''),(285742,'','WO','0000-00-00',NULL,NULL,NULL,31529,31529,43,NULL,NULL,0,NULL,NULL,NULL,'NA','30','test',40,'PPC','30','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI) from Accounts department. If he found any discrepancy from the order then he must take the corrected order','After receiving the MMS form and photos of site within 4 hours.\r\n','fluentsoft.com',''),(285743,'','WO','0000-00-00',NULL,NULL,NULL,31529,31529,44,NULL,NULL,0,NULL,NULL,NULL,'NA','40','test',50,'Production','40','Mr. Vivek Saxena','After receiving MMS in ERP technical executive will make Bill of Material and all production document from K-Soft (viz. stickers, cutting list, assembling list, special instruction if any etc.)\r\n* Any kind of mistake will not be acceptable & may lead to','After receiving the copy of MMS within 4 hours.\r\n','fluentsoft.com',''),(285744,'','WO','0000-00-00',NULL,NULL,NULL,31529,31529,45,NULL,NULL,0,NULL,NULL,NULL,'NA','50','test',60,'QA','50','Mr. Nitin Sagar','After receiving the complete production document from technical department, production executive will verify that he has received all the documents as per norms* .\r\n* BOM, Cutting list,elevation and shop drawing, MMS etc.','After preparation of production document within 4 hours.\r\n','fluentsoft.com',''),(285745,'','WO','0000-00-00',NULL,NULL,NULL,31529,31529,46,NULL,NULL,0,NULL,NULL,NULL,'NA','60','test',70,'Assembly','60','Mr. Jahir/Mr. Robin','through format no&#65533;&#65533;\r\n','after receiving Production document within 1 hour.\r\n','fluentsoft.com',''),(285746,'','WO','0000-00-00',NULL,NULL,NULL,31529,31529,47,NULL,NULL,0,NULL,NULL,NULL,'NA','70','test',80,'Packing','70','Mr. Shivendu','He must follow Format No&#65533;..,fill it completely* and hand over it to Data Entry Operator for feeding it in ERP. If found any Quality defect then he should inform it to the Line Supervisor, Production Executive, Production head and MDO.\r\n* Any kind o','Immediately after receiving the complete product from production department.\r\n','fluentsoft.com',''),(285747,'','WO','0000-00-00',NULL,NULL,NULL,31529,31529,48,NULL,NULL,0,NULL,NULL,NULL,'NA','80','test',90,'Purchasing','80','Mr. Narottam/Mr. Sanjeev','All product after QC clearance must be packed according to minimum packing standards/as per packing instructions in order.\r\n','After receiving the complete product from Quality department.\r\n','',''),(285748,'','WO','0000-00-00',NULL,NULL,NULL,31529,31529,49,NULL,NULL,0,NULL,NULL,NULL,'NA','90','test',100,'Management','90','Mr. G.R Sharma','Inform whether the payment has received as per the approved payment terms decided at the order finalization. After getting OK from Accounts, production dept. must ensure full kitting of dispatch of that partiicular Job Card along with the synchronization ','After receiving the request of clearance from Production Executive within 2 hours by mail only.','fluentsoft.com',''),(285749,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,40,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',10,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n','After receiving it from Client within a day and send for approval to Technical dept.\r\n','fluentsoft.com',''),(285750,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,41,NULL,NULL,0,NULL,NULL,NULL,'NA','10','test',20,'Stores','10','Kamal Kant',' immediately after receiving the complete project file\r\n','As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',''),(285751,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,42,NULL,NULL,0,NULL,NULL,NULL,'NA','20','test',30,'Engineering','20','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.\r\n','fluentsoft.com',''),(285752,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,43,NULL,NULL,0,NULL,NULL,NULL,'NA','30','test',40,'PPC','30','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI) from Accounts department. If he found any discrepancy from the order then he must take the corrected order','After receiving the MMS form and photos of site within 4 hours.\r\n','fluentsoft.com',''),(285753,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,44,NULL,NULL,0,NULL,NULL,NULL,'NA','40','test',50,'Production','40','Mr. Vivek Saxena','After receiving MMS in ERP technical executive will make Bill of Material and all production document from K-Soft (viz. stickers, cutting list, assembling list, special instruction if any etc.)\r\n* Any kind of mistake will not be acceptable & may lead to','After receiving the copy of MMS within 4 hours.\r\n','fluentsoft.com',''),(285754,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,45,NULL,NULL,0,NULL,NULL,NULL,'NA','50','test',60,'QA','50','Mr. Nitin Sagar','After receiving the complete production document from technical department, production executive will verify that he has received all the documents as per norms* .\r\n* BOM, Cutting list,elevation and shop drawing, MMS etc.','After preparation of production document within 4 hours.\r\n','fluentsoft.com',''),(285755,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,46,NULL,NULL,0,NULL,NULL,NULL,'NA','60','test',70,'Assembly','60','Mr. Jahir/Mr. Robin','through format no&#65533;&#65533;\r\n','after receiving Production document within 1 hour.\r\n','fluentsoft.com',''),(285756,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,47,NULL,NULL,0,NULL,NULL,NULL,'NA','70','test',80,'Packing','70','Mr. Shivendu','He must follow Format No&#65533;..,fill it completely* and hand over it to Data Entry Operator for feeding it in ERP. If found any Quality defect then he should inform it to the Line Supervisor, Production Executive, Production head and MDO.\r\n* Any kind o','Immediately after receiving the complete product from production department.\r\n','fluentsoft.com',''),(285757,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,48,NULL,NULL,0,NULL,NULL,NULL,'NA','80','test',90,'Purchasing','80','Mr. Narottam/Mr. Sanjeev','All product after QC clearance must be packed according to minimum packing standards/as per packing instructions in order.\r\n','After receiving the complete product from Quality department.\r\n','',''),(285758,'','WO','0000-00-00',NULL,NULL,NULL,31530,31530,49,NULL,NULL,0,NULL,NULL,NULL,'NA','90','test',100,'Management','90','Mr. G.R Sharma','Inform whether the payment has received as per the approved payment terms decided at the order finalization. After getting OK from Accounts, production dept. must ensure full kitting of dispatch of that partiicular Job Card along with the synchronization ','After receiving the request of clearance from Production Executive within 2 hours by mail only.','fluentsoft.com',''),(285759,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,40,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n','After receiving it from Client within a day and send for approval to Technical dept.\r\n','fluentsoft.com',''),(285760,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,41,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Stores','10','Kamal Kant',' immediately after receiving the complete project file\r\n','As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',''),(285761,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,42,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',30,'Engineering','20','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.\r\n','fluentsoft.com',''),(285762,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,43,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',40,'PPC','30','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI) from Accounts department. If he found any discrepancy from the order then he must take the corrected order','After receiving the MMS form and photos of site within 4 hours.\r\n','fluentsoft.com',''),(285763,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,44,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Production','40','Mr. Vivek Saxena','After receiving MMS in ERP technical executive will make Bill of Material and all production document from K-Soft (viz. stickers, cutting list, assembling list, special instruction if any etc.)\r\n* Any kind of mistake will not be acceptable & may lead to','After receiving the copy of MMS within 4 hours.\r\n','fluentsoft.com',''),(285764,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,45,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'QA','50','Mr. Nitin Sagar','After receiving the complete production document from technical department, production executive will verify that he has received all the documents as per norms* .\r\n* BOM, Cutting list,elevation and shop drawing, MMS etc.','After preparation of production document within 4 hours.\r\n','fluentsoft.com',''),(285765,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,46,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'Assembly','60','Mr. Jahir/Mr. Robin','through format no&#65533;&#65533;\r\n','after receiving Production document within 1 hour.\r\n','fluentsoft.com',''),(285766,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,47,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',80,'Packing','70','Mr. Shivendu','He must follow Format No&#65533;..,fill it completely* and hand over it to Data Entry Operator for feeding it in ERP. If found any Quality defect then he should inform it to the Line Supervisor, Production Executive, Production head and MDO.\r\n* Any kind o','Immediately after receiving the complete product from production department.\r\n','fluentsoft.com',''),(285767,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,48,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',90,'Purchasing','80','Mr. Narottam/Mr. Sanjeev','All product after QC clearance must be packed according to minimum packing standards/as per packing instructions in order.\r\n','After receiving the complete product from Quality department.\r\n','',''),(285768,'','WO','0000-00-00','0000-00-00','2017-11-23',NULL,31531,31531,49,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',100,'Management','90','Mr. G.R Sharma','Inform whether the payment has received as per the approved payment terms decided at the order finalization. After getting OK from Accounts, production dept. must ensure full kitting of dispatch of that partiicular Job Card along with the synchronization ','After receiving the request of clearance from Production Executive within 2 hours by mail only.','fluentsoft.com',''),(285769,'','WO','2017-11-28',NULL,NULL,NULL,31532,31532,66,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',10,'Management','','Badari','test','test','testt@gmial.com','Badari'),(285770,'','WO','2017-11-28',NULL,NULL,NULL,31532,31532,67,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',20,'Stores','','qas','tetet','etet','testt@gmial.com','prodn'),(285771,'','WO','2017-11-28',NULL,NULL,NULL,31532,31532,68,NULL,NULL,0,NULL,NULL,NULL,'NA','20','dfdf',30,'Engineering','20','prodn','teere','etet','testt@gmial.com','HR'),(285772,'','WO','2017-11-30',NULL,NULL,NULL,31532,31532,69,NULL,NULL,0,NULL,NULL,NULL,'NA','','teset',40,'PPC','','accounts','test','esst','testt@gmial.com','accounts'),(285773,'','WO','2017-11-30',NULL,NULL,NULL,31532,31532,70,NULL,NULL,0,NULL,NULL,NULL,'NA','','test',50,'Production','','sa','etet','teset','testt@gmial.com','purch'),(285774,'','WO','2017-11-29','0000-00-00','2017-11-23',NULL,31533,31533,66,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Management','','Badari','test','test','testt@gmial.com','Badari'),(285775,'','WO','2017-11-29','0000-00-00',NULL,NULL,31533,31533,67,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','test',20,'Stores','','qas','tetet','etet','testt@gmial.com','prodn'),(285776,'','WO','2017-11-29','0000-00-00',NULL,NULL,31533,31533,68,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','20','dfdf',30,'Engineering','20','prodn','teere','etet','testt@gmial.com','HR'),(285777,'','WO','2017-11-29','0000-00-00',NULL,NULL,31533,31533,69,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','teset',40,'PPC','','accounts','test','esst','testt@gmial.com','accounts'),(285778,'','WO','2017-11-30','0000-00-00',NULL,NULL,31533,31533,70,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','','test',50,'Production','','sa','etet','teset','testt@gmial.com','purch'),(285779,'','WO','2017-11-30','0000-00-00',NULL,NULL,31533,31533,71,NULL,NULL,0,NULL,'0000-00-00','0000-00-00','','50','test',60,'QA','50','accounts','test','test','testt@gmial.com','accounts'),(285780,'','WO','2017-11-28','0000-00-00','2017-11-23',NULL,31534,31534,66,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Management','','Badari','test','test','testt@gmial.com','Badari'),(285781,'','WO','2017-11-28','0000-00-00','2017-11-23',NULL,31534,31534,67,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Stores','10','qas','tetet','etet','testt@gmial.com',''),(285782,'','WO','2017-11-28','0000-00-00','2017-11-23',NULL,31534,31534,68,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','dfdf',30,'Engineering','20','prodn','teere','etet','testt@gmial.com','HR'),(285783,'','WO','2017-11-30','0000-00-00','2017-11-23',NULL,31534,31534,69,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','teset',40,'PPC','30','accounts','test','esst','testt@gmial.com',''),(285784,'','WO','2017-11-30','0000-00-00','2017-11-23',NULL,31534,31534,70,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Production','40','sa','etet','teset','testt@gmial.com',''),(285785,'','WO','2017-11-30','0000-00-00','2017-11-23',NULL,31534,31534,71,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'QA','50','accounts','test','test','testt@gmial.com','accounts'),(285786,'','WO','2017-11-30','0000-00-00','2017-11-23',NULL,31534,31534,72,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'Assembly','60','sa','test','test','testt@gmial.com','sa'),(285787,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,40,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n','After receiving it from Client within a day and send for approval to Technical dept.\r\n','fluentsoft.com',''),(285788,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,41,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Stores','10','Kamal Kant',' immediately after receiving the complete project file\r\n','As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',''),(285789,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,42,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',30,'Engineering','20','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.\r\n','fluentsoft.com',''),(285790,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,43,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',40,'PPC','30','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI) from Accounts department. If he found any discrepancy from the order then he must take the corrected order','After receiving the MMS form and photos of site within 4 hours.\r\n','fluentsoft.com',''),(285791,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,44,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Production','40','Mr. Vivek Saxena','After receiving MMS in ERP technical executive will make Bill of Material and all production document from K-Soft (viz. stickers, cutting list, assembling list, special instruction if any etc.)\r\n* Any kind of mistake will not be acceptable & may lead to','After receiving the copy of MMS within 4 hours.\r\n','fluentsoft.com',''),(285792,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,45,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'QA','50','Mr. Nitin Sagar','After receiving the complete production document from technical department, production executive will verify that he has received all the documents as per norms* .\r\n* BOM, Cutting list,elevation and shop drawing, MMS etc.','After preparation of production document within 4 hours.\r\n','fluentsoft.com',''),(285793,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,46,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'Assembly','60','Mr. Jahir/Mr. Robin','through format no&#65533;&#65533;\r\n','after receiving Production document within 1 hour.\r\n','fluentsoft.com',''),(285794,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,47,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',80,'Packing','70','Mr. Shivendu','He must follow Format No&#65533;..,fill it completely* and hand over it to Data Entry Operator for feeding it in ERP. If found any Quality defect then he should inform it to the Line Supervisor, Production Executive, Production head and MDO.\r\n* Any kind o','Immediately after receiving the complete product from production department.\r\n','fluentsoft.com',''),(285795,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,48,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',90,'Purchasing','80','Mr. Narottam/Mr. Sanjeev','All product after QC clearance must be packed according to minimum packing standards/as per packing instructions in order.\r\n','After receiving the complete product from Quality department.\r\n','',''),(285796,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,49,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',100,'Management','90','Mr. G.R Sharma','Inform whether the payment has received as per the approved payment terms decided at the order finalization. After getting OK from Accounts, production dept. must ensure full kitting of dispatch of that partiicular Job Card along with the synchronization ','After receiving the request of clearance from Production Executive within 2 hours by mail only.','fluentsoft.com',''),(285797,'','WO','2017-11-29','0000-00-00','2017-11-24',NULL,31535,31535,65,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',110,'Scanout','100','accounts','trgrfg','fgfg','','Badari'),(285798,'','WO','2017-11-30',NULL,'2017-12-19',NULL,31536,31536,73,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285799,'','WO','2017-11-30',NULL,'2017-12-19',NULL,31536,31536,74,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',20,'Production','10','accounts','test','test','testt@gmial.com','sa'),(285800,'','WO','2017-11-30',NULL,'2017-12-19',NULL,31536,31536,75,NULL,NULL,2,NULL,NULL,NULL,'NA','','test',30,'QA','20','Badari','test','test','testt@gmial.com','Badari'),(285801,'','WO','2017-11-28','0000-00-00','2017-11-24',NULL,31537,31537,66,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Management','','Badari','test','test','testt@gmial.com','Badari'),(285802,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31537,31537,67,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Stores','10','qas','tetet','etet','testt@gmial.com',''),(285803,'','WO','2017-12-31','0000-00-00','2017-11-24',NULL,31537,31537,68,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','dfdf',30,'Engineering','20','prodn','teere','etet','testt@gmial.com','HR'),(285804,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31537,31537,69,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','teset',40,'PPC','30','accounts','test','esst','testt@gmial.com',''),(285805,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31537,31537,70,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Production','40','sa','etet','teset','testt@gmial.com',''),(285806,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31537,31537,71,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'QA','50','accounts','test','test','testt@gmial.com','accounts'),(285807,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31537,31537,72,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'Assembly','60','sa','test','test','testt@gmial.com','sa'),(285808,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,40,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Management','','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n','After receiving it from Client within a day and send for approval to Technical dept.\r\n','fluentsoft.com',''),(285809,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,41,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Stores','10','Kamal Kant',' immediately after receiving the complete project file\r\n','As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','fluentsoft.com',''),(285810,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,42,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',30,'Engineering','20','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.\r\n','fluentsoft.com',''),(285811,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,43,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',40,'PPC','30','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI) from Accounts department. If he found any discrepancy from the order then he must take the corrected order','After receiving the MMS form and photos of site within 4 hours.\r\n','fluentsoft.com',''),(285812,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,44,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Production','40','Mr. Vivek Saxena','After receiving MMS in ERP technical executive will make Bill of Material and all production document from K-Soft (viz. stickers, cutting list, assembling list, special instruction if any etc.)\r\n* Any kind of mistake will not be acceptable & may lead to','After receiving the copy of MMS within 4 hours.\r\n','fluentsoft.com',''),(285813,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,45,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'QA','50','Mr. Nitin Sagar','After receiving the complete production document from technical department, production executive will verify that he has received all the documents as per norms* .\r\n* BOM, Cutting list,elevation and shop drawing, MMS etc.','After preparation of production document within 4 hours.\r\n','fluentsoft.com',''),(285814,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,46,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'Assembly','60','Mr. Jahir/Mr. Robin','through format no&#65533;&#65533;\r\n','after receiving Production document within 1 hour.\r\n','fluentsoft.com',''),(285815,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,47,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',80,'Packing','70','Mr. Shivendu','He must follow Format No&#65533;..,fill it completely* and hand over it to Data Entry Operator for feeding it in ERP. If found any Quality defect then he should inform it to the Line Supervisor, Production Executive, Production head and MDO.\r\n* Any kind o','Immediately after receiving the complete product from production department.\r\n','fluentsoft.com',''),(285816,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,48,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',90,'Purchasing','80','Mr. Narottam/Mr. Sanjeev','All product after QC clearance must be packed according to minimum packing standards/as per packing instructions in order.\r\n','After receiving the complete product from Quality department.\r\n','',''),(285817,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,49,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',100,'Management','90','Mr. G.R Sharma','Inform whether the payment has received as per the approved payment terms decided at the order finalization. After getting OK from Accounts, production dept. must ensure full kitting of dispatch of that partiicular Job Card along with the synchronization ','After receiving the request of clearance from Production Executive within 2 hours by mail only.','fluentsoft.com',''),(285818,'','WO','0000-00-00','0000-00-00','2017-11-24',NULL,31538,31538,65,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',110,'Scanout','100','accounts','trgrfg','fgfg','','Badari'),(285819,'','WO','2017-11-28','0000-00-00','2017-11-24',NULL,31539,31539,66,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Management','','Badari','test','test','testt@gmial.com','Badari'),(285820,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31539,31539,67,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'Stores','10','qas','tetet','etet','testt@gmial.com',''),(285821,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31539,31539,68,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','dfdf',30,'Engineering','20','prodn','teere','etet','testt@gmial.com','HR'),(285822,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31539,31539,69,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','teset',40,'PPC','30','accounts','test','esst','testt@gmial.com',''),(285823,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31539,31539,70,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',50,'Production','40','sa','etet','teset','testt@gmial.com',''),(285824,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31539,31539,71,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',60,'QA','50','accounts','test','test','testt@gmial.com','accounts'),(285825,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31539,31539,72,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',70,'Assembly','60','sa','test','test','testt@gmial.com','sa'),(285826,'','WO','2017-11-23','0000-00-00','2017-11-24',NULL,31540,31540,31,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create Wo',100,'Management','','test',' test',' test','',''),(285827,'','WO','2017-11-29',NULL,'2017-12-06',NULL,31541,31541,76,NULL,NULL,2,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285828,'','WO','2017-11-29',NULL,NULL,NULL,31541,31541,77,NULL,NULL,0,NULL,NULL,NULL,'NA','','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com',''),(285829,'','WO','2017-11-29',NULL,NULL,NULL,31541,31541,78,NULL,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','','','testt@gmial.com','Badari'),(285830,'','WO','2017-11-29',NULL,NULL,NULL,31541,31541,79,NULL,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285831,'','WO','2017-11-29',NULL,NULL,NULL,31541,31541,80,NULL,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285832,'','WO','2017-11-29',NULL,NULL,NULL,31541,31541,81,NULL,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285833,'','WO','2017-11-29',NULL,NULL,NULL,31541,31541,82,NULL,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285834,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31542,31542,76,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285835,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31542,31542,77,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com',''),(285836,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31542,31542,78,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Recd_Material',30,'Production','20','Badari','','','testt@gmial.com','Badari'),(285837,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31542,31542,79,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285838,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31542,31542,80,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285839,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31542,31542,81,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285840,'','WO','2017-11-30','0000-00-00','2017-11-24',NULL,31542,31542,82,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285841,'','WO','2017-12-26',NULL,NULL,NULL,2572,2572,83,2572,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285842,'','WO','2017-12-29',NULL,NULL,NULL,2572,2572,84,2572,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285843,'','WO','2017-12-29',NULL,NULL,NULL,2572,2572,85,2572,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285844,'','WO','2017-12-29',NULL,NULL,NULL,2572,2572,86,2572,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285845,'','WO','2017-12-29',NULL,NULL,NULL,2572,2572,87,2572,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285846,'','WO','2017-12-29',NULL,NULL,NULL,2572,2572,88,2572,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285847,'','WO','2017-12-28',NULL,NULL,NULL,2572,2572,89,2572,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285848,'','WO','2017-12-26',NULL,NULL,NULL,2573,2573,83,2573,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285849,'','WO','2017-12-29',NULL,NULL,NULL,2573,2573,84,2573,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285850,'','WO','2017-12-29',NULL,NULL,NULL,2573,2573,85,2573,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285851,'','WO','2017-12-29',NULL,NULL,NULL,2573,2573,86,2573,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285852,'','WO','2017-12-29',NULL,NULL,NULL,2573,2573,87,2573,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285853,'','WO','2017-12-29',NULL,NULL,NULL,2573,2573,88,2573,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285854,'','WO','2017-12-28',NULL,NULL,NULL,2573,2573,89,2573,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285855,'','WO','2017-12-28',NULL,NULL,NULL,2574,2574,83,2574,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285856,'','WO','2017-12-29',NULL,NULL,NULL,2574,2574,84,2574,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285857,'','WO','2017-12-30',NULL,NULL,NULL,2574,2574,85,2574,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285858,'','WO','2017-12-30',NULL,NULL,NULL,2574,2574,86,2574,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285859,'','WO','2017-12-30',NULL,NULL,NULL,2574,2574,87,2574,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285860,'','WO','2017-12-30',NULL,NULL,NULL,2574,2574,88,2574,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285861,'','WO','2017-12-30',NULL,NULL,NULL,2574,2574,89,2574,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285862,'','WO','0000-00-00',NULL,NULL,NULL,2575,2575,83,2575,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285863,'','WO','0000-00-00',NULL,NULL,NULL,2575,2575,84,2575,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285864,'','WO','0000-00-00',NULL,NULL,NULL,2575,2575,85,2575,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285865,'','WO','0000-00-00',NULL,NULL,NULL,2575,2575,86,2575,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285866,'','WO','0000-00-00',NULL,NULL,NULL,2575,2575,87,2575,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285867,'','WO','0000-00-00',NULL,NULL,NULL,2575,2575,88,2575,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285868,'','WO','0000-00-00',NULL,NULL,NULL,2575,2575,89,2575,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285869,'','WO','0000-00-00',NULL,NULL,NULL,2576,2576,83,2576,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285870,'','WO','0000-00-00',NULL,NULL,NULL,2576,2576,84,2576,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285871,'','WO','0000-00-00',NULL,NULL,NULL,2576,2576,85,2576,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285872,'','WO','0000-00-00',NULL,NULL,NULL,2576,2576,86,2576,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285873,'','WO','0000-00-00',NULL,NULL,NULL,2576,2576,87,2576,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285874,'','WO','0000-00-00',NULL,NULL,NULL,2576,2576,88,2576,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285875,'','WO','0000-00-00',NULL,NULL,NULL,2576,2576,89,2576,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285876,'','WO','0000-00-00',NULL,NULL,NULL,2577,2577,83,2577,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285877,'','WO','0000-00-00',NULL,NULL,NULL,2577,2577,84,2577,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285878,'','WO','0000-00-00',NULL,NULL,NULL,2577,2577,85,2577,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285879,'','WO','0000-00-00',NULL,NULL,NULL,2577,2577,86,2577,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285880,'','WO','0000-00-00',NULL,NULL,NULL,2577,2577,87,2577,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285881,'','WO','0000-00-00',NULL,NULL,NULL,2577,2577,88,2577,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285882,'','WO','0000-00-00',NULL,NULL,NULL,2577,2577,89,2577,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285883,'','WO','0000-00-00',NULL,NULL,NULL,2578,2578,83,2578,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285884,'','WO','0000-00-00',NULL,NULL,NULL,2578,2578,84,2578,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285885,'','WO','0000-00-00',NULL,NULL,NULL,2578,2578,85,2578,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285886,'','WO','0000-00-00',NULL,NULL,NULL,2578,2578,86,2578,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285887,'','WO','0000-00-00',NULL,NULL,NULL,2578,2578,87,2578,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285888,'','WO','0000-00-00',NULL,NULL,NULL,2578,2578,88,2578,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285889,'','WO','0000-00-00',NULL,NULL,NULL,2578,2578,89,2578,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285890,'','WO','0000-00-00',NULL,NULL,NULL,2579,2579,83,2579,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285891,'','WO','0000-00-00',NULL,NULL,NULL,2579,2579,84,2579,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285892,'','WO','0000-00-00',NULL,NULL,NULL,2579,2579,85,2579,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285893,'','WO','0000-00-00',NULL,NULL,NULL,2579,2579,86,2579,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285894,'','WO','0000-00-00',NULL,NULL,NULL,2579,2579,87,2579,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285895,'','WO','0000-00-00',NULL,NULL,NULL,2579,2579,88,2579,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285896,'','WO','0000-00-00',NULL,NULL,NULL,2579,2579,89,2579,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285897,'','WO','0000-00-00',NULL,NULL,NULL,2580,2580,83,2580,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285898,'','WO','0000-00-00',NULL,NULL,NULL,2580,2580,84,2580,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285899,'','WO','0000-00-00',NULL,NULL,NULL,2580,2580,85,2580,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285900,'','WO','0000-00-00',NULL,NULL,NULL,2580,2580,86,2580,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285901,'','WO','0000-00-00',NULL,NULL,NULL,2580,2580,87,2580,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285902,'','WO','0000-00-00',NULL,NULL,NULL,2580,2580,88,2580,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285903,'','WO','0000-00-00',NULL,NULL,NULL,2580,2580,89,2580,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285904,'','WO','0000-00-00',NULL,NULL,NULL,2582,2582,83,2582,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285905,'','WO','0000-00-00',NULL,NULL,NULL,2582,2582,84,2582,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285906,'','WO','0000-00-00',NULL,NULL,NULL,2582,2582,85,2582,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285907,'','WO','0000-00-00',NULL,NULL,NULL,2582,2582,86,2582,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285908,'','WO','0000-00-00',NULL,NULL,NULL,2582,2582,87,2582,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285909,'','WO','0000-00-00',NULL,NULL,NULL,2582,2582,88,2582,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285910,'','WO','0000-00-00',NULL,NULL,NULL,2582,2582,89,2582,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285911,'','WO','0000-00-00',NULL,NULL,NULL,2585,2585,83,2585,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285912,'','WO','0000-00-00',NULL,NULL,NULL,2585,2585,84,2585,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285913,'','WO','0000-00-00',NULL,NULL,NULL,2585,2585,85,2585,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285914,'','WO','0000-00-00',NULL,NULL,NULL,2585,2585,86,2585,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285915,'','WO','0000-00-00',NULL,NULL,NULL,2585,2585,87,2585,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285916,'','WO','0000-00-00',NULL,NULL,NULL,2585,2585,88,2585,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285917,'','WO','0000-00-00',NULL,NULL,NULL,2585,2585,89,2585,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285918,'','WO','2017-12-29',NULL,NULL,NULL,2586,2586,83,2586,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285919,'','WO','2017-12-01',NULL,NULL,NULL,2586,2586,84,2586,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285920,'','WO','2017-12-31',NULL,NULL,NULL,2586,2586,85,2586,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285921,'','WO','2017-12-31',NULL,NULL,NULL,2586,2586,86,2586,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285922,'','WO','2017-12-29',NULL,NULL,NULL,2586,2586,87,2586,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285923,'','WO','2017-12-29',NULL,NULL,NULL,2586,2586,88,2586,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285924,'','WO','2017-12-29',NULL,NULL,NULL,2586,2586,89,2586,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285925,'','WO','2017-12-29',NULL,NULL,NULL,2587,2587,83,2587,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285926,'','WO','2017-12-01',NULL,NULL,NULL,2587,2587,84,2587,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285927,'','WO','2017-12-31',NULL,NULL,NULL,2587,2587,85,2587,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285928,'','WO','2017-12-31',NULL,NULL,NULL,2587,2587,86,2587,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285929,'','WO','2017-12-29',NULL,NULL,NULL,2587,2587,87,2587,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285930,'','WO','2017-12-29',NULL,NULL,NULL,2587,2587,88,2587,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285931,'','WO','2017-12-29',NULL,NULL,NULL,2587,2587,89,2587,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285932,'','WO','2017-12-29',NULL,NULL,NULL,2588,2588,83,2588,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285933,'','WO','2017-12-01',NULL,NULL,NULL,2588,2588,84,2588,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285934,'','WO','2017-12-31',NULL,NULL,NULL,2588,2588,85,2588,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285935,'','WO','2017-12-31',NULL,NULL,NULL,2588,2588,86,2588,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285936,'','WO','2017-12-29',NULL,NULL,NULL,2588,2588,87,2588,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285937,'','WO','2017-12-29',NULL,NULL,NULL,2588,2588,88,2588,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285938,'','WO','2017-12-29',NULL,NULL,NULL,2588,2588,89,2588,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285939,'','WO','2017-12-30',NULL,NULL,NULL,2589,2589,83,2589,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285940,'','WO','2017-12-30',NULL,NULL,NULL,2589,2589,84,2589,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285941,'','WO','2017-12-30',NULL,NULL,NULL,2589,2589,85,2589,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285942,'','WO','2017-12-30',NULL,NULL,NULL,2589,2589,86,2589,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285943,'','WO','2017-12-30',NULL,NULL,NULL,2589,2589,87,2589,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285944,'','WO','2017-12-30',NULL,NULL,NULL,2589,2589,88,2589,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285945,'','WO','2017-12-30',NULL,NULL,NULL,2589,2589,89,2589,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285946,'','WO','0000-00-00',NULL,NULL,NULL,2590,2590,83,2590,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285947,'','WO','0000-00-00',NULL,NULL,NULL,2590,2590,84,2590,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285948,'','WO','0000-00-00',NULL,NULL,NULL,2590,2590,85,2590,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285949,'','WO','0000-00-00',NULL,NULL,NULL,2590,2590,86,2590,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285950,'','WO','0000-00-00',NULL,NULL,NULL,2590,2590,87,2590,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285951,'','WO','0000-00-00',NULL,NULL,NULL,2590,2590,88,2590,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285952,'','WO','0000-00-00',NULL,NULL,NULL,2590,2590,89,2590,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285953,'','WO','0000-00-00',NULL,NULL,NULL,2591,2591,83,2591,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285954,'','WO','0000-00-00',NULL,NULL,NULL,2591,2591,84,2591,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285955,'','WO','0000-00-00',NULL,NULL,NULL,2591,2591,85,2591,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285956,'','WO','0000-00-00',NULL,NULL,NULL,2591,2591,86,2591,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285957,'','WO','0000-00-00',NULL,NULL,NULL,2591,2591,87,2591,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285958,'','WO','0000-00-00',NULL,NULL,NULL,2591,2591,88,2591,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285959,'','WO','0000-00-00',NULL,NULL,NULL,2591,2591,89,2591,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285960,'','WO','0000-00-00',NULL,NULL,NULL,2592,2592,83,2592,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285961,'','WO','0000-00-00',NULL,NULL,NULL,2592,2592,84,2592,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285962,'','WO','0000-00-00',NULL,NULL,NULL,2592,2592,85,2592,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285963,'','WO','0000-00-00',NULL,NULL,NULL,2592,2592,86,2592,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285964,'','WO','0000-00-00',NULL,NULL,NULL,2592,2592,87,2592,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285965,'','WO','0000-00-00',NULL,NULL,NULL,2592,2592,88,2592,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285966,'','WO','0000-00-00',NULL,NULL,NULL,2592,2592,89,2592,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285967,'','WO','0000-00-00',NULL,NULL,NULL,2593,2593,83,2593,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285968,'','WO','0000-00-00',NULL,NULL,NULL,2593,2593,84,2593,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285969,'','WO','0000-00-00',NULL,NULL,NULL,2593,2593,85,2593,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285970,'','WO','0000-00-00',NULL,NULL,NULL,2593,2593,86,2593,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285971,'','WO','0000-00-00',NULL,NULL,NULL,2593,2593,87,2593,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285972,'','WO','0000-00-00',NULL,NULL,NULL,2593,2593,88,2593,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285973,'','WO','0000-00-00',NULL,NULL,NULL,2593,2593,89,2593,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285974,'','WO','0000-00-00',NULL,NULL,NULL,2594,2594,83,2594,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285975,'','WO','0000-00-00',NULL,NULL,NULL,2594,2594,84,2594,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285976,'','WO','0000-00-00',NULL,NULL,NULL,2594,2594,85,2594,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285977,'','WO','0000-00-00',NULL,NULL,NULL,2594,2594,86,2594,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285978,'','WO','0000-00-00',NULL,NULL,NULL,2594,2594,87,2594,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285979,'','WO','0000-00-00',NULL,NULL,NULL,2594,2594,88,2594,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285980,'','WO','0000-00-00',NULL,NULL,NULL,2594,2594,89,2594,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285981,'','WO','0000-00-00',NULL,NULL,NULL,2596,2596,83,2596,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285982,'','WO','0000-00-00',NULL,NULL,NULL,2596,2596,84,2596,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285983,'','WO','0000-00-00',NULL,NULL,NULL,2596,2596,85,2596,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285984,'','WO','0000-00-00',NULL,NULL,NULL,2596,2596,86,2596,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285985,'','WO','0000-00-00',NULL,NULL,NULL,2596,2596,87,2596,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285986,'','WO','0000-00-00',NULL,NULL,NULL,2596,2596,88,2596,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285987,'','WO','0000-00-00',NULL,NULL,NULL,2596,2596,89,2596,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285988,'','WO','0000-00-00',NULL,NULL,NULL,2598,2598,83,2598,NULL,0,NULL,NULL,NULL,'NA','','WO_Recd',10,'Stores','','Badari','test','test','testt@gmial.com','Badari'),(285989,'','WO','0000-00-00',NULL,NULL,NULL,2598,2598,84,2598,NULL,0,NULL,NULL,NULL,'NA','10','Docs_Recd',20,'Production','10','Badari','test','test','testt@gmial.com','Badari'),(285990,'','WO','0000-00-00',NULL,NULL,NULL,2598,2598,85,2598,NULL,0,NULL,NULL,NULL,'NA','20','Recd_Material',30,'Production','20','Badari','test','test','testt@gmial.com','Badari'),(285991,'','WO','0000-00-00',NULL,NULL,NULL,2598,2598,86,2598,NULL,0,NULL,NULL,NULL,'NA','30','Stage_Insp_Done',40,'Production','30','Badari','test','test','testt@gmial.com','Badari'),(285992,'','WO','0000-00-00',NULL,NULL,NULL,2598,2598,87,2598,NULL,0,NULL,NULL,NULL,'NA','40','Fitting Done',50,'Production','40','Badari','test','test','testt@gmial.com','Badari'),(285993,'','WO','0000-00-00',NULL,NULL,NULL,2598,2598,88,2598,NULL,0,NULL,NULL,NULL,'NA','50','Recd_FG_For_FI',60,'QA','50','Badari','test','test','testt@gmial.com','Badari'),(285994,'','WO','0000-00-00',NULL,NULL,NULL,2598,2598,89,2598,NULL,0,NULL,NULL,NULL,'NA','60','FI_Completed',70,'QA','60','Badari','test','test','testt@gmial.com','Badari'),(285995,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,90,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',10,'Marketing','','HR',' test',' test','','HR'),(285996,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,91,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','test',20,'DAFNY','10','accounts',' test',' test','','accounts'),(285997,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,92,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','WO_Recd',30,'Stores','20','stores',' test',' test','','stores'),(285998,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,93,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Docs_Recd',40,'Production','30','stores',' test',' test','','stores'),(285999,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,94,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Recd_Material',50,'Production','40','ppc1',' test',' test','','ppc1'),(286000,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,95,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Stage_Insp_Done',60,'Production','50','accounts',' test',' test','','accounts'),(286001,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,96,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Fitting Done',70,'Production','60','Badari',' test',' test','','Badari'),(286002,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,97,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Recd_FG_For_FI',80,'QA','70','accounts',' test',' test','','stores'),(286003,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,98,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','FI_Completed',90,'QA','80','Badari',' test',' test','','Badari'),(286004,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,31,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Create Wo',100,'Management','','test',' test',' test','',''),(286005,'','WO','0000-00-00','0000-00-00','2017-12-05',NULL,31543,31543,99,NULL,NULL,2,NULL,'0000-00-00','0000-00-00','','','Dispatch',110,'Stores','90','Badari',' test',' test','','Badari'),(286006,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,100,2,NULL,0,NULL,NULL,NULL,'NA','','Enquiry',10,'Marketing','','Badari',' test',' tste','','Badari'),(286007,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,101,NULL,NULL,0,NULL,NULL,NULL,'NA','10','Pre Contract Review',20,'Marketing','10','accounts',' tese',' etret','','accounts'),(286008,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,102,2,NULL,0,NULL,NULL,NULL,'NA','20','Quotation',30,'Marketing','20','Badari',' test',' test','','Badari'),(286009,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,103,2,NULL,0,NULL,NULL,NULL,'NA','30','Annexure',40,'Marketing','30','Badari',' test',' test','','Badari'),(286010,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,104,NULL,NULL,0,NULL,NULL,NULL,'NA','40','Order(Cust Po)',50,'DAFNY','40','ppc1',' test',' test','','ppc1'),(286011,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,105,NULL,NULL,0,NULL,NULL,NULL,'NA','50','Order Acceptance',60,'DAFNY','50','qas',' test',' test','','stores'),(286012,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,106,NULL,NULL,0,NULL,NULL,NULL,'NA','60','Int wo Realise',70,'Marketing','60','Badari',' testr',' test','','Badari'),(286013,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,107,2,NULL,0,NULL,NULL,NULL,'NA','70','BOM',80,'Engineering','70','Badari',' test',' test','','stores'),(286014,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,108,2,NULL,0,NULL,NULL,NULL,'NA','80','Purchasing',90,'DAFNY','80','Badari',' test',' test','','Badari'),(286015,'','WO','2017-12-31',NULL,NULL,NULL,31544,31544,109,2,NULL,0,NULL,NULL,NULL,'NA','90','Approval',100,'Marketing','90','Badari',' test',' test','','Badari');
/*!40000 ALTER TABLE `dates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dc_li`
--

DROP TABLE IF EXISTS `dc_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dc_li` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cofcnum` varchar(45) DEFAULT NULL,
  `pinnum` varchar(45) DEFAULT NULL,
  `partnum` varchar(65) DEFAULT NULL,
  `remarks` text,
  `link2dc` varchar(45) DEFAULT NULL,
  `line_num` int(10) unsigned DEFAULT NULL,
  `delvrd_qty` varchar(45) DEFAULT NULL,
  `recd_qty` varchar(45) DEFAULT NULL,
  `atpl_wonum` varchar(45) DEFAULT NULL,
  `cust_ref_no` varchar(45) DEFAULT NULL,
  `ponum` varchar(45) DEFAULT NULL,
  `link2cofc` int(11) DEFAULT NULL,
  `partname` varchar(45) DEFAULT NULL,
  `others` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dc_li`
--

LOCK TABLES `dc_li` WRITE;
/*!40000 ALTER TABLE `dc_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `dc_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd`
--

DROP TABLE IF EXISTS `dd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd` (
  `recnum` int(11) DEFAULT NULL,
  `pur_ord_num` varchar(30) DEFAULT NULL,
  `comp_ser_num` varchar(30) DEFAULT NULL,
  `batch_num` varchar(30) DEFAULT NULL,
  `qty` varchar(30) DEFAULT NULL,
  `gate_pass_num` varchar(30) DEFAULT NULL,
  `gate_pass_date` date DEFAULT NULL,
  `dc_num` varchar(30) DEFAULT NULL,
  `dc_date` date DEFAULT NULL,
  `inspn_report` varchar(30) DEFAULT NULL,
  `insp_approval` varchar(30) DEFAULT NULL,
  `qchead_approval` varchar(30) DEFAULT NULL,
  `line_num` int(11) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dd`
--

LOCK TABLES `dd` WRITE;
/*!40000 ALTER TABLE `dd` DISABLE KEYS */;
/*!40000 ALTER TABLE `dd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_note`
--

DROP TABLE IF EXISTS `delivery_note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_note` (
  `recnum` int(11) DEFAULT NULL,
  `dnnum` char(10) DEFAULT NULL,
  `sent_treat_to` varchar(100) DEFAULT NULL,
  `treat_deliver_to` varchar(100) DEFAULT NULL,
  `crn` varchar(45) DEFAULT NULL,
  `deliver_date` date DEFAULT NULL,
  `ponum` varchar(65) DEFAULT NULL,
  `podate` date DEFAULT NULL,
  `poline_num` varchar(85) DEFAULT NULL,
  `wonum` varchar(100) DEFAULT NULL,
  `untreated_partnum` varchar(100) DEFAULT NULL,
  `treated_partnum` varchar(100) DEFAULT NULL,
  `part_iss` varchar(65) DEFAULT NULL,
  `drg_iss` varchar(65) DEFAULT NULL,
  `cos` varchar(255) DEFAULT NULL,
  `mtl_spec` varchar(255) DEFAULT NULL,
  `grn_num` varchar(85) DEFAULT NULL,
  `batch_num` varchar(75) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `formatnum` varchar(255) DEFAULT NULL,
  `formatrev` varchar(255) DEFAULT NULL,
  `remarks` text,
  `status` varchar(80) DEFAULT NULL,
  `poqty` float DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `comp_qty` int(11) DEFAULT '0',
  `siteid` varchar(45) DEFAULT NULL,
  KEY `dn_crn` (`crn`),
  KEY `dn_wonum` (`wonum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_note`
--

LOCK TABLES `delivery_note` WRITE;
/*!40000 ALTER TABLE `delivery_note` DISABLE KEYS */;
INSERT INTO `delivery_note` VALUES (11875,'DN11875','Aero','Aero','prn8','2017-11-24','','0000-00-00','','31471','','2343','dd','dd','dd','','g8','',5,'F8201','Rev 1 Dt Jun 29, 2012 - Upg cert from AS9100 B to AS9100 C','','Open',0,'FIA',5,'FSI'),(11876,'DN11876','Aero','Aero','prn8','2017-11-29','','0000-00-00','','31473','','2343','dd','dd','dd','','g8','',2,'F8201','Rev 1 Dt Jun 29, 2012 - Upg cert from AS9100 B to AS9100 C','','Open',0,'Regular',2,'FSI'),(11877,'DN11877','Aero','Aero','prn6','2017-11-30','','0000-00-00','','31474','','54543','g','g','g','','g6','',2,'F8201','Rev 1 Dt Jun 29, 2012 - Upg cert from AS9100 B to AS9100 C','','Open',0,'FIA',2,'FSI'),(11878,'DN11878','Aero','Aero','prn4','2017-11-24','','0000-00-00','','31476','','435','s','s','s','','G0004','',1,'F8201','Rev 1 Dt Jun 29, 2012 - Upg cert from AS9100 B to AS9100 C','','Open',0,'FIA',1,'FSI');
/*!40000 ALTER TABLE `delivery_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_note_li`
--

DROP TABLE IF EXISTS `delivery_note_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_note_li` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `cofc_num` varchar(85) DEFAULT NULL,
  `cofc_date` date DEFAULT NULL,
  `qty_recd` int(11) DEFAULT NULL,
  `qty_acc` int(11) DEFAULT NULL,
  `qty_rej` int(11) DEFAULT NULL,
  `insp_stamp` varchar(85) DEFAULT NULL,
  `link2delivery` int(11) unsigned DEFAULT NULL,
  `supplier_wo` varchar(100) DEFAULT NULL,
  `datecode` date DEFAULT NULL,
  `ncnum` char(50) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `qtyrej4store` int(11) DEFAULT NULL,
  `qty_rew` int(10) unsigned DEFAULT NULL,
  `qty_rewqa` int(10) unsigned DEFAULT NULL,
  `disp_qty` int(10) DEFAULT '0',
  `assy_qty` int(11) DEFAULT '0',
  `assy_wonum` varchar(45) DEFAULT NULL,
  `ret_qty` int(11) DEFAULT '0',
  `rework_qty` int(11) DEFAULT '0',
  `rej_qty` int(11) DEFAULT '0',
  `kit_qty` int(11) DEFAULT '0',
  `dn_stage` varchar(80) DEFAULT NULL,
  KEY `dnli_link2delivery` (`link2delivery`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_note_li`
--

LOCK TABLES `delivery_note_li` WRITE;
/*!40000 ALTER TABLE `delivery_note_li` DISABLE KEYS */;
INSERT INTO `delivery_note_li` VALUES (13086,'1','test33','2017-11-24',5,5,0,'',11875,'test232','2017-11-24','',300,0,0,0,5,0,'',0,0,0,0,'fi'),(13087,'1','test232','2017-11-23',2,2,0,'',11876,'test455','2017-11-23','',300,0,0,0,0,1,'A02619',0,0,0,0,'fi'),(13088,'1','test454','2017-11-27',2,2,0,'',11877,'test455','2017-11-27','',200,0,0,0,0,0,'',0,0,0,0,'fi'),(13089,'1','test','2017-11-24',1,1,0,'',11878,'test455','2017-11-24','',100,0,0,0,0,0,'',0,0,0,0,'fi');
/*!40000 ALTER TABLE `delivery_note_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_sch`
--

DROP TABLE IF EXISTS `delivery_sch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_sch` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `crnnum` varchar(200) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_qty` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `time_required` float NOT NULL,
  `status` varchar(100) NOT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `disp_qty` int(11) DEFAULT NULL,
  `wo_issue_qty` int(11) DEFAULT '0',
  `custcode` char(50) DEFAULT NULL,
  `parent_crnnum` varchar(255) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `rej_qty` int(11) DEFAULT NULL,
  `fg_qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_sch`
--

LOCK TABLES `delivery_sch` WRITE;
/*!40000 ALTER TABLE `delivery_sch` DISABLE KEYS */;
INSERT INTO `delivery_sch` VALUES (1,'prn6','2016-11-08',10,'',0,'Open','54543',1,4,'sss',NULL,'FSI',NULL,NULL),(3,'prn3','2016-11-02',10,'',0,'Open','3434',2,11,'ddd',NULL,'FSI',NULL,NULL),(4,'prn1','2016-11-01',1,'',0,'Open','121',1,1,'FFF',NULL,'FSI',NULL,NULL),(5,'prn5','2016-10-05',100,'',0,'Open','324',0,0,'fff',NULL,'FSI',NULL,NULL),(6,'prn7','2016-10-05',100,'',0,'Open','34344',0,0,'fff',NULL,'FSI',NULL,NULL),(7,'prn8','2016-10-18',50,'',0,'Open','2343',25,27,'sss',NULL,'FSI',NULL,NULL),(9,'prn2','2016-11-30',12,'',0,'Open','3434',1,12,'',NULL,'FSI',NULL,NULL),(62,'prn9','2016-11-11',60,'',0,'Open','2222',2,0,'Raj','','FSI',NULL,NULL),(76,'prn1','2017-06-15',50,'',0,'Open','121',7,25,'','','FSI',NULL,NULL),(77,'prn2','2016-11-01',10,'',0,'Open','3434',1,14,'','','FSI',NULL,NULL),(78,'prn3','2017-05-03',10,'',0,'Open','3434',0,6,'','','FSI',NULL,NULL),(79,'prn1','2017-08-03',20,'hgjfdhj',0,'Open','121',0,0,'','','FSI',NULL,NULL),(80,'prn2','2017-08-08',30,'hfjdfjfj',0,'Open','3434',1,1,'','','FSI',NULL,NULL),(81,'prn3','2017-08-17',50,'gfgjgfj',0,'Open','3434',0,0,'','','FSI',NULL,NULL),(82,'prn4','2017-08-23',30,'jlghlhjl',0,'Open','435',1,4,'','','FSI',NULL,NULL),(83,'prn5','2017-08-25',29,'ghjfgjh',0,'Open','324',0,0,'','','FSI',NULL,NULL),(84,'prn6','2017-08-30',36,'ffhsdgh',0,'Open','54543',0,0,'','','FSI',NULL,NULL),(85,'PRN-001','2017-08-08',10,'',0,'Open','prn-001',0,7,'','','FSI',NULL,NULL),(86,'prn1','2018-01-31',10,'test',0,'Open','121',0,0,'A2','','FSI',NULL,NULL),(87,'prn2','2017-12-06',10,'',0,'Open','3434',0,0,'','','FSI',NULL,NULL),(88,'flu-001','2017-12-05',100,'dsgsdgdg',0,'Open','flu 00 100',0,1,'karthick','','FSI',NULL,NULL);
/*!40000 ALTER TABLE `delivery_sch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `DeviceId` varchar(50) DEFAULT NULL,
  `DeviceToken` varchar(255) DEFAULT NULL,
  `Link2User` int(11) DEFAULT NULL,
  `Mobile` varchar(15) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1,'YT910M9VUP','cy1iJM8iQow:APA91bEInzjsEZxVz7wTEwOb7QjHpX2uzFfYFXDiR7AzN6JLsKQ5U5fUbw3BksG7cesvuTlYknVHwcIAP7IBQWsQ-9C1qI88fyTWbTHDuunvl3cqQHqKroQXxcaFBVwyDt8_s4kBrZga',2,'9845152785',''),(2,'3568b16c9904','e4gWbMneCF8:APA91bHQ52a5Ewn2b14fdYICehUAKUytLvFLqxAjqb8g2ZNKnt93Y-YtJq3StK5EiC8Y6NJ_bWR-eUakaqPJ8DLrD1lHuHtkj8TAKSsDFdpQjNMdH0IzI16T54L3y2UEopWCYH-8tYrj',2,'9845152785',''),(3,'a747e194f23666fe','efpKfQ7zLio:APA91bH2faV2cYEcQ5iuvVDrdBtiALd1RNIoqeyKv-CgMHCNHd8Ob0_us97RNZmNGiEexrrO0r_JeOZAqZ0e8W8OToSadj2gMXn6mvEpGW3dNPZVZBOX_MSH2wkv8VSiSfQkpcFnYKrF',2,'9845152785','');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispatch`
--

DROP TABLE IF EXISTS `dispatch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispatch` (
  `recnum` int(11) DEFAULT NULL,
  `relnotenum` varchar(100) DEFAULT NULL,
  `disp_date` date DEFAULT NULL,
  `disp_desc` varchar(255) DEFAULT NULL,
  `disp2customer` varchar(255) DEFAULT NULL,
  `via` varchar(255) DEFAULT NULL,
  `refno` varchar(255) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `crn` varchar(50) DEFAULT NULL,
  `remarks` text,
  `status` varchar(20) DEFAULT NULL,
  `deliver_to` varchar(20) DEFAULT NULL,
  `invoice_to` varchar(20) DEFAULT NULL,
  `schdate` date DEFAULT NULL,
  `schqty` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `formatnum` varchar(255) DEFAULT NULL,
  `formatrev` varchar(255) DEFAULT NULL,
  `expinvnum` varchar(45) DEFAULT NULL,
  `pendqty` int(11) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `cofcnum` varchar(45) DEFAULT NULL,
  `crnnum` varchar(45) DEFAULT NULL,
  `cofcdate` date DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `ponum` varchar(100) DEFAULT NULL,
  `grnnum` varchar(100) DEFAULT NULL,
  `wonum` varchar(100) DEFAULT NULL,
  `dispatchqty` int(10) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  KEY `ind_recnum` (`recnum`),
  KEY `dispatch_crn` (`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispatch`
--

LOCK TABLES `dispatch` WRITE;
/*!40000 ALTER TABLE `dispatch` DISABLE KEYS */;
INSERT INTO `dispatch` VALUES (27351,'C27351','2017-11-24','','127','','','2017-11-24','2017-11-24','prn1','','Open','Primary','Primary','2017-06-15',48,'Untreated','F4200','Rev 3 dt Aug 16, 2013: Email and CRN # modifications','',NULL,'bmandyam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'FSI'),(27352,'C27352','2017-11-24','','127','','','2017-11-24','2017-11-24','prn8','','Open','Primary','Primary','2016-10-18',30,'Treated','F4200','Rev 3 dt Aug 16, 2013: Email and CRN # modifications','',NULL,'bmandyam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'FSI'),(27353,'C27353','2017-11-23','','127','','','2017-11-24','2017-11-24','prn9','','Open','Primary','Primary','2016-11-11',59,'Assembly','F4200','Rev 3 dt Aug 16, 2013: Email and CRN # modifications','',NULL,'bmandyam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'FSI'),(27354,'C27354','2017-12-05','gdg','172','','','2017-12-05','2017-12-05','flu-assy-001','','Open','Primary','Primary','0000-00-00',0,'Assembly','F4200','Rev 3 dt Aug 16, 2013: Email and CRN # modifications','',NULL,'bmandyam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'FSI');
/*!40000 ALTER TABLE `dispatch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispatch_line_items`
--

DROP TABLE IF EXISTS `dispatch_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dispatch_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `wonum` varchar(255) DEFAULT NULL,
  `partnum` varchar(255) DEFAULT NULL,
  `grnnum` varchar(100) DEFAULT NULL,
  `custpo_num` varchar(100) DEFAULT NULL,
  `custpo_qty` int(11) DEFAULT '0',
  `custpo_date` date DEFAULT NULL,
  `dispatch_qty` int(11) NOT NULL DEFAULT '0',
  `wo_qty` int(11) DEFAULT NULL,
  `comp_qty` int(11) DEFAULT NULL,
  `link2dispatch` int(11) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `drgiss` varchar(50) DEFAULT NULL,
  `partiss` varchar(255) DEFAULT NULL,
  `itemnum` varchar(10) DEFAULT NULL,
  `datecode` varchar(20) DEFAULT NULL,
  `rmspec` varchar(100) DEFAULT NULL,
  `cos` varchar(255) DEFAULT NULL,
  `supplier_wonum` varchar(100) DEFAULT NULL,
  `batchNo` varchar(50) DEFAULT NULL,
  `psn` varchar(100) DEFAULT NULL,
  `disp_custpo_no` varchar(100) DEFAULT NULL,
  `disp_custpo_item` char(5) DEFAULT NULL,
  `dnnum` varchar(100) DEFAULT NULL,
  KEY `ind_link2dispatch` (`link2dispatch`),
  KEY `ind_wonum` (`wonum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispatch_line_items`
--

LOCK TABLES `dispatch_line_items` WRITE;
/*!40000 ALTER TABLE `dispatch_line_items` DISABLE KEYS */;
INSERT INTO `dispatch_line_items` VALUES (39763,'1','31469','121','RMK-GRN-001','CUSTPO-001',NULL,'2017-11-24',5,5,5,27351,'sss','A','A','1','NA','bvnxfgchd','A','','dfg4636','','','',''),(39764,'1','31471','2343','g8','CUSTPO-003',NULL,'2017-11-24',5,5,5,27352,'24354','dd','dd','1','NA','','dd','test232','','','','','DN11875'),(39765,'1','A02563','132','-','AS-001',NULL,'0000-00-00',1,1,1,27353,'','C','C','','NA','NA','','','NA','','','',''),(39766,'1','A02599','flu-boi-001','-','KARASSY-001',NULL,'2017-12-06',1,1,1,27354,'new bom','A','A','','NA','NA','','','NA','','','','');
/*!40000 ALTER TABLE `dispatch_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elm`
--

DROP TABLE IF EXISTS `elm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elm` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `link2emp` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `comp_date` date DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  `stage` varchar(100) DEFAULT NULL,
  `siteid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elm`
--

LOCK TABLES `elm` WRITE;
/*!40000 ALTER TABLE `elm` DISABLE KEYS */;
INSERT INTO `elm` VALUES (1,2,'2017-01-01','2017-02-28',50,'PreBoarding','FSI'),(2,3,'2017-01-01','2017-02-28',50,'Onboarding','FSI'),(3,225,'2017-01-01','2017-02-28',98,'PreBoarding','FSI'),(4,225,'2017-01-01','2017-02-28',50,'Onboarding','FSI');
/*!40000 ALTER TABLE `elm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email` (
  `recnum` int(11) DEFAULT NULL,
  `to_addrs` varchar(100) DEFAULT NULL,
  `cc_addrs` varchar(100) DEFAULT NULL,
  `bcc_addrs` varchar(100) DEFAULT NULL,
  `from_addr` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `body` longtext,
  `userid` varchar(100) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `recnum` int(11) DEFAULT NULL,
  `empid` varchar(20) DEFAULT NULL,
  `salutation` varchar(10) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` varchar(30) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `employee2company` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `dept` varchar(30) DEFAULT NULL,
  `empcode` varchar(255) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `employee2site` int(11) DEFAULT NULL,
  `stage` varchar(100) NOT NULL,
  `shift_group` varchar(50) DEFAULT NULL,
  `subscription_type` varchar(50) DEFAULT NULL,
  `emp_type` varchar(50) DEFAULT NULL,
  `subsidarycompany` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,NULL,NULL,'sa','sa','SA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'Active',NULL,NULL,NULL,NULL,'FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(2,'E2','Mr.','Badari','Mandyam','SU','','','bmandyam@fluentsoft.com','','','','','','',1,'Active','2007-04-15',NULL,'Sales',NULL,'FSI',1,'PreBoarding',NULL,'both',NULL,NULL,NULL),(225,'E225','Mr.','accounts','acc','RU','','3455667','accounts@fluent.com','','','','','','',1,'Active','2016-11-02',NULL,'Accounts',NULL,'FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(232,'E232','','stores','stores','RU','','','stores@fluentsoft.com','','','','','','',1,'Active','2017-05-03',NULL,'Stores','','FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(233,'E233','','ppc1','ppc1','OP','','','Shantala@fluentsoft.com','','','','','','',1,'Active','2017-05-03',NULL,'PPC1','00001','FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(234,'E234','','qas','qas','RU','','','qas@gmail.com','','','','','','',1,'Active','2017-05-03',NULL,'QA','','FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(235,'E235','','purch','purch','SU','','','purch@gmail.com','','','','','','',1,'Active','2017-05-03',NULL,'Purchasing','','FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(236,'E236','','prodn','prodn','RU','','','prodn@gmail.com','','','','','','',1,'Active','2017-05-03',NULL,'Production','','FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(237,'E237','','WO','WO','RU','','','wo@fliuentsoft.com','','','','','','',1,'Active','2017-05-03',NULL,'WO','','FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(238,'E238','','prn','prn','RU','','','prn@fluentsoft.com','','','','','','',1,'Active','2017-05-03',NULL,'PRN','','FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(239,'E239','Mr.','HR','HR','RU','','','hr@fluentsoft.com','','','','','','',1,'Active','2017-05-03',NULL,'HR','','FSI',1,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(240,'E240','','sa_FSI','sa','SA','','','','','','','','','',1,'Active','2017-05-05',NULL,'','','',2,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(241,'E241',NULL,'asd','asd','SU',NULL,'46346','add@df.in',NULL,NULL,NULL,NULL,NULL,NULL,1,'Active','2017-07-05',NULL,'Sales',NULL,'FSI',NULL,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(241,'E241',NULL,'asd','asd','SU',NULL,'46346','add@df.in',NULL,NULL,NULL,NULL,NULL,NULL,1,'Active','2017-07-05',NULL,'Sales',NULL,'FSI',NULL,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(242,'E242','Mr.','Karthick','RM','SU','Developer','','karthick@fluentsoft.com','salem','mettur dam','salem','tamil nadu','636401','india',1,'Active','2017-08-03',NULL,'Sales','101','FSI',NULL,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(244,'E244',NULL,'aab','aab','mobile',NULL,'aa','aa',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(245,'E245',NULL,'mmt','mmt','mobile',NULL,'777777','mmt',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PreBoarding',NULL,NULL,NULL,NULL,NULL),(246,'E246','Mr.','Manu','Mohan','SU','','','manu@gmail.com','','','','','','',1,'Active','2017-09-07',NULL,'Sales','','FSI',NULL,'PreBoarding','general','both',NULL,NULL,NULL),(247,'E247','Mr.','mrdeepak','','SU','','','dfsdas@gmail.com','','','','','','',1,'Active','2017-11-13',NULL,'Trial','e1234','FSI',NULL,'PreBoarding',NULL,NULL,'Contract',1,'0000-00-00'),(248,'E248','Mr.','mrmanu','','SU','','','asdf@gmail.com','','','','','','',1,'Active','2017-11-13',NULL,'Trial','','FSI',NULL,'PreBoarding',NULL,NULL,'Contract',1,'0000-00-00'),(249,'E249','Mr.','mrsomone','','SU','','','frt@frt.com','','','','','','',1,'Active','2017-11-13',NULL,'Trial','','FSI',NULL,'PreBoarding',NULL,NULL,'Contract',1,'0000-00-00'),(250,'E250','Mr.','testempl','','SU','','','fasfasd@asfasdf.com','','','','','','',1,'Active','2017-11-21',NULL,'Trial','E34690','FSI',NULL,'PreBoarding',NULL,NULL,'Contract',1,'2017-11-29'),(251,'E251','Mr.','testempl2','','SU','','','fasdfsafsad@sfsdfs.com','','','','','','',1,'Active','2017-11-21',NULL,'Trial','E495u4859','FSI',NULL,'PreBoarding',NULL,NULL,'Contract',1,'2017-11-30');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_config`
--

DROP TABLE IF EXISTS `employee_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_config` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `shift` varchar(20) DEFAULT NULL,
  `start_hour` int(11) DEFAULT NULL,
  `start_min` int(11) DEFAULT NULL,
  `end_hour` int(11) DEFAULT NULL,
  `end_min` int(11) DEFAULT NULL,
  `link2company` int(11) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `siteid` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_config`
--

LOCK TABLES `employee_config` WRITE;
/*!40000 ALTER TABLE `employee_config` DISABLE KEYS */;
INSERT INTO `employee_config` VALUES (1,'general',9,15,17,30,1,'Active','2017-09-07',NULL,'sa',NULL,NULL);
/*!40000 ALTER TABLE `employee_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enquiry`
--

DROP TABLE IF EXISTS `enquiry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquiry` (
  `recnum` int(11) DEFAULT NULL,
  `link2cust` int(11) DEFAULT NULL,
  `partdesc` varchar(100) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `enq_date` date DEFAULT NULL,
  `rtquot_date` date DEFAULT NULL,
  `rtquot_no` varchar(100) DEFAULT NULL,
  `risk_involv` varchar(255) DEFAULT NULL,
  `risk_details` text,
  `status` varchar(100) DEFAULT NULL,
  `remarks` text,
  `siteid` varchar(45) DEFAULT NULL,
  `formrev` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `approved_by` varchar(100) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `id` varchar(100) DEFAULT NULL,
  `approved` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquiry`
--

LOCK TABLES `enquiry` WRITE;
/*!40000 ALTER TABLE `enquiry` DISABLE KEYS */;
INSERT INTO `enquiry` VALUES (1,127,'test','2343',10,'0000-00-00','2017-12-20','243eec','test','tegf evv vcbgb\"\"','Active','',NULL,'MKT/F/01 Iss No:01.Rev:00 dt:','bmandyam','2017-12-20','bmandyam','2017-12-20','232','yes'),(4,134,'test','132',3,'2017-12-21','2017-12-21','test333','test','test te fvcv','Active','test','FSI','MKT/F/01 Iss No:01.Rev:00 dt:','bmandyam','2017-12-21','bmandyam','2017-12-21','133','yes'),(NULL,0,'test','1234',10,'2017-12-28','2017-12-29','123','sgsg','sfgasfg','Active','sfgasg','FSI','MKT/F/01 Iss No:01.Rev:00 dt:','bmandyam','2017-12-28','','0000-00-00','','');
/*!40000 ALTER TABLE `enquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eqpo`
--

DROP TABLE IF EXISTS `eqpo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eqpo` (
  `recnum` int(11) DEFAULT NULL,
  `ponum` varchar(100) DEFAULT NULL,
  `podate` varchar(255) DEFAULT NULL,
  `podescr` varchar(100) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `ship_via` varchar(255) DEFAULT NULL,
  `acct_num` varchar(255) DEFAULT NULL,
  `fob` varchar(255) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `poamount` decimal(15,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `wonum` varchar(50) DEFAULT NULL,
  `link2vendor` int(11) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `last_modified` date DEFAULT NULL,
  `tax` decimal(15,2) DEFAULT NULL,
  `shipping` decimal(15,2) DEFAULT NULL,
  `labor` decimal(15,2) DEFAULT NULL,
  `total_due` decimal(15,2) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `potype` varchar(20) DEFAULT NULL,
  `supp_type` char(20) DEFAULT NULL,
  `ecc_supp` varchar(255) DEFAULT NULL,
  `sub_heading` float DEFAULT NULL,
  `quote_ref` varchar(255) DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `notes` text,
  `created_by` varchar(20) DEFAULT NULL,
  `modified_by` varchar(20) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `target_siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eqpo`
--

LOCK TABLES `eqpo` WRITE;
/*!40000 ALTER TABLE `eqpo` DISABLE KEYS */;
/*!40000 ALTER TABLE `eqpo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eqpo_li`
--

DROP TABLE IF EXISTS `eqpo_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eqpo_li` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_desc` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `rate` decimal(15,2) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `shipping_handling` decimal(10,2) DEFAULT NULL,
  `taxes` decimal(15,2) DEFAULT NULL,
  `link2eqpo` int(11) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `last_modified` date DEFAULT NULL,
  `material_ref` varchar(20) DEFAULT NULL,
  `material_spec` varchar(30) DEFAULT NULL,
  `thick` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `qty_per_meter` float DEFAULT NULL,
  `no_of_meterages` float DEFAULT NULL,
  `delv_by` varchar(20) DEFAULT NULL,
  `uom` varchar(30) DEFAULT NULL,
  `grainflow` varchar(100) DEFAULT NULL,
  `no_of_lengths` float DEFAULT NULL,
  `accepted_date` date DEFAULT NULL,
  `woref` varchar(30) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eqpo_li`
--

LOCK TABLES `eqpo_li` WRITE;
/*!40000 ALTER TABLE `eqpo_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `eqpo_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equip_part_master`
--

DROP TABLE IF EXISTS `equip_part_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equip_part_master` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `mfr_partnum` varchar(50) DEFAULT NULL,
  `digikey_partnum` varchar(50) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `min_qty` int(11) DEFAULT NULL,
  `lead_time` int(11) DEFAULT NULL,
  `lead_unit` char(1) DEFAULT NULL,
  `part_desc` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `inventory_cnt` int(11) DEFAULT NULL,
  `link2vendor` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `ptype` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `part_iss` varchar(255) DEFAULT NULL,
  `drg_no` varchar(200) DEFAULT NULL,
  `drg_iss` varchar(200) DEFAULT NULL,
  `part_ref` varchar(55) DEFAULT NULL,
  `mc_ref` varchar(55) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equip_part_master`
--

LOCK TABLES `equip_part_master` WRITE;
/*!40000 ALTER TABLE `equip_part_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `equip_part_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_notes`
--

DROP TABLE IF EXISTS `event_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_notes` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `notes_label` varchar(50) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_notes`
--

LOCK TABLES `event_notes` WRITE;
/*!40000 ALTER TABLE `event_notes` DISABLE KEYS */;
INSERT INTO `event_notes` VALUES (1,'test','testeth teuycd','2017-07-19',2),(2,'h','gfjgjh','2017-08-24',2);
/*!40000 ALTER TABLE `event_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fair`
--

DROP TABLE IF EXISTS `fair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fair` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `crn` varchar(100) DEFAULT NULL,
  `wonum` varchar(100) DEFAULT NULL,
  `cofc` varchar(100) DEFAULT NULL,
  `wo_date` date DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `nc` varchar(25) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL,
  `remarks` text,
  `mps_rev` varchar(100) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fair`
--

LOCK TABLES `fair` WRITE;
/*!40000 ALTER TABLE `fair` DISABLE KEYS */;
INSERT INTO `fair` VALUES (50,'prn9','A02581',NULL,'2017-12-28','FAIR',NULL,NULL,2581,NULL,'','FSI'),(49,'prn9','A02580',NULL,'2017-12-28','FAIR',NULL,NULL,2580,NULL,'','FSI'),(48,'prn9','A02579',NULL,'2017-12-27','FAIR',NULL,NULL,2579,NULL,'','FSI'),(47,'prn9','A02578',NULL,'2017-12-27','FAIR',NULL,NULL,2578,NULL,'','FSI'),(46,'prn9','A02577',NULL,'2017-12-27','FAIR',NULL,NULL,2577,NULL,'','FSI'),(45,'prn9','A02576',NULL,'2017-12-27','FAIR',NULL,NULL,2576,NULL,'','FSI'),(44,'prn9','A02575',NULL,'2017-12-29','FAIR',NULL,NULL,2575,NULL,'','FSI'),(43,'prn9','A02574',NULL,'2017-12-01','FAIR',NULL,NULL,2574,NULL,'','FSI'),(42,'prn9','A02573',NULL,'2017-12-01','FAIR',NULL,NULL,2573,NULL,'','FSI'),(41,'prn9','A02572',NULL,'2017-12-01','FAIR',NULL,NULL,2572,NULL,'','FSI'),(40,'prn9','A02571',NULL,'2017-12-01','FAIR',NULL,NULL,2571,NULL,'20','FSI'),(39,'prn9','A02570',NULL,'2017-12-01','FAIR',NULL,NULL,2570,NULL,'20','FSI'),(38,'prn9','A02569',NULL,'2017-12-01','FAIR',NULL,NULL,2569,NULL,'20','FSI'),(37,'prn9','A02568',NULL,'2017-12-01','FAIR',NULL,NULL,2568,NULL,'20','FSI'),(36,'prn9','A02567',NULL,'2017-12-01','FAIR',NULL,NULL,2567,NULL,'20','FSI'),(35,'prn9','A02566',NULL,'2017-12-01','RE FAIR',NULL,NULL,2566,NULL,'20','FSI'),(34,'prn4','31475',NULL,'2017-11-24','FAIR','','APPROVED',31541,'','454','FSI'),(33,'prn10','K02565',NULL,'2017-11-30','FAIR',NULL,NULL,2565,NULL,'1','FSI'),(32,'prn6','31474',NULL,'2017-11-23','FAIR','','APPROVED',31540,'','mps','FSI'),(31,'prn9','A02564',NULL,'2017-11-27','FAIR',NULL,NULL,2564,NULL,'','FSI'),(30,'prn9','A02563','C27353','2017-11-24','FAIR',NULL,NULL,2563,NULL,'','FSI'),(29,'prn8','31471','C27352','2017-11-30','FAIR','','APPROVED',31537,'','234','FSI'),(27,'prn1','31469','C27351','2017-11-24','FAIR','','APPROVED',31535,'','121','FSI'),(28,'prn3','31470',NULL,'2017-11-24','FAIR','','APPROVED',31536,'','2323','FSI'),(51,'prn9','A02582',NULL,'2017-12-28','FAIR',NULL,NULL,2582,NULL,'','FSI'),(52,'prn9','A02583',NULL,'2017-12-26','FAIR',NULL,NULL,2583,NULL,'','FSI'),(53,'prn9','A02584',NULL,'2017-12-26','FAIR',NULL,NULL,2584,NULL,'','FSI'),(54,'prn9','A02585',NULL,'2017-12-26','FAIR',NULL,NULL,2585,NULL,'','FSI'),(55,'prn9','A02586',NULL,'2017-12-27','FAIR',NULL,NULL,2586,NULL,'','FSI'),(56,'prn9','A02587',NULL,'2017-12-27','FAIR',NULL,NULL,2587,NULL,'','FSI'),(57,'prn9','A02588',NULL,'2017-12-27','FAIR',NULL,NULL,2588,NULL,'','FSI'),(58,'prn9','A02589',NULL,'2017-12-27','FAIR',NULL,NULL,2589,NULL,'','FSI'),(59,'prn9','A02590',NULL,'2017-12-28','FAIR',NULL,NULL,2590,NULL,'','FSI'),(60,'prn9','A02591',NULL,'2017-12-28','FAIR',NULL,NULL,2591,NULL,'','FSI'),(61,'prn9','A02592',NULL,'2017-12-28','FAIR',NULL,NULL,2592,NULL,'','FSI'),(62,'prn9','A02593',NULL,'2017-12-28','FAIR',NULL,NULL,2593,NULL,'','FSI'),(63,'prn9','A02594',NULL,'2017-12-28','FAIR',NULL,NULL,2594,NULL,'','FSI'),(64,'prn9','A02595',NULL,'2017-12-28','FAIR',NULL,NULL,2595,NULL,'','FSI'),(65,'prn9','A02596',NULL,'2017-12-28','FAIR',NULL,NULL,2596,NULL,'','FSI'),(66,'prn9','A02597',NULL,'2017-12-28','FAIR',NULL,NULL,2597,NULL,'','FSI'),(67,'prn9','A02598',NULL,'2017-12-28','FAIR',NULL,NULL,2598,NULL,'','FSI'),(68,'flu-001','31477',NULL,'2017-12-05','FAIR',NULL,NULL,31543,NULL,'001','FSI'),(69,'flu-assy-001','A02599','C27354','2017-12-06','FAIR',NULL,NULL,2599,NULL,'00','FSI'),(70,'prn9','A02600',NULL,'2017-12-21','FAIR',NULL,NULL,2600,NULL,'','FSI'),(71,'prn9','A02601',NULL,'2017-12-21','FAIR',NULL,NULL,2601,NULL,'','FSI'),(72,'prn9','A02602',NULL,'2017-12-21','FAIR',NULL,NULL,2602,NULL,'','FSI'),(73,'prn9','A02603',NULL,'2017-12-21','FAIR',NULL,NULL,2603,NULL,'','FSI'),(74,'prn9','A02604',NULL,'2017-12-21','FAIR',NULL,NULL,2604,NULL,'','FSI'),(75,'prn9','A02605',NULL,'2017-12-21','FAIR',NULL,NULL,2605,NULL,'','FSI'),(76,'prn9','A02606',NULL,'2017-12-21','FAIR',NULL,NULL,2606,NULL,'','FSI'),(77,'prn9','A02607',NULL,'2017-12-21','FAIR',NULL,NULL,2607,NULL,'','FSI'),(78,'prn9','A02608',NULL,'2017-12-21','FAIR',NULL,NULL,2608,NULL,'','FSI'),(79,'prn9','A02609',NULL,'2017-12-21','FAIR',NULL,NULL,2609,NULL,'','FSI'),(80,'prn9','A02610',NULL,'2017-12-22','FAIR',NULL,NULL,2610,NULL,'20','FSI'),(81,'prn9','A02611',NULL,'2017-12-22','FAIR',NULL,NULL,2611,NULL,'20','FSI'),(82,'prn9','A02612',NULL,'2017-12-22','FAIR',NULL,NULL,2612,NULL,'20','FSI'),(83,'prn9','A02613',NULL,'2017-12-22','FAIR',NULL,NULL,2613,NULL,'','FSI'),(84,'prn9','A02614',NULL,'2017-12-22','FAIR',NULL,NULL,2614,NULL,'','FSI'),(85,'prn9','A02615',NULL,'2017-12-22','FAIR',NULL,NULL,2615,NULL,'','FSI'),(86,'prn9','A02616',NULL,'2017-12-22','FAIR',NULL,NULL,2616,NULL,'','FSI'),(87,'prn9','A02617',NULL,'2017-12-22','FAIR',NULL,NULL,2617,NULL,'','FSI'),(88,'prn9','A02618',NULL,'2017-12-22','FAIR',NULL,NULL,2618,NULL,'20','FSI'),(89,'prn9','A02619',NULL,'2017-12-22','FAIR',NULL,NULL,2619,NULL,'20','FSI');
/*!40000 ALTER TABLE `fair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `recnum` int(11) DEFAULT NULL,
  `crn` varchar(50) DEFAULT NULL,
  `refno` varchar(50) DEFAULT NULL,
  `partnumber` varchar(50) DEFAULT NULL,
  `requestedby` varchar(100) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `docdate` date DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `process` varchar(50) DEFAULT NULL,
  `fixture` varchar(50) DEFAULT NULL,
  `tools` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fid`
--

DROP TABLE IF EXISTS `fid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fid` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` int(11) DEFAULT NULL,
  `qty_recd` varchar(100) DEFAULT NULL,
  `qty_accp` varchar(100) DEFAULT NULL,
  `cim_num` varchar(20) DEFAULT NULL,
  `dc_qty` varchar(100) DEFAULT NULL,
  `insp_report_num` varchar(20) DEFAULT NULL,
  `cust_information` varchar(200) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL,
  `cim_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fid`
--

LOCK TABLES `fid` WRITE;
/*!40000 ALTER TABLE `fid` DISABLE KEYS */;
/*!40000 ALTER TABLE `fid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `final_insp_lineitems`
--

DROP TABLE IF EXISTS `final_insp_lineitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `final_insp_lineitems` (
  `recnum` int(11) DEFAULT NULL,
  `sheet` int(11) DEFAULT NULL,
  `map` varchar(10) DEFAULT NULL,
  `main_view` varchar(20) DEFAULT NULL,
  `slnum1` int(11) DEFAULT NULL,
  `slnum2` int(11) DEFAULT NULL,
  `actual_dim1` varchar(10) DEFAULT NULL,
  `actual_dim2` varchar(10) DEFAULT NULL,
  `actual_dim3` varchar(10) DEFAULT NULL,
  `accpt_reject` varchar(10) DEFAULT NULL,
  `insp_by1` varchar(30) DEFAULT NULL,
  `insp_by2` varchar(30) DEFAULT NULL,
  `insp_by3` varchar(30) DEFAULT NULL,
  `insp_date1` date DEFAULT NULL,
  `insp_date2` date DEFAULT NULL,
  `insp_date3` date DEFAULT NULL,
  `link2final_insp` int(11) DEFAULT NULL,
  `slnum3` int(11) DEFAULT NULL,
  `slno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_insp_lineitems`
--

LOCK TABLES `final_insp_lineitems` WRITE;
/*!40000 ALTER TABLE `final_insp_lineitems` DISABLE KEYS */;
INSERT INTO `final_insp_lineitems` VALUES (9,12,'12','12',0,0,'','','','','','','','0000-00-00','0000-00-00','0000-00-00',10,0,1);
/*!40000 ALTER TABLE `final_insp_lineitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `final_insp_report`
--

DROP TABLE IF EXISTS `final_insp_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `final_insp_report` (
  `recnum` int(11) DEFAULT NULL,
  `qty` varchar(10) DEFAULT NULL,
  `customer` varchar(30) DEFAULT NULL,
  `wonum` varchar(30) DEFAULT NULL,
  `partnum` varchar(30) DEFAULT NULL,
  `billnum` varchar(30) DEFAULT NULL,
  `billdate` date DEFAULT NULL,
  `partname` varchar(30) DEFAULT NULL,
  `ponum` varchar(30) DEFAULT NULL,
  `issue` varchar(10) DEFAULT NULL,
  `reportnum` varchar(30) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `approved_by` varchar(30) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `refnum` varchar(30) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_insp_report`
--

LOCK TABLES `final_insp_report` WRITE;
/*!40000 ALTER TABLE `final_insp_report` DISABLE KEYS */;
INSERT INTO `final_insp_report` VALUES (10,'','','','','','2017-02-16','','','','',0,'','0000-00-00','','FSI');
/*!40000 ALTER TABLE `final_insp_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fitting`
--

DROP TABLE IF EXISTS `fitting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fitting` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `operator` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `shift` int(11) DEFAULT NULL,
  `time_per_piece` int(11) DEFAULT NULL,
  `qty_assigned` int(11) DEFAULT NULL,
  `qty_produced` int(11) DEFAULT NULL,
  `rejection` int(11) DEFAULT NULL,
  `time_wasted` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fitting`
--

LOCK TABLES `fitting` WRITE;
/*!40000 ALTER TABLE `fitting` DISABLE KEYS */;
/*!40000 ALTER TABLE `fitting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_quote`
--

DROP TABLE IF EXISTS `generic_quote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_quote` (
  `recnum` int(11) DEFAULT NULL,
  `string1` varchar(255) DEFAULT NULL,
  `string2` varchar(255) DEFAULT NULL,
  `string3` varchar(255) DEFAULT NULL,
  `string4` varchar(255) DEFAULT NULL,
  `string5` varchar(255) DEFAULT NULL,
  `string6` varchar(255) DEFAULT NULL,
  `string7` varchar(255) DEFAULT NULL,
  `string8` varchar(255) DEFAULT NULL,
  `string9` varchar(255) DEFAULT NULL,
  `string10` varchar(255) DEFAULT NULL,
  `string11` varchar(255) DEFAULT NULL,
  `string12` varchar(255) DEFAULT NULL,
  `string13` varchar(255) DEFAULT NULL,
  `string14` varchar(255) DEFAULT NULL,
  `string15` varchar(255) DEFAULT NULL,
  `string16` varchar(255) DEFAULT NULL,
  `string17` varchar(255) DEFAULT NULL,
  `string18` varchar(255) DEFAULT NULL,
  `string19` varchar(255) DEFAULT NULL,
  `string20` varchar(255) DEFAULT NULL,
  `string21` varchar(255) DEFAULT NULL,
  `string22` varchar(255) DEFAULT NULL,
  `string23` varchar(255) DEFAULT NULL,
  `string24` varchar(255) DEFAULT NULL,
  `string25` varchar(255) DEFAULT NULL,
  `char1` varchar(100) DEFAULT NULL,
  `char2` varchar(100) DEFAULT NULL,
  `char3` varchar(100) DEFAULT NULL,
  `char4` varchar(100) DEFAULT NULL,
  `char5` varchar(100) DEFAULT NULL,
  `char6` varchar(100) DEFAULT NULL,
  `char7` varchar(100) DEFAULT NULL,
  `char8` varchar(100) DEFAULT NULL,
  `char9` varchar(100) DEFAULT NULL,
  `char10` varchar(100) DEFAULT NULL,
  `char11` varchar(100) DEFAULT NULL,
  `char12` varchar(100) DEFAULT NULL,
  `char13` varchar(100) DEFAULT NULL,
  `char14` varchar(100) DEFAULT NULL,
  `char15` varchar(100) DEFAULT NULL,
  `char16` varchar(100) DEFAULT NULL,
  `char17` varchar(100) DEFAULT NULL,
  `char18` varchar(100) DEFAULT NULL,
  `char19` varchar(100) DEFAULT NULL,
  `char20` varchar(100) DEFAULT NULL,
  `checkbox1` char(1) DEFAULT NULL,
  `checkbox2` char(1) DEFAULT NULL,
  `checkbox3` char(1) DEFAULT NULL,
  `checkbox4` char(1) DEFAULT NULL,
  `checkbox5` char(1) DEFAULT NULL,
  `checkbox6` char(1) DEFAULT NULL,
  `checkbox7` char(1) DEFAULT NULL,
  `checkbox8` char(1) DEFAULT NULL,
  `checkbox9` char(1) DEFAULT NULL,
  `checkbox10` char(1) DEFAULT NULL,
  `long1` longtext,
  `long2` longtext,
  `long3` longtext,
  `long4` longtext,
  `long5` longtext,
  `number1` int(11) DEFAULT NULL,
  `number2` int(11) DEFAULT NULL,
  `number3` int(11) DEFAULT NULL,
  `number4` int(11) DEFAULT NULL,
  `number5` int(11) DEFAULT NULL,
  `number6` int(11) DEFAULT NULL,
  `number7` int(11) DEFAULT NULL,
  `number8` int(11) DEFAULT NULL,
  `number9` int(11) DEFAULT NULL,
  `number10` int(11) DEFAULT NULL,
  `floatval1` float DEFAULT NULL,
  `floatval2` float DEFAULT NULL,
  `floatval3` float DEFAULT NULL,
  `floatval4` float DEFAULT NULL,
  `floatval5` float DEFAULT NULL,
  `floatval6` float DEFAULT NULL,
  `floatval7` float DEFAULT NULL,
  `floatval8` float DEFAULT NULL,
  `floatval9` float DEFAULT NULL,
  `floatval10` float DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `date3` date DEFAULT NULL,
  `date4` date DEFAULT NULL,
  `date5` date DEFAULT NULL,
  `date6` date DEFAULT NULL,
  `date7` date DEFAULT NULL,
  `date8` date DEFAULT NULL,
  `date9` date DEFAULT NULL,
  `date10` date DEFAULT NULL,
  `partqty1` varchar(100) DEFAULT NULL,
  `partqty2` varchar(100) DEFAULT NULL,
  `partqty3` varchar(100) DEFAULT NULL,
  `partqty4` varchar(100) DEFAULT NULL,
  `partqty5` varchar(100) DEFAULT NULL,
  `partqty6` varchar(100) DEFAULT NULL,
  `partqty7` varchar(100) DEFAULT NULL,
  `partqty8` varchar(100) DEFAULT NULL,
  `partqty9` varchar(100) DEFAULT NULL,
  `partqty10` varchar(100) DEFAULT NULL,
  `part1` varchar(100) DEFAULT NULL,
  `part2` varchar(100) DEFAULT NULL,
  `part3` varchar(100) DEFAULT NULL,
  `part4` varchar(100) DEFAULT NULL,
  `part5` varchar(100) DEFAULT NULL,
  `part6` varchar(100) DEFAULT NULL,
  `part7` varchar(100) DEFAULT NULL,
  `part8` varchar(100) DEFAULT NULL,
  `part9` varchar(100) DEFAULT NULL,
  `part10` varchar(100) DEFAULT NULL,
  `qty1` int(11) DEFAULT NULL,
  `qty2` int(11) DEFAULT NULL,
  `qty3` int(11) DEFAULT NULL,
  `qty4` int(11) DEFAULT NULL,
  `qty5` int(11) DEFAULT NULL,
  `qty6` int(11) DEFAULT NULL,
  `qty7` int(11) DEFAULT NULL,
  `qty8` int(11) DEFAULT NULL,
  `qty9` int(11) DEFAULT NULL,
  `qty10` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_quote`
--

LOCK TABLES `generic_quote` WRITE;
/*!40000 ALTER TABLE `generic_quote` DISABLE KEYS */;
/*!40000 ALTER TABLE `generic_quote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generic_wo`
--

DROP TABLE IF EXISTS `generic_wo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generic_wo` (
  `recnum` int(11) DEFAULT NULL,
  `string1` varchar(255) DEFAULT NULL,
  `string2` varchar(255) DEFAULT NULL,
  `string3` varchar(255) DEFAULT NULL,
  `string4` varchar(255) DEFAULT NULL,
  `string5` varchar(255) DEFAULT NULL,
  `string6` varchar(255) DEFAULT NULL,
  `string7` varchar(255) DEFAULT NULL,
  `string8` varchar(255) DEFAULT NULL,
  `string9` varchar(255) DEFAULT NULL,
  `string10` varchar(255) DEFAULT NULL,
  `string11` varchar(255) DEFAULT NULL,
  `string12` varchar(255) DEFAULT NULL,
  `string13` varchar(255) DEFAULT NULL,
  `string14` varchar(255) DEFAULT NULL,
  `string15` varchar(255) DEFAULT NULL,
  `string16` varchar(255) DEFAULT NULL,
  `string17` varchar(255) DEFAULT NULL,
  `string18` varchar(255) DEFAULT NULL,
  `string19` varchar(255) DEFAULT NULL,
  `string20` varchar(255) DEFAULT NULL,
  `string21` varchar(255) DEFAULT NULL,
  `string22` varchar(255) DEFAULT NULL,
  `string23` varchar(255) DEFAULT NULL,
  `string24` varchar(255) DEFAULT NULL,
  `string25` varchar(255) DEFAULT NULL,
  `char1` varchar(100) DEFAULT NULL,
  `char2` varchar(100) DEFAULT NULL,
  `char3` varchar(100) DEFAULT NULL,
  `char4` varchar(100) DEFAULT NULL,
  `char5` varchar(100) DEFAULT NULL,
  `char6` varchar(100) DEFAULT NULL,
  `char7` varchar(100) DEFAULT NULL,
  `char8` varchar(100) DEFAULT NULL,
  `char9` varchar(100) DEFAULT NULL,
  `char10` varchar(100) DEFAULT NULL,
  `char11` varchar(100) DEFAULT NULL,
  `char12` varchar(100) DEFAULT NULL,
  `char13` varchar(100) DEFAULT NULL,
  `char14` varchar(100) DEFAULT NULL,
  `char15` varchar(100) DEFAULT NULL,
  `char16` varchar(100) DEFAULT NULL,
  `char17` varchar(100) DEFAULT NULL,
  `char18` varchar(100) DEFAULT NULL,
  `char19` varchar(100) DEFAULT NULL,
  `char20` varchar(100) DEFAULT NULL,
  `checkbox1` char(1) DEFAULT NULL,
  `checkbox2` char(1) DEFAULT NULL,
  `checkbox3` char(1) DEFAULT NULL,
  `checkbox4` char(1) DEFAULT NULL,
  `checkbox5` char(1) DEFAULT NULL,
  `checkbox6` char(1) DEFAULT NULL,
  `checkbox7` char(1) DEFAULT NULL,
  `checkbox8` char(1) DEFAULT NULL,
  `checkbox9` char(1) DEFAULT NULL,
  `checkbox10` char(1) DEFAULT NULL,
  `long1` longtext,
  `long2` longtext,
  `long3` longtext,
  `long4` longtext,
  `long5` longtext,
  `number1` int(11) DEFAULT NULL,
  `number2` int(11) DEFAULT NULL,
  `number3` int(11) DEFAULT NULL,
  `number4` int(11) DEFAULT NULL,
  `number5` int(11) DEFAULT NULL,
  `number6` int(11) DEFAULT NULL,
  `number7` int(11) DEFAULT NULL,
  `number8` int(11) DEFAULT NULL,
  `number9` int(11) DEFAULT NULL,
  `number10` int(11) DEFAULT NULL,
  `floatval1` float DEFAULT NULL,
  `floatval2` float DEFAULT NULL,
  `floatval3` float DEFAULT NULL,
  `floatval4` float DEFAULT NULL,
  `floatval5` float DEFAULT NULL,
  `floatval6` float DEFAULT NULL,
  `floatval7` float DEFAULT NULL,
  `floatval8` float DEFAULT NULL,
  `floatval9` float DEFAULT NULL,
  `floatval10` float DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `date3` date DEFAULT NULL,
  `date4` date DEFAULT NULL,
  `date5` date DEFAULT NULL,
  `date6` date DEFAULT NULL,
  `date7` date DEFAULT NULL,
  `date8` date DEFAULT NULL,
  `date9` date DEFAULT NULL,
  `date10` date DEFAULT NULL,
  `partqty1` varchar(100) DEFAULT NULL,
  `partqty2` varchar(100) DEFAULT NULL,
  `partqty3` varchar(100) DEFAULT NULL,
  `partqty4` varchar(100) DEFAULT NULL,
  `partqty5` varchar(100) DEFAULT NULL,
  `partqty6` varchar(100) DEFAULT NULL,
  `partqty7` varchar(100) DEFAULT NULL,
  `partqty8` varchar(100) DEFAULT NULL,
  `partqty9` varchar(100) DEFAULT NULL,
  `partqty10` varchar(100) DEFAULT NULL,
  `part1` varchar(100) DEFAULT NULL,
  `part2` varchar(100) DEFAULT NULL,
  `part3` varchar(100) DEFAULT NULL,
  `part4` varchar(100) DEFAULT NULL,
  `part5` varchar(100) DEFAULT NULL,
  `part6` varchar(100) DEFAULT NULL,
  `part7` varchar(100) DEFAULT NULL,
  `part8` varchar(100) DEFAULT NULL,
  `part9` varchar(100) DEFAULT NULL,
  `part10` varchar(100) DEFAULT NULL,
  `qty1` int(11) DEFAULT NULL,
  `qty2` int(11) DEFAULT NULL,
  `qty3` int(11) DEFAULT NULL,
  `qty4` int(11) DEFAULT NULL,
  `qty5` int(11) DEFAULT NULL,
  `qty6` int(11) DEFAULT NULL,
  `qty7` int(11) DEFAULT NULL,
  `qty8` int(11) DEFAULT NULL,
  `qty9` int(11) DEFAULT NULL,
  `qty10` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generic_wo`
--

LOCK TABLES `generic_wo` WRITE;
/*!40000 ALTER TABLE `generic_wo` DISABLE KEYS */;
/*!40000 ALTER TABLE `generic_wo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grn`
--

DROP TABLE IF EXISTS `grn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grn` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` varchar(20) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `partname` varchar(20) DEFAULT NULL,
  `raw_mat_type` varchar(30) DEFAULT NULL,
  `raw_mat_spec` varchar(100) DEFAULT NULL,
  `dim1` varchar(20) DEFAULT NULL,
  `dim2` varchar(20) DEFAULT NULL,
  `dim3` varchar(20) DEFAULT NULL,
  `dim4` varchar(20) DEFAULT NULL,
  `num_of_lengths` varchar(10) DEFAULT NULL,
  `num_of_pieces` varchar(10) DEFAULT NULL,
  `raw_mat_code` varchar(20) DEFAULT NULL,
  `invoice_num` varchar(20) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `recieved_date` date DEFAULT NULL,
  `test_report` varchar(50) DEFAULT NULL,
  `batch_num` varchar(100) DEFAULT NULL,
  `mgp_num` varchar(20) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `lead_time` int(11) DEFAULT NULL,
  `lead_unit` char(1) DEFAULT NULL,
  `inventory_cnt` int(11) DEFAULT NULL,
  `link2vendor` int(11) DEFAULT NULL,
  `grnnum` varchar(20) DEFAULT NULL,
  `coc_refnum` varchar(20) DEFAULT NULL,
  `total_qty` varchar(5) DEFAULT NULL,
  `allocated_qty` varchar(10) DEFAULT NULL,
  `rmbycim` varchar(10) DEFAULT NULL,
  `rmbycust` varchar(10) DEFAULT NULL,
  `cimponum` varchar(30) DEFAULT NULL,
  `fmtnum` varchar(20) DEFAULT NULL,
  `fmtrev` varchar(20) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `nc_refnum` varchar(20) DEFAULT NULL,
  `grntype` varchar(20) DEFAULT NULL,
  `crn` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `shipping_date` date DEFAULT NULL,
  `conversion_date` date DEFAULT NULL,
  `quarantine_remarks` varchar(255) DEFAULT NULL,
  `grndateQuar` date DEFAULT NULL,
  `rmpo_empcode` varchar(45) DEFAULT NULL,
  `rmpo_date` date DEFAULT NULL,
  `grn_empcode` varchar(45) DEFAULT NULL,
  `grn_date` varchar(45) DEFAULT NULL,
  `rm_cost` float DEFAULT NULL,
  `rm_currency` varchar(4) DEFAULT NULL,
  `approved` char(5) DEFAULT NULL,
  `rmpolinenum` varchar(20) DEFAULT NULL,
  `altcrn` varchar(50) DEFAULT NULL,
  `parentgrnnum` varchar(50) DEFAULT NULL,
  `pocrn` varchar(45) DEFAULT NULL,
  `approval_remarks` text,
  `approval_date` date DEFAULT NULL,
  `approved_by` varchar(45) DEFAULT NULL,
  `qtm` int(11) DEFAULT '0',
  `qty_used` int(11) DEFAULT '0',
  `qty_quar` int(11) DEFAULT '0',
  `qty_ret` int(11) DEFAULT '0',
  `stdrev` varchar(45) DEFAULT NULL,
  `grn_classif` varchar(45) DEFAULT NULL,
  `wo_ref` varchar(45) DEFAULT NULL,
  `cad_approved` varchar(5) DEFAULT NULL,
  `cad_approved_by` varchar(45) DEFAULT NULL,
  `cad_approval_date` date DEFAULT NULL,
  `qtm_req` int(11) DEFAULT NULL,
  `hold` int(11) DEFAULT NULL,
  `conversion_rate` float DEFAULT NULL,
  `qty_bill_match` varchar(10) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  KEY `ind_grn_recnum` (`recnum`),
  KEY `ind_grn_crn` (`crn`),
  KEY `ind_grn_grn` (`grnnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grn`
--

LOCK TABLES `grn` WRITE;
/*!40000 ALTER TABLE `grn` DISABLE KEYS */;
INSERT INTO `grn` VALUES (15304,NULL,NULL,NULL,'RMT 1','RMS 1',NULL,NULL,NULL,NULL,NULL,'','123','123','2016-08-22','2016-08-23','','1313','',NULL,NULL,NULL,NULL,129,'G1','',NULL,NULL,'sss','','1','F7532','0','','','Regular','PRN-001','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','','1','','','PRN1',NULL,NULL,NULL,5000,2,0,0,'','Regular','',NULL,NULL,NULL,0,NULL,NULL,NULL,'FSI'),(15306,'',NULL,NULL,'RMT 3','RMS 3',NULL,NULL,NULL,NULL,NULL,'','','234','2016-09-30','2016-09-29','','555','',NULL,NULL,NULL,NULL,132,'g3','',NULL,NULL,'ddddd','','3','F7532','0','','','Boughtout','prn3','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','dddd','0',100,'$','yes','1','','','prn3','','2016-10-13','bmandyam',10,6,0,0,'','Regular','','yes','bmandyam','2016-10-13',0,NULL,NULL,NULL,'FSI'),(15307,'',NULL,NULL,'RMT 6','RMS 6',NULL,NULL,NULL,NULL,NULL,'','','545','2016-09-30','2016-09-30','','3455','',NULL,NULL,NULL,NULL,129,'g6','',NULL,NULL,'dddd','','234','F7532','0','','','Consummables','prn6','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','yes','1','','','prn6','','2016-10-13','bmandyam',4000,3,0,0,'','Regular','','yes','bmandyam','2016-10-13',0,NULL,NULL,NULL,'FSI'),(15308,NULL,NULL,NULL,'RMT 5','RMS 5',NULL,NULL,NULL,NULL,NULL,'','324','232','2016-10-05','2016-10-04','','455','43',NULL,NULL,NULL,NULL,129,'g5','',NULL,NULL,'ss','','5','F7532','0','','','Regular','prn5','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','','1','','','prn5',NULL,NULL,NULL,1946,0,0,0,'','Regular','',NULL,NULL,NULL,0,NULL,NULL,NULL,'FSI'),(15309,NULL,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,'','','3434','2016-10-12','2016-10-05','','3434','3434',NULL,NULL,NULL,NULL,129,'g7','',NULL,NULL,'fff','','555','F7532','0','','','Regular','prn7','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','','1','','','prn7',NULL,NULL,NULL,120000,0,0,0,'','Regular','',NULL,NULL,NULL,0,NULL,NULL,NULL,'FSI'),(15312,NULL,NULL,NULL,'RMT 8','RMS 8',NULL,NULL,NULL,NULL,NULL,'','','65756','2016-10-18','2016-10-18','','576','',NULL,NULL,NULL,NULL,129,'g8','',NULL,NULL,'ss','','5551','F7532','0','','','Regular','prn8','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','','1','','','prn8',NULL,NULL,NULL,250,2,0,0,'','Regular','',NULL,NULL,NULL,0,NULL,NULL,NULL,'FSI'),(15313,'',NULL,NULL,'RMT2','RMS2',NULL,NULL,NULL,NULL,NULL,'','123','123','2016-11-09','2016-11-09','','4545','',NULL,NULL,NULL,NULL,129,'g2','',NULL,NULL,'sss','','2','F7532','0','','','Regular','prn2','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','yes','1','','','prn2','','2017-12-21','bmandyam',1000,10,0,0,'','Regular','','yes','bmandyam','2017-12-21',0,NULL,NULL,NULL,'FSI'),(15314,'',NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,'','','3434','2016-11-09','2016-11-09','','343','',NULL,NULL,NULL,NULL,129,'g1235','',NULL,NULL,'dfs','','5','F7532','0','','','Boughtout','','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','yes','1','','','prn5','','2017-02-27','bmandyam',24,5,0,0,'','Regular','','yes','bmandyam','2017-02-27',0,NULL,NULL,NULL,'FSI'),(15315,'',NULL,NULL,'dgsfg','bvnxfgchd',NULL,NULL,NULL,NULL,NULL,'','dgsdf','dgsdfg','2017-08-16','2017-08-10','dgsdfg','dfg4636','dfgsfg',NULL,NULL,NULL,NULL,129,'RMK-GRN-001','',NULL,NULL,'rm host','','PO-001','F7532','0','sfadf','','Regular','prn1','Open','0000-00-00','2017-08-17','','0000-00-00','sfdsd','2017-08-17','sadfsaf','2017-08-22',0,'$','yes','1','','','RMK_001','fgasdgsdfg','2017-08-08','bmandyam',100,1,0,0,'','Regular','','yes','bmandyam','2017-08-08',0,NULL,NULL,NULL,'FSI'),(15317,'',NULL,NULL,'test','test',NULL,NULL,NULL,NULL,NULL,'','test','4545','2017-09-12','2017-09-12','','3545','',NULL,NULL,NULL,NULL,129,'G0004','',NULL,NULL,'yes','','4','F7532','0','','','Regular','prn4','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','yes','1','','','prn4','','2017-11-24','bmandyam',4,1,0,0,'','Regular','','yes','bmandyam','2017-11-24',0,NULL,NULL,NULL,'FSI'),(15318,'',NULL,NULL,'test','test',NULL,NULL,NULL,NULL,NULL,'','test','test','2017-11-22','2017-11-22','','ere','',NULL,NULL,NULL,NULL,129,'G00010','',NULL,NULL,'','yes','1','F7532','0','','','Boughtout','prn1','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','yes','1','','','prn1','','2017-12-01','bmandyam',100,32,0,0,'','Regular','','yes','bmandyam','2017-12-01',0,NULL,NULL,NULL,'FSI'),(15319,NULL,NULL,NULL,'test','test',NULL,NULL,NULL,NULL,NULL,'','test','454534','2017-11-23','2017-11-23','','335345','',NULL,NULL,NULL,NULL,129,'G00011','',NULL,NULL,'yes','','1','F7532','0','','','Consummables','prn4','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','','1','','','PRN1',NULL,NULL,NULL,100,23,0,0,'','Regular','',NULL,NULL,NULL,0,NULL,NULL,NULL,'FSI'),(15320,NULL,NULL,NULL,'raw type','raw spec',NULL,NULL,NULL,NULL,NULL,'','','inn001','2017-12-04','2017-12-04','','10001','',NULL,NULL,NULL,NULL,132,'kar00001','',NULL,NULL,'yes','','KARPO-001','F7532','0','','','Regular','flu-001','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','','1','','','flu-001',NULL,NULL,NULL,2000,1,0,0,'','Regular','',NULL,NULL,NULL,0,NULL,NULL,NULL,'FSI'),(15321,'',NULL,NULL,'raw type','raw spec',NULL,NULL,NULL,NULL,NULL,'','','45646','2017-12-06','2017-12-06','','6746','',NULL,NULL,NULL,NULL,132,'kar00002','',NULL,NULL,'yes','','KAR-002','F7532','0','','','Boughtout','flu-001','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','yes','1','','','rmk 00 12','sfgas','2017-12-05','bmandyam',100,1,0,0,'','Regular','','yes','bmandyam','2017-12-05',0,NULL,NULL,NULL,'FSI'),(15322,'',NULL,NULL,'raw type','raw spec',NULL,NULL,NULL,NULL,NULL,'','','456435','2017-12-05','2017-12-06','','6474367','',NULL,NULL,NULL,NULL,132,'kar00003','',NULL,NULL,'yes','','KARCO-001','F7532','0','','','Consummables','flu-001','Open','0000-00-00','0000-00-00','','0000-00-00','','0000-00-00','','0',0,'$','yes','1','','','rmk 00 13','','2017-12-05','bmandyam',100,1,0,0,'','Regular','','yes','bmandyam','2017-12-05',0,NULL,NULL,NULL,'FSI');
/*!40000 ALTER TABLE `grn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grn_issue`
--

DROP TABLE IF EXISTS `grn_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grn_issue` (
  `recno` int(11) DEFAULT NULL,
  `iss_date` date DEFAULT NULL,
  `iss_qty` int(11) DEFAULT NULL,
  `qty4wo` varchar(20) DEFAULT NULL,
  `accqty` int(11) DEFAULT NULL,
  `rejqty` int(11) DEFAULT NULL,
  `retqty` int(11) DEFAULT '0',
  `balance` int(11) DEFAULT NULL,
  `link2grn` int(11) DEFAULT NULL,
  `line_no` int(11) DEFAULT NULL,
  `opbal` int(11) DEFAULT NULL,
  `clbal` int(11) DEFAULT NULL,
  `wonum` varchar(255) DEFAULT NULL,
  `grnnum` varchar(45) DEFAULT NULL,
  `wo_status` varchar(45) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grn_issue`
--

LOCK TABLES `grn_issue` WRITE;
/*!40000 ALTER TABLE `grn_issue` DISABLE KEYS */;
INSERT INTO `grn_issue` VALUES (10,'2016-12-19',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,10,9,'31422','g3','Open','FSI'),(11,'2016-12-19',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,9,8,'31423','g3','Open','FSI'),(13,'2016-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,9,10,'31422','g3','WO Cancelled','FSI'),(14,'2017-02-14',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,8,9,'31423','g3','WO Cancelled','FSI'),(15,'2017-02-27',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,23,22,'A02557','g1235','Open',NULL),(16,'2017-02-27',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,23,21,'A02558','g1235','Open',NULL),(17,'2017-02-28',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,23,20,'A02560','g1235','Open',NULL),(18,'2017-02-28',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,23,19,'A02561','g1235','Open',NULL),(19,'2017-03-09',NULL,'5',NULL,NULL,0,NULL,NULL,NULL,4999,4994,'31424','G1','Open','FSI'),(20,'2017-08-08',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4995,4994,'31425','G1','Open','FSI'),(21,'2017-08-08',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4995,4993,'31426','G1','Open','FSI'),(22,'2017-08-08',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4995,4992,'31427','G1','Open','FSI'),(23,'2017-08-08',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4995,4991,'31428','G1','Open','FSI'),(24,'2017-08-09',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4991,4990,'31429','G1','Open','FSI'),(25,'2017-08-09',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4990,4989,'31430','G1','Open','FSI'),(26,'2017-08-10',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4989,4988,'31431','G1','Open','FSI'),(27,'2017-08-10',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,100,99,'31432','RMK-GRN-001','Open','FSI'),(28,'2017-08-10',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4988,4987,'31433','G1','Open','FSI'),(29,'2017-08-10',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4987,4986,'31434','G1','Open','FSI'),(30,'2017-08-10',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,99,98,'31435','RMK-GRN-001','Open','FSI'),(31,'2017-08-10',NULL,'2',NULL,NULL,0,NULL,NULL,NULL,969,967,'31436','g2','Open','FSI'),(32,'2017-08-10',NULL,'3',NULL,NULL,0,NULL,NULL,NULL,9,6,'31437','g3','Open','FSI'),(33,'2017-08-10',NULL,'2',NULL,NULL,0,NULL,NULL,NULL,998,996,'31438','g2','Open','FSI'),(34,'2017-08-11',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,99,98,'31439','RMK-GRN-001','Open','FSI'),(35,'2017-08-14',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,98,97,'31440','RMK-GRN-001','Open','FSI'),(36,'2017-08-14',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,97,96,'31441','RMK-GRN-001','Open','FSI'),(37,'2017-08-14',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,95,'31442','RMK-GRN-001','Open','FSI'),(38,'2017-08-14',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,95,94,'31443','RMK-GRN-001','Open','FSI'),(39,'2017-08-16',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,6,5,'31444','g3','Open','FSI'),(40,'2017-08-16',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,94,93,'31445','RMK-GRN-001','Open','FSI'),(41,'2017-08-16',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,99,98,'31446','RMK-GRN-001','Open','FSI'),(42,'2017-08-17',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,99,98,'31447','RMK-GRN-001','Open','FSI'),(43,'2017-08-17',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,98,97,'31448','RMK-GRN-001','Open','FSI'),(44,'2017-08-28',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,4999,4998,'31449','G1','Open','FSI'),(45,'2017-08-28',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,97,96,'31450','RMK-GRN-001','Open','Z3456'),(46,'2017-08-28',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,95,'31451','RMK-GRN-001','Open','FSI'),(47,'2017-08-28',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,95,94,'31452','RMK-GRN-001','Open','FSI'),(48,'2017-08-28',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,94,93,'31453','RMK-GRN-001','Open','FSI'),(49,'2017-08-28',NULL,'10',NULL,NULL,0,NULL,NULL,NULL,998,988,'31454','g2','Open','FSI'),(50,'2017-08-28',NULL,'10',NULL,NULL,0,NULL,NULL,NULL,990,980,'31455','g2','Open','FSI'),(51,'2017-08-29',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,93,92,'31456','RMK-GRN-001','Open','FSI'),(52,'2017-08-29',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,990,989,'31457','g2','Open','FSI'),(53,'2017-09-07',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,989,988,'31458','g2','Open','FSI'),(54,'2017-09-12',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,2,1,'31459','G0004','Open','FSI'),(55,'2017-09-12',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,2,1,'31460','G0004','Open','FSI'),(56,'2017-09-12',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,999,998,'31461','g2','Open','FSI'),(57,'2017-11-03',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,92,91,'31462','RMK-GRN-001','Open','FSI'),(58,'2017-11-03',NULL,'0',NULL,NULL,0,NULL,NULL,NULL,91,91,'31463','RMK-GRN-001','Open','FSI'),(59,'2017-11-03',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,91,90,'31464','RMK-GRN-001','Open','FSI'),(60,'2017-11-03',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,90,89,'31465','RMK-GRN-001','Open','FSI'),(61,'2017-11-23',NULL,'10',NULL,NULL,0,NULL,NULL,NULL,250,240,'31466','g8','Open','FSI'),(62,'2017-11-23',NULL,'20',NULL,NULL,0,NULL,NULL,NULL,240,220,'31467','g8','Open','FSI'),(63,'2017-11-23',NULL,'20',NULL,NULL,0,NULL,NULL,NULL,230,210,'31468','g8','Open','FSI'),(64,'2017-11-24',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,100,99,'A02562','G00010','Open',NULL),(65,'2017-11-24',NULL,'5',NULL,NULL,0,NULL,NULL,NULL,99,94,'31469','RMK-GRN-001','Open','FSI'),(66,'2017-11-24',NULL,'5',NULL,NULL,0,NULL,NULL,NULL,9,4,'31470','g3','Open','FSI'),(67,'2017-11-24',NULL,'5',NULL,NULL,0,NULL,NULL,NULL,230,225,'31471','g8','Open','FSI'),(68,'2017-11-24',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,95,94,'31472','RMK-GRN-001','Open','FSI'),(69,'2017-11-24',NULL,'2',NULL,NULL,0,NULL,NULL,NULL,245,243,'31473','g8','Open','FSI'),(70,'2017-11-24',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,100,98,'A02563','G00010','Open',NULL),(71,'2017-11-24',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,99,98,'A02564','G00010','Open',NULL),(72,'2017-11-24',NULL,'2',NULL,NULL,0,NULL,NULL,NULL,3995,3993,'31474','g6','Open','FSI'),(73,'2017-11-24',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,98,97,'K02565','G00010','Open',NULL),(74,'2017-11-24',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,1,0,'31475','G0004','Open','FSI'),(75,'2017-11-24',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,2,1,'31476','G0004','Open','FSI'),(76,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,97,96,'A02588','G00010','Open',NULL),(77,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,97,95,'A02589','G00010','Open',NULL),(78,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,94,'A02590','G00010','Open',NULL),(79,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,93,'A02591','G00010','Open',NULL),(80,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,92,'A02592','G00010','Open',NULL),(81,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,91,'A02593','G00010','Open',NULL),(82,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,90,'A02594','G00010','Open',NULL),(83,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,89,'A02596','G00010','Open',NULL),(84,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,90,88,'A02597','G00010','Open',NULL),(85,'2017-12-01',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,90,87,'A02598','G00010','Open',NULL),(86,'2017-12-05',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,2000,1999,'31477','kar00001','Open','FSI'),(87,'2017-12-05',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,100,99,'A02599','kar00002','Open',NULL),(88,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,3998,3997,'31478','g6','Open','FSI'),(89,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,87,'A02600','G00010','Open',NULL),(90,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,86,'A02601','G00010','Open',NULL),(91,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,85,'A02602','G00010','Open',NULL),(92,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,84,'A02603','G00010','Open',NULL),(93,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,83,'A02604','G00010','Open',NULL),(94,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,82,'A02605','G00010','Open',NULL),(95,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,81,'A02606','G00010','Open',NULL),(96,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,80,'A02607','G00010','Open',NULL),(97,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,79,'A02608','G00010','Open',NULL),(98,'2017-12-21',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,87,78,'A02609','G00010','Open',NULL),(99,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,77,'A02610','G00010','Open',NULL),(100,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,76,'A02611','G00010','Open',NULL),(101,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,75,'A02612','G00010','Open',NULL),(102,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,74,'A02613','G00010','Open',NULL),(103,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,73,'A02614','G00010','Open',NULL),(104,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,72,'A02615','G00010','Open',NULL),(105,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,71,'A02616','G00010','Open',NULL),(106,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,96,70,'A02617','G00010','Open',NULL),(107,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,100,69,'A02618','G00010','Open',NULL),(108,'2017-12-22',NULL,'1',NULL,NULL,0,NULL,NULL,NULL,99,68,'A02619','G00010','Open',NULL);
/*!40000 ALTER TABLE `grn_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grn_li`
--

DROP TABLE IF EXISTS `grn_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grn_li` (
  `recnum` int(11) DEFAULT NULL,
  `linenum` varchar(20) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `dim1` char(50) DEFAULT NULL,
  `dim2` char(50) DEFAULT NULL,
  `dim3` char(50) DEFAULT NULL,
  `wo_assigned` varchar(255) DEFAULT NULL,
  `qty_left` float DEFAULT NULL,
  `link2grn` varchar(20) DEFAULT NULL,
  `qty_rej` int(11) DEFAULT NULL,
  `qty_to_make` int(11) DEFAULT NULL,
  `qty4billet` decimal(6,2) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `partdesc` varchar(255) DEFAULT NULL,
  `batchnum` varchar(100) DEFAULT NULL,
  `uom` varchar(10) DEFAULT NULL,
  `expdate` date DEFAULT NULL,
  `rmpo_linenum` varchar(20) DEFAULT NULL,
  `val_remarks` varchar(255) DEFAULT NULL,
  `amendlinenum` varchar(20) DEFAULT NULL,
  `layoutrefnum` varchar(30) DEFAULT NULL,
  `amendstatus` varchar(45) DEFAULT NULL,
  `noofpieces` int(11) DEFAULT NULL,
  KEY `ind_grnli_link2grn` (`link2grn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grn_li`
--

LOCK TABLES `grn_li` WRITE;
/*!40000 ALTER TABLE `grn_li` DISABLE KEYS */;
INSERT INTO `grn_li` VALUES (18206,'1',1,'1000','1','1',NULL,1,'15286',0,5,1.00,'P1','','B1','Meters','0000-00-00',NULL,'Material Specifications Dont match','','','',1),(18207,'1',1.054,'34','212','313',NULL,0.372,'15287',0,22,21.00,'11','sfsf','12','FEET','1990-03-22',NULL,'Material  Types  Dont Match','0','11','',31),(18208,'1',0.252,'21','212','212',NULL,0.252,'15288',0,6,23.00,'D924 50146 205','sdf','14','FEET','1990-03-22',NULL,'Material  Types  Dont Match','','22','',12),(18209,'1',0.84,'40','12','12',NULL,0.84,'15289',0,18,21.00,'12','safdsaf','2','FEET','1991-02-23',NULL,'Material  Types  Dont Match','','2','',21),(18210,'1',0.441,'21','21','211',NULL,0.441,'15290',0,9,21.00,'111','sda','1','FEET','1991-02-23',NULL,NULL,'','1','',21),(18211,'1',0.54,'45','13','13',NULL,0.54,'15291',0,12,23.00,'1','fds','12','FEET','1991-02-23',NULL,NULL,'','1','',12),(18212,'1',0.483,'23','2','23',NULL,0.483,'15292',0,10,21.00,'112','safdasf','1','FEET','2016-05-02',NULL,NULL,'','','',21),(18213,'1',1.21,'55','35','33',NULL,1.21,'15293',0,2,2.00,'12','sdfsdf','1','FEET','1990-03-22',NULL,'Suppliers Are Different','','','',22),(18214,'1',0.264,'22','32','42',NULL,0.264,'15294',0,6,21.00,'232','asd','13','FEET','1991-02-23',NULL,NULL,'','','',12),(18215,'1',1.21,'22','22','22',NULL,1.21,'15295',0,25,21.00,'213','TEST','','FEET','1991-02-23',NULL,NULL,'','','',55),(18216,'1',0.021,'1','1','3',NULL,0.021,'15296',0,0,1.00,'12','TEST','1','Meters','2016-05-02',NULL,NULL,'','2','',21),(18217,'1',8,'40','4','4',NULL,8,'15297',0,8,1.00,'22','TEST','3','Meters','2016-05-02',NULL,'Material  Types  Dont Match','','2','',200),(18218,'1',1.332,'333','342','24',NULL,1.332,'15298',0,28,21.00,'ass','test','23','FEET','2016-06-02',NULL,NULL,'','1','',4),(18219,'1',10,'50','55','52',NULL,10,'15299',0,20,2.00,'23','TWSE','23','FEET','2016-06-23',NULL,NULL,'','12','',200),(18220,'1',6,'60','50','50',NULL,6,'15300',0,732,122.00,'2','AWE','2','Meters','2016-06-28',NULL,NULL,'','22','',100),(18221,'1',8.658,'39','40','40',NULL,8.658,'15301',0,182,21.00,'asa','testing','22','FEET','2016-06-03',NULL,'Suppliers Are Different','','12','',222),(18222,'1',64.8,'324','334','44',NULL,64.8,'15302',0,1490,23.00,'43','test','231','FEET','2016-07-28',NULL,NULL,'','23','',200),(18223,'1',50.952,'24','124','24',NULL,50.952,'15303',0,51,1.00,'1','er','123','Meters','2016-08-11',NULL,'Suppliers Are Different','','1','',2123),(18224,'1',500,'50','50','50',NULL,500,'15304',0,5000,10.00,'1213','test','1212','Meters','2016-08-23',NULL,NULL,'','1','',10),(18225,'1',24,'200','50','10',NULL,24,'15305',0,240,10.00,'213','test','234','Meters','2016-09-15',NULL,'Material  Types  Dont Match','','1213','',12),(18226,'1',5568,'232','4','4',NULL,5568,'15306',0,10,100.00,'1212','test','35','Meters','2016-11-15',NULL,'Suppliers Are Different','','13','',24),(18227,'1',40,'400','40','50',NULL,40,'15307',0,4000,100.00,'1234','test','4354','Meters','2017-11-15',NULL,'The Entered Width does not match with RMPO Width','','213','',100),(18228,'1',0.8,'400','40','40',NULL,0.8,'15308',0,1946,2432.00,'323','test','4354','Meters','2016-09-15',NULL,NULL,'','','',200),(18229,'1',400,'200','20','20',NULL,400,'15309',0,120000,300.00,'23','erer','34','Meters','2016-09-15',NULL,NULL,'','','',200),(18230,'1',200,'20','20','20',NULL,200,'15310',0,46000,230.00,'234','test','434','Meters','2016-11-15',NULL,NULL,'','','',10),(18231,'1',100,'10','10','10',NULL,100,'15311',0,5000,50.00,'3434','test','435','Meters','2016-11-15',NULL,NULL,'','','',10),(18232,'1',25,'5','5','5',NULL,25,'15312',0,250,10.00,'sss','test','345','Meters','2016-11-15',NULL,NULL,'','','',5),(18233,'1',100,'10','10','10',NULL,100,'15313',0,1000,10.00,'343','test','34','Meters','2016-09-09',NULL,'Material  Types  Dont Match','','','',10),(18234,'1',0.01,'1','1','1',NULL,0.01,'15314',0,24,2432.00,'1234','test','3545','Meters','2017-09-09',NULL,'Suppliers Are Different','','','',10),(18235,'1',10,'10','10','10',NULL,10,'15315',0,100,10.00,'pn0001','dfgsdf','fg','Meters','0000-00-00',NULL,'Material  Types  Dont Match','','','',1),(18236,'1',20,'2','','10',NULL,20,'15316',0,200,10.00,'test','test','3434','Meters','2017-10-01',NULL,'Suppliers Are Different','','','',10),(18237,'1',2,'200','','10',NULL,12,'15317',0,4,2.00,'test','test','454','Meters','2017-10-01',NULL,'Suppliers Are Different','','','',10),(18238,'1',1,'1','','1',NULL,1,'15318',0,100,1.00,'BBOM/prn6','','dfg4636','Inches','2017-12-31',NULL,'Suppliers Are Different','','','',100),(18239,'1',13,'331','','11',NULL,13,'15319',0,100,1.00,'','test','dfg4636','Inches','2017-12-31',NULL,NULL,'','','',100),(18240,'1',20,'20','20','10',NULL,20,'15320',0,2000,100.00,'5454','part desc','','Meters','0000-00-00',NULL,NULL,'','','',1),(18241,'1',10,'10','10','10',NULL,10,'15321',0,100,1.00,'rmk0012','gdhsdghdg','01','mm','0000-00-00',NULL,'Material  Types  Dont Match','','','',10),(18242,'1',10,'STD','STD','STD',NULL,10,'15322',0,100,10.00,'fsdsdf','sdfsd','464','mm','0000-00-00',NULL,'Material  Types  Dont Match','','','',10);
/*!40000 ALTER TABLE `grn_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grn_notes`
--

DROP TABLE IF EXISTS `grn_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grn_notes` (
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `link2grn` int(10) unsigned DEFAULT NULL,
  `link2user` varchar(50) DEFAULT NULL,
  `grnnotes` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grn_notes`
--

LOCK TABLES `grn_notes` WRITE;
/*!40000 ALTER TABLE `grn_notes` DISABLE KEYS */;
INSERT INTO `grn_notes` VALUES ('2016-05-09 11:25:25','2016-05-09 11:25:25',15287,'bmandyam','dbhsdh'),('2016-05-09 11:26:07','2016-05-09 11:26:07',15287,'bmandyam','efre'),('2016-05-09 11:29:20','2016-05-09 11:29:20',15287,'bmandyam','gkgk'),('2016-05-09 11:31:24','2016-05-09 11:31:24',15287,'bmandyam','gkgksfsa'),('2016-05-09 11:32:59','2016-05-09 11:32:59',15287,'bmandyam','sdhfsh'),('2016-05-09 11:57:27','2016-05-09 11:57:27',15287,'bmandyam','dsgds'),('2016-05-09 18:33:50','2016-05-09 18:33:50',15288,'bmandyam','gdhdhgd'),('2016-05-09 18:34:59','2016-05-09 18:34:59',15288,'bmandyam','dhh'),('2016-05-10 10:57:59','2016-05-10 10:57:59',15287,'bmandyam','dsf'),('2016-05-10 11:05:01','2016-05-10 11:05:01',15287,'bmandyam','safdsdf'),('2016-05-10 11:07:34','2016-05-10 11:07:34',15287,'bmandyam','safdsdf'),('2016-05-10 11:07:56','2016-05-10 11:07:56',15287,'bmandyam','safdsdf'),('2016-05-10 11:11:03','2016-05-10 11:11:03',15287,'bmandyam','safdsdf'),('2016-05-10 11:13:01','2016-05-10 11:13:01',15287,'bmandyam','dddddd'),('2016-05-10 12:30:55','2016-05-10 12:30:55',15287,'bmandyam','efra'),('2016-05-12 11:31:06','2016-05-12 11:31:06',15289,'bmandyam','fhd'),('2016-05-30 11:30:14','2016-05-30 11:30:14',15293,'bmandyam','dsgsd 234'),('2016-05-30 11:30:53','2016-05-30 11:30:53',15293,'bmandyam','dg'),('2016-05-30 11:31:15','2016-05-30 11:31:15',15293,'bmandyam','srgf'),('2016-05-30 14:31:05','2016-05-30 14:31:05',15293,'bmandyam','sad'),('2016-05-30 14:33:26','2016-05-30 14:33:26',15293,'bmandyam','fdsg'),('2016-05-30 14:33:49','2016-05-30 14:33:49',15293,'bmandyam','fdsg'),('2016-05-30 14:34:23','2016-05-30 14:34:23',15289,'bmandyam','xzSC'),('2016-05-30 14:34:51','2016-05-30 14:34:51',15289,'bmandyam','dfa'),('2016-05-30 14:35:05','2016-05-30 14:35:05',15289,'bmandyam','dfa'),('2016-05-30 14:35:19','2016-05-30 14:35:19',15289,'bmandyam','dfa'),('2016-06-27 10:10:07','2016-06-27 10:10:07',15286,'bmandyam','testing'),('2016-06-28 16:45:39','2016-06-28 16:45:39',15297,'bmandyam','test'),('2016-06-28 16:46:16','2016-06-28 16:46:16',15297,'bmandyam','test'),('2016-06-28 16:46:55','2016-06-28 16:46:55',15297,'bmandyam','test'),('2016-06-28 16:53:42','2016-06-28 16:53:42',15297,'bmandyam','test'),('2016-06-28 17:06:36','2016-06-28 17:06:36',15297,'bmandyam','TEST'),('2016-07-05 11:01:53','2016-07-05 11:01:53',15301,'bmandyam','testing'),('2016-07-05 11:04:00','2016-07-05 11:04:00',15301,'bmandyam','testing'),('2016-07-05 11:09:09','2016-07-05 11:09:09',15301,'bmandyam','testing'),('2016-07-05 11:13:15','2016-07-05 11:13:15',15301,'bmandyam','testing'),('2016-07-05 11:33:36','2016-07-05 11:33:36',15301,'bmandyam','testing'),('2016-08-11 17:49:32','2016-08-11 17:49:32',15303,'bmandyam','srf'),('2016-08-11 17:50:07','2016-08-11 17:50:07',15303,'bmandyam','dsfg'),('2016-08-11 18:03:08','2016-08-11 18:03:08',15303,'bmandyam','xz'),('2016-08-11 18:04:56','2016-08-11 18:04:56',15303,'bmandyam','fg'),('2016-10-13 15:50:20','2016-10-13 15:50:20',15307,'bmandyam',''),('2016-10-13 16:02:46','2016-10-13 16:02:46',15307,'bmandyam',''),('2016-10-13 16:07:47','2016-10-13 16:07:47',15307,'bmandyam',''),('2016-10-13 16:20:39','2016-10-13 16:20:39',15307,'bmandyam',''),('2016-10-13 16:22:04','2016-10-13 16:22:04',15306,'bmandyam',''),('2016-10-13 16:39:28','2016-10-13 16:39:28',15306,'bmandyam',''),('2016-10-17 18:15:58','2016-10-17 18:15:58',15305,'bmandyam',''),('2016-10-18 15:06:07','2016-10-18 15:06:07',15307,'bmandyam',''),('2016-11-04 17:44:32','2016-11-04 17:44:32',15306,'bmandyam',''),('2016-11-09 18:34:30','2016-11-09 18:34:30',15305,'bmandyam','TEST'),('2016-11-09 18:55:19','2016-11-09 18:55:19',15314,'bmandyam',''),('2016-11-09 18:57:06','2016-11-09 18:57:06',15314,'bmandyam',''),('2016-11-09 18:57:39','2016-11-09 18:57:39',15314,'bmandyam',''),('2016-11-09 18:57:52','2016-11-09 18:57:52',15314,'bmandyam',''),('2017-02-27 16:42:39','2017-02-27 16:42:39',15314,'bmandyam',''),('2017-02-27 16:43:17','2017-02-27 16:43:17',15314,'bmandyam',''),('2017-02-27 16:43:54','2017-02-27 16:43:54',15314,'bmandyam',''),('2017-02-27 16:52:03','2017-02-27 16:52:03',15314,'bmandyam',''),('2017-02-27 18:06:02','2017-02-27 18:06:02',15307,'bmandyam',''),('2017-08-08 16:24:55','2017-08-08 16:24:55',15315,'bmandyam','dfgfadsg'),('2017-09-12 15:40:51','2017-09-12 15:40:51',15316,'bmandyam',''),('2017-11-24 14:45:20','2017-11-24 14:45:20',15317,'bmandyam',''),('2017-11-24 14:47:55','2017-11-24 14:47:55',15317,'bmandyam',''),('2017-11-24 14:48:12','2017-11-24 14:48:12',15317,'bmandyam',''),('2017-12-01 13:28:32','2017-12-01 13:28:32',15318,'bmandyam',''),('2017-12-01 13:28:56','2017-12-01 13:28:56',15318,'bmandyam',''),('2017-12-01 13:29:39','2017-12-01 13:29:39',15318,'bmandyam',''),('2017-12-05 15:14:33','2017-12-05 15:14:33',15322,'bmandyam','fhjdfgj'),('2017-12-05 15:42:49','2017-12-05 15:42:49',15321,'bmandyam','sgasg'),('2017-12-05 15:47:32','2017-12-05 15:47:32',15322,'bmandyam','dghsdfgsd'),('2017-12-05 15:57:56','2017-12-05 15:57:56',15322,'bmandyam','fghdgh'),('2017-12-21 11:13:01','2017-12-21 11:13:01',15313,'bmandyam','');
/*!40000 ALTER TABLE `grn_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `ref_type` varchar(50) DEFAULT NULL,
  `ref_num` varchar(50) DEFAULT NULL,
  `link2vendpart` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `received_by` varchar(55) DEFAULT NULL,
  `opbal` int(11) DEFAULT NULL,
  `clbal` int(11) DEFAULT NULL,
  `invoice_value` decimal(10,2) DEFAULT NULL,
  `mc_name` varchar(55) DEFAULT NULL,
  `crn` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `closing_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,'Receipts',1,'','',85,'2016-07-05','0000-00-00',0,'0000-00-00','',0,1,0.00,'','','','0000-00-00'),(2,'Receipts',1,'po1','12',85,'2016-07-05','2016-07-13',122,'2016-07-25','123',1,2,1.00,'mpv','14','','0000-00-00'),(3,'Issues',1,'po1','12',85,'2016-07-05','0000-00-00',0,'0000-00-00','123',2,3,0.00,'mpv','133','Scrap','2016-07-05'),(4,'Receipts',10,'po2','123',85,'2016-07-05','2016-07-26',22,'2016-07-26','133',3,13,1.00,'mpv','099','','0000-00-00'),(5,'Issues',1,'po2','123',85,'2016-07-05','0000-00-00',0,'0000-00-00','12',13,13,0.00,'mpv','099','Active','2016-07-05'),(6,'Receipts',10,'po1','123',86,'2016-07-06','2016-07-12',144,'2016-07-18','128',0,10,1.00,'mpv','prn2','','0000-00-00'),(7,'Issues',1,'po1','12',86,'2016-07-06','0000-00-00',0,'0000-00-00','14',10,10,0.00,'mpv','prn2','Active','2016-07-06');
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `recnum` int(11) DEFAULT NULL,
  `exporter` int(11) DEFAULT NULL,
  `consignee` int(11) DEFAULT NULL,
  `invnum` char(50) DEFAULT NULL,
  `invdate` date DEFAULT NULL,
  `invdesc` varchar(255) DEFAULT NULL,
  `inv2customer` int(11) DEFAULT NULL,
  `custpo_num` char(50) DEFAULT NULL,
  `precarriageby` char(50) DEFAULT NULL,
  `precarrierreceipt` char(50) DEFAULT NULL,
  `countryoforigin` char(50) DEFAULT NULL,
  `countryoffinaldest` char(50) DEFAULT NULL,
  `vessel` char(50) DEFAULT NULL,
  `portofloading` char(50) DEFAULT NULL,
  `terms` varchar(50) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `portofdischarge` char(50) DEFAULT NULL,
  `finaldest` char(50) DEFAULT NULL,
  `subtotal` decimal(12,2) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `totaldue` decimal(12,2) DEFAULT NULL,
  `packages` varchar(50) DEFAULT NULL,
  `remarks` text,
  `currency` char(5) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `fob_or_candf` char(10) DEFAULT NULL,
  `awbnum` varchar(45) DEFAULT NULL,
  `awbdate` date DEFAULT NULL,
  `fircnum` varchar(45) DEFAULT NULL,
  `fircdate` date DEFAULT NULL,
  `shipdate` date DEFAULT NULL,
  `shipping` varchar(45) DEFAULT NULL,
  `salestax` varchar(45) DEFAULT NULL,
  `inv2invli` int(10) unsigned DEFAULT NULL,
  `custporecnum` int(10) unsigned DEFAULT NULL,
  `formrev` varchar(255) DEFAULT NULL,
  `inv2shipping` int(11) DEFAULT NULL,
  `dcnum` varchar(45) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `advance_info` varchar(255) DEFAULT NULL,
  `advance_amount` decimal(8,2) DEFAULT NULL,
  `excise` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `excsubtotal` decimal(10,2) NOT NULL,
  `vatsubtotal` decimal(10,2) NOT NULL,
  `service_tax` decimal(10,2) DEFAULT NULL,
  `stsubtotal` decimal(10,2) DEFAULT NULL,
  `cess1` decimal(6,2) DEFAULT NULL,
  `cess2` decimal(6,2) DEFAULT NULL,
  `siteid` varchar(100) DEFAULT NULL,
  `approval` varchar(20) DEFAULT NULL,
  `approved_by` varchar(55) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `supply_date` date DEFAULT NULL,
  `supply_place` varchar(55) DEFAULT NULL,
  `vehicle_num` varchar(55) DEFAULT NULL,
  `transport_mode` varchar(20) DEFAULT NULL,
  KEY `ind_recnum` (`recnum`),
  KEY `ind_inv2customer` (`inv2customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,NULL,NULL,'00001','2016-10-27','',127,'','Road','Bangalore','India','3435','By Air','Bangalore, India','undefined','2016-11-09','df',NULL,100.00,100.00,100.00,'','undefined','$','',NULL,NULL,'FOB',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'F9015 Rev 00 dt August 15, 2011;',130,'','0000-00-00',NULL,NULL,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,NULL,'00002','2016-11-03','',130,'','Road','Bangalore','India','','By Air','Bangalore, India','undefined','2016-11-17','',NULL,0.00,0.00,0.00,'','undefined','$','',NULL,NULL,'FOB',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'F9015 Rev 00 dt August 15, 2011;',130,'','0000-00-00',NULL,NULL,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_line_items`
--

DROP TABLE IF EXISTS `invoice_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` int(11) DEFAULT NULL,
  `custpo_num` char(50) DEFAULT NULL,
  `cofc_num` char(50) DEFAULT NULL,
  `crnnum` char(50) DEFAULT NULL,
  `rawmtl` varchar(255) DEFAULT NULL,
  `cimpartnum` varchar(255) DEFAULT NULL,
  `noofpackages` int(11) DEFAULT NULL,
  `packaging` varchar(255) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `tariff_schedule` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `line_amount` decimal(10,2) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `link2invoice` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `po_qty` int(11) DEFAULT NULL,
  `polinenum` int(10) unsigned DEFAULT NULL,
  `schpo` varchar(255) DEFAULT NULL,
  `podate` date DEFAULT NULL,
  KEY `ind_link2invoice` (`link2invoice`),
  KEY `ind_cofc_num` (`cofc_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_line_items`
--

LOCK TABLES `invoice_line_items` WRITE;
/*!40000 ALTER TABLE `invoice_line_items` DISABLE KEYS */;
INSERT INTO `invoice_line_items` VALUES (1,1,'','','prn1','','3434',NULL,'','dfdf','',1,100,100.00,'2016-11-02',NULL,1,'Treated',0,0,'',NULL),(1,1,'','','3543','','3543',NULL,'','dfdf','',1,0,0.00,'2016-11-02',NULL,2,'Treated',0,0,'',NULL);
/*!40000 ALTER TABLE `invoice_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_payment`
--

DROP TABLE IF EXISTS `invoice_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_payment` (
  `recnum` int(11) DEFAULT NULL,
  `payment_amount` float DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `link2invoice` int(11) DEFAULT NULL,
  `ref_num` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_payment`
--

LOCK TABLES `invoice_payment` WRITE;
/*!40000 ALTER TABLE `invoice_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `irm`
--

DROP TABLE IF EXISTS `irm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `irm` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` int(11) DEFAULT NULL,
  `po_num` varchar(20) DEFAULT NULL,
  `po_qty` int(11) DEFAULT NULL,
  `mgp_num` varchar(20) DEFAULT NULL,
  `rm_dim1` int(11) DEFAULT NULL,
  `rm_dim2` int(11) DEFAULT NULL,
  `rm_dim3` int(11) DEFAULT NULL,
  `rm_qty` int(11) DEFAULT NULL,
  `qty_to_make` int(11) DEFAULT NULL,
  `cust_batch_num` varchar(20) DEFAULT NULL,
  `cust_wo_num` varchar(20) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL,
  `mgp_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `irm`
--

LOCK TABLES `irm` WRITE;
/*!40000 ALTER TABLE `irm` DISABLE KEYS */;
/*!40000 ALTER TABLE `irm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_notes`
--

DROP TABLE IF EXISTS `leads_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2leads` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_notes`
--

LOCK TABLES `leads_notes` WRITE;
/*!40000 ALTER TABLE `leads_notes` DISABLE KEYS */;
INSERT INTO `leads_notes` VALUES (1,'test','2017-03-30',3,5),(2,'test','2017-03-30',3,5),(3,'testing','2017-03-30',3,6),(4,'testing notes','2017-03-30',2,6),(5,'test for addfg','2017-03-30',2,7),(6,'','2017-04-04',2,8),(7,'','2017-04-20',2,49),(8,'test','2017-04-20',2,50),(9,'tewstset','2017-04-20',2,50),(10,'','2017-07-26',2,54),(11,'','2017-07-26',2,55),(12,'','2017-07-26',2,56),(13,'','2017-07-26',2,57),(14,'','2017-07-26',2,58),(15,'','2017-07-26',2,59),(16,'','2017-07-27',2,60),(17,'','2017-07-27',2,61);
/*!40000 ALTER TABLE `leads_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_mgt`
--

DROP TABLE IF EXISTS `leave_mgt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_mgt` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `reason` text,
  `status` varchar(50) DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  `empid` varchar(50) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `siteid` varchar(50) DEFAULT NULL,
  KEY `recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_mgt`
--

LOCK TABLES `leave_mgt` WRITE;
/*!40000 ALTER TABLE `leave_mgt` DISABLE KEYS */;
INSERT INTO `leave_mgt` VALUES (1,'2017-10-05','2017-10-05','i want leave','Active',2,'E2','2017-10-05','FSI'),(2,'2017-10-06','2017-10-09','Dddddddd','Rejected',2,'E2','2017-10-06','FSI'),(3,'2017-10-10','2017-10-11','','Approved',2,'E2','2017-10-10','FSI'),(4,'2017-10-26','2017-10-27','i want leave','Approved',96,'E96','2017-10-26','FSI'),(5,'2017-10-27','2017-10-28','Reason','Active',2,'E2','2017-10-27','FSI'),(19,'2017-11-21','2017-11-22','dadsfasdfsf','Active',2,'E2','2017-11-15','FSI'),(21,'2017-11-14','2017-11-25','sfasdfsf','Active',0,'EE247','2017-11-16','1'),(22,'2017-11-13','2017-11-30','aaaaaaaaa','Active',0,'EE249','2017-11-16','1'),(23,'2017-11-13','2017-11-30','sdfsdfas','Active',248,'E248','2017-11-16','FSI'),(24,'2017-11-06','2017-11-29','sadfsf','Approved',247,'E247','2017-11-16','FSI'),(25,'2017-11-20','2017-11-22','Test reasom','Active',2,'E2','2017-11-20','FSI');
/*!40000 ALTER TABLE `leave_mgt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `userid` varchar(8) DEFAULT NULL,
  `session` varchar(50) DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `activity` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES ('bmandyam','bmandyam','2014-01-21 21:55:28','Logged In'),('bmandyam','bmandyam','2014-01-22 10:09:41','Logged In'),('bmandyam','bmandyam','2014-01-22 10:40:48','Logged Out'),('sa','sa','2014-01-22 10:41:04','Logged In'),('sa','sa','2014-01-22 11:23:35','Logged Out'),('bmandyam','bmandyam','2014-01-22 11:33:45','Logged In'),('bmandyam','bmandyam','2014-01-22 11:40:31','Logged Out'),('bmandyam','bmandyam','2014-01-22 11:49:15','Logged In'),('bmandyam','bmandyam','2014-01-22 15:42:22','Logged Out'),('bmandyam','bmandyam','2014-01-22 15:44:51','Logged In'),('bmandyam','bmandyam','2014-01-22 19:16:35','Logged Out'),('bmandyam','bmandyam','2014-01-22 22:18:17','Logged In'),('bmandyam','bmandyam','2014-01-23 09:37:00','Logged In'),('bmandyam','bmandyam','2014-01-23 12:38:01','Logged Out'),('bmandyam','bmandyam','2014-01-23 14:44:30','Logged In'),('bmandyam','bmandyam','2014-01-24 15:17:19','Logged In'),('bmandyam','bmandyam','2014-01-24 17:30:59','Logged In'),('bmandyam','bmandyam','2014-01-24 17:32:20','Logged In'),('bmandyam','bmandyam','2014-01-24 17:33:37','Logged In'),('bmandyam','bmandyam','2014-01-24 17:33:44','Logged Out'),('bmandyam','bmandyam','2014-01-28 18:19:34','Logged In'),('bmandyam','bmandyam','2014-01-28 19:27:43','Logged Out'),('bmandyam','bmandyam','2014-01-29 12:23:25','Logged In'),('bmandyam','bmandyam','2014-01-29 12:26:01','Logged Out'),('bmandyam','bmandyam','2014-01-29 12:27:48','Logged In'),('bmandyam','bmandyam','2014-01-29 17:52:55','Logged In'),('bmandyam','bmandyam','2014-02-04 15:18:09','Logged In'),('bmandyam','bmandyam','2014-02-04 19:16:20','Logged Out'),('bmandyam','bmandyam','2014-02-11 11:48:38','Logged In'),('bmandyam','bmandyam','2014-02-11 11:52:37','Logged Out'),('bmandyam','bmandyam','2014-02-12 11:56:43','Logged In'),('bmandyam','bmandyam','2014-02-13 11:21:05','Logged In'),('bmandyam','bmandyam','2014-02-13 11:25:27','Logged Out'),('bmandyam','bmandyam','2014-02-13 11:25:33','Logged In'),('bmandyam','bmandyam','2014-02-13 13:01:19','Logged In'),('bmandyam','bmandyam','2014-02-13 13:01:36','Logged In'),('accounts','accounts','2014-02-13 13:10:00','Logged Out'),('bmandyam','bmandyam','2014-02-13 15:20:20','Logged In'),('bmandyam','bmandyam','2014-02-19 15:22:06','Logged In'),('bmandyam','bmandyam','2014-02-19 16:17:05','Logged Out'),('bmandyam','bmandyam','2014-02-24 11:03:04','Logged In'),('bmandyam','bmandyam','2014-02-24 12:01:28','Logged Out'),('bmandyam','bmandyam','2014-02-24 12:30:04','Logged In'),('bmandyam','bmandyam','2014-02-24 12:42:31','Logged Out'),('bmandyam','bmandyam','2014-03-03 18:14:16','Logged In'),('bmandyam','bmandyam','2014-07-04 11:17:06','Logged In'),('bmandyam','bmandyam','2014-07-07 12:14:59','Logged In'),('bmandyam','bmandyam','2014-07-07 12:20:13','Logged Out'),('bmandyam','bmandyam','2014-07-07 12:20:26','Logged In'),('bmandyam','bmandyam','2014-07-28 10:04:50','Logged In'),('bmandyam','bmandyam','2014-07-28 10:05:10','Logged In'),('bmandyam','bmandyam','2014-07-28 11:58:06','Logged Out'),('bmandyam','bmandyam','2014-08-12 11:14:49','Logged In'),('bmandyam','bmandyam','2014-08-12 11:48:54','Logged Out'),('bmandyam','bmandyam','2014-08-12 11:49:46','Logged In'),('bmandyam','bmandyam','2014-08-12 14:50:29','Logged In'),('bmandyam','bmandyam','2014-08-12 15:33:58','Logged Out'),('bmandyam','bmandyam','2015-02-01 13:26:34','Logged In'),('bmandyam','bmandyam','2015-02-01 13:56:46','Logged Out'),('bmandyam','bmandyam','2015-02-02 10:28:32','Logged In'),('bmandyam','bmandyam','2015-02-11 10:22:13','Logged In'),('bmandyam','bmandyam','2015-02-11 11:14:05','Logged Out'),('bmandyam','bmandyam','2015-08-17 11:57:55','Logged In'),('bmandyam','bmandyam','2015-08-17 11:59:25','Logged Out'),('bmandyam','bmandyam','2015-08-18 11:00:35','Logged In'),('bmandyam','bmandyam','2015-08-18 15:07:25','Logged Out'),('bmandyam','bmandyam','2015-08-19 13:05:19','Logged In'),('bmandyam','bmandyam','2015-08-20 15:49:42','Logged In'),('bmandyam','bmandyam','2015-08-20 15:50:30','Logged Out'),('bmandyam','bmandyam','2015-08-20 15:50:37','Logged In'),('bmandyam','bmandyam','2015-08-20 16:19:17','Logged Out'),('bmandyam','bmandyam','2015-08-26 16:16:47','Logged In'),('bmandyam','bmandyam','2015-08-26 16:18:07','Logged Out'),('bmandyam','bmandyam','2015-08-27 10:39:37','Logged In'),('','','2015-08-27 11:23:06','Logged Out'),('bmandyam','bmandyam','2015-08-27 15:22:32','Logged In'),('','','2016-03-10 16:59:41','Logged Out'),('bmandyam','bmandyam','2016-03-10 17:02:24','Logged In'),('bmandyam','bmandyam','2016-03-10 17:04:39','Logged In'),('bmandyam','bmandyam','2016-04-06 12:18:32','Logged In'),('bmandyam','bmandyam','2016-04-06 12:33:53','Logged Out'),('bmandyam','bmandyam','2016-04-06 15:26:38','Logged In'),('bmandyam','bmandyam','2016-04-06 16:42:42','Logged Out'),('','','2016-05-03 15:31:11','Logged Out'),('bmandyam','bmandyam','2016-05-03 15:33:44','Logged In'),('bmandyam','bmandyam','2016-05-03 15:39:45','Logged Out'),('bmandyam','bmandyam','2016-05-06 12:45:16','Logged In'),('sa','sa','2016-05-06 12:46:01','Logged In'),('bmandyam','bmandyam','2016-05-06 12:46:33','Logged In'),('bmandyam','bmandyam','2016-05-06 12:46:46','Logged Out'),('bmandyam','bmandyam','2016-05-06 12:48:46','Logged In'),('','','2016-05-06 12:56:35','Logged Out'),('bmandyam','bmandyam','2016-05-06 12:56:46','Logged In'),('bmandyam','bmandyam','2016-05-06 14:33:24','Logged Out'),('bmandyam','bmandyam','2016-05-06 14:33:33','Logged In'),('bmandyam','bmandyam','2016-05-06 17:00:45','Logged Out'),('bmandyam','bmandyam','2016-05-06 17:01:54','Logged In'),('bmandyam','bmandyam','2016-05-06 19:07:02','Logged Out'),('bmandyam','bmandyam','2016-05-09 10:02:57','Logged In'),('bmandyam','bmandyam','2016-05-09 10:35:16','Logged Out'),('bmandyam','bmandyam','2016-05-09 10:35:26','Logged In'),('bmandyam','bmandyam','2016-05-09 10:35:30','Logged In'),('bmandyam','bmandyam','2016-05-09 10:46:11','Logged In'),('sa','sa','2016-05-09 13:11:45','Logged In'),('sa','sa','2016-05-09 13:16:22','Logged Out'),('','','2016-05-09 13:16:26','Logged Out'),('bmandyam','bmandyam','2016-05-09 13:16:38','Logged In'),('bmandyam','bmandyam','2016-05-09 16:21:28','Logged Out'),('','','2016-05-09 16:22:34','Logged Out'),('bmandyam','bmandyam','2016-05-09 16:22:49','Logged In'),('bmandyam','bmandyam','2016-05-09 16:27:16','Logged In'),('bmandyam','bmandyam','2016-05-09 18:30:32','Logged Out'),('sa','sa','2016-05-09 18:30:44','Logged In'),('sa','sa','2016-05-09 18:30:51','Logged Out'),('bmandyam','bmandyam','2016-05-09 18:31:10','Logged In'),('bmandyam','bmandyam','2016-05-09 19:06:40','Logged Out'),('bmandyam','bmandyam','2016-05-10 10:26:06','Logged In'),('bmandyam','bmandyam','2016-05-10 11:53:46','Logged Out'),('bmandyam','bmandyam','2016-05-10 11:54:34','Logged In'),('bmandyam','bmandyam','2016-05-10 12:08:14','Logged In'),('bmandyam','bmandyam','2016-05-10 14:27:09','Logged Out'),('','','2016-05-10 14:27:16','Logged Out'),('bmandyam','bmandyam','2016-05-10 14:27:30','Logged In'),('bmandyam','bmandyam','2016-05-11 09:57:52','Logged In'),('bmandyam','bmandyam','2016-05-11 15:08:55','Logged Out'),('bmandyam','bmandyam','2016-05-11 15:09:14','Logged In'),('bmandyam','bmandyam','2016-05-12 09:58:10','Logged In'),('bmandyam','bmandyam','2016-05-12 12:48:20','Logged Out'),('sa','sa','2016-05-12 12:48:28','Logged In'),('sa','sa','2016-05-12 12:49:21','Logged Out'),('bmandyam','bmandyam','2016-05-12 12:49:39','Logged In'),('bmandyam','bmandyam','2016-05-12 18:55:32','Logged Out'),('bmandyam','bmandyam','2016-05-12 18:55:43','Logged In'),('bmandyam','bmandyam','2016-05-12 19:16:40','Logged Out'),('','','2016-05-12 19:16:47','Logged Out'),('bmandyam','bmandyam','2016-05-13 10:05:48','Logged In'),('bmandyam','bmandyam','2016-05-13 19:55:00','Logged Out'),('bmandyam','bmandyam','2016-05-16 09:58:15','Logged In'),('bmandyam','bmandyam','2016-05-16 16:30:40','Logged Out'),('bmandyam','bmandyam','2016-05-16 16:30:49','Logged In'),('bmandyam','bmandyam','2016-05-16 18:58:51','Logged Out'),('','','2016-05-16 18:58:57','Logged Out'),('bmandyam','bmandyam','2016-05-16 18:59:28','Logged In'),('bmandyam','bmandyam','2016-05-16 19:02:12','Logged Out'),('bmandyam','bmandyam','2016-05-16 19:08:14','Logged In'),('bmandyam','bmandyam','2016-05-17 10:03:48','Logged In'),('bmandyam','bmandyam','2016-05-17 12:26:25','Logged Out'),('','','2016-05-17 12:26:29','Logged Out'),('','','2016-05-17 12:29:07','Logged Out'),('bmandyam','bmandyam','2016-05-17 14:30:19','Logged In'),('bmandyam','bmandyam','2016-05-17 14:34:03','Logged Out'),('bmandyam','bmandyam','2016-05-17 14:34:49','Logged In'),('bmandyam','bmandyam','2016-05-17 14:43:55','Logged Out'),('bmandyam','bmandyam','2016-05-17 15:51:43','Logged In'),('bmandyam','bmandyam','2016-05-17 16:29:49','Logged In'),('bmandyam','bmandyam','2016-05-17 17:04:31','Logged Out'),('','','2016-05-17 17:04:36','Logged Out'),('bmandyam','bmandyam','2016-05-17 17:04:49','Logged In'),('bmandyam','bmandyam','2016-05-17 17:05:03','Logged In'),('bmandyam','bmandyam','2016-05-17 18:26:05','Logged Out'),('','','2016-05-17 18:26:12','Logged Out'),('bmandyam','bmandyam','2016-05-17 18:26:20','Logged In'),('bmandyam','bmandyam','2016-05-17 19:04:34','Logged Out'),('bmandyam','bmandyam','2016-05-18 10:09:54','Logged In'),('','','2016-05-18 10:12:40','Logged Out'),('bmandyam','bmandyam','2016-05-18 10:12:49','Logged In'),('sa','sa','2016-05-18 11:31:16','Logged In'),('sa','sa','2016-05-18 11:34:48','Logged In'),('sa','sa','2016-05-18 11:38:13','Logged Out'),('','','2016-05-18 11:38:21','Logged Out'),('bmandyam','bmandyam','2016-05-18 11:38:29','Logged In'),('bmandyam','bmandyam','2016-05-18 16:00:29','Logged Out'),('sa','sa','2016-05-18 16:00:37','Logged In'),('sa','sa','2016-05-18 16:01:09','Logged Out'),('bmandyam','bmandyam','2016-05-18 16:01:17','Logged In'),('bmandyam','bmandyam','2016-05-19 10:06:35','Logged In'),('bmandyam','bmandyam','2016-05-19 15:37:43','Logged In'),('bmandyam','bmandyam','2016-05-19 15:47:18','Logged Out'),('bmandyam','bmandyam','2016-05-19 16:02:33','Logged In'),('bmandyam','bmandyam','2016-05-19 16:35:21','Logged Out'),('sa','sa','2016-05-19 16:35:29','Logged In'),('sa','sa','2016-05-19 16:35:38','Logged Out'),('bmandyam','bmandyam','2016-05-19 16:35:46','Logged In'),('bmandyam','bmandyam','2016-05-19 18:29:28','Logged In'),('bmandyam','bmandyam','2016-05-19 19:08:01','Logged Out'),('bmandyam','bmandyam','2016-05-20 10:03:25','Logged In'),('bmandyam','bmandyam','2016-05-20 12:39:56','Logged Out'),('bmandyam','bmandyam','2016-05-20 12:40:03','Logged In'),('accounts','accounts','2016-05-20 13:39:24','Logged Out'),('bmandyam','bmandyam','2016-05-20 15:18:07','Logged In'),('bmandyam','bmandyam','2016-05-20 15:18:50','Logged In'),('bmandyam','bmandyam','2016-05-20 15:36:34','Logged In'),('bmandyam','bmandyam','2016-05-20 19:00:54','Logged Out'),('bmandyam','bmandyam','2016-05-23 10:01:54','Logged In'),('bmandyam','bmandyam','2016-05-23 10:32:14','Logged In'),('accounts','accounts','2016-05-23 12:15:57','Logged Out'),('bmandyam','bmandyam','2016-05-23 12:16:06','Logged In'),('bmandyam','bmandyam','2016-05-23 12:22:58','Logged Out'),('bmandyam','bmandyam','2016-05-23 12:39:33','Logged In'),('accounts','accounts','2016-05-23 13:15:56','Logged Out'),('bmandyam','bmandyam','2016-05-23 13:16:08','Logged In'),('bmandyam','bmandyam','2016-05-23 14:26:03','Logged In'),('bmandyam','bmandyam','2016-05-23 14:42:57','Logged In'),('bmandyam','bmandyam','2016-05-23 15:22:03','Logged In'),('accounts','accounts','2016-05-23 15:31:21','Logged Out'),('bmandyam','bmandyam','2016-05-23 15:31:31','Logged In'),('bmandyam','bmandyam','2016-05-23 15:49:51','Logged Out'),('bmandyam','bmandyam','2016-05-23 16:19:01','Logged In'),('bmandyam','bmandyam','2016-05-23 16:50:57','Logged In'),('bmandyam','bmandyam','2016-05-23 19:02:03','Logged Out'),('','','2016-05-23 19:02:05','Logged Out'),('','','2016-05-23 19:02:09','Logged Out'),('bmandyam','bmandyam','2016-05-24 09:58:42','Logged In'),('bmandyam','bmandyam','2016-05-24 17:50:27','Logged In'),('bmandyam','bmandyam','2016-05-24 18:58:19','Logged Out'),('bmandyam','bmandyam','2016-05-24 18:58:31','Logged In'),('bmandyam','bmandyam','2016-05-24 19:13:12','Logged In'),('bmandyam','bmandyam','2016-05-25 10:00:36','Logged In'),('bmandyam','bmandyam','2016-05-25 14:49:05','Logged In'),('bmandyam','bmandyam','2016-05-25 15:13:59','Logged In'),('bmandyam','bmandyam','2016-05-25 15:50:51','Logged In'),('bmandyam','bmandyam','2016-05-25 16:17:41','Logged Out'),('bmandyam','bmandyam','2016-05-25 16:17:50','Logged In'),('bmandyam','bmandyam','2016-05-25 16:26:16','Logged In'),('bmandyam','bmandyam','2016-05-25 16:31:27','Logged In'),('bmandyam','bmandyam','2016-05-25 19:06:55','Logged Out'),('','','2016-05-25 19:07:08','Logged Out'),('bmandyam','bmandyam','2016-05-26 09:54:39','Logged In'),('','','2016-05-26 11:08:31','Logged Out'),('','','2016-05-26 11:08:47','Logged Out'),('bmandyam','bmandyam','2016-05-26 11:08:55','Logged In'),('bmandyam','bmandyam','2016-05-26 11:13:03','Logged In'),('bmandyam','bmandyam','2016-05-26 15:43:52','Logged Out'),('bmandyam','bmandyam','2016-05-26 15:47:50','Logged In'),('bmandyam','bmandyam','2016-05-26 19:03:33','Logged Out'),('bmandyam','bmandyam','2016-05-27 10:03:49','Logged In'),('bmandyam','bmandyam','2016-05-27 11:42:30','Logged In'),('bmandyam','bmandyam','2016-05-27 18:52:35','Logged Out'),('','','2016-05-27 18:53:03','Logged Out'),('bmandyam','bmandyam','2016-05-30 10:03:57','Logged In'),('bmandyam','bmandyam','2016-05-30 10:04:05','Logged Out'),('bmandyam','bmandyam','2016-05-30 10:04:44','Logged In'),('bmandyam','bmandyam','2016-05-30 11:23:35','Logged In'),('bmandyam','bmandyam','2016-05-30 14:30:30','Logged In'),('bmandyam','bmandyam','2016-05-30 14:45:21','Logged Out'),('bmandyam','bmandyam','2016-05-30 14:53:56','Logged In'),('qas','qas','2016-05-30 15:06:53','Logged Out'),('bmandyam','bmandyam','2016-05-30 17:58:05','Logged In'),('bmandyam','bmandyam','2016-05-30 18:51:14','Logged Out'),('sa','sa','2016-05-30 18:51:21','Logged In'),('sa','sa','2016-05-30 18:51:59','Logged Out'),('sa','sa','2016-05-30 18:52:05','Logged In'),('sa','sa','2016-05-30 18:52:25','Logged Out'),('bmandyam','bmandyam','2016-05-30 18:52:32','Logged In'),('bmandyam','bmandyam','2016-05-30 18:52:38','Logged Out'),('sa','sa','2016-05-30 18:52:45','Logged In'),('sa','sa','2016-05-30 18:52:57','Logged Out'),('','','2016-05-30 18:53:00','Logged Out'),('bmandyam','bmandyam','2016-05-30 18:53:09','Logged In'),('sa','sa','2016-05-30 18:53:21','Logged In'),('sa','sa','2016-05-30 18:53:39','Logged Out'),('bmandyam','bmandyam','2016-05-30 18:53:55','Logged In'),('bmandyam','bmandyam','2016-05-30 19:05:35','Logged Out'),('bmandyam','bmandyam','2016-05-31 10:05:04','Logged In'),('bmandyam','bmandyam','2016-05-31 10:39:39','Logged Out'),('','','2016-05-31 10:39:42','Logged Out'),('bmandyam','bmandyam','2016-06-01 16:48:48','Logged In'),('bmandyam','bmandyam','2016-06-01 17:06:50','Logged Out'),('bmandyam','bmandyam','2016-06-01 17:37:00','Logged In'),('bmandyam','bmandyam','2016-06-02 10:25:29','Logged In'),('bmandyam','bmandyam','2016-06-02 12:28:40','Logged In'),('bmandyam','bmandyam','2016-06-02 16:12:37','Logged In'),('bmandyam','bmandyam','2016-06-02 17:42:52','Logged Out'),('','','2016-06-02 17:42:55','Logged Out'),('bmandyam','bmandyam','2016-06-03 12:36:07','Logged In'),('bmandyam','bmandyam','2016-06-03 15:45:03','Logged Out'),('bmandyam','bmandyam','2016-06-08 18:08:15','Logged In'),('bmandyam','bmandyam','2016-06-08 19:04:45','Logged Out'),('bmandyam','bmandyam','2016-06-13 09:58:22','Logged In'),('bmandyam','bmandyam','2016-06-13 11:05:05','Logged Out'),('bmandyam','bmandyam','2016-06-21 12:19:23','Logged In'),('bmandyam','bmandyam','2016-06-23 15:02:31','Logged In'),('bmandyam','bmandyam','2016-06-23 15:21:39','Logged Out'),('bmandyam','bmandyam','2016-06-23 15:28:25','Logged In'),('bmandyam','bmandyam','2016-06-23 15:36:12','Logged Out'),('bmandyam','bmandyam','2016-06-23 15:39:14','Logged In'),('bmandyam','bmandyam','2016-06-23 16:33:18','Logged Out'),('bmandyam','bmandyam','2016-06-23 16:33:26','Logged In'),('bmandyam','bmandyam','2016-06-23 16:35:01','Logged In'),('bmandyam','bmandyam','2016-06-23 17:55:05','Logged Out'),('','','2016-06-23 18:50:41','Logged Out'),('bmandyam','bmandyam','2016-06-23 18:50:51','Logged In'),('bmandyam','bmandyam','2016-06-23 19:05:59','Logged In'),('bmandyam','bmandyam','2016-06-23 19:08:35','Logged Out'),('','','2016-06-23 19:08:43','Logged Out'),('bmandyam','bmandyam','2016-06-24 09:56:14','Logged In'),('bmandyam','bmandyam','2016-06-24 10:08:56','Logged Out'),('','','2016-06-24 13:07:36','Logged Out'),('bmandyam','bmandyam','2016-06-24 13:07:46','Logged In'),('bmandyam','bmandyam','2016-06-24 14:19:33','Logged In'),('bmandyam','bmandyam','2016-06-24 14:35:00','Logged Out'),('','','2016-06-24 14:35:08','Logged Out'),('','','2016-06-24 15:03:40','Logged Out'),('bmandyam','bmandyam','2016-06-24 15:04:04','Logged In'),('bmandyam','bmandyam','2016-06-24 15:14:09','Logged Out'),('','','2016-06-24 15:17:48','Logged Out'),('bmandyam','bmandyam','2016-06-24 15:17:57','Logged In'),('bmandyam','bmandyam','2016-06-24 16:04:40','Logged Out'),('','','2016-06-24 16:51:47','Logged Out'),('bmandyam','bmandyam','2016-06-24 16:51:57','Logged In'),('bmandyam','bmandyam','2016-06-24 16:52:04','Logged In'),('','','2016-06-24 18:54:14','Logged Out'),('','','2016-06-24 18:54:22','Logged Out'),('bmandyam','bmandyam','2016-06-24 18:54:31','Logged In'),('bmandyam','bmandyam','2016-06-24 19:11:40','Logged Out'),('bmandyam','bmandyam','2016-06-27 09:57:11','Logged In'),('bmandyam','bmandyam','2016-06-27 10:34:54','Logged Out'),('','','2016-06-27 10:34:58','Logged Out'),('','','2016-06-27 10:36:46','Logged Out'),('bmandyam','bmandyam','2016-06-27 10:36:54','Logged In'),('bmandyam','bmandyam','2016-06-27 12:27:24','Logged Out'),('bmandyam','bmandyam','2016-06-27 14:26:02','Logged In'),('bmandyam','bmandyam','2016-06-27 16:02:23','Logged In'),('bmandyam','bmandyam','2016-06-27 16:02:55','Logged In'),('','','2016-06-27 17:32:43','Logged Out'),('','','2016-06-27 17:35:16','Logged Out'),('bmandyam','bmandyam','2016-06-27 17:35:26','Logged In'),('bmandyam','bmandyam','2016-06-27 17:44:35','Logged Out'),('bmandyam','bmandyam','2016-06-27 18:32:33','Logged In'),('bmandyam','bmandyam','2016-06-27 19:02:55','Logged Out'),('','','2016-06-27 19:02:58','Logged Out'),('','','2016-06-27 19:03:01','Logged Out'),('bmandyam','bmandyam','2016-06-28 10:05:18','Logged In'),('bmandyam','bmandyam','2016-06-28 10:50:54','Logged Out'),('','','2016-06-28 10:50:58','Logged Out'),('bmandyam','bmandyam','2016-06-28 10:52:06','Logged In'),('bmandyam','bmandyam','2016-06-28 11:01:55','Logged In'),('bmandyam','bmandyam','2016-06-28 11:02:29','Logged In'),('bmandyam','bmandyam','2016-06-28 11:03:27','Logged Out'),('','','2016-06-28 11:05:19','Logged Out'),('bmandyam','bmandyam','2016-06-28 11:08:39','Logged In'),('bmandyam','bmandyam','2016-06-28 11:08:51','Logged In'),('bmandyam','bmandyam','2016-06-28 11:10:20','Logged In'),('bmandyam','bmandyam','2016-06-28 11:10:38','Logged In'),('bmandyam','bmandyam','2016-06-28 11:11:32','Logged Out'),('bmandyam','bmandyam','2016-06-28 11:11:45','Logged In'),('bmandyam','bmandyam','2016-06-28 11:25:06','Logged In'),('bmandyam','bmandyam','2016-06-28 11:32:31','Logged Out'),('bmandyam','bmandyam','2016-06-28 11:40:55','Logged In'),('bmandyam','bmandyam','2016-06-28 14:50:20','Logged Out'),('bmandyam','bmandyam','2016-06-28 15:12:32','Logged In'),('bmandyam','bmandyam','2016-06-28 18:02:42','Logged Out'),('','','2016-06-28 18:02:46','Logged Out'),('','','2016-06-28 18:02:53','Logged Out'),('','','2016-06-28 18:03:03','Logged Out'),('bmandyam','bmandyam','2016-06-28 18:03:16','Logged In'),('bmandyam','bmandyam','2016-06-28 18:50:12','Logged In'),('bmandyam','bmandyam','2016-06-28 18:58:47','Logged Out'),('','','2016-06-28 18:58:52','Logged Out'),('bmandyam','bmandyam','2016-06-29 09:49:59','Logged In'),('bmandyam','bmandyam','2016-06-29 11:13:44','Logged Out'),('','','2016-06-29 11:13:48','Logged Out'),('','','2016-06-29 11:13:51','Logged Out'),('bmandyam','bmandyam','2016-06-29 11:14:09','Logged In'),('','','2016-06-29 13:20:15','Logged Out'),('bmandyam','bmandyam','2016-06-29 13:20:41','Logged In'),('','','2016-06-29 15:09:09','Logged Out'),('','','2016-06-29 15:09:14','Logged Out'),('bmandyam','bmandyam','2016-06-29 15:09:31','Logged In'),('bmandyam','bmandyam','2016-06-29 19:01:32','Logged Out'),('bmandyam','bmandyam','2016-06-30 09:57:33','Logged In'),('','','2016-06-30 11:02:13','Logged Out'),('bmandyam','bmandyam','2016-06-30 11:02:34','Logged In'),('bmandyam','bmandyam','2016-06-30 11:26:59','Logged In'),('','','2016-06-30 12:11:15','Logged Out'),('bmandyam','bmandyam','2016-06-30 12:11:27','Logged In'),('bmandyam','bmandyam','2016-06-30 19:03:44','Logged Out'),('','','2016-06-30 19:03:51','Logged Out'),('','','2016-06-30 19:03:54','Logged Out'),('','','2016-07-01 10:04:09','Logged Out'),('bmandyam','bmandyam','2016-07-01 10:04:17','Logged In'),('bmandyam','bmandyam','2016-07-01 10:26:30','Logged Out'),('shantala','shantala','2016-07-01 11:52:15','Logged Out'),('','','2016-07-01 11:54:47','Logged Out'),('bmandyam','bmandyam','2016-07-01 11:54:55','Logged In'),('bmandyam','bmandyam','2016-07-01 12:40:58','Logged Out'),('sa','sa','2016-07-01 12:41:13','Logged In'),('sa','sa','2016-07-01 12:43:14','Logged Out'),('bmandyam','bmandyam','2016-07-01 12:43:23','Logged In'),('bmandyam','bmandyam','2016-07-01 14:25:22','Logged Out'),('bmandyam','bmandyam','2016-07-01 14:32:10','Logged In'),('bmandyam','bmandyam','2016-07-01 14:36:29','Logged Out'),('','','2016-07-01 14:55:20','Logged Out'),('bmandyam','bmandyam','2016-07-01 14:55:42','Logged In'),('bmandyam','bmandyam','2016-07-01 15:29:07','Logged Out'),('bmandyam','bmandyam','2016-07-01 16:41:47','Logged In'),('bmandyam','bmandyam','2016-07-01 18:06:35','Logged Out'),('','','2016-07-01 18:06:40','Logged Out'),('','','2016-07-01 18:16:27','Logged Out'),('bmandyam','bmandyam','2016-07-01 18:16:43','Logged In'),('bmandyam','bmandyam','2016-07-01 18:16:57','Logged In'),('bmandyam','bmandyam','2016-07-01 18:30:28','Logged In'),('bmandyam','bmandyam','2016-07-01 18:53:44','Logged Out'),('bmandyam','bmandyam','2016-07-01 18:54:00','Logged In'),('bmandyam','bmandyam','2016-07-01 18:58:26','Logged Out'),('bmandyam','bmandyam','2016-07-01 19:11:29','Logged In'),('bmandyam','bmandyam','2016-07-01 19:11:53','Logged Out'),('bmandyam','bmandyam','2016-07-04 10:42:05','Logged In'),('bmandyam','bmandyam','2016-07-04 13:08:14','Logged Out'),('','','2016-07-04 13:08:17','Logged Out'),('bmandyam','bmandyam','2016-07-04 13:08:34','Logged In'),('bmandyam','bmandyam','2016-07-04 16:43:05','Logged In'),('ashorroc','ashorrock','2016-07-04 18:10:59','Logged Out'),('bmandyam','bmandyam','2016-07-04 18:11:08','Logged In'),('bmandyam','bmandyam','2016-07-04 19:10:34','Logged Out'),('bmandyam','bmandyam','2016-07-05 09:57:59','Logged In'),('','','2016-07-05 11:48:37','Logged Out'),('','','2016-07-05 11:48:42','Logged Out'),('bmandyam','bmandyam','2016-07-05 11:48:50','Logged In'),('bmandyam','bmandyam','2016-07-05 12:43:22','Logged Out'),('','','2016-07-05 12:43:25','Logged Out'),('bmandyam','bmandyam','2016-07-05 12:44:39','Logged Out'),('','','2016-07-05 14:18:40','Logged Out'),('bmandyam','bmandyam','2016-07-05 14:19:02','Logged In'),('bmandyam','bmandyam','2016-07-05 15:07:33','Logged In'),('','','2016-07-06 10:04:35','Logged Out'),('bmandyam','bmandyam','2016-07-06 10:04:43','Logged In'),('bmandyam','bmandyam','2016-07-06 15:11:15','Logged Out'),('','','2016-07-06 18:48:45','Logged Out'),('bmandyam','bmandyam','2016-07-06 18:48:54','Logged In'),('bmandyam','bmandyam','2016-07-06 18:54:40','Logged Out'),('bmandyam','bmandyam','2016-07-07 10:06:27','Logged In'),('bmandyam','bmandyam','2016-07-07 15:34:00','Logged Out'),('','','2016-07-07 15:36:09','Logged Out'),('bmandyam','bmandyam','2016-07-07 15:36:19','Logged In'),('bmandyam','bmandyam','2016-07-07 15:46:45','Logged Out'),('bmandyam','bmandyam','2016-07-07 15:52:18','Logged In'),('bmandyam','bmandyam','2016-07-07 19:00:13','Logged Out'),('','','2016-07-07 19:00:16','Logged Out'),('bmandyam','bmandyam','2016-07-08 10:10:04','Logged In'),('','','2016-07-08 13:02:55','Logged Out'),('','','2016-07-08 14:31:41','Logged Out'),('bmandyam','bmandyam','2016-07-08 14:32:05','Logged In'),('bmandyam','bmandyam','2016-07-08 18:59:44','Logged Out'),('bmandyam','bmandyam','2016-07-11 10:00:14','Logged In'),('bmandyam','bmandyam','2016-07-11 11:13:33','Logged In'),('bmandyam','bmandyam','2016-07-12 18:02:18','Logged In'),('bmandyam','bmandyam','2016-07-12 18:51:11','Logged Out'),('bmandyam','bmandyam','2016-07-13 17:06:58','Logged In'),('','','2016-07-13 17:10:55','Logged Out'),('bmandyam','bmandyam','2016-07-13 17:26:52','Logged In'),('ami','ami','2016-07-13 17:40:12','Logged Out'),('bmandyam','bmandyam','2016-07-13 18:27:50','Logged In'),('sa','sa','2016-07-13 18:45:41','Logged In'),('sa','sa','2016-07-13 18:45:53','Logged Out'),('bmandyam','bmandyam','2016-07-13 18:48:07','Logged In'),('bmandyam','bmandyam','2016-07-13 19:01:15','Logged Out'),('bmandyam','bmandyam','2016-07-13 19:01:29','Logged In'),('bmandyam','bmandyam','2016-07-13 19:02:15','Logged Out'),('bmandyam','bmandyam','2016-07-18 17:05:33','Logged In'),('bmandyam','bmandyam','2016-07-18 18:48:04','Logged Out'),('bmandyam','bmandyam','2016-07-20 11:19:10','Logged In'),('bmandyam','bmandyam','2016-07-22 15:28:25','Logged In'),('bmandyam','bmandyam','2016-07-22 18:47:58','Logged Out'),('bmandyam','bmandyam','2016-07-25 17:57:26','Logged In'),('bmandyam','bmandyam','2016-07-25 17:57:42','Logged Out'),('bmandyam','bmandyam','2016-07-25 17:57:50','Logged In'),('bmandyam','bmandyam','2016-07-25 17:57:57','Logged Out'),('bmandyam','bmandyam','2016-07-25 17:58:07','Logged In'),('bmandyam','bmandyam','2016-07-25 17:58:13','Logged Out'),('bmandyam','bmandyam','2016-07-26 11:07:09','Logged In'),('bmandyam','bmandyam','2016-07-28 11:00:45','Logged In'),('','','2016-07-28 12:19:24','Logged Out'),('','','2016-07-28 12:19:28','Logged Out'),('','','2016-07-28 12:19:33','Logged Out'),('','','2016-07-28 12:19:40','Logged Out'),('','','2016-07-28 12:19:44','Logged Out'),('bmandyam','bmandyam','2016-07-28 12:19:52','Logged In'),('bmandyam','bmandyam','2016-07-28 15:03:32','Logged Out'),('','','2016-07-28 15:03:42','Logged Out'),('','','2016-07-28 15:03:46','Logged Out'),('bmandyam','bmandyam','2016-07-28 15:03:57','Logged In'),('bmandyam','bmandyam','2016-07-28 15:08:15','Logged Out'),('bmandyam','bmandyam','2016-07-28 15:22:01','Logged In'),('bmandyam','bmandyam','2016-07-28 15:34:59','Logged Out'),('bmandyam','bmandyam','2016-07-28 15:45:05','Logged In'),('bmandyam','bmandyam','2016-07-28 16:09:50','Logged Out'),('','','2016-07-28 16:09:59','Logged Out'),('','','2016-07-28 16:10:02','Logged Out'),('','','2016-07-28 16:10:04','Logged Out'),('','','2016-07-28 16:10:12','Logged Out'),('bmandyam','bmandyam','2016-07-28 16:56:07','Logged In'),('ashorroc','ashorrock','2016-07-28 17:11:00','Logged Out'),('bmandyam','bmandyam','2016-07-28 17:11:08','Logged In'),('','','2016-07-28 18:11:20','Logged Out'),('bmandyam','bmandyam','2016-07-28 18:11:36','Logged In'),('bmandyam','bmandyam','2016-07-28 18:43:22','Logged Out'),('','','2016-07-28 18:43:26','Logged Out'),('','','2016-07-28 18:51:28','Logged Out'),('bmandyam','bmandyam','2016-07-29 10:07:20','Logged In'),('bmandyam','bmandyam','2016-07-29 10:46:54','Logged Out'),('','','2016-07-29 14:19:58','Logged Out'),('bmandyam','bmandyam','2016-07-29 14:20:06','Logged In'),('ashorroc','ashorrock','2016-07-29 15:54:40','Logged Out'),('bmandyam','bmandyam','2016-07-29 15:54:50','Logged In'),('bmandyam','bmandyam','2016-07-29 18:16:58','Logged Out'),('bmandyam','bmandyam','2016-08-01 10:09:28','Logged In'),('bmandyam','bmandyam','2016-08-01 10:24:12','Logged Out'),('','','2016-08-03 10:12:30','Logged Out'),('bmandyam','bmandyam','2016-08-03 10:12:52','Logged In'),('bmandyam','bmandyam','2016-08-03 15:28:21','Logged Out'),('','','2016-08-03 15:28:24','Logged Out'),('','','2016-08-03 15:28:27','Logged Out'),('bmandyam','bmandyam','2016-08-03 15:28:48','Logged In'),('bmandyam','bmandyam','2016-08-03 15:31:16','Logged Out'),('bmandyam','bmandyam','2016-08-08 15:32:09','Logged In'),('bmandyam','bmandyam','2016-08-08 17:58:50','Logged In'),('','','2016-08-08 18:57:41','Logged Out'),('bmandyam','bmandyam','2016-08-08 18:57:50','Logged In'),('bmandyam','bmandyam','2016-08-08 18:57:53','Logged Out'),('bmandyam','bmandyam','2016-08-09 10:56:30','Logged In'),('bmandyam','bmandyam','2016-08-09 10:56:34','Logged Out'),('','','2016-08-09 10:57:39','Logged Out'),('bmandyam','bmandyam','2016-08-09 11:04:14','Logged In'),('bmandyam','bmandyam','2016-08-09 11:04:47','Logged Out'),('','','2016-08-09 11:09:59','Logged Out'),('bmandyam','bmandyam','2016-08-09 11:12:58','Logged In'),('bmandyam','bmandyam','2016-08-09 11:43:13','Logged Out'),('bmandyam','bmandyam','2016-08-09 11:43:23','Logged In'),('bmandyam','bmandyam','2016-08-09 11:43:48','Logged In'),('bmandyam','bmandyam','2016-08-09 11:44:03','Logged In'),('bmandyam','bmandyam','2016-08-09 11:50:18','Logged In'),('bmandyam','bmandyam','2016-08-09 11:53:09','Logged In'),('bmandyam','bmandyam','2016-08-09 11:53:21','Logged In'),('bmandyam','bmandyam','2016-08-09 11:57:11','Logged In'),('bmandyam','bmandyam','2016-08-09 11:57:19','Logged In'),('bmandyam','bmandyam','2016-08-09 11:57:27','Logged In'),('bmandyam','bmandyam','2016-08-09 11:58:25','Logged In'),('bmandyam','bmandyam','2016-08-09 11:58:34','Logged In'),('bmandyam','bmandyam','2016-08-09 11:58:51','Logged In'),('bmandyam','bmandyam','2016-08-09 12:03:02','Logged In'),('bmandyam','bmandyam','2016-08-09 12:03:06','Logged In'),('bmandyam','bmandyam','2016-08-09 12:39:46','Logged In'),('bmandyam','bmandyam','2016-08-09 12:54:09','Logged In'),('bmandyam','bmandyam','2016-08-09 13:05:20','Logged Out'),('','','2016-08-09 13:05:49','Logged Out'),('bmandyam','bmandyam','2016-08-09 13:07:01','Logged In'),('bmandyam','bmandyam','2016-08-09 13:07:15','Logged In'),('bmandyam','bmandyam','2016-08-09 14:39:34','Logged In'),('bmandyam','bmandyam','2016-08-09 18:27:19','Logged In'),('bmandyam','bmandyam','2016-08-09 18:33:43','Logged In'),('bmandyam','bmandyam','2016-08-09 18:55:33','Logged Out'),('','','2016-08-09 18:55:46','Logged Out'),('bmandyam','bmandyam','2016-08-09 18:57:57','Logged In'),('bmandyam','bmandyam','2016-08-09 19:03:41','Logged Out'),('bmandyam','bmandyam','2016-08-10 10:00:36','Logged In'),('bmandyam','bmandyam','2016-08-10 10:34:58','Logged In'),('bmandyam','bmandyam','2016-08-10 19:01:52','Logged Out'),('bmandyam','bmandyam','2016-08-11 10:13:35','Logged In'),('bmandyam','bmandyam','2016-08-11 13:07:21','Logged In'),('bmandyam','bmandyam','2016-08-11 18:29:08','Logged In'),('bmandyam','bmandyam','2016-08-11 18:46:33','Logged Out'),('','','2016-08-11 18:46:38','Logged Out'),('','','2016-08-11 18:46:43','Logged Out'),('bmandyam','bmandyam','2016-08-12 10:12:52','Logged In'),('bmandyam','bmandyam','2016-08-12 10:21:41','Logged In'),('bmandyam','bmandyam','2016-08-12 18:19:04','Logged In'),('bmandyam','bmandyam','2016-08-12 18:24:00','Logged In'),('','','2016-08-12 18:37:22','Logged Out'),('','','2016-08-12 18:37:27','Logged Out'),('bmandyam','bmandyam','2016-08-16 09:56:38','Logged In'),('bmandyam','bmandyam','2016-08-16 09:57:47','Logged In'),('bmandyam','bmandyam','2016-08-16 11:04:54','Logged In'),('bmandyam','bmandyam','2016-08-16 13:28:42','Logged In'),('','','2016-08-16 15:53:54','Logged Out'),('bmandyam','bmandyam','2016-08-16 15:54:07','Logged In'),('bmandyam','bmandyam','2016-08-16 17:19:00','Logged Out'),('shantala','shantala','2016-08-16 17:24:29','Logged Out'),('bmandyam','bmandyam','2016-08-16 17:24:43','Logged In'),('bmandyam','bmandyam','2016-08-16 17:56:03','Logged In'),('shantala','shantala','2016-08-16 18:11:04','Logged Out'),('bmandyam','bmandyam','2016-08-16 18:11:38','Logged In'),('engapp','engapp','2016-08-16 18:24:53','Logged Out'),('bmandyam','bmandyam','2016-08-16 18:25:06','Logged In'),('bmandyam','bmandyam','2016-08-16 18:25:13','Logged In'),('bmandyam','bmandyam','2016-08-16 18:29:08','Logged In'),('bmandyam','bmandyam','2016-08-16 18:56:03','Logged Out'),('','','2016-08-16 18:56:07','Logged Out'),('','','2016-08-16 18:56:22','Logged Out'),('bmandyam','bmandyam','2016-08-17 10:06:52','Logged In'),('bmandyam','bmandyam','2016-08-17 10:11:15','Logged In'),('','','2016-08-17 10:35:07','Logged Out'),('bmandyam','bmandyam','2016-08-17 10:35:25','Logged In'),('bmandyam','bmandyam','2016-08-17 11:22:37','Logged Out'),('engapp','engapp','2016-08-17 11:49:42','Logged Out'),('bmandyam','bmandyam','2016-08-17 11:49:50','Logged In'),('','','2016-08-17 14:28:19','Logged Out'),('bmandyam','bmandyam','2016-08-17 14:28:29','Logged In'),('bmandyam','bmandyam','2016-08-18 09:53:24','Logged In'),('bmandyam','bmandyam','2016-08-18 19:04:54','Logged Out'),('bmandyam','bmandyam','2016-08-19 09:54:58','Logged In'),('bmandyam','bmandyam','2016-08-19 11:18:09','Logged In'),('bmandyam','bmandyam','2016-08-19 12:30:20','Logged In'),('bmandyam','bmandyam','2016-08-19 12:31:36','Logged In'),('bmandyam','bmandyam','2016-08-19 12:31:52','Logged In'),('bmandyam','bmandyam','2016-08-19 12:32:05','Logged In'),('','','2016-08-19 18:53:22','Logged Out'),('','','2016-08-19 18:53:28','Logged Out'),('bmandyam','bmandyam','2016-08-22 10:03:34','Logged In'),('bmandyam','bmandyam','2016-08-22 10:39:25','Logged In'),('bmandyam','bmandyam','2016-08-22 10:40:28','Logged In'),('bmandyam','bmandyam','2016-08-22 10:41:27','Logged In'),('bmandyam','bmandyam','2016-08-22 10:43:08','Logged In'),('bmandyam','bmandyam','2016-08-22 10:43:11','Logged In'),('bmandyam','bmandyam','2016-08-22 10:43:23','Logged In'),('bmandyam','bmandyam','2016-08-22 10:44:33','Logged In'),('bmandyam','bmandyam','2016-08-22 10:45:02','Logged In'),('bmandyam','bmandyam','2016-08-22 10:45:58','Logged In'),('bmandyam','bmandyam','2016-08-22 10:46:13','Logged In'),('bmandyam','bmandyam','2016-08-22 10:46:34','Logged In'),('bmandyam','bmandyam','2016-08-22 10:46:40','Logged In'),('bmandyam','bmandyam','2016-08-22 10:47:39','Logged In'),('bmandyam','bmandyam','2016-08-22 10:48:45','Logged In'),('bmandyam','bmandyam','2016-08-22 10:50:52','Logged In'),('bmandyam','bmandyam','2016-08-22 10:51:14','Logged In'),('bmandyam','bmandyam','2016-08-22 10:51:57','Logged In'),('bmandyam','bmandyam','2016-08-22 10:52:15','Logged In'),('bmandyam','bmandyam','2016-08-22 10:52:40','Logged In'),('bmandyam','bmandyam','2016-08-22 10:53:45','Logged In'),('bmandyam','bmandyam','2016-08-22 10:54:27','Logged In'),('bmandyam','bmandyam','2016-08-22 10:55:06','Logged In'),('bmandyam','bmandyam','2016-08-22 10:55:44','Logged In'),('bmandyam','bmandyam','2016-08-22 10:57:05','Logged In'),('bmandyam','bmandyam','2016-08-22 10:58:07','Logged In'),('bmandyam','bmandyam','2016-08-22 10:59:06','Logged In'),('bmandyam','bmandyam','2016-08-22 11:00:17','Logged In'),('bmandyam','bmandyam','2016-08-22 11:00:49','Logged In'),('bmandyam','bmandyam','2016-08-22 11:01:38','Logged In'),('bmandyam','bmandyam','2016-08-22 11:03:02','Logged In'),('bmandyam','bmandyam','2016-08-22 11:03:31','Logged In'),('bmandyam','bmandyam','2016-08-22 11:03:52','Logged In'),('bmandyam','bmandyam','2016-08-22 11:04:36','Logged In'),('bmandyam','bmandyam','2016-08-22 19:03:05','Logged Out'),('bmandyam','bmandyam','2016-08-23 10:03:13','Logged In'),('bmandyam','bmandyam','2016-08-23 10:04:26','Logged In'),('bmandyam','bmandyam','2016-08-23 12:38:19','Logged In'),('bmandyam','bmandyam','2016-08-23 14:28:08','Logged In'),('bmandyam','bmandyam','2016-08-23 14:29:58','Logged Out'),('bmandyam','bmandyam','2016-08-23 14:30:13','Logged In'),('bmandyam','bmandyam','2016-08-23 14:42:42','Logged In'),('bmandyam','bmandyam','2016-08-23 14:43:00','Logged In'),('bmandyam','bmandyam','2016-08-23 15:03:20','Logged In'),('ppc','ppc','2016-08-23 16:48:24','Logged Out'),('bmandyam','bmandyam','2016-08-23 16:48:39','Logged In'),('bmandyam','bmandyam','2016-08-23 17:50:09','Logged Out'),('','','2016-08-23 17:51:39','Logged Out'),('bmandyam','bmandyam','2016-08-23 17:52:13','Logged In'),('bmandyam','bmandyam','2016-08-23 17:52:59','Logged In'),('bmandyam','bmandyam','2016-08-23 17:53:26','Logged In'),('bmandyam','bmandyam','2016-08-23 17:54:19','Logged In'),('bmandyam','bmandyam','2016-08-23 17:54:24','Logged Out'),('bmandyam','bmandyam','2016-08-23 17:55:05','Logged In'),('bmandyam','bmandyam','2016-08-23 17:55:56','Logged In'),('bmandyam','bmandyam','2016-08-23 17:57:07','Logged In'),('bmandyam','bmandyam','2016-09-14 13:08:58','Logged In'),('bmandyam','bmandyam','2016-09-14 13:15:37','Logged In'),('bmandyam','bmandyam','2016-09-14 13:15:42','Logged In'),('bmandyam','bmandyam','2016-09-14 13:15:53','Logged In'),('bmandyam','bmandyam','2016-09-14 13:16:00','Logged In'),('bmandyam','bmandyam','2016-09-14 14:04:44','Logged In'),('bmandyam','bmandyam','2016-09-14 14:05:35','Logged In'),('bmandyam','bmandyam','2016-09-14 14:06:15','Logged In'),('bmandyam','bmandyam','2016-09-14 18:41:51','Logged In'),('bmandyam','bmandyam','2016-09-14 18:42:00','Logged In'),('bmandyam','bmandyam','2016-09-14 19:14:06','Logged Out'),('bmandyam','bmandyam','2016-09-15 09:52:05','Logged In'),('bmandyam','bmandyam','2016-09-15 14:59:54','Logged Out'),('bmandyam','bmandyam','2016-09-15 15:00:20','Logged In'),('bmandyam','bmandyam','2016-09-15 15:02:23','Logged In'),('bmandyam','bmandyam','2016-09-15 15:06:48','Logged In'),('bmandyam','bmandyam','2016-09-15 15:07:20','Logged In'),('bmandyam','bmandyam','2016-09-15 15:07:47','Logged In'),('bmandyam','bmandyam','2016-09-15 15:08:31','Logged In'),('bmandyam','bmandyam','2016-09-15 15:09:37','Logged In'),('bmandyam','bmandyam','2016-09-15 15:11:53','Logged In'),('bmandyam','bmandyam','2016-09-15 15:12:07','Logged In'),('bmandyam','bmandyam','2016-09-15 15:12:21','Logged In'),('bmandyam','bmandyam','2016-09-15 15:14:11','Logged In'),('bmandyam','bmandyam','2016-09-15 15:14:21','Logged In'),('bmandyam','bmandyam','2016-09-15 15:15:20','Logged In'),('bmandyam','bmandyam','2016-09-15 15:15:48','Logged In'),('bmandyam','bmandyam','2016-09-15 15:18:08','Logged In'),('bmandyam','bmandyam','2016-09-15 15:18:59','Logged In'),('bmandyam','bmandyam','2016-09-15 15:19:16','Logged In'),('bmandyam','bmandyam','2016-09-15 18:53:20','Logged In'),('','','2016-09-15 19:09:10','Logged Out'),('bmandyam','bmandyam','2016-09-17 10:23:07','Logged In'),('bmandyam','bmandyam','2016-09-19 10:06:38','Logged In'),('bmandyam','bmandyam','2016-09-19 10:09:53','Logged In'),('bmandyam','bmandyam','2016-09-19 10:10:10','Logged In'),('bmandyam','bmandyam','2016-09-19 10:12:44','Logged In'),('bmandyam','bmandyam','2016-09-19 10:13:52','Logged In'),('bmandyam','bmandyam','2016-09-19 10:14:07','Logged In'),('bmandyam','bmandyam','2016-09-19 10:14:22','Logged In'),('bmandyam','bmandyam','2016-09-19 10:14:49','Logged In'),('bmandyam','bmandyam','2016-09-19 10:15:06','Logged In'),('bmandyam','bmandyam','2016-09-19 10:16:21','Logged In'),('bmandyam','bmandyam','2016-09-19 10:17:29','Logged In'),('bmandyam','bmandyam','2016-09-19 10:17:45','Logged In'),('bmandyam','bmandyam','2016-09-19 10:22:32','Logged In'),('bmandyam','bmandyam','2016-09-19 10:23:45','Logged In'),('bmandyam','bmandyam','2016-09-19 10:25:44','Logged In'),('bmandyam','bmandyam','2016-09-19 10:26:21','Logged In'),('bmandyam','bmandyam','2016-09-19 10:26:56','Logged In'),('bmandyam','bmandyam','2016-09-19 10:27:16','Logged In'),('bmandyam','bmandyam','2016-09-19 10:28:29','Logged In'),('bmandyam','bmandyam','2016-09-19 10:41:03','Logged In'),('bmandyam','bmandyam','2016-09-19 10:45:12','Logged In'),('bmandyam','bmandyam','2016-09-19 10:46:51','Logged In'),('bmandyam','bmandyam','2016-09-19 10:47:37','Logged In'),('bmandyam','bmandyam','2016-09-19 11:32:14','Logged In'),('bmandyam','bmandyam','2016-09-19 11:33:01','Logged In'),('bman','bman','2016-09-19 12:46:43','Logged Out'),('bmandyam','bmandyam','2016-09-20 09:54:54','Logged In'),('bmandyam','bmandyam','2016-09-20 12:49:37','Logged Out'),('bmandyam','bmandyam','2016-09-20 12:51:17','Logged In'),('bmandyam','bmandyam','2016-09-22 10:47:12','Logged In'),('bmandyam','bmandyam','2016-09-22 12:18:45','Logged Out'),('bmandyam','bmandyam','2016-09-27 10:26:43','Logged In'),('bmandyam','bmandyam','2016-09-27 10:26:51','Logged In'),('bmandyam','bmandyam','2016-09-27 10:26:58','Logged In'),('bmandyam','bmandyam','2016-09-27 10:27:16','Logged In'),('bmandyam','bmandyam','2016-09-27 10:28:22','Logged In'),('bmandyam','bmandyam','2016-09-27 10:29:21','Logged In'),('bmandyam','bmandyam','2016-09-27 10:29:41','Logged In'),('bmandyam','bmandyam','2016-09-27 10:30:36','Logged In'),('bmandyam','bmandyam','2016-09-27 10:31:42','Logged In'),('ppc','ppc','2016-09-27 14:27:55','Logged Out'),('bmandyam','bmandyam','2016-09-27 14:28:07','Logged In'),('bmandyam','bmandyam','2016-09-27 14:28:52','Logged In'),('bmandyam','bmandyam','2016-09-27 14:30:20','Logged In'),('bmandyam','bmandyam','2016-09-27 14:36:22','Logged In'),('bmandyam','bmandyam','2016-09-27 14:38:39','Logged In'),('bmandyam','bmandyam','2016-09-27 14:39:28','Logged In'),('bmandyam','bmandyam','2016-09-27 16:24:52','Logged In'),('bmandyam','bmandyam','2016-09-27 16:29:06','Logged In'),('bmandyam','bmandyam','2016-09-27 17:06:29','Logged In'),('bmandyam','bmandyam','2016-09-27 17:07:00','Logged In'),('bmandyam','bmandyam','2016-09-27 17:12:51','Logged In'),('bmandyam','bmandyam','2016-09-27 18:52:28','Logged Out'),('bmandyam','bmandyam','2016-09-28 09:53:24','Logged In'),('bmandyam','bmandyam','2016-09-28 11:14:21','Logged In'),('bmandyam','bmandyam','2016-09-28 11:20:06','Logged In'),('bmandyam','bmandyam','2016-09-28 11:21:08','Logged In'),('bmandyam','bmandyam','2016-09-28 11:22:02','Logged In'),('bmandyam','bmandyam','2016-09-28 14:52:57','Logged In'),('bmandyam','bmandyam','2016-09-28 14:53:58','Logged In'),('','','2016-09-28 19:04:56','Logged Out'),('bmandyam','bmandyam','2016-09-29 09:58:01','Logged In'),('bmandyam','bmandyam','2016-09-29 10:03:15','Logged In'),('bmandyam','bmandyam','2016-09-30 10:02:28','Logged In'),('bmandyam','bmandyam','2016-09-30 10:06:03','Logged In'),('bmandyam','bmandyam','2016-09-30 10:06:37','Logged In'),('bmandyam','bmandyam','2016-09-30 10:07:34','Logged In'),('bmandyam','bmandyam','2016-09-30 10:07:52','Logged In'),('bmandyam','bmandyam','2016-09-30 10:20:03','Logged In'),('bmandyam','bmandyam','2016-09-30 10:20:56','Logged In'),('bmandyam','bmandyam','2016-09-30 10:22:08','Logged In'),('bmandyam','bmandyam','2016-09-30 10:24:27','Logged In'),('bmandyam','bmandyam','2016-09-30 10:25:05','Logged In'),('bmandyam','bmandyam','2016-10-03 09:53:26','Logged In'),('bmandyam','bmandyam','2016-10-03 10:48:25','Logged In'),('bmandyam','bmandyam','2016-10-03 11:18:58','Logged In'),('bmandyam','bmandyam','2016-10-03 12:24:55','Logged In'),('bmandyam','bmandyam','2016-10-03 12:53:39','Logged In'),('bmandyam','bmandyam','2016-10-03 19:01:48','Logged In'),('bmandyam','bmandyam','2016-10-04 10:04:13','Logged In'),('bmandyam','bmandyam','2016-10-04 13:26:45','Logged In'),('bmandyam','bmandyam','2016-10-04 15:19:37','Logged In'),('bmandyam','bmandyam','2016-10-04 18:28:52','Logged In'),('bmandyam','bmandyam','2016-10-05 10:00:56','Logged In'),('bmandyam','bmandyam','2016-10-05 15:51:03','Logged Out'),('bmandyam','bmandyam','2016-10-05 15:51:12','Logged In'),('bmandyam','bmandyam','2016-10-05 19:01:47','Logged Out'),('bmandyam','bmandyam','2016-10-06 10:00:00','Logged In'),('bmandyam','bmandyam','2016-10-06 10:01:06','Logged In'),('qas','qas','2016-10-06 14:23:05','Logged Out'),('bmandyam','bmandyam','2016-10-06 14:23:17','Logged In'),('bmandyam','bmandyam','2016-10-06 15:09:06','Logged In'),('bmandyam','bmandyam','2016-10-07 09:57:19','Logged In'),('bmandyam','bmandyam','2016-10-07 11:20:14','Logged In'),('bmandyam','bmandyam','2016-10-07 18:54:27','Logged In'),('bmandyam','bmandyam','2016-10-07 18:56:34','Logged Out'),('bmandyam','bmandyam','2016-10-11 10:24:58','Logged In'),('accounts','accounts','2016-10-11 11:21:25','Logged Out'),('','','2016-10-11 11:21:31','Logged Out'),('bmandyam','bmandyam','2016-10-11 11:21:39','Logged In'),('bmandyam','bmandyam','2016-10-11 15:57:54','Logged In'),('bmandyam','bmandyam','2016-10-11 19:02:58','Logged Out'),('bmandyam','bmandyam','2016-10-12 10:10:44','Logged In'),('bmandyam','bmandyam','2016-10-13 09:56:15','Logged In'),('bmandyam','bmandyam','2016-10-13 19:05:20','Logged In'),('bmandyam','bmandyam','2016-10-14 10:17:12','Logged In'),('bmandyam','bmandyam','2016-10-14 17:20:57','Logged In'),('bmandyam','bmandyam','2016-10-14 19:26:43','Logged Out'),('bmandyam','bmandyam','2016-10-17 10:08:08','Logged In'),('bmandyam','bmandyam','2016-10-17 19:04:36','Logged Out'),('bmandyam','bmandyam','2016-10-18 10:10:14','Logged In'),('bmandyam','bmandyam','2016-10-19 09:58:37','Logged In'),('bmandyam','bmandyam','2016-10-20 14:18:32','Logged In'),('accounts','accounts','2016-10-20 16:38:17','Logged Out'),('bmandyam','bmandyam','2016-10-20 16:38:37','Logged In'),('bmandyam','bmandyam','2016-10-20 17:59:38','Logged Out'),('bmandyam','bmandyam','2016-10-20 17:59:55','Logged In'),('bmandyam','bmandyam','2016-10-20 19:03:38','Logged Out'),('bmandyam','bmandyam','2016-10-21 10:01:19','Logged In'),('accounts','accounts','2016-10-21 18:52:25','Logged Out'),('bmandyam','bmandyam','2016-10-21 18:52:34','Logged In'),('bmandyam','bmandyam','2016-10-21 18:59:06','Logged Out'),('bmandyam','bmandyam','2016-10-24 10:04:03','Logged In'),('accounts','accounts','2016-10-24 10:16:26','Logged Out'),('bmandyam','bmandyam','2016-10-24 10:16:38','Logged In'),('','','2016-10-24 10:46:29','Logged Out'),('bmandyam','bmandyam','2016-10-24 10:46:40','Logged In'),('bmandyam','bmandyam','2016-10-24 19:04:09','Logged Out'),('bmandyam','bmandyam','2016-10-25 09:55:41','Logged In'),('bmandyam','bmandyam','2016-10-25 10:30:24','Logged In'),('bmandyam','bmandyam','2016-10-25 13:00:25','Logged In'),('deepika','deepika','2016-10-25 16:06:40','Logged Out'),('bmandyam','bmandyam','2016-10-25 16:07:05','Logged In'),('bmandyam','bmandyam','2016-10-25 18:23:45','Logged In'),('bmandyam','bmandyam','2016-10-26 09:57:35','Logged In'),('bmandyam','bmandyam','2016-10-28 16:49:15','Logged In'),('bmandyam','bmandyam','2016-10-28 16:55:48','Logged In'),('bmandyam','bmandyam','2016-10-28 16:57:50','Logged Out'),('bmandyam','bmandyam','2016-10-28 16:57:50','Logged In'),('bmandyam','bmandyam','2016-11-02 10:16:11','Logged In'),('bmandyam','bmandyam','2016-11-02 12:23:10','Logged In'),('bmandyam','bmandyam','2016-11-02 12:25:01','Logged Out'),('bmandyam','bmandyam','2016-11-02 12:25:14','Logged In'),('bmandyam','bmandyam','2016-11-02 12:27:38','Logged In'),('accounts','accounts','2016-11-02 14:35:13','Logged Out'),('bmandyam','bmandyam','2016-11-02 14:35:24','Logged In'),('accounts','accounts','2016-11-02 16:47:45','Logged Out'),('bmandyam','bmandyam','2016-11-02 16:47:57','Logged In'),('bmandyam','bmandyam','2016-11-02 17:56:10','Logged Out'),('sa','sa','2016-11-02 17:56:29','Logged In'),('sa','sa','2016-11-02 17:56:51','Logged In'),('sa','sa','2016-11-02 18:26:02','Logged Out'),('accounts','accounts','2016-11-02 18:26:13','Logged In'),('accounts','accounts','2016-11-02 18:27:19','Logged In'),('accounts','accounts','2016-11-02 18:28:46','Logged In'),('accounts','accounts','2016-11-02 18:29:02','Logged In'),('accounts','accounts','2016-11-02 18:29:53','Logged In'),('accounts','accounts','2016-11-02 18:30:02','Logged In'),('accounts','accounts','2016-11-02 18:32:57','Logged Out'),('accounts','accounts','2016-11-02 18:33:53','Logged In'),('accounts','accounts','2016-11-02 18:34:14','Logged In'),('accounts','accounts','2016-11-02 18:36:10','Logged In'),('accounts','accounts','2016-11-02 18:36:13','Logged In'),('accounts','accounts','2016-11-02 18:36:30','Logged Out'),('','','2016-11-02 18:36:34','Logged Out'),('accounts','accounts','2016-11-02 18:36:53','Logged In'),('accounts','accounts','2016-11-02 18:37:10','Logged In'),('accounts','accounts','2016-11-02 18:37:31','Logged In'),('accounts','accounts','2016-11-02 18:37:46','Logged In'),('accounts','accounts','2016-11-02 18:38:14','Logged In'),('accounts','accounts','2016-11-02 18:38:43','Logged In'),('accounts','accounts','2016-11-02 18:39:01','Logged In'),('accounts','accounts','2016-11-02 18:39:29','Logged Out'),('sa','sa','2016-11-02 18:39:35','Logged In'),('sa','sa','2016-11-02 18:40:16','Logged In'),('sa','sa','2016-11-02 18:40:34','Logged In'),('sa','sa','2016-11-02 18:41:06','Logged In'),('sa','sa','2016-11-02 18:41:29','Logged In'),('sa','sa','2016-11-02 18:42:18','Logged In'),('sa','sa','2016-11-02 18:42:51','Logged In'),('sa','sa','2016-11-02 18:42:56','Logged In'),('sa','sa','2016-11-02 18:43:30','Logged In'),('sa','sa','2016-11-02 18:44:26','Logged In'),('sa','sa','2016-11-02 18:44:36','Logged Out'),('accounts','accounts','2016-11-02 18:44:46','Logged In'),('accounts','accounts','2016-11-02 18:44:50','Logged Out'),('bmandyam','bmandyam','2016-11-02 18:45:03','Logged In'),('bmandyam','bmandyam','2016-11-02 18:47:02','Logged Out'),('sa','sa','2016-11-02 18:47:10','Logged In'),('sa','sa','2016-11-02 19:17:16','Logged Out'),('bmandyam','bmandyam','2016-11-02 19:17:24','Logged In'),('','','2016-11-03 10:06:13','Logged Out'),('sa','sa','2016-11-03 10:06:29','Logged In'),('sa','sa','2016-11-03 10:21:11','Logged Out'),('accounts','accounts','2016-11-03 10:21:26','Logged In'),('accounts','accounts','2016-11-03 10:21:49','Logged Out'),('sa','sa','2016-11-03 10:21:57','Logged In'),('sa','sa','2016-11-03 10:23:21','Logged In'),('bmandyam','bmandyam','2016-11-03 10:37:53','Logged Out'),('sa','sa','2016-11-03 10:38:01','Logged In'),('sa','sa','2016-11-03 10:44:19','Logged In'),('sa','sa','2016-11-03 10:45:06','Logged In'),('sa','sa','2016-11-03 10:45:43','Logged In'),('sa','sa','2016-11-03 10:46:31','Logged In'),('sa','sa','2016-11-03 10:46:38','Logged In'),('sa','sa','2016-11-03 10:56:04','Logged Out'),('bmandyam','bmandyam','2016-11-03 10:56:15','Logged In'),('bmandyam','bmandyam','2016-11-03 11:28:24','Logged In'),('bmandyam','bmandyam','2016-11-03 11:41:13','Logged In'),('bmandyam','bmandyam','2016-11-03 12:55:05','Logged In'),('bmandyam','bmandyam','2016-11-03 12:57:20','Logged Out'),('bmandyam','bmandyam','2016-11-03 12:57:30','Logged In'),('bmandyam','bmandyam','2016-11-03 12:58:16','Logged In'),('bmandyam','bmandyam','2016-11-03 12:58:44','Logged In'),('bmandyam','bmandyam','2016-11-03 12:59:00','Logged In'),('bmandyam','bmandyam','2016-11-03 12:59:22','Logged In'),('bmandyam','bmandyam','2016-11-03 12:59:37','Logged In'),('bmandyam','bmandyam','2016-11-03 16:47:11','Logged In'),('bmandyam','bmandyam','2016-11-03 18:52:54','Logged In'),('bmandyam','bmandyam','2016-11-03 19:06:20','Logged In'),('bmandyam','bmandyam','2016-11-04 09:33:36','Logged In'),('bmandyam','bmandyam','2016-11-04 09:44:05','Logged In'),('','','2016-11-04 10:54:33','Logged Out'),('bmandyam','bmandyam','2016-11-04 10:54:49','Logged In'),('bmandyam','bmandyam','2016-11-04 11:17:06','Logged Out'),('bmandyam','bmandyam','2016-11-04 11:17:18','Logged In'),('','','2016-11-04 11:17:30','Logged Out'),('bmandyam','bmandyam','2016-11-04 11:17:47','Logged In'),('bmandyam','bmandyam','2016-11-04 19:38:16','Logged Out'),('bmandyam','bmandyam','2016-11-05 10:04:43','Logged In'),('bmandyam','bmandyam','2016-11-05 10:36:41','Logged Out'),('bmandyam','bmandyam','2016-11-05 10:40:23','Logged In'),('bmandyam','bmandyam','2016-11-05 14:57:00','Logged Out'),('bmandyam','bmandyam','2016-11-05 15:07:13','Logged In'),('bmandyam','bmandyam','2016-11-05 16:29:47','Logged Out'),('bmandyam','bmandyam','2016-11-06 11:05:02','Logged In'),('bmandyam','bmandyam','2016-11-06 17:57:59','Logged In'),('bmandyam','bmandyam','2016-11-06 22:31:24','Logged Out'),('bmandyam','bmandyam','2016-11-07 12:23:19','Logged In'),('bmandyam','bmandyam','2016-11-07 13:03:42','Logged In'),('bmandyam','bmandyam','2016-11-09 09:52:33','Logged In'),('bmandyam','bmandyam','2016-11-09 12:07:28','Logged Out'),('bmandyam','bmandyam','2016-11-10 09:50:50','Logged In'),('bmandyam','bmandyam','2016-11-10 17:43:56','Logged In'),('bmandyam','bmandyam','2016-11-11 10:06:13','Logged In'),('bmandyam','bmandyam','2016-11-14 10:01:16','Logged In'),('bmandyam','bmandyam','2016-11-15 09:59:36','Logged In'),('cad','cad','2016-11-15 16:24:32','Logged Out'),('bmandyam','bmandyam','2016-11-15 16:24:39','Logged In'),('bmandyam','bmandyam','2016-11-15 19:18:51','Logged Out'),('bmandyam','bmandyam','2016-11-16 10:09:54','Logged In'),('bmandyam','bmandyam','2016-11-16 12:07:44','Logged Out'),('bmandyam','bmandyam','2016-11-16 16:48:28','Logged In'),('bmandyam','bmandyam','2016-11-16 18:53:59','Logged In'),('bmandyam','bmandyam','2016-11-16 19:01:15','Logged Out'),('bmandyam','bmandyam','2016-11-19 10:57:32','Logged In'),('bmandyam','bmandyam','2016-11-21 15:39:10','Logged In'),('bmandyam','bmandyam','2016-11-21 15:56:18','Logged In'),('bmandyam','bmandyam','2016-11-21 18:45:50','Logged In'),('bmandyam','bmandyam','2016-11-22 13:07:57','Logged In'),('','','2016-11-22 13:20:52','Logged Out'),('bmandyam','bmandyam','2016-11-23 16:56:40','Logged In'),('bmandyam','bmandyam','2016-11-24 10:23:09','Logged In'),('bmandyam','bmandyam','2016-11-24 12:11:56','Logged In'),('bmandyam','bmandyam','2016-11-24 18:55:24','Logged In'),('bmandyam','bmandyam','2016-11-25 10:06:57','Logged In'),('bmandyam','bmandyam','2016-11-25 10:45:19','Logged Out'),('bmandyam','bmandyam','2016-11-25 10:45:28','Logged In'),('bmandyam','bmandyam','2016-11-25 12:00:11','Logged In'),('bmandyam','bmandyam','2016-11-25 12:41:12','Logged Out'),('bmandyam','bmandyam','2016-11-28 10:10:08','Logged In'),('bmandyam','bmandyam','2016-11-28 10:15:33','Logged Out'),('bmandyam','bmandyam','2016-11-30 12:46:25','Logged In'),('bmandyam','bmandyam','2016-12-01 10:44:21','Logged In'),('bmandyam','bmandyam','2016-12-01 10:44:42','Logged Out'),('bmandyam','bmandyam','2016-12-02 15:32:57','Logged In'),('bmandyam','bmandyam','2016-12-02 15:33:32','Logged Out'),('bmandyam','bmandyam','2016-12-06 10:30:52','Logged In'),('hmc','hmc','2016-12-06 10:44:10','Logged Out'),('bmandyam','bmandyam','2016-12-08 11:28:53','Logged In'),('fsi','fsi','2016-12-08 15:35:28','Logged Out'),('bmandyam','bmandyam','2016-12-09 16:11:28','Logged In'),('bmandyam','bmandyam','2016-12-09 16:13:02','Logged Out'),('bmandyam','bmandyam','2016-12-09 17:17:55','Logged In'),('bmandyam','bmandyam','2016-12-14 17:37:07','Logged In'),('bmandyam','bmandyam','2016-12-14 17:48:22','Logged In'),('bmandyam','bmandyam','2016-12-14 18:14:12','Logged Out'),('bmandyam','bmandyam','2016-12-14 18:14:25','Logged In'),('bmandyam','bmandyam','2016-12-14 19:04:05','Logged In'),('bmandyam','bmandyam','2016-12-19 10:09:14','Logged In'),('stores_s','stores_sez','2016-12-19 10:27:12','Logged Out'),('bmandyam','bmandyam','2016-12-19 10:27:26','Logged In'),('bmandyam','bmandyam','2016-12-19 10:59:01','Logged In'),('stores_s','stores_sez','2016-12-19 11:28:54','Logged Out'),('bmandyam','bmandyam','2016-12-19 11:29:03','Logged In'),('bmandyam','bmandyam','2016-12-19 16:55:34','Logged In'),('bmandyam','bmandyam','2016-12-19 16:58:36','Logged Out'),('bmandyam','bmandyam','2016-12-19 17:00:19','Logged In'),('bmandyam','bmandyam','2016-12-20 10:17:56','Logged In'),('bmandyam','bmandyam','2016-12-22 10:37:11','Logged In'),('bmandyam','bmandyam','2016-12-22 10:37:41','Logged Out'),('bmandyam','bmandyam','2016-12-22 10:56:53','Logged In'),('bmandyam','bmandyam','2016-12-22 11:13:49','Logged Out'),('bmandyam','bmandyam','2016-12-22 11:17:02','Logged In'),('accounts','accounts_sez','2016-12-22 12:59:56','Logged Out'),('bmandyam','bmandyam','2016-12-22 14:23:20','Logged In'),('bmandyam','bmandyam','2016-12-22 14:35:27','Logged Out'),('','','2016-12-22 16:58:47','Logged Out'),('bmandyam','bmandyam','2016-12-30 15:04:31','Logged In'),('bmandyam','bmandyam','2016-12-30 15:45:31','Logged In'),('bmandyam','bmandyam','2017-01-02 12:43:08','Logged In'),('bmandyam','bmandyam','2017-01-02 12:46:13','Logged Out'),('bmandyam','bmandyam','2017-01-04 15:17:23','Logged In'),('bmandyam','bmandyam','2017-01-04 15:18:12','Logged Out'),('bmandyam','bmandyam','2017-01-04 15:51:02','Logged In'),('bmandyam','bmandyam','2017-01-04 17:28:44','Logged In'),('bmandyam','bmandyam','2017-01-04 17:39:30','Logged In'),('','','2017-01-04 19:00:29','Logged Out'),('bmandyam','bmandyam','2017-01-05 10:21:53','Logged In'),('bmandyam','bmandyam','2017-01-05 17:18:05','Logged In'),('bmandyam','bmandyam','2017-02-14 16:44:51','Logged Out'),('bmandyam','bmandyam','2017-02-14 16:44:59','Logged In'),('bmandyam','bmandyam','2017-02-14 18:50:22','Logged Out'),('bmandyam','bmandyam','2017-02-14 18:50:36','Logged In'),('bmandyam','bmandyam','2017-02-14 19:01:20','Logged Out'),('bmandyam','bmandyam','2017-02-15 10:31:17','Logged In'),('bmandyam','bmandyam','2017-02-15 11:17:28','Logged In'),('accounts','accounts','2017-02-15 11:45:19','Logged Out'),('bmandyam','bmandyam','2017-02-15 11:45:29','Logged In'),('bmandyam','bmandyam','2017-02-15 12:55:01','Logged Out'),('bmandyam','bmandyam','2017-02-15 12:55:16','Logged In'),('accounts','accounts','2017-02-15 15:12:54','Logged Out'),('bmandyam','bmandyam','2017-02-15 15:13:02','Logged In'),('bmandyam','bmandyam','2017-02-15 15:20:53','Logged In'),('bmandyam','bmandyam','2017-02-15 15:47:50','Logged In'),('','','2017-02-15 18:01:12','Logged Out'),('bmandyam','bmandyam','2017-02-15 18:01:20','Logged In'),('bmandyam','bmandyam','2017-02-15 18:45:50','Logged In'),('bmandyam','bmandyam','2017-02-15 18:47:29','Logged Out'),('bmandyam','bmandyam','2017-02-15 18:47:35','Logged In'),('bmandyam','bmandyam','2017-02-15 18:48:41','Logged Out'),('bmandyam','bmandyam','2017-02-15 18:48:51','Logged In'),('bmandyam','bmandyam','2017-02-16 10:12:04','Logged In'),('bmandyam','bmandyam','2017-02-16 15:24:23','Logged In'),('bmandyam','bmandyam','2017-02-16 17:36:46','Logged Out'),('sa','sa','2017-02-16 17:37:01','Logged In'),('sa','sa','2017-02-16 18:06:38','Logged Out'),('bmandyam','bmandyam','2017-02-16 18:07:39','Logged In'),('op','op','2017-02-16 19:05:00','Logged Out'),('bmandyam','bmandyam','2017-02-17 10:30:08','Logged In'),('bmandyam','bmandyam','2017-02-17 11:05:23','Logged Out'),('bmandyam','bmandyam','2017-02-17 11:05:32','Logged In'),('bmandyam','bmandyam','2017-02-17 13:12:45','Logged In'),('bmandyam','bmandyam','2017-02-17 14:27:38','Logged Out'),('bmandyam','bmandyam','2017-02-17 14:27:46','Logged In'),('bmandyam','bmandyam','2017-02-17 16:58:06','Logged Out'),('sa','sa','2017-02-17 16:58:19','Logged In'),('sa','sa','2017-02-17 17:14:49','Logged Out'),('bmandyam','bmandyam','2017-02-17 17:14:56','Logged In'),('bmandyam','bmandyam','2017-02-17 17:15:05','Logged Out'),('sa','sa','2017-02-17 17:15:11','Logged In'),('','','2017-02-17 17:38:05','Logged Out'),('bmandyam','bmandyam','2017-02-17 17:38:15','Logged In'),('bmandyam','bmandyam','2017-02-17 17:39:00','Logged Out'),('','','2017-02-17 17:39:04','Logged Out'),('sa','sa','2017-02-17 17:39:10','Logged In'),('sa','sa','2017-02-17 17:41:10','Logged In'),('sa','sa','2017-02-17 17:41:11','Logged Out'),('sa','sa','2017-02-17 17:41:27','Logged In'),('sa','sa','2017-02-17 17:45:23','Logged Out'),('ravi','ravi','2017-02-17 17:46:33','Logged In'),('ravi','ravi','2017-02-17 17:46:51','Logged In'),('ravi','ravi','2017-02-17 17:51:36','Logged In'),('ravi','ravi','2017-02-17 17:52:34','Logged In'),('ravi','ravi','2017-02-17 17:52:46','Logged In'),('ravi','ravi','2017-02-17 17:53:00','Logged In'),('ravi','ravi','2017-02-17 17:53:36','Logged In'),('ravi','ravi','2017-02-17 17:53:55','Logged In'),('ravi','ravi','2017-02-17 17:54:20','Logged In'),('ravi','ravi','2017-02-17 17:54:59','Logged In'),('ravi','ravi','2017-02-17 17:57:14','Logged In'),('ravi','ravi','2017-02-17 18:22:41','Logged Out'),('bmandyam','bmandyam','2017-02-17 18:22:49','Logged In'),('bmandyam','bmandyam','2017-02-17 19:04:04','Logged Out'),('ravi','ravi','2017-02-17 19:04:21','Logged In'),('ravi','ravi','2017-02-17 19:06:47','Logged In'),('ravi','ravi','2017-02-17 19:07:02','Logged In'),('ravi','ravi','2017-02-17 19:07:34','Logged Out'),('','','2017-02-17 19:07:37','Logged Out'),('','','2017-02-20 10:10:46','Logged Out'),('bmandyam','bmandyam','2017-02-20 10:11:06','Logged In'),('bmandyam','bmandyam','2017-02-20 10:23:42','Logged Out'),('ravi','ravi','2017-02-20 10:23:50','Logged In'),('ravi','ravi','2017-02-20 10:25:26','Logged In'),('ravi','ravi','2017-02-20 10:26:06','Logged In'),('ravi','ravi','2017-02-20 10:26:46','Logged In'),('ravi','ravi','2017-02-20 10:27:12','Logged In'),('ravi','ravi','2017-02-20 10:28:20','Logged In'),('ravi','ravi','2017-02-20 10:28:30','Logged In'),('ravi','ravi','2017-02-20 10:29:00','Logged In'),('ravi','ravi','2017-02-20 10:31:51','Logged In'),('ravi','ravi','2017-02-20 10:32:05','Logged In'),('ravi','ravi','2017-02-20 10:33:31','Logged In'),('ravi','ravi','2017-02-20 10:33:48','Logged In'),('ravi','ravi','2017-02-20 10:33:53','Logged In'),('ravi','ravi','2017-02-20 10:34:29','Logged In'),('ravi','ravi','2017-02-20 10:34:59','Logged In'),('ravi','ravi','2017-02-20 10:35:36','Logged In'),('ravi','ravi','2017-02-20 11:24:34','Logged Out'),('bmandyam','bmandyam','2017-02-20 11:24:42','Logged In'),('bmandyam','bmandyam','2017-02-20 11:25:04','Logged Out'),('ravi','ravi','2017-02-20 11:25:15','Logged In'),('ravi','ravi','2017-02-20 11:25:51','Logged In'),('ravi','ravi','2017-02-20 11:27:36','Logged In'),('','','2017-02-20 12:28:51','Logged Out'),('ravi','ravi','2017-02-20 12:29:01','Logged In'),('ravi','ravi','2017-02-20 12:42:59','Logged Out'),('bmandyam','bmandyam','2017-02-20 12:43:08','Logged In'),('','','2017-02-20 12:46:45','Logged Out'),('bmandyam','bmandyam','2017-02-20 12:46:59','Logged In'),('bmandyam','bmandyam','2017-02-20 12:53:09','Logged Out'),('ravi','ravi','2017-02-20 12:53:17','Logged In'),('ravi','ravi','2017-02-20 12:54:05','Logged In'),('ravi','ravi','2017-02-20 12:54:07','Logged Out'),('bmandyam','bmandyam','2017-02-20 12:54:15','Logged In'),('bmandyam','bmandyam','2017-02-20 12:55:03','Logged Out'),('sa','sa','2017-02-20 12:55:07','Logged In'),('sa','sa','2017-02-20 12:56:33','Logged In'),('sa','sa','2017-02-20 12:57:23','Logged In'),('sa','sa','2017-02-20 12:57:31','Logged Out'),('bmandyam','bmandyam','2017-02-20 12:57:40','Logged In'),('bmandyam','bmandyam','2017-02-20 12:58:00','Logged Out'),('ravi','ravi','2017-02-20 12:58:10','Logged In'),('ravi','ravi','2017-02-20 13:12:47','Logged Out'),('sa','sa','2017-02-20 13:12:54','Logged In'),('sa','sa','2017-02-20 13:14:06','Logged Out'),('asha','asha','2017-02-20 13:14:45','Logged In'),('asha','asha','2017-02-20 13:19:41','Logged Out'),('ravi','ravi','2017-02-20 13:19:49','Logged In'),('ravi','ravi','2017-02-20 14:45:40','Logged In'),('ravi','ravi','2017-02-20 14:46:01','Logged In'),('ravi','ravi','2017-02-20 14:49:13','Logged Out'),('asha','asha','2017-02-20 14:49:30','Logged In'),('asha','asha','2017-02-20 14:49:53','Logged In'),('asha','asha','2017-02-20 14:50:06','Logged In'),('asha','asha','2017-02-20 14:58:42','Logged In'),('asha','asha','2017-02-20 14:59:00','Logged In'),('asha','asha','2017-02-20 14:59:35','Logged In'),('asha','asha','2017-02-20 15:00:05','Logged In'),('asha','asha','2017-02-20 15:00:13','Logged In'),('asha','asha','2017-02-20 15:01:14','Logged In'),('asha','asha','2017-02-20 15:01:17','Logged In'),('asha','asha','2017-02-20 15:01:31','Logged In'),('asha','asha','2017-02-20 15:03:43','Logged Out'),('ravi','ravi','2017-02-20 15:03:52','Logged In'),('ravi','ravi','2017-02-20 15:04:01','Logged Out'),('','','2017-02-20 15:06:28','Logged Out'),('sa','sa','2017-02-20 15:08:27','Logged In'),('sa','sa','2017-02-20 15:11:52','Logged Out'),('venkat','venkat','2017-02-20 15:17:03','Logged In'),('venkat','venkat','2017-02-20 15:18:58','Logged In'),('venkat','venkat','2017-02-20 15:19:23','Logged In'),('venkat','venkat','2017-02-20 15:19:36','Logged In'),('venkat','venkat','2017-02-20 15:19:48','Logged Out'),('bmandyam','bmandyam','2017-02-20 15:20:07','Logged In'),('bmandyam','bmandyam','2017-02-20 15:23:30','Logged Out'),('venkat','venkat','2017-02-20 15:23:37','Logged In'),('ami','ami','2017-02-20 15:31:24','Logged Out'),('sa','sa','2017-02-20 15:31:31','Logged In'),('sa','sa','2017-02-20 15:32:35','Logged Out'),('aero','aero','2017-02-20 15:32:42','Logged In'),('ami','ami','2017-02-20 15:43:48','Logged Out'),('aero','aero','2017-02-20 15:44:02','Logged In'),('aero','aero','2017-02-20 15:44:13','Logged In'),('aero','aero','2017-02-20 15:46:16','Logged In'),('aero','aero','2017-02-20 15:47:41','Logged In'),('aero','aero','2017-02-20 15:47:52','Logged In'),('aero','aero','2017-02-20 15:48:07','Logged In'),('aero','aero','2017-02-20 15:48:32','Logged In'),('aero','aero','2017-02-20 15:48:55','Logged In'),('aero','aero','2017-02-20 15:50:03','Logged In'),('aero','aero','2017-02-20 15:50:10','Logged In'),('aero','aero','2017-02-20 15:50:17','Logged In'),('aero','aero','2017-02-20 15:50:42','Logged In'),('aero','aero','2017-02-20 15:50:56','Logged In'),('aero','aero','2017-02-20 15:51:11','Logged In'),('aero','aero','2017-02-20 15:51:33','Logged In'),('aero','aero','2017-02-20 15:52:00','Logged In'),('aero','aero','2017-02-20 15:52:09','Logged In'),('aero','aero','2017-02-20 15:53:43','Logged In'),('ami','ami','2017-02-20 16:00:14','Logged Out'),('bmandyam','bmandyam','2017-02-20 16:00:21','Logged In'),('bmandyam','bmandyam','2017-02-20 16:02:43','Logged Out'),('aero','aero','2017-02-20 16:02:51','Logged In'),('aero','aero','2017-02-20 16:25:56','Logged In'),('aero','aero','2017-02-20 16:26:25','Logged Out'),('ravi','ravi','2017-02-20 16:26:34','Logged In'),('ravi','ravi','2017-02-20 16:30:23','Logged Out'),('bmandyam','bmandyam','2017-02-20 16:30:32','Logged In'),('bmandyam','bmandyam','2017-02-20 17:01:06','Logged Out'),('ravi','ravi','2017-02-20 17:01:21','Logged In'),('ravi','ravi','2017-02-20 17:10:11','Logged Out'),('bmandyam','bmandyam','2017-02-20 17:10:18','Logged In'),('bmandyam','bmandyam','2017-02-20 17:26:18','Logged Out'),('ravi','ravi','2017-02-20 17:26:27','Logged In'),('ravi','ravi','2017-02-21 10:15:53','Logged In'),('ravi','ravi','2017-02-21 10:17:12','Logged Out'),('bmandyam','bmandyam','2017-02-21 10:17:19','Logged In'),('bmandyam','bmandyam','2017-02-21 10:17:29','Logged In'),('bmandyam','bmandyam','2017-02-21 10:17:32','Logged Out'),('ravi','ravi','2017-02-21 10:17:48','Logged In'),('bmandyam','bmandyam','2017-02-21 10:20:19','Logged In'),('bmandyam','bmandyam','2017-02-21 10:29:06','Logged Out'),('ravi','ravi','2017-02-21 10:29:13','Logged In'),('ravi','ravi','2017-02-21 10:53:22','Logged Out'),('bmandyam','bmandyam','2017-02-21 10:53:30','Logged In'),('bmandyam','bmandyam','2017-02-21 11:22:14','Logged Out'),('ravi','ravi','2017-02-21 11:22:21','Logged In'),('ravi','ravi','2017-02-21 11:31:58','Logged Out'),('bmandyam','bmandyam','2017-02-21 11:32:04','Logged In'),('bmandyam','bmandyam','2017-02-21 11:47:32','Logged Out'),('ravi','ravi','2017-02-21 11:47:43','Logged In'),('ravi','ravi','2017-02-21 12:01:44','Logged Out'),('bmandyam','bmandyam','2017-02-21 12:24:32','Logged Out'),('bmandyam','bmandyam','2017-02-21 12:24:43','Logged In'),('bmandyam','bmandyam','2017-02-21 12:25:36','Logged Out'),('ravi','ravi','2017-02-21 12:25:44','Logged In'),('ravi','ravi','2017-02-21 13:17:47','Logged Out'),('bmandyam','bmandyam','2017-02-21 13:17:54','Logged In'),('bmandyam','bmandyam','2017-02-21 13:19:06','Logged Out'),('ravi','ravi','2017-02-21 13:19:20','Logged In'),('ravi','ravi','2017-02-21 13:24:34','Logged Out'),('bmandyam','bmandyam','2017-02-21 13:24:41','Logged In'),('bmandyam','bmandyam','2017-02-21 14:16:51','Logged Out'),('ravi','ravi','2017-02-21 14:17:15','Logged In'),('ravi','ravi','2017-02-21 14:19:56','Logged Out'),('bmandyam','bmandyam','2017-02-21 14:20:10','Logged In'),('bmandyam','bmandyam','2017-02-21 14:41:22','Logged Out'),('ravi','ravi','2017-02-21 14:41:29','Logged In'),('ravi','ravi','2017-02-21 14:56:39','Logged Out'),('bmandyam','bmandyam','2017-02-21 14:56:54','Logged In'),('','','2017-02-21 15:15:11','Logged Out'),('ravi','ravi','2017-02-21 15:15:19','Logged In'),('bmandyam','bmandyam','2017-02-21 18:13:40','Logged In'),('bmandyam','bmandyam','2017-02-21 19:13:52','Logged Out'),('bmandyam','bmandyam','2017-02-22 10:14:14','Logged In'),('bmandyam','bmandyam','2017-02-22 11:19:46','Logged In'),('bmandyam','bmandyam','2017-02-22 12:54:33','Logged Out'),('bmandyam','bmandyam','2017-02-22 12:54:37','Logged In'),('bmandyam','bmandyam','2017-02-22 15:51:39','Logged Out'),('bmandyam','bmandyam','2017-02-22 15:51:43','Logged In'),('bmandyam','bmandyam','2017-02-23 10:52:10','Logged In'),('bmandyam','bmandyam','2017-02-23 12:14:35','Logged Out'),('bmandyam','bmandyam','2017-02-27 10:11:28','Logged In'),('bmandyam','bmandyam','2017-02-27 10:28:48','Logged Out'),('bmandyam','bmandyam','2017-02-27 10:28:52','Logged In'),('bmandyam','bmandyam','2017-02-27 10:51:57','Logged Out'),('bmandyam','bmandyam','2017-02-27 10:52:01','Logged In'),('bmandyam','bmandyam','2017-02-27 12:24:47','Logged In'),('','','2017-02-27 12:50:13','Logged Out'),('bmandyam','bmandyam','2017-02-27 12:50:17','Logged In'),('bmandyam','bmandyam','2017-02-27 16:01:49','Logged Out'),('bmandyam','bmandyam','2017-02-27 16:01:54','Logged In'),('bmandyam','bmandyam','2017-02-27 17:03:24','Logged Out'),('','','2017-02-27 17:03:29','Logged Out'),('','','2017-02-27 17:03:32','Logged Out'),('bmandyam','bmandyam','2017-02-27 18:03:46','Logged In'),('bmandyam','bmandyam','2017-02-28 11:46:38','Logged In'),('bmandyam','bmandyam','2017-02-28 12:01:13','Logged Out'),('bmandyam','bmandyam','2017-02-28 12:01:17','Logged In'),('bmandyam','bmandyam','2017-02-28 12:55:48','Logged In'),('bmandyam','bmandyam','2017-02-28 14:46:38','Logged Out'),('bmandyam','bmandyam','2017-03-01 10:23:38','Logged In'),('bmandyam','bmandyam','2017-03-01 10:25:35','Logged Out'),('bmandyam','bmandyam','2017-03-01 18:46:58','Logged In'),('bmandyam','bmandyam','2017-03-02 10:08:25','Logged In'),('bmandyam','bmandyam','2017-03-02 11:19:31','Logged In'),('bmandyam','bmandyam','2017-03-03 10:38:34','Logged In'),('bmandyam','bmandyam','2017-03-03 12:15:00','Logged In'),('bmandyam','bmandyam','2017-03-03 12:50:16','Logged Out'),('bmandyam','bmandyam','2017-03-04 16:59:57','Logged In'),('bmandyam','bmandyam','2017-03-04 17:02:18','Logged Out'),('bmandyam','bmandyam','2017-03-04 17:02:31','Logged In'),('bmandyam','bmandyam','2017-03-04 17:02:48','Logged Out'),('bmandyam','bmandyam','2017-03-04 17:03:16','Logged In'),('bmandyam','bmandyam','2017-03-09 14:29:01','Logged In'),('bmandyam','bmandyam','2017-03-09 16:44:28','Logged Out'),('bmandyam','bmandyam','2017-03-09 16:44:32','Logged In'),('bmandyam','bmandyam','2017-03-09 16:48:43','Logged Out'),('bmandyam','bmandyam','2017-03-09 16:48:47','Logged In'),('bmandyam','bmandyam','2017-03-09 16:52:37','Logged Out'),('bmandyam','bmandyam','2017-03-09 16:52:40','Logged In'),('bmandyam','bmandyam','2017-03-09 16:59:11','Logged Out'),('bmandyam','bmandyam','2017-03-09 16:59:15','Logged In'),('bmandyam','bmandyam','2017-03-09 18:03:26','Logged Out'),('bmandyam','bmandyam','2017-03-09 18:03:30','Logged In'),('bmandyam','bmandyam','2017-03-10 16:37:45','Logged In'),('bmandyam','bmandyam','2017-03-10 16:59:41','Logged Out'),('bmandyam','bmandyam','2017-03-10 16:59:44','Logged In'),('bmandyam','bmandyam','2017-03-10 18:01:20','Logged Out'),('','','2017-03-10 18:26:26','Logged Out'),('bmandyam','bmandyam','2017-03-10 19:21:57','Logged In'),('bmandyam','bmandyam','2017-03-10 19:31:28','Logged Out'),('bmandyam','bmandyam','2017-03-10 19:39:55','Logged In'),('bmandyam','bmandyam','2017-03-13 12:03:03','Logged In'),('bmandyam','bmandyam','2017-03-13 12:28:52','Logged In'),('bmandyam','bmandyam','2017-03-13 14:21:12','Logged In'),('bmandyam','bmandyam','2017-03-13 14:40:05','Logged In'),('bmandyam','bmandyam','2017-03-13 19:01:20','Logged In'),('bmandyam','bmandyam','2017-03-14 10:17:14','Logged In'),('bmandyam','bmandyam','2017-03-14 10:19:11','Logged Out'),('bmandyam','bmandyam','2017-03-14 10:33:29','Logged In'),('bmandyam','bmandyam','2017-03-14 10:39:00','Logged Out'),('bmandyam','bmandyam','2017-03-14 11:14:56','Logged In'),('bmandyam','bmandyam','2017-03-15 10:17:34','Logged In'),('bmandyam','bmandyam','2017-03-15 12:22:26','Logged Out'),('bmandyam','bmandyam','2017-03-15 12:22:30','Logged In'),('bmandyam','bmandyam','2017-03-15 14:41:20','Logged Out'),('bmandyam','bmandyam','2017-03-15 14:41:23','Logged In'),('bmandyam','bmandyam','2017-03-15 15:12:37','Logged Out'),('bmandyam','bmandyam','2017-03-15 18:49:59','Logged In'),('bmandyam','bmandyam','2017-03-15 18:51:17','Logged Out'),('bmandyam','bmandyam','2017-03-16 15:03:02','Logged In'),('bmandyam','bmandyam','2017-03-16 15:05:36','Logged Out'),('ravi','ravi','2017-03-16 15:06:41','Logged In'),('bmandyam','bmandyam','2017-03-16 15:16:16','Logged In'),('bmandyam','bmandyam','2017-03-16 15:35:22','Logged Out'),('ravi','ravi','2017-03-16 15:35:33','Logged In'),('ravi','ravi','2017-03-16 15:36:36','Logged Out'),('bmandyam','bmandyam','2017-03-16 15:36:49','Logged In'),('bmandyam','bmandyam','2017-03-16 16:09:45','Logged Out'),('ravi','ravi','2017-03-16 16:09:57','Logged In'),('ravi','ravi','2017-03-16 16:11:07','Logged Out'),('asha','asha','2017-03-16 16:11:18','Logged In'),('asha','asha','2017-03-16 16:12:21','Logged Out'),('bmandyam','bmandyam','2017-03-16 16:12:27','Logged In'),('bmandyam','bmandyam','2017-03-16 16:18:35','Logged Out'),('aero','aero','2017-03-16 16:20:00','Logged In'),('aero','aero','2017-03-16 16:24:18','Logged In'),('aero','aero','2017-03-16 16:26:33','Logged In'),('aero','aero','2017-03-16 16:27:53','Logged In'),('aero','aero','2017-03-16 16:30:37','Logged Out'),('ravi','ravi','2017-03-16 16:30:50','Logged In'),('bmandyam','bmandyam','2017-03-16 16:35:39','Logged Out'),('bmandyam','bmandyam','2017-03-16 16:35:45','Logged In'),('bmandyam','bmandyam','2017-03-16 17:32:03','Logged Out'),('ravi','ravi','2017-03-16 17:32:22','Logged In'),('bmandyam','bmandyam','2017-03-16 18:46:28','Logged In'),('sa','sa','2017-03-17 11:36:07','Logged In'),('sa','sa','2017-03-17 11:37:21','Logged Out'),('','','2017-03-17 11:38:52','Logged Out'),('sa','sa','2017-03-17 11:39:22','Logged In'),('sa','sa','2017-03-17 11:43:54','Logged Out'),('ravi','ravi','2017-03-17 11:44:05','Logged In'),('ravi','ravi','2017-03-17 11:51:26','Logged In'),('ravi','ravi','2017-03-17 12:17:53','Logged In'),('bmandyam','bmandyam','2017-03-17 12:22:21','Logged Out'),('bmandyam','bmandyam','2017-03-17 12:22:29','Logged In'),('bmandyam','bmandyam','2017-03-17 12:22:40','Logged Out'),('ravi','ravi','2017-03-17 12:22:58','Logged In'),('bmandyam','bmandyam','2017-03-17 13:08:55','Logged Out'),('ravi','ravi','2017-03-17 13:09:18','Logged In'),('bmandyam','bmandyam','2017-03-17 14:15:18','Logged Out'),('ravi','ravi','2017-03-17 14:15:26','Logged In'),('bmandyam','bmandyam','2017-03-17 14:58:08','Logged Out'),('ravi','ravi','2017-03-17 14:58:21','Logged In'),('bmandyam','bmandyam','2017-03-17 16:11:18','Logged Out'),('ravi','ravi','2017-03-17 16:11:27','Logged In'),('ravi','ravi','2017-03-17 16:11:31','Logged Out'),('bmandyam','bmandyam','2017-03-17 16:11:34','Logged In'),('bmandyam','bmandyam','2017-03-17 16:18:07','Logged Out'),('ravi','ravi','2017-03-17 16:18:18','Logged In'),('ravi','ravi','2017-03-17 16:52:10','Logged Out'),('asha','asha','2017-03-17 16:52:31','Logged In'),('asha','asha','2017-03-17 16:53:09','Logged Out'),('ravi','ravi','2017-03-17 16:53:17','Logged In'),('bmandyam','bmandyam','2017-03-20 10:35:43','Logged In'),('venkates','venkatesh.bi','2017-03-20 15:04:52','Logged Out'),('bmandyam','bmandyam','2017-03-20 15:04:55','Logged In'),('bmandyam','bmandyam','2017-03-20 15:11:21','Logged In'),('bmandyam','bmandyam','2017-03-20 15:50:58','Logged In'),('bmandyam','bmandyam','2017-03-21 10:17:21','Logged In'),('bmandyam','bmandyam','2017-03-21 13:20:48','Logged Out'),('bmandyam','bmandyam','2017-03-22 14:23:28','Logged In'),('venkates','venkatesh.bi','2017-03-22 15:04:36','Logged Out'),('bmandyam','bmandyam','2017-03-22 15:04:41','Logged In'),('bmandyam','bmandyam','2017-03-22 18:05:49','Logged In'),('bmandyam','bmandyam','2017-03-23 11:19:40','Logged In'),('bmandyam','bmandyam','2017-03-23 12:31:06','Logged In'),('bmandyam','bmandyam','2017-03-24 18:22:20','Logged In'),('bmandyam','bmandyam','2017-03-24 18:27:07','Logged In'),('bmandyam','bmandyam','2017-03-24 18:27:56','Logged In'),('bmandyam','bmandyam','2017-03-24 18:28:37','Logged In'),('bmandyam','bmandyam','2017-03-24 18:29:46','Logged In'),('bmandyam','bmandyam','2017-03-24 18:33:27','Logged In'),('bmandyam','bmandyam','2017-03-24 18:34:04','Logged In'),('bmandyam','bmandyam','2017-03-24 18:34:13','Logged In'),('bmandyam','bmandyam','2017-03-24 18:34:41','Logged In'),('bmandyam','bmandyam','2017-03-24 18:35:04','Logged In'),('bmandyam','bmandyam','2017-03-24 18:56:45','Logged In'),('bmandyam','bmandyam','2017-03-24 18:57:18','Logged In'),('bmandyam','bmandyam','2017-03-24 18:58:05','Logged In'),('bmandyam','bmandyam','2017-03-27 10:10:19','Logged In'),('bmandyam','bmandyam','2017-03-27 10:55:40','Logged In'),('bmandyam','bmandyam','2017-03-27 11:28:31','Logged In'),('bmandyam','bmandyam','2017-03-27 11:29:09','Logged In'),('bmandyam','bmandyam','2017-03-27 12:10:27','Logged In'),('bmandyam','bmandyam','2017-03-27 12:10:52','Logged In'),('bmandyam','bmandyam','2017-03-27 12:14:48','Logged In'),('bmandyam','bmandyam','2017-03-27 12:16:04','Logged In'),('bmandyam','bmandyam','2017-03-27 14:32:35','Logged In'),('bmandyam','bmandyam','2017-03-27 14:53:37','Logged In'),('bmandyam','bmandyam','2017-03-27 14:59:10','Logged In'),('bmandyam','bmandyam','2017-03-27 15:02:58','Logged In'),('bmandyam','bmandyam','2017-03-27 15:09:25','Logged In'),('bmandyam','bmandyam','2017-03-27 16:52:25','Logged In'),('bmandyam','bmandyam','2017-03-27 17:23:04','Logged In'),('bmandyam','bmandyam','2017-03-27 19:07:06','Logged Out'),('bmandyam','bmandyam','2017-03-28 10:10:09','Logged In'),('bmandyam','bmandyam','2017-03-28 10:21:44','Logged In'),('bmandyam','bmandyam','2017-03-28 10:24:38','Logged In'),('bmandyam','bmandyam','2017-03-28 10:25:12','Logged In'),('bmandyam','bmandyam','2017-03-28 10:25:56','Logged In'),('bmandyam','bmandyam','2017-03-28 10:33:26','Logged In'),('bmandyam','bmandyam','2017-03-28 10:34:13','Logged In'),('bmandyam','bmandyam','2017-03-28 10:34:34','Logged In'),('bmandyam','bmandyam','2017-03-28 10:35:05','Logged In'),('bmandyam','bmandyam','2017-03-28 10:35:23','Logged In'),('bmandyam','bmandyam','2017-03-28 10:35:55','Logged In'),('bmandyam','bmandyam','2017-03-28 10:42:35','Logged In'),('bmandyam','bmandyam','2017-03-28 10:54:40','Logged In'),('bmandyam','bmandyam','2017-03-28 10:56:40','Logged In'),('bmandyam','bmandyam','2017-03-28 11:00:19','Logged In'),('bmandyam','bmandyam','2017-03-28 11:09:26','Logged In'),('bmandyam','bmandyam','2017-03-28 11:30:48','Logged In'),('bmandyam','bmandyam','2017-03-28 11:34:04','Logged In'),('bmandyam','bmandyam','2017-03-28 11:50:30','Logged In'),('bmandyam','bmandyam','2017-03-28 11:52:36','Logged In'),('bmandyam','bmandyam','2017-03-28 12:00:39','Logged In'),('bmandyam','bmandyam','2017-03-28 12:03:11','Logged In'),('bmandyam','bmandyam','2017-03-28 12:20:57','Logged In'),('bmandyam','bmandyam','2017-03-28 18:42:48','Logged In'),('bmandyam','bmandyam','2017-03-28 18:43:44','Logged Out'),('bmandyam','bmandyam','2017-03-28 18:43:51','Logged In'),('bmandyam','bmandyam','2017-03-28 19:00:41','Logged Out'),('bmandyam','bmandyam','2017-03-28 19:00:58','Logged In'),('bmandyam','bmandyam','2017-03-28 19:01:02','Logged Out'),('bmandyam','bmandyam','2017-03-28 19:01:31','Logged In'),('bmandyam','bmandyam','2017-03-28 19:01:37','Logged Out'),('bmandyam','bmandyam','2017-03-30 10:04:41','Logged In'),('bmandyam','bmandyam','2017-03-30 10:05:22','Logged In'),('bmandyam','bmandyam','2017-03-30 10:09:49','Logged In'),('bmandyam','bmandyam','2017-03-30 10:27:20','Logged In'),('bmandyam','bmandyam','2017-03-30 10:45:10','Logged In'),('bmandyam','bmandyam','2017-03-30 11:09:08','Logged In'),('bmandyam','bmandyam','2017-03-30 11:21:03','Logged In'),('bmandyam','bmandyam','2017-03-30 12:26:53','Logged In'),('bmandyam','bmandyam','2017-03-30 12:54:31','Logged Out'),('bmandyam','bmandyam','2017-03-30 12:56:16','Logged In'),('bmandyam','bmandyam','2017-03-30 14:43:07','Logged In'),('bmandyam','bmandyam','2017-03-31 15:35:55','Logged In'),('bmandyam','bmandyam','2017-03-31 15:36:50','Logged In'),('bmandyam','bmandyam','2017-04-03 11:00:52','Logged In'),('bmandyam','bmandyam','2017-04-03 11:02:22','Logged In'),('bmandyam','bmandyam','2017-04-03 12:20:59','Logged In'),('bmandyam','bmandyam','2017-04-03 12:22:15','Logged In'),('bmandyam','bmandyam','2017-04-03 12:22:56','Logged In'),('bmandyam','bmandyam','2017-04-03 12:30:05','Logged In'),('bmandyam','bmandyam','2017-04-03 12:31:03','Logged In'),('bmandyam','bmandyam','2017-04-03 12:31:19','Logged In'),('bmandyam','bmandyam','2017-04-03 12:33:31','Logged In'),('bmandyam','bmandyam','2017-04-03 12:40:22','Logged In'),('bmandyam','bmandyam','2017-04-03 12:40:47','Logged In'),('bmandyam','bmandyam','2017-04-03 12:42:52','Logged In'),('bmandyam','bmandyam','2017-04-03 12:50:04','Logged In'),('bmandyam','bmandyam','2017-04-03 12:52:09','Logged In'),('bmandyam','bmandyam','2017-04-03 12:53:10','Logged In'),('bmandyam','bmandyam','2017-04-03 14:29:07','Logged In'),('bmandyam','bmandyam','2017-04-03 15:08:06','Logged In'),('bmandyam','bmandyam','2017-04-03 15:10:00','Logged In'),('bmandyam','bmandyam','2017-04-03 15:10:28','Logged In'),('bmandyam','bmandyam','2017-04-03 15:11:59','Logged In'),('bmandyam','bmandyam','2017-04-03 15:18:33','Logged In'),('bmandyam','bmandyam','2017-04-03 15:19:00','Logged In'),('bmandyam','bmandyam','2017-04-03 15:19:15','Logged In'),('bmandyam','bmandyam','2017-04-03 15:19:42','Logged In'),('bmandyam','bmandyam','2017-04-03 15:19:52','Logged In'),('bmandyam','bmandyam','2017-04-03 15:20:38','Logged In'),('bmandyam','bmandyam','2017-04-03 15:20:49','Logged In'),('bmandyam','bmandyam','2017-04-03 15:22:02','Logged In'),('bmandyam','','2017-04-03 15:28:59','Logged In'),('bmandyam','','2017-04-03 15:30:40','Logged In'),('bmandyam','bmandyam','2017-04-03 15:32:27','Logged In'),('bmandyam','bmandyam','2017-04-03 16:03:40','Logged In'),('bmandyam','bmandyam','2017-04-03 16:04:08','Logged In'),('bmandyam','bmandyam','2017-04-03 16:06:34','Logged In'),('bmandyam','bmandyam','2017-04-03 16:08:57','Logged In'),('bmandyam','bmandyam','2017-04-03 17:23:01','Logged In'),('bmandyam','bmandyam','2017-04-03 17:58:30','Logged In'),('bmandyam','bmandyam','2017-04-04 10:22:19','Logged In'),('bmandyam','bmandyam','2017-04-04 10:29:10','Logged In'),('bmandyam','b','2017-04-04 10:33:42','Logged In'),('bmandyam','bmandyam','2017-04-04 11:14:05','Logged In'),('bmandyam','bmandyam','2017-04-04 11:14:24','Logged In'),('bmandyam','bmandyam','2017-04-04 11:14:37','Logged In'),('bmandyam','bmandyam','2017-04-04 11:16:41','Logged In'),('bmandyam','bmandyam','2017-04-04 11:17:41','Logged In'),('bmandyam','bmandyam','2017-04-04 11:18:26','Logged In'),('bmandyam','bmandyam','2017-04-04 11:21:19','Logged In'),('bmandyam','bmandyam','2017-04-04 14:56:16','Logged In'),('bmandyam','bmandyam','2017-04-04 17:22:49','Logged In'),('bmandyam','bmandyam','2017-04-04 18:11:14','Logged In'),('bmandyam','bmandyam','2017-04-05 10:04:49','Logged In'),('bmandyam','bmandyam','2017-04-05 10:54:10','Logged In'),('bmandyam','bmandyam','2017-04-05 11:19:22','Logged In'),('bmandyam','bmandyam','2017-04-05 11:19:42','Logged Out'),('bmandyam','bmandyam','2017-04-05 11:20:07','Logged In'),('bmandyam','bmandyam','2017-04-05 16:25:19','Logged Out'),('bmandyam','bmandyam','2017-04-05 16:25:23','Logged In'),('bmandyam','bmandyam','2017-04-06 11:06:34','Logged In'),('bmandyam','bmandyam','2017-04-06 11:18:52','Logged In'),('bmandyam','bmandyam','2017-04-06 14:47:26','Logged Out'),('bmandyam','bmandyam','2017-04-06 14:47:29','Logged In'),('bmandyam','bmandyam','2017-04-06 15:15:41','Logged In'),('bmandyam','bmandyam','2017-04-06 17:05:58','Logged Out'),('bmandyam','bmandyam','2017-04-06 17:06:03','Logged In'),('bmandyam','bmandyam','2017-04-06 18:06:35','Logged Out'),('bmandyam','bmandyam','2017-04-06 18:06:39','Logged In'),('qas','qas','2017-04-06 18:22:08','Logged Out'),('bmandyam','bmandyam','2017-04-06 18:22:12','Logged In'),('bmandyam','bmandyam','2017-04-13 15:47:47','Logged In'),('bmandyam','bmandyam','2017-04-13 18:16:17','Logged In'),('bmandyam','bmandyam','2017-04-13 18:56:21','Logged In'),('bmandyam','bmandyam','2017-04-13 19:05:46','Logged Out'),('','','2017-04-13 19:05:49','Logged Out'),('bmandyam','bmandyam','2017-04-14 10:10:09','Logged In'),('bmandyam','bmandyam','2017-04-14 10:22:12','Logged Out'),('bmandyam','bmandyam','2017-04-14 10:22:19','Logged In'),('','','2017-04-14 10:34:42','Logged Out'),('bmandyam','bmandyam','2017-04-14 10:53:23','Logged In'),('bmandyam','bmandyam','2017-04-14 11:44:48','Logged Out'),('bmandyam','bmandyam','2017-04-14 11:44:52','Logged In'),('bmandyam','bmandyam','2017-04-17 18:40:27','Logged In'),('bmandyam','bmandyam','2017-04-18 10:14:42','Logged In'),('shantala','shantala','2017-04-18 10:40:55','Logged Out'),('bmandyam','bmandyam','2017-04-18 11:29:50','Logged In'),('bmandyam','bmandyam','2017-04-18 11:30:07','Logged Out'),('bmandyam','bmandyam','2017-04-18 12:58:15','Logged In'),('op','op','2017-04-18 14:27:29','Logged Out'),('bmandyam','bmandyam','2017-04-18 15:14:52','Logged In'),('bmandyam','bmandyam','2017-04-18 15:50:20','Logged Out'),('bmandyam','bmandyam','2017-04-19 10:13:53','Logged In'),('bmandyam','bmandyam','2017-04-19 11:21:32','Logged In'),('bmandyam','bmandyam','2017-04-19 11:33:51','Logged Out'),('bmandyam','bmandyam','2017-04-19 11:42:35','Logged In'),('bmandyam','bmandyam','2017-04-19 12:46:45','Logged Out'),('','','2017-04-19 12:46:50','Logged Out'),('bmandyam','bmandyam','2017-04-19 12:47:01','Logged In'),('bmandyam','bmandyam','2017-04-19 12:48:22','Logged Out'),('bmandyam','bmandyam','2017-04-19 14:56:11','Logged In'),('bmandyam','bmandyam','2017-04-19 15:06:48','Logged Out'),('bmandyam','bmandyam','2017-04-19 15:17:54','Logged In'),('','','2017-04-19 16:47:17','Logged Out'),('bmandyam','bmandyam','2017-04-19 17:56:11','Logged In'),('bmandyam','bmandyam','2017-04-20 13:23:35','Logged In'),('','','2017-04-20 15:38:23','Logged Out'),('bmandyam','bmandyam','2017-04-20 18:15:15','Logged In'),('bmandyam','bmandyam','2017-04-20 18:16:47','Logged In'),('bmandyam','bmandyam','2017-04-20 18:17:55','Logged Out'),('','','2017-04-20 18:17:57','Logged Out'),('bmandyam','bmandyam','2017-04-21 12:47:56','Logged In'),('bmandyam','bmandyam','2017-04-21 15:03:11','Logged In'),('bmandyam','bmandyam','2017-04-21 15:03:28','Logged In'),('purchasi','purchasing','2017-04-21 15:54:44','Logged Out'),('bmandyam','bmandyam','2017-04-24 16:10:06','Logged In'),('','','2017-04-24 17:48:35','Logged Out'),('ravi','ravi','2017-04-24 17:50:44','Logged In'),('ravi','ravi','2017-04-24 17:51:17','Logged Out'),('aero','aero','2017-04-24 17:51:45','Logged In'),('aero','aero','2017-04-24 17:51:59','Logged Out'),('bmandyam','bmandyam','2017-04-24 17:52:50','Logged In'),('bmandyam','bmandyam','2017-04-24 17:53:03','Logged Out'),('aero','aero','2017-04-24 17:53:13','Logged In'),('aero','aero','2017-04-24 17:53:39','Logged In'),('bmandyam','bmandyam','2017-04-24 18:25:24','Logged In'),('bmandyam','bmandyam','2017-04-26 14:39:30','Logged In'),('accounts','accounts','2017-04-26 14:39:41','Logged In'),('accounts','accounts','2017-04-26 14:40:45','Logged Out'),('bmandyam','bmandyam','2017-04-26 14:41:01','Logged In'),('bmandyam','bmandyam','2017-04-26 14:44:16','Logged Out'),('bmandyam','bmandyam','2017-04-28 13:00:02','Logged In'),('bmandyam','bmandyam','2017-04-28 14:34:40','Logged Out'),('sa','sa','2017-04-28 16:25:51','Logged In'),('sa','sa','2017-04-28 16:29:37','Logged Out'),('sa','sa','2017-04-28 16:30:20','Logged In'),('sa','sa','2017-04-28 16:36:12','Logged Out'),('bmandyam','bmandyam','2017-04-28 16:36:17','Logged In'),('bmandyam','bmandyam','2017-04-28 16:39:12','Logged Out'),('sa','sa','2017-04-28 16:39:18','Logged In'),('sa','sa','2017-04-28 17:13:24','Logged Out'),('','','2017-04-28 17:15:15','Logged Out'),('bmandyam','bmandyam','2017-05-02 10:19:53','Logged In'),('bmandyam','bmandyam','2017-05-02 10:36:13','Logged Out'),('sa_FSI','sa_FSI','2017-05-02 10:48:43','Logged In'),('sa_FSI','sa_FSI','2017-05-02 11:15:44','Logged Out'),('ashwini','ashwini','2017-05-02 11:16:05','Logged In'),('ashwini','ashwini','2017-05-02 11:16:52','Logged Out'),('sa_FSI','sa_FSI','2017-05-02 11:17:06','Logged In'),('sa_FSI','sa_FSI','2017-05-02 11:17:33','Logged Out'),('ashwini','ashwini','2017-05-02 11:17:46','Logged In'),('ashwini','ashwini','2017-05-02 11:19:00','Logged In'),('ashwini','ashwini','2017-05-02 11:20:28','Logged Out'),('ashwini','ashwini','2017-05-02 11:21:24','Logged In'),('','','2017-05-02 11:22:01','Logged Out'),('ashwini','ashwini','2017-05-02 11:22:13','Logged In'),('ashwini','ashwini','2017-05-02 11:23:50','Logged Out'),('sa_FSI','sa_FSI','2017-05-02 11:24:11','Logged In'),('sa_FSI','sa_FSI','2017-05-02 11:24:23','Logged In'),('sa_FSI','sa_FSI','2017-05-02 11:25:22','Logged In'),('sa_FSI','sa_FSI','2017-05-02 11:25:29','Logged Out'),('ashwini','ashwini','2017-05-02 11:25:39','Logged In'),('ashwini','ashwini','2017-05-02 11:26:44','Logged Out'),('ashwini','ashwini','2017-05-02 11:26:59','Logged In'),('ashwini','ashwini','2017-05-02 11:28:11','Logged Out'),('bmandyam','bmandyam','2017-05-02 11:28:14','Logged In'),('bmandyam','bmandyam','2017-05-02 11:29:20','Logged Out'),('ashwini','ashwini','2017-05-02 11:29:30','Logged In'),('ashwini','ashwini','2017-05-02 11:32:06','Logged In'),('ashwini','ashwini','2017-05-02 11:35:25','Logged Out'),('','','2017-05-02 11:38:45','Logged Out'),('ashwini','ashwini','2017-05-02 11:43:29','Logged In'),('bmandyam','bmandyam','2017-05-02 14:32:03','Logged Out'),('bmandyam','bmandyam','2017-05-02 16:14:53','Logged In'),('bmandyam','bmandyam','2017-05-02 16:16:16','Logged Out'),('sa','sa','2017-05-02 16:17:10','Logged In'),('sa','sa','2017-05-02 16:25:41','Logged Out'),('bmandyam','bmandyam','2017-05-02 18:07:18','Logged In'),('bmandyam','bmandyam','2017-05-02 19:10:41','Logged Out'),('bmandyam','bmandyam','2017-05-03 09:46:47','Logged In'),('bmandyam','bmandyam','2017-05-03 10:02:15','Logged Out'),('accounts','accounts','2017-05-03 10:02:34','Logged In'),('accounts','accounts','2017-05-03 10:07:21','Logged Out'),('bmandyam','bmandyam','2017-05-03 10:07:25','Logged In'),('bmandyam','bmandyam','2017-05-03 10:34:12','Logged Out'),('sa','sa','2017-05-03 10:34:18','Logged In'),('sa','sa','2017-05-03 10:55:04','Logged Out'),('bmandyam','bmandyam','2017-05-03 10:55:07','Logged In'),('bmandyam','bmandyam','2017-05-03 11:11:56','Logged Out'),('stores','stores','2017-05-03 11:12:06','Logged In'),('stores','stores','2017-05-03 11:24:17','Logged Out'),('bmandyam','bmandyam','2017-05-03 11:24:20','Logged In'),('bmandyam','bmandyam','2017-05-03 12:50:56','Logged Out'),('sa','sa','2017-05-03 12:51:02','Logged In'),('sa','sa','2017-05-03 13:13:01','Logged Out'),('stores','stores','2017-05-03 13:13:15','Logged In'),('bmandyam','bmandyam','2017-05-03 15:33:23','Logged Out'),('sa','sa','2017-05-03 15:33:37','Logged In'),('sa','sa','2017-05-03 15:34:34','Logged Out'),('stores','stores','2017-05-03 15:36:49','Logged Out'),('stores','stores','2017-05-03 15:36:57','Logged In'),('stores','stores','2017-05-03 15:45:05','Logged Out'),('bmandyam','bmandyam','2017-05-03 15:54:57','Logged In'),('bmandyam','bmandyam','2017-05-03 16:28:53','Logged Out'),('bmandyam','bmandyam','2017-05-03 16:28:58','Logged In'),('','','2017-05-03 18:41:45','Logged Out'),('stores','stores','2017-05-03 18:41:55','Logged In'),('bmandyam','bmandyam','2017-05-03 18:57:27','Logged Out'),('bmandyam','bmandyam','2017-05-03 18:57:30','Logged In'),('','','2017-05-03 19:00:42','Logged Out'),('','','2017-05-03 19:00:50','Logged Out'),('','','2017-05-04 12:03:14','Logged Out'),('stores','stores','2017-05-04 12:03:25','Logged In'),('stores','stores','2017-05-04 12:12:57','Logged In'),('stores','stores','2017-05-04 12:52:15','Logged Out'),('bmandyam','bmandyam','2017-05-04 12:52:20','Logged In'),('bmandyam','bmandyam','2017-05-04 12:53:42','Logged Out'),('stores','stores','2017-05-04 12:53:53','Logged In'),('stores','stores','2017-05-04 13:19:32','Logged Out'),('ppc1','ppc1','2017-05-04 13:22:18','Logged In'),('ppc1','ppc1','2017-05-04 14:54:49','Logged Out'),('bmandyam','bmandyam','2017-05-04 14:54:52','Logged In'),('bmandyam','bmandyam','2017-05-04 14:58:53','Logged Out'),('ppc1','ppc1','2017-05-04 14:59:03','Logged In'),('ppc1','ppc1','2017-05-04 15:59:15','Logged Out'),('qas','qas','2017-05-04 16:02:36','Logged In'),('qas','qas','2017-05-04 16:20:02','Logged Out'),('qas','qas','2017-05-04 16:20:08','Logged In'),('qas','qas','2017-05-04 16:36:29','Logged Out'),('purchasi','purchasing','2017-05-04 16:38:03','Logged In'),('purchasi','purchasing','2017-05-04 16:59:46','Logged Out'),('prodn','prodn','2017-05-04 16:59:55','Logged In'),('prodn','prodn','2017-05-04 17:04:25','Logged In'),('prodn','prodn','2017-05-04 17:11:44','Logged Out'),('accounts','accounts','2017-05-04 17:11:54','Logged In'),('accounts','accounts','2017-05-04 17:13:13','Logged In'),('accounts','accounts','2017-05-04 17:20:30','Logged Out'),('sa','sa','2017-05-04 17:20:34','Logged In'),('sa','sa','2017-05-04 17:23:47','Logged Out'),('WO','WO','2017-05-04 17:24:22','Logged In'),('wo','wo','2017-05-04 17:25:09','Logged In'),('wo','wo','2017-05-04 17:25:46','Logged In'),('wo','wo','2017-05-04 17:26:55','Logged In'),('wo','wo','2017-05-04 17:27:32','Logged In'),('wo','wo','2017-05-04 17:27:39','Logged In'),('wo','wo','2017-05-04 17:28:30','Logged In'),('wo','wo','2017-05-04 17:30:49','Logged In'),('bmandyam','bmandyam','2017-05-04 17:45:37','Logged Out'),('wo','wo','2017-05-04 17:45:48','Logged In'),('wo','wo','2017-05-04 17:45:57','Logged Out'),('prn','prn','2017-05-04 17:46:29','Logged In'),('prn','prn','2017-05-04 17:47:24','Logged Out'),('bmandyam','bmandyam','2017-05-05 10:17:56','Logged In'),('bmandyam','bmandyam','2017-05-05 13:02:03','Logged Out'),('','','2017-05-05 13:03:29','Logged Out'),('aero','aero','2017-05-05 13:04:45','Logged In'),('aero','aero','2017-05-05 13:06:32','Logged Out'),('','','2017-05-05 13:06:55','Logged Out'),('ravi','ravi','2017-05-05 13:07:13','Logged In'),('ravi','ravi','2017-05-05 14:28:56','Logged Out'),('purchasi','purchasing','2017-05-05 14:29:07','Logged In'),('purchasi','purchasing','2017-05-05 14:29:19','Logged Out'),('bmandyam','bmandyam','2017-05-05 14:29:22','Logged In'),('bmandyam','bmandyam','2017-05-05 14:36:38','Logged Out'),('bmandyam','bmandyam','2017-05-05 14:36:43','Logged In'),('bmandyam','bmandyam','2017-05-05 14:36:58','Logged Out'),('purchasi','purchasing','2017-05-05 14:37:09','Logged In'),('purchasi','purchasing','2017-05-05 14:37:22','Logged Out'),('ppc1','ppc1','2017-05-05 14:37:41','Logged In'),('ppc1','ppc1','2017-05-05 14:42:21','Logged Out'),('prodn','prodn','2017-05-05 14:42:30','Logged In'),('prodn','prodn','2017-05-05 14:42:42','Logged Out'),('qas','qas','2017-05-05 14:43:03','Logged In'),('qas','qas','2017-05-05 14:43:12','Logged Out'),('accounts','accounts','2017-05-05 14:43:26','Logged In'),('accounts','accounts','2017-05-05 14:44:12','Logged In'),('accounts','accounts','2017-05-05 14:44:14','Logged Out'),('accounts','accounts','2017-05-05 14:44:31','Logged In'),('accounts','accounts','2017-05-05 14:45:15','Logged In'),('accounts','accounts','2017-05-05 14:45:16','Logged Out'),('accounts','accounts','2017-05-05 14:45:24','Logged In'),('accounts','accounts','2017-05-05 14:45:34','Logged Out'),('wo','wo','2017-05-05 14:45:39','Logged In'),('wo','wo','2017-05-05 14:45:49','Logged Out'),('prn','prn','2017-05-05 14:45:59','Logged In'),('prn','prn','2017-05-05 14:46:06','Logged Out'),('HR','HR','2017-05-05 14:46:59','Logged In'),('HR','HR','2017-05-05 14:47:44','Logged In'),('HR','HR','2017-05-05 14:48:09','Logged In'),('HR','HR','2017-05-05 14:48:13','Logged Out'),('bmandyam','bmandyam','2017-05-05 18:32:07','Logged In'),('bmandyam','bmandyam','2017-05-11 10:11:51','Logged In'),('accounts','accounts','2017-05-11 16:07:31','Logged Out'),('bmandyam','bmandyam','2017-05-11 16:07:59','Logged In'),('accounts','accounts','2017-05-11 16:13:16','Logged Out'),('bmandyam','bmandyam','2017-05-11 16:13:22','Logged In'),('bmandyam','bmandyam','2017-05-12 10:15:04','Logged In'),('bmandyam','bmandyam','2017-05-12 11:36:08','Logged Out'),('bmandyam','bmandyam','2017-05-12 11:36:16','Logged In'),('bmandyam','bmandyam','2017-05-12 16:58:57','Logged Out'),('bmandyam','bmandyam','2017-05-12 16:59:04','Logged In'),('bmandyam','bmandyam','2017-05-12 18:08:23','Logged In'),('bmandyam','bmandyam','2017-05-12 18:09:21','Logged In'),('bmandyam','bmandyam','2017-05-12 19:05:58','Logged Out'),('','','2017-05-12 19:06:01','Logged Out'),('bmandyam','bmandyam','2017-05-12 19:08:50','Logged In'),('bmandyam','bmandyam','2017-05-12 19:09:22','Logged In'),('bmandyam','bmandyam','2017-05-15 10:03:00','Logged In'),('bmandyam','bmandyam','2017-05-15 11:27:23','Logged Out'),('bmandyam','bmandyam','2017-05-15 11:27:32','Logged In'),('bmandyam','bmandyam','2017-05-15 15:36:52','Logged Out'),('aero','aero','2017-05-15 15:42:23','Logged In'),('aero','aero','2017-05-15 15:45:35','Logged In'),('aero','aero','2017-05-15 15:46:32','Logged Out'),('asha','asha','2017-05-15 15:46:44','Logged In'),('asha','asha','2017-05-15 16:40:22','Logged Out'),('bmandyam','bmandyam','2017-05-15 16:40:29','Logged In'),('bmandyam','bmandyam','2017-05-15 18:58:45','Logged Out'),('','','2017-05-15 18:59:40','Logged Out'),('','','2017-05-15 18:59:43','Logged Out'),('bmandyam','bmandyam','2017-05-16 10:18:08','Logged In'),('bmandyam','bmandyam','2017-05-16 10:19:29','Logged In'),('bmandyam','bmandyam','2017-05-16 11:24:11','Logged In'),('bmandyam','bmandyam','2017-05-20 11:35:14','Logged In'),('bmandyam','bmandyam','2017-05-30 16:38:20','Logged In'),('bmandyam','bmandyam','2017-05-31 10:45:27','Logged In'),('bmandyam','bmandyam','2017-05-31 10:51:57','Logged Out'),('bmandyam','bmandyam','2017-05-31 14:51:03','Logged In'),('','','2017-05-31 14:55:40','Logged Out'),('bmandyam','bmandyam','2017-05-31 14:55:45','Logged In'),('bmandyam','bmandyam','2017-06-20 09:37:23','Logged In'),('bmandyam','bmandyam','2017-06-20 10:01:10','Logged Out'),('bmandyam','bmandyam','2017-06-20 16:01:49','Logged In'),('bmandyam','bmandyam','2017-06-20 17:00:59','Logged Out'),('bmandyam','bmandyam','2017-06-20 17:01:05','Logged In'),('bmandyam','bmandyam','2017-06-21 09:38:47','Logged In'),('','','2017-06-21 16:33:50','Logged Out'),('bmandyam','bmandyam','2017-06-21 16:33:55','Logged In'),('','','2017-06-21 18:10:24','Logged Out'),('bmandyam','bmandyam','2017-06-21 18:10:31','Logged In'),('bmandyam','bmandyam','2017-06-30 19:20:32','Logged In'),('bmandyam','bmandyam','2017-07-01 10:54:06','Logged In'),('bmandyam','bmandyam','2017-07-01 11:06:48','Logged Out'),('bmandyam','bmandyam','2017-07-01 11:12:14','Logged In'),('bmandyam','bmandyam','2017-07-03 15:18:02','Logged In'),('asd','asd','2017-07-05 11:11:48','Logged In'),('asd','asd','2017-07-05 11:23:35','Logged Out'),('bmandyam','bmandyam','2017-07-11 13:33:21','Logged Out'),('bmandyam','bmandyam','2017-07-11 13:33:30','Logged In'),('bmandyam','bmandyam','2017-07-11 13:36:27','Logged Out'),('bmandyam','bmandyam','2017-07-11 13:36:39','Logged In'),('bmandyam','bmandyam','2017-07-11 13:38:50','Logged Out'),('','','2017-07-11 13:38:52','Logged Out'),('bmandyam','bmandyam','2017-07-11 13:39:00','Logged In'),('bmandyam','bmandyam','2017-07-11 13:39:41','Logged Out'),('bmandyam','bmandyam','2017-07-11 14:35:10','Logged In'),('bmandyam','bmandyam','2017-07-11 15:03:04','Logged Out'),('bmandyam','bmandyam','2017-07-11 15:16:09','Logged In'),('bmandyam','bmandyam','2017-07-18 16:01:26','Logged In'),('bmandyam','bmandyam','2017-07-18 16:28:11','Logged In'),('bmandyam','bmandyam','2017-07-18 16:35:20','Logged Out'),('bmandyam','bmandyam','2017-07-21 10:33:13','Logged In'),('accounts','accounts','2017-07-21 17:15:28','Logged Out'),('bmandyam','bmandyam','2017-07-24 12:13:35','Logged In'),('bmandyam','bmandyam','2017-07-24 12:39:45','Logged Out'),('ravi','ravi','2017-07-24 12:39:52','Logged In'),('ravi','ravi','2017-07-24 12:40:45','Logged Out'),('bmandyam','bmandyam','2017-07-25 10:24:22','Logged In'),('','','2017-07-25 12:41:21','Logged Out'),('bmandyam','bmandyam','2017-07-25 12:41:26','Logged In'),('bmandyam','bmandyam','2017-07-25 12:52:15','Logged In'),('bmandyam','bmandyam','2017-07-25 12:54:05','Logged Out'),('asha','asha','2017-07-25 12:54:14','Logged In'),('asha','asha','2017-07-25 12:59:50','Logged Out'),('bmandyam','bmandyam','2017-07-25 13:00:07','Logged In'),('bmandyam','bmandyam','2017-07-25 17:43:43','Logged In'),('ashorroc','ashorrock','2017-07-25 18:53:43','Logged Out'),('bmandyam','bmandyam','2017-07-25 18:53:48','Logged In'),('bmandyam','bmandyam','2017-07-25 19:06:01','Logged Out'),('bmandyam','bmandyam','2017-07-26 10:17:17','Logged In'),('bmandyam','bmandyam','2017-07-26 10:22:30','Logged In'),('bmandyam','bmandyam','2017-07-26 11:00:16','Logged Out'),('bmandyam','bmandyam','2017-07-27 12:28:28','Logged In'),('','','2017-07-27 13:07:07','Logged Out'),('bmandyam','bmandyam','2017-07-27 13:07:12','Logged In'),('bmandyam','bmandyam','2017-07-27 15:13:55','Logged Out'),('','','2017-07-27 15:14:35','Logged Out'),('bmandyam','bmandyam','2017-07-31 17:07:31','Logged In'),('bmandyam','bmandyam','2017-07-31 18:03:37','Logged Out'),('bmandyam','bmandyam','2017-07-31 18:03:42','Logged In'),('bmandyam','bmandyam','2017-07-31 18:42:42','Logged Out'),('bmandyam','bmandyam','2017-07-31 18:42:47','Logged In'),('bmandyam','bmandyam','2017-08-01 10:20:04','Logged In'),('bmandyam','bmandyam','2017-08-01 15:26:29','Logged In'),('bmandyam','bmandyam','2017-08-01 15:28:31','Logged Out'),('bmandyam','bmandyam','2017-08-01 17:09:09','Logged In'),('bmandyam','bmandyam','2017-08-01 17:09:15','Logged Out'),('bmandyam','bmandyam','2017-08-01 17:09:32','Logged In'),('bmandyam','bmandyam','2017-08-01 19:15:32','Logged In'),('','','2017-08-03 12:39:26','Logged Out'),('bmandyam','bmandyam','2017-08-03 12:39:34','Logged In'),('bmandyam','bmandyam','2017-08-03 13:09:44','Logged Out'),('sa','sa','2017-08-03 13:09:49','Logged In'),('sa','sa','2017-08-03 13:12:06','Logged Out'),('bmandyam','bmandyam','2017-08-03 13:12:13','Logged In'),('bmandyam','bmandyam','2017-08-03 13:37:13','Logged Out'),('sa','sa','2017-08-03 13:37:19','Logged In'),('sa','sa','2017-08-03 13:39:35','Logged In'),('sa','sa','2017-08-03 13:39:45','Logged Out'),('bmandyam','bmandyam','2017-08-03 13:39:52','Logged In'),('sa','sa','2017-08-03 18:24:57','Logged Out'),('bmandyam','bmandyam','2017-08-04 10:40:09','Logged In'),('bmandyam','bmandyam','2017-08-04 10:40:15','Logged Out'),('sa','sa','2017-08-04 10:40:20','Logged In'),('sa','sa','2017-08-04 10:46:23','Logged In'),('sa','sa','2017-08-04 10:46:26','Logged Out'),('','','2017-08-04 10:46:29','Logged Out'),('bmandyam','bmandyam','2017-08-04 10:46:37','Logged In'),('bmandyam','bmandyam','2017-08-04 10:54:22','Logged Out'),('','','2017-08-04 10:59:25','Logged Out'),('bmandyam','bmandyam','2017-08-04 10:59:32','Logged In'),('sa','sa','2017-08-04 11:33:16','Logged In'),('bmandyam','bmandyam','2017-08-04 11:33:36','Logged In'),('bmandyam','bmandyam','2017-08-05 11:13:33','Logged In'),('bmandyam','bmandyam','2017-08-05 16:35:03','Logged Out'),('bmandyam','bmandyam','2017-08-05 16:35:15','Logged In'),('bmandyam','bmandyam','2017-08-07 10:36:30','Logged In'),('bmandyam','bmandyam','2017-08-07 17:29:47','Logged Out'),('sa','sa','2017-08-07 17:29:52','Logged In'),('sa','sa','2017-08-07 17:31:10','Logged Out'),('bmandyam','bmandyam','2017-08-07 17:31:16','Logged In'),('bmandyam','bmandyam','2017-08-07 17:32:35','Logged Out'),('sa','sa','2017-08-07 17:32:38','Logged In'),('bmandyam','bmandyam','2017-08-07 18:24:58','Logged In'),('bmandyam','bmandyam','2017-08-07 18:27:34','Logged Out'),('sa','sa','2017-08-07 18:27:39','Logged In'),('sa','sa','2017-08-07 18:28:39','Logged Out'),('bmandyam','bmandyam','2017-08-07 18:28:45','Logged In'),('bmandyam','bmandyam','2017-08-07 18:33:31','Logged Out'),('sa','sa','2017-08-07 18:33:51','Logged In'),('sa','sa','2017-08-07 18:34:26','Logged Out'),('bmandyam','bmandyam','2017-08-07 18:34:33','Logged In'),('sa','sa','2017-08-07 18:34:50','Logged In'),('sa','sa','2017-08-07 18:46:46','Logged In'),('','','2017-08-08 11:02:37','Logged Out'),('bmandyam','bmandyam','2017-08-08 11:02:46','Logged In'),('sa','sa','2017-08-08 11:03:10','Logged In'),('sa','sa','2017-08-08 11:11:56','Logged Out'),('bmandyam','bmandyam','2017-08-08 12:21:15','Logged In'),('','','2017-08-08 12:32:54','Logged Out'),('sa','sa','2017-08-08 12:32:58','Logged In'),('sa','sa','2017-08-08 14:18:01','Logged Out'),('sa','sa','2017-08-08 15:27:43','Logged In'),('bmandyam','bmandyam','2017-08-08 19:22:40','Logged Out'),('','','2017-08-08 19:22:44','Logged Out'),('bmandyam','bmandyam','2017-08-09 10:22:26','Logged In'),('bmandyam','bmandyam','2017-08-09 10:26:03','Logged In'),('stores_s','stores_sez','2017-08-09 12:16:06','Logged Out'),('bmandyam','bmandyam','2017-08-09 12:16:09','Logged In'),('bmandyam','bmandyam','2017-08-09 12:18:47','Logged Out'),('sa','sa','2017-08-09 12:18:51','Logged In'),('sa','sa','2017-08-09 12:20:32','Logged Out'),('bmandyam','bmandyam','2017-08-09 12:20:37','Logged In'),('bmandyam','bmandyam','2017-08-09 12:48:28','Logged Out'),('bmandyam','bmandyam','2017-08-09 12:48:35','Logged In'),('bmandyam','bmandyam','2017-08-09 15:15:17','Logged Out'),('bmandyam','bmandyam','2017-08-09 15:15:23','Logged In'),('bmandyam','bmandyam','2017-08-09 15:36:50','Logged Out'),('sa','sa','2017-08-09 15:36:55','Logged In'),('bmandyam','bmandyam','2017-08-09 17:10:20','Logged In'),('bmandyam','bmandyam','2017-08-09 18:57:34','Logged In'),('bmandyam','bmandyam','2017-08-09 18:59:19','Logged Out'),('bmandyam','bmandyam','2017-08-10 10:09:03','Logged In'),('bmandyam','bmandyam','2017-08-10 10:36:39','Logged Out'),('sa','sa','2017-08-10 10:36:46','Logged In'),('sa','sa','2017-08-10 10:42:13','Logged Out'),('bmandyam','bmandyam','2017-08-10 10:42:17','Logged In'),('stores_s','stores_sez','2017-08-10 12:31:13','Logged Out'),('bmandyam','bmandyam','2017-08-10 12:31:17','Logged In'),('bmandyam','bmandyam','2017-08-10 16:05:22','Logged In'),('bmandyam','bmandyam','2017-08-10 18:36:08','Logged In'),('bmandyam','bmandyam','2017-08-10 18:36:14','Logged Out'),('sa','sa','2017-08-10 18:36:20','Logged In'),('sa','sa','2017-08-10 18:44:12','Logged Out'),('','','2017-08-10 18:44:20','Logged Out'),('sa','sa','2017-08-10 18:44:25','Logged In'),('sa','sa','2017-08-10 18:47:33','Logged Out'),('bmandyam','bmandyam','2017-08-10 18:47:38','Logged In'),('bmandyam','bmandyam','2017-08-11 13:09:14','Logged In'),('bmandyam','bmandyam','2017-08-11 13:09:57','Logged Out'),('sa','sa','2017-08-11 13:10:01','Logged In'),('sa','sa','2017-08-11 13:10:42','Logged Out'),('bmandyam','bmandyam','2017-08-11 13:10:46','Logged In'),('bmandyam','bmandyam','2017-08-11 13:15:25','Logged Out'),('bmandyam','bmandyam','2017-08-11 13:15:33','Logged In'),('bmandyam','bmandyam','2017-08-11 13:15:39','Logged Out'),('bmandyam','bmandyam','2017-08-14 10:16:11','Logged In'),('bmandyam','bmandyam','2017-08-14 10:24:00','Logged Out'),('sa','sa','2017-08-14 10:24:04','Logged In'),('sa','sa','2017-08-14 11:09:51','Logged Out'),('bmandyam','bmandyam','2017-08-14 11:09:57','Logged In'),('bmandyam','bmandyam','2017-08-14 11:11:12','Logged Out'),('sa','sa','2017-08-14 11:11:17','Logged In'),('accounts','accounts','2017-08-14 11:42:00','Logged Out'),('sa','sa','2017-08-14 11:42:05','Logged In'),('sa','sa','2017-08-14 12:33:21','Logged Out'),('bmandyam','bmandyam','2017-08-14 12:33:24','Logged In'),('bmandyam','bmandyam','2017-08-14 16:46:13','Logged Out'),('sa','sa','2017-08-14 16:47:56','Logged In'),('sa','sa','2017-08-14 16:54:45','Logged Out'),('bmandyam','bmandyam','2017-08-14 16:54:49','Logged In'),('bmandyam','bmandyam','2017-08-14 16:58:41','Logged Out'),('sa','sa','2017-08-14 16:58:44','Logged In'),('sa','sa','2017-08-14 17:00:06','Logged Out'),('bmandyam','bmandyam','2017-08-14 17:00:13','Logged In'),('bmandyam','bmandyam','2017-08-14 17:02:19','Logged Out'),('sa','sa','2017-08-14 17:02:24','Logged In'),('sa','sa','2017-08-14 17:02:46','Logged Out'),('bmandyam','bmandyam','2017-08-14 17:02:50','Logged In'),('bmandyam','bmandyam','2017-08-14 18:05:53','Logged Out'),('sa','sa','2017-08-14 18:05:57','Logged In'),('sa','sa','2017-08-14 18:35:35','Logged Out'),('bmandyam','bmandyam','2017-08-14 18:35:39','Logged In'),('bmandyam','bmandyam','2017-08-14 18:47:11','Logged Out'),('sa','sa','2017-08-14 18:47:14','Logged In'),('sa','sa','2017-08-14 18:57:59','Logged Out'),('bmandyam','bmandyam','2017-08-14 18:58:06','Logged In'),('bmandyam','bmandyam','2017-08-16 10:03:31','Logged In'),('bmandyam','bmandyam','2017-08-16 14:42:17','Logged Out'),('bmandyam','bmandyam','2017-08-16 14:42:21','Logged In'),('bmandyam','bmandyam','2017-08-16 14:50:37','Logged Out'),('bmandyam','bmandyam','2017-08-16 14:50:51','Logged In'),('bmandyam','bmandyam','2017-08-16 17:09:56','Logged Out'),('bmandyam','bmandyam','2017-08-16 17:10:08','Logged In'),('bmandyam','bmandyam','2017-08-16 17:58:57','Logged Out'),('sa','sa','2017-08-16 17:59:02','Logged In'),('sa','sa','2017-08-16 18:06:50','Logged Out'),('bmandyam','bmandyam','2017-08-16 18:06:53','Logged In'),('bmandyam','bmandyam','2017-08-16 19:02:21','Logged Out'),('bmandyam','bmandyam','2017-08-16 19:02:33','Logged In'),('bmandyam','bmandyam','2017-08-16 19:12:27','Logged In'),('bmandyam','bmandyam','2017-08-16 19:13:30','Logged Out'),('bmandyam','bmandyam','2017-08-17 10:23:15','Logged In'),('bmandyam','bmandyam','2017-08-17 10:33:34','Logged Out'),('bmandyam','bmandyam','2017-08-17 10:33:38','Logged In'),('bmandyam','bmandyam','2017-08-17 10:33:41','Logged Out'),('sa','sa','2017-08-17 10:33:46','Logged In'),('sa','sa','2017-08-17 10:35:04','Logged Out'),('bmandyam','bmandyam','2017-08-17 10:35:08','Logged In'),('bmandyam','bmandyam','2017-08-17 10:37:51','Logged Out'),('sa','sa','2017-08-17 10:37:56','Logged In'),('sa','sa','2017-08-17 10:38:12','Logged Out'),('bmandyam','bmandyam','2017-08-17 10:38:17','Logged In'),('accounts','accounts','2017-08-17 11:02:27','Logged Out'),('bmandyam','bmandyam','2017-08-17 11:02:30','Logged In'),('bmandyam','bmandyam','2017-08-17 11:06:54','Logged Out'),('bmandyam','bmandyam','2017-08-17 11:06:59','Logged In'),('bmandyam','bmandyam','2017-08-17 11:16:20','Logged Out'),('sa','sa','2017-08-17 11:16:23','Logged In'),('sa','sa','2017-08-17 11:17:40','Logged Out'),('bmandyam','bmandyam','2017-08-17 11:17:43','Logged In'),('bmandyam','bmandyam','2017-08-17 19:09:51','Logged In'),('bmandyam','bmandyam','2017-08-17 19:24:58','Logged Out'),('sa','sa','2017-08-17 19:25:14','Logged In'),('sa','sa','2017-08-17 19:32:22','Logged Out'),('bmandyam','bmandyam','2017-08-17 19:32:27','Logged In'),('bmandyam','bmandyam','2017-08-17 19:32:56','Logged Out'),('bmandyam','bmandyam','2017-08-18 10:57:36','Logged In'),('bmandyam','bmandyam','2017-08-21 16:33:01','Logged In'),('stores','stores','2017-08-21 16:50:09','Logged Out'),('bmandyam','bmandyam','2017-08-21 16:50:14','Logged In'),('stores','stores','2017-08-21 16:56:43','Logged Out'),('bmandyam','bmandyam','2017-08-21 16:56:47','Logged In'),('bmandyam','bmandyam','2017-08-21 17:01:48','Logged Out'),('sa','sa','2017-08-21 17:01:51','Logged In'),('sa','sa','2017-08-21 17:03:02','Logged Out'),('bmandyam','bmandyam','2017-08-21 17:03:06','Logged In'),('bmandyam','bmandyam','2017-08-22 10:22:37','Logged In'),('bmandyam','bmandyam','2017-08-22 10:27:14','Logged In'),('bmandyam','bmandyam','2017-08-22 10:28:04','Logged In'),('bmandyam','bmandyam','2017-08-22 10:28:51','Logged In'),('bmandyam','bmandyam','2017-08-22 11:35:22','Logged In'),('bmandyam','bmandyam','2017-08-23 15:48:23','Logged In'),('bmandyam','bmandyam','2017-08-23 17:42:04','Logged In'),('bmandyam','bmandyam','2017-08-24 10:08:52','Logged In'),('bmandyam','bmandyam','2017-08-24 11:14:09','Logged In'),('qas_sez','qas_sez','2017-08-24 15:03:58','Logged Out'),('bmandyam','bmandyam','2017-08-24 15:04:02','Logged In'),('qas_sez','qas_sez','2017-08-24 16:42:20','Logged Out'),('bmandyam','bmandyam','2017-08-24 16:42:24','Logged In'),('qas_sez','qas_sez','2017-08-24 17:22:48','Logged Out'),('bmandyam','bmandyam','2017-08-24 17:22:57','Logged In'),('bmandyam','bmandyam','2017-08-24 18:27:26','Logged Out'),('bmandyam','bmandyam','2017-08-24 18:27:30','Logged In'),('bmandyam','bmandyam','2017-08-24 19:06:41','Logged Out'),('bmandyam','bmandyam','2017-08-24 19:06:49','Logged In'),('bmandyam','bmandyam','2017-08-24 20:19:58','Logged Out'),('bmandyam','bmandyam','2017-08-24 20:20:03','Logged In'),('bmandyam','bmandyam','2017-08-24 20:35:38','Logged Out'),('bmandyam','bmandyam','2017-08-28 11:02:23','Logged In'),('stores','stores','2017-08-28 12:09:53','Logged Out'),('bmandyam','bmandyam','2017-08-28 12:09:57','Logged In'),('bmandyam','bmandyam','2017-08-28 12:21:54','Logged In'),('bmandyam','bmandyam','2017-08-28 12:22:21','Logged In'),('bmandyam','bmandyam','2017-08-28 12:27:05','Logged In'),('bmandyam','bmandyam','2017-08-28 12:43:58','Logged Out'),('bmandyam','bmandyam','2017-08-28 12:44:02','Logged In'),('bmandyam','bmandyam','2017-08-28 13:00:22','Logged Out'),('bmandyam','bmandyam','2017-08-28 13:00:29','Logged In'),('bmandyam','bmandyam','2017-08-28 13:22:33','Logged Out'),('bmandyam','bmandyam','2017-08-28 13:22:37','Logged In'),('bmandyam','bmandyam','2017-08-28 14:40:17','Logged Out'),('bmandyam','bmandyam','2017-08-28 14:40:21','Logged In'),('bmandyam','bmandyam','2017-08-28 18:06:19','Logged Out'),('bmandyam','bmandyam','2017-08-28 18:06:24','Logged In'),('stores_s','stores_sez','2017-08-28 18:46:22','Logged Out'),('bmandyam','bmandyam','2017-08-28 18:46:29','Logged In'),('bmandyam','bmandyam','2017-08-28 19:06:49','Logged In'),('bmandyam','bmandyam','2017-08-28 19:07:19','Logged Out'),('sa','sa','2017-08-28 19:07:24','Logged In'),('sa','sa','2017-08-28 19:31:19','Logged Out'),('bmandyam','bmandyam','2017-08-28 19:31:24','Logged In'),('bmandyam','bmandyam','2017-08-28 19:56:08','Logged Out'),('bmandyam','bmandyam','2017-08-28 19:56:12','Logged In'),('bmandyam','bmandyam','2017-08-29 10:09:26','Logged In'),('bmandyam','bmandyam','2017-08-29 10:36:23','Logged In'),('bmandyam','bmandyam','2017-08-29 11:23:17','Logged Out'),('bmandyam','bmandyam','2017-08-29 11:23:21','Logged In'),('bmandyam','bmandyam','2017-08-29 11:23:23','Logged In'),('bmandyam','bmandyam','2017-08-29 11:47:47','Logged Out'),('sa','sa','2017-08-29 11:47:51','Logged In'),('sa','sa','2017-08-29 11:48:20','Logged Out'),('bmandyam','bmandyam','2017-08-29 11:48:28','Logged In'),('bmandyam','bmandyam','2017-08-29 11:49:30','Logged Out'),('sa','sa','2017-08-29 11:49:36','Logged In'),('sa','sa','2017-08-29 11:51:40','Logged Out'),('bmandyam','bmandyam','2017-08-29 11:51:49','Logged In'),('bmandyam','bmandyam','2017-08-29 11:52:49','Logged Out'),('bmandyam','bmandyam','2017-08-29 11:52:53','Logged In'),('bmandyam','bmandyam','2017-08-29 12:02:33','Logged Out'),('sa','sa','2017-08-29 12:02:40','Logged In'),('sa','sa','2017-08-29 12:04:02','Logged Out'),('bmandyam','bmandyam','2017-08-29 12:04:06','Logged In'),('bmandyam','bmandyam','2017-09-07 02:28:55','Logged In'),('bmandyam','bmandyam','2017-09-07 02:29:05','Logged Out'),('','','2017-09-07 02:33:59','Logged Out'),('bmandyam','bmandyam','2017-09-07 07:04:41','Logged In'),('bmandyam','bmandyam','2017-09-07 07:11:59','Logged Out'),('sa','sa','2017-09-07 07:12:08','Logged In'),('bmandyam','bmandyam','2017-09-07 07:17:53','Logged In'),('sa','sa','2017-09-07 07:19:53','Logged Out'),('manu','manu','2017-09-07 07:20:05','Logged In'),('manu','manu','2017-09-07 07:20:21','Logged In'),('manu','manu','2017-09-07 07:20:31','Logged In'),('manu','manu','2017-09-07 07:30:21','Logged In'),('sa','sa','2017-09-07 07:35:48','Logged In'),('sa','sa','2017-09-07 07:36:20','Logged Out'),('manu','manu','2017-09-07 07:36:27','Logged In'),('bmandyam','bmandyam','2017-09-07 15:01:00','Logged Out'),('bmandyam','bmandyam','2017-09-07 15:01:05','Logged In'),('bmandyam','bmandyam','2017-09-08 10:57:08','Logged In'),('bmandyam','bmandyam','2017-09-12 12:33:04','Logged In'),('bmandyam','bmandyam','2017-09-12 12:53:21','Logged Out'),('bmandyam','bmandyam','2017-09-12 12:53:25','Logged In'),('bmandyam','bmandyam','2017-09-12 12:56:42','Logged Out'),('sa','sa','2017-09-12 12:56:47','Logged In'),('sa','sa','2017-09-12 13:05:24','Logged Out'),('bmandyam','bmandyam','2017-09-12 13:05:29','Logged In'),('bmandyam','bmandyam','2017-09-12 15:22:04','Logged Out'),('sa','sa','2017-09-12 15:22:12','Logged In'),('sa','sa','2017-09-12 15:39:45','Logged Out'),('bmandyam','bmandyam','2017-09-12 15:39:54','Logged In'),('bmandyam','bmandyam','2017-09-12 16:11:01','Logged In'),('bmandyam','bmandyam','2017-09-12 17:19:05','Logged Out'),('bmandyam','bmandyam','2017-09-12 17:19:08','Logged In'),('bmandyam','bmandyam','2017-09-12 18:54:23','Logged Out'),('','','2017-09-12 18:54:28','Logged Out'),('bmandyam','bmandyam','2017-09-12 18:59:58','Logged In'),('bmandyam','bmandyam','2017-09-12 19:07:39','Logged Out'),('bmandyam','bmandyam','2017-09-13 10:24:17','Logged In'),('bmandyam','bmandyam','2017-09-13 12:10:27','Logged Out'),('bmandyam','bmandyam','2017-09-13 12:10:30','Logged In'),('bmandyam','bmandyam','2017-09-13 13:16:09','Logged Out'),('bmandyam','bmandyam','2017-09-13 13:16:15','Logged In'),('bmandyam','bmandyam','2017-09-13 15:09:22','Logged In'),('bmandyam','bmandyam','2017-09-13 16:50:38','Logged Out'),('bmandyam','bmandyam','2017-09-13 16:50:53','Logged In'),('bmandyam','bmandyam','2017-09-13 17:18:45','Logged Out'),('bmandyam','bmandyam','2017-09-13 17:18:49','Logged In'),('bmandyam','bmandyam','2017-09-13 18:52:14','Logged Out'),('bmandyam','bmandyam','2017-09-13 18:52:18','Logged In'),('bmandyam','bmandyam','2017-09-13 18:59:31','Logged Out'),('bmandyam','bmandyam','2017-09-13 19:00:31','Logged In'),('bmandyam','bmandyam','2017-09-14 11:01:33','Logged In'),('qas_aero','qas_aero','2017-09-14 13:08:26','Logged Out'),('bmandyam','bmandyam','2017-09-14 13:08:31','Logged In'),('bmandyam','bmandyam','2017-09-14 15:06:40','Logged In'),('accounts','accounts','2017-09-14 16:12:42','Logged Out'),('','','2017-09-14 16:12:46','Logged Out'),('bmandyam','bmandyam','2017-09-14 16:12:53','Logged In'),('bmandyam','bmandyam','2017-09-25 18:01:26','Logged In'),('bmandyam','bmandyam','2017-09-25 18:05:35','Logged Out'),('sa','sa','2017-11-03 10:36:37','Logged In'),('sa','sa','2017-11-03 10:36:46','Logged Out'),('bmandyam','bmandyam','2017-11-03 10:36:50','Logged In'),('bmandyam','bmandyam','2017-11-03 16:07:53','Logged In'),('bmandyam','bmandyam','2017-11-03 16:09:31','Logged In'),('bmandyam','bmandyam','2017-11-03 16:12:01','Logged Out'),('sa','sa','2017-11-03 16:12:06','Logged In'),('sa','sa','2017-11-03 16:16:49','Logged Out'),('bmandyam','bmandyam','2017-11-03 16:16:57','Logged In'),('bmandyam','bmandyam','2017-11-03 17:16:15','Logged Out'),('sa','sa','2017-11-03 17:16:22','Logged In'),('sa','sa','2017-11-03 17:47:37','Logged Out'),('','','2017-11-03 17:47:45','Logged Out'),('bmandyam','bmandyam','2017-11-03 17:47:49','Logged In'),('bmandyam','bmandyam','2017-11-03 18:03:33','Logged Out'),('sa','sa','2017-11-03 18:03:38','Logged In'),('sa','sa','2017-11-03 18:05:17','Logged Out'),('bmandyam','bmandyam','2017-11-03 18:05:21','Logged In'),('bmandyam','bmandyam','2017-11-03 18:23:09','Logged Out'),('sa','sa','2017-11-03 18:23:13','Logged In'),('sa','sa','2017-11-03 18:24:05','Logged Out'),('bmandyam','bmandyam','2017-11-03 18:24:12','Logged In'),('bmandyam','bmandyam','2017-11-13 10:59:52','Logged In'),('bmandyam','bmandyam','2017-11-13 11:21:04','Logged In'),('bmandyam','bmandyam','2017-11-13 11:21:54','Logged Out'),('bmandyam','bmandyam','2017-11-13 11:21:58','Logged In'),('sa','sa','2017-11-13 11:58:40','Logged Out'),('bmandyam','bmandyam','2017-11-13 11:58:48','Logged In'),('bmandyam','bmandyam','2017-11-13 12:56:13','Logged Out'),('sa','sa','2017-11-13 12:56:22','Logged In'),('sa','sa','2017-11-13 12:58:05','Logged Out'),('bmandyam','bmandyam','2017-11-13 12:58:13','Logged In'),('bmandyam','bmandyam','2017-11-14 10:04:37','Logged In'),('bmandyam','bmandyam','2017-11-14 15:26:28','Logged Out'),('sa','sa','2017-11-14 15:26:33','Logged In'),('sa','sa','2017-11-14 15:28:41','Logged Out'),('bmandyam','bmandyam','2017-11-14 15:28:47','Logged In'),('bmandyam','bmandyam','2017-11-15 10:18:59','Logged In'),('bmandyam','bmandyam','2017-11-15 18:38:37','Logged Out'),('sa','sa','2017-11-15 18:38:41','Logged In'),('sa','sa','2017-11-15 18:41:05','Logged Out'),('bmandyam','bmandyam','2017-11-15 18:41:13','Logged In'),('bmandyam','bmandyam','2017-11-16 12:08:46','Logged In'),('bmandyam','bmandyam','2017-11-16 18:54:09','Logged Out'),('bmandyam','bmandyam','2017-11-17 12:57:23','Logged In'),('bmandyam','bmandyam','2017-11-20 09:51:38','Logged In'),('bmandyam','bmandyam','2017-11-21 12:37:56','Logged In'),('bmandyam','bmandyam','2017-11-21 12:48:41','Logged Out'),('sa','sa','2017-11-21 12:48:50','Logged In'),('sa','sa','2017-11-21 12:54:40','Logged Out'),('bmandyam','bmandyam','2017-11-21 12:54:47','Logged In'),('bmandyam','bmandyam','2017-11-21 13:01:11','Logged Out'),('sa','sa','2017-11-21 13:01:14','Logged In'),('sa','sa','2017-11-21 13:02:34','Logged Out'),('bmandyam','bmandyam','2017-11-21 13:02:42','Logged In'),('bmandyam','bmandyam','2017-11-22 10:03:47','Logged In'),('bmandyam','bmandyam','2017-11-22 12:49:42','Logged Out'),('sa','sa','2017-11-22 12:49:47','Logged In'),('sa','sa','2017-11-22 14:31:42','Logged Out'),('bmandyam','bmandyam','2017-11-22 14:31:47','Logged In'),('bmandyam','bmandyam','2017-11-22 14:42:35','Logged Out'),('sa','sa','2017-11-22 14:42:39','Logged In'),('sa','sa','2017-11-22 14:57:46','Logged Out'),('bmandyam','bmandyam','2017-11-22 14:57:49','Logged In'),('bmandyam','bmandyam','2017-11-23 10:10:54','Logged In'),('bmandyam','bmandyam','2017-11-23 14:40:24','Logged In'),('bmandyam','bmandyam','2017-11-23 14:56:01','Logged Out'),('bmandyam','bmandyam','2017-11-23 14:56:21','Logged In'),('bmandyam','bmandyam','2017-11-23 16:12:54','Logged Out'),('sa','sa','2017-11-23 16:13:04','Logged In'),('sa','sa','2017-11-23 16:38:00','Logged Out'),('bmandyam','bmandyam','2017-11-23 16:38:06','Logged In'),('bmandyam','bmandyam','2017-11-23 16:43:23','Logged Out'),('sa','sa','2017-11-23 16:43:27','Logged In'),('sa','sa','2017-11-23 16:45:16','Logged Out'),('bmandyam','bmandyam','2017-11-23 16:45:20','Logged In'),('bmandyam','bmandyam','2017-11-23 16:52:07','Logged Out'),('sa','sa','2017-11-23 16:52:13','Logged In'),('sa','sa','2017-11-23 17:02:46','Logged Out'),('bmandyam','bmandyam','2017-11-23 17:02:50','Logged In'),('bmandyam','bmandyam','2017-11-23 18:53:50','Logged Out'),('sa','sa','2017-11-23 18:54:57','Logged In'),('sa','sa','2017-11-23 18:57:44','Logged Out'),('bmandyam','bmandyam','2017-11-23 18:57:48','Logged In'),('bmandyam','bmandyam','2017-11-24 10:16:38','Logged In'),('bmandyam','bmandyam','2017-11-24 10:45:52','Logged Out'),('sa','sa','2017-11-24 10:45:56','Logged In'),('sa','sa','2017-11-24 10:49:46','Logged Out'),('bmandyam','bmandyam','2017-11-24 10:49:51','Logged In'),('bmandyam','bmandyam','2017-11-24 10:52:34','Logged Out'),('bmandyam','bmandyam','2017-11-24 10:52:38','Logged In'),('bmandyam','bmandyam','2017-11-24 13:58:28','Logged Out'),('sa','sa','2017-11-24 13:58:34','Logged In'),('sa','sa','2017-11-24 13:59:01','Logged Out'),('bmandyam','bmandyam','2017-11-24 13:59:05','Logged In'),('bmandyam','bmandyam','2017-11-24 13:59:17','Logged Out'),('bmandyam','bmandyam','2017-11-24 13:59:25','Logged In'),('bmandyam','bmandyam','2017-11-24 13:59:29','Logged Out'),('sa','sa','2017-11-24 13:59:34','Logged In'),('sa','sa','2017-11-24 14:07:07','Logged Out'),('bmandyam','bmandyam','2017-11-24 14:07:12','Logged In'),('accounts','accounts','2017-11-24 14:42:12','Logged Out'),('bmandyam','bmandyam','2017-11-24 14:42:19','Logged In'),('','','2017-11-24 18:38:11','Logged Out'),('','','2017-11-24 18:38:14','Logged Out'),('bmandyam','bmandyam','2017-11-28 17:54:59','Logged In'),('bmandyam','bmandyam','2017-11-28 17:55:31','Logged Out'),('bmandyam','bmandyam','2017-11-28 17:58:00','Logged In'),('bmandyam','bmandyam','2017-11-28 17:58:53','Logged Out'),('bmandyam','bmandyam','2017-11-30 18:23:05','Logged In'),('bmandyam','bmandyam','2017-12-01 10:41:48','Logged In'),('qas_sez','qas_sez','2017-12-01 11:03:38','Logged Out'),('bmandyam','bmandyam','2017-12-01 11:03:42','Logged In'),('','','2017-12-01 11:16:52','Logged Out'),('bmandyam','bmandyam','2017-12-01 11:16:55','Logged In'),('bmandyam','bmandyam','2017-12-01 12:03:02','Logged In'),('bmandyam','bmandyam','2017-12-01 12:04:57','Logged Out'),('sa','sa','2017-12-01 12:05:00','Logged In'),('sa','sa','2017-12-01 12:15:37','Logged Out'),('bmandyam','bmandyam','2017-12-01 12:15:41','Logged In'),('accounts','accounts','2017-12-01 12:36:48','Logged Out'),('bmandyam','bmandyam','2017-12-01 12:36:53','Logged In'),('accounts','accounts','2017-12-01 13:03:48','Logged Out'),('bmandyam','bmandyam','2017-12-01 13:04:01','Logged In'),('bmandyam','bmandyam','2017-12-01 14:50:26','Logged Out'),('bmandyam','bmandyam','2017-12-01 14:50:30','Logged In'),('qas_aero','qas_aero','2017-12-01 18:29:27','Logged Out'),('bmandyam','bmandyam','2017-12-05 10:16:58','Logged In'),('bmandyam','bmandyam','2017-12-05 10:17:30','Logged Out'),('sa','sa','2017-12-05 10:17:36','Logged In'),('sa','sa','2017-12-05 10:41:58','Logged Out'),('bmandyam','bmandyam','2017-12-05 10:42:02','Logged In'),('bmandyam','bmandyam','2017-12-05 11:43:10','Logged Out'),('bmandyam','bmandyam','2017-12-05 11:43:19','Logged In'),('sa','sa','2017-12-05 12:11:45','Logged In'),('bmandyam','bmandyam','2017-12-05 14:40:11','Logged Out'),('bmandyam','bmandyam','2017-12-05 14:40:18','Logged In'),('sa','sa','2017-12-05 14:40:22','Logged Out'),('sa','sa','2017-12-05 14:40:26','Logged In'),('sa','sa','2017-12-05 14:57:54','Logged Out'),('','','2017-12-05 15:50:56','Logged Out'),('sa','sa','2017-12-05 15:51:06','Logged In'),('','','2017-12-05 18:48:35','Logged Out'),('sa','sa','2017-12-05 18:48:40','Logged In'),('bmandyam','bmandyam','2017-12-05 18:57:13','Logged Out'),('bmandyam','bmandyam','2017-12-05 18:57:19','Logged In'),('bmandyam','bmandyam','2017-12-06 10:12:42','Logged In'),('','','2017-12-06 15:05:35','Logged Out'),('sa','sa','2017-12-06 15:05:41','Logged In'),('sa','sa','2017-12-06 18:58:38','Logged Out'),('','','2017-12-06 18:58:40','Logged Out'),('stores','stores','2017-12-06 18:58:48','Logged In'),('bmandyam','bmandyam','2017-12-07 09:58:28','Logged In'),('stores','stores','2017-12-07 10:00:47','Logged In'),('stores','stores','2017-12-07 10:16:57','Logged Out'),('prodn','prodn','2017-12-07 10:17:03','Logged In'),('prodn','prodn','2017-12-07 10:20:20','Logged Out'),('qas','qas','2017-12-07 10:20:25','Logged In'),('qas','qas','2017-12-07 10:58:23','Logged Out'),('stores','stores','2017-12-07 10:58:30','Logged In'),('bmandyam','bmandyam','2017-12-08 10:03:29','Logged In'),('stores','stores','2017-12-08 15:36:11','Logged In'),('bmandyam','bmandyam','2017-12-08 17:38:36','Logged Out'),('','','2017-12-08 17:38:38','Logged Out'),('bmandyam','bmandyam','2017-12-08 17:38:44','Logged In'),('bmandyam','bmandyam','2017-12-08 19:20:25','Logged Out'),('bmandyam','bmandyam','2017-12-11 10:17:40','Logged In'),('qas','qas','2017-12-11 10:46:16','Logged In'),('bmandyam','bmandyam','2017-12-11 12:00:38','Logged Out'),('stores','stores','2017-12-11 12:00:46','Logged In'),('qas','qas','2017-12-11 12:39:52','Logged Out'),('purchasi','purchasing','2017-12-11 12:40:02','Logged In'),('purchasi','purchasing','2017-12-11 12:40:20','Logged In'),('purchasi','purchasing','2017-12-11 12:41:02','Logged In'),('purchasi','purchasing','2017-12-11 12:41:38','Logged In'),('purchasi','purchasing','2017-12-11 12:41:53','Logged In'),('purchasi','purchasing','2017-12-11 12:41:58','Logged In'),('purchasi','purchasing','2017-12-11 12:48:04','Logged In'),('purchasi','purchasing','2017-12-11 12:48:10','Logged In'),('purchasi','purchasing','2017-12-11 15:25:37','Logged Out'),('stores','stores','2017-12-11 15:25:45','Logged In'),('stores','stores','2017-12-11 15:30:19','Logged Out'),('bmandyam','bmandyam','2017-12-11 15:30:26','Logged In'),('stores','stores','2017-12-11 15:33:22','Logged Out'),('bmandyam','bmandyam','2017-12-12 15:16:11','Logged In'),('bmandyam','bmandyam','2017-12-13 10:07:58','Logged In'),('','','2017-12-13 16:40:47','Logged Out'),('bmandyam','bmandyam','2017-12-14 10:28:48','Logged In'),('bmandyam','bmandyam','2017-12-14 12:38:12','Logged Out'),('bmandyam','bmandyam','2017-12-18 15:25:59','Logged In'),('bmandyam','bmandyam','2017-12-18 19:10:32','Logged Out'),('','','2017-12-18 19:10:34','Logged Out'),('bmandyam','bmandyam','2017-12-19 10:05:25','Logged In'),('','','2017-12-19 12:06:16','Logged Out'),('bmandyam','bmandyam','2017-12-19 12:06:20','Logged In'),('bmandyam','bmandyam_sez','2017-12-19 12:48:30','Logged Out'),('bmandyam','bmandyam','2017-12-19 12:48:34','Logged In'),('bmandyam','bmandyam','2017-12-19 15:45:47','Logged Out'),('bmandyam','bmandyam','2017-12-19 15:45:51','Logged In'),('bmandyam','bmandyam','2017-12-19 16:05:54','Logged Out'),('','','2017-12-19 16:08:06','Logged Out'),('aero','aero','2017-12-19 16:09:11','Logged In'),('aero','aero','2017-12-19 16:11:11','Logged Out'),('bmandyam','bmandyam','2017-12-19 16:11:17','Logged In'),('bmandyam','bmandyam','2017-12-19 16:53:04','Logged In'),('bmandyam','bmandyam','2017-12-20 09:59:39','Logged In'),('bmandyam','bmandyam','2017-12-20 13:17:48','Logged Out'),('bmandyam','bmandyam','2017-12-20 13:17:53','Logged In'),('bmandyam','bmandyam','2017-12-20 14:52:42','Logged Out'),('bmandyam','bmandyam','2017-12-20 14:52:47','Logged In'),('bmandyam','bmandyam','2017-12-20 15:20:37','Logged Out'),('bmandyam','bmandyam','2017-12-20 15:20:41','Logged In'),('bmandyam','bmandyam','2017-12-20 15:39:18','Logged Out'),('bmandyam','bmandyam','2017-12-20 15:39:23','Logged In'),('bmandyam','bmandyam','2017-12-20 15:47:08','Logged Out'),('bmandyam','bmandyam','2017-12-20 15:47:12','Logged In'),('bmandyam','bmandyam','2017-12-20 18:13:28','Logged Out'),('bmandyam','bmandyam','2017-12-20 18:13:32','Logged In'),('bmandyam','bmandyam','2017-12-21 10:09:34','Logged In'),('accounts','accounts','2017-12-21 15:57:48','Logged Out'),('bmandyam','bmandyam','2017-12-21 15:57:52','Logged In'),('bmandyam','bmandyam','2017-12-21 15:57:57','Logged Out'),('sa','sa','2017-12-21 15:58:03','Logged In'),('bmandyam','bmandyam','2017-12-21 16:04:52','Logged In'),('bmandyam','bmandyam','2017-12-21 16:15:12','Logged Out'),('sa','sa','2017-12-21 16:15:16','Logged In'),('sa','sa','2017-12-21 16:53:54','Logged Out'),('bmandyam','bmandyam','2017-12-21 16:53:59','Logged In'),('accounts','accounts','2017-12-21 17:15:48','Logged Out'),('sa','sa','2017-12-21 17:15:53','Logged In'),('sa','sa','2017-12-21 17:17:56','Logged Out'),('bmandyam','bmandyam','2017-12-21 17:18:00','Logged In'),('bmandyam','bmandyam','2017-12-21 17:21:48','Logged Out'),('bmandyam','bmandyam','2017-12-21 17:21:55','Logged In'),('bmandyam','bmandyam','2017-12-21 17:23:34','Logged Out'),('sa','sa','2017-12-21 17:23:39','Logged In'),('sa','sa','2017-12-21 17:30:44','Logged Out'),('bmandyam','bmandyam','2017-12-21 17:30:49','Logged In'),('bmandyam','bmandyam','2017-12-21 17:57:39','Logged Out'),('sa','sa','2017-12-21 17:57:43','Logged In'),('sa','sa','2017-12-21 18:23:31','Logged Out'),('bmandyam','bmandyam','2017-12-21 18:23:36','Logged In'),('bmandyam','bmandyam','2017-12-21 18:38:37','Logged Out'),('sa','sa','2017-12-21 18:38:41','Logged In'),('sa','sa','2017-12-21 18:49:13','Logged Out'),('bmandyam','bmandyam','2017-12-21 18:49:17','Logged In'),('bmandyam','bmandyam','2017-12-21 18:54:15','Logged Out'),('sa','sa','2017-12-21 18:54:20','Logged In'),('sa','sa','2017-12-21 19:04:16','Logged Out'),('bmandyam','bmandyam','2017-12-21 19:04:20','Logged In'),('bmandyam','bmandyam','2017-12-21 19:27:27','Logged In'),('bmandyam','bmandyam','2017-12-22 10:40:53','Logged In'),('bmandyam','bmandyam','2017-12-22 10:40:56','Logged In'),('bmandyam','bmandyam','2017-12-22 11:38:10','Logged Out'),('bmandyam','bmandyam','2017-12-22 11:39:39','Logged In'),('accounts','accounts','2017-12-22 11:53:26','Logged Out'),('bmandyam','bmandyam','2017-12-22 11:53:34','Logged In'),('bmandyam','bmandyam','2017-12-22 12:57:31','Logged Out'),('','','2017-12-22 12:57:32','Logged Out'),('bmandyam','bmandyam','2017-12-22 12:57:40','Logged In'),('bmandyam','bmandyam','2017-12-26 10:16:59','Logged In'),('bmandyam','bmandyam','2017-12-26 12:38:28','Logged Out'),('stores','stores','2017-12-26 12:38:39','Logged In'),('stores','stores','2017-12-26 12:39:08','Logged Out'),('bmandyam','bmandyam','2017-12-26 12:39:13','Logged In'),('bmandyam','bmandyam','2017-12-26 15:01:25','Logged Out'),('bmandyam','bmandyam','2017-12-26 15:01:34','Logged In'),('bmandyam','bmandyam','2017-12-26 16:18:10','Logged In'),('bmandyam','bmandyam','2017-12-26 17:20:55','Logged In'),('bmandyam','bmandyam','2017-12-27 10:28:45','Logged In'),('bmandyam','bmandyam','2017-12-27 10:39:25','Logged Out'),('sa','sa','2017-12-27 10:39:31','Logged In'),('sa','sa','2017-12-27 12:22:26','Logged Out'),('bmandyam','bmandyam','2017-12-27 12:22:32','Logged In'),('sa','sa','2017-12-27 14:25:17','Logged In'),('sa','sa','2017-12-27 14:52:46','Logged Out'),('sa','sa','2017-12-27 14:53:15','Logged In'),('bmandyam','bmandyam','2017-12-27 15:05:14','Logged Out'),('stores','stores','2017-12-27 15:05:23','Logged In'),('sa','sa','2017-12-27 15:36:08','Logged In'),('stores','stores','2017-12-27 17:41:40','Logged Out'),('bmandyam','bmandyam','2017-12-27 17:41:47','Logged In'),('bmandyam','bmandyam','2017-12-27 18:16:21','Logged Out'),('sa','sa','2017-12-27 18:16:35','Logged Out'),('sa','sa','2017-12-27 18:16:41','Logged In'),('sa','sa','2017-12-27 18:17:02','Logged In'),('bmandyam','bmandyam','2017-12-27 18:17:17','Logged In'),('bmandyam','bmandyam','2017-12-27 18:17:25','Logged In'),('bmandyam','bmandyam','2017-12-28 10:28:37','Logged In'),('bmandyam','bmandyam','2017-12-28 14:40:08','Logged Out'),('bmandyam','bmandyam','2017-12-28 14:40:15','Logged In'),('bmandyam','bmandyam','2017-12-29 10:39:22','Logged In'),('bmandyam','bmandyam','2018-01-02 10:53:29','Logged In'),('bmandyam','bmandyam','2018-01-02 14:38:01','Logged Out');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_generic_limit`
--

DROP TABLE IF EXISTS `m_generic_limit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_generic_limit` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `type_limit` int(11) DEFAULT NULL,
  `parent` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_generic_limit`
--

LOCK TABLES `m_generic_limit` WRITE;
/*!40000 ALTER TABLE `m_generic_limit` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_generic_limit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_pagefields`
--

DROP TABLE IF EXISTS `m_pagefields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_pagefields` (
  `recnum` int(11) DEFAULT NULL,
  `seqnum` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `link2pname` int(11) DEFAULT NULL,
  `mandatory` char(1) DEFAULT NULL,
  `pgroup` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_pagefields`
--

LOCK TABLES `m_pagefields` WRITE;
/*!40000 ALTER TABLE `m_pagefields` DISABLE KEYS */;
INSERT INTO `m_pagefields` VALUES (11,'1','2323','char1','Text',5,'n','3232','Active',NULL),(12,'1','3443','char1','Text',6,'n','45','Active','FSI');
/*!40000 ALTER TABLE `m_pagefields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_pagename`
--

DROP TABLE IF EXISTS `m_pagename`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_pagename` (
  `recnum` int(11) DEFAULT NULL,
  `pname` varchar(100) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `parent` varchar(100) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_pagename`
--

LOCK TABLES `m_pagename` WRITE;
/*!40000 ALTER TABLE `m_pagename` DISABLE KEYS */;
INSERT INTO `m_pagename` VALUES (5,'sss','2017-02-16','WorkOrder','FSI'),(6,'sssmm','2017-02-16','WorkOrder','FSI');
/*!40000 ALTER TABLE `m_pagename` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintain_machine`
--

DROP TABLE IF EXISTS `maintain_machine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintain_machine` (
  `recnum` int(11) DEFAULT NULL,
  `machineid` varchar(20) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `task` varchar(20) DEFAULT NULL,
  `task_time` varchar(20) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintain_machine`
--

LOCK TABLES `maintain_machine` WRITE;
/*!40000 ALTER TABLE `maintain_machine` DISABLE KEYS */;
/*!40000 ALTER TABLE `maintain_machine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master`
--

DROP TABLE IF EXISTS `master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` varchar(20) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `partnum` varchar(30) DEFAULT NULL,
  `revnum` varchar(30) DEFAULT NULL,
  `partname` varchar(40) DEFAULT NULL,
  `revdate` date DEFAULT NULL,
  `attachments` varchar(50) DEFAULT NULL,
  `drg_issue` varchar(20) DEFAULT NULL,
  `customer` varchar(50) DEFAULT NULL,
  `project` varchar(50) DEFAULT NULL,
  `material_type` varchar(50) DEFAULT NULL,
  `material_sp` float DEFAULT NULL,
  `backup_cd_num` varchar(30) DEFAULT NULL,
  `part_type` varchar(30) DEFAULT NULL,
  `cim_ref_num` varchar(30) DEFAULT NULL,
  `approved_by` varchar(30) DEFAULT NULL,
  `prepared_by` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master`
--

LOCK TABLES `master` WRITE;
/*!40000 ALTER TABLE `master` DISABLE KEYS */;
/*!40000 ALTER TABLE `master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_data`
--

DROP TABLE IF EXISTS `master_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_data` (
  `recnum` int(11) DEFAULT NULL,
  `partname` varchar(50) DEFAULT NULL,
  `wonum` varchar(30) DEFAULT NULL,
  `customer` varchar(50) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `RM_by_CIM` varchar(10) DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `attachments` varchar(255) DEFAULT NULL,
  `RM_by_customer` varchar(10) DEFAULT NULL,
  `CIM_refnum` varchar(30) DEFAULT NULL,
  `drg_issue` varchar(255) DEFAULT NULL,
  `rm_type` varchar(255) DEFAULT NULL,
  `rm_spec` varchar(255) DEFAULT NULL,
  `rm_dim1` varchar(60) DEFAULT NULL,
  `rm_dim2` varchar(60) DEFAULT NULL,
  `rm_dim3` varchar(60) DEFAULT NULL,
  `mps_rev` varchar(20) DEFAULT NULL,
  `mps_num` varchar(20) DEFAULT NULL,
  `drawing_num` varchar(20) DEFAULT NULL,
  `cos` varchar(255) DEFAULT NULL,
  `condition` text,
  `maxruling` varchar(60) DEFAULT NULL,
  `grainflow` varchar(60) DEFAULT NULL,
  `machine_name` varchar(45) DEFAULT NULL,
  `revstat` char(30) DEFAULT NULL,
  `secondary_partname` varchar(50) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `status` char(20) DEFAULT NULL,
  `cos_iss_date` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `treat` varchar(50) DEFAULT NULL,
  `eng_app_by` varchar(45) DEFAULT NULL,
  `eng_app_date` date DEFAULT NULL,
  `eng_app` varchar(45) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  KEY `custname` (`customer`),
  KEY `mcrn` (`CIM_refnum`),
  KEY `ind_masterdata_partnum` (`partnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_data`
--

LOCK TABLES `master_data` WRITE;
/*!40000 ALTER TABLE `master_data` DISABLE KEYS */;
INSERT INTO `master_data` VALUES (7047,'sss',NULL,'aaa','121','','','A','','prn1','A','RMT 1','RMS 2','','','','1213','123','','A','','','','','Active','','Non Assembly','Active',NULL,'','2016-11-06','2016-08-23','Untreated','bmandyam','2016-08-23','yes','FSI'),(7048,'ssss',NULL,'ssds','3434','','','b','','prn2','b','','','','','','','12343','','b','test','','','','Active','','Non Assembly','Active',NULL,'','2017-08-10','2016-09-28','Untreated','bmandyam','2016-09-28','yes','FSI'),(7049,'dsds',NULL,'adsd','3434','','','c','','prn3','c','','','','','','00','233','','c','test','','','','Active','','Non Assembly','Active',NULL,'','2016-11-06','2016-09-28','Untreated','bmandyam','2016-09-28','yes','FSI'),(7050,'rdgfd',NULL,'dfgdf','435','','','s','','prn4','s','','','','','','','test122','','s','test','','','','Active','','Non Assembly','Active',NULL,'','2017-11-24','2016-09-28','Treated','bmandyam','2016-09-28','yes','FSI'),(7051,'sddsd',NULL,'dsf','324','','','s','sdfs','prn5','b','','','','','','','222','','a','test','','','','Obsolete','','Non Assembly','Active',NULL,'','2016-11-06','2016-09-28','Untreated','bmandyam','2016-09-28','yes','FSI'),(7052,'sssss',NULL,'dddd','54543','','','g','sccc','prn6','g','RMT 6','','','','','66','324','','g','test','','','','Active','','Non Assembly','Active',NULL,'','2016-11-06','2016-09-30','Treated','bman','2016-09-30','yes','FSI'),(7053,'fddd',NULL,'','34344','','','g','','prn7','g','RMT 7','RMS 7','','','','','3434','','g','','','','','Active','','Non Assembly','Active',NULL,'','2016-11-06','2016-10-12','Treated','bmandyam','2016-10-12','yes','FSI'),(7054,'24354',NULL,'sdsd','2343','','','dd','','prn8','dd','','','','','','123','2342','dd','dd','','','','','Active','','Non Assembly','Active',NULL,'','2016-10-18','2016-10-18','Treated','bmandyam','2016-10-18','yes','FSI'),(7055,'asd',NULL,'sdsd','132','','','C','','prn9','C','','','','','','','','','C','','','','','Active','','Assembly','Active',NULL,'','2017-11-23','2016-10-20','Assembly','bman','2016-10-20','yes','FSI'),(7056,'dsf',NULL,'ssss','3243','','','','','prn10','','','','','','','','','','','','','','','Active','','Kit','Active',NULL,'','2016-11-11','2016-11-11','Assembly','bmandyam','2016-11-11','yes','FSI'),(7057,'prn-name',NULL,'CIM TOOLS PRIVATE LIMITED','prn-001','rm host','AIRBUS','at','rm cust','PRN-001','drgi','rmt','rms','100','50','50','00','MPS/51-036','drg','cos','hjfdhjfd','1','1','','Active','','Non Assembly','Active',NULL,'','2017-08-08','2017-08-08','Treated','bmandyam','2017-08-08','yes','FSI'),(7058,'fluent part',NULL,'karthick','flu 00 100','','','A','','flu-001','A','','','','','','00','flu-mps-001','A','A','','','','','Active','','Non Assembly','Active',NULL,'','2017-12-05','2017-12-05','Untreated','bmandyam','2017-12-05','yes','FSI'),(7059,'partname',NULL,'karthick','flu-boi-001','','','A','','flu-assy-001','A','A','A','','','','00','boi-mps-00','','A','fsgasfg','','','','Active','','Assembly','Active',NULL,'','2017-12-05','2017-12-05','Assembly','bmandyam','2017-12-05','yes','FSI'),(7060,'partname',NULL,'karthick','flu-boi-001','','','A','','flu-boi-001','A','A','A','','','','00','boi-001','A','','','','','','Active','','Assembly','Active',NULL,'','0000-00-00','2017-12-05','Assembly','','0000-00-00','','FSI');
/*!40000 ALTER TABLE `master_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_line_items`
--

DROP TABLE IF EXISTS `master_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `opnnum` varchar(20) DEFAULT NULL,
  `opn_desc` varchar(50) DEFAULT NULL,
  `work_center` varchar(50) DEFAULT NULL,
  `opn_ref_no` varchar(50) DEFAULT NULL,
  `revnum` varchar(50) DEFAULT NULL,
  `link2master` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_line_items`
--

LOCK TABLES `master_line_items` WRITE;
/*!40000 ALTER TABLE `master_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mc_capacity_master`
--

DROP TABLE IF EXISTS `mc_capacity_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mc_capacity_master` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mc_id` varchar(45) DEFAULT NULL,
  `mc_name` varchar(45) DEFAULT NULL,
  `avail_capacity` float DEFAULT '0',
  `mc_series` varchar(45) DEFAULT NULL,
  `create_date` date DEFAULT '0000-00-00',
  `modified_date` date DEFAULT '0000-00-00',
  `created_by` varchar(65) DEFAULT NULL,
  `modified_by` varchar(65) DEFAULT NULL,
  `month` varchar(65) DEFAULT NULL,
  `year` varchar(65) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `shift` int(11) DEFAULT NULL,
  `units` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mc_capacity_master`
--

LOCK TABLES `mc_capacity_master` WRITE;
/*!40000 ALTER TABLE `mc_capacity_master` DISABLE KEYS */;
INSERT INTO `mc_capacity_master` VALUES (3,'DMG 3','DMG 3',300,'1','2016-11-15','2017-03-10','Sales','Sales','11','2015','FSI',1,'hrs'),(4,'DX 4','DX 4',500,'3','2016-11-15','2016-11-15','CAD','Sales','11','2015','FSI',1,'hrs'),(5,'HMC 5','HMC 5',400,'4','2016-11-15','0000-00-00','CAD',NULL,'11','2015','FSI',1,'hrs'),(8,'HAAS','HAAS',200,'2','2016-11-15','2016-11-16','Sales','Sales','11','2015','FSI',1,'hrs'),(9,'HAAS','HAAS',100,'1','2016-11-15','2017-03-14','Sales','Sales','11','2016','FSI',1,'hrs'),(10,'BMV 1','BMV 1',500,'BMV 1','2016-11-25','2017-06-21','Sales','Sales','10','2016','FSI',1,'hrs'),(19,'BMV 1','BMV 1',500,'BMV 1','2017-05-03','2017-06-21','Sales','Sales','11','2016','FSI',1,'hrs'),(12,'VMC 2','VMC 2',100,'1212','2017-03-14','0000-00-00','Sales',NULL,'03','2017','FSI',1,'hrs'),(17,'VMC 2','VMC 2',300,'1','2017-05-03','0000-00-00','Sales',NULL,'06','2017','FSI',1,'hrs'),(18,'DMG 3','DMG 3',500,'VMC 2','2017-05-03','0000-00-00','Sales',NULL,'07','2017','FSI',1,'hrs'),(16,'BMV 1','BMV 1',200,'BMV 1','2017-05-03','0000-00-00','Sales',NULL,'05','2017','FSI',1,'hrs'),(20,'BMV 1','BMV 1',600,'BMV','2017-08-04','0000-00-00','Sales',NULL,'08','2017','FSI',1,'hrs'),(21,'VMC 2','VMC 2',425,'VMC','2017-08-04','0000-00-00','Sales',NULL,'08','2017','FSI',1,'hrs'),(22,'DMG 3','DMG 3',700,'DMG','2017-08-04','0000-00-00','Sales',NULL,'08','2017','FSI',1,'hrs');
/*!40000 ALTER TABLE `mc_capacity_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mc_capacity_plan`
--

DROP TABLE IF EXISTS `mc_capacity_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mc_capacity_plan` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mc_id` varchar(45) NOT NULL DEFAULT '',
  `mc_name` varchar(45) NOT NULL DEFAULT '',
  `crn` varchar(65) NOT NULL DEFAULT '',
  `plan_month` varchar(65) NOT NULL DEFAULT '',
  `req_crn_hrs` varchar(65) NOT NULL DEFAULT '',
  `wonum` varchar(65) NOT NULL DEFAULT '',
  `wo_hrs` varchar(45) NOT NULL DEFAULT '',
  `mc_series` varchar(45) DEFAULT NULL,
  `plan_year` varchar(45) DEFAULT NULL,
  `mc_cap_hrs` varchar(65) DEFAULT NULL,
  `mc_avail_hrs` varchar(65) DEFAULT NULL,
  `crn_qty` varchar(65) DEFAULT NULL,
  `runtime_units` varchar(65) DEFAULT NULL,
  `balance_crn_hrs` varchar(65) DEFAULT NULL,
  `balance_crn_qty` varchar(65) DEFAULT NULL,
  `balance_mc_hrs` varchar(65) DEFAULT NULL,
  `create_date` date DEFAULT '0000-00-00',
  `modified_date` date DEFAULT '0000-00-00',
  `created_by` varchar(65) DEFAULT NULL,
  `modified_by` varchar(65) DEFAULT NULL,
  `operation` char(5) DEFAULT NULL,
  `priority` char(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `start_meridiem` varchar(65) DEFAULT NULL,
  `end_meridiem` varchar(65) DEFAULT NULL,
  `end_time` int(10) unsigned DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `blank` int(11) DEFAULT NULL,
  `units` varchar(45) DEFAULT NULL,
  `shift` varchar(45) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `sch_qty` int(11) DEFAULT NULL,
  `fgqty` int(11) DEFAULT NULL,
  `totalfgqty` int(11) DEFAULT NULL,
  `grn_qty` int(11) DEFAULT NULL,
  `ff_qty` varchar(65) DEFAULT NULL,
  `ff_qty_hrs` varchar(65) DEFAULT NULL,
  `wip_qty` int(11) DEFAULT NULL,
  `rej_qty` int(11) DEFAULT NULL,
  `disp_qty` int(11) DEFAULT NULL,
  `time24` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mc_capacity_plan`
--

LOCK TABLES `mc_capacity_plan` WRITE;
/*!40000 ALTER TABLE `mc_capacity_plan` DISABLE KEYS */;
INSERT INTO `mc_capacity_plan` VALUES (1,'BMV 1','BMV 1','prn5','10','990','','','BMV 1','2016','500','500','100','10','490','49','0','2017-06-30','0000-00-00','Sales',NULL,'',NULL,'2016-10-01','2016-10-21',0,'','PM',8,'FSI',1,'hrs','1','2016-10-05',100,1,99,1946,'50','500',NULL,NULL,NULL,NULL),(2,'BMV 1','BMV 1','prn5','10','990','','','VMC 2','2016','500','500','100','10','490','49','0','2017-07-01','0000-00-00','Sales',NULL,'',NULL,'2016-10-01','2016-10-21',0,'','PM',8,'FSI',1,'hrs','1','2016-10-05',100,1,99,1946,'50','500',NULL,NULL,NULL,NULL),(3,'BMV 1','BMV 1','prn2','11','90','','','VMC 2','2016','500','500','10','10','0','0','410','2017-07-01','0000-00-00','Sales',NULL,'',NULL,'2016-11-01','2016-11-04',0,'','PM',6,'FSI',1,'hrs','1','2016-11-01',10,1,9,969,'9','90',NULL,NULL,NULL,NULL),(4,'BMV 1','BMV 1','prn6','11','80','','','VMC 2','2016','500','410','9','10','0','0','330','2017-07-01','0000-00-00','Sales',NULL,'',NULL,'2016-11-04','2016-11-08',6,'PM','AM',2,'FSI',1,'hrs','1','2016-11-08',9,1,8,3999,'8','80',NULL,NULL,NULL,NULL),(5,'BMV 1','BMV 1','prn2','11','120','','','VMC 2','2016','500','330','12','10','0','0','210','2017-07-01','0000-00-00','Sales',NULL,'',NULL,'2016-11-08','2016-11-13',2,'AM','AM',2,'FSI',1,'hrs','1','2016-11-30',12,0,12,969,'12','120',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `mc_capacity_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mc_master`
--

DROP TABLE IF EXISTS `mc_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mc_master` (
  `mc_id` varchar(20) DEFAULT NULL,
  `mc_name` varchar(50) DEFAULT NULL,
  `mc_cost_per_hour` float DEFAULT NULL,
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `qty` int(11) DEFAULT NULL,
  `setup_time` int(11) DEFAULT NULL,
  `crn_num` varchar(30) DEFAULT NULL,
  `setup_time_mins` int(11) DEFAULT NULL,
  `fitting_time_hrs` int(11) DEFAULT NULL,
  `fitting_time_mins` int(11) DEFAULT NULL,
  `insp_time_hrs` int(11) DEFAULT NULL,
  `insp_time_mins` int(11) DEFAULT NULL,
  `val_per_part` decimal(8,2) DEFAULT NULL,
  `mps_revision` varchar(45) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mc_master`
--

LOCK TABLES `mc_master` WRITE;
/*!40000 ALTER TABLE `mc_master` DISABLE KEYS */;
INSERT INTO `mc_master` VALUES (NULL,NULL,NULL,1,1,0,'PRN1',0,0,23,23,0,1.00,'123','2016-05-29','2016-05-29','FSI'),(NULL,NULL,NULL,2,1,0,'prn1',0,10,0,10,0,2.00,'0','2016-06-01','2016-07-05','FSI'),(NULL,NULL,NULL,3,1,0,'prn2',0,8,0,8,0,3.00,'0','2016-06-06','2016-07-07','FSI');
/*!40000 ALTER TABLE `mc_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mc_stage_master`
--

DROP TABLE IF EXISTS `mc_stage_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mc_stage_master` (
  `stage_num` int(11) DEFAULT NULL,
  `running_time` int(11) DEFAULT NULL,
  `link2mc_master` int(11) DEFAULT NULL,
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `mc_name` varchar(40) DEFAULT NULL,
  `setting_time_mins` float DEFAULT NULL,
  `running_time_mins` float DEFAULT NULL,
  `setting_time` float DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mc_stage_master`
--

LOCK TABLES `mc_stage_master` WRITE;
/*!40000 ALTER TABLE `mc_stage_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `mc_stage_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mdm`
--

DROP TABLE IF EXISTS `mdm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mdm` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` varchar(20) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `partname` varchar(20) DEFAULT NULL,
  `drg_issue` varchar(20) DEFAULT NULL,
  `attachments` varchar(50) DEFAULT NULL,
  `dim1` varchar(20) DEFAULT NULL,
  `dim2` varchar(20) DEFAULT NULL,
  `dim3` varchar(20) DEFAULT NULL,
  `raw_mat_type` varchar(20) DEFAULT NULL,
  `raw_mat_spec` varchar(20) DEFAULT NULL,
  `maching_cycle_time` varchar(10) DEFAULT NULL,
  `filtering_cycle_time` varchar(10) DEFAULT NULL,
  `inopectun_cycle_time` varchar(10) DEFAULT NULL,
  `part_type` varchar(20) DEFAULT NULL,
  `customer` varchar(30) DEFAULT NULL,
  `project` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mdm`
--

LOCK TABLES `mdm` WRITE;
/*!40000 ALTER TABLE `mdm` DISABLE KEYS */;
/*!40000 ALTER TABLE `mdm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mechanical_properties_li`
--

DROP TABLE IF EXISTS `mechanical_properties_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mechanical_properties_li` (
  `recno` int(11) DEFAULT NULL,
  `constituents` varchar(30) DEFAULT NULL,
  `standard_min` float DEFAULT NULL,
  `standard_max` float DEFAULT NULL,
  `supplier_min` float DEFAULT NULL,
  `supplier_max` float DEFAULT NULL,
  `report_lab` varchar(100) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `link2testreport` varchar(20) DEFAULT NULL,
  `lineno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mechanical_properties_li`
--

LOCK TABLES `mechanical_properties_li` WRITE;
/*!40000 ALTER TABLE `mechanical_properties_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `mechanical_properties_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `recnum` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dept` varchar(50) DEFAULT NULL,
  `userrole` varchar(50) DEFAULT NULL,
  `menus` text,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  KEY `recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Sales','SU','[{\"text\":\"CRM\",\"href\":\"leaddashboard.php\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc1\",\"class\":\"sales menudrop\",\"seqnum\":\"1\",\"children\":[{\"text\":\"DashBoard\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Leads\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Opportunity\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Enquiry\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Quote\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Sales Order\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Assy Review\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Cust Feedback\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Competitor\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Support\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"children\":[{\"text\":\"New SR\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"New RMA\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"New Eco\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Solution\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"MES\",\"href\":\"delivery_schSummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc2\",\"class\":\"ppc menudrop\",\"seqnum\":\"2\",\"children\":[{\"text\":\"Planning\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Cap.Master\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Prod.Schdule\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Cap.Plan\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Cap.Chart\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"RCCP\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"CRP\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Purchasing\",\"href\":\"po.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc3\",\"class\":\"purc menudrop\",\"seqnum\":\"3\",\"children\":[{\"text\":\"PO\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"RM Master\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Part Master\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Mtl Tracker\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Supp Master\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"WO\",\"href\":\"worderSummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc4\",\"class\":\"work menudrop\",\"seqnum\":\"4\",\"children\":[{\"text\":\"Reg Wo\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Post Process\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Assy WO\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"BOM\",\"href\":\"bom.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc6\",\"class\":\"bom menudrop\",\"seqnum\":\"6\"},{\"text\":\"Stores\",\"href\":\"grn_summary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc7\",\"class\":\"stores menudrop\",\"seqnum\":\"7\",\"children\":[{\"text\":\"GRN\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"NC\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"QA\",\"href\":\"nc4qa_summary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc8\",\"class\":\"qa menudrop\",\"seqnum\":\"8\",\"children\":[{\"text\":\"NC\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Final Insp\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"FAIR\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Dispatch\",\"href\":\"dispatchSummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc9\",\"class\":\"dispatch menudrop\",\"seqnum\":\"9\"},{\"text\":\"Accounts\",\"href\":\"account.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc10\",\"class\":\"account menudrop\",\"seqnum\":\"10\",\"children\":[{\"text\":\"Company\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Contacts\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Master Data\",\"href\":\"masterSummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc12\",\"class\":\"master_data menudrop\",\"seqnum\":\"12\"},{\"text\":\"Production\",\"href\":\"operatorDetails.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc13\",\"class\":\"prodn menudrop\",\"seqnum\":\"13\",\"children\":[{\"text\":\"Operator\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Invoice\",\"href\":\"invoiceSummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc14\",\"class\":\"invoice menudrop\",\"seqnum\":\"14\",\"children\":[{\"text\":\"Invoice\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Packing\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Pricing\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Excise\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Appendix\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"AR3A\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Utilities\",\"href\":\"emailsummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc18\",\"class\":\"utili menudrop\",\"seqnum\":\"18\",\"children\":[{\"text\":\"Email\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Calendar\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"FluentELM\",\"href\":\"fluentelm.php#!/summary\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc21\",\"class\":\"elm menudrop\",\"seqnum\":\"21\",\"children\":[{\"text\":\"Summary\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Pre Boarding\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"OnBoarding\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Payroll\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Performance\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Exit Interview\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"Project Mgmt\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"children\":[{\"text\":\"TMS\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"AMS\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"},{\"text\":\"LMS\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Resource Planning\",\"href\":\"\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\"}]},{\"text\":\"Reports\",\"href\":\"reports.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc15\",\"class\":\"reports menudrop\",\"seqnum\":\"15\"}]','2017-12-27','bmandyam','Active','2017-12-27','sa','FSI'),(2,'Stores','RU','[{\"text\":\"WO\",\"href\":\"worderSummary.php\",\"icon\":\"\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc4\",\"class\":\"work menudrop\",\"seqnum\":\"4\",\"children\":[{\"text\":\"Reg WO\",\"href\":\"worderSummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"ul17\",\"class\":\"\",\"seqnum\":\"17\"},{\"text\":\"Assy WO\",\"href\":\"assywo.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"ul18\",\"class\":\"\",\"seqnum\":\"18\"}]},{\"text\":\"Purchasing\",\"href\":\"po.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc3\",\"class\":\"purc menudrop\",\"seqnum\":\"3\",\"children\":[{\"text\":\"PO\",\"href\":\"po.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"ul14\",\"class\":\"\",\"seqnum\":\"14\"},{\"text\":\"RM Master\",\"href\":\"rmmastersummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"ul15\",\"class\":\"\",\"seqnum\":\"15\"},{\"text\":\"Part Master\",\"href\":\"vendPart.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"ul16\",\"class\":\"\",\"seqnum\":\"16\"}]},{\"text\":\"Stores\",\"href\":\"grn_summary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc7\",\"class\":\"stores menudrop\",\"seqnum\":\"7\",\"children\":[{\"text\":\"GRN\",\"href\":\"grn_summary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"ul20\",\"class\":\"\",\"seqnum\":\"20\"},{\"text\":\"View Cust PO\",\"href\":\"viewsalesorder.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"\",\"class\":\"\",\"seqnum\":\"\"},{\"text\":\"SP PO\",\"href\":\"view_assypoSummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"\",\"class\":\"\",\"seqnum\":\"\"},{\"text\":\"Boxing\",\"href\":\"boxing.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"\",\"class\":\"\",\"seqnum\":\"\"},{\"text\":\"NC\",\"href\":\"nc4stores_summary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"ul21\",\"class\":\"\",\"seqnum\":\"21\"}]},{\"text\":\"Master Data\",\"href\":\"viewmasterSummary.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc12\",\"class\":\"\",\"seqnum\":\"12\"},{\"text\":\"Reports\",\"href\":\"reports.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc15\",\"class\":\"\",\"seqnum\":\"15\"},{\"text\":\"BOM\",\"href\":\"bom.php\",\"icon\":\"empty\",\"target\":\"_self\",\"title\":\"\",\"id\":\"acc6\",\"class\":\"\",\"seqnum\":\"6\"}]','2017-12-27','sa','Active','2017-12-27','sa',NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfg_order`
--

DROP TABLE IF EXISTS `mfg_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfg_order` (
  `recnum` int(11) DEFAULT NULL,
  `mfg_id` varchar(50) DEFAULT NULL,
  `mfg_desc` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `link2company` int(11) DEFAULT NULL,
  `link2contact` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfg_order`
--

LOCK TABLES `mfg_order` WRITE;
/*!40000 ALTER TABLE `mfg_order` DISABLE KEYS */;
INSERT INTO `mfg_order` VALUES (1,'M1','','2016-03-15',126,26,'2016-03-10');
/*!40000 ALTER TABLE `mfg_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `milestone_notes`
--

DROP TABLE IF EXISTS `milestone_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `milestone_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `link2dates` int(11) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `milestone_notes`
--

LOCK TABLES `milestone_notes` WRITE;
/*!40000 ALTER TABLE `milestone_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `milestone_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm`
--

DROP TABLE IF EXISTS `mm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm` (
  `recnum` int(11) DEFAULT NULL,
  `qty_drawn` int(11) DEFAULT NULL,
  `drawn_by` varchar(255) DEFAULT NULL,
  `issued_by` varchar(255) DEFAULT NULL,
  `accepted` varchar(255) DEFAULT NULL,
  `rejected` varchar(255) DEFAULT NULL,
  `returned` varchar(255) DEFAULT NULL,
  `recd_by` varchar(100) DEFAULT NULL,
  `sl_from` varchar(100) DEFAULT NULL,
  `sl_to` varchar(100) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL,
  `link2notes` int(11) DEFAULT NULL,
  `line_num` varchar(100) DEFAULT NULL,
  `drawn_date` date DEFAULT NULL,
  `issued_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm`
--

LOCK TABLES `mm` WRITE;
/*!40000 ALTER TABLE `mm` DISABLE KEYS */;
/*!40000 ALTER TABLE `mm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mps`
--

DROP TABLE IF EXISTS `mps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mps` (
  `mps_revision` varchar(20) DEFAULT NULL,
  `control` varchar(50) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `link2master_data` int(11) DEFAULT NULL,
  `recnum` int(11) DEFAULT NULL,
  `linenum` varchar(20) DEFAULT NULL,
  `revstat` char(30) DEFAULT NULL,
  `rev_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mps`
--

LOCK TABLES `mps` WRITE;
/*!40000 ALTER TABLE `mps` DISABLE KEYS */;
INSERT INTO `mps` VALUES ('1','ALL','NA',1,1,'1','Active','2014-01-21'),('1','qwrdas','dsfsfxcx',7029,2294,'1','Active','2016-05-30'),('2','sfcsx','dvgdvv',7030,2295,'2','Active','2016-05-29'),('ewr','errwr','rewrewt',7032,2296,'1','Active','2016-05-29'),('efre','dg','sgsg',7033,2297,'1','Active','2016-05-30'),('2','mps','test',7040,2298,'1','Active','2016-06-27'),('12','mpr','test',7041,2299,'1','Active','2016-06-13'),('12','mpv','TEST',7042,2300,'1','Active','2016-06-14'),('12','mp','test',7043,2301,'1','Active','2016-06-27'),('23','mpv','wer',7044,2302,'1','Active','2016-06-27'),('213','mpv','TEST',7046,2303,'1','Active','2016-07-25'),('13','mpv','',7045,2304,'1','Active','2016-07-31'),('121','mpv','',7047,2305,'1','Active','2016-08-31'),('123','mpv','test',7048,2306,'1','Active','2016-09-28'),('2323','mpvb','test',7049,2307,'1','Active','2016-09-28'),('454','mpvf','test',7050,2308,'1','Active','2016-09-28'),('133','mpvf','ersw',7051,2309,'1','Active','2016-09-28'),('mps','mps','test',7052,2310,'1','Active','2016-09-30'),('22','mpv','',7053,2311,'1','Active','2016-10-04'),('234','mpvs','test',7054,2312,'1','Active','0000-00-00'),('20','mpv','testing',7055,2313,'1','Active','2016-10-20'),('1','mpv','test',7056,2314,'1','Active','2016-11-10'),('1','fg','dfgsdfg',7057,2315,'1','Active','2017-08-08'),('001','fanuc','fanuc',7058,2316,'1','Active','2017-12-04'),('00','hass','klkl',7059,2317,'1','Active','2017-12-05'),('00','fhg','jhdfh',7060,2318,'1','Active','2017-12-05');
/*!40000 ALTER TABLE `mps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtl_act_log`
--

DROP TABLE IF EXISTS `mtl_act_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mtl_act_log` (
  `recnum` int(11) DEFAULT NULL,
  `ldate` date DEFAULT NULL,
  `userid` varchar(20) DEFAULT NULL,
  `usertype` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `link2mtltrk` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mtl_act_log`
--

LOCK TABLES `mtl_act_log` WRITE;
/*!40000 ALTER TABLE `mtl_act_log` DISABLE KEYS */;
INSERT INTO `mtl_act_log` VALUES (1315,'2016-05-25','bmandyam','EMPL','Modified',1015),(1316,'2016-05-25','bmandyam','EMPL','Modified',1015),(1317,'2016-05-25','bmandyam','EMPL','Modified',1015),(1318,'2016-05-25','bmandyam','EMPL','Modified',1015),(1319,'2016-05-25','bmandyam','EMPL','Modified',1015),(1320,'2016-05-25','bmandyam','EMPL','Modified',1015),(1321,'2016-05-25','bmandyam','EMPL','Modified',1007),(1322,'2016-05-25','bmandyam','EMPL','Modified',1007),(1323,'2016-05-25','bmandyam','EMPL','Modified',1007),(1324,'2016-05-25','bmandyam','EMPL','Modified',1007),(1325,'2016-05-25','bmandyam','EMPL','Modified',1007),(1326,'2016-05-25','bmandyam','EMPL','Modified',1007),(1327,'2016-05-25','bmandyam','EMPL','Modified',1007),(1328,'2016-05-25','bmandyam','EMPL','Modified',1007),(1329,'2016-05-26','bmandyam','EMPL','Modified',1015),(1330,'2016-05-26','bmandyam','EMPL','Modified',1015),(1331,'2016-05-26','bmandyam','EMPL','Modified',1015),(1332,'2016-05-26','bmandyam','EMPL','Modified',1015),(1333,'2016-05-26','bmandyam','EMPL','Modified',1015),(1334,'2016-05-26','bmandyam','EMPL','Modified',1015),(1335,'2016-05-26','bmandyam','EMPL','Modified',1015),(1336,'2016-05-26','bmandyam','EMPL','Modified',1015),(1337,'2016-05-26','bmandyam','EMPL','Modified',1015),(1338,'2016-05-26','bmandyam','EMPL','Modified',1015),(1339,'2016-05-26','bmandyam','EMPL','Modified',1015),(1340,'2016-05-26','bmandyam','EMPL','Modified',1012),(1341,'2016-05-26','bmandyam','EMPL','Modified',1012),(1342,'2016-05-26','bmandyam','EMPL','Modified',1012),(1343,'2016-05-26','bmandyam','EMPL','Modified',1012),(1344,'2016-06-01','bmandyam','EMPL','Modified',1012),(1345,'2016-06-01','bmandyam','EMPL','Modified',1012),(1346,'2016-06-01','bmandyam','EMPL','Modified',1012),(1347,'2016-06-01','bmandyam','EMPL','Modified',1012),(1348,'2016-06-01','bmandyam','EMPL','Modified',1007),(1349,'2016-07-04','bmandyam','EMPL','Modified',1022),(1350,'2017-02-16','bmandyam','EMPL','Modified',1020);
/*!40000 ALTER TABLE `mtl_act_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtl_supplier_notes`
--

DROP TABLE IF EXISTS `mtl_supplier_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mtl_supplier_notes` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `suppliernotes` longtext,
  `link2supplier` int(11) DEFAULT NULL,
  `link2user` varchar(255) DEFAULT NULL,
  `link2po` int(10) unsigned DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mtl_supplier_notes`
--

LOCK TABLES `mtl_supplier_notes` WRITE;
/*!40000 ALTER TABLE `mtl_supplier_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `mtl_supplier_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtl_tracker`
--

DROP TABLE IF EXISTS `mtl_tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mtl_tracker` (
  `recnum` int(11) DEFAULT NULL,
  `ponum` varchar(20) DEFAULT NULL,
  `vendor_name` varchar(30) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `adv_license_qty` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mtl_tracker`
--

LOCK TABLES `mtl_tracker` WRITE;
/*!40000 ALTER TABLE `mtl_tracker` DISABLE KEYS */;
INSERT INTO `mtl_tracker` VALUES (10073,'PO1','2','RMT',NULL,0),(10074,'214','2','sc',NULL,0),(10075,'35','2','sc',NULL,0),(10076,'','2','sc',NULL,0),(10077,'12','2','sfff',NULL,0),(10078,'4','2','dg',NULL,0),(10079,'2','2','sc',NULL,0),(10080,'po4','2','sc',NULL,0),(10083,'11','2','sfff',NULL,0),(10084,'112','128','',NULL,0),(10085,'45','129','RMT3',NULL,0),(10087,'1','2','',NULL,0),(10088,'1','2','RMT',NULL,0),(10089,'2','129','sc',NULL,0),(10090,'3','129','RMT3',NULL,0),(10091,'4','130','RMT4',NULL,0),(10092,'5','130','sfff',NULL,0),(10093,'6','129','dg',NULL,0),(10094,'234','129','RMT 6',NULL,0),(10095,'555','129','RMS 7',NULL,0),(10096,'5551','129','RMT 8',NULL,0),(10097,'PO-001','129','rmt',NULL,0),(10099,'KARPO-001','132','rm type',NULL,0),(10100,'KAR-002','132','PART',NULL,0),(10101,'KARCO-001','132','PART',NULL,0);
/*!40000 ALTER TABLE `mtl_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtl_tracker_li`
--

DROP TABLE IF EXISTS `mtl_tracker_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mtl_tracker_li` (
  `recnum` int(11) DEFAULT NULL,
  `invnum` varchar(20) DEFAULT NULL,
  `invdate` date DEFAULT NULL,
  `invqty` float DEFAULT NULL,
  `supdel_date` date DEFAULT NULL,
  `paydue_date` date DEFAULT NULL,
  `payexp_date` date DEFAULT NULL,
  `pick_date` date DEFAULT NULL,
  `sail_date` date DEFAULT NULL,
  `eda` date DEFAULT NULL,
  `aad` date DEFAULT NULL,
  `expclr_date` date DEFAULT NULL,
  `cfdel_date` date DEFAULT NULL,
  `link2mtltracker` int(11) DEFAULT NULL,
  `ffpaydue_date` date DEFAULT NULL,
  `ffpayexp_date` date DEFAULT NULL,
  `cfpaydue_date` date DEFAULT NULL,
  `cfpayexp_date` date DEFAULT NULL,
  `packnum` varchar(50) DEFAULT NULL,
  `bill_lading_num` varchar(50) DEFAULT NULL,
  `bill_lading_date` date DEFAULT NULL,
  `docket_num` varchar(50) DEFAULT NULL,
  `boe_num` varchar(50) DEFAULT NULL,
  `credit_note_no` int(11) DEFAULT NULL,
  `recd_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mtl_tracker_li`
--

LOCK TABLES `mtl_tracker_li` WRITE;
/*!40000 ALTER TABLE `mtl_tracker_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `mtl_tracker_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtm_leads_opportunity`
--

DROP TABLE IF EXISTS `mtm_leads_opportunity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mtm_leads_opportunity` (
  `leads_recnum` int(11) DEFAULT NULL,
  `opportunity_recnum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mtm_leads_opportunity`
--

LOCK TABLES `mtm_leads_opportunity` WRITE;
/*!40000 ALTER TABLE `mtm_leads_opportunity` DISABLE KEYS */;
INSERT INTO `mtm_leads_opportunity` VALUES (3,4),(3,3),(4,4),(4,3),(5,3),(5,4),(4,5),(5,5);
/*!40000 ALTER TABLE `mtm_leads_opportunity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtm_po_wo`
--

DROP TABLE IF EXISTS `mtm_po_wo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mtm_po_wo` (
  `po_recnum` int(11) DEFAULT NULL,
  `wo_recnum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mtm_po_wo`
--

LOCK TABLES `mtm_po_wo` WRITE;
/*!40000 ALTER TABLE `mtm_po_wo` DISABLE KEYS */;
/*!40000 ALTER TABLE `mtm_po_wo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtm_wo_grn`
--

DROP TABLE IF EXISTS `mtm_wo_grn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mtm_wo_grn` (
  `wo` char(20) DEFAULT NULL,
  `grn` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mtm_wo_grn`
--

LOCK TABLES `mtm_wo_grn` WRITE;
/*!40000 ALTER TABLE `mtm_wo_grn` DISABLE KEYS */;
/*!40000 ALTER TABLE `mtm_wo_grn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nc4qa`
--

DROP TABLE IF EXISTS `nc4qa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nc4qa` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` varchar(20) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `partname` varchar(25) DEFAULT NULL,
  `bachnum` varchar(20) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `matl_spec` varchar(20) DEFAULT NULL,
  `issues_ps` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `ponum` varchar(20) DEFAULT NULL,
  `part_sl_num` varchar(20) DEFAULT NULL,
  `wonum` varchar(20) DEFAULT NULL,
  `dcnum` varchar(20) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `traceability_recnum` varchar(30) DEFAULT NULL,
  `dim_deviation` varchar(5) DEFAULT NULL,
  `man` varchar(5) DEFAULT NULL,
  `inprocess` varchar(5) DEFAULT NULL,
  `mat_deviation` varchar(5) DEFAULT NULL,
  `machine` varchar(5) DEFAULT NULL,
  `final_insp` varchar(5) DEFAULT NULL,
  `other_deviation` varchar(5) DEFAULT NULL,
  `method` varchar(5) DEFAULT NULL,
  `cust_end` varchar(5) DEFAULT NULL,
  `description` text,
  `root_cause` text,
  `corrective_action` text,
  `preventive_action` text,
  `effectiveness` text,
  `cofcnum` varchar(20) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `super_name` varchar(100) DEFAULT NULL,
  `oper_name` varchar(255) DEFAULT NULL,
  `cust_ncno` varchar(100) DEFAULT NULL,
  `cust_ncdate` date DEFAULT NULL,
  `remarks` text,
  `formatnum` varchar(255) DEFAULT NULL,
  `formatrev` varchar(255) DEFAULT NULL,
  `rm_cost` decimal(10,2) DEFAULT NULL,
  `currency` char(10) DEFAULT NULL,
  `status` char(30) DEFAULT NULL,
  `accepted` varchar(5) DEFAULT NULL,
  `rejected` varchar(5) DEFAULT NULL,
  `quarantined` varchar(5) DEFAULT NULL,
  `wotype` varchar(45) DEFAULT NULL,
  `dn_num` varchar(45) DEFAULT NULL,
  `stagenum` varchar(30) DEFAULT NULL,
  `rework` char(5) DEFAULT NULL,
  `mc_name` varchar(100) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `onsite` char(5) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  KEY `ind_nc4qa_wonum` (`wonum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nc4qa`
--

LOCK TABLES `nc4qa` WRITE;
/*!40000 ALTER TABLE `nc4qa` DISABLE KEYS */;
INSERT INTO `nc4qa` VALUES (6382,'prn2','A2','ssss','4545','3434','','b',2,'1020','','31454','','0000-00-00',NULL,'yes','no','no','no','yes','yes','no','no','no','','','','','','','2017-08-28','Badari(Mandyam)','Badari(Mandyam)','','0000-00-00','','F8003-S','Rev 0 dt 8-1-2009',0.00,'$','Open','no','yes','no','Untreated','','fi','no','Misc','Badari(Mandyam)','','FSI'),(6383,'prn2','A2','ssss','4545','3434','','b',2,'1020','','31455','','0000-00-00',NULL,'yes','no','yes','no','yes','no','no','no','no','','','','','','','2017-08-28','Badari(Mandyam)','Badari(Mandyam)','434','0000-00-00','','F8003-S','Rev 0 dt 8-1-2009',0.00,'$','Open','no','yes','no','Untreated','','fi','no','Misc','Badari(Mandyam)','','FSI');
/*!40000 ALTER TABLE `nc4qa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nc4stores`
--

DROP TABLE IF EXISTS `nc4stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nc4stores` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `refnum` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `supplier` varchar(45) DEFAULT NULL,
  `rm_po_num` varchar(45) DEFAULT NULL,
  `receipt_date` date DEFAULT NULL,
  `invoice_num` varchar(45) DEFAULT NULL,
  `bol_num` varchar(45) DEFAULT NULL,
  `cofcnum` varchar(20) DEFAULT NULL,
  `dim_deviation` varchar(5) DEFAULT NULL,
  `mat_deviation` varchar(5) DEFAULT NULL,
  `descrepancy_quantity` varchar(5) DEFAULT NULL,
  `raw_material_docs` varchar(5) DEFAULT NULL,
  `specific_marking` varchar(5) DEFAULT NULL,
  `root_cause` text,
  `corrective_action` text,
  `preventive_action` text,
  `nc_created_by` varchar(45) DEFAULT NULL,
  `nc_supplied_by` varchar(45) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `effectiveness` text,
  `other_deviation` varchar(5) DEFAULT NULL,
  `description` text,
  `formatnum` varchar(255) DEFAULT NULL,
  `formatrev` varchar(255) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `supplier_answer` text,
  `grnnum` varchar(55) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nc4stores`
--

LOCK TABLES `nc4stores` WRITE;
/*!40000 ALTER TABLE `nc4stores` DISABLE KEYS */;
INSERT INTO `nc4stores` VALUES (1,'3434','2017-02-16','sss','24443','2017-02-16','','','','Yes','No','Yes','Yes','No','','','','','','0000-00-00','','Yes','','F7533','Rev. No.0',NULL,NULL,NULL,NULL,'FSI');
/*!40000 ALTER TABLE `nc4stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ncforstores`
--

DROP TABLE IF EXISTS `ncforstores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ncforstores` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` varchar(30) DEFAULT NULL,
  `partnum` varchar(30) DEFAULT NULL,
  `partname` varchar(30) DEFAULT NULL,
  `rm_invoice_num` varchar(30) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `dcnum` varchar(30) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `ponum` varchar(30) DEFAULT NULL,
  `rmdim1` varchar(20) DEFAULT NULL,
  `rmdim2` varchar(20) DEFAULT NULL,
  `rmdim3` varchar(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ncforstores`
--

LOCK TABLES `ncforstores` WRITE;
/*!40000 ALTER TABLE `ncforstores` DISABLE KEYS */;
/*!40000 ALTER TABLE `ncforstores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ncqa`
--

DROP TABLE IF EXISTS `ncqa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ncqa` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` varchar(20) DEFAULT NULL,
  `customer` varchar(20) DEFAULT NULL,
  `partname` varchar(25) DEFAULT NULL,
  `bachnum` varchar(20) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `matl_spec` varchar(20) DEFAULT NULL,
  `issues_ps` varchar(10) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `ponum` varchar(20) DEFAULT NULL,
  `part_sl_num` varchar(20) DEFAULT NULL,
  `wonum` varchar(20) DEFAULT NULL,
  `dcnum` varchar(20) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `traceability_recnum` varchar(30) DEFAULT NULL,
  `dim_deviation` varchar(5) DEFAULT NULL,
  `man` varchar(5) DEFAULT NULL,
  `inprocess` varchar(5) DEFAULT NULL,
  `mat_deviation` varchar(5) DEFAULT NULL,
  `machine` varchar(5) DEFAULT NULL,
  `final_insp` varchar(5) DEFAULT NULL,
  `other_deviation` varchar(5) DEFAULT NULL,
  `method` varchar(5) DEFAULT NULL,
  `cust_end` varchar(5) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `root_cause` varchar(255) DEFAULT NULL,
  `corrective_action` varchar(255) DEFAULT NULL,
  `preventive_action` varchar(255) DEFAULT NULL,
  `effectiveness` varchar(255) DEFAULT NULL,
  `cofcnum` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ncqa`
--

LOCK TABLES `ncqa` WRITE;
/*!40000 ALTER TABLE `ncqa` DISABLE KEYS */;
/*!40000 ALTER TABLE `ncqa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `recnum` int(11) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `descr` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (20,'bmandyam','2016-09-28','test tuss uuiyi hiiox jhiihk kkhihi kkhoo hkhoo hoo hoos mshklhdl kksoi ksdkls lsdlsos kxnksdko sdklklsdhlshdlksljdosd khsdkshdskhdks khkhkhkhkh hkhkhkhl.'),(21,'bmandyam','2016-09-29','  dsgdsg gfsdg sdgfdsgds gsdg sdgsdgdsg dfgsdfgfsg fdgsd'),(22,'bmandyam','2016-09-30','  hjhgkj'),(23,'bmandyam','2016-09-28','  cgfdg');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2wo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oper_mc_usage`
--

DROP TABLE IF EXISTS `oper_mc_usage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oper_mc_usage` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `mc_id` varchar(20) DEFAULT NULL,
  `mc_name` varchar(50) DEFAULT NULL,
  `running_time` float DEFAULT NULL,
  `stage_num` int(11) DEFAULT NULL,
  `link2operator` int(11) DEFAULT NULL,
  `oper_name` varchar(30) DEFAULT NULL,
  `setting_time` float DEFAULT NULL,
  `idle_time` float DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `sl_from` varchar(30) DEFAULT NULL,
  `sl_to` varchar(30) DEFAULT NULL,
  `setting_time_mins` float DEFAULT NULL,
  `running_time_mins` float DEFAULT NULL,
  `idle_time_mins` float DEFAULT NULL,
  `qty_rej` float DEFAULT NULL,
  `markup_time` decimal(4,2) DEFAULT '0.00',
  `markup_time_mins` decimal(4,2) DEFAULT '0.00',
  `markdown_time` decimal(4,2) DEFAULT '0.00',
  `markdown_time_mins` decimal(4,2) DEFAULT '0.00',
  `qty_acc` float DEFAULT NULL,
  `qty_rew` float DEFAULT NULL,
  `breakdown_time` decimal(6,2) DEFAULT NULL,
  `breakdown_time_mins` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`recnum`),
  KEY `ind_link2operator` (`link2operator`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oper_mc_usage`
--

LOCK TABLES `oper_mc_usage` WRITE;
/*!40000 ALTER TABLE `oper_mc_usage` DISABLE KEYS */;
INSERT INTO `oper_mc_usage` VALUES (1,'','BMV 60-1',1,1,1,'',1,0,1,'0','0',0,0,0,0,0.00,0.00,0.00,0.00,1,0,0.00,0.00),(2,'','BMV 1',1,1,2,'',1,0,1,'0','0',0,0,0,0,0.00,0.00,0.00,0.00,1,0,0.00,0.00),(3,'','VMC 2',1,1,3,'',1,1,1,'0','0',0,0,0,0,0.00,0.00,0.00,0.00,1,0,1.00,0.00),(4,'','DMG 3',1,1,4,'',1,1,1,'0','0',0,0,0,0,0.00,0.00,0.00,0.00,1,0,1.00,0.00),(5,'','DX 4',1,1,5,'',1,1,1,'0','0',0,0,0,0,0.00,0.00,0.00,0.00,1,0,1.00,0.00),(6,'','HMC 5',2,1,6,'',2,2,1,'0','0',0,0,0,0,0.00,0.00,0.00,0.00,1,0,2.00,0.00),(7,'','VMC 2',1,1,7,'',1,1,1,'0','0',0,0,0,0,0.00,0.00,0.00,0.00,1,0,1.00,0.00),(8,'','VMC 2',2,1,8,'',2,1,1,'0','0',2,0,0,0,0.00,0.00,0.00,0.00,1,0,2.00,0.00);
/*!40000 ALTER TABLE `oper_mc_usage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operation`
--

DROP TABLE IF EXISTS `operation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operation` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `opnnum` varchar(25) DEFAULT NULL,
  `stn` varchar(50) DEFAULT NULL,
  `oper_descr` varchar(255) DEFAULT NULL,
  `signoff` varchar(50) DEFAULT NULL,
  `link2assywo` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=7029 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operation`
--

LOCK TABLES `operation` WRITE;
/*!40000 ALTER TABLE `operation` DISABLE KEYS */;
/*!40000 ALTER TABLE `operation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operator`
--

DROP TABLE IF EXISTS `operator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operator` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `oper_id` varchar(10) DEFAULT NULL,
  `oper_name` varchar(50) DEFAULT NULL,
  `shift` varchar(10) DEFAULT NULL,
  `crn` varchar(30) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `st_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `qty_rej` int(11) DEFAULT NULL,
  `qty_with_dev` int(11) DEFAULT NULL,
  `qty_accepted` int(11) DEFAULT NULL,
  `mc_name` varchar(50) DEFAULT NULL,
  `wo_num` varchar(20) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recnum`),
  KEY `opcrn` (`crn`),
  KEY `opwonumm` (`wo_num`),
  KEY `ind_opername` (`oper_name`),
  KEY `ind_mc_name` (`mc_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator`
--

LOCK TABLES `operator` WRITE;
/*!40000 ALTER TABLE `operator` DISABLE KEYS */;
INSERT INTO `operator` VALUES (2,'','','1','prn1',NULL,'2016-10-28',NULL,0,0,0,'BMV 1','31404','','Approved','FSI'),(3,'','','1','prn2',NULL,'2016-11-02',NULL,0,0,0,'VMC 2','31400','test','Approved','FSI'),(4,'','','1','prn1',NULL,'2016-11-02',NULL,0,0,0,'DMG 3','31405','test','Approved','FSI'),(5,'','','1','prn3',NULL,'2016-11-02',NULL,0,0,0,'DX 4','31398','test','Approved','FSI'),(6,'','','1','prn5',NULL,'2016-11-02',NULL,0,0,0,'HMC 5','31401','test','Approved','FSI'),(7,'','','1','prn2',NULL,'2016-11-04',NULL,0,0,0,'VMC 2','31400','TEST','Approved','FSI'),(8,'','','1','prn3',NULL,'2016-11-10',NULL,0,0,0,'VMC 2','31414','test','Approved','FSI');
/*!40000 ALTER TABLE `operator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opportunity_notes`
--

DROP TABLE IF EXISTS `opportunity_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opportunity_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2opportunity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opportunity_notes`
--

LOCK TABLES `opportunity_notes` WRITE;
/*!40000 ALTER TABLE `opportunity_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `opportunity_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packing`
--

DROP TABLE IF EXISTS `packing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packing` (
  `recnum` int(10) unsigned NOT NULL,
  `ponum` varchar(45) DEFAULT NULL,
  `podate` date DEFAULT NULL,
  `wonum` varchar(45) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `order_qty` varchar(45) DEFAULT NULL,
  `qty_dispatch` varchar(45) DEFAULT NULL,
  `qty_balance` varchar(45) DEFAULT NULL,
  `cim_invoice` varchar(45) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `pack_date` date DEFAULT NULL,
  `no_packings` int(10) unsigned DEFAULT NULL,
  `type_packing` varchar(255) DEFAULT NULL,
  `transportation` varchar(100) DEFAULT NULL,
  `link2company` int(10) unsigned DEFAULT NULL,
  `packingnum` varchar(45) DEFAULT NULL,
  `link2invoice` int(10) unsigned DEFAULT NULL,
  `formrev` varchar(255) DEFAULT NULL,
  `tot_net_wt` float DEFAULT NULL,
  `gross_wt` float DEFAULT NULL,
  `siteid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packing`
--

LOCK TABLES `packing` WRITE;
/*!40000 ALTER TABLE `packing` DISABLE KEYS */;
/*!40000 ALTER TABLE `packing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part_bom`
--

DROP TABLE IF EXISTS `part_bom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_bom` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `part_unit` varchar(20) DEFAULT NULL,
  `rm_spec` varchar(20) DEFAULT NULL,
  `req_rm_qty` int(11) DEFAULT NULL,
  `rm_units` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part_bom`
--

LOCK TABLES `part_bom` WRITE;
/*!40000 ALTER TABLE `part_bom` DISABLE KEYS */;
/*!40000 ALTER TABLE `part_bom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part_master`
--

DROP TABLE IF EXISTS `part_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_master` (
  `recnum` int(11) DEFAULT NULL,
  `part_num` varchar(100) DEFAULT NULL,
  `part_desc` varchar(255) DEFAULT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `domain` varchar(50) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `units` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `store_qty` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part_master`
--

LOCK TABLES `part_master` WRITE;
/*!40000 ALTER TABLE `part_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `part_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part_used`
--

DROP TABLE IF EXISTS `part_used`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_used` (
  `recnum` int(11) DEFAULT NULL,
  `part_used_num` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `subtype` varchar(30) DEFAULT NULL,
  `part_used2part_master` int(11) DEFAULT NULL,
  `part_used2type` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part_used`
--

LOCK TABLES `part_used` WRITE;
/*!40000 ALTER TABLE `part_used` DISABLE KEYS */;
/*!40000 ALTER TABLE `part_used` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partwise_req`
--

DROP TABLE IF EXISTS `partwise_req`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partwise_req` (
  `recnum` int(11) DEFAULT NULL,
  `slnum` int(11) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `customer` varchar(30) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `achieved` varchar(10) DEFAULT NULL,
  `balance` varchar(20) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partwise_req`
--

LOCK TABLES `partwise_req` WRITE;
/*!40000 ALTER TABLE `partwise_req` DISABLE KEYS */;
/*!40000 ALTER TABLE `partwise_req` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll`
--

DROP TABLE IF EXISTS `payroll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `init` varchar(1) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `bdate` date NOT NULL,
  `dept` varchar(15) NOT NULL,
  `position` varchar(45) NOT NULL,
  `pay` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `dayswork` int(10) unsigned NOT NULL DEFAULT '0',
  `otrate` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `othrs` int(10) unsigned NOT NULL DEFAULT '0',
  `allow` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `advances` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `insurance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `siteid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll`
--

LOCK TABLES `payroll` WRITE;
/*!40000 ALTER TABLE `payroll` DISABLE KEYS */;
INSERT INTO `payroll` VALUES (1,'aa','ass','a','male','2017-05-02','Accounting','',0.00,0,0.00,0,0.00,0.00,0.00,'flu_1779'),(2,'s','a','s','male','2017-05-31','Accounting','',0.00,0,0.00,0,0.00,0.00,0.00,'flu_1779'),(3,'','','','male','0000-00-00','Accounting','',0.00,0,0.00,0,0.00,0.00,0.00,'E3456'),(4,'','','','male','0000-00-00','Marketing','',0.00,0,0.00,0,0.00,0.00,0.00,'FSI');
/*!40000 ALTER TABLE `payroll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_master`
--

DROP TABLE IF EXISTS `payroll_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_master` (
  `recnum` int(11) DEFAULT NULL,
  `id` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `basic_salary` int(11) DEFAULT NULL,
  `hra` varchar(30) DEFAULT NULL,
  `ta` varchar(100) DEFAULT NULL,
  `sa` varchar(100) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `increment` int(11) DEFAULT NULL,
  `siteid` varchar(55) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `grade` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_master`
--

LOCK TABLES `payroll_master` WRITE;
/*!40000 ALTER TABLE `payroll_master` DISABLE KEYS */;
INSERT INTO `payroll_master` VALUES (3,'E242','Karthick',8000,'5000','2000','5000','2015-04-06',5000,'FSI','Developer','S');
/*!40000 ALTER TABLE `payroll_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_monthly`
--

DROP TABLE IF EXISTS `payroll_monthly`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_monthly` (
  `recnum` int(11) DEFAULT NULL,
  `id` varchar(20) DEFAULT NULL,
  `hrs_worked` int(11) DEFAULT NULL,
  `ot` int(11) DEFAULT NULL,
  `gross_salary` int(11) DEFAULT NULL,
  `tds` int(11) DEFAULT NULL,
  `net_salary` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `siteid` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_monthly`
--

LOCK TABLES `payroll_monthly` WRITE;
/*!40000 ALTER TABLE `payroll_monthly` DISABLE KEYS */;
INSERT INTO `payroll_monthly` VALUES (7,'E242',35,0,4583,0,4583,'2017-08-07','FSI');
/*!40000 ALTER TABLE `payroll_monthly` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_trans`
--

DROP TABLE IF EXISTS `payroll_trans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_trans` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `empid` varchar(50) DEFAULT NULL,
  `date` datetime NOT NULL,
  `siteid` varchar(50) NOT NULL,
  `checkInOut` tinyint(1) DEFAULT NULL,
  `TaskId` varchar(50) NOT NULL,
  `Lat` varchar(50) NOT NULL,
  `Lon` varchar(50) NOT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_trans`
--

LOCK TABLES `payroll_trans` WRITE;
/*!40000 ALTER TABLE `payroll_trans` DISABLE KEYS */;
INSERT INTO `payroll_trans` VALUES (1,'E2','2017-08-21 16:37:03','FSI',1,'TK-8','0','0'),(2,'E2','2017-08-21 16:37:11','FSI',0,'TK-8','0','0'),(3,'E2','2017-08-21 17:03:41','FSI',1,'TK-11','0','0'),(4,'E2','2017-08-21 17:20:33','FSI',0,'TK-11','0','0'),(5,'E2','2017-08-21 17:30:41','FSI',1,'TK-11','0','0'),(6,'E2','2017-08-21 17:35:37','FSI',2,'TK-11','0','0'),(7,'E2','2017-08-21 17:36:38','FSI',0,'TK-11','0','0'),(8,'E2','2017-08-22 10:26:52','FSI',1,'TK-9','0','0'),(9,'E2','2017-08-22 10:27:13','FSI',0,'TK-9','0','0'),(10,'E2','2017-08-22 11:48:41','FSI',1,'TK-9','0','0'),(11,'E2','2017-08-22 15:00:00','FSI',2,'TK-9','0','0');
/*!40000 ALTER TABLE `payroll_trans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po`
--

DROP TABLE IF EXISTS `po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `po` (
  `recnum` int(11) DEFAULT NULL,
  `ponum` varchar(100) DEFAULT NULL,
  `podate` varchar(255) DEFAULT NULL,
  `podescr` varchar(100) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `ship_via` varchar(255) DEFAULT NULL,
  `acct_num` varchar(255) DEFAULT NULL,
  `fob` varchar(255) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `poamount` decimal(15,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `wonum` varchar(50) DEFAULT NULL,
  `link2vendor` int(11) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `last_modified` date DEFAULT NULL,
  `tax` decimal(15,2) DEFAULT NULL,
  `shipping` decimal(15,2) DEFAULT NULL,
  `labor` decimal(15,2) DEFAULT NULL,
  `total_due` decimal(15,2) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `formatnum` varchar(255) DEFAULT NULL,
  `formatrev` varchar(255) DEFAULT NULL,
  `remarks` text,
  `approval` varchar(5) DEFAULT NULL,
  `approvaldate` date DEFAULT NULL,
  `amendment_num` varchar(100) DEFAULT NULL,
  `amendmentdate` date DEFAULT NULL,
  `amendment_notes` longtext,
  `communication` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po`
--

LOCK TABLES `po` WRITE;
/*!40000 ALTER TABLE `po` DISABLE KEYS */;
INSERT INTO `po` VALUES (1019,'1','2016-06-13','test','',NULL,NULL,NULL,NULL,100.00,'Open','',2,'2016-06-28',NULL,0.00,0.00,0.00,100.00,'$','F7003-S','Rev 0','','yes','2016-06-28','','2016-06-22',' \r\n \r\n \r\n',0,'Regular','FSI',NULL),(1020,'2','2016-06-13','test','',NULL,NULL,NULL,NULL,4324.00,'Open','',129,'2016-06-28',NULL,0.00,0.00,0.00,4324.00,'$','F7003-S','Rev 0','','yes','2016-06-28','','0000-00-00',' \r\n',0,'Regular','FSI',NULL),(1021,'3','2016-06-14','test','ewr',NULL,NULL,NULL,NULL,0.00,'Open','',129,'2016-06-29',NULL,0.00,0.00,0.00,0.00,'$','F7003-S','Rev 0','ewr','yes','2016-06-29','ew','2016-06-29',' \r\n',0,'Regular','FSI',NULL),(1022,'4','2016-06-20','test','',NULL,NULL,NULL,NULL,0.00,'Open','',130,'2016-06-29',NULL,0.00,0.00,0.00,0.00,'$','F7003-S','Rev 0','','yes','2016-06-29','','0000-00-00',' \r\n \r\n',0,'Regular','FSI',NULL),(1024,'5','2016-07-25','test','',NULL,NULL,NULL,NULL,0.00,'Open','',130,'2016-07-01',NULL,0.00,0.00,0.00,0.00,'$','F7003-S','Rev 0','','yes','2016-07-01','','0000-00-00',' \r\n',0,'Regular','FSI',NULL),(1025,'6','2016-07-25','test','',NULL,NULL,NULL,NULL,0.00,'Pending','',129,'2016-07-28',NULL,0.00,0.00,0.00,0.00,'$','F7003-S','Rev 0','',NULL,NULL,'','2016-07-27','',0,'Regular','FSI',NULL),(1026,'234','2016-09-30','test','',NULL,NULL,NULL,NULL,0.00,'Open','',129,'2016-09-30',NULL,0.00,0.00,0.00,0.00,'$','F7003-S','Rev 0','','yes','2016-09-30','','0000-00-00',' \r\n',0,'Regular','FSI',NULL),(1027,'555','2016-10-4','test','',NULL,NULL,NULL,NULL,0.00,'Open','',129,'2016-10-12',NULL,0.00,0.00,0.00,0.00,'$','F7003-S','Rev 0','','yes','2016-10-12','','0000-00-00',' \r\n',0,'Regular','FSI',NULL),(1028,'5551','2016-10-18','test','',NULL,NULL,NULL,NULL,0.00,'Open','',129,'2016-10-18',NULL,0.00,0.00,0.00,0.00,'$','F7003-S','Rev 0','','yes','2016-10-18','','2016-10-17',' \r\n \r\n',0,'Regular','FSI',NULL),(1029,'PO-001','2017-08-8','ghjdfhj','fgdhf',NULL,NULL,NULL,NULL,12.00,'Open','',129,'2017-08-08',NULL,0.00,0.00,0.00,12.00,'$','F7003-S','Rev 0','gh','yes','2017-08-08','','0000-00-00','dfhdf \r\n \r\n',0,'Regular','FSI',NULL),(1030,'KARPO-001','2017-12-4','po desc','sfgsf',NULL,NULL,NULL,NULL,10.00,'Open','',132,'2017-12-05',NULL,0.00,0.00,0.00,10.00,'$','F7003-S','Rev 0','gsafgs','yes','2017-12-05','','0000-00-00',' \r\n',0,'Regular','FSI',NULL),(1031,'KAR-002','2017-12-5','fsgsafgas','dfgsdaf',NULL,NULL,NULL,NULL,1000.00,'Open','',132,'2017-12-05',NULL,0.00,0.00,0.00,1000.00,'$','F7003-S','Rev 0','gsafgs','yes','2017-12-05','','0000-00-00',' \r\n',0,'Bought Out','FSI',NULL),(1032,'KARCO-001','2017-12-5','ghjdfh','jfdh',NULL,NULL,NULL,NULL,1000.00,'Open','',132,'2017-12-05',NULL,0.00,0.00,0.00,1000.00,'$','F7003-S','Rev 0','jdfjf','yes','2017-12-11','','0000-00-00',' \r\n \r\n ',0,'Consummables','FSI',NULL);
/*!40000 ALTER TABLE `po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po_line_items`
--

DROP TABLE IF EXISTS `po_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `po_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_desc` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `rate` decimal(15,2) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `shipping_handling` decimal(10,2) DEFAULT NULL,
  `taxes` decimal(15,2) DEFAULT NULL,
  `link2po` int(11) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `last_modified` date DEFAULT NULL,
  `material_ref` varchar(255) DEFAULT NULL,
  `material_spec` varchar(255) DEFAULT NULL,
  `thick` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `qty_per_meter` float DEFAULT NULL,
  `no_of_meterages` float DEFAULT NULL,
  `delv_by` varchar(20) DEFAULT NULL,
  `uom` varchar(30) DEFAULT NULL,
  `grainflow` varchar(100) DEFAULT NULL,
  `no_of_lengths` float DEFAULT NULL,
  `accepted_date` date DEFAULT NULL,
  `condition` text,
  `crn` varchar(100) DEFAULT NULL,
  `maxruling` varchar(100) DEFAULT NULL,
  `qty_rej` int(11) DEFAULT NULL,
  `delivery_time` int(11) DEFAULT NULL,
  `order_qty` decimal(10,2) DEFAULT NULL,
  `alt_spec_rm` varchar(45) DEFAULT NULL,
  `spec_type` varchar(45) DEFAULT NULL,
  `layoutrefnum` varchar(45) DEFAULT NULL,
  `qty_recd` float DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `grn_num` varchar(45) DEFAULT NULL,
  `due_date1` date DEFAULT NULL,
  `due_date2` date DEFAULT NULL,
  `cim1_approval` varchar(5) DEFAULT NULL,
  `cim2_approval` varchar(5) DEFAULT NULL,
  KEY `ind_link2po` (`link2po`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po_line_items`
--

LOCK TABLES `po_line_items` WRITE;
/*!40000 ALTER TABLE `po_line_items` DISABLE KEYS */;
INSERT INTO `po_line_items` VALUES (10088,'1','','',NULL,'2014-07-23',100.00,100.00,NULL,NULL,1019,'2016-06-28',NULL,'RMT','RMS','100','100','100',NULL,0,'SEA','MM','',1,'2016-06-30','','PRN1','',0,0,1.00,'100','Primary Spec','',0.021,'Open','','G1','2014-07-09','2014-07-02',NULL,NULL),(10089,'1','','',NULL,'2016-09-09',4324.00,4324.00,NULL,NULL,1020,'2016-06-28',NULL,'sc','csc','43','41','421',NULL,0,'SEA','Inches','31',1,'0000-00-00','','prn2','123',0,0,22.00,'4324','Alt Spec2','',0,'Open','','','0000-00-00','0000-00-00','',''),(10090,'1','','',NULL,'0000-00-00',0.00,0.00,NULL,NULL,1021,'2016-06-29',NULL,'RMT3','RMS3','2','2','21',NULL,0,'SEA','Inches','2',5,'0000-00-00','sf','prn3','1',0,0,10.00,'','Alt Spec2','',0,'Open','','','0000-00-00','0000-00-00',NULL,NULL),(10091,'1','','',NULL,'2016-07-19',0.00,0.00,NULL,NULL,1022,'2016-06-29',NULL,'RMT4','RMS4','11','10','22',NULL,1,'SEA','MM','',1,'0000-00-00','','prn4','',0,0,20.00,'','Alt Spec1','',0,'Open','','','2016-07-14','2016-07-29','',''),(10092,'1','','',NULL,'0000-00-00',1313.00,0.00,NULL,NULL,1024,'2016-07-01',NULL,'sfff','affs','12','12','21',NULL,0,'SEA','Inches','13',0,'0000-00-00','','prn5','133',0,0,1.00,'1313','Alt Spec2','',0,'Open','','','0000-00-00','0000-00-00',NULL,NULL),(10093,'1','','',NULL,'0000-00-00',24324.00,0.00,NULL,NULL,1025,'2016-07-28',NULL,'dg','gdsg','23','32','24',NULL,0,'SEA','Inches','32',0,'0000-00-00','','prn6','34',0,0,1.00,'24324','Alt Spec2','',0,'Open','','','0000-00-00','0000-00-00',NULL,NULL),(10094,'1','','',NULL,'0000-00-00',0.00,0.00,NULL,NULL,1026,'2016-09-30',NULL,'RMT 6','RMS 6','44','566','450',NULL,0,'SEA','MM','',0,'0000-00-00','TEST','prn6','',0,0,10.00,'','Alt Spec1','',0,'Open','','','0000-00-00','0000-00-00',NULL,NULL),(10095,'1','','',NULL,'0000-00-00',0.00,0.00,NULL,NULL,1027,'2016-10-12',NULL,'RMS 7','RMT 7','33','33','342',NULL,0,'SEA','MM','',0,'0000-00-00','','prn7','',0,0,120.00,'','Primary Spec','',0,'Open','','','0000-00-00','0000-00-00',NULL,NULL),(10096,'1','','',NULL,'2017-02-28',100.00,0.00,NULL,NULL,1028,'2016-10-18',NULL,'RMT 8','RMS 8','40','34','200',NULL,0,'SEA','MM','',0,'2017-02-20','','prn8','',0,0,30.00,'100','Primary Spec','',1,'Open','','','2017-09-30','2017-09-30',NULL,NULL),(10097,'1','','',NULL,'2017-09-01',12.00,12.00,NULL,NULL,1029,'2017-08-08',NULL,'rmt','rms','2','100','50',NULL,0,'SEA','MM','2',1,'0000-00-00','sgasg','RMK_001','we',0,0,50.00,'12','Primary Spec','',0,'Open','dfgasgas','','2017-10-01','2017-10-31',NULL,NULL),(10098,'1-1','','',NULL,'2014-07-23',100.00,100.00,NULL,NULL,1019,'2016-06-28',NULL,'RMT','RMS','100','100','100',NULL,0,'SEA','MM','',1,'2017-11-22','','PRN1','',0,0,1.00,'100','Primary Spec','',1,'Open','','G00010',NULL,NULL,NULL,NULL),(10099,'1','','',NULL,'0000-00-00',10.00,10.00,NULL,NULL,1030,'2017-12-05',NULL,'rm type','rm spec','5','100','20',NULL,0,'SEA','MM','',1,'0000-00-00','nothing','flu-001','',0,0,100.00,'10','Primary Spec','',0,'Open','','','0000-00-00','0000-00-00',NULL,NULL),(10100,'1','','',NULL,'0000-00-00',10.00,1000.00,NULL,NULL,1031,'2017-12-05',NULL,'PART','rmk 00 12','','','',NULL,0,'SEA','','',100,'2017-12-06','','rmk 00 12','',0,0,100.00,'','Primary Spec','',10,'Open','','kar00002','0000-00-00','0000-00-00',NULL,NULL),(10101,'1','','',NULL,'0000-00-00',10.00,1000.00,NULL,NULL,1032,'2017-12-05',NULL,'PART','rmk 00 13','','','',NULL,0,'SEA','','',100,'2017-12-06','','rmk 00 13','',0,0,100.00,'','Primary Spec','',10,'Open','','kar00003','0000-00-00','0000-00-00',NULL,NULL);
/*!40000 ALTER TABLE `po_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po_notes`
--

DROP TABLE IF EXISTS `po_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `po_notes` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ponotes` longtext,
  `link2user` varchar(50) DEFAULT NULL,
  `link2po` int(10) unsigned DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po_notes`
--

LOCK TABLES `po_notes` WRITE;
/*!40000 ALTER TABLE `po_notes` DISABLE KEYS */;
INSERT INTO `po_notes` VALUES (1,'sadfdsgsdg','bmandyam',1015,'2016-05-26','2016-05-26'),(2,'sadfdsgsdg','bmandyam',1015,'2016-05-26','2016-05-26'),(3,'sadfdsgsdg','bmandyam',1015,'2016-05-26','2016-05-26'),(4,'sadfdsgsdg','bmandyam',1015,'2016-05-26','2016-05-26'),(5,'sadfdsgsdg','bmandyam',1015,'2016-05-26','2016-05-26'),(6,'sadfdsgsdg','bmandyam',1015,'2016-05-26','2016-05-26'),(7,'dsfsdgfdf','bmandyam',1015,'2016-05-26','2016-05-26'),(8,'1321424fdgdg','bmandyam',1015,'2016-05-26','2016-05-26'),(9,'swad','bmandyam',1015,'2016-05-26','2016-05-26'),(10,'saf','bmandyam',1015,'2016-05-26','2016-05-26'),(11,'safdsgds','bmandyam',1012,'2016-05-26','2016-05-26'),(12,'cxgvfd','bmandyam',1012,'2016-05-26','2016-05-26'),(13,'test','bmandyam',1012,'2016-06-01','2016-06-01'),(14,'test1','bmandyam',1012,'2016-06-01','2016-06-01'),(15,'test','bmandyam',1007,'2016-06-01','2016-06-01'),(16,'testing','bmandyam',1022,'2016-07-04','2016-07-04'),(17,'tes','bmandyam',1020,'2017-02-16','2017-02-16');
/*!40000 ALTER TABLE `po_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price`
--

DROP TABLE IF EXISTS `price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price` (
  `recnum` int(11) DEFAULT NULL,
  `crn` char(50) DEFAULT NULL,
  `partnum` varchar(255) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `currency` char(5) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `price_valid_from` date DEFAULT NULL,
  `price_valid_to` date DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `link2customer` int(10) unsigned DEFAULT NULL,
  `partname` varchar(255) DEFAULT NULL,
  `formrev` varchar(255) DEFAULT NULL,
  `siteid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price`
--

LOCK TABLES `price` WRITE;
/*!40000 ALTER TABLE `price` DISABLE KEYS */;
INSERT INTO `price` VALUES (1,'prn1','3434','','$',100.00,'Open','2016-10-25','2016-11-30','2016-10-25','2016-10-25','Treated',127,'dfdf','F7000 Rev 00 dt August 04, 2011;',NULL),(2,'3543','3543','','$',0.00,'Open','2016-11-02','2016-12-31','2016-11-02',NULL,'Treated',130,'dfdf','F7000 Rev 00 dt August 04, 2011;',NULL);
/*!40000 ALTER TABLE `price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proc_deviation`
--

DROP TABLE IF EXISTS `proc_deviation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proc_deviation` (
  `recnum` int(11) DEFAULT NULL,
  `partnumber` varchar(50) DEFAULT NULL,
  `drgissue` varchar(50) DEFAULT NULL,
  `procdev2customer` int(11) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `matltype` varchar(50) DEFAULT NULL,
  `matlspec` varchar(50) DEFAULT NULL,
  `project` varchar(100) DEFAULT NULL,
  `refno` varchar(50) DEFAULT NULL,
  `attachments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proc_deviation`
--

LOCK TABLES `proc_deviation` WRITE;
/*!40000 ALTER TABLE `proc_deviation` DISABLE KEYS */;
/*!40000 ALTER TABLE `proc_deviation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proc_deviation_li`
--

DROP TABLE IF EXISTS `proc_deviation_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proc_deviation_li` (
  `recnum` int(11) DEFAULT NULL,
  `sl_num` varchar(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `signature` varchar(50) DEFAULT NULL,
  `link2procdev` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proc_deviation_li`
--

LOCK TABLES `proc_deviation_li` WRITE;
/*!40000 ALTER TABLE `proc_deviation_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `proc_deviation_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process_details`
--

DROP TABLE IF EXISTS `process_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process_details` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `part_tasks` varchar(20) DEFAULT NULL,
  `mfg_cycle_time` varchar(20) DEFAULT NULL,
  `inspection_time` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process_details`
--

LOCK TABLES `process_details` WRITE;
/*!40000 ALTER TABLE `process_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `process_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `production_plan`
--

DROP TABLE IF EXISTS `production_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `production_plan` (
  `recnum` int(11) DEFAULT NULL,
  `slnum` int(11) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `customer` varchar(30) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `production_plan`
--

LOCK TABLES `production_plan` WRITE;
/*!40000 ALTER TABLE `production_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `production_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `production_sch`
--

DROP TABLE IF EXISTS `production_sch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `production_sch` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `est_start_date` date DEFAULT NULL,
  `crnnum` varchar(30) DEFAULT NULL,
  `book_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `production_sch`
--

LOCK TABLES `production_sch` WRITE;
/*!40000 ALTER TABLE `production_sch` DISABLE KEYS */;
/*!40000 ALTER TABLE `production_sch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(255) DEFAULT NULL,
  `desc` text,
  `start_date` date DEFAULT NULL,
  `closed_date` date DEFAULT NULL,
  `manager` char(100) DEFAULT NULL,
  `req` varchar(255) DEFAULT NULL,
  `category` char(50) DEFAULT NULL,
  `technology` char(50) DEFAULT NULL,
  `platform` char(50) DEFAULT NULL,
  `link2site` int(11) DEFAULT NULL,
  `released_to` varchar(255) DEFAULT NULL,
  `link2company` int(11) DEFAULT NULL,
  `siteid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'React','React','2017-08-10','2017-09-30','Karthick','2 laps','Wep App','Web App','JS',NULL,NULL,134,NULL),(2,'laravel','simple crud application','2017-09-01','2017-09-30','karthick','nothing','crud','react','php',NULL,NULL,134,NULL);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchasing_alloc`
--

DROP TABLE IF EXISTS `purchasing_alloc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchasing_alloc` (
  `recnum` int(11) NOT NULL DEFAULT '0',
  `linenum` varchar(20) DEFAULT NULL,
  `mat_spec` varchar(30) DEFAULT NULL,
  `crn` varchar(30) DEFAULT NULL,
  `qty_allocated` int(11) DEFAULT NULL,
  `ponum` varchar(100) DEFAULT NULL,
  `link2poli` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchasing_alloc`
--

LOCK TABLES `purchasing_alloc` WRITE;
/*!40000 ALTER TABLE `purchasing_alloc` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchasing_alloc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quality_plan`
--

DROP TABLE IF EXISTS `quality_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quality_plan` (
  `recnum` int(11) DEFAULT NULL,
  `opnrefno` varchar(50) DEFAULT NULL,
  `operationnumber` varchar(50) DEFAULT NULL,
  `partnumber` varchar(50) DEFAULT NULL,
  `revnumber` varchar(50) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `revdate` date DEFAULT NULL,
  `parttype` varchar(100) DEFAULT NULL,
  `drgissue` varchar(50) DEFAULT NULL,
  `approvedby` varchar(100) DEFAULT NULL,
  `preparedby` varchar(100) DEFAULT NULL,
  `issuesnumber` varchar(50) DEFAULT NULL,
  `sheet` varchar(50) DEFAULT NULL,
  `attachments` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quality_plan`
--

LOCK TABLES `quality_plan` WRITE;
/*!40000 ALTER TABLE `quality_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `quality_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quality_plan_line_items`
--

DROP TABLE IF EXISTS `quality_plan_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quality_plan_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `sl_num` varchar(20) DEFAULT NULL,
  `drawing_dim` varchar(50) DEFAULT NULL,
  `measuring_istrument` varchar(50) DEFAULT NULL,
  `samplesize` varchar(50) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `link2qualityplan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quality_plan_line_items`
--

LOCK TABLES `quality_plan_line_items` WRITE;
/*!40000 ALTER TABLE `quality_plan_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `quality_plan_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote`
--

DROP TABLE IF EXISTS `quote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote` (
  `recnum` int(11) DEFAULT NULL,
  `id` varchar(100) DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `excelfile` varchar(255) DEFAULT NULL,
  `rfqid` varchar(30) DEFAULT NULL,
  `owner_userid` varchar(25) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `last_modified` date DEFAULT NULL,
  `delivarydate` date DEFAULT NULL,
  `terms` varchar(150) DEFAULT NULL,
  `quote2type` int(11) DEFAULT NULL,
  `quotetype` varchar(100) DEFAULT NULL,
  `comments` varchar(100) DEFAULT NULL,
  `quote2company` int(11) DEFAULT NULL,
  `convert2sales` varchar(50) DEFAULT NULL,
  `quote2employee` varchar(50) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `mail2customer` varchar(255) DEFAULT NULL,
  `quote_grosstotal` float DEFAULT NULL,
  `link2bom` int(11) DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `labor` float DEFAULT NULL,
  `shipping` float DEFAULT NULL,
  `misc` float DEFAULT NULL,
  `revise_num` int(11) DEFAULT NULL,
  `parent_quote_id` varchar(20) DEFAULT NULL,
  `lockstatus` varchar(20) DEFAULT NULL,
  `total_due` float DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote`
--

LOCK TABLES `quote` WRITE;
/*!40000 ALTER TABLE `quote` DISABLE KEYS */;
INSERT INTO `quote` VALUES (33,'12','2016-08-14','aaaa','test','','','bmandyam',NULL,'2016-08-22',NULL,'2016-08-10','',NULL,NULL,'',130,NULL,'2','$',NULL,1000,0,0,0,0,0,0,'12','Not Locked',NULL,'FSI'),(34,'12-1','2016-08-14','aaaa','test','','','bmandyam',NULL,'2017-02-17',NULL,'2016-08-10','',NULL,NULL,'',130,NULL,'2','$',NULL,1000,0,0,0,0,0,1,'12','Not Locked',NULL,'FSI'),(35,'12-2','2016-08-14','aaaa','test','','','bmandyam',NULL,'2017-02-17',NULL,'2016-08-10','',NULL,NULL,'',130,NULL,'2','$',NULL,1000,0,0,0,0,0,2,'12','Not Locked',NULL,'FSI'),(36,'12-3','2016-08-14','aaaa','test','','','bmandyam',NULL,'2017-02-17',NULL,'2016-08-10','',NULL,NULL,'',130,NULL,'2','$',NULL,1000,0,0,0,0,0,3,'12','Not Locked',NULL,'FSI');
/*!40000 ALTER TABLE `quote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_li`
--

DROP TABLE IF EXISTS `quote_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_li` (
  `recnum` int(11) DEFAULT NULL,
  `item` varchar(20) DEFAULT NULL,
  `item_desc` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `link2quote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_li`
--

LOCK TABLES `quote_li` WRITE;
/*!40000 ALTER TABLE `quote_li` DISABLE KEYS */;
INSERT INTO `quote_li` VALUES (35,'1','test',10,100,1000,33),(36,'1','test',10,100,1000,34),(37,'1','test',10,100,1000,35),(38,'1','test',10,100,1000,36);
/*!40000 ALTER TABLE `quote_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_requirement`
--

DROP TABLE IF EXISTS `resource_requirement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_requirement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customercompanyid` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(50) NOT NULL,
  `requirement` int(11) NOT NULL,
  `upload_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_requirement`
--

LOCK TABLES `resource_requirement` WRITE;
/*!40000 ALTER TABLE `resource_requirement` DISABLE KEYS */;
INSERT INTO `resource_requirement` VALUES (1,'A127','2017-11-21','day',1,'2017-11-21'),(2,'A127','2017-11-21','day night',1,'2017-11-21'),(3,'A127','2017-11-21','night',1,'2017-11-21'),(4,'A127','2017-11-22','day',1,'2017-11-21'),(5,'A127','2017-11-22','day night',1,'2017-11-21'),(6,'A127','2017-11-22','night',1,'2017-11-21'),(7,'A127','2017-11-23','day',1,'2017-11-21'),(8,'A127','2017-11-23','day night',1,'2017-11-21'),(9,'A127','2017-11-23','night',1,'2017-11-21');
/*!40000 ALTER TABLE `resource_requirement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_schdule`
--

DROP TABLE IF EXISTS `resource_schdule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_schdule` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `parent_company` varchar(20) DEFAULT NULL,
  `subsidary` varchar(20) DEFAULT NULL,
  `empid` varchar(50) DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  `shift` varchar(20) DEFAULT NULL,
  `shiftdate` date DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `link2resourceupload` int(11) DEFAULT NULL,
  `insert_type` varchar(50) DEFAULT NULL,
  KEY `recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_schdule`
--

LOCK TABLES `resource_schdule` WRITE;
/*!40000 ALTER TABLE `resource_schdule` DISABLE KEYS */;
INSERT INTO `resource_schdule` VALUES (1,'FSI','A127','E249',NULL,'day','2017-11-21','2017-11-21','sa',1,'Import'),(2,'FSI','A127','E249',NULL,'day','2017-11-22','2017-11-21','bmandyam',0,'manual'),(3,'FSI','A127','E250',NULL,'day night','2017-11-21','2017-11-21','bmandyam',0,'manual'),(4,'FSI','A127','E251',NULL,'night','2017-11-21','2017-11-21','bmandyam',0,'manual');
/*!40000 ALTER TABLE `resource_schdule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_upload`
--

DROP TABLE IF EXISTS `resource_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_upload` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `upload_name` varchar(50) DEFAULT NULL,
  `upload_size` varchar(50) DEFAULT NULL,
  `upload_by` varchar(50) DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  KEY `recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_upload`
--

LOCK TABLES `resource_upload` WRITE;
/*!40000 ALTER TABLE `resource_upload` DISABLE KEYS */;
INSERT INTO `resource_upload` VALUES (1,'Import_2017-11-21 08:24:37','','sa','2017-11-21',1);
/*!40000 ALTER TABLE `resource_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review_line_items`
--

DROP TABLE IF EXISTS `review_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review_line_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `line_num` varchar(20) DEFAULT NULL,
  `item_desc` varchar(255) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `rmtype` varchar(50) DEFAULT NULL,
  `rmspec` varchar(50) DEFAULT NULL,
  `partiss` varchar(50) DEFAULT NULL,
  `drgiss` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `link2review` int(11) DEFAULT NULL,
  `hcdrgiss` varchar(50) DEFAULT NULL,
  `hcpartiss` varchar(50) DEFAULT NULL,
  `po_cos` varchar(50) DEFAULT NULL,
  `hc_cos` varchar(50) DEFAULT NULL,
  `cos_iss` varchar(50) DEFAULT NULL,
  `uom` varchar(10) DEFAULT NULL,
  `dia` decimal(8,2) DEFAULT NULL,
  `length` decimal(8,2) DEFAULT NULL,
  `width` decimal(8,2) DEFAULT NULL,
  `thickness` decimal(8,2) DEFAULT NULL,
  `grainflow` varchar(50) DEFAULT NULL,
  `maxruling` varchar(50) DEFAULT NULL,
  `altspec` varchar(50) DEFAULT NULL,
  `model_iss` varchar(50) DEFAULT NULL,
  `crn_num` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review_line_items`
--

LOCK TABLES `review_line_items` WRITE;
/*!40000 ALTER TABLE `review_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `review_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review_notes`
--

DROP TABLE IF EXISTS `review_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review_notes` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `stamp_created` datetime DEFAULT NULL,
  `stamp_updated` datetime DEFAULT NULL,
  `notes` longtext,
  `notes2review` int(11) DEFAULT NULL,
  `notes2user` varchar(50) DEFAULT NULL,
  `dept` char(20) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=5526 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review_notes`
--

LOCK TABLES `review_notes` WRITE;
/*!40000 ALTER TABLE `review_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `review_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rfq`
--

DROP TABLE IF EXISTS `rfq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rfq` (
  `recnum` int(11) DEFAULT NULL,
  `rfqid` varchar(50) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfq`
--

LOCK TABLES `rfq` WRITE;
/*!40000 ALTER TABLE `rfq` DISABLE KEYS */;
/*!40000 ALTER TABLE `rfq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rma_items`
--

DROP TABLE IF EXISTS `rma_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rma_items` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `link2rma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rma_items`
--

LOCK TABLES `rma_items` WRITE;
/*!40000 ALTER TABLE `rma_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `rma_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rmm_notes`
--

DROP TABLE IF EXISTS `rmm_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rmm_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` text,
  `create_date` date DEFAULT NULL,
  `notes2rmm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rmm_notes`
--

LOCK TABLES `rmm_notes` WRITE;
/*!40000 ALTER TABLE `rmm_notes` DISABLE KEYS */;
INSERT INTO `rmm_notes` VALUES (1,'rshgdhxdh','2016-05-06',3011),(1,'wa','2016-05-10',3011),(1,'dsf','2016-05-17',3015),(1,'testimg','2016-07-04',3014),(1,'testing','2016-07-04',3014),(1,'testing','2016-07-05',3018),(1,'test','2016-07-28',3014),(1,'test','2016-08-23',3019),(1,'test','2016-08-23',3019),(1,'test','2016-08-23',3019),(1,'test','2016-08-23',3019),(1,'test','2016-08-23',3019),(1,'test','2016-08-23',3020),(1,'test','2016-09-30',3021),(1,'test','2016-09-30',3021),(1,'test','2016-09-30',3021),(1,'test','2016-09-30',3023),(1,'test','2016-09-30',3023),(1,'test','2016-10-06',3024),(1,'test','2016-10-12',3025),(1,'test','2016-10-12',3025),(1,'test','2016-10-18',3026),(1,'test','2016-10-18',3026),(1,'test','2016-10-18',3026),(1,'dfadf','2017-08-08',3027),(1,'test','2017-11-24',3029),(1,'test','2017-11-24',3030),(1,'test','2017-11-24',3031),(1,'test','2017-11-24',3028),(1,'notes added','2017-12-05',3032);
/*!40000 ALTER TABLE `rmm_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rmmaster`
--

DROP TABLE IF EXISTS `rmmaster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rmmaster` (
  `recnum` int(11) DEFAULT NULL,
  `crnnum` varchar(45) DEFAULT NULL,
  `rmcode` varchar(50) DEFAULT NULL,
  `rm_type` varchar(255) DEFAULT NULL,
  `rm_spec` varchar(255) DEFAULT NULL,
  `rm_ruling_dim` varchar(255) DEFAULT NULL,
  `rm_dia` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `thickness` varchar(255) DEFAULT NULL,
  `partnum` varchar(60) DEFAULT NULL,
  `rm_condition` text,
  `rm_uom` varchar(50) DEFAULT NULL,
  `rm_grainflow` varchar(50) DEFAULT NULL,
  `rm_lt` varchar(50) DEFAULT NULL,
  `rm_st` varchar(50) DEFAULT NULL,
  `rm_qty_perbill` varchar(50) DEFAULT NULL,
  `rm_mrs` varchar(50) DEFAULT NULL,
  `rm_unitprize` varchar(50) DEFAULT NULL,
  `rm_supplier` varchar(50) DEFAULT NULL,
  `rm_altrm` varchar(50) DEFAULT NULL,
  `link2vendor` int(11) DEFAULT NULL,
  `rm_status` varchar(50) DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `modifieddate` date DEFAULT NULL,
  `rm_remarks` text,
  `enggapproved` varchar(45) DEFAULT NULL,
  `directorsapproved` varchar(45) DEFAULT NULL,
  `directorsapprovedby` varchar(45) DEFAULT NULL,
  `engapprovedby` varchar(45) DEFAULT NULL,
  `eng_app_date` date DEFAULT NULL,
  `director_app_date` date DEFAULT NULL,
  `currency` char(4) DEFAULT NULL,
  `rm_bars_plates` varchar(20) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  KEY `rmm_crnnum` (`crnnum`),
  KEY `rmm_status` (`rm_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rmmaster`
--

LOCK TABLES `rmmaster` WRITE;
/*!40000 ALTER TABLE `rmmaster` DISABLE KEYS */;
INSERT INTO `rmmaster` VALUES (3019,'prn1','','RMT 1','RMS 1','','','100','100','111','','','MM','','','','10','','1000','Aero','Alt Spec1',129,'Active','2016-08-23','2016-08-23','','yes','yes','bmandyam','bmandyam','2016-08-23','2016-08-23','$','Plates','FSI'),(3020,'prn2','','RMT 2','RMS 2','','','10','100','10','','','MM','','','12','10','','100','supp','Alt Spec2',132,'Active','2016-08-23','2016-08-23','','yes','yes','bmandyam','bmandyam','2016-08-23','2016-08-23','$','Plates',NULL),(3021,'prn3','','RMT 3','RMS 3','','','100','200','344','','TEST','MM','','','','100','','100','supp','Primary Spec',132,'Active','2016-09-30','2016-09-30','test','yes','yes','bmandyam','','2016-09-30','2016-09-30','$','Plates',NULL),(3022,'prn3','','RMT 3','RMS 3','','','100','345','20','','test','MM','','','','','','','supp','Alt Spec1',132,'Pending','2016-09-30',NULL,'','','','','','0000-00-00','0000-00-00','$','Plates',NULL),(3023,'prn6','','RMT 6','RMS 6','','44','566','450','44','','TEST','MM','','','','100','','','Aero','Alt Spec1',129,'Active','2016-09-30','2016-09-30','','yes','yes','bman','','2016-09-30','2016-09-30','$','Plates',NULL),(3024,'prn5','','rmt 5','rms 5','','32','100','342','23','','','MM','24','432','24','2432','','','Aero','Primary Spec',129,'Active','2016-10-06','2016-10-06','','yes','yes','bmandyam','','2016-10-06','2016-10-06','$','Plates',NULL),(3025,'prn7','','RMS 7','RMT 7','','','33','342','33','','','MM','','3','','300','','','Aero','Primary Spec',129,'Active','2016-10-12','2016-10-12','','yes','yes','bmandyam','','2016-10-12','2016-10-12','$','Plates',NULL),(3026,'prn8','','RMT 8','RMS 8','','','34','200','40','','','MM','','','','10','','100','Aero','Primary Spec',129,'Active','2016-10-18','2016-10-18','','yes','yes','bmandyam','','2016-10-18','2016-10-18','$','Plates',NULL),(3027,'RMK_001','','rmt','rms','','20','100','50','2','','sgasg','MM','2','1','2','100','we','12','Aero','Primary Spec',129,'Active','2017-08-08','2017-08-08','dgdgasg','yes','yes','bmandyam','','2017-08-08','2017-08-08','$','Plates','FSI'),(3028,'prn4','','test','test','','2','23','2','2','','test','MM','2','2','2','2','2','100','Aero','Primary Spec',129,'Active','2017-09-12','2017-11-24','ttewer fg','yes','yes','bmandyam','','2017-09-12','2017-09-12','$','Plates','FSI'),(3029,'prn3','','test','test','','2','2','','2','','','MM','','','','1','','100','Aero','Alt Spec2',129,'Active','2017-11-24','2017-11-24','','yes','yes','bmandyam','','2017-11-24','2017-11-24','$','Plates','FSI'),(3030,'prn8','','test','test','','','2','1','2','','','MM','','2','','2','','100','Aero','Alt Spec2',129,'Active','2017-11-24','2017-11-24','','yes','yes','bmandyam','','2017-11-24','2017-11-24','$','Plates','FSI'),(3031,'prn6','','test','test','','','1','150','1','','','MM','','1','','1','','100','Aero','Alt Spec2',129,'Active','2017-11-24','2017-11-24','','yes','yes','bmandyam','','2017-11-24','2017-11-24','$','Plates','FSI'),(3032,'flu-001','','rm type','rm spec','','','100','20','5','','nothing','MM','','','','100','','10','supp','Primary Spec',132,'Active','2017-12-05','2017-12-05','remarks','yes','yes','bmandyam','','2017-12-05','2017-12-05','$','Plates','FSI');
/*!40000 ALTER TABLE `rmmaster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_leads`
--

DROP TABLE IF EXISTS `sales_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_leads` (
  `recnum` int(11) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(5) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `product_interest` varchar(255) DEFAULT NULL,
  `primary_lead` varchar(4) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `industry_segment` varchar(255) DEFAULT NULL,
  `addr1` varchar(50) DEFAULT NULL,
  `addr2` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `convert2contact` int(11) DEFAULT NULL,
  `leadsnum` varchar(100) DEFAULT NULL,
  `oppnum` varchar(100) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `stage` varchar(55) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `stage_num` int(11) DEFAULT NULL,
  `contacted_date` date DEFAULT NULL,
  `meeting_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_leads`
--

LOCK TABLES `sales_leads` WRITE;
/*!40000 ALTER TABLE `sales_leads` DISABLE KEYS */;
INSERT INTO `sales_leads` VALUES (50,'www','ashwini','ashum','436546','ashu.pinky24@fluensoft.com','23','',NULL,'',NULL,'FSI','ds','','','bang','karnataka','','USA',0,'','',NULL,'Convert to Opportunity',10,90,'0000-00-00','0000-00-00'),(51,'www','ashwini','ashum','3434','asha@fluentsoft.com','0','',NULL,'',NULL,'FSI','ds','','','bang','karnataka','','59999',0,'','',NULL,'Convert to Opportunity',0,90,'0000-00-00','0000-00-00'),(52,'','ashwini','dfdsf','436546757','ashu.pinky24@fluentsoft.com','','',NULL,'',NULL,'FSI','fgf','','','','','','',0,'','','FSI','Convert to Opportunity',0,90,'0000-00-00','0000-00-00'),(53,'','dfdg','fg','565767','','','',NULL,'',NULL,'fgfh','54656','','','','','','',0,'','','FSI','Convert to Opportunity',0,90,'2017-07-18','0000-00-00'),(61,'Self Generated','ERP','asds','dfrd','ashu.pinky24@fluentsoft.com','ERP','Yes',NULL,'','2017-07-27','FSI','dfd','dfd','df','dfd','dfd','df','fdf',0,'','',NULL,'Convert to Opportunity',10,90,'0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `sales_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_opportunity`
--

DROP TABLE IF EXISTS `sales_opportunity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_opportunity` (
  `recnum` int(11) DEFAULT NULL,
  `opp_name` varchar(100) DEFAULT NULL,
  `acc_name` varchar(50) DEFAULT NULL,
  `expected_close_date` date DEFAULT NULL,
  `sales_stage` varchar(20) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `link2lead` int(11) DEFAULT NULL,
  `amount_currency` float DEFAULT NULL,
  `assigned_to` varchar(30) DEFAULT NULL,
  `probability` varchar(20) DEFAULT NULL,
  `next_step` varchar(20) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `lead_source` varchar(30) DEFAULT NULL,
  `link2salesnotes` varchar(50) DEFAULT NULL,
  `currency` varchar(250) DEFAULT NULL,
  `leadsnum` varchar(100) DEFAULT NULL,
  `oppnum` varchar(100) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `opp_stagenum` int(11) DEFAULT NULL,
  `proposal_date` date DEFAULT NULL,
  `negotiate_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_opportunity`
--

LOCK TABLES `sales_opportunity` WRITE;
/*!40000 ALTER TABLE `sales_opportunity` DISABLE KEYS */;
INSERT INTO `sales_opportunity` VALUES (3,'aero','hdbj','2016-05-24','','',0,300,'','21','','2016-05-24','','dsg','$','34','23','FSI',NULL,NULL,NULL),(4,'ddd','sss','2016-08-08','Prospecting','Existing Business',0,100,'','10','','2016-08-02','','','$','123','124',NULL,NULL,NULL,NULL),(5,'ssss','hjdgjh','2016-08-25','Prospecting','Existing Business',0,1000,'','1232','','2016-08-23','','','$','1321','121',NULL,NULL,NULL,NULL),(6,'test123','fgfh','2017-07-20','Proposal/Quote','Existing Business',53,100,'test','200','test','2017-07-21','','test testui iucjcbd','$','dfdg','',NULL,140,'2017-07-21','0000-00-00'),(7,'Opp1','FSI','2017-07-27','','Existing Business',52,100,'','100','','2017-07-27','Cold Call','','$','ashwini','',NULL,0,'0000-00-00','0000-00-00'),(8,'Opp2','FSI','2017-07-27','','Existing Business',51,100,'','100','','2017-07-27','Cold Call','','$','ashwini','',NULL,0,'0000-00-00','0000-00-00'),(9,'Opp3','FSI','2017-07-27','Needs Analysis','Existing Business',61,100,'','100','','2017-07-27','Self Generated','','$','ERP','',NULL,110,'0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `sales_opportunity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_order`
--

DROP TABLE IF EXISTS `sales_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_order` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `so2customer` int(11) DEFAULT NULL,
  `so2contact` int(11) DEFAULT NULL,
  `so2employee` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `sales_order` varchar(20) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `special_instruction` longtext,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` varchar(30) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `quote_num` varchar(30) DEFAULT NULL,
  `po_num` varchar(255) DEFAULT NULL,
  `grosstotal` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `shipping` float DEFAULT NULL,
  `labor` float DEFAULT NULL,
  `total_due` float DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `resellnum` varchar(50) DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `attach1` varchar(100) DEFAULT NULL,
  `attach2` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `link2review` int(11) DEFAULT NULL,
  `rmtotal` float DEFAULT NULL,
  `mctotal` float DEFAULT NULL,
  `amendment_num` varchar(50) DEFAULT NULL,
  `formatnum` varchar(255) DEFAULT NULL,
  `formatrev` varchar(255) DEFAULT NULL,
  `amendment_date` date DEFAULT NULL,
  `amendments` text,
  `refno` varchar(30) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `ordernum` varchar(30) DEFAULT NULL,
  `ordertype` varchar(255) DEFAULT NULL,
  `numofparts` varchar(255) DEFAULT NULL,
  `attachment1` varchar(255) DEFAULT NULL,
  `quoterefnum` varchar(50) DEFAULT NULL,
  `rawmaterial` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `resources` varchar(255) DEFAULT NULL,
  `qualityreq` varchar(255) DEFAULT NULL,
  `saliant` varchar(255) DEFAULT NULL,
  `aditional_resources` varchar(255) DEFAULT NULL,
  `investment` varchar(255) DEFAULT NULL,
  `subcontract` varchar(255) DEFAULT NULL,
  `special_process` varchar(255) DEFAULT NULL,
  `delivery_req` varchar(255) DEFAULT NULL,
  `person` varchar(50) DEFAULT NULL,
  `enq_answeredby` varchar(50) DEFAULT NULL,
  `quotation` varchar(100) DEFAULT NULL,
  `data_for_quote` varchar(255) DEFAULT NULL,
  `data_store` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `quotation_det_store` varchar(255) DEFAULT NULL,
  `risk_factors` varchar(255) DEFAULT NULL,
  `requirements` varchar(255) DEFAULT NULL,
  `quote_sentby` varchar(255) DEFAULT NULL,
  `explain_risk_factors` varchar(255) DEFAULT NULL,
  `quote_path` varchar(255) DEFAULT NULL,
  `enquiry_path` varchar(255) DEFAULT NULL,
  `data_for_enquiry` varchar(255) DEFAULT NULL,
  `orderfor` varchar(255) DEFAULT NULL,
  `formrev` varchar(50) DEFAULT NULL,
  `special_instrns` longtext,
  `val_status` varchar(50) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `qa_approved` varchar(45) DEFAULT NULL,
  `engineering_approved` varchar(45) DEFAULT NULL,
  `qa_app_by` varchar(100) DEFAULT NULL,
  `engg_app_by` varchar(100) DEFAULT NULL,
  `prodn_approved` varchar(45) DEFAULT NULL,
  `prodn_app_by` varchar(100) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recnum`),
  KEY `wpo` (`po_num`),
  KEY `ind_so2cust` (`so2customer`),
  KEY `ind_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=1408 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_order`
--

LOCK TABLES `sales_order` WRITE;
/*!40000 ALTER TABLE `sales_order` DISABLE KEYS */;
INSERT INTO `sales_order` VALUES (1400,134,0,0,'test','','2017-11-23','0000-00-00','test','232434','asha@fluentsoft.com','','','','','','4454','CUSTPO-002',20,0,0,0,20,'Open','$','','0000-00-00','','','asha a',0,1000,0,'test','F3003','Rev 1 dt Jul 10,2009','2017-11-30',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','F3003-Rev No.:1','','NO','0000-00-00','','','yes','','bmandyam','','','FSI'),(1401,127,0,0,'test','','2017-11-23','0000-00-00','test','232434','asha@fluentsoft.com','','','','','','34345','CUSTPO-003',1000,0,0,0,1000,'Open','$','','0000-00-00','','','asha a',0,5000,2000,'test','F3003','Rev 1 dt Jul 10,2009','2017-11-22',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','F3003-Rev No.:1','','NO','0000-00-00','','','yes','','bmandyam','','','FSI'),(1402,127,0,0,'test','','2017-11-23','0000-00-00','test','232434','asha@fluentsoft.com','','','','','','3434','CUSTPO-001',200,0,0,0,200,'Open','$','','0000-00-00','','','asha a',0,10000,0,'test','F3003','Rev 1 dt Jul 10,2009','2017-11-24',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','F3003-Rev No.:1','','NO','0000-00-00','','','yes','','bmandyam','','','FSI'),(1403,127,0,0,'test','','2017-11-23','0000-00-00','test','3435','asha@fluentsoft.com','','','','','','3434','CUSTPO-004',200,0,0,0,200,'Open','$','','0000-00-00','','','asha a',0,1000,0,'test','F3003','Rev 1 dt Jul 10,2009','2017-11-29',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','F3003-Rev No.:1','','NO','0000-00-00','','','yes','','bmandyam','','','FSI'),(1404,127,0,0,'test','','2017-11-24','0000-00-00','test','232434','asha@fluentsoft.com','','','','','','657','CUSTPO-005',300,0,0,0,300,'Open','$','','0000-00-00','','','asha a',0,5000,0,'test','F3003','Rev 1 dt Jul 10,2009','2017-11-24',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','F3003-Rev No.:1','','NO','0000-00-00','','','yes','','bmandyam','','','FSI'),(1405,127,0,0,'test','','2017-11-30','0000-00-00','test','232434','asha@fluentsoft.com','','','','','','12','CUSTPO-006',20,0,0,0,20,'Open','$','','0000-00-00','','','asha a',0,500,0,'test','F3003','Rev 1 dt Jul 10,2009','2017-11-24',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','F3003-Rev No.:1','','NO','0000-00-00','','','yes','','bmandyam','','','FSI'),(1406,172,0,0,'','','2017-12-04','0000-00-00','dghsdhsd','404040','rmk@gmail.com','','','','','','0001','KAR-001',1000,0,0,0,1000,'Open','$','','0000-00-00','','','karthick',0,10,0,'1','F3003','Rev 1 dt Jul 10,2009','2017-12-04',NULL,NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','F3003-Rev No.:1','','NO','2017-12-04','','','yes','','bmandyam','','','FSI'),(1407,134,0,2,'test','SO-011','2017-12-19','2017-12-20','','','','','','','','','35','1020',1000,1,1,1,1003,'Open','$','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'FSI');
/*!40000 ALTER TABLE `sales_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seqnum`
--

DROP TABLE IF EXISTS `seqnum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seqnum` (
  `nxtnum` int(11) DEFAULT NULL,
  `tablename` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seqnum`
--

LOCK TABLES `seqnum` WRITE;
/*!40000 ALTER TABLE `seqnum` DISABLE KEYS */;
INSERT INTO `seqnum` VALUES (8,'shipment'),(0,'activeusers_log'),(0,'address'),(0,'app_license'),(0,'bookmark'),(172,'company'),(30,'contact'),(286015,'dates'),(0,'eco'),(251,'employee'),(7,'inventory'),(0,'log'),(1,'mfg_order'),(0,'mtm_po_wo'),(50,'notes'),(0,'part_master'),(0,'part_used'),(1032,'po'),(10101,'po_line_items'),(36,'quote'),(38,'quote_li'),(0,'rfq'),(0,'rma'),(0,'rma_items'),(0,'seqnum'),(0,'serv_req'),(0,'solution'),(0,'srtype'),(0,'support'),(0,'support_notes'),(0,'tran_license'),(97,'user'),(4,'vend_part_master'),(113,'work_flow_config'),(31544,'work_order'),(6,'m_pagename'),(12,'m_pagefields'),(160,'generic_wo'),(0,'generic_quote'),(61,'sales_leads'),(9,'sales_opportunity'),(1406,'sales_order'),(7033,'so_line_items'),(0,'account'),(17,'leads_notes'),(0,'opportunity_notes'),(0,'mtm_leads_opportunity'),(1,'mfg_order'),(8,'shipment'),(2,'invoice'),(1,'invoice_line_items'),(0,'invoice_payment'),(1,'email'),(5,'tasklist'),(0,'tasklist_time'),(0,'wo_attachment'),(0,'task_notes'),(33,'milestone_notes'),(9,'dwf_stage_field'),(2,'master'),(9,'master_line_items'),(2,'datasheet'),(2,'datasheet_line_items'),(3,'quality_plan'),(4,'quality_plan_line_items'),(3,'cust_data_validation'),(6,'cust_data_lineitems'),(40,'mm'),(3,'contract_enquiry'),(3226,'contract_review'),(3,'proc_deviation'),(3,'proc_deviation_li'),(4,'feedback'),(4,'test_report'),(7,'chemical_composition_li'),(5,'mechanical_properties_li'),(37,'fid'),(56,'irm'),(1005,'stage_insp'),(15,'stage_insp_report'),(12,'stage_insp_lineitems'),(10,'final_insp_report'),(9,'final_insp_lineitems'),(7060,'master_data'),(18,'dd'),(6383,'nc4qa'),(6,'standard'),(7,'allot_crn'),(15322,'grn'),(5,'mdm'),(3,'ncforstores'),(0,'production_sch'),(7,'maintain_machine'),(6,'process_details'),(4,'partwise_req'),(5,'production_plan'),(579,'mtl_tracker_li'),(1350,'mtl_act_log'),(2,'part_bom'),(3,'capacity_plan'),(18242,'grn_li'),(3032,'rmmaster'),(31478,'wonum'),(27354,'dispatch'),(39766,'dispatch_line_items'),(15,'accp_rating'),(454,'purchasing_alloc'),(5,'advlic'),(52,'advlic_li'),(2318,'mps'),(223,'assypo'),(2061,'assypo_line_items'),(11878,'delivery_note'),(13089,'delivery_note_li'),(302,'bom'),(429,'bom_mfg_items'),(409,'bom_bought_items'),(294,'bom_consume'),(36,'assy_review'),(1084,'assy_review_li'),(2619,'assywo'),(91,'bom_op_desc'),(1003,'spmaster'),(79,'bom_subassy_items'),(48422,'consumption'),(48,'task'),(23,'news'),(20,'bom_treated_items'),(5,'arform'),(2,'Price'),(2,'invoice'),(1,'invoice_line_items'),(6,'shipping'),(3,'shipping_line_items'),(5,'arform'),(9,'arform_line_items'),(108,'grn_issue'),(2,'site'),(3,'payroll_master'),(7,'payroll_monthly'),(2,'tasks'),(4851,'assywo_flow'),(4,'enquiry'),(6,'cust_feedback');
/*!40000 ALTER TABLE `seqnum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serv_req`
--

DROP TABLE IF EXISTS `serv_req`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serv_req` (
  `recnum` int(11) DEFAULT NULL,
  `srnum` varchar(100) DEFAULT NULL,
  `drawing_rev` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `reportedby` varchar(100) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `priority` varchar(100) DEFAULT NULL,
  `error_desc` longtext,
  `docdate` date DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `duedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serv_req`
--

LOCK TABLES `serv_req` WRITE;
/*!40000 ALTER TABLE `serv_req` DISABLE KEYS */;
/*!40000 ALTER TABLE `serv_req` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment`
--

DROP TABLE IF EXISTS `shipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipment` (
  `recnum` int(11) DEFAULT NULL,
  `seqnum` varchar(50) DEFAULT NULL,
  `ship_desc` varchar(255) DEFAULT NULL,
  `carrier` varchar(255) DEFAULT NULL,
  `tracking_num` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `final` char(1) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment`
--

LOCK TABLES `shipment` WRITE;
/*!40000 ALTER TABLE `shipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping` (
  `recnum` int(10) unsigned DEFAULT NULL,
  `link2invoice` int(10) unsigned DEFAULT NULL,
  `sbnum` varchar(45) DEFAULT NULL,
  `sbdate` date DEFAULT NULL,
  `impexpcode` varchar(45) DEFAULT NULL,
  `rbicode` varchar(45) DEFAULT NULL,
  `qcertnum` varchar(45) DEFAULT NULL,
  `qcertdate` date DEFAULT NULL,
  `rotatingnum` varchar(45) DEFAULT NULL,
  `dischargeport` varchar(100) DEFAULT NULL,
  `countrydestination` varchar(100) DEFAULT NULL,
  `cf` varchar(5) DEFAULT NULL,
  `cfr` varchar(5) DEFAULT NULL,
  `fob` varchar(5) DEFAULT NULL,
  `contractother` varchar(45) DEFAULT NULL,
  `exchangerate` float DEFAULT NULL,
  `netweight` varchar(45) DEFAULT NULL,
  `grossweight` varchar(45) DEFAULT NULL,
  `fobwords` varchar(255) DEFAULT NULL,
  `fob_value` varchar(45) DEFAULT NULL,
  `fob_currency` varchar(45) DEFAULT NULL,
  `fob_inr` varchar(45) DEFAULT NULL,
  `freight_value` varchar(45) DEFAULT NULL,
  `freight_currency` varchar(45) DEFAULT NULL,
  `freight_inr` varchar(45) DEFAULT NULL,
  `insurance_value` varchar(45) DEFAULT NULL,
  `insurance_currency` varchar(45) DEFAULT NULL,
  `insurance_inr` varchar(45) DEFAULT NULL,
  `commission_value` varchar(45) DEFAULT NULL,
  `commission_currency` varchar(45) DEFAULT NULL,
  `commission_inr` varchar(45) DEFAULT NULL,
  `discount_value` varchar(45) DEFAULT NULL,
  `discount_currency` varchar(45) DEFAULT NULL,
  `discount_inr` varchar(45) DEFAULT NULL,
  `other_value` varchar(45) DEFAULT NULL,
  `other_currency` varchar(45) DEFAULT NULL,
  `other_inr` varchar(45) DEFAULT NULL,
  `deduction_value` varchar(45) DEFAULT NULL,
  `deduction_currency` varchar(45) DEFAULT NULL,
  `deduction_inr` varchar(45) DEFAULT NULL,
  `custom_agent` varchar(45) DEFAULT NULL,
  `shipping_id` varchar(45) DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `licnum` varchar(45) DEFAULT NULL,
  `formrev` varchar(255) DEFAULT NULL,
  `deffcredit` varchar(45) DEFAULT NULL,
  `jointventure` varchar(5) DEFAULT NULL,
  `rupcredit` varchar(5) DEFAULT NULL,
  `otherex` varchar(5) DEFAULT NULL,
  `rbiappcode` varchar(45) DEFAULT NULL,
  `rbiappdate` date DEFAULT NULL,
  `outrightsale` varchar(5) DEFAULT NULL,
  `consignmentexp` varchar(5) DEFAULT NULL,
  `othersh` varchar(5) DEFAULT NULL,
  `ar4anum` varchar(45) DEFAULT NULL,
  `ar4adate` date DEFAULT NULL,
  `total_qty` float DEFAULT NULL,
  `vfobtotal` float DEFAULT NULL,
  `siteid` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping`
--

LOCK TABLES `shipping` WRITE;
/*!40000 ALTER TABLE `shipping` DISABLE KEYS */;
INSERT INTO `shipping` VALUES (1,1,'S-5659/16-17','2016-11-16','0797004271','','','0000-00-00','',NULL,NULL,'no','no','no','',100,'','','','100','$','10000','','','','','','','','','','','','','','','','','','','JEENA&Co AAAFJ1721HCH054','S-5659/16-17','2016-11-02','','F7000 Rev 00 dt August 04, 2011','','no','no','no','','0000-00-00','no','no','no','','2016-11-16',1,100,NULL),(6,2,'S-5654/16-17','2016-11-17','0797004271','','','0000-00-00','',NULL,NULL,'no','no','no','',200,'','','','0','$','0','','','','','','','','','','','','','','','','','','','JEENA&Co AAAFJ1721HCH054','S-5654/16-17','2016-11-02','','F7000 Rev 00 dt August 04, 2011','','no','no','no','','0000-00-00','no','no','no','','2016-11-24',1,0,NULL);
/*!40000 ALTER TABLE `shipping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_line_items`
--

DROP TABLE IF EXISTS `shipping_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_line_items` (
  `recnum` int(10) unsigned DEFAULT NULL,
  `line_num` int(10) unsigned DEFAULT NULL,
  `marknum` varchar(255) DEFAULT NULL,
  `statcode` varchar(255) DEFAULT NULL,
  `qty` int(10) unsigned DEFAULT NULL,
  `value_fob` float DEFAULT NULL,
  `link2shipping` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_line_items`
--

LOCK TABLES `shipping_line_items` WRITE;
/*!40000 ALTER TABLE `shipping_line_items` DISABLE KEYS */;
INSERT INTO `shipping_line_items` VALUES (2,1,'  ',' 3543 dfdf ',1,0,5),(3,1,'  ',' 3543 dfdf ',1,0,6);
/*!40000 ALTER TABLE `shipping_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `recnum` int(11) DEFAULT NULL,
  `siteid` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `tsymbol` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `employees` varchar(100) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `ownership` varchar(100) DEFAULT NULL,
  `annual_revenue` int(11) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `stccode` varchar(100) DEFAULT NULL,
  `addr1` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `site2parent_site` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `guid` varchar(20) DEFAULT NULL,
  `alt_recnum` int(11) DEFAULT NULL,
  `remarks` text,
  `terms` varchar(255) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `how_created` varchar(50) DEFAULT NULL,
  `id` varchar(45) DEFAULT NULL,
  KEY `ind_recnum` (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` VALUES (14,'flu_1779','FSI','EMPL','8050200958','','','','ashwinic@fluentsoft.com','','','',0,'','','','','','','',NULL,'Active','2017-05-02',NULL,NULL,NULL,NULL,NULL,NULL,'Online Registration','A14'),(15,'gma_1721','Aero','EMPL','20333333','','','','raj@gmail.com','','','',0,'','','','','','','',NULL,'Active','2017-05-02',NULL,NULL,NULL,NULL,NULL,NULL,'Online Registration','A15'),(1,'FSI','FSI','EMPL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'_5743','FSI','EMPL','8050200804','','','','ammu','','','',0,'','','','','','','',NULL,'Active','2017-05-05',NULL,NULL,NULL,NULL,NULL,NULL,'Online Registration','A2');
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `so_line_items`
--

DROP TABLE IF EXISTS `so_line_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `so_line_items` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `line_num` varchar(20) DEFAULT NULL,
  `item_desc` varchar(255) DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `rmtype` varchar(255) DEFAULT NULL,
  `rmspec` varchar(255) DEFAULT NULL,
  `partiss` varchar(255) DEFAULT NULL,
  `drgiss` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `link2so` int(11) DEFAULT NULL,
  `rmprice` float DEFAULT NULL,
  `rmamount` float DEFAULT NULL,
  `mcprice` float DEFAULT NULL,
  `mcamount` float DEFAULT NULL,
  `hcdrgiss` varchar(255) DEFAULT NULL,
  `hcpartiss` varchar(255) DEFAULT NULL,
  `po_cos` varchar(255) DEFAULT NULL,
  `hc_cos` varchar(255) DEFAULT NULL,
  `model_iss` varchar(255) DEFAULT NULL,
  `amendment_num` varchar(255) DEFAULT NULL,
  `amendment_date` date DEFAULT NULL,
  `uom` varchar(10) DEFAULT NULL,
  `dia` varchar(50) DEFAULT NULL,
  `length` varchar(50) DEFAULT NULL,
  `width` varchar(50) DEFAULT NULL,
  `thickness` varchar(50) DEFAULT NULL,
  `grainflow` varchar(50) DEFAULT NULL,
  `maxruling` varchar(50) DEFAULT NULL,
  `altspec` varchar(50) DEFAULT NULL,
  `cos_iss` varchar(50) DEFAULT NULL,
  `crn_num` varchar(45) DEFAULT NULL,
  `condition` text,
  `po_num` varchar(50) DEFAULT NULL,
  `dim1` varchar(255) DEFAULT NULL,
  `dim2` varchar(255) DEFAULT NULL,
  `dim3` varchar(255) DEFAULT NULL,
  `siteid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`recnum`),
  KEY `ind_soli_partnum` (`partnum`),
  KEY `ind_link2so` (`link2so`)
) ENGINE=InnoDB AUTO_INCREMENT=7035 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `so_line_items`
--

LOCK TABLES `so_line_items` WRITE;
/*!40000 ALTER TABLE `so_line_items` DISABLE KEYS */;
INSERT INTO `so_line_items` VALUES (7027,'1','dsds','3434','test','test','C','C',10,2,20,1400,100,1000,0,0,NULL,NULL,'',NULL,'',NULL,NULL,'MM','2','2','','2','','','Alt Spec2','','prn3','','CUSTPO-002',NULL,NULL,NULL,NULL),(7028,'1','24354','2343','test','test','dd','dd',100,10,1000,1401,50,5000,20,2000,NULL,NULL,'',NULL,'',NULL,NULL,'MM','','2','1','2','','','Alt Spec2','dd','prn8','','CUSTPO-003',NULL,NULL,NULL,NULL),(7029,'1','sss','121','RMT 1','RMS 1','A','A',100,2,200,1402,100,10000,0,0,NULL,NULL,'',NULL,'',NULL,NULL,'MM','','100','100','111','','','Alt Spec1','A','prn1','','CUSTPO-001',NULL,NULL,NULL,NULL),(7030,'1','sssss','54543','test','test','g','g',10,20,200,1403,100,1000,0,0,NULL,NULL,'',NULL,'',NULL,NULL,'MM','','1','150','1','','','Alt Spec2','g','prn6','','CUSTPO-004',NULL,NULL,NULL,NULL),(7031,'2','rdgfd','435','test','test','s','s',100,3,300,1404,50,5000,0,0,NULL,NULL,'',NULL,'',NULL,NULL,'MM','2','23','2','2','2','2','Primary Spec','s','prn4','test','CUSTPO-005',NULL,NULL,NULL,NULL),(7032,'1','rdgfd','435','test','test','s','s',10,2,20,1405,50,500,0,0,NULL,NULL,'',NULL,'',NULL,NULL,'MM','2','23','2','2','2','2','Primary Spec','s','prn4','test','CUSTPO-006',NULL,NULL,NULL,NULL),(7033,'1','fluent part','flu 00 100','rm type','rm spec','A','A',100,10,1000,1406,0.1,10,0,0,NULL,NULL,'',NULL,'',NULL,NULL,'MM','','100','20','5','','','Primary Spec','A','flu-001','nothing','KAR-001',NULL,NULL,NULL,NULL),(7034,'1','','3243','','','','',100,10,1000,1407,0,0,0,0,NULL,NULL,'',NULL,'',NULL,NULL,'','','','','','','','','','prn10','','1020','','','',NULL);
/*!40000 ALTER TABLE `so_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `so_notes`
--

DROP TABLE IF EXISTS `so_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `so_notes` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `stamp_created` datetime DEFAULT NULL,
  `stamp_updated` datetime DEFAULT NULL,
  `notes` longtext,
  `notes2so` int(11) DEFAULT NULL,
  `notes2user` varchar(50) DEFAULT NULL,
  `dept` char(20) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=5560 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `so_notes`
--

LOCK TABLES `so_notes` WRITE;
/*!40000 ALTER TABLE `so_notes` DISABLE KEYS */;
INSERT INTO `so_notes` VALUES (5526,'2017-02-17 15:19:15','2017-02-17 15:19:15','test',1398,'bmandyam','NULL'),(5527,'2017-02-17 15:22:24','2017-02-17 15:22:24','test',1398,'bmandyam','NULL'),(5528,'2017-02-17 15:25:25','2017-02-17 15:25:25','test',1398,'bmandyam','NULL'),(5529,'2017-02-17 15:26:48','2017-02-17 15:26:48','test',1398,'bmandyam','NULL'),(5530,'2017-02-17 15:29:44','2017-02-17 15:29:44','test',1398,'bmandyam','NULL'),(5531,'2017-02-17 15:30:37','2017-02-17 15:30:37','test',1398,'bmandyam','NULL'),(5532,'2017-02-17 15:30:54','2017-02-17 15:30:54','test',1398,'bmandyam','NULL'),(5533,'2017-11-24 11:20:13','2017-11-24 11:20:13','test',1399,'bmandyam','NULL'),(5534,'2017-11-24 11:20:41','2017-11-24 11:20:41','test',1399,'bmandyam','NULL'),(5535,'2017-11-24 11:22:06','2017-11-24 11:22:06','test',1399,'bmandyam','NULL'),(5536,'2017-11-24 11:22:15','2017-11-24 11:22:15','test',1399,'bmandyam','NULL'),(5537,'2017-11-24 11:29:27','2017-11-24 11:29:27','test',1400,'bmandyam','NULL'),(5538,'2017-11-24 11:32:11','2017-11-24 11:32:11','test',1401,'bmandyam','NULL'),(5539,'2017-11-24 11:33:15','2017-11-24 11:33:15','test',1400,'bmandyam','NULL'),(5540,'2017-11-24 11:41:47','2017-11-24 11:41:47','test',1402,'bmandyam','NULL'),(5541,'2017-11-24 12:25:59','2017-11-24 12:25:59','test',1403,'bmandyam','NULL'),(5542,'2017-11-24 14:11:05','2017-11-24 14:11:05','test',1404,'bmandyam','NULL'),(5543,'2017-11-24 14:12:53','2017-11-24 14:12:53','test',1404,'bmandyam','NULL'),(5544,'2017-11-24 15:19:26','2017-11-24 15:19:26','test',1401,'bmandyam','NULL'),(5545,'2017-11-24 15:25:12','2017-11-24 15:25:12','test',1401,'bmandyam','NULL'),(5546,'2017-11-24 15:48:57','2017-11-24 15:48:57','test',1401,'bmandyam','NULL'),(5547,'2017-11-24 15:53:37','2017-11-24 15:53:37','test',1401,'bmandyam','NULL'),(5548,'2017-11-24 15:54:15','2017-11-24 15:54:15','test',1401,'bmandyam','NULL'),(5549,'2017-11-24 15:54:19','2017-11-24 15:54:19','test',1401,'bmandyam','NULL'),(5550,'2017-11-24 15:54:30','2017-11-24 15:54:30','test',1401,'bmandyam','NULL'),(5551,'2017-11-24 16:05:00','2017-11-24 16:05:00','test',1405,'bmandyam','NULL'),(5552,'2017-11-24 16:07:11','2017-11-24 16:07:11','test',1405,'bmandyam','NULL'),(5553,'2017-11-24 16:08:51','2017-11-24 16:08:51','test',1405,'bmandyam','NULL'),(5554,'2017-11-24 16:13:42','2017-11-24 16:13:42','test',1405,'bmandyam','NULL'),(5555,'2017-11-24 16:14:14','2017-11-24 16:14:14','test',1404,'bmandyam','NULL'),(5556,'2017-11-24 16:55:16','2017-11-24 16:55:16','test',1402,'bmandyam','NULL'),(5557,'2017-11-24 16:55:58','2017-11-24 16:55:58','test',1403,'bmandyam','NULL'),(5558,'2017-11-24 16:56:40','2017-11-24 16:56:40','test',1404,'bmandyam','NULL'),(5559,'2017-12-05 11:54:49','2017-12-05 11:54:49','Approved',1406,'bmandyam','NULL');
/*!40000 ALTER TABLE `so_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solution`
--

DROP TABLE IF EXISTS `solution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solution` (
  `recnum` int(11) DEFAULT NULL,
  `solnum` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `prob_desc` longtext,
  `sol_desc` longtext,
  `type` varchar(50) DEFAULT NULL,
  `sol_upload_file` varchar(200) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solution`
--

LOCK TABLES `solution` WRITE;
/*!40000 ALTER TABLE `solution` DISABLE KEYS */;
/*!40000 ALTER TABLE `solution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spmaster`
--

DROP TABLE IF EXISTS `spmaster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spmaster` (
  `recnum` int(11) DEFAULT NULL,
  `crnnum` char(30) DEFAULT NULL,
  `partnum` varchar(255) DEFAULT NULL,
  `aukpartnum` varchar(255) DEFAULT NULL,
  `saabpartnum` varchar(255) DEFAULT NULL,
  `currency` char(10) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `price_valid_from` date DEFAULT NULL,
  `price_valid_upto` date DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qty_valid_from` date DEFAULT NULL,
  `qty_valid_upto` date DEFAULT NULL,
  `totalcost` float DEFAULT NULL,
  `totalcost_valid_from` date DEFAULT NULL,
  `totalcost_valid_upto` date DEFAULT NULL,
  `qty_ss` int(11) DEFAULT NULL,
  `link2vendor` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `status` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spmaster`
--

LOCK TABLES `spmaster` WRITE;
/*!40000 ALTER TABLE `spmaster` DISABLE KEYS */;
INSERT INTO `spmaster` VALUES (999,'prn2','1212','21','21','$',100,'2016-05-23','2016-05-26',21,'2016-05-31','2016-05-30',200,'2016-05-30','2016-05-18',NULL,2,'2016-05-11','Active'),(1000,'prn5','1123','123','123','$',100,'2016-05-25','2016-05-10',12,'2016-05-29','2016-05-26',200,'2016-05-24','2016-05-17',NULL,2,'2016-05-11','Active'),(1001,'prn6','2','2','142','$',100,'2016-05-17','2016-05-25',8,'2016-05-25','2016-05-30',200,'2016-05-31','2016-05-30',NULL,2,'2016-05-11','Active'),(1002,'prn3','323','3213','sfd','$',100,'2016-05-23','2016-05-09',10,'2016-05-23','2016-05-18',100,'2016-05-09','2016-05-19',NULL,2,'2016-05-17','Active'),(1003,'prn1','12','35','121','$',100,'2016-06-08','2017-06-09',10,'2016-06-01','2017-06-08',1000,'2016-06-15','2017-06-17',NULL,2,'2016-06-29','Active');
/*!40000 ALTER TABLE `spmaster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `srtype`
--

DROP TABLE IF EXISTS `srtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `srtype` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `srtype`
--

LOCK TABLES `srtype` WRITE;
/*!40000 ALTER TABLE `srtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `srtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_insp`
--

DROP TABLE IF EXISTS `stage_insp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stage_insp` (
  `recnum` int(11) DEFAULT NULL,
  `seqnum` int(11) DEFAULT NULL,
  `qc_sign` varchar(5) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `fqc_sign` varchar(15) DEFAULT NULL,
  `fremarks` varchar(50) DEFAULT NULL,
  `prodn_sign` varchar(15) DEFAULT NULL,
  `premarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_insp`
--

LOCK TABLES `stage_insp` WRITE;
/*!40000 ALTER TABLE `stage_insp` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_insp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_insp_lineitems`
--

DROP TABLE IF EXISTS `stage_insp_lineitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stage_insp_lineitems` (
  `recnum` int(11) DEFAULT NULL,
  `linenum` int(11) DEFAULT NULL,
  `normal_dim` varchar(30) DEFAULT NULL,
  `slno1` int(11) DEFAULT NULL,
  `slno2` int(11) DEFAULT NULL,
  `slno3` int(11) DEFAULT NULL,
  `slno4` int(11) DEFAULT NULL,
  `measured_dim1` varchar(30) DEFAULT NULL,
  `measured_dim2` varchar(30) DEFAULT NULL,
  `measured_dim3` varchar(30) DEFAULT NULL,
  `measured_dim4` varchar(30) DEFAULT NULL,
  `verified_by` varchar(30) DEFAULT NULL,
  `insp_by1` varchar(30) DEFAULT NULL,
  `insp_by2` varchar(30) DEFAULT NULL,
  `insp_by3` varchar(30) DEFAULT NULL,
  `insp_by4` varchar(30) DEFAULT NULL,
  `shift1` varchar(20) DEFAULT NULL,
  `shift2` varchar(20) DEFAULT NULL,
  `shift3` varchar(20) DEFAULT NULL,
  `shift4` varchar(20) DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `date3` date DEFAULT NULL,
  `date4` date DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `tr_no` varchar(30) DEFAULT NULL,
  `rev_no` int(11) DEFAULT NULL,
  `revdate` date DEFAULT NULL,
  `link2stage_insp` int(11) DEFAULT NULL,
  `measured_dim5` varchar(30) DEFAULT NULL,
  `insp_by5` varchar(30) DEFAULT NULL,
  `shift5` varchar(20) DEFAULT NULL,
  `date5` date DEFAULT NULL,
  `slno5` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_insp_lineitems`
--

LOCK TABLES `stage_insp_lineitems` WRITE;
/*!40000 ALTER TABLE `stage_insp_lineitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_insp_lineitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_insp_report`
--

DROP TABLE IF EXISTS `stage_insp_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stage_insp_report` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` varchar(30) DEFAULT NULL,
  `opnnum` varchar(20) DEFAULT NULL,
  `partnum` varchar(30) DEFAULT NULL,
  `batch_qty` varchar(20) DEFAULT NULL,
  `partname` varchar(30) DEFAULT NULL,
  `sheet` varchar(10) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `tr_no` varchar(30) DEFAULT NULL,
  `rev_no` int(11) DEFAULT NULL,
  `revdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_insp_report`
--

LOCK TABLES `stage_insp_report` WRITE;
/*!40000 ALTER TABLE `stage_insp_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_insp_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `standard`
--

DROP TABLE IF EXISTS `standard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `standard` (
  `recnum` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `standard`
--

LOCK TABLES `standard` WRITE;
/*!40000 ALTER TABLE `standard` DISABLE KEYS */;
/*!40000 ALTER TABLE `standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_enquiry`
--

DROP TABLE IF EXISTS `supplier_enquiry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_enquiry` (
  `recnum` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `link2cust` int(11) DEFAULT NULL,
  `partdesc` varchar(100) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `enq_date` date DEFAULT NULL,
  `rtquot_date` date DEFAULT NULL,
  `rtquot_no` varchar(100) DEFAULT NULL,
  `risk_involv` varchar(255) DEFAULT NULL,
  `risk_details` text,
  `status` varchar(100) DEFAULT NULL,
  `remarks` text,
  `siteid` varchar(45) DEFAULT NULL,
  `formrev` varchar(100) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `approved_by` varchar(100) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `id` varchar(100) DEFAULT NULL,
  `approved` varchar(100) DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  KEY `recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_enquiry`
--

LOCK TABLES `supplier_enquiry` WRITE;
/*!40000 ALTER TABLE `supplier_enquiry` DISABLE KEYS */;
INSERT INTO `supplier_enquiry` VALUES (1,129,'test','1234',20,'0000-00-00','2017-12-28','123','fd','ghfgdhfh','Active','fgdghsdhdsgh','FSI','MKT/F/01 Iss No:01.Rev:00 dt:','bmandyam','2017-12-28','bmandyam','2017-12-28','RMK','yes','bmandyam','2017-12-28');
/*!40000 ALTER TABLE `supplier_enquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_quote`
--

DROP TABLE IF EXISTS `supplier_quote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_quote` (
  `recnum` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(100) DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `descr` varchar(100) DEFAULT NULL,
  `excelfile` varchar(255) DEFAULT NULL,
  `rfqid` varchar(30) DEFAULT NULL,
  `owner_userid` varchar(25) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `last_modified` date DEFAULT NULL,
  `delivarydate` date DEFAULT NULL,
  `terms` varchar(150) DEFAULT NULL,
  `quote2type` int(11) DEFAULT NULL,
  `quotetype` varchar(100) DEFAULT NULL,
  `comments` varchar(100) DEFAULT NULL,
  `quote2company` int(11) DEFAULT NULL,
  `convert2sales` varchar(50) DEFAULT NULL,
  `quote2employee` varchar(50) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `mail2customer` varchar(255) DEFAULT NULL,
  `quote_grosstotal` float DEFAULT NULL,
  `link2bom` int(11) DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `labor` float DEFAULT NULL,
  `shipping` float DEFAULT NULL,
  `misc` float DEFAULT NULL,
  `revise_num` int(11) DEFAULT NULL,
  `parent_quote_id` varchar(20) DEFAULT NULL,
  `lockstatus` varchar(20) DEFAULT NULL,
  `total_due` float DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  KEY `recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_quote`
--

LOCK TABLES `supplier_quote` WRITE;
/*!40000 ALTER TABLE `supplier_quote` DISABLE KEYS */;
INSERT INTO `supplier_quote` VALUES (1,'RMK-01','2017-12-28','','Quote Description','','','bmandyam',NULL,'2017-12-28',NULL,'2017-12-30','',NULL,NULL,'ghghj',129,NULL,'242','$',NULL,560,0,100,0,0,0,0,'RMK-01','Not Locked',NULL,NULL),(2,'RMK-01-1','2017-12-28','','Quote Description','','','bmandyam',NULL,'2017-12-28',NULL,'2017-12-30','',NULL,NULL,'ghghj',132,NULL,'242','$',NULL,650,0,100,0,100,0,1,'RMK-01','Not Locked',NULL,NULL);
/*!40000 ALTER TABLE `supplier_quote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_quote_li`
--

DROP TABLE IF EXISTS `supplier_quote_li`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_quote_li` (
  `recnum` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(20) DEFAULT NULL,
  `item_desc` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `link2quote` int(11) DEFAULT NULL,
  KEY `recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_quote_li`
--

LOCK TABLES `supplier_quote_li` WRITE;
/*!40000 ALTER TABLE `supplier_quote_li` DISABLE KEYS */;
INSERT INTO `supplier_quote_li` VALUES (1,'1','one',12,10,120,1),(2,'2','two',22,20,440,1),(3,'1','one',15,10,150,2),(4,'2','two',25,20,500,2);
/*!40000 ALTER TABLE `supplier_quote_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppmaster`
--

DROP TABLE IF EXISTS `suppmaster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppmaster` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier` varchar(255) DEFAULT NULL,
  `link2supplier` int(11) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `scope_approval` varchar(255) DEFAULT NULL,
  `method_type` varchar(255) DEFAULT NULL,
  `extent_control` varchar(255) DEFAULT NULL,
  `inspection_year` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `approved` varchar(20) DEFAULT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `risk_involve` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppmaster`
--

LOCK TABLES `suppmaster` WRITE;
/*!40000 ALTER TABLE `suppmaster` DISABLE KEYS */;
INSERT INTO `suppmaster` VALUES (1,'Aero',129,'Ashwini','test@gmail.com','yes','test','test','test','Active','Yes','bmandyam','2017-12-26','','2017-12-20','','2017-12-29','1');
/*!40000 ALTER TABLE `suppmaster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `support` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `condition` varchar(30) DEFAULT NULL,
  `supp2wo` int(11) DEFAULT NULL,
  `supp2customer` int(11) DEFAULT NULL,
  `supp2contact` int(11) DEFAULT NULL,
  `supp2employee` int(11) DEFAULT NULL,
  `supp2type` int(11) DEFAULT NULL,
  `supp2solution` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support`
--

LOCK TABLES `support` WRITE;
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
/*!40000 ALTER TABLE `support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_notes`
--

DROP TABLE IF EXISTS `support_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `support_notes` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2support` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_notes`
--

LOCK TABLES `support_notes` WRITE;
/*!40000 ALTER TABLE `support_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `recnum` int(11) DEFAULT NULL,
  `task_name` varchar(20) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `taskcreate_date` date DEFAULT NULL,
  `taskcomp_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (40,'Create Bom',40,'2016-09-27','2016-09-28'),(41,'Create Sales',41,'2016-09-29','2016-09-30'),(42,'asssd',42,'2016-09-28','2016-10-27'),(43,'zhjgjg',43,'0000-00-00','2016-09-29'),(48,'ssss',48,'2016-11-10','0000-00-00');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_notes`
--

DROP TABLE IF EXISTS `task_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2task` int(11) DEFAULT NULL,
  `task` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_notes`
--

LOCK TABLES `task_notes` WRITE;
/*!40000 ALTER TABLE `task_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `task_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasklist`
--

DROP TABLE IF EXISTS `tasklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasklist` (
  `recnum` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `task1` varchar(255) DEFAULT NULL,
  `task2` varchar(255) DEFAULT NULL,
  `task3` varchar(255) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `taskdate` date DEFAULT NULL,
  `task4` varchar(255) DEFAULT NULL,
  `task5` varchar(255) DEFAULT NULL,
  `task6` varchar(255) DEFAULT NULL,
  `task7` varchar(255) DEFAULT NULL,
  `task8` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasklist`
--

LOCK TABLES `tasklist` WRITE;
/*!40000 ALTER TABLE `tasklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasklist_time`
--

DROP TABLE IF EXISTS `tasklist_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasklist_time` (
  `recnum` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasklist_time`
--

LOCK TABLES `tasklist_time` WRITE;
/*!40000 ALTER TABLE `tasklist_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasklist_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasknotes`
--

DROP TABLE IF EXISTS `tasknotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasknotes` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2task` int(11) DEFAULT NULL,
  `notes2project` int(11) DEFAULT NULL,
  KEY `ind_recnum` (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasknotes`
--

LOCK TABLES `tasknotes` WRITE;
/*!40000 ALTER TABLE `tasknotes` DISABLE KEYS */;
INSERT INTO `tasknotes` VALUES (1,'','2017-08-22',2,1,1),(2,'create users','2017-08-22',2,1,1),(3,'List the users','2017-08-22',2,2,1);
/*!40000 ALTER TABLE `tasknotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `recnum` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` char(50) DEFAULT NULL,
  `task_name` char(50) DEFAULT NULL,
  `category` char(50) DEFAULT NULL,
  `desc` text,
  `status` char(50) DEFAULT NULL,
  `link2project` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `priority` varchar(50) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `userrecnum` int(11) DEFAULT NULL,
  `act_complete_date` datetime DEFAULT NULL,
  `estimate_hours` int(11) DEFAULT NULL,
  `started_date` datetime DEFAULT NULL,
  `estimate_mins` int(11) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `siteid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'TK-8','Db Structure','DB','create db structure','Completed',1,'bmandyam','2017-08-21','low','2017-08-21 00:00:00','2017-08-22 00:00:00',NULL,NULL,2,'2017-08-21 16:40:41',4,'2017-08-21 16:37:03',6,NULL,NULL),(2,'TK-9','one','crud','one','Break',1,'bmandyam','2017-08-21','low','2017-08-22 00:00:00','2017-08-23 00:00:00',NULL,NULL,2,NULL,4,'2017-08-22 10:26:52',5,NULL,NULL),(3,'TK-10','two','dghdsg','dafASDF','Created',1,'bmandyam','2017-08-21','low','2017-08-23 00:00:00','2017-08-24 00:00:00',NULL,NULL,2,NULL,4,NULL,8,NULL,NULL),(4,'TK-11','three','sdfasdf','sfgasdfsdf','Completed',1,'bmandyam','2017-08-21','low','2017-08-24 00:00:00','2017-08-25 00:00:00',NULL,NULL,2,'2017-08-21 17:37:00',3,'2017-08-21 17:03:41',17,NULL,NULL);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_report`
--

DROP TABLE IF EXISTS `test_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_report` (
  `recno` int(11) DEFAULT NULL,
  `refno` varchar(50) DEFAULT NULL,
  `partno` varchar(50) DEFAULT NULL,
  `customer` varchar(50) DEFAULT NULL,
  `partname` varchar(100) DEFAULT NULL,
  `cust_standard` varchar(100) DEFAULT NULL,
  `rm_inv_no` varchar(50) DEFAULT NULL,
  `material_type` varchar(50) DEFAULT NULL,
  `inv_date` date DEFAULT NULL,
  `material_spec` varchar(50) DEFAULT NULL,
  `rm_receipt_date` date DEFAULT NULL,
  `rm_supplier` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_report`
--

LOCK TABLES `test_report` WRITE;
/*!40000 ALTER TABLE `test_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `recnum` int(11) NOT NULL,
  `link2user` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expires_in` int(11) DEFAULT NULL,
  `creation_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (0,94,'yaortaw3xc60qin70f68x5u6p0gd3w8p',3600,'2017-08-07 11:36:29'),(0,96,'rkoyx13rqr7z7fpzp4vlbdd6fbhj2kv3',3600,'2017-08-07 12:07:33'),(0,97,'fyxx6b37atnjsnkmynexmzbkn2o2qk4w',86400,'2017-09-07 08:02:23'),(0,2,'ejeci9rjcw9w1smd3l0fnj23bc0p78sd',86400,'2017-11-20 06:43:39');
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tran_license`
--

DROP TABLE IF EXISTS `tran_license`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tran_license` (
  `recnum` int(11) DEFAULT NULL,
  `app_name` varchar(100) DEFAULT NULL,
  `license_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tran_license`
--

LOCK TABLES `tran_license` WRITE;
/*!40000 ALTER TABLE `tran_license` DISABLE KEYS */;
/*!40000 ALTER TABLE `tran_license` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `recnum` int(11) DEFAULT NULL,
  `initials` varchar(10) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `user2contact` varchar(50) DEFAULT NULL,
  `user2employee` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `last_modified` date DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,NULL,'sa','c12e01f2a13ff5587e1e9e4aedb8242d','EMPL',NULL,'1','Active',NULL,NULL,'FSI'),(2,'bm','bmandyam','912ba4afb3fd7e197799758a322b07e4','EMPL',NULL,'2','Active','2007-04-15',NULL,'FSI'),(56,'acc','accounts','7a90e38a211ece1c346928e7d1f3e968','EMPL',NULL,'225','Active','2016-11-02',NULL,'FSI'),(57,'r','ravi','63dd3e154ca6d948fc380fa576343ba6','CUST','27',NULL,'Active','2017-02-17',NULL,'FSI'),(58,'a','asha','a2d5dc83dddc9580d68221d6604a759f','CUST','28',NULL,'Active','2017-02-20',NULL,'FSI'),(60,'A','aero','9575f05d5454113cd5f349e0e1da503c','VEND','30',NULL,'Active','2017-02-20',NULL,'FSI'),(84,'st','stores','61af09f34bc001f3b6d9139687a723fd','EMPL','NULL','232','Active','2017-05-03',NULL,'FSI'),(85,'p','ppc1','c21cedfcbe74cad21fa79031ca5aa95b','EMPL','NULL','233','Active','2017-05-03',NULL,'FSI'),(86,'q','qas','5668eca6cce28dbd64d888303dd7fb60','EMPL','NULL','234','Active','2017-05-03',NULL,'FSI'),(87,'pu','purchasing','74ba4e8291e8b2e40a31a50505f8b72e','EMPL','NULL','235','Active','2017-05-03',NULL,'FSI'),(88,'p','prodn','f8b493c7ffe23206dfdece136d51c382','EMPL','NULL','236','Active','2017-05-03',NULL,'FSI'),(89,'w','WO','e0a0862398ccf49afa6c809d3832915c','EMPL','NULL','237','Active','2017-05-03',NULL,'FSI'),(90,'r','PRN','3c8362a4683179fef39b9cd1e91787df','EMPL','NULL','238','Active','2017-05-03',NULL,'FSI'),(91,'h','HR','adab7b701f23bb82014c8506d3dc784e','EMPL','NULL','239','Active','2017-05-03',NULL,'FSI'),(92,'','sa_FSI','4393fa5764f826773d80747f312741d9','EMPL','','240','Active','2017-05-05',NULL,''),(93,NULL,'asd','79f839a4d23939eeebf8939818068516','EMPL',NULL,'241','Active','2017-07-05',NULL,'FSI'),(95,'aab','aab','e62595ee98b585153dac87ce1ab69c3c','MOBILE',NULL,'244',NULL,'2017-08-07',NULL,NULL),(96,'mmt','mmt','82915a4d88af6b86b4d6cb42705ffcb6','MOBILE',NULL,'245',NULL,'2017-08-07',NULL,NULL),(97,'M','manu','f13bb1bed03db9d68a7d9a48aafeec78','EMPL','NULL','246','Active','2017-09-07',NULL,'FSI');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vend_part_master`
--

DROP TABLE IF EXISTS `vend_part_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vend_part_master` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `mfr_partnum` varchar(50) DEFAULT NULL,
  `digikey_partnum` varchar(50) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `min_qty` int(11) DEFAULT NULL,
  `lead_time` int(11) DEFAULT NULL,
  `lead_unit` char(1) DEFAULT NULL,
  `part_desc` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `inventory_cnt` int(11) DEFAULT NULL,
  `link2vendor` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `ptype` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `part_iss` varchar(255) DEFAULT NULL,
  `drg_no` varchar(200) DEFAULT NULL,
  `drg_iss` varchar(200) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vend_part_master`
--

LOCK TABLES `vend_part_master` WRITE;
/*!40000 ALTER TABLE `vend_part_master` DISABLE KEYS */;
INSERT INTO `vend_part_master` VALUES (85,'BBOM/prn6','','','','',NULL,NULL,NULL,'y','testdf','',13,132,'2016-07-05','PART',NULL,'','','','FSI'),(86,'BBOM/prn2','','','','',NULL,NULL,NULL,'y','test','',10,132,'2016-07-06','BOM',NULL,'','','','FSI'),(2,'1234','3434','','','',100,NULL,NULL,'y','test','100',0,129,'2016-10-13','PART',NULL,'','','','FSI'),(3,'rmk 00 12','rmk 00 12','','','fluent',10,50,NULL,'y','ghdsgh','',0,132,'2017-12-05','PART',NULL,'A','A','A','FSI'),(4,'rmk 00 13','rmk 00 13','','','fluent',10,NULL,NULL,'y','dghsdd','',0,132,'2017-12-05','PART',NULL,'A','A','A','FSI');
/*!40000 ALTER TABLE `vend_part_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wo_attachment`
--

DROP TABLE IF EXISTS `wo_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wo_attachment` (
  `recnum` int(11) DEFAULT NULL,
  `filename1` varchar(255) DEFAULT NULL,
  `filename2` varchar(255) DEFAULT NULL,
  `filename3` varchar(255) DEFAULT NULL,
  `filename4` varchar(255) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wo_attachment`
--

LOCK TABLES `wo_attachment` WRITE;
/*!40000 ALTER TABLE `wo_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `wo_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wo_part_status`
--

DROP TABLE IF EXISTS `wo_part_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wo_part_status` (
  `fromsl` varchar(15) DEFAULT NULL,
  `tosl` varchar(15) DEFAULT NULL,
  `samplingsl` varchar(255) DEFAULT NULL,
  `rework` varchar(255) DEFAULT NULL,
  `acc` varchar(255) DEFAULT NULL,
  `rej` varchar(255) DEFAULT NULL,
  `ret` varchar(255) DEFAULT NULL,
  `stage` varchar(255) DEFAULT NULL,
  `inspnum` varchar(255) DEFAULT NULL,
  `signoff` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL,
  `line_num` int(11) DEFAULT NULL,
  `recno` int(11) NOT NULL AUTO_INCREMENT,
  `st_date` date DEFAULT NULL,
  `dn` varchar(45) DEFAULT NULL,
  `dn_sent` int(10) unsigned DEFAULT NULL,
  `dn_recv` int(10) unsigned DEFAULT NULL,
  `ncnum` char(50) DEFAULT NULL,
  `cofc_num` varchar(255) DEFAULT NULL,
  `cofc_date` date DEFAULT NULL,
  `supplier_wo` varchar(255) DEFAULT NULL,
  `hold` int(10) unsigned DEFAULT NULL,
  `cust_nc` char(50) DEFAULT NULL,
  `cust_rej` int(11) DEFAULT NULL,
  `qtyused_in_assy` int(11) DEFAULT NULL,
  `qtyused_in_dispatch` int(11) DEFAULT NULL,
  `balance_qty` int(11) DEFAULT NULL,
  `cust_rew` int(11) DEFAULT NULL,
  PRIMARY KEY (`recno`),
  KEY `ind_wps2wo` (`link2wo`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wo_part_status`
--

LOCK TABLES `wo_part_status` WRITE;
/*!40000 ALTER TABLE `wo_part_status` DISABLE KEYS */;
INSERT INTO `wo_part_status` VALUES ('','','','','20','','213','final','','','',31420,1,1,'0000-00-00','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','','','','final','','','',31421,1,2,'0000-00-00','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','','','','fi','','','',31433,1,3,'2016-05-30','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','','','','fi','','','',31434,1,4,'2016-05-30','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','','','','fi','','','',31432,1,5,'2016-05-22','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','2','0',NULL,'PostDN',NULL,NULL,NULL,31433,NULL,6,NULL,'DN11800',23,0,'','2','2016-05-23','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','','','','fi','','','',31436,1,8,'0000-00-00','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,11,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','2','0',NULL,'PostDN',NULL,NULL,NULL,31433,NULL,12,NULL,'DN11800',23,0,'','2','2016-05-23','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,13,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','4','0',NULL,'PostDN',NULL,NULL,NULL,31433,NULL,15,NULL,'DN11803',10,0,'','2','2016-05-30','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','4','0',NULL,'PostDN',NULL,NULL,NULL,31433,NULL,16,NULL,'DN11804',10,0,'','2','2016-05-23','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,17,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,18,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,19,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,20,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','4','0',NULL,'PostDN',NULL,NULL,NULL,31433,NULL,21,NULL,'DN11813',10,0,'','2','2016-05-23','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,22,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,24,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,25,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','5','0',NULL,'PostDN',NULL,NULL,NULL,31433,NULL,27,NULL,'DN11819',10,0,'','2','2016-05-16','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,28,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,29,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','5','0',NULL,'PostDN',NULL,NULL,NULL,31433,NULL,30,NULL,'DN11822',10,0,'','2','2016-05-16','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,31,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','5','0',NULL,'PostDN',NULL,NULL,NULL,31433,NULL,32,NULL,'DN11824',10,0,'','2','2016-05-22','4',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,34,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','','','','fina','','','',31419,1,35,'0000-00-00','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','1','0',NULL,'PostDN',NULL,NULL,NULL,31436,NULL,36,NULL,'DN11827',2,0,'','2','2016-05-22','8',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'1','9','0',NULL,'PostDN',NULL,NULL,NULL,31432,NULL,37,NULL,'DN11828',10,10,'06371','2','2016-05-23','10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('1','10','1','1','1','','','DN','','','',31438,1,38,'2016-05-31','',0,0,'06373','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','1','','','DN','','','',31440,1,39,'2016-06-28','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','1','0',NULL,'PostDN',NULL,NULL,NULL,31419,NULL,40,NULL,'DN11829',1,1,'','23','2016-06-20','9',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','1','1','','','DN','','','',31435,1,41,'2016-06-30','',0,0,'06372','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','28','','','fi','','','',31447,1,42,'2016-06-29','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,'0','0','0',NULL,'PostDN',NULL,NULL,NULL,31447,NULL,43,NULL,'DN11831',0,0,'','22','2016-06-27','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','20','','','fi','','','',31452,1,52,'2016-06-27','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','','','',31451,1,53,'2016-07-21','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','12','','',31453,1,54,'2016-07-28','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','134','','',31458,1,55,'2016-07-26','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','10','','','fi','','','test',31462,1,56,'2016-09-30','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','10','','','fi','213','ss','',31463,1,57,'2016-10-05','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','10','','','fi','123','sd','',31461,1,58,'2016-10-05','',0,0,'','',NULL,'',0,'6380',3,NULL,NULL,NULL,NULL),('1','1','1','','18','2','','fi','1223','ssss','',31460,1,59,'2016-10-06','0',0,0,'06375','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','20','','','fi','45','test','',31468,1,60,'2016-10-11','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','10','','','fi','2434','sss','',31467,1,61,'2016-10-13','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','12','','','fi','1213','','',31465,1,62,'2016-10-13','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','10','','','fi','3434','ss','',31469,1,63,'2016-10-18','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','','','',31470,1,64,'0000-00-00','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','','','',31471,1,65,'0000-00-00','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','2324','ssss','',31472,1,66,'2016-11-10','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','FI','12','12','',31476,1,67,'2016-11-05','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','0','1','0','0','FI','12','12','',31477,1,68,'2016-11-07','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','34','dsd','',31478,1,69,'2016-11-10','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','fdg','sss','',31479,1,70,'2016-11-09','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','343','sss','',31480,1,71,'2017-02-20','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','5','','','fi','dsd','asds','',31490,1,72,'2017-03-09','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','rtsded','ete',31501,1,73,'2017-08-10','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','2','','','fi','','','',31502,1,74,'2017-08-10','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','2','','','fi','','','',31504,1,75,'2017-08-10','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','','',31510,1,76,'2017-08-16','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','','',31495,1,77,'2017-08-16','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','','',31511,1,78,'2017-08-16','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','','',31512,1,79,'2017-08-24','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','8','2','','fi','test','','',31520,1,80,'2017-08-29','',0,0,'06382','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','8','2','','fi','te','','',31521,1,81,'2017-08-28','',0,0,'06383','',NULL,'',0,'6383',2,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','','',31526,1,82,'2017-09-12','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','','',31524,1,83,'2017-09-12','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','','',31523,1,84,'2017-09-12','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','','',31527,1,85,'2017-09-12','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('','','','','20','','','DN','test','','',31533,1,86,'2017-11-27','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','20','','','20','','','fi','test','','',31534,1,87,'2017-11-30','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','','','1','','','fi','test','','',31531,1,88,'2017-11-23','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','','','1','','','fi','test','','',31528,1,89,'2017-11-23','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','5','','','fi','test','','',31535,1,90,'2017-11-24','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','5','','','fi','test','','',31537,1,91,'2017-11-24','',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','5','','','fi','test','','',31538,1,92,'2017-11-24','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','2','','','fi','test','','',31539,1,93,'2017-11-29','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','2','','','fi','test','','',31540,1,94,'2017-11-24','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','test','','',31542,1,95,'2017-11-24','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL),('1','1','1','','1','','','fi','01','jkgjk','jgkfjg',31543,1,96,'2017-12-05','0',0,0,'','',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `wo_part_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wonotes`
--

DROP TABLE IF EXISTS `wonotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wonotes` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` date DEFAULT NULL,
  `link2wo` int(10) unsigned DEFAULT NULL,
  `link2user` varchar(45) DEFAULT NULL,
  `wonotes` text,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wonotes`
--

LOCK TABLES `wonotes` WRITE;
/*!40000 ALTER TABLE `wonotes` DISABLE KEYS */;
INSERT INTO `wonotes` VALUES (1,'2016-05-10',31420,'2',''),(7,'2016-05-11',31420,'2',''),(25,'2016-05-11',31433,'2',''),(26,'2016-05-11',31432,'2',''),(27,'2016-05-11',31433,'2',''),(28,'2016-05-11',31433,'2',''),(29,'2016-05-11',31433,'2',''),(30,'2016-05-11',31433,'2',''),(34,'2016-05-11',31420,'2',''),(35,'2016-05-11',31432,'2',''),(36,'2016-05-11',31433,'2',''),(37,'2016-05-11',31432,'2',''),(38,'2016-05-11',31435,'2',''),(39,'2016-05-12',31418,'2',''),(40,'2016-05-12',31423,'2','af'),(41,'2016-05-19',31436,'2',''),(42,'2016-05-23',31434,'2',''),(43,'2016-05-23',31434,'2',''),(44,'2016-05-24',31428,'2',''),(45,'2016-05-24',31437,'2',''),(49,'2016-05-24',31419,'2',''),(50,'2016-05-27',31430,'2',''),(51,'2016-05-30',31438,'2','test'),(52,'2016-06-02',31431,'2',''),(53,'2016-06-02',31440,'2',''),(54,'2016-06-02',31440,'2',''),(55,'2016-06-02',31440,'2',''),(56,'2016-06-02',31435,'2',''),(57,'2016-06-02',31440,'2',''),(58,'2016-06-24',31439,'2',''),(59,'2016-06-24',31439,'2','testing'),(60,'2016-06-27',31439,'2','test'),(62,'2016-06-27',31435,'2',''),(63,'2016-06-27',31435,'2',''),(64,'2016-06-27',31435,'2',''),(65,'2016-06-27',31435,'2',''),(66,'2016-06-27',31438,'2',''),(67,'2016-06-27',31438,'2',''),(68,'2016-06-27',31438,'2',''),(69,'2016-06-28',31435,'2','test'),(71,'2016-06-28',31435,'2','test'),(72,'2016-06-28',31435,'2',''),(73,'2016-06-28',31435,'2',''),(74,'2016-06-28',31446,'2',''),(75,'2016-06-29',31447,'2',''),(76,'2016-06-29',31447,'2',''),(77,'2016-06-30',31452,'2',''),(78,'2016-06-30',31452,'2',''),(79,'2016-06-30',31450,'2',''),(80,'2016-07-01',31451,'2',''),(82,'2016-07-01',31451,'2',''),(83,'2016-07-01',31453,'2',''),(84,'2016-07-04',31457,'2',''),(85,'2016-07-04',31457,'2',''),(86,'2016-07-04',31457,'2',''),(87,'2016-07-04',31457,'2',''),(88,'2016-07-04',31457,'2',''),(89,'2016-07-04',31457,'2',''),(90,'2016-07-04',31457,'2',''),(91,'2016-07-04',31457,'2',''),(92,'2016-07-04',31457,'2',''),(93,'2016-07-05',31457,'2',''),(94,'2016-07-05',31457,'2',''),(95,'2016-07-05',31457,'2',''),(96,'2016-07-05',31457,'2',''),(97,'2016-07-05',31457,'2',''),(98,'2016-07-05',31457,'2',''),(99,'2016-07-05',31457,'2','testing'),(100,'2016-07-05',31457,'2',''),(101,'2016-07-05',31457,'2',''),(102,'2016-07-05',31457,'2','testing'),(103,'2016-07-05',31457,'2','tetsting'),(104,'2016-07-28',31453,'2',''),(105,'2016-07-28',31458,'2',''),(106,'2016-08-23',31460,'17','testing'),(107,'2016-09-30',31462,'85',''),(108,'2016-09-30',31462,'85',''),(109,'2016-10-03',31463,'2','test'),(110,'2016-10-04',31464,'2','test'),(111,'2016-10-05',31463,'2',''),(112,'2016-10-05',31463,'2',''),(113,'2016-10-05',31463,'2',''),(114,'2016-10-05',31463,'2',''),(115,'2016-10-05',31461,'2',''),(116,'2016-10-05',31463,'2',''),(117,'2016-10-05',31463,'2',''),(118,'2016-10-05',31461,'2',''),(119,'2016-10-05',31461,'2',''),(120,'2016-10-05',31461,'2',''),(121,'2016-10-05',31461,'2',''),(122,'2016-10-05',31461,'2',''),(123,'2016-10-05',31461,'2',''),(124,'2016-10-05',31461,'2',''),(125,'2016-10-05',31461,'2',''),(126,'2016-10-05',31461,'2',''),(130,'2016-10-07',31460,'2','test'),(131,'2016-10-12',31468,'2','test'),(132,'2016-10-14',31467,'2','dsdsd'),(133,'2016-10-14',31467,'2','ddd'),(134,'2016-10-18',31465,'2','test'),(135,'2016-10-18',31465,'2','test'),(136,'2016-10-18',31469,'2','test'),(137,'2016-10-18',31469,'2','test'),(138,'2016-10-18',31469,'2','test'),(139,'2016-11-04',31472,'2','test'),(140,'2016-11-05',31476,'2','WO CLosed'),(141,'2016-11-07',31477,'2','Closed'),(142,'2016-11-09',31478,'2','test'),(143,'2016-11-09',31479,'2','test'),(144,'2016-11-10',31477,'2','test'),(145,'2016-11-14',31483,'2','testing  grn issue'),(146,'2016-11-14',31483,'2','test'),(147,'2016-12-19',31487,'2','cancel work order'),(148,'2016-12-19',31488,'2','work order cancelled'),(149,'2016-12-22',31488,'2','testing\r\n'),(150,'2016-12-22',31488,'2','testing'),(151,'2017-02-14',31489,'2','wo caneclled'),(153,'2017-02-20',31480,'2','test'),(154,'2017-03-09',31490,'2','test'),(155,'2017-03-16',31480,'2','test'),(156,'2017-03-16',31480,'2','test'),(157,'2017-08-10',31500,'2','test'),(158,'2017-08-10',31501,'2','test'),(159,'2017-08-10',31501,'2',''),(160,'2017-08-10',31502,'2',''),(161,'2017-08-10',31504,'2',''),(162,'2017-08-16',31510,'2','test'),(163,'2017-08-16',31510,'2','test'),(164,'2017-08-16',31495,'2',''),(165,'2017-08-16',31511,'2','test'),(166,'2017-08-16',31512,'2','test'),(173,'2017-08-28',31520,'2','test'),(175,'2017-08-28',31521,'2','test'),(176,'2017-09-12',31526,'2','test'),(177,'2017-09-12',31524,'2','test'),(178,'2017-09-12',31523,'2','test'),(179,'2017-09-12',31523,'2','test'),(180,'2017-09-12',31527,'2','test'),(181,'2017-11-23',31520,'2','test'),(186,'2017-11-23',31521,'2','test'),(187,'2017-11-23',31533,'2','test'),(188,'2017-11-23',31534,'2','test'),(189,'2017-11-23',31531,'2','Closed by ashwini'),(190,'2017-11-23',31528,'2','test'),(191,'2017-11-24',31535,'2','added fi and closed'),(192,'2017-11-24',31537,'2','Added FI And closed'),(193,'2017-11-24',31537,'2','test'),(194,'2017-11-24',31538,'2','test'),(195,'2017-11-24',31539,'2','test'),(196,'2017-11-24',31540,'2','Added FI and closed'),(197,'2017-11-24',31542,'2','test'),(198,'2017-12-05',31543,'2','close the work order');
/*!40000 ALTER TABLE `wonotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_flow_config`
--

DROP TABLE IF EXISTS `work_flow_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_flow_config` (
  `recnum` int(11) DEFAULT NULL,
  `stage` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `doc_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `email_list` varchar(255) DEFAULT NULL,
  `appr_type` varchar(10) DEFAULT NULL,
  `approval_by` varchar(10) DEFAULT NULL,
  `allow_cust_disp` varchar(10) DEFAULT NULL,
  `allow_print_disp` varchar(10) DEFAULT NULL,
  `allow_report_disp` varchar(10) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  `cust_status_disp` varchar(100) DEFAULT NULL,
  `est_time` time DEFAULT NULL,
  `est_cost` float DEFAULT NULL,
  `act_status` varchar(10) DEFAULT NULL,
  `dependency` varchar(30) DEFAULT NULL,
  `approval` varchar(30) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  `secondary_responsibility` varchar(100) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `when_process` varchar(255) DEFAULT NULL,
  `currency` varchar(45) DEFAULT NULL,
  `primary_responsibility` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_flow_config`
--

LOCK TABLES `work_flow_config` WRITE;
/*!40000 ALTER TABLE `work_flow_config` DISABLE KEYS */;
INSERT INTO `work_flow_config` VALUES (31,100,'Aerowings','Management','WO','Create Wo','bmandyam@fluentsoft.com','','test','test','','eted','2017-08-14','sa',NULL,NULL,'','01:02:00',100,'Active','',NULL,'FSI','test','test','test','$',NULL),(40,10,'prn1','Management','WO','test','fluentsoft.com','','y','y','y','','2017-08-28','sa',NULL,NULL,'','04:03:00',100,'Active','',NULL,'FSI','Mr.Rahul Chhonkar','As per our terms & conditions in Quotation along with the Advance cheque\r\n','After receiving it from Client within a day and send for approval to Technical dept.\r\n','$',NULL),(41,20,'prn1','Stores','WO','test','fluentsoft.com','test','y','y','y','y','2017-08-28','sa',NULL,NULL,'y','01:02:00',100,'Active','10',NULL,'FSI','Kamal Kant',' immediately after receiving the complete project file\r\n','As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site ','$',NULL),(42,30,'prn1','Engineering','WO','test','fluentsoft.com','','y','y','y','y','2017-08-28','sa',NULL,NULL,'','02:03:00',100,'Active','20',NULL,'FSI','Mr.Rahul Chhonkar','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.\r\n','$',NULL),(43,40,'prn1','PPC','WO','test','fluentsoft.com','','y','y','y','y','2017-08-28','sa',NULL,NULL,'','03:02:00',100,'Active','30',NULL,'FSI','Mr. Kamal Kant','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI) from Accounts department. If he found any discrepancy from the order then he must take the corrected order','After receiving the MMS form and photos of site within 4 hours.\r\n','$',NULL),(44,50,'prn1','Production','WO','test','fluentsoft.com','y','y','y','y','y','2017-08-28','sa',NULL,NULL,'y','02:03:00',100,'Active','40',NULL,'FSI','Mr. Vivek Saxena','After receiving MMS in ERP technical executive will make Bill of Material and all production document from K-Soft (viz. stickers, cutting list, assembling list, special instruction if any etc.)\r\n* Any kind of mistake will not be acceptable & may lead to','After receiving the copy of MMS within 4 hours.\r\n','$',NULL),(45,60,'prn1','QA','WO','test','fluentsoft.com','','y','y','y','y','2017-08-28','sa',NULL,NULL,'','02:02:00',100,'Active','50',NULL,'FSI','Mr. Nitin Sagar','After receiving the complete production document from technical department, production executive will verify that he has received all the documents as per norms* .\r\n* BOM, Cutting list,elevation and shop drawing, MMS etc.','After preparation of production document within 4 hours.\r\n','$',NULL),(46,70,'prn1','Assembly','WO','test','fluentsoft.com','y','y','y','y','y','2017-08-28','sa',NULL,NULL,'','01:02:00',100,'Active','60',NULL,'FSI','Mr. Jahir/Mr. Robin','through format no……\r\n','after receiving Production document within 1 hour.\r\n','$',NULL),(47,80,'prn1','Packing','WO','test','fluentsoft.com','','','','','','2017-08-28','sa',NULL,NULL,'','01:02:00',100,'Active','70',NULL,'FSI','Mr. Shivendu','He must follow Format No…..,fill it completely* and hand over it to Data Entry Operator for feeding it in ERP. If found any Quality defect then he should inform it to the Line Supervisor, Production Executive, Production head and MDO.\r\n* Any kind of mist','Immediately after receiving the complete product from production department.\r\n','$',NULL),(48,90,'prn1','Purchasing','WO','test','','','','','','','2017-08-28','sa',NULL,NULL,'','02:04:00',100,'Active','80',NULL,'FSI','Mr. Narottam/Mr. Sanjeev','All product after QC clearance must be packed according to minimum packing standards/as per packing instructions in order.\r\n','After receiving the complete product from Quality department.\r\n','$',NULL),(49,100,'prn1','Management','WO','test','fluentsoft.com','','','','','','2017-08-28','sa',NULL,NULL,'','01:02:00',100,'Active','90',NULL,'FSI','Mr. G.R Sharma','Inform whether the payment has received as per the approved payment terms decided at the order finalization. After getting OK from Accounts, production dept. must ensure full kitting of dispatch of that partiicular Job Card along with the synchronization ','After receiving the request of clearance from Production Executive within 2 hours by mail only.','$',NULL),(50,10,'prn2','Pattern','WO','test','fluentsoft.com','','','','','','2017-08-28','sa',NULL,NULL,'','02:02:00',100,'Active','',NULL,'FSI','Pattern Owner','He will check exact quantity, price & other terms and conditions as per quotation and what the client is giving us in his order. After checking if he will find any discrepancy then he can send it back to Concerned Sales person for rectification in Order. ','immediately after receiving the 1st copy of order within a day.','$',NULL),(51,20,'prn2','Print','WO','test','fluentsoft.com','','','','','','2017-08-28','sa',NULL,NULL,'','02:03:00',100,'Active','10',NULL,'FSI','Print Owner',' immediately after receiving the complete project file','As per Format No. F/Prod/02 he has to take the measurement of all the openings and has to verify the condition of site. If he found it OK then he must take the signatures of client/representative on right MMS** form but if he found any ambiguity in site','$',NULL),(52,30,'prn2','Assy Kit','WO','test','fluentsoft.com','','','','','','2017-08-28','sa',NULL,NULL,'','02:03:00',100,'Active','20',NULL,'FSI','Assy Kit Owner','After receiving MMS form from Pre-Checker, project exec. Will ensure to prepare a right MMS* in ERP along with the accurate Performa Invoice (PI)* from Accounts department. If he found any discrepancy from the order then he must take the corrected order','After receiving the MMS form and photos of site within 4 hours.','$',NULL),(54,50,'prn2','Scanout','WO','test','fluentsoft.com','','','','','','2017-08-28','sa',NULL,NULL,'','01:03:00',100,'Active','30',NULL,'FSI','Scanout Owner','He must check all the relevant papers (viz. payment terms, PI, Bills, Form C etc.) and ensure that the total payment should be received from the Client.','Immediately with CHR.','$',NULL),(55,60,'prn2','Tailored','WO','test','fluentsoft.com','','','','','','2017-08-28','sa',NULL,NULL,'','02:03:00',100,'Active','50',NULL,'FSI','Tailored Owner','As per Format No. Kalco/Proj/F02 each and every thing should be finally handover to client along with his/her signature and handover the User Manual to the Client.','At the time of Handover but within as minimum as possible time after PHR.','$',NULL),(56,70,'prn2','QA','WO','test','fluentsoft.com','','','','','','2017-08-28','sa',NULL,NULL,'','02:03:00',100,'Active','60',NULL,'FSI','QA Owner','As per Format No. Kalco/Proj/F01 If he found unfit to deliver it to the Client then he must ensure that the rectification should be done within minimum time frame.','After/during the fixing of product.','$',NULL),(65,110,'prn1','Scanout','WO','test','','','','','','','2017-11-13','sa',NULL,NULL,'','03:03:00',100,'Active','100',NULL,'FSI','accounts','trgrfg','fgfg','$','Badari'),(66,10,'prn8','Management','WO','test','testt@gmial.com','test','test','y','','','2017-11-23','sa',NULL,NULL,'','02:02:00',100,'Active','',NULL,'FSI','Badari','test','test','$','Badari'),(67,20,'prn8','Stores','WO','test','testt@gmial.com','test','test','y','','','2017-11-23','sa',NULL,NULL,'','02:01:00',100,'Active','10',NULL,'FSI','qas','tetet','etet','$',''),(68,30,'prn8','Engineering','WO','dfdf','testt@gmial.com','dfdg','dfd','y','','','2017-11-23','sa',NULL,NULL,'','02:01:00',100,'Active','20',NULL,'FSI','prodn','teere','etet','$','HR'),(69,40,'prn8','PPC','WO','teset','testt@gmial.com','etset','erste','y','','','2017-11-23','sa',NULL,NULL,'','02:02:00',100,'Active','30',NULL,'FSI','accounts','test','esst','$',''),(70,50,'prn8','Production','WO','test','testt@gmial.com','dfdg','eref','y','','','2017-11-23','sa',NULL,NULL,'','01:05:00',100,'Active','40',NULL,'FSI','sa','etet','teset','$',''),(71,60,'prn8','QA','WO','test','testt@gmial.com','test','test','y','','','2017-11-23','sa',NULL,NULL,'','04:03:00',100,'Active','50',NULL,'FSI','accounts','test','test','$','accounts'),(72,70,'prn8','Assembly','WO','test','testt@gmial.com','test','test','y','','','2017-11-23','sa',NULL,NULL,'','01:01:00',100,'Active','60',NULL,'FSI','sa','test','test','$','sa'),(73,10,'prn3','Stores','WO','test','testt@gmial.com','test','test','','','','2017-11-23','sa',NULL,NULL,'','02:02:00',100,'Active','',NULL,'FSI','Badari','test','test','$','Badari'),(74,20,'prn3','Production','WO','test','testt@gmial.com','test','test','y','','','2017-11-23','sa',NULL,NULL,'','02:02:00',100,'Active','10',NULL,'FSI','accounts','test','test','$','sa'),(75,30,'prn3','QA','WO','test','testt@gmial.com','test','dfd','y','','','2017-11-23','sa',NULL,NULL,'','02:01:00',100,'Active','20',NULL,'FSI','Badari','test','test','$','Badari'),(76,10,'prn4','Stores','WO','WO_Recd','testt@gmial.com','test','test','y','','','2017-11-24','sa',NULL,NULL,'','02:02:00',100,'Active','',NULL,'FSI','Badari','test','test','$','Badari'),(77,20,'prn4','Production','WO','Docs_Recd','testt@gmial.com','dfdg','dfd','y','','','2017-11-24','sa',NULL,NULL,'','02:03:00',100,'Active','10',NULL,'FSI','Badari','test','test','$',''),(78,30,'prn4','Production','WO','Recd_Material','testt@gmial.com','test','test','y','','','2017-11-24','sa',NULL,NULL,'','01:02:00',100,'Active','20',NULL,'FSI','Badari','','','$','Badari'),(79,40,'prn4','Production','WO','Stage_Insp_Done','testt@gmial.com','test','test','y','','','2017-11-24','sa',NULL,NULL,'','04:02:00',100,'Active','30',NULL,'FSI','Badari','test','test','$','Badari'),(80,50,'prn4','Production','WO','Fitting Done','testt@gmial.com','test','test','y','','','2017-11-24','sa',NULL,NULL,'','02:03:00',100,'Active','40',NULL,'FSI','Badari','test','test','$','Badari'),(81,60,'prn4','QA','WO','Recd_FG_For_FI','testt@gmial.com','test','test','y','','','2017-11-24','sa',NULL,NULL,'','03:02:00',100,'Active','50',NULL,'FSI','Badari','test','test','$','Badari'),(82,70,'prn4','QA','WO','FI_Completed','testt@gmial.com','test','test','y','','','2017-11-24','sa',NULL,NULL,'','02:02:00',100,'Active','60',NULL,'FSI','Badari','test','test','$','Badari'),(83,10,'prn9','Stores','WO','WO_Recd','testt@gmial.com','test','y','','y','','2017-12-01','sa',NULL,NULL,'','03:03:00',100,'Active','',NULL,'FSI','Badari','test','test','$','Badari'),(84,20,'prn9','Production','WO','Docs_Recd','testt@gmial.com','test','sfsf','y','y','','2017-12-01','sa',NULL,NULL,'','03:04:00',100,'Active','10',NULL,'FSI','Badari','test','test','$','Badari'),(85,30,'prn9','Production','WO','Recd_Material','testt@gmial.com','test','y','y','y','','2017-12-01','sa',NULL,NULL,'','01:02:00',100,'Active','20',NULL,'FSI','Badari','test','test','$','Badari'),(86,40,'prn9','Production','WO','Stage_Insp_Done','testt@gmial.com','test','y','y','','','2017-12-01','sa',NULL,NULL,'','01:02:00',100,'Active','30',NULL,'FSI','Badari','test','test','$','Badari'),(87,50,'prn9','Production','WO','Fitting Done','testt@gmial.com','test','y','y','y','','2017-12-01','sa',NULL,NULL,'','02:02:00',100,'Active','40',NULL,'FSI','Badari','test','test','$','Badari'),(88,60,'prn9','QA','WO','Recd_FG_For_FI','testt@gmial.com','','test','y','y','','2017-12-01','sa',NULL,NULL,'','01:02:00',100,'Active','50',NULL,'FSI','Badari','test','test','$','Badari'),(89,70,'prn9','QA','WO','FI_Completed','testt@gmial.com','test','test','y','y','','2017-12-01','sa',NULL,NULL,'','02:03:00',100,'Active','60',NULL,'FSI','Badari','test','test','$','Badari'),(90,10,'Aerowings','Marketing','WO','test','testt@gmial.com','','test','y','y','','2017-12-05','sa',NULL,NULL,'','01:02:00',100,'Active','',NULL,'FSI','HR','test','test','$','HR'),(91,20,'Aerowings','DAFNY','WO','test','testt@gmial.com','','','','','','2017-12-05','sa',NULL,NULL,'','02:03:00',100,'Active','10',NULL,'FSI','accounts','test','test','$','accounts'),(92,30,'Aerowings','Stores','WO','WO_Recd','testt@gmial.com','','','','','','2017-12-05','sa',NULL,NULL,'','01:03:00',100,'Active','20',NULL,'FSI','stores','test','test','$','stores'),(93,40,'Aerowings','Production','WO','Docs_Recd','testt@gmial.com','','','','','','2017-12-05','sa',NULL,NULL,'','02:04:00',100,'Active','30',NULL,'FSI','stores','test','test','$','stores'),(94,50,'Aerowings','Production','WO','Recd_Material','testt@gmial.com','test','test','','','','2017-12-05','sa',NULL,NULL,'','01:01:00',100,'Active','40',NULL,'FSI','ppc1','test','test','$','ppc1'),(95,60,'Aerowings','Production','WO','Stage_Insp_Done','testt@gmial.com','','test','y','y','','2017-12-05','sa',NULL,NULL,'','01:03:00',100,'Active','50',NULL,'FSI','accounts','test','test','$','accounts'),(96,70,'Aerowings','Production','WO','Fitting Done','','test','test','','','','2017-12-05','sa',NULL,NULL,'','02:02:00',100,'Active','60',NULL,'FSI','Badari','test','test','$','Badari'),(97,80,'Aerowings','QA','WO','Recd_FG_For_FI','','test','test','','','','2017-12-05','sa',NULL,NULL,'','01:01:00',100,'Active','70',NULL,'FSI','accounts','test','test','$','stores'),(98,90,'Aerowings','QA','WO','FI_Completed','testt@gmial.com','','','','','','2017-12-05','sa',NULL,NULL,'','01:01:00',100,'Active','80',NULL,'FSI','Badari','test','test','$','Badari'),(99,110,'Aerowings','Stores','WO','Dispatch','','','test','y','','','2017-12-05','sa',NULL,NULL,'','01:02:00',100,'Active','90',NULL,'FSI','Badari','test','test','$','Badari'),(100,10,'Ripple','Marketing','WO','Int Wo Released','testt@gmial.com','test','yes','','y','','2017-12-21','sa',NULL,NULL,'','03:04:00',100,'Active','',NULL,'FSI','Badari','test','tste','$','Badari'),(101,20,'Ripple','Marketing','WO','Risk Analysis','testt@gmial.com','','','','y','','2017-12-21','sa',NULL,NULL,'','02:03:00',100,'Active','10',NULL,'FSI','accounts','tese','etret','$','accounts'),(102,30,'Ripple','PPC','WO','BOM','testt@gmial.com','','','','','','2017-12-21','sa',NULL,NULL,'','01:03:00',100,'Active','20',NULL,'FSI','Badari','test','test','$','Badari'),(103,40,'Ripple','PPC','WO','Purchase indents','testt@gmial.com','','','','','','2017-12-21','sa',NULL,NULL,'','03:03:00',100,'Active','30',NULL,'FSI','Badari','test','test','$','Badari'),(104,50,'Ripple','Stores','WO','Store Approval','testt@gmial.com','','','','','','2017-12-21','sa',NULL,NULL,'','03:04:00',100,'Active','40',NULL,'FSI','ppc1','test','test','$','ppc1'),(105,60,'Ripple','PPC','WO','RMPO for tools Consummables','','','','','','','2017-12-21','sa',NULL,NULL,'','01:04:00',100,'Active','50',NULL,'FSI','qas','test','test','$','stores'),(106,70,'Ripple','Stores','WO','Stores Recepts GRN','testt@gmial.com','','','','','','2017-12-21','sa',NULL,NULL,'','01:02:00',100,'Active','60',NULL,'FSI','Badari','testr','test','$','Badari'),(107,80,'Ripple','QA','WO','QA Inspection','','','','','','','2017-12-21','sa',NULL,NULL,'','03:03:00',100,'Active','70',NULL,'FSI','Badari','test','test','$','stores'),(108,90,'Ripple','PPC','WO','BOI','','','','','','','2017-12-21','sa',NULL,NULL,'','04:03:00',100,'Active','80',NULL,'FSI','Badari','test','test','$','Badari'),(109,100,'Ripple','PPC','WO','BOI  recd GRN','','','','','','','2017-12-21','sa',NULL,NULL,'','02:03:00',100,'Active','90',NULL,'FSI','Badari','test','test','$','Badari'),(110,110,'Ripple','PPC','WO','QA Insp','','','','','','','2017-12-21','sa',NULL,NULL,'','03:07:00',100,'Active','100',NULL,'FSI','Badari','test','test','$','Badari'),(111,120,'Ripple','Stores','WO','Stores create KIT & DOC','','','','','','','2017-12-21','sa',NULL,NULL,'','05:04:00',100,'Active','110',NULL,'FSI','Badari','test','test','$','Badari'),(112,130,'Ripple','Account','WO','Invoice by Account','','','','','','','2017-12-21','sa',NULL,NULL,'','04:02:00',100,'Active','120',NULL,'FSI','accounts','test','test','$','accounts'),(113,140,'Ripple','Packing','WO','packing','','','','','','','2017-12-21','sa',NULL,NULL,'','04:03:00',100,'Active','',NULL,'FSI','qas','test','test','$','qas');
/*!40000 ALTER TABLE `work_flow_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_order`
--

DROP TABLE IF EXISTS `work_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_order` (
  `recnum` int(11) DEFAULT NULL,
  `wonum` varchar(50) DEFAULT NULL,
  `wotype` varchar(30) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `po_num` varchar(100) DEFAULT NULL,
  `quote_num` varchar(100) DEFAULT NULL,
  `condition` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `wo2customer` int(11) DEFAULT NULL,
  `wo2contact` int(11) DEFAULT NULL,
  `wo2employee` int(11) DEFAULT NULL,
  `wo2type` int(11) DEFAULT NULL,
  `sch_due_date` date DEFAULT NULL,
  `actual_ship_date` date DEFAULT NULL,
  `reorder` varchar(20) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `last_modified_date` datetime DEFAULT NULL,
  `wo2wfconfig` int(11) DEFAULT NULL,
  `wo2mfg` int(11) DEFAULT NULL,
  `book_date` date DEFAULT NULL,
  `revised_ship_date` date DEFAULT NULL,
  `bomnum` varchar(20) DEFAULT NULL,
  `wo2bom` int(11) DEFAULT NULL,
  `filename1` varchar(255) DEFAULT NULL,
  `filename2` varchar(255) DEFAULT NULL,
  `filename3` varchar(255) DEFAULT NULL,
  `filename4` varchar(255) DEFAULT NULL,
  `link2masterdata` int(11) DEFAULT NULL,
  `grnnum` varchar(255) DEFAULT NULL,
  `qty` varchar(20) DEFAULT NULL,
  `sonum` varchar(30) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `po_qty` float DEFAULT NULL,
  `partnum` varchar(100) DEFAULT NULL,
  `comp_qty` int(11) DEFAULT '0',
  `batchnum` varchar(100) DEFAULT NULL,
  `woclassif` varchar(20) DEFAULT NULL,
  `worefnum` varchar(20) DEFAULT NULL,
  `formrev` varchar(255) DEFAULT NULL,
  `remarks` text,
  `link2mps` int(11) DEFAULT NULL,
  `amendment_date` date DEFAULT NULL,
  `amendment_notes` varchar(255) DEFAULT NULL,
  `original_qty` float unsigned DEFAULT NULL,
  `cust_po_line_num` varchar(20) DEFAULT NULL,
  `treatment` varchar(50) DEFAULT NULL,
  `fai` varchar(10) DEFAULT NULL,
  `type_remarks` text,
  `crn_num` varchar(30) DEFAULT NULL,
  `dn_qty_sent` int(10) unsigned DEFAULT '0',
  `dn_qty_recd` int(10) unsigned DEFAULT '0',
  `stage_split` varchar(45) DEFAULT NULL,
  `approval` varchar(15) DEFAULT NULL,
  `approval_date` date DEFAULT NULL,
  `acc4dn` int(11) DEFAULT '0',
  `printflag` int(11) DEFAULT NULL,
  `printapproval` char(5) DEFAULT NULL,
  `printcount` int(11) DEFAULT NULL,
  `rm_spec` varchar(255) DEFAULT NULL,
  `rm_type` varchar(255) DEFAULT NULL,
  `assy_wonum` varchar(50) DEFAULT NULL,
  `priority` varchar(45) DEFAULT NULL,
  `dispatch_qty` int(11) DEFAULT '0',
  `ret_qty` int(11) DEFAULT '0',
  `rej_qty` int(11) DEFAULT '0',
  `rework_qty` int(11) DEFAULT '0',
  `assy_qty` int(11) DEFAULT '0',
  `approved_by` varchar(45) DEFAULT NULL,
  `cust_rew_qty` int(11) DEFAULT '0',
  `cust_rej_qty` int(11) DEFAULT NULL,
  `dnnum` char(10) DEFAULT NULL,
  `siteid` varchar(45) DEFAULT NULL,
  KEY `wpo` (`po_num`),
  KEY `ind_wonum` (`wonum`),
  KEY `ind_l2m` (`link2masterdata`),
  KEY `ind_wo_grn` (`grnnum`),
  KEY `ind_wo_recnum` (`recnum`),
  KEY `ind_wo2customer` (`wo2customer`),
  KEY `ind_crn` (`crn_num`),
  KEY `ind_wo_condition` (`condition`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_order`
--

LOCK TABLES `work_order` WRITE;
/*!40000 ALTER TABLE `work_order` DISABLE KEYS */;
INSERT INTO `work_order` VALUES (31535,'31469','','xyz','CUSTPO-001',NULL,'Closed','Create Wo',127,NULL,NULL,NULL,'2017-06-15','2017-11-24','','2017-11-24','2017-11-24 11:50:27',NULL,NULL,'2017-11-24','0000-00-00','',NULL,'','','','',7047,'RMK-GRN-001','5',NULL,'0000-00-00',100,'121',5,'dfg4636','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','test',2305,'0000-00-00','',0,'1','Untreated','FAIR','Type is FAIR because of the first WO for the CRN','prn1',0,0,'','','0000-00-00',0,0,'N',NULL,'bvnxfgchd','dgsfg',NULL,'',5,0,0,0,0,'',0,NULL,NULL,'FSI'),(31536,'31470','','xyz','CUSTPO-002',NULL,'Open','Create Wo',134,NULL,NULL,NULL,'2017-05-03','0000-00-00','','2017-11-24',NULL,NULL,NULL,'2017-11-24','0000-00-00','',NULL,'','','','',7049,'g3','5',NULL,'0000-00-00',10,'3434',0,'555','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',2307,'0000-00-00','',0,'1','Untreated','FAIR','Type is FAIR because of the first WO for the CRN','prn3',0,0,'','','0000-00-00',0,0,'0',NULL,'RMS 3','RMT 3',NULL,NULL,0,0,0,0,0,'',0,NULL,NULL,'FSI'),(31537,'31471','','xyz','CUSTPO-003',NULL,'Closed','Create Wo',127,NULL,NULL,NULL,'2016-10-18','2017-11-24','','2017-11-24','2017-11-24 11:52:04',NULL,NULL,'2017-11-30','0000-00-00','',NULL,'','','','',7054,'g8','5',NULL,'0000-00-00',100,'2343',5,'576','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',2312,'0000-00-00','',0,'1','Treated','FAIR','Type is FAIR because of the first WO for the CRN','prn8',0,0,'','','0000-00-00',0,0,'N',NULL,'RMS 8','RMT 8',NULL,'',5,0,0,0,0,'',0,NULL,'DN11875','FSI'),(31538,'31472','','xyz','CUSTPO-001',NULL,'Closed','Create Wo',127,NULL,NULL,NULL,'2017-06-15','2017-11-30','','2017-11-24','2017-11-24 12:04:03',NULL,NULL,'2017-11-27','0000-00-00','',NULL,'','','','',7047,'RMK-GRN-001','5',NULL,'0000-00-00',95,'121',5,'dfg4636','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',2305,'0000-00-00','',0,'1','Untreated','PRODUCTION','Production WO','prn1',0,0,'','','0000-00-00',0,0,'N',NULL,'bvnxfgchd','dgsfg','A02619','',0,0,0,0,2,'',0,NULL,NULL,'FSI'),(31539,'31473','','xyz','CUSTPO-003',NULL,'Closed','Create Wo',127,NULL,NULL,NULL,'2016-10-18','2017-11-29','','2017-11-24','2017-11-24 12:08:08',NULL,NULL,'2017-11-27','0000-00-00','',NULL,'','','','',7054,'g8','2',NULL,'0000-00-00',95,'2343',2,'576','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',2312,'0000-00-00','',0,'1','Treated','PRODUCTION','Production WO','prn8',0,0,'','','0000-00-00',0,0,'N',NULL,'RMS 8','RMT 8',NULL,'',0,0,0,0,0,'',0,NULL,'DN11876','FSI'),(31540,'31474','','xyz','CUSTPO-004',NULL,'Closed','Create Wo',127,NULL,NULL,NULL,'2016-11-08','2017-11-24','','2017-11-24','2017-11-24 12:28:33',NULL,NULL,'2017-11-23','0000-00-00','',NULL,'','','','',7052,'g6','2',NULL,'0000-00-00',10,'54543',2,'3455','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',2310,'0000-00-00','',0,'1','Treated','FAIR','Type is FAIR because of the first WO for the CRN','prn6',0,0,'','','0000-00-00',0,0,'N',NULL,'RMS 6','RMT 6',NULL,'',0,0,0,0,0,'',0,NULL,'DN11877','FSI'),(31541,'31475','','xyz','CUSTPO-005',NULL,'Open','Create Wo',127,NULL,NULL,NULL,'2017-08-23','0000-00-00','','2017-11-24',NULL,NULL,NULL,'2017-11-24','0000-00-00','',NULL,'','','','',7050,'G0004','1',NULL,'0000-00-00',100,'435',0,'3545','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',2308,'0000-00-00','',0,'2','Treated','FAIR','Type is FAIR because of the first WO for the CRN','prn4',0,0,'','','0000-00-00',0,1,'0',NULL,'test','test',NULL,NULL,0,0,0,0,0,'',0,NULL,NULL,'FSI'),(31542,'31476','','xyz','CUSTPO-005',NULL,'Closed','Create Wo',127,NULL,NULL,NULL,'2017-08-23','2017-11-24','','2017-11-24','2017-11-24 14:50:56',NULL,NULL,'2017-11-15','0000-00-00','',NULL,'','','','',7050,'G0004','1',NULL,'0000-00-00',99,'435',1,'3545','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',2308,'0000-00-00','',0,'2','Treated','PRODUCTION','Production WO','prn4',0,0,'','','0000-00-00',0,0,'N',NULL,'test','test',NULL,'',0,0,0,0,0,'',0,NULL,'DN11878','FSI'),(31543,'31477','','xyz','KAR-001',NULL,'Closed','test',172,NULL,NULL,NULL,'2017-12-05','2017-12-05','','2017-12-05','2017-12-05 12:19:14',NULL,NULL,'2017-12-05','0000-00-00','',NULL,'','','','',7058,'kar00001','1',NULL,'2017-12-04',100,'flu 00 100',1,'10001','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',2316,'0000-00-00','',0,'1','Untreated','FAIR','Type is FAIR because of the first WO for the CRN','flu-001',0,0,'','','0000-00-00',0,0,'N',NULL,'raw spec','raw type','','',0,0,0,0,0,'',0,NULL,NULL,'FSI'),(31544,'31478','','xyz','CUSTPO-004',NULL,'Open','Enquiry',127,NULL,NULL,NULL,'2016-11-08','0000-00-00','','2017-12-21',NULL,NULL,NULL,'2017-12-21','0000-00-00','',NULL,'','','','',7052,'g6','1',NULL,'2017-11-23',8,'54543',0,'3455','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',2310,'0000-00-00','',0,'1','Treated','PRODUCTION','Production WO','prn6',0,0,'','','0000-00-00',0,0,'0',NULL,'RMS 6','RMT 6',NULL,NULL,0,0,0,0,0,'',0,NULL,NULL,'FSI');
/*!40000 ALTER TABLE `work_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-02 15:42:45

-- MySQL dump 10.13  Distrib 5.1.30, for Win32 (ia32)
--
-- Host: localhost    Database: fluentwms
-- ------------------------------------------------------
-- Server version	5.1.30-community

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `last_modified_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `activeusers_log` (
  `userid` varchar(8) DEFAULT NULL,
  `session` varchar(50) DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `activity` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `address` (
  `recnum` int(11) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `zipcode` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `adv_lic` (
  `adv_license` varchar(50) DEFAULT NULL,
  `lic_date` date DEFAULT NULL,
  `recnum` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `allot_crn` (
  `recnum` int(11) DEFAULT NULL,
  `refnum` varchar(20) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `partname` varchar(30) DEFAULT NULL,
  `attachments` varchar(50) DEFAULT NULL,
  `drg_issue` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `amendment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amendment` text,
  `cr_date` date DEFAULT NULL,
  `link2so` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `app_license` (
  `recnum` int(11) DEFAULT NULL,
  `app_name` varchar(100) DEFAULT NULL,
  `maxlicense_num` int(11) DEFAULT NULL,
  `license_reg` varchar(100) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `app_license`
--

LOCK TABLES `app_license` WRITE;
/*!40000 ALTER TABLE `app_license` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_license` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assy_part_status`
--

DROP TABLE IF EXISTS `assy_part_status`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `assy_part_status`
--

LOCK TABLES `assy_part_status` WRITE;
/*!40000 ALTER TABLE `assy_part_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `assy_part_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assy_processdetails`
--

DROP TABLE IF EXISTS `assy_processdetails`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `assy_review`
--

LOCK TABLES `assy_review` WRITE;
/*!40000 ALTER TABLE `assy_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `assy_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assy_review_li`
--

DROP TABLE IF EXISTS `assy_review_li`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `assy_review_li`
--

LOCK TABLES `assy_review_li` WRITE;
/*!40000 ALTER TABLE `assy_review_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `assy_review_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assy_wo`
--

DROP TABLE IF EXISTS `assy_wo`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `kit_qty` int(10) unsigned DEFAULT NULL,
  `rework_grn` varchar(45) DEFAULT NULL,
  `rej_qty` int(11) DEFAULT '0',
  `ret_qty` int(11) DEFAULT '0',
  `cust_rej_qty` int(11) DEFAULT '0',
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `assy_wo`
--

LOCK TABLES `assy_wo` WRITE;
/*!40000 ALTER TABLE `assy_wo` DISABLE KEYS */;
/*!40000 ALTER TABLE `assy_wo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assypo`
--

DROP TABLE IF EXISTS `assypo`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `assypo`
--

LOCK TABLES `assypo` WRITE;
/*!40000 ALTER TABLE `assypo` DISABLE KEYS */;
/*!40000 ALTER TABLE `assypo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assypo_line_items`
--

DROP TABLE IF EXISTS `assypo_line_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `assypo_line_items`
--

LOCK TABLES `assypo_line_items` WRITE;
/*!40000 ALTER TABLE `assypo_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `assypo_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assywo_li`
--

DROP TABLE IF EXISTS `assywo_li`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`),
  KEY `ali_grn` (`grn`)
) ENGINE=MyISAM AUTO_INCREMENT=10962 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `assywo_li`
--

LOCK TABLES `assywo_li` WRITE;
/*!40000 ALTER TABLE `assywo_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `assywo_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom`
--

DROP TABLE IF EXISTS `bom`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bom`
--

LOCK TABLES `bom` WRITE;
/*!40000 ALTER TABLE `bom` DISABLE KEYS */;
/*!40000 ALTER TABLE `bom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_bought_items`
--

DROP TABLE IF EXISTS `bom_bought_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bom_bought_items`
--

LOCK TABLES `bom_bought_items` WRITE;
/*!40000 ALTER TABLE `bom_bought_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `bom_bought_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_consume`
--

DROP TABLE IF EXISTS `bom_consume`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bom_consume`
--

LOCK TABLES `bom_consume` WRITE;
/*!40000 ALTER TABLE `bom_consume` DISABLE KEYS */;
/*!40000 ALTER TABLE `bom_consume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_mfg_items`
--

DROP TABLE IF EXISTS `bom_mfg_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bom_mfg_items`
--

LOCK TABLES `bom_mfg_items` WRITE;
/*!40000 ALTER TABLE `bom_mfg_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `bom_mfg_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_notes`
--

DROP TABLE IF EXISTS `bom_notes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bom_notes` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `notes` longtext,
  `notes2user` varchar(50) DEFAULT NULL,
  `notes2bom` int(11) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bom_notes`
--

LOCK TABLES `bom_notes` WRITE;
/*!40000 ALTER TABLE `bom_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `bom_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bom_op_desc`
--

DROP TABLE IF EXISTS `bom_op_desc`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bom_subassy_items`
--

LOCK TABLES `bom_subassy_items` WRITE;
/*!40000 ALTER TABLE `bom_subassy_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `bom_subassy_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookmark`
--

DROP TABLE IF EXISTS `bookmark`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bookmark` (
  `recnum` int(11) DEFAULT NULL,
  `bookmarknum` varchar(100) DEFAULT NULL,
  `notes` longtext,
  `link2wo` int(11) DEFAULT NULL,
  `link2user` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `capacity_plan` (
  `recnum` int(11) DEFAULT NULL,
  `machineid` varchar(20) DEFAULT NULL,
  `av_cap` varchar(20) DEFAULT NULL,
  `used_cap` varchar(20) DEFAULT NULL,
  `unused_cap` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cofc`
--

LOCK TABLES `cofc` WRITE;
/*!40000 ALTER TABLE `cofc` DISABLE KEYS */;
INSERT INTO `cofc` VALUES (1,'','','','','','','','','','','','2','5','','','','','0000-00-00','','','','',15286);
/*!40000 ALTER TABLE `cofc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `ind_recnum` (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'FSI','FLUENT','HOST','','','','','','','','',0,'','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active',NULL,NULL,NULL,1),(2,'A1','SUPP1','VEND','','','','','supp1@ft.com','','','',0,'Aerospace','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2014-01-23',NULL,NULL,NULL),(126,'A126','CUST1','CUST','','','','','cust1@ft.com','','','',0,'Aerospace','','','','','','','','','','','','','','','','','','','',NULL,NULL,NULL,'Active','2014-01-23',NULL,NULL,NULL);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competitor`
--

DROP TABLE IF EXISTS `competitor`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `zip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `competitor`
--

LOCK TABLES `competitor` WRITE;
/*!40000 ALTER TABLE `competitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `competitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumption`
--

DROP TABLE IF EXISTS `consumption`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `consumption`
--

LOCK TABLES `consumption` WRITE;
/*!40000 ALTER TABLE `consumption` DISABLE KEYS */;
INSERT INTO `consumption` VALUES (48341,'I1','G1','2014-01-21',NULL,'RMS1  (1000X1X1) Regular',1,NULL,'2014-01-23',NULL,'PRN1',NULL,NULL,'2014-01-21',NULL,NULL,NULL,NULL,'SUPP1','RMT','Meters',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `consumption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `last_modified_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (26,'C26','Mr.','b','m','RU','','','bm@ft.com','','','','','','',126,'Active','2016-03-10',NULL);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_enquiry`
--

DROP TABLE IF EXISTS `contract_enquiry`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `formrev` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `contract_enquiry`
--

LOCK TABLES `contract_enquiry` WRITE;
/*!40000 ALTER TABLE `contract_enquiry` DISABLE KEYS */;
/*!40000 ALTER TABLE `contract_enquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_review`
--

DROP TABLE IF EXISTS `contract_review`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `contract_review`
--

LOCK TABLES `contract_review` WRITE;
/*!40000 ALTER TABLE `contract_review` DISABLE KEYS */;
INSERT INTO `contract_review` VALUES (3198,'3198','','','0000-00-00','','','','','',NULL,'','','','','','','','','','','','John','','','','','','','','','','','0000-00-00','0000-00-00','','','','F3003-Rev No.:1','','0000-00-00','','','NO','2014-01-21','','','','','','','');
/*!40000 ALTER TABLE `contract_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crn_mc`
--

DROP TABLE IF EXISTS `crn_mc`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `crn_mc`
--

LOCK TABLES `crn_mc` WRITE;
/*!40000 ALTER TABLE `crn_mc` DISABLE KEYS */;
INSERT INTO `crn_mc` VALUES (17,'BMV 60-1','BMV 60-1','B1','PRN1',4,'op1','2014-03-03','0000-00-00','Sales',NULL,'03','2014');
/*!40000 ALTER TABLE `crn_mc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cust_data_lineitems`
--

DROP TABLE IF EXISTS `cust_data_lineitems`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cust_data_validation`
--

LOCK TABLES `cust_data_validation` WRITE;
/*!40000 ALTER TABLE `cust_data_validation` DISABLE KEYS */;
/*!40000 ALTER TABLE `cust_data_validation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datasheet`
--

DROP TABLE IF EXISTS `datasheet`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `link2approvedbyowner` int(11) DEFAULT NULL,
  `link2approvedbycontact` int(11) DEFAULT NULL,
  `hold_date` date DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `condition` varchar(100) DEFAULT NULL,
  `dependency` varchar(30) DEFAULT NULL,
  `stagename` varchar(100) DEFAULT NULL,
  `stagenum` int(11) DEFAULT NULL,
  `dept` varchar(40) DEFAULT NULL,
  `stagedependency` varchar(30) DEFAULT NULL,
  KEY `ind_dates_link2wo` (`link2wo`),
  KEY `ind_date_stagenum` (`stagenum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dates`
--

LOCK TABLES `dates` WRITE;
/*!40000 ALTER TABLE `dates` DISABLE KEYS */;
INSERT INTO `dates` VALUES (285447,'','WO','0000-00-00',NULL,NULL,NULL,31418,31418,19,NULL,NULL,NULL,NULL,NULL,NULL,'NA','','Create WO',10,'PPC',''),(285448,'','WO','0000-00-00',NULL,NULL,NULL,31418,31418,24,NULL,NULL,NULL,NULL,NULL,NULL,'NA','10','Issue Qty',50,'Stores','10');
/*!40000 ALTER TABLE `dates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dd`
--

DROP TABLE IF EXISTS `dd`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `dn_crn` (`crn`),
  KEY `dn_wonum` (`wonum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `delivery_note`
--

LOCK TABLES `delivery_note` WRITE;
/*!40000 ALTER TABLE `delivery_note` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_note_li`
--

DROP TABLE IF EXISTS `delivery_note_li`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `dnli_link2delivery` (`link2delivery`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `delivery_note_li`
--

LOCK TABLES `delivery_note_li` WRITE;
/*!40000 ALTER TABLE `delivery_note_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_note_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_sch`
--

DROP TABLE IF EXISTS `delivery_sch`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `wo_issue_qty` int(11) DEFAULT NULL,
  `custcode` char(50) DEFAULT NULL,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=16560 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `delivery_sch`
--

LOCK TABLES `delivery_sch` WRITE;
/*!40000 ALTER TABLE `delivery_sch` DISABLE KEYS */;
INSERT INTO `delivery_sch` VALUES (16540,'PRN1','2014-01-09',6,'',0,'Open','',0,NULL,'A126'),(16541,'PRN1','2014-02-09',6,'',0,'Open','',0,NULL,'C2'),(16542,'PRN1','2014-02-17',6,'',0,'Open','',0,NULL,'C3'),(16543,'PRN1','2014-02-18',6,'',0,'Open','',0,NULL,'C4'),(16544,'PRN1','2014-02-25',6,'',0,'Open','',0,NULL,'C5'),(16545,'PRN1','2014-02-22',15,'',0,'Open','',0,NULL,'C6'),(16546,'PRN1','2014-03-27',6,'',0,'Open','',0,NULL,'C7'),(16547,'PRN1','2014-03-29',6,'',0,'Open','',0,NULL,'C8'),(16548,'PRN1','2014-03-17',6,'',0,'Open','',0,NULL,'C9'),(16549,'PRN1','2014-03-20',6,'',0,'Open','',0,NULL,'C10'),(16550,'PRN1','2014-01-24',6,'',0,'Open','',0,NULL,'C11'),(16551,'PRN1','2014-01-30',6,'',0,'Open','',0,NULL,'C12'),(16552,'PRN1','2014-02-06',6,'',0,'Open','',0,NULL,'C13'),(16553,'PRN1','2014-02-21',6,'',0,'Open','',0,NULL,'C14'),(16554,'PRN1','2014-02-24',6,'',0,'Open','',0,NULL,'C15'),(16555,'PRN1','2014-03-12',6,'',0,'Open','',0,NULL,'C16'),(16556,'PRN1','2014-03-25',6,'',0,'Open','',0,NULL,'C17'),(16557,'PRN1','2014-03-27',6,'',0,'Open','',0,NULL,'C18'),(16558,'PRN1','2014-04-16',6,'',0,'Open','',0,NULL,'c19'),(16559,'PRN1','2014-04-28',6,'',0,'Open','',0,NULL,'c20');
/*!40000 ALTER TABLE `delivery_sch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispatch`
--

DROP TABLE IF EXISTS `dispatch`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `ind_recnum` (`recnum`),
  KEY `dispatch_crn` (`crn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dispatch`
--

LOCK TABLES `dispatch` WRITE;
/*!40000 ALTER TABLE `dispatch` DISABLE KEYS */;
/*!40000 ALTER TABLE `dispatch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispatch_line_items`
--

DROP TABLE IF EXISTS `dispatch_line_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `dispatch_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `wonum` varchar(255) DEFAULT NULL,
  `partnum` varchar(255) DEFAULT NULL,
  `grnnum` varchar(100) DEFAULT NULL,
  `custpo_num` varchar(100) DEFAULT NULL,
  `custpo_qty` int(11) DEFAULT '0',
  `custpo_date` date DEFAULT NULL,
  `dispatch_qty` int(11) DEFAULT '0',
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
  KEY `ind_link2dispatch` (`link2dispatch`),
  KEY `ind_wonum` (`wonum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dispatch_line_items`
--

LOCK TABLES `dispatch_line_items` WRITE;
/*!40000 ALTER TABLE `dispatch_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `dispatch_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `empcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,NULL,NULL,'sa','sa','SA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'Active',NULL,NULL,NULL,NULL),(2,'E2','Mr.','Badari','Mandyam','SU','','','bmandyam@fluentsoft.com','','','','','','',1,'Active','2007-04-15',NULL,'Sales',NULL);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fair`
--

DROP TABLE IF EXISTS `fair`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `fair`
--

LOCK TABLES `fair` WRITE;
/*!40000 ALTER TABLE `fair` DISABLE KEYS */;
/*!40000 ALTER TABLE `fair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `final_insp_lineitems`
--

LOCK TABLES `final_insp_lineitems` WRITE;
/*!40000 ALTER TABLE `final_insp_lineitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `final_insp_lineitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `final_insp_report`
--

DROP TABLE IF EXISTS `final_insp_report`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `refnum` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `final_insp_report`
--

LOCK TABLES `final_insp_report` WRITE;
/*!40000 ALTER TABLE `final_insp_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `final_insp_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fitting`
--

DROP TABLE IF EXISTS `fitting`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `ind_grn_recnum` (`recnum`),
  KEY `ind_grn_crn` (`crn`),
  KEY `ind_grn_grn` (`grnnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `grn`
--

LOCK TABLES `grn` WRITE;
/*!40000 ALTER TABLE `grn` DISABLE KEYS */;
INSERT INTO `grn` VALUES (15286,NULL,NULL,NULL,'RMT','RMS1',NULL,NULL,NULL,NULL,NULL,'','','I1','2014-01-21','2014-01-21','','B1','',NULL,NULL,NULL,NULL,2,'G1','',NULL,NULL,'Y','','PO1','F7532','0','','','Regular','PRN1','Open','0000-00-00','0000-00-00','','0000-00-00','me','0000-00-00','me','2014-01-21',0,'$','','1','','','PRN1',NULL,NULL,NULL,1,1,0,0,'','Regular','',NULL,NULL,NULL,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `grn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grn_issue`
--

DROP TABLE IF EXISTS `grn_issue`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `grn_issue` (
  `recno` int(11) DEFAULT NULL,
  `iss_date` date DEFAULT NULL,
  `iss_qty` int(11) DEFAULT NULL,
  `iss4wo` varchar(20) DEFAULT NULL,
  `accqty` int(11) DEFAULT NULL,
  `rejqty` int(11) DEFAULT NULL,
  `retqty` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `link2grn` int(11) DEFAULT NULL,
  `line_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `grn_issue`
--

LOCK TABLES `grn_issue` WRITE;
/*!40000 ALTER TABLE `grn_issue` DISABLE KEYS */;
/*!40000 ALTER TABLE `grn_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grn_li`
--

DROP TABLE IF EXISTS `grn_li`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `grn_li`
--

LOCK TABLES `grn_li` WRITE;
/*!40000 ALTER TABLE `grn_li` DISABLE KEYS */;
INSERT INTO `grn_li` VALUES (18206,'1',1,'1000','1','1',NULL,1,'15286',0,1,'1.00','P1','','B1','Meters','0000-00-00',NULL,NULL,'','','',1);
/*!40000 ALTER TABLE `grn_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grn_notes`
--

DROP TABLE IF EXISTS `grn_notes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `grn_notes` (
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `link2grn` int(10) unsigned DEFAULT NULL,
  `link2user` varchar(50) DEFAULT NULL,
  `grnnotes` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `grn_notes`
--

LOCK TABLES `grn_notes` WRITE;
/*!40000 ALTER TABLE `grn_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `grn_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `inventory` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `ref_type` varchar(50) DEFAULT NULL,
  `ref_num` varchar(50) DEFAULT NULL,
  `link2vendpart` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `invoice` (
  `recnum` int(11) DEFAULT NULL,
  `invnum` varchar(100) DEFAULT NULL,
  `invdate` date DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `invdesc` varchar(100) DEFAULT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `shipping` float DEFAULT NULL,
  `salestax` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `inv2customer` int(11) DEFAULT NULL,
  `inv2invli` int(11) DEFAULT NULL,
  `customerponum` varchar(100) DEFAULT NULL,
  `totaldue` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_line_items`
--

DROP TABLE IF EXISTS `invoice_line_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `invoice_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `line_num` varchar(20) DEFAULT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `item_desc` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `um` int(11) DEFAULT NULL,
  `disc_perc` float DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `link2invoice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `invoice_line_items`
--

LOCK TABLES `invoice_line_items` WRITE;
/*!40000 ALTER TABLE `invoice_line_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_payment`
--

DROP TABLE IF EXISTS `invoice_payment`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `invoice_payment` (
  `recnum` int(11) DEFAULT NULL,
  `payment_amount` float DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `link2invoice` int(11) DEFAULT NULL,
  `ref_num` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `leads_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2leads` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `leads_notes`
--

LOCK TABLES `leads_notes` WRITE;
/*!40000 ALTER TABLE `leads_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `log` (
  `userid` varchar(8) DEFAULT NULL,
  `session` varchar(50) DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `activity` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES ('bmandyam','bmandyam','2014-01-21 21:55:28','Logged In'),('bmandyam','bmandyam','2014-01-22 10:09:41','Logged In'),('bmandyam','bmandyam','2014-01-22 10:40:48','Logged Out'),('sa','sa','2014-01-22 10:41:04','Logged In'),('sa','sa','2014-01-22 11:23:35','Logged Out'),('bmandyam','bmandyam','2014-01-22 11:33:45','Logged In'),('bmandyam','bmandyam','2014-01-22 11:40:31','Logged Out'),('bmandyam','bmandyam','2014-01-22 11:49:15','Logged In'),('bmandyam','bmandyam','2014-01-22 15:42:22','Logged Out'),('bmandyam','bmandyam','2014-01-22 15:44:51','Logged In'),('bmandyam','bmandyam','2014-01-22 19:16:35','Logged Out'),('bmandyam','bmandyam','2014-01-22 22:18:17','Logged In'),('bmandyam','bmandyam','2014-01-23 09:37:00','Logged In'),('bmandyam','bmandyam','2014-01-23 12:38:01','Logged Out'),('bmandyam','bmandyam','2014-01-23 14:44:30','Logged In'),('bmandyam','bmandyam','2014-01-24 15:17:19','Logged In'),('bmandyam','bmandyam','2014-01-24 17:30:59','Logged In'),('bmandyam','bmandyam','2014-01-24 17:32:20','Logged In'),('bmandyam','bmandyam','2014-01-24 17:33:37','Logged In'),('bmandyam','bmandyam','2014-01-24 17:33:44','Logged Out'),('bmandyam','bmandyam','2014-01-28 18:19:34','Logged In'),('bmandyam','bmandyam','2014-01-28 19:27:43','Logged Out'),('bmandyam','bmandyam','2014-01-29 12:23:25','Logged In'),('bmandyam','bmandyam','2014-01-29 12:26:01','Logged Out'),('bmandyam','bmandyam','2014-01-29 12:27:48','Logged In'),('bmandyam','bmandyam','2014-01-29 17:52:55','Logged In'),('bmandyam','bmandyam','2014-02-04 15:18:09','Logged In'),('bmandyam','bmandyam','2014-02-04 19:16:20','Logged Out'),('bmandyam','bmandyam','2014-02-11 11:48:38','Logged In'),('bmandyam','bmandyam','2014-02-11 11:52:37','Logged Out'),('bmandyam','bmandyam','2014-02-12 11:56:43','Logged In'),('bmandyam','bmandyam','2014-02-13 11:21:05','Logged In'),('bmandyam','bmandyam','2014-02-13 11:25:27','Logged Out'),('bmandyam','bmandyam','2014-02-13 11:25:33','Logged In'),('bmandyam','bmandyam','2014-02-13 13:01:19','Logged In'),('bmandyam','bmandyam','2014-02-13 13:01:36','Logged In'),('accounts','accounts','2014-02-13 13:10:00','Logged Out'),('bmandyam','bmandyam','2014-02-13 15:20:20','Logged In'),('bmandyam','bmandyam','2014-02-19 15:22:06','Logged In'),('bmandyam','bmandyam','2014-02-19 16:17:05','Logged Out'),('bmandyam','bmandyam','2014-02-24 11:03:04','Logged In'),('bmandyam','bmandyam','2014-02-24 12:01:28','Logged Out'),('bmandyam','bmandyam','2014-02-24 12:30:04','Logged In'),('bmandyam','bmandyam','2014-02-24 12:42:31','Logged Out'),('bmandyam','bmandyam','2014-03-03 18:14:16','Logged In'),('bmandyam','bmandyam','2014-07-04 11:17:06','Logged In'),('bmandyam','bmandyam','2014-07-07 12:14:59','Logged In'),('bmandyam','bmandyam','2014-07-07 12:20:13','Logged Out'),('bmandyam','bmandyam','2014-07-07 12:20:26','Logged In'),('bmandyam','bmandyam','2014-07-28 10:04:50','Logged In'),('bmandyam','bmandyam','2014-07-28 10:05:10','Logged In'),('bmandyam','bmandyam','2014-07-28 11:58:06','Logged Out'),('bmandyam','bmandyam','2014-08-12 11:14:49','Logged In'),('bmandyam','bmandyam','2014-08-12 11:48:54','Logged Out'),('bmandyam','bmandyam','2014-08-12 11:49:46','Logged In'),('bmandyam','bmandyam','2014-08-12 14:50:29','Logged In'),('bmandyam','bmandyam','2014-08-12 15:33:58','Logged Out'),('bmandyam','bmandyam','2015-02-01 13:26:34','Logged In'),('bmandyam','bmandyam','2015-02-01 13:56:46','Logged Out'),('bmandyam','bmandyam','2015-02-02 10:28:32','Logged In'),('bmandyam','bmandyam','2015-02-11 10:22:13','Logged In'),('bmandyam','bmandyam','2015-02-11 11:14:05','Logged Out'),('bmandyam','bmandyam','2015-08-17 11:57:55','Logged In'),('bmandyam','bmandyam','2015-08-17 11:59:25','Logged Out'),('bmandyam','bmandyam','2015-08-18 11:00:35','Logged In'),('bmandyam','bmandyam','2015-08-18 15:07:25','Logged Out'),('bmandyam','bmandyam','2015-08-19 13:05:19','Logged In'),('bmandyam','bmandyam','2015-08-20 15:49:42','Logged In'),('bmandyam','bmandyam','2015-08-20 15:50:30','Logged Out'),('bmandyam','bmandyam','2015-08-20 15:50:37','Logged In'),('bmandyam','bmandyam','2015-08-20 16:19:17','Logged Out'),('bmandyam','bmandyam','2015-08-26 16:16:47','Logged In'),('bmandyam','bmandyam','2015-08-26 16:18:07','Logged Out'),('bmandyam','bmandyam','2015-08-27 10:39:37','Logged In'),('','','2015-08-27 11:23:06','Logged Out'),('bmandyam','bmandyam','2015-08-27 15:22:32','Logged In'),('','','2016-03-10 16:59:41','Logged Out'),('bmandyam','bmandyam','2016-03-10 17:02:24','Logged In'),('bmandyam','bmandyam','2016-03-10 17:04:39','Logged In'),('bmandyam','bmandyam','2016-04-06 12:18:32','Logged In'),('bmandyam','bmandyam','2016-04-06 12:33:53','Logged Out'),('bmandyam','bmandyam','2016-04-06 15:26:38','Logged In'),('bmandyam','bmandyam','2016-04-06 16:42:42','Logged Out'),('','','2016-05-03 15:31:11','Logged Out'),('bmandyam','bmandyam','2016-05-03 15:33:44','Logged In'),('bmandyam','bmandyam','2016-05-03 15:39:45','Logged Out');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_generic_limit`
--

DROP TABLE IF EXISTS `m_generic_limit`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `m_generic_limit` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `type_limit` int(11) DEFAULT NULL,
  `parent` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `m_pagefields` (
  `recnum` int(11) DEFAULT NULL,
  `seqnum` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `link2pname` int(11) DEFAULT NULL,
  `mandatory` char(1) DEFAULT NULL,
  `pgroup` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `m_pagefields`
--

LOCK TABLES `m_pagefields` WRITE;
/*!40000 ALTER TABLE `m_pagefields` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_pagefields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_pagename`
--

DROP TABLE IF EXISTS `m_pagename`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `m_pagename` (
  `recnum` int(11) DEFAULT NULL,
  `pname` varchar(100) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `parent` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `m_pagename`
--

LOCK TABLES `m_pagename` WRITE;
/*!40000 ALTER TABLE `m_pagename` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_pagename` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintain_machine`
--

DROP TABLE IF EXISTS `maintain_machine`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `maintain_machine` (
  `recnum` int(11) DEFAULT NULL,
  `machineid` varchar(20) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `task` varchar(20) DEFAULT NULL,
  `task_time` varchar(20) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `custname` (`customer`),
  KEY `mcrn` (`CIM_refnum`),
  KEY `ind_masterdata_partnum` (`partnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `master_data`
--

LOCK TABLES `master_data` WRITE;
/*!40000 ALTER TABLE `master_data` DISABLE KEYS */;
INSERT INTO `master_data` VALUES (1,'PARTNAME1',NULL,'ABC','PARTNUM1','','','','Y','PRN1','','','','','','','','MPS/PRN1','','','','','','','Active','','Manufacture','Active',NULL,'','2014-01-23','2014-01-23','','yes','0000-00-00','yes');
/*!40000 ALTER TABLE `master_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_line_items`
--

DROP TABLE IF EXISTS `master_line_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `master_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `opnnum` varchar(20) DEFAULT NULL,
  `opn_desc` varchar(50) DEFAULT NULL,
  `work_center` varchar(50) DEFAULT NULL,
  `opn_ref_no` varchar(50) DEFAULT NULL,
  `revnum` varchar(50) DEFAULT NULL,
  `link2master` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mc_capacity_master`
--

LOCK TABLES `mc_capacity_master` WRITE;
/*!40000 ALTER TABLE `mc_capacity_master` DISABLE KEYS */;
INSERT INTO `mc_capacity_master` VALUES (19,'BMV 60-1','BMV 60-1',100,'B1','2014-03-03','0000-00-00','Sales',NULL,'03','2014');
/*!40000 ALTER TABLE `mc_capacity_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mc_capacity_plan`
--

DROP TABLE IF EXISTS `mc_capacity_plan`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mc_capacity_plan`
--

LOCK TABLES `mc_capacity_plan` WRITE;
/*!40000 ALTER TABLE `mc_capacity_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `mc_capacity_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mc_master`
--

DROP TABLE IF EXISTS `mc_master`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mc_master`
--

LOCK TABLES `mc_master` WRITE;
/*!40000 ALTER TABLE `mc_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `mc_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mc_stage_master`
--

DROP TABLE IF EXISTS `mc_stage_master`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mechanical_properties_li`
--

LOCK TABLES `mechanical_properties_li` WRITE;
/*!40000 ALTER TABLE `mechanical_properties_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `mechanical_properties_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfg_order`
--

DROP TABLE IF EXISTS `mfg_order`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mfg_order` (
  `recnum` int(11) DEFAULT NULL,
  `mfg_id` varchar(50) DEFAULT NULL,
  `mfg_desc` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `link2company` int(11) DEFAULT NULL,
  `link2contact` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `milestone_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `link2dates` int(11) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mps`
--

LOCK TABLES `mps` WRITE;
/*!40000 ALTER TABLE `mps` DISABLE KEYS */;
INSERT INTO `mps` VALUES ('1','ALL','NA',1,1,'1','Active','2014-01-21');
/*!40000 ALTER TABLE `mps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtl_act_log`
--

DROP TABLE IF EXISTS `mtl_act_log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mtl_act_log` (
  `recnum` int(11) DEFAULT NULL,
  `ldate` date DEFAULT NULL,
  `userid` varchar(20) DEFAULT NULL,
  `usertype` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `link2mtltrk` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mtl_act_log`
--

LOCK TABLES `mtl_act_log` WRITE;
/*!40000 ALTER TABLE `mtl_act_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `mtl_act_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtl_tracker`
--

DROP TABLE IF EXISTS `mtl_tracker`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mtl_tracker` (
  `recnum` int(11) DEFAULT NULL,
  `ponum` varchar(20) DEFAULT NULL,
  `vendor_name` varchar(30) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `adv_license_qty` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mtl_tracker`
--

LOCK TABLES `mtl_tracker` WRITE;
/*!40000 ALTER TABLE `mtl_tracker` DISABLE KEYS */;
INSERT INTO `mtl_tracker` VALUES (10073,'PO1','2','RMT',NULL,0);
/*!40000 ALTER TABLE `mtl_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtl_tracker_li`
--

DROP TABLE IF EXISTS `mtl_tracker_li`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `boe_num` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mtm_leads_opportunity` (
  `leads_recnum` int(11) DEFAULT NULL,
  `opportunity_recnum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `mtm_leads_opportunity`
--

LOCK TABLES `mtm_leads_opportunity` WRITE;
/*!40000 ALTER TABLE `mtm_leads_opportunity` DISABLE KEYS */;
/*!40000 ALTER TABLE `mtm_leads_opportunity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mtm_po_wo`
--

DROP TABLE IF EXISTS `mtm_po_wo`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mtm_po_wo` (
  `po_recnum` int(11) DEFAULT NULL,
  `wo_recnum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `mtm_wo_grn` (
  `wo` char(20) DEFAULT NULL,
  `grn` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `ind_nc4qa_wonum` (`wonum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `nc4qa`
--

LOCK TABLES `nc4qa` WRITE;
/*!40000 ALTER TABLE `nc4qa` DISABLE KEYS */;
/*!40000 ALTER TABLE `nc4qa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nc4stores`
--

DROP TABLE IF EXISTS `nc4stores`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `nc4stores`
--

LOCK TABLES `nc4stores` WRITE;
/*!40000 ALTER TABLE `nc4stores` DISABLE KEYS */;
/*!40000 ALTER TABLE `nc4stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ncforstores`
--

DROP TABLE IF EXISTS `ncforstores`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ncqa`
--

LOCK TABLES `ncqa` WRITE;
/*!40000 ALTER TABLE `ncqa` DISABLE KEYS */;
/*!40000 ALTER TABLE `ncqa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2wo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `oper_mc_usage`
--

LOCK TABLES `oper_mc_usage` WRITE;
/*!40000 ALTER TABLE `oper_mc_usage` DISABLE KEYS */;
/*!40000 ALTER TABLE `oper_mc_usage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operation`
--

DROP TABLE IF EXISTS `operation`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recnum`),
  KEY `opcrn` (`crn`),
  KEY `opwonumm` (`wo_num`),
  KEY `ind_opername` (`oper_name`),
  KEY `ind_mc_name` (`mc_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `operator`
--

LOCK TABLES `operator` WRITE;
/*!40000 ALTER TABLE `operator` DISABLE KEYS */;
/*!40000 ALTER TABLE `operator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opportunity_notes`
--

DROP TABLE IF EXISTS `opportunity_notes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `opportunity_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2opportunity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `opportunity_notes`
--

LOCK TABLES `opportunity_notes` WRITE;
/*!40000 ALTER TABLE `opportunity_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `opportunity_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part_bom`
--

DROP TABLE IF EXISTS `part_bom`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `part_bom` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `part_unit` varchar(20) DEFAULT NULL,
  `rm_spec` varchar(20) DEFAULT NULL,
  `req_rm_qty` int(11) DEFAULT NULL,
  `rm_units` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `partwise_req`
--

LOCK TABLES `partwise_req` WRITE;
/*!40000 ALTER TABLE `partwise_req` DISABLE KEYS */;
/*!40000 ALTER TABLE `partwise_req` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po`
--

DROP TABLE IF EXISTS `po`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `po`
--

LOCK TABLES `po` WRITE;
/*!40000 ALTER TABLE `po` DISABLE KEYS */;
INSERT INTO `po` VALUES (1007,'PO1','2014-01-21','Test','',NULL,NULL,NULL,NULL,'0.00','Open','',2,'2014-01-23',NULL,'0.00','0.00','0.00','0.00','$','F7003-S','Rev 0','','yes','2014-01-23','','0000-00-00',' \r\n',0,'Regular');
/*!40000 ALTER TABLE `po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po_line_items`
--

DROP TABLE IF EXISTS `po_line_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `ind_link2po` (`link2po`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `po_line_items`
--

LOCK TABLES `po_line_items` WRITE;
/*!40000 ALTER TABLE `po_line_items` DISABLE KEYS */;
INSERT INTO `po_line_items` VALUES (10073,'1','','',NULL,'0000-00-00','100.00','0.00',NULL,NULL,1007,'2014-01-23',NULL,'RMT','RMS','100','100','100',NULL,0,'SEA','MM','',0,'0000-00-00','','PRN1','',0,0,'1.00','','Primary Spec','',0,'Open','','','0000-00-00','0000-00-00');
/*!40000 ALTER TABLE `po_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proc_deviation`
--

DROP TABLE IF EXISTS `proc_deviation`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `proc_deviation_li` (
  `recnum` int(11) DEFAULT NULL,
  `sl_num` varchar(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `signature` varchar(50) DEFAULT NULL,
  `link2procdev` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `process_details` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(20) DEFAULT NULL,
  `part_tasks` varchar(20) DEFAULT NULL,
  `mfg_cycle_time` varchar(20) DEFAULT NULL,
  `inspection_time` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `production_sch` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `est_start_date` date DEFAULT NULL,
  `crnnum` varchar(30) DEFAULT NULL,
  `book_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `production_sch`
--

LOCK TABLES `production_sch` WRITE;
/*!40000 ALTER TABLE `production_sch` DISABLE KEYS */;
/*!40000 ALTER TABLE `production_sch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchasing_alloc`
--

DROP TABLE IF EXISTS `purchasing_alloc`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `quality_plan_line_items` (
  `recnum` int(11) DEFAULT NULL,
  `sl_num` varchar(20) DEFAULT NULL,
  `drawing_dim` varchar(50) DEFAULT NULL,
  `measuring_istrument` varchar(50) DEFAULT NULL,
  `samplesize` varchar(50) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `link2qualityplan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `total_due` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `quote`
--

LOCK TABLES `quote` WRITE;
/*!40000 ALTER TABLE `quote` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_li`
--

DROP TABLE IF EXISTS `quote_li`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `quote_li` (
  `recnum` int(11) DEFAULT NULL,
  `item` varchar(20) DEFAULT NULL,
  `item_desc` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `link2quote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `quote_li`
--

LOCK TABLES `quote_li` WRITE;
/*!40000 ALTER TABLE `quote_li` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_li` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review_line_items`
--

DROP TABLE IF EXISTS `review_line_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rfq` (
  `recnum` int(11) DEFAULT NULL,
  `rfqid` varchar(50) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rma_items` (
  `recnum` int(11) DEFAULT NULL,
  `partnum` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `link2rma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rmm_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` text,
  `create_date` date DEFAULT NULL,
  `notes2rmm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rmm_notes`
--

LOCK TABLES `rmm_notes` WRITE;
/*!40000 ALTER TABLE `rmm_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `rmm_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rmmaster`
--

DROP TABLE IF EXISTS `rmmaster`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `rmm_crnnum` (`crnnum`),
  KEY `rmm_status` (`rm_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rmmaster`
--

LOCK TABLES `rmmaster` WRITE;
/*!40000 ALTER TABLE `rmmaster` DISABLE KEYS */;
INSERT INTO `rmmaster` VALUES (1,'PRN1','','RMT','RMS','','100','100','100','100','','','MM','','','','1','','100','SUPP1','Primary Spec',2,'Active','2014-01-23','2014-01-23','','yes','yes','bmandyam','','2014-01-23','2014-01-23','$','Plates');
/*!40000 ALTER TABLE `rmmaster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_leads`
--

DROP TABLE IF EXISTS `sales_leads`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `oppnum` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `sales_leads`
--

LOCK TABLES `sales_leads` WRITE;
/*!40000 ALTER TABLE `sales_leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_opportunity`
--

DROP TABLE IF EXISTS `sales_opportunity`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `oppnum` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `sales_opportunity`
--

LOCK TABLES `sales_opportunity` WRITE;
/*!40000 ALTER TABLE `sales_opportunity` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_opportunity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_order`
--

DROP TABLE IF EXISTS `sales_order`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `sales_order` (
  `recnum` int(11) DEFAULT NULL,
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
  KEY `wpo` (`po_num`),
  KEY `ind_so2cust` (`so2customer`),
  KEY `ind_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `sales_order`
--

LOCK TABLES `sales_order` WRITE;
/*!40000 ALTER TABLE `sales_order` DISABLE KEYS */;
INSERT INTO `sales_order` VALUES (1371,126,0,0,'','','2014-01-21','0000-00-00','TEST','5551212','john@ft.com','','','','','','Q1','CPO1',100,0,0,0,100,'Open','$','','0000-00-00','','','John',3198,100,0,'0','F3003','Rev 1 dt Jul 10,2009','2014-01-21',NULL);
/*!40000 ALTER TABLE `sales_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seqnum`
--

DROP TABLE IF EXISTS `seqnum`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `seqnum` (
  `nxtnum` int(11) DEFAULT NULL,
  `tablename` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `seqnum`
--

LOCK TABLES `seqnum` WRITE;
/*!40000 ALTER TABLE `seqnum` DISABLE KEYS */;
INSERT INTO `seqnum` VALUES (8,'shipment'),(0,'activeusers_log'),(0,'address'),(0,'app_license'),(0,'bookmark'),(126,'company'),(26,'contact'),(285448,'dates'),(0,'eco'),(224,'employee'),(0,'inventory'),(0,'log'),(1,'mfg_order'),(0,'mtm_po_wo'),(50,'notes'),(0,'part_master'),(0,'part_used'),(1007,'po'),(10073,'po_line_items'),(32,'quote'),(34,'quote_li'),(0,'rfq'),(0,'rma'),(0,'rma_items'),(0,'seqnum'),(0,'serv_req'),(0,'solution'),(0,'srtype'),(0,'support'),(0,'support_notes'),(0,'tran_license'),(55,'user'),(82,'vend_part_master'),(13,'work_flow_config'),(31418,'work_order'),(4,'m_pagename'),(10,'m_pagefields'),(160,'generic_wo'),(0,'generic_quote'),(2,'sales_leads'),(1,'sales_opportunity'),(1371,'sales_order'),(6998,'so_line_items'),(0,'account'),(0,'leads_notes'),(0,'opportunity_notes'),(0,'mtm_leads_opportunity'),(1,'mfg_order'),(8,'shipment'),(1,'invoice'),(2,'invoice_line_items'),(0,'invoice_payment'),(1,'email'),(5,'tasklist'),(0,'tasklist_time'),(0,'wo_attachment'),(0,'task_notes'),(33,'milestone_notes'),(9,'dwf_stage_field'),(2,'master'),(9,'master_line_items'),(2,'datasheet'),(2,'datasheet_line_items'),(3,'quality_plan'),(4,'quality_plan_line_items'),(3,'cust_data_validation'),(6,'cust_data_lineitems'),(40,'mm'),(2,'contract_enquiry'),(3198,'contract_review'),(3,'proc_deviation'),(3,'proc_deviation_li'),(4,'feedback'),(4,'test_report'),(7,'chemical_composition_li'),(5,'mechanical_properties_li'),(37,'fid'),(56,'irm'),(1005,'stage_insp'),(15,'stage_insp_report'),(12,'stage_insp_lineitems'),(9,'final_insp_report'),(8,'final_insp_lineitems'),(7028,'master_data'),(18,'dd'),(6369,'nc4qa'),(6,'standard'),(7,'allot_crn'),(15286,'grn'),(5,'mdm'),(3,'ncforstores'),(0,'production_sch'),(7,'maintain_machine'),(6,'process_details'),(4,'partwise_req'),(5,'production_plan'),(579,'mtl_tracker_li'),(1314,'mtl_act_log'),(2,'part_bom'),(3,'capacity_plan'),(18206,'grn_li'),(3009,'rmmaster'),(31352,'wonum'),(27275,'dispatch'),(39638,'dispatch_line_items'),(15,'accp_rating'),(454,'purchasing_alloc'),(5,'advlic'),(52,'advlic_li'),(2293,'mps'),(214,'assypo'),(2052,'assypo_line_items'),(11793,'delivery_note'),(12992,'delivery_note_li'),(270,'bom'),(403,'bom_mfg_items'),(400,'bom_bought_items'),(285,'bom_consume'),(27,'assy_review'),(1041,'assy_review_li'),(2504,'assywo'),(91,'bom_op_desc'),(998,'spmaster'),(60,'bom_subassy_items'),(48341,'consumption');
/*!40000 ALTER TABLE `seqnum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serv_req`
--

DROP TABLE IF EXISTS `serv_req`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `shipment`
--

LOCK TABLES `shipment` WRITE;
/*!40000 ALTER TABLE `shipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `so_line_items`
--

DROP TABLE IF EXISTS `so_line_items`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `so_line_items` (
  `recnum` int(11) DEFAULT NULL,
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
  KEY `ind_soli_partnum` (`partnum`),
  KEY `ind_link2so` (`link2so`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `so_line_items`
--

LOCK TABLES `so_line_items` WRITE;
/*!40000 ALTER TABLE `so_line_items` DISABLE KEYS */;
INSERT INTO `so_line_items` VALUES (6998,'1','PARTNAME1','PARTNUM1','RMT','RMS','A','A',1,100,100,1371,100,100,0,0,NULL,NULL,'',NULL,'A',NULL,NULL,'MM','100','100','100','100','','','Primary Spec','A','PRN1','','CPO1');
/*!40000 ALTER TABLE `so_line_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solution`
--

DROP TABLE IF EXISTS `solution`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `spmaster`
--

LOCK TABLES `spmaster` WRITE;
/*!40000 ALTER TABLE `spmaster` DISABLE KEYS */;
/*!40000 ALTER TABLE `spmaster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `srtype`
--

DROP TABLE IF EXISTS `srtype`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `srtype` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `standard` (
  `recnum` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `standard`
--

LOCK TABLES `standard` WRITE;
/*!40000 ALTER TABLE `standard` DISABLE KEYS */;
/*!40000 ALTER TABLE `standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `support_notes` (
  `recnum` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2support` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `support_notes`
--

LOCK TABLES `support_notes` WRITE;
/*!40000 ALTER TABLE `support_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_notes`
--

DROP TABLE IF EXISTS `task_notes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `task_notes` (
  `recnum` int(11) DEFAULT NULL,
  `notes` longtext,
  `create_date` date DEFAULT NULL,
  `notes2user` int(11) DEFAULT NULL,
  `notes2task` int(11) DEFAULT NULL,
  `task` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tasklist_time` (
  `recnum` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tasklist_time`
--

LOCK TABLES `tasklist_time` WRITE;
/*!40000 ALTER TABLE `tasklist_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasklist_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_report`
--

DROP TABLE IF EXISTS `test_report`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `test_report`
--

LOCK TABLES `test_report` WRITE;
/*!40000 ALTER TABLE `test_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tran_license`
--

DROP TABLE IF EXISTS `tran_license`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tran_license` (
  `recnum` int(11) DEFAULT NULL,
  `app_name` varchar(100) DEFAULT NULL,
  `license_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `last_modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,NULL,'sa','c12e01f2a13ff5587e1e9e4aedb8242d','EMPL',NULL,'1','Active',NULL,NULL),(2,'bm','bmandyam','912ba4afb3fd7e197799758a322b07e4','EMPL',NULL,'2','Active','2007-04-15',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vend_part_master`
--

DROP TABLE IF EXISTS `vend_part_master`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `drg_iss` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `vend_part_master`
--

LOCK TABLES `vend_part_master` WRITE;
/*!40000 ALTER TABLE `vend_part_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `vend_part_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wo_attachment`
--

DROP TABLE IF EXISTS `wo_attachment`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `wo_attachment` (
  `recnum` int(11) DEFAULT NULL,
  `filename1` varchar(255) DEFAULT NULL,
  `filename2` varchar(255) DEFAULT NULL,
  `filename3` varchar(255) DEFAULT NULL,
  `filename4` varchar(255) DEFAULT NULL,
  `link2wo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

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
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  PRIMARY KEY (`recno`),
  KEY `ind_wps2wo` (`link2wo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `wo_part_status`
--

LOCK TABLES `wo_part_status` WRITE;
/*!40000 ALTER TABLE `wo_part_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `wo_part_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wonotes`
--

DROP TABLE IF EXISTS `wonotes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `wonotes` (
  `recnum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` date DEFAULT NULL,
  `link2wo` int(10) unsigned DEFAULT NULL,
  `link2user` varchar(45) DEFAULT NULL,
  `wonotes` text,
  PRIMARY KEY (`recnum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `wonotes`
--

LOCK TABLES `wonotes` WRITE;
/*!40000 ALTER TABLE `wonotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `wonotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_flow_config`
--

DROP TABLE IF EXISTS `work_flow_config`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  `est_time` int(11) DEFAULT NULL,
  `est_cost` float DEFAULT NULL,
  `act_status` varchar(10) DEFAULT NULL,
  `dependency` varchar(30) DEFAULT NULL,
  `approval` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `work_flow_config`
--

LOCK TABLES `work_flow_config` WRITE;
/*!40000 ALTER TABLE `work_flow_config` DISABLE KEYS */;
INSERT INTO `work_flow_config` VALUES (19,10,'Aerowings','PPC','WO','Create WO','SU','I','SU','N','Y','N','1999-04-30',NULL,NULL,NULL,'Receive PO Requirements',1,1,'Active','',NULL),(24,50,'Aerowings','Stores','WO','Issue Qty','SU','I','SU','Y','Y','N','2007-10-18',NULL,NULL,NULL,'Accept_WO',1,1,'Active','10',NULL);
/*!40000 ALTER TABLE `work_flow_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_order`
--

DROP TABLE IF EXISTS `work_order`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
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
  KEY `wpo` (`po_num`),
  KEY `ind_wonum` (`wonum`),
  KEY `ind_l2m` (`link2masterdata`),
  KEY `ind_wo_grn` (`grnnum`),
  KEY `ind_wo_recnum` (`recnum`),
  KEY `ind_wo2customer` (`wo2customer`),
  KEY `ind_crn` (`crn_num`),
  KEY `ind_wo_condition` (`condition`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `work_order`
--

LOCK TABLES `work_order` WRITE;
/*!40000 ALTER TABLE `work_order` DISABLE KEYS */;
INSERT INTO `work_order` VALUES (31418,'31352','','xyz','CPO1',NULL,'Open','Create WO',126,NULL,NULL,NULL,'2014-01-09','0000-00-00','','2014-01-23',NULL,NULL,NULL,'2014-01-21','0000-00-00','',NULL,'','','','',1,'G1','1',NULL,'2014-01-21',1,'PARTNUM1',0,'B1','Regular','','F7000 Rev 07 dt October 16, 2012; Stages added to print','',1,'0000-00-00','',0,'1','','PRODUCTION','PRODUCTION','PRN1',0,0,'','','0000-00-00',0,1,'0',NULL,'RMS1','RMT',NULL,NULL,0,0,0,0,0,'',0,NULL);
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

-- Dump completed on 2016-06-23  9:48:12

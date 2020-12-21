CREATE DATABASE  IF NOT EXISTS `dbfastparking` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `dbfastparking`;
-- MySQL dump 10.13  Distrib 8.0.11, for Win64 (x86_64)
--
-- Host: localhost    Database: dbfastparking
-- ------------------------------------------------------
-- Server version	8.0.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tblestadia`
--

DROP TABLE IF EXISTS `tblestadia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tblestadia` (
  `idEstadia` int(11) NOT NULL AUTO_INCREMENT,
  `nomeDoCliente` varchar(200) NOT NULL,
  `placaDoVeiculo` varchar(20) NOT NULL,
  `dataDaEntrada` date NOT NULL,
  `horaDaEntrada` time NOT NULL,
  `dataDaSaida` date DEFAULT NULL,
  `horaDaSaida` time DEFAULT NULL,
  `pago` tinyint(4) NOT NULL,
  `valor` double DEFAULT NULL,
  PRIMARY KEY (`idEstadia`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblestadia`
--

LOCK TABLES `tblestadia` WRITE;
/*!40000 ALTER TABLE `tblestadia` DISABLE KEYS */;
INSERT INTO `tblestadia` VALUES (1,'Tuts Da Silva','TEST7T24','2020-12-14','14:20:30','2020-12-14','16:20:00',1,25.3),(2,'teste','OAA4555','2020-12-21','13:25:23',NULL,NULL,0,0),(3,'php','PHP3333','2020-12-21','16:36:17',NULL,NULL,0,0),(4,'css','CSS3333','2020-12-21','16:36:17',NULL,NULL,0,0),(5,'css','JSS3333','2020-12-21','16:36:17',NULL,NULL,0,0),(6,'css','TSS3333','2020-12-21','16:36:17',NULL,NULL,0,0),(7,'css','TCC3333','2020-12-21','16:36:17',NULL,NULL,0,0),(8,'css','LLL3333','2020-12-21','16:36:17',NULL,NULL,0,0);
/*!40000 ALTER TABLE `tblestadia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblprecos`
--

DROP TABLE IF EXISTS `tblprecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tblprecos` (
  `idPreco` int(11) NOT NULL AUTO_INCREMENT,
  `precoEntrada` double DEFAULT NULL,
  `precoAdicional` double DEFAULT NULL,
  PRIMARY KEY (`idPreco`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblprecos`
--

LOCK TABLES `tblprecos` WRITE;
/*!40000 ALTER TABLE `tblprecos` DISABLE KEYS */;
INSERT INTO `tblprecos` VALUES (1,13,8);
/*!40000 ALTER TABLE `tblprecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblusuarios`
--

DROP TABLE IF EXISTS `tblusuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tblusuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `statusUsuario` tinyint(4) NOT NULL,
  `nivelAcesso` int(11) NOT NULL,
  `foto` varchar(225) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblusuarios`
--

LOCK TABLES `tblusuarios` WRITE;
/*!40000 ALTER TABLE `tblusuarios` DISABLE KEYS */;
INSERT INTO `tblusuarios` VALUES (1,'gabriel','e8d95a51f3af4a3b134bf6bb680a213a',1,3,'771898e00a6898c6b625cd146ecf1f8a.jpg'),(2,'João Lucas','e8d95a51f3af4a3b134bf6bb680a213a',1,0,'db8e68851526c387bcd64364654bb2d9.png'),(3,'Adm','e8d95a51f3af4a3b134bf6bb680a213a',1,3,'noImage.png'),(4,'Entrada','e8d95a51f3af4a3b134bf6bb680a213a',1,1,'noImage.png'),(5,'Saida','e8d95a51f3af4a3b134bf6bb680a213a',1,2,'noImage.png'),(6,'Nenhum','e8d95a51f3af4a3b134bf6bb680a213a',1,0,'noImage.png');
/*!40000 ALTER TABLE `tblusuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-21 16:43:40

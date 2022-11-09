-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: epi
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

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
-- Table structure for table `equipamento`
--

DROP TABLE IF EXISTS `equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipamento` (
  `idequipamento` bigint NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  `un` varchar(10) DEFAULT NULL,
  `estoque` decimal(4,1) DEFAULT NULL,
  `minimo` decimal(4,1) DEFAULT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  `idusuario_exclusao` int DEFAULT NULL,
  PRIMARY KEY (`idequipamento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamento`
--

LOCK TABLES `equipamento` WRITE;
/*!40000 ALTER TABLE `equipamento` DISABLE KEYS */;
INSERT INTO `equipamento` VALUES (1,'Capacete','UN',13.0,10.0,NULL,NULL),(2,'Macacão','Un',13.0,15.0,NULL,NULL);
/*!40000 ALTER TABLE `equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item` (
  `sequencia` int NOT NULL AUTO_INCREMENT,
  `requisicao_idrequisicao` bigint NOT NULL,
  `equipamento_idequipamento` bigint NOT NULL,
  `qtd` decimal(4,1) DEFAULT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  `idusuario_exclusao` int DEFAULT NULL,
  PRIMARY KEY (`sequencia`),
  KEY `fk_item_requisicao1_idx` (`requisicao_idrequisicao`),
  KEY `fk_item_equipamento1_idx` (`equipamento_idequipamento`),
  CONSTRAINT `fk_item_equipamento1` FOREIGN KEY (`equipamento_idequipamento`) REFERENCES `equipamento` (`idequipamento`),
  CONSTRAINT `fk_item_requisicao1` FOREIGN KEY (`requisicao_idrequisicao`) REFERENCES `requisicao` (`idrequisicao`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (11,4,1,10.0,'2021-12-09 21:52:41',1),(12,4,1,18.5,'2021-12-09 21:54:58',1),(13,4,1,70.0,NULL,NULL),(14,4,2,12.0,NULL,NULL),(15,4,2,5.0,NULL,NULL);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisicao`
--

DROP TABLE IF EXISTS `requisicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requisicao` (
  `idrequisicao` bigint NOT NULL AUTO_INCREMENT,
  `data_hora` datetime NOT NULL,
  `motivo` text,
  `requisitante_idrequisitante` bigint NOT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  `idusuario_exclusao` int DEFAULT NULL,
  PRIMARY KEY (`idrequisicao`),
  KEY `fk_requisicao_requisitante1_idx` (`requisitante_idrequisitante`),
  CONSTRAINT `fk_requisicao_requisitante1` FOREIGN KEY (`requisitante_idrequisitante`) REFERENCES `requisitante` (`idrequisitante`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisicao`
--

LOCK TABLES `requisicao` WRITE;
/*!40000 ALTER TABLE `requisicao` DISABLE KEYS */;
INSERT INTO `requisicao` VALUES (4,'2021-12-09 20:08:00','Teste',1,NULL,NULL);
/*!40000 ALTER TABLE `requisicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisitante`
--

DROP TABLE IF EXISTS `requisitante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requisitante` (
  `idrequisitante` bigint NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `setor_idsetor` bigint NOT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  `idusuario_exclusao` int DEFAULT NULL,
  PRIMARY KEY (`idrequisitante`),
  KEY `fk_requisitante_setor_idx` (`setor_idsetor`),
  CONSTRAINT `fk_requisitante_setor` FOREIGN KEY (`setor_idsetor`) REFERENCES `setor` (`idsetor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisitante`
--

LOCK TABLES `requisitante` WRITE;
/*!40000 ALTER TABLE `requisitante` DISABLE KEYS */;
INSERT INTO `requisitante` VALUES (1,'Thiago','Contador',2,NULL,NULL),(2,'Rafael','Mecânico de trator',5,NULL,NULL),(3,'João','Pedreiro',1,'2021-11-30 21:10:20',1);
/*!40000 ALTER TABLE `requisitante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setor`
--

DROP TABLE IF EXISTS `setor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setor` (
  `idsetor` bigint NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  `idusuario_exclusao` int DEFAULT NULL,
  PRIMARY KEY (`idsetor`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setor`
--

LOCK TABLES `setor` WRITE;
/*!40000 ALTER TABLE `setor` DISABLE KEYS */;
INSERT INTO `setor` VALUES (1,'TI',NULL,NULL),(2,'Contabilidade',NULL,NULL),(3,'Vendas','2021-11-25 22:05:02',1),(4,'Direção',NULL,NULL),(5,'Manutenção',NULL,NULL),(6,'RH',NULL,NULL),(7,'Auditoria',NULL,NULL),(8,'','2021-11-30 20:50:55',1);
/*!40000 ALTER TABLE `setor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'rafael','123');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'epi'
--
/*!50003 DROP PROCEDURE IF EXISTS `atualiza_estoque` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `atualiza_estoque`(in id int, in qtd decimal(4,1))
BEGIN
	declare atual, novo decimal(4,1);
	select estoque into atual from equipamento where idequipamento = id;
    set novo = atual + qtd;
    update equipamento set estoque = novo;
    commit;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-09 19:43:12

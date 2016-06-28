CREATE DATABASE  IF NOT EXISTS `ecommerce` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ecommerce`;
-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: ecommerce
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `categoriaId` int(11) NOT NULL AUTO_INCREMENT,
  `categoriaNombre` varchar(45) NOT NULL,
  `categoriaIdParent` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`categoriaId`,`categoriaIdParent`),
  UNIQUE KEY `categoriaId_UNIQUE` (`categoriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color` (
  `colorId` int(11) NOT NULL,
  `colorNombre` varchar(45) DEFAULT NULL,
  `producto_productoId` int(11) NOT NULL,
  PRIMARY KEY (`colorId`),
  KEY `fk_color_producto1_idx` (`producto_productoId`),
  CONSTRAINT `fk_color_producto1` FOREIGN KEY (`producto_productoId`) REFERENCES `producto` (`productoId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `empresaId` int(11) NOT NULL AUTO_INCREMENT,
  `empresaNombre` varchar(45) NOT NULL,
  `empresaMail` varchar(45) NOT NULL,
  `empresaCIUT` varchar(45) NOT NULL,
  `empresaTelefono` varchar(45) DEFAULT NULL,
  `empresaDireccion` varchar(45) DEFAULT NULL,
  `empresaFechaAlta` varchar(45) NOT NULL,
  `empresaFechaDeModificacion` varchar(45) DEFAULT NULL,
  `empresaEstado` varchar(45) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`empresaId`,`usuarioId`),
  UNIQUE KEY `empresaId_UNIQUE` (`empresaId`),
  UNIQUE KEY `empresaNombre_UNIQUE` (`empresaNombre`),
  KEY `fk_empresa_usuario1_idx` (`usuarioId`),
  CONSTRAINT `fk_empresa_usuario1` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genero` (
  `generoId` int(11) NOT NULL AUTO_INCREMENT,
  `generoNombre` varchar(50) NOT NULL,
  PRIMARY KEY (`generoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hash`
--

DROP TABLE IF EXISTS `hash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hash` (
  `hashId` int(11) NOT NULL AUTO_INCREMENT,
  `hashHash` varchar(45) NOT NULL,
  `hashUserId` int(11) NOT NULL,
  `hashFechaDeAlta` datetime NOT NULL,
  PRIMARY KEY (`hashId`),
  UNIQUE KEY `hashHash_UNIQUE` (`hashHash`),
  KEY `fk_hash_usuario1_idx` (`hashUserId`),
  CONSTRAINT `fk_hash_usuario1` FOREIGN KEY (`hashUserId`) REFERENCES `usuario` (`usuarioId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hash`
--

LOCK TABLES `hash` WRITE;
/*!40000 ALTER TABLE `hash` DISABLE KEYS */;
INSERT INTO `hash` VALUES (5,'185WSYBYX3HOK7G49HBECCKBLVV1T8',1,'2016-06-25 16:31:16'),(6,'OX1WDUJJF0VCZRIGFBSG6HU9ZHI3AM',1,'2016-06-25 16:32:03'),(7,'H7VZ8D7AVKWVDM2EQG0C53TGE0WYC6',1,'2016-06-25 16:32:19'),(12,'C9PBSD4QR7ADEIZRV4MF9LUS3AY91O',1,'2016-06-25 20:23:15'),(14,'MOXF78V7OOPD9KHVGT3R9BKBUWYK95',1,'2016-06-25 20:29:51'),(15,'7MAGJ2K1T3XWC6THI8QLQ27TYMZGWL',1,'2016-06-25 20:32:51');
/*!40000 ALTER TABLE `hash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `productoId` int(11) NOT NULL AUTO_INCREMENT,
  `productoNombre` varchar(45) NOT NULL,
  `productoDescripcion` varchar(500) NOT NULL,
  `productoPrecio` int(11) NOT NULL,
  `productoFoto` varchar(45) NOT NULL,
  `productoEstado` varchar(45) NOT NULL,
  `productoFechaAlta` varchar(45) NOT NULL,
  `productoFechaModificacion` varchar(45) DEFAULT NULL,
  `usuario_usuarioId` int(11) NOT NULL,
  `categoria_categoriaId` int(11) NOT NULL,
  `empresa_empresaId` int(11) NOT NULL,
  `genero_generoId` int(11) NOT NULL,
  PRIMARY KEY (`productoId`),
  UNIQUE KEY `productoId_UNIQUE` (`productoId`),
  KEY `fk_producto_categoria1_idx` (`categoria_categoriaId`),
  KEY `fk_producto_empresa_idx` (`empresa_empresaId`),
  KEY `fk_producto_usuario1_idx` (`usuario_usuarioId`),
  KEY `fk_producto_genero1_idx` (`genero_generoId`),
  CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_categoriaId`) REFERENCES `categoria` (`categoriaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_empresa` FOREIGN KEY (`empresa_empresaId`) REFERENCES `empresa` (`empresaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_genero1` FOREIGN KEY (`genero_generoId`) REFERENCES `genero` (`generoId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_usuario1` FOREIGN KEY (`usuario_usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_has_transaccion`
--

DROP TABLE IF EXISTS `producto_has_transaccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_has_transaccion` (
  `transaccion_transaccionId` int(11) NOT NULL,
  `producto_productoId` int(11) NOT NULL,
  PRIMARY KEY (`transaccion_transaccionId`,`producto_productoId`),
  KEY `fk_producto_has_transaccion_transaccion1_idx` (`transaccion_transaccionId`),
  KEY `fk_producto_has_transaccion_producto1_idx` (`producto_productoId`),
  CONSTRAINT `fk_producto_has_transaccion_producto1` FOREIGN KEY (`producto_productoId`) REFERENCES `producto` (`productoId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_has_transaccion_transaccion1` FOREIGN KEY (`transaccion_transaccionId`) REFERENCES `transaccion` (`transaccionId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_has_transaccion`
--

LOCK TABLES `producto_has_transaccion` WRITE;
/*!40000 ALTER TABLE `producto_has_transaccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto_has_transaccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguidores`
--

DROP TABLE IF EXISTS `seguidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguidores` (
  `usuarioId` int(11) NOT NULL,
  `usuarioSeguidorId` int(11) NOT NULL,
  KEY `fk_usuarioId_idx` (`usuarioId`),
  KEY `fk_usuarioSeguidoId_idx` (`usuarioSeguidorId`),
  CONSTRAINT `fk_usuarioId` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarioSeguidoId` FOREIGN KEY (`usuarioSeguidorId`) REFERENCES `usuario` (`usuarioId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguidores`
--

LOCK TABLES `seguidores` WRITE;
/*!40000 ALTER TABLE `seguidores` DISABLE KEYS */;
INSERT INTO `seguidores` VALUES (2,4),(1,2);
/*!40000 ALTER TABLE `seguidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talle`
--

DROP TABLE IF EXISTS `talle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talle` (
  `talleId` int(11) NOT NULL,
  `talleNombre` varchar(45) DEFAULT NULL,
  `producto_productoId` int(11) NOT NULL,
  PRIMARY KEY (`talleId`),
  KEY `fk_talle_producto1_idx` (`producto_productoId`),
  CONSTRAINT `fk_talle_producto1` FOREIGN KEY (`producto_productoId`) REFERENCES `producto` (`productoId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talle`
--

LOCK TABLES `talle` WRITE;
/*!40000 ALTER TABLE `talle` DISABLE KEYS */;
/*!40000 ALTER TABLE `talle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaccion`
--

DROP TABLE IF EXISTS `transaccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaccion` (
  `transaccionId` int(11) NOT NULL AUTO_INCREMENT,
  `transaccionFecha` datetime DEFAULT NULL,
  `usuario_usuarioId` int(11) NOT NULL,
  PRIMARY KEY (`transaccionId`,`usuario_usuarioId`),
  KEY `fk_transaccion_usuario1_idx` (`usuario_usuarioId`),
  CONSTRAINT `fk_transaccion_usuario1` FOREIGN KEY (`usuario_usuarioId`) REFERENCES `usuario` (`usuarioId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaccion`
--

LOCK TABLES `transaccion` WRITE;
/*!40000 ALTER TABLE `transaccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuarioId` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioNombre` varchar(100) NOT NULL,
  `usuarioApellido` varchar(100) NOT NULL,
  `usuarioEmail` varchar(100) NOT NULL,
  `usuarioTelefono` int(9) NOT NULL,
  `usuarioFechaDeNacimiento` date NOT NULL,
  `usuarioGenero` varchar(45) NOT NULL,
  `usuarioPassword` varchar(70) NOT NULL,
  `usuarioFotoPerfil` varchar(100) NOT NULL,
  `usuarioEstado` int(11) NOT NULL,
  `usuarioFechaAlta` datetime NOT NULL,
  `usuarioFechaDeModificacion` datetime DEFAULT NULL,
  `genero_generoId` int(11) NOT NULL,
  PRIMARY KEY (`usuarioId`,`genero_generoId`),
  UNIQUE KEY `usuarioEmail_UNIQUE` (`usuarioEmail`),
  UNIQUE KEY `usuarioId_UNIQUE` (`usuarioId`),
  KEY `fk_usuario_genero1_idx` (`genero_generoId`),
  CONSTRAINT `fk_usuario_genero1` FOREIGN KEY (`genero_generoId`) REFERENCES `genero` (`generoId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Manuel','Vilche','manuelvilche@gmail.com',47440109,'1991-10-19','Masculino','$2y$10$tAEfMc4RBpU.B6LK8Scv4e5h3qNeCIFt1QGHqBRVB320faB1l828S','avatar_2x.png',1,'2016-06-28 10:41:56',NULL,0),(2,'Agustina','Rabanal','agusrabanal@gmail.com',47440109,'2016-12-30','Femenino','$2y$10$9QPjVi/JEOuBl9sjYoGJTu2BUIcCXkxMQlsxeAZgTHwEM.p63ipR6','avatar_2x.png',1,'2016-05-17 16:32:28',NULL,0),(3,'Matt','Barrera','mb_herfarth@hotmail.com',47440109,'1911-12-19','Femenino','$2y$10$iWs6nRZoihdsiROR18u2lu/P2W2Z4tpi9oMbwX0z6A7o.nZGVORB2','dolfina.jpg',1,'2016-05-25 21:26:33',NULL,0),(4,'Bianca','Pallaro','biancapallaro@gmail.com',47440109,'9119-12-19','Masculino','$2y$10$QZ05n6hKjDtzp0ErQK/9suc.VSLJw3inHqPKiFL/iscJViEKIQpE2','facebook.png',1,'2016-06-04 20:21:47',NULL,0),(5,'Soporte','Vilche','soporte@manuelvilche.com',47440109,'1991-10-19','Masculino','$2y$10$.ahFosHkTbKsCMbEoHbpuOtXk22SyaQyhV/z9MjaJpdbfmfvB./5W','avatar_2x.png',1,'2016-06-09 20:54:34',NULL,0),(12,'Oscar','Vilche','vilcheoscar@gmail.com',47440109,'1956-03-01','Masculino','$2y$10$s0Gs4zfzqvuMZfwum8FKD.2qEuPLi5qAWEtAT6QekoXwSrm03OC16','avatar_2x.png',1,'2016-06-23 11:47:57',NULL,0),(13,'Oscar','Vilche','vilcheoscar@gmail.com1',47440109,'1956-03-01','Masculino','$2y$10$QXKivGVPn9ztupnNUU2.zu8rB/i6SunZcYd5ttXxpJZD6CmSWNyFu','avatar_2x.png',1,'2016-06-23 11:53:24',NULL,0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-28 20:36:51

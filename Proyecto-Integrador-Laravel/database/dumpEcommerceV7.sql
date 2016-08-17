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
  `categoriaIdParent` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`categoriaId`,`categoriaIdParent`),
  UNIQUE KEY `categoriaId_UNIQUE` (`categoriaId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Clothes',0,NULL,'2016-08-09 21:22:10'),(2,'Shoes',0,NULL,NULL),(3,'Accesories',0,NULL,NULL),(4,'Pantalones',1,NULL,NULL),(5,'Remeras',1,NULL,NULL),(6,'Abrigos',1,NULL,NULL),(7,'Camisa',1,NULL,NULL),(8,'Ropa Interior',1,NULL,NULL),(9,'Carteras',3,NULL,NULL),(10,'Cinturones',3,NULL,NULL),(11,'Bijouterie',3,NULL,'2016-08-09 21:37:24');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color` (
  `colorId` int(11) NOT NULL AUTO_INCREMENT,
  `colorNombre` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`colorId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (1,'Rojo',NULL,NULL),(2,'Amarillo',NULL,NULL),(3,'Azul',NULL,NULL),(4,'Marron',NULL,NULL),(5,'Violeta',NULL,'2016-08-09 19:28:35');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colorHasProducto`
--

DROP TABLE IF EXISTS `colorHasProducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colorHasProducto` (
  `colorId` int(11) NOT NULL,
  `productoId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`colorId`,`productoId`),
  KEY `fk_color_has_producto_producto1_idx` (`productoId`),
  KEY `fk_color_has_producto_color1_idx` (`colorId`),
  CONSTRAINT `fk_color_has_producto_color1` FOREIGN KEY (`colorId`) REFERENCES `color` (`colorId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_color_has_producto_producto1` FOREIGN KEY (`productoId`) REFERENCES `producto` (`productoId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colorHasProducto`
--

LOCK TABLES `colorHasProducto` WRITE;
/*!40000 ALTER TABLE `colorHasProducto` DISABLE KEYS */;
INSERT INTO `colorHasProducto` VALUES (1,1,NULL,NULL),(2,1,NULL,NULL),(3,1,NULL,NULL);
/*!40000 ALTER TABLE `colorHasProducto` ENABLE KEYS */;
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
  `empresaEmail` varchar(45) NOT NULL,
  `empresaCUIT` int(11) NOT NULL,
  `empresaTelefono` varchar(45) NOT NULL,
  `empresaDireccion` varchar(45) NOT NULL,
  `empresaFoto` varchar(45) NOT NULL,
  `empresaEstado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`empresaId`),
  UNIQUE KEY `empresaId_UNIQUE` (`empresaId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'Maria Cher','e-shop@mariachereshop.com.ar',2147483647,'47440109','direccion 1234','cherLogoFB.png',1,'2016-08-08 01:05:58','2016-08-09 02:45:55'),(2,'prueba 2','manuel@amsdka.com',1023102391,'012930129301','aksdkasd','cherLogoFB.png',1,'2016-08-09 02:11:23','2016-08-09 02:11:23'),(3,'Prubea admin','prueba@empresa.com',2,'47440109','direccion 1234','avatar_2x.png',1,'2016-08-11 03:47:47','2016-08-11 03:47:47');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresaHasUsers`
--

DROP TABLE IF EXISTS `empresaHasUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresaHasUsers` (
  `empresaId` int(11) NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `empresaOwner` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`empresaId`,`users_id`),
  KEY `fk_empresa_has_users_users1_idx` (`users_id`),
  KEY `fk_empresa_has_users_empresa1_idx` (`empresaId`),
  CONSTRAINT `fk_empresa_has_users_empresa1` FOREIGN KEY (`empresaId`) REFERENCES `empresa` (`empresaId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_has_users_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresaHasUsers`
--

LOCK TABLES `empresaHasUsers` WRITE;
/*!40000 ALTER TABLE `empresaHasUsers` DISABLE KEYS */;
INSERT INTO `empresaHasUsers` VALUES (1,1,1,NULL,NULL),(1,3,0,NULL,NULL),(2,1,1,'2016-08-09 02:11:23','2016-08-09 02:11:23'),(2,2,0,'2016-08-11 16:46:11','2016-08-11 16:46:11'),(2,3,0,'2016-08-11 16:42:55','2016-08-11 16:42:55'),(3,1,0,'2016-08-11 03:47:47','2016-08-11 03:47:47'),(3,3,0,NULL,NULL);
/*!40000 ALTER TABLE `empresaHasUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followers` (
  `users_id` int(10) unsigned NOT NULL,
  `users_id1` int(10) unsigned NOT NULL DEFAULT '0',
  `empresaId` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`users_id`,`users_id1`,`empresaId`),
  KEY `fk_users_has_users_users2_idx` (`users_id1`),
  KEY `fk_users_has_users_users1_idx` (`users_id`),
  CONSTRAINT `fk_followers_usuario` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followers`
--

LOCK TABLES `followers` WRITE;
/*!40000 ALTER TABLE `followers` DISABLE KEYS */;
INSERT INTO `followers` VALUES (1,0,1,'2016-08-12 03:31:05','2016-08-12 03:31:05'),(1,0,3,'2016-08-11 16:33:19','2016-08-11 16:33:19'),(1,3,0,'2016-08-16 18:46:27','2016-08-16 18:46:27');
/*!40000 ALTER TABLE `followers` ENABLE KEYS */;
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`generoId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Masculino',NULL,'2016-08-09 19:15:53'),(2,'Femenino',NULL,NULL);
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('manuelvilche@gmail.com','c32a90f542843d06df52ff588f766bdf3d2aada8440b343d0118c0f32a463a9e','2016-08-11 00:42:41');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
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
  `empresaId` int(11) NOT NULL DEFAULT '0',
  `generoId` int(11) NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `categoriaId` int(11) NOT NULL,
  `categoriaIdParent` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`productoId`,`generoId`,`users_id`,`categoriaId`,`categoriaIdParent`,`empresaId`),
  UNIQUE KEY `productoId_UNIQUE` (`productoId`),
  KEY `fk_producto_empresa_idx` (`empresaId`),
  KEY `fk_producto_genero1_idx` (`generoId`),
  KEY `fk_producto_users1_idx` (`users_id`),
  KEY `fk_producto_categoria2_idx` (`categoriaIdParent`),
  KEY `fk_producto_categoria1_idx` (`categoriaId`,`categoriaIdParent`),
  CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoriaId`, `categoriaIdParent`) REFERENCES `categoria` (`categoriaId`, `categoriaIdParent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_genero1` FOREIGN KEY (`generoId`) REFERENCES `genero` (`generoId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Camisa','Camisa Cuadrille',100,'sweter.jpg','1',0,1,1,7,1,NULL,NULL),(2,'Coni\'s sweter','Coni\'s sweter',2000,'sweter.jpg','1',0,1,1,1,0,'2016-07-25 21:59:00','2016-08-12 03:42:50'),(3,'Camila\'s shoes','Camila\'s shoes',1500,'zapato2.jpg','1',0,1,1,2,0,'2016-07-25 21:59:00','2016-07-29 03:19:48'),(4,'Bianca\'s Trench','Bianca\'s Trench',1800,'tapado.jpg','1',0,1,1,1,0,'2016-07-25 21:59:00','2016-07-27 01:42:07'),(5,'Daro\'s Shoes','Daro\'s Shoes',1700,'zapas.jpg','1',0,1,1,2,0,'2016-07-25 21:59:00','2016-07-27 01:42:07'),(6,'Daro\'s Shoes','Daro\'s Shoes',3500,'tapado.jpg','1',0,1,2,4,1,'2016-07-25 21:59:00','2016-07-25 21:59:00'),(7,'Prueba','Prueba',10000,'zapas.jpg','1',0,1,3,1,0,NULL,NULL),(8,'Prueba1','Prueba',10000,'zapas.jpg','1',0,1,3,1,0,NULL,NULL),(9,'Daro\'s Shoes','Daro\'s Shoes',1700,'zapas.jpg','1',0,1,1,2,0,'2016-07-25 21:59:00','2016-07-27 01:42:07'),(10,'Remera de Marca','remera maria cher',3000,'artsinfoto.gif','1',1,2,1,2,0,'2016-08-08 01:23:32','2016-08-12 03:42:59'),(11,'prubea cat padre','askda',20342,'artsinfoto.gif','1',0,1,1,4,1,'2016-08-08 08:06:12','2016-08-08 08:06:12'),(12,'prubea foto','askdma',123901,'artsinfoto.gif','1',1,2,1,4,1,'2016-08-10 15:40:28','2016-08-10 15:40:28'),(13,'peurba','ksmdkamdk',1023,'artsinfoto.gif','1',1,1,1,4,1,'2016-08-10 15:44:05','2016-08-10 15:44:05'),(14,'lsa,dla','asda',1231,'artsinfoto.gif','1',0,2,1,11,3,'2016-08-10 23:37:13','2016-08-10 23:37:13'),(15,'empresa 2','',123,'artsinfoto.gif','1',3,1,1,10,3,'2016-08-11 16:33:11','2016-08-11 16:33:11');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleNombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SuperAdmin'),(2,'Admin'),(3,'Common User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock` (
  `stockId` int(11) NOT NULL AUTO_INCREMENT,
  `productoId` int(11) NOT NULL,
  `colorId` int(11) NOT NULL,
  `talleId` int(11) NOT NULL,
  `stockCantidad` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`stockId`,`productoId`,`colorId`,`talleId`),
  KEY `fk_stock_color1_idx` (`colorId`),
  KEY `fk_stock_producto1_idx` (`productoId`),
  KEY `fk_stock_talle1_idx` (`talleId`),
  CONSTRAINT `fk_stock_color1` FOREIGN KEY (`colorId`) REFERENCES `color` (`colorId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_producto1` FOREIGN KEY (`productoId`) REFERENCES `producto` (`productoId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_talle1` FOREIGN KEY (`talleId`) REFERENCES `talle` (`talleId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (25,1,1,1,57,'2016-08-17 16:08:02','2016-08-17 16:08:02'),(26,1,2,2,10,'2016-08-17 16:08:02','2016-08-17 16:08:02'),(27,1,4,3,37,'2016-08-17 16:08:02','2016-08-17 16:08:02'),(28,1,3,4,324,'2016-08-17 16:08:02','2016-08-17 16:08:02'),(49,2,1,1,10,'2016-08-17 16:23:54','2016-08-17 16:23:54'),(50,2,2,1,45,'2016-08-17 16:23:54','2016-08-17 16:23:54'),(51,2,1,2,123,'2016-08-17 16:23:54','2016-08-17 16:23:54');
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talle`
--

DROP TABLE IF EXISTS `talle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talle` (
  `talleId` int(11) NOT NULL AUTO_INCREMENT,
  `talleNombre` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`talleId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talle`
--

LOCK TABLES `talle` WRITE;
/*!40000 ALTER TABLE `talle` DISABLE KEYS */;
INSERT INTO `talle` VALUES (1,'XS',NULL,NULL),(2,'S',NULL,NULL),(3,'M',NULL,NULL),(4,'L',NULL,NULL),(5,'XL',NULL,NULL),(6,'XXL',NULL,NULL);
/*!40000 ALTER TABLE `talle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talleHasProducto`
--

DROP TABLE IF EXISTS `talleHasProducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talleHasProducto` (
  `talleId` int(11) NOT NULL,
  `productoId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`talleId`,`productoId`),
  KEY `fk_talle_has_producto_producto1_idx` (`productoId`),
  KEY `fk_talle_has_producto_talle1_idx` (`talleId`),
  CONSTRAINT `fk_talle_has_producto_producto1` FOREIGN KEY (`productoId`) REFERENCES `producto` (`productoId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_talle_has_producto_talle1` FOREIGN KEY (`talleId`) REFERENCES `talle` (`talleId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talleHasProducto`
--

LOCK TABLES `talleHasProducto` WRITE;
/*!40000 ALTER TABLE `talleHasProducto` DISABLE KEYS */;
INSERT INTO `talleHasProducto` VALUES (1,1,NULL,NULL),(3,1,NULL,NULL);
/*!40000 ALTER TABLE `talleHasProducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `roleId` int(11) NOT NULL,
  PRIMARY KEY (`id`,`gender`,`roleId`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_users_genero1_idx` (`gender`),
  KEY `fk_users_roles1_idx` (`roleId`),
  CONSTRAINT `fk_users_genero1` FOREIGN KEY (`gender`) REFERENCES `genero` (`generoId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Manuel','Vilche',47440109,'manuelvilche@gmail.com',1,'fotoPerfil.jpg','1991-10-19','$2y$10$/fh.cBdG8iff4q3XsrJWY.Fy6lOB6V3SUwBr6I./ddQ1utmPUO/ru','1','0GCV9KiIWgxxjcntTBCIZKaetpV6nP3vxUXYRkOd5nf0CJpuEbL7RwYeXXWW','2016-07-19 21:18:28','2016-08-16 18:50:26',1),(2,'Bianca','Pallaro',12345678,'biancapallaro@gmail.com',2,'avatar_2x.png','1990-12-10','$2y$10$vPsjFebLX3ca4.ZezLBCZOn/VW00wa3Z0kWPf7uvPFlx76zsFnpLq','1','kPaGrWLM6XM7nZh4vmSDW8kU24hOmJyMX8ZCLsi722ozcVRw5Ni88LRdI2fK','2016-07-26 05:08:31','2016-08-11 06:52:30',1),(3,'Matias','Barrera',12345678,'mb_herfarth@hotmail.com',1,'avatar_2x.png','1990-12-10','$2y$10$94Q2cfNvx0lR.lavz9.UgeLhS6fFIePsmXjYxUpqcf3tDpLjxvnra','1','9PA7hqx2Aa1FMpynrX32neNcw2tfHgpVp0bM21EeBpxfVWKPstGie8BP6FWL','2016-07-26 05:10:44','2016-08-11 07:11:52',1),(13,'Pedro','Vilche',47440109,'manuelvilche+4@gmail.com',1,'avatar_2x.png','1991-11-19','$2y$10$OpTMVyk6DDkOtBDYnO.IyeHAzFg0Quxj.LxcN2ecZNL4OO8EkMnmy','1',NULL,'2016-08-01 00:15:46','2016-08-01 00:15:46',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas`
--

DROP TABLE IF EXISTS `visitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitas` (
  `visitaId` int(11) NOT NULL AUTO_INCREMENT,
  `visitaCant` int(11) NOT NULL,
  `productoId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`visitaId`,`productoId`),
  KEY `fk_visitas_producto1_idx` (`productoId`),
  CONSTRAINT `fk_visitas_producto1` FOREIGN KEY (`productoId`) REFERENCES `producto` (`productoId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas`
--

LOCK TABLES `visitas` WRITE;
/*!40000 ALTER TABLE `visitas` DISABLE KEYS */;
INSERT INTO `visitas` VALUES (1,44,2,'2016-08-08 07:15:53','2016-08-16 21:19:55'),(2,29,1,'2016-08-08 07:28:19','2016-08-16 18:28:32'),(3,47,3,'2016-08-08 07:47:35','2016-08-16 18:29:25'),(4,3,10,'2016-08-09 02:02:20','2016-08-09 02:02:57'),(5,12,7,'2016-08-10 02:08:49','2016-08-12 18:24:20'),(6,4,6,'2016-08-10 20:20:13','2016-08-16 18:26:55'),(7,6,4,'2016-08-10 23:30:52','2016-08-12 19:18:59'),(8,2,5,'2016-08-10 23:30:59','2016-08-16 18:07:22'),(9,1,8,'2016-08-12 18:24:16','2016-08-12 18:24:16'),(10,32,9,'2016-08-16 17:41:17','2016-08-16 18:07:12');
/*!40000 ALTER TABLE `visitas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-17 10:57:39

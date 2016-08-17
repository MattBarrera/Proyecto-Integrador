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
INSERT INTO `categoria` VALUES (1,'Clothes',0,NULL,'2016-08-09 21:22:10'),(2,'Shoes',0,NULL,NULL),(3,'Accesories',0,NULL,NULL),(4,'Pants',1,NULL,'2016-08-18 00:25:57'),(5,'T-shirt',1,NULL,'2016-08-18 00:26:11'),(6,'Outerwear',1,NULL,'2016-08-18 00:26:42'),(7,'Shirt',1,NULL,'2016-08-18 00:26:56'),(8,'Underwear',1,NULL,'2016-08-18 00:27:16'),(9,'Bags',3,NULL,'2016-08-18 00:27:24'),(10,'Belt',3,NULL,'2016-08-18 00:27:34'),(11,'Jewelry',3,NULL,'2016-08-18 00:28:01');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (1,'Red',NULL,'2016-08-18 00:24:44'),(2,'Yellow',NULL,'2016-08-18 00:25:09'),(3,'Blue',NULL,'2016-08-18 00:25:14'),(4,'Brown',NULL,'2016-08-18 00:25:29'),(5,'Violet',NULL,'2016-08-18 00:25:34'),(6,'Black','2016-08-17 23:37:30','2016-08-18 00:25:39'),(7,'White','2016-08-18 00:17:23','2016-08-18 00:17:23');
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
INSERT INTO `empresaHasUsers` VALUES (1,1,1,NULL,NULL),(1,3,0,NULL,NULL),(2,1,1,'2016-08-09 02:11:23','2016-08-09 02:11:23'),(2,2,0,'2016-08-11 16:46:11','2016-08-11 16:46:11'),(2,3,0,'2016-08-11 16:42:55','2016-08-11 16:42:55'),(3,1,1,'2016-08-11 03:47:47','2016-08-11 03:47:47');
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
INSERT INTO `genero` VALUES (1,'Male',NULL,'2016-08-18 00:28:11'),(2,'Female',NULL,'2016-08-18 00:28:20');
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Camisa','Camisa Cuadrille',100,'sweter.jpg','1',0,1,1,7,1,NULL,NULL),(2,'Coni\'s sweter','Coni\'s sweter',2000,'sweter.jpg','1',0,1,1,1,0,'2016-07-25 21:59:00','2016-08-12 03:42:50'),(3,'Camila\'s shoes','Camila\'s shoes',1500,'zapato2.jpg','1',0,1,1,2,0,'2016-07-25 21:59:00','2016-07-29 03:19:48'),(4,'Bianca\'s Trench','Bianca\'s Trench',1800,'tapado.jpg','1',0,1,1,1,0,'2016-07-25 21:59:00','2016-07-27 01:42:07'),(5,'Daro\'s Shoes','Daro\'s Shoes',1700,'zapas.jpg','1',0,1,1,2,0,'2016-07-25 21:59:00','2016-07-27 01:42:07'),(6,'Daro\'s Shoes','Daro\'s Shoes',3500,'tapado.jpg','2',0,1,2,4,1,'2016-07-25 21:59:00','2016-08-17 23:26:18'),(7,'Prueba','Prueba',10000,'zapas.jpg','1',0,1,3,1,0,NULL,NULL),(8,'Prueba1','Prueba',10000,'zapas.jpg','1',0,1,3,1,0,NULL,NULL),(9,'Daro\'s Shoes','Daro\'s Shoes',1700,'zapas.jpg','1',0,1,1,2,0,'2016-07-25 21:59:00','2016-07-27 01:42:07'),(10,'Remera de Marca','remera maria cher',3000,'artsinfoto.gif','2',1,2,1,2,0,'2016-08-08 01:23:32','2016-08-18 00:24:06'),(11,'prubea cat padre','askda',20342,'artsinfoto.gif','2',0,1,1,4,1,'2016-08-08 08:06:12','2016-08-18 00:24:09'),(12,'prubea foto','askdma',123901,'artsinfoto.gif','2',1,2,1,4,1,'2016-08-10 15:40:28','2016-08-18 00:24:12'),(13,'peurba','ksmdkamdk',1023,'artsinfoto.gif','2',1,1,1,4,1,'2016-08-10 15:44:05','2016-08-18 00:24:14'),(14,'lsa,dla','asda',1231,'artsinfoto.gif','2',0,2,1,11,3,'2016-08-10 23:37:13','2016-08-18 00:24:16'),(15,'empresa 2','',123,'artsinfoto.gif','2',3,1,1,10,3,'2016-08-11 16:33:11','2016-08-18 00:24:18'),(16,'Bota Negra','Calzado de cuero impermeable que cubre pie y parte del tobillo ',2000,'artsinfoto.gif','2',0,2,2,2,0,'2016-08-17 23:28:52','2016-08-17 23:32:52'),(17,'Bota Negra','Calzado de cuero impermeable que cubre el pie y parte del tobillo',1700,'artsinfoto.gif','2',0,2,2,2,0,'2016-08-17 23:33:38','2016-08-17 23:35:49'),(18,'Black Boot',' Reinforced eyelets and straight toe',1700,'bb.jpg','1',0,2,2,2,0,'2016-08-17 23:36:25','2016-08-18 00:16:34'),(19,'Scottish Trench ','100% Wool Woven ',1340,'ll.jpg','1',0,2,2,6,1,'2016-08-17 23:41:00','2016-08-18 00:15:20'),(20,'Leather Wallet','Fancy rectangular shape with a zipper top closure',500,'ss.jpg','1',0,2,2,3,0,'2016-08-17 23:46:08','2016-08-17 23:46:08'),(21,'Backpack','Leather with top handle, adjustable shoulder straps, two exterior zip pockets, and one interior zip pocket.',1200,'06cba7bbc99d159ab81e263aab55a0783d0f2846.jpg','1',0,1,2,3,0,'2016-08-17 23:50:51','2016-08-18 00:13:22'),(22,'Cardigan','A 3/4-sleeved cardigan cut from a textured knit with an open front, and front patch pockets.',1200,'cc.jpg','1',0,2,2,6,1,'2016-08-17 23:55:41','2016-08-17 23:55:41'),(23,'Handbag','A structured faux leather featuring a front flap with high-polish snap-button closure.',1600,'13ed32724a7599732bdda614c6a09b18b800b5a3.jpg','1',0,2,2,9,3,'2016-08-18 00:02:49','2016-08-18 00:02:49'),(24,'Trench','Lightweight woven trench coat features long sleeves, a notched lapel, slanted front pockets, a buttoned front, and a belt',4000,'343417b9e026e3cac9f1beefe4e14f512155e4f0.jpg','1',0,2,2,6,1,'2016-08-18 00:06:47','2016-08-18 00:06:47'),(25,'White Top',' A French terry-knit top featuring a high neckline',700,'377e166263c2d4470abd93b70385e3e93bd60014.jpg','1',0,2,2,5,1,'2016-08-18 00:11:29','2016-08-18 00:11:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (25,1,1,1,57,'2016-08-17 16:08:02','2016-08-17 16:08:02'),(26,1,2,2,10,'2016-08-17 16:08:02','2016-08-17 16:08:02'),(27,1,4,3,37,'2016-08-17 16:08:02','2016-08-17 16:08:02'),(28,1,3,4,324,'2016-08-17 16:08:02','2016-08-17 16:08:02'),(49,2,1,1,10,'2016-08-17 16:23:54','2016-08-17 16:23:54'),(50,2,2,1,45,'2016-08-17 16:23:54','2016-08-17 16:23:54'),(51,2,1,2,123,'2016-08-17 16:23:54','2016-08-17 16:23:54'),(52,18,6,3,13,'2016-08-17 23:38:29','2016-08-17 23:38:29'),(53,19,4,1,15,'2016-08-17 23:42:33','2016-08-17 23:42:33'),(54,20,7,1,200,'2016-08-18 00:17:39','2016-08-18 00:17:39'),(56,21,6,3,200,'2016-08-18 00:18:04','2016-08-18 00:18:04'),(57,22,6,3,500,'2016-08-18 00:18:26','2016-08-18 00:18:26'),(58,23,4,3,700,'2016-08-18 00:18:40','2016-08-18 00:18:40'),(59,24,6,3,600,'2016-08-18 00:19:05','2016-08-18 00:19:05'),(62,25,7,3,400,'2016-08-18 00:19:52','2016-08-18 00:19:52'),(63,25,7,2,500,'2016-08-18 00:19:52','2016-08-18 00:19:52');
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
-- Table structure for table `transacciones`
--

DROP TABLE IF EXISTS `transacciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transacciones` (
  `transaccionesId` int(11) NOT NULL AUTO_INCREMENT,
  `productoId` int(11) NOT NULL,
  `transaccionQty` int(11) DEFAULT NULL,
  `transaccionPrice` int(11) DEFAULT NULL,
  `transaccionSize` int(11) DEFAULT NULL,
  `transaccionColor` int(11) DEFAULT NULL,
  `transaccionName` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`transaccionesId`,`productoId`),
  KEY `fk_transacciones_producto1_idx` (`productoId`),
  CONSTRAINT `fk_transacciones_producto1` FOREIGN KEY (`productoId`) REFERENCES `producto` (`productoId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transacciones`
--

LOCK TABLES `transacciones` WRITE;
/*!40000 ALTER TABLE `transacciones` DISABLE KEYS */;
INSERT INTO `transacciones` VALUES (1,1,1,100,1,1,'Camisa','2016-08-17 21:49:05','2016-08-17 21:49:05',1),(2,1,1,100,1,1,'Camisa','2016-08-17 22:13:26','2016-08-17 22:13:26',1),(3,2,1,2000,1,1,'Coni\'s sweter','2016-08-17 22:13:26','2016-08-17 22:13:26',1);
/*!40000 ALTER TABLE `transacciones` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Manuel','Vilche',47440109,'manuelvilche@gmail.com',1,'fotoPerfil.jpg','1991-10-19','$2y$10$/fh.cBdG8iff4q3XsrJWY.Fy6lOB6V3SUwBr6I./ddQ1utmPUO/ru','1','046pUmsCjN0ShCNWPg4Hbbepza3CYqZO6Wo1uVamdo1fibJ5b5pPTjLVwyyJ','2016-07-19 21:18:28','2016-08-17 23:25:39',1),(2,'Bianca','Pallaro',12345678,'biancapallaro@gmail.com',2,'avatar_2x.png','1990-12-10','$2y$10$vPsjFebLX3ca4.ZezLBCZOn/VW00wa3Z0kWPf7uvPFlx76zsFnpLq','1','kPaGrWLM6XM7nZh4vmSDW8kU24hOmJyMX8ZCLsi722ozcVRw5Ni88LRdI2fK','2016-07-26 05:08:31','2016-08-11 06:52:30',1),(3,'Matias','Barrera',12345678,'mb_herfarth@hotmail.com',1,'avatar_2x.png','1990-12-10','$2y$10$94Q2cfNvx0lR.lavz9.UgeLhS6fFIePsmXjYxUpqcf3tDpLjxvnra','1','9PA7hqx2Aa1FMpynrX32neNcw2tfHgpVp0bM21EeBpxfVWKPstGie8BP6FWL','2016-07-26 05:10:44','2016-08-11 07:11:52',1),(13,'Pedro','Vilche',47440109,'manuelvilche+4@gmail.com',1,'avatar_2x.png','1991-11-19','$2y$10$OpTMVyk6DDkOtBDYnO.IyeHAzFg0Quxj.LxcN2ecZNL4OO8EkMnmy','1',NULL,'2016-08-01 00:15:46','2016-08-01 00:15:46',3),(14,'DH','house',5263,'contacto@digitalhouse.com',1,'avatar_2x.png','2015-01-01','$2y$10$hQ2vye.N0r2fvv/s00oQjOm/aI8EsT7LAwkq5EKenOO3FCiFhl0FK','1',NULL,'2016-08-17 17:09:19','2016-08-17 17:09:19',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas`
--

LOCK TABLES `visitas` WRITE;
/*!40000 ALTER TABLE `visitas` DISABLE KEYS */;
INSERT INTO `visitas` VALUES (1,47,2,'2016-08-08 07:15:53','2016-08-17 23:21:10'),(2,125,1,'2016-08-08 07:28:19','2016-08-17 23:24:53'),(3,47,3,'2016-08-08 07:47:35','2016-08-16 18:29:25'),(4,3,10,'2016-08-09 02:02:20','2016-08-09 02:02:57'),(5,12,7,'2016-08-10 02:08:49','2016-08-12 18:24:20'),(6,6,6,'2016-08-10 20:20:13','2016-08-17 17:54:36'),(7,7,4,'2016-08-10 23:30:52','2016-08-17 20:47:41'),(8,2,5,'2016-08-10 23:30:59','2016-08-16 18:07:22'),(9,1,8,'2016-08-12 18:24:16','2016-08-12 18:24:16'),(10,43,9,'2016-08-16 17:41:17','2016-08-17 20:37:39'),(11,7,15,'2016-08-17 20:10:08','2016-08-17 20:31:10'),(12,1,12,'2016-08-17 23:03:26','2016-08-17 23:03:26');
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

-- Dump completed on 2016-08-17 18:29:00

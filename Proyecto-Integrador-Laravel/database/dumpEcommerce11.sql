-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: ecommerce
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
INSERT INTO `producto` VALUES (1,'Camisa','Camisa Cuadrille',100,'sweter.jpg','1',0,1,1,7,1,NULL,NULL),(2,'Coni\'s sweter','Coni\'s sweter',2000,'sweter.jpg','1',0,1,1,1,0,'2016-07-25 21:59:00','2016-08-12 03:42:50'),(3,'Camila\'s shoes','Camila\'s shoes',1500,'zapato2.jpg','1',0,1,1,2,0,'2016-07-25 21:59:00','2016-07-29 03:19:48'),(4,'Bianca\'s Trench','Bianca\'s Trench',1800,'tapado.jpg','1',0,1,1,1,0,'2016-07-25 21:59:00','2016-07-27 01:42:07'),(5,'Daro\'s Shoes','Daro\'s Shoes',1700,'zapas.jpg','1',0,1,1,2,0,'2016-07-25 21:59:00','2016-07-27 01:42:07'),(6,'Daro\'s Shoes','Daro\'s Shoes',3500,'tapado.jpg','2',0,1,2,4,1,'2016-07-25 21:59:00','2016-08-17 23:26:18'),(7,'Prueba','Prueba',10000,'zapas.jpg','2',0,1,3,1,0,NULL,'2016-08-18 00:31:03'),(8,'Prueba1','Prueba',10000,'zapas.jpg','2',0,1,3,1,0,NULL,'2016-08-18 00:31:00'),(9,'Daro\'s Shoes','Daro\'s Shoes',1700,'zapas.jpg','1',0,1,1,2,0,'2016-07-25 21:59:00','2016-07-27 01:42:07'),(10,'Remera de Marca','remera maria cher',3000,'artsinfoto.gif','2',1,2,1,2,0,'2016-08-08 01:23:32','2016-08-18 00:24:06'),(11,'prubea cat padre','askda',20342,'artsinfoto.gif','2',0,1,1,4,1,'2016-08-08 08:06:12','2016-08-18 00:24:09'),(12,'prubea foto','askdma',123901,'artsinfoto.gif','2',1,2,1,4,1,'2016-08-10 15:40:28','2016-08-18 00:24:12'),(13,'peurba','ksmdkamdk',1023,'artsinfoto.gif','2',1,1,1,4,1,'2016-08-10 15:44:05','2016-08-18 00:24:14'),(14,'lsa,dla','asda',1231,'artsinfoto.gif','2',0,2,1,11,3,'2016-08-10 23:37:13','2016-08-18 00:24:16'),(15,'empresa 2','',123,'artsinfoto.gif','2',3,1,1,10,3,'2016-08-11 16:33:11','2016-08-18 00:24:18'),(16,'Bota Negra','Calzado de cuero impermeable que cubre pie y parte del tobillo ',2000,'artsinfoto.gif','2',0,2,2,2,0,'2016-08-17 23:28:52','2016-08-17 23:32:52'),(17,'Bota Negra','Calzado de cuero impermeable que cubre el pie y parte del tobillo',1700,'artsinfoto.gif','2',0,2,2,2,0,'2016-08-17 23:33:38','2016-08-17 23:35:49'),(18,'Black Boot',' Reinforced eyelets and straight toe',1700,'bb.jpg','1',0,2,2,2,0,'2016-08-17 23:36:25','2016-08-18 00:16:34'),(19,'Scottish Trench ','100% Wool Woven ',1340,'ll.jpg','1',0,2,2,6,1,'2016-08-17 23:41:00','2016-08-18 00:15:20'),(20,'Leather Wallet','Fancy rectangular shape with a zipper top closure',500,'ss.jpg','1',0,2,2,3,0,'2016-08-17 23:46:08','2016-08-17 23:46:08'),(21,'Backpack','Leather with top handle, adjustable shoulder straps, two exterior zip pockets, and one interior zip pocket.',1200,'06cba7bbc99d159ab81e263aab55a0783d0f2846.jpg','1',0,1,2,3,0,'2016-08-17 23:50:51','2016-08-18 00:13:22'),(22,'Cardigan','A 3/4-sleeved cardigan cut from a textured knit with an open front, and front patch pockets.',1200,'cc.jpg','1',0,2,2,6,1,'2016-08-17 23:55:41','2016-08-17 23:55:41'),(23,'Handbag','A structured faux leather featuring a front flap with high-polish snap-button closure.',1600,'13ed32724a7599732bdda614c6a09b18b800b5a3.jpg','1',0,2,2,9,3,'2016-08-18 00:02:49','2016-08-18 00:02:49'),(24,'Trench','Lightweight woven trench coat features long sleeves, a notched lapel, slanted front pockets, a buttoned front, and a belt',4000,'343417b9e026e3cac9f1beefe4e14f512155e4f0.jpg','1',0,2,2,6,1,'2016-08-18 00:06:47','2016-08-18 00:06:47'),(25,'White Top',' A French terry-knit top featuring a high neckline',700,'377e166263c2d4470abd93b70385e3e93bd60014.jpg','1',0,2,2,5,1,'2016-08-18 00:11:29','2016-08-18 00:11:29');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-17 18:32:24

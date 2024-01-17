-- MariaDB dump 10.19-11.3.0-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: biblio
-- ------------------------------------------------------
-- Server version	11.3.0-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(150) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
INSERT INTO `autor` VALUES
(1,'ultima prueba','logo.png',1),
(2,'cambiar el nombre llll','20210514132528.jpg',1),
(3,'popoiipippi','logo.png',1);
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `estado` int(2) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_c` int(2) DEFAULT 1,
  `user_m` int(2) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES
(1,'sin categoria',NULL,1,'2024-01-17 22:01:44','2024-01-17 22:01:44',1,1),
(2,'peras','son cosas',1,'2024-01-17 22:21:24','2024-01-17 22:21:24',1,1),
(3,'add1','ss',1,'2024-01-17 22:21:52','2024-01-17 22:50:15',1,1),
(4,'add','dd',1,'2024-01-17 22:24:17','2024-01-17 22:50:18',1,1),
(5,'eferer','eee',1,'2024-01-17 22:26:22','2024-01-17 22:26:22',1,1),
(6,'ee','ee',1,'2024-01-17 22:27:36','2024-01-17 22:27:36',1,1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `correo` varchar(100) NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES
(1,'Vida Informático','925491523','Lima - Perú','angelsifuentes@gmail.com','logo.png');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_permisos`
--

DROP TABLE IF EXISTS `detalle_permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_permiso` (`id_permiso`),
  CONSTRAINT `detalle_permisos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `detalle_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_permisos`
--

LOCK TABLES `detalle_permisos` WRITE;
/*!40000 ALTER TABLE `detalle_permisos` DISABLE KEYS */;
INSERT INTO `detalle_permisos` VALUES
(5,2,1),
(6,2,2),
(7,2,3),
(8,2,5),
(9,2,8),
(13,3,4),
(14,3,10),
(15,3,12);
/*!40000 ALTER TABLE `detalle_permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editorial`
--

DROP TABLE IF EXISTS `editorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editorial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editorial` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editorial`
--

LOCK TABLES `editorial` WRITE;
/*!40000 ALTER TABLE `editorial` DISABLE KEYS */;
INSERT INTO `editorial` VALUES
(1,'Ninguna',1),
(2,'Toribio anyarin',0),
(3,'bruÃ±o2',1);
/*!40000 ALTER TABLE `editorial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `carrera` varchar(255) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` VALUES
(1,'12345','74589745','Angel sifuentes','Ingenieria de sistemas','Lima peru','925491523',1),
(2,'465','9779879','Prueba','Ingenieria','Lima','987978456',1);
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `h_categoria`
--

DROP TABLE IF EXISTS `h_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `estado` int(2) DEFAULT 1,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `user` int(2) DEFAULT 1,
  `evento` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_categoria`
--

LOCK TABLES `h_categoria` WRITE;
/*!40000 ALTER TABLE `h_categoria` DISABLE KEYS */;
INSERT INTO `h_categoria` VALUES
(1,6,'ee','ee',1,'2024-01-17 22:27:36',1,'CREADO'),
(2,3,'ders','ss',1,'2024-01-17 22:41:46',1,'MODIFICADO'),
(3,4,'add','dd',0,'2024-01-17 22:47:55',1,'ELIMINADO'),
(4,3,'ders','ss',0,'2024-01-17 22:48:03',1,'ELIMINADO'),
(5,3,'ders','ss',1,'2024-01-17 22:49:47',1,'RESTAURADO'),
(6,3,'add','ss',1,'2024-01-17 22:49:57',1,'MODIFICADO'),
(7,4,'add','dd',1,'2024-01-17 22:50:01',1,'RESTAURADO'),
(8,3,'add1','ss',1,'2024-01-17 22:50:15',1,'MODIFICADO'),
(9,4,'add','dd',1,'2024-01-17 22:50:18',1,'RESTAURADO');
/*!40000 ALTER TABLE `h_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `h_receta`
--

DROP TABLE IF EXISTS `h_receta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_receta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receta_id` int(11) NOT NULL,
  `codigo_receta` varchar(50) DEFAULT NULL,
  `nombre_receta` varchar(50) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `estado` int(2) DEFAULT 1,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `user` int(2) DEFAULT 1,
  `evento` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_receta`
--

LOCK TABLES `h_receta` WRITE;
/*!40000 ALTER TABLE `h_receta` DISABLE KEYS */;
INSERT INTO `h_receta` VALUES
(1,1,'100','luminaria3','Instalacion de luminarias',1,'2024-01-17 15:58:44',3,'MODIFICADO'),
(2,1,'100','luminaria1','Instalacion de luminarias',1,'2024-01-17 15:58:52',3,'MODIFICADO'),
(3,1,'100','luminard','Instalacion de luminarias',1,'2024-01-17 15:58:58',3,'MODIFICADO'),
(4,1,'100','luminairas2','Instalacion de luminarias',1,'2024-01-17 15:59:20',1,'MODIFICADO'),
(5,1,'104','luminairas2','Instalacion de luminarias',1,'2024-01-17 15:59:26',1,'MODIFICADO'),
(6,1,'100','luminarias','Instalacion de luminarias',1,'2024-01-17 15:59:36',1,'MODIFICADO'),
(7,1,'100','luminarias','Instalacion de luminarias',1,'2024-01-17 16:29:11',1,'ELIMINADO'),
(8,1,'100','luminarias','Instalacion de luminarias',1,'2024-01-17 16:30:42',1,'ELIMINADO'),
(9,1,'100','luminarias','Instalacion de luminarias',0,'2024-01-17 16:33:05',3,'ELIMINADO'),
(10,1,'100','luminarias2','Instalacion de luminarias',1,'2024-01-17 16:35:18',3,'MODIFICADO'),
(11,1,'100','luminarias222','Instalacion de luminarias',1,'2024-01-17 16:35:24',3,'MODIFICADO'),
(12,1,'10022','luminarias222','Instalacion de luminarias',1,'2024-01-17 16:35:27',3,'MODIFICADO'),
(13,1,'100','luminarias','Instalacion de luminarias',1,'2024-01-17 16:35:34',3,'MODIFICADO'),
(14,1,'100','luminarias22','Instalacion de luminarias',1,'2024-01-17 16:39:10',3,'MODIFICADO'),
(15,1,'100','luminarias2','Instalacion de luminarias',1,'2024-01-17 16:40:54',3,'MODIFICADO'),
(16,1,'100','luminarias21','Instalacion de luminarias',1,'2024-01-17 16:42:38',3,'MODIFICADO'),
(17,1,'100','luminarias2','Instalacion de luminarias',1,'2024-01-17 16:47:50',3,'MODIFICADO'),
(18,4,'400','luis','ok',1,'2024-01-17 17:05:22',3,'CREADO'),
(19,2,'200','CHELA','se acabo',0,'2024-01-17 19:39:35',1,'ELIMINADO'),
(20,5,'220','CHELA','EE',1,'2024-01-17 19:44:30',1,'CREADO'),
(21,2,'200','CHELA','se acabo',1,'2024-01-17 19:55:35',1,'RESTAURADO'),
(22,5,'220','CHELA','EE',0,'2024-01-17 19:58:25',1,'ELIMINADO'),
(23,5,'220','CHELA','EE',1,'2024-01-17 21:23:31',1,'RESTAURADO'),
(24,5,'220','CHELA','EE',1,'2024-01-17 21:23:50',1,'RESTAURADO'),
(25,5,'220','CHELA','EE',1,'2024-01-17 21:24:23',1,'RESTAURADO'),
(26,5,'220','CHELA','EE',1,'2024-01-17 21:25:21',1,'RESTAURADO'),
(27,2,'200','CHELA1','se acabo',1,'2024-01-17 21:25:49',1,'MODIFICADO'),
(28,5,'220','CHELA','EE',1,'2024-01-17 21:25:53',1,'RESTAURADO'),
(29,5,'220','CHELA','EE',1,'2024-01-17 21:26:01',1,'RESTAURADO'),
(30,5,'220','CHELA','EE',1,'2024-01-17 21:29:20',1,'RESTAURADO'),
(31,5,'220','CHELA','EE',1,'2024-01-17 21:31:21',1,'RESTAURADO'),
(32,5,'220','CHELA','EE',0,'2024-01-17 21:35:43',1,'ELIMINADO'),
(33,2,'200','CHELA','se acabo',1,'2024-01-17 21:35:49',1,'MODIFICADO'),
(34,5,'220','CHELA','EE',1,'2024-01-17 21:35:52',1,'RESTAURADO'),
(35,5,'220','CHELA','EE',1,'2024-01-17 21:35:56',1,'RESTAURADO'),
(36,2,'200','CHELA1','se acabo',1,'2024-01-17 21:36:01',1,'MODIFICADO'),
(37,5,'220','CHELA','EE',1,'2024-01-17 21:36:03',1,'RESTAURADO'),
(38,5,'220','CHELA','EE',0,'2024-01-17 21:42:46',1,'ELIMINADO'),
(39,6,'','CHELA','A',1,'2024-01-17 21:43:33',3,'CREADO'),
(40,4,'400','luis5','ok',1,'2024-01-17 21:44:11',3,'MODIFICADO'),
(41,2,'200','CHELA13','se acabo',1,'2024-01-17 21:44:16',3,'MODIFICADO'),
(42,6,'','CHELA1','A',1,'2024-01-17 21:44:20',3,'MODIFICADO'),
(43,5,'220','CHELA','EE',1,'2024-01-17 21:45:32',1,'RESTAURADO'),
(44,5,'220','CHELA','EE',0,'2024-01-17 21:46:51',1,'ELIMINADO'),
(45,7,'','CHELA','',1,'2024-01-17 21:46:59',1,'CREADO'),
(46,5,'220','CHELA','EE',1,'2024-01-17 21:47:02',1,'RESTAURADO'),
(47,7,'','CHEL','',1,'2024-01-17 21:47:09',1,'MODIFICADO'),
(48,5,'220','CHELA','EE',1,'2024-01-17 21:47:11',1,'RESTAURADO'),
(49,2,'200','CHELA132','se acabo',1,'2024-01-17 22:34:45',1,'MODIFICADO');
/*!40000 ALTER TABLE `h_receta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_editorial` int(11) NOT NULL,
  `anio_edicion` date NOT NULL,
  `id_materia` int(11) NOT NULL,
  `num_pagina` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  KEY `id_materia` (`id_materia`),
  KEY `id_editorial` (`id_editorial`),
  CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id`),
  CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`id_editorial`) REFERENCES `editorial` (`id`),
  CONSTRAINT `libro_ibfk_3` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES
(1,'poiopioioiop',50,1,1,'2021-05-08',1,1335,'si','logo.png',1),
(2,'Javascript',69,1,1,'2021-05-08',2,1478,'Domina javascript','20210514132615.jpg',1),
(3,'python para todos',23,1,1,'2021-05-08',1,258,'anaconda','logo.png',1),
(4,'ultima prueba',23,1,1,'2021-05-14',1,569,'','20210514132757.jpg',1);
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES
(1,'Base de Datos',0),
(2,'Ingenieria de Software',1),
(3,'Algebra',1),
(4,'Matematica',1),
(5,'algoritmo 1',1);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES
(1,'Libros',1),
(2,'Autor',2),
(3,'Editorial',3),
(4,'Usuarios',4),
(5,'Configuracion',5),
(6,'Estudiantes',6),
(7,'Materias',7),
(8,'Reportes',8),
(9,'Prestamos',9),
(10,'Recetas',10),
(11,'Historial',11),
(12,'Categorias',12);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestamo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id_estudiante` (`id_estudiante`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`id`),
  CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamo`
--

LOCK TABLES `prestamo` WRITE;
/*!40000 ALTER TABLE `prestamo` DISABLE KEYS */;
INSERT INTO `prestamo` VALUES
(1,1,1,'2021-05-11','2021-05-11',5,'',0),
(2,1,2,'2021-05-11','2021-05-11',15,'',0);
/*!40000 ALTER TABLE `prestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receta`
--

DROP TABLE IF EXISTS `receta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_receta` varchar(50) DEFAULT NULL,
  `nombre_receta` varchar(50) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `estado` int(2) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_c` int(2) DEFAULT 1,
  `user_m` int(2) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receta`
--

LOCK TABLES `receta` WRITE;
/*!40000 ALTER TABLE `receta` DISABLE KEYS */;
INSERT INTO `receta` VALUES
(1,'100','luminarias2','Instalacion de luminarias',1,'2024-01-17 14:41:02','2024-01-17 16:47:50',1,3),
(2,'200','CHELA132','se acabo',1,'2024-01-17 16:56:39','2024-01-17 22:34:44',3,1),
(3,'300','vanesa','jaja',1,'2024-01-17 17:04:24','2024-01-17 17:04:24',3,3),
(4,'400','luis5','ok',1,'2024-01-17 17:05:22','2024-01-17 21:44:11',3,3),
(5,'220','CHELA','EE',1,'2024-01-17 19:44:30','2024-01-17 21:47:11',1,1),
(6,'','CHELA1','A',1,'2024-01-17 21:43:33','2024-01-17 21:44:20',3,3),
(7,'','CHEL','',1,'2024-01-17 21:46:59','2024-01-17 21:47:09',1,1);
/*!40000 ALTER TABLE `receta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES
(1,'admin','admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',1),
(2,'angel','terribe','519ba91a5a5b4afb9dc66f8805ce8c442b6576316c19c6896af2fa9bda6aff71',1),
(3,'luis','Luis Marcelo','8f80f8ab8a1363201fe5592b61ef5fcdb308ab274b23fcdc2fa84323ebf32f0d',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-17 18:18:47

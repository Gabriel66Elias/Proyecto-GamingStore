-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: gamingstore_grupo25
-- ------------------------------------------------------
-- Server version	8.0.46

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categorias_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Consolas','2026-06-14 02:57:46','2026-06-14 02:57:46'),(2,'Hardware','2026-06-14 02:57:46','2026-06-14 02:57:46'),(3,'Periféricos','2026-06-14 02:57:46','2026-06-14 02:57:46'),(4,'TV & Monitores','2026-06-14 02:57:46','2026-06-14 02:57:46');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensaje` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `leida` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES (1,'Lucas Escobar','Lucassss@gmail.com','Hola, quería consultar si tienen disponible la RTX 4070 Super y si hacen envíos a Uruguay',1,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(2,'Valentina López','valentina.lopez@test.com','Buen día, hice una compra por transferencia hace 2 días y sigue pendiente. ¿Me confirman si impactó el pago?',0,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(3,'Mateo Fernández','mateo.fernandez@test.com','¿La mother ASUS ROG Strix B550-F ya viene con la BIOS actualizada para la serie 5000 de Ryzen?',1,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(4,'Camila Rodríguez','cami.rodriguez@hotmail.com','Necesito armar una PC para diseño gráfico. ¿Tienen algún presupuesto armado con Intel i9?',0,'2026-06-14 02:57:46','2026-06-14 02:57:46');
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favoritos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint unsigned NOT NULL,
  `producto_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favoritos_usuario_id_producto_id_unique` (`usuario_id`,`producto_id`),
  KEY `favoritos_producto_id_foreign` (`producto_id`),
  CONSTRAINT `favoritos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favoritos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritos`
--

LOCK TABLES `favoritos` WRITE;
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
INSERT INTO `favoritos` VALUES (1,2,2,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(2,2,6,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(3,3,10,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(4,3,9,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(5,4,3,'2026-06-14 02:57:46','2026-06-14 02:57:46');
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_15_024921_create_rols_table',1),(5,'2026_05_15_024931_create_usuarios_table',1),(6,'2026_05_20_024134_create_productos_table',1),(7,'2026_05_22_000001_create_categorias_table',1),(8,'2026_05_22_000002_modify_productos_add_categoria_id',1),(9,'2026_06_03_191453_create_consultas_table',1),(10,'2026_06_05_183928_create_venta_cabecera_table',1),(11,'2026_06_05_183942_create_ventas_detalle_table',1),(12,'2026_06_06_202000_fix_venta_cabecera_user_id_fk',1),(13,'2026_06_06_210154_add_pedido_fields_to_venta_cabecera',1),(14,'2026_06_10_000001_create_favoritos_table',1),(15,'2026_06_10_000002_add_codigo_seguimiento_to_venta_cabecera',1),(16,'2026_06_10_000003_create_resenas_table',1),(17,'2026_06_11_025338_add_descuento_porcentaje_to_productos_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria_id` bigint unsigned DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `especificaciones` json DEFAULT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `descuento_porcentaje` decimal(5,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_nombre_unique` (`nombre`),
  KEY `productos_categoria_id_foreign` (`categoria_id`),
  CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'NVIDIA RTX 4070 Super',2,'La RTX 4070 Super ofrece rendimiento excepcional en 1440p y es capaz de mover títulos exigentes en 4K con ray tracing.','[\"12 GB GDDR6X\", \"DLSS 3.5 con Frame Generation\", \"Ray Tracing de 3ra generación\"]',750000.00,1050000.00,10.00,8,'productos/rtx4070.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(2,'NVIDIA RTX 5090',2,'La GPU más potente del mercado. Rendimiento sin igual para entusiastas.','[\"32 GB GDDR7\", \"DLSS 4 con Multi Frame Generation\"]',2200000.00,2800000.00,0.00,3,'productos/rtx5090.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(3,'AMD RX 6600 XT',2,'Excelente relación precio-rendimiento para 1080p gaming.','[\"8 GB GDDR6\", \"128-bit bus\"]',280000.00,390000.00,15.00,9,'productos/rx6600xt.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(4,'AMD Ryzen 7 7800X3D',2,'El procesador gaming más rápido gracias a la tecnología 3D V-Cache.','[\"8 núcleos / 16 hilos\", \"3D V-Cache de 96 MB\"]',420000.00,620000.00,5.00,12,'productos/r7.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(5,'AMD Ryzen 5 5600G',2,'Procesador con gráficos integrados Radeon Vega.','[\"6 núcleos / 12 hilos\", \"GPU integrada Radeon Vega 7\"]',160000.00,230000.00,0.00,11,'productos/ryzen55600g.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(6,'Intel Core i9-14900K',2,'El procesador de escritorio más potente de Intel.','[\"24 núcleos (8P + 16E)\", \"Boost Clock: 6.0 GHz\"]',550000.00,780000.00,0.00,6,'productos/i9-14900k.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(7,'ASUS ROG Strix B550-F Gaming',2,'Motherboard ATX con soporte para Ryzen 5000 y 3000.','[\"Socket AM4\", \"DDR4 hasta 4400 MHz\"]',180000.00,260000.00,10.00,7,'productos/asus-b550f.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(8,'Corsair Vengeance DDR5 32GB',2,'Kit de memoria DDR5 de alta velocidad.','[\"32 GB (2x16 GB)\", \"DDR5-6000 MHz\"]',120000.00,170000.00,20.00,15,'productos/ram.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(9,'Samsung 980 Pro 2TB NVMe',2,'SSD NVMe PCIe 4.0 de alto rendimiento.','[\"2 TB de capacidad\", \"Lectura: 7000 MB/s\"]',130000.00,185000.00,0.00,12,'productos/samsung-980pro.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(10,'Corsair iCUE H150i Elite LCD',2,'Refrigeración líquida AIO de 360mm con pantalla LCD.','[\"Radiador 360mm\", \"Display LCD IPS 2.1\\\"\"]',160000.00,230000.00,5.00,8,'productos/corsair-h150i.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(11,'Corsair RM750x 750W',2,'Fuente de alimentación modular 80 PLUS Gold.','[\"750W de potencia\", \"80 PLUS Gold\"]',110000.00,158000.00,0.00,10,'productos/corsair-rm750x.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(12,'NZXT H5 Flow',2,'Gabinete ATX minimalista con panel frontal mesh.','[\"Factor ATX Mid-Tower\", \"Panel frontal mesh\"]',95000.00,135000.00,10.00,7,'productos/nzxt-h5.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(13,'PlayStation 5',1,'La consola de nueva generación de Sony.','[\"CPU: AMD Zen 2\", \"SSD: 825 GB\"]',600000.00,850000.00,0.00,5,'productos/ps5.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(14,'Xbox Series X',1,'La consola más potente de Microsoft.','[\"CPU: AMD Zen 2\", \"GPU: 12 TFLOPS\"]',550000.00,780000.00,0.00,4,'productos/xboxx.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(15,'Steam Deck OLED',1,'PC gaming portátil de Valve.','[\"Pantalla OLED 7.4\\\"\", \"Batería: hasta 12 horas\"]',400000.00,580000.00,5.00,6,'productos/steam-deck.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(16,'Nintendo Switch OLED',1,'La versión mejorada de Switch con pantalla OLED.','[\"Pantalla OLED 7\\\"\", \"64 GB almacenamiento\"]',280000.00,390000.00,0.00,10,'productos/switch.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(17,'Nintendo Switch 2',1,'La nueva generación de la consola híbrida.','[\"Pantalla LCD 7.9\\\"\", \"RAM: 12 GB\"]',350000.00,490000.00,0.00,3,'productos/sw2.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(18,'HyperX Cloud II',3,'Auriculares gaming con sonido envolvente.','[\"Drivers 53mm\", \"Sonido virtual 7.1\"]',65000.00,92000.00,25.00,14,'productos/hyperx-cloud2.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(19,'Logitech G Pro X Superlight 2',3,'Mouse gaming ultraliviano.','[\"Sensor HERO 2\", \"Peso: <60g\"]',85000.00,120000.00,0.00,9,'productos/logitech-gpro.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(20,'Razer BlackWidow V4',3,'Teclado mecánico gaming.','[\"Switches Razer Yellow\", \"RGB Chroma\"]',75000.00,108000.00,10.00,11,'productos/razer-blackwidow.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(21,'DualSense PlayStation 5',3,'El control oficial de PS5.','[\"Gatillos adaptativos\", \"Háptica\"]',55000.00,78000.00,0.00,0,'productos/mando-ps5.webp','2026-06-14 02:57:46','2026-06-14 03:01:21',NULL),(22,'Xbox Elite Controller Series 2',3,'El control más premium de Microsoft.','[\"Palancas intercambiables\", \"Batería: 40hs\"]',90000.00,128000.00,5.00,8,'productos/xbox-elite.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(23,'HyperX QuadCast S',3,'Micrófono de condensador USB.','[\"4 patrones polares\", \"RGB\"]',70000.00,99000.00,15.00,10,'productos/mic-quadcast.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(24,'Thrustmaster T300RS GT',3,'Volante de carreras con fuerza de retorno.','[\"Rotación 1080°\", \"Force Feedback\"]',220000.00,310000.00,0.00,3,'productos/tm.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(25,'ASUS ROG Swift Pro PG248QP',4,'Monitor gaming Full HD de 360Hz.','[\"24\\\" FHD\", \"360Hz\"]',350000.00,490000.00,0.00,4,'productos/monitor-asus-360hz.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(26,'LG UltraGear 27GP950-B',4,'Monitor 4K de 144Hz.','[\"27\\\" 4K\", \"144Hz\"]',220000.00,308000.00,10.00,6,'productos/monitor-lg-27.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(27,'Samsung Odyssey G7 32\"',4,'Monitor gaming curvo QLED de 240Hz.','[\"32\\\" 2K\", \"240Hz\"]',280000.00,392000.00,15.00,5,'productos/monitor-samsung-g7.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(28,'LG OLED C3 55\"',4,'Smart TV OLED con 4 puertos HDMI 2.1.','[\"55\\\" OLED 4K 120Hz\", \"HDR\"]',650000.00,910000.00,0.00,3,'productos/tv-lg-oled55.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(29,'Samsung Neo QLED 8K 55\"',4,'TV 8K con tecnología Quantum Matrix Pro.','[\"55\\\" 8K\", \"Upscaling IA\"]',900000.00,1260000.00,5.00,2,'productos/tv-samsung-8k.webp','2026-06-14 02:57:46','2026-06-14 02:57:46',NULL);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resenas`
--

DROP TABLE IF EXISTS `resenas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resenas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint unsigned NOT NULL,
  `producto_id` bigint unsigned NOT NULL,
  `venta_id` bigint unsigned NOT NULL,
  `calificacion` tinyint unsigned NOT NULL,
  `comentario` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resenas_venta_id_producto_id_unique` (`venta_id`,`producto_id`),
  KEY `resenas_usuario_id_foreign` (`usuario_id`),
  KEY `resenas_producto_id_foreign` (`producto_id`),
  CONSTRAINT `resenas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resenas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resenas_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `venta_cabecera` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resenas`
--

LOCK TABLES `resenas` WRITE;
/*!40000 ALTER TABLE `resenas` DISABLE KEYS */;
INSERT INTO `resenas` VALUES (1,2,1,1,5,'Una bestia. Corre el Cyberpunk 2077 en Ultra sin transpirar. El envío llegó perfecto con Andreani.','2026-06-14 02:57:46','2026-06-14 02:57:46'),(2,2,4,2,4,'Excelente procesador, las temperaturas son un poco altas pero con una buena líquida se soluciona.','2026-06-14 02:57:46','2026-06-14 02:57:46'),(3,4,5,10,5,'Calidad precio imbatible. Los gráficos integrados zafan muy bien para e-sports como el CS2.','2026-06-14 02:57:46','2026-06-14 02:57:46'),(4,2,8,1,5,'Funciona perfecto','2026-06-14 02:58:19','2026-06-14 02:58:19'),(5,4,7,10,5,'Estoy empezando a armar mi pc y este motherboard es la mejor calidad-precio','2026-06-14 02:59:16','2026-06-14 02:59:16');
/*!40000 ALTER TABLE `resenas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrador del sistema','2026-06-14 02:57:45','2026-06-14 02:57:45',NULL),(2,'cliente','Cliente del ecommerce','2026-06-14 02:57:45','2026-06-14 02:57:45',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('97u3IFFtVF0J99LX6yaUXUQsFhncsuaevidCaLxt',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','eyJfdG9rZW4iOiIyUlJHZHR4SDRndWdKY3p1U1hkTWFYWlllbjFwR01oN1B2ekFPODhrIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvcHJveWVjdG8tZ2FtaW5nc3RvcmUudGVzdFwvY2Fycml0b1wvZGF0b3MiLCJyb3V0ZSI6ImNhcnJpdG8uZGF0b3MifX0=',1781395469);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol_id` bigint unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  KEY `usuarios_rol_id_foreign` (`rol_id`),
  CONSTRAINT `usuarios_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Admin','admin@gamingstation.com','$2y$12$R7cR8LuDEU4cbxqjvV5.LOllU9hFx4nlP5Rv9GGTXH8Jc/GM.rogq',1,NULL,'2026-06-14 02:57:45','2026-06-14 02:57:45',NULL),(2,'Lucas García','lucas.garcia@test.com','$2y$12$Xgv7dXggGoqVvuMT7Hf6LeTZww.Ws9aTabpMFZAbuNWOdQocmjDN6',2,NULL,'2026-06-14 02:57:45','2026-06-14 02:57:45',NULL),(3,'Valentina López','valentina.lopez@test.com','$2y$12$aecglHQ0LMfwt5VQfFos8OvnLmgtl184pDRwbuM0hAhlAOl/HWCRK',2,NULL,'2026-06-14 02:57:46','2026-06-14 02:57:46',NULL),(4,'Mateo Fernández','mateo.fernandez@test.com','$2y$12$Lk/hs.8RWAxExKN1Wy/Fx.R7LgCgryHz0dtKVNaiYI9.WE9T3CFKC',2,NULL,'2026-06-14 02:57:46','2026-06-14 02:57:46',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_cabecera`
--

DROP TABLE IF EXISTS `venta_cabecera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venta_cabecera` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fecha_venta` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'carrito',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `numero_pedido` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_cliente` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido_cliente` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_cliente` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_cliente` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_envio` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transporte` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_seguimiento` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provincia` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localidad` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calle` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `costo_envio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `metodo_pago` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `venta_cabecera_numero_pedido_unique` (`numero_pedido`),
  KEY `venta_cabecera_user_id_foreign` (`user_id`),
  CONSTRAINT `venta_cabecera_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_cabecera`
--

LOCK TABLES `venta_cabecera` WRITE;
/*!40000 ALTER TABLE `venta_cabecera` DISABLE KEYS */;
INSERT INTO `venta_cabecera` VALUES (1,'2026-05-10 02:57:46',2,'completado',1402500.00,'PED-SEED-001','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','domicilio','Andreani',NULL,'Buenos Aires','La Plata','Av. 7 Nro. 1234','1900',12500.00,'tarjeta','2026-06-14 02:57:46','2026-06-14 02:57:46'),(2,'2026-05-27 02:57:46',2,'entregado',818900.00,'PED-SEED-002','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','domicilio','Correo Argentino',NULL,'Buenos Aires','La Plata','Av. 7 Nro. 1234','1900',13900.00,'transferencia','2026-06-14 02:57:46','2026-06-14 02:57:46'),(3,'2026-06-09 02:57:46',2,'en_camino',242500.00,'PED-SEED-003','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','domicilio','Andreani',NULL,'Buenos Aires','La Plata','Av. 7 Nro. 1234','1900',12500.00,'tarjeta','2026-06-14 02:57:46','2026-06-14 02:57:46'),(4,'2026-06-13 02:57:46',2,'pendiente',490000.00,'PED-SEED-004','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','retiro',NULL,NULL,NULL,NULL,NULL,NULL,0.00,'tarjeta','2026-06-14 02:57:46','2026-06-14 02:57:46'),(5,'2026-06-12 02:57:46',3,'pendiente',2813900.00,'PED-SEED-005','Valentina','López','valentina.lopez@test.com','+54 351 444-7890','domicilio','Correo Argentino',NULL,'Córdoba','Córdoba Capital','Bv. San Juan 459','5000',13900.00,'transferencia','2026-06-14 02:57:46','2026-06-14 02:57:46'),(6,'2026-06-10 02:57:46',3,'en_proceso',1062500.00,'PED-SEED-006','Valentina','López','valentina.lopez@test.com','+54 351 444-7890','domicilio','Andreani',NULL,'Córdoba','Córdoba Capital','Bv. San Juan 459','5000',12500.00,'tarjeta','2026-06-14 02:57:46','2026-06-14 02:57:46'),(7,'2026-06-02 02:57:46',3,'cancelado',780000.00,'PED-SEED-007','Valentina','López','valentina.lopez@test.com','+54 351 444-7890','retiro',NULL,NULL,NULL,NULL,NULL,NULL,0.00,'tarjeta','2026-06-14 02:57:46','2026-06-14 02:57:46'),(8,'2026-06-08 02:57:46',4,'enviado',587500.00,'PED-SEED-008','Mateo','Fernández','mateo.fernandez@test.com','+54 341 522-6600','domicilio','Andreani',NULL,'Santa Fe','Rosario','Av. Pellegrini 1800','2000',12500.00,'transferencia','2026-06-14 02:57:46','2026-06-14 02:57:46'),(9,'2026-06-11 02:57:46',4,'en_proceso',583900.00,'PED-SEED-009','Mateo','Fernández','mateo.fernandez@test.com','+54 341 522-6600','domicilio','Correo Argentino',NULL,'Santa Fe','Rosario','Av. Pellegrini 1800','2000',13900.00,'tarjeta','2026-06-14 02:57:46','2026-06-14 02:57:46'),(10,'2026-05-23 02:57:46',4,'completado',675000.00,'PED-SEED-010','Mateo','Fernández','mateo.fernandez@test.com','+54 341 522-6600','retiro',NULL,NULL,NULL,NULL,NULL,NULL,0.00,'tarjeta','2026-06-14 02:57:46','2026-06-14 02:57:46'),(11,'2026-04-15 02:57:46',2,'cancelado',390000.00,'PED-SEED-011','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','retiro',NULL,NULL,NULL,NULL,NULL,NULL,0.00,'transferencia','2026-06-14 02:57:46','2026-06-14 02:57:46'),(12,'2026-06-13 21:57:46',4,'pendiente',792500.00,'PED-SEED-012','Mateo','Fernández','mateo.fernandez@test.com','+54 341 522-6600','domicilio','Andreani',NULL,'Santa Fe','Rosario','Av. Pellegrini 1800','2000',12500.00,'tarjeta','2026-06-14 02:57:46','2026-06-14 02:57:46');
/*!40000 ALTER TABLE `venta_cabecera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_detalle`
--

DROP TABLE IF EXISTS `ventas_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas_detalle` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `venta_id` bigint unsigned NOT NULL,
  `producto_id` bigint unsigned NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_detalle_venta_id_foreign` (`venta_id`),
  KEY `ventas_detalle_producto_id_foreign` (`producto_id`),
  CONSTRAINT `ventas_detalle_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  CONSTRAINT `ventas_detalle_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `venta_cabecera` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_detalle`
--

LOCK TABLES `ventas_detalle` WRITE;
/*!40000 ALTER TABLE `ventas_detalle` DISABLE KEYS */;
INSERT INTO `ventas_detalle` VALUES (1,1,1,1,1050000.00,1050000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(2,1,8,2,170000.00,340000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(3,2,4,1,620000.00,620000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(4,2,9,1,185000.00,185000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(5,3,10,1,230000.00,230000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(6,4,7,1,260000.00,260000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(7,4,5,1,230000.00,230000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(8,5,2,1,2800000.00,2800000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(9,6,4,1,620000.00,620000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(10,6,7,1,260000.00,260000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(11,6,8,1,170000.00,170000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(12,7,6,1,780000.00,780000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(13,8,3,1,390000.00,390000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(14,8,9,1,185000.00,185000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(15,9,10,1,230000.00,230000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(16,9,8,2,170000.00,340000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(17,10,5,1,230000.00,230000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(18,10,7,1,260000.00,260000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(19,10,9,1,185000.00,185000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(20,11,3,1,390000.00,390000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46'),(21,12,6,1,780000.00,780000.00,'2026-06-14 02:57:46','2026-06-14 02:57:46');
/*!40000 ALTER TABLE `ventas_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'gamingstore_grupo25'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-13 21:12:01

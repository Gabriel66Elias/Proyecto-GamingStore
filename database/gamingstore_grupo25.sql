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
INSERT INTO `categorias` VALUES (1,'Consolas','2026-06-14 01:03:14','2026-06-14 01:03:14'),(2,'Hardware','2026-06-14 01:03:14','2026-06-14 01:03:14'),(3,'Periféricos','2026-06-14 01:03:14','2026-06-14 01:03:14'),(4,'TV & Monitores','2026-06-14 01:03:14','2026-06-14 01:03:14');
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
INSERT INTO `consultas` VALUES (1,'Lucas Escobar','Lucassss@gmail.com','Hola, quería consultar si tienen disponible la RTX 4070 Super y si hacen envíos a Uruguay',1,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(2,'Valentina López','valentina.lopez@test.com','Buen día, hice una compra por transferencia hace 2 días y sigue pendiente. ¿Me confirman si impactó el pago?',0,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(3,'Mateo Fernández','mateo.fernandez@test.com','¿La mother ASUS ROG Strix B550-F ya viene con la BIOS actualizada para la serie 5000 de Ryzen?',1,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(4,'Camila Rodríguez','cami.rodriguez@hotmail.com','Necesito armar una PC para diseño gráfico. ¿Tienen algún presupuesto armado con Intel i9?',0,'2026-06-14 01:03:14','2026-06-14 01:03:14');
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
INSERT INTO `favoritos` VALUES (1,2,2,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(2,2,6,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(3,3,10,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(4,3,9,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(5,4,3,'2026-06-14 01:03:14','2026-06-14 01:03:14');
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
INSERT INTO `productos` VALUES (1,'NVIDIA RTX 4070 Super',2,'La RTX 4070 Super ofrece rendimiento excepcional en 1440p y es capaz de mover títulos exigentes en 4K con ray tracing. Incluye soporte para DLSS 3.5 y Frame Generation.','[\"12 GB GDDR6X\", \"DLSS 3.5 con Frame Generation\", \"Ray Tracing de 3ra generación\", \"Boost Clock: 2475 MHz\", \"Consumo: 220W TDP\"]',750000.00,1050000.00,NULL,8,'productos/rtx4070.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(2,'NVIDIA RTX 5090',2,'La GPU más potente del mercado. Diseñada para 4K y 8K gaming con DLSS 4 y Multi Frame Generation. Rendimiento sin igual para los entusiastas más exigentes.','[\"32 GB GDDR7\", \"DLSS 4 con Multi Frame Generation\", \"512-bit bus\", \"Boost Clock: 2.9 GHz\", \"Consumo: 575W TDP\"]',2200000.00,2800000.00,NULL,3,'productos/rtx5090.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(3,'AMD RX 6600 XT',2,'Excelente relación precio-rendimiento para 1080p gaming. Ideal para armar un PC gaming de entrada sin sacrificar fluidez en los títulos más populares.','[\"8 GB GDDR6\", \"128-bit bus\", \"Boost Clock: 2589 MHz\", \"Consumo: 160W TDP\", \"Compatible con FidelityFX Super Resolution\"]',280000.00,390000.00,NULL,9,'productos/rx6600xt.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(4,'AMD Ryzen 7 7800X3D',2,'El procesador gaming más rápido gracias a la tecnología 3D V-Cache. Domina en juegos a 1080p y 1440p superando a cualquier rival en títulos optimizados.','[\"8 núcleos / 16 hilos\", \"3D V-Cache de 96 MB\", \"Boost Clock: 5.0 GHz\", \"TDP: 120W\", \"Socket AM5\"]',420000.00,620000.00,NULL,12,'productos/r7.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(5,'AMD Ryzen 5 5600G',2,'Procesador con gráficos integrados Radeon Vega. Perfecta solución para armar un PC sin GPU dedicada, con capacidad para gaming casual en 1080p.','[\"6 núcleos / 12 hilos\", \"GPU integrada Radeon Vega 7\", \"Boost Clock: 4.4 GHz\", \"TDP: 65W\", \"Socket AM4\"]',160000.00,230000.00,NULL,11,'productos/ryzen55600g.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(6,'Intel Core i9-14900K',2,'El procesador de escritorio más potente de Intel. 24 núcleos para tareas de creación de contenido y gaming de alto rendimiento en simultáneo.','[\"24 núcleos (8P + 16E)\", \"Boost Clock: 6.0 GHz\", \"Cache L3: 36 MB\", \"TDP: 125W (PBP)\", \"Socket LGA1700\"]',550000.00,780000.00,NULL,6,'productos/i9-14900k.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(7,'ASUS ROG Strix B550-F Gaming',2,'Motherboard ATX con soporte para Ryzen 5000 y 3000. Diseño robusto, PCIe 4.0, conectividad WiFi 6 y audio SupremeFX de alta fidelidad.','[\"Socket AM4\", \"DDR4 hasta 4400 MHz\", \"PCIe 4.0 x16\", \"WiFi 6 integrado\", \"2.5Gb Ethernet\"]',180000.00,260000.00,NULL,7,'productos/asus-b550f.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(8,'Corsair Vengeance DDR5 32GB',2,'Kit de memoria DDR5 de alta velocidad para plataformas Intel y AMD de última generación. Optimizado para overclocking con perfil XMP 3.0.','[\"32 GB (2x16 GB)\", \"DDR5-6000 MHz\", \"CL30\", \"XMP 3.0\", \"Disipador de aluminio de bajo perfil\"]',120000.00,170000.00,NULL,15,'productos/ram.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(9,'Samsung 980 Pro 2TB NVMe',2,'SSD NVMe PCIe 4.0 de alto rendimiento con velocidades de lectura de hasta 7000 MB/s. Ideal para acortar tiempos de carga y manejar proyectos pesados.','[\"2 TB de capacidad\", \"Lectura: 7000 MB/s\", \"Escritura: 6900 MB/s\", \"PCIe 4.0 x4 NVMe 1.3c\", \"Factor de forma: M.2 2280\"]',130000.00,185000.00,NULL,12,'productos/samsung-980pro.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(10,'Corsair iCUE H150i Elite LCD',2,'Refrigeración líquida AIO de 360mm con pantalla LCD integrada de 2.1\". Control total de velocidad de ventiladores y bomba vía software iCUE.','[\"Radiador 360mm\", \"Display LCD IPS 2.1\\\"\", \"3 ventiladores LL120 RGB\", \"Compatible LGA1700, AM5, AM4\", \"Control por software iCUE\"]',160000.00,230000.00,NULL,8,'productos/corsair-h150i.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(11,'Corsair RM750x 750W',2,'Fuente de alimentación modular 80 PLUS Gold con ventilador ZeroRPM en cargas bajas. Construida para sistemas gaming de alto rendimiento.','[\"750W de potencia\", \"80 PLUS Gold\", \"Totalmente modular\", \"Ventilador 135mm ZeroRPM\", \"Garantía 10 años\"]',110000.00,158000.00,NULL,10,'productos/corsair-rm750x.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(12,'NZXT H5 Flow',2,'Gabinete ATX minimalista con panel frontal mesh para máximo flujo de aire. Diseño interior limpio con soporte para AIOs de hasta 360mm.','[\"Factor ATX Mid-Tower\", \"Panel frontal mesh\", \"Soporte AIO 360mm frontal\", \"2x USB-A + 1x USB-C frontal\", \"Vidrio templado lateral\"]',95000.00,135000.00,NULL,7,'productos/nzxt-h5.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(13,'PlayStation 5',1,'La consola de nueva generación de Sony con SSD ultrarrápido, ray tracing nativo y el innovador control DualSense con retroalimentación háptica y gatillos adaptativos.','[\"CPU: AMD Zen 2, 8 núcleos a 3.5 GHz\", \"GPU: 10.28 TFLOPS, 36 CUs a 2.23 GHz\", \"SSD: 825 GB (5.5 GB/s)\", \"RAM: 16 GB GDDR6\", \"Resolución: hasta 8K\"]',600000.00,850000.00,NULL,5,'productos/ps5.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(14,'Xbox Series X',1,'La consola más potente de Microsoft con 12 TFLOPS de rendimiento. Compatible con miles de juegos de Xbox One, 360 y Xbox original mediante retrocompatibilidad.','[\"CPU: AMD Zen 2, 8 núcleos a 3.8 GHz\", \"GPU: 12 TFLOPS RDNA 2\", \"SSD: 1 TB NVMe\", \"RAM: 16 GB GDDR6\", \"Resolución: hasta 4K 120fps\"]',550000.00,780000.00,NULL,4,'productos/xboxx.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(15,'Steam Deck OLED',1,'PC gaming portátil de Valve con pantalla OLED HDR de 7.4\". Corré tu biblioteca completa de Steam en cualquier lugar con hasta 12 horas de batería.','[\"Pantalla OLED 7.4\\\" HDR 90Hz\", \"CPU: AMD Zen 2 + GPU RDNA 2\", \"RAM: 16 GB LPDDR5\", \"SSD: 512 GB NVMe\", \"Batería: hasta 12 horas\"]',400000.00,580000.00,NULL,6,'productos/steam-deck.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(16,'Nintendo Switch OLED',1,'La versión mejorada de Switch con pantalla OLED de 7\" y mayor almacenamiento. Jugá en TV, sobremesa o modo portátil con los mismos controles Joy-Con.','[\"Pantalla OLED 7\\\" 720p\", \"64 GB de almacenamiento interno\", \"Slot microSD\", \"Batería: 4.5-9 horas\", \"Dock con LAN integrada\"]',280000.00,390000.00,NULL,10,'productos/switch.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(17,'Nintendo Switch 2',1,'La nueva generación de la consola híbrida de Nintendo. Mayor potencia, pantalla más grande y nuevas funciones para el modo multijugador local.','[\"Pantalla LCD 7.9\\\" 1080p\", \"Procesador NVIDIA mejorado\", \"RAM: 12 GB\", \"Almacenamiento: 256 GB\", \"Batería: hasta 6 horas\"]',350000.00,490000.00,NULL,3,'productos/sw2.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(18,'HyperX Cloud II',3,'Auriculares gaming con drivers de 53mm y sonido envolvente virtual 7.1. Micrófono desmontable con cancelación de ruido y compatibilidad multiplataforma.','[\"Drivers 53mm\", \"Sonido virtual 7.1\", \"Micrófono desmontable\", \"Frecuencia: 15Hz-25kHz\", \"Compatible PC, PS4, Xbox, Switch\"]',65000.00,92000.00,NULL,14,'productos/hyperx-cloud2.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(19,'Logitech G Pro X Superlight 2',3,'Mouse gaming ultraliviano de menos de 60g con sensor HERO 2 de 32000 DPI. El mouse preferido por los jugadores profesionales de esports a nivel mundial.','[\"Sensor HERO 2 — 32000 DPI\", \"Peso: menos de 60g\", \"Conexión inalámbrica LIGHTSPEED\", \"Batería: hasta 95 horas\", \"5 botones programables\"]',85000.00,120000.00,NULL,9,'productos/logitech-gpro.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(20,'Razer BlackWidow V4',3,'Teclado mecánico gaming con switches Razer Yellow de activa lineal. RGB Chroma con 16.8M de colores y teclas multimedia dedicadas.','[\"Switches Razer Yellow (lineales)\", \"RGB Chroma por tecla\", \"Teclas multimedia dedicadas\", \"Reposamuñecas magnético\", \"Anti-ghosting completo\"]',75000.00,108000.00,NULL,11,'productos/razer-blackwidow.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(21,'DualSense PlayStation 5',3,'El control oficial de PS5 con retroalimentación háptica y gatillos adaptativos que simulan resistencia física. Micrófono y parlante integrados.','[\"Gatillos adaptativos L2/R2\", \"Retroalimentación háptica\", \"Micrófono y parlante integrados\", \"USB-C + Bluetooth 5.1\", \"Batería recargable\"]',55000.00,78000.00,NULL,16,'productos/mando-ps5.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(22,'Xbox Elite Controller Series 2',3,'El control más premium de Microsoft con palancas intercambiables, gatillos con recorrido ajustable y batería recargable de hasta 40 horas.','[\"Palancas y D-pad intercambiables\", \"Gatillos con recorrido ajustable\", \"Batería: hasta 40 horas\", \"Conexión inalámbrica + USB-C\", \"Memoriza hasta 3 perfiles\"]',90000.00,128000.00,NULL,8,'productos/xbox-elite.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(23,'HyperX QuadCast S',3,'Micrófono de condensador USB con iluminación RGB y cuatro patrones polares seleccionables. Ideal para streaming, podcasting y comunicación en juego.','[\"4 patrones polares\", \"Frecuencia: 20Hz-20kHz\", \"Resolución: 24 bit / 96kHz\", \"LED RGB personalizable\", \"Conexión USB-A y USB-C\"]',70000.00,99000.00,NULL,10,'productos/mic-quadcast.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(24,'Thrustmaster T300RS GT',3,'Volante de carreras con motor de doble correa y fuerza de retorno de 1080°. Compatible con PlayStation y PC, incluye pedales de dos ejes.','[\"Rotación: 1080°\", \"Motor dual belt force feedback\", \"Compatible PS5, PS4, PC\", \"Pedales de 2 ejes incluidos\", \"Hub de volante intercambiable\"]',220000.00,310000.00,NULL,3,'productos/tm.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(25,'ASUS ROG Swift Pro PG248QP',4,'Monitor gaming Full HD de 360Hz con tecnología NVIDIA G-Sync. Diseñado específicamente para jugadores competitivos que necesitan cada fotograma.','[\"24\\\" Full HD 1920x1080\", \"360Hz con NVIDIA G-Sync\", \"1ms GtG\", \"Panel TN\", \"HDMI 2.0 + DisplayPort 1.4\"]',350000.00,490000.00,NULL,4,'productos/monitor-asus-360hz.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(26,'LG UltraGear 27GP950-B',4,'Monitor 4K de 144Hz con panel Nano IPS y HDMI 2.1. Perfecto para PS5 y Xbox Series X aprovechando al máximo la resolución y tasa de refresco.','[\"27\\\" 4K UHD 3840x2160\", \"144Hz con HDMI 2.1\", \"1ms GtG Nano IPS\", \"NVIDIA G-Sync + AMD FreeSync\", \"HDR 600\"]',220000.00,308000.00,NULL,6,'productos/monitor-lg-27.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(27,'Samsung Odyssey G7 32\"',4,'Monitor gaming curvo QLED de 240Hz con resolución 2K. La curvatura 1000R cubre todo tu campo visual para una inmersión total en el juego.','[\"32\\\" 2K QHD 2560x1440\", \"240Hz\", \"1ms MPRT\", \"Curvatura 1000R QLED\", \"G-Sync Compatible + FreeSync Premium Pro\"]',280000.00,392000.00,NULL,5,'productos/monitor-samsung-g7.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(28,'LG OLED C3 55\"',4,'Smart TV OLED con 4 puertos HDMI 2.1 y soporte para 4K 120fps. Negros perfectos, contraste infinito y procesador α9 Gen6 para una imagen excepcional.','[\"55\\\" OLED 4K 120Hz\", \"4x HDMI 2.1\", \"Dolby Vision IQ + Dolby Atmos\", \"Procesador α9 Gen6\", \"webOS 23 con ThinQ AI\"]',650000.00,910000.00,NULL,3,'productos/tv-lg-oled55.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL),(29,'Samsung Neo QLED 8K 55\"',4,'TV 8K con tecnología Quantum Matrix Pro y upscaling de inteligencia artificial. La experiencia visual más avanzada disponible para el hogar.','[\"55\\\" 8K UHD 7680x4320\", \"Quantum Matrix Pro\", \"AI 8K Upscaling Neural Quantum\", \"4x HDMI 2.1\", \"Tizen OS con Gaming Hub\"]',900000.00,1260000.00,NULL,2,'productos/tv-samsung-8k.webp','2026-06-14 01:03:14','2026-06-14 01:03:14',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resenas`
--

LOCK TABLES `resenas` WRITE;
/*!40000 ALTER TABLE `resenas` DISABLE KEYS */;
INSERT INTO `resenas` VALUES (1,2,1,1,5,'Una bestia. Corre el Cyberpunk 2077 en Ultra sin transpirar. El envío llegó perfecto con Andreani.','2026-06-14 01:03:14','2026-06-14 01:03:14'),(2,2,4,2,4,'Excelente procesador, las temperaturas son un poco altas pero con una buena líquida se soluciona.','2026-06-14 01:03:14','2026-06-14 01:03:14'),(3,4,5,10,5,'Calidad precio imbatible. Los gráficos integrados zafan muy bien para e-sports como el CS2.','2026-06-14 01:03:14','2026-06-14 01:03:14'),(4,2,8,1,5,'Funciona perfecto','2026-06-14 01:04:46','2026-06-14 01:04:46');
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
INSERT INTO `roles` VALUES (1,'admin','Administrador del sistema','2026-06-14 01:03:13','2026-06-14 01:03:13',NULL),(2,'cliente','Cliente del ecommerce','2026-06-14 01:03:13','2026-06-14 01:03:13',NULL);
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
INSERT INTO `sessions` VALUES ('Aj3mGag3vTMR3nRVKty4V5sGWKPN9Jzyvcoc2CaZ',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJDRW5KQjY4eWxkNWVrM0NxS0lhV0N0MnBZcFlDQ0Mwam1aU3FYOExtIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvcHJveWVjdG8tZ2FtaW5nc3RvcmUudGVzdFwvY2Fycml0b1wvZGF0b3MiLCJyb3V0ZSI6ImNhcnJpdG8uZGF0b3MifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9',1781388407);
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
INSERT INTO `usuarios` VALUES (1,'Admin','admin@gamingstation.com','$2y$12$pxLNjZvEUP4CRk.DqM6uXuuxpEWwbtd7MMtBUf2SEKsHwCgZ52TWq',1,NULL,'2026-06-14 01:03:13','2026-06-14 01:03:13',NULL),(2,'Lucas García','lucas.garcia@test.com','$2y$12$8/ftp6Pb8vc9n0C6jQYn6OLIqxM94nMTYw2PE4FUxWU1Q8/gmCqDS',2,NULL,'2026-06-14 01:03:13','2026-06-14 01:03:13',NULL),(3,'Valentina López','valentina.lopez@test.com','$2y$12$C5f9lHwbTC0qICPxiFbZK.0jMpDDguQcWFlm2wTqVv3FNNxRlxZqq',2,NULL,'2026-06-14 01:03:13','2026-06-14 01:03:13',NULL),(4,'Mateo Fernández','mateo.fernandez@test.com','$2y$12$p1zTosIy9qMNDQ5l7g4GCefST3/Oomgy0q216orlJrBo9Mc6PU242',2,NULL,'2026-06-14 01:03:14','2026-06-14 01:03:14',NULL);
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
INSERT INTO `venta_cabecera` VALUES (1,'2026-05-10 01:03:14',2,'completado',1402500.00,'PED-SEED-001','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','domicilio','Andreani',NULL,'Buenos Aires','La Plata','Av. 7 Nro. 1234','1900',12500.00,'tarjeta','2026-06-14 01:03:14','2026-06-14 01:03:14'),(2,'2026-05-27 01:03:14',2,'entregado',818900.00,'PED-SEED-002','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','domicilio','Correo Argentino',NULL,'Buenos Aires','La Plata','Av. 7 Nro. 1234','1900',13900.00,'transferencia','2026-06-14 01:03:14','2026-06-14 01:03:14'),(3,'2026-06-09 01:03:14',2,'en_camino',242500.00,'PED-SEED-003','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','domicilio','Andreani',NULL,'Buenos Aires','La Plata','Av. 7 Nro. 1234','1900',12500.00,'tarjeta','2026-06-14 01:03:14','2026-06-14 01:03:14'),(4,'2026-06-13 01:03:14',2,'pendiente',490000.00,'PED-SEED-004','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','retiro',NULL,NULL,NULL,NULL,NULL,NULL,0.00,'tarjeta','2026-06-14 01:03:14','2026-06-14 01:03:14'),(5,'2026-06-12 01:03:14',3,'pendiente',2813900.00,'PED-SEED-005','Valentina','López','valentina.lopez@test.com','+54 351 444-7890','domicilio','Correo Argentino',NULL,'Córdoba','Córdoba Capital','Bv. San Juan 459','5000',13900.00,'transferencia','2026-06-14 01:03:14','2026-06-14 01:03:14'),(6,'2026-06-10 01:03:14',3,'en_proceso',1062500.00,'PED-SEED-006','Valentina','López','valentina.lopez@test.com','+54 351 444-7890','domicilio','Andreani',NULL,'Córdoba','Córdoba Capital','Bv. San Juan 459','5000',12500.00,'tarjeta','2026-06-14 01:03:14','2026-06-14 01:03:14'),(7,'2026-06-02 01:03:14',3,'cancelado',780000.00,'PED-SEED-007','Valentina','López','valentina.lopez@test.com','+54 351 444-7890','retiro',NULL,NULL,NULL,NULL,NULL,NULL,0.00,'tarjeta','2026-06-14 01:03:14','2026-06-14 01:03:14'),(8,'2026-06-08 01:03:14',4,'enviado',587500.00,'PED-SEED-008','Mateo','Fernández','mateo.fernandez@test.com','+54 341 522-6600','domicilio','Andreani',NULL,'Santa Fe','Rosario','Av. Pellegrini 1800','2000',12500.00,'transferencia','2026-06-14 01:03:14','2026-06-14 01:03:14'),(9,'2026-06-11 01:03:14',4,'en_proceso',583900.00,'PED-SEED-009','Mateo','Fernández','mateo.fernandez@test.com','+54 341 522-6600','domicilio','Correo Argentino',NULL,'Santa Fe','Rosario','Av. Pellegrini 1800','2000',13900.00,'tarjeta','2026-06-14 01:03:14','2026-06-14 01:03:14'),(10,'2026-05-23 01:03:14',4,'completado',675000.00,'PED-SEED-010','Mateo','Fernández','mateo.fernandez@test.com','+54 341 522-6600','retiro',NULL,NULL,NULL,NULL,NULL,NULL,0.00,'tarjeta','2026-06-14 01:03:14','2026-06-14 01:03:14'),(11,'2026-04-15 01:03:14',2,'cancelado',390000.00,'PED-SEED-011','Lucas','García','lucas.garcia@test.com','+54 11 4521-3300','retiro',NULL,NULL,NULL,NULL,NULL,NULL,0.00,'transferencia','2026-06-14 01:03:14','2026-06-14 01:03:14'),(12,'2026-06-13 20:03:14',4,'pendiente',792500.00,'PED-SEED-012','Mateo','Fernández','mateo.fernandez@test.com','+54 341 522-6600','domicilio','Andreani',NULL,'Santa Fe','Rosario','Av. Pellegrini 1800','2000',12500.00,'tarjeta','2026-06-14 01:03:14','2026-06-14 01:03:14');
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
INSERT INTO `ventas_detalle` VALUES (1,1,1,1,1050000.00,1050000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(2,1,8,2,170000.00,340000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(3,2,4,1,620000.00,620000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(4,2,9,1,185000.00,185000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(5,3,10,1,230000.00,230000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(6,4,7,1,260000.00,260000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(7,4,5,1,230000.00,230000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(8,5,2,1,2800000.00,2800000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(9,6,4,1,620000.00,620000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(10,6,7,1,260000.00,260000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(11,6,8,1,170000.00,170000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(12,7,6,1,780000.00,780000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(13,8,3,1,390000.00,390000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(14,8,9,1,185000.00,185000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(15,9,10,1,230000.00,230000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(16,9,8,2,170000.00,340000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(17,10,5,1,230000.00,230000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(18,10,7,1,260000.00,260000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(19,10,9,1,185000.00,185000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(20,11,3,1,390000.00,390000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14'),(21,12,6,1,780000.00,780000.00,'2026-06-14 01:03:14','2026-06-14 01:03:14');
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

-- Dump completed on 2026-06-13 19:10:50

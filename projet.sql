-- MariaDB dump 10.19  Distrib 10.7.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: learn
-- ------------------------------------------------------
-- Server version	10.7.8-MariaDB

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BFDD316812469DE2` (`category_id`),
  CONSTRAINT `FK_BFDD316812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES
(9,'Aiguillettes de poulets au curry',5.99,'Aiguillettes-de-poulet-au-curry.jpg','2024-05-14 09:56:30','2024-05-14 16:01:44',9),
(10,'Moussaka facile',11,'Moussaka-facile.jpg','2024-05-14 08:32:34','2024-05-15 23:17:54',9),
(11,'Amandine aux poires',5.5,'images (15).jpg','2024-05-14 10:51:45','2024-05-14 17:07:05',6),
(12,'Gratin Provencial',7,'Gratin-provencal.png','2024-05-14 10:52:01','2024-05-15 23:18:08',10),
(13,'Brownies sans beurre',6.5,'Brownies-sans-beurre.jpg','2024-05-14 10:52:21','2024-05-14 16:01:32',6),
(14,'Endives au jambon',10,'Endives-au-jambon-facon-regime.jpg','2024-05-14 10:52:38','2024-05-15 23:18:20',9),
(15,'Tartare de tomates',2.9,'Tartare-de-tomate.jpg','2024-05-14 10:52:58','2024-05-15 23:18:32',9),
(16,'Soupe d\'aubergine',7.5,'Soupe-d-aubergine-tomatee-a-l-ail.jpg','2024-05-14 10:53:20','2024-05-15 23:18:43',10),
(17,'Vinaigrette mince',2,'Vinaigrette-minceur.jpg','2024-05-14 16:13:49','2024-05-14 16:13:49',9),
(18,'Mayonnaise sans huile',1.5,'Mayonnaise-sans-huile.jpg','2024-05-14 16:15:03','2024-05-14 16:15:03',6),
(19,'Gratin de choux fleurs',4.5,'Gratin-de-chou-fleur-allege.jpg','2024-05-14 16:15:59','2024-05-14 16:15:59',9),
(20,'Glace au chocolat',5.5,'glacechocolat3.jpg','2024-05-14 17:08:18','2024-05-14 17:13:26',6),
(21,'Glace à la vanille',5,'glacevanille4.jpg','2024-05-14 17:14:22','2024-05-14 17:14:22',6),
(22,'Bavaroise au fraise',1.5,'bavaroisfraise.jpg','2024-05-14 17:16:39','2024-05-14 17:16:39',6),
(24,'Légume vapeur',14,'Legumes-vapeur-a-l-huile-d-olive.png','2024-05-14 18:10:02','2024-05-14 18:10:02',9),
(26,'Vary sy tsaramaso',0.99,'Courgettes-a-la-vapeur.jpg','2024-05-16 10:14:05','2024-05-16 10:14:05',9),
(27,'Vary sy laoka',0.5,'téléchargement (35).jpg','2024-05-16 10:24:14','2024-05-19 00:47:05',9);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES
(6,'Desserts','2024-05-14 15:34:32','2024-05-14 15:34:32'),
(9,'Déjeuner','2024-05-14 16:01:09','2024-05-14 16:01:09'),
(10,'Dîner','2024-05-14 20:35:14','2024-05-14 20:35:14');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `finished` tinyint(1) NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_35D4282CA76ED395` (`user_id`),
  CONSTRAINT `FK_35D4282CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commandes`
--

LOCK TABLES `commandes` WRITE;
/*!40000 ALTER TABLE `commandes` DISABLE KEYS */;
INSERT INTO `commandes` VALUES
(13,15,'2024-06-30 16:04:10',0,57.97),
(14,2,'2024-06-30 16:05:43',1,97.97);
/*!40000 ALTER TABLE `commandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `details`
--

DROP TABLE IF EXISTS `details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commande_id` int(11) NOT NULL,
  `articles_id` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_72260B8A82EA2E54` (`commande_id`),
  KEY `IDX_72260B8A1EBAF6CC` (`articles_id`),
  CONSTRAINT `FK_72260B8A1EBAF6CC` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id`),
  CONSTRAINT `FK_72260B8A82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `details`
--

LOCK TABLES `details` WRITE;
/*!40000 ALTER TABLE `details` DISABLE KEYS */;
INSERT INTO `details` VALUES
(63,13,9,3),
(64,13,10,1),
(65,13,14,1),
(66,13,12,1),
(67,13,13,1),
(68,13,11,1),
(69,14,9,3),
(70,14,10,2),
(71,14,11,2),
(72,14,13,2),
(73,14,14,2),
(74,14,12,2);
/*!40000 ALTER TABLE `details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES
('DoctrineMigrations\\Version20240514045526','2024-05-14 04:55:37',401),
('DoctrineMigrations\\Version20240514115706','2024-05-14 11:57:22',238),
('DoctrineMigrations\\Version20240514123009','2024-05-14 12:30:22',1238),
('DoctrineMigrations\\Version20240514181518','2024-05-14 18:15:29',237),
('DoctrineMigrations\\Version20240515101614','2024-05-15 10:16:31',325),
('DoctrineMigrations\\Version20240516095722','2024-05-16 09:57:37',396),
('DoctrineMigrations\\Version20240516102018','2024-05-16 10:20:29',294),
('DoctrineMigrations\\Version20240516202519','2024-05-16 20:25:34',1025),
('DoctrineMigrations\\Version20240516203326','2024-05-16 20:33:38',1228),
('DoctrineMigrations\\Version20240516203457','2024-05-16 20:35:03',332),
('DoctrineMigrations\\Version20240517084222','2024-05-17 08:42:39',346),
('DoctrineMigrations\\Version20240517102029','2024-05-17 10:20:36',270),
('DoctrineMigrations\\Version20240517104958','2024-05-17 10:50:24',659),
('DoctrineMigrations\\Version20240517111158','2024-05-17 11:12:11',284),
('DoctrineMigrations\\Version20240517120741','2024-05-17 12:07:46',464),
('DoctrineMigrations\\Version20240517181851','2024-05-17 18:19:38',714);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commande_id` int(11) NOT NULL,
  `valeur` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `is_read` tinyint(1) NOT NULL,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6000B0D382EA2E54` (`commande_id`),
  CONSTRAINT `FK_6000B0D382EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES
(11,13,'Nouvelle commande enregistrée','2024-06-30 16:04:10',1,'App\\Entity\\Commandes'),
(12,14,'Commande déjà effectuée','2024-06-30 16:05:43',1,'App\\Entity\\Commandes');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'admin01@gmail.com','[]','$2y$13$fQhanqoXpejePl0ZTKT0tOmMoA9T3dSiaoWZ7ULlT3gXr8gTcbKUO','Admin','01','witcher-3-pink-sunset-landscape-aesthetic-desktop-wallpaper-cover.jpg'),
(2,'user01@gmail.com','[]','$2y$13$FuUy0PrGW86zUVeyKKNoeueVueiyV9/j2zXuSuwFu1RUw24CITmfC','User','01','femme-transparent-2.png'),
(15,'user02@gmail.com','[]','$2y$13$7CtZ/8UNPUlvZkQn.ZrosukKdQflgxYIplGFHiBroZ/OawSaX70Ry','user','02','1675861116929.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-30 18:36:34

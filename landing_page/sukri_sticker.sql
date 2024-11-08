  CREATE DATABASE  IF NOT EXISTS `sukri_sticker` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
  USE `sukri_sticker`;
  -- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
  --
  -- Host: 127.0.0.1    Database: sukri_sticker
  -- ------------------------------------------------------
  -- Server version	8.0.30

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

  --5
  -- Table structure for table `stickers`
  --

  DROP TABLE IF EXISTS `stickers`;
  /*!40101 SET @saved_cs_client     = @@character_set_client */;
  /*!50503 SET character_set_client = utf8mb4 */;
  CREATE TABLE `stickers` (
    `id` int NOT NULL AUTO_INCREMENT,
    `sticker_name` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `image_filename` varchar(255) NOT NULL,
    `price` decimal(10,2) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
  /*!40101 SET character_set_client = @saved_cs_client */;

  --
  -- Dumping data for table `stickers`
  --

  LOCK TABLES `stickers` WRITE;
  /*!40000 ALTER TABLE `stickers` DISABLE KEYS */;
  /*!40000 ALTER TABLE `stickers` ENABLE KEYS */;
  UNLOCK TABLES;

  --
  -- Table structure for table `user`
  --

  DROP TABLE IF EXISTS `user`;
  /*!40101 SET @saved_cs_client     = @@character_set_client */;
  /*!50503 SET character_set_client = utf8mb4 */;
  CREATE TABLE `user` (
    `id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `user_password` varchar(255) NOT NULL,
    `account_role` varchar(5) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
  /*!40101 SET character_set_client = @saved_cs_client */;

  --
  -- Dumping data for table `user`
  --

  LOCK TABLES `user` WRITE;
  /*!40000 ALTER TABLE `user` DISABLE KEYS */;
  INSERT INTO `user` VALUES (1,'Admin','Admin@admin.com','$2y$10$ZIiHgPN0JfCm9P2ck3itD.3mF5lcCxG5QMiXewVUYlQuzuOeAQPru','user'),(2,'Capybara','Capybara@gmail.com','$2y$10$Qp3/rs9KdUZNdxwmQWYOb.LMPQi24o/qiKzEnBrgcbjbOBmuDG536','user');
  /*!40000 ALTER TABLE `user` ENABLE KEYS */;
  UNLOCK TABLES;

  --
  -- Dumping events for database 'sukri_sticker'
  --

  --
  -- Dumping routines for database 'sukri_sticker'
  --
  /*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

  /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
  /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
  /*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
  /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

  -- Dump completed on 2024-11-05 21:27:18


CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    sticker_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (sticker_id) REFERENCES stickers(id) ON DELETE CASCADE,
    UNIQUE (user_id, sticker_id) 
);

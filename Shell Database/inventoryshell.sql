-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: inventoryshell
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `gas_purchase`
--

DROP TABLE IF EXISTS `gas_purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gas_purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int NOT NULL,
  `gasoline_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `date_purchase` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gasoline_id` (`gasoline_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `gasoline_id` FOREIGN KEY (`gasoline_id`) REFERENCES `gasoline` (`id`),
  CONSTRAINT `supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gas_purchase`
--

LOCK TABLES `gas_purchase` WRITE;
/*!40000 ALTER TABLE `gas_purchase` DISABLE KEYS */;
INSERT INTO `gas_purchase` VALUES (4,1,1,15000,'2022-10-11'),(5,5,3,5000,'2022-10-22');
/*!40000 ALTER TABLE `gas_purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gasoline`
--

DROP TABLE IF EXISTS `gasoline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gasoline` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `available` int DEFAULT NULL,
  `stored` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gasoline`
--

LOCK TABLES `gasoline` WRITE;
/*!40000 ALTER TABLE `gasoline` DISABLE KEYS */;
INSERT INTO `gasoline` VALUES (1,'Shell Fuel save','Cars/Motorcycles',78.75,3985,34000),(2,'Shell V-Power Diesel','Cars/Trucks',80.73,18987,19000),(3,'Shell V-power Gasoline','Cars/Motorcycles',77.78,14977,24000),(4,'Shell V-power Racing','Cars/Motorcycles',80.5,18993,19000);
/*!40000 ALTER TABLE `gasoline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gasolinesold`
--

DROP TABLE IF EXISTS `gasolinesold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gasolinesold` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `date_sold` date DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `totalPrice` float DEFAULT NULL,
  `gas_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gasoline_id_idx` (`gas_id`),
  CONSTRAINT `id` FOREIGN KEY (`gas_id`) REFERENCES `gasoline` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gasolinesold`
--

LOCK TABLES `gasolinesold` WRITE;
/*!40000 ALTER TABLE `gasolinesold` DISABLE KEYS */;
INSERT INTO `gasolinesold` VALUES (3,'Customer 1','2022-10-08',10,807.3,2),(4,'customer 2','2022-10-08',5,388.9,3),(5,'customer 3','2022-10-08',5,393.75,1),(6,'customer 4','2022-10-08',3,242.19,2),(7,'Customer 4','2022-10-08',5,402.5,4),(11,'costumer 1','2022-10-22',10,787.5,1),(12,'customer 4','2022-10-22',5000,393750,1),(13,'customer 2','2022-10-22',10000,787500,1),(14,'customer 4','2022-10-22',9000,700020,3),(15,'customer 3','2022-10-22',10,777.8,3),(16,'Manoy nag pa gas','2022-10-22',5,388.9,3),(17,'Customer 1','2022-10-26',2,161,4),(18,'customer 5','2022-10-29',3,233.34,3);
/*!40000 ALTER TABLE `gasolinesold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `liters` int DEFAULT NULL,
  `price` double DEFAULT NULL,
  `stockonhand` int DEFAULT NULL,
  `stockstored` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (24,'Shell advance Ultra',1,585,89,100),(25,'Shell Advance ax7',1,385,25,80),(26,'Shell Advance premium',1,600,90,100),(27,'Shell Helix',2,985,85,240),(28,'Shell Helix Hx8',2,1300,60,100),(29,'Shell Helix Ultra',2,1485,100,100),(30,'Shell Advance Power',1,490,10,100),(31,'Shell advcane Longride',1,550,100,100),(32,'Shell Advance fuel Save',1,530,110,220);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int NOT NULL,
  `product_id` int NOT NULL,
  `stock_order` int DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_supplier_idx` (`supplier_id`),
  KEY `fk_purchase_product1_idx` (`product_id`),
  CONSTRAINT `fk_purchase_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_purchase_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
INSERT INTO `purchase` VALUES (4,2,28,50,'2022-10-11'),(5,2,27,60,'2022-10-18'),(6,2,27,50,'2022-10-18'),(7,2,32,100,'2022-10-22'),(8,5,27,80,'2022-10-22');
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sold`
--

DROP TABLE IF EXISTS `sold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sold` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `date_sold` date DEFAULT NULL,
  `stock_sold` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `total` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sold_product1_idx` (`product_id`),
  CONSTRAINT `fk_sold_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sold`
--

LOCK TABLES `sold` WRITE;
/*!40000 ALTER TABLE `sold` DISABLE KEYS */;
INSERT INTO `sold` VALUES (74,'Monday sale ','2022-10-03',10,24,5850),(75,'Tuesday sale','2022-10-04',5,25,1925),(76,'Wednesday sale','2022-10-05',10,27,9850),(77,'Wednesday sale','2022-10-05',10,32,5300),(78,'Wednesday sale','2022-10-05',7,28,9100),(79,'Wednesday sale','2022-10-05',3,27,2955),(97,'costumer 1','2022-10-11',10,27,9850),(98,'Customer 1','2022-10-11',30,28,39000),(99,'Customer 1','2022-10-11',3,28,3900),(103,'Saturday sale','2022-10-22',100,32,53000),(104,'Customer 1','2022-10-22',50,27,49250),(105,'Customer 1','2022-10-26',10,26,6000),(106,'Customer 1','2022-10-26',20,25,7700),(107,'customer 2','2022-10-26',10,25,3850),(108,'customer 5','2022-10-26',90,30,44100),(109,'Customer 1','2022-10-29',20,25,7700);
/*!40000 ALTER TABLE `sold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'PSP Specialties','Bangkok, Thailand'),(2,'Shell Oil Company','Houston, Texas, United States'),(5,'Shell Oil Products US','150 North Dairy Ashford Road Houston, TX  77079');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `userType` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `approval` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$gwbr8p84ljcR6VKSQrN29exdHe3GmYJ1rFR7DKQssK4zv3JtvQ3qS','admin','James','Kotlin','Approved'),(7,'user','$2y$10$kp1CaOTKZ/YQhcFgfHti3uzlpLcwjGhCtD1Y6Xyf3XAl1FRZ7hxb6','user','Ajax','Database','Approved'),(10,'admin@100','$2y$10$ewU9JRgJVvJIbudNJvkY1e4/h.7KoyP7CveB/4Z00l2lBliMn6p16','admin','James','Ackerman','Approved'),(13,'george@100','$2y$10$VFoa9ht35ChpSfhxy7UvHeNC35tdXbEYK6zBICU5HL.Ty0vmBOh1q','user','George','Manglabok','Pending');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'inventoryshell'
--

--
-- Dumping routines for database 'inventoryshell'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-05 20:07:04

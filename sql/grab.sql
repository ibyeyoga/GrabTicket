# Host: localhost  (Version: 5.7.19)
# Date: 2018-04-21 16:15:01
# Generator: MySQL-Front 5.3  (Build 4.271)

/*!40101 SET NAMES gb2312 */;

#
# Structure for table "ticketgrabbed"
#

DROP TABLE IF EXISTS `ticketgrabbed`;
CREATE TABLE `ticketgrabbed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tno` varchar(255) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `created_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "ticketgrabbed"
#

/*!40000 ALTER TABLE `ticketgrabbed` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticketgrabbed` ENABLE KEYS */;

#
# Structure for table "userinfo"
#

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "userinfo"
#

INSERT INTO `userinfo` VALUES (1,'2g3jhglNLfN71zCd3sXi'),(2,'dtBo1Ju4IeOduEC0ZLFU'),(3,'fJIfUDipYvryfp9meUHA'),(4,'VxJUb3vgA1bIRZdXZTlS'),(5,'5LoypgUzXVzVLTZ7uW5r'),(6,'4CGr0yA7EIvbgB5qI7i0'),(7,'cRxXZVxJS4xlUlPYd1ih'),(8,'id4whDaOpoDNWaPsGSa2'),(9,'GqWgjATxSz4u5NBp52ME'),(10,'0s9bjQ7U2g6w7U1dSz4r'),(11,'LWe9UUGvjSiIyphYSiIy'),(12,'ZWB19w1myyUM0vm8rDHs'),(13,'FqWjAPfAZ38k8uVXSlYC'),(14,'ZYIxoauPvTLZwrv1s2E1'),(15,'bNeFtdvK1ImvfA2h5rPD');

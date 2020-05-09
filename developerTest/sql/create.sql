CREATE DATABASE IF NOT EXISTS `apodDB`;
USE `apodDB`;
CREATE TABLE IF NOT EXISTS `apod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(1500) NOT NULL,
  `date` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
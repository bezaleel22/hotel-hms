CREATE TABLE `whatsapp_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `whatsapp_number` varchar(100) DEFAULT  NULL,
  `chatenable` int(11) DEFAULT 0,
  `orderenable` int(11) DEFAULT 0,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `demo` (
  `id` VARCHAR(64) NOT NULL,
  `data` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;
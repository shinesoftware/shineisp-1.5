delimiter $$

CREATE TABLE `user_password_reset` (
  `request_key` varchar(32) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `request_time` datetime NOT NULL,
  PRIMARY KEY (`request_key`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `user_password_reset_fk1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$

CREATE TABLE `orders` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `widget_quantity` int(10) unsigned NOT NULL DEFAULT '1',
  `widget_type_id` int(10) unsigned NOT NULL,
  `widget_color_id` int(10) unsigned NOT NULL,
  `date_needed` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`),
  KEY `widget_type_id` (`widget_type_id`),
  KEY `widget_color_id` (`widget_color_id`),
  KEY `date_needed` (`date_needed`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `widget_colors` (
  `widget_color_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `widget_color_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`widget_color_id`),
  UNIQUE KEY `widget_color_name` (`widget_color_name`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `widget_colors` (`widget_color_id`, `widget_color_name`) VALUES(1, 'red');
INSERT INTO `widget_colors` (`widget_color_id`, `widget_color_name`) VALUES(2, 'yellow');
INSERT INTO `widget_colors` (`widget_color_id`, `widget_color_name`) VALUES(3, 'blue');

CREATE TABLE `widget_types` (
  `widget_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `widget_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`widget_type_id`),
  UNIQUE KEY `widget_type_name` (`widget_type_name`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `widget_types` (`widget_type_id`, `widget_type_name`) VALUES(1, 'Widget');
INSERT INTO `widget_types` (`widget_type_id`, `widget_type_name`) VALUES(2, 'Widget Pro');
INSERT INTO `widget_types` (`widget_type_id`, `widget_type_name`) VALUES(3, 'Widget Xtreme');


ALTER TABLE `orders`
  ADD CONSTRAINT `orders_widget_type_id` FOREIGN KEY (`widget_type_id`) REFERENCES `widget_types` (`widget_type_id`),
  ADD CONSTRAINT `orders_widget_color_id` FOREIGN KEY (`widget_color_id`) REFERENCES `widget_colors` (`widget_color_id`);

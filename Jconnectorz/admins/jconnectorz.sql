
CREATE TABLE `admins` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `skill` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `total_post_created` bigint(255) NOT NULL,
  `status` varchar(255) NOT NULL
);

CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `total_order` bigint(255) NOT NULL
  
);


CREATE TABLE `post` (
`post_id` int PRIMARY KEY AUTO_INCREMENT,
`post_image` varchar(255) NOT NULL,
`post_title` varchar(255) NOT NULL,
`created_by` varchar(255) NOT NULL,
`id_of_creator` varchar(255) NOT NULL,
`image_of_creator` varchar(255) NOT NULL,
`post_info` longtext NOT NULL,
`description` varchar(255) NOT NULL,
`no_of_readers` int(255) NOT NULL
);




CREATE TABLE `subscriber` (
`id` int PRIMARY KEY AUTO_INCREMENT,
`email` varchar(255) NOT NULL,
`status` int(255) NOT NULL
);



/*data base for counting visitors */
CREATE TABLE `counter_ips` (
  `ip` varchar(15) NOT NULL,
  `visit` datetime NOT NULL,
  UNIQUE KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `counter_values` (
  `id` bigint(11) NOT NULL,
  `day_id` bigint(11) NOT NULL,
  `day_value` bigint(11) NOT NULL,
  `yesterday_id` bigint(11) NOT NULL,
  `yesterday_value` bigint(11) NOT NULL,
  `week_id` bigint(11) NOT NULL,
  `week_value` bigint(11) NOT NULL,
  `month_id` bigint(11) NOT NULL,
  `month_value` bigint(11) NOT NULL,
  `year_id` bigint(11) NOT NULL,
  `year_value` bigint(11) NOT NULL,
  `all_value` bigint(11) NOT NULL,
  `record_date` datetime NOT NULL,
  `record_value` bigint(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/* end of counter section */
CREATE TABLE `admins` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `photo` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `records` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `image` varchar(100) NOT NULL,
  `category` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `news` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `image` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comments` (
`id` int PRIMARY KEY AUTO_INCREMENT,
`comments` varchar(200) NOT NULL,
`name` varchar(255) NOT NULL,
`news_id` varchar(50) NOT NULL 
);

CREATE TABLE `joins` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `state_of` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;








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



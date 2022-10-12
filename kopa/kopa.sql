CREATE TABLE `corpers` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` int(255) NOT NULL,
  `statecode` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `callup` bigint(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `deploy_state` varchar(255) NOT NULL,
  `serving` varchar(255) NOT NULL,
  `hide` int(255) NOT NULL
);


CREATE TABLE `trends` (
`id` int PRIMARY KEY AUTO_INCREMENT,
`title` varchar(255) NOT NULL,
`description` longtext NOT NULL,
`creator_email` varchar(255) NOT NULL,
`created_by` varchar(255) NOT NULL,
`replies` bigint(255) NOT NULL, 
`date_created` varchar(255) NOT NULL,
`category` varchar(255) NOT NULL

);


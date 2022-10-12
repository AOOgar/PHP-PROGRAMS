CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `employ_status` varchar(255) NOT NULL,
  `tax_filling` varchar(255) NOT NULL,
  `annual_income` varchar(255) NOT NULL,
  `tax_percent` varchar(255) NOT NULL,
  `investable_assets` varchar(255) NOT NULL
);

CREATE TABLE `admins` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` int(255) NOT NULL
);

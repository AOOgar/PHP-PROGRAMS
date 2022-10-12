CREATE TABLE `contact` (
 `id` int PRIMARY KEY AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `message` varchar(500) NOT NULL
);

CREATE TABLE `already` (
`id` int PRIMARY KEY AUTO_INCREMENT,
`product_name` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`quantity` varchar(255) NOT NULL,
`address` varchar(500) NOT NULL,
`phone_number` varchar(50) NOT NULL,
`city` varchar(50) NOT NULL
);

CREATE TABLE `custom` (
`id` int PRIMARY KEY AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`full_length` varchar(255) NOT NULL,
`waist` varchar(255) NOT NULL,
`sleeve_length` varchar(255) NOT NULL,
`round_sleeve` varchar(255) NOT NULL,
`brust_chest` varchar(255) NOT NULL
);

CREATE TABLE `add_product` (
`id` int PRIMARY KEY AUTO_INCREMENT,
`product_name` varchar(255) NOT NULL,
`price` varchar(255) NOT NULL,
`image` varchar(255) NOT NULL
);
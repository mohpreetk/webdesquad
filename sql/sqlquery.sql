CREATE DATABASE COMP1006_SUMMER2020; 
USE COMP1006_SUMMER2020; 
CREATE TABLE `profiles` (
  `user_id` int NOT NULL,
  `pic` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar (100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `social_media` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  PRIMARY KEY (user_id)
); 
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (id)
); 
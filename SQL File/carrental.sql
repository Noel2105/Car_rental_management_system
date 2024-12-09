-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2020 at 07:46 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE admin (
  admin_name varchar(100) PRIMARY KEY,
  password varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO admin (admin_name, password) VALUES
('admin', 'admin@123');


CREATE TABLE users (
  email_id varchar(100) PRIMARY KEY,
  full_name varchar(120) DEFAULT NULL,
  password varchar(100) DEFAULT NULL,
  contact_no char(11) DEFAULT NULL,
  dob varchar(100) DEFAULT NULL,
  address varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO users VALUES
('chaithrahrr2003@gmail.com','Chaitra HS','chaitra@11','7411048068','',''),
('noellobo0888@gmail.com','Noel Antony Lobo','noel@123','8951626493','',''),
('navanath@gmail.com','Navanath Pattekar','navanath@123','123456789','',''),
('harsh@gmail.com','Harsh Gupta','harsh@123','987654321','','');

CREATE TABLE vehicles_list (
  vehicle_id int(11) PRIMARY KEY,
  vehicle_title varchar(150) DEFAULT NULL,
  price_per_day int(11) DEFAULT NULL,
  fuel_type varchar(100) DEFAULT NULL,
  model_year int(6) DEFAULT NULL,
  seating_capacity int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO vehicles_list VALUES
(1,'MAHINDRA THAR',2000,'Petrol',2018,5),
(2,'BMW 5 Series',6000,'Petrol',2016,5),
(3,'Audi Q8',5500,'Diesel',2023,4);

CREATE TABLE booking (
  id int(11) PRIMARY KEY,
  usr_email varchar(100) DEFAULT NULL,
  vehicle_id int(11) DEFAULT NULL,
  from_date varchar(20) DEFAULT NULL,
  to_date varchar(20) DEFAULT NULL,
  status int(11) DEFAULT NULL,
  FOREIGN KEY(usr_email) REFERENCES users(email_id),
  FOREIGN KEY(vehicle_id) REFERENCES vehicles_list(vehicle_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO booking (id,usr_email, vehicle_id, from_date, to_date,status) VALUES
(1,'noellobo0888@gmail.com', 1, '2020-07-07', '2020-07-09',0),
(2,'chaithrahrr2003@gmail.com', 3, '2020-07-19', '2020-07-24',0),
(3,'harsh@gmail.com', 2, '2020-07-29', '2020-08-24',0),
(4,'navanath@gmail.com', 3, '2021-07-01', '2021-07-18',0);

CREATE TABLE subscribers (
  sub_id int(11) PRIMARY KEY,
  sub_email varchar(100),
  FOREIGN KEY(sub_email) REFERENCES users(email_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO subscribers VALUES
(1, 'chaithrahrr2003@gmail.com'),
(2, 'navanath@gmail.com');

ALTER TABLE booking
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE subscribers
  MODIFY sub_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE vehicles_list
  MODIFY vehicle_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
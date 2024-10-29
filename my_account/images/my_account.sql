SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Table structure for table `costumers`
CREATE TABLE `costumers` (
  `cos_id` int(10) NOT NULL,
  `cos_name` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `village` text NOT NULL,
  `p_status` text NOT NULL,
  `cos_address` text NOT NULL,
  `cos_amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  `payment_due` TINYINT(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `cos_name` (`cos_name`),
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `factories`
CREATE TABLE `factories` (
  `factory_id` int(10) NOT NULL,
  `factory_name` text NOT NULL,
  `factory_mobile` varchar(15) NOT NULL,
  `factory_address` text NOT NULL,
  `factory_amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  `payment_due` TINYINT(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `factory_name` (`factory_name`),
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`factory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('owner','worker') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert initial user data
INSERT INTO `users` (`username`, `password`, `role`) VALUES
('shaaz', 'mash', 'owner'),
('mash', 'shaaz', 'worker');

-- Table structure for table `customer_transactions`
CREATE TABLE `customer_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `cos_id` int(10) NOT NULL,
  `transaction_type` ENUM('add', 'subtract') NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_id`),
  KEY `cos_id` (`cos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

COMMIT;
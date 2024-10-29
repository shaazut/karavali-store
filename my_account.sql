SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `costumers` (
  `cos_id` INT AUTO_INCREMENT PRIMARY KEY,
  `cos_name` text NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `village` text NOT NULL,
  `p_status` text NOT NULL,
  `cos_address` text NOT NULL,
  `cos_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `initial_amt` decimal(10,2) NOT NULL,
  `payment_due` tinyint(1) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



INSERT INTO `costumers` (`cos_id`, `cos_name`, `mobile`, `village`, `p_status`, `cos_address`, `cos_amount`, `initial_amt`, `payment_due`, `date`) VALUES
(1, 'chitae', '1232312332', 'Kalugundi', 'due', 'sss', 200.00, 120.00, 1, '2024-04-24 10:29:05');



CREATE TABLE `customer_transactions` (
  `transaction_id` int(11) NOT NULL,
  `cos_id` int(10) NOT NULL,
  `transaction_type` enum('add','subtract') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



INSERT INTO `customer_transactions` (`transaction_id`, `cos_id`, `transaction_type`, `amount`, `transaction_date`) VALUES
(1, 1, 'add', 80.00, '2024-04-24 10:29:17');



CREATE TABLE `factories` (
  `factory_id` INT AUTO_INCREMENT PRIMARY KEY,
  `factory_name` text NOT NULL,
  `factory_mobile` varchar(15) NOT NULL,
  `factory_address` text NOT NULL,
  `factory_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `initial_amt` decimal(10,2) NOT NULL,
  `payment_due` tinyint(1) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factory_transactions`
--

CREATE TABLE `factory_transactions` (
  `transaction_id` int(11) NOT NULL,
  `factory_id` int(10) NOT NULL,
  `transaction_type` enum('add','subtract') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('owner','worker') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'shaaz', 'mash', 'owner'),
(2, 'mash', 'shaaz', 'worker');


ALTER TABLE `customer_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `cos_id` (`cos_id`);

ALTER TABLE `factory_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `factory_id` (`factory_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);


ALTER TABLE `costumers`
  MODIFY `cos_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_transactions`
--
ALTER TABLE `customer_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `factories`
--
ALTER TABLE `factories`
  MODIFY `factory_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `factory_transactions`
--
ALTER TABLE `factory_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;


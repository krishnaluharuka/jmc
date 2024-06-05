-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 02:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hi5treasues_recomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `f_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answers` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`f_id`, `question`, `answers`) VALUES
(2, '<p><b>1. How to place an order from the website?</b><br></p>', '<p>Step 1: Start by searching through search bar or by clicking on your preferred item category. For example, if you are looking for bouquets, click on the Bouquet in Categories tab. Scroll through the options and click on your desired product. </p><p>Step 2: On the home page click Add To Cart to shop it. Then the data will be increased in cart icon and you can click to the cart icon on navbar to manage cart and check out.</p><p> Step 3: But before it, if you want to know about the organization and its services view about and review page. Moreover,&nbsp; if you want to shop the products of your choice there will be available products of your choice in choices section.</p><p>Step 4: Log in with your email ID and password as prompted On the checkout page, you can customize your product through special messages.</p><p> Step 5: Verify your order and click confirm to make payment to complete your purchase.<br></p>'),
(3, '<p><b>2. I am not able to complete the payment. What should I do?</b></p>', '<p>If you are encountering this issue, it may be related to a connectivity problem. To resolve this, ensure that you have a stable internet connection when placing your order.&nbsp; If the issue continues to persist, please donot hesitate to&nbsp; give us a call at 9869141935</p>'),
(4, '<p><b>3. Can I place an order for delivery outside of Pokhara?</b></p>', '<p>Certainly! You can easily place an order for all over Nepal from our website and send thoughtful gifts to your loved ones. Plus, we accept the order from all over the world.</p>'),
(5, '<p><b>4. What is the shipping charge of the products?</b></p>', '<p>Our standard gift delivery service inside Pokhara Valley cost NPR 100 only/-</p><p>However, if you choose special delivery options or your delivery location is outside pokhara valley, there will be nominal additional charges.</p>'),
(6, '<p><b>5. What about any discount on bulk orders?</b></p>', '<p>We are open to discussing this matter regarding potential discounts on bulk orders. So, feel free to inquire by reaching out to us via email at hi5treasures.pkr@gmail.com or by calling us at 9846907548</p>'),
(7, '<p><b>6. What is the benefit of setting up an account on Hi5treasures._.pkr?</b></p>', '<p>You will gain exclusive access to recommendation channel. You will&nbsp; be able to provide your reviews. You will be able to directly contact us on website through chatbox. You will be able to maintain your profile and place orders and make payment. This way, you will not ever miss out on getting the perfect gifts for your loved ones, that too, at the best prices.</p>'),
(8, '<p><b>7. Is Hi5treasures._.pkr on Facebook and Instagram?</b></p>', '<p>Yes, Hi5treasures._.pkr is both on Facebook and Instagram! You can follow our page at https://www.facebook.com/hi5treasures and </p><p>https://www.instagram.com/hi5treasures._.pkr for the latest updates and a sneak peek into what happens behind the scenes.</p>'),
(9, '<p><b>8. Can I order a customised products for my loved one?</b><br></p>', '<p>If you have something special in mind regarding the customization, please don not hesitate to reach out to us through our chatbox in our website or give us a call at 9846907548. We would love to hear your ideas and try our best to treasure your memories.<br></p>'),
(10, '<p><b>9. How will I know if my order has been delivered?</b></p>', '<p>You will receive a confirmation email once your order has been delivered. Additionally you will receive notification on profile of our website.</p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`f_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

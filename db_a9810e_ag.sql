-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql8001.site4now.net
-- Generation Time: May 22, 2023 at 07:48 AM
-- Server version: 8.0.28
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_a9810e_ag`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'Admin', '', 'admin@123', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cid` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileno` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ctype` varchar(10) NOT NULL DEFAULT 'Wholesale'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cid`, `name`, `email`, `mobileno`, `password`, `address`, `ctype`) VALUES
(5, 'WalkIn', '', '', '', '', 'Retail'),
(7, 'Harshad Dange', 'harshaddange347@gmail.com', '7049817156', '$2y$10$f9BOkVO.pMLkphS56v5Sg.GUoPVSp9TaM3GAQjDTNRbdxCa3KY3l2', 'Dange gali juna budhawar peth 2519  d ward', 'Wholesale'),
(8, 'Akash Gurav', 'guravakashparshuram10@gmail.com', '7385779350', '$2y$10$f9BOkVO.pMLkphS56v5Sg.GUoPVSp9TaM3GAQjDTNRbdxCa3KY3l2', '2283, D ward, Shukrawar peth, Kolhapur', 'Retail'),
(16, 'Tushar Bhosale', 'tusharbhosale@gmail.com', '9359372565', '$2y$10$f9BOkVO.pMLkphS56v5Sg.GUoPVSp9TaM3GAQjDTNRbdxCa3KY3l2', 'At Varewadi Post Salshi, Tal.Shahuwadi, Dist. Kolhapur', 'Retail'),
(17, 'Amey Jadhav', 'ameyjadhav5724@gmail.com', '9422041947', '$2y$10$f9BOkVO.pMLkphS56v5Sg.GUoPVSp9TaM3GAQjDTNRbdxCa3KY3l2', 'Oros Sindhudurg', 'Retail'),
(18, 'Shahuraje Patil', 'shahupatil4151@gmail.com', '8010393956', '$2y$10$f9BOkVO.pMLkphS56v5Sg.GUoPVSp9TaM3GAQjDTNRbdxCa3KY3l2', 'At Post. Hasur-Dumala, Tal. Karveer, Dist. Kolhapur', 'Retail'),
(19, 'Shubham Gavade', 'gavadeshubham2004@gmail.com', '7057652014', '$2y$10$f9BOkVO.pMLkphS56v5Sg.GUoPVSp9TaM3GAQjDTNRbdxCa3KY3l2', 'At Post. Buzawade, Tal. Chandgad, Dist. Kolhapur ', 'Retail'),
(23, 'Vaishnavi Sabale', 'vaishnavisabale128@gmail.com', '9067818484', '$2y$10$aRbaiiz..QXF3OXtL6qRKehiERYZso3BUxlKTLFUaNfS.ZKkwZYoO', 'Sai Mandir, behind kesarkar hospital, Kalamba, Kolhapur', 'Wholesale'),
(25, 'Sandesh Shinde', 'sandeshshinde7047@gmail.com', '7798357047', '$2y$10$dQnTLh7cmYS34NoTYC5sKuvb2YAIxxm6pqzrp1zfboosIL4de0Aqe', 'At Post Shiral, Tal. Shiral, Dist. Sangali', 'Retail'),
(44, 'Karan Patil', 'kmpatil2004@gmail.com', '9067062415', '$2y$10$qS14O0Tpnb/3XPdNchpl0.Hw/Y8uxMVF7MF0EyEarw.rGf0ELZTFC', 'At-Nandari , Tal-Shahuwadi, Dist-Kolhapur', 'Retail'),
(45, 'Aditya Sutar', 'sutaraditya68@gmail.com', '9284915447', '$2y$10$f8v/oMe4ZsOMkNR.eB3Rtu32vxiReHYjrhOH8BAPS8Y2Bi3NFOI1u', 'om colony,vidyanagar,karad, Maharashtra', 'Retail'),
(46, 'Rohan Done', 'rohandonerd@gmail.com', '8010317276', '$2y$10$wZ4HSYDjXzxzpNN6xogLCerxmiBMmPUpeDc/0/4E5tR1Lok3FjQJe', 'Kagal, Tal. Kagal, Dist. Kolhapur', 'Retail'),
(47, 'Harshvardhan Khade', 'harshvardhankhade0@gmail.com', '9921227780', '$2y$10$TaxAbIPQ7IdSyW7yTwas.ufHgeydtsa70BUfy/N9DyBlo1FXcUmAG', 'R.K. Nagar, Dist. Kolhapur', 'Retail'),
(48, 'Siddhant Delekar', 'delekarsiddhant@gmail.com', '9527405404', '$2y$10$fmAeyYqR1JjT1qgWWdY8EOCOpbQ4LKn2bC7M7ORH0d0oOvAL2f6Py', 'At Ghotawade, Post Kaulav, Tal. Radhanagari, Dist. Kolhapur', 'Retail'),
(49, 'Vaibhavi Bhope', 'vaibhavibhope15@gmail.com', '7588263596', '$2y$10$eWNEcW8vW.a2sFzDbNu7MuAQK9/bxFoyLC6T8YGkrKRXZX9RGXzBu', 'University Road, Kolhapur', 'Retail'),
(50, 'Ritesh Krishnat Mali', 'riteshkmali007@gmail.com', '8421419119', '$2y$10$FMjHYB/a5kF66U7KrBkvnuo5AEdGrsXdN9eRIn90/lspzlSzJEACK', 'mouje sanggaon,kagal,kolhapur', 'Retail'),
(51, 'Apurva Burud', 'apurvaburud2204@gmail.com', '8668428526', '$2y$10$LSrCl.lAxlAO25RKBT9yj.5HxZRv/ovTHIyUY29iCvqhPg.GdndNi', '135, R. K .Nagar , Kolhapur , Maharashtra', 'Retail'),
(52, 'Ashish Gurav', 'guravashish10@gmail.com', '9112019559', '$2y$10$20odagRRXCqA9bbkIUa5oOQ49e7LP8Vosqkd6C9Uz7W38yzWrK5Ce', '2283, D Ward, Shukrawar Peth, Kolhapur', 'Retail'),
(53, 'Shubham Pradip Pawar', 'shubham412805@gmail.com', '9322305913', '$2y$10$XoID4Ds5gJOt/YjXYlCXxO4pNxp/040D25ziPkEslmPhkOgJl2ne2', 'At.Vahagaon Post Ranjani Ta.Jaoli Dist.Satara', 'Retail'),
(54, 'Diksha Parakhe', 'parakhediksha@gmail.com', '9146970074', '$2y$10$727HfG5eJZHSuOhY33Hl.uDgIJ/BeNN3uCQcfst5tLrPBTBb6hw9a', 'University Road, Vidya Nagar, Kolhapur', 'Retail'),
(55, 'Rohit Dilip Dhavare', 'rohitdhavare754@gmail.com', '7249004472', '$2y$10$64OP/OSmExLjL.745ZI3cuGrDMbvk2ftf0J5DY4xI9EnqVd3Sbrma', 'Talasangi Taluka Mangalawedha Solapur', 'Retail'),
(56, 'Sakshi Gavali', 'gavalisakshi34@gmail.com', '9322413203', '$2y$10$dTkD/Fh4S5uTaSv7JEGaLOzFqqWhk2LfcKB8zzekX.y7cNog05Eq.', 'At post Kaneri Tal. Karveer Dist. Kolhapu', 'Retail'),
(57, 'Sandesh Anil Mahind', 'sandeshamahind@gmail.com', '9322882733', '$2y$10$wjwfSft4.bxSMK7YJmLAwuWy/67FWuWEs/B9B10UfRNA5YgN1TrTS', 'shahapur ,tal-panhala, dist-kolhapur', 'Retail'),
(58, 'Vaishali Gurav', 'guravvaishali10@gmail.com', '8830556049', '$2y$10$oMyYv7112g2nBO15xNm4tuPyU4baM3OzaC30dXUjA8sZ3jUbSjV6e', '2283, D Ward, Shukrawar Peth, Kolhapur', 'Retail'),
(59, 'Gopal Dose', 'dangergamergod@gmail.com', '8605961162', '$2y$10$OAmnqkgoRIeoxdkdjQmXWu1DEFjy8JDOkWptvGHvq5h2OYaa0lI/.', 'At Post. Malkapur, Dist. Buldhana', 'Retail'),
(60, 'Rajdeep Patil', 'rajexpress1210@gmail.com', '9157816884', '$2y$10$9TXijBibaN3zRbbFB8k65O1Vyi1TYogm2HdC1xdtQ1DhgHm.lCJ3O', 'Deokar Panand, Kolhapur, Maharashtra 416001, India', 'Retail'),
(61, 'manasi sabale ', 'manasisabal2021@gmail.com', '8421747097', '$2y$10$FrxpJEJYy.5HiO0C1xygKOUsxT/l7NRubEEvMt5eWS1XbA9jBHknu', ' 123, new lane , kolhapur', 'Retail'),
(62, 'Manasi Sabale', 'manasisabale2021@gmail.com', '7856554946', '$2y$10$1p9TrR9.taVTEqYCPfVsf.ySAxbZbAWaNepxS04UZlzyGufeSka.C', 'Deokar Panand, Kolhapur, Maharashtra 416001, India', 'Retail');

-- --------------------------------------------------------

--
-- Table structure for table `online_orderdetails`
--

CREATE TABLE `online_orderdetails` (
  `id` int NOT NULL,
  `oo_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `online_orderdetails`
--

INSERT INTO `online_orderdetails` (`id`, `oo_id`, `product_id`, `quantity`) VALUES
(1, 1, 5, 20),
(2, 1, 6, 30),
(3, 1, 2, 20),
(4, 1, 1, 20),
(5, 3, 5, 20),
(6, 3, 6, 10),
(7, 4, 6, 2),
(8, 5, 15, 6);

-- --------------------------------------------------------

--
-- Table structure for table `online_orders`
--

CREATE TABLE `online_orders` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `online_orders`
--

INSERT INTO `online_orders` (`id`, `customer_id`, `order_date`, `status`) VALUES
(1, 7, '2023-03-30', 'Billed'),
(2, 8, '2023-03-30', 'pending'),
(3, 17, '2023-04-11', 'Billed'),
(4, 60, '2023-05-22', 'pending'),
(5, 62, '2023-05-22', 'Billed');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `pname` varchar(250) NOT NULL,
  `ptype` varchar(250) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subquantity` int NOT NULL,
  `a_discount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `pname`, `ptype`, `description`, `subquantity`, `a_discount`) VALUES
(1, 'Azithral 250mg', 'Tablets', 'Azithral 250mg is an antibiotic used to treat respiratory tract infections. It is effective against a wide range of bacterial pathogens.', 10, 'Yes'),
(2, 'Azee 250mg', 'Tablets', 'Azee 250mg is an antibiotic used to treat bacterial infections. It belongs to the class of macrolide antibiotics and helps in fighting bacteria.', 15, 'Yes'),
(5, 'Azee 500mg', 'Tablets', 'Azee 500mg is an antibiotic used to treat bacterial infections. It is a stronger dosage of Azee and is prescribed for more severe infections.', 15, 'No'),
(6, 'Agumectin 625mg', 'Capsules', 'Agumectin 625mg is an antibiotic used to treat various bacterial infections. It works by inhibiting the growth of bacteria in the body.', 15, 'Yes'),
(7, 'Becosules', 'Syrups', 'Becosules is a multivitamin supplement that provides essential vitamins and minerals to support overall health and well-being.', 10, 'Yes'),
(8, 'Brufen 400mg', 'Capsules', 'Brufen 400mg is a nonsteroidal anti-inflammatory drug (NSAID) used to relieve pain, reduce inflammation, and lower fever.', 15, 'No'),
(9, 'Gemer 1mg', 'Tablets', 'Gemer 1mg is an oral antidiabetic medication that contains Glimepiride. It is used to control blood sugar levels in patients with type 2 diabetes.', 10, 'Yes'),
(10, 'Omez', 'Capsules', 'Omez is a proton pump inhibitor (PPI) used to reduce stomach acid production. It is commonly prescribed for acid reflux and gastric ulcers', 15, 'Yes'),
(11, 'Omez D', 'Tablets', 'Omez D is a combination medication that contains Omeprazole (an acid reducer) and Domperidone (an antiemetic). It helps in managing acid-related disorders and nausea.', 10, 'Yes'),
(12, 'Ciplox', 'Tablets', 'Ciplox is an antibiotic medication that contains Ciprofloxacin. It is commonly used to treat bacterial infections, including urinary tract infections.', 20, 'Yes'),
(13, 'Cilpladine', 'Capsules', 'Cilpladine is not a recognized medicine. Please verify the name or consult a healthcare professional for accurate information.', 20, 'Yes'),
(14, 'Gelusils', 'Tablets', 'Gelusils is an antacid and antiflatulent medication that provides relief from acidity, heartburn, and gas. It helps in neutralizing excess stomach acid.', 15, 'Yes'),
(15, 'Zeredol P7', 'Tablets', 'Zeredol P is a combination medication that contains Aceclofenac and Paracetamol. It is used to alleviate pain and reduce fever.', 10, 'Yes'),
(16, 'Rinifol 5', 'Capsules', 'Rinifol is a nutritional supplement that contains essential vitamins and minerals. It helps in maintaining overall health and well-being.', 10, 'Yes'),
(17, 'PanD 10', 'Capsules', 'Pan-D is a combination medication that contains Pantoprazole (a PPI) and Domperidone (an antiemetic). It helps in managing acid-related disorders and nausea.', 15, 'Yes'),
(18, 'Telmikind 40mg', 'Capsules', 'Telmikind 40mg is an angiotensin II receptor blocker (ARB) used to manage high blood pressure (hypertension) and certain heart conditions.', 12, 'Yes'),
(19, 'Wikoryl', 'Capsules', 'Wikoryl is a combination medication that contains Paracetamol, Phenylephrine, and Chlorpheniramine. It is used to relieve symptoms of cold and flu.', 10, 'Yes'),
(20, 'Norflox TZ', 'Tablets', 'Norflox TZ is an antibiotic combination that contains Norfloxacin and Tinidazole. It is used to treat various bacterial and parasitic infections.', 10, 'Yes'),
(21, 'Temsan 80mg', 'Capsules', 'Temsan 80mg is an angiotensin II receptor blocker (ARB) that is used to treat high blood pressure (hypertension) and certain heart conditions.', 10, 'Yes'),
(22, 'Pan 20', 'Tablets', 'Pan 20 is a proton pump inhibitor (PPI) that reduces the production of stomach acid. It is commonly used to treat acid reflux and gastric ulcers.', 10, 'No'),
(23, 'Metoprolol', 'Tablets', 'Metoprolol is a beta-blocker medication used to treat high blood pressure, chest pain (angina), and heart-related conditions such as heart failure and heart attack. It works by blocking certain receptors in the heart and blood vessels.', 12, 'Yes'),
(24, 'Sertraline', 'Syrups', 'Sertraline is an antidepressant medication known as a selective serotonin reuptake inhibitor (SSRI). It is used to treat depression, anxiety disorders, obsessive-compulsive disorder (OCD), and post-traumatic stress disorder (PTSD).', 10, 'Yes'),
(25, 'VoveranSR 10', 'Tablets', 'Voveran SR is a nonsteroidal anti-inflammatory drug (NSAID) used to relieve pain, inflammation, and swelling. It provides sustained release of the medication.', 15, 'No'),
(26, 'Fluoxetine', 'Tablets', 'Fluoxetine is an antidepressant medication belonging to the class of drugs known as selective serotonin reuptake inhibitors (SSRIs). It is used to treat depression, anxiety disorders, and certain eating disorders.', 10, 'Yes'),
(27, 'Losartan', 'Tablets', 'Losartan is an angiotensin II receptor blocker (ARB) used to treat high blood pressure (hypertension) and certain heart conditions. It works by blocking the action of angiotensin II, a substance that constricts blood vessels.', 10, 'Yes'),
(28, 'Amoxicillin', 'Tablets', 'Amoxicillin is a broad-spectrum antibiotic used to treat various bacterial infections, including respiratory infections, ear infections, urinary tract infections, and skin infections. It belongs to the penicillin class of antibiotics.', 10, 'No'),
(29, 'Omeprazole', 'Capsules', 'Omeprazole is a proton pump inhibitor (PPI) used to reduce stomach acid production. It is commonly prescribed to treat conditions such as gastroesophageal reflux disease (GERD), ulcers, and heartburn.', 10, 'Yes'),
(30, 'Aspirin', 'Tablets', 'Aspirin, also known as acetylsalicylic acid, is a medication used to treat pain, reduce inflammation, and lower fever. It is commonly used for headaches, minor aches and pains, and to prevent heart attacks and strokes.', 10, 'Yes'),
(31, 'Ciprofloxacin', 'Tablets', 'Ciprofloxacin is an antibiotic that belongs to the fluoroquinolone class. It is used to treat bacterial infections such as urinary tract infections, respiratory tract infections, skin infections, and gastrointestinal infections.', 15, 'Yes'),
(32, 'Metformin', 'Capsules', 'Metformin is an oral medication used to manage high blood sugar levels in people with type 2 diabetes. It works by reducing glucose production in the liver and improving insulin sensitivity in the body.', 10, 'Yes'),
(33, 'Koflet Ex 100ml Linctus', 'Syrups', 'Koflet cough syrup is an expectorant formulated with natural herbal actives and is ideal for relieving wet cough.', 1, 'No'),
(34, 'Glycodin Syrup', 'Syrups', 'Glycodin Syrup is used to treat dry cough. It works by reducing the activity of cough center in the brain & relieves minor throat irritation.', 1, 'No'),
(35, 'KolQ', 'Tablets', 'For weakness', 10, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int NOT NULL,
  `purchase_date` date NOT NULL,
  `sid` int NOT NULL,
  `total_amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `purchase_date`, `sid`, `total_amount`) VALUES
(12, '2023-02-10', 1, 34000),
(14, '2023-02-11', 1, 600),
(15, '2023-02-27', 1, 90000),
(16, '2023-02-27', 2, 45000),
(17, '2023-02-27', 2, 45000),
(18, '2023-02-24', 2, 46200),
(20, '2023-02-28', 1, 400000),
(21, '2023-05-11', 2, 0),
(22, '2023-05-11', 1, 4000),
(23, '2023-05-11', 2, 4200),
(24, '2023-05-11', 1, 4000),
(25, '2023-05-11', 1, 410),
(27, '2023-05-11', 1, 10000),
(28, '2023-05-11', 1, 0),
(29, '2023-05-11', 1, 420),
(30, '2023-05-11', 1, 1000),
(31, '2023-05-11', 1, 8900),
(32, '2023-05-22', 8, 2875),
(33, '2023-05-22', 11, 8389),
(34, '2023-05-22', 9, 77500),
(35, '2023-05-22', 1, 7100),
(36, '2023-05-22', 5, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `pd_id` int NOT NULL,
  `purchase_id` int NOT NULL,
  `pid` int NOT NULL,
  `batch_no` varchar(11) NOT NULL,
  `quantity` int NOT NULL,
  `purchase_rate` int NOT NULL,
  `purchase_total` int NOT NULL,
  `retailrate` int NOT NULL,
  `wholesale_rate` int NOT NULL,
  `mfg_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`pd_id`, `purchase_id`, `pid`, `batch_no`, `quantity`, `purchase_rate`, `purchase_total`, `retailrate`, `wholesale_rate`, `mfg_date`, `expiry_date`, `stock`) VALUES
(26, 12, 1, '1', 100, 100, 10000, 100, 1000, '2023-01-31', '2024-03-23', 858),
(27, 14, 1, '12', 10, 20, 200, 15, 46, '2023-01-25', '2024-02-22', 295),
(28, 14, 2, 'cr-1', 10, 40, 400, 47, 76, '2023-02-07', '2023-02-17', 855),
(29, 18, 5, 'p-1', 1100, 42, 46200, 45, 41, '2023-02-27', '2023-12-27', 751),
(30, 20, 6, 'z-1', 10000, 40, 400000, 45, 42, '2023-02-27', '2025-07-22', 9894),
(31, 24, 1, '4', 100, 40, 4000, 42, 42, '2023-05-10', '2025-01-23', 100),
(32, 30, 1, '42', 10, 100, 1000, 42, 42, '2023-05-11', '2024-08-04', 0),
(33, 31, 1, 'hg', 89, 100, 8900, 10, 42, '2023-05-11', '2024-08-11', 77),
(34, 32, 34, 'GS01', 25, 50, 1250, 75, 55, '2023-01-31', '2025-03-31', 18),
(35, 32, 33, 'KFX01', 25, 65, 1625, 90, 70, '2023-03-01', '2025-01-31', 21),
(36, 33, 16, 'RI01', 231, 19, 4389, 25, 23, '2023-01-03', '2025-06-22', 129),
(37, 33, 24, 'SE00', 100, 25, 2500, 30, 27, '2022-01-22', '2024-06-22', 95),
(38, 33, 19, 'WI01', 50, 30, 1500, 36, 33, '2023-02-21', '2024-09-22', 34),
(39, 34, 6, 'AG01', 1000, 23, 23000, 24, 24, '2023-05-22', '2025-10-14', 954),
(40, 34, 28, 'AM01', 1000, 15, 15000, 16, 16, '2023-05-15', '2025-09-11', 919),
(41, 34, 30, 'AS01', 1000, 14, 14000, 15, 15, '2023-05-22', '2023-05-31', 836),
(42, 34, 2, 'AZ01', 1000, 13, 13000, 15, 14, '2023-05-02', '2025-07-15', 978),
(43, 34, 7, 'BE01', 1000, 3, 2500, 3, 3, '2023-05-02', '2024-08-06', 900),
(44, 34, 9, 'GM01', 1000, 10, 10000, 12, 11, '2023-05-15', '2025-01-27', 898),
(45, 35, 15, 'ZE0523', 50, 40, 2000, 45, 43, '2023-01-10', '2025-11-22', 44),
(46, 35, 11, 'OM0523', 100, 30, 3000, 40, 35, '2023-06-18', '2024-10-22', 50),
(47, 35, 8, 'BR0523', 100, 21, 2100, 29, 25, '2022-12-22', '2025-01-01', 86),
(48, 36, 14, 'GL0523', 100, 25, 2500, 40, 30, '2023-01-17', '2025-01-22', 100);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` int NOT NULL,
  `sale_date` date NOT NULL,
  `cid` int NOT NULL,
  `subtotal` int NOT NULL,
  `discount` int NOT NULL,
  `total` int NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `sale_date`, `cid`, `subtotal`, `discount`, `total`, `status`) VALUES
(2, '2023-02-16', 5, 16200, 1150, 15050, 'Closed'),
(3, '2023-02-09', 7, 104600, 10460, 94140, 'Closed'),
(4, '2023-02-17', 7, 11220, 1046, 10174, 'Closed'),
(5, '2023-02-08', 7, 5320, 0, 5320, 'Closed'),
(6, '2023-02-09', 8, 11500, 0, 11500, 'Closed'),
(7, '2023-02-16', 8, 1500, 0, 1500, 'Closed'),
(8, '2023-02-27', 16, 4950, 0, 45000, 'Closed'),
(9, '2023-02-27', 17, 4500, 0, 4500, 'Closed'),
(10, '2023-02-27', 17, 1000, 0, 1000, 'Closed'),
(11, '2023-02-28', 8, 1000, 0, 1000, 'Closed'),
(12, '2023-02-28', 7, 42, 0, 42, 'Closed'),
(13, '2023-02-28', 16, 225, 0, 225, 'Closed'),
(14, '2023-02-28', 17, 450, 0, 450, 'Closed'),
(15, '2023-02-28', 16, 1000, 0, 1000, 'Closed'),
(16, '2023-02-28', 8, 2250, 45, 2205, 'Closed'),
(17, '2023-02-28', 17, 2025, 0, 2025, 'Closed'),
(18, '2023-03-04', 17, 1450, 0, 1450, 'Closed'),
(19, '2023-03-03', 7, 420, 0, 420, 'Closed'),
(20, '2023-03-02', 16, 1000, 100, 900, 'Closed'),
(21, '2023-03-04', 17, 225, 0, 225, 'Closed'),
(31, '2023-03-06', 16, 2250, 225, 2025, 'Closed'),
(33, '2023-03-07', 7, 0, 0, 500, 'Closed'),
(37, '2023-03-12', 7, 2250, 45, 2205, 'Closed'),
(38, '2023-03-12', 7, 450, 0, 450, 'Closed'),
(39, '2023-03-14', 8, 4450, 445, 4005, 'Closed'),
(40, '2023-04-22', 8, 0, 0, 0, 'Closed'),
(41, '2023-04-22', 8, 0, 0, 0, 'Closed'),
(42, '2023-04-22', 7, 0, 0, 0, 'Closed'),
(43, '2023-04-22', 17, 0, 0, 0, 'Closed'),
(44, '2023-04-22', 8, 4700, 0, 4700, 'Closed'),
(45, '2023-04-22', 17, 1900, 190, 1710, 'Closed'),
(46, '2023-04-22', 17, 1350, 90, 1260, 'Closed'),
(47, '2023-04-22', 17, 1350, 90, 1260, 'Closed'),
(50, '2023-05-11', 7, 0, 0, 0, 'Closed'),
(51, '2023-05-11', 7, 0, 0, 0, 'Closed'),
(52, '2023-05-11', 7, 10000, 0, 10000, 'Closed'),
(53, '2023-05-15', 7, 3490, 0, 3490, 'Closed'),
(54, '2023-05-15', 17, 470, 0, 470, 'Closed'),
(55, '2023-05-15', 25, 470, 0, 470, 'Closed'),
(56, '2023-05-15', 17, 4500, 0, 4500, 'Closed'),
(57, '2023-05-15', 51, 500, 15, 485, 'Closed'),
(58, '2023-05-15', 54, 4500, 0, 4500, 'Closed'),
(59, '2023-05-15', 23, 235, 0, 235, 'Closed'),
(60, '2023-05-16', 23, 1200, 0, 1200, 'Closed'),
(61, '2023-05-16', 16, 180, 0, 180, 'Closed'),
(62, '2023-05-16', 52, 432, 9, 423, 'Closed'),
(63, '2023-05-16', 5, 150, 3, 147, 'Closed'),
(64, '2023-05-16', 45, 345, 10, 335, 'Closed'),
(65, '2023-05-17', 8, 320, 0, 320, 'Closed'),
(66, '2023-05-17', 19, 300, 0, 300, 'Closed'),
(67, '2023-05-17', 52, 1175, 59, 1116, 'Closed'),
(68, '2023-05-17', 8, 450, 81, 369, 'Closed'),
(69, '2023-05-18', 44, 600, 0, 600, 'Closed'),
(70, '2023-05-18', 56, 50, 4, 47, 'Closed'),
(71, '2023-05-18', 55, 2660, 266, 2394, 'Closed'),
(72, '2023-05-18', 54, 330, 0, 330, 'Closed'),
(73, '2023-05-18', 55, 2660, 266, 2394, 'Closed'),
(74, '2023-05-18', 46, 144, 0, 144, 'Closed'),
(75, '2023-05-18', 59, 544, 0, 544, 'Closed'),
(76, '2023-05-18', 45, 240, 0, 240, 'Closed'),
(77, '2023-05-18', 5, 585, 0, 585, 'Closed'),
(78, '2023-05-18', 57, 1500, 150, 1350, 'Closed'),
(79, '2023-05-19', 45, 319, 0, 319, 'Closed'),
(80, '2023-05-19', 50, 375, 0, 375, 'Closed'),
(81, '2023-05-19', 17, 400, 0, 400, 'Closed'),
(82, '2023-05-19', 44, 150, 0, 150, 'Closed'),
(83, '2023-05-19', 47, 160, 0, 160, 'Closed'),
(84, '2023-05-22', 56, 150, 0, 150, 'Closed'),
(85, '2023-05-22', 5, 675, 7, 668, 'Closed'),
(86, '2023-05-22', 25, 470, 0, 470, 'Closed'),
(87, '2023-05-22', 16, 87, 0, 87, 'Closed'),
(88, '2023-05-22', 48, 120, 0, 120, 'Closed'),
(89, '2023-05-22', 44, 24, 0, 24, 'Closed'),
(90, '2023-05-22', 5, 2000, 100, 1900, 'Closed'),
(91, '2023-05-22', 59, 705, 0, 705, 'Closed'),
(92, '2023-05-22', 59, 150, 0, 150, 'Closed'),
(93, '2023-05-22', 5, 150, 0, 150, 'Closed'),
(94, '2023-05-22', 54, 504, 0, 504, 'Closed'),
(95, '2023-05-22', 51, 300, 30, 270, 'Closed'),
(96, '2023-05-22', 5, 1227, 62, 1165, 'Closed'),
(97, '2023-05-22', 62, 270, 0, 270, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `salereturns`
--

CREATE TABLE `salereturns` (
  `id` int NOT NULL,
  `srdate` date NOT NULL,
  `customer_id` int NOT NULL,
  `total_amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salereturns`
--

INSERT INTO `salereturns` (`id`, `srdate`, `customer_id`, `total_amount`) VALUES
(1, '2023-03-07', 7, 84),
(2, '2023-03-07', 8, 255),
(3, '2023-03-07', 7, 1600),
(4, '2023-03-09', 7, 8000),
(5, '2023-03-07', 7, 800),
(6, '2023-03-07', 7, 8000),
(7, '2023-03-07', 16, 1000),
(8, '2023-03-14', 8, 400),
(9, '2023-03-14', 8, 144),
(10, '2023-04-22', 5, 800),
(11, '2023-05-11', 7, 2352),
(12, '2023-05-11', 7, 1520),
(13, '2023-05-11', 8, 1800),
(14, '2023-05-11', 8, 6000),
(15, '2023-05-11', 16, 1600),
(16, '2023-05-11', 17, 450),
(17, '2023-05-11', 8, 1800),
(18, '2023-05-11', 7, 2250),
(19, '2023-05-11', 7, 2250),
(20, '2023-05-11', 7, 1472),
(21, '2023-05-11', 7, 900),
(22, '2023-05-11', 8, 12000),
(23, '2023-05-11', 7, 720),
(24, '2023-05-11', 16, 5400),
(25, '2023-05-11', 17, 0),
(26, '2023-05-11', 16, 0),
(27, '2023-05-11', 8, 0),
(28, '2023-05-04', 7, 0),
(29, '2023-05-11', 7, 3680),
(30, '2023-05-11', 8, 0),
(31, '2023-05-11', 8, 600),
(32, '2023-05-11', 16, 225),
(33, '2023-05-22', 8, 320);

-- --------------------------------------------------------

--
-- Table structure for table `salereturns_details`
--

CREATE TABLE `salereturns_details` (
  `id` int NOT NULL,
  `srid` int NOT NULL,
  `product_id` int NOT NULL,
  `sd_id` int NOT NULL,
  `pd_id` int NOT NULL,
  `quantity` int NOT NULL,
  `rate` int NOT NULL,
  `total_amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salereturns_details`
--

INSERT INTO `salereturns_details` (`id`, `srid`, `product_id`, `sd_id`, `pd_id`, `quantity`, `rate`, `total_amount`) VALUES
(1, 1, 6, 27, 30, 2, 42, 84),
(2, 2, 6, 23, 30, 5, 45, 225),
(3, 3, 1, 6, 26, 2, 800, 1600),
(4, 4, 1, 6, 26, 10, 800, 8000),
(5, 5, 1, 6, 26, 1, 800, 800),
(6, 6, 1, 4, 26, 10, 800, 8000),
(7, 7, 1, 21, 26, 10, 100, 1000),
(8, 8, 1, 17, 26, 4, 100, 400),
(9, 9, 5, 22, 29, 4, 36, 144),
(10, 10, 1, 1, 26, 10, 80, 800),
(11, 11, 6, 27, 30, 56, 42, 2352),
(12, 12, 2, 7, 28, 20, 76, 1520),
(13, 13, 1, 12, 27, 120, 15, 1800),
(14, 14, 1, 36, 26, 75, 80, 6000),
(15, 15, 1, 28, 26, 20, 80, 1600),
(16, 16, 6, 29, 30, 10, 45, 450),
(17, 17, 6, 23, 30, 40, 45, 1800),
(18, 18, 6, 33, 30, 50, 45, 2250),
(19, 19, 6, 33, 30, 50, 45, 2250),
(20, 20, 1, 8, 27, 40, 37, 1472),
(21, 21, 5, 34, 29, 20, 45, 900),
(22, 22, 1, 11, 26, 120, 100, 12000),
(23, 23, 5, 32, 29, 20, 36, 720),
(24, 24, 6, 14, 30, 120, 45, 5400),
(26, 26, 5, 13, 29, 10, 45, 450),
(29, 28, 1, 4, 26, 0, 800, 0),
(30, 29, 1, 5, 27, 100, 37, 3680),
(31, 30, 2, 40, 28, 0, 47, 0),
(32, 31, 1, 17, 26, 6, 100, 600),
(33, 32, 5, 19, 29, 5, 45, 225),
(34, 33, 28, 66, 40, 20, 16, 320);

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `sd_id` int NOT NULL,
  `sale_id` int NOT NULL,
  `product_id` int NOT NULL,
  `pd_id` int NOT NULL,
  `subquantity` int NOT NULL,
  `rate` int NOT NULL,
  `subtotal` int NOT NULL,
  `discount` int NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`sd_id`, `sale_id`, `product_id`, `pd_id`, `subquantity`, `rate`, `subtotal`, `discount`, `total`) VALUES
(1, 2, 1, 26, 100, 100, 10000, 1000, 9000),
(2, 2, 2, 28, 100, 47, 4700, 0, 4700),
(3, 2, 1, 27, 100, 15, 1500, 150, 1350),
(4, 3, 1, 26, 100, 1000, 100000, 10000, 90000),
(5, 3, 1, 27, 100, 46, 4600, 460, 4140),
(6, 4, 1, 26, 10, 1000, 10000, 1000, 9000),
(7, 4, 2, 28, 10, 76, 760, 0, 760),
(8, 4, 1, 27, 10, 46, 460, 46, 414),
(9, 5, 2, 28, 70, 76, 5320, 0, 5320),
(10, 6, 1, 27, 100, 15, 1500, 0, 1500),
(11, 6, 1, 26, 100, 100, 10000, 0, 10000),
(12, 7, 1, 27, 100, 15, 1500, 0, 1500),
(13, 8, 5, 29, 10, 45, 450, 0, 450),
(14, 8, 6, 30, 100, 45, 4500, 0, 4500),
(15, 9, 6, 30, 100, 45, 4500, 0, 4500),
(16, 10, 1, 26, 10, 100, 1000, 0, 1000),
(17, 11, 1, 26, 10, 100, 1000, 0, 1000),
(18, 12, 6, 30, 1, 42, 42, 0, 42),
(19, 13, 5, 29, 5, 45, 225, 0, 225),
(20, 14, 5, 29, 10, 45, 450, 0, 450),
(21, 15, 1, 26, 10, 100, 1000, 0, 1000),
(22, 16, 5, 29, 10, 45, 450, 45, 405),
(23, 16, 6, 30, 40, 45, 1800, 0, 1800),
(24, 17, 6, 30, 45, 45, 2025, 0, 2025),
(25, 18, 1, 26, 10, 100, 1000, 0, 1000),
(26, 18, 6, 30, 10, 45, 450, 0, 450),
(27, 19, 6, 30, 10, 42, 420, 0, 420),
(28, 20, 1, 26, 10, 100, 1000, 100, 900),
(29, 21, 6, 30, 5, 45, 225, 0, 225),
(30, 31, 5, 29, 50, 45, 2250, 225, 2025),
(32, 37, 5, 29, 10, 45, 450, 45, 405),
(33, 37, 6, 30, 40, 45, 1800, 0, 1800),
(34, 38, 5, 29, 10, 45, 450, 0, 450),
(35, 39, 5, 29, 10, 45, 450, 45, 405),
(36, 39, 1, 26, 40, 100, 4000, 400, 3600),
(40, 44, 2, 28, 100, 47, 4700, 0, 4700),
(41, 45, 5, 29, 20, 45, 900, 90, 810),
(42, 45, 1, 26, 10, 100, 1000, 100, 900),
(43, 46, 5, 29, 20, 45, 900, 90, 810),
(44, 46, 6, 30, 10, 45, 450, 0, 450),
(45, 47, 5, 29, 20, 45, 900, 90, 810),
(46, 47, 6, 30, 10, 45, 450, 0, 450),
(47, 50, 1, 32, 0, 42, 0, 0, 0),
(48, 51, 1, 26, 0, 100, 0, 0, 0),
(49, 52, 1, 26, 100, 100, 10000, 0, 10000),
(50, 53, 5, 29, 20, 45, 900, 0, 900),
(51, 53, 6, 30, 30, 45, 1350, 0, 1350),
(52, 53, 2, 28, 20, 47, 940, 0, 940),
(53, 53, 1, 27, 20, 15, 300, 0, 300),
(54, 54, 2, 28, 10, 47, 470, 0, 470),
(55, 55, 2, 28, 10, 47, 470, 0, 470),
(56, 56, 5, 29, 100, 45, 4500, 0, 4500),
(57, 57, 2, 28, 10, 47, 470, 14, 456),
(58, 57, 1, 27, 2, 15, 30, 1, 29),
(59, 58, 5, 29, 100, 45, 4500, 0, 4500),
(60, 59, 2, 28, 5, 47, 235, 0, 235),
(61, 60, 9, 44, 100, 12, 1200, 0, 1200),
(62, 61, 33, 35, 2, 90, 180, 0, 180),
(63, 62, 19, 38, 12, 36, 432, 9, 423),
(64, 63, 30, 41, 10, 15, 150, 3, 147),
(65, 64, 1, 27, 23, 15, 345, 10, 335),
(66, 65, 28, 40, 20, 16, 320, 0, 320),
(67, 66, 1, 27, 20, 15, 300, 0, 300),
(68, 67, 2, 28, 25, 47, 1175, 59, 1116),
(69, 68, 30, 41, 30, 15, 450, 81, 369),
(70, 69, 6, 39, 25, 24, 600, 0, 600),
(71, 70, 16, 36, 2, 25, 50, 4, 47),
(72, 71, 16, 36, 50, 25, 1250, 125, 1125),
(73, 71, 2, 28, 30, 47, 1410, 141, 1269),
(74, 72, 2, 42, 22, 15, 330, 0, 330),
(75, 73, 16, 36, 50, 25, 1250, 125, 1125),
(76, 73, 2, 28, 30, 47, 1410, 141, 1269),
(77, 74, 19, 38, 4, 36, 144, 0, 144),
(78, 75, 28, 40, 34, 16, 544, 0, 544),
(79, 76, 30, 41, 4, 15, 60, 0, 60),
(80, 76, 33, 35, 2, 90, 180, 0, 180),
(81, 77, 5, 29, 13, 45, 585, 0, 585),
(82, 78, 30, 41, 100, 15, 1500, 150, 1350),
(83, 79, 8, 47, 11, 29, 319, 0, 319),
(84, 80, 34, 34, 5, 75, 375, 0, 375),
(85, 81, 28, 40, 25, 16, 400, 0, 400),
(86, 82, 34, 34, 2, 75, 150, 0, 150),
(87, 83, 28, 40, 10, 16, 160, 0, 160),
(88, 84, 30, 41, 10, 15, 150, 0, 150),
(89, 85, 6, 30, 15, 45, 675, 7, 668),
(90, 86, 2, 28, 10, 47, 470, 0, 470),
(91, 87, 8, 47, 3, 29, 87, 0, 87),
(92, 88, 1, 33, 12, 10, 120, 0, 120),
(93, 89, 9, 44, 2, 12, 24, 0, 24),
(94, 90, 11, 46, 50, 40, 2000, 100, 1900),
(95, 91, 2, 28, 15, 47, 705, 0, 705),
(96, 92, 24, 37, 5, 30, 150, 0, 150),
(97, 93, 30, 41, 10, 15, 150, 0, 150),
(98, 94, 6, 39, 21, 24, 504, 0, 504),
(99, 95, 7, 43, 100, 3, 300, 30, 270),
(100, 96, 6, 30, 23, 45, 1035, 62, 1035),
(101, 96, 28, 40, 12, 16, 192, 0, 192),
(102, 97, 15, 45, 6, 45, 270, 0, 270);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sid` int NOT NULL,
  `suppliercode` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobileno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sid`, `suppliercode`, `name`, `email`, `address`, `mobileno`) VALUES
(1, 'GNMLTD', 'Ganesh Medice Ltd', 'ganesh.medico@gmail.com', 'Near Ganesh Mandir, Shahupuri 3rd lane, Kolhapur', '9876543218'),
(2, 'SNLLP', 'Sunny LLP', 'sunny.llp@gmail.com', 'Khari Corner, Mangalwar peth, Kolhapur', '9876543211'),
(3, ' VD003', 'Vishal Distributors', 'vishal.distributors@gmail.com', '789, PQR Plaza, Market Street, Villageton, Stateville, PIN-345678', '7654321098'),
(5, 'SHRAGN', 'Sharda Agencies', 'sharda.agencies@gmail.com', '1433, A ward, Near Khandoba Mandir, Shivaji Peth, Kolhapur', '9156544258'),
(6, 'SDVND', 'Siddhivinayak Distributions', 'siddhivinayak10@gmail.com', '1560, D Ward, Near Panchaganga Hospital, Shukrawar Peth, Kolhapur', '9166533224'),
(7, 'GREMDS', 'Green Remedies Ltd', 'green.remedies@gmail.com', '654, R. K. Nagar, Kolhapur, Maharashtra 416012\r\n', '9876543221'),
(8, 'SLDBS', 'Solaris Distributions', 'solaris.distribution@gmail.com', '104, Royal Enclave, Rajarampuri 1st Lane, Kolhapur', '9877762387'),
(9, 'SRD07', 'Shri Ramnath distribution', 'shri.ramnath.dis@example.com', '543, KLM Colony, Kolhapur, Maharashtra 416007', '9876543216'),
(10, 'SNM1', 'Sanjay medical', 'sanjay.medical@example.com', '765, MNO Society, Kolhapur, Maharashtra 416017', '9876543226'),
(11, 'SKT010', 'Sarth Ayurveda', 'Sarth.Ayurveda@gmail.com', '654 Fake Road, Citytown, XYZ654, Landcountry', '9876543210');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `mobileno` (`mobileno`),
  ADD UNIQUE KEY `mobileno_2` (`mobileno`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`,`mobileno`);

--
-- Indexes for table `online_orderdetails`
--
ALTER TABLE `online_orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oo_id` (`oo_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `online_orders`
--
ALTER TABLE `online_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `salereturns`
--
ALTER TABLE `salereturns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `salereturns_details`
--
ALTER TABLE `salereturns_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `srid` (`srid`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sale_id` (`sd_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`sd_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `mobileno` (`mobileno`),
  ADD UNIQUE KEY `mobileno_2` (`mobileno`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `mobileno_3` (`mobileno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `online_orderdetails`
--
ALTER TABLE `online_orderdetails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `online_orders`
--
ALTER TABLE `online_orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `pd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `salereturns`
--
ALTER TABLE `salereturns`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `salereturns_details`
--
ALTER TABLE `salereturns_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `sd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `online_orderdetails`
--
ALTER TABLE `online_orderdetails`
  ADD CONSTRAINT `online_orderdetails_ibfk_1` FOREIGN KEY (`oo_id`) REFERENCES `online_orders` (`id`),
  ADD CONSTRAINT `online_orderdetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `online_orders`
--
ALTER TABLE `online_orders`
  ADD CONSTRAINT `online_orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`cid`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `suppliers` (`sid`);

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`purchase_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_details_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customers` (`cid`);

--
-- Constraints for table `salereturns`
--
ALTER TABLE `salereturns`
  ADD CONSTRAINT `salereturns_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`cid`);

--
-- Constraints for table `salereturns_details`
--
ALTER TABLE `salereturns_details`
  ADD CONSTRAINT `salereturns_details_ibfk_1` FOREIGN KEY (`srid`) REFERENCES `salereturns` (`id`),
  ADD CONSTRAINT `salereturns_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `salereturns_details_ibfk_3` FOREIGN KEY (`sd_id`) REFERENCES `sale_details` (`sd_id`),
  ADD CONSTRAINT `salereturns_details_ibfk_4` FOREIGN KEY (`pd_id`) REFERENCES `purchase_details` (`pd_id`);

--
-- Constraints for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD CONSTRAINT `sale_details_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`),
  ADD CONSTRAINT `sale_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `sale_details_ibfk_3` FOREIGN KEY (`pd_id`) REFERENCES `purchase_details` (`pd_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

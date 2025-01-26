-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql105.infinityfree.com
-- Generation Time: Oct 18, 2024 at 07:29 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36690524_infoworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_data`
--

CREATE TABLE `bill_data` (
  `BillingBranch` varchar(50) NOT NULL,
  `billNo` varchar(50) NOT NULL,
  `ItemCode` varchar(50) NOT NULL,
  `serialNo` varchar(50) NOT NULL,
  `QTY` int(11) NOT NULL DEFAULT 1,
  `TotalPrice` double(10,2) NOT NULL,
  `SellingPrice` double(10,2) NOT NULL,
  `costPrice` double(10,2) NOT NULL,
  `DiscountType` int(11) NOT NULL,
  `Discount` decimal(10,2) NOT NULL,
  `Price` double(10,2) NOT NULL,
  `profit` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bill_data`
--

INSERT INTO `bill_data` (`BillingBranch`, `billNo`, `ItemCode`, `serialNo`, `QTY`, `TotalPrice`, `SellingPrice`, `costPrice`, `DiscountType`, `Discount`, `Price`, `profit`) VALUES
('iworld01', '1', '10015', '5CD34078LF', 1, 226000.00, 226000.00, 198000.00, 0, '0.00', 226000.00, 28000.00),
('iworld01', '2', '10016', '', 1, 0.00, 0.00, 0.00, 0, '0.00', 0.00, 0.00),
('iworld01', '3', '10018', '', 1, 4000.00, 4000.00, 2100.00, 2, '500.00', 3500.00, 1400.00),
('iworld01', '4', '10034', 'OS45082339001460', 1, 7900.00, 7900.00, 5200.00, 2, '700.00', 7200.00, 2000.00),
('iworld01', '4', '10039', '', 1, 2500.00, 2500.00, 500.00, 2, '1000.00', 1500.00, 1000.00),
('iworld01', '5', '10074', '2SJPPZ3', 1, 170000.00, 170000.00, 155000.00, 2, '3000.00', 167000.00, 12000.00),
('iworld01', '6', '10015', 'NDAHKA', 1, 226000.00, 226000.00, 198000.00, 2, '5000.00', 221000.00, 23000.00),
('iworld01', '7', '10078', 'I609640423', 1, 29500.00, 29500.00, 25500.00, 2, '1500.00', 28000.00, 2500.00),
('iworld01', '8', '10086', 'EMS006696', 1, 5500.00, 5500.00, 3500.00, 0, '0.00', 5500.00, 2000.00),
('iworld01', '9', '10085', 'BD3497549', 1, 20500.00, 20500.00, 15222.00, 2, '4500.00', 16000.00, 778.00),
('iworld01', '9', '10026', 'BC9947218', 1, 21500.00, 21500.00, 17987.00, 2, '3500.00', 18000.00, 13.00),
('iworld01', '10', '10094', '5CD351HK1X', 1, 165000.00, 165000.00, 127000.00, 2, '20000.00', 145000.00, 18000.00),
('iworld01', '11', '10094', '5CD351HK1X', 1, 165000.00, 165000.00, 127000.00, 2, '20000.00', 145000.00, 18000.00);

-- --------------------------------------------------------

--
-- Table structure for table `bill_head`
--

CREATE TABLE `bill_head` (
  `BillingBranch` varchar(50) NOT NULL,
  `billNo` varchar(50) NOT NULL,
  `billTotal` double(10,2) NOT NULL,
  `PaybleBillAmountSend` double(10,2) NOT NULL,
  `TotalDiscountSend` double(10,2) NOT NULL,
  `totalProfit` double(10,2) NOT NULL,
  `Cashier` varchar(500) NOT NULL,
  `custPaid` double(10,2) NOT NULL,
  `cusBallence` double(10,2) NOT NULL,
  `cansel` int(11) NOT NULL DEFAULT 0,
  `customerID` int(11) NOT NULL,
  `timespam` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bill_head`
--

INSERT INTO `bill_head` (`BillingBranch`, `billNo`, `billTotal`, `PaybleBillAmountSend`, `TotalDiscountSend`, `totalProfit`, `Cashier`, `custPaid`, `cusBallence`, `cansel`, `customerID`, `timespam`) VALUES
('iworld01', '1', 226000.00, 226000.00, 0.00, 28000.00, 'Hashan', 226.00, -225774.00, 2, 2, '2024-07-11 05:59:34'),
('iworld01', '2', 0.00, 0.00, 0.00, 0.00, 'Hashan', 0.00, 0.00, 2, 2, '2024-07-12 05:54:49'),
('iworld01', '3', 4000.00, 3500.00, 500.00, 1400.00, 'Hashan', 3500.00, 0.00, 2, 3, '2024-07-13 06:10:30'),
('iworld01', '4', 10400.00, 8700.00, 1700.00, 3000.00, 'Hashan', 8700.00, 0.00, 2, 0, '2024-07-22 06:09:27'),
('iworld01', '5', 170000.00, 167000.00, 3000.00, 12000.00, 'Hashan', 167000.00, 0.00, 2, 0, '2024-08-01 09:53:47'),
('iworld01', '6', 226000.00, 221000.00, 5000.00, 23000.00, 'Hashan', 221000.00, 0.00, 2, 0, '2024-08-04 05:50:14'),
('iworld01', '7', 29500.00, 28000.00, 1500.00, 2500.00, 'Hashan', 28000.00, 0.00, 2, 2, '2024-08-04 06:05:23'),
('iworld01', '8', 5500.00, 5500.00, 0.00, 2000.00, 'Hashan', 5500.00, 0.00, 0, 6, '2024-08-06 10:32:39'),
('iworld01', '9', 42000.00, 34000.00, 8000.00, 791.00, 'Hashan', 34000.00, 0.00, 0, 7, '2024-08-12 06:32:19'),
('iworld01', '10', 165000.00, 145000.00, 20000.00, 18000.00, 'Hashan', 145000.00, 0.00, 0, 0, '2024-08-13 08:50:51'),
('iworld01', '11', 165000.00, 145000.00, 20000.00, 18000.00, 'Hashan', 145000.00, 0.00, 0, 8, '2024-08-13 08:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branchCode` varchar(100) NOT NULL,
  `branchName` varchar(100) NOT NULL,
  `BranchAddress` varchar(500) NOT NULL,
  `BranchTel` varchar(30) NOT NULL,
  `purchesNo` int(11) NOT NULL DEFAULT 0,
  `trancferNo` int(11) NOT NULL,
  `billNo` int(11) NOT NULL,
  `returnNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branchCode`, `branchName`, `BranchAddress`, `BranchTel`, `purchesNo`, `trancferNo`, `billNo`, `returnNo`) VALUES
('iworld01', 'InfoWorld Computer Solution', 'No.811, Sawmill Junction, Kaduruwela', '027-2055501', 44, 0, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `brand_names`
--

CREATE TABLE `brand_names` (
  `catCode` varchar(100) NOT NULL,
  `brandCode` varchar(100) NOT NULL,
  `brandName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brand_names`
--

INSERT INTO `brand_names` (`catCode`, `brandCode`, `brandName`) VALUES
('', '', ''),
('ADP01', 'ADPLAP', 'Laptop Charger'),
('ADP01', 'ADPMULTI', 'NOTEBOOK MULTI ADAPTER'),
('BAG01', 'BAGAC', 'Acer'),
('BAG01', 'BAGAS', 'Asus'),
('BAG01', 'BAGDE', 'Dell'),
('BAG01', 'BAGHP', 'Hewlett Packard'),
('BAG01', 'BAGLE', 'Lenovo'),
('BAT01', 'BATLAP', 'Laptop Battery'),
('CAM01', 'CAMHIK', 'Hikvision'),
('CBL01', 'CBLEX', 'USB Extention'),
('CBL01', 'CBLHD', 'HDMI'),
('CBL01', 'CBLPR', 'USB Printer Cable'),
('CBL01', 'CBLPWR', 'Power Cable'),
('CBL01', 'CBLRC', '2RC'),
('CCTVACC01', 'CCTVVB', 'Video Balun'),
('CHG01', 'CHGTRS', 'TRANS'),
('CLEANER01', 'CLEANERLIQ', 'Other'),
('CNVT01', 'CNVTHD', 'VGA to HDMI'),
('CNVT01', 'CNVTHDMI', 'Maxcom'),
('CNVT01', 'CNVTUSB', 'GIGA'),
('CNVT01', 'CNVTVGA', 'VGA to HDMI'),
('DISP01', 'DISPLAP', 'Laptop Display'),
('DON01', 'DONBT', 'Bluetooth '),
('DON01', 'DONWI', 'WiFi'),
('ENC01', 'ENCOSC', 'OSCOO'),
('ENC01', 'ENCWD', 'WD '),
('FAN01', 'FANDES', 'Desktop CPU Fan'),
('FAN01', 'FANLAP', 'Laptop CPU Fan'),
('HDD01', 'HDDM.2', 'M.2 Hard Drive'),
('HDD01', 'HDDNVME', 'NVME Hard Drive'),
('HDD01', 'HDDPORT', 'Portable HDD'),
('HDD01', 'HDDSSD', 'SSD Hard Drive'),
('INK01', 'INKBR', 'Brother'),
('INK01', 'INKCA', 'Canon'),
('INK01', 'INKEP', 'Epson'),
('INK01', 'INKHP', 'Hewlett Packard'),
('KB01', 'KBJEDEL', 'Jedel'),
('KB01', 'KBLAP', 'Laptop Keyboard'),
('KB01', 'KBMTION', 'Meetion'),
('KB01', 'KBXB', 'X-Brand'),
('LAP01', 'LAPAC', 'Acer'),
('LAP01', 'LAPAS', 'Asus'),
('LAP01', 'LAPDE', 'Dell'),
('LAP01', 'LAPHP', 'Hewlett Packard'),
('LAP01', 'LAPLE', 'Lenovo'),
('MC01', 'MCKIN', 'Kingston'),
('MC01', 'MCTM', 'Team'),
('MON01', 'MONAC', 'Acer'),
('MON01', 'MONAI', 'Aiwa'),
('MON01', 'MONAS', 'Asus'),
('MON01', 'MONDA', 'Dahua'),
('MON01', 'MONDE', 'Dell'),
('MON01', 'MONHP', 'Hewlett Packard'),
('MON01', 'MONHU', 'Huawei'),
('MON01', 'MONJO', 'Jooyontech'),
('MON01', 'MONLE', 'Lenovo'),
('MON01', 'MONLG', 'LG'),
('MON01', 'MONOT', 'Other'),
('MON01', 'MONSA', 'Samsung'),
('MOU01', 'MOUAL', 'Alcatroz'),
('MOU01', 'MOUAS', 'Asus'),
('MOU01', 'MOUAT', 'Other'),
('MOU01', 'MOUDE', 'Dell'),
('MOU01', 'MOUDES', 'Desso'),
('MOU01', 'MOUHA', 'Havit'),
('MOU01', 'MOUHP', 'Hewlett Packard'),
('MOU01', 'MOUJE', 'Jedel'),
('MOU01', 'MOUJEO', 'Jeoang'),
('MOU01', 'MOULE', 'Lenovo'),
('MOU01', 'MOULO', 'Logitech'),
('MOU01', 'MOULOGI', 'Logitech'),
('MOU01', 'MOUPRO', 'Prolink'),
('MOU01', 'MOUXB', 'X-Brand'),
('NET01', 'NETPCI', 'PCI Express'),
('NET01', 'NETSW', 'Network Switch'),
('PEN01', 'PENOSC', 'OSCOO'),
('PHONE01', 'PHONECBL', 'Phone Charging Cable'),
('PHONE01', 'PHONEHS', 'Headset '),
('PRI01', 'PRICA', 'Canon'),
('PRI01', 'PRIEP', 'Epson'),
('PRI01', 'PRIHP', 'Hewlett Packard'),
('PRI01', 'PRIRO', 'Rongta'),
('PRI01', 'PRIX', 'X - Printer'),
('PRO01', 'PROEP', 'Epson'),
('PSU01', 'PSUCCTV', 'CCTV Power Supply'),
('PSU01', 'PSUCPU', 'Desktop Power Supply'),
('PSU01', 'PSUPRINT', 'Printer Power Supply'),
('REPAIR01', 'REPAIRDE', 'Desktop Repair Charge'),
('REPAIR01', 'REPAIRLAP', 'Laptop Repair Charges'),
('RIB01', 'RIBEP', 'Epson'),
('ROU01', 'ROUMOB', 'Mobile Router'),
('SBOX01', 'SBOX', 'Sun Box 100 x 100'),
('SERVICE01', 'SERVICEDES', 'Desktop Service Charges'),
('SERVICE01', 'SERVICEHING', 'Laptop Hinges Repair Charges'),
('SERVICE01', 'SERVICELAP', 'Laptop Service Charges'),
('SERVICE01', 'SERVICESOFT', 'Soft Ware Installation Charges'),
('SOFT01', 'SOFTVG', 'Virus Guard'),
('SPARE01', 'SPARELAP', 'Dell'),
('SPK01', 'SPKJE', 'Jedel'),
('SPK01', 'SPKKI', 'Kisonli'),
('SPK01', 'SPKX', 'X - Brand'),
('STND01', 'STNDHP', 'Headphone Stand'),
('TON01', 'TONAI', 'AIT '),
('TON01', 'TONAK', 'AKAS'),
('TON01', 'TONOA', 'OAT'),
('TON01', 'TONOT', 'Other'),
('TON01', 'TONPRI', 'Print - Rite'),
('TOOL01', 'TOOLNET', 'Tool Net Work'),
('TOOL01', 'TOOLPO', 'Power Extension'),
('STND01', 'UNK', 'Dome'),
('ADP01', 'Wi-Fi', 'LB-Link');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catCode` varchar(100) NOT NULL,
  `catName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catCode`, `catName`) VALUES
('', ''),
('ADP01', 'Adapter'),
('BAG01', 'Laptop Carrying Bag'),
('BAT01', 'Battery'),
('CAM01', 'Camera'),
('CBL01', 'Cable'),
('CCTVACC01', 'CCTV Accessories'),
('CHG01', 'Phone Charger'),
('CLEANER01', 'CLEANER'),
('CNVT01', 'Convertor'),
('DISP01', 'Display'),
('DON01', 'Dongle'),
('ENC01', 'Encloser'),
('FAN01', 'Fan'),
('HDD01', 'Hard Disk'),
('INK01', 'Printer Ink'),
('KB01', 'Keyboard'),
('LAP01', 'Laptop'),
('MC01', 'Micro Chip'),
('MON01', 'Monitor'),
('MOU01', 'Mouse'),
('NET01', 'Network'),
('PEN01', 'Pen Drive'),
('PHONE01', 'Phone Accessories'),
('PRI01', 'Printer'),
('PRO01', 'Projector'),
('PSU01', 'Power Supply'),
('REPAIR01', 'Repair'),
('RIB01', 'Printer Ribbon'),
('ROU01', 'Router'),
('SBOX01', 'Sun Box'),
('SERVICE01', 'Service Charge'),
('SOFT01', 'Software'),
('SPARE01', 'Laptop Spare Parts'),
('SPK01', 'Speaker'),
('STND01', 'Stand'),
('SUB01', 'SUB WOOFER'),
('TON01', 'TONER'),
('TOOL01', 'TOOL');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `address` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `mobile`, `address`) VALUES
(0, 'Not Registered Customer', 'Not Registered Customer', 'Not Registered Customer'),
(2, 'M.M.L.N.Ariyarathna', '0775160232', 'No.M550, Parakum Pedesa, Kaduruwela'),
(3, 'Sri Lanka Air Force', '027-2247 550', 'Hingurakgoda'),
(4, 'M.M.L.N.Ariyarathna', '0775160232', 'No.M550, Parakum Pedesa, Kaduruwela'),
(5, 'M.M.L.N.Ariyarathna', '0775160232', 'No.M550, Parakum Pedesa, Kaduruwela'),
(6, 'Imaya Sehaji', '0716601886', 'No.246, Udyana Pedesa, 4th canel , Kaduruwela'),
(7, 'Hotel Abimane Grand ', '0703043047', 'Dambulla Road, Thorayaya, Kurunegala.'),
(8, 'Anuradha Gamage', '0777860115', 'Hotel Sudu Araliya');

-- --------------------------------------------------------

--
-- Table structure for table `icode`
--

CREATE TABLE `icode` (
  `icode` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `icode`
--

INSERT INTO `icode` (`icode`) VALUES
(10112);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `catCode` varchar(100) NOT NULL,
  `brandCode` varchar(100) NOT NULL,
  `itemCode` varchar(100) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `costPrice` double(10,2) NOT NULL,
  `sellingPrice` double(10,2) NOT NULL,
  `reorderLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`catCode`, `brandCode`, `itemCode`, `itemName`, `costPrice`, `sellingPrice`, `reorderLevel`) VALUES
('', '', '', '', 0.00, 0.00, 0),
('MOU01', 'MOUPRO', '10001', 'Prolink Wireless Mouse (PMW5008)', 2100.00, 3500.00, 2),
('PRI01', 'PRIRO', '10002', 'Rongta RP331C Thermal Receipt Printer (USB+Serial+Ethernet) ', 23000.00, 29000.00, 1),
('INK01', 'INKCA', '10003', 'Print - Rite Canon Compatible GI - 590/ 790 Ink Bottle (Black)', 1200.00, 2000.00, 2),
('INK01', 'INKCA', '10004', 'Print - Rite Canon Compatible GI - 590/ 790 Ink Bottle (Cyan)', 1000.00, 1800.00, 2),
('INK01', 'INKCA', '10005', 'Print - Rite Canon Compatible GI - 590/ 790 Ink Bottle (Magenta)', 1000.00, 1800.00, 2),
('INK01', 'INKCA', '10006', 'Print - Rite Canon Compatible GI - 590/ 790 Ink Bottle (Yellow)', 1000.00, 1800.00, 2),
('RIB01', 'RIBEP', '10007', 'Printer - Rite Epson Compatible Ribbon LQ310/ LX310', 635.00, 1800.00, 5),
('PRI01', 'PRICA', '10008', 'Canon LBP6030 Laser Jet (BK) Printer', 48500.00, 57000.00, 1),
('PRI01', 'PRICA', '10009', 'Canon Pixma Ink Efficient G1730 Color Printer', 43500.00, 50000.00, 1),
('DON01', 'DONBT', '10010', 'Bluetooth 5.0 Dongle', 420.00, 1250.00, 2),
('CHG01', 'CHGTRS', '10011', 'Trans 25W Super-Fast Micro Charger (TL-08)', 1200.00, 2100.00, 2),
('SPK01', 'SPKKI', '10012', 'Kisonli V400 M/M Speaker', 500.00, 1250.00, 2),
('ADP01', 'Wi-Fi', '10013', 'LB-Link 150Mbps Nano Wireless N USB Adapter BL-WN151', 580.00, 1800.00, 2),
('STND01', 'UNK', '10014', 'Dome Stand', 350.00, 1000.00, 2),
('LAP01', 'LAPHP', '10015', 'HP 250 G10 CORE I5 (1335U) 13TH GEN. 16GB / 512SSD / 15.6 \'FHD / DOS', 198000.00, 226000.00, 1),
('BAG01', 'BAGHP', '10016', 'HP Laptop Backpack', 0.00, 0.00, 0),
('MON01', 'MONLE', '10017', 'Lenovo 22\" IPS Frameless FHD Monitor', 16800.00, 20800.00, 1),
('CBL01', 'CBLHD', '10018', '20M HDMI Cable', 2100.00, 4000.00, 1),
('CNVT01', 'CNVTUSB', '10019', 'USB 3.0 To LAN GIGA', 1750.00, 3000.00, 1),
('CNVT01', 'CNVTVGA', '10020', 'Maxcom VGA to HDMI Convertor', 1250.00, 2250.00, 1),
('SBOX01', 'SBOX', '10021', 'Sun Box 100 x 100', 325.00, 1000.00, 5),
('MC01', 'MCKIN', '10022', 'Kingston Canvas 128GB 100MB/s Original Micro Chip', 3750.00, 5000.00, 1),
('MC01', 'MCKIN', '10023', 'Kingston Canvas 64GB 100MB/s Original Micro Chip', 1850.00, 3000.00, 2),
('MC01', 'MCTM', '10024', 'Team Micro SDHC 32GB 100MB/s Class10 UHS-1 Micro Chip', 1100.00, 2300.00, 2),
('ROU01', 'ROUMOB', '10025', 'TABWD MF920 4G Mobile Router (LTE 150Mbps / Wi-Fi 300Mbps) ', 7800.00, 12500.00, 1),
('CAM01', 'CAMHIK', '10026', 'Hikvision Ezviz H9C Dual 2K (3MP + 3MP) Smart Home Camera', 17987.00, 21500.00, 1),
('ADP01', 'ADPLAP', '10027', 'Asus 19V 3.42A Short Pin 10th Gen. New Laptop Charger', 2350.00, 4000.00, 1),
('ADP01', 'ADPLAP', '10028', 'HP Blue Pin 19.5V 3.34A 65W Original Laptop Charger', 2350.00, 4000.00, 1),
('BAT01', 'BATLAP', '10029', 'Dell 5558 8th Gen. Original (M5Y1K) Laptop Battery', 8500.00, 11750.00, 1),
('SPARE01', 'SPARELAP', '10030', 'Dell 3558/3568 Power Button with Cable', 4500.00, 7000.00, 1),
('STND01', 'STNDHP', '10031', 'Onikuma ST-3 Gaming Headphone Stand', 1300.00, 2500.00, 1),
('CCTVACC01', 'CCTVVB', '10032', 'Video balun AHD 200M', 265.00, 1000.00, 5),
('HDD01', 'HDDSSD', '10033', 'OSCOO Black 512GB SATA 2.5\" SSD ', 10350.00, 14250.00, 1),
('HDD01', 'HDDNVME', '10034', 'Oscoo 128GB NVME ON900 SSD', 5200.00, 7900.00, 1),
('HDD01', 'HDDM.2', '10035', 'Oscoo 128GB M.2 ON800 SSD', 4000.00, 6500.00, 1),
('SERVICE01', 'SERVICEDES', '10036', 'Desktop Full-Service Charges', 500.00, 2000.00, 1),
('SERVICE01', 'SERVICEHING', '10037', 'Laptop Hinges Repair Charges', 750.00, 3500.00, 1),
('SERVICE01', 'SERVICELAP', '10038', 'Laptop Full-Service Charges', 750.00, 2500.00, 1),
('SERVICE01', 'SERVICESOFT', '10039', 'Desktop / Laptop Software Installation Charges', 500.00, 2500.00, 1),
('ADP01', 'ADPLAP', '10040', 'Acer Yellow Pin 19V 3.42A Laptop Charger', 2350.00, 4000.00, 1),
('ADP01', 'ADPLAP', '10041', 'Acer 10th Gen. 19V 3.42A 3.0*1.1MM 65W Laptop Charger', 2350.00, 4000.00, 1),
('BAT01', 'BATLAP', '10042', 'Dell 3521 40W XCMRD Original Laptop Battery', 7500.00, 11500.00, 1),
('BAT01', 'BATLAP', '10043', 'HP CS03XL Laptop Battery', 8500.00, 12500.00, 1),
('FAN01', 'FANLAP', '10044', 'Dell Inspiron 3593 CPU Fan', 4500.00, 6500.00, 1),
('KB01', 'KBLAP', '10045', 'Dell 3542 OEM US Laptop key Board', 3000.00, 5500.00, 1),
('ADP01', 'ADPLAP', '10046', 'ASUS Big Pin 19V 3.42A 5.5*2.5 Laptop Charger ', 2350.00, 4000.00, 1),
('ADP01', 'ADPLAP', '10047', 'Asus Small Pin 19V 2.1A Laptop Charger ', 2350.00, 4000.00, 1),
('ADP01', 'ADPLAP', '10048', 'Asus 19V 3.42A 4.0. *1.35MM P2540 65W Laptop Charger', 2350.00, 4000.00, 1),
('BAT01', 'BATLAP', '10049', 'HP HT03XL Original Battery', 8500.00, 12500.00, 1),
('DISP01', 'DISPLAP', '10050', '15.6\" 30pin Slim HD with Frame OEM US Display', 12500.00, 17500.00, 1),
('KB01', 'KBLAP', '10051', 'HP Pavillion 15D/ 15N/ 15G/ 15R/ Laptop Keyboard', 3000.00, 6000.00, 1),
('ADP01', 'ADPLAP', '10052', 'Dell Small Pin 19.5V 3.34A 4*5 3.0MM Laptop Charger', 2250.00, 3900.00, 1),
('DISP01', 'DISPLAP', '10053', 'BOE 15.6\" 30pin HD Nano Display', 13000.00, 18000.00, 1),
('DISP01', 'DISPLAP', '10054', '15.6\" 40pin Normal Display', 12500.00, 17500.00, 1),
('DISP01', 'DISPLAP', '10055', '15.6\" 30pin Slim HD Display', 12500.00, 17500.00, 1),
('ADP01', 'ADPLAP', '10056', 'LENOVO usb tYPE 20v 3.25a 65w Laptop Charger', 2500.00, 4250.00, 1),
('BAT01', 'BATLAP', '10057', 'Dell YRDD6 Original Laptop Battery', 11000.00, 14500.00, 1),
('INK01', 'INKCA', '10058', 'Refill Ink Canon GI - 790 Black Ink Bottle', 495.00, 1900.00, 2),
('INK01', 'INKCA', '10059', 'Refill Ink Canon GI - 790 Magenta Ink Bottle', 380.00, 1700.00, 2),
('INK01', 'INKCA', '10060', 'Refill Ink Canon GI - 790 Cyan Ink Bottle', 380.00, 1700.00, 2),
('INK01', 'INKCA', '10061', 'Refill Ink Canon GI - 790 Yellow Ink Bottle', 380.00, 1700.00, 2),
('INK01', 'INKEP', '10062', 'Refill Ink Epson 003 Magenta Ink Bottle', 440.00, 1700.00, 2),
('INK01', 'INKEP', '10063', 'Refill Ink Epson 003 Cyan Ink Bottle', 440.00, 1700.00, 2),
('INK01', 'INKEP', '10064', 'Refill Ink Epson 664 Black  Ink Bottle', 380.00, 1700.00, 2),
('INK01', 'INKHP', '10065', 'Refill Ink HP GT-51 Black  Ink Bottle', 450.00, 1700.00, 2),
('PRI01', 'PRICA', '10066', 'Canon Pixma Ink Efficient G3730 Color Wireless MF Printer', 56500.00, 65000.00, 1),
('PRI01', 'PRICA', '10067', 'Canon Pixma Ink Efficient G2010 Color MF Printer', 0.00, 0.00, 1),
('REPAIR01', 'REPAIRDE', '10068', 'Repair Charges', 0.00, 0.00, 1),
('TOOL01', 'TOOLNET', '10069', 'Crimping Tool', 750.00, 2000.00, 1),
('NET01', 'NETPCI', '10070', 'E PCI 10 / 100 / 1000 Mbps Gigabit Ethernet Lan Card', 2200.00, 3900.00, 1),
('TOOL01', 'TOOLPO', '10071', 'Power Distribution Bar', 4250.00, 7500.00, 1),
('SOFT01', 'SOFTVG', '10072', 'Eset Internet Security 3 User Virus Guard', 3950.00, 5412.00, 1),
('SOFT01', 'SOFTVG', '10073', 'Eset Internet Security 1 User Virus Guard', 1775.00, 2499.00, 1),
('LAP01', 'LAPDE', '10074', 'Dell Vostro 3520 Core i5 12th Gen. Laptop (8GB RAM, 512GB NVME, 15.6\" Display)', 155000.00, 170000.00, 1),
('PHONE01', 'PHONECBL', '10075', 'Remax C113 USB to Type \"C\" Cable', 290.00, 850.00, 2),
('PHONE01', 'PHONEHS', '10076', 'MSL-08 Neckband Headsets', 2000.00, 3500.00, 1),
('MOU01', 'MOULOGI', '10077', 'Logitech G302 Daedal US Prime Mouse', 1350.00, 3000.00, 2),
('HDD01', 'HDDPORT', '10078', 'Transcend Store Jet 25H3 2TB USB 3.1 Gen 1 Portable HDD', 25500.00, 29500.00, 1),
('HDD01', 'HDDPORT', '10079', 'Transcend Store Jet 25H3 1TB USB 3.1 Gen 1 Portable HDD', 20500.00, 25000.00, 1),
('TON01', 'TONPRI', '10080', 'Print-Rite 85A / 35A Compatible Toner', 0.00, 0.00, 5),
('TON01', 'TONPRI', '10081', 'Print-Rite 107A Compatible Toner with Chip', 3970.00, 7000.00, 5),
('TON01', 'TONPRI', '10082', 'Print-Rite PR-855 Ribbon', 1700.00, 3000.00, 2),
('TON01', 'TONPRI', '10083', 'Print-Rite LQ-300 Ribbon', 750.00, 2000.00, 2),
('CAM01', 'CAMHIK', '10084', 'Hikvision DS-2CE16DOT-EXLPF 2MP Smart Hybrid Light Fixed Mini Bullet Camera', 4731.00, 7500.00, 5),
('CAM01', 'CAMHIK', '10085', 'Hikvision CS-H8C 4G 2K PT Camera', 15222.00, 20500.00, 2),
('KB01', 'KBLAP', '10086', 'KEYBOARD LENOVO IDEAPAD 100- 15IBY OEM', 3500.00, 5500.00, 1),
('CLEANER01', 'CLEANERLIQ', '10087', 'Handboss Universal Foam Cleaner', 380.00, 1500.00, 2),
('KB01', 'KBJEDEL', '10088', 'Jedel K100 Mini USB Keyboard', 995.00, 2000.00, 2),
('CNVT01', 'CNVTHD', '10089', 'VGA to HDMI Convertor', 1250.00, 2500.00, 2),
('PSU01', 'PSUCCTV', '10090', '12V 2A CCTV Power Supply', 375.00, 1500.00, 5),
('CBL01', 'CBLPWR', '10091', 'Laptop Power Cable with Fuse', 325.00, 1000.00, 5),
('CBL01', 'CBLHD', '10092', 'HDMI 20M cable', 0.00, 0.00, 1),
('CBL01', 'CBLHD', '10093', 'HDMI 15M cable', 0.00, 0.00, 1),
('LAP01', 'LAPHP', '10094', 'HP 250 G10 i3 13TH GEN 4GB RAM 256GB NVME FREE DOS', 127000.00, 165000.00, 1),
('MOU01', 'MOUPRO', '10095', 'Prolink Wireless Mouse (PMW5009)', 0.00, 0.00, 2),
('MOU01', 'MOUPRO', '10096', 'Prolink Wireless Mouse (PMW6009)', 0.00, 0.00, 2),
('KB01', 'KBMTION', '10097', 'Meetion K100 USB Wired Key Board', 0.00, 0.00, 2),
('KB01', 'KBXB', '10098', 'X-Brand TP-312 Trilingual USB key Board ', 0.00, 0.00, 2),
('ADP01', 'ADPMULTI', '10099', 'Notebook Multi Power Adapter (12-24V) 96watt', 0.00, 0.00, 2),
('ADP01', 'Wi-Fi', '10100', 'LB-Link BL-WN300AX 300Mbps Wi-Fi 6 Wireless USB Adapter', 0.00, 0.00, 2),
('PRI01', 'PRICA', '10101', 'Canon Pixma Ink Efficient G2730 Color All in One Printer', 0.00, 0.00, 1),
('INK01', 'INKCA', '10102', 'Canon Pixma 71 Genuine Black Ink Bottle', 0.00, 0.00, 2),
('INK01', 'INKCA', '10103', 'Canon Genuine 71 Cyan Ink Bottle ', 0.00, 0.00, 2),
('INK01', 'INKCA', '10104', 'Canon Genuine 71 Yellow Ink Bottle ', 0.00, 0.00, 2),
('INK01', 'INKCA', '10105', 'Canon Genuine 71 Magenta Ink Bottle ', 0.00, 0.00, 2),
('NET01', 'NETSW', '10106', 'TP-Link 8-Port LS1008 10/100Mpbs Network Switch', 0.00, 0.00, 2),
('HDD01', 'HDDSSD', '10107', 'Oscoo 128GB SATA Black SSD', 0.00, 0.00, 2),
('HDD01', 'HDDSSD', '10108', '	OSCOO Black 512GB SATA Black 2.5\" SSD', 0.00, 0.00, 2),
('HDD01', 'HDDSSD', '10109', '	OSCOO 128GB SATA Blue 2.5\" SSD', 0.00, 0.00, 2),
('HDD01', 'HDDSSD', '10110', '	OSCOO  256GB SATA Blue 2.5\" SSD', 0.00, 0.00, 2),
('HDD01', 'HDDSSD', '10111', '	OSCOO Black 512GB SATA 2.5\" SSD', 0.00, 0.00, 2),
('ENC01', 'ENCOSC', '10112', 'Oscoo 2.5\" SATA USB Enclosure ', 0.00, 0.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `BrachCode` varchar(50) NOT NULL,
  `perchusNo` int(11) NOT NULL,
  `paymentMethod` varchar(10) NOT NULL,
  `paidAmount` double(10,2) NOT NULL,
  `chequeNo` varchar(50) NOT NULL DEFAULT 'N/A',
  `chequeDate` varchar(50) NOT NULL DEFAULT 'N/A',
  `BankName` varchar(100) NOT NULL,
  `Reserve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `BrachCode`, `perchusNo`, `paymentMethod`, `paidAmount`, `chequeNo`, `chequeDate`, `BankName`, `Reserve`) VALUES
(1, 'iworld01', 9, 'c', 9300.00, 'N/A', 'N/A', '', 0),
(2, 'iworld01', 10, 'c', 198000.00, 'N/A', 'N/A', '', 0),
(3, 'iworld01', 11, 'c', 198000.00, 'N/A', 'N/A', '', 0),
(4, 'iworld01', 12, 'cq', 13100.00, '147224', '2024-08-26', 'Sampath Bank', 0),
(5, 'iworld01', 13, 'c', 33600.00, 'N/A', 'N/A', '', 0),
(6, 'iworld01', 14, 'c', 4200.00, 'N/A', 'N/A', '', 0),
(7, 'iworld01', 15, 'c', 7000.00, 'N/A', 'N/A', '', 0),
(8, 'iworld01', 16, 'c', 9300.00, 'N/A', 'N/A', '', 0),
(9, 'iworld01', 17, 'c', 26000.00, 'N/A', 'N/A', '', 0),
(10, 'iworld01', 18, 'c', 11000.00, 'N/A', 'N/A', '', 0),
(11, 'iworld01', 19, 'c', 15600.00, 'N/A', 'N/A', '', 0),
(12, 'iworld01', 20, 'c', 53961.00, 'N/A', 'N/A', '', 0),
(13, 'iworld01', 21, 'c', 17700.00, 'N/A', 'N/A', '', 0),
(14, 'iworld01', 22, 'cq', 28600.00, '147227', '2024-08-11', 'Sampath Bank', 0),
(15, 'iworld01', 23, 'c', 20800.00, 'N/A', 'N/A', '', 0),
(16, 'iworld01', 24, 'c', 41050.00, 'N/A', 'N/A', '', 0),
(17, 'iworld01', 25, 'c', 17900.00, 'N/A', 'N/A', '', 0),
(18, 'iworld01', 26, 'c', 15500.00, 'N/A', 'N/A', '', 0),
(19, 'iworld01', 27, 'c', 42600.00, 'N/A', 'N/A', '', 0),
(20, 'iworld01', 28, 'c', 2500.00, 'N/A', 'N/A', '', 0),
(21, 'iworld01', 29, 'c', 56500.00, 'N/A', 'N/A', '', 0),
(22, 'iworld01', 30, 'c', 5900.00, 'N/A', 'N/A', '', 0),
(23, 'iworld01', 31, 'c', 17000.00, 'N/A', 'N/A', '', 0),
(24, 'iworld01', 32, 'cq', 19750.00, '147228', '2024-09-05', 'Sampath Bank', 0),
(25, 'iworld01', 33, 'c', 44375.00, 'N/A', 'N/A', '', 0),
(26, 'iworld01', 34, 'c', 155000.00, 'N/A', 'N/A', '', 0),
(27, 'iworld01', 35, 'cq', 12200.00, '147229', '2024-09-24', 'Sampath Bank', 0),
(28, 'iworld01', 36, 'c', 66500.00, 'N/A', 'N/A', '', 0),
(29, 'iworld01', 37, 'cq', 67000.00, '147232', '2024-09-15', 'Sampath Bank', 0),
(30, 'iworld01', 38, 'c', 56772.00, 'N/A', 'N/A', '', 0),
(31, 'iworld01', 39, 'c', 76110.00, 'N/A', 'N/A', '', 0),
(32, 'iworld01', 40, 'c', 3500.00, 'N/A', 'N/A', '', 0),
(33, 'iworld01', 41, 'c', 11275.00, 'N/A', 'N/A', '', 0),
(34, 'iworld01', 42, 'c', 7500.00, 'N/A', 'N/A', '', 0),
(35, 'iworld01', 43, 'c', 16250.00, 'N/A', 'N/A', '', 0),
(36, 'iworld01', 44, 'c', 127000.00, 'N/A', 'N/A', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purch_data`
--

CREATE TABLE `purch_data` (
  `branchCode` varchar(50) DEFAULT NULL,
  `PurchesNo` varchar(50) DEFAULT NULL,
  `itemCode` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `costPrice` double(10,2) NOT NULL,
  `totalPrice` double(10,2) NOT NULL,
  `serialAdded` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purch_data`
--

INSERT INTO `purch_data` (`branchCode`, `PurchesNo`, `itemCode`, `qty`, `costPrice`, `totalPrice`, `serialAdded`) VALUES
('iworld01', '11', '10015', 1, 198000.00, 198000.00, 1),
('iworld01', '11', '10016', 1, 0.00, 0.00, 1),
('iworld01', '12', '10012', 10, 500.00, 5000.00, 1),
('iworld01', '12', '10010', 0, 420.00, 2100.00, 1),
('iworld01', '12', '10010', 5, 420.00, 2100.00, 1),
('iworld01', '12', '10011', 5, 1200.00, 6000.00, 1),
('iworld01', '13', '10017', 2, 16800.00, 33600.00, 1),
('iworld01', '14', '10018', 2, 2100.00, 4200.00, 0),
('iworld01', '15', '10019', 4, 1750.00, 7000.00, 1),
('iworld01', '16', '10014', 10, 350.00, 3500.00, 1),
('iworld01', '16', '10013', 10, 580.00, 5800.00, 1),
('iworld01', '17', '10023', 10, 1850.00, 18500.00, 1),
('iworld01', '17', '10022', 2, 3750.00, 7500.00, 1),
('iworld01', '18', '10024', 10, 1100.00, 11000.00, 1),
('iworld01', '19', '10025', 2, 7800.00, 15600.00, 1),
('iworld01', '20', '10026', 3, 17987.00, 53961.00, 1),
('iworld01', '21', '10027', 1, 2350.00, 2350.00, 1),
('iworld01', '21', '10028', 1, 2350.00, 2350.00, 1),
('iworld01', '21', '10029', 1, 8500.00, 8500.00, 1),
('iworld01', '21', '10030', 1, 4500.00, 4500.00, 1),
('iworld01', '22', '10031', 2, 1300.00, 2600.00, 1),
('iworld01', '22', '10032', 20, 265.00, 5300.00, 1),
('iworld01', '22', '10033', 2, 10350.00, 20700.00, 1),
('iworld01', '23', '10034', 4, 5200.00, 20800.00, 1),
('iworld01', '24', '10040', 2, 2350.00, 4700.00, 1),
('iworld01', '24', '10041', 1, 2350.00, 2350.00, 1),
('iworld01', '24', '10042', 2, 7500.00, 15000.00, 1),
('iworld01', '24', '10043', 1, 8500.00, 8500.00, 1),
('iworld01', '24', '10044', 1, 4500.00, 4500.00, 1),
('iworld01', '24', '10045', 2, 3000.00, 6000.00, 1),
('iworld01', '25', '10046', 1, 2350.00, 2350.00, 1),
('iworld01', '25', '10047', 1, 2350.00, 2350.00, 1),
('iworld01', '25', '10048', 1, 2350.00, 2350.00, 1),
('iworld01', '25', '10041', 1, 2350.00, 2350.00, 1),
('iworld01', '25', '10049', 1, 8500.00, 8500.00, 1),
('iworld01', '26', '10050', 1, 12500.00, 12500.00, 1),
('iworld01', '26', '10051', 1, 3000.00, 3000.00, 1),
('iworld01', '27', '10041', 1, 2350.00, 2350.00, 1),
('iworld01', '27', '10052', 1, 2250.00, 2250.00, 1),
('iworld01', '27', '10053', 1, 13000.00, 13000.00, 1),
('iworld01', '27', '10054', 1, 12500.00, 12500.00, 1),
('iworld01', '27', '10054', 1, 12500.00, 12500.00, 1),
('iworld01', '28', '10037', 1, 750.00, 750.00, 1),
('iworld01', '28', '10036', 1, 500.00, 500.00, 1),
('iworld01', '28', '10038', 1, 750.00, 750.00, 1),
('iworld01', '28', '10039', 1, 500.00, 500.00, 1),
('iworld01', '29', '10066', 1, 56500.00, 56500.00, 1),
('iworld01', '30', '10069', 2, 750.00, 1500.00, 1),
('iworld01', '30', '10070', 2, 2200.00, 4400.00, 1),
('iworld01', '31', '10071', 4, 4250.00, 17000.00, 1),
('iworld01', '32', '10072', 5, 3950.00, 19750.00, 1),
('iworld01', '33', '10073', 25, 1775.00, 44375.00, 1),
('iworld01', '34', '10074', 1, 155000.00, 155000.00, 1),
('iworld01', '35', '10075', 5, 290.00, 1450.00, 1),
('iworld01', '35', '10076', 1, 2000.00, 2000.00, 1),
('iworld01', '35', '10077', 5, 1350.00, 6750.00, 1),
('iworld01', '36', '10078', 1, 25500.00, 25500.00, 1),
('iworld01', '36', '10079', 2, 20500.00, 41000.00, 1),
('iworld01', '37', '10080', 20, 2000.00, 40000.00, 1),
('iworld01', '37', '10080', 1, 0.00, 0.00, 1),
('iworld01', '37', '10081', 5, 3970.00, 19850.00, 1),
('iworld01', '37', '10082', 2, 1700.00, 3400.00, 1),
('iworld01', '37', '10083', 5, 750.00, 3750.00, 1),
('iworld01', '38', '10084', 12, 4731.00, 56772.00, 1),
('iworld01', '39', '10085', 5, 15222.00, 76110.00, 1),
('iworld01', '40', '10086', 1, 3500.00, 3500.00, 1),
('iworld01', '41', '10087', 10, 380.00, 3800.00, 1),
('iworld01', '41', '10088', 5, 995.00, 4975.00, 1),
('iworld01', '41', '10089', 2, 1250.00, 2500.00, 1),
('iworld01', '42', '10090', 20, 375.00, 7500.00, 1),
('iworld01', '43', '10091', 50, 325.00, 16250.00, 1),
('iworld01', '44', '10094', 1, 127000.00, 127000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purch_head`
--

CREATE TABLE `purch_head` (
  `PurchesNo` int(11) DEFAULT NULL,
  `purchOfficer` varchar(500) DEFAULT NULL,
  `SuplierCode` varchar(50) DEFAULT NULL,
  `InvoiceNo` varchar(50) DEFAULT NULL,
  `purchTot` decimal(10,2) DEFAULT NULL,
  `branchCode` varchar(50) DEFAULT NULL,
  `cansel` int(11) NOT NULL DEFAULT 0,
  `timeSpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purch_head`
--

INSERT INTO `purch_head` (`PurchesNo`, `purchOfficer`, `SuplierCode`, `InvoiceNo`, `purchTot`, `branchCode`, `cansel`, `timeSpan`) VALUES
(11, 'Lahiru', 'ITH01', '6094', '198000.00', 'iworld01', 0, '2024-07-10 09:09:07'),
(12, 'Lahiru', 'TRANS01', '009159', '13100.00', 'iworld01', 0, '2024-07-11 06:38:39'),
(13, 'Lahiru', '3D01', '3D01', '33600.00', 'iworld01', 0, '2024-07-11 06:52:41'),
(14, 'Lahiru', 'LT01', 'CS-21-14927', '4200.00', 'iworld01', 0, '2024-07-12 05:51:41'),
(15, 'Lahiru', 'LT01', 'CS-21-14332', '7000.00', 'iworld01', 0, '2024-07-12 06:09:50'),
(16, 'Lahiru', 'LT01', 'CS-21-14595', '9300.00', 'iworld01', 0, '2024-07-12 08:02:59'),
(17, 'Lahiru', 'BLG01', 'INV17930', '26000.00', 'iworld01', 0, '2024-07-12 10:17:48'),
(18, 'Lahiru', 'NGD01', 'TG0071', '11000.00', 'iworld01', 0, '2024-07-12 10:34:15'),
(19, 'Lahiru', 'TIT01', '1800', '15600.00', 'iworld01', 0, '2024-07-12 10:53:29'),
(20, 'Lahiru', 'ITG01', 'ITG2024-07-00611', '53961.00', 'iworld01', 0, '2024-07-13 08:12:33'),
(21, 'Lahiru', 'EMS01', 'EMS-1026758', '17700.00', 'iworld01', 0, '2024-07-13 09:21:40'),
(22, 'Lahiru', 'KT01', 'KTD/INV200218', '28600.00', 'iworld01', 0, '2024-07-13 10:19:23'),
(23, 'Lahiru', 'KT01', 'KTD/INV100003', '20800.00', 'iworld01', 0, '2024-07-13 10:46:06'),
(24, 'Lahiru', 'EMS01', 'EMS-1026708', '41050.00', 'iworld01', 0, '2024-07-14 08:52:12'),
(25, 'Lahiru', 'EMS01', 'EMS-1026632', '17900.00', 'iworld01', 0, '2024-07-14 09:09:23'),
(26, 'Lahiru', 'EMS01', 'EMS-1026654', '15500.00', 'iworld01', 0, '2024-07-15 03:42:53'),
(27, 'Lahiru', 'EMS01', 'EMS-1026510', '42600.00', 'iworld01', 0, '2024-07-15 04:00:16'),
(28, 'Lahiru', 'SERVICE01', 'iw-01', '2500.00', 'iworld01', 0, '2024-07-15 04:28:39'),
(29, 'Lahiru', 'SHARD01', 'SBAJS1002424', '56500.00', 'iworld01', 0, '2024-08-01 07:24:06'),
(30, 'Lahiru', 'LT01', 'CS-21-15802', '5900.00', 'iworld01', 0, '2024-08-01 07:55:30'),
(31, 'Lahiru', 'LT01', 'CS-21-15806', '17000.00', 'iworld01', 0, '2024-08-01 08:05:02'),
(32, 'Lahiru', 'HEMAX01', 'HM00030774', '19750.00', 'iworld01', 0, '2024-08-01 08:19:49'),
(33, 'Lahiru', 'HEMAX01', 'HM00028118', '44375.00', 'iworld01', 0, '2024-08-01 08:24:41'),
(34, 'Lahiru', 'MRT01', 'MR1480', '155000.00', 'iworld01', 0, '2024-08-01 09:52:13'),
(35, 'Lahiru', 'TRANS01', '009262', '10200.00', 'iworld01', 0, '2024-08-02 06:28:44'),
(36, 'Lahiru', 'SHARD01', 'SBAJS1002224', '66500.00', 'iworld01', 0, '2024-08-02 08:00:37'),
(37, 'Lahiru', 'ABC01', '7068', '67000.00', 'iworld01', 0, '2024-08-02 09:08:21'),
(38, 'Lahiru', 'ITG01', 'ITG2024-07-01346', '56772.00', 'iworld01', 0, '2024-08-04 06:18:14'),
(39, 'Lahiru', 'ITG01', 'ITG2024-08-00222', '76110.00', 'iworld01', 0, '2024-08-06 10:25:04'),
(40, 'Lahiru', 'EMS01', 'EMS-1026847', '3500.00', 'iworld01', 0, '2024-08-06 10:31:37'),
(41, 'Lahiru', 'LT01', 'CS-21-15747', '11275.00', 'iworld01', 0, '2024-08-07 06:22:14'),
(42, 'Lahiru', 'LT01', 'CS-21-16051', '7500.00', 'iworld01', 0, '2024-08-07 06:51:21'),
(43, 'Lahiru', 'LT01', 'CS-21-15757', '16250.00', 'iworld01', 0, '2024-08-07 07:21:26'),
(44, 'Lahiru', 'MRT01', 'MR1502', '127000.00', 'iworld01', 0, '2024-08-13 08:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `retun_items_data`
--

CREATE TABLE `retun_items_data` (
  `branchCode` varchar(100) NOT NULL,
  `returnNo` int(11) NOT NULL,
  `itemCode` varchar(100) NOT NULL,
  `serialNo` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `comeDate` varchar(30) NOT NULL DEFAULT 'N/A',
  `sendDate` varchar(30) NOT NULL DEFAULT 'N/A',
  `recieveDate` varchar(30) NOT NULL DEFAULT 'N/A',
  `issueDate` varchar(30) NOT NULL DEFAULT 'N/A',
  `costPrice` double(10,2) NOT NULL,
  `recievePrice` double(10,2) NOT NULL,
  `custId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `repair` varchar(1000) NOT NULL,
  `new_worrent` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `retun_items_data`
--

INSERT INTO `retun_items_data` (`branchCode`, `returnNo`, `itemCode`, `serialNo`, `description`, `comeDate`, `sendDate`, `recieveDate`, `issueDate`, `costPrice`, `recievePrice`, `custId`, `status`, `repair`, `new_worrent`) VALUES
('iworld01', 4, '10010', 'No Serial', 'warranty', '2024-08-06', '2024-08-06', 'N/A', 'N/A', 0.00, 0.00, 2, 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `serial_no`
--

CREATE TABLE `serial_no` (
  `branchCode` varchar(50) NOT NULL,
  `PurchesNo` int(11) NOT NULL,
  `billNo` int(11) NOT NULL,
  `itemCode` varchar(50) NOT NULL,
  `serialNo` varchar(100) NOT NULL,
  `Warranty` varchar(5) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `comeDate` varchar(30) NOT NULL DEFAULT 'N/A',
  `sendDate` varchar(30) NOT NULL DEFAULT 'N/A',
  `recieveDate` varchar(30) NOT NULL DEFAULT 'N/A',
  `issueDate` varchar(30) NOT NULL DEFAULT 'N/A',
  `custName` varchar(500) NOT NULL DEFAULT 'N/A',
  `custTel` varchar(30) NOT NULL DEFAULT 'N/A',
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `serial_no`
--

INSERT INTO `serial_no` (`branchCode`, `PurchesNo`, `billNo`, `itemCode`, `serialNo`, `Warranty`, `sold`, `comeDate`, `sendDate`, `recieveDate`, `issueDate`, `custName`, `custTel`, `status`) VALUES
('iworld01', 11, 0, '10015', '5CD34078LF', '1y', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 13, 0, '10017', '9559', '3m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 13, 0, '10017', '9795', '3m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 19, 0, '10025', '1000000098BED7', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 19, 0, '10025', '1000000098BDBC', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 20, 0, '10026', 'BC9947189', '2y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 20, 0, '10026', 'BC9947375', '2y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 20, 9, '10026', 'BC9947218', '2y', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 21, 0, '10027', 'EMS006403', '6y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 21, 0, '10028', 'EMS006406', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 21, 0, '10029', 'EMS006407', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 22, 0, '10033', 'OS11132406000672', '3y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 22, 0, '10033', 'OS11132406000713', '3y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 23, 0, '10034', 'OS45082339001460', '3y', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 23, 0, '10034', 'OS45082339001350', '3y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 23, 0, '10034', '1234', '3y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 23, 0, '10034', '12345', '3y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 24, 0, '10040', 'EMS006220', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 24, 0, '10040', 'EMS006219', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 24, 0, '10041', 'EMS006218', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 24, 0, '10042', 'EMS006222', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 24, 0, '10042', 'XCMRD123', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 24, 0, '10045', 'EMS006217', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 24, 0, '10045', 'EMS006216', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 25, 0, '10047', 'EMS007973', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 26, 0, '10050', 'EMS006086', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 27, 0, '10041', 'EMS007507', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 27, 0, '10052', 'EMS007508', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 27, 0, '10053', 'EMS007505', '6m', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 29, 0, '10066', 'KPMM07812', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 32, 0, '10072', '1583D1Y00784', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 32, 0, '10072', '1583D1Y00785', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 32, 0, '10072', '1583D1Y00786', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 32, 0, '10072', '1583D1Y00787', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 32, 0, '10072', '1583D1Y00788', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506038', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506495', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506037', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506060', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506059', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506058', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506057', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506056', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506055', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506054', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506053', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 33, 0, '10073', '1541D1Y506052', '1y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 39, 0, '10085', 'BD3497314', '2y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 39, 0, '10085', 'BD3497156', '2y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 39, 0, '10085', 'BD3497202', '2y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 39, 0, '10085', 'BD3497159', '2y', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 39, 9, '10085', 'BD3497549', '2y', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 40, 0, '10086', 'EMS006696', '6m', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0),
('iworld01', 44, 11, '10094', '5CD351HK1X', '1y', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `branchCode` varchar(50) DEFAULT NULL,
  `itemCode` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`branchCode`, `itemCode`, `qty`) VALUES
('iworld01', '10015', 3),
('iworld01', '10016', 1),
('iworld01', '10012', 10),
('iworld01', '10010', 5),
('iworld01', '10011', 5),
('iworld01', '10017', 2),
('iworld01', '10018', 2),
('iworld01', '10019', 4),
('iworld01', '10014', 10),
('iworld01', '10013', 10),
('iworld01', '10023', 10),
('iworld01', '10022', 2),
('iworld01', '10024', 10),
('iworld01', '10025', 2),
('iworld01', '10026', 2),
('iworld01', '10027', 1),
('iworld01', '10028', 1),
('iworld01', '10029', 1),
('iworld01', '10030', 1),
('iworld01', '10031', 2),
('iworld01', '10032', 20),
('iworld01', '10033', 2),
('iworld01', '10034', 4),
('iworld01', '10040', 2),
('iworld01', '10041', 3),
('iworld01', '10042', 2),
('iworld01', '10043', 1),
('iworld01', '10044', 1),
('iworld01', '10045', 2),
('iworld01', '10046', 1),
('iworld01', '10047', 1),
('iworld01', '10048', 1),
('iworld01', '10049', 1),
('iworld01', '10050', 1),
('iworld01', '10051', 1),
('iworld01', '10052', 1),
('iworld01', '10053', 1),
('iworld01', '10054', 2),
('iworld01', '10037', 1),
('iworld01', '10036', 1),
('iworld01', '10038', 1),
('iworld01', '10039', 1),
('iworld01', '10066', 1),
('iworld01', '10069', 2),
('iworld01', '10070', 2),
('iworld01', '10071', 4),
('iworld01', '10072', 5),
('iworld01', '10073', 25),
('iworld01', '10074', 1),
('iworld01', '10075', 5),
('iworld01', '10076', 1),
('iworld01', '10077', 5),
('iworld01', '10078', 1),
('iworld01', '10079', 2),
('iworld01', '10080', 21),
('iworld01', '10081', 5),
('iworld01', '10082', 2),
('iworld01', '10083', 5),
('iworld01', '10084', 12),
('iworld01', '10085', 4),
('iworld01', '10086', 0),
('iworld01', '10087', 10),
('iworld01', '10088', 5),
('iworld01', '10089', 2),
('iworld01', '10090', 20),
('iworld01', '10091', 50),
('iworld01', '10094', -1);

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `SuplierCode` varchar(100) NOT NULL,
  `SuplierName` varchar(100) NOT NULL,
  `SuplierAd` varchar(500) NOT NULL,
  `SuplierPhone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`SuplierCode`, `SuplierName`, `SuplierAd`, `SuplierPhone`) VALUES
('3D01', '3D Computer', 'No.216/1, Hunnavila, Thanabaddegama, Ethkandura', '075-5554540'),
('ABC01', 'ABC Trade & Investments (Pvt) Ltd', 'No.03, Bandaranayakapura Road, Rajagiriya', '011-5160000'),
('BLG01', 'BLG Technologies', 'No.17A, Frankfort Place, Colombo 04.', '011 - 2555900'),
('EMS01', 'Electromax Solution (Pvt) Ltd', 'No.39/1/9, Fortune Arcade, Colombo 04.', '011-7024356'),
('HEMAX01', 'Hemax Computers', 'No.120, Kandy Road, Kurunegala.', '0372054690'),
('ITG01', 'IT Gallery Computers (Pvt) Ltd', 'No.8B, St. Xavier Road, Ja-Ela.', '011-2228886'),
('ITH01', 'It Hub Distributors ', 'No.52/5, Keabawa Road, Boralasgamuwa', '011-5923711'),
('KT01', 'Kingston Technologies (Pvt) Ltd', 'No.311, Puttalam Road, Kurunegala.', '037-2200870'),
('LT01', 'Latest Technology', 'No.636, Maradana Road, Colombo-10', '0112676769'),
('MRT01', 'MR Technologies', 'No.561/10/B4, Maitreepala Senanayaka Mawatha, 1st Cross, New Town, Anuradhapura', '0782526316'),
('NGD01', 'Nexgen Distributors', 'No.17A, Frankfort Place, Colombo 04.', '011-2555900'),
('SERVICE01', 'InfoWorld Computer Solution', 'No.811, Sawmill Junction, Kaduruwela', '027-2055501'),
('SHARD01', 'Shards Computer (Pvt) Ltd', 'No.315, 1st Floor, Unity Plaza Complex, Colombo 04.', '0112584440'),
('TIT01', 'Trend IT', 'No.111, 1/2, S.D.S. Jayasingha Mawatha, Kohuwala.``', '077-3650691'),
('TRANS01', 'Trans Lankaa', 'No.96/1/1, Consistory Building (Sony Building), Front Street, Colombo 11.', '011 - 2322497'),
('WIFI01', 'WiFi Zone Computer Technologies (Pvt) Ltd', '9B1/488, Maithripala Senanayake MW , Anuradhapura', '025-2227127');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_item`
--

CREATE TABLE `supplier_item` (
  `supplier_code` varchar(100) NOT NULL,
  `item_code` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_data`
--

CREATE TABLE `transfer_data` (
  `TransferBranchCode` varchar(50) DEFAULT NULL,
  `ReceiveBranchCode` varchar(50) DEFAULT NULL,
  `TransferNo` varchar(50) DEFAULT NULL,
  `itemCode` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `checked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_head`
--

CREATE TABLE `transfer_head` (
  `TransferNo` int(11) DEFAULT NULL,
  `TransferOfficer` varchar(50) DEFAULT NULL,
  `TransferBranchCode` varchar(50) DEFAULT NULL,
  `ReceiveBranchCode` varchar(50) NOT NULL,
  `TransferTot` varchar(50) DEFAULT NULL,
  `checked` int(11) NOT NULL DEFAULT 0,
  `timeSpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_type` int(11) NOT NULL DEFAULT 0,
  `statues` int(11) NOT NULL DEFAULT 0,
  `regno` int(11) NOT NULL,
  `fname` varchar(250) NOT NULL DEFAULT 'NA',
  `lid` varchar(50) NOT NULL,
  `pw` varchar(20) NOT NULL DEFAULT '123',
  `wa` varchar(20) NOT NULL DEFAULT 'None',
  `branchCode` varchar(100) NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_type`, `statues`, `regno`, `fname`, `lid`, `pw`, `wa`, `branchCode`) VALUES
(0, 1, 1, 'Dulik Suranga  ', 'Admin', '123', '0740430551', 'N/A'),
(0, 1, 15, 'RP', 'rp', '123', '000', 'N/A'),
(0, 1, 16, 'Nalaka', 'Nalaka', '123', '0775997574', 'N/A'),
(2, 1, 21, 'Hashan', 'Hashan', '123', '0272055501', 'iworld01'),
(3, 1, 22, 'Lahiru', 'Lahiru', '123', '077-5160232', 'iworld01'),
(1, 1, 23, 'Nishantha', 'Nishantha', '123', '077-5160232', 'iworld01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branchCode`);

--
-- Indexes for table `brand_names`
--
ALTER TABLE `brand_names`
  ADD PRIMARY KEY (`brandCode`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catCode`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemCode`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`SuplierCode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`regno`),
  ADD UNIQUE KEY `lid` (`lid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `regno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2020 at 05:45 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unqId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isSuper` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `unqId`, `name`, `email`, `password`, `isSuper`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'b7c7dfbc', 'Quinoid Super-Admin', 'superadmin@demo.com', '$2y$10$VvlMjDr2D6GTOJF0nxLLou8n5sgWrNo5mMoPP/EU4SoTGm8ikvuNO', 1, NULL, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33'),
(2, '63ac0ab4', 'Admin Demo', 'admin@demo.com', '$2y$10$2dZf7GbJfDu1a8VmRNEnYe8IWanz.EuOcZA96pHKLAP8QX8ao74h.', 0, NULL, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_admins`
--

CREATE TABLE `clinic_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unqId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','suspend') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'suspend',
  `hasFirstTimeActivated` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinic_admins`
--

INSERT INTO `clinic_admins` (`id`, `unqId`, `name`, `email`, `password`, `status`, `hasFirstTimeActivated`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '72c81c15', 'Clinic Demo', 'clinic@demo.com', '$2y$10$Lp.6gY.Z0RSJ0PMzhJxiJO17V.kfmamAnDbplyy29IpoboXZ5Zzb6', 'active', 1, NULL, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_inventories`
--

CREATE TABLE `clinic_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unqId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinicId` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `stockQuantity` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_profiles`
--

CREATE TABLE `clinic_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `createdByAdminId` bigint(20) UNSIGNED DEFAULT NULL,
  `clinicAdminId` bigint(20) UNSIGNED NOT NULL,
  `clinicRefNum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinicName` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinicAddress` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondaryEmail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankAcNumber` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankAcHolderName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankCode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bankAddress` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `commissionPercentage` decimal(6,2) NOT NULL DEFAULT '10.00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinic_profiles`
--

INSERT INTO `clinic_profiles` (`id`, `createdByAdminId`, `clinicAdminId`, `clinicRefNum`, `clinicName`, `clinicAddress`, `phoneNumber`, `secondaryEmail`, `bankAcNumber`, `bankAcHolderName`, `bankName`, `bankCode`, `bankAddress`, `commissionPercentage`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'clinic#67b432c3', 'Demo Clinic', 'Test address, Test Street, CA', '9219592195', 'demo_secondary@gmail.com', '12345678', 'Demo Name', 'Demo Bank', 'DEMO000336', 'Demo bank address, Demo Street, CA', '10.00', NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_logs`
--

CREATE TABLE `inventory_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unqId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `refNum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `logEvent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventCode` tinyint(4) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `openingQty` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `closingQty` int(11) NOT NULL,
  `relatedEntryModel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relatedEntryModelId` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_logs`
--

INSERT INTO `inventory_logs` (`id`, `unqId`, `productId`, `refNum`, `logEvent`, `eventCode`, `dateTime`, `openingQty`, `quantity`, `closingQty`, `relatedEntryModel`, `relatedEntryModelId`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '8c980fda', 1, '-', 'Initial Inventory Added', 0, '2020-02-01 00:00:00', 0, 110, 110, 'App\\Models\\Admin\\Product', 1, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33'),
(2, '3ac31f8c', 2, '-', 'Initial Inventory Added', 0, '2020-02-18 07:00:00', 0, 10000, 10000, 'App\\Models\\Admin\\Product', 2, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33'),
(3, '2814de56', 3, '-', 'Initial Inventory Added', 0, '2020-02-18 07:00:00', 0, 10000, 10000, 'App\\Models\\Admin\\Product', 3, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_purchases`
--

CREATE TABLE `inventory_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unqId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdByAdminId` bigint(20) UNSIGNED DEFAULT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `purchaseRefNum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchaseNumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `supplier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transfers`
--

CREATE TABLE `inventory_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unqId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdByAdminId` bigint(20) UNSIGNED DEFAULT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `clinicId` bigint(20) UNSIGNED NOT NULL COMMENT 'clinic, where product to be transferred',
  `transferRefNum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transferNumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `totalPrice` decimal(10,2) NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_05_03_000001_create_customer_columns', 1),
(4, '2019_05_03_000002_create_subscriptions_table', 1),
(5, '2020_02_10_153636_create_admins_table', 1),
(6, '2020_02_10_154025_create_clinic_admins_table', 1),
(7, '2020_02_10_164025_create_clinic_profiles_table', 1),
(8, '2020_02_18_162807_create_products_table', 1),
(9, '2020_02_18_163241_create_product_images_table', 1),
(10, '2020_02_27_135538_create_inventory_purchases_table', 1),
(11, '2020_03_04_143516_create_inventory_transfers_table', 1),
(12, '2020_03_04_143815_create_clinic_inventories_table', 1),
(13, '2020_03_13_055451_create_inventory_logs_table', 1),
(14, '2020_03_17_103037_create_user_addresses_table', 1),
(15, '2020_03_17_103141_create_user_orders_table', 1),
(16, '2020_03_17_103700_create_user_order_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unqId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdByAdminId` bigint(20) UNSIGNED DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `initialStockQuantity` int(11) NOT NULL DEFAULT '0',
  `stockQuantity` int(11) NOT NULL,
  `stockStatus` enum('in_stock','out_of_stock') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_stock',
  `sellingPrice` decimal(6,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `unqId`, `createdByAdminId`, `title`, `slug`, `description`, `remarks`, `dateTime`, `initialStockQuantity`, `stockQuantity`, `stockStatus`, `sellingPrice`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '85b8ff76', 1, 'Demo Face Gel', 'demo-face-gel', 'This is a test description for Face Gel. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.', 'This is a test remark', '2020-02-01 00:00:00', 110, 110, 'in_stock', '499.00', NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33'),
(2, '0555335d', 1, 'Womens Collagen', 'womens-collagen', 'Womens Collagen by Fourseas', NULL, '2020-02-18 07:00:00', 10000, 10000, 'in_stock', '200.00', NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33'),
(3, 'd5df64ce', 1, 'Mens Collagen', 'mens-collagen', 'Mens Collagen by Fourseas', NULL, '2020-02-18 07:00:00', 10000, 10000, 'in_stock', '100.00', NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `originalImagePath` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbImagePath` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `productId`, `originalImagePath`, `thumbImagePath`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '/uploads/products/1584200000-ageless.png', NULL, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33'),
(2, 1, '/uploads/products/1584200000-anti-wrinkle-cream.jpg', NULL, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33'),
(3, 2, '/uploads/products/1584200000-womens-collagen.jpg', NULL, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33'),
(4, 3, '/uploads/products/1584200000-mens-collagen.jpg', NULL, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unqId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unqId`, `name`, `email`, `email_verified_at`, `password`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(1, '6850b97d', 'User Demo', 'user@demo.com', NULL, '$2y$10$bbMuVZgNG2DiCYwfNMKTa.mehfp8pVYyPSPE5oVMR0KKV1pO2bWLq', NULL, NULL, '2020-03-22 23:15:33', '2020-03-22 23:15:33', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipCode` int(11) NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unqId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isWalkinCustomer` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Registered | 1: Walkin',
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `orderRefNum` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `grossTotal` decimal(10,2) NOT NULL,
  `netTotal` decimal(10,2) NOT NULL,
  `customerAddressId` bigint(20) UNSIGNED DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `orderStatus` enum('processing','completed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `paymentStatus` enum('processing','completed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `saleChannel` enum('ecommerce','clinic') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ecommerce',
  `saleClinicId` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_order_products`
--

CREATE TABLE `user_order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userOrderId` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `subTotal` decimal(10,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_unqid_index` (`unqId`);

--
-- Indexes for table `clinic_admins`
--
ALTER TABLE `clinic_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clinic_admins_email_unique` (`email`),
  ADD KEY `clinic_admins_unqid_index` (`unqId`);

--
-- Indexes for table `clinic_inventories`
--
ALTER TABLE `clinic_inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_inventories_unqid_index` (`unqId`),
  ADD KEY `clinic_inventories_clinicid_foreign` (`clinicId`),
  ADD KEY `clinic_inventories_productid_foreign` (`productId`);

--
-- Indexes for table `clinic_profiles`
--
ALTER TABLE `clinic_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clinic_profiles_clinicrefnum_unique` (`clinicRefNum`),
  ADD KEY `clinic_profiles_createdbyadminid_foreign` (`createdByAdminId`),
  ADD KEY `clinic_profiles_clinicadminid_foreign` (`clinicAdminId`);

--
-- Indexes for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_logs_unqid_index` (`unqId`),
  ADD KEY `inventory_logs_productid_foreign` (`productId`);

--
-- Indexes for table `inventory_purchases`
--
ALTER TABLE `inventory_purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_purchases_purchaserefnum_unique` (`purchaseRefNum`),
  ADD KEY `inventory_purchases_unqid_index` (`unqId`),
  ADD KEY `inventory_purchases_createdbyadminid_foreign` (`createdByAdminId`),
  ADD KEY `inventory_purchases_productid_foreign` (`productId`);

--
-- Indexes for table `inventory_transfers`
--
ALTER TABLE `inventory_transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_transfers_transferrefnum_unique` (`transferRefNum`),
  ADD KEY `inventory_transfers_unqid_index` (`unqId`),
  ADD KEY `inventory_transfers_createdbyadminid_foreign` (`createdByAdminId`),
  ADD KEY `inventory_transfers_productid_foreign` (`productId`),
  ADD KEY `inventory_transfers_clinicid_foreign` (`clinicId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_unqid_index` (`unqId`),
  ADD KEY `products_createdbyadminid_foreign` (`createdByAdminId`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_productid_foreign` (`productId`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_unqid_index` (`unqId`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_userid_foreign` (`userId`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_orders_orderrefnum_unique` (`orderRefNum`),
  ADD KEY `user_orders_unqid_index` (`unqId`),
  ADD KEY `user_orders_userid_foreign` (`userId`),
  ADD KEY `user_orders_customeraddressid_foreign` (`customerAddressId`),
  ADD KEY `user_orders_saleclinicid_foreign` (`saleClinicId`);

--
-- Indexes for table `user_order_products`
--
ALTER TABLE `user_order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_order_products_userorderid_foreign` (`userOrderId`),
  ADD KEY `user_order_products_productid_foreign` (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinic_admins`
--
ALTER TABLE `clinic_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clinic_inventories`
--
ALTER TABLE `clinic_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clinic_profiles`
--
ALTER TABLE `clinic_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory_purchases`
--
ALTER TABLE `inventory_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_transfers`
--
ALTER TABLE `inventory_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_order_products`
--
ALTER TABLE `user_order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clinic_inventories`
--
ALTER TABLE `clinic_inventories`
  ADD CONSTRAINT `clinic_inventories_clinicid_foreign` FOREIGN KEY (`clinicId`) REFERENCES `clinic_admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clinic_inventories_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clinic_profiles`
--
ALTER TABLE `clinic_profiles`
  ADD CONSTRAINT `clinic_profiles_clinicadminid_foreign` FOREIGN KEY (`clinicAdminId`) REFERENCES `clinic_admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clinic_profiles_createdbyadminid_foreign` FOREIGN KEY (`createdByAdminId`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD CONSTRAINT `inventory_logs_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_purchases`
--
ALTER TABLE `inventory_purchases`
  ADD CONSTRAINT `inventory_purchases_createdbyadminid_foreign` FOREIGN KEY (`createdByAdminId`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inventory_purchases_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_transfers`
--
ALTER TABLE `inventory_transfers`
  ADD CONSTRAINT `inventory_transfers_clinicid_foreign` FOREIGN KEY (`clinicId`) REFERENCES `clinic_admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_transfers_createdbyadminid_foreign` FOREIGN KEY (`createdByAdminId`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inventory_transfers_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_createdbyadminid_foreign` FOREIGN KEY (`createdByAdminId`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD CONSTRAINT `user_orders_customeraddressid_foreign` FOREIGN KEY (`customerAddressId`) REFERENCES `user_addresses` (`id`),
  ADD CONSTRAINT `user_orders_saleclinicid_foreign` FOREIGN KEY (`saleClinicId`) REFERENCES `clinic_admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_orders_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_order_products`
--
ALTER TABLE `user_order_products`
  ADD CONSTRAINT `user_order_products_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_order_products_userorderid_foreign` FOREIGN KEY (`userOrderId`) REFERENCES `user_orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

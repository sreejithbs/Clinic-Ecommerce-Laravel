-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2020 at 07:41 PM
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
(1, '93ef9426', 'Quinoid Super-Admin', 'superadmin@demo.com', '$2y$10$VUIRuUVGALHNJhZZc7tkzunsVBZ1L34w5X7PR99wTgStRWX7zoHt.', 1, NULL, NULL, '2020-03-14 13:10:48', '2020-03-14 13:10:48'),
(2, 'adcc98c1', 'Admin Demo', 'admin@demo.com', '$2y$10$Cwh2fN3En16UtDE7HB9DTuzW4NX2A13cJoFY1J/z0F4edeid4lywe', 0, NULL, NULL, '2020-03-14 13:10:48', '2020-03-14 13:10:48');

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
(1, 'd2cc20fd', 'Clinic Demo', 'clinic@demo.com', '$2y$10$ZcTkCHXMh6ME9MQufPYdLeUhrBaCH0nW6GwoqWFxWTTBwYkCf2bYG', 'active', 1, NULL, NULL, '2020-03-14 13:10:48', '2020-03-14 13:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_profiles`
--

CREATE TABLE `clinic_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `createdByAdminId` bigint(20) UNSIGNED DEFAULT NULL,
  `clinicAdminId` bigint(20) UNSIGNED DEFAULT NULL,
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
(1, 1, 1, 'clinic_67b432c3', 'Demo Clinic', 'Test address, Test Street, CA', '9219592195', 'demo_secondary@gmail.com', '12345678', 'Demo Name', 'Demo Bank', 'DEMO000336', 'Demo bank address, Demo Street, CA', '10.00', NULL, '2020-03-14 13:10:48', '2020-03-14 13:10:48');

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
(1, '9dcd666d', 1, '-', 'Initial Inventory Added', 0, '2020-03-14 12:47:14', 0, 101, 101, 'App\\Models\\Admin\\Product', 1, NULL, '2020-03-14 13:10:48', '2020-03-14 13:10:48');

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
(3, '2020_02_10_153636_create_admins_table', 1),
(4, '2020_02_10_154025_create_clinic_admins_table', 1),
(5, '2020_02_10_164025_create_clinic_profiles_table', 1),
(6, '2020_02_18_162807_create_products_table', 1),
(7, '2020_02_18_163241_create_product_images_table', 1),
(8, '2020_02_27_135538_create_inventory_purchases_table', 1),
(9, '2020_03_04_143516_create_inventory_transfers_table', 1),
(10, '2020_03_13_055451_create_inventory_logs_table', 1);

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
  `initialStockQuantity` int(11) NOT NULL DEFAULT '0',
  `stockQuantity` int(11) NOT NULL,
  `stockStatus` enum('in_stock','out_of_stock') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_stock',
  `regularPrice` decimal(6,2) NOT NULL,
  `sellingPrice` decimal(6,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `unqId`, `createdByAdminId`, `title`, `slug`, `description`, `remarks`, `initialStockQuantity`, `stockQuantity`, `stockStatus`, `regularPrice`, `sellingPrice`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '97b1d1a0', 1, 'Demo Face Gel', 'demo-face-gel', 'This is a test description for Face Gel', 'No remarks to add', 101, 101, 'in_stock', '599.00', '499.00', NULL, '2020-03-14 13:10:48', '2020-03-14 13:10:48');

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
(1, 1, '/uploads/products/1584209834-ageless-derma-stem-cell-and-peptide-anti-wrinkle-cream-1-280x300.png', NULL, NULL, '2020-03-14 13:10:48', '2020-03-14 13:10:48'),
(2, 1, '/uploads/products/1584209834-orig.jpg', NULL, NULL, '2020-03-14 13:10:48', '2020-03-14 13:10:48');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unqId`, `name`, `email`, `email_verified_at`, `password`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '7a3ab4bd', 'User Demo', 'user@demo.com', NULL, '$2y$10$Oyn9a.CJweFpy6SmAO2RJO5SPf6CoCLeML1rGIUQnXTMcI4OJAwV2', NULL, NULL, '2020-03-14 13:10:48', '2020-03-14 13:10:48');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_unqid_index` (`unqId`);

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
-- AUTO_INCREMENT for table `clinic_profiles`
--
ALTER TABLE `clinic_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_purchases`
--
ALTER TABLE `inventory_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clinic_profiles`
--
ALTER TABLE `clinic_profiles`
  ADD CONSTRAINT `clinic_profiles_clinicadminid_foreign` FOREIGN KEY (`clinicAdminId`) REFERENCES `clinic_admins` (`id`) ON DELETE SET NULL,
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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_createdbyadminid_foreign` FOREIGN KEY (`createdByAdminId`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

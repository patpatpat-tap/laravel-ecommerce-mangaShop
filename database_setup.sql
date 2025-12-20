-- ============================================
-- Laravel Manga Shop - Complete Database Setup
-- Updated: December 2024
-- Database Name: laravel_mangashop
-- ============================================
-- This file contains the complete database schema
-- including all recent updates (QA status, ready_to_ship status)
-- ============================================

-- Step 1: Create Database
DROP DATABASE IF EXISTS `laravel_mangashop`;
CREATE DATABASE `laravel_mangashop` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `laravel_mangashop`;

-- ============================================
-- Step 2: Create All Tables
-- ============================================

-- Users Table
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `password` VARCHAR(255) NOT NULL,
    `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
    `remember_token` VARCHAR(100) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Password Reset Tokens Table
CREATE TABLE `password_reset_tokens` (
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sessions Table
CREATE TABLE `sessions` (
    `id` VARCHAR(255) NOT NULL,
    `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
    `ip_address` VARCHAR(45) NULL DEFAULT NULL,
    `user_agent` TEXT NULL DEFAULT NULL,
    `payload` LONGTEXT NOT NULL,
    `last_activity` INT NOT NULL,
    PRIMARY KEY (`id`),
    KEY `sessions_user_id_index` (`user_id`),
    KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Cache Table
CREATE TABLE `cache` (
    `key` VARCHAR(255) NOT NULL,
    `value` MEDIUMTEXT NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Cache Locks Table
CREATE TABLE `cache_locks` (
    `key` VARCHAR(255) NOT NULL,
    `owner` VARCHAR(255) NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Jobs Table
CREATE TABLE `jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `queue` VARCHAR(255) NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `attempts` TINYINT UNSIGNED NOT NULL,
    `reserved_at` INT UNSIGNED NULL DEFAULT NULL,
    `available_at` INT UNSIGNED NOT NULL,
    `created_at` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Job Batches Table
CREATE TABLE `job_batches` (
    `id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `total_jobs` INT NOT NULL,
    `pending_jobs` INT NOT NULL,
    `failed_jobs` INT NOT NULL,
    `failed_job_ids` LONGTEXT NOT NULL,
    `options` MEDIUMTEXT NULL DEFAULT NULL,
    `cancelled_at` INT NULL DEFAULT NULL,
    `created_at` INT NOT NULL,
    `finished_at` INT NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Failed Jobs Table
CREATE TABLE `failed_jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(255) NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Categories Table
CREATE TABLE `categories` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL DEFAULT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Products Table
CREATE TABLE `products` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` BIGINT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL DEFAULT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `stock` INT NOT NULL DEFAULT 0,
    `image` VARCHAR(255) NULL DEFAULT NULL,
    `author` VARCHAR(255) NULL DEFAULT NULL,
    `publisher` VARCHAR(255) NULL DEFAULT NULL,
    `pages` INT NULL DEFAULT NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `products_slug_unique` (`slug`),
    KEY `products_category_id_foreign` (`category_id`),
    CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Carts Table
CREATE TABLE `carts` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `carts_user_id_foreign` (`user_id`),
    CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Cart Items Table
CREATE TABLE `cart_items` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `cart_id` BIGINT UNSIGNED NOT NULL,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `quantity` INT NOT NULL DEFAULT 1,
    `price` DECIMAL(10, 2) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `cart_items_cart_id_foreign` (`cart_id`),
    KEY `cart_items_product_id_foreign` (`product_id`),
    CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
    CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Orders Table (Updated with ready_to_ship status)
CREATE TABLE `orders` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `order_number` VARCHAR(255) NOT NULL,
    `total_amount` DECIMAL(10, 2) NOT NULL,
    `status` ENUM('pending', 'paid', 'ready_to_ship', 'shipped', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    `shipping_address` VARCHAR(255) NOT NULL,
    `shipping_city` VARCHAR(255) NOT NULL,
    `shipping_state` VARCHAR(255) NULL DEFAULT NULL,
    `shipping_postal_code` VARCHAR(255) NOT NULL,
    `shipping_country` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(255) NULL DEFAULT NULL,
    `notes` TEXT NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `orders_order_number_unique` (`order_number`),
    KEY `orders_user_id_foreign` (`user_id`),
    CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Order Items Table (Updated with QA status)
CREATE TABLE `order_items` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_id` BIGINT UNSIGNED NOT NULL,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `quantity` INT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `subtotal` DECIMAL(10, 2) NOT NULL,
    `qa_status` ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `order_items_order_id_foreign` (`order_id`),
    KEY `order_items_product_id_foreign` (`product_id`),
    CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
    CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Step 3: Insert Admin User
-- ============================================
-- Default Admin Credentials:
-- Email: admin@mangashop.com
-- Password: admin123
-- 
-- IMPORTANT: The password hash below is for 'admin123'
-- If you want to change the password, generate a new hash using:
-- php artisan tinker
-- Then run: Hash::make('your_new_password')
-- ============================================

INSERT INTO `users` (`name`, `email`, `password`, `is_admin`, `email_verified_at`, `created_at`, `updated_at`) 
VALUES 
(
    'Admin User', 
    'admin@mangashop.com', 
    '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy', 
    1, 
    NOW(), 
    NOW(), 
    NOW()
)
ON DUPLICATE KEY UPDATE 
    `name` = VALUES(`name`),
    `is_admin` = VALUES(`is_admin`);

-- ============================================
-- Step 4: Verification Queries
-- ============================================
-- Run these queries to verify your database setup
-- ============================================

-- Check if admin user exists
SELECT id, name, email, is_admin, created_at 
FROM users 
WHERE is_admin = 1;

-- Count all tables
SELECT COUNT(*) as total_tables 
FROM information_schema.tables 
WHERE table_schema = 'laravel_mangashop';

-- List all tables
SHOW TABLES;

-- Check table structures
DESCRIBE users;
DESCRIBE categories;
DESCRIBE products;
DESCRIBE carts;
DESCRIBE cart_items;
DESCRIBE orders;
DESCRIBE order_items;

-- Verify orders table has ready_to_ship status
SHOW COLUMNS FROM orders WHERE Field = 'status';

-- Verify order_items table has qa_status
SHOW COLUMNS FROM order_items WHERE Field = 'qa_status';

-- ============================================
-- Setup Complete!
-- ============================================
-- Next Steps:
-- 1. Update your .env file with:
--    DB_DATABASE=laravel_mangashop
--    DB_USERNAME=your_username
--    DB_PASSWORD=your_password
--
-- 2. Run Laravel migrations (optional, but recommended):
--    php artisan migrate
--    This ensures migrations table is created
--
-- 3. Run seeders to populate initial data:
--    php artisan db:seed
--
-- 4. Login to the admin panel with:
--    Email: admin@mangashop.com
--    Password: admin123
--
-- 5. Create storage link for image uploads:
--    php artisan storage:link
-- ============================================
--
-- Recent Updates Included:
-- ✅ QA Status for order items (pending, approved, rejected)
-- ✅ Ready to Ship status for orders
-- ✅ Complete table structure with all relationships
-- ✅ Admin user setup
-- ✅ Verification queries
-- ============================================

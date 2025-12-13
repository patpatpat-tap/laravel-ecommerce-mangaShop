-- ============================================
-- Laravel Manga Shop - Database Setup SQL
-- ============================================
-- Database Name: laravel_mangashop
-- ============================================

-- Step 1: Create the database (if it doesn't exist)
CREATE DATABASE IF NOT EXISTS `laravel_mangashop` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Step 2: Use the database
USE `laravel_mangashop`;

-- Step 3: Make sure you've run migrations first!
-- Run: php artisan migrate
-- This will create all the necessary tables

-- Step 4: Insert admin user
-- Default credentials:
-- Email: admin@mangashop.com
-- Password: admin123
-- 
-- IMPORTANT: The password hash below is for 'admin123'
-- If you want to change the password, generate a new hash using:
-- php artisan tinker
-- Then run: Hash::make('your_new_password')

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
-- Alternative: Use Laravel Seeder (Recommended)
-- ============================================
-- Instead of running SQL, you can use:
-- php artisan db:seed --class=AdminUserSeeder
-- 
-- This is safer as it uses Laravel's Hash facade
-- ============================================


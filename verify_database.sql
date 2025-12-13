-- ============================================
-- Database Verification Queries
-- Run these to verify your database setup
-- ============================================

USE `laravel_mangashop`;

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


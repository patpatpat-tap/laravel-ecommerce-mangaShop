# 📚 Manga Shop E-Commerce System - Complete Documentation

## 📋 Table of Contents
1. [System Overview](#system-overview)
2. [Quick Start Guide](#quick-start-guide)
3. [Database Structure](#database-structure)
4. [MVC Architecture - Complete Flow](#mvc-architecture---complete-flow)
5. [Key Features](#key-features)
6. [User Roles & Permissions](#user-roles--permissions)
7. [Recent Updates](#recent-updates)
8. [Technical Stack](#technical-stack)

---

## 🎯 System Overview

### What is This System?

A **complete e-commerce platform** for selling manga (Japanese comic books) online. Built with Laravel 11, it provides a full shopping experience from product browsing to order fulfillment with admin management capabilities.

### Core Purpose:
- **Customers** browse, search, add to cart, and purchase manga
- **Administrators** manage products, categories, orders, and users
- **System** handles inventory, orders, and accounts automatically

---

## 🚀 Quick Start Guide

### Prerequisites
- PHP 8.2+
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

### Installation

1. **Clone/Download the project**
2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Edit `.env` with your database credentials

4. **Run migrations:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Create storage link:**
   ```bash
   php artisan storage:link
   ```

6. **Start development server:**
   ```bash
   php artisan serve
   npm run dev
   ```

7. **Access the application:**
   - Landing Page: `http://127.0.0.1:8000/`
   - Admin Dashboard: `http://127.0.0.1:8000/admin/dashboard`
   - Default Admin: Check `database/seeders/AdminUserSeeder.php`

---

## 🗄️ Database Structure

### Tables Overview

#### **users**
- `id`, `name`, `email`, `password`, `is_admin`, `created_at`, `updated_at`
- **Purpose:** User accounts (customers and admins)

#### **categories**
- `id`, `name`, `description`, `created_at`, `updated_at`
- **Purpose:** Product categories (e.g., Shonen, Shojo, Seinen)

#### **products**
- `id`, `name`, `description`, `author`, `publisher`, `price`, `stock`, `image`, `category_id`, `is_active`, `created_at`, `updated_at`
- **Purpose:** Manga products with pricing and inventory

#### **carts**
- `id`, `user_id`, `created_at`, `updated_at`
- **Purpose:** Shopping carts (one per user)

#### **cart_items**
- `id`, `cart_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`
- **Purpose:** Items in shopping carts

#### **orders**
- `id`, `user_id`, `order_number`, `total_amount`, `status`, `shipping_address`, `shipping_city`, `shipping_postal_code`, `shipping_country`, `phone`, `notes`, `created_at`, `updated_at`
- **Status ENUM:** `'pending'`, `'paid'`, `'ready_to_ship'`, `'shipped'`, `'completed'`, `'cancelled'`
- **Purpose:** Customer orders

#### **order_items**
- `id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `qa_status`, `created_at`, `updated_at`
- **QA Status ENUM:** `'pending'`, `'approved'`, `'rejected'`
- **Purpose:** Individual items in orders

### SQL Files Location

All database-related SQL files are in the root directory:
- `database_setup.sql` - Initial database setup
- `mysql_workbench_full_setup.sql` - MySQL Workbench setup
- `verify_database.sql` - Database verification queries

**Migrations Location:** `database/migrations/`
- All schema changes are tracked via Laravel migrations
- Recent migrations:
  - `2025_12_17_035455_add_qa_status_to_order_items_table.php` - Adds QA status to order items
  - `2025_12_17_040545_add_ready_to_ship_status_to_orders_table.php` - Adds "ready_to_ship" status to orders

---

## 🏗️ MVC Architecture - Complete Flow

### The Journey Overview

```
START
  ↓
1. Landing Page (View)
  ↓
2. Register/Login (Controller → Model → View)
  ↓
3. Dashboard (Controller → Model → View)
  ↓
4. Browse Products (Controller → Model → View)
  ↓
5. View Product (Controller → Model → View)
  ↓
6. Add to Cart (Controller → Model → Response)
  ↓
7. View Cart (Controller → Model → View)
  ↓
8. Checkout (Controller → Model → View)
  ↓
9. Place Order (Controller → Model → Model → Model → View)
  ↓
10. Order Confirmation (Controller → Model → View)
  ↓
END
```

### Step-by-Step MVC Flow

#### **Step 1: Landing Page**

**Route:** `GET /` → `HomeController::landing()`

**Flow:**
```
User visits: http://127.0.0.1:8000/
  ↓
Route: GET /
  ↓
Controller: HomeController::landing()
  ↓
View: landing.blade.php
  ↓
User sees landing page
```

**Files:**
- Controller: `app/Http/Controllers/HomeController.php` (Line 11-14)
- View: `resources/views/landing.blade.php`
- Route: `routes/web.php` (Line 14)

**Models Used:** None (static page)

---

#### **Step 2: User Registration**

**Route:** `POST /register` → `RegisterController::register()`

**Flow:**
```
User clicks "Sign Up" button
  ↓
Form submits: POST /register
  ↓
Controller: RegisterController::register()
  ↓
  ├─ Validates input
  ├─ Calls MODEL: User::create()
  │     ↓
  │  MODEL saves to database
  │     ↓
  ├─ Logs user in
  └─ Redirects to dashboard
```

**Files:**
- Controller: `app/Http/Controllers/Auth/RegisterController.php`
- Model: `app/Models/User.php`
- Route: `routes/web.php` (Line 22)

**Models Used:** `User`

---

#### **Step 3: User Login**

**Route:** `POST /login` → `LoginController::login()`

**Flow:**
```
User clicks "Sign In" button
  ↓
Form submits: POST /login
  ↓
Controller: LoginController::login()
  ↓
  ├─ Validates input
  ├─ Calls MODEL: Auth::attempt()
  │     ↓
  │  MODEL checks database for user
  │  MODEL verifies password
  │     ↓
  ├─ If valid: Creates session, redirects to dashboard
  └─ If invalid: Shows error message
```

**Files:**
- Controller: `app/Http/Controllers/Auth/LoginController.php` (Line 20-69)
- Model: `app/Models/User.php`
- Route: `routes/web.php` (Line 26)

**Models Used:** `User`

---

#### **Step 4: Browse Products**

**Route:** `GET /dashboard` → `HomeController::dashboard()`

**Flow:**
```
User visits: http://127.0.0.1:8000/dashboard
  ↓
Route: GET /dashboard
  ↓
Controller: HomeController::dashboard()
  ↓
  ├─ Calls MODEL: Category::all()
  ├─ Calls MODEL: Product::where(...)->get()
  └─ Calls MODEL: Product::withCount('orderItems')
  ↓
Controller passes data to VIEW
  ↓
View: dashboard.blade.php displays products
```

**Files:**
- Controller: `app/Http/Controllers/HomeController.php` (Line 40-194)
- View: `resources/views/dashboard.blade.php`
- Models: `app/Models/Product.php`, `app/Models/Category.php`
- Route: `routes/web.php` (Line 33)

**Models Used:** `Product`, `Category`

---

#### **Step 5: View Product Details**

**Route:** `GET /products/{product}` → `ProductController::show()`

**Flow:**
```
User clicks product card
  ↓
Goes to: /products/20
  ↓
Route: GET /products/{product}
  ↓
Controller: ProductController::show($product)
  ↓
  └─ Calls MODEL: $product->load('category')
        ↓
     MODEL gets product and category from database
  ↓
Controller passes $product to VIEW
  ↓
View: products/show.blade.php displays product details
```

**Files:**
- Controller: `app/Http/Controllers/ProductController.php` (Line 69-73)
- View: `resources/views/products/show.blade.php`
- Model: `app/Models/Product.php`
- Route: `routes/web.php` (Line 36)

**Models Used:** `Product`, `Category`

---

#### **Step 6: Add to Cart**

**Route:** `POST /cart/add/{product}` → `CartController::add()`

**Flow:**
```
User clicks "Add to Cart" button
  ↓
JavaScript sends: POST /cart/add/20
  ↓
Route: POST /cart/add/{product}
  ↓
Controller: CartController::add()
  ↓
  ├─ Validates quantity
  ├─ Calls MODEL: Cart::firstOrCreate()
  ├─ Calls MODEL: CartItem::where(...)->first()
  ├─ If exists: Calls MODEL: CartItem::update()
  └─ If not: Calls MODEL: CartItem::create()
  ↓
Controller returns JSON: { success: true, cart_count: 3 }
  ↓
JavaScript updates cart badge (no page reload!)
```

**Files:**
- Controller: `app/Http/Controllers/CartController.php` (Line 21-66)
- Models: `app/Models/Cart.php`, `app/Models/CartItem.php`
- Route: `routes/web.php` (Line 40)
- JavaScript: `resources/views/dashboard.blade.php` (Line 727-785)

**Models Used:** `Cart`, `CartItem`, `Product`

---

#### **Step 7: View Cart**

**Route:** `GET /cart` → `CartController::index()`

**Flow:**
```
User clicks "Cart" button
  ↓
Goes to: /cart
  ↓
Route: GET /cart
  ↓
Controller: CartController::index()
  ↓
  ├─ Calls MODEL: Cart::firstOrCreate()
  └─ Calls MODEL: $cart->load('items.product')
        ↓
     MODEL gets cart items and products from database
  ↓
Controller passes $cart to VIEW
  ↓
View: cart/index.blade.php displays cart items
```

**Files:**
- Controller: `app/Http/Controllers/CartController.php` (Line 13-19)
- View: `resources/views/cart/index.blade.php`
- Models: `app/Models/Cart.php`, `app/Models/CartItem.php`
- Route: `routes/web.php` (Line 39)

**Models Used:** `Cart`, `CartItem`, `Product`

**Recent Update:** Cart now supports quantity updates via +/- buttons and direct input with real-time AJAX updates.

---

#### **Step 8: Checkout**

**Route:** `GET /checkout` → `OrderController::checkout()`

**Flow:**
```
User clicks "Proceed to Checkout"
  ↓
Goes to: /checkout
  ↓
Route: GET /checkout
  ↓
Controller: OrderController::checkout()
  ↓
  ├─ Calls MODEL: Auth::user()->cart
  └─ Calls MODEL: $item->product->stock
        ↓
     MODEL checks stock for each item
  ↓
Controller passes $cart to VIEW
  ↓
View: orders/checkout.blade.php displays checkout form
```

**Files:**
- Controller: `app/Http/Controllers/OrderController.php` (Line 30-48)
- View: `resources/views/orders/checkout.blade.php`
- Models: `app/Models/Cart.php`, `app/Models/Product.php`
- Route: `routes/web.php` (Line 48)

**Models Used:** `Cart`, `CartItem`, `Product`

---

#### **Step 9: Place Order**

**Route:** `POST /orders` → `OrderController::store()`

**Flow:**
```
User clicks "Place Order" button
  ↓
Form submits: POST /orders
  ↓
Controller: OrderController::store()
  ↓
  ├─ Validates shipping information
  ├─ Calls MODEL: Auth::user()->cart
  ├─ Calls MODEL: Order::generateOrderNumber()
  ├─ Calls MODEL: Order::create()
  ├─ For each cart item:
  │  ├─ Calls MODEL: OrderItem::create()
  │  └─ Calls MODEL: Product::decrement('stock')
  └─ Calls MODEL: CartItem::delete()
  ↓
Controller redirects to order confirmation
```

**Files:**
- Controller: `app/Http/Controllers/OrderController.php` (Line 50-104)
- Models: `app/Models/Order.php`, `app/Models/OrderItem.php`, `app/Models/Product.php`
- Route: `routes/web.php` (Line 49)

**Models Used:** `Order`, `OrderItem`, `Product`, `Cart`, `CartItem`

---

#### **Step 10: View Orders**

**Route:** `GET /orders` → `OrderController::index()`
**Route:** `GET /orders/{order}` → `OrderController::show()`

**Flow:**
```
User visits: /orders
  ↓
Route: GET /orders
  ↓
Controller: OrderController::index()
  ↓
  └─ Calls MODEL: Auth::user()->orders()
        ↓
     MODEL gets user's orders from database
  ↓
View: orders/index.blade.php displays order list
```

**Files:**
- Controller: `app/Http/Controllers/OrderController.php` (Line 13-28)
- Views: `resources/views/orders/index.blade.php`, `resources/views/orders/show.blade.php`
- Models: `app/Models/Order.php`, `app/Models/User.php`
- Routes: `routes/web.php` (Line 46-47)

**Models Used:** `Order`, `OrderItem`, `Product`, `User`

---

## ✨ Key Features

### 1. **Shopping Cart System**
- One cart per user (auto-created)
- Real-time quantity updates via AJAX
- +/- buttons and direct input for quantity changes
- Stock validation
- Price locked at add time
- Automatic total calculation

### 2. **Order Management**
- Unique order numbers (ORD-{unique_id})
- Order status workflow: Pending → Paid → Ready to Ship → Shipped → Completed
- QA Status for order items: Pending → Approved/Rejected
- Stock automatically decremented on order placement
- Order history for customers

### 3. **Product Management**
- Image upload support (stored in `storage/app/public/images/products/`)
- Category organization
- Stock tracking
- Active/Inactive status
- Search and filter capabilities

### 4. **Admin Dashboard**
- KPI statistics (total orders, revenue, users, products)
- Recent orders table
- Product CRUD operations
- Category management
- Order status updates
- User management
- QA status management for order items

### 5. **Authentication & Authorization**
- User registration and login
- Session-based authentication
- Admin middleware protection
- 403 error page for unauthorized access
- Role-based access control

### 6. **User Interface**
- Modern, responsive design
- Gold/Red/Beige color scheme
- Glassmorphism modals
- Smooth animations and transitions
- AJAX-powered updates (no page reloads)
- Mobile-friendly layout

---

## 👥 User Roles & Permissions

### **1. Guest (Not Logged In)**
- ✅ View landing page and shop
- ❌ Cannot add to cart or place orders
- ✅ Can sign up or sign in

### **2. Customer (Logged In)**
- ✅ Browse and search products
- ✅ Add to cart
- ✅ Update cart quantities
- ✅ Place orders
- ✅ View own orders
- ❌ Cannot access admin panel

### **3. Administrator**
- ✅ All customer features
- ✅ Manage products (CRUD)
- ✅ Manage categories (CRUD)
- ✅ View all orders
- ✅ Update order status
- ✅ Update QA status for order items
- ✅ View all users
- ✅ Access admin dashboard

---

## 🔄 Recent Updates

### 1. **Cart Quantity Updates** (Latest)
- Added +/- buttons for quantity control
- Direct input field for quantity
- Real-time AJAX updates
- Automatic price recalculation
- Stock limit validation
- Visual feedback during updates

**Files Modified:**
- `resources/views/cart/index.blade.php` - Added quantity controls and JavaScript
- `app/Http/Controllers/CartController.php` - Already had update method

### 2. **QA Status System**
- Added QA status dropdown for order items (admin only)
- Status options: Pending, Approved, Rejected
- Color-coded badges and dropdown
- Real-time AJAX updates
- Visual feedback messages

**Files Modified:**
- `resources/views/orders/show.blade.php` - Added QA status UI and styling
- `app/Http/Controllers/OrderController.php` - Added `updateQAStatus()` method
- `database/migrations/2025_12_17_035455_add_qa_status_to_order_items_table.php` - Database migration

### 3. **Ready to Ship Status**
- Added "Ready to Ship" status to order workflow
- Available in admin orders page filter and status dropdown
- Purple color scheme for visual distinction

**Files Modified:**
- `resources/views/admin/orders/index.blade.php` - Added status option
- `app/Http/Controllers/OrderController.php` - Updated validation
- `database/migrations/2025_12_17_040545_add_ready_to_ship_status_to_orders_table.php` - Database migration

### 4. **Order Items Count Fix**
- Fixed "Items" column to show total quantity instead of unique product count
- Changed from `count()` to `sum('quantity')`

**Files Modified:**
- `resources/views/admin/orders/index.blade.php` - Fixed item count calculation

### 5. **Image Upload System**
- Changed from URL input to file upload
- Images stored in `storage/app/public/images/products/`
- Preview of current image in edit form
- Automatic old image deletion on update

**Files Modified:**
- `resources/views/admin/products/create.blade.php` - File upload input
- `resources/views/admin/products/edit.blade.php` - File upload with preview
- `app/Http/Controllers/ProductController.php` - Upload handling logic

---

## 🛠️ Technical Stack

### Backend
- **Framework:** Laravel 11
- **Language:** PHP 8.2+
- **Database:** MySQL/PostgreSQL
- **ORM:** Eloquent

### Frontend
- **Templating:** Blade Templates
- **CSS:** Tailwind CSS + Custom CSS
- **JavaScript:** Vanilla JS (AJAX)
- **Icons:** Font Awesome

### Key Laravel Features Used
- **Migrations:** Database schema versioning
- **Seeders:** Initial data population
- **Middleware:** Authentication & Authorization
- **Eloquent Relationships:** One-to-Many, Many-to-One
- **Accessors:** Computed properties (e.g., `totalPrice`, `subtotal`)
- **Soft Deletes:** For products and categories
- **File Storage:** Laravel Storage facade

---

## 📁 File Structure Quick Reference

### Models
- `app/Models/User.php` - User accounts
- `app/Models/Product.php` - Products
- `app/Models/Category.php` - Categories
- `app/Models/Cart.php` - Shopping carts
- `app/Models/CartItem.php` - Cart items
- `app/Models/Order.php` - Orders
- `app/Models/OrderItem.php` - Order items

### Controllers
- `app/Http/Controllers/HomeController.php` - Landing, dashboard, shop
- `app/Http/Controllers/Auth/LoginController.php` - Authentication
- `app/Http/Controllers/Auth/RegisterController.php` - Registration
- `app/Http/Controllers/ProductController.php` - Product management
- `app/Http/Controllers/CartController.php` - Cart operations
- `app/Http/Controllers/OrderController.php` - Order processing
- `app/Http/Controllers/AdminController.php` - Admin dashboard
- `app/Http/Controllers/CategoryController.php` - Category management

### Views
- `resources/views/landing.blade.php` - Landing page
- `resources/views/dashboard.blade.php` - Customer dashboard
- `resources/views/products/show.blade.php` - Product details
- `resources/views/cart/index.blade.php` - Shopping cart
- `resources/views/orders/checkout.blade.php` - Checkout form
- `resources/views/orders/index.blade.php` - Order list
- `resources/views/orders/show.blade.php` - Order details
- `resources/views/admin/` - Admin panel views
- `resources/views/layouts/app.blade.php` - Main layout
- `resources/views/layouts/admin.blade.php` - Admin layout

### Routes
- `routes/web.php` - All web routes

### Middleware
- `app/Http/Middleware/EnsureUserIsAdmin.php` - Admin authorization

### Migrations
- `database/migrations/` - All database schema changes

### Seeders
- `database/seeders/AdminUserSeeder.php` - Creates admin user
- `database/seeders/CategorySeeder.php` - Creates categories
- `database/seeders/MangaSeeder.php` - Creates sample products

---

## 🔐 Security Features

1. **Authentication:** Laravel's built-in authentication system
2. **Authorization:** Middleware-based role checking
3. **CSRF Protection:** All forms include CSRF tokens
4. **Password Hashing:** Bcrypt password hashing
5. **Input Validation:** All user inputs are validated
6. **SQL Injection Protection:** Eloquent ORM prevents SQL injection
7. **XSS Protection:** Blade templating escapes output by default

---

## 📝 Notes

- **Database Migrations:** Always run migrations in order. Use `php artisan migrate` to apply all pending migrations.
- **Storage Link:** After deployment, run `php artisan storage:link` to make uploaded images accessible.
- **Environment:** Never commit `.env` file. Use `.env.example` as a template.
- **Admin Access:** Default admin credentials are in `database/seeders/AdminUserSeeder.php`. Change after first login.

---

## ✅ System Status

### All Features Complete:
- ✅ User registration/login
- ✅ Product browsing/search
- ✅ Shopping cart with quantity updates
- ✅ Order placement
- ✅ Order tracking
- ✅ Admin dashboard
- ✅ Product management
- ✅ Category management
- ✅ Order management
- ✅ User management
- ✅ Stock management
- ✅ QA status system
- ✅ Image upload system
- ✅ Authentication/Authorization

**Status:** ✅ **Complete & Production-Ready**

---

*Last Updated: December 2024*


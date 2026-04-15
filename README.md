# Veloria - Fashion & Lifestyle E-Commerce Platform

A fully functional e-commerce platform built with Laravel 10, designed for fashion and lifestyle products. Inspired by Amazon and Flipkart with a modern, responsive UI.

## Tech Stack

- **Backend:** Laravel 10 (PHP 8.1+)
- **Frontend:** Bootstrap 5, SCSS, Bootstrap Icons
- **Database:** MySQL
- **Build Tool:** Vite
- **Auth:** Custom authentication with role-based access control

## Features

### Authentication & Authorization
- Custom login/register with strong password policies (mixed case, numbers, symbols)
- Role-based access: **Admin** and **User** roles
- Rate-limited login (5 attempts per minute per email+IP)
- Session regeneration on login/logout (session fixation protection)
- Account deactivation support
- CSRF protection on all forms
- Password breach detection (Have I Been Pwned integration via Laravel)

### User Side (Customer)
- Responsive storefront with product browsing
- Search bar, categories, featured products, new arrivals
- Wishlist and cart (session-based)
- User account management (orders, addresses, profile)

### Admin Panel
- Dashboard with revenue, orders, products, and customer stats
- Sidebar navigation for all admin modules
- Product, category, order, coupon, and review management
- Quick actions and alerts

### Database Schema (10 tables)
- `users` - with role, phone, avatar, is_active
- `categories` - hierarchical (parent/child), sortable
- `products` - with images (JSON), variants, SKU, featured flag
- `product_variants` - size, color, price modifier, stock
- `orders` - full lifecycle (pending/processing/shipped/delivered/cancelled)
- `order_items` - linked to products and variants
- `addresses` - billing & shipping with default flag
- `coupons` - percentage/flat, min order, expiry, usage limits
- `payments` - provider, transaction ID, status tracking
- `reviews` - star rating (1-5), moderation (approved flag)
- `wishlists` - user-product favorites

## Project Structure

```
app/
  Http/
    Controllers/
      Auth/           # Login, Register controllers
      Admin/          # Admin dashboard & management
      Frontend/       # Public storefront pages
    Middleware/
      AdminMiddleware.php       # Admin role guard
      UserMiddleware.php        # Authenticated user guard
      ActiveUserMiddleware.php  # Account active check
  Models/               # Eloquent models with relationships

routes/
  web.php              # Public & user routes
  admin.php            # Admin routes (prefix: /admin, middleware: auth+admin)

resources/views/
  layouts/
    app.blade.php      # User/storefront master layout (navbar, footer)
    admin.blade.php    # Admin master layout (sidebar, topbar)
    auth.blade.php     # Auth pages layout (centered card)
  auth/                # Login, register views
  admin/               # Admin panel views
  frontend/            # Storefront views
```

## Setup Instructions

### 1. Clone & Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database settings:
```
DB_DATABASE=veloria
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Run Migrations & Seed
```bash
php artisan migrate --seed
```

### 4. Build Assets & Start Server
```bash
npm run dev          # Development (with hot reload)
npm run build        # Production build
php artisan serve    # Start at http://localhost:8000
```

## Default Accounts

| Role  | Email              | Password   |
|-------|--------------------|------------|
| Admin | admin@veloria.com  | Admin@123  |
| User  | user@veloria.com   | User@123   |

## Routes Overview

| URL                | Role   | Description           |
|--------------------|--------|-----------------------|
| `/`                | Public | Home page             |
| `/login`           | Guest  | Login page            |
| `/register`        | Guest  | Registration page     |
| `/logout`          | Auth   | Logout (POST)         |
| `/admin/dashboard` | Admin  | Admin dashboard       |

## Security Features

- CSRF token on all forms
- Password hashing (bcrypt via Laravel)
- Strong password validation (8+ chars, mixed case, numbers, symbols, breach check)
- Login rate limiting (5 attempts/min)
- Session regeneration on auth state changes
- Role-based middleware guards
- XSS protection (Blade auto-escaping)
- SQL injection protection (Eloquent ORM)
- Account deactivation with forced logout

## License

This project is for educational/portfolio purposes.

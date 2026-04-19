<h1 align="center">VELORIA</h1>
<h3 align="center"><em>"Where every piece tells your story"</em></h3>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white">
  <img src="https://img.shields.io/badge/Stripe-Payment-635BFF?style=for-the-badge&logo=stripe&logoColor=white">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
</p>

<p align="center">
A full-stack fashion & lifestyle e-commerce platform with Admin Panel, Shopping Cart, Wishlist, Stripe Checkout, Order Management, Email Notifications, Dark Mode, and more.
</p>

---

## What is Veloria?

Veloria is a complete e-commerce web application — like Amazon, Flipkart, or Myntra — built from scratch with Laravel. It includes everything needed to run an online fashion store:

- **Admin Panel** — Manage products, categories, orders, customers, coupons, reviews, subscribers, enquiries, and store settings
- **Customer Side** — Browse products, add to cart/wishlist, apply coupons, checkout with Stripe or COD, track orders, write reviews
- **Email Notifications** — Welcome email, order confirmation, order status updates, newsletter subscription, review thank you
- **Interactive Features** — Live search autocomplete, dark mode, image zoom, toast notifications, scroll animations, social sharing, invoice PDF download
- **Fully Responsive** — Works on mobile, tablet, and desktop
- **Security** — CSRF protection, bcrypt hashing, rate limiting, strong password policy, role-based access control

---

## How to Run

### Prerequisites

- PHP 8.1+ | Composer | Node.js 16+ | MySQL | Git

### Setup (5 minutes)

```bash
# Clone
git clone https://github.com/aartisharma0/veloria.git
cd veloria

# Install
composer install
npm install

# Configure
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database:

```
DB_DATABASE=veloria
DB_USERNAME=root
DB_PASSWORD=your_password
```

```bash
# Database + sample data
php artisan migrate --seed
php artisan storage:link

# Build + Run
npm run build
php artisan serve
```

Open **http://localhost:8000**

### Login Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@veloria.com | Admin@123 |
| User | user@veloria.com | User@123 |

### Test Coupon Codes

| Code | Discount |
|------|----------|
| WELCOME20 | 20% off (min Rs.500) |
| VELORIA10 | 10% off (min Rs.999) |
| FLAT200 | Rs.200 off (min Rs.1499) |

### Stripe Test Card

`4242 4242 4242 4242` | Expiry: any future date | CVC: any 3 digits

---

## Tech Stack

Laravel 10 | Bootstrap 5 | MySQL | Stripe | Vite | SCSS | jQuery | Select2

---

## Connect With Me

**Built by Aarti Sharma**

| | |
|---|---|
| **Portfolio** | [aartisharma-portfolio.netlify.app](https://aartisharma-portfolio.netlify.app/) |
| **GitHub** | [github.com/aartisharma0](https://github.com/aartisharma0) |

---

## Support

If you found this project useful:

- **Star** this repo
- **Fork** it and build on top of it
- **Share** it with fellow developers

---

<p align="center">
  <strong>VELORIA</strong> — <em>"Where every piece tells your story"</em><br>
  Made with &#10084; by <a href="https://aartisharma-portfolio.netlify.app/">Aarti Sharma</a>
</p>

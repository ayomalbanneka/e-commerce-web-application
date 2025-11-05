![PHP](https://img.shields.io/badge/PHP-8.x-777bb4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2F8.0-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white)
![Status](https://img.shields.io/badge/Project-Active-green)
![License](https://img.shields.io/badge/license-UNLICENSED-lightgrey)

# UrbanElegance E‑Commerce Web Application

UrbanElegance is a modern, feature‑rich e‑commerce web application for fashion retail. It delivers a smooth shopping experience for customers and a powerful administration suite for managing products, users, and orders.

> TL;DR: PHP + MySQL storefront with cart, watchlist, checkout, invoices, admin panel, and Google/Facebook login.

---

## Table of Contents

- Overview
- Features
- Tech Stack & Architecture
- Quick Start (Windows + XAMPP)
- Environment Variables
- Database Overview
- Key Pages
- Screenshots
- Admin Access
- Security & Production Notes
- Deployment
- Troubleshooting
- Roadmap
- Contributing
- Credits

## Features

- Authentication: user sign‑up/sign‑in, remember‑me cookies, email verification, password reset, and OAuth (Google & Facebook)
- Product catalog: categories, sub‑categories, brands, sizes, colors, collections, images, and search (basic + advanced + price filters)
- Shopping: cart, watchlist, quantity controls, buy‑now, checkout, invoices (PDF/print)
- Orders: order history, status changes, invoice lookup and download
- Admin panel: product CRUD, media uploads, status toggles, category/brand/material/size/color management, admin user management
- Profile: profile data, address book (district/city), profile image upload
- Comms: contact form emails via PHPMailer
- UX: responsive Bootstrap UI, SweetAlert2 dialogs

## Tech Stack & Architecture

- Frontend: HTML5, CSS3, Bootstrap, JavaScript, SweetAlert2
- Backend: PHP 8.x (mysqli), MySQL 5.7+/8.0+
- Email: PHPMailer (bundled under `mail/`)
- PDF/Print: jsPDF + html2canvas (via CDN)
- Composer packages (see `composer.json`):
  - `vlucas/phpdotenv` (env management)
  - `facebook/graph-sdk`
  - `google/apiclient`

Architecture at a glance:
- PHP (procedural with light OOP) backed by MySQL
- Single DB layer in `connection.php` with `Database::search($sql)` and `Database::iud($sql)`
- Environment configuration via `.env` (phpdotenv)
- OAuth flows in `sign-in.php` (Facebook/Google SDKs)

## Requirements

- Windows with XAMPP (Apache + MySQL) or any PHP 8.x + MySQL stack
- PHP extensions: mysqli, OpenSSL, mbstring, json, curl
- Composer (for PHP dependencies)

## Quick Start (Windows + XAMPP)

1) Place the project in your web root: `C:\xampp\htdocs\shop` (already in this repo layout)

2) Install Composer dependencies:

```powershell
cd C:\xampp\htdocs\shop
composer install
```

3) Create the database:

- Create a MySQL database named `shop` (default in `connection.php`).
- Import your schema dump if you have one. If not, see Database overview below to create tables manually.

4) Configure environment:

- Copy `.env.example` to `.env` and fill in values (see the Environment variables section).
- Ensure `.env` is not committed to version control.

5) Start services and run:

- Start Apache and MySQL from XAMPP.
- Open http://localhost/shop/home.php

## Environment Variables

This app uses `.env` loaded from project root. Required keys:

- `MYSQL_PWD` — MySQL password for user `root` (or your configured user)
- `G_EMAIL` — SMTP sender email (e.g., Gmail address)
- `G_APP_PASSWORD` — SMTP app password (e.g., Gmail App Password)
- `GOOGLE_CLIENT_ID` — Google OAuth client ID
- `GOOGLE_CLIENT_SECRET` — Google OAuth client secret
- `FACEBOOK_APP_ID` — Facebook App ID
- `FACEBOOK_APP_SECRET` — Facebook App Secret

Notes:
- OAuth redirect/return URIs in code currently point to `http://localhost/shop/home.php`. Configure the same URI in Google & Facebook app settings or adjust the code and `.env` accordingly.

## Database Overview

- Default database name: `shop`.
- Key tables referenced in code (non‑exhaustive):
	- `users`, `admin`, `profile_img`, `users_has_address`, `district`, `city`
	- `products`, `product_img`, `category`, `sub_category`, `category_has_sub_category`
	- `brand`, `sizes`, `color`, `product_collection`
	- Link tables: `products_has_sizes`, `products_has_colors`
	- Commerce: `cart`, `watchlist`, `invoice`
	- Status fields: e.g., `status_status_id` used on `users` and `products`

See `docs/Database.md` for relationships and common fields to create when building the schema manually.

## Key Pages

- Storefront: `home.php`, `product.php`, `product-view.php`, `single-product-view.php`, `cart.php`, `watchlist.php`, `invoice.php`
- Auth: `sign-in.php`, `sign-up.php`, `forgot-password.php` (+ backend processes under `backend/`)
- Admin: `admin-sign-in.php`, `admin-panel.php`, `admin-management.php` (includes admin registration modal)
- Search: `advanced-search.php`, `search-result.php` (+ price sort endpoints)
- Contact: `contact-us.php`

## Admin Access

- Visit `admin-sign-in.php` to sign in as an admin.
- Use `admin-management.php` (post‑login) to register additional admins via the modal.

## Security & Production Notes

- Do NOT commit real secrets. Add `.env` to `.gitignore` and rotate any exposed keys immediately.
- Validate and sanitize all inputs; current code uses direct SQL concatenation. Consider parameterized queries (prepared statements) to mitigate SQL injection.
- Set secure cookies/headers and enable HTTPS in production.
- Lock down file uploads (MIME/type/size checks, storage outside webroot when possible).

## Troubleshooting

- Blank pages / errors: check `vendor/autoload.php` exists (run `composer install`).
- DB connection errors: verify MySQL is running, DB name is `shop`, and `MYSQL_PWD` matches your MySQL user.
- OAuth errors: ensure redirect URIs match `http://localhost/shop/home.php` (or update to your chosen callback).
- Emails not sending: verify `G_EMAIL` and `G_APP_PASSWORD` (Gmail requires App Password with 2FA enabled).

## Credits

- Author: Ayomal Banneka
- Libraries: [PHPMailer](https://github.com/PHPMailer/PHPMailer), [Bootstrap](https://getbootstrap.com/), [SweetAlert2](https://sweetalert2.github.io/), [jsPDF](https://github.com/parallax/jsPDF), [html2canvas](https://html2canvas.hertzen.com/)

—

© 2024–2025 UrbanElegance

---



## Screenshots

> Replace with your own captures as needed.

| Sign in | Sign up | Admin sign-in |
| --- | --- | --- |
| ![Sign in](img/sign-in.jpg) | ![Sign up](img/sign-up.gif) | ![Admin sign-in](img/admin-sign-in.gif) |

| Home carousel | Empty cart | Empty watchlist |
| --- | --- | --- |
| ![Carousel](img/carousel2.png) | ![Empty cart](img/cart_empty.jpg) | ![Watchlist empty](img/watchlist_empty.jpg) |

| Purchase history (empty) | Contact | |
| --- | --- | --- |
| ![Purchase history empty](img/purchase_history_empty.jpg) | ![Contact](img/contact-us.gif) | |

## Contributing

Contributions are welcome. To propose a change:

1. Fork the repo and create a feature branch.
2. Keep changes focused and include clear commit messages.
3. If you change database structure, update `docs/Database.md` and include a migration/SQL snippet in your PR.
4. Open a Pull Request describing the change, rationale, and testing steps.

Coding tips:
- Prefer prepared statements if you touch SQL; avoid string concatenation.
- Keep UI changes responsive and consistent with Bootstrap.
- For new env keys, document them in `.env.example`.

## License

This repository currently has no explicit open-source license. All rights reserved by the author.

If you intend to open-source it, add a `LICENSE` file (e.g., MIT/Apache-2.0) and update the badge above.

## Changelog

Unreleased
- Add comprehensive README with setup, env, DB overview
- Provide `.env.example` and `docs/Database.md`
- Clarify OAuth redirect URIs and security notes

## Roadmap

- Switch SQL access to prepared statements
- Add CSRF protection to forms and strengthen session/cookie flags
- Introduce migration scripts (SQL dump or Phinx/Laravel-Migrations style)
- Add unit/integration test harness (PHPUnit) for core flows
- Dockerized local dev (Apache + PHP-FPM + MySQL)
- Optional payment gateway integration (Stripe/PayPal sandbox)

## FAQ

Q: I see a blank page or class not found errors.
A: Run `composer install`; make sure `vendor/autoload.php` exists. Check PHP errors in your server logs.

Q: OAuth login fails with redirect_mismatch.
A: Set the exact redirect URI (`http://localhost/shop/home.php`) in Google and Facebook app settings or update both code and settings to your chosen URI.

Q: Emails don’t send.
A: Use an app password (e.g., Gmail App Password) and set `G_EMAIL` + `G_APP_PASSWORD` in `.env`. Some hosts block SMTP ports—try 587 with TLS.

Q: Database connection error.
A: Confirm MySQL is running, DB name is `shop`, user/password match `.env` and `connection.php`.

## Deployment

Basic shared/VPS hosting steps:
- PHP 8.x with mysqli, curl, mbstring, json, openssl enabled
- MySQL 5.7/8.0 and a database named `shop` (or update `connection.php`)
- Upload code, run `composer install` on server (or locally and upload `vendor/`)
- Set web root to project folder; ensure `.env` is present and not publicly accessible
- Configure SMTP and OAuth redirect URIs to match your domain (e.g., `https://yourdomain.com/home.php`)
- Enforce HTTPS and secure cookies/headers

## SQL schema import instructions

There is no SQL dump in the repo. To set up the database:

1) Create database

```sql
CREATE DATABASE IF NOT EXISTS shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2) Create tables using `docs/Database.md` as a guide (entities and FKs listed). Optionally export an existing local DB and import on target:

Export (local):
```powershell
mysqldump -u root -p shop > C:\backups\shop.sql
```

Import (target):
```powershell
mysql -u root -p shop < C:\backups\shop.sql
```

3) Create an initial admin via the UI after setup (`admin-sign-in.php` then register in Admin Management), or insert directly into `admin` with a hashed password.
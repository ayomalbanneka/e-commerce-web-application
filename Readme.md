# UrbanElegance E-Commerce Web Application

UrbanElegance is a modern, full-featured e-commerce web application tailored for fashion retail. It supports both user and admin roles, robust product management, a seamless shopping experience, and comprehensive order processing.

## Key Features

- **User Authentication:** Email/password sign up & sign in, Google & Facebook OAuth, password reset, and email verification.
- **Product Catalog:** Browse and search products by category, subcategory, and brand with advanced filtering.
- **Shopping Cart & Watchlist:** Add, update, and move items between cart and watchlist.
- **Order Management:** Streamlined checkout, order history, and PDF invoice generation (download/print).
- **Admin Panel:** Manage products, categories, brands, materials, users, and orders with secure admin authentication.
- **Profile Management:** Edit profile, upload profile images, and manage addresses.
- **Contact & Support:** Contact form with email notifications via PHPMailer.
- **Responsive Design:** Mobile-first UI using Bootstrap.
- **Enhanced Alerts:** Integrated SweetAlert2 for modern dialogs and confirmations.

## Recent Updates

- Improved authentication flow and security.
- Advanced product search and filtering.
- Enhanced cart and watchlist UI/UX.
- PDF invoice download/print with jsPDF & html2canvas.
- Refactored admin panel for better usability.
- Updated PHPMailer configuration for reliable email delivery.
- Bug fixes in checkout and order modules.
- Improved mobile responsiveness and accessibility.

## Tech Stack

- **Frontend:** HTML5, CSS3, Bootstrap, Vanilla JavaScript, SweetAlert2
- **Backend:** PHP (Procedural & OOP), MySQL (custom `Database` class)
- **Email:** PHPMailer (SMTP)
- **PDF:** jsPDF, html2canvas
- **OAuth:** Google & Facebook

## Project Structure

- `index.php`, `home.php` — Landing & home pages
- `sign-in.php`, `sign-up.php`, `forgot-password.php` — User authentication
- `admin-sign-in.php`, `admin-panel.php` — Admin authentication & dashboard
- `add-product.php`, `add-product-process.php` — Product management
- `user-profile.php`, `user-management.php` — User profile & admin management
- `cart.php`, `watchlist.php` — Cart & watchlist
- `checkout-process.php`, `invoice.php` — Orders & invoicing
- `contact-us.php`, `contact-us-process.php` — Contact form & email handler
- `js/script.js` — Main JavaScript logic
- `css/style.css`, `css/admin-panel.css` — Styling
- `mail/PHPMailer.php`, `mail/SMTP.php`, `mail/OAuth.php` — Email libraries

## Setup Guide

1. **Clone the repository** into your web server directory (e.g., `htdocs` for XAMPP).
2. **Create a MySQL database** and import the required tables (SQL not included).
3. **Configure database connection** in `connection.php`.
4. **Set SMTP credentials** in `contact-us-process.php` and related scripts.
5. **Install dependencies** (Bootstrap, SweetAlert2, jsPDF, html2canvas) via CDN or locally.
6. **Start your web server** and access the app in your browser.

## Credits

- Developed by Ayomal Banneka
- Built with [PHPMailer](https://github.com/PHPMailer/PHPMailer), [Bootstrap](https://getbootstrap.com/), [SweetAlert2](https://sweetalert2.github.io/), [jsPDF](https://github.com/parallax/jsPDF), [html2canvas](https://html2canvas.hertzen.com/)

---

&copy; 2024–2025 UrbanElegance. All Rights Reserved.
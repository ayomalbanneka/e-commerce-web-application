# UrbanElegance E-Commerce Web Application

UrbanElegance is a modern, feature-rich e-commerce web application designed for fashion retail. It provides a seamless shopping experience for customers and powerful management tools for administrators.

## Features

- **User Authentication:** Secure registration, login, password reset, email verification, and OAuth (Google & Facebook).
- **Product Catalog:** Browse, search, and filter products by category, subcategory, and brand.
- **Shopping Cart & Watchlist:** Add, update, and move items between cart and watchlist.
- **Order Management:** Easy checkout, order history, and downloadable/printable PDF invoices.
- **Admin Panel:** Manage products, categories, brands, materials, users, and orders.
- **Profile Management:** Edit profile, upload profile images, and manage addresses.
- **Contact & Support:** Contact form with email notifications via PHPMailer.
- **Responsive Design:** Mobile-first layout using Bootstrap.
- **Modern Alerts:** SweetAlert2 for enhanced dialogs and confirmations.

## What's New

- Improved authentication and security.
- Advanced product filtering and search.
- Enhanced cart and watchlist experience.
- PDF invoice generation with jsPDF & html2canvas.
- Refined admin panel UI.
- Updated PHPMailer integration.
- Bug fixes and performance improvements.
- Better mobile responsiveness.

## Technology Stack

- **Frontend:** HTML5, CSS3, Bootstrap, JavaScript, SweetAlert2
- **Backend:** PHP (Procedural & OOP), MySQL
- **Email:** PHPMailer (SMTP)
- **PDF:** jsPDF, html2canvas
- **OAuth:** Google, Facebook

## Project Structure

- `index.php`, `home.php` — Main pages
- `sign-in.php`, `sign-up.php`, `forgot-password.php` — User authentication
- `admin-sign-in.php`, `admin-panel.php` — Admin dashboard
- `add-product.php`, `add-product-process.php` — Product management
- `user-profile.php`, `user-management.php` — User and admin management
- `cart.php`, `watchlist.php` — Cart and watchlist
- `checkout-process.php`, `invoice.php` — Orders and invoices
- `contact-us.php`, `contact-us-process.php` — Contact and email
- `js/script.js` — JavaScript logic
- `css/style.css`, `css/admin-panel.css` — Stylesheets
- `mail/PHPMailer.php`, `mail/SMTP.php`, `mail/OAuth.php` — Email libraries

## Getting Started

1. **Clone the repository** to your web server directory (e.g., `htdocs` for XAMPP).
2. **Create a MySQL database** and import the required tables.
3. **Configure database connection** in `connection.php`.
4. **Set SMTP credentials** in `contact-us-process.php` and related files.
5. **Install dependencies** (Bootstrap, SweetAlert2, jsPDF, html2canvas) via CDN or locally.
6. **Start your web server** and open the app in your browser.

## Credits

- Developed by Ayomal Banneka
- Built with [PHPMailer](https://github.com/PHPMailer/PHPMailer), [Bootstrap](https://getbootstrap.com/), [SweetAlert2](https://sweetalert2.github.io/), [jsPDF](https://github.com/parallax/jsPDF), [html2canvas](https://html2canvas.hertzen.com/)

---

&copy; 2024–2025 UrbanElegance.
# UrbanElegance E-Commerce Web Application

UrbanElegance is a full-featured e-commerce web application designed for a modern fashion store. It supports user and admin roles, product management, shopping cart, order processing, and customer engagement features.

## Features

- **User Authentication:** Sign up, sign in (with email, Google, Facebook), password reset, and email verification.
- **Product Catalog:** Browse products by categories, subcategories, and brands. Advanced and basic search supported.
- **Shopping Cart & Watchlist:** Add products to cart or watchlist, update quantities, and move items between lists.
- **Order Management:** Checkout process, order history, and invoice generation with PDF download and print options.
- **Admin Panel:** Manage products, categories, brands, materials, users, and orders. Admin authentication and password reset.
- **Profile Management:** Update user profile, change profile image, and manage addresses.
- **Contact & Support:** Contact form with email notifications using PHPMailer.
- **Responsive Design:** Optimized for desktop and mobile devices using Bootstrap.

## Technologies Used

- **Frontend:** HTML5, CSS3, Bootstrap, JavaScript (Vanilla JS), SweetAlert2
- **Backend:** PHP (Procedural and OOP), MySQL (via custom `Database` class)
- **Email:** PHPMailer for SMTP email sending
- **PDF Generation:** jsPDF and html2canvas for invoice downloads
- **Authentication:** Google and Facebook OAuth integration

## Project Structure

- `index.php`, `home.php` - Main landing and home pages
- `sign-in.php`, `sign-up.php`, `forgot-password.php` - User authentication pages
- `admin-sign-in.php`, `admin-panel.php` - Admin authentication and dashboard
- `add-product.php`, `add-product-process.php` - Product management
- `user-profile.php`, `user-management.php` - User profile and admin user management
- `cart.php`, `watchlist.php` - Shopping cart and watchlist
- `checkout-process.php`, `invoice.php` - Order processing and invoicing
- `contact-us.php`, `contact-us-process.php` - Contact form and email handler
- `js/script.js` - Main JavaScript logic for UI interactions and AJAX
- `css/style.css`, `css/admin-panel.css` - Styling for user and admin interfaces
- `mail/PHPMailer.php`, `mail/SMTP.php`, `mail/OAuth.php` - Email sending libraries

## Setup Instructions

1. **Clone the repository** and place it in your web server directory (e.g., `htdocs` for XAMPP).
2. **Create a MySQL database** and import the required tables (not included here).
3. **Configure database connection** in `connection.php`.
4. **Set up SMTP credentials** in `contact-us-process.php` and other mail-related scripts.
5. **Install dependencies** (Bootstrap, SweetAlert2, jsPDF, html2canvas) via CDN or locally as needed.
6. **Start your web server** and access the application via your browser.

## Credits

- Designed and developed by Ayomal Banneka
- Uses [PHPMailer](https://github.com/PHPMailer/PHPMailer), [Bootstrap](https://getbootstrap.com/), [SweetAlert2](https://sweetalert2.github.io/), [jsPDF](https://github.com/parallax/jsPDF), [html2canvas](https://html2canvas.hertzen.com/)

---

&copy; 2024 UrbanElegance. All
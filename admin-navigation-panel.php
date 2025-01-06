<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin-panel.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body>

    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="main-title">UrbanElegance</span>
                </a>
            </li>
            <li>
                <a href="admin-panel.php">
                    <span class="icon">
                        <i class="bi bi-house-fill"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="user-management.php">
                    <span class="icon">
                        <i class="bi bi-people-fill"></i>
                    </span>
                    <span class="title">Customers</span>
                </a>
            </li>
            <!-- <li>
                <a href="#">
                    <span class="icon">
                        <i class="bi bi-chat-left-text-fill"></i>
                    </span>
                    <span class="title">Messages</span>
                </a>
            </li> -->
            <li>
                <a href="orders.php">
                    <span class="icon">
                        <i class="bi bi-basket-fill"></i>
                    </span>
                    <span class="title">Orders</span>
                </a>
            </li>
            <li>
                <a href="product.php">
                    <span class="icon">
                        <i class="bi bi-cart"></i>
                    </span>
                    <span class="title">Products</span>
                </a>
            </li>

            <li>
                <a href="add-product.php">
                    <span class="icon">
                        <i class="bi bi-cart-plus-fill"></i>
                    </span>
                    <span class="title">Add Product</span>
                </a>
            </li>

            <!-- <li>
                <a href="add-product.php">
                    <span class="icon">
                        <i class="bi bi-cart4"></i>
                    </span>
                    <span class="title">Update Products</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="#">
                    <span class="icon">
                        <i class="bi bi-question-circle-fill"></i>
                    </span>
                    <span class="title">Help</span>
                </a>
            </li> -->
            <li>
                <a href="#">
                    <span class="icon">
                        <i class="bi bi-gear-wide-connected"></i>
                    </span>
                    <span class="title">Settings</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon">
                        <i class="bi bi-door-open-fill"></i>
                    </span>
                    <span class="title" onclick="adminSignOut();">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Navigation -->

    <!-- <script src="js/admin-panel.js"></script> -->
    <script src="js/script.js"></script>
</body>

</html>
<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | UrbanElegance</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
</head>

<body>

    <?php include "header.php"; ?>

    <?php
    if (isset($_SESSION["u"])) {
        $mail = $_SESSION["u"]["email"];

        $cart_rs = Database::search("SELECT * FROM `cart` 
            INNER JOIN `products` ON cart.cart_products_id = products.id 
            INNER JOIN `color` ON products.color_color_id = color.color_id 
            INNER JOIN `admin` ON products.admin_email = admin.email 
            INNER JOIN `category` ON products.category_cat_id = category.cat_id 
            INNER JOIN `category_has_sub_category` ON products.category_has_sub_category_category_has_sub_category_id = category_has_sub_category.category_has_sub_category_id 
            INNER JOIN `sub_category` ON category_has_sub_category.sub_category_sub_cat_id = sub_category.sub_cat_id 
            WHERE cart_users_email = '$mail'");

        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 0) {
            // Empty Cart View
    ?>

            <section class="h-100 h-custom" style="background-color: #F5EDED;">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12">
                            <div class="card card-cart card-cart-2" style="border-radius: 15px;">
                                <div class="card-body p-0">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 emptyCart"></div>
                                            <div class="col-12 text-center mb-2">
                                                <label class="form-label fs-1 fw-bold">
                                                    You have no items in your Cart yet.
                                                </label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                                <a href="home.php" class="btn btn-outline-dark fs-3 fw-bold">
                                                    Start Shopping
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php
        } else {
            $total = 0;
            $shipping = 0;
        ?>

            <section class="h-100 h-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12">
                            <div class="card card-cart card-cart-2">
                                <div class="card-body p-0">
                                    <div class="row g-0">
                                        <div class="col-lg-8">
                                            <div class="p-5">
                                                <div class="d-flex justify-content-between align-items-center mb-5">
                                                    <h1 class="fw-bold mb-0">Shopping Cart</h1>
                                                    <h6 class="mb-0 text-muted">items <?php echo $cart_num; ?></h6>
                                                </div>
                                                <hr class="my-4">

                                                <?php
                                                for ($x = 0; $x < $cart_num; $x++) {
                                                    $cart_data = $cart_rs->fetch_assoc();
                                                    $total = $total + ($cart_data["price"] * $cart_data["cart_qty"]);

                                                    // Calculate Shipping
                                                    $address_rs = Database::search("SELECT * FROM `users_has_address` 
                                                        INNER JOIN `city` ON users_has_address.city_city_id 
                                                        INNER JOIN `district` ON city.district_district_id = district.district_id 
                                                        WHERE `users_email` = '$mail'");

                                                    $address_data = $address_rs->fetch_assoc();

                                                    $ship = 0;

                                                    if ($address_data["district_id"] == 5) {
                                                        $ship = $cart_data["delivery_fee_colombo"];
                                                        $shipping = $shipping + $ship;
                                                    } else {
                                                        $ship = $cart_data["delivery_fee_other"];
                                                        $shipping = $shipping + $ship;
                                                    }

                                                ?>

                                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                        <div class="col-4 col-md-2">
                                                            <?php
                                                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $cart_data["id"] . "'");
                                                            $image_data = $image_rs->fetch_assoc();
                                                            ?>
                                                            <img src="<?php echo $image_data["img_path"]; ?>" class="img-fluid rounded-3" alt="Product Image">
                                                        </div>
                                                        <div class="col-8 col-md-4">
                                                            <h6 class="text-muted"><?php echo $cart_data["sub_cat_name"]; ?></h6>
                                                            <h6 class="mb-0"><?php echo $cart_data["title"]; ?></h6>
                                                            <h6 class="mt-2 text-secondary">Shipping: Rs.<?php echo $ship; ?>.00</h6>
                                                        </div>
                                                        <div class="col-md-3 col-lg-2 d-flex custom-qty-selector">
                                                            <button class="btn btn-link px-2" onclick="cartQtyMinus(<?php echo $cart_data['id']; ?>);">
                                                                <i class="bi bi-dash"></i>
                                                            </button>
                                                            <input id="qty_cnt" min="0" name="quantity" value="<?php echo $cart_data["cart_qty"]; ?>" type="text" class="form-control text-center form-control-sm" />
                                                            <button class="btn btn-link px-2" onclick="cartQtyPlus(<?php echo $cart_data['id']; ?>,<?php echo $cart_data['qty']; ?>)">
                                                                <i class="bi bi-plus"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-3 col-lg-2 offset-lg-1 custom-price-show">
                                                            <h6 class="mb-0">Rs.<?php echo $cart_data["price"]; ?>.00</h6>
                                                        </div>
                                                        <div class="col-2 col-md-1 text-end">
                                                            <i class="bi bi-trash custom-bin text-danger btn btn-outline-dark trash-icon ms-2" onclick="removeFromCart(<?php echo $cart_data['cart_id'];?>);"></i>
                                                        </div>
                                                    </div>

                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <div class="col-lg-4" style="background-color: #D1E9F6;">
                                            <div class="p-5">
                                                <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                                <hr class="my-4">

                                                <div class="d-flex justify-content-between mb-4">
                                                    <h5 class="text-uppercase">items (<?php echo $cart_num; ?>)</h5>
                                                    <h5>Rs. <?php echo $total; ?>.00</h5>
                                                </div>

                                                <div class="d-flex justify-content-between mb-4">
                                                    <h5 class="text-uppercase mb-3">Shipping</h5>
                                                    <h5>Rs.<?php echo $shipping; ?>.00</h5>
                                                </div>

                                                <hr class="my-4">

                                                <div class="d-flex justify-content-between mb-5">
                                                    <h5 class="text-uppercase">Total price</h5>
                                                    <h5>Rs. <?php echo $total + $shipping; ?>.00</h5>
                                                </div>

                                                <div class="col-6 col-lg-12 col-md-12 mb-3">
                                                    <button class="add-to-cart btn btn-dark btn-block text-uppercase" type="submit" id="payhere-payment" onclick="checkout();"><i style="color: greenyellow;" class="bi bi-cash"></i> checkout</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

    <?php
        }
    } else {
        echo "Please login first";
    }
    ?>

    <?php include "footer.php"; ?>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>

</html>

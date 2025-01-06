<?php

session_start();
include "connection.php";

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard | UrbanElegance</title>
        <link rel="stylesheet" href="css/admin-panel.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
        <link rel="shortcut icon" href="favicon.ico" />
    </head>

    <body>


        <!-- Navigation -->

        <div class="container2">

            <?php include "admin-navigation-panel.php" ?>

            <!-- Navigation -->

            <!-- main -->

            <div class="main">



                <?php include "admin-header.php";

                $today = date("Y-m-d");
                $thisMonth = date("m");
                $thisYear = date("Y");

                $a = "0";
                $b = "0";
                $c = "0";
                $e = "0";
                $f = "0";

                $invoice_rs = Database::search("SELECT * FROM invoice");
                $invoice_num = $invoice_rs->num_rows;

                for ($x = 0; $x < $invoice_num; $x++) {
                    $invoice_data = $invoice_rs->fetch_assoc();

                    $f = $f + $invoice_data['invoice_qty']; // Total qty 

                    $d = $invoice_data['date'];
                    $splitDate = explode(" ", $d); // seperate date from time
                    $pdate = $splitDate[0]; // Sold date

                    if ($pdate == $today) {
                        $a = $a + $invoice_data['total']; // Today income
                        $c = $c + $invoice_data['invoice_qty']; // Today qty
                    }

                    $splitMonth = explode("-", $pdate); // seperate date as year , month and date
                    $pMonth = $splitMonth['1']; // sold month
                    $pYear = $splitMonth['0']; // sold year

                    if ($pYear == $thisYear) {
                        if ($pMonth == $thisMonth) {
                            $b = $b + $invoice_data['total']; // monthly income
                            $e = $e + $invoice_data['invoice_qty']; // monthly qty
                        }
                    }
                }


                ?>

                <header class="admin-header">
                    <?php

                    $data = $_SESSION["au"];

                    ?>

                    <h2 style="margin-left: 20px; margin-top: 10px; margin-bottom: 10px;" class="text-dark typing">
                        <span id="greetings"></span>, <?php echo $data["fname"] . " " . $data["lname"]; ?>
                    </h2>


                    <?php

                    ?>
                </header>

                <!-- Cards -->


                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $e; ?></div>
                            <div class="cardName">Monthly Sales</div>
                        </div>

                        <div class="iconBx">
                            <i class="bi bi-truck" style="color: red;"></i>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $c; ?></div>
                            <div class="cardName">Today Sales</div>
                        </div>

                        <div class="iconBx">
                            <i class="bi bi-cart"></i>
                        </div>
                    </div>
                    <div class="card">
                        <div>

                            <?php
                            $user_rs = Database::search("SELECT * FROM `users`");
                            $user_num = $user_rs->num_rows;
                            ?>

                            <div class="numbers"><?php echo $user_num; ?></div>
                            <div class="cardName">Customers</div>
                        </div>

                        <div class="iconBx">
                            <i class="bi bi-people-fill" style="color: blue;"></i>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <div class="numbers">LKR <?php echo $b; ?>.00 </div>
                            <div class="cardName">Monthly Income</div>
                        </div>

                        <div class="iconBx">
                            <i class="bi bi-cash-stack" style="color: rgb(4, 205, 4);"></i>
                        </div>
                    </div>
                </div>

                <!-- Cards -->

                <!-- Order Details List -->

                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Recent Orders</h2>
                            <!-- <a href="#" class="btn">View All</a> -->
                        </div>

                        <table>

                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Price</td>
                                    <td>Payments</td>
                                    <td>Date</td>
                                    <td>Status</td>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                $recent_orders_rs = Database::search("SELECT * FROM invoice 
                                INNER JOIN products ON invoice.products_id=products.id ORDER BY `date` DESC LIMIT 5");

                                $recent_orders_num = $recent_orders_rs->num_rows;


                                for ($x = 0; $x < $recent_orders_num; $x++) {

                                    $recent_orders_data = $recent_orders_rs->fetch_assoc();
                                    $split_date = explode(" ", $recent_orders_data["date"]);
                                ?>

                                    <tr>
                                        <td><?php echo $recent_orders_data["title"]; ?></td>
                                        <td>RS <?php echo $recent_orders_data["total"] ?>.00</td>
                                        <td>Paid</td>
                                        <td class="text-center"><?php echo $split_date[0]; ?></td>
                                        <td><?php

                                            if ($recent_orders_data["status"] == 0) {

                                            ?>

                                                <span class="confirmOrder">Pending</span>

                                            <?php

                                            } elseif ($recent_orders_data["status"] == 1) {
                                            ?>

                                                <span class="packing">Packing</span>

                                            <?php
                                            } elseif ($recent_orders_data["status"] == 2) {
                                            ?>

                                                <span class="dispatched">Dispatched</span>

                                            <?php
                                            } elseif ($recent_orders_data["status"] == 3) {
                                            ?>

                                                <span class="shipping">Shipping</span>

                                            <?php
                                            } elseif ($recent_orders_data["status"] == 4) {
                                            ?>

                                                <span class="delivered">Confirmed <i class="bi bi-check-circle-fill text-success"></i></span>

                                            <?php
                                            }

                                            ?>
                                        </td>
                                    </tr>

                                <?php
                                }

                                ?>

                                <!-- <tr>
                                    <td>Star Refrigerator</td>
                                    <td>$1200</td>
                                    <td>Paid</td>
                                    <td><span class="status pending">Pending</span></td>
                                </tr>

                                <tr>
                                    <td>Dell Laptop</td>
                                    <td>$1200</td>
                                    <td>Paid</td>
                                    <td><span class="status pending">Pending</span></td>
                                </tr>

                                <tr>
                                    <td>Apple Watch</td>
                                    <td>$1200</td>
                                    <td>Paid</td>
                                    <td><span class="status ConfirmOrder">Return</span></td>
                                </tr>

                                <tr>
                                    <td>Addidas Shoes</td>
                                    <td>$620</td>
                                    <td>Due</td>
                                    <td><span class="status inProgress">In Progress</span></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>

                    <!-- New Customers -->

                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Recent Customers</h2>
                        </div>

                        <table>

                            <?php
                            $customer_rs = Database::search("SELECT * FROM `users`
                            INNER JOIN `users_has_address` ON users_has_address.users_email=users.email
                            INNER JOIN city ON users_has_address.city_city_id=city.city_id
                            ORDER BY joined_date DESC LIMIT 5");

                            $customer_num = $customer_rs->num_rows;

                            for ($x = 0; $x < $customer_num; $x++) {
                                $customer_data = $customer_rs->fetch_assoc();
                            ?>

                                <tr>
                                    <td width="60px">
                                        <div class="imgBx">
                                            <?php
                                            $user_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '" . $customer_data["email"] . "'");
                                            $user_img_num = $user_img_rs->num_rows;

                                            if ($user_img_num > 0) {
                                                $user_img_data = $user_img_rs->fetch_assoc();
                                            ?>
                                                <img src="<?php echo $user_img_data["img_path"]; ?>" alt="">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="img/new_user.svg" alt="">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td>
                                        <h4><?php echo $customer_data["fname"]; ?> <br> <span><?php echo $customer_data["city_name"]; ?></span></h4>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>

                        </table>
                    </div>

                    <!-- New Customers -->
                </div>

                <!-- Order Details List -->
            </div>

            <!-- main -->
        </div>

        <script>
            var myDate = new Date();
            var hrs = myDate.getHours();

            var greet;

            if (hrs < 12)
                greet = 'Good Morning 🌞';
            else if (hrs >= 12 && hrs <= 17)
                greet = 'Good Afternoon ⛅';
            else if (hrs >= 17 && hrs <= 24)
                greet = 'Good Evening 🌛';

            document.getElementById('greetings').innerHTML = greet;
        </script>

        <script src="js/admin-panel.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>

    </html>

<?php
} else {
    header("Location:admin-sign-in.php");
}

?>
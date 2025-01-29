<?php

if (empty($_GET['id'])) {
    header("Location:home.php");
} else {
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice | UrbanEleganceba</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
        <style>
            @font-face {
                font-family: "Caveat";
                src: url("fonts/Caveat-Bold.ttf");
            }

            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }

            .invoice-container {
                max-width: 900px;
                margin: 40px auto;
                background-color: #fff;
                border-radius: 10px;
                padding: 40px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .invoice-header {
                font-family: "Caveat";
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .invoice-header1 {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .invoice-header h2 {
                font-weight: bold;
                color: #000;
            }

            .invoice-header .invoice-info {
                text-align: right;
            }

            .invoice-info {
                margin-bottom: 30px;
            }

            .invoice-info h6 {
                margin-bottom: 5px;
                color: #888;
            }

            .invoice-info p {
                margin: 0;
            }

            .table th,
            .table td {
                vertical-align: middle;
                border-top: none;
                border-bottom: 2px solid #eee;
            }

            .table th {
                background-color: #f9f9f9;
            }

            .summary {
                margin-top: 30px;
                text-align: right;
            }

            .summary p {
                margin: 0;
                line-height: 2;
            }

            .summary h4 {
                font-weight: bold;
                color: #000;
            }

            .footer {
                margin-top: 50px;
                padding-top: 20px;
                border-top: 1px solid #ddd;
                display: flex;
                justify-content: space-between;
            }

            .footer div {
                width: 30%;
            }

            .footer p {
                margin: 0;
                color: #777;
                font-size: 14px;
            }

            .footer-icons {
                text-align: center;
                margin-top: 20px;
                color: #888;
            }
        </style>
    </head>

    <body>

        <div class="mt-2 col-12 btn-toolbar justify-content-end">
            <button class="btn btn-outline-danger me-2" onclick="printInvoice();">
                <i class="bi bi-printer-fill"></i> Print
            </button>

            <button class="btn btn-outline-dark me-2" onclick="downloadInvoice();">
                <i class="bi bi-download"></i> Download
            </button>
        </div>


        <div class="invoice-container" id="page">



            <?php

            session_start();

            include "connection.php";
            // include "header.php";
            if (isset($_SESSION["u"])) {
                # code...

                $mail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` 
                INNER JOIN `users` ON invoice.users_email=users.email 
                INNER JOIN `products` ON invoice.products_id=products.id 
                WHERE `order_id`='" . $oid . "' ");



                $invoice_data = $invoice_rs->fetch_assoc();

                $checkot_cloths = Database::search("SELECT * FROM `invoice` INNER JOIN `products` ON products.id = invoice.products_id  WHERE `order_id` = '" . $oid . "'");
                $subTotal = 0;
                $delivery = 0;


            ?>

                <div class="invoice-header">
                    <div>
                        <h2>UrbanEleganceba</h2>
                    </div>
                    <div class="invoice-info">
                        <p><strong>Invoice Number:</strong> <?php echo $invoice_data["invoice_id"]; ?></p>
                        <p><strong>Invoice Date:</strong> <?php echo $invoice_data["date"]; ?></p>
                    </div>
                </div>

                <div class="row mb-4">

                    <?php

                    $address_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email` = '" . $mail . "'");
                    $address_data = $address_rs->fetch_assoc();


                    ?>

                    <div class="col-md-6">
                        <h6 class="fw-bolder">Invoice To</h6>
                        <p><?php echo $invoice_data["fname"] . " " . $invoice_data["lname"]; ?></p>
                        <p><?php echo $address_data["line1"] . ", " . $address_data["line2"]; ?></p>
                        <p><?php echo $mail; ?></p>
                    </div>
                    <!-- <div class="col-md-6 text-md-end">
                <h6>Bill To</h6>
                <p>Apexo Inc</p>
                <p>billing@apexo.com</p>
                <p>169 Teroghoria, Bangladesh</p>
                <p><strong>Payment Method:</strong> Credit Card</p>
            </div> -->
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            for ($x = 0; $x < $checkot_cloths->num_rows; $x++) {
                                $checkot_cloths_data = $checkot_cloths->fetch_assoc();
                                $subTotal += $checkot_cloths_data["price"] * $checkot_cloths_data["invoice_qty"];

                                $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id` = '" . $address_data["city_city_id"] . "'");
                                $city_data = $city_rs->fetch_assoc();


                                if ($city_data["district_district_id"] == 5) {
                                    $delivery += $checkot_cloths_data["delivery_fee_colombo"];
                                } else {
                                    $delivery += $checkot_cloths_data["delivery_fee_other"];
                                }

                            ?>

                                <tr>
                                    <td><?php echo $checkot_cloths_data["invoice_id"]; ?></td>
                                    <td>
                                        <span class="fw-bold text-dark p-2"><?php echo $checkot_cloths_data["title"]; ?></span><br />
                                        <!-- <span class="fw-bold text-secondary text-decoration-none p-2"><?php echo $oid; ?></span> -->
                                    </td>
                                    <td>Rs.<?php echo $checkot_cloths_data["price"]; ?>.00</td>
                                    <td><?php echo $checkot_cloths_data["invoice_qty"]; ?></td>
                                    <td>Rs.<?php echo $checkot_cloths_data["invoice_qty"] * $checkot_cloths_data["price"]; ?>.00</td>
                                </tr>

                            <?php
                            }

                            ?>


                        </tbody>
                    </table>
                </div>

                <div class="summary">
                    <p><strong>Subtotal:</strong> Rs.<?php echo $subTotal; ?>.00</p>
                    <p><strong>Delivery Fee:</strong> Rs.<?php echo $delivery; ?>.00</p>
                    <hr class="d-flex justify-content-end col-12" />
                    <h5>Grand Total: Rs.<?php echo $subTotal + $delivery; ?>.00</h5>
                </div>



                <div class="footer">
                    <!-- <div>
                <h6>Payment Info</h6>
                <p>Account Name: 00 123 647 840</p>
                <p>Account Number: John Doe</p>
                <p>Branch Name: xyz</p>
            </div> -->
                    <div>
                        <h6>Terms and Conditions</h6>
                        <p>Once order done, money can't refund.</p>
                    </div>
                    <div>
                        <h6>Notes</h6>
                        <p>This is a computer-generated invoice and physical signature...</p>
                    </div>
                </div>

                <div class="footer-icons text-center">
                    <p>
                        <span>&#9742; +94 112 657 7852</span> |
                        <span>&#9993; urbaneleganceofficial@gmail.com</span> |
                        <span>&#127968; No. 123, Galle Road, Colombo 03, Sri Lanka</span>
                    </p>
                </div>
            <?php
            }
            ?>
        </div>


        <div class="mb-5">
            <a class="link icon-link icon-link-hover link-dark text-decoration-none" href="home.php">
                <i class="bi bi-arrow-left"></i> Go Back
            </a>
        </div>



        <script src="js/script.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    </body>

    </html>

<?php
}

?>
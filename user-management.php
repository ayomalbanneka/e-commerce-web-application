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
        <title>Customers Management | UrbanElegance</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="css/admin-panel.css">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
    </head>

    <body>

        <div class="container2">

            <?php include "admin-navigation-panel.php" ?>

            <div class="main">

                <?php include "admin-header.php" ?>

                <div class="container">
                    <h1 class="header">Customers Management</h1>

                    <table class="table align-middle mb-0 bg-white mb-3">
                        <thead>
                            <tr>
                                <th>Customers & Email</th>
                                <th>Mobile Number</th>
                                <th>Status</th>
                                <th>Joined Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <?php

                        $query = "SELECT * FROM `users`";
                        $pageno;

                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        $user_rs = Database::search($query);
                        $user_num = $user_rs->num_rows;

                        $results_per_page = 10;
                        $number_of_pages = ceil($user_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page;
                        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);
                        $selected_num = $selected_rs->num_rows;

                        for ($x = 0; $x < $selected_num; $x++) {

                            $selected_data = $selected_rs->fetch_assoc();

                        ?>

                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php

                                            $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '" . $selected_data["email"] . "'");
                                            $img_num = $img_rs->num_rows;
                                            $img_data = $img_rs->fetch_assoc();

                                            if ($img_num > 0) {
                                            ?>


                                                <img src="<?php echo $img_data["img_path"]; ?>" style="width: 45px; height: 45px"
                                                    class="rounded-circle" />

                                            <?php
                                            } else {
                                            ?>

                                                <img src="img/new_user.svg" style="width: 45px; height: 45px"
                                                    class="rounded-circle" />

                                            <?php
                                            }

                                            ?>
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></p>
                                                <p class="text-muted mb-0"><?php echo $selected_data["email"]; ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>

                                        <?php

                                        $split_mobile = str_split($selected_data["mobile"], 6);

                                        ?>

                                        <p class="fw-normal mb-1"><?php echo "******" . $split_mobile[1]; ?></p>
                                    </td>
                                    <td>

                                        <?php

                                        if ($selected_data["status_status_id"] == 4) {

                                        ?>

                                            <span class="badge rounded-pill text-bg-success">Active</span>

                                        <?php

                                        } else {
                                        ?>

                                            <span class="badge rounded-pill text-bg-warning">Deactive</span>

                                        <?php
                                        }

                                        ?>


                                    </td>

                                    <?php

                                    $split_date = explode(" ", $selected_data["joined_date"]);

                                    ?>

                                    <td><?php echo $split_date[0]; ?></td>
                                    <td>
                                        <?php

                                        if ($selected_data["status_status_id"] == 4) {
                                        ?>

                                            <button class="btn btn-danger btn-sm btn-rounded" onclick="blockUser('<?php echo $selected_data['email'] ?>');">
                                                BLOCK
                                            </button>

                                        <?php
                                        } else {
                                        ?>

                                            <button class="btn btn-warning btn-sm btn-rounded" onclick="blockUser('<?php echo $selected_data['email'] ?>');">
                                                UNBLOCK
                                            </button>

                                        <?php
                                        }

                                        ?>
                                    </td>
                                </tr>

                            </tbody>

                        <?php

                        }


                        ?>


                    </table>

                </div>

                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-lg justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="<?php

                                                            if ($pageno <= 1) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page=" . ($pageno - 1);
                                                            }

                                                            ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <?php

                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                if ($pageno == $x) {
                            ?>

                                    <li class="page-item active">
                                        <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                    </li>

                                <?php
                                } else {
                                ?>

                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                    </li>

                            <?php
                                }
                            }

                            ?>

                            <li class="page-item">
                                <a class="page-link" href="<?php

                                                            if ($pageno >= $number_of_pages) {
                                                                echo "#";
                                                            } else {
                                                                echo "?page=" . ($pageno + 1);
                                                            }

                                                            ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>


            </div>

        </div>

        <script src="js/script.js"></script>
        <script src="js/admin-panel.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>

    </html>

<?php

} else {
    header("Location:admin-sign-in.php");
}

?>
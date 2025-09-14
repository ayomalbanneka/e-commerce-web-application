<?php

session_start();
include "connection.php";


if (isset($_SESSION["au"])) {

    $user = Database::search("SELECT * FROM `admin` WHERE `email`='" . $_SESSION["au"]['email'] . "'");
    $user_datas = $user->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Management | UrbanElegance</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- <link href="css/style.css" rel="stylesheet"> -->
        <link href="css/admin-panel.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
    </head>

    <body>

        <!-- Admin Registration Modal -->
        <div class="modal fade" id="adminRegistrationModal" tabindex="-1" aria-labelledby="adminRegistrationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-center text-white">
                        <h5 class="modal-title" id="adminRegistrationModalLabel">
                            <i class="bi bi-person-plus me-2"></i>Admin Registration
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark"><i class="bi bi-person text-white"></i></span>
                                    <input type="text" class="form-control" id="firstName" placeholder="Enter your first name" required>
                                </div>
                                <h6 class="text-danger small mt-1 d-none" id="fname_err">Enter the firstname</h6>
                            </div>

                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark"><i class="bi bi-person text-white"></i></span>
                                    <input type="text" class="form-control" id="lastName" placeholder="Enter your last name" required>
                                </div>
                                <h6 class="text-danger small mt-1 d-none" id="lname_err">Enter the last name</h6>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark"><i class="bi bi-envelope text-white"></i></span>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                                </div>
                                <h6 class="text-danger small mt-1 d-none" id="email_err">Enter the email</h6>
                            </div>

                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark"><i class="bi bi-envelope text-white"></i></span>
                                    <input type="text" class="form-control" id="mobile" placeholder="Enter your email" required>
                                </div>
                                <h6 class="text-danger small mt-1 d-none" id="mobile_err">Enter the mobile number</h6>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="roled" id="role" class="form-select">
                                    <option value="0">Select a Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Moderator">Moderator</option>
                                </select>
                                <h6 class="text-danger small mt-1 d-none" id="role_err">Select a Roler</h6>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark"><i class="bi bi-lock text-white"></i></span>
                                    <input type="password" class="form-control" id="password" placeholder="Create password" required>
                                </div>
                                <div class="form-text">Must be at least 8 characters</div>
                                <h6 class="text-danger small mt-1 d-none" id="pwd_err">Enter the password</h6>
                            </div>

                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark"><i class="bi bi-lock-fill text-white"></i></span>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
                                </div>
                                <h6 class="text-danger small mt-1 d-none" id="cpwd_err">Entered password isn't matching</h6>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-dark border border-dark btn-sm" onclick="adminRegistration();"><i class="bi bi-person-plus-fill me-2"></i>Register Admin Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container2">

            <?php include "admin-navigation-panel.php" ?>

            <?php
            if ($user_datas["role"] != "Admin") {
            ?>
                <div style="pointer-events: none; opacity: 10.5;" class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> You don't have permission to access Admin Management Page. Please contact the system administrator.
                </div>
            <?php

            }


            ?>


            <div class="main"
                <?php
                if ($user_datas["role"] != "Admin") {
                ?>
                style="pointer-events: none; opacity: 0.5;"
                <?php
                } ?>>


                <?php include "admin-header.php" ?>

                <div class="container">
                    <h1 class="header">Admin Management</h1>

                    <button type="button" class="btn btn-sm btn-outline-dark ms-auto border border-dark" data-bs-toggle="modal" data-bs-target="#adminRegistrationModal">
                        <i class="bi bi-person-plus me-2"></i>Register Admin
                    </button>

                    <table class="table align-middle mb-0 bg-white mb-3">
                        <thead>
                            <tr>
                                <th>Admin & Email</th>
                                <th>Mobile Number</th>
                                <th>Status</th>
                                <th>Joined Date</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <?php

                        $query = "SELECT * FROM `admin`";
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

                            <?php

                            $adminDetail = Database::search("SELECT * FROM `admin` WHERE `email`='" . $selected_data['email'] . "'");
                            $adminDetailData = $adminDetail->fetch_assoc();

                            ?>

                            <!-- Admin Details Updating Modal -->
                            <div class="modal fade" id="adminUpdateModal<?php echo $selected_data['email']; ?>" tabindex="-1" aria-labelledby="adminUpdateModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-center text-white">
                                            <h5 class="modal-title" id="adminUpdateModalLabel">
                                                <i class="bi bi-person-plus me-2"></i>Admin Details Update
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="UfirstName" class="form-label">First Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-dark"><i class="bi bi-person text-white"></i></span>
                                                        <input type="text" class="form-control" id="UfirstName" value="<?php echo $adminDetailData['fname']; ?>" placeholder="Enter your first name" required>
                                                        <h6 class="text-danger small mt-1 d-none" id="Ufname_err">Enter the last name</h6>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="UlastName" class="form-label">Last Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-dark"><i class="bi bi-person text-white"></i></span>
                                                        <input type="text" class="form-control" id="UlastName" value="<?php echo $adminDetailData['lname']; ?>" placeholder=" Enter your last name" required>
                                                    </div>
                                                    <h6 class="text-danger small mt-1 d-none" id="Ulname_err">Enter the last name</h6>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="Uemail" class="form-label">Email Address</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-dark"><i class="bi bi-envelope text-white"></i></span>
                                                        <input type="email" class="form-control" id="Uemail" value="<?php echo $adminDetailData['email']; ?>" placeholder="Enter your email" required>
                                                    </div>
                                                    <h6 class="text-danger small mt-1 d-none" id="Uemail_err">Enter the email</h6>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="Umobile" class="form-label">Mobile Number</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-dark"><i class="bi bi-envelope text-white"></i></span>
                                                        <input type="text" class="form-control" id="Umobile" value="<?php echo $adminDetailData['mobile']; ?>" placeholder="Enter your email" required>
                                                    </div>
                                                    <h6 class="text-danger small mt-1 d-none" id="Umobile_err">Enter the mobile number</h6>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Role</label>
                                                    <select name="roled" id="role" class="form-select" disabled>
                                                        <option value="<?php echo $adminDetailData['role'] ?>"><?php echo $adminDetailData['role']; ?></option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-dark"><i class="bi bi-lock text-white"></i></span>
                                                        <input type="password" class="form-control" value="<?php echo $adminDetailData['password']; ?>" id="password" placeholder="Create password" disabled>
                                                    </div>
                                                    <div class="form-text">Must be at least 8 characters</div>
                                                    <h6 class="text-danger small mt-1 d-none" id="Upwd_err">Enter the password</h6>
                                                </div>

                                                <div class="d-grid gap-2">
                                                    <button type="button" class="btn btn-outline-dark border border-dark btn-sm" onclick="adminDetailsUpdater();"><i class="bi bi-person-plus-fill me-2"></i>Update Admin Details</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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

                                        if ($selected_data["status"] == 'Active') {

                                        ?>

                                            <span class="badge rounded-pill text-bg-success">Active</span>

                                        <?php

                                        }
                                        if ($selected_data["status"] == 'Deactive') {
                                        ?>

                                            <span class="badge rounded-pill text-bg-warning">Deactive</span>

                                        <?php
                                        }

                                        if ($selected_data["status"] == 'Blocked') {
                                        ?>

                                            <span class="badge rounded-pill text-bg-danger">Blocked</span>

                                        <?php
                                        }

                                        ?>


                                    </td>

                                    <?php

                                    $split_date = explode(" ", $selected_data["joined_date"]);

                                    ?>

                                    <td><?php echo $split_date[0]; ?></td>
                                    <td class="text-uppercase"><?php echo $selected_data["role"] ?></td>
                                    <td>
                                        <?php

                                        if ($selected_data["status"] == "Active") {
                                        ?>

                                            <button class="btn btn-outline-warning btn-sm btn-rounded border border-warning" onclick="blockAdmin('<?php echo $selected_data['email'] ?>');">
                                                Deactivate
                                            </button>

                                        <?php
                                        } else if ($selected_data["status"] == "Deactive") {
                                        ?>

                                            <button class="btn btn-outline-danger btn-sm border btn-rounded border border-danger" onclick="blockAdmin('<?php echo $selected_data['email'] ?>');">
                                                Block
                                            </button>

                                        <?php
                                        } elseif ($selected_data["status"] == "Blocked") {
                                        ?>

                                            <button class="btn btn-outline-success btn-sm btn-rounded border border-success" onclick="blockAdmin('<?php echo $selected_data['email'] ?>');">
                                                Unblock
                                            </button>
                                        <?php
                                        }

                                        ?>

                                        <button class="btn btn-outline-dark btn-sm btn-rounded border border-dark" data-bs-toggle="modal" data-bs-target="#adminUpdateModal" onclick="setAdminDetails('<?php echo $selected_data['email']; ?>');">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
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

        <script src="js/admin-panel.js"></script>
        <!-- <script src="js/script.js"></script> -->
        <script src="js/bootstrap.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>

    </html>

<?php

} else {
    header("Location:admin-sign-in.php");
}

?>
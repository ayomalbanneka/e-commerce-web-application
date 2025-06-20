<?php
http_response_code(404); // Set the status code to 404
include "connection.php"

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>404 Page | UrbanElegance</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
</head>

<body>

    <section class="h-100 h-custom" style="background-color:rgb(255, 255, 255);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div>
                        <div class="card-body p-0">
                            <div class="col-12">
                                <div class="row">
                                    <h1 style="font-size: 60px; text-align: center; font-weight: bold;">404</h1>
                                    <div class="col-12 _404gif"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-4 fw-bold">
                                            <p>Sorry, the page you are looking for does not exist.</p>
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                        <a href="home.php" class="btn btn-outline-success fs-4 fw-bold">
                                            Go Home
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

</body>

</html>
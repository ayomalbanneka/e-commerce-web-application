<?php
session_start();
if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Product | UrbanElegance</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="css/admin-panel.css">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>

        <div class="container2">

            <?php include "admin-navigation-panel.php" ?>

            <div class="main">

                <?php include "admin-header.php";
                include "connection.php";
                ?>

                <div class="container">
                    <h1 class="header">Add New Product</h1>
                    <form>
                        <div class="card custom-card-ap">
                            <div class="card-header">General Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="productName">Name Product</label>
                                    <input type="text" id="productName" class="form-control" placeholder="Puffer Jacket With Pocket Detail">
                                </div>
                                <!-- <div class="form-group">
                                <label for="productDescription">Description Product</label>
                                <textarea id="productDescription" class="form-control" rows="4" placeholder="Cropped puffer jacket made of technical fabric. High neck and long sleeves. Flap pocket at the chest and in-seam side pockets at the hip. Inside pocket detail. Hem with elastic interior. Zip-up front."></textarea>
                            </div> -->

                                <form action="add-product-process.php" method="POST">

                                    <div class="form-group">
                                        <label class="form-label">Size</label>
                                        <div class="size-options">

                                            <select class="form-select" id="size">

                                                <option value="0">Select Size</option>



                                                <?php

                                                $size_rs = Database::search("SELECT * FROM `sizes`");
                                                for ($x = 0; $x < $size_rs->num_rows; $x++) {
                                                    $sizes_data = $size_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $sizes_data["sizes_id"]; ?>"><?php echo $sizes_data["size"]; ?></option>

                                                <?php
                                                }

                                                ?>



                                            </select>

                                        </div>
                                    </div>

                                </form>


                                <div class="form-group">
                                    <label class="form-label">Product Collection</label>
                                    <div class="gender-options">

                                        <select class="form-select" id="gender">

                                            <option value="0">Select Collection</option>

                                            <?php

                                            $pg_rs = Database::search("SELECT * FROM `product_collection`");
                                            for ($x = 0; $x < $pg_rs->num_rows; $x++) {
                                                $pg_data = $pg_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $pg_data["id"]; ?>"><?php echo $pg_data["name"]; ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>


                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <div class="card custom-card-ap">
                                    <div class="card-header">Pricing And Stock</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" id="price" class="form-control" placeholder="LKR">
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Stock</label>
                                            <input type="text" id="qty" class="form-control" placeholder="77">
                                        </div>
                                        <div class="form-group">
                                            <label for="dic">Delivery In Colombo</label>
                                            <input type="text" id="dic" class="form-control" placeholder="LKR">
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Delivery Out Of Colombo</label>
                                            <input type="doc" id="doc" class="form-control" placeholder="LKR">
                                        </div>
                                        <!-- <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="text" id="discount" class="form-control" placeholder="10%">
                                    </div> -->
                                        <!-- <div class="form-group">
                                        <label for="discountType">Discount Type</label>
                                        <input type="text" id="discountType" class="form-control" placeholder="Chinese New Year Discount">
                                    </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card custom-card-ap col-md-12">
                                    <div class="card-header">Add Product Images</div>
                                    <div class="card-body">
                                        <div class="offset-lg-3 col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-4 border border-dark rounded">
                                                    <img src="img/addproductimg.svg" class="img-thumbnail" style="width: 250px;" id="i0" />
                                                </div>
                                                <div class="col-4 border border-dark rounded">
                                                    <img src="img/addproductimg.svg" class="img-thumbnail" style="width: 250px;" id="i1" />
                                                </div>
                                                <div class="col-4 border border-dark rounded">
                                                    <img src="img/addproductimg.svg" class="img-thumbnail" style="width: 250px;" id="i2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="file" id="imageUploader" multiple class="d-none">
                                            <label for="imageUploader" class="col-12 btn btn-outline-dark border border-1 border-dark" onclick="changeProductImage();">Upload Images</label>
                                        </div>
                                        <!-- <div id="imgPreview" class="img-preview">
                                        Image preview in here
                                    </div> -->
                                    </div>
                                </div>



                                <div class="card custom-card-ap mt-3">
                                    <div class="card-header">Categories</div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Product Sub category</label>
                                            <select class="form-select text-center" id="sub_category">
                                                <option value="0">Select sub category</option>

                                                <?php

                                                $p_sub_category_rs = Database::search("SELECT * FROM `sub_category`");
                                                $p_sub_category_num = $p_sub_category_rs->num_rows;

                                                for ($x = 0; $x < $p_sub_category_num; $x++) {
                                                    $p_sub_category_data = $p_sub_category_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $p_sub_category_data["sub_cat_id"]; ?>"><?php echo $p_sub_category_data["sub_cat_name"]; ?> </option>

                                                <?php
                                                }

                                                ?>

                                            </select>

                                            <div class="col-12">
                                                <div class="input-group mt-4 mb-2">
                                                    <input type="text" id="sub_cat" class="form-control" placeholder="Add new sub category" />
                                                    <button class="btn btn-dark" type="button" onclick="addSubCategory();">+ Add</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Product Category</label>
                                            <select class="form-select text-center" id="category">
                                                <option value="0">Select Category</option>

                                                <?php

                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>

                                                <?php


                                                }

                                                ?>


                                            </select>

                                            <div class="col-12">
                                                <div class="input-group mt-4 mb-2">
                                                    <input type="text" id="new_cat" class="form-control" placeholder="Add new category" />
                                                    <button class="btn btn-dark" type="button" onclick="addCategory();">+ Add</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Product Brand</label>
                                            <select class="form-select text-center" id="brand">
                                                <option value="">Select Brand</option>

                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand` ");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($x = 0; $x < $brand_num; $x++) {
                                                    $brand_data = $brand_rs->fetch_assoc();

                                                ?>
                                                    <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>
                                                <?php
                                                }

                                                ?>

                                            </select>

                                            <div class="col-12">
                                                <div class="input-group mt-4 mb-2">
                                                    <input type="text" id="new_brd" class="form-control" placeholder="Add new brand" />
                                                    <button class="btn btn-dark" type="button" onclick="addBrand();">+ Add</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Material</label>
                                            <select class="form-select text-center" id="material">
                                                <option value="">Select Material</option>

                                                <?php

                                                $material_rs = Database::search("SELECT * FROM `material` ");
                                                $material_num = $material_rs->num_rows;

                                                for ($x = 0; $x < $material_num; $x++) {
                                                    $material_data = $material_rs->fetch_assoc();

                                                ?>
                                                    <option value="<?php echo $material_data["material_id"]; ?>"><?php echo $material_data["material_name"]; ?></option>
                                                <?php
                                                }

                                                ?>

                                            </select>

                                            <div class="col-12">
                                                <div class="input-group mt-4 mb-2">
                                                    <input type="text" id="new_mtl" class="form-control" placeholder="Add new material" />
                                                    <button class="btn btn-dark" type="button" onclick="addMaterial();">+ Add</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row card-body">
                                        <label class="form-label fw-bold">Product Available Colors</label>

                                        <select class="form-select text-center" id="color">

                                            <option value="0">Select Color</option>

                                            <?php

                                            $color_rs = Database::search("SELECT * FROM `color`");
                                            for ($x = 0; $x < $color_rs->num_rows; $x++) {
                                                $color_data = $color_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $color_data["color_id"]; ?>"><?php echo $color_data["color_name"]; ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>

                                        <div class="col-12">
                                            <div class="input-group mt-2 mb-2">
                                                <input type="text" id="new_clr" class="form-control" placeholder="Add new Colour" />
                                                <button class="btn btn-dark" type="button" onclick="addColor();">+ Add</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                            <a class="btn border border-dark btn-outline-success" onclick="addProducts();">Add Product</a>
                        </div>
                    </form>
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
    echo ("Please login to your account");
}

?>
<?php

session_start();

if (isset($_SESSION["au"])) {
    include "connection.php"

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
    </head>

    <body>

        <div class="container2">

            <?php include "admin-navigation-panel.php" ?>

            <div class="main">

                <?php

                include "admin-header.php";

                // if (isset($_SESSION["au"])) {
                $pid = $_GET["id"];

                $product_rs = Database::search("SELECT * FROM `products`
                INNER JOIN `color` ON products.color_color_id=color.color_id 
                INNER JOIN `admin` ON products.admin_email=admin.email
                INNER JOIN `category` ON products.category_cat_id = category.cat_id 
                INNER JOIN `category_has_sub_category` ON products.category_has_sub_category_category_has_sub_category_id = category_has_sub_category.category_has_sub_category_id 
                INNER JOIN `sub_category` ON category_has_sub_category.sub_category_sub_cat_id = sub_category.sub_cat_id
                INNER JOIN `sizes` ON products.status_status_id=sizes.sizes_id
                INNER JOIN `product_collection` ON product_collection.id=products.product_collection_id
                INNER JOIN `brand` ON products.brand_brand_id=brand.brand_id
                INNER JOIN `material` ON products.material_material_id=material.material_id
                WHERE products.id = '" . $pid . "' ");

                $product_data = $product_rs->fetch_assoc();

                ?>

                <div class="container">
                    <h1 class="header">Update Product</h1>
                    <form>
                        <div class="card custom-card-ap">
                            <div class="card-header">Product Information</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="productName">Name Product</label>
                                    <input type="text" id="productName" class="form-control" value="<?php echo $product_data["title"]; ?>">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Size</label>
                                    <div class="size-options">
                                        <select class="form-select" disabled id="size">
                                            <option><?php echo $product_data["size"]; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Gender</label>
                                    <div class="gender-options">
                                        <select class="form-select" disabled id="gender">
                                            <option><?php echo $product_data["name"]; ?></option>
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
                                            <input type="text" id="price" class="form-control" disabled value="<?php echo $product_data["price"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Stock</label>
                                            <input type="text" id="qty" class="form-control" value="<?php echo $product_data["qty"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="dic">Delivery In Colombo</label>
                                            <input type="text" id="dic" class="form-control" value="<?php echo $product_data["delivery_fee_colombo"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="doc">Delivery Out Of Colombo</label>
                                            <input type="text" id="doc" class="form-control" value="<?php echo $product_data["delivery_fee_other"]; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card custom-card-ap col-md-12">
                                    <div class="card-header">Add Product Images</div>
                                    <div class="card-body">
                                        <div class="offset-lg-3 col-12 col-lg-6">

                                            <?php

                                            $img = array();

                                            $img[0] = "img/addproductimg.svg";
                                            $img[1] = "img/addproductimg.svg";
                                            $img[2] = "img/addproductimg.svg";

                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `products_id` = '" . $pid . "' ");
                                            $img_num = $img_rs->num_rows;

                                            for ($x = 0; $x < $img_num; $x++) {
                                                $img_data = $img_rs->fetch_assoc();
                                                $img[$x] = $img_data["img_path"];
                                            }

                                            ?>

                                            <div class="row">
                                                <div class="col-4 border border-dark rounded">
                                                    <img src="<?php echo $img[0]; ?>" class="img-thumbnail" style="width: 250px;" id="i0" />
                                                </div>
                                                <div class="col-4 border border-dark rounded">
                                                    <img src="<?php echo $img[1]; ?>" class="img-thumbnail" style="width: 250px;" id="i1" />
                                                </div>
                                                <div class="col-4 border border-dark rounded">
                                                    <img src="<?php echo $img[2]; ?>" class="img-thumbnail" style="width: 250px;" id="i2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="file" id="imageUploader" multiple class="d-none">
                                            <label for="imageUploader" class="col-12 btn btn-outline-dark border border-1 border-dark" onclick="changeProductImage();">Upload Images</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card custom-card-ap mt-3">
                                    <div class="card-header">Categories</div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Product Sub category</label>
                                            <select class="form-select text-center" disabled id="sub_category">
                                                <option><?php echo $product_data["sub_cat_name"]; ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Product Category</label>
                                            <select class="form-select text-center" disabled id="category">
                                                <option><?php echo $product_data["cat_name"]; ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Product Brand</label>
                                            <select class="form-select text-center" disabled id="brand">
                                                <option><?php echo $product_data["brand_name"]; ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Material</label>
                                            <select class="form-select text-center" disabled id="material">
                                                <option><?php echo $product_data["material_name"]; ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row card-body">
                                        <label class="form-label fw-bold">Product Available Colors</label>

                                        <select class="form-select text-center" disabled id="color">
                                            <option><?php echo $product_data["color_name"]; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                            <a class="btn border border-dark btn-outline-success" onclick="updateProduct('<?php echo $pid; ?>');">Update Product</a>
                        </div>
                    </form>
                </div>

                <?php



                ?>



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
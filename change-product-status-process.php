<?php  

include "connection.php";

$product_id = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '".$product_id."'");

if($product_rs->num_rows == 1){
    $product_data = $product_rs->fetch_assoc();
    $status = $product_data["status_status_id"];

    if($status == 1){
        Database::iud("UPDATE `products` SET `status_status_id` = '2' WHERE `id` = '".$product_id."' ");
        echo("Deactivate");
    }else if($status == 2){
        Database::iud("UPDATE `products` SET `status_status_id` = '1' WHERE `id` = '".$product_id."' ");
        echo("Activate");
    }

}else{
    echo("Somthing went wrong. Try agian later!");
}

?>
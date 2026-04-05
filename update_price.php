<?php
include("database.php");

if(isset($_POST['update_price'])){
    $id = $_POST['product_id'];
    $price = $_POST['price'];

    mysqli_query($conn, "
        UPDATE products 
        SET price = $price 
        WHERE id = $id
    ");
}

header("Location: adminhome.php?msg=updated");
exit();
?>
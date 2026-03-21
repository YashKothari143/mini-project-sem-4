<?php
session_start();
include("database.php");

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$action = $_POST['action'];

if($action == "increase"){
    mysqli_query($conn, "
        UPDATE cart 
        SET quantity = quantity + 1 
        WHERE user_id = $user_id AND product_id = $product_id
    ");
}

if($action == "decrease"){

    $result = mysqli_query($conn, "
        SELECT quantity FROM cart 
        WHERE user_id = $user_id AND product_id = $product_id
    ");

    $row = mysqli_fetch_assoc($result);

    if($row['quantity'] > 1){
        mysqli_query($conn, "
            UPDATE cart 
            SET quantity = quantity - 1 
            WHERE user_id = $user_id AND product_id = $product_id
        ");
    } else {
        mysqli_query($conn, "
            DELETE FROM cart 
            WHERE user_id = $user_id AND product_id = $product_id
        ");
    }
}

header("Location: cart.php");
exit();
?>
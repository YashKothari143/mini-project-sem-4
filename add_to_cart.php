<?php
session_start();
include("database.php");

// check login
if(!isset($_SESSION['user_id'])){
    die("ERROR: User not logged in");
}

// check product_id
if(!isset($_POST['product_id'])){
    die("ERROR: No product received");
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];


// check if already in cart
$check = mysqli_query($conn, "
    SELECT * FROM cart 
    WHERE user_id = $user_id AND product_id = $product_id
");

if(!$check){
    die("SELECT ERROR: " . mysqli_error($conn));
}

// if exists → update
if(mysqli_num_rows($check) > 0){

    $update = mysqli_query($conn, "
        UPDATE cart 
        SET quantity = quantity + 1
        WHERE user_id = $user_id AND product_id = $product_id
    ");
    echo "<script>alert('item updated successfully')</script>";

    if(!$update){
        die("UPDATE ERROR: " . mysqli_error($conn));
    }

    echo "Updated Successfully";

// if not exists → insert
} else {

    $insert = mysqli_query($conn, "
        INSERT INTO cart (user_id, product_id, quantity)
        VALUES ($user_id, $product_id, 1)
    ");
    
    echo "<script>alert('added to cart successfully')</script>";
}


header("");
exit();
?>
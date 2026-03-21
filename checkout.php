<?php
session_start();
include("database.php");

// check login
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// get cart items with price
$result = mysqli_query($conn, "
    SELECT cart.product_id, cart.quantity, products.price
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
");

$total = 0;

// calculate total
while($row = mysqli_fetch_assoc($result)){
    $total += $row['price'] * $row['quantity'];
}

// insert into orders
mysqli_query($conn, "
    INSERT INTO orders (user_id, date_and_time, total_amount)
    VALUES ($user_id, NOW(), $total)
");

// get order id
$order_id = mysqli_insert_id($conn);

// get cart items again
$result = mysqli_query($conn, "
    SELECT cart.product_id, cart.quantity, products.price
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
");

// insert into order_items
while($row = mysqli_fetch_assoc($result)){

    $pid = $row['product_id'];
    $qty = $row['quantity'];
    $price = $row['price']; // 🔥 NEW

    mysqli_query($conn, "
        INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase)
        VALUES ($order_id, $pid, $qty, $price)
    ");
}



// clear cart
mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

// redirect back
header("Location: cart.php");
exit();
?>
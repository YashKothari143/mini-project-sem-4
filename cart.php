<?php
session_start();
include("database.php");

// check login
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GreenCart: Online Organic Grocery Store</title>

<link rel="stylesheet" href="cart.css">

</head>

<body>

<div class="nav">
    <div class="page-nav">
        <a href="Home.php">🏠 Home</a>
        <span>›</span>
        <a href="cart.php" class="active">🛒 Cart</a>
    </div>
</div>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>GreenCart: Online Organic Grocery Store</h1>
        <p class="tagline">Fresh • Organic • Sustainable</p>
    </div>

    <div class="cart-container">
        <h2>Your Shopping Cart</h2>

        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Total (₹)</th>
                </tr>
            </thead>

            <tbody>
<?php
$result = mysqli_query($conn, "
    SELECT products.name, products.price, cart.quantity, cart.product_id
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
");

$total = 0;

while($row = mysqli_fetch_assoc($result)){

    $name = $row['name'];
    $price = $row['price'];
    $qty = $row['quantity'];

    $sub = $price * $qty;
    $total += $sub;
?>
<tr>
    <td><?php echo $name; ?></td>
    <td><?php echo $price; ?></td>

    <td>
        <form method="POST" action="update_cart.php" style="display:inline;">
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
            <input type="hidden" name="action" value="decrease">
            <button type="submit" class="btn-decrease">➖</button>
        </form>

        <?php echo $qty; ?>

        <form method="POST" action="update_cart.php" style="display:inline;">
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
            <input type="hidden" name="action" value="increase">
            <button type="submit" class="btn-increase">➕</button>
        </form>
    </td>

    <td><?php echo $sub; ?></td>
</tr>
<?php
}
?>
</tbody>
        </table>
<h3>Grand Total: ₹<?php echo $total; ?></h3>

<form method="POST" action="checkout.php">
    <button type="submit" class="placeorder-btn">Place Order</button>
</form>

        <hr>

        <h2>Previous Bills</h2>
        <div id="billingHistory"></div>

    <?php
        $orders = mysqli_query($conn, "
            SELECT * FROM orders 
            WHERE user_id = $user_id 
            ORDER BY id DESC
        ");

        if(mysqli_num_rows($orders) == 0){
            echo "<p>No previous orders</p>";
        }

        while($order = mysqli_fetch_assoc($orders)){
        ?>
            <div class="order-box">
                <h3>Order #<?php echo $order['id']; ?></h3>
                <p>Date: <?php echo $order['date_and_time']; ?></p>
                <p>Total: ₹<?php echo $order['total_amount']; ?></p>

                <ul>
                <?php
                $items = mysqli_query($conn, "
                    SELECT products.name, order_items.quantity
                    FROM order_items
                    JOIN products ON order_items.product_id = products.id
                    WHERE order_items.order_id = ".$order['id']."
                ");

                while($item = mysqli_fetch_assoc($items)){
                ?>
                    <li>
                        <?php echo $item['name']; ?> x <?php echo $item['quantity']; ?>
                    </li>
                <?php
                }
                ?>
                </ul>
                <a href="invoice.php?order_id=<?php echo $order['id']; ?>" target="_blank">
                    <button>Download PDF</button>
                </a>
            </div>
    <?php
}
?>

</body>
</html>
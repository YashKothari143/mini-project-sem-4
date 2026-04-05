<?php
session_start();
include("database.php");
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";

require 'vendor/autoload.php'; // or dompdf/autoload.inc.php

use Dompdf\Dompdf;

$order_id = $_GET['order_id'];

// get order
$order = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM orders WHERE id = $order_id
"));

// get items
$items = mysqli_query($conn, "
    SELECT products.name, order_items.quantity, order_items.price_at_purchase
    FROM order_items
    JOIN products ON order_items.product_id = products.id
    WHERE order_items.order_id = $order_id
");

// HTML for PDF
$html = "
<style>
body {
    font-family: Arial;
}

h2 {
    text-align: center;
    color: #2e7d32;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 10px;
}

th {
    background-color: #2e7d32;
    color: white;
    padding: 8px;
}

td {
    text-align: center;
    padding: 8px;
}

.total {
    text-align: right;
    margin-top: 10px;
    font-size: 18px;
    font-weight: bold;
}
</style>";
$html = "
<h2>GreenCart Invoice</h2>
<p>Name: {$username}</p>
<p>Order ID: {$order['id']}</p>
<p>Date: {$order['date_and_time']}</p>

<table border='1' width='100%' cellpadding='5'>
<tr>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
</tr>
";

$total = 0;

while($row = mysqli_fetch_assoc($items)){
    $sub = $row['price_at_purchase'] * $row['quantity'];
    $total += $sub;

    $html .= "
    <tr>
        <td>{$row['name']}</td>
        <td>{$row['price_at_purchase']}</td>
        <td>{$row['quantity']}</td>
        <td>$sub</td>
    </tr>
    ";
}

$html .= "</table>";
$html .= "<h3>Total: Rs.$total</h3>";

// generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();

// download
$dompdf->stream("invoice_$order_id.pdf");
?>
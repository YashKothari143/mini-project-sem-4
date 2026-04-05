<?php
session_start();
include("database.php");
include("logout.php");

$username = $_SESSION['username'] ?? "Admin";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GreenCart: Online Organic Grocery Store</title>

<link rel="stylesheet" href="adminhome.css">
<link rel="stylesheet" href="Home.css">

</head>

<body>
    <?php if(isset($_GET['msg']) && $_GET['msg']=="updated"){ ?>
    <div class="success-msg"><b>Price updated successfully</b><br>
              ✅ 
    </div>
    <?php } ?>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>GreenCart Admin Dashboard</h1>
        <p class="tagline">Manage Products • Prices • Inventory
        </p>
        <div class="admin-badge">ADMIN PANEL</div>
    </div>

    <!-- SEARCH + ICONS -->
    <div class="tools-bar" style="background-color: #c8e6c9;">
        <input type="text" id="searchInput" placeholder="Search organic products...">
            <form action="index.php" method="post">
                <button type="button" class="cart-btn" onclick="toggleMenu()"><span style="font-size:20px">👤</span></button>

                <div class="logout" id="menu" style="display:none;">
                    <label>Hello Admin </label><br>
                    <input type="submit" name="logout" class="logout-btn" value="Log out">
                </div>        
            </form>
    </div>

    <!-- SLIDER -->
    <div class="slider">
        <button class="active" onclick="filterProducts('vegetable', this)">Vegetables</button>
        <button onclick="filterProducts('fruit', this)">Fruits</button>
        <button onclick="filterProducts('dairy', this)">Dairy</button>
    </div>

    <!-- PRODUCTS -->
    <div class="products">

        <!-- VEGETABLES -->
        <div class="product vegetable">
            <img src="https://tse4.mm.bing.net/th/id/OIP.AXKJ8B6K3CWq1cpr-s7rgAHaHL?pid=Api&P=0&h=180">
            <h3>Tomato</h3>

            <?php
                $res = mysqli_query($conn, "SELECT * FROM products WHERE id=1");
                $row = mysqli_fetch_assoc($res);
            ?>

                <form method="POST" action="update_price.php"class="product-form">

                    <input type="hidden" name="product_id" value="1">

                    <p class="price">
                        Price: ₹ 
                        <input class="price-input"type="number" name="price" value="<?php echo $row['price']; ?>">
                    </p>

                    <button type="submit" name="update_price"class="update-btn">🛠 Update</button>

                </form>

        </div>

        <div class="product vegetable">
            <img src="https://s3.amazonaws.com/images.ecwid.com/images/17661180/1352398916.jpg">
            <h3>Potato</h3>

            <?php
                $res = mysqli_query($conn, "SELECT * FROM products WHERE id=2");
                $row = mysqli_fetch_assoc($res);
            ?>

                <form method="POST" action="update_price.php"class="product-form">

                    <input type="hidden" name="product_id" value="2">

                    <p class="price">
                        Price: ₹ 
                        <input class="price-input"type="number" name="price" value="<?php echo $row['price']; ?>">
                    </p>

                    <button type="submit" name="update_price"class="update-btn">🛠 Update</button>

                </form>
        </div>

        <!-- FRUITS -->
        <div class="product fruit" style="display:none">
            <img src="https://cdn.stocksnap.io/img-thumbs/960w/fresh-apple_KNCHMWUOR0.jpg">
            <h3>Apple</h3>
         
            <?php
                $res = mysqli_query($conn, "SELECT * FROM products WHERE id=3");
                $row = mysqli_fetch_assoc($res);
            ?>

                <form method="POST" action="update_price.php"class="product-form">

                    <input type="hidden" name="product_id" value="3">

                    <p class="price">
                        Price: ₹ 
                        <input class="price-input"type="number" name="price" value="<?php echo $row['price']; ?>">
                    </p>

                    <button type="submit" name="update_price"class="update-btn">🛠 Update</button>

                </form>
        </div>

        <div class="product fruit" style="display:none">
            <img src="https://wallpapercave.com/wp/wp6932603.jpg">
            <h3>Banana</h3>
            <?php
                $res = mysqli_query($conn, "SELECT * FROM products WHERE id=4");
                $row = mysqli_fetch_assoc($res);
            ?>

                <form method="POST" action="update_price.php"class="product-form">

                    <input type="hidden" name="product_id" value="4">

                    <p class="price">
                        Price: ₹ 
                        <input class="price-input"type="number" name="price" value="<?php echo $row['price']; ?>">
                    </p>

                    <button type="submit" name="update_price"class="update-btn">🛠 Update</button>

                </form>

       </div> 
       
        <!-- DAIRY -->
        <div class="product dairy" style="display:none">
            <img src="https://www.dairyglobal.net/app/uploads/2023/02/IMG_Milkinglassbottles_canva_WEB.jpg">
            <h3>Milk</h3>
            <?php
                $res = mysqli_query($conn, "SELECT * FROM products WHERE id=5");
                $row = mysqli_fetch_assoc($res);
            ?>

                <form method="POST" action="update_price.php"class="product-form">

                    <input type="hidden" name="product_id" value="5">

                    <p class="price">
                        Price: ₹ 
                        <input class="price-input"type="number" name="price" value="<?php echo $row['price']; ?>">
                    </p>

                    <button type="submit" name="update_price"class="update-btn">🛠 Update</button>

                </form>
        </div>

        <div class="product dairy" style="display:none">
            <img src="https://tse4.mm.bing.net/th/id/OIP.UTRbtQ7akFe-QnSMpWZHUQHaFW?pid=Api&P=0&h=180">
            <h3>Curd</h3>
            <?php
                $res = mysqli_query($conn, "SELECT * FROM products WHERE id=6");
                $row = mysqli_fetch_assoc($res);
            ?>

                <form method="POST" action="update_price.php"class="product-form">

                    <input type="hidden" name="product_id" value="6">

                    <p class="price">
                        Price: ₹ 
                        <input class="price-input"type="number" name="price" value="<?php echo $row['price']; ?>">
                    </p>

                    <button type="submit" name="update_price"class="update-btn">🛠 Update</button>

                </form>

        </div>



    </div>

</div>
<script src="adminhome.js"></script>

</body>
</html>
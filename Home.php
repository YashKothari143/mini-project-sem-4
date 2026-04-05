<?php
session_start();
include("database.php");
include("logout.php");
$user_id = $_SESSION['user_id'];
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
if(isset($_GET['category'])){
    $_SESSION['category'] = $_GET['category'];
}

$category = $_SESSION['category'] ?? "vegetable";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GreenCart: Online Organic Grocery Store</title>

<link rel="stylesheet" href="Home.css">

</head>

<body>
    <!-- this part posp when  the user ckicls add to cart -->
    <?php if(isset($_GET['msg']) && $_GET['msg']=="added"){ ?>
    <div class="success-msg">Added to cart successfully✅</div>
    <?php } ?>
        <!-- the cart no which shoes up when u add new item -->
      
<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>GreenCart: Online Organic Grocery Store</h1>
        <p class="tagline">Fresh • Organic • Sustainable</p>
    </div>

    <!-- SEARCH + ICONS -->
    <div class="tools-bar" style="background-color: #c8e6c9;">
        <input type="text" id="searchInput" placeholder="Search organic products...">
        <div class="action-icons">
            <a href="cart.php" class="cart-btn">🛒</a>
            <?php
                $count = 0;

                $result = mysqli_query($conn, "
                    SELECT COUNT(DISTINCT product_id) as total 
                    FROM cart 
                    WHERE user_id = $user_id
                ");

                if($result){
                    $row = mysqli_fetch_assoc($result);
                    $count = $row['total'];
                }

                if($count > 0){
                    echo '<div class="cart-no">'.$count.'</div>';
                }
            ?>
            <form action="index.php" method="post">
                <button type="button" class="cart-btn" onclick="toggleMenu()"><span style="font-size:20px">👤</span></button>

                <div class="logout" id="menu" style="display:none;">
                    <label>Hello <?php echo $username; ?></label><br>
                    <input type="submit" name="logout" class="logout-btn" value="Log out">
                </div>        
            </form>
        </div>

    </div>

    <!-- SLIDER -->
    <div class="slider">
        <a href="Home.php?category=vegetable">
            <button class="<?php if($category=='vegetable') echo 'active'; ?>">Vegetables</button>
        </a>

        <a href="Home.php?category=fruit">
            <button class="<?php if($category=='fruit') echo 'active'; ?>">Fruits</button>
        </a>

        <a href="Home.php?category=dairy">
            <button class="<?php if($category=='dairy') echo 'active'; ?>">Dairy</button>
        </a>
    </div>

    <!-- PRODUCTS -->
    <div class="products">

        <!-- VEGETABLES -->
        <?php if($category == "vegetable"){ ?>
           <div name="vegetable" class="product vegetable" id="1">
            <img src="https://tse4.mm.bing.net/th/id/OIP.AXKJ8B6K3CWq1cpr-s7rgAHaHL?pid=Api&P=0&h=180">
            <h3>Tomato</h3>

            <?php
            $res = mysqli_query($conn, "SELECT * FROM products WHERE id=1");
            $row = mysqli_fetch_assoc($res);
            ?>


            <p class="price">
	     Price: ₹ <span class="price-value"><?php echo $row['price']; ?></span> / kg
            </p>
        <!-- Add to cart -->
            <form method="POST" action="add_to_cart.php">
                <input type="hidden" name="product_id" value="1">
                <button type="submit" class="buy-btn">Add to cart</button>
            </form>
        </div>

        <div class="product vegetable" id="2">
            <img src="https://s3.amazonaws.com/images.ecwid.com/images/17661180/1352398916.jpg">
            <h3>Potato</h3>
            
            <?php
            $res = mysqli_query($conn, "SELECT * FROM products WHERE id=2");
            $row = mysqli_fetch_assoc($res);
            ?>


            <p class="price">Price: ₹ <span class="price-value"><?php echo $row['price']; ?></span> / kg</p>

        <!-- Add to cart -->
	    <form method="POST" action="add_to_cart.php">
             <input type="hidden" name="product_id" value="2">
             <button type="submit" class="buy-btn">Add to cart</button>
        </form>
        </div>
        <?php } ?>

        <!-- FRUITS -->

        <?php if($category == "fruit"){ ?>
        <div class="product fruit" id="3">
            <img src="https://cdn.stocksnap.io/img-thumbs/960w/fresh-apple_KNCHMWUOR0.jpg">
            <h3>Apple</h3>
            
            <?php
            $res = mysqli_query($conn, "SELECT * FROM products WHERE id=3");
            $row = mysqli_fetch_assoc($res);
            ?>


            <p class="price">Price: ₹ <span class="price-value"><?php echo $row['price']; ?></span> / kg</p>

        <!-- Add to cart -->
	    <form method="POST" action="add_to_cart.php">
            <input type="hidden" name="product_id" value="3">
            <button type="submit" class="buy-btn">Add to cart</button>
        </form>
        </div>

        <div class="product fruit"id="4">
            <img src="https://wallpapercave.com/wp/wp6932603.jpg">
            <h3>Banana</h3>
            
            <?php
            $res = mysqli_query($conn, "SELECT * FROM products WHERE id=4");
            $row = mysqli_fetch_assoc($res);
            ?>


            <p class="price">Price: ₹ <span class="price-value"><?php echo $row['price']; ?></span> /dozen</p>

        <!-- Add to cart -->
	    <form method="POST" action="add_to_cart.php">
             <input type="hidden" name="product_id" value="4">
            <button type="submit" class="buy-btn">Add to cart</button>
        </form>
        </div>
        <?php } ?>


        <!-- DAIRY -->
         
         <?php if($category == "dairy"){ ?>
       <div class="product dairy"id="5">
            <img src="https://www.dairyglobal.net/app/uploads/2023/02/IMG_Milkinglassbottles_canva_WEB.jpg">
            <h3>Milk</h3>
            
            <?php
            $res = mysqli_query($conn, "SELECT * FROM products WHERE id=5");
            $row = mysqli_fetch_assoc($res);
            ?>


            <p class="price">Price: ₹ <span class="price-value"><?php echo $row['price']; ?></span> /litre</p>

        <!-- Add to cart -->
	    <form method="POST" action="add_to_cart.php">
            <input type="hidden" name="product_id" value="5">
            <button type="submit" class="buy-btn">Add to cart</button>
        </form>
        </div>

        <div class="product dairy"id="6">
            <img src="https://tse4.mm.bing.net/th/id/OIP.UTRbtQ7akFe-QnSMpWZHUQHaFW?pid=Api&P=0&h=180">
            <h3>Curd</h3>
            
            <?php
            $res = mysqli_query($conn, "SELECT * FROM products WHERE id=6");
            $row = mysqli_fetch_assoc($res);
            ?>


            <p class="price">Price: ₹ <span class="price-value"><?php echo $row['price']; ?></span> / kg</p>

        <!-- Add to cart -->
	    <form method="POST" action="add_to_cart.php">
            <input type="hidden" name="product_id" value="6">
            <button type="submit" class="buy-btn">Add to cart</button>
        </form>
        </div>
        <?php } ?>


    </div>

</div>



<script src="Home.js"></script>
</body>
</html>

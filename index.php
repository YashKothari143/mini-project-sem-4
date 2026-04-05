<?php
include("database.php");
session_start();
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if($email === "admin@gmail.com" && $password === "admin123"){
    header("Location: adminhome.php");
    exit();
}

    $sql = "SELECT * FROM register WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);


        if(password_verify($password,$row["password"]))
        {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: Home.php");
            exit();
        }
        else
        {
            echo "<script>alert('Wrong password')</script>";
        }
    }
    else
    {
        echo "<script>alert('User not found')</script>";
    }
}

?>
<html>
    <head>
        <title>
            Greencart: An E-comerce Platform For Online Groceries
        </title>
        <link rel="stylesheet" href="login.css">
    </head>
<body class="background">
    <img class="lamp" src="./images/lamp.png">

    <div class="login_palete">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" id="formlogin">
            <div class="login_contents">
                <h2 class="userlogintext"><b>User Login</b></h2>
                <label>Email</label>
                <input name="email" id="email" class="inputlogin" type="email" required placeholder="">
                <label>Password</label>
                <input name="password" id="password" class="inputlogin" type="password" required placeholder="">
                <a href="signup.php" class="signuppage">Don't have an account? Sign in</a>
                <input type="submit" class="submitbutton"  value="Log in">
            </div>
        </form>
    </div>
    <div class="clicktext">
        Click on the Lamp!!!
    </div>

    <script src="lamplight.js"></script>
    
    

</body>
</html>





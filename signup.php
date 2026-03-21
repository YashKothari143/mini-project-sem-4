<?php
include("database.php");

?>
<html>
    <head>
        <title>
            Greencart: An E-comerce Platform For Online Groceries
        </title>
        <link rel="stylesheet" href="signup.css">
    </head>
<body class="backgroundsignup">

    <div class="signup_palete">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post"> 
            <div class="signup_contents">
                <h2 class="usersignuptext"><b>Sign in</b></h2>
                <label>Username</label>
                <input name="username" id="username" class="inputsignup" type=text placeholder="Enter Username" required>
                <label>Email</label>
                <input name="email" id="email" class="inputsignup" type="email" placeholder="Eg: abc@gmail.com" required>
                <label>Password</label>
                <input name="password" id="password" class="inputsignup" type="password" placeholder="Enter Password" required>
                <a href="index.php" class="signuppage">Have an account? Log in</a>
                <input type="submit" class="submitbutton" value ="Sign up">
            </div>
        </form>
    </div>

</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $email=filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
        $username=filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
        $password=filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
    
    $hash=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO register(email,username,password)
        VALUES ('$email','$username','$hash')";
    mysqli_query($conn,$sql);
    echo "<script>alert('Registered successfully,Log in->')</script>";
    header("Location: index.php");
            exit();
    }
    
    
mysqli_close($conn);
?>
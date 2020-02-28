<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    if($_SESSION['is_admin']!=1){
        header("Location: userPages/home.php");
    }
    else{
        header("Location: adminPages/manualOrder.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/login.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>login</title>
</head>

<body>
    <div class="container">
        <div class="login">
            <div class='login-title'>Welcome to OS Cafe</div>
            <form action="authenticate.php" method="POST">
                <div class="form-group">
                    <input type="text" name="username" placeholder="username *" value="" required/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Your Password *" value="" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Login" />
                </div>
                <div class="form-group">
                    <a href="forgetPassword.php" class="ForgetPwd">Forget Password?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
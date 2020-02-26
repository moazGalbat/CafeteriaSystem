<?php 

  session_start();
  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['loggedin'])) {
      header('Location: ../login.php');
  }
  if ($_SESSION['is_admin']!=1){
      die ("Access Denied");
  }
?>


<?php
$response="";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	    if (empty($_GET["user"])) {
	      $response="";
	    }else{
	      $response=$_GET['user'];
	    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/addUser.css" rel="stylesheet" type="text/css">
    <link href="../css/adminNav.css" rel="stylesheet" type="text/css">

    <title>Add New User</title>
</head>
<body onload="dbreaction()">

    <?php include('adminNav.html') ?>
    <!-- *************** -->
    <div id="main-container">
        <div id="card">
            <div id="header">
                <p>Add New User</p>
            </div>
            <div id="form-container">
                <table>
                    <form action="addUserdb.php" method="POST" id="form" enctype="multipart/form-data">
                        <tr>
                            <td><label>User Name</label></td>
                            <td><input class="input" type="text" name="username" pattern="[a-zA-Z_]+[a-zA-Z0-9]{2,10}" title="Name should start with letter or underscore, 3 characters at least 'No special characters are allowed'" required></td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td><input class="input" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></td>
                        </tr>
                        <tr>
                        <td><label>Password</label></td>
                        <td><input class="input" type="password" name="password" pattern="[a-zA-Z0-9._%+-]{3,}" title="password should not be less than 3 characters or contain a special character" required></td>
                        </tr>
                    <tr>
                        <td><label>Confirm password</label></td>
                        <td><input class="input" type="password" name="confirm" required></td>
                        </tr>
                        <tr>
                            <td><label>Room</label></td>
                            <td><input class="input" type="text" name="room" pattern="[0-9]{0,5}"></td>
                        </tr>
                        <tr>
                            <td><label>Ext.</label></td>
                            <td><input class="input" type="tel" name="ext" pattern="01[0-9]{9}"></td>
                        </tr>
                        <tr>
                            <td><label>Is_admin</label></td>
                            <td>
                                <input type="radio" name="admin" value="1">Admin
                                <input type="radio" name="admin" value="0">User
                            </td>
                        </tr>
                        <tr>
                            <td><label>Profile Picture</label></td>
                            <td><input type="file" name="image" id="img" accept=".png, .jpeg, .jpg"></td>
                        </tr>
                        <tr>
                        <td><input type="hidden" name="hidden_id" value=""></td>
                        </tr>
                    </form>
                    </table>

            </div>
            <div id="footer">
                <input type="submit" form="form" id="save" value="Save">
                <input type="reset" form="form" id="reset" value="Reset">
            </div>
    </div>
    <div id="notification"></div>
</div>
<script>
let password = document.querySelector("[name=password]");
let confirm = document.querySelector("[name=confirm]");
function confimation(){
  if(password.value != confirm.value) {
    confirm.setCustomValidity("Passwords Don't Match");
  } else {
    confirm.setCustomValidity('');
  }
password.addEventListener("change",confimation);
confirm.addEventListener("change",confimation);   
}


let response = <?php echo json_encode($response)?>;
console.log(response)
let notification = document.getElementById("notification");
function dbreaction(){
    if(response == "accepted"){
        notification.innerHTML="<p class='note'>User added successfully</p>";
        notification.style.display='block';
        notification.style.animation='notify 5s forwards';
    
}else if(response == "notAccepted"){
    notification.innerHTML="<p class='note'>User already exists</p>";
        notification.style.display='block';
        notification.style.animation='notify 2s forwards';
        
}
}

</script>
</body>
</html>

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
$allData="";
$allData = "";
$response="";
$data_arr=["...","...","...","..",".."];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["data"])) {
     $allData="";
    }else{
        $allData=$_POST["data"];
        $data_arr= explode(",",$allData);
    }
}


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
    <title>cafeteria/addUser</title>
</head>
<body onload="dbreaction()">
    <div id="main-container">
        <div id="card">
            <div id="header">
                <p style="color:red"><strong>Upate USER Data</strong> </p>
            </div>
            <div id="form-container">
                <table>
                    <form action="addUserdb.php" method="POST" id="form" enctype="multipart/form-data">
                        <tr>
                            <td><label>User Name</label></td>
                            <td><input class="input" type="text" name="username" value="<?php echo $data_arr[1];?>"" pattern="[a-zA-Z_]+[a-zA-Z0-9]{2,10}" title="Name should start with letter or underscore, 3 characters at least 'No special characters are allowed'" required></td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td><input class="input" type="email" name="email" value="<?php echo $data_arr[2];?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></td>
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
                            <td><input class="input" type="text" name="room" value="<?php echo $data_arr[3];?>" pattern="[0-9]{0,5}"></td>
                        </tr>
                        <tr>
                            <td><label>Ext.</label></td>
                            <td><input class="input" type="tel" name="ext" value="<?php echo $data_arr[4];?>"  pattern="01[0-9]{9}"></td>
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
                        <td><input type="hidden" name="hidden_id" value="<?php echo $data_arr[0];?>"></td>
                        </tr>
                    </form>
                    </table>

            </div>
            <div id="footer">
                <input type="submit" form="form" id="save" value="save">
                <input type="reset" form="form" id="reset">
            </div>
    </div>
    <div id="notification"></div>
</div>
<script>
let password = document.querySelector("[name=password]");
let confirm = document.querySelector("[name=confirm]");
function confimation(){
    console.log(password.value);
    console.log(confirm.value);
  if(password.value != confirm.value) {
      
    confirm.setCustomValidity("Passwords Don't Match");
  } else {
    confirm.setCustomValidity('');
  }
}
password.addEventListener("change",confimation);
confirm.addEventListener("change",confimation);


let response = <?php echo json_encode($response)?>;
console.log(response)
let notification = document.getElementById("notification");
function dbreaction(){
    if(response == "accepted"){
        notification.innerHTML="<p class='note'>User updated successfully</p>";
        notification.style.display='block';
        notification.style.animation='notify 5s forwards';
}
}

</script>
</body>
</html>
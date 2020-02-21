<?php
$allData="";
$allData = $_POST['data'];
$data_arr= explode(",",$allData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="addUser.css" rel="stylesheet" type="text/css">
    <title>cafeteria/addUser</title>
</head>
<body>
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


</script>
</body>
</html>
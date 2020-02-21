<?php
$servername="localhost";
$username="root";
$password="";
$deleteId="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["userid"])) {
  $deleteId="";
}else{
  $deleteId=$_POST['userid'];
}
}
$conn = new PDO("mysql:host=$servername;dbname=cafteria", $username, $password);
if (mysqli_connect_errno()) {
    trigger_error(mysqli_connect_error());
    echo "connection fail".mysqli_connect_error();
    }else{
    //echo "Connected successfully";
  }

#delete from db
$sql= "DELETE FROM user where user_id=?";
$stmt=$conn->prepare($sql);
$stmt->execute([$deleteId]);

#select all from db
$sql="SELECT user_id,username,email,room,profile_pic,ext FROM user";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="allUsers.css" rel="stylesheet" type="text/css">
  <title>cafeteria/allUsers</title>
</head>
<body>
<div id="main-container">
  <div id="table-container">
    <p>All Users</p>
    <table>
    <tr>
      <th>User Name</th>
      <th>Room</th>
      <th>Image</th>
      <th>Ext.</th>
      <th>Action</th>
    </tr>
    <?php
      foreach($result as $data){
        echo "<tr>";
        echo "<td>".$data['username']."</td> <td>".$data['room']."</td> <td><img src=".$data['profile_pic']." width='30px' height='30%' alt='img'></td> <td>".$data['ext']."</td>";
        echo "<form action='updateUser.php' method='POST'>";
        echo "<td><button type='submit' name='data' value='".$data['user_id'].",".$data['username'].",".$data['email'].",".$data['room'].",".$data['ext']."'>Edit</button></form>";
        echo "<button id='delete' onclick='deleteUser()' value=".$data['user_id'].">Delete</button></td>";
        echo "</tr>";
      }
    ?>
    </table>
  </div>
</div>
<script>
  let id = document.getElementById('delete').value;
  function deleteUser(){
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      location.reload(true);
    }
  };
  xhttp.open("POST", "allUsers.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("userid="+id);

  }

</script>
</body>
</html>
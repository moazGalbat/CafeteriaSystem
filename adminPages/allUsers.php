<?php
require '../config.php';
#select all from db
$sql="SELECT user_id,username,email,room,profile_pic,ext FROM user";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/allUsers.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../css/adminNav.css" />

  <title>Users</title>
</head>
<body>
  <?php include('adminNav.html') ?>

  <!-- *************** -->
  <div id="main-container">
    <div id="table-container">
      <div class='table-title'>
        <div>All Users</div>
        <button onclick="window.location.href='addUser.php'">Add New User</button>
      </div>
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
          echo "<td>".$data['username']."</td> <td>".$data['room']."</td> <td><img src=".$data['profile_pic']." width='30px' height='30px' alt='img'></td> <td>".$data['ext']."</td>";
          echo "<form action='updateUser.php' method='POST'>";
          echo "<td><button type='submit' name='data' value='".$data['user_id'].",".$data['username'].",".$data['email'].",".$data['room'].",".$data['ext']."'>Edit</button></form>";
          echo "<button onclick='deleteUser(".$data['user_id'].")'>Delete</button></td>";
          echo "</tr>";
        }
      ?>
      </table>
    </div>
  </div>
  <script>
    function deleteUser(id){
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        location.reload(true);
      }
    };
    xhttp.open("POST", "deleteUser.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("userid="+id);
    }
    
  </script>
</body>
</html>

<?php 

session_start();
// If the user is not logged in redirect to the login page...
// if (!isset($_SESSION['loggedin'])) {
//     header('Location: ../login.php');
// }
// if ($_SESSION['is_admin']!=1){
//     die ("Access Denied");
// }
?>


<?php

include("../db.php");
// var_dump($_GET['id']);
// die();

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM order_product WHERE order_id = $id";
  $result = mysqli_query($conn, $query);
  

  $query2 = "DELETE FROM orders WHERE order_id = $id";
  $result = mysqli_query($conn, $query2);


  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'order Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: myorders.php');
}

?>

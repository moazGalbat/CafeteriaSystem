<?php

include("db.php");
var_dump($_GET);

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM product WHERE product_id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: index.php');
}

?>

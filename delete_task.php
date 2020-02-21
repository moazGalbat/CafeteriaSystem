<?php

include("db.php");

if(isset($_GET['product_id'])) {
  $id = $_GET['product_id'];
  $query = "DELETE FROM product WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: index.php');
}

?>

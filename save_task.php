<?php

include('db.php');
echo "Connected .... ";

move_uploaded_file($_FILES["file"]["tmp_name"],"files/");


if (isset($_POST['save_task'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  var_dump($_FILES);
  die();
  // $img_path = $_FILES["file"]["tmp_name"];
  // $file = $_POST['file'];


  $query = "INSERT INTO product(name, price, pic, category_id) VALUES ('$name', '$price, $img_path,$category ')";
  $query = "INSERT INTO product(name, price, pic, category_id) VALUES ('$name', '$price, $img_path,$category ')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: addProduct.php');

}

?>





<?php

include('db.php');
echo "Connected .... ";

// -------------- check for file ---------------


$filename = $_FILES['file']['name'];
$filetype = $_FILES['file']['type'];
$filetmp_name = $_FILES['file']['tmp_name'];
$filesize = $_FILES['file']['size'];
$ext = explode(".", $_FILES['file']['name']);
$fileExt = strtolower(end($ext));

$err = array();
$extensions = ["png", "jpg", "md"];


// Check File Extensions
if(in_array($fileExt, $extensions) === false){
    $err[]= "----------Extension is not Allawoed -----";
}

// Check File Size
if($filesize > 10000){
    $err[]= "----------Too Much Size -----";
}

if(empty($err) == true){
    move_uploaded_file($filetmp_name,$filename);
    echo "----------------File Added ----------";
    var_dump($filetmp_name);
}




if (isset($_POST['save_task'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  $img_path = $_FILES["file"]["tmp_name"];
  



  $query = "INSERT INTO product(name, price, pic, category_id) VALUES (' $name ', '$price', '$img_pathll',$category)";
  $result = mysqli_query($conn, $query);

  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');

}

?>





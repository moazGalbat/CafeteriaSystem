
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
include("../db.php");

$filename = $_FILES['file']['name'];
$filetype = $_FILES['file']['type'];
$filetmp_name = $_FILES['file']['tmp_name'];
$filesize = $_FILES['file']['size'];
$ext = explode(".", $_FILES['file']['name']);
$fileExt = strtolower(end($ext));

$err = array();
$extensions = ["png", "jpg", "md"];


// Check File Extensions
if (in_array($fileExt, $extensions) === false) {
  $err[] = "----------Extension is not Allawoed -----";
}


if (empty($err) == true) {
  move_uploaded_file($filetmp_name, "../images/" . $filename);
  echo "----------------File Added ----------";
  var_dump($filetmp_name);
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM product WHERE product_id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $product_name = $row['name'];
    $price = $row['price'];
    $pic = $row['pic'];
    $category = $row['category_id'];
  }
}



if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  $img_path = "/CafeteriaSystem/images/$filename";



  $query = "UPDATE product SET name = '$name', price = '$price', pic = '$img_path', category_id = $category WHERE product_id=$id";


  $result = mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';

  header('Location: list_products.php');
}

?>
<?php include('../includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
        <form action="edit_product.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
          <div class="title form-group">
            <h1> AUpdate Product </h1>
          </div>

          <div class="form-group">
            <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" placeholder="Product Name" autofocus>
          </div>

          <div class="form-group">
            <input type="number" name="price" class="form-control" value="<?php echo $row['price']; ?>" placeholder="cost" min="0" autofocus>
          </div>

          <!-- "<?php echo $row['category_id']; ?> -->
          <div class="form-group">
            <select class="form-control" name="category" value="<?php echo $row['category_id']; ?>">
              <?php
              $query = "SELECT * FROM category";
              $result_tasks = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result_tasks)) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="input-group ">
            <div class="custom-file">
              <input type="file" name="file" class="custom-file-input" value="<?php echo $row['pic']; ?>" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
          </div>
          <button class="btn-success" name="update">
            Update
          </button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include('../includes/footer.php'); ?>
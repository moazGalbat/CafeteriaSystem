<?php
include("db.php");
$title = '';
$description= '';


if  (isset($_GET['product_id'])) {
  $id = $_GET['product_id'];
  $query = "SELECT * FROM product WHERE product_id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $product_name = $row['name'];
    $price = $row['price'];
    $pic = $row['pic'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['product_id'];
  $product_name= $_POST['name'];
  $price = $_POST['price'];
  $price = $_POST['pic'];


  $query = "UPDATE product set name = '$product_name', price = '$price', pic = '$pic' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
      <div class="title form-group" >
            <h1> AUpdate Product </h1>
          </div>

          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Product Name" autofocus>
          </div>

          <div class="form-group">
            <input type="number" name="price" class="form-control" placeholder="cost" min="0" autofocus>
          </div>

          <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1" name="category">
                  <option value="1" disabled selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
          </div>

        <div class="input-group ">
          <div class="custom-file">
            <input type="file" name="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
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
<?php include('includes/footer.php'); ?>

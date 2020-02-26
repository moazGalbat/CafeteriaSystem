<?php include("../db.php"); ?>

<?php include('../includes/header.php'); ?>

<main class="container p-4">
<div class="row"><div class="col-md-3"></div><div class="col-md-6 "> <h1>Products</h1>  </div></div>
  <div class="row">
    
    <div class="col-md-10">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT p.* ,c.name as category FROM product p, category c Where p.category_id=c.id";
          $result_tasks = mysqli_query($conn, $query);  
          

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><img src="<?php echo $row['pic']; ?>" alt="" width=50px></td>
            <td><?php echo $row['category']; ?></td>
            <td>
              <a href="edit_product.php?id=<?php echo $row['product_id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_product.php?id=<?php echo $row['product_id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('../includes/footer.php'); ?>

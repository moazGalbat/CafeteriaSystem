<?php include("../db.php"); ?>

<!-- <'?php include('../includes/header.php'); ?> -->
<?php include('adminNav.html') ?>
<link rel="stylesheet" href="../css/adminNav.css" />
<link rel="stylesheet" href="../css/listProducts.css" />

<main  id='main-container' class="container p-4">
  
  <!-- ********************* -->

  <div id="table-container">
    

    <div class='table-title'>
        <div>All Products</div>
        <button onclick="window.location.href='add_product.php'">Add New Product</button>
    </div>

      <table>
          <tr class="table-header">
            <th>Product</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Action</th>
          </tr>

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
      </table>
  </div>
</main>

<!-- <'?php include('../includes/footer.php'); ?> -->

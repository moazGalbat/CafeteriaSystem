<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>
<!--  Header -->
<div class="row"><div class="col-md-3"></div><div class="col-md-6 bg-primary"> <h1>My Orders</h1>  </div></div>
<!-- Main Section  -->
<div class="row">
    
    <div class="col-md-3"></div>  <!-- Just Padding -->

    <div class="col-md-6">
        <form action="myorders.php" method="POST">
            <input type="date"  name="from"> from 
            <br>
            <input type="date"  name="to">to 
            <br>
            <input type="submit" value="Find">
        </form>
    </div>
</div>
<main class="container p-4">
  <div class="row">
    
    <div class="col-md-10">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Order Date</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM order";
          $result_tasks = mysqli_query($conn, $query);  
          var_dump($_POST);
          die();

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="delete_task.php?id=<?php echo $row['product_id']?>" class="btn btn-danger">
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
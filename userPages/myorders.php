<?php include("../db.php"); ?>
<link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
session_start();
// if ($_SESSION['loggedin']) {
//   $id= $_SESSION['id'];
// }else{
//  header('Location: /404.php');
// }
?>

<?php


$from = NULL;
$to = NULL;
$user_id = NULL;
global $res;
global $stack;
$stack = array();

if (isset($_GET['from'])) {

  $from = $_GET['from'];
}

if (isset($_GET['to'])) {

  $to = $_GET['to'];
}

if (isset($_GET['user_id'])) {

  $from = $_GET['user_id'];
}


?>

<div class="container">

  <!-- Date Start -->
  <br>
  <div class="row">
    <div class="col-md-4"></div>
    <br>
    <div class="col-md-4">
      <form action="<?php $_PHP_SELF ?>" method="GET">
        <input type="date" name="from" value="<?= $from ?>" class="form-control"> from

        <input type="date" name="to" value="<?= $to ?>" class="form-control">for <br>

        <input type="submit" value="Find" class="btn btn-dark"><br>

      </form>
    </div>
  </div>
  <!-- Date End -->


  <!-- Table Start -->
  <br>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
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

          $id= $_SESSION['id'];
          
          $query = "SELECT date as orderDate, status, SUM(price*quantity)as total, orders.order_id as order_id, order_product.product_id as product_item_id, product.pic as pic_path
              from orders ,order_product ,product 
              where orders.order_id=order_product.order_id AND 
              product.product_id=order_product.product_id and orders.user_id =$id
              GROUP by orders.order_id ";


          $q2 = "SELECT SUM(price*quantity)as total, status, date as orderDate , orders.order_id
          from orders ,order_product ,product 
          where orders.order_id=order_product.order_id AND 
          product.product_id=order_product.product_id and orders.user_id = $id
          GROUP by orders.order_id ";


        

          $result_tasks = mysqli_query($conn, $q2);
          // var_dump($result_tasks);               
          // die();

          // $id= $_SESSION['id'];



          while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
            <?php
            $res = $row;
            $q3 = "SELECT
        quantity,
        pic,name,price,
        orders.order_id
    FROM
        orders,
        product,
        order_product
    WHERE
        orders.order_id = order_product.order_id 
        AND product.product_id = order_product.product_id
          AND orders.order_id = {$row['order_id']}";
         


            ?>
            <tr>
              <td>
                <i class='fa fa-plus' aria-expanded="false" onclick="toggle('toggel-userid'+<?= $res['order_id'] ?>)"></i>
                <?php echo $row['orderDate']; ?>
              </td>
              <td><?php echo $row['status']; ?></td>
              <td><?php echo $row['total']; ?></td>
              <td>

                <a href="delete_order.php?id=<?php echo $row['order_id'] ?>" class="btn btn-danger <?php if ($row['status'] != 'processing') {
                                                                                                        echo 'd-none';
                                                                                                      } ?>">
                  <i class="far fa-trash-alt"></i>
                </a>

              </td>
            </tr>

            <tr></tr>
              <td colspan="4">
                <div class="collapse" id="toggel-userid<?= $res['order_id'] ?>">
                  <div class="card card-body" id="toggel-orderid<?= $row['order_id'] ?>">
                    <?php
                     $result_items = mysqli_query($conn, $q3);
                     
                     foreach ($result_items as $itm) {
                     
                    ?>
                    <div id="orderid<?= $row['product_id'] ?>" class="item">
                      <div>
                        <img src="<?php echo $itm['pic']; ?>" alt="" width=50px>
                        <li><?php echo $itm['quantity']; ?></li>
                        
                      </div>
                      
                    </div>

                    <?php }?>
                    <?php
                    ?>
                  </div>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
    <!-- Table End -->
  </div>

</div>

<!-- Container End -->

<!-- Shoing Order Details -->


<script>
  function toggle(id) {

    $("#" + id).toggle();
  }
</script>

<?php include('../includes/footer.php'); ?>
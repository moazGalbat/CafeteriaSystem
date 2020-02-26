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

require '../config.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/login.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Users orders</title>

    <style>
    body {
        background-color: #faf9f4;
        font-family: 'Tajawal', sans-serif;
        padding-top: 20px;

    }
    .myform{
        margin: 10px;
        padding: 10px;  
    }

    .user {

        margin: 10px;
        padding: 10px;
        background-color: #f3f1e4;
    }

    .order {
        background: #999;
        padding: 10px;

        margin: 10px;
    }

    .item {
        background: #faf9f4;
        padding: 10px;

        margin: 10px;
    }

    .table-head {
        border: 1px solid #666;
        margin-bottom:5px;
    }
    </style>
</head>

<body>
    <div class="container">

        <?php


    $from=NULL;
    $to=NULL;
    $user_id=NULL;

    if(isset($_GET['from']))
    {
    
        $from=$_GET['from'];
    }
    if(isset($_GET['to']))
    {
    
        $to=$_GET['to'];
    }
    if(isset($_GET['user_id']))
    {
    
        $user_id=$_GET['user_id'];
    }

$allUsers=getAllUser();

?>

        <form action="<?php $_PHP_SELF ?>" method="get" class="row shadow-sm myform">





            <div class="form-group form-group-md col-md-6">
                <label for="" class=" control-label"> From <i class="fa fa-calendar" aria-hidden="true"></i></label>
                <div class="">
                    <input type="date" name="from" value="<?=$from?>" class="form-control">

                </div>
            </div>



            <div class="form-group form-group-md col-md-6">
                <label for="" class=" control-label"> To <i class="fa fa-calendar" aria-hidden="true"></i></label>
                <div class="">
                    <input type="date" name="to" value="<?=$to?>" class="form-control">for
                </div>
            </div>



            <div class="form-group form-group-md col-md-6">
                <label for="" class=" control-label"> users</label>
                <div class="">
                    <select class="form-control" name="user_id" id="">
                        <option value=""></option>
                        <?php 
                      
                      foreach($allUsers as $user)
                      {
                          $selected='';
                          if($user['user_id']==$user_id){$selected='selected';}

                          echo "<option ".$selected. "  value='".$user['user_id']."'>".$user['username']."</option>";
                        }
                        
                        
                        ?>

                    </select>
                </div>
            </div>


            <div class="form-group form-group-md col-md-12">
                <div class="">
                    <input type="submit" value="Find" class="btn btn-primary">
                </div>
            </div>


        </form>
    </div>




    <div class="container">
        <div class="row">
            <span class="text-left col-md-6 table-head"> Name </span>
            <span class="text-center col-md-6 table-head">Total Amounts</span>
            <?php  
        $users= getUsers($from ,$to ,$user_id );
        foreach ($users as  $user) {
           ?>

            <div id="userid<?=$user['user_id'] ?>" class="col-md-12 user">

                <div class="row">
                    <span class="text-left col-md-6">
                        <i class='fa fa-plus' onclick="toggle('toggel-userid'+<?=$user['user_id'] ?>)"></i>
                        <?=$user['username'] ?></span>
                    <span class="text-center col-md-6"> <?=$user['total'] ?></span>

                </div>
                <div id="toggel-userid<?=$user['user_id'] ?>" style="display:none" class="row order">
                    <span class="text-left col-md-6 table-head"> Order Date </span>
                    <span class="text-center col-md-6 table-head"> Amount</span>
                    <?php 
              $orders=getUserOrders($user['user_id']);
              foreach ($orders as  $order) {
                
              ?>
                    <div id="orderid<?=$order['order_id'] ?>" class=" col-md-12">
                        <div class="row ">

                            <span class="text-left col-md-6">

                                <i class='fa fa-plus' onclick="toggle('toggel-orderid'+<?=$order['order_id'] ?>)"></i>
                                <?=$order['orderDate'] ?>
                            </span>
                            <span class="text-center col-md-6"> <?=$order['total'] ?></span>

                        </div>

                        <div id="toggel-orderid<?=$order['order_id'] ?>" style="display:none">

                            <?php 
              $items=getOrderItem($order['order_id']);
              foreach ($items as  $item) {
                
              ?>

                            <div id="orderid<?=$item['product_id'] ?>" class="item">
                                <div>
                                    <span> <?=$item['name'] ?></span>
                                    <span> <?=$item['quantity'] ?></span>

                                </div>
                            </div>



                            <?php } ?>

                        </div>
                    </div>
                    <?php }?>
                </div>






            </div>



            <?php
        }
        
        ?>
        </div>



    </div>



</body>

</html>



<?php


function getUsers($from=NULL , $to=NULL,$user_id=NULL)
{
   
    global $db;
    $andWhere='';
    if($to && $from)
    {
        $andWhere .= " AND orders.date >= '" . $from . "' AND orders.date <= '" . $to . "'";
    }
     elseif($from)
     {
        $andWhere .= " AND orders.date >= '" . $from . "'";
        
     }
     elseif($to)
     {
        $andWhere .=  " AND orders.date <= '" . $to . "'";  
     }

     if($user_id)
     {
        $andWhere=" AND  user.user_id= ".$user_id; 
     }

 
    $stm=$db->prepare("SELECT SUM(price*quantity)as total ,username, user.user_id
    from orders ,order_product , product ,user
    where orders.order_id=order_product.order_id AND 
    product.product_id=order_product.product_id 
    and user.user_id=orders.user_id ".$andWhere."
    GROUP by username");


    $stm->execute();
    $rows=$stm->fetchAll();
    return $rows; 
}


function getUserOrders($user_id)
{
    global $db;
  
    $stm=$db->prepare("SELECT SUM(price*quantity)as total,date as orderDate , orders.order_id
    from orders ,order_product ,product 
    where orders.order_id=order_product.order_id AND 
    product.product_id=order_product.product_id and orders.user_id = $user_id
    GROUP by orders.order_id ");


    $stm->execute();
    $rows=$stm->fetchAll();
    return $rows; 
}

function getOrderItem($order_id)
{
    global $db;
   
    $stm=$db->prepare("SELECT
                            quantity,
                            name,
                            orders.order_id
                        FROM
                            orders,
                            product,
                            order_product
                        WHERE
                            orders.order_id = order_product.order_id 
                            AND product.product_id = order_product.product_id
                            AND orders.order_id = $order_id");
                        
  
   $stm->execute();
    $rows=$stm->fetchAll();
    return $rows; 
}
function getAllUser()
{
    global $db;
   
    $stm=$db->prepare("SELECT
                           username,
                           user_id
                        FROM
                           user");
                     
                        
  
   $stm->execute();
    $rows=$stm->fetchAll();
    return $rows; 
}


?>
<script>
function toggle(id) {

    $("#" + id).toggle();
}
</script>
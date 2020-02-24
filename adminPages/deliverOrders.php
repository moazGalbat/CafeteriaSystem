<?php
require '../config.php';
$sql="SELECT order_id,date,status,username,room,ext FROM orders o,user u WHERE o.user_id = u.user_id and NOT o.status = 'done'";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(); 

$query="SELECT o.order_id,o.status,p.name,p.price,p.pic,op.quantity FROM orders o join order_product op on o.order_id = op.order_id join product p on p.product_id = op.product_id where NOT o.status = 'done' order by o.order_id";
$stmt = $db->prepare($query);
$stmt->execute();
$res = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check orders</title>
    <link href="../css/deliverOrder.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="../css/adminNav.css" />

</head>
<body>
<?php include('adminNav.html') ?>

<div id="main-container">
<div id="head"><p>ORDERS</p></div>
<div id="table-container">
    
    <!-- </table> -->
    <table>
      <tr class='table-header'>
        <th>Order Date</th>
        <th>Name</th>
        <th>Room</th>
        <th>Ext.</th>
        <th>Action</th>
      </tr>

    <?php
    foreach($result as $data){
      echo "<tr class='order-data'>";
      echo "<td>".$data['date']."</td><td>".$data['username']."</td><td>".$data['room']."</td><td>".$data['ext']."</td>";
      echo "<td><button onclick=updateOrder(".$data['order_id'].",'deliver')>Deliver</button>
      <button onclick=updateOrder(".$data['order_id'].",'done')>Done</button>
      </td>";
      echo "</tr>";
      echo "<tr><td class='row-data' colspan='100%'><div class='order-items'>";
      $total = 0;
      foreach($res as $orderdata){
        if($data['order_id'] == $orderdata['order_id']){
          echo "<div id='small-container'>
          <div class='item-img'> <img src='".$orderdata['pic']."' alt='img'></div>
          <div class='item-name'>".$orderdata['name']."</div>
          <div class='item-price'> Price : ".$orderdata['price']." L.E"."</div>
          <div class='item-quantity'>"."Qty : ".$orderdata['quantity']."</div>
                  </div>";
              $total+=$orderdata['price']*$orderdata['quantity']; 
            }  
        }
        echo "</div>";
        echo "<div class='total-info'><div class='label'>Total price = ".$total." L.E"."</div><div class='value'>Status : ".$data['status']."</div></div>";
        echo "</td></tr>"; 
    }
    ?>
    </table>  
</div>
</div>

<script>
function updateOrder(id,status){
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // if(status == "deliver"){
       
      // }else{

      // }
      location.reload(true);
    }
  };
  xhttp.open("POST", "updatedeliverOrder.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("order="+id+"&status="+status);
}
</script>


</body>
</html>

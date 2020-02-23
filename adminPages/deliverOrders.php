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
    <title>cafeteria/deliverOrder</title>
    <link href="../css/deliverOrder.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main-container">
<div id="head"><p>ORDERS</p></div>
<div id="table-container">
<table>
<tr>
<th>Order Date</th>
<th>Name</th>
<th>Room</th>
<th>Ext.</th>
<th>Action</th>
</tr>
<?php
foreach($result as $data){
    echo "<tr>";
    echo "<td>".$data['date']."</td><td>".$data['username']."</td><td>".$data['room']."</td><td>".$data['ext']."</td>";
    echo "<td><button onclick=updateOrder(".$data['order_id'].",'deliver')>Deliver</button>
          <button onclick=updateOrder(".$data['order_id'].",'done')>Done</button>
    </td>";
    echo "</tr>";
    echo "<tr>";
    $total = 0;
    foreach($res as $orderdata){
        if($data['order_id'] == $orderdata['order_id']){
          echo "<td><div id='small-container'>
                      <div>".$orderdata['name']."</div>
                      <div> price : ".$orderdata['price']."</div>
                      <div> <img src='".$orderdata['pic']."' alt='img' width='40px' height='40px'></div>
                      <div>".$orderdata['quantity']."</div>
              </div></td>";
          $total+=$orderdata['price']*$orderdata['quantity']; 
        }  
    } 
    echo "<td class='total'> <div>Total price = ".$total."</div><div id='".$$orderdata['order_id']."'>Status : ".$data['status']."</div></td>";
    echo "</tr>";   

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

<?php
$servername="localhost";
$username="root";
$password="";
$updatedOrder="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["order"])) {
    $updatedOrder="";
  }else{
    $updatedOrder=$_POST['order'];
  }
  }
$conn = new PDO("mysql:host=$servername;dbname=cafteria", $username, $password);
if (mysqli_connect_errno()) {
    trigger_error(mysqli_connect_error());
    echo "connection fail".mysqli_connect_error();
    }else{
    //echo "Connected successfully";
  }

$sql="SELECT order_id,date,username,room,ext FROM orders o,user u WHERE o.user_id = u.user_id and o.status = 'out for delivery'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(); 

$query="SELECT o.order_id,p.name,p.price,p.pic,op.quantity FROM orders o join order_product op on o.order_id = op.order_id join product p on p.product_id = op.product_id where o.status = 'out for delivery' order by o.order_id";
$stmt = $conn->prepare($query);
$stmt->execute();
$res = $stmt->fetchAll();

if($updatedOrder !== ""){
  $sql= "UPDATE orders SET status=? WHERE order_id=?";
  $stmt=$conn->prepare($sql);
  $stmt->execute(['done',$updatedOrder]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cafeteria/deliverOrder</title>
    <link href="deliverOrder.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main-container">
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
    echo "<td><button onclick=updateOrder(".$data['order_id'].")>Deliver</button></td>";
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
    echo "<td class='total'> Total price = ".$total."</td>";
    echo "</tr>";   

}
?>
</table>
</div>
</div>

<script>
function updateOrder(id){
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      location.reload(true);
    }
  };
  xhttp.open("POST", "deliverOrders.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("order="+id);
}
</script>


</body>
</html>
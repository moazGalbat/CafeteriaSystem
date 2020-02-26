
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
$servername = "localhost";
$username = "root";
$password="";
$dbName="cafteria";

echo "
<style>
table, th, td {
    border: 1px solid black;
}
</style>";
// Create connection
$conn = mysqli_connect($servername,$username,$password,$dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

else{
    global $from ,$to ,$user_name;
    $form=$_POST['from'];
    $to=$_POST['to'];
    


if(isset ($_POST['from']) && ($_POST['to']))
{ 
    if(isset($_POST['username']))
       {     $user_name=$_POST['username'];
              //echo $user_name;
            echo "<table><tr><th>Name</th><th>Total amount</th></tr>";
            $query="SELECT SUM(price*quantity)as total ,username
            from orders ,order_product , product ,user
            where orders.order_id=order_product.order_id AND 
            product.product_id=order_product.product_id 
            and user.user_id=orders.user_id  and date between '$from' AND '$to' 
            and username='".$user_name."'
            GROUP by date";
            $result = mysqli_query($conn, $query);
            $num_rows = mysqli_num_rows($result);
            if($num_rows>0){
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>". $row["total"]."</td><td>". $row["username"]. "</td></tr>";
                }
                echo "</table>";
              }
            else
             {
                 echo "0 rows !";
             }
        }
       
       else 
       {
            echo "<table><tr><th>totalAmount </th><th>orderDate</th></tr>";
            $query="SELECT SUM(price*quantity)as total,date as orderDate
            from orders ,order_product ,product 
            where orders.order_id=order_product.order_id AND 
            product.product_id=order_product.product_id 
            and date between '$from' AND '$to'
            GROUP by date";
            $result = mysqli_query($conn, $query);
            $num_rows = mysqli_num_rows($result);
            if($num_rows>0)
             {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td> " . $row["total"]." </td> <td>". $row["orderDate"]. "</td></tr>";
                } 
                echo "</table>";
            }
            else 
                {
                    echo "0 rows !";

                }


        }
     
}
else 
{
   echo "you didn't selet any date or user :";
    header('location:http://localhost/CafeteriaSystem/php_project/select.php');
}

}

?>
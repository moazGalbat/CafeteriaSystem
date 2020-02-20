<?php
$servername = "localhost";
$username = "root";
$password="";
$dbName="cafteria";


// Create connection
$conn = mysqli_connect($servername,$username,$password,$dbName);
$query="select * from user";
$result = mysqli_query($conn, $query);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$options ="";
while ($row2=mysqli_fetch_array($result))
{

    $options=$options."<option>$row2[1]</option>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="showOrder.php" method="post">
     <input type="date"  name="from"> from
     <br>
     <br>
     <input type="date"  name="to">for 
     <br>
     <br>
    <select name="username">
    <option value="username" selected disabled>username</option>
     <?php  echo $options ;?> 
    </select>
    <br>
    <br>
    <input type="submit" value="Find">
    </form>
</body>
</html>
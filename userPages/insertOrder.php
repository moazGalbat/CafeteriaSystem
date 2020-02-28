<?php
///
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
}
if ($_SESSION['is_admin']==1){
    die ("Access Denied");
}
//////
$user_id = $_SESSION['id'];
$products = $_POST['quantity'];
print_r($inputs);

if (!empty($products)) {
    include '../config.php';

    ///insert into orders table 
    $sql = "INSERT INTO orders (user_id , status) VALUES($user_id, 'processing')";
    $db->exec($sql);
    $order_id = $db->lastInsertId();


    ///insert into order_product table 
    foreach ($products as $id => $qunatity) {
        $sql = "INSERT INTO order_product (order_id , product_id , quantity) VALUES( $order_id , '$id', '$qunatity')";
        $db->exec($sql);
    }
    echo json_encode("success");
}
else{
    echo json_encode("faild");
}
$db = null;

// header("location: home.php");

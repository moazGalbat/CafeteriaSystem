


<?php
require '../config.php';
$deleteId="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["userid"])) {
  $deleteId="";
}else{
  $deleteId=$_POST['userid'];
}
}

#delete from db
$sql= "DELETE FROM user where user_id=?";
$stmt=$db->prepare($sql);
$stmt->execute([$deleteId]);


?>
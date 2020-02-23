<?php
require '../config.php';
$flag=false;
$userName = $email = $password= $room = $exten = $hidden_id =$user="";
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $hash = password_hash($password,PASSWORD_DEFAULT);
    $room = test_input($_POST['room']);
    $exten = test_input($_POST['ext']);
    $hidden_id = test_input($_POST['hidden_id']);
    if(isset($_FILES['image'])){
        $errors= array();      
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $ext=explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($ext));
        $extensions= array("jpeg","jpg","png");
        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
        }
        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"../images/".$file_name);
        }else{
            print_r($errors);
        }
    }

    if ($hidden_id==""){
    #select all users
        $sql="SELECT username FROM user";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(); 
        foreach($result as $names) {
            if($names['username'] == $userName){
            $flag=true;
            break;
            }
        }
                     
        if($flag==true){       
                echo "This user ALREADY EXISTS";
                $user="notAccepted";
                header('Location: addUser.php?user='.$user.'');
        }else {
            
                $sql= "INSERT INTO user (username,password,email,room,ext,profile_pic) Values(?,?,?,?,?,?)";
                $stmt=$db->prepare($sql);
                $stmt->execute([$userName,$hash,$email,$room,$exten,"/CafeteriaSystem/images/".$_FILES['image']['name']]);
                echo "row created successfully";
                $user="accepted";
                header('Location: addUser.php?user='.$user.'');
            }

        }else{
            $sql= "UPDATE user SET username=?,password=?,email=?,room=?,ext=?,profile_pic=? WHERE user_id=?";
            $stmt=$db->prepare($sql);
            $stmt->execute([$userName,$hash,$email,$room,$exten,"/CafeteriaSystem/images/".$_FILES['image']['name'],$hidden_id]);
            $user="accepted";
            header('Location: updateUser.php?user='.$user.'');
        }
        
      
}

$db=null;
?>

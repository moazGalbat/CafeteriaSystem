<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// require "databaseHandler.php";
// $conn= new DbHandler();
// $db=$conn->connect();

include "config.php";

if ( !isset($_POST['username'], $_POST['password']) ) {
	die ('Please fill both the username and password field!');
}

$query="SELECT user_id, password,profile_pic,`is_admin` FROM `user` WHERE username = ? ";
if ($stmt = $db->prepare("SELECT user_id, password,profile_pic,`is_admin` FROM `user` WHERE username = ? ")) {
	$stmt->bindParam(1, $_POST['username']);
	$stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ($res=$stmt->fetch()) {
        if (password_verify($_POST['password'],$res['password']) ) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $res['user_id'];
            $_SESSION['profile_pic']=$res['profile_pic'];
            $_SESSION['is_admin']=$res['is_admin'];

            if($res['is_admin']){
                header('Location: adminPages/manualOrder.php');
            }
            else{
                header('Location: userPages/home.php');
            }
        } else {
            echo 'Incorrect password!';
        }
    } else {
        echo 'Incorrect username!';
    }

    // $conn->disConnect();
}


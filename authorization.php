<?php
    session_start();
    $Name = htmlspecialchars(trim($_POST['Login']));

    $Password = htmlspecialchars(trim($_POST['Password']));
 
    $Password = md5($Password);    
    require_once("connect.php");
    $result = $mysql->query("SELECT UserID, Nickname FROM `User` WHERE Nickname = '$Name' AND Password = '$Password'");
    $user = $result->fetch_assoc();
    if (!$user){
            header('Location: /Auth.php');
            $_SESSION['RightData'] = 'no';
     }
    else{
            header('Location: /Profile.php');
     }
    $_SESSION['UserID'] = $user['UserID']; 
     $mysql ->close();
    

?>
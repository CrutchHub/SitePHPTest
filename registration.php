<?php
    session_start();
    $Name = htmlspecialchars(trim($_POST['Login']));

    $Password = htmlspecialchars(trim($_POST['Password']));

    require_once('connect.php');
    if(preg_match('/^[a-zA-Z0-9]{1,15}$/', $Name)){
        if (preg_match('/^(?=.*[a-zA-Z])(?=.*\d).{5,10}$/', $Password)){
            $Password = md5($Password);    
            $mysql ->query("INSERT INTO `User` (`Nickname`, `Password`) VALUES('$Name', '$Password')");
            $status = $mysql->query("SELECT userID FROM User WHERE Nickname = '$Name'");
            $status = $status->fetch_assoc();
            $mysql ->query("INSERT INTO `AccountStatus` (`userID`, `PrivilegeLevel`, `Has_Ban`) VALUES('$status[userID]', 1, 0)");
            $mysql ->close();
            header('Location: /Auth.php');
            exit();    
        }
        else{
            $_SESSION['WrongPattern'] = 'yes';
            header('Location: /Auth.php');
        }
    }
    else{
        $_SESSION['WrongName'] = 'yes';
        header('Location: /Auth.php');
    }   
?>
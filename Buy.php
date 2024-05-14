<?php
    session_start();
    if(!$_SESSION['UserID'])
    {
        header('Location: /Auth.php');
        exit();
    }
    $_SESSION['GameID'] = $_GET['GameID'];
    require_once('connect.php');

    $Balance = $mysql->query("SELECT Balance FROM User WHERE userID = '$_SESSION[UserID]'");
    $Balance = $Balance->fetch_assoc();
    if ($Balance['Balance'] < $_GET['Price']){
        $_SESSION['EnoughMoney'] = 'no';
        header('Location: /game.php');
    }
    else{
        $mysql->query("UPDATE User SET Balance = Balance-'$_GET[Price]' WHERE userID = '$_SESSION[UserID]'");
        $_SESSION['EnoughMoney'] = 'yes';
        $mysql->query("INSERT INTO `User_has_Game` (`UserID`, `GameID`) VALUES ('$_SESSION[UserID]', '$_GET[GameID]')");
        header('Location: /game.php');
    }
    
?>
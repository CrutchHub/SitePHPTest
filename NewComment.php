<?php
    session_start();
    if (!$_SESSION['UserID']){
        header('Location: /Auth.php');
        exit();
    }
    require_once('connect.php');
    if ($_POST['Descr']){
        $timeStamp = date('Y-m-d H:i:s');
        $mysql->query("INSERT INTO `Comment` (`CommentID`, `Text`, `UserID`, `GameID`, `Date`, `Mark`) VALUES (NULL, '$_POST[Descr]', '$_SESSION[UserID]', '$_POST[GameID]', '$timeStamp', '$_POST[Mark]')");
        $mysql->close();
        header('Location: /game.php');
    }
?>
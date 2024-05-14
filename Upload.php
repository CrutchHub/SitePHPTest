<?php
    session_start();
    require_once('connect.php');
    if(!$_SESSION['UserID'])header('Location: /Auth.php');
if ($_FILES['userFile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userFile']['tmp_name']))  {
    $filename = $_FILES['userFile']['name'];
    $target_dir = "img/";
    $target_path = $target_dir . basename($filename);


    if (move_uploaded_file($_FILES['userFile']['tmp_name'], $target_path)) {
      mysqli_query($mysql, "UPDATE User SET Avatar = '$target_path' WHERE UserID = '{$_SESSION['UserID']}'");
    } else {
      echo "Ошибка загрузки файла 1";
    }
  } else {
    echo "Ошибка загрузки файла";
  }
  if($_POST['NewUserDescr'] || preg_match('/^[a-zA-Z0-9]{1,15}$/', $_POST['NewUserDescr'])){
    $mysql->query("UPDATE User SET About_Me = '$_POST[NewUserDescr]' WHERE userID = '$_SESSION[UserID]'");
  }
  if (@$_POST['newNick']){
    $mysql->query("UPDATE User SET Nickname = '$_POST[newNick]' WHERE userID = '$_SESSION[UserID]'");
  }
  if (@$_POST['newpass'] || preg_match('/^(?=.*[a-zA-Z])(?=.*\d).{5,10}$/', $_POST['newpass'])){
    $npass = md5($_POST['newpass']);
    $mysql->query("UPDATE User SET Password = '$npass' WHERE userID = '$_SESSION[UserID]'");
  }
  if(@$_POST['newBalance']){
    $mysql->query("UPDATE User SET Balance = '$_POST[newBalance]' WHERE userID = '$_SESSION[UserID]'");
  }
  $mysql->close();
  header('Location: /Profile.php');
?>
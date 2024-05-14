<?php
        session_start();
        require_once('connect.php');
        print_r($_POST);
        print_r($_FILES);
    if ($_FILES['userFile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userFile']['tmp_name']))  {
        $filename = $_FILES['userFile']['name'];
        $target_dir = "img/";
        $target_path = $target_dir . basename($filename);
    
    
        if (move_uploaded_file($_FILES['userFile']['tmp_name'], $target_path)) {
          mysqli_query($mysql, "UPDATE Game SET GameAvatar = '$target_path' WHERE GameID = '$_SESSION[GameID]'");
        } else {
          echo "Ошибка загрузки файла 1";
        }
      } else {
        echo "Ошибка загрузки файла 2";
      }
      function InsertFourImages($filename){
        if ($_FILES[$filename]['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES[$filename]['tmp_name']))  {
            require('connect.php');
            $filename2 = $_FILES[$filename]['name'];
            $target_dir = "img/";
            $target_path = $target_dir . basename($filename2);
            print_r($filename);
        
            if (move_uploaded_file($_FILES[$filename]['tmp_name'], $target_path)) {
              mysqli_query($mysql, "INSERT INTO `GameImages` (`ImageID`, `GameID`, `Path`) VALUES (NULL, '$_SESSION[GameID]', '$target_path')");
            } 
            else {
              echo "Ошибка загрузки файла 1";
            }
          } else {
            echo "Ошибка загрузки файла 2";
          }
      }
      if($_FILES['userFile2']['name'] || $_FILES['userFile3']['name'] || $_FILES['userFile4']['name'] || $_FILES['userFile5']['name']){
        mysqli_query($mysql, "DELETE FROM GameImages WHERE GameID = '$_SESSION[GameID]'");
        InsertFourImages('userFile2');
        InsertFourImages('userFile3');
        InsertFourImages('userFile4');
        InsertFourImages('userFile5');
      }
      if(@$_FILES['SmallAvatar'])
      {
        if ($_FILES['SmallAvatar']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['SmallAvatar']['tmp_name']))  {
          $filename = $_FILES['SmallAvatar']['name'];
          $target_dir = "img/";
          $target_path = $target_dir . basename($filename);
      
      
          if (move_uploaded_file($_FILES['SmallAvatar']['tmp_name'], $target_path)) {
            mysqli_query($mysql, "UPDATE Game SET SmallAvatar = '$target_path' WHERE GameID = '$_SESSION[GameID]'");
          } else {
            echo "Ошибка загрузки файла 1";
          }
        } else {
          echo "Ошибка загрузки файла 2";
        }
      }
      if($_POST['newGameName']){
        $mysql->query("UPDATE Game SET Game_Name = '$_POST[newGameName]' WHERE GameID = '$_SESSION[GameID]'");
      }
      if (@$_POST['newPrice']){
        $mysql->query("UPDATE Game SET Price = '$_POST[newPrice]' WHERE GameID = '$_SESSION[GameID]'");
      }
      if (@$_POST['newDescription']){
        $mysql->query("UPDATE Game SET Description = '$_POST[newDescription]' WHERE GameID = '$_SESSION[GameID]'");
      }
      $mysql->close();
      header('Location: /game.php');
?>
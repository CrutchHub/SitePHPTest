<?php
    session_start();
    if(!$_SESSION['UserID'])header('Location: /Auth.php');
    require_once('connect.php');
    $result = $mysql->query("SELECT * from `User` WHERE UserID = ' $_SESSION[UserID]'");
    $result2 = $mysql->query("SELECT * from `AccountStatus` WHERE UserID = '$_SESSION[UserID]'");
    $result2 = $result2->fetch_assoc();
    if($result2['PrivilegeLevel'] == 2){
        $_SESSION['PrivilegeLevel'] = 2;
    }
    $Info = $result->fetch_assoc();
    $mysql->close();              
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v=2">
    <link rel="stylesheet" href="fonts.css" />
</head>
<body class="__container">
    <div class="__container korobka">
        <header class="__container">
            <nav class="headPanel">
            <img src="logo.png">
                <div class=""><a href="index.php" class="Link">Магазин</a></div>
                <div class=""><a href="library.php" class="Link">Библиотека</a></div>
                <div class=""><a href="Auth.php" class="Link">Профиль</a></div>
                <input type="search" placeholder="Поиск" class="gradient">
            </nav>
        </header>
        <main class="__container">
            <section class="profile">
                <div>
                    <img src=" <?=$Info['Avatar'];?>" class="avatarkaProfile">
                </div>
                <div class="profileSubDiv">
                    <div class="actualProfile">
                 
                        <div><span class="blueText"><?=$Info['Nickname'];?></span></div>
                        <div><?=$Info['About_Me']?></div>
                        <br>
                        <div>Ваш баланс(руб):<?=$Info['Balance']?></div>
                    </div>
                    <div>
                        <form action="Upload.php" enctype="multipart/form-data" method="post" class="newDataProfile">
                            <input type="text" placeholder="Новый никнейм" name="newNick">
                            <input type="text" placeholder="Новый баланс" name="newBalance">
                            <textarea class="newDescriptionUser" placeholder="Новое описание" name="NewUserDescr"></textarea>
                            <input type="password" placeholder="Новый пароль" name="newpass">
                            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000"> -->
                            <input type="file" name="userFile" placeholder="Новая аватарка">
                            <input type="submit" placeholder="Подтвердить" class="confirmProfile">
                            <br>
                        </form>
                        <form method="post" action="unlogin.php" class="newDataProfile">
                                <input type="submit" placeholder="Выйти из аккаунта" value="Выйти из аккаунта" class="confirmProfile">
                        </form>
                    </div>
                </div>
            </section>
            <section>
                <?php
                    if(@$_SESSION['PrivilegeLevel'] == 2){
                        echo '<h1>Вы зашли как админ.</h1>';
                    } 
                ?>
            </section>
            
        </main>
      
    </div>
</body>
</html>
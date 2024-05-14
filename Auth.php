<?php
    session_start();
    if (@$_SESSION['UserID']){
        header('Location: /Profile.php');
    }

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
        <main class="AuthMain">
           <div class="authorization">
                
                
                    <form method="post" action="authorization.php" class="AuthForm">
                        <div>Авторизация</div>
                        <input type="text" placeholder="Логин" class="AuthInput confirmButton" name="Login">
                        <input type="password" placeholder="Пароль" class="AuthInput confirmButton" name="Password">  
                        <input type="submit" class="confirmButton submitStyle" value="Подтвердить"> 
                    </form>
                    <form method="post" action="registration.php" class="AuthForm">
                        <br>
                        <div>Регистрация</div>
                        <input type="text" placeholder="Логин" class="AuthInput confirmButton" name="Login">
                        <input type="password" placeholder="Пароль" class="AuthInput confirmButton" name="Password">               
                        
                        <input type="submit" class="confirmButton submitStyle" value="Зарегистрироваться">

                    </form>         
                    <?php
                        if(@$_SESSION['RightData'] == 'no'){
                            unset($_SESSION['RightData']);
                            echo  '<div>Неправильные данные. Убедитесь что ввели правильный логин и пароль.</div>';
                        }
                        if(@$_SESSION['WrongName'] == 'yes'){
                            unset($_SESSION['WrongName']);
                            echo  '<div>Неправильный никнейм. Он должен содержать в себе от 1 до 15 символов 1 и не должен содержать специальных символов.</div>';
                        } 
                        if(@$_SESSION['WrongPattern'] == 'yes'){
                          unset($_SESSION['WrongPattern']);
                          echo  '<div>Неправильный пароль. Он должен содержать в себе от 5 до 10 символов 1 из которых обязательно цифра и 1 буква любого регистра.</div>';
                        }
                    ?>
       
               
           </div>
        </main>
       
    </div>
    <footer>
    </footer>
</body>
</html>
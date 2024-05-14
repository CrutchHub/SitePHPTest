<?php 
    session_start();
    require_once('connect.php');
    if(!$_SESSION['UserID'])
    {
        header('Location: /Auth.php');
    }
    $result1 = $mysql->query("SELECT GameID, GameAvatar, Game_Name FROM Game");
    $result2 = $mysql->query("SELECT GameID FROM User_has_Game WHERE UserID = '$_SESSION[UserID]'");
    $GameList = array();
    $UserGameList = array();
    while ($row = $result1->fetch_assoc()){
        $GameList[] = $row;
      }
    while ($row = $result2->fetch_assoc()){
        $UserGameList[] = $row;
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
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
        <main class="libmain">
            <h1>У вас куплено:</h1>
            <aside class="libraryList">
                    <?php 
                        foreach($UserGameList as $r)
                        {
                            foreach($GameList as $q)
                            {
                                if ($r['GameID'] == $q['GameID']){
                                    echo '<div class="asideList">  <div><img src="' . $q['GameAvatar'] .'" class="avatarka"></div> <div>' . $q['Game_Name'] . '</div> </div>';
                                }
                            }
                        }
                    ?>
            </aside>
        </main>
        
    </div>
</body>
</html>
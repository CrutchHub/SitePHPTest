<?php
    session_start();
    require_once("connect.php");
    if(@$_GET['GameID'])$_SESSION['GameID'] = $_GET['GameID'];
    if(@$_SESSION['EnoughMoney'] == 'no'){
        echo '<script language="javascript">';
        echo 'alert("Недостаточно средств на балансе.")';
        echo '</script>';
    }
    elseif(@$_SESSION['EnoughMoney'] == 'yes'){
        echo '<script language="javascript">';
        echo 'alert("Успешная покупка")';
        echo '</script>';
    }
    if (@$_GET['SortByTime'] && @$_GET['SortByMark']){
        if ($_GET['SortByTime'] == 'New'){
          $OrderTime = 'Comment.Date ASC';
        }
        else {
            $OrderTime = 'Comment.Date DESC';
        }
        if ($_GET['SortByMark'] == 'WithHighMark'){
            $OrderMark = 'Comment.Mark ASC';
        }
        else {
            $OrderMark = 'Comment.Mark DESC';
        }
        $Comments = $mysql->query("SELECT Comment.UserID, User.Avatar, Comment.GameID, Comment.Date, Comment.Mark, Comment.Text, User.Nickname 
        FROM Comment INNER JOIN User ON Comment.UserID = User.userID WHERE GameID = '$_SESSION[GameID]' ORDER BY $OrderMark, $OrderTime");
    }
    else{
        $Comments = $mysql->query("SELECT Comment.UserID, User.Avatar, Comment.GameID, Comment.Date, Comment.Mark, Comment.Text, User.Nickname 
        FROM Comment INNER JOIN User ON Comment.UserID = User.userID WHERE GameID = '$_SESSION[GameID]'");
    }
    $result = $mysql->query("SELECT `Path` FROM `GameImages` WHERE GameID = '$_SESSION[GameID]'");
    $result2 = $mysql->query("SELECT `GameAvatar`, `Description`, Game_Name, Price, SmallAvatar FROM `Game` WHERE GameID = '$_SESSION[GameID]'");
    $result2 = $result2->fetch_assoc();
    $avatarka = $result2['GameAvatar'];
    $miniavatarka = $result2['SmallAvatar'];
    $gameDescr = $result2['Description'];
    $arra = array();
    while ($row = $result->fetch_assoc()){
      $arra[] = $row;
    }

  
    $CommentsArray = array();
    while ($row = $Comments->fetch_assoc()){
        $CommentsArray[] = $row;
    }
    $CommentsArray = array_reverse($CommentsArray);
    $AvgMarks  = $mysql->query("SELECT AVG(Mark) AS Average_Mark FROM Comment WHERE GameID = '$_SESSION[GameID]'");
    $AvgMarks = $AvgMarks->fetch_assoc();
    $Five = $mysql->query("SELECT COUNT(Mark) AS MarkCount FROM Comment WHERE GameID = '$_SESSION[GameID]' and Mark = 5;");
    $Five = $Five->fetch_assoc();
    $Four = $mysql->query("SELECT COUNT(Mark) AS MarkCount FROM Comment WHERE GameID = '$_SESSION[GameID]' and Mark = 4;");
    $Four = $Four->fetch_assoc();
    $Three = $mysql->query("SELECT COUNT(Mark) AS MarkCount FROM Comment WHERE GameID = '$_SESSION[GameID]' and Mark = 3;");
    $Three = $Three->fetch_assoc();
    $Two = $mysql->query("SELECT COUNT(Mark) AS MarkCount FROM Comment WHERE GameID = '$_SESSION[GameID]' and Mark = 2;");
    $Two = $Two->fetch_assoc();
    $One = $mysql->query("SELECT COUNT(Mark) AS MarkCount FROM Comment WHERE GameID = '$_SESSION[GameID]' and Mark = 1;");
    $One = $One->fetch_assoc();
    $tags = $mysql->query("SELECT TagID FROM Game_has_Tag WHERE GameID = '$_SESSION[GameID]'");
    $GameTagsArray = array();
    while ($row = $tags->fetch_assoc()){
        $GameTagsArray[] = $row;
      }
    $tagsTable = $mysql->query("SELECT TagID, TagName FROM Tag");
    $targArray = array();
  
    while ($row = $tagsTable->fetch_assoc()){
        $tagsArray[] = $row;
      }
    if (@!$_SESSION['UserID'])
    {
        $CommentsDisabled = 'disabled';
    }
    if ($AvgMarks['Average_Mark'] > 4.4) $count = 5;
    elseif($AvgMarks['Average_Mark'] <= 4.4 && $AvgMarks['Average_Mark'] > 3.4) $count = 4;
    elseif($AvgMarks['Average_Mark'] <= 3.4 && $AvgMarks['Average_Mark'] > 2.4) $count = 3;
    elseif($AvgMarks['Average_Mark'] <= 2.4 && $AvgMarks['Average_Mark'] > 1.4) $count = 2;
    elseif($AvgMarks['Average_Mark'] <= 1.4 && $AvgMarks['Average_Mark'] > 0.4) $count = 1;
    else $count = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css?v=2">
    <link rel="stylesheet" href="fonts.css" />
</head>
<body class="__container">
    <div class="__container korobka">
        <?php 
           if( $_SESSION['EnoughMoney'] = false){
            echo '<script language="javascript">';
            echo 'alert("Недостаточно средств на балансе.")';
            echo '</script>';      }
        ?>
        <header class="__container">
            <nav class="headPanel">
                <img src="logo.png" class="logotip">
                <div class=""><a href="index.php" class="Link">Магазин</a></div>
                <div class=""><a href="library.php" class="Link">Библиотека</a></div>
                <div class=""><a href="Auth.php" class="Link">Профиль</a></div>
                <input type="search" placeholder="Поиск" class="gradient">
            </nav>
        </header>
            <?php 
                if(@$_SESSION['PrivilegeLevel'] == 2){
                    echo '
                        <form action="change.php" method="post" class="admin" enctype="multipart/form-data">
                                <input type="text" placeholder="Новое название игры" name="newGameName">
                                <br>
                                <input type="text" placeholder="Новая цена игры" name="newPrice">
                                <br>
                                <input type="text" placeholder="Новое описание игры" name="newDescription">
                    
                              
                                <p>Загрузить аватарку</p><br>
                                <input type="file" name="userFile">
                                <p>Загрузить вторую аватарку</p><br>
                                <input type="file" name="SmallAvatar">
                               
                                <p>Загрузить 4 картинки для игры</p> <br>
                                <input type="file" name="userFile2"> <br>
                                <input type="file" name="userFile3"> <br>
                                <input type="file" name="userFile4"> <br>
                                <input type="file" name="userFile5"> <br>
                                <br>
                                <input type="submit" value="Подтвердить">
                        </form>
                    ';
                }            
            ?>
        <main class="__container">
            <section class="firstSection">
                <div class="firstSectionSubDiv">
                    <div class="firstSectionBigImage">
                        <img src="<?=$avatarka;?>" class="pictures">
                    </div>
                    <div class="firstSectionFourImages">
                        <?php 
                            foreach ($arra as $r){
                                echo '<div class="firstSectionSmallImage"><img src="' . $r['Path'] . '" class="pictures"></div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="firstSectionSubDiv2">
                    <div class="firstSectionSubDiv2UpperInformation">
                        <div class="firstSectionMediumImage">
                            <img src="<?= $miniavatarka?>" class="pictures">
                        </div>
                        <div class="tags gradient">
                            <?php 
                                foreach($tagsArray as $r){
                                    foreach($GameTagsArray as $q){
                                        if ($r['TagID'] == $q['TagID']){
                                            echo '<div class="tag">'. $r['TagName'] . '</div>';
                                        }
                                    }
                                }
                            
                            ?>

                        </div>
                    </div>
                    <div class="stars gradient">
                        <div class="starsDiv">
                            <?php  
                                for($i = 0; $i < $count; $i++)
                                {
                                    echo '<img src="stars.png" alt="" class="stars2">';
                                }
                            ?>
                        </div>
                        <div class="starsSum">Общая оценка: <span class="blueText"><?=$AvgMarks['Average_Mark'];?></span></div>
                    </div>
                </div>
            </section>
    
            <section class="secondSection">
                <div class="secondSectionSubDiv">
                    <div class="priceDiv">
                        <span class="BuyText">Купить <?= $result2['Game_Name']?></span>
                        <div class="BuyAndPrice">
                            <div class="Price"><?=$result2['Price'];?> руб</div>
                            <form action="Buy.php" method="get">
                                <input type="hidden" name="GameID" value="<?= $_SESSION['GameID'];?>">
                                <input type="hidden" name="Price" value="<?= $result2['Price'];?>">
                                <input type="submit" class="Buy" value="Купить">
                            </form>
                          
                        </div>
                    </div>
                    <div class="description gradient">
                        <h2 class="blueText">Описание</h2>
                        <p class="descr"><?=$gameDescr?></p>
                    </div>
                </div>
    
                <div class="secondSectionSubDiv2">
                    <div class="statistic gradient">
                        <div class="stats"> Оценок 5: <span class="blueText"><?=$Five['MarkCount'];?></span></div>
                        <div class="stats"> Оценок 4: <span class="blueText"><?=$Four['MarkCount'];?></span></div>
                        <div class="stats"> Оценок 3: <span class="blueText"><?=$Three['MarkCount'];?></span></div>
                        <div class="stats"> Оценок 2: <span class="blueText"><?=$Two['MarkCount'];?></span></div>
                        <div class="stats"> Оценок 1: <span class="blueText"><?=$One['MarkCount'];?></span></div>
                    </div>

                </div>
            </section>
            <section class="thirdSection">
                <h2>Комментарии</h2>
                <div class="AllFiltrs">
                    <form class="AllFiltrs" method="get" action="game.php">
                        <input type="hidden" value="<?= $_SESSION['GameID'];?>" name="GameID">
                        <select class="Filtr" name="SortByTime">
                            <option value="New">Новые</option>
                            <option value="Old">Старые</option>
                        </select>
                        <select class="Filtr" name="SortByMark">
                            <option value="WithHighMark">С высокой оценкой</option>
                            <option value="WithLowMark">С низкой оценкой</option>
                        </select>
              
                        <input type="submit" value="Применить" class="AcceptButton submitStyle">

                    </form>
                   
                </div>
                <div class="comments">
                        <div class="MakeComment">
                    
                                <form method="post" action="NewComment.php">
                                <label for="UserMark">Оценка</label><select name="Mark" id="UserMark">
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                </select>
                                <textarea placeholder="Оставь свой комментарий" class="newComm" name="Descr"></textarea>
                                <input type="submit" <?=@$CommentsDisabled?> placeholder="Подтвердить" class="confirmProfile AcceptButton submitStyle">
                                <input type="hidden" name="GameID" value="<?=$_SESSION['GameID']?>">
                                </form>                             
                        </div>
                </div>
                <div class="comments">
                    <?php 
                        foreach($CommentsArray as $r)
                        {
                            echo '<div class="comment">
                                        <div>
                                            <img src="' . $r['Avatar'] . '" alt="" class="avatarka">
                                        </div>
                                        <div>
                                                <div><span class="blueText">' . $r['Nickname'] . '</span></div>
                                                <div>Оценка:<span class="blueText">'. $r['Mark'] . '</span></div>
                                                <div>' . $r['Text'] . '  <br>
                                                <span class="blueText">' . $r['Date'] . '</span>
                                                </div>
                                                
                                        </div>  
                                    </div>';
                      
                        }                    
                    ?>
                    
                </div>
            </section>
        </main>
    
    </div>
    
</body>
</html>
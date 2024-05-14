<?php
    require_once('connect.php');
    $result = $mysql->query("SELECT `GameAvatar`, `Position`, `GameID`, Description, Game_Name from `Game` ORDER BY `Position` ASC");
    $arra = array();
    while ($row = $result->fetch_assoc()){
      $arra[] = $row;
    }
    
    function homeGamesName($pos, $arr){
      foreach($arr as $sas){
        if ($pos == $sas['Position'])
        {
          return $sas['Game_Name'];
        }
      }
    }
    function homeGames($pos, $arr){
      foreach($arr as $sas){
        if ($pos == $sas['Position'])
        {
          return $sas['GameAvatar'];
        }
      }
    }
    function homeGamesID($pos, $arr){
      foreach($arr as $sas){
        if ($pos == $sas['Position'])
        {
          return $sas['GameID'];
        }
      }
    }
    function homeGamesDescr($pos, $arr){
      foreach($arr as $sas){
        if ($pos == $sas['Position'])
        {
          return $sas['Description'];
        }
      }
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="reset.css" />
    <link rel="stylesheet" href="fonts.css" />
    <link rel="stylesheet" href="style2.css" />
    <link rel="stylesheet" href="style.css"/>
  </head>
  <body>
  <header class="__container">
            <nav class="headPanel">
            <img src="logo.png">
                <div class=""><a href="index.php" class="Link">Магазин</a></div>
                <div class=""><a href="library.php" class="Link">Библиотека</a></div>
                <div class=""><a href="Auth.php" class="Link">Профиль</a></div>
                <input type="search" placeholder="Поиск" class="gradient">
            </nav>
    </header>
    <main>
      <section class="container">
        <a href="game.php?Position=1&amp;GameID=<?=homeGamesID(1, $arra )?>">
        <img
          class="osnov"
          src="<?=homeGames(1, $arra)?>"
        />  
        </a>
       
        <div class="showcase__description">
          <h2 class="showcase__title"><?=homeGamesName(1, $arra);?></h2>
          <div class="showcase__text">
            <?=homeGamesDescr(1, $arra)?>
          </div>
        </div>
      </section>
      <section class="container games">
        <div class="games__grid">
          <div class="games_game">
            <a href="game.php?Position=2&amp;GameID=<?=homeGamesID(2, $arra)?>">
              <img
                class="game"
                src="<?=homeGames(2, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=3&amp;GameID=<?=homeGamesID(3, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(3, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=4&amp;GameID=<?=homeGamesID(4, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(4, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=5&amp;GameID=<?=homeGamesID(5, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(5, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=6&amp;GameID=<?=homeGamesID(6, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(6, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=7&amp;GameID=<?=homeGamesID(7, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(7, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=8&amp;GameID=<?=homeGamesID(8, $arra )?>">
              <img class="game"
              src="<?=homeGames(8, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=9&amp;GameID=<?=homeGamesID(9, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(9, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=10&amp;GameID=<?=homeGamesID(10, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(10, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=11&amp;GameID=<?=homeGamesID(11, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(11, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=12&amp;GameID=<?=homeGamesID(12, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(12, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=13&amp;GameID=<?=homeGamesID(13, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(13, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=14&amp;GameID=<?=homeGamesID(14, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(14, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=15&amp;GameID=<?=homeGamesID(15, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(15, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=16&amp;GameID=<?=homeGamesID(16, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(16, $arra)?>"
              />
            </a>
          </div>
          <div class="games_game">
            <a href="game.php?Position=17&amp;GameID=<?=homeGamesID(17, $arra )?>">
              <img
                class="game"
                src="<?=homeGames(17, $arra)?>"
              />
            </a>
          </div>
        </div>
      </section>
    </main>
    <footer class="__container">
      <section class="container">
        <div class="fot">
          <img src="logo.png" class="logo2" alt="нет" />
          <p class="ttx">
            Все права защищены. Все торговые марки являются собственностью
            соответствующих владельцев в Российской Федерации и других странах. НДС включён во
            все цены, где он применим.
          </p>
          <ul class="srrw">
            <li class="srrwp Link"><a href="#">Возрат средств</a></li>
            <li class="srrwp Link"><a href="#">FAQ</a></li>
          </ul>
            <ul class="srrw">
              <li class="srrwp Link"><a href="#">О нас</a></li>
              <li class="srrwp Link"><a href="#">Обратная связь</a></li>
            </ul>

          <img src="logo.png" class="logo2" alt="нет" />
        </div>
      </section>
    </footer>
  </body>
</html>

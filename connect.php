<?php
        $mysql = new mysqli('localhost', 'root', '', 'mydb');
        if(!$mysql){
            die('Ошибка подключения бд');
        }
?>
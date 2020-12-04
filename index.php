<?php
require_once 'app/get_turnament_table.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./public/css/style.css" rel="stylesheet">
    <title>Test for kit-store</title>
</head>
<body>
<div class="container">
    
    <table class="teams">
    <caption>Таблица teams</caption>
    <tr>
                <th>id</th>
                <th>name</th>
            </tr>
        <? foreach($teams as $team){ ?>
  
        <tr>
            <td><? echo $team['id'] ?></td>
            <td><? echo $team['name'] ?></td>
        </tr> 
        <? }; ?>
    </table>

    
<table class="games">
<caption>Таблица games</caption>
    <tr>
        <th>id</th>
        <th>done</th>
        <th>k1</th>
        <th>k2</th>
        <th>g1</th>
        <th>g2</th>
    </tr>  
        <? foreach($games as $game){ ?>
        <tr>
            <td><? echo $game['id'] ?></td>
            <td><? echo $game['done'] ?></td>
            <td><? echo $game['k1'] ?></td>
            <td><? echo $game['k2'] ?></td>
            <td><? echo $game['g1'] ?></td>
            <td><? echo $game['g2'] ?></td>
        </tr> <? }; ?>
</table>
        </div>

<table class="turnament">
<caption>Турнирная таблица</caption>
        <th>№</th>
        <th>Название команды</th>
        <th>И</th>
        <th> В</th>
        <th> П</th>
        <th> Н</th>
        <th> МЗ/МП</th>
        <th> О</th>
    </tr>
    <?$num = 1; foreach($turnament_table as $item){ ?>
<tr>
    <td> <? echo $num++;?></td>
    <td><? echo $item['team_name']; ?></td>
    <td><? echo $item['played_games']; ?></td>
    <td><? echo $item['games_win']; ?></td>
    <td><? echo $item['games_lose']; ?></td>
    <td><? echo $item['games_draw']; ?></td>
    <td><? echo $item['goals_scored'].' / '.$item['goals_misses']; ?></td>
    <td><? echo $item['score']; ?></td>   
</tr>
<? }; ?>
</table>
    
</body>
</html>
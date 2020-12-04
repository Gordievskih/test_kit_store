<?php
require_once 'db.php';



function getTeams($link){

    $sql = "SELECT * FROM teams ";

    $result = mysqli_query($link, $sql);

    $teams = mysqli_fetch_all($result, 1);
    
    return $teams;

};


function getGames($link){

    $sql = "SELECT * FROM games ";

    $result = mysqli_query($link, $sql);

    $games = mysqli_fetch_all($result, 1);
    
    return $games;
}

function updateTurnamentTable($link, $data){

    $sql = "INSERT INTO turnament_table ( name_team, played_games, games_win, games_lose, games_draw, goals_scored, goals_misses, score) VALUES ".$data.";";
    
    $result = mysqli_query($link, $sql);

    if(mysqli_error($link)){
        echo "Error insert data in turnament tatble";
    }

};

function getTurnamentTable($link){
    $sql = "SELECT * FROM turnament_table ORDER BY score DESC ";

    $result = mysqli_query($link, $sql);

    $turnamentTable = mysqli_fetch_all($result, 1);
    
    return $turnamentTable;
}

$turnament_table = [];
$teams = getTeams($link);
$games = getGames($link);


foreach($teams as $team){
    $turnament_table[$team['id']] = array
    (  
            'team_name' => $team['name'],
            'played_games' => 0,
            'games_win' => 0,
            'games_lose' =>0,
            'games_draw' =>0,
            'goals_scored' => 0,
            'goals_misses' => 0,
            'score' => 0,
    );  
};


foreach($games as $game){   
//Если игра состоялась, то засчитываем каждой команде по одной сыграной игре.
if($game['done'] == 1){
    $turnament_table[$game['k1']]['played_games'] += 1;
    $turnament_table[$game['k2']]['played_games'] += 1;


//Записываем все данные при выигрыше первой команды 
if($game['g1'] > $game['g2']){

    $turnament_table[$game['k1']]['games_win'] += 1;
    $turnament_table[$game['k1']]['goals_scored'] += $game['g1'];
    $turnament_table[$game['k1']]['goals_misses'] += $game['g2'];
    $turnament_table[$game['k1']]['score'] += 3;

    $turnament_table[$game['k2']]['games_lose'] += 1;
    $turnament_table[$game['k2']]['goals_scored'] += $game['g2'];
    $turnament_table[$game['k2']]['goals_misses'] += $game['g1'];

};

////Записываем все данные при выигрыше второй команды 
if($game['g1'] < $game['g2']){
    $turnament_table[$game['k2']]['games_win'] += 1;
    $turnament_table[$game['k2']]['goals_scored'] += $game['g2'];
    $turnament_table[$game['k2']]['goals_misses'] += $game['g1'];
    $turnament_table[$game['k2']]['score'] += 3;

    $turnament_table[$game['k1']]['games_lose'] += 1;
    $turnament_table[$game['k1']]['goals_scored'] += $game['g1'];
    $turnament_table[$game['k1']]['goals_misses'] += $game['g2'];

};
// Записываем данные если ничья
if($game['g1'] == $game['g2']){
    $turnament_table[$game['k1']]['games_draw'] += 1;
    $turnament_table[$game['k2']]['games_draw'] += 1;
    $turnament_table[$game['k1']]['score'] += 1;
    $turnament_table[$game['k2']]['score'] += 1;
    $turnament_table[$game['k1']]['goals_scored'] += $game['g1'];
    $turnament_table[$game['k1']]['goals_misses'] += $game['g2'];
    $turnament_table[$game['k2']]['goals_scored'] += $game['g2'];
    $turnament_table[$game['k2']]['goals_misses'] += $game['g1'];
    };

};
};




/*

Можно записать данные в новую результирующую таблицу
и вывести результат отсортированый по сумарным очкам команды

foreach($turnament_table as $item){
    $string .= "('".$item['team_name']."','".$item['played_games']."','".$item['games_win']."','".$item['games_lose']."','".$item['games_draw']."','".$item['goals_scored']."','".$item['goals_misses']."','".$item['score']."'),";
};
$string = mb_substr($string, 0, -1);
updateTurnamentTable($link,$string);
$result = getTurnamentTable($link);
*/


function cmp($a, $b)
    {
        return strcmp($a['score'], $b['score']);
    }


usort($turnament_table, "cmp");
krsort($turnament_table);


?>
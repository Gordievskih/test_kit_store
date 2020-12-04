<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'test_kit_store';


$link = mysqli_connect($host,$user,$pass,$db);

if(mysqli_connect_errno()){

    echo 'Ошибка подключения к базе данных: '.mysqli_connect_errno();
    exit();
};


?>
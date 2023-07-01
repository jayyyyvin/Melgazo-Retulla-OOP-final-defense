<?php

include "../racer.php"; 
header("Content-type: application/json; charset=UTF-8");


//initialize user class
$racer = new Racer();

//connect to database and create table
$racer->createTable();

//call get table
echo $racer->delete($_GET);
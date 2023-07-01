<?php

include "../racer.php"; 
header("Content-type: application/json; charset=UTF-8");


//initialize user class
$racer = new Racer();

//connect to database and create table
$racer->createTable();

//call create method
echo $racer->create1($_POST);
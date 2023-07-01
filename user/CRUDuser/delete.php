<?php

include "../user.php"; 
header("Content-type: application/json; charset=UTF-8");


//initialize user class
$user = new User();

//connect to database and create table
$user->createTable();

//call get table
echo $user->delete($_GET);
<?php

include "../car.php"; 
header("Content-type: application/json; charset=UTF-8");


//initialize user class
$car = new Car();

//connect to database and create table
$car->createTable();

//call create method
echo $car->create1($_POST);
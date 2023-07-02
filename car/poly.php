<?php

abstract class Database
{
    abstract public function conn();
}

interface Car 
{
    public function createtable();
}
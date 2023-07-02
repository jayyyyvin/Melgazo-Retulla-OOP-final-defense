<?php

abstract class Database
{
    abstract public function conn();
}

interface User 
{
    public function createtable();
}
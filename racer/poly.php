<?php

abstract class Database
{
    abstract public function conn();
}

interface Racer
{
    public function createtable();
}
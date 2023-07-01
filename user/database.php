<?php 

class Database{
    public $conn;
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "defense";

    public function db()
    {
        $this->conn = new MYSQLI($this->servername, $this->username, $this->password);
        $table = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        $this->conn->query($table);

        $use = "USE $this->dbname";
        $this->conn->query($use);
    }

    public function getError()
    {
        return $this->conn->error;
    }
}
$call = new Database();
$call->db();
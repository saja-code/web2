<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $dbname;

    public $conn;

    public function __construct()
    {
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->username = getenv('DB_USER') ?: 'taskuser';
        $this->password = getenv('DB_PASS') ?: '123456';
        $this->dbname = getenv('DB_NAME') ?: 'task_manager';
    }

    public function connect()
    {
        try {
            $this->conn = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->dbname
            );
        } catch (mysqli_sql_exception $exception) {
            die("Database connection failed. Check config/Database.php settings.");
        }

        if ($this->conn->connect_error) {
            die("Database connection failed. Check config/Database.php settings.");
        }

        return $this->conn;
    }
}

<?php
class Database
{
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "csc30025";
    private $username = "root";
    private $password = "";
    public $conn;

    /**
     * Connects to the db using the previously defined credentials `$host`, `$db_name`, `$username`, `$password`.
     * 
     * @return $conn the connection 
     */
    public function getConnection()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            // throw exceptions
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "DB connection successful.";
        } catch (PDOException $exception) {
            echo "DB connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
